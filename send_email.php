<?php
	require 'phpmailer/PHPMailerAutoload.php';
    include ("classes/db_constants.php");

	if (!isset($_POST['to_email'])) exit(0);
	if (!isset($_POST['body'])) exit(0);

	$to_email = explode("\n", $_POST['to_email']);

	if ($_POST['report_name'] == "") $_POST['report_name'] = "Contact Us";
	if (!sizeof($to_email)) exit(0);

	$attachment = "";
	$attachment_name = "";

	if (isset($_POST['attachment'])) $attachment = $_POST['attachment'];
	if (isset($_POST['attachment_name'])) $attachment_name = $_POST['attachment_name'];



	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = env('MAIL_HOST','');  				  // Specify main and backup SMTP servers
	$mail->SMTPAuth = env('MAIL_SMTP_AUTH','');                               // Enable SMTP authentication
	$mail->Username = env('MAIL_USERNAME','');            // SMTP username
	$mail->Password = env('MAIL_PASSWORD','');           // SMTP password
	$mail->Port = env('MAIL_PORT','');

	$from_email = (isset($_POST['from_email'])) ? trim($_POST['from_email']) : "no-reply@amztracker.com";
	$from_name = (isset($_POST['from_name'])) ? trim($_POST['from_name']) : "AMZ Tracker";

	if ((strpos($from_email, "@amztracker.com") === false) &&
		(strpos($from_email, "@amzreviewtrader.com") === false) &&
		(strpos($from_email, "@amzreviews.co.uk") === false) &&
		(strpos($from_email, "@amzreviews.de") === false)) $from_email = "no-reply@amztracker.com";

	if (!strlen($from_email)) $from_email = "support@amztracker.com";
	if (!strlen($from_name)) $from_name = "AMZ Tracker";

	$mail->From = $from_email;
	$mail->FromName = $from_name;

	foreach ($to_email as $key => $value) {
		$mail->addAddress($value, $value);     // Add a recipient
	}

	$mail->addReplyTo($_POST['from_email'], $_POST['from_name']);

	if (($attachment != "") && ($attachment_name == "")) $mail->addStringAttachment($attachment);         // Add attachments
	if (($attachment != "") && ($attachment_name != "")) $mail->addStringAttachment($attachment, $attachment_name);    // Optional name

	if (isset($_POST['notHTML'])) $mail->isHTML(false);
	else $mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $_POST['report_name'];
	$mail->Body    = $_POST['body'];

	if(!$mail->send()) {
	    echo 'Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message sent!';
	}
?>