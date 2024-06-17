<?php
include 'includes/session.php';

function generateRow($conn, $pdf){
	$totalSalary = 0;
	$totalMonthly_Salary = 0; 
	
	$totaldeduction_db_per_employee =0;
	$totalallowance_db_per_employee = 0;

	//total loan
	$totalDisallowance =0;
	$totaldeduction_per_employee = 0;
	
	//loan
	$totaldeduction = 0;
	$totalRefSal = 0;
	$totalRef_Ocom =0;
	$totalNHMC =0;
	$totalMP2 =0;
	$totalGSIS_MPL =0;
	$totalGSIS_Sal =0;
	$totalGSIS_Pol =0;
	$totalGSIS_ELA =0;
	$totalGSIS_Opin =0;
	$totalGSIS_OpLo =0;
	$totalGSIS_GFAL =0;
	$totalGSIS_HIP =0;
	$totalGSIS_CPL =0;
	$totalGSIS_SOS =0;
	$totalGSIS_Eplan =0;
	$totalGSIS_Ecard =0;
	$totalHDMF_MPL =0;
	$totalHDMF_Res =0;
	$totalLBP =0;
	$totalTUPM_Cd =0;
	$totalFin_Ass =0;
	$totalGSIS_Educ =0;
	$totalTUPAEA =0;
	$totalTUPFA =0;
	$totalHDMF_Eme =0;



	//first and second 
	$totalfirst_half_db_per_employee = 0;
	$totalsecond_half_db_per_employee = 0;

	//Mandatory deduction
	$totaltotal_gsis_total_db_per_employee = 0;
	$totaltotal_w_tax_total_db_per_employee = 0;
	$totaltotal_eeph_db_per_employee = 0;
	$totaltotal_eep_db_per_employee = 0;

	$sql ="SELECT 
	employee_id,
	netpay,
	invoice_id,
	employee_name,
	SUM(gsis_total) AS total_gsis_total,
	SUM(w_tax_total) AS total_w_tax_total,
	SUM(eeph) AS total_eeph,
	SUM(eep) AS total_eep,
	
	SUM(totaldeduction) AS total_totaldeduction,
	SUM(allowance) AS total_allowance

	FROM 
	payslip

	GROUP BY 
		employee_id
		ORDER BY 
		employee_name";
    $count = 0; // Counter for the number of rows printed


    // Start HTML table
    $html = '
    <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS</h2>
    <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
    Ayala Blvd. Ermita, Manila<br>
    For the period </b></p>
    <h4 align="left">We acknowledge receipt of cash shown opposite names as full comppensation for services rendered for the period covered.<br>
    <b>ADMINISTRATIVE SECTOR</b></h4>
    <table border="0" cellspacing="0" cellpadding="3">
	<tr>  
	<th border="1" width="5%" rowspan="2" align="center"><b><br><br><br><br>NO</b></th>
	<th border="1" width="10%" rowspan="2" align="center"><b><br><br><br><br>NAME</b></th>
	<th border="1" width="10%" rowspan="2" align="center"><b><br><br><br><br>POSITION</b></th>
	<th border="1" width="8%" rowspan="2" align="center"><b><br><br><br><br>EMPLO<br>YEE <br>NO</b></th>
	<th border="1" width="60%" rowspan="1" colspan="7" align="center" ><b><br><br>DEDUCTIONS</b></th>
	
	<th border="1" width="10%" rowspan="2" align="center" ><b><br><br><br><br>TOTAL<br>DEDUCTIONS</b></th>
	
</tr>

<tr>
		

		<th class="bottom-border" width="3%" align="center"><b>@<br>#<br>.<br>&<br>!</b></th>
		<th class="bottom-border right-border" width="7%"><b>Disallowance<br>Ref-Sal<br>Ref-Ocom<br>NHMC<br>MP2</b></th>

		<th class="bottom-border" width="3%" align="center"><b>a<br>b<br>c<br>d<br>e</b></th>
		<th class="bottom-border right-border" width="7%"><b>Integ-Ins<br>W/tax<br>Philhealth<br>GSIS MPL<br>GSIS Sal</b></th>

		<th class="bottom-border" width="3%" align="center"><b>f<br>g<br>h<br>i<br>j</b></th>
		<th class="bottom-border right-border" width="7%"><b>GSIS Pol<br>GSIS ELA<br>GSIS Opin<br>GSIS OpLo<br>GSIS GFAL</b></th>

		<th class="bottom-border" width="3%" align="center"><b>k<br>l<br>m<br>n<br>o</b></th>
		<th class="bottom-border right-border" width="7%"><b>GSIS HIP<br>GSIS CPL<br>GSIS SOS<br>GSIS Eplan<br>GSIS Ecard</b></th>

		<th  class="bottom-border" width="3%" align="center"><b>p<br>q<br>r<br>s<br>t</b></th>
		<th class="bottom-border right-border" width="7%"><b>HDMF MPL<br>H\'DMF Res<br>HDMF Con<br>LBP<br>TUPM-Cd</b></th>

		<th  class="bottom-border" width="3%" align="center"><b>u<br>v<br>w<br>x<br>y</b></th>
		<th class="bottom-border right-border" width="7%"><b>Fin Ass<br>GSIS Educ<br>TUPAEA<br>TUPFA<br>HDMF Eme</b></th>

	

		
</tr>';

$no = 1;
$query = $conn->query($sql);
while($row = $query->fetch_assoc()){
	$employee_id = $row['employee_id'];
	$netPay = $row['netpay'];
	$totalSalary += $netPay; 
        $count++;
        /**///1st
			

			$first_half = $row['netpay']/2;
			$totalfirst_half_db_per_employee += $first_half; 
			//2nd
			$second_half = $row['netpay']/2;
			$totalsecond_half_db_per_employee += $second_half; 

			//1stand2nd
			$totalsalaryfirstandsecond = $totalfirst_half_db_per_employee + $totalsecond_half_db_per_employee;

			//Integ_ins
			$total_gsis_total = $row['total_gsis_total'];
			$totaltotal_gsis_total_db_per_employee += $total_gsis_total;

			//W/TAX
			$total_w_tax_total = $row['total_w_tax_total'];
			$totaltotal_w_tax_total_db_per_employee += $total_w_tax_total;

			//PHILHEALTH
			$total_eeph = $row['total_eeph'];
			$totaltotal_eeph_db_per_employee += $total_eeph;
			//PAG-IBIG
			$total_eep = $row['total_eep'];
			$totaltotal_eep_db_per_employee += $total_eep;

			//
			$totaldeduction_db = $row['total_totaldeduction'];
			$totaldeduction_db_per_employee += $totaldeduction_db; 
			
			$totalallowance = $row['total_allowance'];
			$totalallowance_db_per_employee += $totalallowance; 


			$invoice_id = $row['invoice_id'];
			//$invoice_id2 = $row['invoice_id2'];
			//$invoice_id = $row['invoice_id'];
			// search employee 
			$sql_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
			$query_employee = $conn->query($sql_employee);
			$row_employee = $query_employee->fetch_assoc();
			$position_id = $row_employee['position_id'];

			// search employee position
			$sql_position = "SELECT * FROM position WHERE id = '$position_id'";
			$query_position = $conn->query($sql_position);
			$row_position = $query_position->fetch_assoc();
			$position = $row_position['description'];
			$sg = $row_position['sg'];
			$step = $row_position['step'];
			$monthly_salary = $row_position['monthly_salary'];
			

			
			$totalMonthly_Salary += $monthly_salary; 
			//checking if employee have add loans
			
			//Disallowance
			//$sql_Disallowance = "SELECT * FROM loan_transaction WHERE description = 'Disallowance' AND loan_id = '$invoice_id'";
			$sql_Disallowance = "SELECT SUM(loan_amount) AS total_loan_amount 
			FROM loan_transaction WHERE description = 'Disallowance'AND loan_id = '$invoice_id'";

			$query_Disallowance = $conn->query($sql_Disallowance);
			$row_Disallowance = $query_Disallowance->fetch_assoc();
			if($query_Disallowance->num_rows > 0){
				$Disallowance = $row_Disallowance['total_loan_amount'];

				if($Disallowance == 0){
					$Disallowance_value ='-';
				}
				else{
					$Disallowance_value = number_format($row_Disallowance['total_loan_amount'], 2);
					$netDisallowance = $Disallowance;
					$totalDisallowance += $netDisallowance;
				}

			}else{
				$Disallowance_value ='-';
				$Disallowance = 0; 
				$netDisallowance = $Disallowance;
				$totalDisallowance += $netDisallowance;
	
			}
			if($totalDisallowance == 0){
				$totalDisallowance_value = '-';
			}else{
				$totalDisallowance_value = number_format($totalDisallowance, 2);
			}


			//Ref-Sal
			$sql_RefSal =  "SELECT SUM(loan_amount) AS total_loan_amount 
			FROM 
				loan_transaction 
			WHERE 
				description = 'Ref-Sal' 
				AND loan_id = '$invoice_id'";
			$query_RefSal = $conn->query($sql_RefSal);
			$row_RefSal = $query_RefSal->fetch_assoc();
			if($query_RefSal->num_rows > 0){
				$RefSal = $row_RefSal['total_loan_amount'];
				
				if($RefSal == 0){
					$RefSal_value ='-';
				}else{
					$RefSal_value = number_format($row_RefSal['total_loan_amount'], 2);
					
					$netRefSal = $RefSal;
					$totalRefSal += $netRefSal;
				}

			}else{
				$RefSal_value ='-';
				$RefSal = 0; 
				$netRefSal = $RefSal;
				$totalRefSal += $RefSal;
	
			}
			if($totalRefSal == 0){
				$totalRefSal_value = '-';
			}else{
				$totalRefSal_value = number_format($totalRefSal, 2);
			}
			
			//Ref-Ocom
			$sql_Ref_Ocom = "SELECT * FROM loan_transaction WHERE description = 'Ref-Ocom' AND loan_id = '$invoice_id'";
			$query_Ref_Ocom = $conn->query($sql_Ref_Ocom);
			$row_Ref_Ocom = $query_Ref_Ocom->fetch_assoc();
			if($query_Ref_Ocom->num_rows > 0){
				$Ref_Ocom_value = number_format($row_Ref_Ocom['loan_amount'], 2);
				$Ref_Ocom = $row_Ref_Ocom['loan_amount'];
				$netRef_Ocom = $Ref_Ocom;
				$totalRef_Ocom += $netRef_Ocom;

			}else{
				$Ref_Ocom_value ='-';
				$Ref_Ocom = 0; 
				$netRef_Ocom = $Ref_Ocom;
				$totalRef_Ocom += $netRef_Ocom;

			}
			if($totalRef_Ocom == 0){
				$totalRef_Ocom_value = '-';
			}else{
				$totalRef_Ocom_value = number_format($totalRef_Ocom, 2);
			}
			//NHMC
			$sql_NHMC = "SELECT * FROM loan_transaction WHERE description = 'NHMC' AND loan_id = '$invoice_id'";
			$query_NHMC = $conn->query($sql_NHMC);
			$row_NHMC = $query_NHMC->fetch_assoc();
			if($query_NHMC->num_rows > 0){
				$NHMC_value = number_format($row_NHMC['loan_amount'], 2);
				$NHMC = $row_NHMC['loan_amount'];
				$netNHMC = $NHMC;
				$totalNHMC += $netNHMC;

			}else{
				$NHMC_value ='-';
				$NHMC = 0; 
				$netNHMC = $NHMC;
				$totalNHMC += $netNHMC;

			}
			if($totalNHMC == 0){
				$totalNHMC_value = '-';
			}else{
				$totalNHMC_value = number_format($totalNHMC, 2);
			}
			//MP2
			$sql_MP2 = "SELECT * FROM loan_transaction WHERE description = 'MP2' AND loan_id = '$invoice_id'";
			$query_MP2 = $conn->query($sql_MP2);
			$row_MP2 = $query_MP2->fetch_assoc();
			if($query_MP2->num_rows > 0){
				$MP2_value = number_format($row_MP2['loan_amount'], 2);
				$MP2 = $row_MP2['loan_amount'];
				$netMP2 = $MP2;
				$totalMP2 += $netMP2;

			}else{
				$MP2_value ='-';
				$MP2 = 0; 
				$netMP2 = $MP2;
				$totalMP2 += $netMP2;

			}
			if($totalMP2 == 0){
				$totalMP2_value = '-';
			}else{
				$totalMP2_value = number_format($totalMP2, 2);
			}
//GSIS MPL
$sql_GSIS_MPL = "SELECT * FROM loan_transaction WHERE description = 'GSIS MPL' AND loan_id = '$invoice_id'";
$query_GSIS_MPL = $conn->query($sql_GSIS_MPL);
$row_GSIS_MPL = $query_GSIS_MPL->fetch_assoc();
if($query_GSIS_MPL->num_rows > 0){
    $GSIS_MPL_value = number_format($row_GSIS_MPL['loan_amount'], 2);
    $GSIS_MPL = $row_GSIS_MPL['loan_amount'];
    $netGSIS_MPL = $GSIS_MPL;
    $totalGSIS_MPL += $netGSIS_MPL;

}else{
    $GSIS_MPL_value ='-';
    $GSIS_MPL = 0; 
    $netGSIS_MPL = $GSIS_MPL;
    $totalGSIS_MPL += $netGSIS_MPL;

}
if($totalGSIS_MPL == 0){
    $totalGSIS_MPL_value = '-';
}else{
    $totalGSIS_MPL_value = number_format($totalGSIS_MPL, 2);
}

//GSIS_Sal
$sql_GSIS_Sal = "SELECT * FROM loan_transaction WHERE description = 'GSIS Sal' AND loan_id = '$invoice_id'";
$query_GSIS_Sal = $conn->query($sql_GSIS_Sal);
$row_GSIS_Sal = $query_GSIS_Sal->fetch_assoc();
if($query_GSIS_Sal->num_rows > 0){
    $GSIS_Sal_value = number_format($row_GSIS_Sal['loan_amount'], 2);
    $GSIS_Sal = $row_GSIS_Sal['loan_amount'];
    $netGSIS_Sal = $GSIS_Sal;
    $totalGSIS_Sal += $netGSIS_Sal;

}else{
    $GSIS_Sal_value ='-';
    $GSIS_Sal = 0; 
    $netGSIS_Sal = $GSIS_Sal;
    $totalGSIS_Sal += $netGSIS_Sal;

}
if($totalGSIS_Sal == 0){
    $totalGSIS_Sal_value = '-';
}else{
    $totalGSIS_Sal_value = number_format($totalGSIS_Sal, 2);
}
//GSIS_Pol
$sql_GSIS_Pol = "SELECT * FROM loan_transaction WHERE description = 'GSIS Pol' AND loan_id = '$invoice_id'";
$query_GSIS_Pol = $conn->query($sql_GSIS_Pol);
$row_GSIS_Pol = $query_GSIS_Pol->fetch_assoc();
if($query_GSIS_Pol->num_rows > 0){
    $GSIS_Pol_value = number_format($row_GSIS_Pol['loan_amount'], 2);
    $GSIS_Pol = $row_GSIS_Pol['loan_amount'];
    $netGSIS_Pol = $GSIS_Pol;
    $totalGSIS_Pol += $netGSIS_Pol;

}else{
    $GSIS_Pol_value ='-';
    $GSIS_Pol = 0; 
    $netGSIS_Pol = $GSIS_Pol;
    $totalGSIS_Pol += $netGSIS_Pol;

}
if($totalGSIS_Pol == 0){
    $totalGSIS_Pol_value = '-';
}else{
    $totalGSIS_Pol_value = number_format($totalGSIS_Pol, 2);
}

//GSIS ELA
$sql_GSIS_ELA = "SELECT * FROM loan_transaction WHERE description = 'GSIS ELA' AND loan_id = '$invoice_id'";
$query_GSIS_ELA = $conn->query($sql_GSIS_ELA);
$row_GSIS_ELA = $query_GSIS_ELA->fetch_assoc();
if($query_GSIS_ELA->num_rows > 0){
    $GSIS_ELA_value = number_format($row_GSIS_ELA['loan_amount'], 2);
    $GSIS_ELA = $row_GSIS_ELA['loan_amount'];
    $netGSIS_ELA = $GSIS_ELA;
    $totalGSIS_ELA += $netGSIS_ELA;

}else{
    $GSIS_ELA_value ='-';
    $GSIS_ELA = 0; 
    $netGSIS_ELA = $GSIS_ELA;
    $totalGSIS_ELA += $netGSIS_ELA;

}
if($totalGSIS_ELA == 0){
    $totalGSIS_ELA_value = '-';
}else{
    $totalGSIS_ELA_value = number_format($totalGSIS_ELA, 2);
}
//GSIS Opin
$sql_GSIS_Opin = "SELECT * FROM loan_transaction WHERE description = 'GSIS Opin' AND loan_id = '$invoice_id'";
$query_GSIS_Opin = $conn->query($sql_GSIS_Opin);
$row_GSIS_Opin = $query_GSIS_Opin->fetch_assoc();
if($query_GSIS_Opin->num_rows > 0){
    $GSIS_Opin_value = number_format($row_GSIS_Opin['loan_amount'], 2);
    $GSIS_Opin = $row_GSIS_Opin['loan_amount'];
    $netGSIS_Opin = $GSIS_Opin;
    $totalGSIS_Opin += $netGSIS_Opin;

}else{
    $GSIS_Opin_value ='-';
    $GSIS_Opin = 0; 
    $netGSIS_Opin = $GSIS_Opin;
    $totalGSIS_Opin += $netGSIS_Opin;

}
if($totalGSIS_Opin == 0){
    $totalGSIS_Opin_value = '-';
}else{
    $totalGSIS_Opin_value = number_format($totalGSIS_Opin, 2);
}
//GSIS OpLo
$sql_GSIS_OpLo = "SELECT * FROM loan_transaction WHERE description = 'GSIS OpLo' AND loan_id = '$invoice_id'";
$query_GSIS_OpLo = $conn->query($sql_GSIS_OpLo);
$row_GSIS_OpLo = $query_GSIS_OpLo->fetch_assoc();
if($query_GSIS_OpLo->num_rows > 0){
    $GSIS_OpLo_value = number_format($row_GSIS_OpLo['loan_amount'], 2);
    $GSIS_OpLo = $row_GSIS_OpLo['loan_amount'];
    $netGSIS_OpLo = $GSIS_OpLo;
    $totalGSIS_OpLo += $netGSIS_OpLo;

}else{
    $GSIS_OpLo_value ='-';
    $GSIS_OpLo = 0; 
    $netGSIS_OpLo = $GSIS_OpLo;
    $totalGSIS_OpLo += $netGSIS_OpLo;

}
if($totalGSIS_OpLo == 0){
    $totalGSIS_OpLo_value = '-';
}else{
    $totalGSIS_OpLo_value = number_format($totalGSIS_OpLo, 2);
}

//GSIS GFAL
$sql_GSIS_GFAL = "SELECT * FROM loan_transaction WHERE description = 'GSIS GFAL' AND loan_id = '$invoice_id'";
$query_GSIS_GFAL = $conn->query($sql_GSIS_GFAL);
$row_GSIS_GFAL = $query_GSIS_GFAL->fetch_assoc();
if($query_GSIS_GFAL->num_rows > 0){
    $GSIS_GFAL_value = number_format($row_GSIS_GFAL['loan_amount'], 2);
    $GSIS_GFAL = $row_GSIS_GFAL['loan_amount'];
    $netGSIS_GFAL = $GSIS_GFAL;
    $totalGSIS_GFAL += $netGSIS_GFAL;

}else{
    $GSIS_GFAL_value ='-';
    $GSIS_GFAL = 0; 
    $netGSIS_GFAL = $GSIS_GFAL;
    $totalGSIS_GFAL += $netGSIS_GFAL;

}
if($totalGSIS_GFAL == 0){
    $totalGSIS_GFAL_value = '-';
}else{
    $totalGSIS_GFAL_value = number_format($totalGSIS_GFAL, 2);
}

//GSIS HIP
$sql_GSIS_HIP = "SELECT * FROM loan_transaction WHERE description = 'GSIS HIP' AND loan_id = '$invoice_id'";
$query_GSIS_HIP = $conn->query($sql_GSIS_HIP);
$row_GSIS_HIP = $query_GSIS_HIP->fetch_assoc();
if($query_GSIS_HIP->num_rows > 0){
    $GSIS_HIP_value = number_format($row_GSIS_HIP['loan_amount'], 2);
    $GSIS_HIP = $row_GSIS_HIP['loan_amount'];
    $netGSIS_HIP = $GSIS_HIP;
    $totalGSIS_HIP += $netGSIS_HIP;

}else{
    $GSIS_HIP_value ='-';
    $GSIS_HIP = 0; 
    $netGSIS_HIP = $GSIS_HIP;
    $totalGSIS_HIP += $netGSIS_HIP;

}
if($totalGSIS_HIP == 0){
    $totalGSIS_HIP_value = '-';
}else{
    $totalGSIS_HIP_value = number_format($totalGSIS_HIP, 2);
}
//GSIS CPL
$sql_GSIS_CPL = "SELECT * FROM loan_transaction WHERE description = 'GSIS CPL' AND loan_id = '$invoice_id'";
$query_GSIS_CPL = $conn->query($sql_GSIS_CPL);
$row_GSIS_CPL = $query_GSIS_CPL->fetch_assoc();
if($query_GSIS_CPL->num_rows > 0){
    $GSIS_CPL_value = number_format($row_GSIS_CPL['loan_amount'], 2);
    $GSIS_CPL = $row_GSIS_CPL['loan_amount'];
    $netGSIS_CPL = $GSIS_CPL;
    $totalGSIS_CPL += $netGSIS_CPL;

}else{
    $GSIS_CPL_value ='-';
    $GSIS_CPL = 0; 
    $netGSIS_CPL = $GSIS_CPL;
    $totalGSIS_CPL += $netGSIS_CPL;

}
if($totalGSIS_CPL == 0){
    $totalGSIS_CPL_value = '-';
}else{
    $totalGSIS_CPL_value = number_format($totalGSIS_CPL, 2);
}

//GSIS SOS
$sql_GSIS_SOS = "SELECT * FROM loan_transaction WHERE description = 'GSIS SOS' AND loan_id = '$invoice_id'";
$query_GSIS_SOS = $conn->query($sql_GSIS_SOS);
$row_GSIS_SOS = $query_GSIS_SOS->fetch_assoc();
if($query_GSIS_SOS->num_rows > 0){
    $GSIS_SOS_value = number_format($row_GSIS_SOS['loan_amount'], 2);
    $GSIS_SOS = $row_GSIS_SOS['loan_amount'];
    $netGSIS_SOS = $GSIS_SOS;
    $totalGSIS_SOS += $netGSIS_SOS;

}else{
    $GSIS_SOS_value ='-';
    $GSIS_SOS = 0; 
    $netGSIS_SOS = $GSIS_SOS;
    $totalGSIS_SOS += $netGSIS_SOS;

}
if($totalGSIS_SOS == 0){
    $totalGSIS_SOS_value = '-';
}else{
    $totalGSIS_SOS_value = number_format($totalGSIS_SOS, 2);
}

//GSIS Eplan
$sql_GSIS_Eplan = "SELECT * FROM loan_transaction WHERE description = 'GSIS Eplan' AND loan_id = '$invoice_id'";
$query_GSIS_Eplan = $conn->query($sql_GSIS_Eplan);
$row_GSIS_Eplan = $query_GSIS_Eplan->fetch_assoc();
if($query_GSIS_Eplan->num_rows > 0){
    $GSIS_Eplan_value = number_format($row_GSIS_Eplan['loan_amount'], 2);
    $GSIS_Eplan = $row_GSIS_Eplan['loan_amount'];
    $netGSIS_Eplan = $GSIS_Eplan;
    $totalGSIS_Eplan += $netGSIS_Eplan;

}else{
    $GSIS_Eplan_value ='-';
    $GSIS_Eplan = 0; 
    $netGSIS_Eplan = $GSIS_Eplan;
    $totalGSIS_Eplan += $netGSIS_Eplan;

}
if($totalGSIS_Eplan == 0){
    $totalGSIS_Eplan_value = '-';
}else{
    $totalGSIS_Eplan_value = number_format($totalGSIS_Eplan, 2);
}

//GSIS Ecard
$sql_GSIS_Ecard = "SELECT * FROM loan_transaction WHERE description = 'GSIS Ecard' AND loan_id = '$invoice_id'";
$query_GSIS_Ecard = $conn->query($sql_GSIS_Ecard);
$row_GSIS_Ecard = $query_GSIS_Ecard->fetch_assoc();
if($query_GSIS_Ecard->num_rows > 0){
    $GSIS_Ecard_value = number_format($row_GSIS_Ecard['loan_amount'], 2);
    $GSIS_Ecard = $row_GSIS_Ecard['loan_amount'];
    $netGSIS_Ecard = $GSIS_Ecard;
    $totalGSIS_Ecard += $netGSIS_Ecard;

}else{
    $GSIS_Ecard_value ='-';
    $GSIS_Ecard = 0; 
    $netGSIS_Ecard = $GSIS_Ecard;
    $totalGSIS_Ecard += $netGSIS_Ecard;

}
if($totalGSIS_Ecard == 0){
    $totalGSIS_Ecard_value = '-';
}else{
    $totalGSIS_Ecard_value= number_format($totalGSIS_Ecard, 2);
}

//HDMF MPL
$sql_HDMF_MPL = "SELECT * FROM loan_transaction WHERE description = 'HDMF MPL' AND loan_id = '$invoice_id'";
$query_HDMF_MPL = $conn->query($sql_HDMF_MPL);
$row_HDMF_MPL = $query_HDMF_MPL->fetch_assoc();
if($query_HDMF_MPL->num_rows > 0){
    $HDMF_MPL_value = number_format($row_HDMF_MPL['loan_amount'], 2);
    $HDMF_MPL = $row_HDMF_MPL['loan_amount'];
    $netHDMF_MPL = $HDMF_MPL;
    $totalHDMF_MPL += $netHDMF_MPL;

}else{
    $HDMF_MPL_value ='-';
    $HDMF_MPL = 0; 
    $netHDMF_MPL = $HDMF_MPL;
    $totalHDMF_MPL += $netHDMF_MPL;

}
if($totalHDMF_MPL == 0){
    $totalHDMF_MPL_value = '-';
}else{
    $totalHDMF_MPL_value = number_format($totalHDMF_MPL, 2);
}
//HDMF Res
$sql_HDMF_Res = "SELECT * FROM loan_transaction WHERE description = 'HDMF Res' AND loan_id = '$invoice_id'";
$query_HDMF_Res = $conn->query($sql_HDMF_Res);
$row_HDMF_Res = $query_HDMF_Res->fetch_assoc();
if($query_HDMF_Res->num_rows > 0){
    $HDMF_Res_value = number_format($row_HDMF_Res['loan_amount'], 2);
    $HDMF_Res = $row_HDMF_Res['loan_amount'];
    $netHDMF_Res = $HDMF_Res;
    $totalHDMF_Res += $netHDMF_Res;

}else{
    $HDMF_Res_value ='-';
    $HDMF_Res = 0; 
    $netHDMF_Res = $HDMF_Res;
    $totalHDMF_Res += $netHDMF_Res;

}
if($totalHDMF_Res == 0){
    $totalHDMF_Res_value = '-';
}else{
    $totalHDMF_Res_value = number_format($totalHDMF_Res, 2);
}

//LBP
$sql_LBP = "SELECT * FROM loan_transaction WHERE description = 'LBP' AND loan_id = '$invoice_id'";
$query_LBP = $conn->query($sql_LBP);
$row_LBP = $query_LBP->fetch_assoc();
if($query_LBP->num_rows > 0){
    $LBP_value = number_format($row_LBP['loan_amount'], 2);
    $LBP = $row_LBP['loan_amount'];
    $netLBP = $LBP;
    $totalLBP += $netLBP;

}else{
    $LBP_value ='-';
    $LBP = 0; 
    $netLBP = $LBP;
    $totalLBP += $netLBP;

}
if($totalLBP == 0){
    $totalLBP_value = '-';
}else{
    $totalLBP_value = number_format($totalLBP, 2);
}


//TUPM-Cd
$sql_TUPM_Cd = "SELECT * FROM loan_transaction WHERE description = 'TUPM-Cd' AND loan_id = '$invoice_id'";
$query_TUPM_Cd = $conn->query($sql_TUPM_Cd);
$row_TUPM_Cd = $query_TUPM_Cd->fetch_assoc();
if($query_TUPM_Cd->num_rows > 0){
    $TUPM_Cd_value = number_format($row_TUPM_Cd['loan_amount'], 2);
    $TUPM_Cd = $row_TUPM_Cd['loan_amount'];
    $netTUPM_Cd = $TUPM_Cd;
    $totalTUPM_Cd += $netTUPM_Cd;

}else{
    $TUPM_Cd_value ='-';
    $TUPM_Cd = 0; 
    $netTUPM_Cd = $TUPM_Cd;
    $totalTUPM_Cd += $netTUPM_Cd;

}
if($totalTUPM_Cd == 0){
    $totalTUPM_Cd_value = '-';
}else{
    $totalTUPM_Cd_value = number_format($totalTUPM_Cd, 2);
}

//Fin Ass
$sql_Fin_Ass = "SELECT * FROM loan_transaction WHERE description = 'Fin Ass' AND loan_id = '$invoice_id'";
$query_Fin_Ass = $conn->query($sql_Fin_Ass);
$row_Fin_Ass = $query_Fin_Ass->fetch_assoc();
if($query_Fin_Ass->num_rows > 0){
    $Fin_Ass_value = number_format($row_Fin_Ass['loan_amount'], 2);
    $Fin_Ass = $row_Fin_Ass['loan_amount'];
    $netFin_Ass = $Fin_Ass;
    $totalFin_Ass += $netFin_Ass;

}else{
    $Fin_Ass_value ='-';
    $Fin_Ass = 0; 
    $netFin_Ass = $Fin_Ass;
    $totalFin_Ass += $netFin_Ass;

}
if($totalFin_Ass == 0){
    $totalFin_Ass_value = '-';
}else{
    $totalFin_Ass_value = number_format($totalFin_Ass, 2);
}

//GSIS Educ
$sql_GSIS_Educ = "SELECT * FROM loan_transaction WHERE description = 'GSIS Educ' AND loan_id = '$invoice_id'";
$query_GSIS_Educ = $conn->query($sql_GSIS_Educ);
$row_GSIS_Educ = $query_GSIS_Educ->fetch_assoc();
if($query_GSIS_Educ->num_rows > 0){
    $GSIS_Educ_value = number_format($row_GSIS_Educ['loan_amount'], 2);
    $GSIS_Educ = $row_GSIS_Educ['loan_amount'];
    $netGSIS_Educ = $GSIS_Educ;
    $totalGSIS_Educ += $netGSIS_Educ;

}else{
    $GSIS_Educ_value ='-';
    $GSIS_Educ = 0; 
    $netGSIS_Educ = $GSIS_Educ;
    $totalGSIS_Educ += $netGSIS_Educ;

}
if($totalGSIS_Educ == 0){
    $totalGSIS_Educ_value = '-';
}else{
    $totalGSIS_Educ_value = number_format($totalGSIS_Educ, 2);
}

//TUPAEA
$sql_TUPAEA = "SELECT * FROM loan_transaction WHERE description = 'TUPAEA' AND loan_id = '$invoice_id'";
$query_TUPAEA = $conn->query($sql_TUPAEA);
$row_TUPAEA = $query_TUPAEA->fetch_assoc();
if($query_TUPAEA->num_rows > 0){
    $TUPAEA_value = number_format($row_TUPAEA['loan_amount'], 2);
    $TUPAEA = $row_TUPAEA['loan_amount'];
    $netTUPAEA = $TUPAEA;
    $totalTUPAEA += $netTUPAEA;

}else{
    $TUPAEA_value ='-';
    $TUPAEA = 0; 
    $netTUPAEA = $TUPAEA;
    $totalTUPAEA += $netTUPAEA;

}
if($totalTUPAEA == 0){
    $totalTUPAEA_value = '-';
}else{
    $totalTUPAEA_value = number_format($totalTUPAEA, 2);
}

//TUPFA
$sql_TUPFA = "SELECT * FROM loan_transaction WHERE description = 'TUPFA' AND loan_id = '$invoice_id'";
$query_TUPFA = $conn->query($sql_TUPFA);
$row_TUPFA = $query_TUPFA->fetch_assoc();
if($query_TUPFA->num_rows > 0){
    $TUPFA_value = number_format($row_TUPFA['loan_amount'], 2);
    $TUPFA = $row_TUPFA['loan_amount'];
    $netTUPFA = $TUPFA;
    $totalTUPFA += $netTUPFA;

}else{
    $TUPFA_value ='-';
    $TUPFA = 0; 
    $netTUPFA = $TUPFA;
    $totalTUPFA += $netTUPFA;

}
if($totalTUPFA == 0){
    $totalTUPFA_value = '-';
}else{
    $totalTUPFA_value = number_format($totalTUPFA, 2);
}

//HDMF Eme
$sql_HDMF_Eme = "SELECT * FROM loan_transaction WHERE description = 'HDMF Eme' AND loan_id = '$invoice_id'";
$query_HDMF_Eme = $conn->query($sql_HDMF_Eme);
$row_HDMF_Eme = $query_HDMF_Eme->fetch_assoc();
if($query_HDMF_Eme->num_rows > 0){
    $HDMF_Eme_value = number_format($row_HDMF_Eme['loan_amount'], 2);
    $HDMF_Eme = $row_HDMF_Eme['loan_amount'];
    $netHDMF_Eme = $HDMF_Eme;
    $totalHDMF_Eme += $netHDMF_Eme;

}else{
    $HDMF_Eme_value ='-';
    $HDMF_Eme = 0; 
    $netHDMF_Eme = $HDMF_Eme;
    $totalHDMF_Eme += $netHDMF_Eme;

}
if($totalHDMF_Eme == 0){
    $totalHDMF_Eme_value = '-';
}else{
    $totalHDMF_Eme_value = number_format($totalHDMF_Eme, 2);
}

			//total deduction per employee
			$totaldeduction_per_employee = $Disallowance +$RefSal+$Ref_Ocom
			+ $NHMC+ $MP2+ $GSIS_MPL+ $GSIS_Sal+ $GSIS_Pol+ $GSIS_ELA+ $GSIS_Opin
			+ $GSIS_OpLo+ $GSIS_GFAL+ $GSIS_HIP+ $GSIS_CPL+ $GSIS_SOS+ $GSIS_Eplan
			+ $HDMF_MPL+ $LBP+ $TUPM_Cd
			+ $Fin_Ass+ $GSIS_Educ+ $TUPAEA+ $TUPFA+ $HDMF_Eme;

			//total deduction
			$totaldeduction = $totaldeduction_per_employee;
			$totaldeduction += $totaldeduction;
			
			
			 

			


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
		<td border="1" align="center">'.$no++.'</td>
		<td border="1" align="left">'.$row['employee_name'].'<br><br>STEP '.$step.'<br><br>SG '.$sg.'</td>
		
		<td border="1" align="left">'.$position.'<br><br>'.$step.'<br><br>'.$sg.'</td>

		<td border="1" align="center">'.$row['employee_id'].'</td>


		
		<td class="bottom-border" align="center"><b>@<br>#<br>.<br>&<br>!</b></td>
		<td class="bottom-border right-border"  align="right"><b>'.$Disallowance_value.'<br>'.$RefSal_value.'<br>'.$Ref_Ocom_value.'<br>'.$NHMC_value.'<br>'.$MP2_value.'</b></td>

		<td class="bottom-border" align="center"><b>a<br>b<br>c<br>d<br>e</b></td>
		<td class="bottom-border right-border" align="right"><b>'.number_format($total_gsis_total, 2).'<br>'.number_format($total_w_tax_total, 2).'<br>'.number_format($total_eeph, 2).'<br>'.$GSIS_MPL_value.'<br>'.$GSIS_Sal_value.'</b></td>

		<td class="bottom-border" align="center"><b>f<br>g<br>h<br>i<br>j</b></td>
		<td class="bottom-border right-border"  align="right"><b>'.$GSIS_Pol_value.'<br>'.$GSIS_ELA_value.'<br>'.$GSIS_Opin_value.'<br>'.$GSIS_OpLo_value.'<br>'.$GSIS_GFAL_value.'</b></td>

		<td class="bottom-border" align="center"><b>k<br>l<br>m<br>n<br>o</b></td>
		<td class="bottom-border right-border"  align="right"><b>'.$GSIS_HIP_value.'<br>'.$GSIS_CPL_value.'<br>'.$GSIS_SOS_value.'<br>'.$GSIS_Eplan_value.'<br>'.$GSIS_Ecard_value.'</b></td>

		<td class="bottom-border" align="center"><b>p<br>q<br>r<br>s<br>t</b></td>
		<td class="bottom-border right-border" align="right"><b>'.$HDMF_MPL_value.'<br>'.$HDMF_Res_value.'<br>'.number_format($total_eep, 2).'<br>'.$LBP_value.'<br>'.$TUPM_Cd_value.'</b></td>

		<td class="bottom-border" align="center"><b>u<br>v<br>w<br>x<br>y</b></td>
		<td class="bottom-border right-border"  align="right"><b>'.$Fin_Ass_value.'<br>'.$GSIS_Educ_value.'<br>'.$TUPAEA_value.'<br>'.$TUPFA_value.'<br>'.$HDMF_Eme_value.'</b></td>

		
		<td border="1" width="10%" align="right">'.number_format($totaldeduction_db, 2).'</td>
		

		

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
			<td border="1"  align="center"></td>
			<td border="1"  align="center">SHEET TOTAL</td>
			
			<td border="1" align="center">-</td>

			<td border="1"  align="center"></td>
			
			

			
			<td class="bottom-border" align="center"><b>@<br>#<br>.<br>&<br>!</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalDisallowance_value.'<br>'.$totalRefSal_value.'<br>'.$totalRef_Ocom_value.'<br>'.$totalNHMC_value.'<br>'.$totalMP2_value.'</b></td>

			<td class="bottom-border" align="center"><b>a<br>b<br>c<br>d<br>e</b></td>
			<td class="bottom-border right-border" align="right"><b>'.number_format($totaltotal_gsis_total_db_per_employee, 2).'<br>'.number_format($totaltotal_w_tax_total_db_per_employee, 2).'<br>'.number_format($totaltotal_eeph_db_per_employee, 2).'<br>'.$totalGSIS_MPL_value.'<br>'.$totalGSIS_Sal_value.'</b></td>

			<td class="bottom-border" align="center"><b>f<br>g<br>h<br>i<br>j</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalGSIS_Pol_value.'<br>'.$totalGSIS_ELA_value.'<br>'.$totalGSIS_Opin_value.'<br>'.$totalGSIS_OpLo_value.'<br>'.$totalGSIS_GFAL_value.'</b></td>

			<td class="bottom-border" align="center"><b>k<br>l<br>m<br>n<br>o</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalGSIS_HIP_value.'<br>'.$totalGSIS_CPL_value.'<br>'.$totalGSIS_SOS_value.'<br>'.$totalGSIS_Eplan_value.'<br>'.$totalGSIS_Ecard_value.'</b></td>

			<td class="bottom-border" align="center"><b>p<br>q<br>r<br>s<br>t</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalHDMF_MPL_value.'<br>'.$totalHDMF_Res_value.'<br>'.number_format($totaltotal_eep_db_per_employee, 2).'<br>'.$totalLBP_value.'<br>'.$totalTUPM_Cd_value.'</b></td>

			<td class="bottom-border" align="center"><b>u<br>v<br>w<br>x<br>y</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalFin_Ass_value.'<br>'.$totalGSIS_Educ_value.'<br>'.$totalTUPAEA_value.'<br>'.$totalTUPFA_value.'<br>'.$totalHDMF_Eme_value.'</b></td>

			
			<td border="1" width="10%" align="right">'.number_format($totaldeduction_db_per_employee, 2).'</td>
			

		
		</tr>';
				//footer
				
           // Reset subtotal net pay for the next set of four rows
		   $totalSalary = 0;
		   $totalMonthly_Salary = 0; 
		   
		   $totaldeduction_db_per_employee =0;
		   $totalallowance_db_per_employee = 0;
	   
		   //total loan
		   $totalDisallowance =0;
		   $totaldeduction_per_employee = 0;
		   
		   //loan
		   $totaldeduction = 0;
		   $totalRefSal = 0;
		   $totalRef_Ocom =0;
		   $totalNHMC =0;
		   $totalMP2 =0;
		   $totalGSIS_MPL =0;
		   $totalGSIS_Sal =0;
		   $totalGSIS_Pol =0;
		   $totalGSIS_ELA =0;
		   $totalGSIS_Opin =0;
		   $totalGSIS_OpLo =0;
		   $totalGSIS_GFAL =0;
		   $totalGSIS_HIP =0;
		   $totalGSIS_CPL =0;
		   $totalGSIS_SOS =0;
		   $totalGSIS_Eplan =0;
		   $totalGSIS_Ecard =0;
		   $totalHDMF_MPL =0;
		   $totalHDMF_Res =0;
		   $totalLBP =0;
		   $totalTUPM_Cd =0;
		   $totalFin_Ass =0;
		   $totalGSIS_Educ =0;
		   $totalTUPAEA =0;
		   $totalTUPFA =0;
		   $totalHDMF_Eme =0;
	   
	   
	   
		   //first and second 
		   $totalfirst_half_db_per_employee = 0;
		   $totalsecond_half_db_per_employee = 0;
	   
		   //Mandatory deduction
		   $totaltotal_gsis_total_db_per_employee = 0;
		   $totaltotal_w_tax_total_db_per_employee = 0;
		   $totaltotal_eeph_db_per_employee = 0;
		   $totaltotal_eep_db_per_employee = 0;
			
			$html .= '</table>';
            $pdf->writeHTML($html); // Write HTML content to PDF
            $pdf->AddPage(); // Add a new page after the subtotal
            // Reset HTML content for the new page
            $html = '
    <h2 align="center">POWERED BY EZ PAYROLL SYSTEM<br>DEDUCTION AND LOAN RECORDS</h2>
    <p align="center"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES<br>
    Ayala Blvd. Ermita, Manila<br>
    For the period </b></p>
    <h4 align="left">We acknowledge receipt of cash shown opposite names as full comppensation for services rendered for the period covered.<br>
    <b>ADMINISTRATIVE SECTOR</b></h4>
    <table border="0" cellspacing="0" cellpadding="3">
	<tr>  
	<th border="1" width="5%" rowspan="2" align="center"><b><br><br><br><br>NO</b></th>
	<th border="1" width="10%" rowspan="2" align="center"><b><br><br><br><br>NAME</b></th>
	<th border="1" width="10%" rowspan="2" align="center"><b><br><br><br><br>POSITION</b></th>
	<th border="1" width="8%" rowspan="2" align="center"><b><br><br><br><br>EMPLO<br>YEE <br>NO</b></th>
	<th border="1" width="60%" rowspan="1" colspan="7" align="center" ><b><br><br>DEDUCTIONS</b></th>
	
	<th border="1" width="10%" rowspan="2" align="center" ><b><br><br><br><br>TOTAL<br>DEDUCTIONS</b></th>
	
</tr>

<tr>
		

		<th class="bottom-border" width="3%" align="center"><b>@<br>#<br>.<br>&<br>!</b></th>
		<th class="bottom-border right-border" width="7%"><b>Disallowance<br>Ref-Sal<br>Ref-Ocom<br>NHMC<br>MP2</b></th>

		<th class="bottom-border" width="3%" align="center"><b>a<br>b<br>c<br>d<br>e</b></th>
		<th class="bottom-border right-border" width="7%"><b>Integ-Ins<br>W/tax<br>Philhealth<br>GSIS MPL<br>GSIS Sal</b></th>

		<th class="bottom-border" width="3%" align="center"><b>f<br>g<br>h<br>i<br>j</b></th>
		<th class="bottom-border right-border" width="7%"><b>GSIS Pol<br>GSIS ELA<br>GSIS Opin<br>GSIS OpLo<br>GSIS GFAL</b></th>

		<th class="bottom-border" width="3%" align="center"><b>k<br>l<br>m<br>n<br>o</b></th>
		<th class="bottom-border right-border" width="7%"><b>GSIS HIP<br>GSIS CPL<br>GSIS SOS<br>GSIS Eplan<br>GSIS Ecard</b></th>

		<th  class="bottom-border" width="3%" align="center"><b>p<br>q<br>r<br>s<br>t</b></th>
		<th class="bottom-border right-border" width="7%"><b>HDMF MPL<br>H\'DMF Res<br>HDMF Con<br>LBP<br>TUPM-Cd</b></th>

		<th  class="bottom-border" width="3%" align="center"><b>u<br>v<br>w<br>x<br>y</b></th>
		<th class="bottom-border right-border" width="7%"><b>Fin Ass<br>GSIS Educ<br>TUPAEA<br>TUPFA<br>HDMF Eme</b></th>

	

		
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
			<td border="1"  align="center"></td>
			<td border="1"  align="center">SHEET TOTAL</td>
			
			<td border="1" align="center">-</td>

			<td border="1"  align="center"></td>
			
		

			
			<td class="bottom-border" align="center"><b>@<br>#<br>.<br>&<br>!</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalDisallowance_value.'<br>'.$totalRefSal_value.'<br>'.$totalRef_Ocom_value.'<br>'.$totalNHMC_value.'<br>'.$totalMP2_value.'</b></td>

			<td class="bottom-border" align="center"><b>a<br>b<br>c<br>d<br>e</b></td>
			<td class="bottom-border right-border" align="right"><b>'.number_format($totaltotal_gsis_total_db_per_employee, 2).'<br>'.number_format($totaltotal_w_tax_total_db_per_employee, 2).'<br>'.number_format($totaltotal_eeph_db_per_employee, 2).'<br>'.$totalGSIS_MPL_value.'<br>'.$totalGSIS_Sal_value.'</b></td>

			<td class="bottom-border" align="center"><b>f<br>g<br>h<br>i<br>j</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalGSIS_Pol_value.'<br>'.$totalGSIS_ELA_value.'<br>'.$totalGSIS_Opin_value.'<br>'.$totalGSIS_OpLo_value.'<br>'.$totalGSIS_GFAL_value.'</b></td>

			<td class="bottom-border" align="center"><b>k<br>l<br>m<br>n<br>o</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalGSIS_HIP_value.'<br>'.$totalGSIS_CPL_value.'<br>'.$totalGSIS_SOS_value.'<br>'.$totalGSIS_Eplan_value.'<br>'.$totalGSIS_Ecard_value.'</b></td>

			<td class="bottom-border" align="center"><b>p<br>q<br>r<br>s<br>t</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalHDMF_MPL_value.'<br>'.$totalHDMF_Res_value.'<br>'.number_format($totaltotal_eep_db_per_employee, 2).'<br>'.$totalLBP_value.'<br>'.$totalTUPM_Cd_value.'</b></td>

			<td class="bottom-border" align="center"><b>u<br>v<br>w<br>x<br>y</b></td>
			<td class="bottom-border right-border" align="right"><b>'.$totalFin_Ass_value.'<br>'.$totalGSIS_Educ_value.'<br>'.$totalTUPAEA_value.'<br>'.$totalTUPFA_value.'<br>'.$totalHDMF_Eme_value.'</b></td>

			
			<td border="1" width="10%" align="right">'.number_format($totaldeduction_db_per_employee, 2).'</td>
			

		
		</tr>';
		//footer
		
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
generateRow($conn, $pdf);  

$pdf->Output('deduction_and_loan_records.pdf', 'I');
?>
