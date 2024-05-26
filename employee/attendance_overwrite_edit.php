<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['edit_date'];
		$time_in = $_POST['edit_time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['edit_time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

			// Check if the 'photo' file input is empty
			if(empty($filename = $_FILES['photo']['name'])) {
				
				$_SESSION['error'] = 'enmpt';
				
			} else {
				
				$_SESSION['error'] = 'sadsad';
				
			}


	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:attendance_overwrite');

?>