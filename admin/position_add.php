<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		$rate = $_POST['rate'];
		$ot = $_POST['ot'];

		$sql = "INSERT INTO position (description, rate, ot) VALUES ('$title', '$rate', '$ot')";
		if($conn->query($sql)){
			
			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
			
			$des = 	$title .' | Rate per Hour P'.$rate.' | Rate per Overtime P'.$ot;
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'Added new Position '.$des.' date '.$auditdate;

			$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
			VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
			if ($conn->query($sqlaudit)) {
				$_SESSION['success'] = 'Position added successfully';
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

	header('location: position.php');

?>