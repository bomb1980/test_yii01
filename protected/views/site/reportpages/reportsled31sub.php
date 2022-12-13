<?php
	//$slv = $_GET['slv'];
	//$df1 = date_create($d1)->format('d/m/Y'); //date("d/m/Y", $d1);
	//$df2 = date_create($d2)->format('d/m/Y'); //date("d/m/Y", $d2);
	$sso1 = $sso1;
	$bct = $bct;
	$bc = $bc;
	$sso1t = $sso1t;
	
	$sso1str01 = substr($sso1,0,2);
	$sso1str = $sso1; //substr($sso1,0,2) . "%";  //เปลี่ยนเงื่อนไขในการดูรายงานให้ตรงกับเลข baran_code 4 หลัก หรือ 2 หลัก
	//$datesch1 = date_create($d1)->format('Y-m-d');
	//$datesch2 = date_create($d2)->format('Y-m-d');
	
	$ledstatus = 2;
	
	$this->pageTitle='report - ' . $sso1t;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png">
<title>Report page1</title>
<script>
function dilldownrpt1(){
	//alert('test');	
}
</script>
<style>
@import url("<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/webfonts/thcharmau/stylesheet.css");
@import url("<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/webfonts/vivak/stylesheet.css");
@import url("<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/webfonts/thsarabun/stylesheet.css");

.thfont1{
	font-family: thcharmau;
	font-size: 21px;
}		
	
.thfont2{
	font-family: vivak;
	font-size: 21px;
}	
	
.thfont3{
	font-family: THSarabun;
	font-size: 21px;
}

.thfont4{
	font-family: THSarabun;
	font-size: 26px;
	color:#666;
}

.thfont5{
	font-family: THSarabun;
	font-size: 24px;
	line-height:normal; 
	/*font-weight:bold;*/
}

.thfont6{
	font-family: THSarabun;
	font-size: 18px;
	line-height:normal; 
	/*font-weight:bold;*/
}
</style>
</head>

