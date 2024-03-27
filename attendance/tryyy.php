<?php
if (isset($_POST['employee'])) {
    $output = array('error' => false);

    include 'conn.php';
    include 'timezone.php';

    $employee = $_POST['employee'];

    $sql = "SELECT * FROM employees WHERE employee_id = '$employee' OR employee_rfid= '$employee'";

    $query = $conn->query($sql);

    
    //Search the location

/* */if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        
        // Define the target latitude and longitude
        $targetLatitude = 14.6443769;
        $targetLongitude = 121.0114013;
        $tolerance = 0.001; // Adjust this value as needed
    
//if (abs($latitude - $targetLatitude) < $tolerance && abs($longitude - $targetLongitude) < $tolerance) {
if (0==0) {        
       
    //end contract
    $time_check = date('h:i:s A');
    $timeoutvalue='00:00:00';

    if ($query->num_rows > 0) {
            /**/$sqlend = "SELECT * FROM employees WHERE employee_id = '$employee' OR employee_rfid= '$employee'";
        $queryend = $conn->query($sqlend);
        $rowed = $queryend->fetch_assoc();

        $date_contract = date('Y-m-d');
        $check_contract = $rowed['end_contract'];

        if ($check_contract <= $date_contract ){
            $output['error'] = true;
            $output['message'] = 'End Contract';
        } 
        else{
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
                            $output['image'] = "../images/" . $roweid['photo'];
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
                        $output['image'] = "../images/" .$roweid['photo'];
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
                    $output['image'] = "../images/" .$roweid['photo'];
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
                            $output['image'] = "../images/" . $roweid['photo'];
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
                        $output['image'] = "../images/" .$roweid['photo'];
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
                    $output['image'] = "../images/" .$roweid['photo'];
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
            
        }
       else{





        $row = $query->fetch_assoc();
        $id = $row['id'];
        //$output['message'] = $id;
        $date_now = date('Y-m-d');
       
        // Check if there is a time-in entry for today
        $asql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now'";
        $aquery = $conn->query($asql);
        $arow = $aquery->fetch_assoc();

        $asql1 = "SELECT * FROM attendance WHERE time_out = '$timeoutvalue' AND date = '$date_now' AND employee_id = '$id'";
        $aquery1 = $conn->query($asql1);
        $arow1 = $aquery1->fetch_assoc();

        if ($aquery1->num_rows > 0 ) {

            if ($arow1['time_out'] == $timeoutvalue) {
                // TIME OUT
                $lognow = date('H:i:s');
                //id of attendance
                $idsss= $arow1['id'];
                
                $sqlup = "UPDATE attendance SET time_out = '$lognow' WHERE time_out = '$timeoutvalue' AND date = '$date_now' AND employee_id = '$id'";
        
                if ($conn->query($sqlup)) {
                    $output['image'] = "../images/" . $row['photo'];
                    $output['time'] = 'Time out : ' . $time_check;
                    $output['employee_id'] = $employee;
                    $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                    //$output['message'] = $idsss; // Set a different message for time out


                    $sql = "SELECT * FROM attendance WHERE id = '$idsss'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['time_in'];
							$time_out = $urow['time_out'];

							/**/$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();

							$value_time = 0;

                            if($urow['time_out'] < $srow['time_in']){
                                $value_time = 2;
                            }
                            elseif($srow['time_in'] > $urow['time_in']){
								$time_in = $srow['time_in'];
                                $time_out = $srow['time_out'];
                                $value_time = 1;
							}
                            elseif($srow['time_out'] < $urow['time_in']){
								
                                $value_time = 3;
							}
                            
                            else{
                                $time_in = $urow['time_in'];
                                $time_out = $srow['time_out'];
                                $value_time = 1;
                            }
                             /*   
							/*if($srow['time_out'] > $urow['time_in']){
								$time_out = $urow['time_out'];
							}
                            else{
                                $time_out = $srow['time_out'];
                            }*/
                                
                                //OT
                                if($urow['time_out'] > $srow['time_out']){
                                    
                                    $time_sot = new DateTime($srow['time_out']);
                                    $time_uot = new DateTime($urow['time_out']);

                                    $interval_ot = $time_sot->diff($time_uot);
                                    $hrs_ot = $interval_ot->format('%h');
                                    $mins_ot = $interval_ot->format('%i');
                                    $mins_ot = $mins_ot/60;
                                    $overtime = $hrs_ot + $mins_ot;
                                
                                    /*if($overtime > 4){
                                        $overtime = $overtime - 1;
                                    }*/
                                    $time_out = $srow['time_out'];
                                   
                                }
                                else{
                                    $overtime = 0;
                                    $time_out = $urow['time_out'];
                                   
                                }


                                
                            if($value_time == 1){
                                $time_in = new DateTime($time_in);
                                $time_out = new DateTime($time_out);
    
                                $interval = $time_in->diff($time_out);
                                $hrs = $interval->format('%h');
                                $mins = $interval->format('%i');
                                $mins = $mins/60;
                                $int = $hrs + $mins;
                                
                                /*if($int > 4){
                                    $int = $int - 1;
                                }*/
                                $sql = "UPDATE attendance SET num_hr = '$int' ,num_ot = '$overtime' WHERE id = '$idsss'";
							    $conn->query($sql);
                            }
                            elseif($value_time==2){
                                $int = 0;
                                $overtime = 0;
                                
                                $sql = "UPDATE attendance SET num_hr = '$int' ,num_ot = '$overtime' WHERE id = '$idsss'";
							    $conn->query($sql);
                            }
                            elseif($value_time==3){
                                $int = 0;

                                $time_sot = new DateTime($urow['time_in']);
                                $time_uot = new DateTime($urow['time_out']);

                                $interval_ot = $time_sot->diff($time_uot);
                                $hrs_ot = $interval_ot->format('%h');
                                $mins_ot = $interval_ot->format('%i');
                                $mins_ot = $mins_ot/60;
                                $overtime = $hrs_ot + $mins_ot;

                                $sql = "UPDATE attendance SET num_hr = '$int' ,num_ot = '$overtime' WHERE id = '$idsss'";
							    $conn->query($sql);
                            }
							

							
                } else {
                    $output['error'] = true;
                    $output['message'] = $conn->error;
                }
            } 
            
            else {
                // TIME IN 2
                  
               /* $output['message'] = 'Time In 2 Message'; // Set a different message for time in 2
               
                */
                //$lognow = date('H:i:s');
                $logstatus = 2;

                $sql = "INSERT INTO attendance (employee_id, date, time_in, status) 
                    VALUES ('$id', '$date_now', NOW(), '$logstatus')";

                if ($conn->query($sql)) {
                    $output['image'] = "../images/" . $row['photo'];
                    $output['time'] = 'Time in : ' . $time_check;
                    $output['employee_id'] = $employee;
                    $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                } else {
                    $output['error'] = true;
                    $output['message'] = $conn->error;
                }
               
            }
        }
        
        
        
       else{

                if ($aquery->num_rows > 0 ) {
                    $logstatus = 2;

                    $sql = "INSERT INTO attendance (employee_id, date, time_in, status) 
                        VALUES ('$id', '$date_now', NOW(), '$logstatus')";

                    if ($conn->query($sql)) {
                        $output['image'] = "../images/" . $row['photo'];
                        $output['time'] = 'Time in : ' . $time_check;
                        $output['employee_id'] = $employee;
                        $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                    } else {
                        $output['error'] = true;
                        $output['message'] = $conn->error;
                    }
                }
                else {
                    
                
                        $sched = $row['schedule_id'];
                        $lognow = date('H:i:s');
                        $sql = "SELECT * FROM schedules WHERE id = '$sched'";
                        $squery = $conn->query($sql);
                        $srow = $squery->fetch_assoc();			
                        $logstatus = ($lognow > $srow['time_in']) ? 0 : 1;


                        $sql = "INSERT INTO attendance (employee_id, date, time_in, status) 
                            VALUES ('$id', '$date_now', NOW(), '$logstatus')";

                        if ($conn->query($sql)) {
                            $output['image'] = "../images/" . $row['photo'];
                            $output['time'] = 'Time in : ' . $time_check;
                            $output['employee_id'] = $employee;
                            $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                        } else {
                            $output['error'] = true;
                            $output['message'] = $conn->error;
                        }
                }
            }
        }   //End validation of Employee Day Off
        }   //End validation of Employee Leave
        }	//End validation of end contract
    } else {
        $output['error'] = true;
        $output['message'] = 'Employee ID not found';
        $output['messages'] = $employee;
    }
//End validation of location
/**/} 
else {
    $output['error'] = true;
    $output['message'] = 'Location Not Found';
}
}
else{
    $output['error'] = true;
    $output['message'] = 'Location Data Not Available';
}
}

echo json_encode($output);
?>
