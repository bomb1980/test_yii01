<?php

ini_set("max_execution_time", "-1");
ini_set("memory_limit", "-1");
ignore_user_abort(true);
set_time_limit(0);

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Untitled Document</title>
	<script>
		function downloadpdf() {
			//alert("test ok");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/downloadpdf1'); ?>",
				data: data1,
				success: function(da) {
					//$("#resega1").html(da);
					//BootstrapDialog.alert('<font class="thfont5">' + da + '</font>');
					//$('#resega1').html(""); 
				}
			});

		} //function
	</script>
</head>

<body>
	<?php
	//echo "{$action} , {$txt1}, {$txt2}";
	//start call ega service Token==============================
	//$url = 'https://api.egov.go.th/ws/auth/validate?ConsumerSecret=qyEMnqWM7Of&AgentID=3740300261452';
	//$url = 'https://172.20.90.230:443/rest/egov/ws/auth/validate?ConsumerSecret=qyEMnqWM7Of&AgentID=3740300261452';
	//$url = 'https://uatws.sso.go.th/rest/egov/ws/auth/validate?ConsumerSecret=qyEMnqWM7Of&AgentID=3740300261452'; //uat
	//https://wsg.sso.go.th/rest/egov/ws/auth/    //use for production

	$url = 'https://wsg.sso.go.th/rest/egov/ws/auth/validate?ConsumerSecret=qyEMnqWM7Of&AgentID=3740300261452';

	$opts = array(
		"http" => array(
			"method" => "GET",
			"header" =>
			//"Content-Type: application/xml; charset=utf-8;\r\n".
			"Consumer-Key: 8400dfa3-4fe3-43b9-b830-060d948d75cf",
			"Connection: close\r\n",
			"ignore_errors" => true,
			"timeout" => (float)30.0,
			//"content" => $postdata,
			//'Content-type: application/xwww-form-urlencoded',
		),
		"ssl" => array(
			"verify_peer" => false,
			"verify_peer_name" => false,
		),
	);


	//  $content = file_get_contents($url, false, stream_context_create($opts));
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		//CURLOPT_HEADER => TRUE,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'consumer-key: 8400dfa3-4fe3-43b9-b830-060d948d75cf',
			'content-Type: application/json'
		),
	));

	$content = curl_exec($ch);

	if (!curl_errno($ch)) {
		//echo $response;
	} else {
		//echo 'Curl error: ' . curl_error($ch);
		echo "Call Token is failed => " . curl_error($ch) . "<br>";
		echo "ไม่พบข้อมูลที่ต้องการค้นหาบน <br>";
		exit();
	}
	$header_data = curl_getinfo($ch);

	$http_code = $header_data['http_code'];

	if ($http_code == 200) {
		echo "Call Token is success =>" . $http_code . "<br>";
	} else {
		echo "Call Token is failed => " . curl_error($ch) . "<br>";
		echo "ไม่พบข้อมูลที่ต้องการค้นหาล่าง <br>";
		exit();
	}
	curl_close($ch);
	//exit();


	/* 
	$mystring = $http_response_header[0];
	$findme   = '200';
	if (strpos($mystring, $findme)) {
		echo "Call Token is success =>" . $http_response_header[0] . "<br>";
	} else {
		echo "Call Token is failed => " . $http_response_header[0] . "<br>";
		echo "ไม่พบข้อมูลที่ต้องการค้นหา <br>";
		exit();
	}
*/

