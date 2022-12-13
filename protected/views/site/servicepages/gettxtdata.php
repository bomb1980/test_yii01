<?php  ini_set('max_execution_time', 3600); //300 seconds = 5 minutes  ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>gettxtdata</title>
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
	function callledservice1(rn,tn,cn){
		//alert(rn);
		//ledresp
		$("#ledresp" + rn).html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$("#ledresp" + rn).html(rn + "," + tn + "," + cn);
	}
</script>

</head>

<body>
<?php
  if(isset(Yii::app()->user->username)){
	  $username = Yii::app()->user->username;
  }else{
	  $username = "sys";
  }
  
  if(isset(Yii::app()->user->address)){
	  $brachcode = Yii::app()->user->address;
  }else{
	  $brachcode = "-";
  }
  
  //**** นับจำนวนบรรทัดทั้งหมดใน textfile ******** //
  	$linecount = 0;
	$handle = fopen(Yii::app()->params['ledtextfile'] ."/ledtextfile/sapiens/" . $fn1, "r");
	$time_start = microtime(true); 
	while(!feof($handle)){
	  $line = fgets($handle);
	  $linecount++;
	}
	fclose($handle);
	//echo $linecount; echo "<br>";
	$time_end = microtime(true);
	$execution_time = ($time_end - $time_start)/60;
	//echo '<b>Total Execution Time:</b> '.$execution_time.' Mins'; echo "<br>";
  //**** นับจำนวนบรรทัดทั้งหมดใน textfile ******** //	
  
  //********
  $linecount = $linecount; //5000;
  //********
  
  //*************************** ประกาศตัวแปร array ********
  	//$array_name =array();
	$sso_accno_arr = array(); // เลขประกันสังคม 10 หลัก
 	$sso_accbran_arr = array(); // เลขสาขา 6 หลัก
 	$crg_registernum_arr = array(); // เลขทะเบียนพาณิชย์ 13 หลัก
 	$crg_cropname_arr = array(); // ชื่อสถานประกอบการ
 	$crg_cropaddrss_arr = array(); //ที่อยู่
 	$crg_brancode_arr = array(); // bran_code สปส เร่งรัดหนี้
	$crg_brancode2_arr = array(); // bran_code สปส รับผิดชอบ
  //***************************************************
	
  $line = -1;
  $min = $minrec; //บรรทัดเริ่มต้น บรรทัดแรกสุด คือ 0
  $max = $linecount; //$min + 1000;//42632; //บรรทัดสุดท้ายที่จะให้ดึง
  
  /*if($max<=$linecount){
	 $max = $max; 
  }else{
	 $maxl = $max - $linecount;
	 $max = $max - $maxl; 
  }*/
  
  
  if (($myfile = fopen( Yii::app()->params['ledtextfile'] ."/ledtextfile/sapiens/" . $fn1 , "r")) !== FALSE) {
  	
  
  //$myfile = fopen( Yii::app()->params['ledtextfile'] ."/ledtextfile/" . $fn1 , "r") or die("Unable to open file!");	
  
  //place this before any script you want to calculate time
	$time_start = microtime(true); 
  
  
    $rownum = 0;
	$rowempty = 0;
	$rowlength = 0;
	$rownonum = 0;
	$rowduplicate = 0;
  // Output one line until end-of-file	
	while(!feof($myfile)) {
		
	  $line++;
	  
	  if(($line >= $min && $line <= $max)) {
		  
	  $datastr  = fgets($myfile);
	  $arraystr = explode(";", $datastr); //ตัดข้อมูลออกตาม ; เป็น arraystr
	  
	  if(!empty($arraystr[0])){
	  	$t1 = trim($arraystr[0]);// เลขประกันสังคม 10 หลัก
	  }else{
		$t1 = "";  	
	  }
	  if(!empty($arraystr[1])){
	  	$t2 = trim($arraystr[1]);// เลขสาขา 6 หลัก
	  }else{
		$t2 = "";    
	  }
	  if(!empty($arraystr[2])){
	  	$t3 = trim($arraystr[2]);// เลขทะเบียนพาณิชย์ 13 หลัก
	  }else{
		$t3 = "";  
	  }
	  if(!empty($arraystr[3])){
	  	$t4 = trim($arraystr[3]);// ชื่อสถานประกอบการ
	  }else{
		$t4 = "";  
	  }
	  if(!empty($arraystr[4])){
	  	$t5 = trim($arraystr[4]);// bran_code สปส เร่งรัดหนี้
	  }else{
		$t5 = "";
	  }
	  if(!empty($arraystr[5])){
	  	$t6 = trim($arraystr[5]);// ที่อยู่
	  }else{
		$t6 = "";  
	  }
	  if(!empty($arraystr[6])){
	 	$t7 = trim($arraystr[6]);// อำเภอ
	  }else{
		$t7 = "";   
	  }
	 if(!empty($arraystr[7])){
		$t8 = trim($arraystr[7]);// จังหวัด
	 }else{
		$t8 = "";	 
	 }
	 if(!empty($arraystr[8])){  
	    $t9 = trim($arraystr[8]);// รหัสไปรษณีย์ 
	 }else{
		$t9 = ""; 
	 }
	 //รหัส สปส รับผิดชอบ *******************************************
	 
	 //*********************************************************
	  
	  $t4f = iconv('tis-620','utf-8',$t4);// ชื่อสถานประกอบการ
	  $t6f = iconv('tis-620','utf-8',$t6);// ที่อยู่
	  $t7f = iconv('tis-620','utf-8',$t7);// อำเภอ
	  $t8f = iconv('tis-620','utf-8',$t8);// จังหวัด
	  
	  $crop_address = $t6f . " " .  $t7f . " " . $t8f . " " . $t9;
	  
	  if(!empty($t3)){ //ถ้าเลข 13 หลัก เป็นค่าว่าง หรือ null
		  $lent3 = strlen($t3);
		  if($lent3==13){ //ถ้าตัวเลขทะเบียน เท่ากับ 13 หลัก
		  	if(is_numeric($t3) && $t3 > 0 && $t3 == round($t3,0)){ //ถ้าเป็นตัวเลขทั้งหมด is_numeric($value) && $value > 0 && $value == round($value, 0)
			
				 //$array_name[] = $rows->name;
				 
				 
				 $sso_accno_arr[] = $t1; // เลขประกันสังคม 10 หลัก
 				 $sso_accbran_arr[] = $t2; // เลขสาขา 6 หลัก
 				 $crg_registernum_arr[] = $t3; // เลขทะเบียนพาณิชย์ 13 หลัก
 				 $crg_cropname_arr[] = $t4f; // ชื่อสถานประกอบการ
 				 $crg_cropaddrss_arr[] = $crop_address; //ที่อยู่
 				 $crg_brancode_arr[] = $t5; // bran_code สปส เร่งรัดหนี้
				 $crg_brancode2_arr[] = $t5; //สปส รับผิดชอบ
				 
				 //echo "{$rownum}, {$line}, {$t1}, {$t2}, {$t3}, {$t4f}, {$t5}, {$crop_address}"; echo "<br>";
				 
				 $rownum += 1;
				 
				/*$selq = CropRiskGroup::model()->findByAttributes(array('crg_registernum'=>$t3));
				if(empty($selq)){
				  
				  $CropRiskGroup = new CropRiskGroup();
				  $CropRiskGroup->sso_accno = $t1;
				  $CropRiskGroup->sso_accbran = $t2;
				  $CropRiskGroup->crg_registernum = $t3;
				  $CropRiskGroup->crg_cropname = $t4f;
				  $CropRiskGroup->crg_cropaddrss = $crop_address;
				  $CropRiskGroup->crg_brancode = $t5;
				  $CropRiskGroup->crg_createby = $username;
				  $CropRiskGroup->crg_created = date('Y-m-d H:i:s');
				  $CropRiskGroup->crg_updateby = $username;
				  $CropRiskGroup->crg_modified = date('Y-m-d H:i:s');
				  $CropRiskGroup->crg_remark = "-";
				  $CropRiskGroup->crg_status = 1;
				  if($CropRiskGroup->save()){
					  //echo "{$line}, {$t1}, {$t2}, {$t3}, {$t4f}, {$t5}, {$crop_address}"; echo "<br>";
					  //echo CJSON::encode(array('status' => 'Success')); echo "<br>";
				  }else{
					 echo CJSON::encode($CropRiskGroup->getErrors()); echo "<br>";
				  }//$CropRiskGroup->save)
				  
				}else{
					//echo CJSON::encode(array('status' => 'Duplicate')); echo "<br>";
					$rowduplicate +=1;
				}*/
			}else{
				//echo CJSON::encode(array('status' => 'Numberic Error')); echo "<br>";
				$rownonum += 1;
			}
		  }else{
			  //echo CJSON::encode(array('status' => 'Error length')); echo "<br>";
			  $rowlength += 1;
		  }
	  }else{
		  //echo CJSON::encode(array('status' => 'Empty')); echo "<br>";
		  $rowempty += 1;
	  }
	
	}elseif($line > $max) {
		break;
	}else{
		//echo "error!";
		fgets($myfile);
	}
	
	  
	}//while(!feof($myfile))
	
	
	fclose($myfile);
	
	$time_end = microtime(true);
	
	//dividing with 60 will give the execution time in minutes otherwise seconds
	$execution_time = ($time_end - $time_start)/60;

	//execution time of the script
	// echo '<b>Total Execution Time:</b> '.$execution_time.' Mins <br>';
	// if you get weird results, use number_format((float) $execution_time, 10) 
  
  }else{//if myfile
	 echo CJSON::encode(array('status' => 'Can not open file.')); echo "<br>";
  }
  
  
  //echo date('h:i:s') . "<br>";
  //sleep for 5 seconds
  //sleep(5);
  //echo date('h:i:s');
  
  //if($max<$linecount){
