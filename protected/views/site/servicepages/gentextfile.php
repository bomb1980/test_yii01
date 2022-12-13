<?php
set_time_limit(0);
ini_set("max_execution_time","0");
ini_set("memory_limit","9999M"); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Generate Text File</title>
</head>

<body>

<?php

 // Yii::log('Error Test by niras: ' ,CLogger::LEVEL_ERROR,'system.db.CDbCommand');
	
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
?>
<?php
	//$startdate = $bgdatep . "T00:00:00+07:00";
	//$enddate = $eddatep . "T23:59:59+07:00";
	
	//$datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
	//$datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
	
	$now = date_create('now')->format('Y-m-d H:i:s');
	$tomorrow = date_create('+1 day')->format('Y-m-d');
	$tdy = date_create('now')->format('Ymd');
	$tdyd = date_create('now')->format('d');
	$tdym = date_create('now')->format('m');
	$tdyy = date_create('now')->format('Y');
	
	$tdyyth = $tdyy + 543;
	
	$tdy = $tdyyth . $tdym . $tdyd;
	//================ count textfile today generedted ==============================
		/*
		Yii::app()->Cgentextfile->gtf_remark= date('Ymd');
		$numtotalrow = Yii::app()->Cgentextfile->counttodaygen();
		$numaddone = $numtotalrow +1; 
		*/
		
		//var_dump($numtotalrow);
		//echo "{$numtotalrow}-<br>";
	//===============================================================================

	//$textfilename = "wpd-" . $tdy . "-" . $numaddone . ".txt";
	
	$textfilename = "wpd" . $tdy . ".txt";
	
	//$mypath = Yii::app()->params['ngixpath'] . "/ssowpd/assets/exportfile/" . $textfilename;
	$mypath = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/" . $textfilename;

	//$myfile = fopen(Yii::app()->params['ngixpath'] . Yii::app()->request->baseUrl . "/assets/exportfile/" . $textfilename, "w") or die("Unable to open file!");
	$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/" . $textfilename, "w") or die("Unable to open file!");
	
	//$myfile = fopen("formatcomp.txt", "w") or die("Unable to open file!");
	
	$txt = "";
	
?>
	<div  class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
    
    <?php
//---- ฟังก์ชั่น ตัดข้อความ utf8 -----------------------------------------------------------------------	
function str_split_unicode($str, $l = 0) {
  if ($l > 0) {
	  $ret = array();
	  $len = mb_strlen($str, "UTF-8");
	  for ($i = 0; $i < $len; $i += $l) {
		  $ret[] = mb_substr($str, $i, $l, "UTF-8");
	  }
	  return $ret;
  }
  return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}//function

//echo substr($massage,0,25);
//echo  mb_substr($massage,0,25,'UTF-8');
//echo iconv_substr($massage, 0,25, "UTF-8");
//-----------------------------------------------------------------------------------------------
	
		$qcorp = new CDbCriteria( array(
    		'condition' => "crop_remark = :crop_remark ",         // no quotes around :match
    		'params'    => array(':crop_remark' => "B")  //  $statusgt
		));
		
		/*$qcorp = new CDbCriteria( array(
    		'condition' => "registernumber = :registernumber ",         // no quotes around :match
    		'params'    => array(':registernumber' => "0505562014187")  //  $statusgt
		));*/
		
        $resulcrop = CropinfoTmpTb::model()->findAll($qcorp);
		$countb = count($resulcrop);
	
