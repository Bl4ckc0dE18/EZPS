<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];

		$asql = "SELECT * FROM pre_attendance WHERE id = '$id' ";
        $aquery = $conn->query($asql);
        $arow = $aquery->fetch_assoc();
		$pre_comment = $arow['comment'];
		if (isset($_POST['edit_status'])) {
			$selectedOption = $_POST['edit_status'];
		
			if ($selectedOption === 'Pending') {
				// Handle logic for 'Pending' option
				
				$status = $_POST['edit_status'];

				
				$comments = $_POST['edit_comment'];
				$comment = $pre_comment."<br><br><br>----------------<br><br><br> Reviewd by : ".$user['firstname'].' '.$user['lastname'] ." <br><br><br>".$comments ."<br><br><br>"."Check Date : ". date("Y-m-d");
				$sql = "UPDATE pre_attendance SET status = '$status', comment = '$comment' WHERE id = '$id'";
					if($conn->query($sql)){
						
						$_SESSION['success'] = 'Employee complain attendance updated successfully';
					}
					else{
						$_SESSION['error'] = $conn->error;
					}

			} elseif ($selectedOption === 'Approved') {
				// Handle logic for 'Approved' option
				$status = $_POST['edit_status'];
				$comments = $_POST['edit_comment'];
				$comment = $pre_comment."<br><br><br>----------------<br><br><br> Approved by : ".$user['firstname'].' '.$user['lastname'] ." <br><br><br>".$comments ."<br><br><br>"."Check Date : ". date("Y-m-d");
				$sql = "UPDATE pre_attendance SET status = '$status', comment = '$comment' WHERE id = '$id'";
					if($conn->query($sql)){
						
						$_SESSION['success'] = 'Employee complain attendance updated successfully';
						

					}
					else{
						$_SESSION['error'] = $conn->error;
					}
			} elseif ($selectedOption === 'Rejected') {
				// Handle logic for 'Rejected' option
				$status = $_POST['edit_status'];

				$comment = $pre_comment."<br><br><br>----------------<br><br><br> Rejected by : ".$user['firstname'].' '.$user['lastname']." "."Check Date : ". date("Y-m-d");
				$sql = "UPDATE pre_attendance SET status = '$status', comment = '$comment' WHERE id = '$id'";
					if($conn->query($sql)){
						
						
					
					}
					else{
						$_SESSION['error'] = $conn->error;
					}
			} else {
				// Handle other cases if needed
				echo "Invalid leave status";
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:attendance_overwrite');

?>