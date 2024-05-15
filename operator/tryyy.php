<?php
if (isset($_POST['employee'])) 
{
    include 'conn.php';
    include 'timezone.php';
    $output = array('error' => false);
    $employee = $_POST['employee'];
    
    $time_check = date('h:i:s A');
    $timeoutvalue='00:00:00';

    $sql = "SELECT * FROM employees WHERE employee_id = '$employee' OR employee_rfid= '$employee'";
    $query = $conn->query($sql);
    //Start checking in database of employee
    if ($query->num_rows > 0) 
    {
            // Search Employee
            $sqlend = "SELECT * FROM employees WHERE employee_id = '$employee' OR employee_rfid= '$employee'";
            $queryend = $conn->query($sqlend);
            $rowed = $queryend->fetch_assoc();

            $date_contract = date('Y-m-d');
            $check_contract = $rowed['end_contract'];
            // Strat Validation in end contract
            if ($check_contract <= $date_contract ){
                $output['error'] = true;
                $output['message'] = 'End Contract';
            } 
             // If no Validation in end contract
            else
            {
                    /*Employee Table Search For Employee ID*/
                $sqleid = "SELECT * FROM employees WHERE employee_id = '$employee' OR employee_rfid= '$employee'";
                $queryeid = $conn->query($sqleid);
                $roweid = $queryeid->fetch_assoc();
                $eid = $roweid['employee_id'];
                $eids = $roweid['id'];
                /*Leave_Record Table Search For Employee ID*/
                $Approved = 'Approved';
                $date_leave = date('Y-m-d');
                $sqlleave = "SELECT * FROM leave_record WHERE employee_id = '$eid' AND leave_status = '$Approved' AND '$date_leave' BETWEEN datefrom AND dateto";
                $queryleave = $conn->query($sqlleave);
            
                if ($queryleave->num_rows >= 1){
                    $date_now= date('Y-m-d');
                    $esql = "SELECT * FROM attendance WHERE employee_id = '$eids' AND date = '$date_now'AND time_out ='$timeoutvalue'";
                    $equery = $conn->query($esql);
                    $erow = $equery->fetch_assoc();

                    $timeoutvalue='00:00:00';

                    $esqls = "SELECT * FROM attendance WHERE employee_id = '$eids' AND date = '$date_now' ";
                    $equerys = $conn->query($esqls);
                    $erows = $equerys->fetch_assoc();
                
                    
                    if ($equery->num_rows > 0){
                        $etime_out = $erow['time_out'];
                        $lognow = date('H:i:s');
                        $timeoutvalue='00:00:00';
                        if( $erow['time_out']== $timeoutvalue){
                                $sqlup = "UPDATE attendance SET time_out = '$lognow' WHERE time_out = '$timeoutvalue' AND date = '$date_now' AND employee_id = '$eids'";
                                if ($conn->query($sqlup)) {
                                    $output['image'] = "./images/" . $roweid['photo'];
                                    $output['time'] = 'Time out : ' . $time_check;
                                    $output['employee_id'] = $employee;
                                    $output['name'] = $roweid['firstname'] . ' ' . $roweid['lastname'];
                                    $output['status'] = 'Employee On Leave';
                                }
                                else {
                                    $output['error'] = true;
                                    $output['message'] = $conn->error;
                                }
                        }               
                    }else{

                        if ($equerys->num_rows > 0 ) {
                        $logstatus = 3;
                        $set = 0;
                        $lognow = date('H:i:s');
                        $sql = "INSERT INTO attendance (employee_id, date, time_in,time_out, status, num_hr,num_ot) 
                            VALUES ('$eids', '$date_now', '$lognow', '$timeoutvalue','$logstatus','$set','$set')";

                            if ($conn->query($sql)) {
                                $output['image'] = "./images/" .$roweid['photo'];
                                $output['time'] = 'Time in : ' .$time_check;
                                $output['employee_id'] = $employee;
                                $output['name'] = $roweid['firstname'] . ' ' . $roweid['lastname'];
                                $output['status'] = 'Employee On Leave';
                            } else {
                                $output['error'] = true;
                                $output['message'] = $conn->error;
                            }
                        }
                        else{
                        $logstatus = 3;
                        $set = 0;
                        $lognow = date('H:i:s');
                        $sql = "INSERT INTO attendance (employee_id, date, time_in,time_out, status, num_hr,num_ot) 
                            VALUES ('$eids', '$date_now', '$lognow', '$timeoutvalue','$logstatus','$set','$set')";

                        if ($conn->query($sql)) {
                            $output['image'] = "./images/" .$roweid['photo'];
                            $output['time'] = 'Time in : ' .$time_check;
                            $output['employee_id'] = $employee;
                            $output['name'] = $roweid['firstname'] . ' ' . $roweid['lastname'];
                            $output['status'] = 'Employee On Leave ';
                        } else {
                            $output['error'] = true;
                            $output['message'] = $conn->error;
                        }
                        }  
                    }
                }
                else{
                    /*Employee Table Search For Employee ID*/
                    /*Day Off Table Search For Employee ID*/
                    $currentDay = date("D"); // "D" format represents the abbreviated day name.
                    $uppercaseDay = strtoupper($currentDay);

                    $sqleid = "SELECT * FROM employees WHERE employee_id = '$employee' OR employee_rfid= '$employee' ";
                    $queryeid = $conn->query($sqleid);
                    $roweid = $queryeid->fetch_assoc();
                    $day_off = $roweid['day_off'];

                    

                    if ($day_off==$uppercaseDay){
                        $date_now= date('Y-m-d');
                        $esql = "SELECT * FROM attendance WHERE employee_id = '$eids' AND date = '$date_now'AND time_out ='$timeoutvalue'";
                        $equery = $conn->query($esql);
                        $erow = $equery->fetch_assoc();

                        $timeoutvalue='00:00:00';

                        $esqls = "SELECT * FROM attendance WHERE employee_id = '$eids' AND date = '$date_now' ";
                        $equerys = $conn->query($esqls);
                        $erows = $equerys->fetch_assoc();
                    
                        
                        if ($equery->num_rows > 0){
                            $etime_out = $erow['time_out'];
                            $lognow = date('H:i:s');
                            $timeoutvalue='00:00:00';
                            if( $erow['time_out']== $timeoutvalue){
                                    $sqlup = "UPDATE attendance SET time_out = '$lognow' WHERE time_out = '$timeoutvalue' AND date = '$date_now' AND employee_id = '$eids'";
                                    if ($conn->query($sqlup)) {
                                        $output['image'] = "./images/" . $roweid['photo'];
                                        $output['time'] = 'Time out : ' . $time_check;
                                        $output['employee_id'] = $employee;
                                        $output['name'] = $roweid['firstname'] . ' ' . $roweid['lastname'];
                                        $output['status'] = 'Employee Day Off';
                                    }
                                    else {
                                        $output['error'] = true;
                                        $output['message'] = $conn->error;
                                    }
                            }               
                        }else{

                            if ($equerys->num_rows > 0 ) {
                            $logstatus = 4;
                            $set = 0;
                            $lognow = date('H:i:s');
                            $sql = "INSERT INTO attendance (employee_id, date, time_in,time_out, status, num_hr,num_ot) 
                                VALUES ('$eids', '$date_now', '$lognow', '$timeoutvalue','$logstatus','$set','$set')";

                                if ($conn->query($sql)) {
                                    $output['image'] = "./images/" .$roweid['photo'];
                                    $output['time'] = 'Time in : ' .$time_check;
                                    $output['employee_id'] = $employee;
                                    $output['name'] = $roweid['firstname'] . ' ' . $roweid['lastname'];
                                    $output['status'] = 'Employee Day Off';
                                } else {
                                    $output['error'] = true;
                                    $output['message'] = $conn->error;
                                }
                            }
                            else{
                            $logstatus = 4;
                            $set = 0;
                            $lognow = date('H:i:s');
                            $sql = "INSERT INTO attendance (employee_id, date, time_in,time_out, status, num_hr,num_ot) 
                                VALUES ('$eids', '$date_now', '$lognow', '$timeoutvalue','$logstatus','$set','$set')";

                            if ($conn->query($sql)) {
                                $output['image'] = "./images/" .$roweid['photo'];
                                $output['time'] = 'Time in : ' .$time_check;
                                $output['employee_id'] = $employee;
                                $output['name'] = $roweid['firstname'] . ' ' . $roweid['lastname'];
                                $output['status'] = 'Employee Day Off';
                            } else {
                                $output['error'] = true;
                                $output['message'] = $conn->error;
                            }
                            }  
                        }
                        
                    }// End Validation in Day Off
                    // Start Validation in Schedule 
                    else{



                        

                        }  // End Validation in Schedule
                }// End Validation in leave   
                
            }// End Validation in end contract
        } 
    
    //End checking in database of employee
    else {
            $output['error'] = true;
            $output['message'] = 'Employee ID not found';
            $output['messages'] = $employee;
        }
   

    
} 
else{
    $output['error'] = true;
    $output['message'] = 'Fill the blank';
}


echo json_encode($output);
?>
