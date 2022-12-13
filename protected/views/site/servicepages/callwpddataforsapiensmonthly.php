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
//ค้นหาจำนวน record ที่มีอยู่เดิมจาก table
$cif=MonthlytxtfileforsapiensTb::model()->findByAttributes(array('tffs_id'=>$tffs_id)); 
if($cif){
	$tffs_numrec_old = $cif->tffs_numrec;
	//echo "{$tffs_numrec}"; exit;
}else{//if
	$tffs_numrec_old = 0;
}

//echo "{$tffs_numrec_old}, "; //exit;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>callwpddataforsapiens</title>
</head>

<body>
<?php
	//echo "{$action}, {$bgdatewt2}, {$tffs_id}, {$tffs_name}, "; //variable ที่รับมาจาก controller
	
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
	
	$mypath = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/monthly/" . $textfilename;
	$myfile = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/monthly/" . $textfilename;
	
	//echo "{$mypath}, {$myfile} <br>"; //exit;
	
	//if(file_exists($myfile)){//ตรวจสอบถ้ามีไฟล์อยู่
		//$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/" . $textfilename, "w") or die("Unable to open file!"); //อ่านไฟล์เพื่อเขียนทับ
		$fp = fopen($myfile, 'a') or die("Unable to open file!"); //อ่านไฟล์ขึ้นมาเพื่อเขียนต่อ
		$txt = ""; //กำหนด variable
		
	//}else{//กรณีไม่มีไฟล์ชื่อนี้อยู่
		
	//}//if file_exists
	
	//เริ่มค้นหาข้อมูลกิจการ
	$datesch1 = date_create($bgdatewt2)->format('Y-m-d'). "T00:00:00+07:00";
	$datesch2 = date_create($bgdatewt2)->format('Y-m-d'). "T23:59:59+07:00"; 
	
	 
	//echo "{$datesch1},{$datesch2}";
	
	$qry = new CDbCriteria( array(
	  'condition' => "updateddate between :datesch1 and :datesch2 and statuscode in (:c1,:c2,:c3,:c4) ",         
	  'params'    => array(':datesch1' => $datesch1, ':datesch2' => $datesch2, ':c1' => 4, ':c2' => 5, ':c3' => 8, ':c4' => 9)  
   	));
	$model = CropinfoUpdateTb::model()->findAll($qry);
	$countmedel = count($model);
	
	echo "Count of data : {$countmedel} Record.<br>"; //exit;
	
	if($countmedel>0){ //แสดง่ว่ามีข้อมูลตามวันที่ที่เลือกไว้
		$rowno = 0;
		foreach ($model as $rows){ //เริ่มดึงข้อมูลกิจการแบบวนลูป
			$crop_id = $rows->crop_id;
			$registernumber = $rows->registernumber; //
		
			//echo "{$registernumber} <br>";
			
			//---เริ่มเขียนข้อมูลบรรทัดแรก------------------------------------------------------
				
				$txt = "";
				$f1 = iconv("utf-8","tis-620",$registernumber); //WA-RIG
				$f2 = iconv("utf-8","tis-620",""); //FILLER
				
				$txt .= str_pad($f1, 15);
				$txt .= str_pad($f2, 65);
				
				fwrite($fp, $txt);
				$newln = "\r" . PHP_EOL;
				fwrite($fp, $newln);
			
			//-------------------------------------------------------------------------
			
			$rowno += 1;
		}//foreach
		
		fclose($fp);
		
		echo "เขียนข้อมูลเพิ่มสำเร็จ จำนวน : {$rowno} รายการ. <br>";
		
		//--update---------------------------------------------------------------------------
			//Textfileforsapiens2Tb
			$tffs_numrec_new = $tffs_numrec_old + $rowno;
			
			$cif2=MonthlytxtfileforsapiensTb::model()->findByAttributes(array('tffs_id'=>$tffs_id));
			if($cif2){
				$cif2->tffs_numrec = $tffs_numrec_new;
				$cif2->tffs_updateby = $un1;
				$cif2->tffs_modified = date('Y-m-d H:i:s');
				$cif2->tffs_status = 2;
				if($cif2->save()){
					echo "จำนวนรายการที่เขียนในเท็กไฟล์ทั้งหมด : {$tffs_numrec_new} รายการ. <br>";
				//== insert log event ======================
					$levremark = "เขียนข้อมูลลง textfile ชื่อ : " . $tffs_name . " ใช้ข้อมูลจากวันที่ : " . $bgdatewt2 . " เป็นข้อมูลล่าสุด.";
					$datalog = $tffs_name . "," . $bgdatewt2;
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