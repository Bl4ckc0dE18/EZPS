<?php
if (isset($_POST['employee'])) {
    $output = array('error' => false);
    $timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);

    include 'conn.php';
    //include 'timezone.php';

    $employee = $_POST['employee'];

    $sql = "SELECT * FROM employees WHERE employee_id = '$employee' OR employee_rfid= '$employee'";

    $query = $conn->query($sql);
    
    //Search the location
          
    //end contract
    $time_check = date('h:i:s A');
    //$time_check =$_POST['times'];

    $timeoutvalue='00:00:00';

    if ($query->num_rows > 0) {
    
    /**/$sqlend = "SELECT * FROM employees WHERE employee_id = '$employee' OR employee_rfid= '$employee'";
        $queryend = $conn->query($sqlend);
        $rowed = $queryend->fetch_assoc();

        $date_contract = date('Y-m-d');
        $check_contract = $rowed['end_contract'];
        $check_regular = $rowed['regular'];
        if ($check_contract <= $date_contract && $check_regular == 'NO' ){
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
            
        }
       else{





        $row = $query->fetch_assoc();
        $employee_id=$row['employee_id'];
        $id = $row['id'];
        //$output['message'] = $id;
        $date_now = date('Y-m-d');
        $time_checks = date('h:i:s A');
        $time_check_log = date('H:i:s', strtotime($time_checks));

        // Check if there is a time-in entry for today
        $asql = "SELECT * FROM attendance WHERE employee_id = '$id'  AND date = '$date_now'";
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
                $time_in_db= $arow1['time_in'];
                // FIRST VALIDATE THE TIME OUT IF LESS OR GREATER THAN THE TIME OUT VALUE IN SCHEDULE BEFORE UPDATING IT 
                
                //$output['time'] = 'Time out : ' . $time_in_db;
                $time_check_db = date('H:i:s', strtotime($time_in_db));

                $sql_es_db = "SELECT *
                FROM employee_schedule
                WHERE schedule_day = '$uppercaseDay'
                AND ('$time_check_db' <= time_in OR '$time_check_db' >= time_in)
                AND '$time_check_db' < time_out
                AND employee_id = '$employee_id'";
                    $query_es_db = $conn->query($sql_es_db);
                    $row_es_db = $query_es_db->fetch_assoc();
                    $time_out_db = $row_es_db['time_out'];
                    $time_check_out_db = date('H:i:s', strtotime($time_out_db));

                    //Checking if less than or equal time out 
                    $time_check_out_ot = ($time_check_log <= $time_check_out_db) ? 0 : 1;
                    $time_check_out = ($time_check_log <= $time_check_out_db) ? $time_check_log: $time_check_out_db;
                    /*$output['time'] = 'Time in : ' . $time_check_out;*/

                    // NO OT 
                        if($time_check_out_ot == 0){
                            
                            $sqlup = "UPDATE attendance SET time_out = '$time_check_out' WHERE time_out = '$timeoutvalue' AND date = '$date_now' AND employee_id = '$id' AND id ='$idsss'";
        
                            if ($conn->query($sqlup)) {
                                $output['image'] = "./images/" . $row['photo'];
                                $output['time'] = 'Time out : ' . $time_check;
                                $output['employee_id'] = $employee;
                                $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                                //$output['message'] = $idsss; // Set a different message for time out
                                $int = 0;

                                $time_in = new DateTime($time_check_db);
                                $time_out = new DateTime($time_check_out);
    
                                $interval = $time_in->diff($time_out);
                                $hrs = $interval->format('%h');
                                $mins = $interval->format('%i');
                                $mins = $mins/60;
                                $int = $hrs + $mins;

                                $sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '$idsss'";
							    $conn->query($sql);
                                
                            } else {
                                $output['error'] = true;
                                $output['message'] = $conn->error;
                            }
                        }else {
                            /**/
                                $sql_out_db = "SELECT MAX(time_out) AS max_time_out
                                FROM employee_schedule
                                WHERE schedule_day = '$uppercaseDay'
                                AND employee_id = '$employee_id'";

                                    $query_out_db = $conn->query($sql_out_db);
                                    $row_out_db = $query_out_db->fetch_assoc();

                                    $time_out_db_max = $row_out_db['max_time_out'];
                                    $time_out_dbs = date('H:i:s', strtotime($time_out_db_max));

                                    $time_ot = ($time_check_log < $time_out_dbs) ? 0 : 1;

                                        if($time_ot==0){
                                            // Not over time
                                            //$output['time'] = 'Time out: ' . $time_ot;

                                            $sqlup = "UPDATE attendance SET time_out = '$time_check_out' WHERE time_out = '$timeoutvalue' AND date = '$date_now' AND employee_id = '$id' AND id ='$idsss'";
        
                                            if ($conn->query($sqlup)) {
                                                $output['image'] = "./images/" . $row['photo'];
                                                $output['time'] = 'Time out : ' . $time_check;
                                                $output['employee_id'] = $employee;
                                                $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                                                //$output['message'] = $idsss; // Set a different message for time out
                                                $time_in = new DateTime($time_check_db);
                                                $time_out = new DateTime($time_check_out);
                    
                                                $interval = $time_in->diff($time_out);
                                                $hrs = $interval->format('%h');
                                                $mins = $interval->format('%i');
                                                $mins = $mins/60;
                                                $int = $hrs + $mins;
                
                                                $sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '$idsss'";
                                                $conn->query($sql);

                                            } else {
                                                $output['error'] = true;
                                                $output['message'] = $conn->error;
                                            }


                                        }else{
                                            //over time 
                                            // calculate the working hours
                                            
                                            $time_in = new DateTime($time_check_db);
                                            $time_out = new DateTime($time_check_out);
                
                                            $interval = $time_in->diff($time_out);
                                            $hrs = $interval->format('%h');
                                            $mins = $interval->format('%i');
                                            $mins = $mins/60;
                                            $int = $hrs + $mins;

                                            // calcualate the overtime
                                            
                                            $time_in_ot = new DateTime($time_out_dbs);
                                            $time_out_ot = new DateTime($time_check_log);
                
                                            $interval_ot = $time_in_ot->diff($time_out_ot);
                                            $hrs_ot = $interval_ot->format('%h');
                                            $mins_ot = $interval_ot->format('%i');
                                            $mins_ot = $mins_ot/60;
                                            $int_ot = $hrs_ot + $mins_ot;

                                            //$output['time'] = 'OVER TIME: ' . $int_ot;

                                            $sql_wl_db = "SELECT *
                                            FROM work_overtime
                                            WHERE schedule_load = '$uppercaseDay'
                                            AND employee_id = '$employee_id'";
                                                $query_wl_db = $conn->query($sql_wl_db);
                                                $row_wl_db = $query_wl_db->fetch_assoc();

                                               
                                                // checking if employee have work load this day 
                                                if ($query_wl_db->num_rows > 0 ){
                                                    $time_out_load = $row_wl_db['time_load'];
                                                    //$output['time'] = 'over load: ';
                                                    

                                                    $time_overload = ($int_ot <= $time_out_load) ? 0 : 1;
                                                    $time_overloads = ($int_ot <= $time_out_load) ? $int_ot  : $time_out_load;
                                                    //$time_overloads = ($int_ot <= $time_out_load) ? 0  : $time_out_load;

                                                    // checkin if the employee render the work load of time
                                                    if($time_overload==0){
                                                        //$output['time'] = 'Not Render Hour: '.$time_overloads;
                                                        $output['image'] = "./images/" . $row['photo'];
                                                        $output['time'] = 'Time out : ' . $time_check;
                                                        $output['employee_id'] = $employee;
                                                        $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                                                        
                                                        
                                                        $sql = "UPDATE attendance SET time_out = '$time_check_out',num_hr = '$int' WHERE id = '$idsss'";
                                                        $conn->query($sql);


                                                    }else{
                                                        //overload render that expecting hours  
                                                        //$output['time'] = 'Render Hour: '.$time_overloads;

                                                        $output['image'] = "./images/" . $row['photo'];
                                                        $output['time'] = 'Time out q: ' . $time_check;
                                                        $output['employee_id'] = $employee;
                                                        $output['name'] = $row['firstname'] . ' ' . $row['lastname'];

                                                        $sql = "UPDATE attendance SET time_out = '$time_check_out',num_hr = '$int',num_ot = '$time_overloads' WHERE id = '$idsss'";
                                                        $conn->query($sql);
                                                    }



                                                }else{
                                                    //just insert the update the attendance no work load
                                                    //$output['time'] = 'no over load: ';
                                                    $output['image'] = "./images/" . $row['photo'];
                                                    $output['time'] = 'Time out : ' . $time_check;
                                                    $output['employee_id'] = $employee;
                                                    $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                                                    
                                                    
                                                    $sql = "UPDATE attendance SET time_out = '$time_check_out', num_hr = '$int' WHERE id = '$idsss'";
                                                    $conn->query($sql);
                                                }



                                        }
                                    

                                
                        }
               
            } 
            
            /* else {
                // TIME IN 2
                  
               // $output['message'] = 'Time In 2 Message'; // Set a different message for time in 2
               
                
                //$lognow = date('H:i:s');
                $logstatus = 3;

                $sql = "INSERT INTO attendance (employee_id, date, time_in, status) 
                    VALUES ('$id', '$date_now', '$time_check', '$logstatus')";

                if ($conn->query($sql)) {
                    $output['image'] = "./images/" . $row['photo'];
                    $output['time'] = 'Time in : ' . $time_check;
                    $output['employee_id'] = $employee;
                    $output['name'] = $row['firstname'] . ' ' . $row['lastname'];
                } else {
                    $output['error'] = true;
                    $output['message'] = $conn->error;
                }
               
            }*/
        }
        
        
        
       else{
                // second insert in attendance
                if ($aquery->num_rows > 0 ) {
                    // second insert in attendance
                         // search from employee_schedule where between time_in and time_out
                        // base on certain day 
                        $sql_es = "SELECT *
                        FROM employee_schedule
                        WHERE schedule_day = '$uppercaseDay'
                        AND ('$time_check_log' <= time_in OR '$time_check_log' >= time_in)
                        AND '$time_check_log' < time_out
                        AND employee_id = '$employee_id'";
                        
                         // check schedule
                        $query_es = $conn->query($sql_es);
                        $row_es = $query_es->fetch_assoc();

                        if($query_es->num_rows > 0){
                            

                           

                            $early_time_In = $row_es['time_in'];

                            //$time_check_in = ($time_check_log > $row_es['time_in']) ? $early_time_In : $time_check_log ;
                            // Convert time strings to 24-hour format
                           
                            $time_in_24 = date('H:i:s', strtotime($row_es['time_in']));
                            $early_time_In_24 = date('H:i:s', strtotime($early_time_In));

                            // Compare 24-hour format times and assign accordingly
                            $logstatus = ($time_check_log > $time_in_24) ? 0 : 1;
                            $time_check_in = ($time_check_log > $time_in_24) ? $time_check_log: $early_time_In;

                           
                             /*$output['time'] = 'Time in : ' . $time_check_in;*/
                           

                           $sql_attendance = "INSERT INTO attendance (employee_id, date, time_in, status) 
                            VALUES ('$id', '$date_now', '$time_check_in', '$logstatus')";

                                if ($conn->query($sql_attendance)) {
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
                else {
                        // first insert in attendance
                        // search from employee_schedule where between time_in and time_out
                        // base on certain day 
                        $sql_es = "SELECT *
                        FROM employee_schedule
                        WHERE schedule_day = '$uppercaseDay'
                        AND ('$time_check_log' <= time_in OR '$time_check_log' >= time_in)
                        AND '$time_check_log' < time_out
                        AND employee_id = '$employee_id'";
                        
                         // check schedule
                        $query_es = $conn->query($sql_es);
                        $row_es = $query_es->fetch_assoc();

                        if($query_es->num_rows > 0){
                            

                           

                            $early_time_In = $row_es['time_in'];

                            //$time_check_in = ($time_check_log > $row_es['time_in']) ? $early_time_In : $time_check_log ;
                            // Convert time strings to 24-hour format
                           
                            $time_in_24 = date('H:i:s', strtotime($row_es['time_in']));
                            $early_time_In_24 = date('H:i:s', strtotime($early_time_In));

                            // Compare 24-hour format times and assign accordingly
                            $logstatus = ($time_check_log > $time_in_24) ? 0 : 1;
                            $time_check_in = ($time_check_log > $time_in_24) ? $time_check_log: $early_time_In;

                           
                             /*$output['time'] = 'Time in : ' . $time_check_in;*/
                           

                           $sql_attendance = "INSERT INTO attendance (employee_id, date, time_in, status) 
                            VALUES ('$id', '$date_now', '$time_check_in', '$logstatus')";

                                if ($conn->query($sql_attendance)) {
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
            }
        }   //End validation of Employee Day Off
        }   //End validation of Employee Leave
        }	//End validation of end contract
    } else {
        $output['error'] = true;
        $output['message'] = 'Employee ID not found';
        $output['messages'] = $employee;
    }
} 


echo json_encode($output);
?>

