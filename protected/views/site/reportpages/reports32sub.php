<?php
	$ssobranch_code = $ssobranch_code;
	$d1 = $d1;
	$d2 = $d2;
	$ssobranch_codet = $ssobranch_codet;
	
	$datesch1 = date_create($d1)->format('Y-m-d');
	$datesch2 = date_create($d2)->format('Y-m-d');
	
	$dd1 = date_create($d1)->format('d');
	$dm1 = date_create($d1)->format('m');
	$dy1 = date_create($d1)->format('Y')+543;
	$ddmy1 = $dy1 . "-" . $dm1 . "-" . $dd1; 
	$datesch1f = date_create($ddmy1)->format('d/m/Y');
	
	$dd2 = date_create($d2)->format('d');
	$dm2 = date_create($d2)->format('m');
	$dy2 = date_create($d2)->format('Y')+543;
	$ddmy2 = $dy2 . "-" . $dm2 . "-" . $dd2; 
	$datesch2f = date_create($ddmy2)->format('d/m/Y');
	
	$this->pageTitle='report - ' . $ssobranch_codet;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>WPD Report</title>
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
	font-size: 14px;
	line-height:normal; 
	/*font-weight:bold;*/
}

.page {
  width: 29.7cm;
  margin-left:180px;
  margin-bottom:20px;
}

@page {
  size: A4 landscape;
  margin: 0;
  margin-bottom:20px;
 
}



@media print {
  .page {
    margin: 0;
	margin-bottom: 5px;
	margin-top: 5px;
	margin-left:5px;
	margin-right:5px;
	background: white;
	border: initial;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
	margin-top:5px;
  }
  
 body, page[size="A4"]["landscape"] {
    margin-bottom: 0;
	margin-top: 0;
	background: white;
	border: initial;
  }
  
  .page-break { /* ขึ้นหน้าใหม่ แบบหน้า ถัดไป */ 
	  display:block;
	  height:1px; 
	  page-break-before:always; 
  }
  .page-break-no{ /* ขึ้นหน้าใหม่ แบบหน้า หน้าแรก */
	  display:block;
	  height:1px; 
	  page-break-after:avoid; 
  } 
  
  @page {
  	size: A4 landscape;
  	margin: 1%;
	margin-top:3%;
	margin-bottom:3%;
	
  }
  
  #menup1{
    display:none;
  }			 
  
}

#menup1 {
  position: fixed;
  right: 0;
  top: 10%;
  width: auto;
  height: auto;
  background-color:rgba(0,255,0,0.3);
  padding-top:5px;
  padding-bottom:5px;
  padding-left:5px;
  padding-right:5px;
  border-radius:70px;
  margin-right:25px;
  box-shadow: 5px 5px 15px 5px rgba(50, 50, 50, .5);
}


#content {
    display: table;
}

#pageFooter {
    display: table-footer-group;
}

#pageFooter:after {
    counter-increment: page;
    content: counter(page);
}

</style>

</head>

<body>
<div id="menup1">
   <a href="javascript:;" onClick="print();" title="Print Preview">
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/print-icon.png" width="59" height="59">
   </a>
</div>

