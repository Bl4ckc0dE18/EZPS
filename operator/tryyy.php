<?php
if (isset($_POST['employee'])) {
    $output = array('error' => false);
    $output['time'] = 'Time in : ';
   
}
else{
    $output['error'] = true;
    $output['message'] = 'Location Data Not Available';
}


echo json_encode($output);
?>
