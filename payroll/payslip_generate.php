<?php
// Check if the 'id' query parameter is set in the URL
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));	

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
 

   
    $sql = "SELECT *
	FROM payslip
	LEFT JOIN 
		employees ON employees.employee_id = payslip.employee_id
	LEFT JOIN 
		position ON position.id = employees.position_id
	WHERE payslip.datefrom >= '$from' AND payslip.dateto <= '$to'";
	

	
    
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
	
		$invoice_id = $row['invoice_id'];
		
		
		//Disallowance
		$sql_Disallowance = "SELECT * FROM loan_transaction WHERE description = 'Disallowance' AND loan_id = '$invoice_id'";
		$query_Disallowance = $conn->query($sql_Disallowance);
		$row_Disallowance = $query_Disallowance->fetch_assoc();
		if($query_Disallowance->num_rows > 0){
			
			$Disallowance = $row_Disallowance['loan_amount'];
		
		
		}else{
			
			$Disallowance = 0; 
			
		
		}
		
		
		//Ref-Sal
		$sql_Ref_Sal = "SELECT * FROM loan_transaction WHERE description = 'Ref-Sal' AND loan_id = '$invoice_id'";
		$query_Ref_Sal = $conn->query($sql_Ref_Sal);
		$row_Ref_Sal = $query_Ref_Sal->fetch_assoc();
		if($query_Ref_Sal->num_rows > 0){
			
			$Ref_Sal = $row_Ref_Sal['loan_amount'];
			
		
		}else{
			
			$Ref_Sal = 0; 
			
		
		}
		
		
		//Ref-Ocom
		$sql_Ref_Ocom = "SELECT * FROM loan_transaction WHERE description = 'Ref-Ocom' AND loan_id = '$invoice_id'";
		$query_Ref_Ocom = $conn->query($sql_Ref_Ocom);
		$row_Ref_Ocom = $query_Ref_Ocom->fetch_assoc();
		if($query_Ref_Ocom->num_rows > 0){
		
			$Ref_Ocom = $row_Ref_Ocom['loan_amount'];
		
		
		}else{
			
			$Ref_Ocom = 0; 
			
		}
		
		
		//NHMC
		$sql_NHMC = "SELECT * FROM loan_transaction WHERE description = 'NHMC' AND loan_id = '$invoice_id'";
		$query_NHMC = $conn->query($sql_NHMC);
		$row_NHMC = $query_NHMC->fetch_assoc();
		if($query_NHMC->num_rows > 0){
			
			$NHMC = $row_NHMC['loan_amount'];
		
		
		}else{
			
			$NHMC = 0; 
			
		
		}
		
		
		//MP2
		$sql_MP2 = "SELECT * FROM loan_transaction WHERE description = 'MP2' AND loan_id = '$invoice_id'";
		$query_MP2 = $conn->query($sql_MP2);
		$row_MP2 = $query_MP2->fetch_assoc();
		if($query_MP2->num_rows > 0){
			
			$MP2 = $row_MP2['loan_amount'];
		
		}else{
		
			$MP2 = 0; 
			
		
		}
		
		//GSIS MPL
		$sql_GSIS_MPL = "SELECT * FROM loan_transaction WHERE description = 'GSIS MPL' AND loan_id = '$invoice_id'";
		$query_GSIS_MPL = $conn->query($sql_GSIS_MPL);
		$row_GSIS_MPL = $query_GSIS_MPL->fetch_assoc();
		if($query_GSIS_MPL->num_rows > 0){
			
			$GSIS_MPL = $row_GSIS_MPL['loan_amount'];
		
		
		}else{
			
			$GSIS_MPL = 0; 
			
		
		}
		//GSIS_Sal
		$sql_GSIS_Sal = "SELECT * FROM loan_transaction WHERE description = 'GSIS Sal' AND loan_id = '$invoice_id'";
		$query_GSIS_Sal = $conn->query($sql_GSIS_Sal);
		$row_GSIS_Sal = $query_GSIS_Sal->fetch_assoc();
		if($query_GSIS_Sal->num_rows > 0){
		
			$GSIS_Sal = $row_GSIS_Sal['loan_amount'];
			

		}else{
			
			$GSIS_Sal = 0; 
			

		}
	
		
		//GSIS_Pol
		$sql_GSIS_Pol = "SELECT * FROM loan_transaction WHERE description = 'GSIS Pol' AND loan_id = '$invoice_id'";
		$query_GSIS_Pol = $conn->query($sql_GSIS_Pol);
		$row_GSIS_Pol = $query_GSIS_Pol->fetch_assoc();
		if($query_GSIS_Pol->num_rows > 0){
			
			$GSIS_Pol = $row_GSIS_Pol['loan_amount'];
			
		
		}else{
			
			$GSIS_Pol = 0; 
		
		}
		
		
		//GSIS ELA
		$sql_GSIS_ELA = "SELECT * FROM loan_transaction WHERE description = 'GSIS ELA' AND loan_id = '$invoice_id'";
		$query_GSIS_ELA = $conn->query($sql_GSIS_ELA);
		$row_GSIS_ELA = $query_GSIS_ELA->fetch_assoc();
		if($query_GSIS_ELA->num_rows > 0){
			
			$GSIS_ELA = $row_GSIS_ELA['loan_amount'];
			
		
		}else{
			
			$GSIS_ELA = 0; 
			
		
		}
		
		
		//GSIS Opin
		$sql_GSIS_Opin = "SELECT * FROM loan_transaction WHERE description = 'GSIS Opin' AND loan_id = '$invoice_id'";
		$query_GSIS_Opin = $conn->query($sql_GSIS_Opin);
		$row_GSIS_Opin = $query_GSIS_Opin->fetch_assoc();
		if($query_GSIS_Opin->num_rows > 0){
		
			$GSIS_Opin = $row_GSIS_Opin['loan_amount'];
		
		
		}else{

			$GSIS_Opin = 0; 
		
		}
		
		
		//GSIS OpLo
		$sql_GSIS_OpLo = "SELECT * FROM loan_transaction WHERE description = 'GSIS OpLo' AND loan_id = '$invoice_id'";
		$query_GSIS_OpLo = $conn->query($sql_GSIS_OpLo);
		$row_GSIS_OpLo = $query_GSIS_OpLo->fetch_assoc();
		if($query_GSIS_OpLo->num_rows > 0){

			$GSIS_OpLo = $row_GSIS_OpLo['loan_amount'];
		
		}else{

			$GSIS_OpLo = 0; 
			
		}
		
		//GSIS GFAL
		$sql_GSIS_GFAL = "SELECT * FROM loan_transaction WHERE description = 'GSIS GFAL' AND loan_id = '$invoice_id'";
		$query_GSIS_GFAL = $conn->query($sql_GSIS_GFAL);
		$row_GSIS_GFAL = $query_GSIS_GFAL->fetch_assoc();
		if($query_GSIS_GFAL->num_rows > 0){
			
			$GSIS_GFAL = $row_GSIS_GFAL['loan_amount'];
		
		
		}else{
		
			$GSIS_GFAL = 0; 
		
		}
		
		//GSIS HIP
		$sql_GSIS_HIP = "SELECT * FROM loan_transaction WHERE description = 'GSIS HIP' AND loan_id = '$invoice_id'";
		$query_GSIS_HIP = $conn->query($sql_GSIS_HIP);
		$row_GSIS_HIP = $query_GSIS_HIP->fetch_assoc();
		if($query_GSIS_HIP->num_rows > 0){
			
			$GSIS_HIP = $row_GSIS_HIP['loan_amount'];
			
		
		
		}else{
			
			$GSIS_HIP = 0; 
			
		
		}
		
		
		//GSIS CPL
		$sql_GSIS_CPL = "SELECT * FROM loan_transaction WHERE description = 'GSIS CPL' AND loan_id = '$invoice_id'";
		$query_GSIS_CPL = $conn->query($sql_GSIS_CPL);
		$row_GSIS_CPL = $query_GSIS_CPL->fetch_assoc();
		if($query_GSIS_CPL->num_rows > 0){
			
			$GSIS_CPL = $row_GSIS_CPL['loan_amount'];
			
		
		}else{
			
			$GSIS_CPL = 0; 
			
		
		}
		
		
		//GSIS SOS
		$sql_GSIS_SOS = "SELECT * FROM loan_transaction WHERE description = 'GSIS SOS' AND loan_id = '$invoice_id'";
		$query_GSIS_SOS = $conn->query($sql_GSIS_SOS);
		$row_GSIS_SOS = $query_GSIS_SOS->fetch_assoc();
		if($query_GSIS_SOS->num_rows > 0){
		
			$GSIS_SOS = $row_GSIS_SOS['loan_amount'];
		
		
		}else{
			
			$GSIS_SOS = 0; 
			
		
		}
		
		//GSIS Eplan
		$sql_GSIS_Eplan = "SELECT * FROM loan_transaction WHERE description = 'GSIS Eplan' AND loan_id = '$invoice_id'";
		$query_GSIS_Eplan = $conn->query($sql_GSIS_Eplan);
		$row_GSIS_Eplan = $query_GSIS_Eplan->fetch_assoc();
		if($query_GSIS_Eplan->num_rows > 0){
		
			$GSIS_Eplan = $row_GSIS_Eplan['loan_amount'];
			
		
		}else{
		
			$GSIS_Eplan = 0; 
		
		
		}
		
		
		//GSIS Ecard
		$sql_GSIS_Ecard = "SELECT * FROM loan_transaction WHERE description = 'GSIS Ecard' AND loan_id = '$invoice_id'";
		$query_GSIS_Ecard = $conn->query($sql_GSIS_Ecard);
		$row_GSIS_Ecard = $query_GSIS_Ecard->fetch_assoc();
		if($query_GSIS_Ecard->num_rows > 0){
			
			$GSIS_Ecard = $row_GSIS_Ecard['loan_amount'];
			
		}else{
			
			$GSIS_Ecard = 0; 
			
		}
	
		
		//HDMF MPL
		$sql_HDMF_MPL = "SELECT * FROM loan_transaction WHERE description = 'HDMF MPL' AND loan_id = '$invoice_id'";
		$query_HDMF_MPL = $conn->query($sql_HDMF_MPL);
		$row_HDMF_MPL = $query_HDMF_MPL->fetch_assoc();
		if($query_HDMF_MPL->num_rows > 0){
			
			$HDMF_MPL = $row_HDMF_MPL['loan_amount'];
			
		
		}else{
			
			$HDMF_MPL = 0; 
			
		
		}
		
		//HDMF Res
		$sql_HDMF_Res = "SELECT * FROM loan_transaction WHERE description = 'HDMF Res' AND loan_id = '$invoice_id'";
		$query_HDMF_Res = $conn->query($sql_HDMF_Res);
		$row_HDMF_Res = $query_HDMF_Res->fetch_assoc();
		if($query_HDMF_Res->num_rows > 0){
		
			$HDMF_Res = $row_HDMF_Res['loan_amount'];
			
		
		}else{
			$HDMF_Res ='-';
			$HDMF_Res = 0; 
			
		
		}
		
		//LBP
		$sql_LBP = "SELECT * FROM loan_transaction WHERE description = 'LBP' AND loan_id = '$invoice_id'";
		$query_LBP = $conn->query($sql_LBP);
		$row_LBP = $query_LBP->fetch_assoc();
		if($query_LBP->num_rows > 0){
			
			$LBP = $row_LBP['loan_amount'];
		
		
		}else{
			
			$LBP = 0; 
			
		
		}
	
		
		//TUPM-Cd
		$sql_TUPM_Cd = "SELECT * FROM loan_transaction WHERE description = 'TUPM-Cd' AND loan_id = '$invoice_id'";
		$query_TUPM_Cd = $conn->query($sql_TUPM_Cd);
		$row_TUPM_Cd = $query_TUPM_Cd->fetch_assoc();
		if($query_TUPM_Cd->num_rows > 0){
			
			$TUPM_Cd = $row_TUPM_Cd['loan_amount'];
			
		
		}else{
			
			$TUPM_Cd = 0; 
		
		
		}
	
		//Fin Ass
		$sql_Fin_Ass = "SELECT * FROM loan_transaction WHERE description = 'Fin Ass' AND loan_id = '$invoice_id'";
		$query_Fin_Ass = $conn->query($sql_Fin_Ass);
		$row_Fin_Ass = $query_Fin_Ass->fetch_assoc();
		if($query_Fin_Ass->num_rows > 0){
			$Fin_Ass = $row_Fin_Ass['loan_amount'];

		}else{
			$Fin_Ass = 0; 
		}

		//GSIS Educ
		$sql_GSIS_Educ = "SELECT * FROM loan_transaction WHERE description = 'GSIS Educ' AND loan_id = '$invoice_id'";
		$query_GSIS_Educ = $conn->query($sql_GSIS_Educ);
		$row_GSIS_Educ = $query_GSIS_Educ->fetch_assoc();
		if($query_GSIS_Educ->num_rows > 0){
			
			$GSIS_Educ = $row_GSIS_Educ['loan_amount'];
			
		
		}else{
			$GSIS_Educ = 0; 
			
		}
	
		
		//TUPAEA
		$sql_TUPAEA = "SELECT * FROM loan_transaction WHERE description = 'TUPAEA' AND loan_id = '$invoice_id'";
		$query_TUPAEA = $conn->query($sql_TUPAEA);
		$row_TUPAEA = $query_TUPAEA->fetch_assoc();
		if($query_TUPAEA->num_rows > 0){
			$TUPAEA = $row_TUPAEA['loan_amount'];
		
		}else{
			$TUPAEA = 0; 
		
		}
	
		
		//TUPFA
		$sql_TUPFA = "SELECT * FROM loan_transaction WHERE description = 'TUPFA' AND loan_id = '$invoice_id'";
		$query_TUPFA = $conn->query($sql_TUPFA);
		$row_TUPFA = $query_TUPFA->fetch_assoc();
		if($query_TUPFA->num_rows > 0){
			$TUPFA = $row_TUPFA['loan_amount'];

		}else{

			$TUPFA = 0; 
		}
		
		
		//HDMF Eme
		$sql_HDMF_Eme = "SELECT * FROM loan_transaction WHERE description = 'HDMF Eme' AND loan_id = '$invoice_id'";
		$query_HDMF_Eme = $conn->query($sql_HDMF_Eme);
		$row_HDMF_Eme = $query_HDMF_Eme->fetch_assoc();
		if($query_HDMF_Eme->num_rows > 0){
			$HDMF_Eme = $row_HDMF_Eme['loan_amount'];				
		}else{		
			$HDMF_Eme = 0; 	
		
		}
								$contents .= '
								<style>
			.right-border {
        	border-right: 1px solid black; 
    		}
			.bottom-border {	
			border-bottom: 1px solid black;		
			}
			.left-border {	
				border-left: 1px solid black;		
			}
			.top-border {	
					border-top: 1px solid black;		
			}
		</style>
								<h3 align="center">POWER BY EZ PAYROLL SYSTEM<br>TUP MANILA<br>PAYROLL PAYMENT SLIP<br>For the period of '.date('M d, Y', strtotime($row['datefrom']))." - ".date('M d, Y', strtotime($row['dateto'])).'<br><br><br></h3>
								
								
								<table border="0" cellspacing="0" cellpadding="3">  
									<tr>  
										<td width="15%" align="left">Employee No. </td>
										<td width="15%">'.$row['employee_id'].'</td>   
										<td width="15%" align="left">SG</td>
										<td width="15%" >'.$row['sg'].'</td> 
									</tr>
									<tr>  
										<td width="15%" align="left">Name </td>
										<td width="15%">'.$row['firstname'].' ' .$row['lastname'].'</td>   
										<td width="15%" align="left">Step</td>
										<td width="15%" >'.$row['step'].'</td> 
									</tr>

									<tr>  
										<td width="15%" align="left"></td>
										<td width="15%"></td>   
										<td width="15%" align="left">Position</td>
										<td width="15%" >'.$row['description'].'</td> 
									</tr>
									<tr>  
										<td width="18%" align="left">Basic Salary</td>
										<td width="70%" align="center">
											<b>-----------------------------------------------------------------------------------------------------------------------------------</b>
										</td>
										<td width="12%" align="right">'.number_format($row['monthly_salary'], 2).'</td>
									</tr>
									<tr>  
										<td width="18%" align="left">PERA/AsCom</td>
										<td width="70%" align="center">
											<b>-----------------------------------------------------------------------------------------------------------------------------------</b>
										</td>
										<td width="12%" align="right">'.number_format($row['allowance'], 2).'</td>
									</tr>
									<tr>  
										<td width="18%" align="left"><b>GROSS Amount Due</b></td>
										<td width="70%" align="center">
											
										</td>
										<td width="12%" class="bottom-border" align="right">'.number_format($row['gross'], 2).'</td>
									</tr>
									<br><br><br>
									<tr>  
										<td width="20%" align="left">Disallowance</td>
										<td width="10%" align="right"><b>'.number_format($Disallowance, 2).'</b></td>
										<td width="20%" align="left">GSIS ELA</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_ELA, 2).'</b></td>
										<td width="20%" align="left">HDMF Con</td>
										<td width="10%" align="right"><b>'.number_format($row['eep'], 2).'</b></td>
									</tr>
									<tr>  
										<td width="20%" align="left">Ref-Sal</td>
										<td width="10%" align="right"><b>'.number_format($Ref_Sal, 2).'</b></td>
										<td width="20%" align="left">GSIS Opin</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_Opin, 2).'</b></td>
										<td width="20%" align="left">LBP</td>
										<td width="10%" align="right"><b>'.number_format($LBP, 2).'</b></td>
									</tr>
									<tr>  
										<td width="20%" align="left">Ref-Ocom</td>
										<td width="10%" align="right"><b>'.number_format($Ref_Ocom, 2).'</b></td>
										<td width="20%" align="left">GSIS OpLo</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_OpLo, 2).'</b></td>
										<td width="20%" align="left">TUPM-Cd</td>
										<td width="10%" align="right"><b>'.number_format($TUPM_Cd, 2).'</b></td>
									</tr>
									<tr>  
										<td width="20%" align="left">NHMC</td>
										<td width="10%" align="right"><b>'.number_format($NHMC, 2).'</b></td>
										<td width="20%" align="left">GSIS GFAL</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_GFAL, 2).'</b></td>
										<td width="20%" align="left">Fin Ass</td>
										<td width="10%" align="right"><b>'.number_format($Fin_Ass, 2).'</b></td>
									</tr>
									<tr>  
										<td width="20%" align="left">MP2</td>
										<td width="10%" align="right"><b>'.number_format($MP2, 2).'</b></td>
										<td width="20%" align="left">GSIS HIP</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_HIP, 2).'</b></td>
										<td width="20%" align="left">GSIS Educ</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_Educ, 2).'</b></td>
									</tr>
									<tr>  
										<td width="20%" align="left">Integ-Ins</td>
										<td width="10%" align="right"><b>'.number_format($row['gsis_total'], 2).'</b></td>
										<td width="20%" align="left">GSIS CPL</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_CPL, 2).'</b></td>
										<td width="20%" align="left">TUPAEA</td>
										<td width="10%" align="right"><b>'.number_format($TUPAEA, 2).'</b></td>
									</tr>
									<tr>  
										<td width="20%" align="left">W/tax</td>
										<td width="10%" align="right"><b>'.number_format($row['w_tax_total'], 2).'</b></td>
										<td width="20%" align="left">GSIS SOS</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_SOS, 2).'</b></td>
										<td width="20%" align="left">TUPFA</td>
										<td width="10%" align="right"><b>'.number_format($TUPFA, 2).'</b></td>
									</tr>
									<tr>  
										<td width="20%" align="left">Philhealth</td>
										<td width="10%" align="right"><b>'.number_format($row['eeph'], 2).'</b></td>
										<td width="20%" align="left">GSIS Eplan</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_Eplan, 2).'</b></td>
										<td width="20%" align="left">HDMF Eme</td>
										<td width="10%" align="right"><b>'.number_format($HDMF_Eme, 2).'</b></td>
									</tr>
									<tr>  
										<td width="20%" align="left">GSIS MPL</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_MPL, 2).'</b></td>
										<td width="20%" align="left">GSIS Ecard</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_Ecard, 2).'</b></td>
										<td width="20%" align="left"></td>
										<td width="10%" align="right"></td>
									</tr>
									<tr>  
										<td width="20%" align="left">GSIS Sal</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_Sal, 2).'</b></td>
										<td width="20%" align="left">HDMF MPL</td>
										<td width="10%" align="right"><b>'.number_format($HDMF_MPL, 2).'</b></td>
										<td width="20%" align="left"></td>
										<td width="10%" align="right"></td>
									</tr>
									<tr>  
										<td width="20%" align="left">GSIS Pol</td>
										<td width="10%" align="right"><b>'.number_format($GSIS_Pol, 2).'</b></td>
										<td width="20%" align="left">H\'DMF Res</td>
										<td width="10%" align="right"><b>'.number_format($HDMF_Res, 2).'</b></td>
										<td width="20%" align="left" class="bottom-border" >Total Deduction</td>
										<td width="10%" align="right" class="bottom-border" ><b>'.number_format($row['totaldeduction'], 2).'</b></td>
									</tr>
									<tr>  
										<td width="20%" align="left"></td>
										<td width="10%" align="right"></td>
										<td width="20%" align="left"></td>
										<td width="10%" align="right"></td>
										<td width="20%" align="left"><b>Net Amount</b></td>
										<td width="10%" align="right"><b>'.number_format($row['netpay'], 2).'</b></td>
									</tr>
									<br><br><br>
									<tr style="background-color: lightgray;">  
										<td class="bottom-border" width="15%" align="left"><b>Salary : </b></td>
										<td class="bottom-border" width="15%" align="left"><b>1st Half</b></td>
										<td class="bottom-border" width="15%" align="left"><b>'.number_format($row['netpay']/2, 2).'</b></td>
										<td class="bottom-border" width="15%" align="left"><b>2nd Half</b></td>
										<td class="bottom-border" width="15%" align="left"><b>'.number_format($row['netpay']/2, 2).'</b></td>
									</tr>
									<br><br><br>
									<tr>  
										<td width="40%" align="left"><em>Prepared by :</em><br><br><br><b>ANTONIETTE T. CASTILLO</b><br>Administrative Officer IV</td>
										<td width="40%" align="left"><em>Certified correct :</em><br><br><br><b>CATALINA M. BAQUIRAN</b><br>Head, HRMS</td>
									</tr>

								</table>
								
								
							';
                       // Add page break after each employee's details
		$pdf->writeHTML($contents);
		$pdf->AddPage();
		// Reset $contents for the next employee
		$contents = '';
                        
							
    
                		}
               
            

    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');



?>
