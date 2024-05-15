<?php
	include 'includes/session.php';
	
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));



    $generateby = $user['firstname'].' '.$user['lastname'];

	$sql = "SELECT *, SUM(num_hr) AS total_hr, SUM(num_ot) AS total_ot, 
    attendance.employee_id AS empid, employees.employee_id AS employee 
    FROM 
        attendance 
    LEFT JOIN
        employees ON employees.id=attendance.employee_id 
    LEFT JOIN 
        position ON position.id=employees.position_id 
    WHERE date BETWEEN '$from' AND '$to' GROUP BY
        attendance.employee_id ORDER BY 
        employees.lastname ASC, employees.firstname ASC";
   
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

        $grossot = $row['ot'] * $row['total_ot'];
		$gross = $grossn + $grossot;
        
        $rate = $row['rate'];
        $totalhr = $row['total_hr'];
        $otrate = $row['ot'] ;
        $othrtotal = $row['total_ot'];


        $ssql = "SELECT * FROM sss WHERE t >= $gross AND f <= $gross";
        $squery = $conn->query($ssql);
        $employeeid = $row['employee'];
        while ($srow = $squery->fetch_assoc()) {
            // Check if the value is within the desired range
                // The value is within the range
                $ers = $srow['er'];
                $ees = $srow['ee'];
                $values = $srow['total'];

                $psql = "SELECT * FROM pagibig WHERE t >= $gross AND f <= $gross";
                $pquery = $conn->query($psql);
                
                while ($prow = $pquery->fetch_assoc()) {
                    // Check if the value is within the desired range
                        // The value is within the range
                        $erp = (($prow['er'] / 100) * $gross);
                        $eep = (($prow['ee'] / 100) * $gross);
                        $valuep = (($prow['total'] / 100) * $gross);

                        $phsql = "SELECT * FROM philhealth WHERE t >= $gross AND f <= $gross";
                        $phquery = $conn->query($phsql);
                        
                        while ($phrow = $phquery->fetch_assoc()) {
                            // Check if the value is within the desired range
                                // The value is within the range
                                $erph = (($phrow['er'] / 100) * $gross);
                                $eeph = (($phrow['ee'] / 100) * $gross);
                                $valueph = (($phrow['total'] / 100) * $gross);


                                /*Loan*/
                                $loansql = "SELECT * FROM loan WHERE employee_id = $employeeid AND semiloan >=0";
                                $loanquery = $conn->query($loansql);

                                $descriptionloan = '';  // Initialize variables to store descriptions
                                $descriptionloanamount = '';  // and amounts
                                $totalloan = 0;  // Initialize variable to store total loan amount
                                
                                while ($loanrow = $loanquery->fetch_assoc()) {
                               // Check if the value is within the desired range
                               // The value is within the range   
                                $idloan=$loanrow['id']; 
                                $semiloan=$loanrow['semiloan'] - 1; 
                                $loanbalance=$loanrow['loanbalance'] - $loanrow['semimonths']; 
                                $loanpay=$loanrow['loanpay'];
                                $updateloanpay=$loanpay+$loanrow['semimonths'];

                                $sqlloan = "UPDATE loan SET semiloan = '$semiloan' , loanbalance = '$loanbalance', loanpay = '$updateloanpay' WHERE id = '$idloan'";
                                if($conn->query($sqlloan)){
                                    $_SESSION['success'] = 'Payroll Generate added successfully';
                                }
                                else{
                                    $_SESSION['error'] = $conn->error;
                                }   
                                $descriptionloan .= ' <br>'.$loanrow['description'];
                                $descriptionloanamount .= ' <br>'.$loanrow['semimonths'];
                                $totalloan =+ $loanrow['semimonths'];

                                }

                                
								$deduction = $ees + $eep + $eeph;
                                $loan_description = $descriptionloan;
                                $loan_amount= $descriptionloanamount;
								$total_deduction = $deduction + $cashadvance + $totalloan;
								$net = $gross - $total_deduction;
                                $paystatus = "Pending";
                                $totaleeer = $values+$valuep+$valueph;

								
                       
                            //PUT IN INVOINCE AND RECORD FOR BENIFITS
							
                            $paysql = "INSERT INTO payslip (invoice_id, employee_name, employee_id,rate, totalhours,otrate, othrtotal, ers, ees, totals, erp, eep, totalp, erph, eeph, totalph,loan_description,loan_amount, totalbenifitsdeduction,totaleeer,deduction_status, cashadvance, totaldeduction, gross, netpay, paystatus,generateby,datefrom,dateto)
                            VALUES ('$invocie_id', '$name', '$employeeid','$rate', '$totalhr', '$otrate', '$othrtotal', '$ers', '$ees', '$values','$erp','$eep', '$valuep', '$erph', '$eeph',  '$valueph', '$loan_description', '$loan_amount', '$deduction','$totaleeer','$paystatus', '$cashadvance', '$total_deduction', '$gross', '$net', '$paystatus','$generateby','$from','$to')";
                            if($conn->query($paysql)){
                                $_SESSION['success'] = 'Payroll Generate added successfully';
                            }
                            else{
                                $_SESSION['error'] = $conn->error;
                            }
    
                		}
                        header('location: payroll');
               
            }
        }
    }



		
	
    header('location: payroll');


?>