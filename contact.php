<?php

//Import PHPMailer classes into tuse PHPMailer\PHPMailer\PHPMailer;he global namespace
//These must be at the top of your script, not inside a function
require("/home/kerecodq/public_html/PHPMailer/src/PHPMailer.php");
require("/home/kerecodq/public_html/PHPMailer/src/SMTP.php");
require("/home/kerecodq/public_html/PHPMailer/src/Exception.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mail.ru';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('');
    $mail->addAddress('Kervasiliy@gmail.com');               //Name is optional

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Заявка с сайта kerechanin.com!';
    $mail->Body    = 'Имя: '.$name . '<br>Email: '.$email . '<br>Телефон: '.$phone . '<br>Сообщение: '.$message;
    $mail->AltBody = '';

    $mail->send();
    header('location: donate.html');
} catch (Exception $e) {
    echo "Ошибка отправки!";
}