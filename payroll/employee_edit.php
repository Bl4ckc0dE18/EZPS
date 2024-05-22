<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$employee_id = $_POST['employee_id'];
		$employee_rfid = $_POST['employee_rfid'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$edit_hour = $_POST['edit_hour'];
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
		//$password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
		$position = $_POST['position'];
		$regular = $_POST['edit_regular'];
		$day_off = $_POST['dayoff_edit'];
		$e_leave = $_POST['eleave'];
		$date_contract_start = $_POST['datepicker_employee_sedit'];
		$date_contract_end = $_POST['datepicker_employee_edit'];
		
		$sql = "UPDATE employees SET employee_id = '$employee_id',employee_rfid = '$employee_rfid', firstname = '$firstname', lastname = '$lastname',required_hour = '$edit_hour', address = '$address', birthdate = '$birthdate', contact_info = '$contact', gender = '$gender', email = '$email', position_id = '$position', regular = '$regular', day_off = '$day_off', e_leave = '$e_leave', created_on = '$date_contract_start', end_contract = '$date_contract_end' WHERE id = '$empid'";
		if($conn->query($sql)){
			

			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
						
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'Employee updated '.$employee_id .' date '.$auditdate;

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

	header('location: employee');
?>