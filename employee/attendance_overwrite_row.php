<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, 
		pre_attendance.id as attid 
		FROM pre_attendance 
		LEFT JOIN 
			employees ON employees.id=pre_attendance.employee_id 
		WHERE pre_attendance.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>