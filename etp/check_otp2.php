<?php
session_start();
//$con=mysqli_connect('localhost','root','','etpdb');
//$con=mysqli_connect('wpddb.sso.loc','appwpd','APP@wpd','etpdb'); //uat wpddb.sso.loc
$con=mysqli_connect('C2WPDDBPRO001','appwpd','APP@wpd','etpdb'); //prd

$otp=$_POST['otp'];
$email=$_SESSION['EMAIL'];
$oel_id = $_POST['oel_id'];
$et = $_POST['et'];
$oelans  =$_POST['oelans'];
$dp2 = $_POST['dp2'];

$res=mysqli_query($con,"select * from otp_email_tb where oel_emailaddress='$email' and oel_otp='$otp'");
$count=mysqli_num_rows($res);
if($count>0){
	mysqli_query($con,"update otp_email_tb set oel_otp='', oel_answer = '$oelans', 
	oel_updateby = 'sys', oel_updatedate = NOW(), oel_status= '$dp2'
	where oel_emailaddress='$email' and oel_registernumber='$oel_id' and oel_emailtype='$et'");
	$_SESSION['IS_LOGIN']=$email;
	echo "yes";
}else{
	echo "not_exist";
}
?>