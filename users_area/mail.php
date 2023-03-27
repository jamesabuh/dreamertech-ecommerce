<?php
    
    use PHPMailer\PHPMailer\PHPMailer;
    

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

        
function send_mail($recipient,$subject,$message)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->SMTPDebug = 0;
    $mail->SMTPAuth  = FALSE;
    $mail->SMTPSecure = "tls";
    $mail->Port       =  587;
    $mail->Host       = "relay.sendinblue.com";
// $mail->Host       = "smtp.mail.yahoo.com";
    $mail->Username   = "dreamertech6@gmail.com";
    $mail->Password   = "02KV5BJCjvAnd8PX";

    $mail->IsHTML(true);
    $mail->AddAddress($recipient, "Dear-value-customer");
    $mail->SetFrom("dreamertech6@gmail.com", "My website");   
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