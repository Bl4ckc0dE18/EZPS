<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
        $edit_percent = $_POST['edit_percent'];
		
		

		$sql = "UPDATE gsis SET percent = '$edit_percent' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'GSIS updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:gsis');

?>