?>
  
  <script> /*getdatatxtfiletodb('T8000_W620909.TXT',<?=$max?>);*/ </script>
  
<?php  
 // }//if($max<2000){
  echo "ชื่อไฟล์ : {$fn1} <br>";
  echo "จำนวนรายการทั้งหมด : {$linecount} <br>";
  echo "จำนวนค่าว่าง :{$rowempty} <br>";
  echo "จำนวนความยาวผิดพลาด : {$rowlength} <br>";
  echo "จำนวนที่ไม่ไช่ตัวเลข : {$rownonum} <br>";
  //echo "จำนวนที่มีอยุ่แล้วใน DB : {$rowduplicate} <br>";
  echo "จำนวนรายการที่ใช้ได้ : {$rownum} <br>";
  
  $countarray1 = count($sso_accno_arr);
  
  //echo "จำนวน array: {$countarray1} <br>";
  
  /*$esso_accno = CJSON::encode($sso_accno_arr);
  $esso_accbran = CJSON::encode($sso_accbran_arr);
  $ecrg_registernum = CJSON::encode($crg_registernum_arr);
  $encodejson_crg_cropname_arr = CJSON::encode($crg_cropname_arr);
  $encodejson_crg_cropaddrss_arr = CJSON::encode($crg_cropaddrss_arr);
  $encodejson_crg_brancode_arr = CJSON::encode($crg_brancode_arr);*/
  
  //echo $encodejson; echo "<br>";
  
  //$decodearray1 = CJSON::decode($encodejson);
  
  //echo $decodearray1[2]; echo "<br>";
  
