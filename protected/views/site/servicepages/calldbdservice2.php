<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Test Call DBD</title>
<script>
	$(document).ready(function() {
		$('#wpddt1 tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		} );
		var table = $('#wpddt1').DataTable({
			"scrollX": true,	
		});
		table.columns().every( function () {
			var that = this;
	 
			$( 'input', this.footer() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
						.search( this.value )
						.draw();
				}
			});
		});
		
	});
</script>
</head>

<body>
<?php
	
  if(Yii::app()->user->username){
	  $username = Yii::app()->user->username;
  }else{
	  $username = "sys";
  }
  
  if(Yii::app()->user->address){
	  $brachcode = Yii::app()->user->address;
  }else{
	  $brachcode = "-";
  }	

  $now = date_create('now')->format('Y-m-d H:i:s');
  $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  $daten1 = date('Y-m-d H:i:s');
  
  $startdate = $bgdatep . "T00:00:00+07:00";
  $enddate = $eddatep . "T23:59:59+07:00";
  
  $startdate = date_create($startdate)->format('Y-m-d') . "T00:00:00+07:00";
  $enddate = date_create($enddate)->format('Y-m-d') . "T23:59:59+07:00";
	
  $rundate = date_create($bgdatep)->format('Ymd');
	
  echo "data formate : {$startdate}, {$enddate} <br>";
  
   $qlrs = new CDbCriteria( array(
	  'condition' => "lrs_remark = :lrs_remark ",         
	  'params'    => array(':lrs_remark' => $rundate)  
   ));
   $rlrs = LogrunserviceTb::model()->findAll($qlrs);
   $clrs = count($rlrs);
   
