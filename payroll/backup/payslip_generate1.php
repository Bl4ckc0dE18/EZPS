<?php
	include 'includes/session.php';
	
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('EZ PAYROLL SYSTEM');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '9', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 8);  
    $pdf->AddPage(); 
    $contents = '';
 
	$sql = "SELECT * FROM payslip WHERE datefrom >= '$from' AND dateto <= '$to'";

    
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
		
		$contents .= '
		<h2 align="center">EZ PAYROLL SYSTEM</h2>
		<h4 align="center">'.$row['datefrom']." - ".$row['dateto'].'</h4>
		<table border="0" cellspacing="0" cellpadding="3">  
			<tr>  
				<td width="25%" align="left">Employee Name </td>
				<td width="25%"><b>'.$row['employee_name'].'</b></td>
				<td width="25%" align="left">Rate per Hour </td>
				<td width="25%" align="right">'.number_format($row['rate'], 2).'</td>
			</tr>
			<tr>
				<td width="25%" align="left">Employee ID </td>
				<td width="25%">'.$row['employee_id'].'</td>   
				<td width="25%" align="left">Total Hours </td>
				<td width="25%" align="right">'.number_format($row['totalhours'], 2).'</td> 
			</tr>
			<tr>
				 
				<td width="25%" align="left">Invocie Number  </td>
				<td width="25%" >'.$row['invoice_id'].' </td>  
				<td width="25%" align="left">Rate per Hour Overtime </td>
				<td width="25%" align="right">'.number_format($row['otrate'], 2).'</td> 
			</tr>
			<tr>
				<td width="25%" >Generated By : </td>
				<td width="25%">'.$row['generateby'].'</td>   
				<td width="25%" align="left">Total Hours </td>
				<td width="25%" align="right">'.number_format($row['othrtotal'], 2).'</td> 
			</tr>
			<tr> 
				<td width="25%" ></td>
				<td width="25%"></td>
				<td width="25%" align="left"><b>Gross Pay </b></td>
				<td width="25%" align="right"><b>'.number_format($row['gross'], 2).'</b></td> 
			</tr>
			
			<tr> 
				<td width="25%" ></td>

			</tr>
			<tr> 	
				<td border="1" width="20%" align="center">Deduction List </td>
				<td border="1" width="20%" align="center">GSIS </td>
				<td border="1" width="20%" align="center">W/TAX </td>
				<td border="1" width="20%" align="center">PHILHEALTH </td>
				<td border="1" width="20%" align="center">PAG-IBIG </td>
					
			</tr>
			<tr> 
				<td border="1"  width="20%" align="center"></td>
				<td border="1"  width="20%" align="center">'.number_format($row['gsis_total'], 2).'</td>
				<td border="1"  width="20%" align="center">'.number_format($row['w_tax_total'], 2).' </td>
				<td border="1"  width="20%" align="center">'.number_format($row['eep'], 2).' </td>
				<td border="1"  width="20%" align="center">'.number_format($row['eeph'], 2).'</td>
			</tr>
			<tr> 
				<td width="25%" ></td>
				
			
			</tr>
			<tr> 
				<td border="1" width="25%" ><b>Loan</b></td>
				<td border="1" width="25%">Loan Description</td>
				<td border="1" width="25%" align="left">Loan Amount</td>
				
			</tr>
			<tr> 
				<td border="1" width="25%" ><b></b></td>
				<td border="1" width="25%">'.$row['loan_description'].'</td>   
				<td border="1" width="25%">'.$row['loan_amount'].'</td>   
				
			</tr>
			<tr> 
				<td width="25%" ></td>
				
			
			</tr>
			<tr> 
				
				<td border="1" width="25%" align="center">Total Benefits Deduction </td>
				
				<td border="1" width="25%" align="center"><b>Total Deduction</b></td>
				<td border="1" width="25%" align="center"><b>Net Pay</b></td>
			</tr>

			<tr>
				<td border="1" width="25%" align="center">'.number_format($row['totalbenifitsdeduction'], 2).'</td> 
				
				<td border="1" width="25%" align="center"><b>'.number_format($row['totaldeduction'], 2).'</b></td> 
				<td border="1" width="25%" align="center"><b>'.number_format($row['netpay'], 2).'</b></td> 
			</tr>
			<tr> 
				<td width="25%" ></td>

			</tr>
			
			<tr> 
				<td width="25%" align="center"><b>Paid By : </b></td>
				<td width="25%" align="center"><b> '.$row['ppaidby'].'</b></td>
				<td width="25%" align="center"><b>Payment Status</b></td>
				<td width="25%" align="center"><b> '.$row['paystatus'].'</b></td> 
			</tr>

			<tr> 
				<td></td> 
				<td></td>
			</tr>
		</table>
		<br><hr>
		
	';
                       
        // Add page break after each employee's details
		$pdf->writeHTML($contents);
		$pdf->AddPage();
		// Reset $contents for the next employee
		$contents = '';
							
    
                		}
               
            

    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');



?>