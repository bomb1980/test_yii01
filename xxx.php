<?php

$registerNumber = null;
if (!empty($_REQUEST['regnum'])) $registerNumber = $_REQUEST['regnum'];
if (is_null($registerNumber)) {
  echo "request registernumber";
  exit;
}
//$registerNumber = "0105518008120";
header('Content-Type: application/json; charset=utf-8');

$curl = curl_init();

$postData = [
  "username" => "SSO001",
  "password" => "",
  "type" => "DATA",
  "firstName" => "",
  "lastName" => "",
  "idCard" => $registerNumber,
  "reqHeader" => [
    "transID" => "SSO20180620",
    "rqAppID" => "SSO",
    "transDateTimestamp" => "20180620",
    "terminalID" => "terminalID",
    "ip" => "127.0.0.1",
    "branchCode" => "001"
  ]
];


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://services.led.go.th/v1/GdxWebServiceSam',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  /*
  CURLOPT_POSTFIELDS => '{
    "username": "SSO001",
    "password": "",
    "type": "DATA",
    "firstName": "",
    "lastName": "",
    "idCard": "{$registerNumber}",
    "reqHeader": {
        "transID": "SSO20180620",
        "rqAppID": "SSO",
        "transDateTimestamp": "20180620",
        "terminalID": "terminalID",
        "ip": "127.0.0.1",
        "branchCode": "001"
    }
}',*/
  CURLOPT_POSTFIELDS => json_encode($postData),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
