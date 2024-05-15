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
                                    $output['employee_id'] = $eids;
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
                                $output['employee_id'] = $eids;
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
                            $output['employee_id'] = $eids;
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
                                        $output['employee_id'] = $eids;
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
                                    $output['employee_id'] = $eids;
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
                                $output['employee_id'] = $eids;
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

                        // row from employee table
                        $row = $query->fetch_assoc();
                        $id = $row['id'];
                        $e_id = $row['employee_id'];
                        $date_now = date('Y-m-d');
                        $time_check = date('h:i:s A');

                        $currentDay = date("D"); // "D" format represents the abbreviated day name.
                        $uppercaseDay = strtoupper($currentDay);


                        
                        // Check if there is a time-in entry for today
                        $asql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now'";
                        $aquery = $conn->query($asql);
                        $arow = $aquery->fetch_assoc();

                        // Checking for time out is 00:00:00
                        $asql1 = "SELECT * FROM attendance WHERE time_out = '$timeoutvalue' AND date = '$date_now' AND employee_id = '$id'";
                        $aquery1 = $conn->query($asql1);
                        $arow1 = $aquery1->fetch_assoc();
                        $idsss= $arow1['id'];   

                            if($aquery1->num_rows > 0){
                                // time in
                                
                                if ($arow1['time_out'] == $timeoutvalue) {
                                    //where attendance are update
                                    //$output['status'] = 'Employee Day';
                                    // TIME OUT
                                    $lognow = date('H:i:s');
                                    //id of attendance
                                  

                                    $sqlup = "UPDATE attendance SET time_out = '$lognow' WHERE time_out = '$timeoutvalue' AND date = '$date_now' AND employee_id = '$id'";

                                    if ($conn->query($sqlup)) {
                                        $output['image'] = "./images/" . $row['photo'];
                                        $output['time'] = 'Time out : ' . $time_check;
                                        $output['employee_id'] = $employee;
                                        $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                                       

                                    } else {
                                        $output['error'] = true;
                                        $output['message'] = $conn->error;
                                    }
                                }
                                
                                else{
                                    // time in
                                    $output['error'] = true;
                                    $output['message'] = '2';

                                }

                            }
                            else{
                                

                                // search from employee_schedule where between time_in and time_out
                                // base on certain day 
                                $sql_employee_schedule = "SELECT *
                                FROM employee_schedule
                                WHERE schedule_day = '$uppercaseDay'
                                AND ('$time_check' >= time_in OR '$time_check' <= time_in)
                                AND '$time_check' <= time_out
                                AND employee_id = '$e_id'";
       


                                // check schedule
                                $query_employee_schedule = $conn->query($sql_employee_schedule);
                                $row_employee_schedule = $query_employee_schedule->fetch_assoc();

                                
                                if($query_employee_schedule->num_rows > 0){
                                    $logstatus = ($time_check > $row_employee_schedule['time_in']) ? 1 : 0;
                                    $early_time_In = $row_employee_schedule['time_in'];
    
                                    $time_check_in = ($time_check > $row_employee_schedule['time_in']) ? $early_time_In : $time_check;

                                    $sqlinsertattendance = "INSERT INTO attendance (employee_id, date, time_in, status) 
                                    VALUES ('$id', '$date_now', '$time_check_in', '$logstatus')";

                                        if ($conn->query($sqlinsertattendance)) {
                                            $output['image'] = "./images/" . $row['photo'];
                                            $output['time'] = 'Time in : ' . $time_check;
                                            $output['employee_id'] = $employee;
                                            $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                                        } else {
                                            $output['error'] = true;
                                            $output['message'] = $conn->error;
                                        }
                                }
                                else{
                                    
                                    $output['error'] = true;
                                    $output['message'] = 'No Schedule';

                                } 
                                
                                   
                            }




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
