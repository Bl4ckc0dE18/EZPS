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
   
   // SQL query 
   $sql = "SELECT 
                                        employees.*, 
                                        employees.id AS empid, 
                                        position.*, 
                                        (SELECT GROUP_CONCAT(CONCAT(schedule_load, ' ', time_load) ORDER BY FIELD(schedule_load, 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'), time_load SEPARATOR ' \n <br>') FROM work_overtime WHERE work_overtime.employee_id = employees.employee_id) AS work_overtimes,
                                        (SELECT GROUP_CONCAT(CONCAT('DAY - ',schedule_day,'<br>','TIME IN - ' ,TIME_FORMAT(time_in, '%h:%i %p'), '<br>TIME OUT - ', TIME_FORMAT(time_out, '%h:%i %p'),'<br>TYPE - ',type,'<br>') ORDER BY FIELD(schedule_day, 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT')SEPARATOR ' \n <br>') FROM employee_schedule WHERE employee_schedule.employee_id = employees.employee_id) AS work_schedules
                                    FROM 
                                        employees
                                    LEFT JOIN 
                                        position ON position.id = employees.position_id
                                    WHERE 
                                        employee_id like '$look'
                                    ORDER BY 
                                    work_overtimes,
                                        work_schedules;";
    
    
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){

       
        
        //$image = '<img src="../images/' . $row['photo'] . '" width="100px" height="100px" style="border-radius: 50%; overflow: hidden;" />';
        $image = '<img src="' . (!empty($row['photo']) ? '../images/' . $row['photo'] : '../images/profile.jpg') . '" width="100px" height="100px" style="border-radius: 50%; overflow: hidden;" />';



        
								$contents .= '
                                <style>
        .right-border {
            border-right: 1px solid black;        
        }
        .bottom-border {        
            border-bottom: 1px solid black;
        }
        
    </style>
								<table border="0" cellspacing="0" cellpadding="3"> 
                                    <tr>  
										<td colspan="10" align="center"><h1>EZ PAYROLL SYSTEM</h1></td>
                                        
											
									</tr> 

                                    <tr>  
										<td colspan="10" align="center"></td>
                                        
											
									</tr> 
									<tr>  
										<td width="25%" rowspan="6" align="center" >'.$image.' </td>
                                        <td width="15%" align="center" >Name </td>
                                        <td colspan="6" class="bottom-border" align="left" ><b>'. $row['firstname'] . ' '. $row['lastname'] .'</b></td>
                                       
											
									</tr>
                                    <tr>  
										
                                        <td width="15%" align="center" >Employee ID </td>
                                        <td colspan="6" class="bottom-border" align="left" ><b>'. $row['employee_id'].'</b></td>
                                       
											
									</tr>
                                    <tr>  
										
                                        <td width="15%" align="center" >Birthday </td>
                                        <td colspan="6" class="bottom-border" align="left" ><b>'.date("F d, Y", strtotime($row['birthdate'])).'</b></td>
                                       
											
									</tr>
                                    <tr>  
										
                                        <td width="15%" align="center" >Email </td>
                                        <td colspan="6" class="bottom-border"  align="left" ><b>'. $row['email'] .'</b></td>
                                       
											
									</tr>
                                    <tr>  
										
                                        <td width="15%" align="center" >Contact Number </td>
                                        <td colspan="6"  class="bottom-border" align="left" ><b>'. $row['contact_info']  .'</b></td>
                                       
											
									</tr>
                                    <tr>  
										
                                        <td width="15%" align="center" >Address </td>
                                        <td colspan="6" class="bottom-border" align="left" ><b>'. $row['address'] . '</b></td>
                                   
                                        
                                    </tr>
                                    
                                        
                                    <tr> 
                                        <td border="0"  width="25%" align="center"></td>
                                        <td border="0"  width="25%" align="center"></td>
                                        <td border="0" width="25%" align="center"></td>
                                        <td border="0" width="25%" align="center"></td>
                                    </tr>
                                    <tr> 
                                        <td border="1" width="25%" align="center">Position</td>
                                        <td border="1" width="25%" align="center">Basic Salary</td>
                                        <td border="1" width="25%" align="center">Salary Grade</td>
                                        <td border="1" width="25%" align="center">Step</td>
                                    </tr>
                                    <tr> 
                                        <td border="1" width="25%" align="center">'. $row['description'] .'</td>
                                        <td border="1" width="25%" align="center">'.number_format($row['monthly_salary'], 2).'</td>
                                        <td border="1" width="25%" align="center">'. $row['sg'] .'</td>
                                        <td border="1" width="25%" align="center">'. $row['step'] .'</td>
                                    </tr>

                                    <tr> 
                                        <td width="25%" align="center"></td>
                                        <td width="25%" align="center"></td>
                                        <td width="25%" align="center"></td>
                                        <td width="25%" align="center"></td>
                                    </tr>
                                    <tr> 
                                        <td border="0"  width="25%" align="center"></td>
                                        <td border="0"  width="25%" align="center"></td>
                                        <td border="0" width="25%" align="center"></td>
                                        <td border="0" width="25%" align="center"></td>
                                    </tr>
                                    <tr> 
                                        <td border="1" width="25%" align="center">Rate per Hour</td>
                                        <td border="1" width="25%" align="center">Rate per Hour Overtime</td>
                                        <td border="1" width="25%" align="center">Work Schedule</td>
                                        <td border="1" width="25%" align="center">Work Overtime</td>
                                    </tr>
                                    <tr> 
                                        <td border="1" width="25%" align="center">'.number_format($row['rate'], 2).'</td>
                                        <td border="1" width="25%" align="center">'.number_format($row['ot'], 2).'</td>
                                        <td border="1" width="25%" align="left">'. $row['work_schedules'] .'</td>
                                        <td border="1" width="25%" align="left">'. $row['work_overtimes'] .'</td>
                                    </tr>
                                    <tr> 
                                        <td width="25%" align="center"></td>
                                        <td width="25%" align="center"></td>
                                        <td width="25%" align="center"></td>
                                        <td width="25%" align="center"></td>
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
