<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		$sqle = "SELECT * FROM employees WHERE id = '$id'";
		$querye = $conn->query($sqle);
		$rowe = $querye->fetch_assoc();
		$ide = $rowe['employee_id'];

		$sql = "DELETE FROM employees WHERE id = '$id'";
		
		if($conn->query($sql)){
			
			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
						
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'Employee deleted '.$ide .' date '.$auditdate;

			$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
			VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
			if ($conn->query($sqlaudit)) {
				$_SESSION['success'] = 'Employee deleted successfully';
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

	header('location: employee.php');
	
?>