if($clrs==0){
  //https://wsg.sso.go.th:443/corpinfo-webservice-v5/CorpInfoWebService?wsdl
  //https://wsg.sso.go.th/corpinfo-webservice-v2/CorpInfoWebService?wsdl
  $fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebServiceV5.wsdl';
  $client = new SoapClient($fullPathToWsdl,[
    		'stream_context' => stream_context_create([
        		'ssl' => [
            			'verify_peer' => false,
            			'verify_peer_name' => false,
        			],
    			]),
		]);
	
	 $corpInfoFilter = array("corpType" => '*', "tsic" => '*', "province" => '*');
     $registerDateRange = array("startDate" => $startdate, "endDate" => $enddate);
     $changeDateRange	= array("startDate" => $startdate, "endDate" => $enddate);
	 
	 if($newdap != 0){
		$params = array(
			"subscribeId" => '6211003', //usersso
			"pincode" => 'P@ssw0rd', //pinsso
			"corpInfoFilter" => $corpInfoFilter, 
			"registerDateRange" => $registerDateRange, 
			"changeDateRange" => null, //$changeDateRange, 
			"newEntry" => true, //true
			"changedEntry" => false, //false,
			"recordOffset" => 0,
			"recordLimit" => 1000
			//registerNumber => "0103555016414"
		 );
	}else{
		echo "Error : Please select check box 'รายการใหม่' ";	
	}
	
	if($params){
		$data = $client->GetCorpInfoService($params);
		//echo "<pre>";  var_dump($data);  echo "</pre>"; 
		
		if(property_exists($data->CorpInfoList,"corpInfo")) {
			if(is_array($data->CorpInfoList->corpInfo)){
				$countcorpinfo = count($data->CorpInfoList->corpInfo); //count of corpinfo list
			}else{
				$countcorpinfo = 1;	
			}
			//echo "Count of data : {$countcorpinfo} Record. <br>";
		}else{
			$countcorpinfo = 0;
		}
		
		if($countcorpinfo != 0){ 
			if($countcorpinfo > 1){
				$rowno = 1;
				$dupstate = 0; //ค่าเริ่มต้น
				for($f=0;$f<=$countcorpinfo-1;$f++){//$countcorpinfo-1 0
					//ตรวจสอบว่ามี field ที่ต้องการมาใน xml หรือไม่
						if(property_exists($data->CorpInfoList->corpInfo[$f],"tsic")) { 
						   $tsic = $data->CorpInfoList->corpInfo[$f]->tsic; 
						}else{
						   $tsic = "-"; 
						}
						if(empty($tsic)){
							$tsic = "-";
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"tsicName")) {
						  $tsicName = $data->CorpInfoList->corpInfo[$f]->tsicName;
						}else{
						  $tsicName = "-";  
						}
						if(empty($tsicName)){
							$tsicName = "-";
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"corpType")) {
						  $corpType = $data->CorpInfoList->corpInfo[$f]->corpType;
						}else{
						   $corpType ='-'; 
						}
						if(empty($corpType)){
							$corpType = "-";
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"corpTypeName")) {
						  $corpTypeName = $data->CorpInfoList->corpInfo[$f]->corpTypeName;
						}else{
						   $corpTypeName ='-'; 
						}
						if(empty($corpTypeName)){
							$corpTypeName = "-";
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"registerNumber")) {
						  $registerNumber = $data->CorpInfoList->corpInfo[$f]->registerNumber;
						}else{
						  $registerNumber ='-';  
						}
						if(empty($registerNumber)){
							$registerNumber = "-";
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"registerName")) {
						  $registerName = $data->CorpInfoList->corpInfo[$f]->registerName;
						}else{
						   $registerName ='-';  
						}
						if(empty($registerName)){
							$registerName = "-";
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"registerDate")) {
						  $registerDate = $data->CorpInfoList->corpInfo[$f]->registerDate;
						  $registerDate =  date_create($registerDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}else{
						  $registerDate =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');  //date('Y-m-d H:i:s');
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"updatedDate")) {
						  $updatedDate = $data->CorpInfoList->corpInfo[$f]->updatedDate;
						  $updatedDate =  date_create($updatedDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}else{
						  $updatedDate =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"updatedEntry")) {
						  $updatedEntry = $data->CorpInfoList->corpInfo[$f]->updatedEntry;
						}else{
						  $updatedEntry ='-'; 
						}
						if(empty($updatedEntry)){
							  $updatedEntry ='-';
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"authorizedCapital")) {
						  $authorizedCapital = $data->CorpInfoList->corpInfo[$f]->authorizedCapital; // number_format($data->CorpInfoList->corpInfo[$f]->authorizedCapital,2,".",",");
						}else{
						  $authorizedCapital =0;  
						}
						if(empty($authorizedCapital)){
							$authorizedCapital = 0;
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"accountingDate")) {
						  $accountingDate = $data->CorpInfoList->corpInfo[$f]->accountingDate;
						}else{
						  $accountingDate ='-';  
						}
						if(empty($accountingDate)){
							  $accountingDate ='-';
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"statusCode")) {
						  $statusCode = $data->CorpInfoList->corpInfo[$f]->statusCode;
						}else{
						  $statusCode ='-';  
						}
						if(empty($statusCode)){
							  $statusCode ='-';
						}
						if(property_exists($data->CorpInfoList->corpInfo[$f],"cpower")) {
						  $cpower = $data->CorpInfoList->corpInfo[$f]->cpower;
						}else{
						  $cpower ='-';  
						}
						if(empty($cpower)){
							  $cpower ='-';
						}
						$now = date_create('now')->format('Y-m-d H:i:s');
						 
						if($statusCode==1){
						   $statusCodef = 'New'; 
						}else{
						   $statusCodef = 'Old'; 
						}
					
						  
						$df =date_create($registerDate)->format('d-m-Y'); //set format date
						
						//echo "{$rowno}, {$registerNumber}, {$tsic}, {$tsicName}, {$corpType}, {$corpTypeName}, {$registerDate}, {$updatedDate}, {$updatedEntry}, {$accountingDate}, {$authorizedCapital}, {$statusCode}, {$cpower}";
					
					//ค้นหาว่ามีเลข 13 หลักในตาราง CropinfoTmpTb หรือยัง ------------------------------
					$ciftm = CropinfoTmpTb::model()->findByAttributes(array('registernumber'=>$registerNumber));
					if($ciftm){
					    //ถ้ามีแล้วไม่ต้องทำอะไรข้ามไปเลย
						$dupstate = 1;
					}else{
						
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
						 $CropinfoMasTb->crop_createby = $username;
						 $CropinfoMasTb->crop_createtime = date('Y-m-d H:i:s');
						 $CropinfoMasTb->crop_updateby = $username;
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
							   
						   }else{
							  $msgerror =  $CropinfoMasTb->getErrors();
							  echo "{$msgerror}";
						   }//if($CropinfoMasTb->save())
						 }else if($countresult>0){//if $countresult==0
						 	$dupstate = 1;
						 }
						 
					}//if($ciftm) 
						
		if($dupstate != 1){	
						
						 if(property_exists($data->CorpInfoList->corpInfo[$f],"committees")) {
							 if(is_array($data->CorpInfoList->corpInfo[$f]->committees->committee)){
								 $countcommittees = count($data->CorpInfoList->corpInfo[$f]->committees->committee); 
								 $crow = 1;
								 for($c=0;$c<=$countcommittees-1;$c++){
									 if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"committeeType")) { 
									   $committeeType = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->committeeType;
									}else{
									   $committeeType = "-"; 
									}
									if(empty($committeeType)){
							  			$committeeType ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"orderNumber")) { 
									   $orderNumber = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->orderNumber;
									}else{
									   $orderNumber = 0; 
									}
									if(empty($orderNumber)){
							  			$orderNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"identityType")) { 
									   $identityType = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->identityType;
									}else{
									   $identityType = "-"; 
									}
									if(empty($identityType)){
							  			$identityType ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"identity")) { 
									  $identity = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->identity; 
									}else{
									   $identity = "-"; 
									}
									if(empty($identity)){
							  			$identity ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"title")) { 
									  $title = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->title; 
									}else{
									   $title = "-"; 
									}
									if(empty($title)){
							  			$title ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"firstName")) { 
									  $firstName = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->firstName;
									}else{
									  $firstName = "-"; 
									}
									if(empty($firstName)){
							  			$firstName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"lastName")) { 
									  $lastName = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->lastName; 
									}else{
									  $lastName = "-"; 
									}
									if(empty($lastName)){
							  			$lastName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"englishTitle")) { 
									  $englishTitle = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->englishTitle;  
									}else{
									  $englishTitle = "-"; 
									}
									if(empty($englishTitle)){
							  			$englishTitle ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"englishFirstName")) { 
									  $englishFirstName = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->englishFirstName;  
									}else{
									  $englishFirstName = "-"; 
									}
									if(empty($englishFirstName)){
							  			$englishFirstName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"englishLastName")) { 
									  $englishLastName = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->englishLastName;
									}else{
									  $englishLastName = "-"; 
									}
									if(empty($englishLastName)){
							  			$englishLastName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"nationality")) { 
									  $nationality = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->nationality;
									}else{
									  $nationality = "-"; 
									}
									if(empty($nationality)){
							  			$nationality ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee[$c],"dateOfBirth")) {
									  $dateOfBirth = $data->CorpInfoList->corpInfo[$f]->committees->committee[$c]->dateOfBirth;
									  $dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
									}else{
									  $dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
									}
									
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
									 $CommitteeMasTb->cmit_createby = $username;
									 $CommitteeMasTb->cmit_createtime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_updateby = $username;
									 $CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_status = 1;
									 
									 if($dupstate == 0){
									   if($CommitteeMasTb->save()){
							   
									   }else{
										  $msgerror =  $CommitteeMasTb->getErrors();
										  echo "{$msgerror}";
									   }//if($CommitteeMasTb->save())
									 }
					
									
								 }//for($c=0;$c<=$countcommittees-1;$c++){
							 }else{//if(is_array($data->CorpInfoList->corpInfo[$f]->committees->committee))
							 	$countcommittees = 1;
								
								if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"committeeType")) { 
									   $committeeType = $data->CorpInfoList->corpInfo[$f]->committees->committee->committeeType;
									}else{
									   $committeeType = "-"; 
									}
									if(empty($committeeType)){
							  			$committeeType ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"orderNumber")) { 
									   $orderNumber = $data->CorpInfoList->corpInfo[$f]->committees->committee->orderNumber;
									}else{
									   $orderNumber = 0; 
									}
									if(empty($orderNumber)){
							  			$orderNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"identityType")) { 
									   $identityType = $data->CorpInfoList->corpInfo[$f]->committees->committee->identityType;
									}else{
									   $identityType = "-"; 
									}
									if(empty($identityType)){
							  			$identityType ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"identity")) { 
									  $identity = $data->CorpInfoList->corpInfo[$f]->committees->committee->identity; 
									}else{
									   $identity = "-"; 
									}
									if(empty($identity)){
							  			$identity ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"title")) { 
									  $title = $data->CorpInfoList->corpInfo[$f]->committees->committee->title; 
									}else{
									   $title = "-"; 
									}
									if(empty($title)){
							  			$title ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"firstName")) { 
									  $firstName = $data->CorpInfoList->corpInfo[$f]->committees->committee->firstName;
									}else{
									  $firstName = "-"; 
									}
									if(empty($firstName)){
							  			$firstName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"lastName")) { 
									  $lastName = $data->CorpInfoList->corpInfo[$f]->committees->committee->lastName; 
									}else{
									  $lastName = "-"; 
									}
									if(empty($lastName)){
							  			$lastName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"englishTitle")) { 
									  $englishTitle = $data->CorpInfoList->corpInfo[$f]->committees->committee->englishTitle;  
									}else{
									  $englishTitle = "-"; 
									}
									if(empty($englishTitle)){
							  			$englishTitle ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"englishFirstName")) { 
									  $englishFirstName = $data->CorpInfoList->corpInfo[$f]->committees->committee->englishFirstName;  
									}else{
									  $englishFirstName = "-"; 
									}
									if(empty($englishFirstName)){
							  			$englishFirstName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"englishLastName")) { 
									  $englishLastName = $data->CorpInfoList->corpInfo[$f]->committees->committee->englishLastName;
									}else{
									  $englishLastName = "-"; 
									}
									if(empty($englishLastName)){
							  			$englishLastName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"nationality")) { 
									  $nationality = $data->CorpInfoList->corpInfo[$f]->committees->committee->nationality;
									}else{
									  $nationality = "-"; 
									}
									if(empty($nationality)){
							  			$nationality ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->committees->committee,"dateOfBirth")) {
									  $dateOfBirth = $data->CorpInfoList->corpInfo[$f]->committees->committee->dateOfBirth;
									  $dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
									}else{
									  $dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
									}
									
									
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
									 $CommitteeMasTb->cmit_createby = $username;
									 $CommitteeMasTb->cmit_createtime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_updateby = $username;
									 $CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s');
									 $CommitteeMasTb->cmit_status = 1;
									 
									 if($dupstate == 0){
									   if($CommitteeMasTb->save()){
							   
									   }else{
										  $msgerror =  $CommitteeMasTb->getErrors();
										  echo "{$msgerror}";
									   }//if($CommitteeMasTb->save())
									 }
									
							 }//if committee is array
						 }else{//if(property_exists($data->CorpInfoList->corpInfo[$f],"committees"))
						 	$countcommittees = 0;
						 }//if proerty_exists
		}//if
		
		if($dupstate != 1){
						 
						 if(property_exists($data->CorpInfoList->corpInfo[$f],"branches")) {
							 if(is_array($data->CorpInfoList->corpInfo[$f]->branches->branch)){
								 $countbranches = count($data->CorpInfoList->corpInfo[$f]->branches->branch);
								 $brow = 1;
								 for($b=0;$b<=$countbranches-1;$b++){
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"name")) { 
									  $name = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->name;
									}else{
									  $name = "-"; 
									}
									if(empty($name)){
							  			$name ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"orderNumber")) { 
									  $orderNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->orderNumber; 
									}else{
									  $orderNumber = 0; 
									}
									if(empty($orderNumber)){
							  			$orderNumber =0;
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"houseId")) { 
									  $houseId = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->houseId;
									}else{
									  $houseId = "-"; 
									}
									if(empty($houseId)){
							  			$houseId ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"houseNumber")) { 
									  $houseNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->houseNumber;
									}else{
									  $houseNumber = "-"; 
									}
									if(empty($houseNumber)){
							  			$houseNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"buildingName")) { 
									  $buildingName = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->buildingName; 
									}else{
									  $buildingName = "-"; 
									}
									if(empty($buildingName)){
							  			$buildingName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"buildingNumber")) { 
									  $buildingNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->buildingNumber; 
									}else{
									  $buildingNumber = "-"; 
									}
									if(empty($buildingNumber)){
							  			$buildingNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"buildingFloor")) { 
									  $buildingFloor = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->buildingFloor; 
									}else{
									  $buildingFloor = "-"; 
									}
									if(empty($buildingFloor)){
							  			$buildingFloor ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"village")) { 
									  $village = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->village;
									}else{
									  $village = "-"; 
									}
									if(empty($village)){
							  			$village ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"moo")) { 
									  $moo = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->moo;
									}else{
									  $moo = "-"; 
									}
									if(empty($moo)){
							  			$moo ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"Soi")) { 
									  $Soi = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->Soi;
									}else{
									  $Soi = "-"; 
									}
									if(empty($Soi)){
							  			$Soi ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"Road")) { 
									  $Road = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->Road;
									}else{
									  $Road = "-"; 
									}
									if(empty($Road)){
							  			$Road ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"tumbon")) { 
									  $tumbon = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->tumbon;
									}else{
									  $tumbon = "-"; 
									}
									if(empty($tumbon)){
							  			$tumbon ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"ampur")) { 
									  $ampur = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->ampur;
									}else{
									  $ampur = "-"; 
									}
									if(empty($ampur)){
							  			$ampur ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"province")) { 
									  $province = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->province;
									}else{
									  $province = "-"; 
									}
									if(empty($province)){
							  			$province ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"tumbonCode")) { 
									  $tumbonCode = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->tumbonCode;
									}else{
									  $tumbonCode = "-"; 
									}
									if(empty($tumbonCode)){
							  			$tumbonCode ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"ampurCode")) { 
									  $ampurCode = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->ampurCode; 
									}else{
									  $ampurCode = "-"; 
									}
									if(empty($ampurCode)){
							  			$ampurCode ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"provinceCode")) { 
									  $provinceCode = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->provinceCode;  
									}else{
									  $provinceCode = "-"; 
									}
									if(empty($provinceCode)){
							  			$provinceCode ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"zipCode")) { 
									  $zipCode = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->zipCode;   
									}else{
									  $zipCode = "-"; 
									}
									if(empty($zipCode)){
							  			$zipCode ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"phoneNumber")) { 
									  $phoneNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->phoneNumber;   
									}else{
									  $phoneNumber = "-"; 
									}
									if(empty($phoneNumber)){
							  			$phoneNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"faxNumber")) { 
									  $faxNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->faxNumber;   
									}else{
									  $faxNumber = "-"; 
									}
									if(empty($faxNumber)){
							  			$faxNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch[$b],"email")) { 
									  $email = $data->CorpInfoList->corpInfo[$f]->branches->branch[$b]->email;   
									}else{
									  $email = "-"; 
									}
									if(empty($email)){
							  			$email ='-';
									}
									
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
									 
									 //ค้นหา สปส รับผิดชอบ ----------------------------------------------------------
									 	if($provinceCode!="-" && $ampurCode!="-"){
										  $ampcode1 = $provinceCode . $ampurCode;
										  //echo "{$ampcode1} <br>";
										  //$dd1=WpdSpnLtSsobran::model()->findByAttributes(array('ZONE_AMPUR_CODE'=>'{$ampcode1}'));
										   $qldd1 = new CDbCriteria( array(
												'condition' => "ZONE_AMPUR_CODE = :ZONE_AMPUR_CODE ORDER BY ZONE_AMPUR_CODE DESC LIMIT 0,1 ",
												'params'    => array(':ZONE_AMPUR_CODE' => $ampcode1)  //  $statusgt
											));
										   $dd1 = WpdSpnLtSsobran::model()->findAll($qldd1);
										   //echo "<pre>"; var_dump($dd1);  echo "</pre>";
										  $c = count($dd1);
										  //echo "*** {$c} *** <br>";
										  if($c != 0){	
											  foreach ($dd1 as $rows){
												$SSO_BRAN_CODE = $rows->SSO_BRAN_CODE;
											  }
										  }else{
											  $SSO_BRAN_CODE = '-';
										  }
										}else{//if
											$SSO_BRAN_CODE = '-';
										}
										//echo "--- {$SSO_BRAN_CODE} ---<br>";
									  //--------------------------------------------------------------------------
									
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
									 $BranchMasTb->brch_createby = $username;
									 $BranchMasTb->brch_createtime = date('Y-m-d H:i:s');
									 $BranchMasTb->brch_updateby = $username;
									 $BranchMasTb->brch_updatetime = date('Y-m-d H:i:s');
									 $BranchMasTb->brch_status = 1;
									 
									 if($dupstate == 0){
									   if($BranchMasTb->save()){
							   				//insert data to crop_v_bran
											/*$cropid = $lastcrop_id;
											$registernumber = $registerNumber;
											Yii::app()->Cwpdreport->createcrop_v_bran($cropid, $registernumber);*/
									   }else{
										  $msgerror =  $BranchMasTb->getErrors();
										  echo "{$msgerror}";
									   }//if($BranchMasTb->save()) 
									 }
									
									
								 }// for $b
							 }else{// if is_array
								 $countbranches=1;	
								 if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"name")) { 
									  $name = $data->CorpInfoList->corpInfo[$f]->branches->branch->name;
									}else{
									  $name = "-"; 
									}
									if(empty($name)){
							  			$name ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"orderNumber")) { 
									  $orderNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch->orderNumber; 
									}else{
									  $orderNumber = 0; 
									}
									if(empty($orderNumber)){
							  			$orderNumber =0;
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"houseId")) { 
									  $houseId = $data->CorpInfoList->corpInfo[$f]->branches->branch->houseId;
									}else{
									  $houseId = "-"; 
									}
									if(empty($houseId)){
							  			$houseId ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"houseNumber")) { 
									  $houseNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch->houseNumber;
									}else{
									  $houseNumber = "-"; 
									}
									if(empty($houseNumber)){
							  			$houseNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"buildingName")) { 
									  $buildingName = $data->CorpInfoList->corpInfo[$f]->branches->branch->buildingName; 
									}else{
									  $buildingName = "-"; 
									}
									if(empty($buildingName)){
							  			$buildingName ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"buildingNumber")) { 
									  $buildingNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch->buildingNumber; 
									}else{
									  $buildingNumber = "-"; 
									}
									if(empty($buildingNumber)){
							  			$buildingNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"buildingFloor")) { 
									  $buildingFloor = $data->CorpInfoList->corpInfo[$f]->branches->branch->buildingFloor; 
									}else{
									  $buildingFloor = "-"; 
									}
									if(empty($buildingFloor)){
							  			$buildingFloor ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"village")) { 
									  $village = $data->CorpInfoList->corpInfo[$f]->branches->branch->village;
									}else{
									  $village = "-"; 
									}
									if(empty($village)){
							  			$village ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"moo")) { 
									  $moo = $data->CorpInfoList->corpInfo[$f]->branches->branch->moo;
									}else{
									  $moo = "-"; 
									}
									if(empty($moo)){
							  			$moo ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"Soi")) { 
									  $Soi = $data->CorpInfoList->corpInfo[$f]->branches->branch->Soi;
									}else{
									  $Soi = "-"; 
									}
									if(empty($Soi)){
							  			$Soi ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"Road")) { 
									  $Road = $data->CorpInfoList->corpInfo[$f]->branches->branch->Road;
									}else{
									  $Road = "-"; 
									}
									if(empty($Road)){
							  			$Road ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"tumbon")) { 
									  $tumbon = $data->CorpInfoList->corpInfo[$f]->branches->branch->tumbon;
									}else{
									  $tumbon = "-"; 
									}
									if(empty($tumbon)){
							  			$tumbon ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"ampur")) { 
									  $ampur = $data->CorpInfoList->corpInfo[$f]->branches->branch->ampur;
									}else{
									  $ampur = "-"; 
									}
									if(empty($ampur)){
							  			$ampur ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"province")) { 
									  $province = $data->CorpInfoList->corpInfo[$f]->branches->branch->province;
									}else{
									  $province = "-"; 
									}
									if(empty($province)){
							  			$province ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"tumbonCode")) { 
									  $tumbonCode = $data->CorpInfoList->corpInfo[$f]->branches->branch->tumbonCode;
									}else{
									  $tumbonCode = "-"; 
									}
									if(empty($tumbonCode)){
							  			$tumbonCode ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"ampurCode")) { 
									  $ampurCode = $data->CorpInfoList->corpInfo[$f]->branches->branch->ampurCode; 
									}else{
									  $ampurCode = "-"; 
									}
									if(empty($ampurCode)){
							  			$ampurCode ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"provinceCode")) { 
									  $provinceCode = $data->CorpInfoList->corpInfo[$f]->branches->branch->provinceCode;  
									}else{
									  $provinceCode = "-"; 
									}
									if(empty($provinceCode)){
							  			$provinceCode ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"zipCode")) { 
									  $zipCode = $data->CorpInfoList->corpInfo[$f]->branches->branch->zipCode;   
									}else{
									  $zipCode = "-"; 
									}
									if(empty($zipCode)){
							  			$zipCode ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"phoneNumber")) { 
									  $phoneNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch->phoneNumber;   
									}else{
									  $phoneNumber = "-"; 
									}
									if(empty($phoneNumber)){
							  			$phoneNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"faxNumber")) { 
									  $faxNumber = $data->CorpInfoList->corpInfo[$f]->branches->branch->faxNumber;   
									}else{
									  $faxNumber = "-"; 
									}
									if(empty($faxNumber)){
							  			$faxNumber ='-';
									}
									if(property_exists($data->CorpInfoList->corpInfo[$f]->branches->branch,"email")) { 
									  $email = $data->CorpInfoList->corpInfo[$f]->branches->branch->email;   
									}else{
									  $email = "-"; 
									}
									if(empty($email)){
							  			$email ='-';
									}
									
								   
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
									 
									 
									 //ค้นหา สปส รับผิดชอบ ----------------------------------------------------------
									 	if($provinceCode!="-" && $ampurCode!="-"){
										  $ampcode1 = $provinceCode . $ampurCode;
										  //echo "{$ampcode1} <br>";
										  //$dd1=WpdSpnLtSsobran::model()->findByAttributes(array('ZONE_AMPUR_CODE'=>'{$ampcode1}'));
										  $qldd1 = new CDbCriteria( array(
												'condition' => "ZONE_AMPUR_CODE = :ZONE_AMPUR_CODE ORDER BY ZONE_AMPUR_CODE DESC LIMIT 0,1 ",
												'params'    => array(':ZONE_AMPUR_CODE' => $ampcode1)  //  $statusgt
											));
										   $dd1 = WpdSpnLtSsobran::model()->findAll($qldd1);
										   //echo "<pre>"; var_dump($dd1);  echo "</pre>";
										  $c = count($dd1);
										  //echo "*** {$c} *** <br>";
										  if($c != 0){
											  foreach ($dd1 as $rows){
												$SSO_BRAN_CODE = $rows->SSO_BRAN_CODE;
											  }	
										  }else{
											  $SSO_BRAN_CODE = '-';
										  }
										}else{//if
											$SSO_BRAN_CODE = '-';
										}
										//echo "--- {$SSO_BRAN_CODE} ---<br>";
									  //--------------------------------------------------------------------------
									
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
									 $BranchMasTb->brch_createby = $username;
									 $BranchMasTb->brch_createtime = date('Y-m-d H:i:s');
									 $BranchMasTb->brch_updateby = $username;
									 $BranchMasTb->brch_updatetime = date('Y-m-d H:i:s');
									 $BranchMasTb->brch_status = 1;
									 
									 if($dupstate == 0){
									   if($BranchMasTb->save()){
							   				//insert data to crop_v_bran
											/*$cropid = $lastcrop_id;
											$registernumber = $registerNumber;
											Yii::app()->Cwpdreport->createcrop_v_bran($cropid, $registernumber);*/
									   }else{
										  $msgerror =  $BranchMasTb->getErrors();
										  echo "{$msgerror}";
									   }//if($BranchMasTb->save()) 
									 }
							 }// if is_array
				}//if
						 }else{//if proerty_exists
							 $countbranches=0;
						 }////if proerty_exists
				  
				}//for($f=0;$f<=$countcorpinfo-1;$f++)
			}else if($countcorpinfo == 1){//if cropinfo > 1
			
			}
			
		}else{//if($countcorpinfo != 0){ 
			echo "Not have Data. <br>";
		}//if cropinf !=0
		
	}else{//if($params)
		echo "Error Can't call data from DBD : Please Check Paramiter of Web Service!";	
	} //if($params)
	
	 $LogrunserviceTb = new LogrunserviceTb();
	 //* @property integer $lrs_id
	 $LogrunserviceTb->lrs_servicename = "service1";
	 $LogrunserviceTb->lrs_rundate = date('Y-m-d H:i:s');
	 $LogrunserviceTb->lrs_resultrecord = $countcorpinfo;
	 $LogrunserviceTb->lrs_createby = $username;
	 $LogrunserviceTb->lrs_created = date('Y-m-d H:i:s');
	 $LogrunserviceTb->lrs_updateby = $username;
	 $LogrunserviceTb->lrs_modified = date('Y-m-d H:i:s');
	 $LogrunserviceTb->lrs_remark = $rundate;
	 $LogrunserviceTb->lrs_status = "1";
	 
	  if($LogrunserviceTb->save()){
			$lremark = "runserviceดึงข้อมูลจากdbd:service1&" . $rundate . "&จำนวนrecord=" . $countcorpinfo;
			$msgresult = Yii::app()->Clogevent->createlogevent("runservice", "servicepage", "runservice1", "service1", $lremark);				
	   }else{
		  $msgerror =  $LogrunserviceTb->getErrors();
		  echo "{$msgerror}";
	   }//if($BranchMasTb->save()) 
	 
}//if clsr

