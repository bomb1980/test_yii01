<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search Information From DBD</title>
<script>
	$(document).ready(function() {
		$('.panel').lobiPanel({
       		reload: false,
    		close: false,
			editTitle: false,
			sortable: true
			//minimize: false
		});
		
		var table = $('#cropinfo1').DataTable({
			"scrollX": true,
			"searching": false,
			"paging":   false,
        	"ordering": false,
        	"info":     false	
		});
		
	});
</script>
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
</head>

<body>
<?php
	if(is_null($dbddata)){ //ถ้าไม่มีผลลัพธ์กลับมาจะเป็น null
		//	
	}else{
		//echo 'Search Information From DBD <br><pre>';var_dump($dbddata);echo '</pre>';
		$data = $dbddata;
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
			   $tsic = ""; 
			}
			if(empty($tsic)){
				$tsic = "";
			}
			if(property_exists($data->CorpInfo,"tsicName")) {
			  $tsicName = $data->CorpInfo->tsicName;
			}else{
			  $tsicName = "";  
			}
			if(empty($tsicName)){
				$tsicName = "";
			}
			if(property_exists($data->CorpInfo,"corpType")) {
			  $corpType = $data->CorpInfo->corpType;
			}else{
			   $corpType =''; 
			}
			if(empty($corpType)){
				$corpType = "";
			}
			if(property_exists($data->CorpInfo,"corpTypeName")) {
			  $corpTypeName = $data->CorpInfo->corpTypeName;
			}else{
			   $corpTypeName =''; 
			}
			if(empty($corpTypeName)){
				$corpTypeName = "";
			}
			if(property_exists($data->CorpInfo,"registerNumber")) {
			  $registerNumber = $data->CorpInfo->registerNumber;
			}else{
			  $registerNumber ='';  
			}
			if(empty($registerNumber)){
				$registerNumber = "";
			}
			if(property_exists($data->CorpInfo,"registerName")) {
			  $registerName = $data->CorpInfo->registerName;
			}else{
			   $registerName ='';  
			}
			if(empty($registerName)){
				$registerName = "";
			}
			if(property_exists($data->CorpInfo,"registerDate")) {
			  $registerDate = $data->CorpInfo->registerDate;
			  
			  $rgdd = date_create($registerDate)->format('d');
			  $rgdm = date_create($registerDate)->format('m');
	          $rgdy = date_create($registerDate)->format('Y')+543;
	          $rgddmy = $rgdy . "-" . $rgdm . "-" . $rgdd; 
			  $registerDatef = date_create($rgddmy)->format('d-m-Y');
			  
			  $registerDate =  date_create($registerDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
			  
			  $rgdmi = intval(date_create($registerDate)->format('m'));
			  $rgdyi = intval(date_create($registerDate)->format('Y'));
			  
			  //echo "{$rgdmi},{$rgdyi}"; exit;
			  
			   if($rgdyi==2019){
				 if(($rgdmi>=9)){
					//echo "Y"; 
					$bt1 = "Y";
				 }else{
					//echo "N";
					$bt1 = "N";
				 }
			   }else if($rgdyi>2019){
				   $bt1 = "Y";
			   }else{
				   $bt1 = "N";
			   }//if
			   
			   //exit; 	
				   
			if($bt1=="Y"){
			?>
            	<script> $("#btnsav1").show(); </script> <!--$("#btnsav1").attr("disabled",false);  //$('#btnsav1').removeAttr("disabled");--> 
      <?php }else if($bt1=="N"){  ?>
				   	<script> $("#btnsav1").hide(); //$("#btnsav1").attr("disabled",true); </script>
             <?php
			}//if
			
			//exit;
			   
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
			  $updatedEntry =''; 
			}
			if(empty($updatedEntry)){
				  $updatedEntry ='';
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
			  $accountingDate ='';  
			}
			if(empty($accountingDate)){
				  $accountingDate ='';
			}
			if(property_exists($data->CorpInfo,"statusCode")) {
			  $statusCode = $data->CorpInfo->statusCode;
			  if($statusCode==1){
				  $statusCodef = "ยังดำเนินกิจการอยู่";
			  }
			}else{
			  $statusCode ='';  
			}
			
			if(empty($statusCode)){
				  $statusCode ='-';
			}
			if(property_exists($data->CorpInfo,"cpower")) {
			  $cpower = $data->CorpInfo->cpower;
			}else{
			  $cpower ='';  
			}
			if(empty($cpower)){
				  $cpower ='';
			}
			$now = date_create('now')->format('Y-m-d H:i:s');
			 
			if($statusCode==1){
			   $statusCodef = 'New'; 
			}else{
			   $statusCodef = 'Old'; 
			}
		
			  
			$df =date_create($registerDate)->format('d-m-Y'); //set format date
			
			//echo " {$registerNumber}, {$tsic}, {$tsicName}, {$corpType}, {$corpTypeName}, {$registerDate}, {$updatedDate}, {$updatedEntry}, {$accountingDate}, {$authorizedCapital}, {$statusCode}, {$cpower} <br>";
			

?>

<div class="row" id="rowresult2">
	<div class="col-md-12">
    
		<div class="row">
        	<div class="col-md-12">
            
            <div class="panel panel-info"><!--panel-->
                <div class="panel-heading">
                    <i class="fa fa-university"></i><font class="thfont5" style="font-size:24px;"><b> <?=$registerName?></b></font>
                </div>
                <div class="panel-body">
                    <div id="cres1" class="thfont5" style="padding-bottom:10px;">
                    	<table id="cropinfo1" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
                        	<thead>
                            	<tr>
                                    <th>เลขนิติบุคคล 13 หลัก</th>
                                    <th>ชื่อนิติบุคคล</th>
                                    <th>ประเภทนิติบุคคล</th>
                                    <th>วันที่จดทะเบียน</th>
                                    <th>สถานะนิติบุคคล</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                                	<td><?=$registerNumber?></td>
                                    <td><?=$registerName?></td>
                                    <td><?=$corpTypeName?></td>
                                    <td><?=$registerDatef?></td>
                                    <td><?php if($statusCode==1){ echo "ยังดำเนินกิจการอยู่"; }?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                     <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-danger"><!--panel-->
                                        <div class="panel-heading">
                                            <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"><b> ข้อมูลเจ้าของกิจการ</b></font>
                                        </div>
                                        <div class="panel-body">
                                            <div id="cres3" class="thfont5">
                                            	<table id="scommittee1" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
                                                  <thead>
                                                     <tr style="background-color:#6CC;">
                                                        <td style="text-align:center; width:10%; font-weight:bold;">#</td>
                                                        <td style="width:30%; font-weight:bold;">ชื่อ - สกุล (ไทย)</td>
                                                        <td style="width:30%; font-weight:bold;">ชื่อ - สกุล (Eng)</td>
                                                        <td style="text-align:center; width:20%; font-weight:bold;">เลขที่บัตรประจำตัว</td>
                                                        <td style="width:10%; font-weight:bold;">สัญชาติ</td>
                                                        
                                                     </tr>
                                                  </thead>
                                                  <tbody>
<?php
if(property_exists($data->CorpInfo,"committees")) {
					if(is_array($data->CorpInfo->committees->committee)){
						$countcommittees = count($data->CorpInfo->committees->committee); 
						$crow = 1;
						$ordernumber_old=0;
						for($c=0;$c<=$countcommittees-1;$c++){
							
							 
							
							  if(property_exists($data->CorpInfo->committees->committee[$c],"committeeType")) { 
								 $committeeType = $data->CorpInfo->committees->committee[$c]->committeeType;
							  }else{
								 $committeeType = ""; 
							  }
							  if(empty($committeeType)){
								  $committeeType ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"orderNumber")) { 
								 $orderNumber = $data->CorpInfo->committees->committee[$c]->orderNumber;
							  }else{
								 $orderNumber = 0; 
							  }
							  if(empty($orderNumber)){
								  $orderNumber ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"identityType")) { 
								 $identityType = $data->CorpInfo->committees->committee[$c]->identityType;
							  }else{
								 $identityType = ""; 
							  }
							  if(empty($identityType)){
								  $identityType ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"identity")) { 
								$identity = $data->CorpInfo->committees->committee[$c]->identity; 
							  }else{
								 $identity = ""; 
							  }
							  if(empty($identity)){
								  $identity ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"title")) { 
								$title = $data->CorpInfo->committees->committee[$c]->title; 
							  }else{
								 $title = ""; 
							  }
							  if(empty($title)){
								  $title ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"firstName")) { 
								$firstName = $data->CorpInfo->committees->committee[$c]->firstName;
							  }else{
								$firstName = ""; 
							  }
							  if(empty($firstName)){
								  $firstName ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"lastName")) { 
								$lastName = $data->CorpInfo->committees->committee[$c]->lastName; 
							  }else{
								$lastName = ""; 
							  }
							  if(empty($lastName)){
								  $lastName ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishTitle")) { 
								$englishTitle = $data->CorpInfo->committees->committee[$c]->englishTitle;  
							  }else{
								$englishTitle = ""; 
							  }
							  if(empty($englishTitle)){
								  $englishTitle ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishFirstName")) { 
								$englishFirstName = $data->CorpInfo->committees->committee[$c]->englishFirstName;  
							  }else{
								$englishFirstName = ""; 
							  }
							  if(empty($englishFirstName)){
								  $englishFirstName ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"englishLastName")) { 
								$englishLastName = $data->CorpInfo->committees->committee[$c]->englishLastName;
							  }else{
								$englishLastName = ""; 
							  }
							  if(empty($englishLastName)){
								  $englishLastName ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"nationality")) { 
								$nationality = $data->CorpInfo->committees->committee[$c]->nationality;
							  }else{
								$nationality = ""; 
							  }
							  if(empty($nationality)){
								  $nationality ='';
							  }
							  if(property_exists($data->CorpInfo->committees->committee[$c],"dateOfBirth")) {
								$dateOfBirth = $data->CorpInfo->committees->committee[$c]->dateOfBirth;
								$dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
							  }else{
								$dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
							  }
							  
							  //echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
							  
							  if($ordernumber_old != $orderNumber){	
						

?>
                                                  	<tr>
                                                    	<td style="text-align:center; width:10%;"><?=$orderNumber?></td>
                                                        <td style="width:20%;"><?=$title?> <?=$firstName?>  <?=$lastName?></td>
                                                        <td style="width:20%;"><?=$englishTitle?> <?=$englishFirstName?>  <?=$englishLastName?></td>
                                                        <td style="text-align:left; width:20%;"><?=$identity?></td>
                                                        <td style="width:10%;"><?=$nationality?></td>
                                                       
                                                    </tr>
<?php
									$ordernumber_old = $orderNumber;
							  }//if

}//for
						
					}else{//if(is_array($data->CorpInfo->committees->committee))
						$countcommittees = 1;
						if(property_exists($data->CorpInfo->committees->committee,"committeeType")) { 
						   $committeeType = $data->CorpInfo->committees->committee->committeeType;
						}else{
						   $committeeType = ""; 
						}
						if(empty($committeeType)){
							$committeeType ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"orderNumber")) { 
						   $orderNumber = $data->CorpInfo->committees->committee->orderNumber;
						}else{
						   $orderNumber = 0; 
						}
						if(empty($orderNumber)){
							$orderNumber ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"identityType")) { 
						   $identityType = $data->CorpInfo->committees->committee->identityType;
						}else{
						   $identityType = ""; 
						}
						if(empty($identityType)){
							$identityType ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"identity")) { 
						  $identity = $data->CorpInfo->committees->committee->identity; 
						}else{
						   $identity = ""; 
						}
						if(empty($identity)){
							$identity ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"title")) { 
						  $title = $data->CorpInfo->committees->committee->title; 
						}else{
						   $title = ""; 
						}
						if(empty($title)){
							$title ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"firstName")) { 
						  $firstName = $data->CorpInfo->committees->committee->firstName;
						}else{
						  $firstName = ""; 
						}
						if(empty($firstName)){
							$firstName ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"lastName")) { 
						  $lastName = $data->CorpInfo->committees->committee->lastName; 
						}else{
						  $lastName = ""; 
						}
						if(empty($lastName)){
							$lastName ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishTitle")) { 
						  $englishTitle = $data->CorpInfo->committees->committee->englishTitle;  
						}else{
						  $englishTitle = ""; 
						}
						if(empty($englishTitle)){
							$englishTitle ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishFirstName")) { 
						  $englishFirstName = $data->CorpInfo->committees->committee->englishFirstName;  
						}else{
						  $englishFirstName = ""; 
						}
						if(empty($englishFirstName)){
							$englishFirstName ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"englishLastName")) { 
						  $englishLastName = $data->CorpInfo->committees->committee->englishLastName;
						}else{
						  $englishLastName = ""; 
						}
						if(empty($englishLastName)){
							$englishLastName ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"nationality")) { 
						  $nationality = $data->CorpInfo->committees->committee->nationality;
						}else{
						  $nationality = ""; 
						}
						if(empty($nationality)){
							$nationality ='';
						}
						if(property_exists($data->CorpInfo->committees->committee,"dateOfBirth")) {
						  $dateOfBirth = $data->CorpInfo->committees->committee->dateOfBirth;
						  $dateOfBirth = date_create($dateOfBirth)->format('Y-m-d H:i:s');
						}else{
						  $dateOfBirth =date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
						}
						
						
						//echo " &nbsp;&nbsp; {$committeeType}, {$orderNumber}, {$identityType}, {$identity}, {$title}, {$firstName}, {$lastName}, {$englishTitle}, {$englishFirstName}, {$englishLastName}, {$nationality} , {$dateOfBirth} <br>";
