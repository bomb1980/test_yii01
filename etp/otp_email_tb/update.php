<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/otp_email_tb.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 var_dump ($db);
 exit;
// prepare product object
$otp_email_tb = new otp_email_tb($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$otp_email_tb->id = $data->id;
 
// set product property values
            //$otp_email_tb->oel_id =$data->oel_id;
            //$otp_email_tb->oel_registernumber =$data->oel_registernumber; 
            //$otp_email_tb->oel_accno =$data->oel_accno;
            //$otp_email_tb->oel_registername =$data->oel_registername;
            //$otp_email_tb->oel_emailaddress =$data->oel_emailaddress;
            $otp_email_tb->oel_otp =$data->oel_otp;
            $otp_email_tb->oel_expdatetime =$data->oel_expdatetime;
            //$otp_email_tb->oel_registerdate =$data->oel_registerdate; 
            $otp_email_tb->oel_emailtype =$data->oel_emailtype; 
            $otp_email_tb->oel_answer =$data->oel_answer; 
            //$otp_email_tb->oel_createby =$data->oel_createby; 
            //$otp_email_tb->oel_createdate =$data->oel_createdate;
            $otp_email_tb->oel_updateby =$data->oel_updateby; 
            $otp_email_tb->oel_updatedate =$data->oel_updatedate;
            $otp_email_tb->oel_remark =$data->oel_remark; 
            $otp_email_tb->oel_status =$data->oel_status;

// update the product
if($otp_email_tb->update()){
   
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "otp_email_tb was updated."));
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update otp_email_tb."));
}
?>