?>
<?php

	$datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
	$datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
	
	$model = CropinfoTmpTb::model()->findAllByAttributes(array('registerdate'=>$datesch1));
	$countmedel = count($model);
	
	echo "Count of data : {$countmedel} Record.<br>";

?>
<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
      <table id="wpddt1" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
      <thead>
          <tr>
              <!--<th>ลำดับ</th>-->
              <th>ชื่อนิติบุคคล</th>
              <th>เลขนิติบุคคล 13 หลัก</th>
              <th>เลขประกันสังคม 10 หลัก</th>
              <th>วันที่จดทะเบียน</th>
              <th>สถานะ</th>
             
          </tr>
      </thead>
      <tbody>
      <?php
	  	$rowno = 1;
		foreach ($model as $rows){
			$registername = $rows->registername;
			$registernumber = $rows->registernumber;
			$acc_no = $rows->acc_no;
			$acc_bran = $rows->acc_bran;
			$registerdate = $rows->registerdate;
			$crop_remark = $rows->crop_remark;
			$crop_status = $rows->crop_status;
	  ?>
          <tr <?php if($crop_remark=='B'){  ?> style="background-color:#FFFFC6;" <?php }else if($crop_remark=='A'){ ?> style="background-color:#CEFFDB;" <?php } ?>>
              <!--<td style="text-align:center;"><?=$rowno?></td>-->
              <td><?=$registername?></td>
              <td style="text-align:center;"><?=$registernumber?></td>
              <td style="text-align:center;"><?=$acc_no?></td>
              <td style="text-align:center;"><?=$registerdate?></td>
              <td style="color:red; text-align:center;"><span class="badge thfont3" style="color:#FF6;"><?=$crop_remark?></span></td>
             
          </tr>
      <?php
      	    $rowno += 1;
		}//foreach ($model as $rows){
	  ?>  
      </tbody>
      <tfoot>
          <tr>
              <!--<th>ลำดับ</th>-->
              <th>ชื่อนิติบุคคล</th>
              <th>เลขนิติบุคคล 13 หลัก</th>
              <th>เลขประกันสังคม 10 หลัก</th>
              <th>วันที่จดทะเบียน</th>
              <th>สถานะ</th>
              
          </tr>
      </tfoot>
  </table>
</body>
</html>