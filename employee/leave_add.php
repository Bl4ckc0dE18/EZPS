<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
        $look = $user['position_id'];


        $sql = "SELECT * FROM position WHERE id like '$look'";
        $query = $conn->query($sql);
	    while($row = $query->fetch_assoc()){

            $department = $row['description'];

                    
		
        $name = $user['firstname'].' '.$user['lastname'];
        $employee_id = $user['employee_id'];
        $reason = $_POST['reason'];
		$datefrom = $_POST['datefrom'];
        $dateto = $_POST['dateto'];
		$leave_status = "Pending";
       
        
        $leave_comment = "For Review";
        $applied_on = date("Y-m-d");

		$sql = "INSERT INTO leave_record (employee_name, employee_id,department, reason, datefrom, dateto,leave_status,leave_comment,applied_on) 
        VALUES ('$name', '$employee_id', '$department', '$reason', '$datefrom', '$dateto', '$leave_status', '$leave_comment', '$applied_on')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Leave added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
        }
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}


	header('location: leave');

?>