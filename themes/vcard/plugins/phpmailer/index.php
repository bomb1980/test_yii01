<?php

require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->setFrom('day.jakkrit@gmail.com', 'Your Name');
$mail->addAddress('day.jakkrit@gmail.com', 'My Friend');
$mail->Subject  = 'First PHPMailer Message';
$mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';
if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}

	/***
	Server SMTP/POP : mail.thaicreate.com
	Email Account : webmaster@thaicreate.com
	Password : 123456
	*/
/*	require_once('PHPMailer/class.phpmailer.php');

	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
	$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
	$mail->Port = 465; // set the SMTP port for the GMAIL server
	$mail->Username = "day.jakkrit@gmail.com"; // GMAIL username
	$mail->Password = "Jak03122516"; // GMAIL password
	$mail->From = "day.jakkrit@gmail.com"; // "name@yourdomain.com";
	//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
	$mail->FromName = "Mr.Weerachai Nukitram";  // set from Name
	$mail->Subject = "Test sending mail."; 
	$mail->Body = "My Body & <b>My Description</b>";

	$mail->AddAddress("day.jakkrit@gmail.com", "Mr.Adisorn Boonsong"); // to Address

	$mail->Send(); 
	*/
	

	/*require_once('class.phpmailer.php');

    $mail             = new PHPMailer(); // defaults to using php "mail()"
    $body             = file_get_contents('contents.html');
    //$body             = eregi_replace("[\]",'',$body);
        print ($body ); // to verify that I got the html
    $mail->AddReplyTo("day.jakkrit@gmail.com","my name");
    $mail->SetFrom('day.jakkrit@gmail.com', 'my name');
    $address = "day.jakkrit@gmail.com";
    $mail->AddAddress($address, "her name");
    $mail->Subject    = "PHPMailer Test Subject via mail(), basic";
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
    $mail->MsgHTML($body);
    //$mail->AddAttachment("images/phpmailer.gif");      // attachment
    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }*/
?>
