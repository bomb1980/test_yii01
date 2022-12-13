<?php	
set_time_limit(0);
ini_set("max_execution_time","0");
ini_set("memory_limit","9999M"); 
?>
<?php

  if($actionby === 'm'){
	  $un1 = Yii::app()->user->username;
  }else if($actionby === 'a'){
	  $un1 = "sys";
  }


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
//echo mb_substr($massage,0,25,'UTF-8');
//echo iconv_substr($massage, 0,25, "UTF-8");
//-----------------------------------------------------------------------------------------------

$cif=Textfileforsapiens2Tb::model()->findByAttributes(array('tffs_id'=>$tffs_id));
if($cif){
	$tffs_numrec_old = $cif->tffs_numrec;
	//echo "{$tffs_numrec}"; exit;
}else{//if
	$tffs_numrec_old = 0;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>callwpddataforsapiens</title>
</head>

<body>
<?php
	//echo "{$action}, {$bgdatewt1}, {$tffs_id}, {$tffs_name}"; //variable ที่รับมาจาก controller
	
	$now = date_create('now')->format('Y-m-d H:i:s');
	$tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
	$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
	$daten1 = date('Y-m-d H:i:s');
	$tdy = date_create('now')->format('Ymd');
	$tdyd = date_create('now')->format('d');
	$tdym = date_create('now')->format('m');
	$tdyy = date_create('now')->format('Y');
	
	$tdyyth = $tdyy + 543;
	$tdy = $tdyyth . $tdym . $tdyd;
	$textfilename = $tffs_name; //"wpd" . $tdy . ".txt";
	
	$mypath = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/" . $textfilename;
	$myfile = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/" . $textfilename;
	
	//if(file_exists($myfile)){//ตรวจสอบถ้ามีไฟล์อยู่
		//$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/" . $textfilename, "w") or die("Unable to open file!"); //อ่านไฟล์เพื่อเขียนทับ
		$fp = fopen($myfile, 'a') or die("Unable to open file!"); //อ่านไฟล์ขึ้นมาเพื่อเขียนต่อ
		$txt = ""; //กำหนด variable
		
	//}else{//กรณีไม่มีไฟล์ชื่อนี้อยู่
		
	//}//if file_exists
	
	//เริ่มค้นหาข้อมูลกิจการ
	$datesch1 = date_create($bgdatewt1)->format('Y-m-d H:i:s');
	$model = CropinfoTmpTb::model()->findAllByAttributes(array('registerdate'=>$datesch1));
	$countmedel = count($model);
	
	echo "Count of data : {$countmedel} Record.<br>";
	
	if($countmedel>0){ //แสดง่ว่ามีข้อมูลตามวันที่ที่เลือกไว้
		$rowno = 0;
		foreach ($model as $rows){ //เริ่มดึงข้อมูลกิจการแบบวนลูป
			$crop_id = $rows->crop_id;
			$registernumber = $rows->registernumber;
			if (strstr($rows->registername, 'จำกัด' )) {
			  $registername = substr($rows->registername,0,strpos($rows->registername,'จำกัด'));
			}else{
			  $registername = $rows->registername;
			}
			//$registername = $rows->registername;
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
			
			$len = strlen($registername);
			
			$registername_arr = str_split_unicode($registername,100);
			$count_registername_arr = count($registername_arr);
			
			 //กำหนดแยก วัน เดือน ปี
			 $emsd = date_create($registerdate)->format('d');
			 $emsm = date_create($registerdate)->format('m');
			 $emsy = date_create($registerdate)->format('Y')+543;
				
			 
			 $yf1 = str_pad($emsy,2,0, STR_PAD_LEFT);
			 $nm = str_pad($emsm,2,0, STR_PAD_LEFT); //date_create('+1 month')->format('m');
			 $mf1 = $nm; //str_pad($nm,2,0, STR_PAD_LEFT);
			 $df1 = str_pad($emsd,2,0, STR_PAD_LEFT); //"01"; //date('d');
			
			 
			 $regis_date = $df1 . $mf1 . $yf1;  //จัดรูปแบบวันที่ขึ้นทะเบียน
			
			
			
			//นำ crop_id ไปค้นหาข้อมูลสาขาสำนักงานใหญ่ ----------------------------------------
			$qbrch = new CDbCriteria( array(
				'condition' => "crop_id = :crop_id and ordernumber = :ordernumber",         
				'params'    => array(':crop_id' => "{$crop_id}", ':ordernumber' => 0)  
			));	
			
			$resultbrch = BranchTmpTb::model()->findAll($qbrch);
			$countbrch = count($resultbrch);
			
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
				 $phonenumber = substr($p1,0,10);  //$rows->phonenumber;
				 $faxnumber = $rows->faxnumber;
				 $email = $rows->email;
				 $brch_remark = $rows->brch_remark;
				 $brch_createby = $rows->brch_createby;
				 $brch_createtime = $rows->brch_createtime;
				 $brch_updateby = $rows->brch_updateby;
				 $brch_updatetime = $rows->brch_updatetime;
				 $brch_status = $rows->brch_status;
			}//foreach $resultbrch
			
			
			$wa_code = '2';
			$wa_type = 'A';
			$wa_number = '01';  //$seq_no = str_pad($ordernumber,2,0, STR_PAD_LEFT); กำหนดรูปแบบให้เป็น 2 ตัวอักษร
			$wa_xx = '1';
			//-------------------------------------------------------------------------
			//if($registernumber==='0505562014217'){
				//echo "{$registernumber}, {$wa_code}, {$wa_type}, {$wa_number}, {$registername}, {$regis_date}, {$wa_xx}, {$authorizedcapital}, {$provincecode}, {$ampurcode}, {$tumboncode} <br>";
			//}
			
			//---เริ่มเขียนข้อมูลบรรทัดแรก------------------------------------------------------
				
				$txt = "";
				$f1 = iconv("utf-8","tis-620",$registernumber); //WA-RIG
				$f2 = iconv("utf-8","tis-620",$wa_code); //WA-CODE
				$f3 = iconv("utf-8","tis-620",$wa_type); //WA-TYPE
				$f4 = iconv("utf-8","tis-620",$wa_number); //WA-NUMBER
				$f5 = iconv("utf-8","tis-620//IGNORE//TRANSLIT", $registername);
				//IGNORE//TRANSLIT
				//$f5 = iconv("utf-8","tis-620//TRANSLIT",$registername); //WA-NAME
				$f6 = iconv("utf-8","tis-620",$regis_date); //WA-DDMMYYYY
				$f7 = iconv("utf-8","tis-620",$wa_xx); //WA-XX
				$f8 = iconv("utf-8","tis-620",$authorizedcapital); //WA-AMOUNT
				$f9 = iconv("utf-8","tis-620",$provincecode); //WA-TCODE1
				$f10 = iconv("utf-8","tis-620",$ampurcode); //WA-TCODE2
				$f11 = iconv("utf-8","tis-620",$tumboncode); //WA-TCODE3
				$f12 = iconv("utf-8","tis-620",""); //FILLER
				
				$txt .= str_pad($f1, 15);
				$txt .= str_pad($f2, 1);
				$txt .= str_pad($f3, 1);
				$txt .= str_pad($f4, 2);
				$txt .= str_pad($f5, 100);
				$txt .= str_pad($f6, 8);
				$txt .= str_pad($f7, 1);
				$txt .= str_pad($f8, 16);
				$txt .= str_pad($f9, 2);
				$txt .= str_pad($f10, 2);
				$txt .= str_pad($f11, 2);
				$txt .= str_pad($f12, 46);
				
				fwrite($fp, $txt);
				$newln = "\r" . PHP_EOL;
				fwrite($fp, $newln);
			
			//-------------------------------------------------------------------------
			
			$wp_code = '2';
			$wp_type = 'P';
			$wp_number = '01';
			
			 if($housenumber!='-'){
				 $housenumber = $housenumber;
			 }else{
				 $housenumber = "";
			 }
			
		   	 if($buildingname!='-'){
				 $buildingname = " " . $buildingname;
			 }else{
				 $buildingname = "";
			 }
			 
			 if($buildingnumber!='-'){
				 $buildingnumber = " " . $buildingnumber;
			 }else{
				 $buildingnumber = "";
			 }
			 
			 if($buildingfloor!='-'){
				 $buildingfloor = " " . $buildingfloor;
			 }else{
				 $buildingfloor = "";
			 }
			 
			 if($village!='-'){
				 $village = " " . $village;
			 }else{
				 $village = "";
			 }
			 
			 if($moo!='-'){
				 $moo = " ม." . $moo;
			 }else{
				 $moo = "";
			 }
			 
			 if($soi!='-'){
				 $soi = " ซ." . $soi;
			 }else{
				 $soi = "";
			 }
			 
			 if($road!='-'){
				 $road = " ถ." . $road;
			 }else{
				 $road = "";
			 }
			 
			 if($tumbon!='-'){
				 if($provincecode!='10'){
				 	$tumbon = " ต." . $tumbon;
				 }else{
					$tumbon = " แขวง" . $tumbon; 
				 }
			 }else{
				 $tumbon = "";
			 }
			 
			 if($ampur!='-'){
				 if($provincecode!='10'){
				 	$ampur = " อ." . $ampur;
				 }else{
					$ampur = " " . $ampur; 
				 }
			 }else{
				 $ampur = "";
			 }
			 
			 if($province!='-'){
				 if($provincecode!='10'){
				 	$province = " จ." . $province;
				 }else{
					$province = " " . $province; 
				 }
			 }else{
				 $province = "";
			 }
			 
			 if($zipcode!='-'){
				 $zipcode = " " . $zipcode;
			 }else{
				 $zipcode = "";
			 }
			 
			 $add1 = $housenumber . $moo . $soi . $road . $tumbon . $ampur . $province . $zipcode;
		   
			//---เริ่มบรรทัดที่2--------------------------------------------------------------
			
			  	$txt = "";
				$p1 = iconv("utf-8","tis-620",$registernumber); //WP-RIG
				$p2 = iconv("utf-8","tis-620",$wp_code); //WP-CODE
				$p3 = iconv("utf-8","tis-620",$wp_type); //WP-TYPE
				$p4 = iconv("utf-8","tis-620",$wp_number); //WP-NUMBER
				$p5 = iconv("utf-8","tis-620",$add1); //WP-NUMBER
				
				
				$txt .= str_pad($p1, 15);
				$txt .= str_pad($p2, 1);
				$txt .= str_pad($p3, 1);
				$txt .= str_pad($p4, 2);
				$txt .= str_pad($p5, 177);
				
				fwrite($fp, $txt);
				$newln = "\r" . PHP_EOL;
				fwrite($fp, $newln);
			
			//-------------------------------------------------------------------------
			
			
			$wkl_code = '2';
			
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
			
			    $wkl_type = $committeetype;
				$wkl_number = str_pad($ordernumber,2,0, STR_PAD_LEFT); //กำหนดรูปแบบให้เป็น 2 ตัวอักษร
				$wkl_name = $title . $firstname . " " . $lastname . " " . $identity;
				//---เริ่มเขียนบรรทัดที่ 3 WKL -------------------------------------------------------
					$txt = "";
					$kl1 = iconv("utf-8","tis-620",$registernumber); //WKL-RIG
					$kl2 = iconv("utf-8","tis-620",$wkl_code); //WKL-CODE
					$kl3 = iconv("utf-8","tis-620",$wkl_type); //WKL-TYPE
					$kl4 = iconv("utf-8","tis-620",$wkl_number); //WKL-NUMBER
					$kl5 = iconv("utf-8","tis-620",$wkl_name); //WKL-NAME
					
					$txt .= str_pad($kl1, 15);
					$txt .= str_pad($kl2, 1);
					$txt .= str_pad($kl3, 1);
					$txt .= str_pad($kl4, 2);
					$txt .= str_pad($kl5, 177);
					
					fwrite($fp, $txt);
					$newln = "\r" . PHP_EOL;
					fwrite($fp, $newln);
					
				//---------------------------------------------------------------------------	
				 
			}//foreach committee
			
			$wm_code = '2';
			$wm_type = 'M';
			$wm_number = '01'; 
			$wm_name = 'ไม่มี'; 
			//---เขียนบรรทัดที่ 4------------------------------------------------------------------
				$txt = "";
				$m1 = iconv("utf-8","tis-620",$registernumber); //WM-RIG
				$m2 = iconv("utf-8","tis-620",$wm_code); //WM-CODE
				$m3 = iconv("utf-8","tis-620",$wm_type); //WM-TYPE
				$m4 = iconv("utf-8","tis-620",$wm_number); //WM-NUMBER
				$m5 = iconv("utf-8","tis-620",$wm_name); //WM-NAME
				
				$txt .= str_pad($m1, 15);
				$txt .= str_pad($m2, 1);
				$txt .= str_pad($m3, 1);
				$txt .= str_pad($m4, 2);
				$txt .= str_pad($m5, 177);
				
				fwrite($fp, $txt);
				$newln = "\r" . PHP_EOL;
				fwrite($fp, $newln);
			//-------------------------------------------------------------------------------
			
			
			$rowno += 1;
		}//foreach
		
		fclose($fp);
		
		echo "เขียนข้อมูลเพิ่มสำเร็จ จำนวน : {$rowno} รายการ. <br>";
		
		//--update---------------------------------------------------------------------------
			//Textfileforsapiens2Tb
			$tffs_numrec_new = $tffs_numrec_old + $rowno;
			
			$cif2=Textfileforsapiens2Tb::model()->findByAttributes(array('tffs_id'=>$tffs_id));
			if($cif2){
				$cif2->tffs_numrec = $tffs_numrec_new;
				$cif2->tffs_updateby = $un1;
				$cif2->tffs_modified = date('Y-m-d H:i:s');
				$cif2->tffs_status = 2;
				if($cif2->save()){
					echo "จำนวนรายการที่เขียนในเท็กไฟล์ทั้งหมด : {$tffs_numrec_new} รายการ. <br>";
				//== insert log event ======================
					$levremark = "เขียนข้อมูลลง textfile รายเดือน ชื่อ : " . $tffs_name . " ใช้ข้อมูลจากวันที่ : " . $bgdatewt1 . " เป็นข้อมูลล่าสุด.";
					$datalog = $tffs_name . "," . $bgdatewt1;
					$msgresult = Yii::app()->Clogevent->createlogevent("writedatatotextfile", "callwpddataforsapiens", "oldwpd", $datalog, $levremark);
				//==========================================
				}else{//
					echo "ไม่สามารถบันทึกปรับปรุงจำนวน รายการที่เขียนได้. <br>";
				}//if
			}//if
		//-----------------------------------------------------------------------------------
		
		
		
	}//if
	
	
?>
</body>
</html>