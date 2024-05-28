<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];
        $amount = $_POST['amount'];
		
		
		$sql = "UPDATE allowance SET description = '$description', amount = '$amount' WHERE id = '$id'";
		
		
		if($conn->query($sql)){
			$_SESSION['success'] = 'Allowance updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:allowance');

?>