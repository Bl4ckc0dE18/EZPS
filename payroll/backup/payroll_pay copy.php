<?php
	include 'includes/session.php';
	
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
WHERE num_wl = 1 date BETWEEN '$from' AND '$to' 
GROUP BY attendance.employee_id ";
//ORDER BY employees.lastname ASC, employees.firstname ASC";

	/*$sql = "SELECT *, 
               
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
        WHERE date BETWEEN '$from' AND '$to' 
          
        GROUP BY attendance.employee_id 
        ORDER BY employees.lastname ASC, employees.firstname ASC";
        /*$sql = "SELECT *, 
        SUM(CASE WHEN status IN (0, 1) THEN num_hr END) AS total_main_hr,
        SUM(CASE WHEN status = 3 THEN num_hr END) AS total_leave_hr,
        SUM(num_ot) AS total_ot,
        attendance.employee_id AS empid,
        employees.employee_id AS employee
        FROM 
        attendance 
        LEFT JOIN
        employees ON employees.id=attendance.employee_id 
        LEFT JOIN 
        position ON position.id=employees.position_id 
        WHERE date BETWEEN '$from' AND '$to' 
        AND num_wl = 0
        GROUP BY attendance.employee_id 
        ORDER BY employees.lastname ASC, employees.firstname ASC";*/

   
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
		//creating employeeid
		$set = '1234567890';

		$invocie_id = ((date('Y')).substr(str_shuffle($set), 0, 15));

        $name = $row['firstname']." ".$row['lastname'];

		$empid = $row['empid'];
                      
      	$casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
      
      	$caquery = $conn->query($casql);
      	$carow = $caquery->fetch_assoc();
      	$cashadvance = $carow['cashamount'];
        
        //total hour * rate
        $grossn = $row['rate'] * $row['total_hr'];
       // $grossl = $row['rate'] * $row['total_leave_hr'];
        $grossot = $row['ot'] * $row['total_ot'];
        // Basic Salary
        $basic_salary = $row['monthly_salary']*12;
        //allowance

        $sqlallowance = "SELECT SUM(amount) AS total_amount FROM allowance";
        $allowancequery = $conn->query($sqlallowance);
        $allowancerow = $allowancequery->fetch_assoc();
        $allowance = $allowancerow['total_amount'];
        
		$gross = $grossn + $grossot +$grossl + $allowance;
        
        $rate = $row['rate'];
        $totalhr = $row['total_hr'];
        $otrate = $row['ot'] ;
        $othrtotal = $row['total_ot'];


        $ssql = "SELECT * FROM w_tax WHERE t >= $basic_salary AND f <= $basic_salary";
        $squery = $conn->query($ssql);
        $employeeid = $row['employee'];
        while ($srow = $squery->fetch_assoc()) {
            // Check if the value is within the desired range
                // The value is within the range
                $a = $srow['a'];
                $b = $srow['b'];
                $c = $srow['c'];
                $bp = $b/100;
                //total
                $totalvalues = $a+($bp*$c);
                $totalvaluess = $totalvalues / 12;
                $w_tax_total = $totalvaluess;

                $sqlgsis = "SELECT SUM(percent) AS percent_total FROM gsis";
                $gsisequery = $conn->query($sqlgsis);
                $gsisrow = $gsisequery->fetch_assoc();
                $percent_total = $gsisrow['percent_total'];
                $gsis_total_deduction = (($percent_total / 100)* $grossn);
                $gsis_total = $gsis_total_deduction;

                $psql = "SELECT * FROM pagibig WHERE t >= $grossn AND f <= $grossn";
                $pquery = $conn->query($psql);
                
                while ($prow = $pquery->fetch_assoc()) {
                    // Check if the value is within the desired range
                        // The value is within the range
                        $erp = (($prow['er'] / 100) * $grossn);
                        $eep = (($prow['ee'] / 100) * $grossn);
                        $valuep = (($prow['total'] / 100) * $grossn);

                        $phsql = "SELECT * FROM philhealth WHERE t >= $grossn AND f <= $grossn";
                        $phquery = $conn->query($phsql);
                        
                        while ($phrow = $phquery->fetch_assoc()) {
                            // Check if the value is within the desired range
                                // The value is within the range
                                $erph = (($phrow['er'] / 100) * $grossn);
                                $eeph = (($phrow['ee'] / 100) * $grossn);
                                $valueph = (($phrow['total'] / 100) * $gross);


                                            /*Loan*/
                                            $loansql = "SELECT * FROM loan WHERE employee_id = $employeeid AND loanbalance > 0";
                                            $loanquery = $conn->query($loansql);

                                            $descriptionloan = '';  // Initialize variables to store descriptions
                                            $descriptionloanamount = '';  // and amounts
                                            $totalloan = 0;  // Initialize variable to store total loan amount
                                            
                                            while ($loanrow = $loanquery->fetch_assoc()) {
                                        // Check if the value is within the desired range
                                        // The value is within the range   
                                            $idloan=$loanrow['id']; 
                                            $semiloan=$loanrow['semiloan'] - 2; 
                                            $loanbalance=$loanrow['loanbalance'] - $loanrow['permonths']; 
                                            $loanpay=$loanrow['loanpay'];
                                            $updateloanpay=$loanpay+$loanrow['permonths'];

                                            $sqlloan = "UPDATE loan SET semiloan = '$semiloan' , loanbalance = '$loanbalance', loanpay = '$updateloanpay' WHERE id = '$idloan'";
                                            if($conn->query($sqlloan)){
                                                $_SESSION['success'] = 'Payroll Generate added successfully';
                                            }
                                            else{
                                                $_SESSION['error'] = $conn->error;
                                            }   
                                            $descriptionloan .= ' <br>'.$loanrow['description'];
                                            $descriptionloanamount .= ' <br>'.number_format($loanrow['permonths'], 2);
                                                $totalloan_per_loan = number_format($loanrow['permonths'], 2);
                                                $totalloan += $totalloan_per_loan; 
                                            // insert in loan_transanction
                                            $loan_description = $loanrow['description'];
                                            $loan_semimonths = number_format($loanrow['permonths'], 2);
                                            
                                            $sql = "INSERT INTO loan_transaction (loan_id, description, loan_amount) VALUES ('$invocie_id', '$loan_description', '$loan_semimonths')";
                                            $conn->query($sql);

                                


                                }

                                //Benefits
								$deduction = $gsis_total+$w_tax_total + $eep + $eeph;
                                $loan_description = $descriptionloan;
                                $loan_amount= $descriptionloanamount;
								$total_deduction = $deduction + $totalloan;
								$net = $gross - $total_deduction;
                                $paystatus = "Pending";
                                $totaleeer = $values+$valuep+$valueph;

								
                       
                            //PUT IN INVOINCE AND RECORD FOR BENIFITS
							
                            $paysql = "INSERT INTO payslip (invoice_id, employee_name, employee_id,rate, totalhours,otrate, othrtotal,gsis_total,w_tax_total, ers, ees, totals, erp, eep, totalp, erph, eeph, totalph,loan_description,loan_amount, totalbenifitsdeduction,totaleeer,deduction_status, cashadvance, totaldeduction, gross,allowance, netpay, paystatus,generateby,datefrom,dateto)
                            VALUES ('$invocie_id', '$name', '$employeeid','$rate', '$totalhr', '$otrate', '$othrtotal','$gsis_total','$w_tax_total', '$ers', '$ees', '$values','$erp','$eep', '$valuep', '$erph', '$eeph',  '$valueph', '$loan_description', '$loan_amount', '$deduction','$totaleeer','$paystatus', '$cashadvance', '$total_deduction', '$gross','$allowance', '$net', '$paystatus','$generateby','$from','$to')";
                            if($conn->query($paysql)){

                                $sqlf = "SELECT * FROM attendance WHERE date BETWEEN '$from' AND '$to'";
                                $queryf = $conn->query($sqlf);
                                while($rowf = $query->fetch_assoc()){
                                    //id from attendance
                                    $ida = $rowf['id'];
                                    $num_wl = 1;

                                    
                                }
                                $rowf = $query->fetch_assoc();
                                $_SESSION['success'] = 'Payroll Generate added successfully';
                            }
                            else{
                                $_SESSION['error'] = $conn->error;
                            }
    
                		}
                        
               
            }
        }
    }



		
	
    header('location: payroll?range='.$range);


?>

<!-- $sqlattendance = "UPDATE attendance SET num_wl = '$num_wl' WHERE id = '$ida'";
                                    if($conn->query($sqlattendance)){
                                        $_SESSION['success'] = 'Payroll Generate added successfully';
                                    }
                                    else{
                                        $_SESSION['error'] = $conn->error;
                                    } -->