<body>
	<?php
	
	    $ssobranch_code =array();
		$array_name =array();
		$array_p =array();
		$array_b =array();
		$array_a =array(); 
		$array_total =array();
		
		if($sso1=='0'){ //ทั่วประเทศ
		
		  /*$sqlrpt = "SELECT lrc_ssocode1, lrc_status, Count(lrc_registernumber) AS CountOflrc_registernumber";
		  $sqlrpt .= "FROM ledriskcrop2_tb";
		  $sqlrpt .= "GROUP BY lrc_ssocode1, lrc_status";
		  $sqlrpt .= "HAVING (((lrc_status)=2));";*/
		 
		  $criteria = new CDbCriteria();
		  $criteria->group = 'lrc_ssocode1,lrc_status';
		  $criteria->select = 'lrc_ssocode1, lrc_status, Count(lrc_registernumber) AS CountOflrc_registernumber';
		  $criteria->condition = 'lrc_status =:lrc_status';
		  $criteria->params = array(':lrc_status'=>$ledstatus);
			
		}else{ //ถ้าไม่ไช่ทั่วประเทศ
		
		  /*$sqlrpt = "SELECT ledriskcrop2_tb.lrc_ssocode1, ledriskcrop2_tb.lrc_status, Count(ledriskcrop2_tb.lrc_registernumber) AS CountOflrc_registernumber";
		  $sqlrpt .= "FROM ledriskcrop2_tb";
		  $sqlrpt .= "GROUP BY ledriskcrop2_tb.lrc_ssocode1, ledriskcrop2_tb.lrc_status";
		  $sqlrpt .= "HAVING (((ledriskcrop2_tb.lrc_ssocode1)='1002') AND ((ledriskcrop2_tb.lrc_status)=2));";*/
		  	
		  $criteria = new CDbCriteria(); 
		  //$criteria->having='lrc_ssocode1,lrc_status';
		  $criteria->group = 'lrc_ssocode1,lrc_status';
		  $criteria->select = 'lrc_ssocode1, lrc_status, Count(lrc_registernumber) AS CountOflrc_registernumber';
		  $criteria->condition = 'lrc_ssocode1=:lrc_ssocode1 AND lrc_status=:lrc_status';
		  $criteria->params = array(':lrc_ssocode1'=>$sso1str, ':lrc_status'=>$ledstatus);
		  
		}
		
		$modelast = Ledriskcrop2Tb::model()->findAll($criteria);
		//$modelast = Ledriskcrop2Tb::model()->findBySQL($sqlrpt);
		
		//print_r($modelast);exit;
		
		$countast = count($modelast);
		//echo "<br><br><br><br>{$countast}"; exit;
		
		if($countast>0){
		 	$sumcol1 = 0;
			//$sumcol2 = 0;
			//$sumcol3 = 0;
			//$sumcol4 = 0;
		  foreach ($modelast as $rows){
			  
			  $data1 =  $rows->lrc_ssocode1;
			  $data2 =  $rows->lrc_status;
			  $data3 = $rows->CountOflrc_registernumber;
			  
			  $bcr=MasSsobranch::model()->findByAttributes(array('ssobranch_code'=>$data1));
			  $bcn = $bcr->name;
			  	
			  //ค้นหาชื่อ สปส ตามเขตพื้นที่ 
			  
			  $lrc_ssocode1[] = $data1;
			  $array_name[] = $bcn;
			  $array_led[] = $data3; //P_status;
			 
			  $sumcol1 = $sumcol1 + $rows->CountOflrc_registernumber;
			  
			  //echo "{$data1}, {$data2}, {$data3}, {$bcn}, {$sumcol1}<br>";
			  
			   
		  }
		  //exit;
		}else{
			?>
            <script> alert('ไม่พบรายการข้อมูลสถานประกอบการที่ถูกฟ้องล้มละลาย ตามเงื่อนไขที่เลือก!');  </script>
            <?php	
		  //exit;	
		}
		
		
		//$countast = 50;
		
		//echo "{$array_name[2]},{$array_p[2]},{$array_b[2]},{$array_a[2]}<br>";
		
		$total_record = $countast; //40; //จำนวน record ทั้งหมด ที่ดึงออกมาจาก ฐานข้อมูลได้
		$perpage = 30; //จำนวน record ที่ต้องการให้แสดงต่อ 1 หน้า
		$total_page = ceil($total_record / $perpage);  //จำนวนหน้าทั้งหมด
		$beginpage = 1; //เลขหน้าเริ่มต้น
		$endpage = $total_page; //เลขหน้าสุดท้าย
		$rowt = $total_record; //จำนวน record ทั้งหมดที่จะให้แสดง
		$rowl = 1; //เลขแถวที่ต้องการให้เริ่มต้น
		
		for($i=$beginpage;$i<=$endpage;$i++){ //เริ่ม page
	?>
<div class="page-break<?=($i==1)?"-no":""?>">&nbsp;</div>
<page size='A4'>
       
<table id="tbp1" width="750" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td align="right" style="text-align:right;" class="thfont3">Page <?php echo " {$i}/{$endpage} "; ?></td>
  </tr>
  <tr>
    <td align="center"  class="headTitle thfont3">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png" width="50" height="45"><br />
    รายงานสรุปสถานประกอบการถูกฟ้องล้มละลาย <br />
    <?=$sso1t?> <br>
    <?php //if($df1!=$df2){  ?>
    	<!--ดึงข้อมูลวันที่ <?$df1?> ถึงวันที่ <?$df2?> <br /></td>-->
    <?php //}else{  ?>
    	<!--ประจำวันที่ <?$df1?>-->
    <?php //}  ?>
  </tr>
  <?php  if($i==$beginpage){  ?>	
  <tr>
    <td>
    วันที่ออกรายงาน : 
    <?php
	//$d=mktime(11, 14, 54, 8, 12, 2014);
	//echo "Created date is " . date("Y-m-d h:i:sa", $d);
	echo date("d/m/Y h:i:sa");
	?> 
    </td>
  </tr>
  <?php } ?>
  <tr><td>&nbsp;</td></tr>
  <tr>
  	<td>
    	<table width="750" border="1" align="left" cellpadding="3" cellspacing="0" style="border-collapse:collapse;border-top:5px double #000;" class="thfont6">
        	<tr height="50px;" bgcolor="#B7FFFF">
            	<th width="50">ลำดับ</th>
                <th width="400">สปส. รับผิดชอบ</th>
                <th width="150">สถานประกอบการ<br />ที่ถูกฟ้องล้มละลาย</th>
            <tr>
             <?php 
			   
				  $rowstart = 1; //ลำดับแถวเริ่มต้น
				  $rowstop = $perpage;//จำนวนบรรทัดต่อ 1 หน้า;
				  $rowlarray = $rowl - 1; //เลขแถวเริ่มต้น ลบ1
				 
				 for($l=$rowstart;$l<=$rowstop;$l++){   
				  
				  /*if($rowt>0){
					$tatalall = $array_p[$rowl-1] + $array_b[$rowl-1] + $array_a[$rowl-1];	
				  }else{
					$tatalal1 = 0;   
				  }*/
				  
				  //หาความยาว string
				  //$len_name = strlen($array_name[$rowl-1]);
				  //อัตราส่วน 55 ตัวอักษร = 1 บรรทัด
				  
				  
			  ?>
            <tr height="25px;">
            	<td align="center">
                	
                	<?php 
						if($rowt>0){
							echo "{$rowl}";
						}
						
					?>
                    
                </td>
                <!--<td></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>-->
                <?php
					if($rowt>0) { $ssobcl = $lrc_ssocode1[$rowl-1]; } 
				?>
                <td><a style="text-decoration:none" href="<?php echo Yii::app()->createAbsoluteUrl('site/callshowrptled32',  array('ssobranch_code' => $ssobcl)); ?>" target="_blank"><div><?php if($rowt>0) { echo "{$array_name[$rowl-1]}" ;}?></div></a></td>
                
                <td align="center"><?php if($rowt>0) { echo "{$array_led[$rowl-1]}";} ?></td>
            <tr>
             
             <?php 
				   
					
					$rowt = $rowt - 1; //จำนวนเรคคอรืดทั้งหมด
					$rowl = $rowl + 1; //ลำดับที่

				} //for $l
				
			?>
            <?php if($i==$endpage){  ?>
                <!--<table>-->
                  <tr style="background-color:#B7FFFF; line-height:20px;">	
                    <td></td>
                    <td style="text-align:right; font-weight:bold;">รวม :</td>
                    <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol1)?></td>
                  </tr>
                <!--</table>-->
          <?php } ?>
        </table>
      </td>
  </tr>
</table>

   </page>
    <?php
			
		} //for $i page
		
	?>
</body>
</html>
