<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		$employee_id = $_POST['employee_id'];

		$sqle = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
		$querye = $conn->query($sqle);
		$rowe = $querye->fetch_assoc();
		$name = $rowe['firstname'].' '.$rowe['lastname'];

		
		$schedule_day = $_POST['schedule_day'];
		$schedule_load = $_POST['schedule_load'];
		

		$sql = "INSERT INTO work_overtime (employee_id,name,schedule_load ,time_load) VALUES ('$employee_id','$name','$schedule_day','$schedule_load')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee Work Load added successfully';

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

	header('location: work_overtime');

?>