?>
	<!--<button onClick="javascript:testajaxjson();">test send array to ajax</button>
    <div id="res2"></div>-->
    
    
<?php
	$tdy = date_create('now')->format('Ymd');
	
	$fileno = 1;
	$recperfile = 10000;
	$startrec = 0;
	$stoprec = $startrec + $recperfile;
	
	$filedeciaml = $countarray1/$recperfile;
	
	$allfile = ceil($filedeciaml);
	
	echo "จำนวนไฟล์ทั้งหมดที่จะแบ่ง {$allfile} <br>";
	
	//บันทึกการวิเคราะห์ไฟล์ ลงฐานข้อมูล
	$selq1 = LedtxtsapiensTb::model()->findByAttributes(array('lts_name'=>$fn1));
	if(empty($selq1)){
		$LedtxtsapiensTb = new LedtxtsapiensTb();
		 $LedtxtsapiensTb->lts_name = $fn1;
		 $LedtxtsapiensTb->lts_allrec = $linecount;
		 $LedtxtsapiensTb->lts_emptyrec = $rowempty;
		 $LedtxtsapiensTb->lts_errlgrec = $rowlength;
		 $LedtxtsapiensTb->lts_errtprec = $rownonum;
		 $LedtxtsapiensTb->lts_okrec = $rownum;
		 $LedtxtsapiensTb->lts_numfile = $allfile;
		 $LedtxtsapiensTb->lts_createby = $username;
		 $LedtxtsapiensTb->lts_created = date('Y-m-d H:i:s');
		 $LedtxtsapiensTb->lts_updateby = $username;
		 $LedtxtsapiensTb->lts_modified = date('Y-m-d H:i:s');
		 $LedtxtsapiensTb->lts_remark = "-";
		 $LedtxtsapiensTb->lts_status = 1;
		 $LedtxtsapiensTb->save();
	}//if(empty($selq1)){
	
	//$allfile = 3;
	
	for($j=1;$j<=$allfile;$j++){
	
		$textfilename = "riskgroup_" . $j . ".txt";
	
		$mypath = "C:/xampp/htdocs/wpdcore_local/";
	
		$myfile2 = fopen($mypath ."/ledtextfile/callled/" . $textfilename, "w") or die("Unable to open file!");
	
		$time_start = microtime(true);
	
	
	
		for($i=$startrec;$i<=$stoprec-1;$i++){
			
			$stoprec_old = $stoprec;
		
			$txt = "";
		
			$txt .= $sso_accno_arr[$i] . ";"; //str_pad($f21, 4);
			$txt .= $sso_accbran_arr[$i] . ";"; //str_pad($f22, 8);
			$txt .= $crg_registernum_arr[$i] . ";";//str_pad($f23, 6);
			$txt .= $crg_cropname_arr[$i] . ";";//str_pad($f24, 10);
			$txt .= $crg_cropaddrss_arr[$i] . ";";//str_pad($f25, 6);
			$txt .= $crg_brancode_arr[$i] . ";";
			$txt .= $crg_brancode2_arr[$i] . PHP_EOL;//str_pad($f26, 15);
			fwrite($myfile2, $txt) or die("Could not write file!"); //write over text to textfile
			//$newln = "\r" . PHP_EOL;
			//fwrite($myfile2, $newln);
		
		}//for($i=0;$i<=$countarray1-1;$i++){
			
			$recnumcall = $stoprec - $startrec;
	
	    //บันทึกชื่อไฟล์, จำนวนรายการที่ต้องcall, จำนวนรายการที่ respose กับมา 
		$selq = LedtxtfileTb::model()->findByAttributes(array('ltf_name'=>$textfilename));
		if(empty($selq)){
			$LedtxtfileTb = new LedtxtfileTb();
			$LedtxtfileTb->ltf_name = $textfilename;
			$LedtxtfileTb->ltf_callrec = $recnumcall;
			$LedtxtfileTb->ltf_resprec = 0;
			$LedtxtfileTb->ltf_createby = $username;
			$LedtxtfileTb->ltf_created = date('Y-m-d H:i:s');
			$LedtxtfileTb->ltf_updateby = $username;
			$LedtxtfileTb->ltf_modified = date('Y-m-d H:i:s');
			$LedtxtfileTb->ltf_remark = $fn1;
			$LedtxtfileTb->ltf_status = 1;
			$LedtxtfileTb->save();
		}else{//ถ้ามีไฟล์แล้ว ก้ให้ update ใหม่
			$udq = LedtxtfileTb::model()->findByAttributes(array('ltf_name'=>$textfilename));
			$udq->ltf_callrec = $recnumcall;
			$udq->ltf_resprec = 0;
			$udq->ltf_updateby = $username;
			$udq->ltf_modified = date('Y-m-d H:i:s');
			$udq->ltf_remark = $fn1;
			$udq->ltf_status = 1;
			$udq->save();
		}//if(empty($selq)){
			
	
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start)/60;
		//echo '<b>Total Execution Time for write textfile:</b> '.$execution_time.' Mins <br>';
		
		//ปรับ record เริ่มต้น และ record สุดท้าย
		$startrec = $stoprec_old;
		$stoprec = $startrec + $recperfile;
		
		if($stoprec<=$countarray1){
	 		$stoprec = $stoprec; 
  		}else{
	 		$stoprecl = $stoprec - $countarray1;
	 		$stoprec = $stoprec - $stoprecl; 
  		}
		
	}//for($j=1;$j<=$allfile;$j++){
	
	/*
	$mypath = "C:/xampp/htdocs/wpdcore_local/";
	$myfile = fopen($mypath . "/ledtextfile/" . "newfile.txt", "w") or die("Unable to open file!"); //create text file
	$txt = "Day Jakkrit\n"; //create text
	fwrite($myfile, $txt); //write over text to textfile
	$txt = "Day Jakkrit\n"; //create text
	fwrite($myfile, $txt); //write text to textfile
	fclose($myfile); //close text file
	*/

