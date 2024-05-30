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
								<table border="0" cellspacing="0" cellpadding="3">  
										<tr>  
											<td border="1" width="25%" align="left">Employee Name </td>
											<td border="1" width="25%"><b>'.$row['employee_name'].'</b></td>
                                            <td border="1" width="25%" align="left">Employee ID </td>
											<td border="1" width="25%">'.$row['employee_id'].'</td>
										</tr>
										
										<tr>
											 
											<td border="1" width="25%" align="left">Invocie Number  </td>
											<td border="1" width="25%" >'.$row['invoice_id'].' </td> 
											<td border="1" width="25%" align="left">Paid By : </td>
											<td border="1" width="25%" >'.$row['dpaidby'].' </td> 
                                             
											 
										</tr>
										
										<tr>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>	
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
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>	
										</tr>
										<tr> 
											<td border="1"  width="20%" align="center">Loan List</td>
											<td border="1"  width="20%" align="center">Description</td>
											<td border="1"  width="20%" align="center">Amount</td>
											
										</tr>
										
										<tr> 
											<td border="1"  width="20%" align="center"></td>
											<td border="1"  width="20%" align="center">'.$row['loan_description'].'</td>
											<td border="1"  width="20%" align="center">'.$row['loan_amount'].'</td>
											
										</tr>
										
										<tr>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>	
										</tr>

										<tr> 
                                            
                                            <td border="1"  width="25%" align="center">Total Deduction </td>
                                            <td border="1"  width="25%" align="center">'.number_format($row['totaldeduction'], 2).'</td> 
                                            <td border="1"  width="25%" align="center"><b>Payment Status</b></td>
											<td border="1"  width="25%" align="center"><b> '.$row['deduction_status'].'</b></td>
										</tr>
										<tr>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>
											<td width="20%" align="center"></td>	
										</tr>
                                        <tr> 

											<td  border="1"  width="100%" align="center"><b>Generate By : '.$row['generateby'].' </b></td>	                                        
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
