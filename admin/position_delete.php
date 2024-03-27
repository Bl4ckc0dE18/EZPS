<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sqle = "SELECT * FROM position WHERE id = '$id'";
		$querye = $conn->query($sqle);
		$rowe = $querye->fetch_assoc();

		$title = $rowe['description'];
		$rate= $rowe['rate'];
		$ot	= $rowe['ot'];

		$sql = "DELETE FROM position WHERE id = '$id'";
		if($conn->query($sql)){
			
			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
			
			$des = 	$title .' | Rate per Hour P'.$rate.' | Rate per Overtime P'.$ot;
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'Position deleted '.$des.' date '.$auditdate;

			$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
			VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
			if ($conn->query($sqlaudit)) {
				$_SESSION['success'] = 'Position deleted successfully';
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

	header('location: position.php');
	
?>