?>    

<table class="table4_1 display row-border responsive nowrap" >
	<thead>
    	<tr>
        	<th style="text-align:center;">ลำดับที่</th>
            <th>ชื่อไฟล์</th>
            <th>จำนวนรายการ</th>
            <th>จำนวนรายการ<br>ที่ถูกฟ้องล้มละลาย</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    	$rowno = 1;
		$model = LedtxtfileTb::model()->findAllByAttributes(array('ltf_status'=>1));
		foreach ($model as $rows){
		    $ltf_id = $rows->ltf_id;
		    $ltf_name = $rows->ltf_name;
		    $ltf_callrec = $rows->ltf_callrec;
		    $ltf_resprec = $rows->ltf_resprec;
		    $ltf_createby = $rows->ltf_createby;
		    $ltf_created = $rows->ltf_created;
		    $ltf_updateby = $rows->ltf_updateby;
		    $ltf_modified = $rows->ltf_modified;
		    $ltf_remark = $rows->ltf_remark;
		    $ltf_status = $rows->ltf_status;
	?>
    	<tr>
        	<td style="text-align:center;"><?=$rowno?></td>
            <td><?=$ltf_name?></td>
            <td><?=$ltf_callrec?></td>
            <td><div id="ledresp<?=$rowno?>" ><?=$ltf_resprec?></div></td>
            <td><button class="btn btn-success thfont5" onClick="javascript:callledservice1(<?=$rowno?>,'<?=$ltf_name?>',<?=$ltf_callrec?>)">call led service</button></td>
        </tr>
     <?php
	 		$rowno += 1;
		}//foreach
	 ?>   
    </tbody>
