<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>gen textfile for sapains</title>
<script>
function writeallsapains(tfns,rwn){
	$('#pl' + rwn).html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Writing...");
	var data1 = 'tfns=' + tfns;
	$.ajax({
		type: "POST", 
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/writesapeainsall'); ?>",      
		data: data1,         
		success: function (da)
		{
		   $('#pl' + rwn).html("");
		   if(da){
		   		BootstrapDialog.alert('<font class="thfont5">เขียนข้อมูลลงไฟล์รวม เรียบร้อย.</font>'); 
				$("#trid" + rwn).css("background-color","#FC6");
				$("#st" + rwn).html("เขียนรวมแล้ว");
				$("#btn" + rwn).hide();
		   }else{
			   	BootstrapDialog.alert('<font class="thfont5">เกิดข้อผิดพลาด ขณะทำการเขียนไฟล์.</font>'); 
		   }
		  // $("#re4").load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/gentxtfilesapeains') ."'" ; ?>, { tfn: tfn });
		  
		}
	});
}//function 
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

/* $now = date_create('now')->format('Y-m-d H:i:s');
 $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
 $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
 $daten1 = date('Y-m-d H:i:s');
 
  $now = date_create('now')->format('Y-m-d H:i:s');
  $tomorrow = date_create('+1 day')->format('Y-m-d');
  $tdy = date_create('now')->format('Ymd');
  $tdyd = date_create('now')->format('d');
  $tdym = date_create('now')->format('m');
  $tdyy = date_create('now')->format('Y');
  
  $tdyyth = $tdyy + 543;
  
  $tdy = $tdyyth . $tdym . $tdyd;
  
  $startdate = $bgdate;
  $enddate = $eddate;
  
  $datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
  $datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
  
  $tdy2 = date_create($startdate)->format('dmY'); //ชื่อไฟล์
  $tdy3 = date_create($startdate)->format('d/m/Y');
  */
  
  $accno_arr = array(); // เลขประกันสังคม 10 หลัก
  $accbran_arr = array(); // เลขสาขา 6 หลัก
  $registernum_arr = array(); // เลขทะเบียนพาณิชย์ 13 หลัก
  
  $textfilename = $tfn;
  
