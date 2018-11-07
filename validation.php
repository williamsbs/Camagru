<?php
session_start();
include_once "header.php";
?>
<h1 style="text-align: center">Please Check your emails to activate your account</h1>
<?php
include_once "footer.php";

//
//require 'PHPMailer/src/Exception.php';
//require 'PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/SMTP.php';
//$mail = new PHPMailer(true);
//echo "oiu";
//
//$mail->isSMTP();
//$mail->SMTPAuth = true;
//$mail->SMTPSecure = 'ssl';
//$mail->Host = 'smtp.gmail.com';
//$mail->port = '465';
//$mail->isHTML(true);
//$mail->Username = 'camagruwsabates@gmail.com';
//$mail->PassWord = 'camagru123456';
//$mail->SetFrom('From: validation@camagru.com');
//$mail->From = "camagruwsabates@gmail.com";
//$mail->Subject = "Activer votre compte";
//$mail->Body = 'A test mail';
//$mail->AddAddress= ('bobsabates@gmail.com');
//
//if($mail->Send())
//{
//
//    echo "email send";
//}
//else{
//    echo "mail not sent";
//}
//
//$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
//try {
//    //Server settings
//    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
//    $mail->isSMTP();                                      // Set mailer to use SMTP
//    $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
//    $mail->SMTPAuth = true;                               // Enable SMTP authentication
//    $mail->Username = 'user@example.com';                 // SMTP username
//    $mail->Password = 'secret';                           // SMTP password
//    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//    $mail->Port = 587;                                    // TCP port to connect to
//
//    //Recipients
//    $mail->setFrom('from@example.com', 'Mailer');
//    $mail->addAddress('bobsabates@gmail.com', 'Joe User');     // Add a recipient
//    $mail->addAddress('bobsabates@gmail.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');
//
//
//    //Content
//    $mail->isHTML(true);                                  // Set email format to HTML
//    $mail->Subject = 'Here is the subject';
//    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
//    $mail->send();
//    echo 'Message has been sent';
//} catch (Exception $e) {
//    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
//}