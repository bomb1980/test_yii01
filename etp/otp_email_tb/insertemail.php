<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/otp_email_tb.php';
 
$database = new Database();
$db = $database->getConnection();
 //var_dump($db);
 //exit;
$otp_email_tb = new otp_email_tb($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 //var_dump($data); //เชคดาต้าที่ถูกอินพุท
/* echo $data->oel_registernumber; echo "<br>";
 echo $data->oel_accno; echo "<br>";
 echo $data->oel_registername; echo "<br>";
 echo $data->oel_emailaddress; echo "<br>";
 //echo $data->oel_otp; echo "<br>";
 //echo $data->oel_expdatetime; echo "<br>";
 echo $data->oel_registerdate; echo "<br>";
 echo $data->oel_emailtype; echo "<br>";
// echo $data->oel_answer; echo "<br>";
 echo $data->oel_createby; echo "<br>";
 echo $data->oel_createdate; echo "<br>";
 echo $data->oel_updateby; echo "<br>";
 echo $data->oel_updatedate; echo "<br>";
 echo $data->oel_remark; echo "<br>";
 echo $data->oel_status; echo "<br>";   
 //exit;*/
// make sure data is not empty
if(

    !empty($data->oel_registernumber) &&
    !empty($data->oel_accno) &&
    !empty($data->oel_registername) &&
    !empty($data->oel_emailaddress)  &&
    !empty($data->oel_registerdate) &&
    !empty($data->oel_emailtype) &&
    !empty($data->oel_createby) &&
    !empty($data->oel_createdate) &&
    !empty($data->oel_updateby) &&
    !empty($data->oel_updatedate) &&
    !empty($data->oel_remark) &&
    !empty($data->oel_status) 
    
){
 
    // set product property values
	$otp_email_tb->oel_registernumber = $data->oel_registernumber; //varchar(50) 
	$otp_email_tb->oel_accno = $data->oel_accno; //varchar(50) 
	$otp_email_tb->oel_registername = $data->oel_registername; //varchar(500) 
	$otp_email_tb->oel_emailaddress = $data->oel_emailaddress; //varchar(200) 
	//$otp_email_tb->oel_otp = $data->oel_otp; //varchar(10) 
	//$otp_email_tb->oel_expdatetime = $data->oel_expdatetime; //datetime 
    $otp_email_tb->oel_registerdate = $data->oel_registerdate; //datetime 
    $otp_email_tb->oel_emailtype = $data->oel_emailtype; //varchar(10) 
	//$otp_email_tb->oel_answer = $data->oel_answer; //varchar(50) 
	$otp_email_tb->oel_createby = $data->oel_createby; //varchar(150) 
	$otp_email_tb->oel_createdate = date('Y-m-d H:i:s'); //datetime 
	$otp_email_tb->oel_updateby = $data->oel_updateby; //varchar(150) 
	$otp_email_tb->oel_updatedate = date('Y-m-d H:i:s'); //datetime 
	$otp_email_tb->oel_remark = $data->oel_remark; //text 
	$otp_email_tb->oel_status = $data->oel_status; //varchar(10)


    // create the product
    if($otp_email_tb->insertemail()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "otp_email_tb was inserted."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to insert otp_email_tb."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to insert otp_email_tb. Data is incomplete."));
}
?>