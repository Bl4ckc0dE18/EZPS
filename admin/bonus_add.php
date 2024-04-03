<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		
		$applied_on=date("Y-m-d");
        //creating employeeid
		$set = '1234567890';

		$invocie_id = ((date('Y')).substr(str_shuffle($set), 0, 15));

        $employee = $_POST['employee'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
		$bonus_status = "Pending";
        $total = $_POST['total'];
        
        
		$sql = "SELECT * FROM employees WHERE employee_id like '$employee'";
        $query = $conn->query($sql);
	    while($row = $query->fetch_assoc()){
            $name = $row['firstname'].' '.$row['lastname'];

            $sql = "INSERT INTO employee_bonus (applied_on, invoice_id, employee_id, employee_name, description,amount,bonus_status)
            VALUES ('$applied_on', '$invocie_id', '$employee', '$name', '$description', '$amount', '$bonus_status')";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Bonus added successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: bonus');

?>