<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
        $status = $_POST['payment_status'];
		
		$ppaidby = $user['firstname'].' '.$user['lastname'];
		$sql = "UPDATE payslip SET paystatus = '$status' , ppaidby = '$ppaidby' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Payroll updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:payroll');

?>