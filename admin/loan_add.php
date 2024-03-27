<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee_id = $_POST['employee_id'];
		$description = $_POST['description'];
        $loanamount = $_POST['loanamount'];
		$monthstopay = $_POST['monthstopay'];

        $sqle = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
		$querye = $conn->query($sqle);
		$rowe = $querye->fetch_assoc();
		$ide = $rowe['firstname'].' '.$rowe['lastname'];

        $semiloan = ($monthstopay*2);
		$loanpay = 0;
		$loanbalance =  $loanamount;
        $permonths = $loanamount / $monthstopay;
        $semimonths = $loanamount / $semiloan;
		$sql = "INSERT INTO loan (employee_id, employee_name, description, loanamount, monthstopay,permonths,semiloan,semimonths,loanpay,loanbalance) 
                            VALUES ('$employee_id','$ide', '$description', '$loanamount', '$monthstopay', '$permonths', '$semiloan', '$semimonths', '$loanpay', '$loanbalance')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Loan added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: loan.php');

?>