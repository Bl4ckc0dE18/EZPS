<?php
// Check if the 'id' query parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $tdId = $_GET['id'];

    // Now, you can use the $tdId variable in this PHP page
	include 'includes/session.php';
	
	
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
 
	$look=$tdId;
	
    $sql = "SELECT * FROM payslip WHERE invoice_id like '$look' ";

    
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
		
								$contents .= '
								<h2 align="center">EZ PAYROLL SYSTEM</h2>
								<h4 align="center">'.$row['datefrom']." - ".$row['dateto'].'</h4>
								<table border="" cellspacing="0" cellpadding="3">  
										<tr>  
											<td width="25%" align="left">Employee Name </td>
											<td width="25%"><b>'.$row['employee_name'].'</b></td>
                                            <td width="25%" align="left">Employee ID </td>
											<td width="25%">'.$row['employee_id'].'</td>
										</tr>
										
										<tr>
											 
											<td width="25%" align="left">Invocie Number  </td>
											<td width="25%" >'.$row['invoice_id'].' </td> 
											<td width="25%" align="left">Paid By : </td>
											<td width="25%" >'.$row['dpaidby'].' </td> 
                                             
											 
										</tr>
										
										
										
										<tr> 
											
											<td width="25%" align="center">Deduction List </td>
											<td width="25%" align="center">SSS </td>
											<td width="25%" align="center">PAG-IBIG </td>
											<td width="25%" align="center">PHILHEALTH </td>
										</tr>
										
										<tr> 
											<td width="25%" align="center">EE </td>
											<td width="25%" align="center">'.number_format($row['ees'], 2).' </td>
											<td width="25%" align="center">'.number_format($row['eep'], 2).' </td>
											<td width="25%" align="center">'.number_format($row['eeph'], 2).'</td>
										</tr>

										<tr> 
											<td width="25%" align="center">ER </td>
											<td width="25%" align="center">'.number_format($row['ers'], 2).' </td>
											<td width="25%" align="center">'.number_format($row['erp'], 2).' </td>
											<td width="25%" align="center">'.number_format($row['erph'], 2).'</td> 
										</tr>
										
										<tr> 
											<td width="25%" align="center">TOTAL </td>
											<td width="25%" align="center">'.number_format($row['totals'], 2).' </td>
											<td width="25%" align="center">'.number_format($row['totalp'], 2).' </td>
											<td width="25%" align="center">'.number_format($row['totalph'], 2).'</td> 
										</tr>
												
										<tr> 
                                            
                                            <td width="25%" align="center">Total Benifits Deduction </td>
                                            <td width="25%" align="center">'.number_format($row['totalbenifitsdeduction'], 2).'</td> 
                                            <td></td> 
											<td></td>
										</tr>

										<tr> 
											<td width="25%" align="center"><b>Total EE and ER</b></td>
											<td width="25%" align="center"><b> '.$row['totaleeer'].'</b></td>
                                            <td width="25%" align="center"><b>Payment Status</b></td>
											<td width="25%" align="center"><b> '.$row['deduction_status'].'</b></td>
                                            
                                            
										</tr>
                                        <tr> 
											
                                           
										<td width="25%" align="center"><b>Generate By : '.$row['generateby'].' </b></td>
											
                                            
                                            
											
                                            
										</tr>

                                        
									</table>
									<br><hr>
									
								';
                       
                       
                        
							
    
                		}
               
            

    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');


} else {
    echo "ID not received.";
}
?>