?>
							
													<tr>
                                                    	<td style="text-align:center; width:10%;"><?=$orderNumber?></td>
                                                        <td style="width:20%;"><?=$title?> <?=$firstName?>  <?=$lastName?></td>
                                                        <td style="width:20%;"><?=$englishTitle?> <?=$englishFirstName?>  <?=$englishLastName?></td>
                                                        <td style="text-align:left; width:20%;"><?=$identity?></td>
                                                        <td style="width:10%;"><?=$nationality?></td>
                                                       
                                                    </tr>

<?php						
					}//else if
			
				}else{//if(property_exists($data->CorpInfo,"committees"))
					$countcommittees = 0;
				}//else if
?>
                                                  </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!--panel-->
                                    
                                </div><!--col-md-12-->
                            </div><!--row-->
                        </div><!--col-->
                        <div class="col-md-5">
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="panel panel-warning"><!--panel-->
                                      <div class="panel-heading">
                                          <i class="fa fa-university"></i><font class="thfont5" style="font-size:24px;"><b> รายละเอียดกิจการ</b></font>
                                      </div>
                                      <div class="panel-body">
                                          <div id="cres4" class="thfont5">
                                          	<table id="sbranch1" cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
                                            	<tbody>
                                                	<tr>
                                                        <td style="text-align:right; width:30%; font-weight:bold;">หมวดธุรกิจ:</td>
                                                        <td style="text-align:left; width:70%; padding-left:15px;"><?=$tsic?>: <?=$tsicName?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right; width:30%; font-weight:bold;">ทุนจดทะเบียน :</td>
                                                        <td style="text-align:left; width:70%; padding-left:15px;"><?=number_format($authorizedCapital,0,".",",")?> บาท</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right; width:30%; font-weight:bold;">คณะกรรมการลงชื่อผูกพัน :</td>
                                                        <td style="text-align:left; width:70%; padding-left:15px;"><?=$cpower?></td>
                                                    </tr>
                                                </tbody>
                                                
                                            </table>
                                          </div>
                                      </div>
                                  </div><!--panel-->
                                  
                              </div>
                          </div><!--row-->
                        </div><!--col-->
                    </div><!--row-->
                    
                    <div class="row">
                    	<div class="col-md-12">
                        	<div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-success"><!--panel-->
                                        <div class="panel-heading">
                                            <i class="fa fa-industry"></i><font class="thfont5" style="font-size:24px;"><b> สำนักงาน</b></font>
                                        </div>
                                        <div class="panel-body">
                                            <div id="cres4" class="thfont5">
                                            	<table id="sbranch1" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
                                                   <thead>
                                                     <tr style="background-color:#6CC;">
                                                        <td style="text-align:center; width:10%; font-weight:bold;">#</td>
                                                        <td style="width:15%; font-weight:bold;">ชื่อสาขา</td>
                                                        <td style="width:40%; font-weight:bold;">สถานที่ตั้ง</td>
                                                        <td style="width:10%; font-weight:bold;">เบอร์โทรศัพท์</td>
                                                        <td style="width:10%; font-weight:bold;">เบอร์แฟกซ์</td>
                                                        <td style="width:15%; font-weight:bold;">E-mail</td>
                                                     </tr>
                                                  </thead>
                                                  
                                                  <tbody>
