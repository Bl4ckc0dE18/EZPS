<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
        $from = $_POST['from'];
		$to = $_POST['to'];
        $a = $_POST['a'];
		$b = $_POST['b'];
        $c = $_POST['c'];
		
		

		$sql = "UPDATE w_tax SET f = '$from', t = '$to', a = '$a', b = '$b', c = '$c' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Withholding Tax updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:w_tax');

?>