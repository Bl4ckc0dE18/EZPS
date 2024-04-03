<?php
	include 'includes/session.php';

	function generateRow($from, $to, $conn){
		$contents = '';
	 	
		//$sql = "SELECT * FROM payslip WHERE datefrom >= '$from' AND dateto <= '$to'";

		$sql = "SELECT * FROM payslip WHERE datefrom >= '$from' AND dateto <= '$to'";


		$query = $conn->query($sql);
		//$total = 0;
		//$total1 = 0;
		while($row = $query->fetch_assoc()){
			
			$contents .= '
			<tr>
				<td align="center">'.$row['employee_name'].'</td>
				<td align="center">'.$row['employee_id'].'</td>
				<td align="center">'.$row['invoice_id'].'</td>
				<td align="center">'.number_format($row['totals'], 2).'</td>
				<td align="center">'.number_format($row['totalp'], 2).'</td>
				<td align="center">'.number_format($row['totalph'], 2).'</td>
				<td align="center">'.number_format($row['totalbenifitsdeduction'], 2).'</td>
				<td align="center">'.$row['deduction_status'].'</td>

			</tr>
			';
			
		}
		//$total = $row['total_net_pay'];
		

		//$contents .= '
			//<tr>
				//<td colspan="3" align="right"><b>Total</b></td>
				//<td align="center"><b>'.number_format($total, 2).'</b></td>
		//	</tr>
		//';
		return $contents;
	}
		
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
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '',7);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
      	<h2 align="center">EZ PAYROLL SYSTEM</h2>
      	<h4 align="center">'.$from_title." - ".$to_title.'</h4>

      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="15%" align="center"><b>Employee Name</b></th>
                <th width="15%" align="center"><b>Employee ID</b></th>
				<th width="15%" align="center"><b>Invoice Number</b></th> 
				<th width="10%" align="center"><b>SSS</b></th> 
				<th width="10%" align="center"><b>PAG-IBIG</b></th> 
				<th width="10%" align="center"><b>PHILHEALTH</b></th> 
				<th width="10%" align="center"><b>TOTAL</b></th> 
				<th width="15%" align="center"><b>STATUS</b></th> 

				
           </tr>  
      ';  
    $content .= generateRow($from, $to, $conn);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('benefits_list.pdf', 'I');

?>