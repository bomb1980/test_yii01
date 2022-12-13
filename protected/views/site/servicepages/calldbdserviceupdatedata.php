<?php	
	set_time_limit(0);
	ini_set("max_execution_time","0");
	ini_set("memory_limit","9999M"); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Call dbd update data</title>
<script>
	$(document).ready(function() {
		$('#wpddtup1 tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		} );
		var table = $('#wpddtup1').DataTable({
			"scrollX": true,
			"order": [[3, "asc"]]	
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
  //echo "{$action}, {$bgdatecd1}";
  if($st=="m"){
	  if(Yii::app()->user->username){
		  $username = Yii::app()->user->username;
	  }else{
		  $username = "sys";
	  }//if
	  
	  if(Yii::app()->user->address){
		  $brachcode = Yii::app()->user->address;
	  }else{
		  $brachcode = "-";
	  }//if	
  }else if($st=="a"){//if
  	$username = "sys";
	$brachcode = "-";
  }
  
  $startdate = $bgdatecd1 . "T00:00:00+07:00";
  $enddate = $bgdatecd1 . "T23:59:59+07:00";
  
  
  $bgdate2 = "01/01/2017";
  $eddate2 = "12/31/2017";
  $startdate2 = date_create($bgdate2)->format('Y-m-d') . "T00:00:00+07:00";
  $enddate2 = date_create($eddate2)->format('Y-m-d') . "T23:59:59+07:00";
  
  $startdate = date_create($bgdatecd1)->format('Y-m-d') . "T00:00:00+07:00";
  $enddate = date_create($bgdatecd1)->format('Y-m-d') . "T23:59:59+07:00";
  
  //echo "{$startdate}, {$enddate}";
  
  	$rundate = date_create($bgdatecd1)->format('Ymd');
  
    $qlrs = new CDbCriteria( array(
	  'condition' => "lrs_remark = :lrs_remark ",         
	  'params'    => array(':lrs_remark' => $rundate)  
   	));
   $rlrs = LogrunserviceTb::model()->findAll($qlrs);
   $clrs = count($rlrs);

$clrs = 0; 
//====================================================================================================
if($clrs==0){
  //https://wsg.sso.go.th:443/corpinfo-webservice-v5/CorpInfoWebService?wsdl
  //https://wsg.sso.go.th/corpinfo-webservice-v2/CorpInfoWebService?wsdl
  
  $fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebService.wsdl';
  //$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebServiceV5.wsdl';
  $client = new SoapClient($fullPathToWsdl,[
	  'stream_context' => stream_context_create([
		  'ssl' => [
				  'verify_peer' => false,
				  'verify_peer_name' => false,
			  ],
		  ]),
  ]);
	
	 $corpInfoFilter = array("corpType" => '*', "tsic" => '*', "province" => '*');
     $registerDateRange = array("startDate" => $startdate2, "endDate" => $enddate2);
     $changeDateRange	= array("startDate" => $startdate, "endDate" => $enddate);
	 
	 $params1 = array(
		"subscribeId" => 'usersso', //'6211003', //usersso
		"pincode" => 'pinsso', // 'P@ssw0rd', //pinsso
		"corpInfoFilter" => $corpInfoFilter, 
		"registerDateRange" => null, //$registerDateRange, //null
		"updatedDateRange" => $changeDateRange, //null
		"newEntry" => false, //true
		"updatedEntry" => true
	 );
	 
	 //ดึงจำนวนรายการทั้งหมดออกมาก่อน---------------------------------------
	 if($params1){
		 $countdata = 0;
		 $data1 = $client->GetCorpInfoRecordService($params1);
		 //echo "<pre>";  var_dump($data1);  echo "</pre>"; 
			$countdata = $data1->CorpInfoCount;
			$countdata = $countdata - 1;
			echo "All data update : {$countdata} Recoord. <br>";
	 }//if
	 //------------------------------------------------------------
	 
	 //คำนวณรอบในการเรียก service ------------------------------------- 
	 if($countdata > 0){
		$perloop = 1000;
		$startloop = 0; 
		$numloop = ceil($countdata/$perloop); 
		//echo "{$numloop}";
		if($numloop <= 1){
			echo "รอบที่: 1 , จาก: {$startloop} ถึง: {$countdata}  <br>";		
			//เริ่มดึงข้อมูล-----------------------------------------------------------
			  $params = array(
				  "subscribeId" => 'usersso', //'6211003', //usersso
				  "pincode" => 'pinsso', // 'P@ssw0rd', //pinsso
				  "corpInfoFilter" => $corpInfoFilter, 
				  "registerDateRange" => null, //$registerDateRange, //null
				  "changeDateRange" => $changeDateRange, //null
				  "newEntry" => false, //true
				  "changedEntry" => true, //false, //false,
				  "recordOffset" => $startloop, //0,
				  "recordLimit" => $countdata //1000
			  );
			  if($params){	
			  	$data = $client->GetCorpInfoService($params);
				if(property_exists($data->CorpInfoList,"corpInfo")) {
					if(is_array($data->CorpInfoList->corpInfo)){
						$countcorpinfo = count($data->CorpInfoList->corpInfo); //count of corpinfo list
					}else{
						$countcorpinfo = 1;	
					}//if is_array($data->CorpInfoList->corpInfo)
				}else{
					$countcorpinfo = 0;
				}//if property_exists($data->CorpInfoList,"corpInfo")
				
				if($countcorpinfo != 0){
					 if($countcorpinfo > 1){
						$rowno = 1;
						$dupstate = 0; //ค่าเริ่มต้น
						for($f=0;$f<=$countcorpinfo-1;$f++){//$countcorpinfo-1 0
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
							  $authorizedCapital = $data->CorpInfoList->corpInfo[$f]->authorizedCapital; 
							  // number_format($data->CorpInfoList->corpInfo[$f]->authorizedCapital,2,".",",");
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
						
							if($statusCode==1){
							   $statusCodef = 'ยังดำเนินการอยู่'; 
							   $stc = 0;
							}else if($statusCode==2){
							   $statusCodef = 'พิทักษ์ทรัพย์เด็ดขาด'; 
							   $stc = 0;
							}else if($statusCode==3){
							   $statusCodef = 'แปรสภาพ'; 
							   $stc = 0;
							}else if($statusCode==4){
							   $statusCodef = 'เลิก'; 
							   $stc = 1;
							}else if($statusCode==5){
							   $statusCodef = 'เสร็จการชำระบัญชี'; 
							   $stc = 1;
							}else if($statusCode==6){
							   $statusCodef = 'ควบ'; 
							   $stc = 0;
							}else if($statusCode==8){
							   $statusCodef = 'ร้าง'; 
							   $stc = 1;
							}else if($statusCode==9){
							   $statusCodef = 'ล้มละลาย'; 
							   $stc = 1;
							}else if($statusCode=='A'){
							   $statusCodef = 'คืนสู่ทะเบียน'; 
							   $stc = 0;
							}else if($statusCode=='B'){
							   $statusCodef = 'ฟื้นฟู'; 
							   $stc = 0;
							}//if
						
							/*
							  1 ยังดำเนินกิจการอยู่
							  2 พิทักษ์ทรัพย์เด็ดขาด
							  3 แปรสภาพ
							  4 เลิก
							  5 เสร็จการชำระบัญชี
							  6 ควบ
							  8 ร้าง
							  9 ล้มละลาย
							  B คืนสู่ทะเบียน
							  A ฟื้นฟู
							*/
							  
							$df =date_create($registerDate)->format('d-m-Y'); //set format date
							
							//echo "{$rowno}, {$registerNumber}, {$tsic}, {$tsicName}, {$corpType}, {$corpTypeName}, {$registerDate}, {$updatedDate}, {$updatedEntry}, {$accountingDate}, {$authorizedCapital}, {$statusCode}, {$cpower}";
							
							//ค้นหาว่ามีเลข 13 หลักในตาราง CropinfoTmpTb หรือยัง ------------------------------
							$ciftm = CropinfoUpdateTb::model()->findByAttributes(array('registernumber'=>$registerNumber, 'updateddate'=>$updatedDate));
							if($ciftm){
								$dupstate = 1;
							}else{
								if($stc===1){
									$CropinfoMasTb = new CropinfoUpdateTb();
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
										'condition' => "registernumber = :registernumber and updateddate = :updateddate",
										'params'    => array(':registernumber' => $registerNumber, 'updateddate' => $updatedDate)
									));
									  $dupstate = 0;
									  $result = CropinfoUpdateTb::model()->findAll($qdup);
									  $countresult = count($result);
									  if($countresult==0){
										  if($CropinfoMasTb->save()){
										 
										  }else{
											  $msgerror =  $CropinfoMasTb->getErrors();
											  echo "{$msgerror}";
										  }//if($CropinfoMasTb->save())
									  }else if($countresult>0){//if $countresult==0
										  $dupstate = 1;
									  }//if $countresult==0
						 
						 
								}else{//if if($stc===1)
						  			$dupstate = 1;
								}//if($stc===1)
								
							}//if $ciftm
							
							
						}//for $f=0;$f<=$countcorpinfo-1;$f++
					 }//if $countcorpinfo > 1
				}//if $countcorpinfo != 0
				
			  }//if $params
			//จบการดึงข้อมูล---------------------------------------------------------
		}else{//กรณีมีมากกว่า 1 รอบ
			$startloop = 0;
			for ($x = 1; $x <= $numloop; $x++) {
				echo "รอบที่: $x , จาก: {$startloop} ถึง: {$perloop}  <br>";
				//เริ่มการดึงข้อมูล---------------------------------------------------------				
					 $params = array(
						"subscribeId" => 'usersso', //'6211003', //usersso
						"pincode" => 'pinsso', // 'P@ssw0rd', //pinsso
						"corpInfoFilter" => $corpInfoFilter, 
						"registerDateRange" => null, //$registerDateRange, //null
						"changeDateRange" => $changeDateRange, //null
						"newEntry" => false, //true
						"changedEntry" => true, //false, //false,
						"recordOffset" => $startloop, //0,
						"recordLimit" => 1000 //1000
					 );
					 if($params){	
			  	$data = $client->GetCorpInfoService($params);
				if(property_exists($data->CorpInfoList,"corpInfo")) {
					if(is_array($data->CorpInfoList->corpInfo)){
						$countcorpinfo = count($data->CorpInfoList->corpInfo); //count of corpinfo list
					}else{
						$countcorpinfo = 1;	
					}//if is_array($data->CorpInfoList->corpInfo)
				}else{
					$countcorpinfo = 0;
				}//if property_exists($data->CorpInfoList,"corpInfo")
				
				if($countcorpinfo != 0){
					 if($countcorpinfo > 1){
						$rowno = 1;
						$dupstate = 0; //ค่าเริ่มต้น
						for($f=0;$f<=$countcorpinfo-1;$f++){//$countcorpinfo-1 0
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
							  $authorizedCapital = $data->CorpInfoList->corpInfo[$f]->authorizedCapital; 
							  // number_format($data->CorpInfoList->corpInfo[$f]->authorizedCapital,2,".",",");
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
						
							if($statusCode==1){
							   $statusCodef = 'ยังดำเนินการอยู่'; 
							   $stc = 0;
							}else if($statusCode==2){
							   $statusCodef = 'พิทักษ์ทรัพย์เด็ดขาด'; 
							   $stc = 0;
							}else if($statusCode==3){
							   $statusCodef = 'แปรสภาพ'; 
							   $stc = 0;
							}else if($statusCode==4){
							   $statusCodef = 'เลิก'; 
							   $stc = 1;
							}else if($statusCode==5){
							   $statusCodef = 'เสร็จการชำระบัญชี'; 
							   $stc = 1;
							}else if($statusCode==6){
							   $statusCodef = 'ควบ'; 
							   $stc = 0;
							}else if($statusCode==8){
							   $statusCodef = 'ร้าง'; 
							   $stc = 1;
							}else if($statusCode==9){
							   $statusCodef = 'ล้มละลาย'; 
							   $stc = 1;
							}else if($statusCode=='A'){
							   $statusCodef = 'คืนสู่ทะเบียน'; 
							   $stc = 0;
							}else if($statusCode=='B'){
							   $statusCodef = 'ฟื้นฟู'; 
							   $stc = 0;
							}//if
						
							/*
							  1 ยังดำเนินกิจการอยู่
							  2 พิทักษ์ทรัพย์เด็ดขาด
							  3 แปรสภาพ
							  4 เลิก
							  5 เสร็จการชำระบัญชี
							  6 ควบ
							  8 ร้าง
							  9 ล้มละลาย
							  B คืนสู่ทะเบียน
							  A ฟื้นฟู
							*/
							  
							$df =date_create($registerDate)->format('d-m-Y'); //set format date
							
							//echo "{$rowno}, {$registerNumber}, {$tsic}, {$tsicName}, {$corpType}, {$corpTypeName}, {$registerDate}, {$updatedDate}, {$updatedEntry}, {$accountingDate}, {$authorizedCapital}, {$statusCode}, {$cpower}";
							
							//ค้นหาว่ามีเลข 13 หลักในตาราง CropinfoTmpTb หรือยัง ------------------------------
							$ciftm = CropinfoUpdateTb::model()->findByAttributes(array('registernumber'=>$registerNumber, 'updateddate'=>$updatedDate));
							if($ciftm){
								$dupstate = 1;
							}else{
								if($stc===1){
									$CropinfoMasTb = new CropinfoUpdateTb();
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
										'condition' => "registernumber = :registernumber and updateddate = :updateddate",
										'params'    => array(':registernumber' => $registerNumber, 'updateddate' => $updatedDate)
									));
									  $dupstate = 0;
									  $result = CropinfoUpdateTb::model()->findAll($qdup);
									  $countresult = count($result);
									  if($countresult==0){
										  if($CropinfoMasTb->save()){
										 
										  }else{
											  $msgerror =  $CropinfoMasTb->getErrors();
											  echo "{$msgerror}";
										  }//if($CropinfoMasTb->save())
									  }else if($countresult>0){//if $countresult==0
										  $dupstate = 1;
									  }//if $countresult==0
						 
						 
								}else{//if if($stc===1)
						  			$dupstate = 1;
								}//if($stc===1)
								
							}//if $ciftm
							
							
						}//for $f=0;$f<=$countcorpinfo-1;$f++
					 }//if $countcorpinfo > 1
				}//if $countcorpinfo != 0
				
			  }//if $params
				//จบการดึงข้อมูล---------------------------------------------------------
				$startloop = $perloop + 1; 
				$perloop = $perloop + 1000;
				if($perloop<$countdata){
					$perloop = $perloop - 0;
				}else{
					$perloop = $perloop - ($perloop - ($countdata));
				}//if 	
			}//for $x = 1; $x <= $numloop; $x++
		}//if $numloop <= 1
	 }//if $countdata > 0
			 
//------------------------------------------------------------
	//exit;
//------------------------------------------------------------
	 
//เริ่มบันทึกlog----------------------------------------------------------------------------------------
	 $LogrunserviceTb = new LogrunserviceTb();
	 //* @property integer $lrs_id
	 $LogrunserviceTb->lrs_servicename = "service8_updatedata";
	 $LogrunserviceTb->lrs_rundate = date('Y-m-d H:i:s');
	 $LogrunserviceTb->lrs_resultrecord = $countcorpinfo;
	 $LogrunserviceTb->lrs_createby = $username;
	 $LogrunserviceTb->lrs_created = date('Y-m-d H:i:s');
	 $LogrunserviceTb->lrs_updateby = $username;
	 $LogrunserviceTb->lrs_modified = date('Y-m-d H:i:s');
	 $LogrunserviceTb->lrs_remark = $rundate;
	 $LogrunserviceTb->lrs_status = "1";
	 
	  if($LogrunserviceTb->save()){
			$lremark = "runserviceดึงข้อมูลที่มีการupdateจากdbd:service1&" . $rundate . "&จำนวนrecord=" . $countcorpinfo;
			$msgresult = Yii::app()->Clogevent->createlogevent("runservice", "servicepage", "runservice8", "service8", $lremark);				
	   }else{
		  $msgerror =  $LogrunserviceTb->getErrors();
		  echo "{$msgerror}";
	   }//if($BranchMasTb->save()) 
	   
//จบการบันทึกlog--------------------------------------------------------------------------------------
	 
}//if clsr

//====================================================================================================	
  
?>

<?php
	$datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
	$datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
	
	//echo "{$datesch1}, {$datesch2}";
	
	$qry1 = new CDbCriteria( array(
	  'condition' => "updateddate between :datesch1 and :datesch2 ",         
	  'params'    => array(':datesch1' => $datesch1, ':datesch2' => $datesch2)  
   ));
   $rm1 = CropinfoUpdateTb::model()->findAll($qry1);
   $crm1 = count($rm1);
   
   echo "Count of data : {$crm1} Record.<br>";

?>   
    <table id="wpddtup1" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
      <thead>
          <tr>
              <!--<th>ลำดับ</th>-->
              <th>ชื่อนิติบุคคล</th>
              <th style="text-align:center;">เลขนิติบุคคล 13 หลัก</th>
              <th style="text-align:center;">วันที่จดทะเบียน</th>
              <th style="text-align:center;">วันที่ปรับปรุง</th>
          </tr>
      </thead>
      <tbody>
      <?php
	  	$rowno = 1;
		foreach ($rm1 as $rows){
			$registername = $rows->registername;
			$registernumber = $rows->registernumber;
			$acc_no = $rows->acc_no;
			$acc_bran = $rows->acc_bran;
			$registerdate = $rows->registerdate;
			$updateddate = $rows->updateddate;
			$crop_remark = $rows->crop_remark;
			$crop_status = $rows->crop_status;
	  ?>
          <tr <?php if($crop_remark=='B'){  ?> style="background-color:#FFFFC6;" <?php }else if($crop_remark=='A'){ ?> style="background-color:#CEFFDB;" <?php } ?>>
              <!--<td style="text-align:center;"><?=$rowno?></td>-->
              <td><?=$registername?></td>
              <td style="text-align:center;"><?=$registernumber?></td>
              <td style="text-align:center;"><?=$registerdate?></td>
              <td style="color:red; text-align:center;"><?=$updateddate?></td>
             
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
              <th style="text-align:center;">เลขนิติบุคคล 13 หลัก</th>
              <th style="text-align:center;">วันที่จดทะเบียน</th>
              <th style="text-align:center;">วันที่ปรับปรุง</th>
          </tr>
      </tfoot>
  </table>
  
</body>
</html>