<?php
include 'includes/session.php';

function generateRow($conn, $pdf){
    $sql = "SELECT * FROM payslip";
    $query = $conn->query($sql);
    $count = 0; // Counter for the number of rows printed
    $totalNetPay = 0; // Variable to store total net pay

    // Start HTML table
    $html = '
    <h2 align="center">POWER BY EZ PAYROLL SYSTEM</h2>
    <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
    Ayala Blvd. Ermita, Manila<br>
    For the period </b></p>
    <h4 align="left">We acknowledge receipt of cash shown opposite names as full comppensation for services rendered for the period covered.<br>
    <b>ADMINISTRATIVE SECTOR</b></h4>
    <table border="1" cellspacing="0" cellpadding="3">
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

		
</tr>';

    while($row = $query->fetch_assoc()){
        $count++;
        $totalNetPay += $row['netpay']; // Add net pay to total

        // Add row to HTML table
        $html .= '<tr>
                    <td align="center">'.$row['employee_name'].'</td>
                    <td align="center">'.$row['employee_id'].'</td>
                    <td align="center">'.$row['paystatus'].'</td>
                    <td align="center">'.number_format($row['netpay'], 2).'</td>
                </tr>';

        // Check if 4 rows have been printed
        if ($count % 4 == 0 && $query->num_rows > $count) {
            // Display subtotal net pay for the previous four rows
            $html .= '<tr>
                        <td colspan="3" align="right"><b>Subtotal Net Pay:</b></td>
                        <td align="center"><b>'.number_format($totalNetPay, 2).'</b></td>
                    </tr>';

            $totalNetPay = 0; // Reset subtotal net pay for the next set of four rows

			$html .= '</table>';
            $pdf->writeHTML($html); // Write HTML content to PDF
            $pdf->AddPage(); // Add a new page after the subtotal
            // Reset HTML content for the new page
            $html = '
            <h2 align="center">POWER BY EZ PAYROLL SYSTEM</h2>
            <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
            Ayala Blvd. Ermita, Manila<br>
            For the period </b></p>
            <h4 align="left">We acknowledge receipt of cash shown opposite names as full comppensation for services rendered for the period covered.<br>
            <b>ADMINISTRATIVE SECTOR</b></h4>
            <table border="1" cellspacing="0" cellpadding="3">
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
	
				
		</tr>';
        }
		
    }
	$html .= '<tr>
	<td colspan="3" align="right"><b>Subtotal Net Pay:</b></td>
	<td align="center"><b>'.number_format($totalNetPay, 2).'</b></td>
</tr>';
    $html .= '</table>'; // Close HTML table

    $pdf->writeHTML($html); // Write HTML content to PDF
}

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
	$pdf->SetMargins('5', '8', '12');  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);   

$pdf->AddPage();
generateRow($conn, $pdf);  

$pdf->Output('payroll.pdf', 'I');
?>
