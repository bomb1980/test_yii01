<?php
class cropinfo_tmp extends CApplicationComponent 
{
	// object properties
	public $crop_id; // INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'ลำดับ' ,
	public $registernumber; // VARCHAR( 13 ) NOT NULL COMMENT 'เลขทะเบียนนิติบุคคล' ,
	public $registername; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อที่ใช้จดทะเบียน' ,
	public $acc_no; // VARCHAR( 10 ) NOT NULL COMMENT 'เลขที่บัญชี' ,
	public $acc_bran; // VARCHAR( 6 ) NOT NULL COMMENT 'สาขา' ,
	public $tsic; // VARCHAR( 5 ) NOT NULL COMMENT 'รหัส tsic' ,
	public $tsicname; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อ tsic' ,
	public $corptype; // VARCHAR( 1 ) NOT NULL COMMENT 'รหัสประเภทธุรกิจ' ,
	public $corptypename; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อประเภท' ,
	public $registerdate; // DATETIME NOT NULL COMMENT 'วันที่จดทะเบียน' ,
	public $updateddate; // DATETIME NOT NULL COMMENT 'วันที่มีการแก้ไขข้อมูลล่าสุด' ,
	public $updateentry; // VARCHAR( 1 ) NOT NULL COMMENT 'มีการแก้ไขข้อมูลหลังจากลงทะเบียน' ,
	public $accountingdate; // VARCHAR( 4 ) NOT NULL COMMENT 'รอบปีบัญชี' ,
	public $authorizedcapital; // Double(20 ,2) NOT NULL COMMENT 'ทุนจดทะเบียน' ,
	public $statuscode; // VARCHAR( 1 ) NOT NULL COMMENT 'สถานะนิติบุคคล' ,
	public $cpower; // VARCHAR( 5000 ) NOT NULL COMMENT 'จำนวนหรือชื่อกรรมการที่ลงชื่อผูกพัน' ,
	public $crop_remark; // TEXT NULL COMMENT 'หมายเหตุ' ,
	public $crop_createby; // VARCHAR( 100 ) NOT NULL COMMENT 'สร้างโดย' ,
	public $crop_createtime; // DATETIME NOT NULL COMMENT 'วันที่สร้าง' ,
	public $crop_updateby; // VARCHAR( 100 ) NOT NULL COMMENT 'แก้ไขโดย' ,
	public $crop_updatetime; // DATETIME NOT NULL COMMENT 'วันที่แก้ไข' ,
	public $crop_status; // TINYINT( 1 ) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ' ,
	
