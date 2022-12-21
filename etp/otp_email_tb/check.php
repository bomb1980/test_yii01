<?php
include_once '../config/database.php';
include_once '../objects/otp_email_tb.php';

$database = new Database();
$db = $database->getConnection();

 //var_dump($db);
 //exit;

$otp_email_tb = new otp_email_tb($db);

  $emadd=$_POST['emadd'];
  $oel_id=$_POST['oel_id'];
  $et=$_POST['et'];
  

if(

    !empty($emadd) &&
    !empty($oel_id) &&
    !empty($et)
    
){
 
    // set product property values
	$otp_email_tb->oel_registernumber = $oel_id; 
    $otp_email_tb->oel_emailaddress = $emadd;   
    $otp_email_tb->oel_emailtype = $et;
   
   
   if($otp_email_tb->chkemail()){
		echo "https://172.20.90.50/etp/form1.php";
   }else{
       echo "ERROR";
   }

}

?>