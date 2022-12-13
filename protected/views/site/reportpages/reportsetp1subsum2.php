<?php
	set_time_limit(0);
	ini_set("max_execution_time", "0");
	ini_set("memory_limit", "9999M");
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
	
	/*echo "<br><br><br><br>";
	echo "$action,$d1,$d2,$sso1,$bct,$bc,$sso1t";
	echo "<br><br><br><br>";
	echo $datesch1, $datesch2";
	echo "<br><br><br>";*/

	//exit();
	
	
	
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
	$array_ne =array();
	$array_zr =array();
	$array_cl =array();
	$array_al =array();
	$array_total =array();
	$array_pn =array();
	
	if($sso1=='0'){ //ทั่วประเทศ
	
		  $criteria = new CDbCriteria();
		  $criteria->group = 'ssobranch_code, name';
		  $criteria->select = 'ssobranch_code, name, Sum(P_status) AS SumOfP_status, Sum(B_status) AS SumOfB_status, Sum(A_status) AS SumOfA_status';
		  $criteria->condition = 'stateP_Date Between :bdate AND :edate';
		  $criteria->params = array(':bdate'=>"{$datesch1}", ':edate'=>"{$datesch2}");
		  
	}else{ //ถ้าไม่ไช่ทั่วประเทศ
	
		  $criteria = new CDbCriteria();
		  $criteria->having='ssobranch_code like :ssobranch_code';
		  $criteria->group = 'ssobranch_code, name';
		  $criteria->select = 'ssobranch_code, name, Sum(P_status) AS SumOfP_status, Sum(B_status) AS SumOfB_status, Sum(A_status) AS SumOfA_status';
		  $criteria->condition = 'stateP_Date Between :bdate AND :edate ';
		  $criteria->params = array(':bdate'=>"{$datesch1}", ':edate'=>"{$datesch2}", ':ssobranch_code'=>$sso1str);
	
	}
	
	$modelast = Countallstatus::model()->findAll($criteria);
	$countast = count($modelast);
	if($countast>0){
		$sumcol_p = 0;
		$sumcol_a = 0;
		$sumcol_ne = 0;
		$sumcol_zr = 0;
		$sumcol_al = 0;
		$sumcol_cl = 0;
		$sumcol_all = 0;
		$ne_rows = 0;
		$zr_rows = 0;
		$al_rows = 0;
		$cl_rows = 0;
		$all_rows = 0;
		//$all_rows2 = 0;
		$pn_rows= 0;
		foreach ($modelast as $rows){
			$ssobranch_code[] = $rows->ssobranch_code;
			$array_name[] = mb_substr($rows->name,19,strlen($rows->name),'UTF-8'); //mb_substr(ข้อความ,เริ่มต้นตัดที่อักขระ,จำนวนอักขระที่ตัด,'UTF-8');
			$array_p[] = $rows->SumOfP_status; //P_status;
			//$array_b[] = $rows->SumOfB_status; //B_status;
			$array_a[] = $rows->SumOfA_status; //A_status;	
			 //ค้นหายอดคำตอบ NE -----------------------------------------
			//$array_ne[]=OtpEmailTb::model()->countByAttributes(array('oel_remark'=>$rows->ssobranch_code));
			$array_ne[]=OtpEmailTb::model()->count("oel_remark=:oel_remark and oel_answer=:oel_answer and oel_registerdate between '{$datesch1}' and '{$datesch2}'", array(":oel_remark" => $rows->ssobranch_code, ":oel_answer"=>"NE"));
			//จบการค้นหายอด NE------------------------------------------
			$array_zr[]=OtpEmailTb::model()->count("oel_remark=:oel_remark and oel_answer=:oel_answer and oel_registerdate between '{$datesch1}' and '{$datesch2}'", array(":oel_remark" => $rows->ssobranch_code, ":oel_answer"=>"ZR"));
		
			$array_al[]=OtpEmailTb::model()->count("oel_remark=:oel_remark and oel_answer=:oel_answer and oel_registerdate between '{$datesch1}' and '{$datesch2}'", array(":oel_remark" => $rows->ssobranch_code, ":oel_answer"=>"AL"));

			$array_cl[]=OtpEmailTb::model()->count("oel_remark=:oel_remark and oel_answer=:oel_answer and oel_registerdate between '{$datesch1}' and '{$datesch2}'", array(":oel_remark" => $rows->ssobranch_code, ":oel_answer"=>"CL"));

			$ne_rows=OtpEmailTb::model()->count("oel_remark=:oel_remark and oel_answer=:oel_answer and oel_registerdate between '{$datesch1}' and '{$datesch2}'", array(":oel_remark" => $rows->ssobranch_code, ":oel_answer"=>"NE"));
			
			$zr_rows=OtpEmailTb::model()->count("oel_remark=:oel_remark and oel_answer=:oel_answer and oel_registerdate between '{$datesch1}' and '{$datesch2}'", array(":oel_remark" => $rows->ssobranch_code, ":oel_answer"=>"ZR"));
			
			$al_rows=OtpEmailTb::model()->count("oel_remark=:oel_remark and oel_answer=:oel_answer and oel_registerdate between '{$datesch1}' and '{$datesch2}'", array(":oel_remark" => $rows->ssobranch_code, ":oel_answer"=>"AL"));

			$cl_rows=OtpEmailTb::model()->count("oel_remark=:oel_remark and oel_answer=:oel_answer and oel_registerdate between '{$datesch1}' and '{$datesch2}'", array(":oel_remark" => $rows->ssobranch_code, ":oel_answer"=>"CL"));

			
			$array_total[] = $rows->SumOfP_status + $rows->SumOfA_status;// + $ne_rows + $zr_rows + $cl_rows;
			$array_pn[] = $rows->SumOfP_status - ($ne_rows + $zr_rows + $al_rows + $cl_rows);
			
			$all_rows = $rows->SumOfP_status + $rows->SumOfA_status ;
		//	$all_rows2 = $rows->SumOfP_status + $rows->SumOfA_status;
			$pn_rows = $rows->SumOfP_status - ($ne_rows + $zr_rows + $al_rows + $cl_rows);
			//sum column
			 $sumcol_p = $sumcol_p + $pn_rows; //$sumcol_p + $rows->SumOfP_status;
			 //$sumcol2 = $sumcol2 + $rows->SumOfB_status;
			 $sumcol_a = $sumcol_a + $rows->SumOfA_status;
			 $sumcol_ne = $sumcol_ne + $ne_rows;
			 $sumcol_zr = $sumcol_zr + $zr_rows;
			 $sumcol_al = $sumcol_al + $al_rows;
			 $sumcol_cl = $sumcol_cl + $cl_rows;
			 $sumcol_all = $sumcol_all + $all_rows;
			 
		}//for
	}else{
		?>
         	<script> alert('ไม่พบรายการข้อมูลนิติบุคคลที่ขึ้นทะเบียน ตามเงื่อนไขที่เลือก!');  </script>
        <?php
	}//if
	
