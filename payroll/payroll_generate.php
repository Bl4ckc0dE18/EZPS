<?php
	include 'includes/session.php';

	function generateRow($from, $to, $conn){
		$contents = '';
		$totalSalary = 0; 
		$totaldeduction_db_per_employee =0;
		$totalDisallowance =0;
		$totaldeduction_per_employee = 0;
		$totaldeduction = 0;
		$totalRefSal = 0;

		$sql ="SELECT 
		employee_id,
		employee_id,
		netpay,
		
		invoice_id,
		employee_name,
		SUM(totaldeduction) AS total_totaldeduction,

		MAX(CASE WHEN DAY(datefrom) <= 15 AND DAY(dateto) >= 15 THEN netpay ELSE 0 END) AS first_half,
    	MAX(CASE WHEN DAY(datefrom) > 15 THEN netpay ELSE 0 END) AS second_half,
		
		MAX(CASE WHEN DAY(datefrom) <= 15 AND DAY(dateto) >= 15 THEN invoice_id ELSE 0 END) AS invoice_id1,
    	MAX(CASE WHEN DAY(datefrom) > 15 THEN invoice_id ELSE 0 END) AS invoice_id2
		FROM 
		payslip
		WHERE 
			datefrom >= '$from' AND dateto <= '$to'
		GROUP BY 
			employee_id
			ORDER BY 
   		datefrom;";
		/*$sql = "SELECT * FROM payslip WHERE datefrom >= '$from' AND dateto <= '$to'";*/
		
		
		//$sql = "SELECT * FROM payslip WHERE datefrom >= '$from' AND dateto <= '$to'";

		$no = 1;
		$query = $conn->query($sql);
		//$total = 0;
		//$total1 = 0;
		while($row = $query->fetch_assoc()){
			$employee_id = $row['employee_id'];
			$netPay = $row['netpay'];
			$totalSalary += $netPay; 
 
			

			$totaldeduction_db = $row['total_totaldeduction'];
			$totaldeduction_db_per_employee += $totaldeduction_db; 


			$invoice_id1 = $row['invoice_id1'];
			$invoice_id2 = $row['invoice_id2'];
			//$invoice_id = $row['invoice_id'];
			// search employee 
			$sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
			$query_employee = $conn->query($sql_employee);
			$row_employee = $query_employee->fetch_assoc();
			$position_id = $row_employee['position_id'];

			// search employee position
			$sql_position = "SELECT * FROM position WHERE id = '$position_id'";
			$query_position = $conn->query($sql_position);
			$row_position = $query_position->fetch_assoc();
			$position = $row_position['description'];
			$sg = $row_position['sg'];
			$step = $row_position['step'];
			$monthly_salary = $row_position['monthly_salary'];
			//checking if employee have add loans
			
			//Disallowance
			//$sql_Disallowance = "SELECT * FROM loan_transaction WHERE description = 'Disallowance' AND loan_id = '$invoice_id'";
			$sql_Disallowance = "SELECT SUM(loan_amount) AS total_loan_amount FROM loan_transaction WHERE description = 'Disallowance' AND loan_id IN ('$invoice_id1', '$invoice_id2')";

			$query_Disallowance = $conn->query($sql_Disallowance);
			$row_Disallowance = $query_Disallowance->fetch_assoc();
			if($query_Disallowance->num_rows > 0){
				$Disallowance = $row_Disallowance['total_loan_amount'];

				if($Disallowance == 0){
					$RefSal_value ='-';
				}
				else{
					$Disallowance_value = number_format($row_Disallowance['total_loan_amount'], 2);
					$netDisallowance = $Disallowance;
					$totalDisallowance += $netDisallowance;
				}

			}else{
				$Disallowance_value ='-';
				$Disallowance = 0; 
				$netDisallowance = $Disallowance;
				$totalDisallowance += $netDisallowance;
	
			}
			if($totalDisallowance == 0){
				$totalDisallowance_value = '-';
			}else{
				$totalDisallowance_value = number_format($totalDisallowance, 2);
			}


			//Disallowance
			$sql_RefSal =  "SELECT SUM(loan_amount) AS total_loan_amount 
			FROM 
				loan_transaction 
			WHERE 
				description = 'Ref-Sal' 
				AND loan_id IN ('$invoice_id1', '$invoice_id2')";
			$query_RefSal = $conn->query($sql_RefSal);
			$row_RefSal = $query_RefSal->fetch_assoc();
			if($query_RefSal->num_rows > 0){
				$RefSal = $row_RefSal['total_loan_amount'];
				
				if($RefSal == 0){
					$RefSal_value ='-';
				}else{
					$RefSal_value = number_format($row_RefSal['total_loan_amount'], 0);
					
					$netRefSal = $RefSal;
					$totalRefSal += $netRefSal;
				}

			}else{
				$RefSal_value ='-';
				$RefSal = 0; 
				$netRefSal = $RefSal;
				$totalRefSal += $RefSal;
	
			}
			if($totalRefSal == 0){
				$totalRefSal_value = '-';
			}else{
				$totalRefSal_value = number_format($totalRefSal, 2);
			}
			
			//total deduction per employee
			$totaldeduction_per_employee = $Disallowance +$RefSal;

			//total deduction
			$totaldeduction = $totaldeduction_per_employee;
			$totaldeduction += $totaldeduction;
			
			
			 

			




			/**/$contents .= '
			<style>
				.right-border {
				border-right: 1px solid black; 
				}
				.bottom-border {	
				border-bottom: 1px solid black;		
				}
			</style>
			<tr>
				<td border="1" align="center">'.$no++.'</td>
				<td border="1" align="left">'.$row['employee_name'].'<br><br>STEP '.$step.'<br><br>SG '.$sg.'</td>
				
				<td border="1" align="left">'.$position.'<br><br>'.$step.'<br><br>'.$sg.'</td>

				<td border="1" align="center">'.$row['employee_id'].'</td>
				
				<td border="1" align="right">'.number_format($monthly_salary, 2).'</td>
				<td border="1" align="right">PERA</td>
				
				<td border="1" align="right">AC</td>
				<td border="1" width="7%" align="right">GAE</td>

				
				<td class="bottom-border" align="center"><b>@<br>#<br>.<br>&<br>!</b></td>
				<td class="bottom-border right-border"  align="right"><b>'.$Disallowance_value.'<br>'.$RefSal_value.'<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>a<br>b<br>c<br>d<br>e</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>f<br>g<br>h<br>i<br>j</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>k<br>l<br>m<br>n<br>o</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>p<br>q<br>r<br>s<br>t</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>u<br>v<br>w<br>x<br>y</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				
				<td border="1" width="7%" align="right">'.number_format($totaldeduction_db, 2).'</td>
				

				<td class="bottom-border" width="2%" align="center"><b>*<br><br>.<br></b></td>
				<td class="bottom-border right-border" width="5%" align="right"><b>'.number_format($row['first_half'], 2).'<br><br>'.number_format($row['second_half'], 2).'</b></td>


			</tr>
			';
			
		}
	 
		// total sheet

		/**/$contents .= '
		<style>
    		.right-border {
        	border-right: 1px solid black; 
    		}
			.bottom-border {	
			border-bottom: 1px solid black;		
			}
		</style>

			<tr>
				<td border="1"  align="center"></td>
				<td border="1"  align="center">SHEET TOTAL</td>
				
				<td border="1" align="center">-</td>

				<td border="1"  align="center"></td>
				
				<td border="1" align="right">'.number_format($totalSalary, 2).'</td>
				<td border="1" align="right">PERA</td>
				
				<td border="1" align="right">AC</td>
				<td border="1" width="7%" align="right">GAE</td>

				
				<td class="bottom-border" align="center"><b>@<br>#<br>.<br>&<br>!</b></td>
				<td class="bottom-border right-border" align="right"><b>'.$totalDisallowance_value.'<br>'.$totalRefSal_value.'<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>a<br>b<br>c<br>d<br>e</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>f<br>g<br>h<br>i<br>j</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>k<br>l<br>m<br>n<br>o</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>p<br>q<br>r<br>s<br>t</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				<td class="bottom-border" align="center"><b>u<br>v<br>w<br>x<br>y</b></td>
				<td class="bottom-border right-border" align="right"><b>-<br>-<br>-<br>-<br>-</b></td>

				
				<td border="1" width="7%" align="right">'.number_format($totaldeduction_db_per_employee, 2).'</td>
				

				<td class="bottom-border" width="2%" align="center"><b>TL<br>*<br><br>.<br></b></td>
				<td class="bottom-border right-border" width="5%"align="right"><b>1st half<br>1st half<br><br>2nd half</b></td>

			</tr>
		';

//footer
		$contents .= '
		<style>
			.right-border {
        	border-right: 1px solid black; 
    		}
			.bottom-border {	
			border-bottom: 1px solid black;		
			}
			.left-border {	
				border-left: 1px solid black;		
			}
			.top-border {	
					border-top: 1px solid black;		
			}
		</style>
			<tr>
				<td border="1" rowspan="1"  align="center">A</td>
				<td colspan="9" align="left">CERTIFIED: Service duly rendered as stated</td>

				<td border="1"colspan="1" align="center">C</td>
				<td class="right-border" colspan="12" align="left">  APPROVED FOR PAYMENT:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________ P___________________</td>
				
			</tr>

			<tr>
				<td class="left-border right-border" colspan="10" align="center" ><br></td>
				<td class="right-border" colspan="13" align="center" ><br></td>
			</tr>
			<tr>
				
				<td class="left-border bottom-border" colspan="2" align="center" ><br></td>
				<td class="bottom-border right-border "colspan="8" align="left"><b>ATTY. CHRISTOPHER M. MORTEL</b>
				<br>Supervising Adminstrative Officer, HRMS</td>

				<td class="left-border bottom-border" colspan="3" align="center" ><br></td>
				<td class="bottom-border right-border "colspan="10" align="left"><b>PURABELLA R. ARGON</b>
				<br>Vice President for Adminstrative and Finance</td>
			</tr>

			<tr>
				<td border="1" rowspan="1"  align="center">B</td>
				<td colspan="9" align="left">CERTIFIED: Supporting documents complete and proper;
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				and crash available in the amount of P</td>
				
				<td border="1" rowspan="1"  align="center">D</td>
				<td colspan="13" class="right-border" align="left">CERTIFIED: Each employee whom name appears shown has been 
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				paid the amount indicated opposite is/her name.</td>
			</tr>

			<tr>
				<td class="left-border" rowspan="1"  align="center"></td>
				<td colspan="9" align="left"></td>
				
				<td class="left-border" rowspan="1"  align="center"></td>
				<td colspan="9" align="left"></td>

				<td colspan="1" align="left">OR No.</td>
				<td colspan="3" class="right-border" align="left">_________________</td>

			</tr>

			<tr>
				<td colspan="2" class="left-border bottom-border" rowspan="1"  align="center"></td>
				<td colspan="8" class="bottom-border" align="left"><b>CATALINO A. FORTES JR.</b>
				<br>Head, Accountant Services</td>
				
				<td class="left-border bottom-border" rowspan="1"  align="center"></td>
					<td class="bottom-border" colspan="9" align="left"> __________________________________________________________________<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					S.D.O
				</td>

				<td class="bottom-border" colspan="1" align="left">Date:</td>
				<td colspan="3" class="bottom-border right-border" align="left">_________________</td>

			</tr>
			
			
			
		';
		return $contents;
	}
		
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('EZ PAYROLL SYSTEM');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
	$pdf->SetMargins('3', '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 50);  
    $pdf->SetFont('helvetica', '', 5);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '

	<style>
    		.right-border {
        	border-right: 1px solid black;
			
    		}

			.bottom-border {
				
				border-bottom: 1px solid black;
				}
			
	</style>

	<h2 align="center">POWER BY EZ PAYROLL SYSTEM</h2>
	<p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
	Ayala Blvd. Ermita, Manila<br>
	For the period'.$from_title." - ".$to_title.'</b></p>
	<h4 align="left">We acknowledge receipt of cash shown opposite names as full comppensation for services rendered for the period covered.<br>
	<b>ADMINSTRATIVE SECTOR</b></h4>
	<table border="0" cellspacing="0" cellpadding="3">  

	<tr>  
		<th border="1" width="3%" rowspan="2" align="center"><b><br><br><br><br>NO</b></th>
		<th border="1" width="8%" rowspan="2" align="center"><b><br><br><br><br>NAME</b></th>
		<th border="1" width="6%" rowspan="2" align="center"><b><br><br><br><br>POSITION</b></th>
		<th border="1" width="4%" rowspan="2" align="center"><b><br><br><br><br>EMPLO<br>YEE <br>NO</b></th>
		<th border="1"  width="6%" rowspan="2" align="center"><b><br><br><br><br>MONTHLY SALARY</b></th>
		<th border="1" width="12%" height="2" rowspan="1"  align="center"><b><br>OTHER COMPENSATION</b></th>

		<th border="1" width="7%" rowspan="2"	align="center" ><b><br><br><br><br><br>GROSS AMOUNT <BR>EARNED</b></th>
		<th border="1" width="42%" rowspan="1" colspan="7" align="center" ><b><br><br>DEDUCTIONS</b></th>
		
		<th border="1" width="7%" rowspan="2" align="center" ><b><br><br><br><br>TOTAL<br>DEDUCTIONS</b></th>
		<th border="1" width="7%" rowspan="1" align="center" ><b><br><br><br><br>NET AMOUNT DUE<br> <br>. </b></th>
	</tr>

	<tr>
			
			<th border="1" width="6%" align="center"><b><br>PERSONAL<br>ECONOMIC<br>RELIEF<br>ALLOWANCE</b></th>
			<th width="6%" align="center"><b><br><br>ADDITIONAL COMPENS.</b></th>

			<th class="bottom-border" width="2%" align="center"><b>@<br>#<br>.<br>&<br>!</b></th>
			<th class="bottom-border right-border" width="5%"><b>Disallowance<br>Ref-Sal<br>Ref-Ocom<br>NHMC<br>MP2</b></th>

			<th class="bottom-border" width="2%" align="center"><b>a<br>b<br>c<br>d<br>e</b></th>
			<th class="bottom-border right-border" width="5%"><b>Integ-Ins<br>W/tax<br>Philhealth<br>GSIS MPL<br>GSIS Sal</b></th>

			<th class="bottom-border" width="2%" align="center"><b>f<br>g<br>h<br>i<br>j</b></th>
			<th class="bottom-border right-border" width="5%"><b>GSIS Pol<br>GSIS ELA<br>GSIS Opin<br>GSIS OpLo<br>GSIS GFAL</b></th>

        	<th class="bottom-border" width="2%" align="center"><b>k<br>l<br>m<br>n<br>o</b></th>
			<th class="bottom-border right-border" width="5%"><b>GSIS HIP<br>GSIS CPL<br>GSIS SOS<br>GSIS Eplan<br>GSIS Ecard</b></th>

        	<th  class="bottom-border" width="2%" align="center"><b>p<br>q<br>r<br>s<br>t</b></th>
			<th class="bottom-border right-border" width="5%"><b>HDMF MPL<br>H\'DMF Res<br>HDMF Con<br>LBP<br>TUPM-Cd</b></th>

        	<th  class="bottom-border" width="2%" align="center"><b>u<br>v<br>w<br>x<br>y</b></th>
			<th class="bottom-border right-border" width="5%"><b>Fin Ass<br>GSIS Educ<br>TUPAEA<br>TUPFA<br>HDMF Eme</b></th>

			<th  class="bottom-border" width="2%" align="center"><b>*<br><br>.<br></b></th>
			<th class="bottom-border right-border" width="5%" align="right" ><b>1st half<br><br>2nd half</b></th>

			
	</tr>

      ';  
    $content .= generateRow($from, $to, $conn);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('payroll.pdf', 'I');

?>