</table>
    
</body>
</html>
<script>
	/*function testajaxjson(){
		//alert('test');
		var dataString1 = '<?$encodejson_sso_accno_arr?>' ;
		var dataString2 = '<?$encodejson_sso_accbran_arr?>' ;
		var dataString3 = '<?$encodejson_crg_registernum_arr?>' ;
		var dataString4 = '<?$encodejson_crg_cropname_arr?>' ;
		var dataString5 = '<?$encodejson_crg_cropaddrss_arr?>' ;
		var dataString6 = '<?$encodejson_crg_brancode_arr?>' ;
		
		//alert(dataString);
		//var jsonString = JSON.stringify(dataString);
		//alert(jsonString);
		var data1 = 'action=senddata&sso_accno_arr=' + dataString1 + '&sso_accbran_arr=' + dataString2 + '&crg_registernum_arr=' + dataString3 + '&crg_cropname_arr=' + dataString4 + '&crg_cropaddrss_arr=' + dataString5 + '&crg_brancode_arr=' + dataString6;
		$('#res2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		   $.ajax({
			  type: "POST", 
			  url: "<?php echo Yii::app()->createAbsoluteUrl('site/callajaxjson'); ?>",      
			  data: data1,         
			  success: function (da)
			  {
				 $("#res2").html(da);
				 
			  }
		  });
			
		/*
			เวลารับ data
			$data = json_decode(stripslashes($_POST['data']));
  			// here i would like use foreach:
  			foreach($data as $d){
     			echo $d;
  			}
			
	}*/
</script>
