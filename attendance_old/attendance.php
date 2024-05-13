<?php
if (isset($_POST['employee'])) {
    $output = array('error' => false);

    include 'conn.php';
    include 'timezone.php';

    $employee = $_POST['employee'];

    $sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
    $query = $conn->query($sql);
    $time_check = date('h:i:s A');
    $timeoutvalue='00:00:00';

    if ($query->num_rows > 0) {
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
                    $output['message'] = $idsss; // Set a different message for time out


                    $sql = "SELECT * FROM attendance WHERE id = '$idsss'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['time_in'];
							$time_out = $urow['time_out'];

							/**/$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();

							if($srow['time_in'] > $urow['time_in']){
								$time_in = $srow['time_in'];
							}
                            else{
                                $time_in = $urow['time_in'];
                            }

							/*if($srow['time_out'] > $urow['time_in']){
								$time_out = $urow['time_out'];
							}
                            else{
                                $time_out = $srow['time_out'];
                            }*/

                            if($urow['time_out'] > $srow['time_out']){

                                $time_sot = new DateTime($srow['time_out']);
							    $time_uot = new DateTime($urow['time_out']);

							    $interval_ot = $time_sot->diff($time_uot);
							    $hrs_ot = $interval_ot->format('%h');
							    $mins_ot = $interval_ot->format('%i');
							    $mins_ot = $mins_ot/60;
							    $overtime = $hrs_ot + $mins_ot;
                            
							    /**/if($overtime > 4){
								    $overtime = $overtime - 1;
							    }
                                $time_out = $srow['time_out'];
							}
                            else{
                                $overtime = 0;
                                $time_out = $urow['time_out'];
                            }

							$time_in = new DateTime($time_in);
							$time_out = new DateTime($time_out);

							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
                            
							/**/if($int > 4){
								$int = $int - 1;
							}

							$sql = "UPDATE attendance SET num_hr = '$int' ,num_ot = '$overtime' WHERE id = '$idsss'";
							$conn->query($sql);
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
        
		
    } else {
        $output['error'] = true;
        $output['message'] = 'Employee ID not found';
        $output['messages'] = $employee;
    }
}

echo json_encode($output);
?>