<?php
if(property_exists($data->CorpInfo,"branches")) {
					if(is_array($data->CorpInfo->branches->branch)){
						 $countbranches = count($data->CorpInfo->branches->branch);
						 $brow = 1;
						 for($b=0;$b<=$countbranches-1;$b++){
							  if(property_exists($data->CorpInfo->branches->branch[$b],"name")) { 
								$name = $data->CorpInfo->branches->branch[$b]->name;
							  }else{
								$name = ""; 
							  }
							  if(empty($name)){
								  $name ='';
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
								$houseId = ""; 
							  }
							  if(empty($houseId)){
								  $houseId ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"houseNumber")) { 
								$houseNumber = $data->CorpInfo->branches->branch[$b]->houseNumber;
							  }else{
								$houseNumber = ""; 
							  }
							  if(empty($houseNumber)){
								  $houseNumber ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingName")) { 
								$buildingName = $data->CorpInfo->branches->branch[$b]->buildingName; 
							  }else{
								$buildingName = ""; 
							  }
							  if(empty($buildingName)){
								  $buildingName ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingNumber")) { 
								$buildingNumber = $data->CorpInfo->branches->branch[$b]->buildingNumber; 
							  }else{
								$buildingNumber = ""; 
							  }
							  if(empty($buildingNumber)){
								  $buildingNumber ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"buildingFloor")) { 
								$buildingFloor = $data->CorpInfo->branches->branch[$b]->buildingFloor; 
							  }else{
								$buildingFloor = ""; 
							  }
							  if(empty($buildingFloor)){
								  $buildingFloor ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"village")) { 
								$village = $data->CorpInfo->branches->branch[$b]->village;
							  }else{
								$village = ""; 
							  }
							  if(empty($village)){
								  $village ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"moo")) { 
								$moo = $data->CorpInfo->branches->branch[$b]->moo;
							  }else{
								$moo = ""; 
							  }
							  if(empty($moo)){
								  $moo ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"Soi")) { 
								$Soi = $data->CorpInfo->branches->branch[$b]->Soi;
							  }else{
								$Soi = ""; 
							  }
							  if(empty($Soi)){
								  $Soi ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"Road")) { 
								$Road = $data->CorpInfo->branches->branch[$b]->Road;
							  }else{
								$Road = ""; 
							  }
							  if(empty($Road)){
								  $Road ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"tumbon")) { 
								$tumbon = $data->CorpInfo->branches->branch[$b]->tumbon;
							  }else{
								$tumbon = ""; 
							  }
							  if(empty($tumbon)){
								  $tumbon ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"ampur")) { 
								$ampur = $data->CorpInfo->branches->branch[$b]->ampur;
							  }else{
								$ampur = ""; 
							  }
							  if(empty($ampur)){
								  $ampur ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"province")) { 
								$province = $data->CorpInfo->branches->branch[$b]->province;
							  }else{
								$province = ""; 
							  }
							  if(empty($province)){
								  $province ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"tumbonCode")) { 
								$tumbonCode = $data->CorpInfo->branches->branch[$b]->tumbonCode;
							  }else{
								$tumbonCode = ""; 
							  }
							  if(empty($tumbonCode)){
								  $tumbonCode ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"ampurCode")) { 
								$ampurCode = $data->CorpInfo->branches->branch[$b]->ampurCode; 
							  }else{
								$ampurCode = ""; 
							  }
							  if(empty($ampurCode)){
								  $ampurCode ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"provinceCode")) { 
								$provinceCode = $data->CorpInfo->branches->branch[$b]->provinceCode;  
							  }else{
								$provinceCode = ""; 
							  }
							  if(empty($provinceCode)){
								  $provinceCode ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"zipCode")) { 
								$zipCode = $data->CorpInfo->branches->branch[$b]->zipCode;   
							  }else{
								$zipCode = ""; 
							  }
							  if(empty($zipCode)){
								  $zipCode ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"phoneNumber")) { 
								$phoneNumber = $data->CorpInfo->branches->branch[$b]->phoneNumber;   
							  }else{
								$phoneNumber = ""; 
							  }
							  if(empty($phoneNumber)){
								  $phoneNumber ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"faxNumber")) { 
								$faxNumber = $data->CorpInfo->branches->branch[$b]->faxNumber;   
							  }else{
								$faxNumber = ""; 
							  }
							  if(empty($faxNumber)){
								  $faxNumber ='';
							  }
							  if(property_exists($data->CorpInfo->branches->branch[$b],"email")) { 
								$email = $data->CorpInfo->branches->branch[$b]->email;   
							  }else{
								$email = ""; 
							  }
							  if(empty($email)){
								  $email ='';
							  }
							  
							  //echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
							  
							  $addressp = $houseNumber . " " . $buildingName . " " . $buildingNumber . " " . $buildingFloor . " " . $village . "ม." . $moo . " " . $Soi . " " . $Road . " " . $tumbon . " " . $ampur . " " .  $province . " " . $zipCode;
						
