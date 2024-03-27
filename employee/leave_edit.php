<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
        $reason = $_POST['reason'];
		$datefrom = $_POST['datefrom'];
		$dateto = $_POST['dateto'];
		
		
		$sql = "UPDATE leave_record SET reason = '$reason', datefrom = '$datefrom', dateto = '$dateto' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Leave updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:leave.php');

?>