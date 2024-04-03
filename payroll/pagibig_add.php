<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$from = $_POST['from'];
		$to = $_POST['to'];
        $er = $_POST['er'];
		$ee = $_POST['ee'];
        $total = $_POST['total'];
		

		$sql = "INSERT INTO pagibig (f, t, er, ee, total) VALUES ('$from', '$to', '$er', '$ee', '$total')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'PAG-IBIG added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: pagibig');

?>