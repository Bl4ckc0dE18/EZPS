<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
        $status = $_POST['payment_status'];
		
		$dpaidby = $user['firstname'].' '.$user['lastname'];
		$sql = "UPDATE payslip SET deduction_status = '$status' , dpaidby = '$dpaidby' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Record updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:benefits.php');

?>