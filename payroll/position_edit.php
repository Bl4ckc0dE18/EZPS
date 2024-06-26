<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$rate = $_POST['rate'];
		$ot = $_POST['ot'];
		
		$sg = $_POST['edit_sg_edit'];
		$steps = $_POST['edit_steps_edit'];
		$monthly_salary = $_POST['edit_monthly_salary'];
		$position_code = $title.'_sg'.$sg.'_s'.$steps;
		$sql = "UPDATE position SET description = '$title', rate = '$rate', ot = '$ot', sg = '$sg', step = '$steps', monthly_salary = '$monthly_salary', position_code = '$position_code' WHERE id = '$id'";
		if($conn->query($sql)){
			

			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
			
			$des = 	$title .' | Rate per Hour P'.$rate.' | Rate per Overtime P'.$ot;
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'Position updated '.$des.' date '.$auditdate;

			$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
			VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
			if ($conn->query($sqlaudit)) {
				$_SESSION['success'] = 'Position updated successfully';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:position');

?>