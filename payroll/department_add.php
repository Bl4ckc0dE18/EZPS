<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$code = $_POST['code'];
		
		

		$sql = "INSERT INTO department (name,code) VALUES ('$name','$code')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Department added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: department');

?>