//echo $content->Result;
	$content_jsdc = json_decode($content);
	$msg = $content_jsdc->Result;

	//return $msg;
	//echo "{$msg} <br>";

	//exit();	

	//====================================================

	//start call ega service งบการเงิน==แบบ Text ============================================================

	//https://172.20.90.230:443/rest/egov/ws/dbd/
	//https://api.egov.go.th/ws/dbd/v2/financial?JuristicID=$txt1&Year=$txt2
	//https://172.20.90.230:443/rest/egov/ws/dbd/v2/financial?JuristicID=$txt1&Year=$txt2"
	//https://uatws.sso.go.th/rest/egov/ws/dbd/v2/financial?JuristicID=$txt1&Year=$txt2"
	//0615562000363&Year2562
	//https://uatwsg.sso.go.th/rest/egov/ws/dbd/v2/financial?JuristicID=0100515010838&Year=2556

	/*
	  $curl = curl_init();
	  
	  curl_setopt_array($curl, array(
		CURLOPT_URL => "https://uatwsg.sso.go.th/rest/egov/ws/dbd/v2/financial?JuristicID=0100515010838&Year=2556", 
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		  "Content-Type: application/x-www-form-urlencoded",
		  "Consumer-Key: 8400dfa3-4fe3-43b9-b830-060d948d75cf",
		  "Token: $msg"
		),
	  ));
	  
	  $response = curl_exec($curl);
	  
	  curl_close($curl);

	  echo "<pre> {$response} </pre>";

	  exit();
	  */

	//===== call financial dga====================================================

	//https://wsg.sso.go.th/rest/egov/ws/dbd/ <= user for production

	//$url2 = 'https://wsg.sso.go.th/rest/egov/ws/dbd/v2/financial?JuristicID=' . $txt1 . '&Year=' . $txt2;

	//$url2 = 'https://wsg.sso.go.th/rest/egov/ws/dbd/juristic/v4/profile/financial/image?JuristicID=' . $txt1 . '&Year=' . $txt2;

	$url2 = 'https://uatwsg.sso.go.th/rest/egov/ws/dbd/juristic/v5/profile/financial/image?JuristicID=' . $txt1 . '&Year=' . $txt2;

	$opts2 = array(
		"http" => array(
			"method" => "GET",
			"header" =>
			"Consumer-Key: 8400dfa3-4fe3-43b9-b830-060d948d75cf\r\nToken: $msg",
			"Connection: close\r\n",
			"ignore_errors" => true,
			"timeout" => (float)30.0,
		),
		"ssl" => array(
			"verify_peer" => false,
			"verify_peer_name" => false,
		),

	);

	//$response = file_get_contents($url2, false, stream_context_create($opts2));
	
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url2,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		//CURLOPT_HEADER => TRUE,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			"Consumer-Key: 8400dfa3-4fe3-43b9-b830-060d948d75cf\r\nToken: $msg",
			'content-Type: application/json'
		),
	));

	$response = curl_exec($ch);

	if (!curl_errno($ch)) {
		//echo $response;
	} else {
		//echo 'Curl error: ' . curl_error($ch);
		echo "Call Token is failed => " . curl_error($ch) . "<br>";
		echo "ไม่พบข้อมูลที่ต้องการค้นหาบน <br>";
		exit();
	}
	$header_data = curl_getinfo($ch);

	$http_code = $header_data['http_code'];

	if ($http_code == 200) {
		echo "Call Content is success =>" . $http_code . "<br>";
	} else {
		echo "Call Content is failed => " . curl_error($ch) . $http_code . "<br>";
                if ($response){
                $res = json_decode($response,true);
                 if($res){
                  // var_dump($res);
                   echo $res['Message']. "<br>";
                 }else{
                   echo $response . "<br>";
                 }
             
                }
		echo "ไม่พบข้อมูลที่ต้องการค้นหา <br>";
		exit();
	}
	curl_close($ch);
	


	/*/var_dump($response);
	$mystring = $http_response_header[0];
	$findme   = '200';
	if (strpos($mystring, $findme)) {
		echo "Call Content is success =>" .  $http_response_header[0] .  "<br>";
	} else {
		echo "Call Content is failed =>" . $http_response_header[0] . "<br>";
		echo "ไม่พบข้อมูลที่ต้องการค้นหา <br>";
		exit();
	}

	//exit();*/


	//=============================================================================


	if ($response) {

		$resdj = json_decode($response);

		if (is_null($resdj->Type) || empty($resdj->Type)) {
			$Type = "-ไม่มี-";
		} else {
			$Type = $resdj->Type;
		}

		if (is_null($resdj->Page) || empty($resdj->Page)) {
			$Page = "-ไม่มี-";
		} else {
			$Page = $resdj->Page;
		}

		if (is_null($resdj->Contents) || empty($resdj->Contents)) {
			$Contents = "-ไม่มี-";
		} else {
			$Contents = $resdj->Contents[0]->Data;
		}

		/*$bin = base64_decode($Contents, true);
	if (strpos($bin, '%PDF') !== 0) {
  		throw new Exception('Missing the PDF file signature');
	}
	file_put_contents('financail.pdf', $bin);
	*/

	?>
		<div>
			<!--<iframe src="<?php echo Yii::app()->request->baseUrl; ?>/financail.pdf" style="width:100%; height:800px;" frameborder="0"></iframe>-->
			<!--<embed src="<?php echo Yii::app()->request->baseUrl; ?>/financail.pdf" width="100%" height="800"><br>-->

			<iframe src="data:application/pdf;base64,<?= $Contents ?>" style="width:100%; height:800px;" frameborder="0"></iframe>

		</div>
	<?php
	} else {
		echo  "<b><div style='text-align:center'> เลขนิติบุคคล 13 หลัก $txt1 ไม่มีข้อมูลงบการเงินในปีนี้ $txt2 </div></b> ";
	}
	?>

	<?php
	//===========================================================================================
	?>
</body>

</html>
