<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		
		$password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
		$sqle = "SELECT * FROM employees WHERE id = '$id'";
		$querye = $conn->query($sqle);
		$rowe = $querye->fetch_assoc();
		$ide = $rowe['employee_id'];
		
		$sql = "UPDATE employees SET password = '$password' WHERE id = '$empid'";
		if($conn->query($sql)){
			
			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
						
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'Employee password updated  '.$ide .' date '.$auditdate;

			$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
			VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
			if ($conn->query($sqlaudit)) {
				$_SESSION['success'] = 'Employee updated successfully';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to edit first';
	}

	header('location: employee.php');
?>