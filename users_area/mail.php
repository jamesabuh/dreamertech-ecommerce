<?php
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

        
function send_mail($recipient,$subject,$message)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->SMTPDebug = 0;
    $mail->SMTPAuth  = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       =  465;
    $mail->Host       = "localhost";
// $mail->Host       = "smtp.mail.yahoo.com";
    $mail->Username   = "info@dreamer.com.ng";
    $mail->Password   = "0j8a0m2e9s";

    $mail->IsHTML(true);
    $mail->AddAddress($recipient, "Dear-value-customer");
    $mail->SetFrom("info@dreamer.com.ng", "My website");   
     $mail->Subject = $subject;
    $content = $message;

    $mail->MsgHTML($content);
    if(!$mail->send()){
            echo "Error while sending Email.";
            echo "<pre>";
            echo var_dump($email);
        return "false"; 
    }else{
        return true;
    }
    
}    
?>