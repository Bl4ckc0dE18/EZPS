<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$timezone = 'Asia/Manila';
date_default_timezone_set($timezone);
// Include PHPMailer autoload file
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
include 'includes/conn.php';
$output = array('error'=>false);

if(isset($_POST['username_fp'])){
    $username_fp = $_POST['username_fp'];
    $email_fp = $_POST['email_fp'];

    $sql = "SELECT * FROM employees WHERE employee_id = '$username_fp' AND email= '$email_fp'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    
    if ($query->num_rows > 0) {
    
            $name = $row['firstname'].' '.$row['lastname'];
            $set = '1234567890';
            $randomNumber = substr(str_shuffle($set), 0, 6);
            $currentDateTime = date('H:i:s', strtotime('+5 minutes'));
          
            
            $sql_email = "INSERT INTO verification_code (employee_id, email, code,time_code) 
            VALUES ('$username_fp','$email_fp','$randomNumber','$currentDateTime')";

            if($conn->query($sql_email)){
                
                $subject = 'Forgot Password';
                $message = '<p style="color: black;">Dear ' . $name . ',</p>
                <p style="color: black;">Thank you for reaching out regarding your EZ PAYROLL SYSTEM account. We\'re here to assist you in resetting your password.</p>
                <p style="color: black;">To proceed, please use the following verification code to verify your identity.</p>
                <p><strong style="color: black;">Verification Code: [' . $randomNumber . ']</strong></p>
                <p style="color: black;">This code can only be used once and will expire in 5 minutes.</p>
                <p><a href="https://www.example.com/change-password" style="color: black;">Click here to change your password.</a></p>
                <p style="color: black;">Please use this code within the designated field to complete the password reset process.</p>
                <p style="color: black;">If you did not initiate this request, please disregard this email. Your account security is important to us.</p>
                <p style="color: black;">Thank you for choosing EZ PAYROLL SYSTEM,</p>
                <p style="color: black;">Best regards,<br>Team EZ PAYROLL SYSTEM</p>';

                
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
                $mail->addAddress($email_fp);

                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;

                // Send email
                if($mail->send()){
                    $output['message'] = 'Code has been sent';
                    
                }else{
                    $output['error'] = true;
                    $output['message'] = 'Email could not be sent. Please try again later.';
                }
            }else{
                $output['error'] = true;
                $output['message']  = $conn->error;
            }
    }else{
        $output['error'] = true;
        $output['message'] = 'Cannot find account';
    }  
}else{
    $output['error'] = true;
    $output['message'] = 'Fill up add form first';
}

echo json_encode($output);
?>
