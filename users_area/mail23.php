<?php
       use PHPMailer\PHPMailer\PHPMailer;
       use PHPMailer\PHPMailer\Exception;

       require 'PHPMailer-master/src/Exception.php';
       require 'PHPMailer-master/src/PHPMailer.php';
       require 'PHPMailer-master/src/SMTP.php';


function send_mail($recipient, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = 'smtp.mail.yahoo.com';
        $mail->Port = 587;  
        $mail->Username = 'dreamertech6@gmail.com';
        $mail->Password = 'mtn66666';   
   
   //   $path = 'reseller.pdf';
   //   $mail->AddAttachment($path);
   
        $mail->IsHTML(true);
        $mail->From="dreamertech6@gmail.com";
        $mail->FromName="website";
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($recipient);
        if(!$mail->Send())
        {
            $error ="Please try Later, Error Occured while Processing...";
            return $error; 
        }
        else 
        {
            $error = "Thanks You !! Your email is sent.";  
            return $error;
        }
    }
    
    $to   = '$recipient';
    $from = '$michealjames12311@yahoo.com';
    $name = 'website';
    $subj = 'PHPMailer 5.2 testing from DomainRacer';
    $msg = 'This is mail about testing mailing using PHP.';
    
    $error= send_mail($to,$from, $name ,$subj, $msg);
    
?>

<html>
    <head>
        <title>PHPMailer 5.2 testing from DomainRacer</title>
    </head>
    <body style="background: black;">
        <h2 style="padding-top:70px;color: white;"><?php echo $error; ?></h2>
    </body>
    
</html>