?>
                                                  	<tr>
                                                    	<td style="text-align:center; width:10%;"><?=$brow?></td>
                                                        <td style="width:15%;"><?=$name?></td>
                                                        <td style="width:40%;"><?=$addressp?></td>
                                                        <td style="width:10%;"><?=$phoneNumber?></td>
                                                        <td style="width:10%;"><?=$faxNumber?></td>
                                                        <td style="width:15%;"><?=$email?></td>
                                                    </tr>
<?php
	$brow += 1;
 }//for
					}else{//if(is_array($data->CorpInfoList->corpInfo[$f]->branches->branch))
						 $countbranches=1;
						 if(property_exists($data->CorpInfo->branches->branch,"name")) { 
							$name = $data->CorpInfo->branches->branch->name;
						  }else{
							$name = ""; 
						  }
						  if(empty($name)){
							  $name ='';
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
							$houseId = ""; 
						  }
						  if(empty($houseId)){
							  $houseId ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"houseNumber")) { 
							$houseNumber = $data->CorpInfo->branches->branch->houseNumber;
						  }else{
							$houseNumber = ""; 
						  }
						  if(empty($houseNumber)){
							  $houseNumber ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingName")) { 
							$buildingName = $data->CorpInfo->branches->branch->buildingName; 
						  }else{
							$buildingName = ""; 
						  }
						  if(empty($buildingName)){
							  $buildingName ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingNumber")) { 
							$buildingNumber = $data->CorpInfo->branches->branch->buildingNumber; 
						  }else{
							$buildingNumber = ""; 
						  }
						  if(empty($buildingNumber)){
							  $buildingNumber ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"buildingFloor")) { 
							$buildingFloor = $data->CorpInfo->branches->branch->buildingFloor; 
						  }else{
							$buildingFloor = ""; 
						  }
						  if(empty($buildingFloor)){
							  $buildingFloor ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"village")) { 
							$village = $data->CorpInfo->branches->branch->village;
						  }else{
							$village = ""; 
						  }
						  if(empty($village)){
							  $village ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"moo")) { 
							$moo = $data->CorpInfo->branches->branch->moo;
						  }else{
							$moo = ""; 
						  }
						  if(empty($moo)){
							  $moo ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"Soi")) { 
							$Soi = $data->CorpInfo->branches->branch->Soi;
						  }else{
							$Soi = ""; 
						  }
						  if(empty($Soi)){
							  $Soi ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"Road")) { 
							$Road = $data->CorpInfo->branches->branch->Road;
						  }else{
							$Road = ""; 
						  }
						  if(empty($Road)){
							  $Road ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"tumbon")) { 
							$tumbon = $data->CorpInfo->branches->branch->tumbon;
						  }else{
							$tumbon = ""; 
						  }
						  if(empty($tumbon)){
							  $tumbon ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"ampur")) { 
							$ampur = $data->CorpInfo->branches->branch->ampur;
						  }else{
							$ampur = ""; 
						  }
						  if(empty($ampur)){
							  $ampur ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"province")) { 
							$province = $data->CorpInfo->branches->branch->province;
						  }else{
							$province = ""; 
						  }
						  if(empty($province)){
							  $province ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"tumbonCode")) { 
							$tumbonCode = $data->CorpInfo->branches->branch->tumbonCode;
						  }else{
							$tumbonCode = ""; 
						  }
						  if(empty($tumbonCode)){
							  $tumbonCode ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"ampurCode")) { 
							$ampurCode = $data->CorpInfo->branches->branch->ampurCode; 
						  }else{
							$ampurCode = ""; 
						  }
						  if(empty($ampurCode)){
							  $ampurCode ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"provinceCode")) { 
							$provinceCode = $data->CorpInfo->branches->branch->provinceCode;  
						  }else{
							$provinceCode = ""; 
						  }
						  if(empty($provinceCode)){
							  $provinceCode ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"zipCode")) { 
							$zipCode = $data->CorpInfo->branches->branch->zipCode;   
						  }else{
							$zipCode = ""; 
						  }
						  if(empty($zipCode)){
							  $zipCode ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"phoneNumber")) { 
							$phoneNumber = $data->CorpInfo->branches->branch->phoneNumber;   
						  }else{
							$phoneNumber = ""; 
						  }
						  if(empty($phoneNumber)){
							  $phoneNumber ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"faxNumber")) { 
							$faxNumber = $data->CorpInfo->branches->branch->faxNumber;   
						  }else{
							$faxNumber = ""; 
						  }
						  if(empty($faxNumber)){
							  $faxNumber ='';
						  }
						  if(property_exists($data->CorpInfo->branches->branch,"email")) { 
							$email = $data->CorpInfo->branches->branch->email;   
						  }else{
							$email = ""; 
						  }
						  if(empty($email)){
							  $email ='';
						  }
						  
						   //echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";
						  
						  $addressp = $houseNumber . " " . $buildingName . " " . $buildingNumber . " " . $buildingFloor . " " . $village . "ม." . $moo . " " . $Soi . " " . $Road . " " . $tumbon . " " . $ampur . " " .  $province . " " . $zipCode;
		
