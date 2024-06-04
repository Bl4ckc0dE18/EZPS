<?php
    include 'includes/session.php';

    function generateRow($conn, $pdf, $pageContent){
        $no = 1;
        $rowCount = 0; // Track the number of rows generated

        $sql = "SELECT * FROM payslip ";
        $query = $conn->query($sql);

        while($row = $query->fetch_assoc()){
            $total = $row['netpay'];

            $pageContent .= '
            <tr>
                <td  align="center">'.$no++.'</td>
                <td  align="center">'.$row['employee_name'].'</td>
                <td  align="center"></td>
                <td  align="center">'.$row['employee_id'].'</td>
                <td  align="right">'.number_format($row['netpay'], 2).'</td>
                <td  align="right">PERA</td>
                <td align="right">AC</td>
                <td width="7%" align="right">GAE</td>
                <td align="center"><b>@<br>#<br>.<br>&<br>!</b></td>
                <td align="right"><b>-<br>-<br>-<br>-<br>-</b></td>
                <td align="center"><b>a<br>b<br>c<br>d<br>e</b></td>
                <td align="right"><b>-<br>-<br>-<br>-<br>-</b></td>
                <td align="center"><b>f<br>g<br>h<br>i<br>j</b></td>
                <td align="right"><b>-<br>-<br>-<br>-<br>-</b></td>
                <td align="center"><b>k<br>l<br>m<br>n<br>o</b></td>
                <td align="right"><b>-<br>-<br>-<br>-<br>-</b></td>
                <td align="center"><b>p<br>q<br>r<br>s<br>t</b></td>
                <td align="right"><b>-<br>-<br>-<br>-<br>-</b></td>
                <td align="center"><b>u<br>v<br>w<br>x<br>y</b></td>
                <td align="right"><b>-<br>-<br>-<br>-<br>-</b></td>
                <td  width="7%" align="right">TD </td>
                <td width="7%"align="right">NAE  </td>
            </tr>
            ';

            $rowCount++;
            if ($rowCount == 4) { // If 4 rows are generated, add a new page and reset the row count
                $pdf->writeHTML($pageContent);
                $pdf->AddPage();
                $pageContent = ''; // Reset the page content
                
            }
        }

        return $pageContent;
    }

    $from_title = date('M d, Y');
    $to_title = date('M d, Y');

    require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('EZ PAYROLL SYSTEM');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins('3', '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 5);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
    <h2 align="center">EZ PAYROLL SYSTEM</h2>
    <h4 align="center"></h4>
    <table border="1" cellspacing="0" cellpadding="3">  
    <tr>  
        <th width="3%" rowspan="2" align="center"><b><br><br><br><br>NO</b></th>
        <th width="8%" rowspan="2" align="center"><b><br><br><br><br>NAME</b></th>
        <th width="6%" rowspan="2" align="center"><b><br><br><br><br>POSITION</b></th>
        <th width="4%" rowspan="2" align="center"><b><br><br><br><br>EMPLO<br>YEE <br>NO</b></th>
        <th width="6%" rowspan="2" align="center"><b><br><br><br><br>MONTHLY SALARY</b></th>
        <th width="12%" height="2" rowspan="1"  align="center"><b><br>OTHER COMPENSATION</b></th>
        <th width="7%" rowspan="2"    align="center" ><b><br><br><br><br>GROSS AMOUNT <BR>EARNED</b></th>
        <th width="42%" rowspan="1" colspan="7" align="center" ><b><br><br>DEDUCTIONS</b></th>
        <th width="7%" rowspan="2" align="center" ><b><br><br><br><br>TOTAL<br>DEDUCTIONS</b></th>
        <th width="7%" rowspan="2" align="center" ><b><br><br><br><br>NET AMOUNT DUE<br> 1st half<br>. 2nd half</b></th>
    </tr>
    <tr>
        <th width="6%" align="center"><b><br>PERSONAL<br>ECONOMIC<br>RELIEF<br>ALLOWANCE</b></th>
        <th width="6%" align="center"><b><br><br>ADDITIONAL COMPENS.</b></th>
        <th width="2%" align="center"><b>@<br>#<br>.<br>&<br>!</b></th>
        <th width="5%"><b>Disallowance<br>Ref-Sal<br>Ref-Ocom<br>NHMC<br>MP2</b></th>
        <th width="2%" align="center"><b>a<br>b<br>c<br>d<br>e</b></th>
        <th width="5%"><b>Integ-Ins<br>W/tax<br>Philhealth<br>GSIS MPL<br>GSIS Sal</b></th>
        <th width="2%" align="center"><b>f<br>g<br>h<br>i<br>j</b></th>
        <th width="5%"><b>GSIS Pol<br>GSIS ELA<br>GSIS Opin<br>GSIS OpLo<br>GFAL</b></th>
        <th width="2%" align="center"><b>k<br>l<br>m<br>n<br>o</b></th>
        <th width="5%"><b>GSIS HIP<br>GSIS CPL<br>GSIS SOS<br>GSIS Eplan<br>GSIS Ecard</b></th>
        <th width="2%" align="center"><b>p<br>q<br>r<br>s<br>t</b></th>
        <th width="5%"><b>HDMF MPL<br>H\'DMF Res<br>HDMF Con<br>LBP<br>TUPM-Cd</b></th>
        <th width="2%" align="center"><b>u<br>v<br>w<br>x<br>y</b></th>
        <th width="5%"><b>Fin Ass<br>GSIS Educ<br>TUPAEA<br>TUPFA<br>HDMF Eme</b></th>
    </tr>
    ';  
    $rowCount = 0;
    $content .= generateRow($conn, $pdf, $content);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('payroll.pdf', 'I');
?>
