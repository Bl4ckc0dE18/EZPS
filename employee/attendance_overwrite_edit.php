<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['edit_date'];
		$time_in = $_POST['edit_time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['edit_time_out'];
		$time_out = date('H:i:s', strtotime($time_out));
		$asql = "SELECT * FROM pre_attendance WHERE id = '$id'";
		$aquery = $conn->query($asql);
		$arow = $aquery->fetch_assoc();
		$pre_comment = $arow['comment'];
		$comment = $pre_comment."<br>----------------<br>Reviewd by : ".$user['firstname'].' '.$user['lastname'] ." <br><br><br>Employee check<br><br><br>"."Check Date : ". date("Y-m-d");
			
		// Check if the 'photo' file input is empty
			if(empty($filename = $_FILES['photo']['name'])) {
				
				$sql = "UPDATE pre_attendance SET date = '$date', time_in = '$time_in', time_out = '$time_out', comment = '$comment' WHERE id = '$id'";
				if($conn->query($sql)){
					$_SESSION['success'] = 'Employee attendance updated successfully';
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
				
			} else {
				
				$_SESSION['error'] = 'sadsad';
				
			}


	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:attendance_overwrite');

?>