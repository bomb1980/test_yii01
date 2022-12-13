<?php
	//$slv = $_GET['slv'];
	$df1d = date_create($d1)->format('d');
	$df1m = date_create($d1)->format('m');
	$df1y = date_create($d1)->format('Y')+543;
	$df1dmy = $df1y . "-" . $df1m . '-' . $df1d;   
	$df1 = date_create($df1dmy)->format('d/m/Y'); //date("d/m/Y", $d1);
	
	$df2d = date_create($d2)->format('d');
	$df2m = date_create($d2)->format('m');
	$df2y = date_create($d2)->format('Y')+543;
	$df2dmy = $df2y . "-" . $df2m . '-' . $df2d; 	
	$df2 = date_create($df2dmy)->format('d/m/Y'); //date("d/m/Y", $d2);
	
	$sso1 = $sso1;
	$bct = $bct;
	$bc = $bc;
	$sso1t = $sso1t;
	
	$sso1str01 = substr($sso1,0,2);
	$sso1str = $sso1; //substr($sso1,0,2) . "%";  //เปลี่ยนเงื่อนไขในการดูรายงานให้ตรงกับเลข baran_code 4 หลัก หรือ 2 หลัก
	$datesch1 = date_create($d1)->format('Y-m-d');
	$datesch2 = date_create($d2)->format('Y-m-d');
	
	
	
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
		  /*$qsbd = new CDbCriteria( array(
			  'condition' => "stateP_Date between :datesch1 and :datesch2 ",         
			  'params'    => array(':datesch1' => "{$datesch1}", ':datesch2' => "{$datesch2}")  
		  ));*/
		  /*$sqlrpt = " SELECT wpdreportdb.countallstatus.ssobranch_code, wpdreportdb.countallstatus.name, ";
		  $sqlrpt .= " Sum(wpdreportdb.countallstatus.P_status) AS SumOfP_status, ";
		  $sqlrpt .= " Sum(wpdreportdb.countallstatus.B_status) AS SumOfB_status, ";
		  $sqlrpt .= " Sum(wpdreportdb.countallstatus.A_status) AS SumOfA_status ";
		  $sqlrpt .= " FROM wpdreportdb.countallstatus ";
		  $sqlrpt .= " WHERE (((wpdreportdb.countallstatus.stateP_Date) Between '2019-06-01' And '2019-08-30')) ";
		  $sqlrpt .= " GROUP BY wpdreportdb.countallstatus.ssobranch_code, wpdreportdb.countallstatus.name; ";*/
		  
		  $criteria = new CDbCriteria();
		  $criteria->group = 'ssobranch_code, name';
		  $criteria->select = 'ssobranch_code, name, Sum(P_status) AS SumOfP_status, Sum(B_status) AS SumOfB_status, Sum(A_status) AS SumOfA_status';
		  $criteria->condition = 'stateP_Date Between :bdate AND :edate';
		  $criteria->params = array(':bdate'=>"{$datesch1}", ':edate'=>"{$datesch2}");
			
		}else{
		  /*$qsbd = new CDbCriteria( array(
			  'condition' => "stateP_Date between :datesch1 and :datesch2 and ssobranch_code = :ssobranch_code ",         
			  'params'    => array(':datesch1' => "{$datesch1}", ':datesch2' => "{$datesch2}", ':ssobranch_code' => $sso1)  
		  ));*/
		 /* $sqlrpt = " SELECT wpdreportdb.countallstatus.ssobranch_code, wpdreportdb.countallstatus.name, ";
		  $sqlrpt .= " Sum(wpdreportdb.countallstatus.P_status) AS SumOfP_status, "; 
		  $sqlrpt .= " Sum(wpdreportdb.countallstatus.B_status) AS SumOfB_status, ";
		  $sqlrpt .= " Sum(wpdreportdb.countallstatus.A_status) AS SumOfA_status ";
		  $sqlrpt .= " FROM wpdreportdb.countallstatus ";
		  $sqlrpt .= " WHERE (((wpdreportdb.countallstatus.stateP_Date) Between '2019-06-01' And '2019-08-30')) ";
		  $sqlrpt .= " GROUP BY wpdreportdb.countallstatus.ssobranch_code, wpdreportdb.countallstatus.name ";
		  $sqlrpt .= " HAVING (((wpdreportdb.countallstatus.ssobranch_code)='1200')); ";*/
		  
		  //if($sso1str01!='10'){
			  $criteria = new CDbCriteria();
			  $criteria->having='ssobranch_code like :ssobranch_code';
			  $criteria->group = 'ssobranch_code, name';
			  $criteria->select = 'ssobranch_code, name, Sum(P_status) AS SumOfP_status, Sum(B_status) AS SumOfB_status, Sum(A_status) AS SumOfA_status';
			  $criteria->condition = 'stateP_Date Between :bdate AND :edate ';
			  $criteria->params = array(':bdate'=>"{$datesch1}", ':edate'=>"{$datesch2}", ':ssobranch_code'=>$sso1str);
		  //}else{
			  /*$criteria = new CDbCriteria();
			  $criteria->having='ssobranch_code = :ssobranch_code';
			  $criteria->group = 'ssobranch_code, name';
			  $criteria->select = 'ssobranch_code, name, Sum(P_status) AS SumOfP_status, Sum(B_status) AS SumOfB_status, Sum(A_status) AS SumOfA_status';
			  $criteria->condition = 'stateP_Date Between :bdate AND :edate ';
			  $criteria->params = array(':bdate'=>"{$datesch1}", ':edate'=>"{$datesch2}", ':ssobranch_code'=>$sso1);*/
		  //}
		  
		}
		
		$modelast = Countallstatus::model()->findAll($criteria);
		//$modelast = Countallstatus::model()->findBySQL($sqlrpt);
		$countast = count($modelast);
		if($countast>0){
		 	$sumcol1 = 0;
			$sumcol2 = 0;
			$sumcol3 = 0;
			$sumcol4 = 0;	
		  foreach ($modelast as $rows){
			  $ssobranch_code[] = $rows->ssobranch_code;
			  $array_name[] = $rows->name;
			  $array_p[] = $rows->SumOfP_status; //P_status;
			  $array_b[] = $rows->SumOfB_status; //B_status;
			  $array_a[] = $rows->SumOfA_status; //A_status;	
			  $array_total[] = $rows->SumOfP_status + $rows->SumOfB_status + $rows->SumOfA_status;
			  //sum column
			  $sumcol1 = $sumcol1 + $rows->SumOfP_status;
			  $sumcol2 = $sumcol2 + $rows->SumOfB_status;
			  $sumcol3 = $sumcol3 + $rows->SumOfA_status;
			  $sumcol4 = $sumcol4 + ($rows->SumOfP_status + $rows->SumOfB_status + $rows->SumOfA_status);
			  
		  }
		}else{
			?>
            <script> alert('ไม่พบรายการข้อมูลนิติบุคคลที่ขึ้นทะเบียน ตามเงื่อนไขที่เลือก!');  </script>
            <?php	
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
    <td align="center" class="headTitle thfont3">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png" width="50" height="45"><br />
    รายงานสรุปผลสถานะการขึ้นทะเบียนนายจ้าง <br />
    <?=$sso1t?> <br>
    <?php if($df1!=$df2){  ?>
    	ขึ้นทะเบียนวันที่ <?=$df1?> ถึงวันที่ <?=$df2?> <br /></td>
    <?php }else{  ?>
    	ประจำวันที่ <?=$df1?>
    <?php }  ?>
  </tr>
  <?php  if($i==$beginpage){  ?>	
  <tr>
    <td>
    วันที่ออกรายงาน : 
    <?php
	//$d=mktime(11, 14, 54, 8, 12, 2014);
	//echo "Created date is " . date("Y-m-d h:i:sa", $d);
	$nd = date_create('now')->format('d');
	$nm = date_create('now')->format('m');
	$ny = date_create('now')->format('Y')+543;
	$ndmy = $nd . "-" . $nm . '-' . $ny; 	
	echo date("{$ndmy} h:i:sa");
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
                <th width="100">นิติบุคคล<br />สถานะ P</th>
                <th width="100">นิติบุคคล<br />สถานะ B</th>
                <th width="100">นิติบุคคล<br />สถานะ A</th>
                <th width="150">นิติบุคคล<br />ที่จดทะเบียนทั้งหมด</th>
            </tr>
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
					if($rowt>0) { $ssobcl = $ssobranch_code[$rowl-1]; } 
				?>
                <td><a style="text-decoration:none" href="<?php echo Yii::app()->createAbsoluteUrl('site/callshowrpt32',  array('ssobranch_code' => $ssobcl, 'd1' => $d1, 'd2' => $d2)); ?>" target="_blank"><div><?php if($rowt>0) { echo "{$array_name[$rowl-1]}" ;}?></div></a></td>
                
                <td align="center"><?php if($rowt>0) { echo "{$array_p[$rowl-1]}" ;}?></td>
                <td align="center"><?php if($rowt>0) { echo "{$array_b[$rowl-1]}" ;}?></td>
                <td align="center"><?php if($rowt>0) { echo "{$array_a[$rowl-1]}" ;}?></td>
                <td align="center"><?php if($rowt>0) { echo "{$array_total[$rowl-1]}";} ?></td>
            <tr>
             
             <?php 
				    //sum column
					//$sumcol1 = $sumcol1 + $array_p[$l];
					//$sumcol2 = $sumcol2 + $array_b[$rowl-1];
					//$sumcol3 = $sumcol3 + $array_a[$rowl-1];
					//$sumcol4 = $sumcol4 + $tatalall;
					
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
                    <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol2)?></td>
                    <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol3)?></td>
                    <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol4)?></td>
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
