<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__.'/../vendor/autoload.php';

function sendMail($subject, $body, $to){
    require_once __DIR__.'/../config/mailer.php';
    
    $mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8";                              

    $mail->isSMTP();                                  
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                              
    $mail->Username = $EMAIL_ADDRESS;                
    $mail->Password = $EMAIL_PASS;                          
    $mail->SMTPSecure = 'tls';                           
    $mail->Port = 587;                                   
    $mail->setFrom($EMAIL_ADDRESS, 'SCTI 2019');

    $mail->addAddress($to, $to); 

    //Content
    $mail->isHTML(true);                                 
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = 'Não foi possível mostrar o conteúdo original pois o seu serviço de email não suporta HTML.';

    $mail->send();
    return true;
}
?>