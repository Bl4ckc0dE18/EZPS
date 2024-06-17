<?php
include 'includes/session.php';

if (isset($_POST['print'])) {
    $selectedOption = $_POST['description'];
	$select_month = $_POST['select_month'];
	$select_year = $_POST['select_year'];
	
if ($selectedOption == 'Integ-Ins'){
   

	function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='Integ-Ins';
		$total = 0;
        $sql = "SELECT 
                    employee_id,
                    employee_name,
                    gsis_total
                   
                FROM 
                    payslip
					WHERE MONTH(datefrom) >= $select_month 
        			AND MONTH(dateto) <= $select_month 
        			AND YEAR(datefrom) = $select_year 
        			AND YEAR(dateto) = $select_year
                
                ORDER BY 
                    employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];
            $total_loan = $row['gsis_total'];
			$total += $total_loan;
			$deduction = $row['gsis_total'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction. '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;

                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'W/tax'){
	function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='W/Tax';
		$total = 0;
        $sql = "SELECT 
                    employee_id,
                    employee_name,
                    w_tax_total
                   
                FROM 
                    payslip
					WHERE MONTH(datefrom) >= $select_month 
        			AND MONTH(dateto) <= $select_month 
        			AND YEAR(datefrom) = $select_year 
        			AND YEAR(dateto) = $select_year
                
                ORDER BY 
                    employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];
            $total_loan = $row['w_tax_total'];
			$total += $total_loan;
			$deduction=$row['w_tax_total'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'HDMF Con'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='HDMF Con';
		$total = 0;
        $sql = "SELECT 
                    employee_id,
                    employee_name,
                    eep
                   
                FROM 
                    payslip
					WHERE MONTH(datefrom) >= $select_month 
        			AND MONTH(dateto) <= $select_month 
        			AND YEAR(datefrom) = $select_year 
        			AND YEAR(dateto) = $select_year
                
                ORDER BY 
                    employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];
            $total_loan = $row['eep'];
			$total += $total_loan;
			$deduction=$row['eep'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}   
elseif($selectedOption == 'Philhealth'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='Philhealth';
		$total = 0;
        $sql = "SELECT 
                    employee_id,
                    employee_name,
                    eeph
                   
                FROM 
                    payslip
					WHERE MONTH(datefrom) >= $select_month 
        			AND MONTH(dateto) <= $select_month 
        			AND YEAR(datefrom) = $select_year 
        			AND YEAR(dateto) = $select_year
                
                ORDER BY 
                    employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];
            $total_loan = $row['eeph'];
			$total += $total_loan;
			$deduction=$row['eeph'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}   
// LOANS
elseif($selectedOption == 'Disallowance'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='Disallowance';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}

elseif($selectedOption == 'Ref-Sal'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='Ref-Sal';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
} 

elseif($selectedOption == 'Ref-Ocom'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='Ref-Ocom';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
} 

elseif($selectedOption == 'NHMC'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='NHMC';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
} 

elseif($selectedOption == 'MP2'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='MP2';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
} 

elseif($selectedOption == 'GSIS MPL'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS MPL';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}

elseif($selectedOption == 'GSIS Sal'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS Sal';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}

elseif($selectedOption == 'GSIS Sal'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS Sal';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS Pol'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS Pol';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS ELA'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS ELA';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS Opin'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS Opin';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS OpLo'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS OpLo';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS GFAL'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS GFAL';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS HIP'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS HIP';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS CPL'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS CPL';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS SOS'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS SOS';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS Eplan'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS Eplan';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS Ecard'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS Ecard';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'HDMF MPL'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='HDMF MPL';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'HDMF Res'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='HDMF Res';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'LBP'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='LBP';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'TUPM-Cd'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='TUPM-Cd';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'Fin Ass'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='Fin Ass';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'GSIS Educ'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='GSIS Educ';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'TUPAEA'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='TUPAEA';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'TUPFA'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='TUPFA';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
elseif($selectedOption == 'HDMF Eme'){
    function generateRow($conn, $pdf,$select_month,$select_year) {
        $description ='HDMF Eme';
		$total = 0;
        $sql = "SELECT
            payslip.employee_id,
            payslip.employee_name,
            payslip.invoice_id,
            loan_transaction.loan_amount
        FROM 
            payslip
        INNER JOIN 
            loan_transaction ON payslip.invoice_id = loan_transaction.loan_id 
                                AND loan_transaction.description = '$description'
        WHERE 
            MONTH(payslip.datefrom) >= $select_month 
            AND MONTH(payslip.dateto) <= $select_month 
            AND YEAR(payslip.datefrom) = $select_year 
            AND YEAR(payslip.dateto) = $select_year
        ORDER BY 
            payslip.employee_name ASC";
        
        $count = 0; // Counter for the number of rows printed

        // Start HTML table
        $html = '
        <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
        <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
        Ayala Blvd. Ermita, Manila<br>
        For the period '.date('M', strtotime("2000-$select_month-01")).' - '.$select_year.' </b></p>
        <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
        <b>ADMINISTRATIVE SECTOR</b></h4>
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>  
            <th border="1" width="5%" align="center"><b>NO</b></th>
            <th border="1" width="15%" align="center"><b>NAME</b></th>
            <th border="1" width="15%" align="center"><b>POSITION</b></th>
            <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
            <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
        </tr>';

        $no = 1;
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

            $employee_id = $row['employee_id'];

            $total_loan = $row['loan_amount'];
			$total += $total_loan;
            
			$deduction=$row['loan_amount'];
            $count++;
            $sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
            $query_employee = $conn->query($sql_employee);
            $row_employee = $query_employee->fetch_assoc();
            $position_id = $row_employee['position_id'];

            // Search employee position
            $sql_position = "SELECT * FROM position WHERE id = '$position_id'";
            $query_position = $conn->query($sql_position);
            $row_position = $query_position->fetch_assoc();
            $position = $row_position['description'];
            $sg = $row_position['sg'];
            $step = $row_position['step'];

            // Add row to HTML table
            $html .= '<style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
            </style>
            <tr>
                <td border="1" align="center">' . $no++ . '</td>
                <td border="1" align="left">' . $row['employee_name'] . '</td>
                <td border="1" align="left">' . $position . ' ' . $step . ' ' . $sg . '</td>
                <td border="1" align="center">' . $row['employee_id'] . '</td>
                <td class="bottom-border right-border" align="right"><b>' . $deduction . '</b></td>
            </tr>';

            // Check if 4 rows have been printed
            if ($count % 15 == 0 && $query->num_rows > $count) {
                // Display subtotal net pay for the previous four rows
                $html .= '
                <style>
                    .right-border {
                        border-right: 1px solid black; 
                    }
                    .bottom-border {	
                        border-bottom: 1px solid black;		
                    }
                </style>
                <tr>
                    <td border="1" align="center"></td>
                    <td border="1" align="center">SHEET TOTAL</td>
                    <td border="1" align="center">-</td>
                    <td border="1" align="center"></td>
                     <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
                </tr>';
                // Reset HTML content for the new page
                $total = 0;
                
                $html .= '</table>';
                $pdf->writeHTML($html); // Write HTML content to PDF
                $pdf->AddPage(); // Add a new page after the subtotal
                
                $html = '
                <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS<br>'.$description.'</h2>
                <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
                Ayala Blvd. Ermita, Manila<br>
                For the period </b></p>
                <h4 align="left">We acknowledge receipt of cash shown opposite names as full compensation for services rendered for the period covered.<br>
                <b>ADMINISTRATIVE SECTOR</b></h4>
                <table border="0" cellspacing="0" cellpadding="3">
                <tr>  
                    <th border="1" width="5%" align="center"><b>NO</b></th>
                    <th border="1" width="15%" align="center"><b>NAME</b></th>
                    <th border="1" width="15%" align="center"><b>POSITION</b></th>
                    <th border="1" width="15%" align="center"><b>EMPLOYEE NO</b></th>
                    <th border="1" width="15%" align="center"><b>DEDUCTIONS</b></th>
                </tr>';
            }
        }

        $html .= '
        <style>
            .right-border {
                border-right: 1px solid black; 
            }
            .bottom-border {	
                border-bottom: 1px solid black;		
            }
        </style>
        <tr>
            <td border="1" align="center"></td>
            <td border="1" align="center">SHEET TOTAL</td>
            <td border="1" align="center">-</td>
            <td border="1" align="center"></td>
            <td class="bottom-border right-border" align="right"><b>' . $total . '</b></td>
        </tr>';
        
        $html .= '</table>'; // Close HTML table
        $pdf->writeHTML($html); // Write HTML content to PDF
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT,'10');  
    $pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

    $pdf->AddPage();
    generateRow($conn, $pdf,$select_month,$select_year);  

    $pdf->Output('deduction_and_loan_records.pdf', 'I');
}
else {
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location:deduction');

} else {
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location:deduction');
?>
