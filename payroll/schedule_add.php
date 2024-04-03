<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		$sql = "INSERT INTO schedules (time_in, time_out) VALUES ('$time_in', '$time_out')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Schedule added successfully';

			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
						
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'Schedule added '.$time_in .' and '. $time_out  .' date '.$auditdate;

			$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
			VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
			if ($conn->query($sqlaudit)) {
				$_SESSION['success'] = 'Schedule added successfully';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: schedule');

?>