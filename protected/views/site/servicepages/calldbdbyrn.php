<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Call DBD By RegisterNumber</title>
</head>

<body>
Call DBD By RegisterNumber
<br>
<?php
	$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebService.wsdl';
	$client = new SoapClient($fullPathToWsdl,[
    		'stream_context' => stream_context_create([
        		'ssl' => [
            			'verify_peer' => false,
            			'verify_peer_name' => false,
        			],
    			]),
		]);
	 
	$params = array(
		"subscribeId" => 'usersso',
		"pincode" => 'pinsso',
		"registerNumber" => '0305562004027'
     );
	 
	  $data = $client->GetCorpInfoByRegisterNumberService($params);
	  echo '<pre>';var_dump($data);echo '</pre>'; 
?>
</body>
</html>