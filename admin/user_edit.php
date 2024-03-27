<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
        $username = $_POST['username'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
        $position = $_POST['position'];
        
		$sql = "SELECT * FROM admin WHERE id = $id";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		if($password == $row['password']){
			$password = $row['password'];
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		$sql = "UPDATE admin SET username ='$username',firstname = '$firstname', lastname = '$lastname',position ='$position'  WHERE id = '$id'";
		if($conn->query($sql)){
			

			// audit trail mapping
			$timezone = 'Asia/Manila';
			date_default_timezone_set($timezone);
						
			$auditdate = date('Y-m-d');
			$audittime = date('H:i:s');
			$audituser = $user['firstname'].' '.$user['lastname'];
			$auditdescription = 'User updated '.$username .' date '.$auditdate;

			$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
			VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
			if ($conn->query($sqlaudit)) {
				$_SESSION['success'] = 'User updated successfully';
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

	header('location: user.php');

?>