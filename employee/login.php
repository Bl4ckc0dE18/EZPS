<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM employees WHERE employee_id = '$username'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot find account with the employee id';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['employees'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input employee credentials first';
	}

	header('location: index');

?>