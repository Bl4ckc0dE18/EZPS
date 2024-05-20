<?php 
$totalDisallowance =0;
$totalRef_Ocom =0;



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



////////////////////////////
//Ref-Ocom
$sql_Ref_Ocom = "SELECT * FROM loan_transaction WHERE description = 'Ref-Ocom' AND loan_id = '$invoice_id'";
$query_Ref_Ocom = $conn->query($sql_Ref_Ocom);
$row_Ref_Ocom = $query_Disallowance->fetch_assoc();
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



?>