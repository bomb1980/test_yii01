<?php

$registerNumber = null;
if (!empty($_REQUEST['regnum'])) $registerNumber = $_REQUEST['regnum'];
if (is_null($registerNumber)) {
	echo "request registernumber";exit;
}

header('Content-Type: application/json; charset=utf-8');
//header('Content-type: text/xml');
$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebServiceV5.wsdl';

$client = new SoapClient($fullPathToWsdl, [
	'stream_context' => stream_context_create([
		'ssl' => [
			'verify_peer' => false,
			'verify_peer_name' => false,
		],
	]),
]);

$params = array(
	"subscribeId" => '6211003', //'6211003', //usersso
	"pincode" => 'P@ssw0rd', //'P@ssw0rd', //pinsso
	"registerNumber" => $registerNumber  //'0102558000071'
);

$data =  $client->GetCorpInfoByRegisterNumberService($params);


//$json_data = json_encode((array) $data, JSON_UNESCAPED_UNICODE);

$per = objectToArray($data);

$json_data = json_encode((array) $per, JSON_UNESCAPED_UNICODE);
echo $json_data;

function objectToArray ($object) {
    if(!is_object($object) && !is_array($object)){
    	return $object;
    }
    return array_map('objectToArray', (array) $object);
}
