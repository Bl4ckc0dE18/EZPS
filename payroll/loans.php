<?php 
$totalDisallowance =0;
$totalRef_Sal =0;
$totalRef_Ocom =0;
$totalNHMC =0;
$totalMP2 =0;
$totalGSIS_MPL =0;
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


//Disallowance
$sql_Disallowance = "SELECT * FROM loan_transaction WHERE description = 'Disallowance' AND loan_id = '$invoice_id'";
$query_Disallowance = $conn->query($sql_Disallowance);
$row_Disallowance = $query_Disallowance->fetch_assoc();
if($query_Disallowance->num_rows > 0){
    $Disallowance_value = number_format($row_Disallowance['loan_amount'], 2);
    $Disallowance = $row_Disallowance['loan_amount'];
    $netDisallowance = $Disallowance;
    $totalDisallowance += $netDisallowance;

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
$sql_Ref_Sal = "SELECT * FROM loan_transaction WHERE description = 'Ref-Sal' AND loan_id = '$invoice_id'";
$query_Ref_Sal = $conn->query($sql_Ref_Sal);
$row_Ref_Sal = $query_Ref_Sal->fetch_assoc();
if($query_Ref_Sal->num_rows > 0){
    $Ref_Sal_value = number_format($row_Ref_Sal['loan_amount'], 2);
    $Ref_Sal = $row_Ref_Sal['loan_amount'];
    $netRef_Sal = $Ref_Sal;
    $totalRef_Sal += $netRef_Sal;

}else{
    $Ref_Sal_value ='-';
    $Ref_Sal = 0; 
    $netRef_Sal = $Ref_Sal;
    $totalRef_Sal += $netRef_Sal;

}
if($totalRef_Sal == 0){
    $totalRef_Sal_value = '-';
}else{
    $totalRef_Sal_value = number_format($totalRef_Sal, 2);
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
    $GSIS_Ecard = number_format($row_GSIS_Ecard['loan_amount'], 2);
    $GSIS_Ecard = $row_GSIS_Ecard['loan_amount'];
    $netGSIS_Ecard = $GSIS_Ecard;
    $totalGSIS_Ecard += $netGSIS_Ecard;

}else{
    $GSIS_Ecard ='-';
    $GSIS_Ecard = 0; 
    $netGSIS_Ecard = $GSIS_Ecard;
    $totalGSIS_Ecard += $netGSIS_Ecard;

}
if($totalGSIS_Ecard == 0){
    $totalGSIS_Ecard = '-';
}else{
    $totalGSIS_Ecard = number_format($totalGSIS_Ecard, 2);
}

//HDMF MPL
$sql_HDMF_MPL = "SELECT * FROM loan_transaction WHERE description = 'HDMF MPL' AND loan_id = '$invoice_id'";
$query_HDMF_MPL = $conn->query($sql_HDMF_MPL);
$row_HDMF_MPL = $query_HDMF_MPL->fetch_assoc();
if($query_HDMF_MPL->num_rows > 0){
    $HDMF_MPL = number_format($row_HDMF_MPL['loan_amount'], 2);
    $HDMF_MPL = $row_HDMF_MPL['loan_amount'];
    $netHDMF_MPL = $HDMF_MPL;
    $totalHDMF_MPL += $netHDMF_MPL;

}else{
    $HDMF_MPL ='-';
    $HDMF_MPL = 0; 
    $netHDMF_MPL = $HDMF_MPL;
    $totalHDMF_MPL += $netHDMF_MPL;

}
if($totalHDMF_MPL == 0){
    $totalHDMF_MPL = '-';
}else{
    $totalHDMF_MPL = number_format($totalHDMF_MPL, 2);
}

//HDMF Res
$sql_HDMF_Res = "SELECT * FROM loan_transaction WHERE description = 'HDMF Res' AND loan_id = '$invoice_id'";
$query_HDMF_Res = $conn->query($sql_HDMF_Res);
$row_HDMF_Res = $query_HDMF_Res->fetch_assoc();
if($query_HDMF_Res->num_rows > 0){
    $HDMF_Res = number_format($row_HDMF_Res['loan_amount'], 2);
    $HDMF_Res = $row_HDMF_Res['loan_amount'];
    $netHDMF_Res = $HDMF_Res;
    $totalHDMF_Res += $netHDMF_Res;

}else{
    $HDMF_Res ='-';
    $HDMF_Res = 0; 
    $netHDMF_Res = $HDMF_Res;
    $totalHDMF_Res += $netHDMF_Res;

}
if($totalHDMF_Res == 0){
    $totalHDMF_Res = '-';
}else{
    $totalHDMF_Res = number_format($totalHDMF_Res, 2);
}

//LBP
$sql_LBP = "SELECT * FROM loan_transaction WHERE description = 'LBP' AND loan_id = '$invoice_id'";
$query_LBP = $conn->query($sql_LBP);
$row_LBP = $query_LBP->fetch_assoc();
if($query_LBP->num_rows > 0){
    $LBP = number_format($row_LBP['loan_amount'], 2);
    $LBP = $row_LBP['loan_amount'];
    $netLBP = $LBP;
    $totalLBP += $netLBP;

}else{
    $LBP ='-';
    $LBP = 0; 
    $netLBP = $LBP;
    $totalLBP += $netLBP;

}
if($totalLBP == 0){
    $totalLBP = '-';
}else{
    $totalLBP = number_format($totalLBP, 2);
}

//TUPM-Cd
$sql_TUPM_Cd = "SELECT * FROM loan_transaction WHERE description = 'TUPM-Cd' AND loan_id = '$invoice_id'";
$query_TUPM_Cd = $conn->query($sql_TUPM_Cd);
$row_TUPM_Cd = $query_TUPM_Cd->fetch_assoc();
if($query_TUPM_Cd->num_rows > 0){
    $TUPM_Cd = number_format($row_TUPM_Cd['loan_amount'], 2);
    $TUPM_Cd = $row_TUPM_Cd['loan_amount'];
    $netTUPM_Cd = $TUPM_Cd;
    $totalTUPM_Cd += $netTUPM_Cd;

}else{
    $TUPM_Cd ='-';
    $TUPM_Cd = 0; 
    $netTUPM_Cd = $TUPM_Cd;
    $totalTUPM_Cd += $netTUPM_Cd;

}
if($totalTUPM_Cd == 0){
    $totalTUPM_Cd = '-';
}else{
    $totalTUPM_Cd = number_format($totalTUPM_Cd, 2);
}

//Fin Ass
$sql_Fin_Ass = "SELECT * FROM loan_transaction WHERE description = 'Fin Ass' AND loan_id = '$invoice_id'";
$query_Fin_Ass = $conn->query($sql_Fin_Ass);
$row_Fin_Ass = $query_Fin_Ass->fetch_assoc();
if($query_Fin_Ass->num_rows > 0){
    $Fin_Ass = number_format($row_Fin_Ass['loan_amount'], 2);
    $Fin_Ass = $row_Fin_Ass['loan_amount'];
    $netFin_Ass = $Fin_Ass;
    $totalFin_Ass += $netFin_Ass;

}else{
    $Fin_Ass ='-';
    $Fin_Ass = 0; 
    $netFin_Ass = $Fin_Ass;
    $totalFin_Ass += $netFin_Ass;

}
if($totalFin_Ass == 0){
    $totalFin_Ass = '-';
}else{
    $totalFin_Ass = number_format($totalFin_Ass, 2);
}

//GSIS Educ
$sql_GSIS_Educ = "SELECT * FROM loan_transaction WHERE description = 'GSIS Educ' AND loan_id = '$invoice_id'";
$query_GSIS_Educ = $conn->query($sql_GSIS_Educ);
$row_GSIS_Educ = $query_GSIS_Educ->fetch_assoc();
if($query_GSIS_Educ->num_rows > 0){
    $GSIS_Educ = number_format($row_GSIS_Educ['loan_amount'], 2);
    $GSIS_Educ = $row_GSIS_Educ['loan_amount'];
    $netGSIS_Educ = $GSIS_Educ;
    $totalGSIS_Educ += $netGSIS_Educ;

}else{
    $GSIS_Educ ='-';
    $GSIS_Educ = 0; 
    $netGSIS_Educ = $GSIS_Educ;
    $totalGSIS_Educ += $netGSIS_Educ;

}
if($totalGSIS_Educ == 0){
    $totalGSIS_Educ = '-';
}else{
    $totalGSIS_Educ = number_format($totalGSIS_Educ, 2);
}

//TUPAEA
$sql_TUPAEA = "SELECT * FROM loan_transaction WHERE description = 'TUPAEA' AND loan_id = '$invoice_id'";
$query_TUPAEA = $conn->query($sql_TUPAEA);
$row_TUPAEA = $query_TUPAEA->fetch_assoc();
if($query_TUPAEA->num_rows > 0){
    $TUPAEA = number_format($row_TUPAEA['loan_amount'], 2);
    $TUPAEA = $row_TUPAEA['loan_amount'];
    $netTUPAEA = $TUPAEA;
    $totalTUPAEA += $netTUPAEA;

}else{
    $TUPAEA ='-';
    $TUPAEA = 0; 
    $netTUPAEA = $TUPAEA;
    $totalTUPAEA += $netTUPAEA;

}
if($totalTUPAEA == 0){
    $totalTUPAEA = '-';
}else{
    $totalTUPAEA = number_format($totalTUPAEA, 2);
}

//TUPFA
$sql_TUPFA = "SELECT * FROM loan_transaction WHERE description = 'TUPFA' AND loan_id = '$invoice_id'";
$query_TUPFA = $conn->query($sql_TUPFA);
$row_TUPFA = $query_TUPFA->fetch_assoc();
if($query_TUPFA->num_rows > 0){
    $TUPFA = number_format($row_TUPFA['loan_amount'], 2);
    $TUPFA = $row_TUPFA['loan_amount'];
    $netTUPFA = $TUPFA;
    $totalTUPFA += $netTUPFA;

}else{
    $TUPFA ='-';
    $TUPFA = 0; 
    $netTUPFA = $TUPFA;
    $totalTUPFA += $netTUPFA;

}
if($totalTUPFA == 0){
    $totalTUPFA = '-';
}else{
    $totalTUPFA = number_format($totalTUPFA, 2);
}

//HDMF Eme
$sql_HDMF_Eme = "SELECT * FROM loan_transaction WHERE description = 'HDMF Eme' AND loan_id = '$invoice_id'";
$query_HDMF_Eme = $conn->query($sql_HDMF_Eme);
$row_HDMF_Eme = $query_HDMF_Eme->fetch_assoc();
if($query_HDMF_Eme->num_rows > 0){
    $HDMF_Eme = number_format($row_HDMF_Eme['loan_amount'], 2);
    $HDMF_Eme = $row_HDMF_Eme['loan_amount'];
    $netHDMF_Eme = $HDMF_Eme;
    $totalHDMF_Eme += $netHDMF_Eme;

}else{
    $HDMF_Eme ='-';
    $HDMF_Eme = 0; 
    $netHDMF_Eme = $HDMF_Eme;
    $totalHDMF_Eme += $netHDMF_Eme;

}
if($totalHDMF_Eme == 0){
    $totalHDMF_Eme = '-';
}else{
    $totalHDMF_Eme = number_format($totalHDMF_Eme, 2);
}

?>