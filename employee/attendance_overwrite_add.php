<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
	  $employee_id = $user['id'];
		$filename = $_FILES['photo']['name'];
		$date = $_POST['date'];
    $time_in = $_POST['time_in'];
    $time_out = $_POST['time_out'];


    $time_in = date('H:i:s', strtotime($time_in));
    $time_out = date('H:i:s', strtotime($time_out));
    $status = 'Pending';
    $comment = 'For Review';
    

		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../evidence/'.$filename);	
		}

		
		$sql = "INSERT INTO pre_attendance (employee_id, date,time_in, time_out,status, comment, evidence) 
		VALUES ('$employee_id','$date', '$time_in', '$time_out','$status', '$comment', '$filename')";
		if($conn->query($sql)){
			
				
					// audit trail mapping
							$timezone = 'Asia/Manila';
							date_default_timezone_set($timezone);
							
										
							$auditdate = date('Y-m-d');
							$audittime = date('H:i:s');
							$audituser = $user['firstname'].' '.$user['lastname'];
							$auditdescription = 'Added new attendance employee '.$employee_ide.' date '.$auditdate;

							$sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
							VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
							if ($conn->query($sqlaudit)) {
								$_SESSION['success'] = 'Employee attendance added successfully';
							} else {
								$_SESSION['error'] = $conn->error;
							}
			}
			else{
				$_SESSION['error'] = $conn->error;
			}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: attendance_overwrite');
?>