<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		$sqle = "SELECT * FROM schedules WHERE id = '$id'";
		$querye = $conn->query($sqle);
		$rowe = $querye->fetch_assoc();
		$time_in = $rowe['time_in'];
		$time_out = $rowe['time_out'];

		$sql = "DELETE FROM schedules WHERE id = '$id'";
		
		if($conn->query($sql)){
			

			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
						
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'Schedule deleted '.$time_in .' and '. $time_out  .' date '.$auditdate;

			$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
			VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
			if ($conn->query($sqlaudit)) {
				$_SESSION['success'] = 'Schedule deleted successfully';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: schedule.php');
	
?>