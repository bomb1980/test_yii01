<?php

require("class.phpmailer.php");

$mailer = new PHPMailer();
$mailer->IsSMTP();
//$mailer->Host = 'smtp.gmail.com'; //'ssl://smtp.gmail.com';
//$mailer->Port = 587; //can be 587
//$mailer->SMTPAuth = TRUE;
$mailer->Host = 'smtp.sso.go.th'; //'ssl://smtp.gmail.com';
$mailer->Port = 25; //can be 587
$mailer->SMTPAuth = FALSE;
// Change this to your gmail address
// $mailer->Username = 'day.jakkrit@gmail.com';
// Change this to your gmail password
// $mailer->Password = '******';
// Change this to your gmail address
$mailer->From = 'no-reply@sso.go.th';
// This will reflect as from name in the email to be sent
$mailer->FromName = 'Day Jakkrit Rungwong';
$mailer->Body = 'This is the body of your email.';
$mailer->Subject = 'This is your subject.';
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
