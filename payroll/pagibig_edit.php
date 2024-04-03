<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
        $from = $_POST['from'];
		$to = $_POST['to'];
        $er = $_POST['er'];
		$ee = $_POST['ee'];
        $total = $_POST['total'];
		

		$sql = "UPDATE pagibig SET f = '$from', t = '$to', er = '$er', ee = '$ee', total = '$total' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'PAG-IBIG updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:pagibig');

?>