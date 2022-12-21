<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/otp_email_tb.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection(); //เรียกใช้ฟังก์ชันเชื่อมต่อดาต้าเบส


// initialize object
$otp_email_tb = new otp_email_tb($db); 

// read products will be here
// query products
$stmt = $otp_email_tb->read(); // select ข้อมูลทุก record ออกมาเก็บไว้ใน $stmt
$num = $stmt->rowCount(); //นับจำนวน record ที่ นับออกมาได้

// check if more than 0 record found
if($num>0){
 
    // products array
    $otp_email_tb_arr=array();
    $otp_email_tb_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $otp_email_tb_item=array(
            "oel_id" => $oel_id,  
            "oel_registernumber" => $oel_registernumber, 
            "oel_accno" => $oel_accno ,
            "oel_registername" => $oel_registername,
            "oel_emailaddress" => $oel_emailaddress,
            "oel_otp" => $oel_otp, 
            "oel_expdatetime" => $oel_expdatetime,
            "oel_registerdate" => $oel_registerdate, 
            "oel_answer" => $oel_answer, 
            "oel_createby" => $oel_createby, 
            "oel_createdate" => $oel_createdate,
            "oel_updateby" => $oel_updateby, 
            "oel_updatedate" => $oel_updatedate, 
            "oel_status" => $oel_status 
            //"description" => html_entity_decode($description)
        );
 
        array_push($otp_email_tb_arr["records"], $otp_email_tb_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($otp_email_tb_arr);

}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No otp_email_tb found.")
    );
}