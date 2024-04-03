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
   
    $sql = "SELECT * FROM employees WHERE employee_id like '$look' ";

    
    
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){

        $pid=$row['position_id'];

        $sqlp = "SELECT * FROM position WHERE id like '$pid' ";
        $queryp = $conn->query($sqlp);
        $rowp = $queryp->fetch_assoc();
        
        $image = '<img src="../images/' . $row['photo'] . '" width="100px" height="100px" style="border-radius: 50%; overflow: hidden;" />';


        
								$contents .= '
								<table border="0" cellspacing="0" cellpadding="3"> 
                                    <tr>  
										<td width="25%" align="center">EZ PAYROLL SYSTEM</td>
                                        <td width="25%" align="center" border="1">Address</td>
											
									</tr> 
									<tr>  
										<td width="25%" align="center" >'.$image.' </td>
                                        <td width="25%" align="center" >'. $row['address'].' </td>
											
									</tr>
                                        
                                    <tr> 
                                        <td width="25%" align="center"><b>'. $row['firstname'] . ' '. $row['lastname'] .'</b></td>
                                        <td width="25%" align="center"><b>____________________</b></td>
                                    </tr>

                                    <tr> 
                                        <td width="25%" align="center">'. $row['employee_id'] .'</td>
                                        <td width="25%" align="center"><b>Employee Signature</b></td>
                                    </tr>
                                    
                                    <tr> 
                                        <td width="25%" align="center">'. $rowp['description'] .'</td>
                                        <td width="25%" align="center" border-right="1" >Contact Info</td>
                                    </tr>
                                    <tr> 
                                        <td width="25%" align="center">Member Since</td>
                                        <td width="25%" align="center">'. $row['contact_info'] .'</td>
                                    </tr>
                                    <tr> 
                                        <td width="25%" align="center">'. $row['created_on'] .'</td>
                                        <td width="25%" align="center">'. $row['email'] .'</td>
                                    </tr>

                                    </table>
								
							';
                       
                        
							
    
                		}
               
            

    $pdf->writeHTML($contents);  
    $pdf->Output('My_ID.pdf', 'I');


} else {
    echo "ID not received.";
}
?>
