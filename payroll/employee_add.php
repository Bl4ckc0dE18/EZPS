<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		//$employee_id = $_POST['employee_id'];
		$employee_rfid = $_POST['employee_rfid'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$position = $_POST['position'];
		$schedule = $_POST['schedule'];
		$day_off = $_POST['dayoff'];
		$e_leave = $_POST['eleave'];
		$created_by = $user['firstname'].' '.$user['lastname'];
		$filename = $_FILES['photo']['name'];
		$date_contract_start = $_POST['datepicker_employee_sadd'];
		$date_contract_end = $_POST['datepicker_employee_add'];
		
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//creating employeeid
		$set = '1234567890';
		
		
		$employee_id = 0;
		$sql = "INSERT INTO employees (employee_id, employee_rfid,firstname, lastname, address, birthdate, contact_info, gender,email ,password,position_id, schedule_id,day_off, e_leave,created_by,photo, created_on,end_contract) 
		VALUES ('$employee_id','$employee_rfid', '$firstname', '$lastname', '$address', '$birthdate', '$contact', '$gender','$email','$password', '$position', '$schedule', '$day_off','$e_leave','$created_by','$filename', '$date_contract_start','$date_contract_end')";
		if($conn->query($sql)){
			$sqle = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
			$querye = $conn->query($sqle);
			$rowe = $querye->fetch_assoc();
			$ide = $rowe['id'];
			$employee_ide = ((date('Y')).$ide );

			$sqlu = "UPDATE employees SET employee_id = '$employee_ide' WHERE id = '$ide '";
			if($conn->query($sqlu)){
				
					// audit trail mapping
							$timezone = 'Asia/Manila';
							date_default_timezone_set($timezone);
							
										
							$auditdate = date('Y-m-d');
							$audittime = date('H:i:s');
							$audituser = $user['firstname'].' '.$user['lastname'];
							$auditdescription = 'Added new Employee '.$employee_ide.' date '.$auditdate;

							$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
							VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
							if ($conn->query($sqlaudit)) {
								$_SESSION['success'] = 'Employee added successfully';
							} else {
								$_SESSION['error'] = $conn->error;
							}
			}
			else{
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

	header('location: employee');
?>