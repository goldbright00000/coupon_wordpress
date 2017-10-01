<?php
include ("classes/db_constants.php");
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = env('MAIL_HOST','');  				  // Specify main and backup SMTP servers
$mail->SMTPAuth = env('MAIL_SMTP_AUTH','');                               // Enable SMTP authentication
$mail->Username = env('MAIL_USERNAME','');            // SMTP username
$mail->Password = env('MAIL_PASSWORD','');           // SMTP password
$mail->Port = env('MAIL_PORT','');
// $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'admin@serpalytics.com';
$mail->FromName = 'Serpalytics';
$mail->addAddress('boptom@gmail.com', 'An Ly');     // Add a recipient
$mail->addReplyTo('info@example.com', 'Information');
$mail->SMTPDebug = true;

// $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>