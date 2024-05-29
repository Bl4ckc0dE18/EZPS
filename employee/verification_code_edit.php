<?php
$timezone = 'Asia/Manila';
date_default_timezone_set($timezone);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

include 'includes/conn.php';
$output = array('error' => false);

if (isset($_POST['employee_id_vc'])) {
    // $output['message'] = 'Code has been sent';
    $employee_id_vc = $_POST['employee_id_vc'];
    $email_vc = $_POST['email_vc'];
    $code_vc = $_POST['code_vc'];
    $password =  password_hash($_POST['password_vc'], PASSWORD_DEFAULT);

    $currentDateTime = date('H:i:s', time());

    $sql = "SELECT * FROM verification_code WHERE employee_id = '$employee_id_vc' 
    AND email= '$email_vc'
    AND code= '$code_vc'";

    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if ($query->num_rows > 0) {
        $idvs = $row['id'];
        $time_db = $row['time_code'];
        if ($time_db < $currentDateTime) {
            $output['error'] = true;
            $output['message'] = 'Invalid Verifications';
        } else {
            
            $sqles = "SELECT * FROM employees WHERE employee_id = '$employee_id_vc'";
            $queryes = $conn->query($sqles);
            $rowes = $queryes->fetch_assoc();
            
            if ($queryes->num_rows > 0) {
                
                $ides = $rowes['id'];
                $name = $rowes['firstname'] . ' ' . $rowes['lastname'];
                $sqlp = "UPDATE employees SET password = '$password' WHERE id = '$ides'";
                
                    if ($conn->query($sqlp)) {
                        $output['message'] = 'Password Change';
                        $sqld = "DELETE FROM verification_code WHERE id = '$idvs'";
                        if ($conn->query($sqld)) {
                            $subject = 'Password Changed Successfully';
                            $message = '<p style="color: black;">Dear ' . $name . ',</p><br><br><br>
                            <p style="color: black;">Your password for your EZ PAYROLL SYSTEM account has been successfully changed.</p><br>
                            <p style="color: black;">If you did not initiate this change, please contact us immediately.</p><br>
                            <p style="color: black;">For further assistance, please visit our website or contact our support team.</p><br>
                            <p style="color: black;">Thank you for choosing EZ PAYROLL SYSTEM.</p><br>
                            <p style="color: black;">Best regards,<br>Team EZ PAYROLL SYSTEM</p><br>';
                
                            
                
                                
                                // Initialize PHPMailer
                                $mail = new PHPMailer(true);
                                
                                // SMTP configuration
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                                $mail->SMTPAuth = true;
                                $mail->Username = 'ezpayrollsystem.tech@gmail.com'; // Your SMTP username
                                $mail->Password = 'vgvgxnvbyknfqpxx'; // Your SMTP password
                                $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
                                $mail->Port = 465; // TCP port to connect to
                
                                // Set sender and recipient
                                $mail->setFrom('ezpayrollsystem.tech@gmail.com');
                                $mail->addAddress($email_vc);
                
                                // Content
                                $mail->isHTML(true);
                                $mail->Subject = $subject;
                                $mail->Body = $message;
                
                                // Send email
                                if($mail->send()){                               
                                    $output['message'] = 'Password Change';
                                }else{
                                    $output['error'] = true;
                                    $output['message'] = 'Please try again later.';
                                }
                            
                        } else {
                            $output['error'] = true;
                            $output['message'] = $conn->error;
                        }
                    } else {
                        $output['error'] = true;
                        $output['message'] = $conn->error;
                    }/**/

            }
            else {
                    $output['error'] = true;
                    $output['message'] = $conn->error;
                }
            
        }
    } else {
        $output['error'] = true;
        $output['message'] = 'Invalid Verification';
    }
} else {
    $output['error'] = true;
    $output['message'] = 'Fill up add form first';
}

echo json_encode($output);

?>
