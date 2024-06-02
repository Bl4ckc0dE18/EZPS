<?php
	include 'includes/session.php';
	$timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	// Include PHPMailer autoload file
	require './PHPMailer/src/Exception.php';
	require './PHPMailer/src/PHPMailer.php';
	require './PHPMailer/src/SMTP.php';


	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	$generateby = $user['firstname'].' '.$user['lastname'];
	$sql = "SELECT *, 
			SUM(num_hr) AS total_hr,
			SUM(num_ot) AS total_ot,
			attendance.employee_id AS empid,
			employees.employee_id AS employee
			FROM 
			attendance 
			LEFT JOIN
			employees ON employees.id=attendance.employee_id 
			LEFT JOIN 
			position ON position.id=employees.position_id 
			WHERE num_wl = 0 AND date BETWEEN '$from' AND '$to' 
			GROUP BY attendance.employee_id
			ORDER BY employees.lastname ASC, employees.firstname ASC";

	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
		$set = '1234567890';
		$invocie_id = ((date('Y')).substr(str_shuffle($set), 0, 15));
		$name = $row['firstname']." ".$row['lastname'];
		$empid = $row['empid'];
		$email = $row['email'];
		$grossn = $row['rate'] * $row['total_hr'];
		$grossot = $row['ot'] * $row['total_ot'];
		$basic_salary = $row['monthly_salary'] * 12;

		$sqlallowance = "SELECT SUM(amount) AS total_amount FROM allowance";
		$allowancequery = $conn->query($sqlallowance);
		$allowancerow = $allowancequery->fetch_assoc();
		$allowance = $allowancerow['total_amount'];

		$gross = $grossn + $grossot + $allowance;

		$rate = $row['rate'];
		$totalhr = $row['total_hr'];
		$otrate = $row['ot'];
		$othrtotal = $row['total_ot'];

		$ssql = "SELECT * FROM w_tax WHERE t >= $basic_salary AND f <= $basic_salary";
		$squery = $conn->query($ssql);
		$employeeid = $row['employee'];

		while ($srow = $squery->fetch_assoc()) {
			$a = $srow['a'];
			$b = $srow['b'];
			$c = $srow['c'];
			$bp = $b/100;
			$totalvalues = $a + ($bp * $c);
			$totalvaluess = $totalvalues / 12;
			$w_tax_total = $totalvaluess;

			$sqlgsis = "SELECT SUM(percent) AS percent_total FROM gsis";
			$gsisequery = $conn->query($sqlgsis);
			$gsisrow = $gsisequery->fetch_assoc();
			$percent_total = $gsisrow['percent_total'];
			$gsis_total_deduction = (($percent_total / 100) * $grossn);
			$gsis_total = $gsis_total_deduction;

			$psql = "SELECT * FROM pagibig WHERE t >= $grossn AND f <= $grossn";
			$pquery = $conn->query($psql);

			while ($prow = $pquery->fetch_assoc()) {
				$erp = (($prow['er'] / 100) * $grossn);
				$eep = (($prow['ee'] / 100) * $grossn);
				$valuep = (($prow['total'] / 100) * $grossn);

				$phsql = "SELECT * FROM philhealth WHERE t >= $grossn AND f <= $grossn";
				$phquery = $conn->query($phsql);

				while ($phrow = $phquery->fetch_assoc()) {
					$erph = (($phrow['er'] / 100) * $grossn);
					$eeph = (($phrow['ee'] / 100) * $grossn);
					$valueph = (($phrow['total'] / 100) * $gross);

					$loansql = "SELECT * FROM loan WHERE employee_id = $employeeid AND loanbalance > 0";
					$loanquery = $conn->query($loansql);

					$descriptionloan = '';
					$descriptionloanamount = '';
					$totalloan = 0;

					while ($loanrow = $loanquery->fetch_assoc()) {
						$idloan = $loanrow['id'];
						$semiloan = $loanrow['semiloan'] - 2;
						$loanbalance = $loanrow['loanbalance'] - $loanrow['permonths'];
						$loanpay = $loanrow['loanpay'];
						$updateloanpay = $loanpay + $loanrow['permonths'];

						$sqlloan = "UPDATE loan SET semiloan = '$semiloan' , loanbalance = '$loanbalance', loanpay = '$updateloanpay' WHERE id = '$idloan'";
						if($conn->query($sqlloan)){
							$_SESSION['success'] = 'Payroll Generate added successfully';
						} else {
							$_SESSION['error'] = $conn->error;
						}
						
						$descriptionloan .= ' <br>'.$loanrow['description'];
						$descriptionloanamount .= ' <br>'.number_format($loanrow['permonths'], 2);
						$totalloan_per_loan = number_format($loanrow['permonths'], 2);
						$totalloan += $totalloan_per_loan; 
						
						$loan_description = $loanrow['description'];
						$loan_semimonths = number_format($loanrow['permonths'], 2);
						
						$sql = "INSERT INTO loan_transaction (loan_id, description, loan_amount) VALUES ('$invocie_id', '$loan_description', '$loan_semimonths')";
						$conn->query($sql);
					}

					$deduction = $gsis_total + $w_tax_total + $eep + $eeph;
					$loan_description = $descriptionloan;
					$loan_amount = $descriptionloanamount;
					$total_deduction = $deduction + $totalloan;
					$net = $gross - $total_deduction;
					$paystatus = "Pending";
					$totaleeer =  $valuep + $valueph;

					$paysql = "INSERT INTO payslip (invoice_id, employee_name, employee_id, rate, totalhours, otrate, othrtotal, gsis_total, w_tax_total, erp, eep, totalp, erph, eeph, totalph, loan_description, loan_amount, totalbenifitsdeduction, totaleeer, deduction_status, totaldeduction, gross, allowance, netpay, paystatus, generateby, datefrom, dateto)
					VALUES ('$invocie_id', '$name', '$employeeid', '$rate', '$totalhr', '$otrate', '$othrtotal', '$gsis_total', '$w_tax_total',  '$erp', '$eep', '$valuep', '$erph', '$eeph', '$valueph', '$loan_description', '$loan_amount', '$deduction', '$totaleeer', '$paystatus', '$total_deduction', '$gross', '$allowance', '$net', '$paystatus', '$generateby', '$from', '$to')";

					if($conn->query($paysql)){
                        $num_wl = 1;
						$sqlf = "UPDATE attendance SET num_wl = '$num_wl' WHERE employee_id = $empid AND date BETWEEN '$from' AND '$to' ";
                        if($conn->query($sqlf)){

							$subject = 'PAYROLL GENERATED';
							$message = '<p style="color: black;">Dear ' . $name . ',</p><br><br><br>
							<p style="color: black;">Your salary for the period from ' . date('M d, Y', strtotime($from)) . ' to ' . date('M d, Y', strtotime($to)) . ' has been successfully processed and deposited into your account.</p><br>
							<p style="color: black;">If you have any questions or concerns regarding your salary deposit, please don\'t hesitate to reach out to us.</p><br>
							<p style="color: black;">You can view your account details <a href="https://ezpayrollsystem.online/employee">here</a>.</p><br>
							<p style="color: black;">For further assistance, please visit our website or contact our support team.</p><br>
							<p style="color: black;">Thank you for your hard work and dedication.</p><br>
							<p style="color: black;">Best regards,<br>Team EZ PAYROLL SYSTEM</p><br>';
							
                
                            
                
                                
                                // Initialize PHPMailer
                                $mail = new PHPMailer(true);
                                
                                // SMTP configuration
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                                $mail->SMTPAuth = true;
                                $mail->Username = 'ezpayrollsystem.tech@gmail.com'; // Your SMTP username
                                $mail->Password = 'vgvgxnvbyknfqpxx'; // Your SMTP password
                                $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
                                $mail->Port = 465; // TCP port to connect to
                
                                // Set sender and recipient
                                $mail->setFrom('ezpayrollsystem.tech@gmail.com');
                                $mail->addAddress($email);
                
                                // Content
                                $mail->isHTML(true);
                                $mail->Subject = $subject;
                                $mail->Body = $message;
                
                                // Send email
                                if($mail->send()){                               
									$_SESSION['success'] = 'Payroll Generate added successfully';
                                }else{
									
									$_SESSION['error']  = 'Please try again later.';
                                }
                           
                        }
                        else{
                            $_SESSION['error'] = $conn->error;
                        }
						
					} else {
						$_SESSION['error'] = $conn->error;
					}
				}
			}
		}
	}

	header('location: payroll?range='.$range);
?>