<div class="book">
	 <div class="page thfont3">
     
     	<div id="hd1" class="header" style="text-align:center;">
        	<div><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png" width="50" height="45"> </div><div>สำนักงานประกันสังคม</div>
            <div>รายงานรายชื่อสถานประกอบการนิติบุคคล ขึ้นทะเบียนภายในวันที่ <?=$datesch1f?> ถึงวันที่ <?=$datesch2f?></div>
            <div><?=$ssobranch_codet?></div>
        </div>
        
   <div id="ct1" style="text-align:center; padding-top:10px;">
      <TABLE border="1" width="100%" align="left" cellpadding="6" cellspacing="0" style="border-collapse:collapse;border-top:5px double #000;" class="thfont6" >  
     	 <THEAD>
        	<TR bgcolor="#B7FFFF"> 
            	<TH>ลำดับที่</TH> 
                <TH>เลขสปส 10 หลัก</TH>
                <TH>เลขสาขา</TH>
                <TH>เลขทะเบียนพาณิชย์</TH> 
                <TH>ชื่อสถานประกอบการ</TH> 
                <TH>วันที่ขึ้นทะเบียน</TH>
                <TH>รหัสประเภทกิจการ</TH> 
                <TH>ประเภทกิจการ</TH> 
                <TH>ที่อยู่สถานประกอบการ</TH>  
                <TH>เบอร์โทรศัพท์</TH>
                <TH>อีเมล์</TH>
                <TH>จำนวนลูกจ้าง</TH>
                <TH>จำนวนเงินค่าจ้าง</TH>
                <TH>สถานะ</TH>
            </TR>
         </THEAD>
         
         <TBODY>
         	<?php
				$qcvb = new CDbCriteria( array(
					'condition' => "registerdate between :datesch1 and :datesch2 and SSO_BRAN_CODE = :ssobranch_code order by  registerdate",         
					'params'    => array(':datesch1' => "{$datesch1}", ':datesch2' => "{$datesch2}", ':ssobranch_code' => $ssobranch_code)  
				));
				$modelcropvbran = CropVBran::model()->findAll($qcvb);
				$countcvb = count($modelcropvbran);
				//echo "{$countcvb}"; 
				$numrows = 1;
				foreach ($modelcropvbran as $rows){
					$registernumber = $rows->registernumber; //เลขทะเบียนพาณิชย์
					$registerdate = $rows->registerdate; //วันที่ขึ้นทะเบียน
					$registername = $rows->registername; //ชื่อสถานประกอบการ
					$tsic = $rows->tsic; //รหัสประเภทกิจการ
					$tsicname = $rows->tsicname; //ประเภทกิจการ
					$address = $rows->address; //ที่อยู่สถานประกอบการ
					$email = $rows->email; //email
					$numofemp = $rows->numofemp; 
 					$totalsalary = $rows->totalsalary;
					$phonenumber = $rows->phonenumber; //เบอร์โทรศัพท์
					$crop_remark = $rows->crop_remark; //สถานะการขึ้นทะเบียน
					$acc_no = $rows->acc_no;
					$acc_bran = $rows->acc_bran;
					
					$rd = date_create($registerdate)->format('d');
					$rm = date_create($registerdate)->format('m');
					$ry = date_create($registerdate)->format('Y')+543;
					$rdmy = $ry . "-" . $rm . "-" . $rd;
					$registerdatef = date_create($rdmy)->format('d-m-Y');
			?>
         	<TR> 
            	<TH style="text-align:center; width:3%;"><?=$numrows?></TH> 
                <TH style="text-align:center; "><?=$acc_no?></TH>
                <TH style="text-align:center; "><?=$acc_bran?></TH>
                <TH style="text-align:center; width:5%;"><?=$registernumber?></TH> 
                <TH style="text-align:left; width:17%;"><?=$registername?></TH> 
                <TH style="text-align:center; width:7%;"><?=$registerdatef?></TH> 
                <TH style="text-align:center; width:3%;"><?=$tsic?></TH> 
                <TH style="text-align:left; width:22%;"><?=$tsicname?></TH> 
                <TH style="text-align:left; width:25%;"><?=$address?></TH> 
                <TH><?=$phonenumber?></TH>
                <TH style="text-align:left; width:7%;"><?=$email?></TH>
                <TH style="text-align:center; width:4%;"><?=$numofemp?></TH>
                <TH style="text-align:right; width:6%;"><?=$totalsalary?></TH> 
                <TH><?=$crop_remark?></TH>
            </TR>
            <?php
				//echo "{$numrows}, {$registernumber}, {$registerdate}, {$registername}, {$tsic}, {$tsicname}, {$address}, {$email}, {$phonenumber}, {$crop_remark} <br>";
		
					$numrows += 1; 
				}//foreach
			?>
         </TBODY>

	  </TABLE>
</div><!--ct1-->
	 </div><!--page-->
</div><!--book-->

</body>
</html>