?>

<?php
		
  $total_record = $countast;//$countast; //40; //จำนวน record ทั้งหมด ที่ดึงออกมาจาก ฐานข้อมูลได้
  $perpage = 28; //จำนวน record ที่ต้องการให้แสดงต่อ 1 หน้า
  $total_page = ceil($total_record / $perpage);  //จำนวนหน้าทั้งหมด
  $beginpage = 1; //เลขหน้าเริ่มต้น
  $endpage = $total_page; //เลขหน้าสุดท้าย
  $rowt = $total_record; //จำนวน record ทั้งหมดที่จะให้แสดง
  $rowl = 1; //เลขแถวที่ต้องการให้เริ่มต้น
  
  for($i=$beginpage;$i<=$endpage;$i++){ //เริ่ม page
?>
  <div class="page-break<?=($i==1)?"-no":""?>">&nbsp;</div>
   <page size='A4'>
     <!-- start page -->
     
     
     <table id="tbp1" width="750" border="0" align="center" cellpadding="0" cellspacing="0" >
     	<!-- report header -->
        <tr>
        	<td align="right" style="text-align:right;" class="thfont3">หน้าที่ <?php echo " {$i}/{$endpage} "; ?></td>
        </tr>
        <tr>
          <td align="center" class="headTitle thfont3">
          <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png" width="50" height="45"><br />
          รายงานสรุปการติดตามสถานประกอบการซึ่งมีสถานะเป็น P (pending)<br />
          <?=$sso1t?> <br>
          <?php if($df1!=$df2){  ?>
              ตั้งแต่วันที่ <?=$df1?> ถึงวันที่ <?=$df2?> <br /></td>
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
        <?php }//if ?>
        <tr><td>&nbsp;</td></tr>
        <!-- //report header -->
        
        <!-- report body -->
        <tr>
        	<td>
            	<table width="750" border="1" align="left" cellpadding="3" cellspacing="0" style="border-collapse:collapse;border-top:5px double #000;" class="thfont6">
                	<tr height="50px;" bgcolor="#B7FFFF">
                        <th width="50">ลำดับ</th>
                        <th width="470">สปส.รับผิดชอบ</th>
                        <th width="80">รวม<br/>นิติบุคคล</th>
                        <th width="80">Pending<br />(P)</th>
                        <th width="80">Active<br />(A)</th>
                        <th width="80">ไม่เปิด<br />ดำเนินการ<br>(NE)</th>
                        <th width="80">ไม่มี<br />ลูกจ้าง<br>(ZR)</th>
						<th width="80">ดำเนินกิจการแต่ไม่มีลูกกจ้าง<br>(AL)</th>
                        <th width="80">หยุด/เลิก<br>(CL)</th>
                    </tr>
                    <?php 
						  $rowstart = 1; //ลำดับแถวเริ่มต้น
						  $rowstop = $perpage;//จำนวนบรรทัดต่อ 1 หน้า;
						  $rowlarray = $rowl - 1; //เลขแถวเริ่มต้น ลบ1
						  
						  $sumbyrows = 0;
						 
						 for($l=$rowstart;$l<=$rowstop;$l++){   
						 
						 //$sumbyrows = $array_p[$l-1] + $array_a[$l-1] + $array_ne[$l-1] + $array_zr[$l-1] + 0;
					?>
                    <tr height="25px;">
                        <td style="text-align:center;"><?php if($rowt>0){ echo "{$rowl}"; } ?>	</td>
                        <td>&nbsp;<?php if($rowt>0) { echo "{$ssobranch_code[$rowl-1]} {$array_name[$rowl-1]}" ;}?></td>
                        <td style="text-align:center;"><?php if($rowt>0) { echo "{$array_total[$rowl-1]}" ;}?></td>
                        <td style="text-align:center;"><?php if($rowt>0) { echo "{$array_pn[$rowl-1]}" ;}?></td>
                        <?php                           ?>
                        <td style="text-align:center;"><?php if($rowt>0) { echo "{$array_a[$rowl-1]}" ;}?></td>
                     <?php
					
					 ?>
                        <td style="text-align:center;"><?php if($rowt>0) { echo "{$array_ne[$rowl-1]}"; }?></td>
                        <td style="text-align:center;"><?php if($rowt>0) { echo "{$array_zr[$rowl-1]}" ;}?></td>
                        <td style="text-align:center;"><?php if($rowt>0) { echo "{$array_al[$rowl-1]}" ;}?></td>
						<td style="text-align:center;"><?php if($rowt>0) { echo "{$array_cl[$rowl-1]}" ;}?></td>

                    </tr>
                    <?php 
							  
							  $rowt = $rowt - 1; //จำนวนเรคคอรืดทั้งหมด
							  $rowl = $rowl + 1; //ลำดับที
						}//for 
					?>
                    <?php if($i==$endpage){  ?>
                          <!--<table>-->
                            <tr style="background-color:#B7FFFF; line-height:20px;">	
                              <td></td>
                              <td style="text-align:right; font-weight:bold;">รวม**</td>
                              <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol_all)?></td>
                              <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol_p)?></td>
                              <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol_a)?></td>
                              <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol_ne)?></td>
                              <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol_zr)?></td>
							  <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol_al)?></td>
                              <td style="text-align:center; font-weight:bold;"><?=number_format($sumcol_cl)?></td>
                            </tr>
                          <!--</table>-->
                    <?php } ?>
                    
                </table>
            </td>
        </tr>
        <!-- //report body -->
        
     </table>
     
     
     <!-- //end page -->
   </page>
<?php		
  } //for $i page end page	
?>

</body>
</html>
