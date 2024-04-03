<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		if (isset($_POST['leave_status'])) {
			$selectedOption = $_POST['leave_status'];
		
			if ($selectedOption === 'Pending') {
				// Handle logic for 'Pending' option
				
				$leave_status = $_POST['leave_status'];

				$comment = 'For Review';
				$sql = "UPDATE leave_record SET leave_status = '$leave_status', leave_comment = '$comment' WHERE id = '$id'";
					if($conn->query($sql)){
						
						
						//search from leave record database
						$sqlsearch = "SELECT * FROM leave_record WHERE id = '$id'";
						$querysearch  = $conn->query($sqlsearch);
						$rowsearch = $querysearch ->fetch_assoc();
						$employee_ids= $rowsearch['employee_id'];//employee Id
						$startdate = $rowsearch['datefrom'];//date start
						$endate = $rowsearch['dateto'];//date end

						//search from employee database
						$ssearch = "SELECT * FROM employees WHERE employee_id = '$employee_ids'";
						$qsearch  = $conn->query($ssearch);
						$rsearch = $qsearch ->fetch_assoc();
						$employee_id= $rsearch['employee_id'];//employee Id
						$main_id= $rsearch['id'];//main Id
						$schedule_id= $rsearch['schedule_id'];//schedule Id
						$e_leave = $rsearch['e_leave'];//e_leave number

						//search from schedule database
						$ssearchschedules = "SELECT * FROM schedules WHERE id = '$schedule_id'";
						$qsearchschedules  = $conn->query($ssearchschedules);
						$rsearchschedules = $qsearchschedules ->fetch_assoc();

						$lognow= $rsearchschedules['time_in'];//time in
						$timeoutvalue= $rsearchschedules['time_out'];//time out

						// Convert time strings to Unix timestamps
						$time_in_timestamp = strtotime($lognow);
						$time_out_timestamp = strtotime($timeoutvalue);

						// Calculate the time difference in seconds
						$time_difference = $time_out_timestamp - $time_in_timestamp;

						// Convert seconds to hours
						$num_hr = $time_difference / 3600;

						$start_date = strtotime($startdate);
						$end_date = strtotime($endate);
						$logstatus = 3;
						$num_ot = 0;

							// Loop through each date and print it
							for ($current_date = $start_date; $current_date <= $end_date; $current_date = strtotime('+1 day', $current_date)) {
								$date_now = date('Y-m-d', $current_date);
								

								$esqls = "SELECT * FROM attendance WHERE employee_id = '$main_id' AND date = '$date_now' AND status ='$logstatus'";
								$equerys = $conn->query($esqls);
								//$erows = $equerys->fetch_assoc();
								while($erows = $equerys->fetch_assoc()){
								$id_attendance = $erows['id'];
								

								$sql = "DELETE FROM attendance WHERE id = '$id_attendance'";
								if($conn->query($sql)){
									$timezone = 'Asia/Manila';
										date_default_timezone_set($timezone);
										
										$auditdate = date('Y-m-d');
										$audittime = date('H:i:s');
										$audituser = $user['firstname'].' '.$user['lastname'];
										$auditdescription = 'Delete leave for employee id number '.$employee_id.' date '.$auditdate;

										$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
										VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
											if ($conn->query($sqlaudit)) {
												$_SESSION['success'] = 'Leave updated successfully';
											} else {
												$_SESSION['error'] = $conn->error;
											}
								}
								else{
									$_SESSION['error'] = $conn->error;
								}
							}
							}
							$timezone = 'Asia/Manila';
							date_default_timezone_set($timezone);
										
							$auditdate = date('Y-m-d');
							$audittime = date('H:i:s');
							$audituser = $user['firstname'].' '.$user['lastname'];
							$auditdescription = 'Pending leave for employee id number '.$employee_id.' date '.$date_now;

							$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
							VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
							if ($conn->query($sqlaudit)) {
								$_SESSION['success'] = 'Leave updated successfully';
							} else {
								$_SESSION['error'] = $conn->error;
							}
						

					}
					else{
						$_SESSION['error'] = $conn->error;
					}

			} elseif ($selectedOption === 'Approved') {
				// Handle logic for 'Approved' option
				$leave_status = $_POST['leave_status'];

				$comment = "Approved by : ".$user['firstname'].' '.$user['lastname'] ." "."Check Date : ". date("Y-m-d");
				$sql = "UPDATE leave_record SET leave_status = '$leave_status', leave_comment = '$comment' WHERE id = '$id'";
					if($conn->query($sql)){
						
						
						//search from leave record database
						$sqlsearch = "SELECT * FROM leave_record WHERE id = '$id'";
						$querysearch  = $conn->query($sqlsearch);
						$rowsearch = $querysearch ->fetch_assoc();
						$employee_ids= $rowsearch['employee_id'];//employee Id
						$startdate = $rowsearch['datefrom'];//date start
						$endate = $rowsearch['dateto'];//date end

						//search from employee database
						$ssearch = "SELECT * FROM employees WHERE employee_id = '$employee_ids'";
						$qsearch  = $conn->query($ssearch);
						$rsearch = $qsearch ->fetch_assoc();
						$employee_id= $rsearch['employee_id'];//employee Id
						$main_id= $rsearch['id'];//main Id
						$schedule_id= $rsearch['schedule_id'];//schedule Id

						//search from schedule database
						$ssearchschedules = "SELECT * FROM schedules WHERE id = '$schedule_id'";
						$qsearchschedules  = $conn->query($ssearchschedules);
						$rsearchschedules = $qsearchschedules ->fetch_assoc();

						$lognow= $rsearchschedules['time_in'];//time in
						$timeoutvalue= $rsearchschedules['time_out'];//time out

						// Convert time strings to Unix timestamps
						$time_in_timestamp = strtotime($lognow);
						$time_out_timestamp = strtotime($timeoutvalue);

						// Calculate the time difference in seconds
						$time_difference = $time_out_timestamp - $time_in_timestamp;

						// Convert seconds to hours
						$num_hr = $time_difference / 3600;

						$start_date = strtotime($startdate);
						$end_date = strtotime($endate);
						$logstatus = 3;
						$num_ot = 0;

							// Loop through each date and print it
							for ($current_date = $start_date; $current_date <= $end_date; $current_date = strtotime('+1 day', $current_date)) {
								$date_now = date('Y-m-d', $current_date);
								$esqls = "SELECT * FROM attendance WHERE employee_id = '$main_id' AND date = '$date_now' AND status ='$logstatus'";
								$equerys = $conn->query($esqls);
								//Avoiding double for adding leave
								if($equerys->num_rows > 0){
									$_SESSION['error'] = 'Already added leave';
								}
								else{
									$sqlattendance = "INSERT INTO attendance (employee_id, date, time_in,status, time_out,  num_hr,num_ot) 
									VALUES ('$main_id', '$date_now', '$lognow', '$logstatus','$timeoutvalue','$num_hr','$num_ot')";
	
	
									
									if ($conn->query($sqlattendance)) {

										$timezone = 'Asia/Manila';
										date_default_timezone_set($timezone);

										$auditdate = date('Y-m-d');
										$audittime = date('H:i:s');
										$audituser = $user['firstname'].' '.$user['lastname'];
										//Edit this for Description
										$auditdescription = 'Added new leave for employee id number '.$employee_id.' date '.$date_now;

										$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
										VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
											if ($conn->query($sqlaudit)) {
												//Edit this for Status
												$e_leaves = ($rsearch['e_leave'] -1);
												$sqle_leave = "UPDATE employees SET e_leave = '$e_leaves' WHERE id = '$main_id'";
		
		
												if($conn->query($sqle_leave)){
													$_SESSION['success'] = 'Leave updated successfully';
												}
												else{
													$_SESSION['error'] = $conn->error;
												}
												
											} else {
												$_SESSION['error'] = $conn->error;
											}
										
									} else {
										$_SESSION['error'] = $conn->error;
									}
								}
								
							}
							
						

					}
					else{
						$_SESSION['error'] = $conn->error;
					}
			} elseif ($selectedOption === 'Rejected') {
				// Handle logic for 'Rejected' option
				$leave_status = $_POST['leave_status'];

				$comment = "Rejected by : ".$user['firstname'].' '.$user['lastname']." "."Check Date : ". date("Y-m-d");
				$sql = "UPDATE leave_record SET leave_status = '$leave_status', leave_comment = '$comment' WHERE id = '$id'";
					if($conn->query($sql)){
						
						
						//search from leave record database
						$sqlsearch = "SELECT * FROM leave_record WHERE id = '$id'";
						$querysearch  = $conn->query($sqlsearch);
						$rowsearch = $querysearch ->fetch_assoc();
						$employee_ids= $rowsearch['employee_id'];//employee Id
						$startdate = $rowsearch['datefrom'];//date start
						$endate = $rowsearch['dateto'];//date end

						//search from employee database
						$ssearch = "SELECT * FROM employees WHERE employee_id = '$employee_ids'";
						$qsearch  = $conn->query($ssearch);
						$rsearch = $qsearch ->fetch_assoc();
						$employee_id= $rsearch['employee_id'];//employee Id
						$main_id= $rsearch['id'];//main Id
						$schedule_id= $rsearch['schedule_id'];//schedule Id

						//search from schedule database
						$ssearchschedules = "SELECT * FROM schedules WHERE id = '$schedule_id'";
						$qsearchschedules  = $conn->query($ssearchschedules);
						$rsearchschedules = $qsearchschedules ->fetch_assoc();

						$lognow= $rsearchschedules['time_in'];//time in
						$timeoutvalue= $rsearchschedules['time_out'];//time out

						// Convert time strings to Unix timestamps
						$time_in_timestamp = strtotime($lognow);
						$time_out_timestamp = strtotime($timeoutvalue);

						// Calculate the time difference in seconds
						$time_difference = $time_out_timestamp - $time_in_timestamp;

						// Convert seconds to hours
						$num_hr = $time_difference / 3600;

						$start_date = strtotime($startdate);
						$end_date = strtotime($endate);
						$logstatus = 3;
						$num_ot = 0;

							// Loop through each date and print it
							for ($current_date = $start_date; $current_date <= $end_date; $current_date = strtotime('+1 day', $current_date)) {
								$date_now = date('Y-m-d', $current_date);
								

								$esqls = "SELECT * FROM attendance WHERE employee_id = '$main_id' AND date = '$date_now' AND status ='$logstatus'";
								$equerys = $conn->query($esqls);
								//$erows = $equerys->fetch_assoc();
								while($erows = $equerys->fetch_assoc()){
								$id_attendance = $erows['id'];
									$sql = "DELETE FROM attendance WHERE id = '$id_attendance'";
									if($conn->query($sql)){
										$timezone = 'Asia/Manila';
										date_default_timezone_set($timezone);
										
										$auditdate = date('Y-m-d');
										$audittime = date('H:i:s');
										$audituser = $user['firstname'].' '.$user['lastname'];
										$auditdescription = 'Delete leave for employee id number '.$employee_id.' date '.$date_now;

										$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
										VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
											if ($conn->query($sqlaudit)) {
												$_SESSION['success'] = 'Leave updated successfully';
											} else {
												$_SESSION['error'] = $conn->error;
											}
										
									}
									else{
										$_SESSION['error'] = $conn->error;
									}
								}
								
								
							}
										$timezone = 'Asia/Manila';
										date_default_timezone_set($timezone);
										
										$auditdate = date('Y-m-d');
										$audittime = date('H:i:s');
										$audituser = $user['firstname'].' '.$user['lastname'];
										$auditdescription = 'Rejected leave for employee id number '.$employee_id.' date '.$date_now;

										$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
										VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
											if ($conn->query($sqlaudit)) {
												$_SESSION['success'] = 'Leave updated successfully';
											} else {
												$_SESSION['error'] = $conn->error;
											}
							//$_SESSION['success'] = 'Leave updated successfully';
						

					}
					else{
						$_SESSION['error'] = $conn->error;
					}
			} else {
				// Handle other cases if needed
				echo "Invalid leave status";
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:leave');

?>