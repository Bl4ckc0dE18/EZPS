<?php
	include 'includes/session.php';

	function generateRow($conn){
		$contents = '';
		
        $sql = "SELECT 
        employees.*, 
        employees.id AS empid, 
        position.*, 
        (SELECT GROUP_CONCAT(work_load.schedule_load, ' ', work_load.time_load SEPARATOR ' \n <br>') FROM work_load WHERE work_load.employee_id = employees.employee_id) AS work_loads,
        (SELECT GROUP_CONCAT(CONCAT(employee_schedule.schedule_day, ' ', TIME_FORMAT(employee_schedule.time_in, '%h:%i %p'), ' - ', TIME_FORMAT(employee_schedule.time_out, '%h:%i %p')) SEPARATOR ' \n <br>') FROM employee_schedule WHERE employee_schedule.employee_id = employees.employee_id) AS work_schedules
        FROM 
            employees 
        LEFT JOIN 
            position ON position.id = employees.position_id";
        $query = $conn->query($sql);

            // Check for errors
            if (!$query) {
                // Query failed
                echo "Error: " . $conn->error;
            } else {
                // Query succeeded
                // Fetch and display data
                while ($row = $query->fetch_assoc()) {
                    $contents .= "
                        <tr>
                            <td>".$row['employee_id']."</td>
                            <td>".$row['lastname'].", ".$row['firstname']."</td>
                            <td>".$row['description']."</td>
                            <td>".$row['work_schedules']."</td>
                            <td>".$row['work_loads']."</td>
                           
                        </tr>
                        ";
                    
                }
            }

		return $contents;
	}

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
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
      	<h2 align="center">EZ PAYROLL SYSTEM</h2>
      	<h4 align="center">Employee Schedule</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="15%" align="center"><b>Employee ID</b></th>
                <th width="20%" align="center"><b>Employee Name</b></th>
				<th width="20%" align="center"><b>Position</b></th> 
                <th width="30%" align="center"><b>Work Schedule</b></th>
				<th width="15%" align="center"><b>Work Load</b></th> 
           </tr>  
      ';  
    $content .= generateRow($conn); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('schedule.pdf', 'I');

?>