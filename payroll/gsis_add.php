<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$percent = $_POST['percent'];
		
		

		$sql = "INSERT INTO gsis (percent) VALUES ('$percent')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'GSIS added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: gsis');

?>