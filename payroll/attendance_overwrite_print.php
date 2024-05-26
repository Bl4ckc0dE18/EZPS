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
   
	$sql = "SELECT *,
	employees.employee_id AS empid, 
	pre_attendance.id AS attid 
		FROM pre_attendance 
		LEFT JOIN employees 
			ON employees.id = pre_attendance.employee_id
		WHERE 
		pre_attendance.id = $look 
		ORDER BY
			pre_attendance.date DESC, pre_attendance.time_in DESC";

    
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
		$image = '<img src="../evidence/' . $row['evidence'] . '" width="300px" height="300px" />';

								$contents .= '
								<h2 align="center">EZ PAYROLL SYSTEM</h2>
								<h4 align="center">'.date('M d, Y', strtotime($row['date'])).'</h4>
								<h4 align="center">'.date('h:i A', strtotime($row['time_in']))." - ".date('h:i A', strtotime($row['time_out'])).'</h4>
								<table border="0" cellspacing="0" cellpadding="3">  
									
									
									
							<tr> 
								<td border="1" width="50%"><b>Name</b></td>
								<td border="1" width="50%"><b>'.$row['firstname'].' '.$row['lastname'].'</b></td>
								
							</tr>
							
							<tr> 
								
								<td border="1" width="50%"><b>Status</b></td>
								<td border="1" width="50%"><b>'.$row['status'].'</b></td> 
							</tr>
							<tr> 
								<td border="1" colspan="4" align ="center"><b>Comment</b></td>
							</tr>
							<tr> 
								<td border="1" colspan="4" align ="center"><b>'.$row['comment'].'</b></td>
							</tr>
							
							<tr>
								<td colspan="4"></td>
								<td colspan="4"></td>
							</tr>
							<tr>
								<td colspan="4"></td>
								<td colspan="4"></td>
							</tr>
							<tr> 
								<td border="1" colspan="4" align ="center"><b>Evidence</b></td>
							</tr>
							<tr> 
								<td border="1" colspan="4" align ="center"><b><br><br><br>'.$image.'<br><br><br></b></td>
							</tr>
									
								</table>
								
								
							';
                       
                        
							
    
                		}
               
            

    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');


} else {
    echo "ID not received.";
}
?>
