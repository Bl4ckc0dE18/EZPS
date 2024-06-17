<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name_edit'];
        $code = $_POST['code_edit'];
		
		

		$sql = "UPDATE department SET name = '$name' ,code = '$code' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Department updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:department');

?>