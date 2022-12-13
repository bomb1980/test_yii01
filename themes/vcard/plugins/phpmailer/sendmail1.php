<?php

require("class.phpmailer.php");

$mailer = new PHPMailer();
//$mailer->SetLanguage("en", 'includes/phpMailer/language/');
//$mailer->IsSMTP();
//**** gmail *************************************************

$mailer->Mailer = "mail";
$mailer->Host = 'smtp.gmail.com'; //'ssl://smtp.gmail.com';
$mailer->Port = 587; //can be 587
$mailer->SMTPAuth = FALSE;
// Change this to your gmail address
//$mailer->Username = 'day.jakkrit@gmail.com';  
// Change this to your gmail password
//$mailer->Password = '*****';  
// Change this to your gmail address
$mailer->From = 'no-reply@sso.go.th';  

//***** sso mail *************************************************
/*
$mailer->Host = 'smtp.sso.go.th'; //'ssl://smtp.gmail.com';
$mailer->Port = 25; //can be 587
$mailer->SMTPAuth = FALSE;
$mailer->From = 'no-reply@sso.go.th';
*/
//****************************************************************

// This will reflect as from name in the email to be sent
$mailer->FromName = 'Day Jakkrit Rungwong'; 
$mailer->Body = iconv('utf-8','tis-620','This is the body of your emal ทดสอบภาษาไทย.');
$mailer->Subject = iconv('utf-8','tis-620','This is your subject ทดสอบภาษาไทย.');

// This is where you want your email to be sent
$mailer->AddAddress('day.jakkrit@gmail.com'); 
 
if(!$mailer->Send())
{
    echo "Message was not sent<br/ >";
    echo "Mailer Error: " . $mailer->ErrorInfo;
}
else
{
    echo "Message has been sent";
}

?>