if($textfilename != "-"){  //ตรวจสอบว่า ชื่อไฟล์ ไม่เท่ากับ -
  //read data in textfile
  $linecount = 0;
  $handle = fopen($_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/out/" . $tfn, "r");
  while(!feof($handle)){
	  $line = fgets($handle);
	  $linecount++;
  }//while
  fclose($handle);
  
  if($linecount===0){
	  echo "ไม่พบข้อมูลสถานประกอบการในไฟล์ : {$tfn} <br>";
  }else{
	  echo "จำนวนสถานประกอบการในไฟล์ : {$tfn} มีทั้งหมด : {$linecount} รายการ <br>";
	  
	  $line = -1;
  	  $min = 0; //$minrec; //บรรทัดเริ่มต้น บรรทัดแรกสุด คือ 0
  	  $max = $linecount; //$linecount; //$min + 1000;//42632; //บรรทัดสุดท้ายที่จะให้ดึง
	  
	  if (($myfile = fopen( $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/out/" . $tfn , "r")) !== FALSE) {
		  while(!feof($myfile)) {
			$line++; //เริ่มบรรทัดที่ 0
			if(($line >= $min && $line <= $max)) {//ถ้าบรรทัดยังไม่ถึงบรรทัดสุดท้าย
				$datastr  = fgets($myfile);
	  			$arraystr = explode("|", $datastr); //ตัดข้อมูลออกตาม | เป็น arraystr
				
			if($tfn==="BBMFT8000.txt"){
				
				if(!empty($arraystr[0])){
				  $t1 = trim($arraystr[0]);// เลขประกันสังคม 10 หลัก
				}else{
				  $t1 = "";  	
				}//if
				
				if(!empty($arraystr[1])){
				  $t2 = trim($arraystr[1]);// เลขสาขา 6 หลัก
				}else{
				  $t2 = "";    
				}//if
				
				if(!empty($arraystr[5])){
				  $t3 = trim($arraystr[5]);// เลขทะเบียนพาณิชย์ 13 หลัก
				}else{
				  $t3 = "";  
				}//if
				
			}else{
				
				if(!empty($arraystr[3])){
				  $t1 = trim($arraystr[3]);// เลขประกันสังคม 10 หลัก
				}else{
				  $t1 = "";  	
				}//if
				
				if(!empty($arraystr[4])){
				  $t2 = trim($arraystr[4]);// เลขสาขา 6 หลัก
				}else{
				  $t2 = "";    
				}//if
				
				if(!empty($arraystr[8])){
				  $t3 = trim($arraystr[8]);// เลขทะเบียนพาณิชย์ 13 หลัก
				}else{
				  $t3 = "";  
				}//if
				
			}//if $tfn
			
			 if($t2==="000000"){
				if(!empty($t3)){
					$lent3 = strlen($t3);
					if($lent3==13){
						if(is_numeric($t3) && $t3 > 0 && $t3 == round($t3,0)){
			 				$accno_arr[] = $t1; // เลขประกันสังคม 10 หลัก
 			 				$accbran_arr[] = $t2; // เลขสาขา 6 หลัก
 			 				$registernum_arr[] = $t3; // เลขทะเบียนพาณิชย์ 13 หลัก
						}//if
					}//if
				}//if
			 }//if t2
				
			}elseif($line > $max) {
				break;
			}else{
				//echo "error!";
				fgets($myfile);
			}//if $line
			
		  }//while feof
		  
		  fclose($myfile);
		  
	  }//if
	  
	  //var_dump($accno_arr); //แสดงค่า array ออกมา
	  $countarr = count($accno_arr); //จำนวนรายการใน Array
	  
	  $mypath = $_SERVER['DOCUMENT_ROOT'] ."/wpdtextfile/sapains/" . $tfn;
	  
	  //เริ่มนำข้อมูลจาก Array เขียนลงไฟล์
	  $myfile2 = fopen($_SERVER['DOCUMENT_ROOT'] ."/wpdtextfile/sapains/" . $tfn, "w") or die("Unable to open file!");
	  for($i=0;$i<=$countarr-1;$i++){
		$txt = "";
		$txt .= $accno_arr[$i] . ";"; //str_pad($f21, 4);
		$txt .= $accbran_arr[$i] . ";"; //str_pad($f22, 8);
		$txt .= $registernum_arr[$i] . PHP_EOL;//str_pad($f23, 6);
		fwrite($myfile2, $txt) or die("Could not write file!");
		//echo "{$txt} <br>";
	  }//for
	  fclose($myfile2);
	  
	   echo "สร้าง textfile ชื่อ : {$textfilename} เรียบร้อยแล้ว จำนวนรายการที่เขียน : {$countarr} รายการ. <br>";
	  
	  //บันทึกชื่อไฟล์ ลงฐานข้้อมูล 
	  $model2 = Sapainstxtfile2Tb::model()->findAllByAttributes(array('sptf_filename'=>$textfilename));
  	  $countmedel2 = count($model2);
	  //echo "{$countmedel2}";
	  if($countmedel2===0){
		//เพิ่มข้อมูลใน table 
		$Sapainstxtfile2Tb = new Sapainstxtfile2Tb();
		$Sapainstxtfile2Tb->sptf_filename = $textfilename;
		$Sapainstxtfile2Tb->sptf_path = $mypath;
		$Sapainstxtfile2Tb->sptf_numrec = $countarr;
		$Sapainstxtfile2Tb->sptf_createby = $username;
		$Sapainstxtfile2Tb->sptf_created = date('Y-m-d H:i:s');
		$Sapainstxtfile2Tb->sptf_updateby = $username;
		$Sapainstxtfile2Tb->sptf_modified = date('Y-m-d H:i:s');
		$Sapainstxtfile2Tb->sptf_remark = "-";
		$Sapainstxtfile2Tb->sptf_status = 1;
		if($Sapainstxtfile2Tb->save()){
			//อัปเดทสถานะ และ จำนวนรายการ
			$empdm=SapainstxtfileTb::model()->findByAttributes(array('sptf_filename'=>$tfn));
			$empdm->sptf_numrec = $linecount;
			$empdm->sptf_updateby = $username;
			$empdm->sptf_modified = date('Y-m-d H:i:s');
			$empdm->sptf_remark = "wfa";
			$empdm->sptf_status = 2;
			$empdm->save();
			
			?>
            
            <script>
            	$("#re3").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
				$("#re3").load("<?php echo Yii::app()->createAbsoluteUrl('site/getfilenamesapains'); ?>");
			</script>
            
            <?php
			
			//echo "{$tfn}";
			
			//$modelupdate = SapainstxtfileTb::model()->findAllByAttributes(array('sptf_filename'=>$tfn));	
			//var_dump($modelupdate);
			//foreach ($modelupdate as $rows){
				//$aaa = $modelupdate->sptf_filename;
			//}//foreach
			//echo "{$aaa}";
			/*$modelupdate->sptf_numrec = $linecount;
			$modelupdate->sptf_updateby = $username;
			$modelupdate->sptf_modified = date('Y-m-d H:i:s');
			$modelupdate->sptf_remark = "wfa";
			$modelupdate->sptf_status = 2;
			if($modelupdate->save()){
				$msg3 = "update data is success.";
			}else{
				$msg3 = $modelupdate->getErrors();
			}//if   */
		}else{
			//
		}//if
	 }//if
	  
	  
  }//if
  
}//if textfilename
  
  $model3 = Sapainstxtfile2Tb::model()->findAll();
  $countmedel3 = count($model3);
  
  echo "จำนวน textfile sapains ที่เขียนใหม่ : {$countmedel3} ไฟล์";
 
  
?>

<div style="overflow-x:hidden; overflow-y:auto; height:340px;">
	<div class="row">
    	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
        	<table class="tablen">
            	<thead>
                	<tr>
                    	<th class="thn">No.</th>
                    	<th class="thn">ชื่อไฟล์</th>
                        <th class="thn">จำนวนรายการ</th>
                        <th class="thn">สถานะเขียนรวม</th>
                        <th class="thn">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
				  $rowno = 1;
				  foreach ($model3 as $rows){
					  
					   $sptf_filename = $rows->sptf_filename;
					   $sptf_path = $rows->sptf_path;
					   $sptf_numrec = $rows->sptf_numrec;
					   $sptf_createby = $rows->sptf_createby;
					   $sptf_created = $rows->sptf_created;
					   $sptf_updateby = $rows->sptf_updateby;
					   $sptf_modified = $rows->sptf_modified;
					   $sptf_remark = $rows->sptf_remark;
					   $sptf_status = $rows->sptf_status;
					   
					   if($sptf_status==='1'){
						   $sptf_status_txt = "ยังไม่ได้เขียนรวม";
					   }else if($sptf_status==='2'){
						   $sptf_status_txt = "เขียนรวมแล้ว";
					   }else{
						   $sptf_status_txt = "-";
					   }
					  
				?>
                	<tr id="trid<?=$rowno?>" <?php if($sptf_status==='2'){ ?> style="background-color:#FC6;" <?php } ?>>
                    	<td class="tdn"><?=$rowno?></td>
                    	<td class="tdn"><?=$sptf_filename?></td>
                        <td class="tdn"><?=$sptf_numrec?></td>
                        <td class="tdn"><div id="st<?=$rowno?>"><?=$sptf_status_txt?></div></td>
                        <td class="tdn">
                        	<?php if($sptf_status==='1'){ ?>
                            	<?php if($sptf_numrec!='0'){ ?>
                        		<button id="btn<?=$rowno?>" class="btn btn-primary" title="เขียนไฟล์รวม" onClick="javascript:writeallsapains('<?=$sptf_filename?>',<?=$rowno?>);"><i class="fa fa-edit"></i></button>
                                <?php } ?>
                            <?php }//if ?>
                            <span id="pl<?=$rowno?>"></span>
                        </td>
                    </tr>
                <?php
				  $rowno += 1;
				  }//foreach ($model as $rows){
				?>  
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>