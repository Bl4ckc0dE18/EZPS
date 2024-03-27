<?php
	include 'includes/session.php';
	$member = date("Y-m-d");
	if(isset($_POST['add'])){
		
		$username = $_POST['username'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		
		$filename = $_FILES['photo']['name'];
		$position = $_POST['position']; 	
		//$position = "User"; 	
		
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "INSERT INTO admin (username, password, firstname, lastname, photo, position, created_on) VALUES ('$username', '$password', '$firstname', '$lastname', '$filename',  '$position','$member')";
		if($conn->query($sql)){
			

			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
			
						
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'Added new User '.$username.' date '.$auditdate;

			$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
			VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
			if ($conn->query($sqlaudit)) {
				$_SESSION['success'] = 'User added successfully';
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

	header('location: user.php');
?>