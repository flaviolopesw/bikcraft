<?php
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output (Just enable it for development purpose)
    $mail->isSMTP();                                            //Send using SMTP
    $mail->CharSet = 'UTF-8';                                   //UTF-8 Charset
    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '';                                     //SMTP username
    $mail->Password   = '';                                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('', 'Bikcraft.com'); //Email sender
    $mail->addAddress('');               //Email destination

    //Content
    $mail->isHTML(true);
    
    if(array_key_exists('budget',$_POST) && $_POST['budget'] == true){
        $mail->Subject = 'Bikcraft.com Orçamento';
        $mail->Body    = <<<EOT
        <b style="line-height: 1.5">Nome:</b>    {$_POST['name']} <br>
        <b style="line-height: 1.5">Email:</b>   {$_POST['email']} <br>
        <b style="line-height: 1.5">Telefone:</b>   {$_POST['phone']} <br>
        <b style="line-height: 1.5">Mensagem:</b> {$_POST['message']} <br>
        <b style="line-height: 1.5">Bikcraft:</b>
        <ul style="margin-top: 0;">
            <li><b>Cor</b>: {$_POST['color']}</li>
            <li><b>Estilo</b>: {$_POST['style']}</li>
            <li><b>Acessório</b>: {$_POST['accessory']}</li>
            <li><b>Medida</b>: {$_POST['measure']}</li>
        </ul>
        EOT;
    } else {
        $mail->Subject = 'Bikcraft.com Contato';
        $mail->Body    = <<<EOT
        <b style="line-height: 1.5">Nome:</b>    {$_POST['name']} <br>
        <b style="line-height: 1.5">Email:</b>   {$_POST['email']} <br>
        <b style="line-height: 1.5">Telefone:</b>   {$_POST['phone']} <br>
        <b style="line-height: 1.5">Mensagem:</b> {$_POST['message']} <br>
        EOT;
    }

    $mail->send();
    
    header("Location: index?messagesent");
} catch (Exception $e) {
    header("Location: index?messagenotsent");
    // Visualize error messages on console
    // echo "<script>console.log('Message could not be sent. Mailer Error: '.$mail->ErrorInfo)</script>";
}
?>