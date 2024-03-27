<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];
        $amount = $_POST['amount'];
		$bonus_status = $_POST['payment_status'];
		
		$sql = "UPDATE employee_bonus SET description = '$description', amount = '$amount', bonus_status = '$bonus_status' WHERE id = '$id'";
		
		
		if($conn->query($sql)){
			$_SESSION['success'] = 'Bonus updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:bonus.php');

?>