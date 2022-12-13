<?php
set_time_limit(0);
ini_set("max_execution_time","0");
ini_set("memory_limit","9999M"); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Call DBD Webservice</title>
</head>
<style>
.table4_1 table {
	width:100%;
	margin:15px 0;
	border:0;
}
.table4_1 th {
	background-color:#93DAFF;
	color:#000000
}
.table4_1,.table4_1 th,.table4_1 td {
	font-size:0.95em;
	/*text-align:center;*/
	padding:4px;
	border-collapse:collapse;
}
.table4_1 th,.table4_1 td {
	border: 1px solid #c1e9fe;
	border-width:1px 0 1px 0
}
.table4_1 tr {
	border: 1px solid #c1e9fe;
}
.table4_1 tr:nth-child(odd){
	background-color:#dbf2fe;
}
.table4_1 tr:nth-child(even){
	background-color:#fdfdfd;
}


@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	.table4_1 table, .table4_1 thead, .table4_1 tbody, .table4_1 th, .table4_1 td, .table4_1 tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	.table4_1 thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	.table4_1 tr { border: 1px solid #ccc; }
	
	.table4_1 td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	.table4_1 td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	.table4_1 button{
		width:80%;
		height:100%;
	}
	
	/*
	Label the data
	*/
	.table4_1 td:nth-of-type(1):before { content: ""; }
	.table4_1 td:nth-of-type(2):before { content: ""; }
	.table4_1 td:nth-of-type(3):before { content: ""; }
	.table4_1 td:nth-of-type(4):before { content: ""; }
	.table4_1 td:nth-of-type(5):before { content: ""; }
	.table4_1 td:nth-of-type(5):after { content: "";}
	.table4_1 td:nth-of-type(6):before { content: ""; }
	.table4_1 td:nth-of-type(6):after { content: "";}
	
}
</style>
<script>
	$(document).ready(function() {
		
    	//$('#wpddt1').DataTable();
		// Setup - add a text input to each footer cell
		$('#wpddt1 tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		} );
	 
		// DataTable
		var table = $('#wpddt1').DataTable({
			"scrollX": true,	
		});
	 
		// Apply the search
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
<script>
	
</script>
<body>
<?php
  $now = date_create('now')->format('Y-m-d H:i:s');
  $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  $daten1 = date('Y-m-d H:i:s');
?>
<?php
	//echo "data from contorller : {$bgdatep}, {$eddatep}, {$newdap}, {$updap} <br>";
	
	$startdate = $bgdatep . "T00:00:00+07:00";
	$enddate = $eddatep . "T23:59:59+07:00";
	
	$rundate = date_create($bgdatep)->format('Ymd');
	
	//echo "data formate : {$startdate}, {$enddate} <br>";
	
	//ดึง data จาก dbd ตามวันที่
	
	//-------------------- check logrunservice --------------------------------------------------------
		Yii::app()->Clogrunservice->lrs_servicename = "service1";	
		Yii::app()->Clogrunservice->lrs_remark = $rundate;	
		
		//$resultlrs = Yii::app()->Clogrunservice->checkexists();	
		if(!Yii::app()->Clogrunservice->checkexists()){
		
	
?>

<?php
	//ดึงข้อมูลจาก dbd แสดงทั้งหมด
	$client = new SoapClient("https://wsg.sso.go.th/corpinfo-webservice-v2/CorpInfoWebService?wsdl",[
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
			"subscribeId" => 'usersso',
			"pincode" => 'pinsso',
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
			echo "Count of data : {$countcorpinfo} Record. <br>";
		}else{
			$countcorpinfo = 0;
		}
		
	    //----แบ่งรอบทำ------------------------------------------
		
		
		if($countcorpinfo != 0){ 
		        
				if($countcorpinfo > 1){
		        	$rowno = 1;
					
					$endrec = $countcorpinfo-1;
					$onel = 10;
					$beginl = 0;
					$endl = 10; //$beginl + $onel;2
					
					for($f=0;$f<=$countcorpinfo-1;$f++){//$countcorpinfo-1 0
						set_time_limit(0);
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
				  
				  		//echo "{$rowno}, {$tsic},{$tsicName},{$corpType}, {$corpTypeName}, {$registerNumber}, {$registerName}, {$registerDate}, {$updatedEntry}, {$authorizedCapital}, {$accountingDate}, {$statusCode}, {$cpower}, {$df},  <br>";
						
						//echo "{$rowno}, {$registerNumber}, {$tsic}, {$tsicName}, {$corpType}, {$corpTypeName}, {$registerDate}, {$updatedDate}, {$updatedEntry}, {$accountingDate}, {$authorizedCapital}, {$statusCode}, {$cpower}";
						
						
						
						//============= create crop_info ===================================================================
							//Yii::app()->CGenAccNo->provice_code = "11"; //กำหนดค่าให้ propreties
							//Yii::app()->CGenAccNo->registernumber = "0115562012587"; 
							
							//set data to properties
							Yii::app()->CCropinfo_tmp->registernumber = $registerNumber; //"0115562012587"; // VARCHAR( 13 ) NOT NULL COMMENT 'เลขทะเบียนนิติบุคคล' ,
							Yii::app()->CCropinfo_tmp->registername = $registerName; //"คุ้มหลวง ทูยู" ; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อที่ใช้จดทะเบียน' ,
							Yii::app()->CCropinfo_tmp->acc_no = "0000000000"; //Yii::app()->CGenAccNo->genAccNumber(); // VARCHAR( 10 ) NOT NULL COMMENT 'เลขที่บัญชี' ,
							Yii::app()->CCropinfo_tmp->acc_bran = "000000"; // VARCHAR( 6 ) NOT NULL COMMENT 'สาขา' ,
							Yii::app()->CCropinfo_tmp->tsic = $tsic; //"47612"; // VARCHAR( 5 ) NOT NULL COMMENT 'รหัส tsic' ,
							Yii::app()->CCropinfo_tmp->tsicname = $tsicName; //"ร้านขายปลีกเครื่องเขียนและเครื่องใช้สำนักงาน"; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อ tsic' ,
							Yii::app()->CCropinfo_tmp->corptype = $corpType; //"5"; // VARCHAR( 1 ) NOT NULL COMMENT 'รหัสประเภทธุรกิจ' ,
							Yii::app()->CCropinfo_tmp->corptypename = $corpTypeName; //"บริษัทจำกัด"; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อประเภท' ,
							Yii::app()->CCropinfo_tmp->registerdate = $registerDate; //"2019-05-01 00:00:00"; // DATETIME NOT NULL COMMENT 'วันที่จดทะเบียน' ,
							Yii::app()->CCropinfo_tmp->updateddate = $updatedDate; //"0000-00-00 00:00:00"; // DATETIME NOT NULL COMMENT 'วันที่มีการแก้ไขข้อมูลล่าสุด' ,
							Yii::app()->CCropinfo_tmp->updateentry = $updatedEntry; //"0"; // VARCHAR( 1 ) NOT NULL COMMENT 'มีการแก้ไขข้อมูลหลังจากลงทะเบียน' ,
							Yii::app()->CCropinfo_tmp->accountingdate = $accountingDate; //"3112"; // VARCHAR( 4 ) NOT NULL COMMENT 'รอบปีบัญชี' ,
							Yii::app()->CCropinfo_tmp->authorizedcapital = $authorizedCapital; //"1000000"; // Double(20 ,2) NOT NULL COMMENT 'ทุนจดทะเบียน' ,
							Yii::app()->CCropinfo_tmp->statuscode = $statusCode; //"1"; // VARCHAR( 1 ) NOT NULL COMMENT 'สถานะนิติบุคคล' ,
							Yii::app()->CCropinfo_tmp->cpower = $cpower; //"กรรมการหนึ่งคนลงลายมือชื่อและประทับตราสำคัญของบริษัท"; // VARCHAR( 5000 ) NOT NULL COMMENT 'จำนวนหรือชื่อกรรมการที่ลงชื่อผูกพัน' ,
							Yii::app()->CCropinfo_tmp->crop_remark = "-"; // TEXT NULL COMMENT 'หมายเหตุ' ,
							Yii::app()->CCropinfo_tmp->crop_createby = "sys"; // VARCHAR( 100 ) NOT NULL COMMENT 'สร้างโดย' ,
							Yii::app()->CCropinfo_tmp->crop_createtime = date('Y-m-d H:i:s'); // DATETIME NOT NULL COMMENT 'วันที่สร้าง' ,
							Yii::app()->CCropinfo_tmp->crop_updateby = "sys"; // VARCHAR( 100 ) NOT NULL COMMENT 'แก้ไขโดย' ,
							Yii::app()->CCropinfo_tmp->crop_updatetime = date('Y-m-d H:i:s'); // DATETIME NOT NULL COMMENT 'วันที่แก้ไข' ,
							Yii::app()->CCropinfo_tmp->crop_status = 1; // TINYINT( 1 ) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ' ,
							
							//$rc1 = Yii::app()->CCropinfo_tmp->regexists();
							//echo "-{$rc1}-<br>";
							
							if(!Yii::app()->CCropinfo_tmp->regexists()){
								$msg_result = Yii::app()->CCropinfo_tmp->create();
								//$msg_result = "ยังไม่มีข้อมูล";
							}else{
								$msg_result = "มีข้อมูลอยู่แล้ว";
							}
							
							//echo "-{$msg_result}- <br>";
				        //============= end create crop_info ===============================================================
						
						//$data->CorpInfoList->corpInfo[0]->committees->committee
						if(property_exists($data->CorpInfoList->corpInfo[$f],"committees")) {
							if(is_array($data->CorpInfoList->corpInfo[$f]->committees->committee)){
								//echo "C Array Yes, <br>";
								$countcommittees = count($data->CorpInfoList->corpInfo[$f]->committees->committee); 
								//echo "committees : {$countcommittees} <br>";
								$crow = 1;
								for($c=0;$c<=$countcommittees-1;$c++){
									set_time_limit(0);
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
									
									 //echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
									 
									 //========== create committee =================================================
									 //กำหนดค่า ให้ properties ใน class
									Yii::app()->CCommittee_tmp->crop_id = Yii::app()->CCropinfo_tmp->getlastcorpid(); 
									Yii::app()->CCommittee_tmp->registernumber = $registerNumber; //"0115562012587"; //** select
									Yii::app()->CCommittee_tmp->tsic = $tsic; //"47612"; //** select
									Yii::app()->CCommittee_tmp->corptype = $corpType; // "5";  //** select
									Yii::app()->CCommittee_tmp->committeetype = $committeeType; //"K"; 
									Yii::app()->CCommittee_tmp->ordernumber = $orderNumber; //1; 
									Yii::app()->CCommittee_tmp->typeno = $identityType; //"1"; 
									Yii::app()->CCommittee_tmp->identity = $identity; //"1100800307965"; 
									Yii::app()->CCommittee_tmp->birthday = $dateOfBirth; //"1986-10-24 00:00:00"; 
									Yii::app()->CCommittee_tmp->title = $title; //"น.ส."; 
									Yii::app()->CCommittee_tmp->firstname = $firstName; //"จันท์สุดา"; 
									Yii::app()->CCommittee_tmp->lastname = $lastName; //"นวมรัตน์"; 
									Yii::app()->CCommittee_tmp->englishtitle = $englishTitle; //"Ms."; 
									Yii::app()->CCommittee_tmp->englishfirstname12 = $englishFirstName; //"JANSUDA"; 
									Yii::app()->CCommittee_tmp->englishlastname = $englishLastName; //"NAWAMARAT"; 
									Yii::app()->CCommittee_tmp->nation = $nationality; //"TH"; 
									Yii::app()->CCommittee_tmp->cmit_remark = "-"; 
									Yii::app()->CCommittee_tmp->cmit_createby = "sys"; 
									Yii::app()->CCommittee_tmp->cmit_createtime = date('Y-m-d H:i:s'); 
									Yii::app()->CCommittee_tmp->cmit_updateby = "sys"; 
									Yii::app()->CCommittee_tmp->cmit_updatetime = date('Y-m-d H:i:s');
									Yii::app()->CCommittee_tmp->cmit_status = 1; 
									
									if(!Yii::app()->CCommittee_tmp->committeeexists()){
										$msg_result = Yii::app()->CCommittee_tmp->create();
									}else{
										$msg_result = "มีรายการเลขที่บัตรประจำตัว : " . Yii::app()->CCommittee_tmp->identity . " อยู่ในระบบแล้ว.";	
									}
									
									//echo "{$msg_result},";
									 //========== end create committee =================================================
									
									$crow +=1;
								
								}//for($c=0;$c<=$countcommittees-1;$c++){
								
							}else{
								//echo "C Array No, <br>";
								$countcommittees = 1;
								//echo "committees : {$countcommittees} <br>";
								
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
									
									 //echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
									 
									 
									  //========== create committee =================================================
										 //กำหนดค่า ให้ properties ใน class
										Yii::app()->CCommittee_tmp->crop_id = Yii::app()->CCropinfo_tmp->getlastcorpid(); 
										Yii::app()->CCommittee_tmp->registernumber = $registerNumber; //"0115562012587"; //** select
										Yii::app()->CCommittee_tmp->tsic = $tsic; //"47612"; //** select
										Yii::app()->CCommittee_tmp->corptype = $corpType; // "5";  //** select
										Yii::app()->CCommittee_tmp->committeetype = $committeeType; //"K"; 
										Yii::app()->CCommittee_tmp->ordernumber = $orderNumber; //1; 
										Yii::app()->CCommittee_tmp->typeno = $identityType; //"1"; 
										Yii::app()->CCommittee_tmp->identity = $identity; //"1100800307965"; 
										Yii::app()->CCommittee_tmp->birthday = $dateOfBirth; //"1986-10-24 00:00:00"; 
										Yii::app()->CCommittee_tmp->title = $title; //"น.ส."; 
										Yii::app()->CCommittee_tmp->firstname = $firstName; //"จันท์สุดา"; 
										Yii::app()->CCommittee_tmp->lastname = $lastName; //"นวมรัตน์"; 
										Yii::app()->CCommittee_tmp->englishtitle = $englishTitle; //"Ms."; 
										Yii::app()->CCommittee_tmp->englishfirstname12 = $englishFirstName; //"JANSUDA"; 
										Yii::app()->CCommittee_tmp->englishlastname = $englishLastName; //"NAWAMARAT"; 
										Yii::app()->CCommittee_tmp->nation = $nationality; //"TH"; 
										Yii::app()->CCommittee_tmp->cmit_remark = "-"; 
										Yii::app()->CCommittee_tmp->cmit_createby = "sys"; 
										Yii::app()->CCommittee_tmp->cmit_createtime = date('Y-m-d H:i:s'); 
										Yii::app()->CCommittee_tmp->cmit_updateby = "sys"; 
										Yii::app()->CCommittee_tmp->cmit_updatetime = date('Y-m-d H:i:s');
										Yii::app()->CCommittee_tmp->cmit_status = 1; 
										
										if(!Yii::app()->CCommittee_tmp->committeeexists()){
											$msg_result = Yii::app()->CCommittee_tmp->create();
										}else{
											$msg_result = "มีรายการเลขที่บัตรประจำตัว : " . Yii::app()->CCommittee_tmp->identity . " อยู่ในระบบแล้ว.";	
										}
										
										//echo "{$msg_result},";
									 //========== end create committee =================================================
								
							}//if(is_array($data->CorpInfoList->corpInfo[$f]->committees->committee)){
						}else{
						  $countcommittees = 0;
						}//if(property_exists($data->CorpInfoList->corpInfo[$f],"committees")) {
						
						//$data->CorpInfoList->corpInfo[0]->branches->branch
						if(property_exists($data->CorpInfoList->corpInfo[$f],"branches")) {
							if(is_array($data->CorpInfoList->corpInfo[$f]->branches->branch)){
								//echo "B Array Yes, <br>";
								$countbranches = count($data->CorpInfoList->corpInfo[$f]->branches->branch);
								//echo "branches : {$countbranches} <br>";
								$brow = 1;
								for($b=0;$b<=$countbranches-1;$b++){
									set_time_limit(0);
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
									
									//echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
									
									
									//================ create branch ==============================================================
										Yii::app()->CBranch_tmp->crop_id = Yii::app()->CCropinfo_tmp->getlastcorpid();
										Yii::app()->CBranch_tmp->registernumber = $registerNumber; //"0115562012587"; 
										Yii::app()->CBranch_tmp->tsic = $tsic; //"47612"; 
										Yii::app()->CBranch_tmp->corptype = $corpType; //"5"; 
										Yii::app()->CBranch_tmp->ordernumber = $orderNumber; //1; 
										Yii::app()->CBranch_tmp->name = $name; //"สำนักงานใหญ่"; 
										Yii::app()->CBranch_tmp->houseid = $houseId; //"11031785426"; 
										Yii::app()->CBranch_tmp->housenumber = $houseNumber; //"111/418"; 
										Yii::app()->CBranch_tmp->buildingname = $buildingName; //"-"; 
										Yii::app()->CBranch_tmp->buildingnumber = $buildingNumber; //"-"; 
										Yii::app()->CBranch_tmp->buildingfloor = $buildingFloor; //"-";
										Yii::app()->CBranch_tmp->village = $village; //"-"; 
										Yii::app()->CBranch_tmp->moo = $moo; //"4"; 
										Yii::app()->CBranch_tmp->soi = $Soi; //"-"; 
										Yii::app()->CBranch_tmp->road = $Road; //"-"; 
										Yii::app()->CBranch_tmp->tumbon = $tumbon; //"บางแก้ว"; 
										Yii::app()->CBranch_tmp->tumboncode = $tumbonCode; //"02"; 
										Yii::app()->CBranch_tmp->ampur = $ampur; //"บางพลี"; 
										Yii::app()->CBranch_tmp->ampurcode = $ampurCode; //"03"; 
										Yii::app()->CBranch_tmp->province = $province; //"สมุทรปราการ"; 
										Yii::app()->CBranch_tmp->provincecode = $provinceCode; //"11"; 
										Yii::app()->CBranch_tmp->zipcode = $zipCode; //"10540"; 
										Yii::app()->CBranch_tmp->phonenumber = $phoneNumber; //"0922460043"; 
										Yii::app()->CBranch_tmp->faxnumber = $faxNumber; //"-";
										Yii::app()->CBranch_tmp->email = $email; //"-"; 
										Yii::app()->CBranch_tmp->brch_remark = "-"; 
										Yii::app()->CBranch_tmp->brch_createby = "sys"; 
										Yii::app()->CBranch_tmp->brch_createtime = date('Y-m-d H:i:s'); 
										Yii::app()->CBranch_tmp->brch_updateby = "sys"; 
										Yii::app()->CBranch_tmp->brch_updatetime = date('Y-m-d H:i:s'); 
										Yii::app()->CBranch_tmp->brch_status = 1; 
										
										//echo Yii::app()->CBranch_tmp->branchexists();
										
										if(!Yii::app()->CBranch_tmp->branchexists()){
											$msg_result = Yii::app()->CBranch_tmp->create();
										}else{
											$msg_result = "มีรายการสาขา : " . Yii::app()->CBranch_tmp->name . " อยู่ในระบบแล้ว.";		
										}
										
										//echo "--{$msg_result}, <br>";
									//================ end create branch ==========================================================
									
									$brow +=1;
								
								}//for($b=0;$b<=$countbranches-1;$b++){
							}else{
								//echo "B Array No, <br>";
								$countbranches=1;	
								//echo "branches : {$countbranches} <br>";
								//echo "{$f} ,";
								//$test2 = $data->CorpInfoList->corpInfo[$f]->branches->branch->name;
								//echo " {$test2} <br>";
								
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
									
									
									//echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
									
									
									//================ create branch ==============================================================
										Yii::app()->CBranch_tmp->crop_id = Yii::app()->CCropinfo_tmp->getlastcorpid();
										Yii::app()->CBranch_tmp->registernumber = $registerNumber; //"0115562012587"; 
										Yii::app()->CBranch_tmp->tsic = $tsic; //"47612"; 
										Yii::app()->CBranch_tmp->corptype = $corpType; //"5"; 
										Yii::app()->CBranch_tmp->ordernumber = $orderNumber; //1; 
										Yii::app()->CBranch_tmp->name = $name; //"สำนักงานใหญ่"; 
										Yii::app()->CBranch_tmp->houseid = $houseId; //"11031785426"; 
										Yii::app()->CBranch_tmp->housenumber = $houseNumber; //"111/418"; 
										Yii::app()->CBranch_tmp->buildingname = $buildingName; //"-"; 
										Yii::app()->CBranch_tmp->buildingnumber = $buildingNumber; //"-"; 
										Yii::app()->CBranch_tmp->buildingfloor = $buildingFloor; //"-";
										Yii::app()->CBranch_tmp->village = $village; //"-"; 
										Yii::app()->CBranch_tmp->moo = $moo; //"4"; 
										Yii::app()->CBranch_tmp->soi = $Soi; //"-"; 
										Yii::app()->CBranch_tmp->road = $Road; //"-"; 
										Yii::app()->CBranch_tmp->tumbon = $tumbon; //"บางแก้ว"; 
										Yii::app()->CBranch_tmp->tumboncode = $tumbonCode; //"02"; 
										Yii::app()->CBranch_tmp->ampur = $ampur; //"บางพลี"; 
										Yii::app()->CBranch_tmp->ampurcode = $ampurCode; //"03"; 
										Yii::app()->CBranch_tmp->province = $province; //"สมุทรปราการ"; 
										Yii::app()->CBranch_tmp->provincecode = $provinceCode; //"11"; 
										Yii::app()->CBranch_tmp->zipcode = $zipCode; //"10540"; 
										Yii::app()->CBranch_tmp->phonenumber = $phoneNumber; //"0922460043"; 
										Yii::app()->CBranch_tmp->faxnumber = $faxNumber; //"-";
										Yii::app()->CBranch_tmp->email = $email; //"-"; 
										Yii::app()->CBranch_tmp->brch_remark = "-"; 
										Yii::app()->CBranch_tmp->brch_createby = "sys"; 
										Yii::app()->CBranch_tmp->brch_createtime = date('Y-m-d H:i:s'); 
										Yii::app()->CBranch_tmp->brch_updateby = "sys"; 
										Yii::app()->CBranch_tmp->brch_updatetime = date('Y-m-d H:i:s'); 
										Yii::app()->CBranch_tmp->brch_status = 1; 
										
										//echo Yii::app()->CBranch_tmp->branchexists();
										
										if(!Yii::app()->CBranch_tmp->branchexists()){
											$msg_result = Yii::app()->CBranch_tmp->create();
										}else{
											$msg_result = "มีรายการสาขา : " . Yii::app()->CBranch_tmp->name . " อยู่ในระบบแล้ว.";		
										}
										
										//echo "{$msg_result}, <br>";
									//================ end create branch ==========================================================
									
							}
						}else{
							$countbranches=0;
						}
						
						//======= start gen account number 10 digit ==========================
							Yii::app()->CGenAccNo->provice_code = $provinceCode; //"11"; //กำหนดค่าให้ propreties
		    				Yii::app()->CGenAccNo->registernumber = $registerNumber; //"0115562012587";
							
							$numrows = Yii::app()->CGenAccNo->RowsCount();
							Yii::app()->CGenAccNo->rowcountnew = intval($numrows) + 1;
			
							$accno10digit = Yii::app()->CGenAccNo->genAccNumber(); //gen เลขประกันสังคม 10 หลัก
							
							$createnumprovice = Yii::app()->CGenAccNo->updatenumprovice(); //update จำนวนใน provice
							
							Yii::app()->CGenAccNo->acc_no = $accno10digit;
							Yii::app()->CGenAccNo->acc_bran = "000000";
							Yii::app()->CGenAccNo->acc_regis_no = $registerNumber;
							
							if(!Yii::app()->CGenAccNo->accnoexists()){ //ตรวจสอบเลขที่
							
								$createc = Yii::app()->CGenAccNo->CreateNewAcc(); //บันทึกเลขประกันสังคมที่ gen แล้ว
								
								Yii::app()->CCropinfo_tmp->registernumber = $registerNumber;
								Yii::app()->CCropinfo_tmp->acc_no = $accno10digit; 
								
								$updatestatuscorp = Yii::app()->CCropinfo_tmp->UpdateStatusCorp();
								
							}else{
								$createc = "มีเลขที่ Acccount Number อยู่แล้ว";
							}
							
						//echo "<br> {$accno10digit}, {$createc}";
						//echo "<br>{$updatestatuscorp}<br>";
						//======= start gen account number 10 digit ========================== 
						
						//======= start create corptinfo_temp statatus P ================================
						//read accno form accnumber
							
									
					    //======= end create corptinfo_temp statatus P =================================
						
						
						$rowno += 1; 
						
					}//for($f=0;$f<=$countcorpinfo-1;$f++){
						
				}else if($countcorpinfo == 1){//if($countcorpinfo > 1){
					
				}//else if($countcorpinfo == 1){
			
		}else{//if($countcorpinfo != 0){ 
			echo "Not have Data.";
		}
		
	}else{//if($params)
		echo "Error Can't call data from DBD : Please Check Paramiter of Web Service!";	
	} //if($params)

?>

<?php
			//echo "<br> no data <br>";
			//--------------------------- create in logrunservice --------------------------------
				//Yii::app()->Clogrunservice->lrs_id = "";
				$rundateremark = date_create('now')->format('Ymd');
				Yii::app()->Clogrunservice->lrs_servicename = "service1";
				Yii::app()->Clogrunservice->lrs_rundate = date('Y-m-d H:i:s');
				Yii::app()->Clogrunservice->lrs_resultrecord = $countcorpinfo;
				Yii::app()->Clogrunservice->lrs_createby = "sys";
				Yii::app()->Clogrunservice->lrs_created = date('Y-m-d H:i:s');
				Yii::app()->Clogrunservice->lrs_updateby = "sys";
				Yii::app()->Clogrunservice->lrs_modified = date('Y-m-d H:i:s');
				Yii::app()->Clogrunservice->lrs_remark = $rundate;
				Yii::app()->Clogrunservice->lrs_status = "1";
				
				$resultcreatelrs = Yii::app()->Clogrunservice->create();
				//echo "<br>-{$resultcreatelrs}-<br>";
			//------------------------------------------------------------------------------------
		}else{
			//echo "<br> have data <br>";
		}
		//echo "-{$resultlrs}-<br>";	
	//-------------------------------------------------------------------------------------------------
?>

<?php
	
	//ดึง data จาก xml ไฟล์
	
/*	$data = simplexml_load_file(Yii::app()->basePath . '/config/data.xml') or die("Error: Cannot create object");
	
	//echo "<pre>"; var_dump($data); echo "</pre>";
	
	$val3 = $data[0]->corpInfo; //อ้างอิงถึง object corpInfo
	//echo "<pre>"; var_dump($val3); echo "</pre>";
	
	$a = (array)$data; //แปลง $data เป็นรูปแบบ array
    //echo "<pre>"; print_r($a); echo "</pre>";
	
	$keys = array_keys((array)$data[0]->corpInfo); //เก็บ key ของ corpinfo 
    //echo "<pre>"; var_dump($keys); echo "</pre>";
	
	echo "<pre>";
	
	for($i=0;$i<=9;$i++){
	   
	   $ii = $i+1;
	   echo "{$ii} <br>";
	   foreach($data[0]->corpInfo[$i] as $key => $value) {
    		//do something with your $key and $value;
			$countcommittees = count($data[0]->corpInfo[$i]->committees->committee)-1;
			$countbranches = count($data[0]->corpInfo[$i]->branches->branch)-1;
			if($key != 'committees' && $key != 'branches'){
    			echo "{$key} = {$value} <br>";
			}else if($key == 'committees'){
				echo "countcommittees: <br>";
				for($c=0;$c<=$countcommittees;$c++){
					$cc = $c+1;
					echo "{$cc} <br>";
					foreach($data[0]->corpInfo[$i]->committees->committee[$c] as $key => $value){
						echo "&nbsp;&nbsp;&nbsp;{$key} = {$value} <br>";
					}
				}
			}else if($key == 'branches'){
				echo "branches: <br>";
				for($b=0;$b<=$countbranches;$b++){
					$bb = $b+1;
					echo "{$bb} <br>";
					foreach($data[0]->corpInfo[$i]->branches->branch[$b] as $key => $value){
						echo "&nbsp;&nbsp;&nbsp;{$key} = {$value} <br>";
					}
				}
			}
	   }
	   echo "<hr><br>";
   }// for
   
   echo "</pre>";
*/	
?>

<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
      <table id="wpddt1" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
      <thead>
          <tr>
              <th>ลำดับ</th>
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
		//$model = CropinfoTmpTb::model()->findAll(); // return data (array) findAllByAttributes(array('use_level'=>$d1v));
		//$startdate = $bgdatep . "T00:00:00+07:00";
	    //$enddate = $eddatep . "T23:59:59+07:00";
		
		$datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
		$datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
		
		$model = CropinfoTmpTb::model()->findAllByAttributes(array('registerdate'=>$datesch1));
		
		//$criteria = new CDbCriteria;
		//$criteria->condition = "registerdate BETWEEN '" . $datesch1 . "' AND '". $datesch2 . "'";
		//$criteria->addBetweenCondition('registerdate', '2019-05-01 00:00:00', '2019-05-01 23:59:59');
		//$model = CropinfoTmpTb::model()->find($criteria); 
		
		//$model = new CropinfoTmpTb;
		//$cropinfo = $model::model()->findBySQL("SELECT * FROM cropinfo_tmp_tb WHERE registerdate between '2019-05-01 00:00:00' and '2019-05-01 23:59:59'");
		
		//$wynik = $model::model()->findBySQL('SELECT * FROM uzytkownik');
        //$model = new CropinfoTmpTb;
		//$wynik = $model::model()->findBySQL('SELECT * FROM uzytkownik');

		//$criteria = new CDbCriteria;
		//$criteria->condition = "registerdate >= '2019-05-01 00:00:00' AND registerdate <= '2019-05-01 23:59:59'"; //$date_start $date_end
		//$model = CropinfoTmpTb::model()->find($criteria);
		
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
              <td style="text-align:center;"><?=$rowno?></td>
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
              <th>ลำดับ</th>
              <th>ชื่อนิติบุคคล</th>
              <th>เลขนิติบุคคล 13 หลัก</th>
              <th>เลขประกันสังคม 10 หลัก</th>
              <th>วันที่จดทะเบียน</th>
              <th>สถานะ</th>
              
          </tr>
      </tfoot>
  </table>
</div>
          
</body>
</html>
<!--Test Call Soap API-->
<?php
/*	  $client = new SoapClient("https://172.16.11.232:443/corpinfo-webservice-v2/CorpInfoWebService?wsdl",[
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
		"registerNumber" => '0103555016414'
	  );
	   
	   $data = $client->GetCorpInfoByRegisterNumberService($params);
	  
	   echo '<pre>';
		  var_dump($data);
	   echo '</pre>'; 	
*/				 
?>

<!--Test Call Rest API-->
<?php
/*	$ctc = "EN"; //$_GET["ctc"]; // "TH";

	$data = file_get_contents('https://wpdws.sso.go.th/webservice_rest/WebService_getAllProduct.php?ctc=' . $ctc);

	$mydata = json_decode($data,true); // json decode from web service json response
	
	//$response = new SimpleXMLElement($response); // xml response
	
	echo '<pre>';
		var_dump($mydata);
	echo '</pre>';
	
	if(count($mydata) == 0){
		echo "Not found data!";
	}else{
		foreach ($mydata as $result) {
			$CustomerID = $result["CustomerID"];
			$Name = $result["Name"];
			$Email = $result["Email"];
			$CountryCode = $result["CountryCode"];
			$Budget = $result["Budget"];
			$Used = $result["Used"];
			
			echo "{$CustomerID}, {$Name}, {$Email}, {$CountryCode} , {$Budget}, {$Used} <br>";
		}
	}
	*/
?>