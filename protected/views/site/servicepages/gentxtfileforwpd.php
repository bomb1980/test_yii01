<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>gen textfile for wpd</title>
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

if($bgdate != "-"){

 $now = date_create('now')->format('Y-m-d H:i:s');
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
  $textfilename = "wpd_" . $tdy2 . ".txt"; //ชื่อเท็กไฟล์ทั้งหมด
  
  
  
  $model = CropinfoTmpTb::model()->findAllByAttributes(array('registerdate'=>$datesch1));
  $countmedel = count($model); //นับจำนวนรายการของวันที่ค้นหา
  
  if($countmedel===0){
	 echo "ไม่พบข้อมูลสถานประกอบการในวันที่ : {$tdy3} <br>";
  }else{
	 //เริ่มดึงข้อมูลมา gentextfile
	 $mypath = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpd/" . $textfilename;
  	 $myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpd/" . $textfilename, "w") or die("Unable to open file!"); //สร้างไฟล์
	 $txt = "";
	 foreach ($model as $rows){
		$registername = $rows->registername;
		$registernumber = $rows->registernumber;
		$acc_no = $rows->acc_no;
		$acc_bran = $rows->acc_bran;
		$registerdate = $rows->registerdate;
		$crop_remark = $rows->crop_remark;
		$crop_status = $rows->crop_status;
		
		$txt = "";
		$f1 = $registernumber;
		$f2 = $acc_no;
		$f3 = $crop_remark;
		
		$txt .= $f1 . ",";
		$txt .= $f2 . ",";
		$txt .= $f3 . "";
		
		fwrite($myfile, $txt); //เริ่มเขียนไฟล์ 1 บรรทัด
		$newln = "\r" . PHP_EOL; 
		fwrite($myfile, $newln); //ขึ้นบรรทัดใหม่
		
	 }//for
	 
	 fclose($myfile); //ปิดไฟล์
	 
	 echo "สร้าง textfile ชื่อ : {$textfilename} เรียบร้อยแล้ว. <br>";
	 
	 $model2 = WpdtxtfileTb::model()->findAllByAttributes(array('wpdtf_filename'=>$textfilename));
  	 $countmedel2 = count($model2); //นับจำนวนรายการของวันที่ค้นหา
	 
	 if($countmedel2===0){
		//เพิ่มข้อมูลใน table 
		$WpdtxtfileTb = new WpdtxtfileTb();
		$WpdtxtfileTb->wpdtf_filename = $textfilename;
		$WpdtxtfileTb->wpdtf_path = $mypath;
		$WpdtxtfileTb->wpdtf_numrec = $countmedel;
		$WpdtxtfileTb->wpdtf_createby = $username;
		$WpdtxtfileTb->wpdtf_created = date('Y-m-d H:i:s');
		$WpdtxtfileTb->wpdtf_updateby = $username;
		$WpdtxtfileTb->wpdtf_modified = date('Y-m-d H:i:s');
		$WpdtxtfileTb->wpdtf_remark = "-";
		$WpdtxtfileTb->wpdtf_status = 1;
		if($WpdtxtfileTb->save()){
			//	
		}else{
			//
		}//if
	 }//if
	 
  }//if
 
}//if bgdate
 
  $model3 = WpdtxtfileTb::model()->findAll();
  $countmedel3 = count($model3);
  
  echo "จำนวน textfile wpd : {$countmedel3} ไฟล์";
  
?>

<div style="overflow-x:hidden; overflow-y:auto; height:330px;">
	<div class="row">
    	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
        	<table class="tablen">
            	<thead>
                	<tr>
                    	<th class="thn">No.</th>
                    	<th class="thn">ชื่อไฟล์</th>
                        <th class="thn">จำนวนรายการ</th>
                        <th class="thn">สถานะ cleansing</th>
                    </tr>
                </thead>
                <tbody>
                <?php
				  $rowno = 1;
				  foreach ($model3 as $rows){
					  
					   $wpdtf_filename = $rows->wpdtf_filename;
					   $wpdtf_path = $rows->wpdtf_path;
					   $wpdtf_numrec = $rows->wpdtf_numrec;
					   $wpdtf_createby = $rows->wpdtf_createby;
					   $wpdtf_created = $rows->wpdtf_created;
					   $wpdtf_updateby = $rows->wpdtf_updateby;
					   $wpdtf_modified = $rows->wpdtf_modified;
					   $wpdtf_remark = $rows->wpdtf_remark;
					   $wpdtf_status = $rows->wpdtf_status;
					   
					   if($wpdtf_status==='1'){
						   $wpdtf_status_txt = "ยังไม่ได้ cleansing";
					   }else if($wpdtf_status==='2'){
						   $wpdtf_status_txt = "cleansing แล้ว";
					   }else{
						   $wpdtf_status_txt = "-";
					   }
					  
				?>
                	<tr>
                    	<td class="thn"><?=$rowno?></td>
                    	<td class="thn"><?=$wpdtf_filename?></td>
                        <td class="thn"><?=$wpdtf_numrec?></td>
                        <td class="thn"><?=$wpdtf_status_txt?></td>
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