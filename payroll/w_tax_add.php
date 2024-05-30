<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$from = $_POST['from'];
		$to = $_POST['to'];
        $a = $_POST['a'];
		$b = $_POST['b'];
        $c = $_POST['c'];
		

		$sql = "INSERT INTO w_tax (f, t, a, b, c) VALUES ('$from', '$to', '$a', '$b', '$c')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Withholding Tax added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: w_tax');

?>