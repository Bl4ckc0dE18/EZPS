<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])) {
		$id = $_POST['id'];

		$asql = "SELECT * FROM pre_attendance WHERE id = '$id'";
		$aquery = $conn->query($asql);
		$arow = $aquery->fetch_assoc();
		$pre_comment = $arow['comment'];

		if (isset($_POST['edit_status'])) {
			$selectedOption = $_POST['edit_status'];

			if ($selectedOption === 'Pending') {
				// Handle logic for 'Pending' option
				$status = $_POST['edit_status'];
				$comments = $_POST['edit_comment'];
				$comment = $pre_comment."<br>----------------<br>Reviewd by : ".$user['firstname'].' '.$user['lastname'] ." <br><br><br>".$comments ."<br><br><br>"."Check Date : ". date("Y-m-d");
				$sql = "UPDATE pre_attendance SET status = '$status', comment = '$comment' WHERE id = '$id'";
				if($conn->query($sql)) {
					$_SESSION['success'] = 'Employee complain attendance updated successfully';
				} else {
					$_SESSION['error'] = $conn->error;
				}
			} elseif ($selectedOption === 'Approved') {
				// Handle logic for 'Approved' option
				//$status = 'Pending';
				//$comment ='';

				$status = $_POST['edit_status'];
				$comments = $_POST['edit_comment'];
				$comment = $pre_comment."<br>----------------<br>Approved by : ".$user['firstname'].' '.$user['lastname'] ." <br><br><br>".$comments ."<br><br><br>"."Check Date : ". date("Y-m-d");
				
				$sql = "UPDATE pre_attendance SET status = '$status', comment = '$comment' WHERE id = '$id'";
				if($conn->query($sql)) {
					$pre_employee_id = $arow['employee_id'];
					$pre_date = $arow['date'];
					$pre_time_in = $arow['time_in'];
					$pre_time_out= $arow['time_out'];

					$esql = "SELECT * FROM employees WHERE id = '$pre_employee_id'";
					$equery = $conn->query($esql);
					$erow = $equery->fetch_assoc();
					$e_employee_id = $erow['employee_id'];

					$pre_day = strtoupper(date('D', strtotime($pre_date)));

					$sql_es = "SELECT * FROM employee_schedule WHERE schedule_day = '$pre_day' AND ('$pre_time_in' <= time_in OR '$pre_time_in' >= time_in) AND '$pre_time_in' < time_out AND employee_id = '$e_employee_id'";

					$query_es = $conn->query($sql_es);
					$row_es = $query_es->fetch_assoc();

					if($query_es->num_rows > 0) {
						$early_time_In = $row_es['time_in'];
						
						$time_out_db = $row_es['time_out'];
						$time_check_out_db = date('H:i:s', strtotime($time_out_db));

						$time_in_24 = date('H:i:s', strtotime($row_es['time_in']));
						$early_time_In_24 = date('H:i:s', strtotime($early_time_In));

						$logstatus = ($pre_time_in > $time_in_24) ? 0 : 1;
						$time_check_in = ($pre_time_in > $time_in_24) ? $pre_time_in: $early_time_In;

						$time_check_out = ($pre_time_out <= $time_check_out_db) ? $pre_time_out: $time_check_out_db;

						$sql_out_db = "SELECT MAX(time_out) AS max_time_out FROM employee_schedule WHERE schedule_day = '$pre_day' AND employee_id = '$e_employee_id'";

						$query_out_db = $conn->query($sql_out_db);
						$row_out_db = $query_out_db->fetch_assoc();

						$time_out_db_max = $row_out_db['max_time_out'];
						$time_out_dbs = date('H:i:s', strtotime($time_out_db_max));

						$time_ot = ($pre_time_out < $time_out_dbs) ? 0 : 1;
								
							if($time_ot == 1) {
								// hr
								$time_in = new DateTime($time_check_in);
								$time_out = new DateTime($time_check_out);

								$interval = $time_in->diff($time_out);
								$hrs = $interval->format('%h');
								$mins = $interval->format('%i');
								$mins = $mins/60;
								$int = $hrs + $mins;

								// ot
								$time_in_ot = new DateTime($time_out_dbs);
								$time_out_ot = new DateTime($pre_time_out);

								$interval_ot = $time_in_ot->diff($time_out_ot);
								$hrs_ot = $interval_ot->format('%h');
								$mins_ot = $interval_ot->format('%i');
								$mins_ot = $mins_ot/60;
								$int_ot = $hrs_ot + $mins_ot;

								$sql_wl_db = "SELECT * FROM work_load WHERE schedule_load = '$pre_day' AND employee_id = '$e_employee_id'";
								$query_wl_db = $conn->query($sql_wl_db);
								$row_wl_db = $query_wl_db->fetch_assoc();
								

								if ($query_wl_db->num_rows > 0 ) {
									// Workload exists for the day
									$time_out_load = $row_wl_db['time_load'];
									$time_overloads = ($int_ot <= $time_out_load) ? 0  : $time_out_load;

									$sql_attendance = "INSERT INTO attendance (employee_id, date, time_in,time_out, status,num_hr,num_ot) VALUES ('$pre_employee_id', '$pre_date', '$time_check_in','$time_check_out', '$logstatus','$int','$time_overloads')";

									if ($conn->query($sql_attendance)) {
										$_SESSION['success'] = 'Employee complain attendance updated successfully'.$time_overloads;
									} else {
										$_SESSION['error'] = $conn->error;
									}


								} else {
									// No workload exists for the day
									
									$sql_attendance = "INSERT INTO attendance (employee_id, date, time_in,time_out, status,num_hr) VALUES ('$pre_employee_id', '$pre_date', '$time_check_in','$time_check_out', '$logstatus','$int')";

										if ($conn->query($sql_attendance)) {
											$_SESSION['success'] = 'Employee complain attendance updated successfully';
										} else {
											$_SESSION['error'] = $conn->error;
										}
								}

							
						} else {
							$time_in = new DateTime($time_check_in);
							$time_out = new DateTime($time_check_out);

							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							
							$sql_attendance = "INSERT INTO attendance (employee_id, date, time_in,time_out, status,num_hr) VALUES ('$pre_employee_id', '$pre_date', '$time_check_in','$time_check_out', '$logstatus','$int')";

							if ($conn->query($sql_attendance)) {
								$_SESSION['success'] = 'Employee complain attendance updated successfully';
							} else {
								$_SESSION['error'] = $conn->error;
							}
						}

					} else {

						$status = 'Rejected';
						$comments = 'No Schedule';
						$comment = $pre_comment."<br>----------------<br>Rejected by : ".$user['firstname'].' '.$user['lastname'] ." <br><br><br>".$comments ."<br><br><br>"."Check Date : ". date("Y-m-d");
						$sqlns = "UPDATE pre_attendance SET status = '$status', comment = '$comment' WHERE id = '$id'";
						$_SESSION['error'] = 'No Schedule';
						if($conn->query($sqlns)) {

						}else{
							$_SESSION['error'] = $conn->error;
						}
					}
				} else {
					$_SESSION['error'] = $conn->error;
				}
			} elseif ($selectedOption === 'Rejected') {
				// Handle logic for 'Rejected' option
				$status = $_POST['edit_status'];

				$comment = $pre_comment."<br>----------------<br>Rejected by : ".$user['firstname'].' '.$user['lastname']." "."Check Date : ". date("Y-m-d");
				$sql = "UPDATE pre_attendance SET status = '$status', comment = '$comment' WHERE id = '$id'";
				if($conn->query($sql)) {
					// Do something if needed
				} else {
					$_SESSION['error'] = $conn->error;
				}
			} else {
				// Handle other cases if needed
				echo "Invalid leave status";
			}
		}
	} else {
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:attendance_overwrite');
?>