?>
													<tr>
                                                    	<td style="text-align:center; width:10%;">1</td>
                                                        <td style="width:15%;"><?=$name?></td>
                                                        <td style="width:40%;"><?=$addressp?></td>
                                                        <td style="width:10%;"><?=$phoneNumber?></td>
                                                        <td style="width:10%;"><?=$faxNumber?></td>
                                                        <td style="width:15%;"><?=$email?></td>
                                                    </tr>											

<?php
						   
						    
					}//else if is_array
				}else{//if(property_exists($data->CorpInfo,"branches"))
					$countbranches=0;
				}//else if
?>
                                                  </tbody>
                                                  
                                                </table>
                                            </div>
                                        </div>
                                    </div><!--panel-->
                                    
                                </div>
                            </div><!--row-->
                        </div>
                    </div><!--row-->
                    
                </div><!--pbody-->
                
            </div><!--panel-->
            
            
           <!-- <div class="panel panel-info"><!--panel2
            	<div class="panel-heading">
                    <i class="fa fa-university"></i><font class="thfont5" style="font-size:24px;"><b> <?=$registerName?></b></font>
                </div>
                <div class="panel-body">
                	<div id="dbdfrm" class="thfont5">
                      <table id="sbranch1" cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
                          <tbody>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">เลขทะเบียนนิติบุคคล :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">ประเภทนิติบุคคล :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">วันที่จดทะเบียน :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">สถานะนิติบุคคล :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">ทุนจดทะเบียน (บาท) :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">ที่ตั้ง :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">หมวดธุรกิจ :<br>(มาจากงบการเงินปีล่าสุด)</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">กรรมการ :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">คณะกรรมการลงชื่อผูกพัน :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">โทรศัพท์ :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">โทรสาร :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                              <tr>
                                  <td style="text-align:right; width:30%; font-weight:bold;">E-mail address :</td>
                                  <td style="text-align:left; width:70%; padding-left:15px;"></td>
                              </tr>
                          </tbody>
                          
                      </table>
                    </div>
                </div>
            </div><!--//panel2-->
            
            </div><!--Col-->
        </div><!--row-->
        
        
        
	</div>
</div>


<?php						
						
		}//if($countcorpinfo != 0){
			
?>

<?php			
		
			
	}//is_null($dbddata)
?>
</body>
</html>