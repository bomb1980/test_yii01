<?php
	$ssobranch_code = $ssobranch_code;
	//$d1 = $d1;
	//$d2 = $d2;
	$ssobranch_codet = $ssobranch_codet;
	
	//$datesch1 = date_create($d1)->format('Y-m-d');
	//$datesch2 = date_create($d2)->format('Y-m-d');
	
	//$datesch1f = date_create($d1)->format('d/m/Y');
	//$datesch2f = date_create($d2)->format('d/m/Y');
	
	$this->pageTitle='report - ' . $ssobranch_codet;
	
	//echo "{$ssobranch_code}, {$ssobranch_codet} "; exit;
	
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
<style>
.tablerpt32 th {
	background-color:#93DAFF;
	color:#000000
}
.tablerpt32 tr:nth-child(odd){
	background-color:#dbf2fe;
}
.tablerpt32 tr:nth-child(even){
	background-color:#fdfdfd;
}

@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	.tablerpt32 table, .tablerpt32 thead, .tablerpt32 tbody, .tablerpt32 th, .tablerpt32 td, .tablerpt32 tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	.tablerpt32 thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	.tablerpt32 tr { border: 1px solid #ccc; }
	
	.tablerpt32 td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	.tablerpt32 td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	.tablerpt32 button{
		width:80%;
		height:100%;
	}
	
	/*
	Label the data
	*/
	.tablerpt32 td:nth-of-type(1):before { content: ""; }
	.tablerpt32 td:nth-of-type(2):before { content: ""; }
	.tablerpt32 td:nth-of-type(3):before { content: ""; }
	.tablerpt32 td:nth-of-type(4):before { content: ""; }
	.tablerpt32 td:nth-of-type(5):before { content: ""; }
	.tablerpt32 td:nth-of-type(5):after { content: "";}
	.tablerpt32 td:nth-of-type(6):before { content: ""; }
	.tablerpt32 td:nth-of-type(6):after { content: "";}
	
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
            <div>รายงานรายชื่อสถานประกอบการถูกฟ้องล้มละลาย</div>
            <div><?=$ssobranch_codet?></div>
        </div>
        
   <div id="ct1" style="text-align:center; padding-top:10px;">
      <TABLE border="1" width="100%" align="left" cellpadding="6" cellspacing="0" style="border-collapse:collapse;border-top:5px double #000;" class="thfont6 tablerpt32" >  
     	 <THEAD>
        	<TR bgcolor="#0FFF87"> 
            	<TH>ลำดับที่</TH> 
                <TH>เลขประกันสังคม 10 หลัก</TH>
                <TH>เลขสาขา 6 หลัก</TH>
                <TH>เลขทะเบียนพาณิชย์</TH> 
                <TH>ชื่อสถานประกอบการ</TH> 
                <TH>ที่อยู่สถานประกอบการ</TH>   
                <TH>วันที่พิทักษ์ทรัพย์เด็ดขาด</TH>
                <TH>วันที่ประกาศราชกิจจาฯ</TH> 
                <TH>วันที่ครบกำหนดยื่นคำขอรับชำระหนี้</TH> 
                <TH>วันที่พิพากษาล้มละลาย</TH>
                
                <TH>วันที่อัพเดทล่าสุด</TH>
                <!--<TH>จำนวนเงินค่าจ้าง</TH>
                <TH>สถานะ</TH>-->
            </TR>
         </THEAD>
         
         <TBODY>
         	<?php
				$qcvb = new CDbCriteria( array(
					'condition' => "lrc_ssocode1 =:lrc_ssocode1 AND lrc_status =:lrc_status order by  lrc_ssocode1",         
					'params'    => array(':lrc_ssocode1' => "{$ssobranch_code}", ':lrc_status' => 2)  
				));
				$modelcropvbran = Ledriskcrop2Tb::model()->findAll($qcvb);
				$countcvb = count($modelcropvbran);
				//echo "{$countcvb}"; 
				$numrows = 1;
				foreach ($modelcropvbran as $rows){
					
					
					 $lrc_accno = $rows->lrc_accno;
					 $lrc_bran = $rows->lrc_bran;
					 $lrc_registernumber = $rows->lrc_registernumber;
					 $lrc_registername = $rows->lrc_registername;
					 $lrc_ssocode1 = $rows->lrc_ssocode1;
					 $lrc_ssocode2 = $rows->lrc_ssocode2;
					 $lrc_address = $rows->lrc_address;
					 $lrc_amphur = $rows->lrc_amphur;
					 $lrc_province = $rows->lrc_province;
					 $lrc_zipcode = $rows->lrc_zipcode;
					 $lrc_createby = $rows->lrc_createby;
					 $lrc_created = $rows->lrc_created;
					 $lrc_updateby = $rows->lrc_updateby;
					 $lrc_modified = $rows->lrc_modified;
					 $lrc_remark = $rows->lrc_remark;
					 $lrc_status = $rows->lrc_status;
					 $lrpt_abs_prot = $rows->lrpt_abs_prot;
					 $lrpt_abs_gaz = $rows->lrpt_abs_gaz;
					 $lrpt_abs_due = $rows->lrpt_abs_due;
					 $lrpt_bkr_prot = $rows->lrpt_bkr_prot;
					 $lrpt_req = $rows->lrpt_req;
					 $lrpt_lastupdate = $rows->lrpt_lastupdate;
					 $lrpt_df_id = $rows->lrpt_df_id;
					 $lrpt_df_name = $rows->lrpt_df_name;
					 $lrpt_df_surname = $rows->lrpt_df_surname;
					 
					 $address = $lrc_address . " " . $lrc_amphur . " " . $lrc_province . " " . $lrc_zipcode;
					
					/*$registernumber = $rows->registernumber; //เลขทะเบียนพาณิชย์
					$registerdate = $rows->registerdate; //วันที่ขึ้นทะเบียน
					$registername = $rows->registername; //ชื่อสถานประกอบการ
					$tsic = $rows->tsic; //รหัสประเภทกิจการ
					$tsicname = $rows->tsicname; //ประเภทกิจการ
					$address = $rows->address; //ที่อยู่สถานประกอบการ
					$email = $rows->email; //email
					$numofemp = $rows->numofemp; 
 					$totalsalary = $rows->totalsalary;
					$phonenumber = $rows->phonenumber; //เบอร์โทรศัพท์
					$crop_remark = $rows->crop_remark; //สถานะการขึ้นทะเบียน*/
					
					/*if($email=='-'){//ค้นหา email
						$model2 = EmpstateTb::model()->findAllByAttributes(array('ems_registernumber'=>$registernumber));
						$cm2 = count($model2);
						if($cm2>0){
							foreach ($model2 as $rows2){
								$email = $rows2->ems_email;
							}
						}else{
							$email = '-';
						}
					}*/
					
					//$registerdatef = date_create($registerdate)->format('d-m-Y');
			?>
         	<TR> 
            	<TD style="text-align:center;"><?=$numrows?></TD> 
                <TD><?=$lrc_accno?></TD>
                <TD><?=$lrc_bran?></TD>
                <TD style="text-align:center;"><?=$lrc_registernumber?></TD> 
                <TD style="text-align:left;"><?=$lrc_registername?></TD>
                <TD style="text-align:left;"><?=$address?></TD> 
                <TD style="text-align:center; width:6%;"><?=$lrpt_abs_prot?></TD> 
                <TD style="text-align:center; width:6%;"><?=$lrpt_abs_gaz?></TD> 
                <TD style="text-align:center; width:6%;"><?=$lrpt_abs_due?></TD>
                <TD style="text-align:center; width:6%;"><?=$lrpt_bkr_prot?></TD>
                <TD style="text-align:center; width:6%;"><?=$lrpt_lastupdate?></TD>
                
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