	public $username;
	
	
		
	
	public function create(){
		// Set the POST data
		$postdata = json_encode(
			array(
				'registernumber' => $this->registernumber,
				'registername' => $this->registername,
				'acc_no' => $this->acc_no,
				'acc_bran' => $this->acc_bran,
				'tsic' => $this->tsic,
				'tsicname' => $this->tsicname,
				'corptype' => $this->corptype,
				'corptypename' => $this->corptypename,
				'registerdate' => $this->registerdate,
				'updateddate' => $this->updateddate,
				'updateentry' => $this->updateentry,
				'accountingdate' => $this->accountingdate,
				'authorizedcapital' => $this->authorizedcapital,
				'statuscode' => $this->statuscode,
				'cpower' => $this->cpower,
				'crop_remark' => $this->crop_remark,
				'crop_createby' => $this->crop_createby,
				'crop_createtime' => $this->crop_createtime,
				'crop_updateby' => $this->crop_updateby,
				'crop_updatetime' => $this->crop_updatetime,
				'crop_status' => $this->crop_status
			)
		);
		
		//return $postdata;
		
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/cropinfo_temp/create.php';
		
		$opts = array(
			"http" => array (
				"method" => "POST",
				 "header" =>
					"Content-Type: application/xml; charset=utf-8;\r\n".
					"Connection: close\r\n",
					"ignore_errors" => true,
					"timeout" => (float)30.0,
					"content" => $postdata,
					//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		
		$content = file_get_contents($url, false, stream_context_create($opts));
		
		//return $content; 
		
		$content_jsdc = json_decode($content);

		$msg = $content_jsdc->message; 
		
		return $msg;
		
		
	}//public function create(){
		
	public function regexists(){
		$postdata = json_encode(
			array(
				'registernumber' => $this->registernumber
			)
		);
		
		//return $postdata;
		
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/cropinfo_temp/regexists.php';
		
		$opts = array(
			"http" => array (
				"method" => "POST",
				 "header" =>
					"Content-Type: application/xml; charset=utf-8;\r\n".
					"Connection: close\r\n",
					"ignore_errors" => true,
					"timeout" => (float)30.0,
					"content" => $postdata,

					//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$content = file_get_contents($url, false, stream_context_create($opts));
		
		//return $content;
		
		$content_jsdc = json_decode($content);

		$msg = $content_jsdc->message; 
		
		//return $msg;
		
		if($msg=='y'){
			return true;
			//$msgr = "have data";
		}else{
			return false;
			//$msgr = "not have data";
		}
		
		//return $msgr;
		
		
	}//public function regexists(){
		
	public function getlastcorpid(){
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/cropinfo_temp/getlastcorpid.php';
		$opts = array(
			"http" => array (
				"method" => "GET",
				 "header" =>
					"Content-Type: application/xml; charset=utf-8;\r\n".
					"Connection: close\r\n",
					"ignore_errors" => true,
					"timeout" => (float)30.0,
					//"content" => $postdata,
					//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		
		$content = file_get_contents($url, false, stream_context_create($opts));
		$content_jsdc = json_decode($content);

		$msg = $content_jsdc->message; 
		
		//return $msg;
		
		if($msg=='y'){
			$lastcropid = $content_jsdc->crop_id;
		}else{
			$lastcropid = 0;
		}
		
		return $lastcropid;
		
	}//public function getlastcorpid(){
		
	public function UpdateStatusCorp(){
		$postdata = json_encode(
			array(
				'registernumber' => $this->registernumber,
				'acc_no' => $this->acc_no
			)
		);
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/cropinfo_temp/update.php';
		$opts = array(
			"http" => array (
				"method" => "POST",
				 "header" =>
					"Content-Type: application/xml; charset=utf-8;\r\n".
					"Connection: close\r\n",
					"ignore_errors" => true,
					"timeout" => (float)30.0,
					"content" => $postdata,
					//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		
		$content = file_get_contents($url, false, stream_context_create($opts));
		
		//return $content;
		
		$content_jsdc = json_decode($content);

		$msg = $content_jsdc->message; 
		
		return $msg;
		
	}//public function getlastcorpid(){
		
	public function UpdateStatus1(){
		$postdata = json_encode(
			array(
				'crop_id' => $this->crop_id,
				'registernumber' => $this->registernumber,
				'crop_remark' => $this->crop_remark,
				'crop_status' => $this->crop_status
			)
		);
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/cropinfo_temp/updatestatus1.php';
		
		$opts = array(
			"http" => array (
				"method" => "POST",
				 "header" =>
					"Content-Type: application/xml; charset=utf-8;\r\n".
					"Connection: close\r\n",
					"ignore_errors" => true,
					"timeout" => (float)30.0,
					"content" => $postdata,
					//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		
		$content = file_get_contents($url, false, stream_context_create($opts));
		
		//return $content;
		
		$content_jsdc = json_decode($content);

		$msg = $content_jsdc->message; 
		
		return $msg;
		
	}
	
	public function UpdateStatusBtoA(){
		$postdata = json_encode(
			array(
				'crop_id' => $this->crop_id,
				'registernumber' => $this->registernumber,
				'crop_remark' => $this->crop_remark,
				'crop_status' => $this->crop_status
			)
		);
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/cropinfo_temp/updatestatusbtoa.php';
		$opts = array(
			"http" => array (
				"method" => "POST",
				 "header" =>
					"Content-Type: application/xml; charset=utf-8;\r\n".
					"Connection: close\r\n",
					"ignore_errors" => true,
					"timeout" => (float)30.0,
					"content" => $postdata,
					//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		
		$content = file_get_contents($url, false, stream_context_create($opts));
		
		//return $content;
		
		$content_jsdc = json_decode($content);

		$msg = $content_jsdc->message; 
		
		return $msg;
		
	}//UpdateStatusBtoA
	
	public function GetinfoByRN(){
		
		//$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebService.wsdl';
		$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebServiceV5.wsdl';
		
		$client = new SoapClient($fullPathToWsdl,[
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
			"registerNumber" => $this->registernumber //'0305562004027'
		 );
		 
		 //try{
		   $data = $client->GetCorpInfoByRegisterNumberService($params);	 
		   //echo '<pre>';var_dump($data);echo '</pre>'; 
		   //exit;
		   
			if(property_exists($data,"CorpInfo")) {
				if(is_array($data->CorpInfo)){
					$countcorpinfo = count($data->CorpInfo);
				}else{
					$countcorpinfo = 1;	
				}
				//echo " count of corpInfo : {$countcorpinfo} <br>";
			}//if(property_exists($data,"CorpInfo"))
			if($countcorpinfo != 0){ 
			
				if(property_exists($data->CorpInfo,"tsic")) { 
						   $tsic = $data->CorpInfo->tsic; 
						}else{
						   $tsic = "-"; 
						}
						if(empty($tsic)){
							$tsic = "-";
						}
						if(property_exists($data->CorpInfo,"tsicName")) {
						  $tsicName = $data->CorpInfo->tsicName;
						}else{
						  $tsicName = "-";  
						}
						if(empty($tsicName)){
							$tsicName = "-";
						}
						if(property_exists($data->CorpInfo,"corpType")) {
						  $corpType = $data->CorpInfo->corpType;
						}else{
						   $corpType ='-'; 
						}
						if(empty($corpType)){
							$corpType = "-";
						}
						if(property_exists($data->CorpInfo,"corpTypeName")) {
						  $corpTypeName = $data->CorpInfo->corpTypeName;
						}else{
						   $corpTypeName ='-'; 
						}
						if(empty($corpTypeName)){
							$corpTypeName = "-";
						}
						if(property_exists($data->CorpInfo,"registerNumber")) {
						  $registerNumber = $data->CorpInfo->registerNumber;
						}else{
						  $registerNumber ='-';  
						}
						if(empty($registerNumber)){
							$registerNumber = "-";
						}
						if(property_exists($data->CorpInfo,"registerName")) {
						  $registerName = $data->CorpInfo->registerName;
						}else{
						   $registerName ='-';  
						}
						if(empty($registerName)){
							$registerName = "-";
						}
						if(property_exists($data->CorpInfo,"registerDate")) {
						  $registerDate = $data->CorpInfo->registerDate;
						  $registerDate =  date_create($registerDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}else{
						  $registerDate =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');  //date('Y-m-d H:i:s');
						}
						if(property_exists($data->CorpInfo,"updatedDate")) {
						  $updatedDate = $data->CorpInfo->updatedDate;
						  $updatedDate =  date_create($updatedDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}else{
						  $updatedDate =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}
						if(property_exists($data->CorpInfo,"updatedEntry")) {
						  $updatedEntry = $data->CorpInfo->updatedEntry;
						}else{
						  $updatedEntry ='-'; 
						}
						if(empty($updatedEntry)){
							  $updatedEntry ='-';
						}
						if(property_exists($data->CorpInfo,"authorizedCapital")) {
						  $authorizedCapital = $data->CorpInfo->authorizedCapital; // number_format($data->CorpInfoList->corpInfo[$f]->authorizedCapital,2,".",",");
						}else{
						  $authorizedCapital =0;  
						}
						if(empty($authorizedCapital)){
							$authorizedCapital = 0;
						}
						if(property_exists($data->CorpInfo,"accountingDate")) {
						  $accountingDate = $data->CorpInfo->accountingDate;
						}else{
						  $accountingDate ='-';  
						}
						if(empty($accountingDate)){
							  $accountingDate ='-';
						}
						if(property_exists($data->CorpInfo,"statusCode")) {
						  $statusCode = $data->CorpInfo->statusCode;
						}else{
						  $statusCode ='-';  
						}
						if(empty($statusCode)){
							  $statusCode ='-';
						}
						if(property_exists($data->CorpInfo,"cpower")) {
						  $cpower = $data->CorpInfo->cpower;
						}else{
						  $cpower ='-';  
						}
						if(empty($cpower)){
							  $cpower ='-';
						}
						$now = date_create('now')->format('Y-m-d H:i:s');
						 
						if($statusCode==1){
						   $statusCodef = 'Now'; 
						}else{
						   $statusCodef = 'Old'; 
						}
					
						  
						$df =date_create($registerDate)->format('d-m-Y'); //set format date
						
						//echo " {$registerNumber}, {$tsic}, {$tsicName}, {$corpType}, {$corpTypeName}, {$registerDate}, {$updatedDate}, {$updatedEntry}, {$accountingDate}, {$authorizedCapital}, {$statusCode}, {$cpower} <br>";
						
						//insert data to cropinfotmptb========================================
						
						 $CropinfoMasTb = new CropinfoTmpTb();
						
						 //* @property integer $crop_id
						 $CropinfoMasTb->registernumber = $registerNumber;
						 $CropinfoMasTb->registername = $registerName;
						 $CropinfoMasTb->acc_no = "0000000000";
						 $CropinfoMasTb->acc_bran = "000000";
						 $CropinfoMasTb->tsic = $tsic;
						 $CropinfoMasTb->tsicname = $tsicName;
						 $CropinfoMasTb->corptype = $corpType;
						 $CropinfoMasTb->corptypename = $corpTypeName;
						 $CropinfoMasTb->registerdate = $registerDate;
						 $CropinfoMasTb->updateddate = $updatedDate;
						 $CropinfoMasTb->updateentry = $updatedEntry;
						 $CropinfoMasTb->accountingdate = $accountingDate;
						 $CropinfoMasTb->authorizedcapital = $authorizedCapital;
						 $CropinfoMasTb->statuscode = $statusCode;
						 $CropinfoMasTb->cpower = $cpower;
						 $CropinfoMasTb->crop_remark = "N";
						 $CropinfoMasTb->crop_createby = $this->username;
						 $CropinfoMasTb->crop_createtime = date('Y-m-d H:i:s');
						 $CropinfoMasTb->crop_updateby = $this->username;
						 $CropinfoMasTb->crop_updatetime = date('Y-m-d H:i:s');
						 $CropinfoMasTb->crop_status = 1;
						 
						 $qdup = new CDbCriteria( array(
							  'condition' => "registernumber = :registernumber ",
							  'params'    => array(':registernumber' => $registerName)
						  ));
						  
						 $dupstate = 0;
						 $result = CropinfoTmpTb::model()->findAll($qdup);
						 $countresult = count($result);
						 
						 if($countresult==0){
						   if($CropinfoMasTb->save()){
							  $msgerror = "Save data is success.";
							  //echo "{$msgerror}<br>";
						   }else{
							  $msgerror =  $CropinfoMasTb->getErrors();
							  echo "{$msgerror}<br>";
						   }//if($CropinfoMasTb->save())
						 }else if($countresult>0){//if $countresult==0
						 	$dupstate = 1;
						 }
						 
					//==========================================================
				
				if(property_exists($data->CorpInfo,"committees")) {
					if(is_array($data->CorpInfo->committees->committee)){
						$countcommittees = count($data->CorpInfo->committees->committee); 
						$crow = 1;
						for($c=0;$c<=$countcommittees-1;$c++){
							  if(property_exists($data->CorpInfo->committees->committee[$c],"committeeType")) { 
								 $committeeType = $data->CorpInfo->committees->committee[$c]->committeeType;
							  }else{
								 $committeeType = "-"; 
							  }
							  if(empty($committeeType)){
								  $committeeType ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"orderNumber")) { 
								 $orderNumber = $data->CorpInfo->committees->committee[$c]->orderNumber;
							  }else{
								 $orderNumber = 0; 
							  }
							  if(empty($orderNumber)){
								  $orderNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"identityType")) { 
								 $identityType = $data->CorpInfo->committees->committee[$c]->identityType;
							  }else{
								 $identityType = "-"; 
							  }
							  if(empty($identityType)){
								  $identityType ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"identity")) { 
								$identity = $data->CorpInfo->committees->committee[$c]->identity; 
							  }else{
								 $identity = "-"; 
							  }
							  if(empty($identity)){
								  $identity ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"title")) { 
								$title = $data->CorpInfo->committees->committee[$c]->title; 
							  }else{
								 $title = "-"; 
							  }
							  if(empty($title)){
								  $title ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"firstName")) { 
								$firstName = $data->CorpInfo->committees->committee[$c]->firstName;
							  }else{
								$firstName = "-"; 
							  }
							  if(empty($firstName)){
								  $firstName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"lastName")) { 
								$lastName = $data->CorpInfo->committees->committee[$c]->lastName; 
							  }else{
								$lastName = "-"; 
							  }
							  if(empty($lastName)){
								  $lastName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishTitle")) { 
								$englishTitle = $data->CorpInfo->committees->committee[$c]->englishTitle;  
							  }else{
								$englishTitle = "-"; 
							  }
							  if(empty($englishTitle)){
								  $englishTitle ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishFirstName")) { 
								$englishFirstName = $data->CorpInfo->committees->committee[$c]->englishFirstName;  
							  }else{
								$englishFirstName = "-"; 
							  }
							  if(empty($englishFirstName)){
								  $englishFirstName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishLastName")) { 
								$englishLastName = $data->CorpInfo->committees->committee[$c]->englishLastName;
							  }else{
								$englishLastName = "-"; 
							  }
							  if(empty($englishLastName)){
								  $englishLastName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"nationality")) { 
								$nationality = $data->CorpInfo->committees->committee[$c]->nationality;
							  }else{
								$nationality = "-"; 
							  }
							  if(empty($nationality)){
								  $nationality ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"dateOfBirth")) {
								$dateOfBirth = $data->CorpInfo->committees->committee[$c]->dateOfBirth;
								$dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
							  }else{
								$dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
							  }
							  
							  //echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
							  
							  		//--- getlast cropid ------//
									$qlc = new CDbCriteria( array(
										'condition' => "crop_status = :crop_status ORDER BY crop_id DESC LIMIT 0,1 ",
										'params'    => array(':crop_status' => 1)  //  $statusgt
									));
									 $rlc = CropinfoTmpTb::model()->findAll($qlc);
									 $clc = count($rlc);
									 if($clc>0){
										 foreach ($rlc as $rows){
											 $lastcrop_id = $rows->crop_id;
										 }
									 }else{
										 $lastcrop_id = 0;
									 }
									
									$CommitteeMasTb = new CommitteeTmpTb();
									 //* @property integer $cmit_id
									 $CommitteeMasTb->crop_id = $lastcrop_id;
									 $CommitteeMasTb->registernumber = $registerNumber;
									 $CommitteeMasTb->tsic = $tsic;
									 $CommitteeMasTb->corptype = $corpType;
									 $CommitteeMasTb->committeetype = $committeeType;
									 $CommitteeMasTb->ordernumber = $orderNumber;
									 $CommitteeMasTb->typeno = $identityType;
									 $CommitteeMasTb->identity = $identity;
									 $CommitteeMasTb->birthday = $dateOfBirth;
									 $CommitteeMasTb->title = $title;
									 $CommitteeMasTb->firstname = $firstName;
									 $CommitteeMasTb->lastname = $lastName;
									 $CommitteeMasTb->englishtitle = $englishTitle;
									 $CommitteeMasTb->englishfirstname12 =  $englishFirstName;
									 $CommitteeMasTb->englishlastname = $englishLastName;
									 $CommitteeMasTb->nation = $nationality;
									 $CommitteeMasTb->cmit_remark = "-";
									 $CommitteeMasTb->cmit_createby = $this->username;
									 $CommitteeMasTb->cmit_createtime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_updateby = $this->username;
									 $CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_status = 1;
									 
									 if($dupstate == 0){
									   if($CommitteeMasTb->save()){
							   				//echo "Save committee is success.<br>";
									   }else{
										  $msgerror =  $CommitteeMasTb->getErrors();
										  echo "{$msgerror}";
									   }//if($CommitteeMasTb->save())
									 }
									 
									//====================================================
						}//for
						
					}else{//if(is_array($data->CorpInfo->committees->committee))
						$countcommittees = 1;
						if(property_exists($data->CorpInfo->committees->committee,"committeeType")) { 
						   $committeeType = $data->CorpInfo->committees->committee->committeeType;
						}else{
						   $committeeType = "-"; 
						}
						if(empty($committeeType)){
							$committeeType ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"orderNumber")) { 
						   $orderNumber = $data->CorpInfo->committees->committee->orderNumber;
						}else{
						   $orderNumber = 0; 
						}
						if(empty($orderNumber)){
							$orderNumber ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"identityType")) { 
						   $identityType = $data->CorpInfo->committees->committee->identityType;
						}else{
						   $identityType = "-"; 
						}
						if(empty($identityType)){
							$identityType ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"identity")) { 
						  $identity = $data->CorpInfo->committees->committee->identity; 
						}else{
						   $identity = "-"; 
						}
						if(empty($identity)){
							$identity ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"title")) { 
						  $title = $data->CorpInfo->committees->committee->title; 
						}else{
						   $title = "-"; 
						}
						if(empty($title)){
							$title ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"firstName")) { 
						  $firstName = $data->CorpInfo->committees->committee->firstName;
						}else{
						  $firstName = "-"; 
						}
						if(empty($firstName)){
							$firstName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"lastName")) { 
						  $lastName = $data->CorpInfo->committees->committee->lastName; 
						}else{
						  $lastName = "-"; 
						}
						if(empty($lastName)){
							$lastName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishTitle")) { 
						  $englishTitle = $data->CorpInfo->committees->committee->englishTitle;  
						}else{
						  $englishTitle = "-"; 
						}
						if(empty($englishTitle)){
							$englishTitle ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishFirstName")) { 
						  $englishFirstName = $data->CorpInfo->committees->committee->englishFirstName;  
						}else{
						  $englishFirstName = "-"; 
						}
						if(empty($englishFirstName)){
							$englishFirstName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishLastName")) { 
						  $englishLastName = $data->CorpInfo->committees->committee->englishLastName;
						}else{
						  $englishLastName = "-"; 
						}
						if(empty($englishLastName)){
							$englishLastName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"nationality")) { 
						  $nationality = $data->CorpInfo->committees->committee->nationality;
						}else{
						  $nationality = "-"; 
						}
						if(empty($nationality)){
							$nationality ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"dateOfBirth")) {
						  $dateOfBirth = $data->CorpInfo->committees->committee->dateOfBirth;
						  $dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
						}else{
						  $dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
						}
						
						
						//echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
						
									//--- getlast cropid ------//
									$qlc = new CDbCriteria( array(
										'condition' => "crop_status = :crop_status ORDER BY crop_id DESC LIMIT 0,1 ",
										'params'    => array(':crop_status' => 1)  //  $statusgt
									));
									 $rlc = CropinfoTmpTb::model()->findAll($qlc);
									 $clc = count($rlc);
									 if($clc>0){
										 foreach ($rlc as $rows){
											 $lastcrop_id = $rows->crop_id;
										 }
									 }else{
										 $lastcrop_id = 0;
									 }
									
									$CommitteeMasTb = new CommitteeTmpTb();
									 //* @property integer $cmit_id
									 $CommitteeMasTb->crop_id = $lastcrop_id;
									 $CommitteeMasTb->registernumber = $registerNumber;
									 $CommitteeMasTb->tsic = $tsic;
									 $CommitteeMasTb->corptype = $corpType;
									 $CommitteeMasTb->committeetype = $committeeType;
									 $CommitteeMasTb->ordernumber = $orderNumber;
									 $CommitteeMasTb->typeno = $identityType;
									 $CommitteeMasTb->identity = $identity;
									 $CommitteeMasTb->birthday = $dateOfBirth;
									 $CommitteeMasTb->title = $title;
									 $CommitteeMasTb->firstname = $firstName;
									 $CommitteeMasTb->lastname = $lastName;
									 $CommitteeMasTb->englishtitle = $englishTitle;
									 $CommitteeMasTb->englishfirstname12 =  $englishFirstName;
									 $CommitteeMasTb->englishlastname = $englishLastName;
									 $CommitteeMasTb->nation = $nationality;
									 $CommitteeMasTb->cmit_remark = "-";
									 $CommitteeMasTb->cmit_createby = $this->username;
									 $CommitteeMasTb->cmit_createtime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_updateby = $this->username;
									 $CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_status = 1;
									 
									 if($dupstate == 0){
									   if($CommitteeMasTb->save()){
							   			  //echo "Save committee is success.<br>";	
									   }else{
										  $msgerror =  $CommitteeMasTb->getErrors();
										  echo "{$msgerror}<br>";
									   }//if($CommitteeMasTb->save())
									 }
									 
									 
									 //=============================================================
						
					}//else if
			
				}else{//if(property_exists($data->CorpInfo,"committees"))
					$countcommittees = 0;
				}//else if
				
				
				//branch data xml=========================================
				if(property_exists($data->CorpInfo,"branches")) {
					if(is_array($data->CorpInfo->branches->branch)){
						 $countbranches = count($data->CorpInfo->branches->branch);
						 $brow = 1;
						 for($b=0;$b<=$countbranches-1;$b++){
							  if(property_exists($data->CorpInfo->branches->branch[$b],"name")) { 
								$name = $data->CorpInfo->branches->branch[$b]->name;
							  }else{
								$name = "-"; 
							  }
							  if(empty($name)){
								  $name ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"orderNumber")) { 
								$orderNumber = $data->CorpInfo->branches->branch[$b]->orderNumber; 
							  }else{
								$orderNumber = 0; 
							  }
							  if(empty($orderNumber)){
								  $orderNumber =0;
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"houseId")) { 
								$houseId = $data->CorpInfo->branches->branch[$b]->houseId;
							  }else{
								$houseId = "-"; 
							  }
							  if(empty($houseId)){
								  $houseId ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"houseNumber")) { 
								$houseNumber = $data->CorpInfo->branches->branch[$b]->houseNumber;
							  }else{
								$houseNumber = "-"; 
							  }
							  if(empty($houseNumber)){
								  $houseNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingName")) { 
								$buildingName = $data->CorpInfo->branches->branch[$b]->buildingName; 
							  }else{
								$buildingName = "-"; 
							  }
							  if(empty($buildingName)){
								  $buildingName ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingNumber")) { 
								$buildingNumber = $data->CorpInfo->branches->branch[$b]->buildingNumber; 
							  }else{
								$buildingNumber = "-"; 
							  }
							  if(empty($buildingNumber)){
								  $buildingNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingFloor")) { 
								$buildingFloor = $data->CorpInfo->branches->branch[$b]->buildingFloor; 
							  }else{
								$buildingFloor = "-"; 
							  }
							  if(empty($buildingFloor)){
								  $buildingFloor ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"village")) { 
								$village = $data->CorpInfo->branches->branch[$b]->village;
							  }else{
								$village = "-"; 
							  }
							  if(empty($village)){
								  $village ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"moo")) { 
								$moo = $data->CorpInfo->branches->branch[$b]->moo;
							  }else{
								$moo = "-"; 
							  }
							  if(empty($moo)){
								  $moo ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"Soi")) { 
								$Soi = $data->CorpInfo->branches->branch[$b]->Soi;
							  }else{
								$Soi = "-"; 
							  }
							  if(empty($Soi)){
								  $Soi ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"Road")) { 
								$Road = $data->CorpInfo->branches->branch[$b]->Road;
							  }else{
								$Road = "-"; 
							  }
							  if(empty($Road)){
								  $Road ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"tumbon")) { 
								$tumbon = $data->CorpInfo->branches->branch[$b]->tumbon;
							  }else{
								$tumbon = "-"; 
							  }
							  if(empty($tumbon)){
								  $tumbon ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"ampur")) { 
								$ampur = $data->CorpInfo->branches->branch[$b]->ampur;
							  }else{
								$ampur = "-"; 
							  }
							  if(empty($ampur)){
								  $ampur ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"province")) { 
								$province = $data->CorpInfo->branches->branch[$b]->province;
							  }else{
								$province = "-"; 
							  }
							  if(empty($province)){
								  $province ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"tumbonCode")) { 
								$tumbonCode = $data->CorpInfo->branches->branch[$b]->tumbonCode;
							  }else{
								$tumbonCode = "-"; 
							  }
							  if(empty($tumbonCode)){
								  $tumbonCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"ampurCode")) { 
								$ampurCode = $data->CorpInfo->branches->branch[$b]->ampurCode; 
							  }else{
								$ampurCode = "-"; 
							  }
							  if(empty($ampurCode)){
								  $ampurCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"provinceCode")) { 
								$provinceCode = $data->CorpInfo->branches->branch[$b]->provinceCode;  
							  }else{
								$provinceCode = "-"; 
							  }
							  if(empty($provinceCode)){
								  $provinceCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"zipCode")) { 
								$zipCode = $data->CorpInfo->branches->branch[$b]->zipCode;   
							  }else{
								$zipCode = "-"; 
							  }
							  if(empty($zipCode)){
								  $zipCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"phoneNumber")) { 
								$phoneNumber = $data->CorpInfo->branches->branch[$b]->phoneNumber;   
							  }else{
								$phoneNumber = "-"; 
							  }
							  if(empty($phoneNumber)){
								  $phoneNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"faxNumber")) { 
								$faxNumber = $data->CorpInfo->branches->branch[$b]->faxNumber;   
							  }else{
								$faxNumber = "-"; 
							  }
							  if(empty($faxNumber)){
								  $faxNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"email")) { 
								$email = $data->CorpInfo->branches->branch[$b]->email;   
							  }else{
								$email = "-"; 
							  }
							  if(empty($email)){
								  $email ='-';
							  }
							  
							  //echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
							  
							  //ค้นหา สปส รับผิดชอบ ----------------------------------------------------------
							  	$ampcode1 = $provinceCode . $ampurCode;
								//echo "{$ampcode1} <br>";exit;
								$dd1=WpdSpnLtSsobran::model()->findByAttributes(array('ZONE_AMPUR_CODE'=>$ampcode1));
								//$c = count($dd1);
								//echo "*** {$c} *** <br>";
								if($dd1){ //($c != 0){
									$SSO_BRAN_CODE = $dd1->SSO_BRAN_CODE;	
								}else{
							  		$SSO_BRAN_CODE = '-';
								}
								//echo "--- {$SSO_BRAN_CODE} ---<br>";
							  //--------------------------------------------------------------------------
							  
							  //sava data branch========================================
							  	//--- getlast cropid ------//
								$qlc = new CDbCriteria( array(
									'condition' => "crop_status = :crop_status ORDER BY crop_id DESC LIMIT 0,1 ",
									'params'    => array(':crop_status' => 1)  //  $statusgt
								));
								 $rlc = CropinfoTmpTb::model()->findAll($qlc);
								 $clc = count($rlc);
								 if($clc>0){
									 foreach ($rlc as $rows){
										 $lastcrop_id = $rows->crop_id;
									 }
								 }else{
									 $lastcrop_id = 0;
								 }
								
								 //* @property integer $brch_id
								 $BranchMasTb = new BranchTmpTb();
								 
								 $BranchMasTb->crop_id = $lastcrop_id;
								 $BranchMasTb->registernumber = $registerNumber;
								 $BranchMasTb->tsic = $tsic;
								 $BranchMasTb->corptype = $corpType;
								 $BranchMasTb->ordernumber = $orderNumber;
								 $BranchMasTb->name = $name;
								 $BranchMasTb->houseid = $houseId;
								 $BranchMasTb->housenumber = $houseNumber;
								 $BranchMasTb->buildingname = $buildingName;
								 $BranchMasTb->buildingnumber = $buildingNumber;
								 $BranchMasTb->buildingfloor = $buildingFloor;
								 $BranchMasTb->village = $village;
								 $BranchMasTb->moo = $moo;
								 $BranchMasTb->soi = $Soi;
								 $BranchMasTb->road = $Road;
								 $BranchMasTb->tumbon = $tumbon;
								 $BranchMasTb->tumboncode = $tumbonCode;
								 $BranchMasTb->ampur = $ampur;
								 $BranchMasTb->ampurcode = $ampurCode;
								 $BranchMasTb->province = $province;
								 $BranchMasTb->provincecode = $provinceCode;
								 $BranchMasTb->zipcode = $zipCode;
								 $BranchMasTb->phonenumber = $phoneNumber;
								 $BranchMasTb->faxnumber = $faxNumber;
								 $BranchMasTb->email = $email;
								 $BranchMasTb->brch_remark = $SSO_BRAN_CODE;
								 $BranchMasTb->brch_createby = $this->username;
								 $BranchMasTb->brch_createtime = date('Y-m-d H:i:s');
								 $BranchMasTb->brch_updateby = $this->username;
								 $BranchMasTb->brch_updatetime = date('Y-m-d H:i:s');
								 $BranchMasTb->brch_status = 1;
								 
								 if($dupstate == 0){
								   if($BranchMasTb->save()){
						   			  //echo "Save branch is success.";	
								   }else{
									  $msgerror =  $BranchMasTb->getErrors();
									  echo "{$msgerror} <br>";
								   }//if($BranchMasTb->save()) 
								 }
							  //========================================================
							  
						 }//for
					}else{//if(is_array($data->CorpInfoList->corpInfo[$f]->branches->branch))
						 $countbranches=1;
						 if(property_exists($data->CorpInfo->branches->branch,"name")) { 
							$name = $data->CorpInfo->branches->branch->name;
						  }else{
							$name = "-"; 
						  }
						  if(empty($name)){
							  $name ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"orderNumber")) { 
							$orderNumber = $data->CorpInfo->branches->branch->orderNumber; 
						  }else{
							$orderNumber = 0; 
						  }
						  if(empty($orderNumber)){
							  $orderNumber =0;
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"houseId")) { 
							$houseId = $data->CorpInfo->branches->branch->houseId;
						  }else{
							$houseId = "-"; 
						  }
						  if(empty($houseId)){
							  $houseId ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"houseNumber")) { 
							$houseNumber = $data->CorpInfo->branches->branch->houseNumber;
						  }else{
							$houseNumber = "-"; 
						  }
						  if(empty($houseNumber)){
							  $houseNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingName")) { 
							$buildingName = $data->CorpInfo->branches->branch->buildingName; 
						  }else{
							$buildingName = "-"; 
						  }
						  if(empty($buildingName)){
							  $buildingName ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingNumber")) { 
							$buildingNumber = $data->CorpInfo->branches->branch->buildingNumber; 
						  }else{
							$buildingNumber = "-"; 
						  }
						  if(empty($buildingNumber)){
							  $buildingNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingFloor")) { 
							$buildingFloor = $data->CorpInfo->branches->branch->buildingFloor; 
						  }else{
							$buildingFloor = "-"; 
						  }
						  if(empty($buildingFloor)){
							  $buildingFloor ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"village")) { 
							$village = $data->CorpInfo->branches->branch->village;
						  }else{
							$village = "-"; 
						  }
						  if(empty($village)){
							  $village ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"moo")) { 
							$moo = $data->CorpInfo->branches->branch->moo;
						  }else{
							$moo = "-"; 
						  }
						  if(empty($moo)){
							  $moo ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"Soi")) { 
							$Soi = $data->CorpInfo->branches->branch->Soi;
						  }else{
							$Soi = "-"; 
						  }
						  if(empty($Soi)){
							  $Soi ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"Road")) { 
							$Road = $data->CorpInfo->branches->branch->Road;
						  }else{
							$Road = "-"; 
						  }
						  if(empty($Road)){
							  $Road ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"tumbon")) { 
							$tumbon = $data->CorpInfo->branches->branch->tumbon;
						  }else{
							$tumbon = "-"; 
						  }
						  if(empty($tumbon)){
							  $tumbon ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"ampur")) { 
							$ampur = $data->CorpInfo->branches->branch->ampur;
						  }else{
							$ampur = "-"; 
						  }
						  if(empty($ampur)){
							  $ampur ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"province")) { 
							$province = $data->CorpInfo->branches->branch->province;
						  }else{
							$province = "-"; 
						  }
						  if(empty($province)){
							  $province ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"tumbonCode")) { 
							$tumbonCode = $data->CorpInfo->branches->branch->tumbonCode;
						  }else{
							$tumbonCode = "-"; 
						  }
						  if(empty($tumbonCode)){
							  $tumbonCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"ampurCode")) { 
							$ampurCode = $data->CorpInfo->branches->branch->ampurCode; 
						  }else{
							$ampurCode = "-"; 
						  }
						  if(empty($ampurCode)){
							  $ampurCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"provinceCode")) { 
							$provinceCode = $data->CorpInfo->branches->branch->provinceCode;  
						  }else{
							$provinceCode = "-"; 
						  }
						  if(empty($provinceCode)){
							  $provinceCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"zipCode")) { 
							$zipCode = $data->CorpInfo->branches->branch->zipCode;   
						  }else{
							$zipCode = "-"; 
						  }
						  if(empty($zipCode)){
							  $zipCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"phoneNumber")) { 
							$phoneNumber = $data->CorpInfo->branches->branch->phoneNumber;   
						  }else{
							$phoneNumber = "-"; 
						  }
						  if(empty($phoneNumber)){
							  $phoneNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"faxNumber")) { 
							$faxNumber = $data->CorpInfo->branches->branch->faxNumber;   
						  }else{
							$faxNumber = "-"; 
						  }
						  if(empty($faxNumber)){
							  $faxNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"email")) { 
							$email = $data->CorpInfo->branches->branch->email;   
						  }else{
							$email = "-"; 
						  }
						  if(empty($email)){
							  $email ='-';
						  }
						  
						   //echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
						   
						    //ค้นหา สปส รับผิดชอบ ----------------------------------------------------------
							  	$ampcode1 = $provinceCode . $ampurCode;
								//echo "{$ampcode1} <br>";
								$dd1=WpdSpnLtSsobran::model()->findByAttributes(array('ZONE_AMPUR_CODE'=>$ampcode1));
								//$c = count($dd1);
								//echo "*** {$c} *** <br>";
								if($dd1){
									$SSO_BRAN_CODE = $dd1->SSO_BRAN_CODE;	
								}else{
							  		$SSO_BRAN_CODE = '-';
								}
								//echo "--- {$SSO_BRAN_CODE} ---<br>";
							  //--------------------------------------------------------------------------
						   
						 //save branch==============================================
						 	//--- getlast cropid ------//
							$qlc = new CDbCriteria( array(
								'condition' => "crop_status = :crop_status ORDER BY crop_id DESC LIMIT 0,1 ",
								'params'    => array(':crop_status' => 1)  //  $statusgt
							));
							 $rlc = CropinfoTmpTb::model()->findAll($qlc);
							 $clc = count($rlc);
							 if($clc>0){
								 foreach ($rlc as $rows){
									 $lastcrop_id = $rows->crop_id;
								 }
							 }else{
								 $lastcrop_id = 0;
							 }
							
							 //* @property integer $brch_id
							 $BranchMasTb = new BranchTmpTb();
							 
							 $BranchMasTb->crop_id = $lastcrop_id;
							 $BranchMasTb->registernumber = $registerNumber;
							 $BranchMasTb->tsic = $tsic;
							 $BranchMasTb->corptype = $corpType;
							 $BranchMasTb->ordernumber = $orderNumber;
							 $BranchMasTb->name = $name;
							 $BranchMasTb->houseid = $houseId;
							 $BranchMasTb->housenumber = $houseNumber;
							 $BranchMasTb->buildingname = $buildingName;
							 $BranchMasTb->buildingnumber = $buildingNumber;
							 $BranchMasTb->buildingfloor = $buildingFloor;
							 $BranchMasTb->village = $village;
							 $BranchMasTb->moo = $moo;
							 $BranchMasTb->soi = $Soi;
							 $BranchMasTb->road = $Road;
							 $BranchMasTb->tumbon = $tumbon;
							 $BranchMasTb->tumboncode = $tumbonCode;
							 $BranchMasTb->ampur = $ampur;
							 $BranchMasTb->ampurcode = $ampurCode;
							 $BranchMasTb->province = $province;
							 $BranchMasTb->provincecode = $provinceCode;
							 $BranchMasTb->zipcode = $zipCode;
							 $BranchMasTb->phonenumber = $phoneNumber;
							 $BranchMasTb->faxnumber = $faxNumber;
							 $BranchMasTb->email = $email;
							 $BranchMasTb->brch_remark = $SSO_BRAN_CODE;
							 $BranchMasTb->brch_createby = $this->username;
							 $BranchMasTb->brch_createtime = date('Y-m-d H:i:s');
							 $BranchMasTb->brch_updateby = $this->username;
							 $BranchMasTb->brch_updatetime = date('Y-m-d H:i:s');
							 $BranchMasTb->brch_status = 1;
							 
							 if($dupstate == 0){
							   if($BranchMasTb->save()){
					   			  //echo "Save Branch is success.";
							   }else{
								  $msgerror =  $BranchMasTb->getErrors();
								  echo "{$msgerror}";
							   }//if($BranchMasTb->save()) 
							 }
						 //=========================================================  
									
					}//else if is_array
				}else{//if(property_exists($data->CorpInfo,"branches"))
					$countbranches=0;
				}//else if
				//========================================================
				
			}//if($countcorpinfo != 0)
		//}catch (Exception $e){
			//echo "ไม่สามารถ Call Service จากกรมพัฒนาธุรกิจการค้าได้ กรุณาติตต่อผู้ดูแลระบบ!";
		//}
		
		  //$msg = $data;
		  
		  //return $msg;
	}//function
	
	public function GenSsoNumber(){
		
		$q = new CDbCriteria( array(
			'condition' => "registernumber = :registernumber ",
			'params'    => array(':registernumber' => $this->registernumber )
		));
		
		 $r = CropinfoTmpTb::model()->findAll($q);
		 $c = count($r);
		 //echo "Count of data is update {$c} Record. <br>";
		 foreach ($r as $rows){
			$crop_id = $rows->crop_id;  
			$registernumber = $rows->registernumber;
			$regisarr = str_split($registernumber);
			$provicecode = $regisarr[1] . $regisarr[2];	 
			
			//echo "{$crop_id}, {$provicecode} <br>";
			
			$q2 = new CDbCriteria( array(
			  'condition' => "prvi_code = :prvi_code ",
			  'params'    => array(':prvi_code' => $provicecode)
			));	
			$r2 = ProviceTb::model()->findAll($q2);
			$c2 = count($r2);
			foreach ($r2 as $rows){
				$prvi_id = $rows->prvi_id;
				$lastnum = $rows->prvi_remark;
			}
			$rowcountpv = $lastnum + 1;
			
			//echo "{$prvi_id}, {$lastnum}, {$rowcountpv}<br>";
			
			$dg12 = $provicecode;
			$dg3 = "2";
			$dg49 = str_pad($rowcountpv, 6, 0, STR_PAD_LEFT);
			
			$accno = $dg12 . $dg3 . $dg49;
			
			$sarray = str_split($accno);
			
			//****** gen check digit ****************************
			  $dd1 =  $sarray[0] * 10;
			  $dd2 =  $sarray[1] *	9;
			  $dd3 =  $sarray[2] *	8;
			  $dd4 =  $sarray[3] *	7;
			  $dd5 =  $sarray[4] *	6;
			  $dd6 =  $sarray[5] *	5;
			  $dd7 =  $sarray[6] *	4;
			  $dd8 =  $sarray[7] *	3;
			  $dd9 =  $sarray[8] *	2;
			  
			  $sumdd = $dd1 + $dd2 + $dd3 + $dd4 + $dd5 + $dd6 + $dd7 + $dd8 + $dd9;	
			  $mod11 = $sumdd % 11; 
			  if($mod11==0){
				 $div11 = 1;
			  }else if($mod11==1){
				 $div11 = 0; 
			  }else{
				 $div11 = 11-$mod11;  
			  }
			//****** end gen check digit ****************************  
			
			$accnogen = $dg12 . $dg3 . $dg49 . $div11;
			
			//echo "{$accnogen} <br>";
			
			//ค้นหา รายการตาม registernumber แล้วตรวจสอบว่า มี accno = '0000000000' หรือไม่
				$q3 = new CDbCriteria( array(
					'condition' => "registernumber = :registernumber ",
					'params'    => array(':registernumber' => $this->registernumber )
				));
			   $r3 = CropinfoTmpTb::model()->findAll($q3);
		 	   $c3 = count($r3);
			   foreach ($r3 as $rows){
					$crop_id3 = $rows->crop_id; 
					$acc_no3 = $rows->acc_no;
			   }//foreach
			   
			   //echo "{$crop_id3},{$acc_no3} <br>";
			
			if($acc_no3==="0000000000"){
				//echo "Day DEE Day";
			//******* update cropinfo **********************************
				  $update2 = CropinfoTmpTb::model()->findByPk($crop_id);
				  $update2->acc_no = $accnogen;
				  $update2->crop_remark = "P";
				  $update2->crop_updateby = $this->username;
				  $update2->crop_updatetime = date('Y-m-d H:i:s');
				  $update2->crop_status = 2;
				  if($update2->save()){
					  $msgerr = "update data is success.";
				  }else{
					  $msgerr = $update2->getErrors();
					  echo "{$msgerr}<br>";
				  }//if
			  
				  //****** insert accnumber_tb ****************************************
					  $AccnumberTb2 = new AccnumberTb();
					  $AccnumberTb2->acc_no = $accnogen;
					  $AccnumberTb2->acc_bran = "000000";
					  $AccnumberTb2->acc_regis_no = $this->registernumber;
					  $AccnumberTb2->acc_active_flag = "N";
					  $AccnumberTb2->acc_using_date = date('Y-m-d H:i:s');
					  $AccnumberTb2->acc_createby = $this->username;
					  $AccnumberTb2->acc_created = date('Y-m-d H:i:s');
					  $AccnumberTb2->acc_updateby = $this->username;
					  $AccnumberTb2->acc_modified = date('Y-m-d H:i:s');
					  $AccnumberTb2->acc_remark = "P";
					  $AccnumberTb2->acc_status = 2;
					  if($AccnumberTb2->save()){
						//echo "y";
						//echo CJSON::encode(array('status' => 'success'));
						$msgerr2 = "update data is success.";	
						//insert data to crop_v_bran
						$cropid = $crop_id;
						$registernumber = $registernumber;
						Yii::app()->Cwpdreport->createcrop_v_bran($cropid, $registernumber);
					  }else{
						//echo "n";
						//echo CJSON::encode(array('status' => 'error'));
						$msgerr2 = $AccnumberTb2->getErrors();
						echo "{$msgerr2}<br>";
					  }//if	
				  //**********************************************************************
				  
				  //****** update provicetb ********************************
					  $update1 = ProviceTb::model()->findByPk($prvi_id);
					  $update1->prvi_remark = $rowcountpv;
					  if($update1->save()){
						  $msgerr1 = "update data is success.";
					  }else{
						  $msgerr1 = $update1->getErrors();
						  echo "{$msgerr1}<br>";
					  }
				  //********************************************************
				  
				  //echo "{$msgerr}, {$msgerr1}, {$msgerr2} <br>";
				  
			//*****************************************************************************
			}else{//if acc_no=0000000000
				echo "Can't update acc_no. <br>";
			}//else if acc_no='0000000000'
		 }//foreach
		 
	}
	
	public function Getinfofrmdbd(){
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
			"registerNumber" => $this->registernumber //'0305562004027'
		 );
		 
		 try{
		   $data = $client->GetCorpInfoByRegisterNumberService($params);	 
		   //echo '<pre>';var_dump($data);echo '</pre>'; 
		   return $data;
		 }catch (Exception $e){
			echo "<font style='color:red;'><i class='fa fa-warning'></i> ไม่พบข้อมูลนิติบุคคล เลขที่: " . $this->registernumber . "  จากกรมพัฒนาธุรกิจการค้า (DBD) , กรุณาตรวจสอบเลขนิติบุคคลอีกครั้ง !</font>";
		 }//try
	}//function
	
	public function GetinfofrmdbdV5(){
		$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebServiceV5.wsdl';
		$client = new SoapClient($fullPathToWsdl,[
			  'stream_context' => stream_context_create([
				  'ssl' => [
						  'verify_peer' => false,
						  'verify_peer_name' => false,
					  ],
				  ]),
		  ]);
	 
		$params = array(
			"subscribeId" => '6211003',
			"pincode" => 'P@ssw0rd',
			"registerNumber" => $this->registernumber //'0305562004027'
		 );
		 
		 try{
		   $data = $client->GetCorpInfoByRegisterNumberService($params);	 
		   //echo '<pre>';var_dump($data);echo '</pre>'; 
		   return $data;
		 }catch (Exception $e){
			echo "<font style='color:red;'><i class='fa fa-warning'></i> ไม่พบข้อมูลนิติบุคคล เลขที่: " . $this->registernumber . "  จากกรมพัฒนาธุรกิจการค้า (DBD) , กรุณาตรวจสอบเลขนิติบุคคลอีกครั้ง !</font>";
		 }//try
	}//function
	
	public function BackupBrn(){
		//เริ่มค้นหา ข้อมูลสาขาจาก model BranchTmpTb
		$mbrn=BranchTmpTb::model()->findByAttributes(array('registernumber'=>$this->registernumber, 'ordernumber'=>0));
		//var_dump($mbrn);exit;
		//$registernumber0 = $mbrn->registernumber;
		//echo "{$registernumber0}";exit;
	if($mbrn){
		$brch_id = $mbrn->brch_id;
	  	$crop_id = $mbrn->crop_id;
	    $registernumber = $mbrn->registernumber;
	    $tsic = $mbrn->tsic;
	    $corptype = $mbrn->corptype;
	    $ordernumber = $mbrn->ordernumber;
	    $name = $mbrn->name;
	    $houseid = $mbrn->houseid;
	    $housenumber = $mbrn->housenumber;
	    $buildingname = $mbrn->buildingname;
	    $buildingnumber = $mbrn->buildingnumber;
	    $buildingfloor = $mbrn->buildingfloor;
	    $village = $mbrn->village;
	    $moo = $mbrn->moo;
	    $soi = $mbrn->soi;
	    $road = $mbrn->road;
	    $tumbon = $mbrn->tumbon;
	    $tumboncode = $mbrn->tumboncode;
	    $ampur = $mbrn->ampur;
	    $ampurcode = $mbrn->ampurcode;
	    $province = $mbrn->province;
	  	$provincecode = $mbrn->provincecode;
	    $zipcode = $mbrn->zipcode;
	    $phonenumber = $mbrn->phonenumber;
	    $faxnumber = $mbrn->faxnumber;
	    $email = $mbrn->email;
	    $brch_remark = $mbrn->brch_remark;
	    $brch_createby = $mbrn->brch_createby;
	    $brch_createtime = $mbrn->brch_createtime;
	    $brch_updateby = $mbrn->brch_updateby;
	    $brch_updatetime = $mbrn->brch_updatetime;
	    $brch_status = $mbrn->brch_status;
		
		//echo "{$registernumber}, {$ordernumber}, {$ampur}, {$province}"; exit;
				
		//นำข้อมูลบันทึกลงที่ model BranchMasTb
		 $BranchMasTb = new BranchMasTb();
							 
		 $BranchMasTb->crop_id = $crop_id;
		 $BranchMasTb->registernumber = $registernumber;
		 $BranchMasTb->tsic = $tsic;
		 $BranchMasTb->corptype = $corptype;
		 $BranchMasTb->ordernumber = $ordernumber;
		 $BranchMasTb->name = $name;
		 $BranchMasTb->houseid = $houseid;
		 $BranchMasTb->housenumber = $housenumber;
		 $BranchMasTb->buildingname = $buildingname;
		 $BranchMasTb->buildingnumber = $buildingnumber;
		 $BranchMasTb->buildingfloor = $buildingfloor;
		 $BranchMasTb->village = $village;
		 $BranchMasTb->moo = $moo;
		 $BranchMasTb->soi = $soi;
		 $BranchMasTb->road = $road;
		 $BranchMasTb->tumbon = $tumbon;
		 $BranchMasTb->tumboncode = $tumboncode;
		 $BranchMasTb->ampur = $ampur;
		 $BranchMasTb->ampurcode = $ampurcode;
		 $BranchMasTb->province = $province;
		 $BranchMasTb->provincecode = $provincecode;
		 $BranchMasTb->zipcode = $zipcode;
		 $BranchMasTb->phonenumber = $phonenumber;
		 $BranchMasTb->faxnumber = $faxnumber;
		 $BranchMasTb->email = $email;
		 $BranchMasTb->brch_remark = $brch_remark;
		 $BranchMasTb->brch_createby = $brch_createby;
		 $BranchMasTb->brch_createtime = $brch_createtime;
		 $BranchMasTb->brch_updateby = $this->username; //$brch_updateby;
		 $BranchMasTb->brch_updatetime = date('Y-m-d H:i:s'); //$brch_updatetime;
		 $BranchMasTb->brch_status = $brch_status;
		 
		 if($BranchMasTb->save()){
			 //delete data from BranchTmpTb
			 $q = new CDbCriteria( array(
				'condition' => "registernumber = :registernumber ",         
				'params'    => array(':registernumber' => $this->registernumber)  
			 ));
			 $mbrnd=BranchTmpTb::model()->deleteAll($q);
	
			 return true;
			 
		 }else{
			 return false;
		 }
		 
	   }else{//if
	   	 return true;
	   }
		
	}//function
	
	public function UpdateBrn(){
		
		
		//$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebService.wsdl';
		$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebServiceV5.wsdl';
		
		$client = new SoapClient($fullPathToWsdl,[
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
			"registerNumber" => $this->registernumber //'0305562004027'
		 );
		 
		 //try{
		   $data = $client->GetCorpInfoByRegisterNumberService($params);	 
		   //echo '<pre>';var_dump($data);echo '</pre>'; 
		   //exit;
		   
			if(property_exists($data,"CorpInfo")) {
				if(is_array($data->CorpInfo)){
					$countcorpinfo = count($data->CorpInfo);
				}else{
					$countcorpinfo = 1;	
				}
				//echo " count of corpInfo : {$countcorpinfo} <br>";
			}//if(property_exists($data,"CorpInfo"))
			
			if($countcorpinfo != 0){ 
			
				if(property_exists($data->CorpInfo,"tsic")) { 
						   $tsic = $data->CorpInfo->tsic; 
						}else{
						   $tsic = "-"; 
						}
						if(empty($tsic)){
							$tsic = "-";
						}
						if(property_exists($data->CorpInfo,"tsicName")) {
						  $tsicName = $data->CorpInfo->tsicName;
						}else{
						  $tsicName = "-";  
						}
						if(empty($tsicName)){
							$tsicName = "-";
						}
						if(property_exists($data->CorpInfo,"corpType")) {
						  $corpType = $data->CorpInfo->corpType;
						}else{
						   $corpType ='-'; 
						}
						if(empty($corpType)){
							$corpType = "-";
						}
						if(property_exists($data->CorpInfo,"corpTypeName")) {
						  $corpTypeName = $data->CorpInfo->corpTypeName;
						}else{
						   $corpTypeName ='-'; 
						}
						if(empty($corpTypeName)){
							$corpTypeName = "-";
						}
						if(property_exists($data->CorpInfo,"registerNumber")) {
						  $registerNumber = $data->CorpInfo->registerNumber;
						}else{
						  $registerNumber ='-';  
						}
						if(empty($registerNumber)){
							$registerNumber = "-";
						}
						if(property_exists($data->CorpInfo,"registerName")) {
						  $registerName = $data->CorpInfo->registerName;
						}else{
						   $registerName ='-';  
						}
						if(empty($registerName)){
							$registerName = "-";
						}
						if(property_exists($data->CorpInfo,"registerDate")) {
						  $registerDate = $data->CorpInfo->registerDate;
						  $registerDate =  date_create($registerDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}else{
						  $registerDate =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');  //date('Y-m-d H:i:s');
						}
						if(property_exists($data->CorpInfo,"updatedDate")) {
						  $updatedDate = $data->CorpInfo->updatedDate;
						  $updatedDate =  date_create($updatedDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}else{
						  $updatedDate =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}
						if(property_exists($data->CorpInfo,"updatedEntry")) {
						  $updatedEntry = $data->CorpInfo->updatedEntry;
						}else{
						  $updatedEntry ='-'; 
						}
						if(empty($updatedEntry)){
							  $updatedEntry ='-';
						}
						if(property_exists($data->CorpInfo,"authorizedCapital")) {
						  $authorizedCapital = $data->CorpInfo->authorizedCapital; // number_format($data->CorpInfoList->corpInfo[$f]->authorizedCapital,2,".",",");
						}else{
						  $authorizedCapital =0;  
						}
						if(empty($authorizedCapital)){
							$authorizedCapital = 0;
						}
						if(property_exists($data->CorpInfo,"accountingDate")) {
						  $accountingDate = $data->CorpInfo->accountingDate;
						}else{
						  $accountingDate ='-';  
						}
						if(empty($accountingDate)){
							  $accountingDate ='-';
						}
						if(property_exists($data->CorpInfo,"statusCode")) {
						  $statusCode = $data->CorpInfo->statusCode;
						}else{
						  $statusCode ='-';  
						}
						if(empty($statusCode)){
							  $statusCode ='-';
						}
						if(property_exists($data->CorpInfo,"cpower")) {
						  $cpower = $data->CorpInfo->cpower;
						}else{
						  $cpower ='-';  
						}
						if(empty($cpower)){
							  $cpower ='-';
						}
						$now = date_create('now')->format('Y-m-d H:i:s');
						 
						if($statusCode==1){
						   $statusCodef = 'Now'; 
						}else{
						   $statusCodef = 'Old'; 
						}
					
						  
						$df =date_create($registerDate)->format('d-m-Y'); //set format date
						
						//echo " {$registerNumber}, {$tsic}, {$tsicName}, {$corpType}, {$corpTypeName}, {$registerDate}, {$updatedDate}, {$updatedEntry}, {$accountingDate}, {$authorizedCapital}, {$statusCode}, {$cpower} <br>";
						
						//insert data to cropinfotmptb========================================
						/*
						 $CropinfoMasTb = new CropinfoTmpTb();
						
						 //* @property integer $crop_id
						 $CropinfoMasTb->registernumber = $registerNumber;
						 $CropinfoMasTb->registername = $registerName;
						 $CropinfoMasTb->acc_no = "0000000000";
						 $CropinfoMasTb->acc_bran = "000000";
						 $CropinfoMasTb->tsic = $tsic;
						 $CropinfoMasTb->tsicname = $tsicName;
						 $CropinfoMasTb->corptype = $corpType;
						 $CropinfoMasTb->corptypename = $corpTypeName;
						 $CropinfoMasTb->registerdate = $registerDate;
						 $CropinfoMasTb->updateddate = $updatedDate;
						 $CropinfoMasTb->updateentry = $updatedEntry;
						 $CropinfoMasTb->accountingdate = $accountingDate;
						 $CropinfoMasTb->authorizedcapital = $authorizedCapital;
						 $CropinfoMasTb->statuscode = $statusCode;
						 $CropinfoMasTb->cpower = $cpower;
						 $CropinfoMasTb->crop_remark = "N";
						 $CropinfoMasTb->crop_createby = $this->username;
						 $CropinfoMasTb->crop_createtime = date('Y-m-d H:i:s');
						 $CropinfoMasTb->crop_updateby = $this->username;
						 $CropinfoMasTb->crop_updatetime = date('Y-m-d H:i:s');
						 $CropinfoMasTb->crop_status = 1;
						 
						 $qdup = new CDbCriteria( array(
							  'condition' => "registernumber = :registernumber ",
							  'params'    => array(':registernumber' => $registerName)
						  ));
						  
						 $dupstate = 0;
						 $result = CropinfoTmpTb::model()->findAll($qdup);
						 $countresult = count($result);
						 
						 if($countresult==0){
						   if($CropinfoMasTb->save()){
							  $msgerror = "Save data is success.";
							  //echo "{$msgerror}<br>";
						   }else{
							  $msgerror =  $CropinfoMasTb->getErrors();
							  echo "{$msgerror}<br>";
						   }//if($CropinfoMasTb->save())
						 }else if($countresult>0){//if $countresult==0
						 	$dupstate = 1;
						 }
						 */
					//==========================================================
				
				if(property_exists($data->CorpInfo,"committees")) {
					if(is_array($data->CorpInfo->committees->committee)){
						$countcommittees = count($data->CorpInfo->committees->committee); 
						$crow = 1;
						for($c=0;$c<=$countcommittees-1;$c++){
							  if(property_exists($data->CorpInfo->committees->committee[$c],"committeeType")) { 
								 $committeeType = $data->CorpInfo->committees->committee[$c]->committeeType;
							  }else{
								 $committeeType = "-"; 
							  }
							  if(empty($committeeType)){
								  $committeeType ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"orderNumber")) { 
								 $orderNumber = $data->CorpInfo->committees->committee[$c]->orderNumber;
							  }else{
								 $orderNumber = 0; 
							  }
							  if(empty($orderNumber)){
								  $orderNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"identityType")) { 
								 $identityType = $data->CorpInfo->committees->committee[$c]->identityType;
							  }else{
								 $identityType = "-"; 
							  }
							  if(empty($identityType)){
								  $identityType ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"identity")) { 
								$identity = $data->CorpInfo->committees->committee[$c]->identity; 
							  }else{
								 $identity = "-"; 
							  }
							  if(empty($identity)){
								  $identity ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"title")) { 
								$title = $data->CorpInfo->committees->committee[$c]->title; 
							  }else{
								 $title = "-"; 
							  }
							  if(empty($title)){
								  $title ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"firstName")) { 
								$firstName = $data->CorpInfo->committees->committee[$c]->firstName;
							  }else{
								$firstName = "-"; 
							  }
							  if(empty($firstName)){
								  $firstName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"lastName")) { 
								$lastName = $data->CorpInfo->committees->committee[$c]->lastName; 
							  }else{
								$lastName = "-"; 
							  }
							  if(empty($lastName)){
								  $lastName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishTitle")) { 
								$englishTitle = $data->CorpInfo->committees->committee[$c]->englishTitle;  
							  }else{
								$englishTitle = "-"; 
							  }
							  if(empty($englishTitle)){
								  $englishTitle ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishFirstName")) { 
								$englishFirstName = $data->CorpInfo->committees->committee[$c]->englishFirstName;  
							  }else{
								$englishFirstName = "-"; 
							  }
							  if(empty($englishFirstName)){
								  $englishFirstName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishLastName")) { 
								$englishLastName = $data->CorpInfo->committees->committee[$c]->englishLastName;
							  }else{
								$englishLastName = "-"; 
							  }
							  if(empty($englishLastName)){
								  $englishLastName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"nationality")) { 
								$nationality = $data->CorpInfo->committees->committee[$c]->nationality;
							  }else{
								$nationality = "-"; 
							  }
							  if(empty($nationality)){
								  $nationality ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"dateOfBirth")) {
								$dateOfBirth = $data->CorpInfo->committees->committee[$c]->dateOfBirth;
								$dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
							  }else{
								$dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
							  }
							  
							  //echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
							  
							  		//--- getlast cropid ------//
									/*
									$qlc = new CDbCriteria( array(
										'condition' => "crop_status = :crop_status ORDER BY crop_id DESC LIMIT 0,1 ",
										'params'    => array(':crop_status' => 1)  //  $statusgt
									));
									 $rlc = CropinfoTmpTb::model()->findAll($qlc);
									 $clc = count($rlc);
									 if($clc>0){
										 foreach ($rlc as $rows){
											 $lastcrop_id = $rows->crop_id;
										 }
									 }else{
										 $lastcrop_id = 0;
									 }
									
									$CommitteeMasTb = new CommitteeTmpTb();
									 //* @property integer $cmit_id
									 $CommitteeMasTb->crop_id = $lastcrop_id;
									 $CommitteeMasTb->registernumber = $registerNumber;
									 $CommitteeMasTb->tsic = $tsic;
									 $CommitteeMasTb->corptype = $corpType;
									 $CommitteeMasTb->committeetype = $committeeType;
									 $CommitteeMasTb->ordernumber = $orderNumber;
									 $CommitteeMasTb->typeno = $identityType;
									 $CommitteeMasTb->identity = $identity;
									 $CommitteeMasTb->birthday = $dateOfBirth;
									 $CommitteeMasTb->title = $title;
									 $CommitteeMasTb->firstname = $firstName;
									 $CommitteeMasTb->lastname = $lastName;
									 $CommitteeMasTb->englishtitle = $englishTitle;
									 $CommitteeMasTb->englishfirstname12 =  $englishFirstName;
									 $CommitteeMasTb->englishlastname = $englishLastName;
									 $CommitteeMasTb->nation = $nationality;
									 $CommitteeMasTb->cmit_remark = "-";
									 $CommitteeMasTb->cmit_createby = $this->username;
									 $CommitteeMasTb->cmit_createtime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_updateby = $this->username;
									 $CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_status = 1;
									 
									 if($dupstate == 0){
									   if($CommitteeMasTb->save()){
							   				//echo "Save committee is success.<br>";
									   }else{
										  $msgerror =  $CommitteeMasTb->getErrors();
										  echo "{$msgerror}";
									   }//if($CommitteeMasTb->save())
									 }
									 */
									 
									//====================================================
						}//for
						
					}else{//if(is_array($data->CorpInfo->committees->committee))
						$countcommittees = 1;
						if(property_exists($data->CorpInfo->committees->committee,"committeeType")) { 
						   $committeeType = $data->CorpInfo->committees->committee->committeeType;
						}else{
						   $committeeType = "-"; 
						}
						if(empty($committeeType)){
							$committeeType ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"orderNumber")) { 
						   $orderNumber = $data->CorpInfo->committees->committee->orderNumber;
						}else{
						   $orderNumber = 0; 
						}
						if(empty($orderNumber)){
							$orderNumber ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"identityType")) { 
						   $identityType = $data->CorpInfo->committees->committee->identityType;
						}else{
						   $identityType = "-"; 
						}
						if(empty($identityType)){
							$identityType ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"identity")) { 
						  $identity = $data->CorpInfo->committees->committee->identity; 
						}else{
						   $identity = "-"; 
						}
						if(empty($identity)){
							$identity ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"title")) { 
						  $title = $data->CorpInfo->committees->committee->title; 
						}else{
						   $title = "-"; 
						}
						if(empty($title)){
							$title ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"firstName")) { 
						  $firstName = $data->CorpInfo->committees->committee->firstName;
						}else{
						  $firstName = "-"; 
						}
						if(empty($firstName)){
							$firstName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"lastName")) { 
						  $lastName = $data->CorpInfo->committees->committee->lastName; 
						}else{
						  $lastName = "-"; 
						}
						if(empty($lastName)){
							$lastName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishTitle")) { 
						  $englishTitle = $data->CorpInfo->committees->committee->englishTitle;  
						}else{
						  $englishTitle = "-"; 
						}
						if(empty($englishTitle)){
							$englishTitle ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishFirstName")) { 
						  $englishFirstName = $data->CorpInfo->committees->committee->englishFirstName;  
						}else{
						  $englishFirstName = "-"; 
						}
						if(empty($englishFirstName)){
							$englishFirstName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishLastName")) { 
						  $englishLastName = $data->CorpInfo->committees->committee->englishLastName;
						}else{
						  $englishLastName = "-"; 
						}
						if(empty($englishLastName)){
							$englishLastName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"nationality")) { 
						  $nationality = $data->CorpInfo->committees->committee->nationality;
						}else{
						  $nationality = "-"; 
						}
						if(empty($nationality)){
							$nationality ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"dateOfBirth")) {
						  $dateOfBirth = $data->CorpInfo->committees->committee->dateOfBirth;
						  $dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
						}else{
						  $dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
						}
						
						
						//echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
						
									//--- getlast cropid ------//
									/*
									$qlc = new CDbCriteria( array(
										'condition' => "crop_status = :crop_status ORDER BY crop_id DESC LIMIT 0,1 ",
										'params'    => array(':crop_status' => 1)  //  $statusgt
									));
									 $rlc = CropinfoTmpTb::model()->findAll($qlc);
									 $clc = count($rlc);
									 if($clc>0){
										 foreach ($rlc as $rows){
											 $lastcrop_id = $rows->crop_id;
										 }
									 }else{
										 $lastcrop_id = 0;
									 }
									
									$CommitteeMasTb = new CommitteeTmpTb();
									 //* @property integer $cmit_id
									 $CommitteeMasTb->crop_id = $lastcrop_id;
									 $CommitteeMasTb->registernumber = $registerNumber;
									 $CommitteeMasTb->tsic = $tsic;
									 $CommitteeMasTb->corptype = $corpType;
									 $CommitteeMasTb->committeetype = $committeeType;
									 $CommitteeMasTb->ordernumber = $orderNumber;
									 $CommitteeMasTb->typeno = $identityType;
									 $CommitteeMasTb->identity = $identity;
									 $CommitteeMasTb->birthday = $dateOfBirth;
									 $CommitteeMasTb->title = $title;
									 $CommitteeMasTb->firstname = $firstName;
									 $CommitteeMasTb->lastname = $lastName;
									 $CommitteeMasTb->englishtitle = $englishTitle;
									 $CommitteeMasTb->englishfirstname12 =  $englishFirstName;
									 $CommitteeMasTb->englishlastname = $englishLastName;
									 $CommitteeMasTb->nation = $nationality;
									 $CommitteeMasTb->cmit_remark = "-";
									 $CommitteeMasTb->cmit_createby = $this->username;
									 $CommitteeMasTb->cmit_createtime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_updateby = $this->username;
									 $CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_status = 1;
									 
									 if($dupstate == 0){
									   if($CommitteeMasTb->save()){
							   			  //echo "Save committee is success.<br>";	
									   }else{
										  $msgerror =  $CommitteeMasTb->getErrors();
										  echo "{$msgerror}<br>";
									   }//if($CommitteeMasTb->save())
									 }
									 */
									 
									 //=============================================================
						
					}//else if
			
				}else{//if(property_exists($data->CorpInfo,"committees"))
					$countcommittees = 0;
				}//else if
				
				
				//branch data xml=========================================
				if(property_exists($data->CorpInfo,"branches")) {
					if(is_array($data->CorpInfo->branches->branch)){
						 $countbranches = count($data->CorpInfo->branches->branch);
						 $brow = 1;
						 for($b=0;$b<=$countbranches-1;$b++){
							  if(property_exists($data->CorpInfo->branches->branch[$b],"name")) { 
								$name = $data->CorpInfo->branches->branch[$b]->name;
							  }else{
								$name = "-"; 
							  }
							  if(empty($name)){
								  $name ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"orderNumber")) { 
								$orderNumber = $data->CorpInfo->branches->branch[$b]->orderNumber; 
							  }else{
								$orderNumber = 0; 
							  }
							  if(empty($orderNumber)){
								  $orderNumber =0;
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"houseId")) { 
								$houseId = $data->CorpInfo->branches->branch[$b]->houseId;
							  }else{
								$houseId = "-"; 
							  }
							  if(empty($houseId)){
								  $houseId ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"houseNumber")) { 
								$houseNumber = $data->CorpInfo->branches->branch[$b]->houseNumber;
							  }else{
								$houseNumber = "-"; 
							  }
							  if(empty($houseNumber)){
								  $houseNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingName")) { 
								$buildingName = $data->CorpInfo->branches->branch[$b]->buildingName; 
							  }else{
								$buildingName = "-"; 
							  }
							  if(empty($buildingName)){
								  $buildingName ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingNumber")) { 
								$buildingNumber = $data->CorpInfo->branches->branch[$b]->buildingNumber; 
							  }else{
								$buildingNumber = "-"; 
							  }
							  if(empty($buildingNumber)){
								  $buildingNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingFloor")) { 
								$buildingFloor = $data->CorpInfo->branches->branch[$b]->buildingFloor; 
							  }else{
								$buildingFloor = "-"; 
							  }
							  if(empty($buildingFloor)){
								  $buildingFloor ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"village")) { 
								$village = $data->CorpInfo->branches->branch[$b]->village;
							  }else{
								$village = "-"; 
							  }
							  if(empty($village)){
								  $village ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"moo")) { 
								$moo = $data->CorpInfo->branches->branch[$b]->moo;
							  }else{
								$moo = "-"; 
							  }
							  if(empty($moo)){
								  $moo ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"Soi")) { 
								$Soi = $data->CorpInfo->branches->branch[$b]->Soi;
							  }else{
								$Soi = "-"; 
							  }
							  if(empty($Soi)){
								  $Soi ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"Road")) { 
								$Road = $data->CorpInfo->branches->branch[$b]->Road;
							  }else{
								$Road = "-"; 
							  }
							  if(empty($Road)){
								  $Road ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"tumbon")) { 
								$tumbon = $data->CorpInfo->branches->branch[$b]->tumbon;
							  }else{
								$tumbon = "-"; 
							  }
							  if(empty($tumbon)){
								  $tumbon ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"ampur")) { 
								$ampur = $data->CorpInfo->branches->branch[$b]->ampur;
							  }else{
								$ampur = "-"; 
							  }
							  if(empty($ampur)){
								  $ampur ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"province")) { 
								$province = $data->CorpInfo->branches->branch[$b]->province;
							  }else{
								$province = "-"; 
							  }
							  if(empty($province)){
								  $province ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"tumbonCode")) { 
								$tumbonCode = $data->CorpInfo->branches->branch[$b]->tumbonCode;
							  }else{
								$tumbonCode = "-"; 
							  }
							  if(empty($tumbonCode)){
								  $tumbonCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"ampurCode")) { 
								$ampurCode = $data->CorpInfo->branches->branch[$b]->ampurCode; 
							  }else{
								$ampurCode = "-"; 
							  }
							  if(empty($ampurCode)){
								  $ampurCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"provinceCode")) { 
								$provinceCode = $data->CorpInfo->branches->branch[$b]->provinceCode;  
							  }else{
								$provinceCode = "-"; 
							  }
							  if(empty($provinceCode)){
								  $provinceCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"zipCode")) { 
								$zipCode = $data->CorpInfo->branches->branch[$b]->zipCode;   
							  }else{
								$zipCode = "-"; 
							  }
							  if(empty($zipCode)){
								  $zipCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"phoneNumber")) { 
								$phoneNumber = $data->CorpInfo->branches->branch[$b]->phoneNumber;   
							  }else{
								$phoneNumber = "-"; 
							  }
							  if(empty($phoneNumber)){
								  $phoneNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"faxNumber")) { 
								$faxNumber = $data->CorpInfo->branches->branch[$b]->faxNumber;   
							  }else{
								$faxNumber = "-"; 
							  }
							  if(empty($faxNumber)){
								  $faxNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"email")) { 
								$email = $data->CorpInfo->branches->branch[$b]->email;   
							  }else{
								$email = "-"; 
							  }
							  if(empty($email)){
								  $email ='-';
							  }
							  
							  //echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
							  
							  //ค้นหา สปส รับผิดชอบ ----------------------------------------------------------
							  	$ampcode1 = $provinceCode . $ampurCode;
								//echo "{$ampcode1} <br>";
								$dd1=WpdSpnLtSsobran::model()->findByAttributes(array('ZONE_AMPUR_CODE'=>$ampcode1));
								//$c = count($dd1);
								//echo "*** {$c} *** <br>";
								if($dd1){
									$SSO_BRAN_CODE = $dd1->SSO_BRAN_CODE;	
								}else{
							  		$SSO_BRAN_CODE = '-';
								}
								//echo "--- {$SSO_BRAN_CODE} ---<br>";
							  //--------------------------------------------------------------------------
							  
							  //sava data branch========================================
							  	//--- getlast cropid ------//
								$qlc = new CDbCriteria( array(
									'condition' => "registernumber = :registernumber ORDER BY crop_id DESC LIMIT 0,1 ",
									'params'    => array(':registernumber' => $this->registernumber)  //  $statusgt
								));
								 $rlc = CropinfoTmpTb::model()->findAll($qlc);
								 $clc = count($rlc);
								 if($clc>0){
									 foreach ($rlc as $rows){
										 $lastcrop_id = $rows->crop_id;
									 }
								 }else{
									 $lastcrop_id = 0;
								 }
								
								 //* @property integer $brch_id
								 $BranchMasTb = new BranchTmpTb();
								 
								 $BranchMasTb->crop_id = $lastcrop_id;
								 $BranchMasTb->registernumber = $registerNumber;
								 $BranchMasTb->tsic = $tsic;
								 $BranchMasTb->corptype = $corpType;
								 $BranchMasTb->ordernumber = $orderNumber;
								 $BranchMasTb->name = $name;
								 $BranchMasTb->houseid = $houseId;
								 $BranchMasTb->housenumber = $houseNumber;
								 $BranchMasTb->buildingname = $buildingName;
								 $BranchMasTb->buildingnumber = $buildingNumber;
								 $BranchMasTb->buildingfloor = $buildingFloor;
								 $BranchMasTb->village = $village;
								 $BranchMasTb->moo = $moo;
								 $BranchMasTb->soi = $Soi;
								 $BranchMasTb->road = $Road;
								 $BranchMasTb->tumbon = $tumbon;
								 $BranchMasTb->tumboncode = $tumbonCode;
								 $BranchMasTb->ampur = $ampur;
								 $BranchMasTb->ampurcode = $ampurCode;
								 $BranchMasTb->province = $province;
								 $BranchMasTb->provincecode = $provinceCode;
								 $BranchMasTb->zipcode = $zipCode;
								 $BranchMasTb->phonenumber = $phoneNumber;
								 $BranchMasTb->faxnumber = $faxNumber;
								 $BranchMasTb->email = $email;
								 $BranchMasTb->brch_remark = $SSO_BRAN_CODE;
								 $BranchMasTb->brch_createby = $this->username;
								 $BranchMasTb->brch_createtime = date('Y-m-d H:i:s');
								 $BranchMasTb->brch_updateby = $this->username;
								 $BranchMasTb->brch_updatetime = date('Y-m-d H:i:s');
								 $BranchMasTb->brch_status = 1;
								 
								 //if($dupstate == 0){
								   if($BranchMasTb->save()){
						   			  //echo "Save branch is success.";	
								   }else{
									  $msgerror =  $BranchMasTb->getErrors();
									  echo "{$msgerror} <br>";
								   }//if($BranchMasTb->save()) 
								 //}
							  //========================================================
							  
						 }//for
					}else{//if(is_array($data->CorpInfoList->corpInfo[$f]->branches->branch))
						 $countbranches=1;
						 if(property_exists($data->CorpInfo->branches->branch,"name")) { 
							$name = $data->CorpInfo->branches->branch->name;
						  }else{
							$name = "-"; 
						  }
						  if(empty($name)){
							  $name ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"orderNumber")) { 
							$orderNumber = $data->CorpInfo->branches->branch->orderNumber; 
						  }else{
							$orderNumber = 0; 
						  }
						  if(empty($orderNumber)){
							  $orderNumber =0;
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"houseId")) { 
							$houseId = $data->CorpInfo->branches->branch->houseId;
						  }else{
							$houseId = "-"; 
						  }
						  if(empty($houseId)){
							  $houseId ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"houseNumber")) { 
							$houseNumber = $data->CorpInfo->branches->branch->houseNumber;
						  }else{
							$houseNumber = "-"; 
						  }
						  if(empty($houseNumber)){
							  $houseNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingName")) { 
							$buildingName = $data->CorpInfo->branches->branch->buildingName; 
						  }else{
							$buildingName = "-"; 
						  }
						  if(empty($buildingName)){
							  $buildingName ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingNumber")) { 
							$buildingNumber = $data->CorpInfo->branches->branch->buildingNumber; 
						  }else{
							$buildingNumber = "-"; 
						  }
						  if(empty($buildingNumber)){
							  $buildingNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingFloor")) { 
							$buildingFloor = $data->CorpInfo->branches->branch->buildingFloor; 
						  }else{
							$buildingFloor = "-"; 
						  }
						  if(empty($buildingFloor)){
							  $buildingFloor ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"village")) { 
							$village = $data->CorpInfo->branches->branch->village;
						  }else{
							$village = "-"; 
						  }
						  if(empty($village)){
							  $village ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"moo")) { 
							$moo = $data->CorpInfo->branches->branch->moo;
						  }else{
							$moo = "-"; 
						  }
						  if(empty($moo)){
							  $moo ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"Soi")) { 
							$Soi = $data->CorpInfo->branches->branch->Soi;
						  }else{
							$Soi = "-"; 
						  }
						  if(empty($Soi)){
							  $Soi ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"Road")) { 
							$Road = $data->CorpInfo->branches->branch->Road;
						  }else{
							$Road = "-"; 
						  }
						  if(empty($Road)){
							  $Road ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"tumbon")) { 
							$tumbon = $data->CorpInfo->branches->branch->tumbon;
						  }else{
							$tumbon = "-"; 
						  }
						  if(empty($tumbon)){
							  $tumbon ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"ampur")) { 
							$ampur = $data->CorpInfo->branches->branch->ampur;
						  }else{
							$ampur = "-"; 
						  }
						  if(empty($ampur)){
							  $ampur ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"province")) { 
							$province = $data->CorpInfo->branches->branch->province;
						  }else{
							$province = "-"; 
						  }
						  if(empty($province)){
							  $province ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"tumbonCode")) { 
							$tumbonCode = $data->CorpInfo->branches->branch->tumbonCode;
						  }else{
							$tumbonCode = "-"; 
						  }
						  if(empty($tumbonCode)){
							  $tumbonCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"ampurCode")) { 
							$ampurCode = $data->CorpInfo->branches->branch->ampurCode; 
						  }else{
							$ampurCode = "-"; 
						  }
						  if(empty($ampurCode)){
							  $ampurCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"provinceCode")) { 
							$provinceCode = $data->CorpInfo->branches->branch->provinceCode;  
						  }else{
							$provinceCode = "-"; 
						  }
						  if(empty($provinceCode)){
							  $provinceCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"zipCode")) { 
							$zipCode = $data->CorpInfo->branches->branch->zipCode;   
						  }else{
							$zipCode = "-"; 
						  }
						  if(empty($zipCode)){
							  $zipCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"phoneNumber")) { 
							$phoneNumber = $data->CorpInfo->branches->branch->phoneNumber;   
						  }else{
							$phoneNumber = "-"; 
						  }
						  if(empty($phoneNumber)){
							  $phoneNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"faxNumber")) { 
							$faxNumber = $data->CorpInfo->branches->branch->faxNumber;   
						  }else{
							$faxNumber = "-"; 
						  }
						  if(empty($faxNumber)){
							  $faxNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"email")) { 
							$email = $data->CorpInfo->branches->branch->email;   
						  }else{
							$email = "-"; 
						  }
						  if(empty($email)){
							  $email ='-';
						  }
						  
						   //echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
						   
						    //ค้นหา สปส รับผิดชอบ ----------------------------------------------------------
							  	$ampcode1 = $provinceCode . $ampurCode;
								//echo "{$ampcode1} <br>";
								$dd1=WpdSpnLtSsobran::model()->findByAttributes(array('ZONE_AMPUR_CODE'=>$ampcode1));
								//$c = count($dd1);
								//echo "*** {$c} *** <br>";
								if($dd1){
									$SSO_BRAN_CODE = $dd1->SSO_BRAN_CODE;	
								}else{
							  		$SSO_BRAN_CODE = '-';
								}
								//echo "--- {$SSO_BRAN_CODE} ---<br>";
							  //--------------------------------------------------------------------------
						   
						 //save branch==============================================
						 	//--- getlast cropid ------//
							$qlc = new CDbCriteria( array(
									'condition' => "registernumber = :registernumber ORDER BY crop_id DESC LIMIT 0,1 ",
									'params'    => array(':registernumber' => $this->registernumber)  //  $statusgt
								));
							 $rlc = CropinfoTmpTb::model()->findAll($qlc);
							 $clc = count($rlc);
							 if($clc>0){
								 foreach ($rlc as $rows){
									 $lastcrop_id = $rows->crop_id;
								 }
							 }else{
								 $lastcrop_id = 0;
							 }
							
							 //* @property integer $brch_id
							 $BranchMasTb = new BranchTmpTb();
							 
							 $BranchMasTb->crop_id = $lastcrop_id;
							 $BranchMasTb->registernumber = $registerNumber;
							 $BranchMasTb->tsic = $tsic;
							 $BranchMasTb->corptype = $corpType;
							 $BranchMasTb->ordernumber = $orderNumber;
							 $BranchMasTb->name = $name;
							 $BranchMasTb->houseid = $houseId;
							 $BranchMasTb->housenumber = $houseNumber;
							 $BranchMasTb->buildingname = $buildingName;
							 $BranchMasTb->buildingnumber = $buildingNumber;
							 $BranchMasTb->buildingfloor = $buildingFloor;
							 $BranchMasTb->village = $village;
							 $BranchMasTb->moo = $moo;
							 $BranchMasTb->soi = $Soi;
							 $BranchMasTb->road = $Road;
							 $BranchMasTb->tumbon = $tumbon;
							 $BranchMasTb->tumboncode = $tumbonCode;
							 $BranchMasTb->ampur = $ampur;
							 $BranchMasTb->ampurcode = $ampurCode;
							 $BranchMasTb->province = $province;
							 $BranchMasTb->provincecode = $provinceCode;
							 $BranchMasTb->zipcode = $zipCode;
							 $BranchMasTb->phonenumber = $phoneNumber;
							 $BranchMasTb->faxnumber = $faxNumber;
							 $BranchMasTb->email = $email;
							 $BranchMasTb->brch_remark = $SSO_BRAN_CODE;
							 $BranchMasTb->brch_createby = $this->username;
							 $BranchMasTb->brch_createtime = date('Y-m-d H:i:s');
							 $BranchMasTb->brch_updateby = $this->username;
							 $BranchMasTb->brch_updatetime = date('Y-m-d H:i:s');
							 $BranchMasTb->brch_status = 1;
							 
							 //if($dupstate == 0){
							   if($BranchMasTb->save()){
					   			  //echo "Save Branch is success.";
							   }else{
								  $msgerror =  $BranchMasTb->getErrors();
								  echo "{$msgerror}";
							   }//if($BranchMasTb->save()) 
							 //}
						 //=========================================================  
									
					}//else if is_array
				}else{//if(property_exists($data->CorpInfo,"branches"))
					$countbranches=0;
				}//else if
				//========================================================
				
			}//if($countcorpinfo != 0)
		//}catch (Exception $e){
			//echo "ไม่สามารถ Call Service จากกรมพัฒนาธุรกิจการค้าได้ กรุณาติตต่อผู้ดูแลระบบ!";
		//}
		
		  //$msg = $data;
		  //return $msg;
	
	}//function 
	
	
	public function BackupCommittee(){
		//เริ่มค้นหา Committee
		//$mctt=CommitteeTmpTb::model()->findByAttributes(array('registernumber'=>$this->registernumber));
		$qmctt = new CDbCriteria( array(
				'condition' => "registernumber = :registernumber",
				'params'    => array(':registernumber' => $this->registernumber)  //  $statusgt
			));
		$mctt = CommitteeTmpTb::model()->findAll($qmctt);
		$cmctt = count($mctt);
		//echo "{$cmctt}";exit;
		//var_dump($mbrn);exit;
		//$registernumber0 = $mbrn->registernumber;
		//echo "{$registernumber0}";exit;
	if($mctt){
		foreach ($mctt as $rows){
		  
		 $cmit_id = $rows->cmit_id;
		 $crop_id = $rows->crop_id;
		 $registernumber = $rows->registernumber;
		 $tsic = $rows->tsic;
		 $corptype = $rows->corptype;
		 $committeetype = $rows->committeetype;
		 $ordernumber = $rows->ordernumber;
		 $typeno = $rows->typeno;
		 $identity = $rows->identity;
		 $birthday = $rows->birthday;
		 $title = $rows->title;
		 $firstname = $rows->firstname;
		 $lastname = $rows->lastname;
		 $englishtitle = $rows->englishtitle;
		 $englishfirstname12 = $rows->englishfirstname12;
		 $englishlastname = $rows->englishlastname;
		 $nation = $rows->nation;
		 $cmit_remark = $rows->cmit_remark;
		 $cmit_createby = $rows->cmit_createby;
		 $cmit_createtime = $rows->cmit_createtime;
		 $cmit_updateby = $rows->cmit_updateby;
		 $cmit_updatetime = $rows->cmit_updatetime;
		 $cmit_status = $rows->cmit_status;
		 
		
		//echo "{$crop_id}, {$identity}, {$title}, {$firstname}, {$lastname} <br>"; exit;
		
		//insert data to 
		   $CommitteeMasTb = new CommitteeMasTb();
		 
		   $CommitteeMasTb->crop_id = $crop_id;
		   $CommitteeMasTb->registernumber = $registernumber;
		   $CommitteeMasTb->tsic = $tsic;
		   $CommitteeMasTb->corptype = $corptype;
		   $CommitteeMasTb->committeetype = $committeetype;
		   $CommitteeMasTb->ordernumber = $ordernumber;
		   $CommitteeMasTb->typeno = $typeno;
		   $CommitteeMasTb->identity = $identity;
		   $CommitteeMasTb->birthday = $birthday;
		   $CommitteeMasTb->title = $title;
		   $CommitteeMasTb->firstname = $firstname;
		   $CommitteeMasTb->lastname = $lastname;
		   $CommitteeMasTb->englishtitle = $englishtitle;
		   $CommitteeMasTb->englishfirstname12 = $englishfirstname12;
		   $CommitteeMasTb->englishlastname = $englishlastname;
		   $CommitteeMasTb->nation = $nation;
		   $CommitteeMasTb->cmit_remark = $cmit_remark;
		   $CommitteeMasTb->cmit_createby= $cmit_createby;
		   $CommitteeMasTb->cmit_createtime = $cmit_createtime;
		   $CommitteeMasTb->cmit_updateby = $this->username; //$cmit_updateby;
		   $CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s'); //$cmit_updatetime;
		   $CommitteeMasTb->cmit_status = $cmit_status;
		   
		   if($CommitteeMasTb->save()){
				//delete data from  CommitteeTmpTb
			 $q = new CDbCriteria( array(
				'condition' => "registernumber = :registernumber ",         
				'params'    => array(':registernumber' => $this->registernumber)  
			 ));
			 $mcttd=CommitteeTmpTb::model()->deleteAll($q);
	
			 //return true;  
			 
		   }else{
			 //return false;  
		   }
		
		}//foreach
		
	}else{//if
		return true; 
	}
				
	}//function
	
	public function UpdateCommittee(){
		//$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebService.wsdl';
		$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebServiceV5.wsdl';
		
		$client = new SoapClient($fullPathToWsdl,[
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
			"registerNumber" => $this->registernumber //'0305562004027'
		 );
		 
		 //try{
		   $data = $client->GetCorpInfoByRegisterNumberService($params);	 
		   //echo '<pre>';var_dump($data);echo '</pre>'; 
		   //exit;
		   
			if(property_exists($data,"CorpInfo")) {
				if(is_array($data->CorpInfo)){
					$countcorpinfo = count($data->CorpInfo);
				}else{
					$countcorpinfo = 1;	
				}
				//echo " count of corpInfo : {$countcorpinfo} <br>";
			}//if(property_exists($data,"CorpInfo"))
			
			if($countcorpinfo != 0){ 
			
				if(property_exists($data->CorpInfo,"tsic")) { 
						   $tsic = $data->CorpInfo->tsic; 
						}else{
						   $tsic = "-"; 
						}
						if(empty($tsic)){
							$tsic = "-";
						}
						if(property_exists($data->CorpInfo,"tsicName")) {
						  $tsicName = $data->CorpInfo->tsicName;
						}else{
						  $tsicName = "-";  
						}
						if(empty($tsicName)){
							$tsicName = "-";
						}
						if(property_exists($data->CorpInfo,"corpType")) {
						  $corpType = $data->CorpInfo->corpType;
						}else{
						   $corpType ='-'; 
						}
						if(empty($corpType)){
							$corpType = "-";
						}
						if(property_exists($data->CorpInfo,"corpTypeName")) {
						  $corpTypeName = $data->CorpInfo->corpTypeName;
						}else{
						   $corpTypeName ='-'; 
						}
						if(empty($corpTypeName)){
							$corpTypeName = "-";
						}
						if(property_exists($data->CorpInfo,"registerNumber")) {
						  $registerNumber = $data->CorpInfo->registerNumber;
						}else{
						  $registerNumber ='-';  
						}
						if(empty($registerNumber)){
							$registerNumber = "-";
						}
						if(property_exists($data->CorpInfo,"registerName")) {
						  $registerName = $data->CorpInfo->registerName;
						}else{
						   $registerName ='-';  
						}
						if(empty($registerName)){
							$registerName = "-";
						}
						if(property_exists($data->CorpInfo,"registerDate")) {
						  $registerDate = $data->CorpInfo->registerDate;
						  $registerDate =  date_create($registerDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}else{
						  $registerDate =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');  //date('Y-m-d H:i:s');
						}
						if(property_exists($data->CorpInfo,"updatedDate")) {
						  $updatedDate = $data->CorpInfo->updatedDate;
						  $updatedDate =  date_create($updatedDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}else{
						  $updatedDate =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}
						if(property_exists($data->CorpInfo,"updatedEntry")) {
						  $updatedEntry = $data->CorpInfo->updatedEntry;
						}else{
						  $updatedEntry ='-'; 
						}
						if(empty($updatedEntry)){
							  $updatedEntry ='-';
						}
						if(property_exists($data->CorpInfo,"authorizedCapital")) {
						  $authorizedCapital = $data->CorpInfo->authorizedCapital; // number_format($data->CorpInfoList->corpInfo[$f]->authorizedCapital,2,".",",");
						}else{
						  $authorizedCapital =0;  
						}
						if(empty($authorizedCapital)){
							$authorizedCapital = 0;
						}
						if(property_exists($data->CorpInfo,"accountingDate")) {
						  $accountingDate = $data->CorpInfo->accountingDate;
						}else{
						  $accountingDate ='-';  
						}
						if(empty($accountingDate)){
							  $accountingDate ='-';
						}
						if(property_exists($data->CorpInfo,"statusCode")) {
						  $statusCode = $data->CorpInfo->statusCode;
						}else{
						  $statusCode ='-';  
						}
						if(empty($statusCode)){
							  $statusCode ='-';
						}
						if(property_exists($data->CorpInfo,"cpower")) {
						  $cpower = $data->CorpInfo->cpower;
						}else{
						  $cpower ='-';  
						}
						if(empty($cpower)){
							  $cpower ='-';
						}
						$now = date_create('now')->format('Y-m-d H:i:s');
						 
						if($statusCode==1){
						   $statusCodef = 'Now'; 
						}else{
						   $statusCodef = 'Old'; 
						}
					
						  
						$df =date_create($registerDate)->format('d-m-Y'); //set format date
						
						//echo " {$registerNumber}, {$tsic}, {$tsicName}, {$corpType}, {$corpTypeName}, {$registerDate}, {$updatedDate}, {$updatedEntry}, {$accountingDate}, {$authorizedCapital}, {$statusCode}, {$cpower} <br>";
						
						//insert data to cropinfotmptb========================================
						/*
						 $CropinfoMasTb = new CropinfoTmpTb();
						
						 //* @property integer $crop_id
						 $CropinfoMasTb->registernumber = $registerNumber;
						 $CropinfoMasTb->registername = $registerName;
						 $CropinfoMasTb->acc_no = "0000000000";
						 $CropinfoMasTb->acc_bran = "000000";
						 $CropinfoMasTb->tsic = $tsic;
						 $CropinfoMasTb->tsicname = $tsicName;
						 $CropinfoMasTb->corptype = $corpType;
						 $CropinfoMasTb->corptypename = $corpTypeName;
						 $CropinfoMasTb->registerdate = $registerDate;
						 $CropinfoMasTb->updateddate = $updatedDate;
						 $CropinfoMasTb->updateentry = $updatedEntry;
						 $CropinfoMasTb->accountingdate = $accountingDate;
						 $CropinfoMasTb->authorizedcapital = $authorizedCapital;
						 $CropinfoMasTb->statuscode = $statusCode;
						 $CropinfoMasTb->cpower = $cpower;
						 $CropinfoMasTb->crop_remark = "N";
						 $CropinfoMasTb->crop_createby = $this->username;
						 $CropinfoMasTb->crop_createtime = date('Y-m-d H:i:s');
						 $CropinfoMasTb->crop_updateby = $this->username;
						 $CropinfoMasTb->crop_updatetime = date('Y-m-d H:i:s');
						 $CropinfoMasTb->crop_status = 1;
						 
						 $qdup = new CDbCriteria( array(
							  'condition' => "registernumber = :registernumber ",
							  'params'    => array(':registernumber' => $registerName)
						  ));
						  
						 $dupstate = 0;
						 $result = CropinfoTmpTb::model()->findAll($qdup);
						 $countresult = count($result);
						 
						 if($countresult==0){
						   if($CropinfoMasTb->save()){
							  $msgerror = "Save data is success.";
							  //echo "{$msgerror}<br>";
						   }else{
							  $msgerror =  $CropinfoMasTb->getErrors();
							  echo "{$msgerror}<br>";
						   }//if($CropinfoMasTb->save())
						 }else if($countresult>0){//if $countresult==0
						 	$dupstate = 1;
						 }
						 */
					//==========================================================
				
				if(property_exists($data->CorpInfo,"committees")) {
					if(is_array($data->CorpInfo->committees->committee)){
						$countcommittees = count($data->CorpInfo->committees->committee); 
						$crow = 1;
						for($c=0;$c<=$countcommittees-1;$c++){
							  if(property_exists($data->CorpInfo->committees->committee[$c],"committeeType")) { 
								 $committeeType = $data->CorpInfo->committees->committee[$c]->committeeType;
							  }else{
								 $committeeType = "-"; 
							  }
							  if(empty($committeeType)){
								  $committeeType ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"orderNumber")) { 
								 $orderNumber = $data->CorpInfo->committees->committee[$c]->orderNumber;
							  }else{
								 $orderNumber = 0; 
							  }
							  if(empty($orderNumber)){
								  $orderNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"identityType")) { 
								 $identityType = $data->CorpInfo->committees->committee[$c]->identityType;
							  }else{
								 $identityType = "-"; 
							  }
							  if(empty($identityType)){
								  $identityType ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"identity")) { 
								$identity = $data->CorpInfo->committees->committee[$c]->identity; 
							  }else{
								 $identity = "-"; 
							  }
							  if(empty($identity)){
								  $identity ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"title")) { 
								$title = $data->CorpInfo->committees->committee[$c]->title; 
							  }else{
								 $title = "-"; 
							  }
							  if(empty($title)){
								  $title ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"firstName")) { 
								$firstName = $data->CorpInfo->committees->committee[$c]->firstName;
							  }else{
								$firstName = "-"; 
							  }
							  if(empty($firstName)){
								  $firstName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"lastName")) { 
								$lastName = $data->CorpInfo->committees->committee[$c]->lastName; 
							  }else{
								$lastName = "-"; 
							  }
							  if(empty($lastName)){
								  $lastName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishTitle")) { 
								$englishTitle = $data->CorpInfo->committees->committee[$c]->englishTitle;  
							  }else{
								$englishTitle = "-"; 
							  }
							  if(empty($englishTitle)){
								  $englishTitle ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishFirstName")) { 
								$englishFirstName = $data->CorpInfo->committees->committee[$c]->englishFirstName;  
							  }else{
								$englishFirstName = "-"; 
							  }
							  if(empty($englishFirstName)){
								  $englishFirstName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishLastName")) { 
								$englishLastName = $data->CorpInfo->committees->committee[$c]->englishLastName;
							  }else{
								$englishLastName = "-"; 
							  }
							  if(empty($englishLastName)){
								  $englishLastName ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"nationality")) { 
								$nationality = $data->CorpInfo->committees->committee[$c]->nationality;
							  }else{
								$nationality = "-"; 
							  }
							  if(empty($nationality)){
								  $nationality ='-';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"dateOfBirth")) {
								$dateOfBirth = $data->CorpInfo->committees->committee[$c]->dateOfBirth;
								$dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
							  }else{
								$dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
							  }
							  
							  //echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
							  
							  		//--- getlast cropid ------//
									
									$qlc = new CDbCriteria( array(
										'condition' => "registernumber = :registernumber ORDER BY crop_id DESC LIMIT 0,1 ",
										'params'    => array(':registernumber' => $this->registernumber)  //  $statusgt
									));
									 $rlc = CropinfoTmpTb::model()->findAll($qlc);
									 $clc = count($rlc);
									 if($clc>0){
										 foreach ($rlc as $rows){
											 $lastcrop_id = $rows->crop_id;
										 }
									 }else{
										 $lastcrop_id = 0;
									 }
									
									$CommitteeMasTb = new CommitteeTmpTb();
									 //* @property integer $cmit_id
									 $CommitteeMasTb->crop_id = $lastcrop_id;
									 $CommitteeMasTb->registernumber = $registerNumber;
									 $CommitteeMasTb->tsic = $tsic;
									 $CommitteeMasTb->corptype = $corpType;
									 $CommitteeMasTb->committeetype = $committeeType;
									 $CommitteeMasTb->ordernumber = $orderNumber;
									 $CommitteeMasTb->typeno = $identityType;
									 $CommitteeMasTb->identity = $identity;
									 $CommitteeMasTb->birthday = $dateOfBirth;
									 $CommitteeMasTb->title = $title;
									 $CommitteeMasTb->firstname = $firstName;
									 $CommitteeMasTb->lastname = $lastName;
									 $CommitteeMasTb->englishtitle = $englishTitle;
									 $CommitteeMasTb->englishfirstname12 =  $englishFirstName;
									 $CommitteeMasTb->englishlastname = $englishLastName;
									 $CommitteeMasTb->nation = $nationality;
									 $CommitteeMasTb->cmit_remark = "-";
									 $CommitteeMasTb->cmit_createby = $this->username;
									 $CommitteeMasTb->cmit_createtime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_updateby = $this->username;
									 $CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_status = 1;
									 
									 //if($dupstate == 0){
									   if($CommitteeMasTb->save()){
							   				//echo "Save committee is success.<br>";
									   }else{
										  $msgerror =  $CommitteeMasTb->getErrors();
										  echo "{$msgerror}";
									   }//if($CommitteeMasTb->save())
									 //}
									 
									 
									//====================================================
						}//for
						
					}else{//if(is_array($data->CorpInfo->committees->committee))
						$countcommittees = 1;
						if(property_exists($data->CorpInfo->committees->committee,"committeeType")) { 
						   $committeeType = $data->CorpInfo->committees->committee->committeeType;
						}else{
						   $committeeType = "-"; 
						}
						if(empty($committeeType)){
							$committeeType ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"orderNumber")) { 
						   $orderNumber = $data->CorpInfo->committees->committee->orderNumber;
						}else{
						   $orderNumber = 0; 
						}
						if(empty($orderNumber)){
							$orderNumber ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"identityType")) { 
						   $identityType = $data->CorpInfo->committees->committee->identityType;
						}else{
						   $identityType = "-"; 
						}
						if(empty($identityType)){
							$identityType ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"identity")) { 
						  $identity = $data->CorpInfo->committees->committee->identity; 
						}else{
						   $identity = "-"; 
						}
						if(empty($identity)){
							$identity ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"title")) { 
						  $title = $data->CorpInfo->committees->committee->title; 
						}else{
						   $title = "-"; 
						}
						if(empty($title)){
							$title ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"firstName")) { 
						  $firstName = $data->CorpInfo->committees->committee->firstName;
						}else{
						  $firstName = "-"; 
						}
						if(empty($firstName)){
							$firstName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"lastName")) { 
						  $lastName = $data->CorpInfo->committees->committee->lastName; 
						}else{
						  $lastName = "-"; 
						}
						if(empty($lastName)){
							$lastName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishTitle")) { 
						  $englishTitle = $data->CorpInfo->committees->committee->englishTitle;  
						}else{
						  $englishTitle = "-"; 
						}
						if(empty($englishTitle)){
							$englishTitle ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishFirstName")) { 
						  $englishFirstName = $data->CorpInfo->committees->committee->englishFirstName;  
						}else{
						  $englishFirstName = "-"; 
						}
						if(empty($englishFirstName)){
							$englishFirstName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishLastName")) { 
						  $englishLastName = $data->CorpInfo->committees->committee->englishLastName;
						}else{
						  $englishLastName = "-"; 
						}
						if(empty($englishLastName)){
							$englishLastName ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"nationality")) { 
						  $nationality = $data->CorpInfo->committees->committee->nationality;
						}else{
						  $nationality = "-"; 
						}
						if(empty($nationality)){
							$nationality ='-';
						}
						if(property_exists($data->CorpInfo->committees->committee,"dateOfBirth")) {
						  $dateOfBirth = $data->CorpInfo->committees->committee->dateOfBirth;
						  $dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
						}else{
						  $dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
						}
						
						
						//echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
						
									//--- getlast cropid ------//
									
									$qlc = new CDbCriteria( array(
										'condition' => "registernumber = :registernumber ORDER BY crop_id DESC LIMIT 0,1 ",
										'params'    => array(':registernumber' => $this->registernumber)  //  $statusgt
									));
									 $rlc = CropinfoTmpTb::model()->findAll($qlc);
									 $clc = count($rlc);
									 if($clc>0){
										 foreach ($rlc as $rows){
											 $lastcrop_id = $rows->crop_id;
										 }
									 }else{
										 $lastcrop_id = 0;
									 }
									
									$CommitteeMasTb = new CommitteeTmpTb();
									 //* @property integer $cmit_id
									 $CommitteeMasTb->crop_id = $lastcrop_id;
									 $CommitteeMasTb->registernumber = $registerNumber;
									 $CommitteeMasTb->tsic = $tsic;
									 $CommitteeMasTb->corptype = $corpType;
									 $CommitteeMasTb->committeetype = $committeeType;
									 $CommitteeMasTb->ordernumber = $orderNumber;
									 $CommitteeMasTb->typeno = $identityType;
									 $CommitteeMasTb->identity = $identity;
									 $CommitteeMasTb->birthday = $dateOfBirth;
									 $CommitteeMasTb->title = $title;
									 $CommitteeMasTb->firstname = $firstName;
									 $CommitteeMasTb->lastname = $lastName;
									 $CommitteeMasTb->englishtitle = $englishTitle;
									 $CommitteeMasTb->englishfirstname12 =  $englishFirstName;
									 $CommitteeMasTb->englishlastname = $englishLastName;
									 $CommitteeMasTb->nation = $nationality;
									 $CommitteeMasTb->cmit_remark = "-";
									 $CommitteeMasTb->cmit_createby = $this->username;
									 $CommitteeMasTb->cmit_createtime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_updateby = $this->username;
									 $CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_status = 1;
									 
									 //if($dupstate == 0){
									   if($CommitteeMasTb->save()){
							   			  //echo "Save committee is success.<br>";	
									   }else{
										  $msgerror =  $CommitteeMasTb->getErrors();
										  echo "{$msgerror}<br>";
									   }//if($CommitteeMasTb->save())
									 //}
									 
									 
									 //=============================================================
						
					}//else if
			
				}else{//if(property_exists($data->CorpInfo,"committees"))
					$countcommittees = 0;
				}//else if
				
				
				//branch data xml=========================================
				if(property_exists($data->CorpInfo,"branches")) {
					if(is_array($data->CorpInfo->branches->branch)){
						 $countbranches = count($data->CorpInfo->branches->branch);
						 $brow = 1;
						 for($b=0;$b<=$countbranches-1;$b++){
							  if(property_exists($data->CorpInfo->branches->branch[$b],"name")) { 
								$name = $data->CorpInfo->branches->branch[$b]->name;
							  }else{
								$name = "-"; 
							  }
							  if(empty($name)){
								  $name ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"orderNumber")) { 
								$orderNumber = $data->CorpInfo->branches->branch[$b]->orderNumber; 
							  }else{
								$orderNumber = 0; 
							  }
							  if(empty($orderNumber)){
								  $orderNumber =0;
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"houseId")) { 
								$houseId = $data->CorpInfo->branches->branch[$b]->houseId;
							  }else{
								$houseId = "-"; 
							  }
							  if(empty($houseId)){
								  $houseId ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"houseNumber")) { 
								$houseNumber = $data->CorpInfo->branches->branch[$b]->houseNumber;
							  }else{
								$houseNumber = "-"; 
							  }
							  if(empty($houseNumber)){
								  $houseNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingName")) { 
								$buildingName = $data->CorpInfo->branches->branch[$b]->buildingName; 
							  }else{
								$buildingName = "-"; 
							  }
							  if(empty($buildingName)){
								  $buildingName ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingNumber")) { 
								$buildingNumber = $data->CorpInfo->branches->branch[$b]->buildingNumber; 
							  }else{
								$buildingNumber = "-"; 
							  }
							  if(empty($buildingNumber)){
								  $buildingNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingFloor")) { 
								$buildingFloor = $data->CorpInfo->branches->branch[$b]->buildingFloor; 
							  }else{
								$buildingFloor = "-"; 
							  }
							  if(empty($buildingFloor)){
								  $buildingFloor ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"village")) { 
								$village = $data->CorpInfo->branches->branch[$b]->village;
							  }else{
								$village = "-"; 
							  }
							  if(empty($village)){
								  $village ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"moo")) { 
								$moo = $data->CorpInfo->branches->branch[$b]->moo;
							  }else{
								$moo = "-"; 
							  }
							  if(empty($moo)){
								  $moo ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"Soi")) { 
								$Soi = $data->CorpInfo->branches->branch[$b]->Soi;
							  }else{
								$Soi = "-"; 
							  }
							  if(empty($Soi)){
								  $Soi ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"Road")) { 
								$Road = $data->CorpInfo->branches->branch[$b]->Road;
							  }else{
								$Road = "-"; 
							  }
							  if(empty($Road)){
								  $Road ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"tumbon")) { 
								$tumbon = $data->CorpInfo->branches->branch[$b]->tumbon;
							  }else{
								$tumbon = "-"; 
							  }
							  if(empty($tumbon)){
								  $tumbon ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"ampur")) { 
								$ampur = $data->CorpInfo->branches->branch[$b]->ampur;
							  }else{
								$ampur = "-"; 
							  }
							  if(empty($ampur)){
								  $ampur ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"province")) { 
								$province = $data->CorpInfo->branches->branch[$b]->province;
							  }else{
								$province = "-"; 
							  }
							  if(empty($province)){
								  $province ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"tumbonCode")) { 
								$tumbonCode = $data->CorpInfo->branches->branch[$b]->tumbonCode;
							  }else{
								$tumbonCode = "-"; 
							  }
							  if(empty($tumbonCode)){
								  $tumbonCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"ampurCode")) { 
								$ampurCode = $data->CorpInfo->branches->branch[$b]->ampurCode; 
							  }else{
								$ampurCode = "-"; 
							  }
							  if(empty($ampurCode)){
								  $ampurCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"provinceCode")) { 
								$provinceCode = $data->CorpInfo->branches->branch[$b]->provinceCode;  
							  }else{
								$provinceCode = "-"; 
							  }
							  if(empty($provinceCode)){
								  $provinceCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"zipCode")) { 
								$zipCode = $data->CorpInfo->branches->branch[$b]->zipCode;   
							  }else{
								$zipCode = "-"; 
							  }
							  if(empty($zipCode)){
								  $zipCode ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"phoneNumber")) { 
								$phoneNumber = $data->CorpInfo->branches->branch[$b]->phoneNumber;   
							  }else{
								$phoneNumber = "-"; 
							  }
							  if(empty($phoneNumber)){
								  $phoneNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"faxNumber")) { 
								$faxNumber = $data->CorpInfo->branches->branch[$b]->faxNumber;   
							  }else{
								$faxNumber = "-"; 
							  }
							  if(empty($faxNumber)){
								  $faxNumber ='-';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"email")) { 
								$email = $data->CorpInfo->branches->branch[$b]->email;   
							  }else{
								$email = "-"; 
							  }
							  if(empty($email)){
								  $email ='-';
							  }
							  
							  //echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
							  
							  //ค้นหา สปส รับผิดชอบ ----------------------------------------------------------
							  	$ampcode1 = $provinceCode . $ampurCode;
								//echo "{$ampcode1} <br>";
								$dd1=WpdSpnLtSsobran::model()->findByAttributes(array('ZONE_AMPUR_CODE'=>$ampcode1));
								//$c = count($dd1);
								//echo "*** {$c} *** <br>";
								if($dd1){
									$SSO_BRAN_CODE = $dd1->SSO_BRAN_CODE;	
								}else{
							  		$SSO_BRAN_CODE = '-';
								}
								//echo "--- {$SSO_BRAN_CODE} ---<br>";
							  //--------------------------------------------------------------------------
							  
							  //sava data branch========================================
							  	//--- getlast cropid ------//
								/*$qlc = new CDbCriteria( array(
									'condition' => "registernumber = :registernumber ORDER BY crop_id DESC LIMIT 0,1 ",
									'params'    => array(':registernumber' => $this->registernumber)  //  $statusgt
								));
								 $rlc = CropinfoTmpTb::model()->findAll($qlc);
								 $clc = count($rlc);
								 if($clc>0){
									 foreach ($rlc as $rows){
										 $lastcrop_id = $rows->crop_id;
									 }
								 }else{
									 $lastcrop_id = 0;
								 }
								
								 //* @property integer $brch_id
								 $BranchMasTb = new BranchTmpTb();
								 
								 $BranchMasTb->crop_id = $lastcrop_id;
								 $BranchMasTb->registernumber = $registerNumber;
								 $BranchMasTb->tsic = $tsic;
								 $BranchMasTb->corptype = $corpType;
								 $BranchMasTb->ordernumber = $orderNumber;
								 $BranchMasTb->name = $name;
								 $BranchMasTb->houseid = $houseId;
								 $BranchMasTb->housenumber = $houseNumber;
								 $BranchMasTb->buildingname = $buildingName;
								 $BranchMasTb->buildingnumber = $buildingNumber;
								 $BranchMasTb->buildingfloor = $buildingFloor;
								 $BranchMasTb->village = $village;
								 $BranchMasTb->moo = $moo;
								 $BranchMasTb->soi = $Soi;
								 $BranchMasTb->road = $Road;
								 $BranchMasTb->tumbon = $tumbon;
								 $BranchMasTb->tumboncode = $tumbonCode;
								 $BranchMasTb->ampur = $ampur;
								 $BranchMasTb->ampurcode = $ampurCode;
								 $BranchMasTb->province = $province;
								 $BranchMasTb->provincecode = $provinceCode;
								 $BranchMasTb->zipcode = $zipCode;
								 $BranchMasTb->phonenumber = $phoneNumber;
								 $BranchMasTb->faxnumber = $faxNumber;
								 $BranchMasTb->email = $email;
								 $BranchMasTb->brch_remark = $SSO_BRAN_CODE;
								 $BranchMasTb->brch_createby = $this->username;
								 $BranchMasTb->brch_createtime = date('Y-m-d H:i:s');
								 $BranchMasTb->brch_updateby = $this->username;
								 $BranchMasTb->brch_updatetime = date('Y-m-d H:i:s');
								 $BranchMasTb->brch_status = 1;
								 
								 //if($dupstate == 0){
								   if($BranchMasTb->save()){
						   			  //echo "Save branch is success.";	
								   }else{
									  $msgerror =  $BranchMasTb->getErrors();
									  echo "{$msgerror} <br>";
								   }//if($BranchMasTb->save()) 
								 //}
								 */
							  //========================================================
							  
						 }//for
					}else{//if(is_array($data->CorpInfoList->corpInfo[$f]->branches->branch))
						 $countbranches=1;
						 if(property_exists($data->CorpInfo->branches->branch,"name")) { 
							$name = $data->CorpInfo->branches->branch->name;
						  }else{
							$name = "-"; 
						  }
						  if(empty($name)){
							  $name ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"orderNumber")) { 
							$orderNumber = $data->CorpInfo->branches->branch->orderNumber; 
						  }else{
							$orderNumber = 0; 
						  }
						  if(empty($orderNumber)){
							  $orderNumber =0;
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"houseId")) { 
							$houseId = $data->CorpInfo->branches->branch->houseId;
						  }else{
							$houseId = "-"; 
						  }
						  if(empty($houseId)){
							  $houseId ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"houseNumber")) { 
							$houseNumber = $data->CorpInfo->branches->branch->houseNumber;
						  }else{
							$houseNumber = "-"; 
						  }
						  if(empty($houseNumber)){
							  $houseNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingName")) { 
							$buildingName = $data->CorpInfo->branches->branch->buildingName; 
						  }else{
							$buildingName = "-"; 
						  }
						  if(empty($buildingName)){
							  $buildingName ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingNumber")) { 
							$buildingNumber = $data->CorpInfo->branches->branch->buildingNumber; 
						  }else{
							$buildingNumber = "-"; 
						  }
						  if(empty($buildingNumber)){
							  $buildingNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingFloor")) { 
							$buildingFloor = $data->CorpInfo->branches->branch->buildingFloor; 
						  }else{
							$buildingFloor = "-"; 
						  }
						  if(empty($buildingFloor)){
							  $buildingFloor ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"village")) { 
							$village = $data->CorpInfo->branches->branch->village;
						  }else{
							$village = "-"; 
						  }
						  if(empty($village)){
							  $village ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"moo")) { 
							$moo = $data->CorpInfo->branches->branch->moo;
						  }else{
							$moo = "-"; 
						  }
						  if(empty($moo)){
							  $moo ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"Soi")) { 
							$Soi = $data->CorpInfo->branches->branch->Soi;
						  }else{
							$Soi = "-"; 
						  }
						  if(empty($Soi)){
							  $Soi ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"Road")) { 
							$Road = $data->CorpInfo->branches->branch->Road;
						  }else{
							$Road = "-"; 
						  }
						  if(empty($Road)){
							  $Road ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"tumbon")) { 
							$tumbon = $data->CorpInfo->branches->branch->tumbon;
						  }else{
							$tumbon = "-"; 
						  }
						  if(empty($tumbon)){
							  $tumbon ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"ampur")) { 
							$ampur = $data->CorpInfo->branches->branch->ampur;
						  }else{
							$ampur = "-"; 
						  }
						  if(empty($ampur)){
							  $ampur ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"province")) { 
							$province = $data->CorpInfo->branches->branch->province;
						  }else{
							$province = "-"; 
						  }
						  if(empty($province)){
							  $province ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"tumbonCode")) { 
							$tumbonCode = $data->CorpInfo->branches->branch->tumbonCode;
						  }else{
							$tumbonCode = "-"; 
						  }
						  if(empty($tumbonCode)){
							  $tumbonCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"ampurCode")) { 
							$ampurCode = $data->CorpInfo->branches->branch->ampurCode; 
						  }else{
							$ampurCode = "-"; 
						  }
						  if(empty($ampurCode)){
							  $ampurCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"provinceCode")) { 
							$provinceCode = $data->CorpInfo->branches->branch->provinceCode;  
						  }else{
							$provinceCode = "-"; 
						  }
						  if(empty($provinceCode)){
							  $provinceCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"zipCode")) { 
							$zipCode = $data->CorpInfo->branches->branch->zipCode;   
						  }else{
							$zipCode = "-"; 
						  }
						  if(empty($zipCode)){
							  $zipCode ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"phoneNumber")) { 
							$phoneNumber = $data->CorpInfo->branches->branch->phoneNumber;   
						  }else{
							$phoneNumber = "-"; 
						  }
						  if(empty($phoneNumber)){
							  $phoneNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"faxNumber")) { 
							$faxNumber = $data->CorpInfo->branches->branch->faxNumber;   
						  }else{
							$faxNumber = "-"; 
						  }
						  if(empty($faxNumber)){
							  $faxNumber ='-';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"email")) { 
							$email = $data->CorpInfo->branches->branch->email;   
						  }else{
							$email = "-"; 
						  }
						  if(empty($email)){
							  $email ='-';
						  }
						  
						   //echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
						   
						    //ค้นหา สปส รับผิดชอบ ----------------------------------------------------------
							  	$ampcode1 = $provinceCode . $ampurCode;
								//echo "{$ampcode1} <br>";
								$dd1=WpdSpnLtSsobran::model()->findByAttributes(array('ZONE_AMPUR_CODE'=>$ampcode1));
								//$c = count($dd1);
								//echo "*** {$c} *** <br>";
								if($dd1){
									$SSO_BRAN_CODE = $dd1->SSO_BRAN_CODE;	
								}else{
							  		$SSO_BRAN_CODE = '-';
								}
								//echo "--- {$SSO_BRAN_CODE} ---<br>";
							  //--------------------------------------------------------------------------
						   
						 //save branch==============================================
						 	//--- getlast cropid ------//
							/*$qlc = new CDbCriteria( array(
									'condition' => "registernumber = :registernumber ORDER BY crop_id DESC LIMIT 0,1 ",
									'params'    => array(':registernumber' => $this->registernumber)  //  $statusgt
								));
							 $rlc = CropinfoTmpTb::model()->findAll($qlc);
							 $clc = count($rlc);
							 if($clc>0){
								 foreach ($rlc as $rows){
									 $lastcrop_id = $rows->crop_id;
								 }
							 }else{
								 $lastcrop_id = 0;
							 }
							
							 //* @property integer $brch_id
							 $BranchMasTb = new BranchTmpTb();
							 
							 $BranchMasTb->crop_id = $lastcrop_id;
							 $BranchMasTb->registernumber = $registerNumber;
							 $BranchMasTb->tsic = $tsic;
							 $BranchMasTb->corptype = $corpType;
							 $BranchMasTb->ordernumber = $orderNumber;
							 $BranchMasTb->name = $name;
							 $BranchMasTb->houseid = $houseId;
							 $BranchMasTb->housenumber = $houseNumber;
							 $BranchMasTb->buildingname = $buildingName;
							 $BranchMasTb->buildingnumber = $buildingNumber;
							 $BranchMasTb->buildingfloor = $buildingFloor;
							 $BranchMasTb->village = $village;
							 $BranchMasTb->moo = $moo;
							 $BranchMasTb->soi = $Soi;
							 $BranchMasTb->road = $Road;
							 $BranchMasTb->tumbon = $tumbon;
							 $BranchMasTb->tumboncode = $tumbonCode;
							 $BranchMasTb->ampur = $ampur;
							 $BranchMasTb->ampurcode = $ampurCode;
							 $BranchMasTb->province = $province;
							 $BranchMasTb->provincecode = $provinceCode;
							 $BranchMasTb->zipcode = $zipCode;
							 $BranchMasTb->phonenumber = $phoneNumber;
							 $BranchMasTb->faxnumber = $faxNumber;
							 $BranchMasTb->email = $email;
							 $BranchMasTb->brch_remark = $SSO_BRAN_CODE;
							 $BranchMasTb->brch_createby = $this->username;
							 $BranchMasTb->brch_createtime = date('Y-m-d H:i:s');
							 $BranchMasTb->brch_updateby = $this->username;
							 $BranchMasTb->brch_updatetime = date('Y-m-d H:i:s');
							 $BranchMasTb->brch_status = 1;
							 
							 //if($dupstate == 0){
							   if($BranchMasTb->save()){
					   			  //echo "Save Branch is success.";
							   }else{
								  $msgerror =  $BranchMasTb->getErrors();
								  echo "{$msgerror}";
							   }//if($BranchMasTb->save()) 
							 //}
							 */
						 //=========================================================  
									
					}//else if is_array
				}else{//if(property_exists($data->CorpInfo,"branches"))
					$countbranches=0;
				}//else if
				//========================================================
				
			}//if($countcorpinfo != 0)
		//}catch (Exception $e){
			//echo "ไม่สามารถ Call Service จากกรมพัฒนาธุรกิจการค้าได้ กรุณาติตต่อผู้ดูแลระบบ!";
		//}
		
		  //$msg = $data;
		  //return $msg;
		  
	}//function
	
	
}//class Cropinfo_tmp extends CApplicationComponent 
?>