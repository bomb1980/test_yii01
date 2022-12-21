<?php
session_start();

date_default_timezone_set("Asia/Bangkok");

//$con=mysqli_connect('localhost','root','','etpdb'); //localhost
//$con=mysqli_connect('wpddb.sso.loc','appwpd','APP@wpd','etpdb'); //uat wpddb.sso.loc
$con=mysqli_connect('C2WPDDBPRO001','appwpd','APP@wpd','etpdb'); //prd

$email=$_POST['email'];
$oel_id = $_POST['oel_id'];
$et = $_POST['et'];
$dp2 = $_POST['dp2'];
$res=mysqli_query($con,"select * from otp_email_tb where oel_emailaddress='$email'");
$count=mysqli_num_rows($res);
$newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +10 minutes"));
        //echo "{$newTime}";
if($count>0){
	$otp=rand(11111,99999);
	mysqli_query($con,"update otp_email_tb set oel_otp='$otp',oel_expdatetime='$newTime',
	oel_updateby = 'sys', oel_updatedate = NOW()
	where oel_emailaddress='$email' and oel_registernumber='$oel_id' and oel_emailtype='$et'");
	$html="Your otp verification code is ". $otp . " this expire in 10 minutes.";
	$_SESSION['EMAIL']=$email;
	smtp_mailer($email,'OTP Verification',$html);
	echo "yes"; 
}else{
	echo "not_exist";
}

function smtp_mailer($to,$subject, $msg){ 
	
	require_once("smtp/class.smtp.php");
	require_once("smtp/class.phpmailer.php");

	/* //localhost gmail server
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 0; 
	$mail->SMTPAuth = TRUE; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = "587"; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "kafiw2539@gmail.com";
	$mail->Password = "**";
	$mail->SetFrom("kafiw2539@gmail.com", "FROM NAME");
	$mail->Mailer   = "smtp";	
	$mail->Subject = "$subject";
	$mail->Body ="$msg";
	$mail->AddAddress($to);
	
	if(!$mail->Send()){
		return 0;
	}else{
		return 1;
	}
	*/

    $txtsendform = "�ӹѡ�ҹ��Сѹ�ѧ��";

    //sso mail server
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->Host = 'smtp.sso.go.th';
	$mailer->Port = 25;
	$mailer->SMTPAuth = FALSE;
	$mailer->From = 'no-reply@sso.go.th';
	$mailer->IsHTML(true);
	//$mailer->FromName = $txtsendform; 
	$mailer->Body = $msg;
	$mailer->Subject = $subject; 
	$mailer->AddAddress($to);
	
	if(!$mailer->Send()){
		return 0;
	}else{
		return 1;
	}

}
?>