if($countb>0){
		
		//echo "จำนวนกิจการสถานะ B : {$countb} รายการ<br>";
		$rowno = 1;
		foreach ($resulcrop as $rows){
			
			$crop_id = $rows->crop_id;
			$registernumber = $rows->registernumber;
			if (strstr($rows->registername, 'จำกัด' )) {
			  //echo "หาคำเจอ <br>";
			  $registername = substr($rows->registername,0,strpos($rows->registername,'จำกัด'));
			} else {
			  //echo "หาคำไม่เจอ <br>";
			  $registername = $rows->registername;
			}
			$acc_no = $rows->acc_no;
			$acc_bran = $rows->acc_bran;
			$tsic = $rows->tsic;
			$tsicname = $rows->tsicname;
			$corptype = $rows->corptype;
			$corptypename = $rows->corptypename;
			$registerdate = $rows->registerdate;
			$updateddate = $rows->updateddate;
			$updateentry = $rows->updateentry;
			$accountingdate = $rows->accountingdate;
			$authorizedcapital = $rows->authorizedcapital;
			$statuscode = $rows->statuscode;
			$cpower = $rows->cpower;
			$crop_remark = $rows->crop_remark;
			$crop_createby = $rows->crop_createby;
			$crop_createtime = $rows->crop_createtime;
			$crop_updateby = $rows->crop_updateby;
			$crop_updatetime = $rows->crop_updatetime;
			$crop_status = $rows->crop_status;
			
			//$registername = substr("Hello world",0,strpos("Hello world","world"));
			
			$len = strlen($registername);
			
			$registername_arr1 = mb_substr($registername,0,50, "utf-8");//substr($registername,0,50);
			$registername_arr2 = mb_substr($registername,51,99, "utf-8");//substr($registername,51,99);
			
			//$cr1 = iconv("utf-8","tis-620//IGNORE//TRANSLIT",$registername_arr1);
			//$cr2 = iconv("utf-8","tis-620//IGNORE//TRANSLIT",$registername_arr2);
			
			//$count_registername_arr = count($registername_arr);
			
			//echo "{$registername}, {$len},  <br>"; 
			//var_dump($registername_arr);
		    //echo "<br>---- {$registername_arr1} ---- <br> ----{$registername_arr2}---- <br>";
			
			//exit;
			
			//echo "{$rowno},{$crop_id},{$registernumber},{$registername},{$acc_no},{$acc_bran},{$tsic},{$tsicname},{$corptype},{$corptypename},{$registerdate},{$updateddate},{$updateentry},{$accountingdate},{$authorizedcapital},{$statuscode},{$cpower},{$crop_remark},{$crop_createby},{$crop_createtime},{$crop_updateby},{$crop_updatetime},{$crop_status} <br>";
			
			//echo "<hr>";
			
			//---------------- set format data ----------------------------
				//str_pad($this->RowsCount()+1, 6, 0, STR_PAD_LEFT);
				//$tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
			
				 $y1 = date('Y') + 543;
				 $m1 = str_pad(date('m'),2,0, STR_PAD_LEFT);
				 $d1 = str_pad(date('d'),2,0, STR_PAD_LEFT);
				 
				 $dt1 = $y1 . $m1 . $d1;
				 
				 $h1 = str_pad(date('H'),2,0, STR_PAD_LEFT);
				 $i1 = str_pad(date('i'),2,0, STR_PAD_LEFT);
				 $s1 = str_pad(date('s'),2,0, STR_PAD_LEFT);
				 
				 $dt2 = $h1 . $i1 . $s1;
				 
				 $corptype_str = (string)$corptype;
				 
			$qcty = new CDbCriteria( array(
				'condition' => "cty_typecode = :cty_typecode ",         
				'params'    => array(':cty_typecode' => "{$corptype_str}")  
			));		 
			$resultcty = CorptypeTb::model()->findAll($qcty);
			foreach ($resultcty as $rows){
				 $cty_id = $rows->cty_id;
				 $cty_typecode = $rows->cty_typecode;
				 $cty_typenameshort = $rows->cty_typenameshort;
				 $cty_typenamefull = $rows->cty_typenamefull;
				 $cty_busstypecode = $rows->cty_busstypecode;
				 $cty_prefixname = $rows->cty_prefixname;
				 $cty_suffixname = $rows->cty_suffixname;
			}
				 
				 
			//---------------- set format data ----------------------------
			
			$qbrch = new CDbCriteria( array(
				'condition' => "crop_id = :crop_id and ordernumber = :ordernumber",         
				'params'    => array(':crop_id' => "{$crop_id}", ':ordernumber' => 0)  
			));	
			
			$resultbrch = BranchTmpTb::model()->findAll($qbrch);
			$countbrch = count($resultbrch);
				
			//echo "สำนักงาน : {$countbrch} ที่ <br>";	
			
			foreach ($resultbrch as $rows){
				 $brch_id = $rows->brch_id;
				 $crop_id = $rows->crop_id;
				 $registernumber = $rows->registernumber;
				 $tsic = $rows->tsic;
				 $corptype = $rows->corptype;
				 $ordernumber = $rows->ordernumber;
				 $name = $rows->name;
				 $houseid = $rows->houseid;
				 $housenumber = $rows->housenumber;
				 $buildingname = $rows->buildingname;
				 $buildingnumber = $rows->buildingnumber;
				 $buildingfloor = $rows->buildingfloor;
				 $village = $rows->village;
				 $moo = $rows->moo;
				 $soi = $rows->soi;
				 $road = $rows->road;
				 $tumbon = $rows->tumbon;
				 $tumboncode = $rows->tumboncode;
				 $ampur = $rows->ampur;
				 $ampurcode = $rows->ampurcode;
				 $province = $rows->province;
				 $provincecode = $rows->provincecode;
				 $zipcode = $rows->zipcode;
				 $p1 = str_replace("-","",$rows->phonenumber);
				 $phonenumber = mb_substr($p1,0,10, "utf-8"); //($p1,0,10);  //$rows->phonenumber;
				 $f1 = str_replace("-","",$rows->faxnumber);
				 $faxnumber = mb_substr($f1,0,10, "utf-8");
				 $email = $rows->email;
				 $brch_remark = $rows->brch_remark;
				 $brch_createby = $rows->brch_createby;
				 $brch_createtime = $rows->brch_createtime;
				 $brch_updateby = $rows->brch_updateby;
				 $brch_updatetime = $rows->brch_updatetime;
				 $brch_status = $rows->brch_status;
				 
				 //echo "<br>-{$housenumber}-<br>";
				 
				 $table_no1 = "8100";
				 
				 if($housenumber!='-'){
					 $housenumber = $housenumber;
				 }else{
					 $housenumber = "";
				 }
				
				 if($buildingname!='-'){
					 $buildingname = $buildingname;
				 }else{
					 $buildingname = "";
				 }
				 
				 if($buildingnumber!='-'){
					 $buildingnumber = $buildingnumber;
				 }else{
					 $buildingnumber = "";
				 }
				 
				 if($buildingfloor!='-'){
					 $buildingfloor = $buildingfloor;
				 }else{
					 $buildingfloor = "";
				 }
				 
				 if($village!='-'){
					 $village = $village;
				 }else{
					 $village = "";
				 }
				 
				 if($moo!='-'){
					 $moo = "ม." . $moo;
				 }else{
					 $moo = "";
				 }
				 
				 if($soi!='-'){
					 $soi = "ซ." . $soi;
				 }else{
					 $soi = "";
				 }
				 
				  if($road!='-'){
					 $road = "ถ." . $road;
				 }else{
					 $road = "";
				 }
				 
				 
				 //echo "<br>-{$housenumber}-<br>";
				 
				 $add1 = $housenumber . $moo . $soi . $road;
				 
				 //ตัดให้ที่อยู่ 1 ความยามไม่เกิน 30 ตัวอักษร
				 $add1 = mb_substr($add1,0,30, "utf-8"); //substr($add1,0,30);
				 
				 if($tumbon!='-'){
					 $tumbon = $tumbon;
				 }else{
					 $tumbon = "";
				 }
				 
				 $add2 = $tumbon;
				 
				 $dist_no = $provincecode . $ampurcode;
				 
				 $prov_no = $provincecode;
				 
				 $zip_code = $zipcode;
				 
				 if($phonenumber!='-'){
					 $phonenumber = $phonenumber;
				 }else{
					 $phonenumber = "";
				 }
				 
				 $tel_no = $phonenumber;
				 
				 if($faxnumber!='-'){
					 $faxnumber = $faxnumber;
				 }else{
					 $faxnumber = "";
				 }
				 
				 $fax_no = $faxnumber;
				 
                                 Yii::log('Error Test by niras Registernumber: ' . $registernumber  ,CLogger::LEVEL_ERROR,'system.db.CDbCommand');
				 //ค้นหาวันที่มีลูกจ้าง EmpstateTb
				 $emsm =EmpstateTb::model()->findByAttributes(array('ems_registernumber'=>$registernumber));
			     $emsstartdate = $emsm->ems_startdate;
		
				 
				 //กำหนดแยก วัน เดือน ปี
				 $emsd = date_create($emsstartdate)->format('d');
			  	 $emsm = date_create($emsstartdate)->format('m');
	          	 $emsy = date_create($emsstartdate)->format('Y')+543;
	          	 	
				 
				 $yf1 = str_pad($emsy,2,0, STR_PAD_LEFT);
				 $nm = str_pad($emsm,2,0, STR_PAD_LEFT); //date_create('+1 month')->format('m');
				 $mf1 = $nm; //str_pad($nm,2,0, STR_PAD_LEFT);
				 $df1 = str_pad($emsd,2,0, STR_PAD_LEFT); //"01"; //date('d');
				 
				 /*
				   $y1 = date('Y') + 543;
				   $m1 = str_pad(date('m'),2,0, STR_PAD_LEFT);
				   $d1 = str_pad(date('d'),2,0, STR_PAD_LEFT);
				   
				   $dt1 = $y1 . $m1 . $d1;
				 */
				 
				 $first_date = $yf1 . $mf1 . $df1;  
				 
				 
				// echo "{$brch_id}, {$crop_id}, {$registernumber}, {$tsic}, {$corptype}, {$ordernumber}, {$name}, {$houseid}, {$housenumber}, {$buildingname}, {$buildingnumber}, {$buildingfloor}, {$village}, {$moo}, {$soi}, {$road}, {$tumbon}, {$tumboncode}, {$ampur}, {$ampurcode}, {$province}, {$provincecode}, {$zipcode}, {$phonenumber}, {$faxnumber}, {$email}, {$brch_remark}, {$brch_createby}, {$brch_updatetime}, {$brch_updateby}, {$brch_updatetime}, {$brch_status}, {$dt1}, {$dt2} <br>"; 
				 
				 
				 
			}//foreach ($resultcom as $rows){
				
				//echo "<hr>";
			
			
			$txt = "";
			$f1 = iconv("utf-8","tis-620",$table_no1);
			$f2 = iconv("utf-8","tis-620",$dt1);
			$f3 = iconv("utf-8","tis-620",$dt2);
			$f4 = iconv("utf-8","tis-620",$acc_no);
			$f5 = iconv("utf-8","tis-620",$acc_bran);
			$f6 = iconv("utf-8","tis-620",$registernumber);
			$f7 = iconv("utf-8","tis-620//IGNORE//TRANSLIT",$registername_arr1);
			$f8 = iconv("utf-8","tis-620",$cty_busstypecode);
			$f9 = iconv("utf-8","tis-620//IGNORE//TRANSLIT",$add1);
			$f10 = iconv("utf-8","tis-620",$add2);
			$f11 = iconv("utf-8","tis-620",$dist_no);
			$f12 = iconv("utf-8","tis-620",$prov_no);
			$f13 = iconv("utf-8","tis-620",$zip_code);
			$f14 = iconv("utf-8","tis-620//IGNORE//TRANSLIT",$tel_no);
			$f15 = iconv("utf-8","tis-620//IGNORE//TRANSLIT",$fax_no);
			$f16 = iconv("utf-8","tis-620",$first_date);
			$f17 = iconv("utf-8","tis-620//IGNORE//TRANSLIT",$registername_arr2);
			
			$txt .= str_pad($f1, 4);
			$txt .= str_pad($f2, 8);
			$txt .= str_pad($f3, 6);
			$txt .= str_pad($f4, 10);
			$txt .= str_pad($f5, 6);
			$txt .= str_pad($f6, 15);
			$txt .= str_pad($f7, 50);
			$txt .= str_pad($f8, 2);
			$txt .= str_pad($f9, 30);
			$txt .= str_pad($f10, 30);
			$txt .= str_pad($f11, 4);
			$txt .= str_pad($f12, 2);
			$txt .= str_pad($f13, 5);
			$txt .= str_pad($f14, 10);
			$txt .= str_pad($f15, 10);
			$txt .= str_pad($f16, 8);
			$txt .= str_pad($f17, 100);
			fwrite($myfile, $txt);
			$newln = "\r" . PHP_EOL;
			fwrite($myfile, $newln);
			
			
			$qcomm = new CDbCriteria( array(
				'condition' => "crop_id = :crop_id ",         
				'params'    => array(':crop_id' => "{$crop_id}")  
			));
			
			$resultcom = CommitteeTmpTb::model()->findAll($qcomm);
			$countcomm = count($resultcom);
			
			//echo "เจ้าของกิจการ : {$countcomm} คน <br>";
			$rowcmtno = 0;
			$ordernumber_old = 0;
			foreach ($resultcom as $rows){
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
				 
				 
				 //echo "{$cmit_id},{$crop_id},{$registernumber},{$tsic},{$corptype},{$committeetype},{$ordernumber},{$typeno},{$identity},{$birthday},{$title},{$firstname},{$lastname},{$englishtitle},{$englishfirstname12},{$englishlastname},{$nation},{$cmit_remark},{$cmit_createby},{$cmit_createtime},{$cmit_updateby},{$cmit_updatetime},{$cmit_status} <br>";
				 
			   if($ordernumber_old!=$ordernumber){	 
				 
				 $table_no = "8110";
				 
				 $curr_date = $dt1;
				 
				 $curr_time = $dt2;
				 
				 $acc_no = $acc_no;
				 
				 $acc_bran = $acc_bran;
				 
				 $regis_no = $registernumber;
				 
				 $seq_no = str_pad($ordernumber,2,0, STR_PAD_LEFT);
				 
				 $owner_name = $title . $firstname . "  " . $lastname;
				 
				 //Type2
				$txt2 = "";
				
				$f21 = iconv("utf-8","tis-620",$table_no);
				$f22 = iconv("utf-8","tis-620",$curr_date);
				$f23 = iconv("utf-8","tis-620",$curr_time);
				$f24 = iconv("utf-8","tis-620",$acc_no);
				$f25 = iconv("utf-8","tis-620",$acc_bran);
				$f26 = iconv("utf-8","tis-620",$regis_no);
				$f27 = iconv("utf-8","tis-620",$seq_no);
				$f28 = iconv("utf-8","tis-620",$owner_name);
				$f29 = iconv("utf-8","tis-620","");
				
				$txt2 .= str_pad($f21, 4);
				$txt2 .= str_pad($f22, 8);
				$txt2 .= str_pad($f23, 6);
				$txt2 .= str_pad($f24, 10);
				$txt2 .= str_pad($f25, 6);
				$txt2 .= str_pad($f26, 15);
				$txt2 .= str_pad($f27, 2);
				$txt2 .= str_pad($f28, 50);
				$txt2 .= str_pad($f29, 49);
				fwrite($myfile, $txt2) or die("Could not write file!"); //write over text to textfile
				$newln = "\r" . PHP_EOL;
				fwrite($myfile, $newln);
				
				$rowcmtno += 1; //เพิ่มจำนวนแถวที่จะส่งไปให้กับ
			 
			   }//if($ordernumber_old!=$ordernumber){	
				
				$ordernumber_old = $ordernumber;
				 
			}//foreach ($resultcom as $rows){
			
			//เริ่ม ดึงข้อมูล cpower จาก 
			$qcorp2 = new CDbCriteria( array(
    			'condition' => "registernumber = :registernumber ",         // no quotes around :match
    			'params'    => array(':registernumber' => $registernumber)  //  $statusgt
			));
		
        	$resulcrop2 = CropinfoTmpTb::model()->findAll($qcorp2);
			$countb2 = count($resulcrop2);
			
			foreach ($resulcrop2 as $rows2){
				$cpower2 = $rows2->cpower;
			}//foreach
			
			if($cpower2){
				$cpower_arr = str_split_unicode($cpower2,50);
				$count_cpower_arr = count($cpower_arr);
				//echo "{$cpower_arr[0]}, {$count_cpower_arr}, {$rowcmtno}"; 
				
			}else{
				$cpower_arr[0] = "";
				$count_cpower_arr = 0;
				//echo "{$cpower_arr[0]}, {$count_cpower_arr}, {$rowcmtno}";
			}//if cpower
			
			
			foreach ($cpower_arr as $key => $value){
				$rowcmtno +=1;
				//echo "{$key},{$rowcmtno} : {$value}<br>";
				 $table_no = "8110";
				 $curr_date = $dt1;
				 $curr_time = $dt2;
				 $acc_no = $acc_no;
				 $acc_bran = $acc_bran;
				 $regis_no = $registernumber;
				 $seq_no = str_pad($rowcmtno,2,0, STR_PAD_LEFT);
				 $owner_name = $value;
				 
				//Type2
				$txt2 = "";
				
				$f21 = iconv("utf-8","tis-620",$table_no);
				$f22 = iconv("utf-8","tis-620",$curr_date);
				$f23 = iconv("utf-8","tis-620",$curr_time);
				$f24 = iconv("utf-8","tis-620",$acc_no);
				$f25 = iconv("utf-8","tis-620",$acc_bran);
				$f26 = iconv("utf-8","tis-620",$regis_no);
				$f27 = iconv("utf-8","tis-620",$seq_no);
				$f28 = iconv("utf-8","tis-620",$owner_name);
				$f29 = iconv("utf-8","tis-620","");
				
				
				$txt2 .= str_pad($f21, 4);
				$txt2 .= str_pad($f22, 8);
				$txt2 .= str_pad($f23, 6);
				$txt2 .= str_pad($f24, 10);
				$txt2 .= str_pad($f25, 6);
				$txt2 .= str_pad($f26, 15);
				$txt2 .= str_pad($f27, 2);
				$txt2 .= str_pad($f28, 50);
				$txt2 .= str_pad($f29, 49);
				//echo "{$txt2} <br>";
				
			if($cpower2!='-'){
				fwrite($myfile, $txt2) or die("Could not write file!"); //write over text to textfile
				$newln = "\r" . PHP_EOL;
				fwrite($myfile, $newln);
			}//if
				 
			}//foreach ($cpower_arr as $key => $value){
			
			
				
			//echo "<hr>";
			//======= update status B to A ===============================================
				/*Yii::app()->CCropinfo_tmp->crop_id = $crop_id;
				Yii::app()->CCropinfo_tmp->registernumber = $registernumber;
				Yii::app()->CCropinfo_tmp->crop_remark = "A";
				Yii::app()->CCropinfo_tmp->crop_status = 4;
			
				$msgr1 = Yii::app()->CCropinfo_tmp->UpdateStatusBtoA();*/
			
				//echo "{$msgr1} update crop_id: {$crop_id}, {$registernumber}-<br>";
				
				$updatec = CropinfoTmpTb::model()->findByPk($crop_id);
				$updatec->crop_remark = "A";
				$updatec->crop_status = 4;
				$updatec->crop_updateby = $username;
				$updatec->crop_updatetime = date('Y-m-d H:i:s');
				if($updatec->save()){
					//echo CJSON::encode(array('status' => 'success'));
					//update crop_v_bran status to A
					$cropid = $crop_id;
					$registernumber = $registernumber;
					Yii::app()->Cwpdreport->updatetoa($cropid, $registernumber);  //******* 
				}else{
					//echo CJSON::encode(array('status' => 'error'));
					//echo CJSON::encode($updatec->getErrors());
				}
			
			//======= update status B to A ================================================	
			
			
			
			//======= update accnumber flag ================================================
				/*Yii::app()->Caccnumbertb->acc_no = $acc_no;
				Yii::app()->Caccnumbertb->acc_regis_no = $registernumber;
				Yii::app()->Caccnumbertb->acc_active_flag = "Y";
				Yii::app()->Caccnumbertb->acc_updateby = $username;
				Yii::app()->Caccnumbertb->acc_modified = date('Y-m-d H:i:s');
				Yii::app()->Caccnumbertb->acc_remark = "A";
				Yii::app()->Caccnumbertb->acc_status = 3;
				
				$msgr2 = Yii::app()->Caccnumbertb->updateflag();*/
				//echo " {$msgr2} update accnumbertb {$acc_no}, {$registernumber}-<br>";

                                 Yii::log('Error Test by niras Username: ' . $username  ,CLogger::LEVEL_ERROR,'system.db.CDbCommand');
				
				$updatea = AccnumberTb::model()->findByAttributes(array('acc_no'=>$acc_no, 'acc_regis_no'=>$registernumber));
				$updatea->acc_updateby = $username;
				$updatea->acc_modified = date('Y-m-d H:i:s');
				$updatea->acc_active_flag = "Y";
				$updatea->acc_remark = "A";
				$updatea->acc_status = 4;
				if($updatea->save()){
					//$msg3 = "update data is success.";
				}else{
					//$msg3 = "can't update data.";
				}
			
			//======= update accnumber flag ================================================
			
			
			$rowno +=1;
		}//foreach ($resulcrop as $rows){
			
		fclose($myfile);	
		
		//======== create gentexfile_tb record =================================================
				
			/*	Yii::app()->Cgentextfile->gtf_name= $textfilename;
				Yii::app()->Cgentextfile->gtf_path= $mypath;
				Yii::app()->Cgentextfile->gtf_countgen= $countb;
				Yii::app()->Cgentextfile->gtf_statusgen= "Success";
				Yii::app()->Cgentextfile->gtf_statusupload= "n";
				Yii::app()->Cgentextfile->gtf_createby= $username;
				Yii::app()->Cgentextfile->gtf_created= date('Y-m-d H:i:s');
				Yii::app()->Cgentextfile->gtf_updateby= $username;
				Yii::app()->Cgentextfile->gtf_modified= date('Y-m-d H:i:s');
				Yii::app()->Cgentextfile->gtf_remark= date('Ymd');
				Yii::app()->Cgentextfile->gtf_status= 1;
				
				$msgr3 = Yii::app()->Cgentextfile->create();*/
				
				//$msgr3 = Yii::app()->Cgentextfile->gentest();
				//var_dump($msgr3);
				
				//echo "{$msgr3} create gentextfile {$textfilename},{$countb} -<br>";*/
				
				$GentextfileTbadd = new GentextfileTb();
				$GentextfileTbadd->gtf_name= $textfilename;
				$GentextfileTbadd->gtf_path= $mypath;
				$GentextfileTbadd->gtf_countgen= $countb;
				$GentextfileTbadd->gtf_statusgen= "Success";
				$GentextfileTbadd->gtf_statusupload= "n";
				$GentextfileTbadd->gtf_createby= $username;
				$GentextfileTbadd->gtf_created= date('Y-m-d H:i:s');
				$GentextfileTbadd->gtf_updateby= $username;
				$GentextfileTbadd->gtf_modified= date('Y-m-d H:i:s');
				$GentextfileTbadd->gtf_remark= date('Ymd');
				$GentextfileTbadd->gtf_status= 1;
				if($GentextfileTbadd->save()){
					//
				}else{
					//
				}
				
		//=========================================================================================
		
		//============ insert log file ============================================================		
				
		$lremark = "generatetextfileที่มีสถานะเป็นB&ชื่อไฟล์=" . $textfilename . "&path=" . $mypath . "&จำนวนรายการ=" . $countb;
  		$msgresult = Yii::app()->Clogevent->createlogevent("runservice5", "servicepage", "runservice5", "service5", $lremark);
		
		//======== create gentexfile_tb record ====================================================
		
	//echo "generate text file is success. ";
	//echo "<a download href='path/to/the/download/file'> Clicking on this link will force download the file</a>";	
?>
	<script>callshowtextfile();</script>	
    
<?php	
}else{ //if($countb>0){
	echo "ไม่พบรายการข้อมูลนิติบุคคล ที่มีสถานะเป็น B <br>";
}
?>
    </div>
</body>
</html>
