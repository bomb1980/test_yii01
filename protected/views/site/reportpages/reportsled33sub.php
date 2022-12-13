<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png">
<title>Sub Report 33</title>
<script>

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

.thfont3min{
	font-family: THSarabun;
	font-size: 16px;
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
<style>

body {
  background: rgb(204,204,204); 
}


page[size="A4"] {  
  background: white;
  width: 21cm;
  height: 29.7cm;
  display: block;
  border-radius: 5px;
  margin: 0 auto;
  margin-top: 0.5cm;
  margin-bottom: 0.5cm;
  padding-left: 0.5cm;
  padding-top: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}

page[size="A4"][layout="landscape"] {
  background: white;	
  width: 29.7cm;
  height: 21cm;
  display: block;
  border-radius: 5px;
  margin: 0 auto;
  margin-top: 0.5cm;
  margin-bottom: 0.5cm;
  padding-left: 0.5cm;
  padding-top: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}

page[size="A2"] {
  background: white;
  width: 21cm;
  height: 16cm;
  display: block;
  border-radius: 5px;
  margin: 0 auto;
  margin-top: 0.5cm;
  margin-bottom: 0.5cm;
  padding-left: 0.5cm;
  padding-top: 0.5cm;
}

@page {
  size: A4 portrait;
  margin: 0;
}

@media all
{
    .page-break { display:none; }
    .page-break-no{ display:none; }
}

@media print {
  body, page[size="A4"] {
    margin-bottom: 0;
	margin-top: 0;
	margin-left: 0;
	margin-right: 0;
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
  	size: A4 portrait;
  	margin: 0;
  }
  
  #bp1, #s1, #menup1{
    display:none;
  }	 
}
</style>
<style>
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
</style>
</head>

<body>
<?php
  $now = date_create('now')->format('m/d/Y H:i:s');
  $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  $daten1 = date('Y-m-d H:i:s');
  //$startdate = $bgdatep . "T00:00:00+07:00";
  //$enddate = $eddatep . "T23:59:59+07:00";
  //echo "{$now},{$tomorrow}";
  
 //เรียก service สอบถาม led**********************************************************
		$url = 'https://wsg.sso.go.th:443/v1/GdxWebServiceSam'; //'https://services.led.go.th/v1/GdxWebServiceSam'; //https://wsg.sso.go.th:443/v1/GdxWebServiceSam

		$data = json_encode(
			array(
				"username" => "SSO001",
				"password" => "",
				"type" => "DATA",
				"firstName" => "",
				"lastName" => "",
				"idCard" => "{$lrc_registernumber}",
				"reqHeader" => array( "transID" => "SSO20180620",
					"rqAppID" => "SSO",
					"transDateTimestamp" => "20180620",
					"terminalID" => "terminalID",
					"ip" => "127.0.0.1",
					"branchCode" => "001"
					)
			)
		);
		
		$arrContextOptions=array(
			"http" => array(
			  "method" => "POST",
			  "header" =>
				  //"Consumer-Key: 8400dfa3-4fe3-43b9-b830-060d948d75cf", 
				  "Content-Type: application/json; charset=utf-8;\r\n".
				  "Connection: keep-alive\r\n",
				  "ignore_errors" => true,
				  "timeout" => (float)30.0,
				  "content" => $data,
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  
		
		if($content = file_get_contents($url, false, stream_context_create($arrContextOptions))){
		
		/*echo "<pre>";
		echo "{$content} <br>";
		echo "</pre> <br>";*/
		$json = json_decode($content, true);
        foreach ($json as $key => $value) {
		  //echo "{$key} <br>";
		  if($key=='data'){
			  
			  foreach ($value[0] as $key2 => $value2) {
				  //echo "{$key2} : {$value2} <br>";
				 if($key2=='tws_id'){ $tws_id = $value2; }
				 if($key2=='recv_no') { $recv_no = $value2; } // : 2986
				 if($key2=='recv_yr') { $recv_yr = $value2; } // : 2557
				 if($key2=='df_id') { $df_id = $value2; } // : 0107537001048
				 if($key2=='df_name') { $df_name = $value2; } // : ดาต้าแมท จำกัด (มหาชน)
				 if($key2=='df_surname') { $df_surname = $value2; } // :
				 if($key2=='df_no') { $df_no = $value2; } // : 1
				 if($key2=='court_name') { $court_name = $value2; } // : ศาลล้มละลายกลาง
				 if($key2=='court_type') { $court_type = $value2; } // : 1
				 if($key2=='black_case') { $black_case = $value2; } // : ล.12950
				 if($key2=='black_yy') { $black_yy = $value2; } // : 2552
				 if($key2=='red_case') { $red_case = $value2; } // : ล.3970
				 if($key2=='red_yy') { $red_yy = $value2; } // : 2554
				 if($key2=='plaintiff1') { $plaintiff1 = $value2; } // : ธนาคารกรุงเทพ จำกัด (มหาชน)
				 if($key2=='plaintiff2') { $plaintiff2 = $value2; } // :
				 if($key2=='plaintiff3') { $plaintiff3 = $value2; } // :
				 if($key2=='defendant1') { $defendant1 = $value2; } // : บริษัท ดาต้าแมท จำกัด (มหาชน) ที่ 1
				 if($key2=='defendant2') { $defendant2 = $value2; } // : นายมนู อรดีดลเชษฐ์ ที่ 2
				 if($key2=='defendant3') { $defendant3 = $value2; } // : นายเอกชัย เกียรติชัยพานิช ที่ 3
				 if($key2=='case_capital') { $case_capital = $value2; } // : 90978054
				 if($key2=='tmp_prot_dd') { $tmp_prot_dd = $value2; } // :
				 if($key2=='tmp_prot_mm') { $tmp_prot_mm = $value2; } // :
				 if($key2=='tmp_prot_yy') { $tmp_prot_yy = $value2; } // :
				 if($key2=='tmp_gaz_dd') { $tmp_gaz_dd = $value2; } // :
				 if($key2=='tmp_gaz_mm') { $tmp_gaz_mm = $value2; } // :
				 if($key2=='tmp_gaz_yy') { $tmp_gaz_yy = $value2; } // :
				 if($key2=='tmp_gaz_book') { $tmp_gaz_book = $value2; } // :
				 if($key2=='tmp_gaz_part') { $tmp_gaz_part = $value2; } // :
				 if($key2=='tmp_gaz_page') { $tmp_gaz_page = $value2; } // :
				 if($key2=='tmp_ejc_dd') { $tmp_ejc_dd = $value2; } // :
				 if($key2=='tmp_ejc_mm') { $tmp_ejc_mm = $value2; } // :
				 if($key2=='tmp_ejc_yy') { $tmp_ejc_yy = $value2; } // :
				 if($key2=='tmp_ejc_gaz_dd') { $tmp_ejc_gaz_dd = $value2; } // :
				 if($key2=='tmp_ejc_gaz_mm') { $tmp_ejc_gaz_mm = $value2; } // :
				 if($key2=='tmp_ejc_gaz_yy') { $tmp_ejc_gaz_yy = $value2; } // :
				 if($key2=='tmp_ejc_gaz_book') { $tmp_ejc_gaz_book = $value2; } // :
				 if($key2=='tmp_ejc_gaz_part') { $tmp_ejc_gaz_part = $value2; } // :
				 if($key2=='tmp_ejc_gaz_page') { $tmp_ejc_gaz_page = $value2; } // :
				 if($key2=='abs_prot_dd') { $abs_prot_dd = $value2; } // : 04
				 if($key2=='abs_prot_mm') { $abs_prot_mm = $value2; } //: 11
				 if($key2=='abs_prot_yy') { $abs_prot_yy = $value2; } //: 2557
				 if($key2=='abs_gaz_dd') { $abs_gaz_dd = $value2; } // : 10
				 if($key2=='abs_gaz_mm') { $abs_gaz_mm = $value2; } //: 02
				 if($key2=='abs_gaz_yy') { $abs_gaz_yy = $value2; } // : 2558
				 if($key2=='abs_gaz_book') { $abs_gaz_book = $value2; } // : 132
				 if($key2=='abs_gaz_part') { $abs_gaz_part = $value2; } // : 11ง
				 if($key2=='abs_gaz_page') { $abs_gaz_page = $value2; } // : 2
				 if($key2=='abs_due_dd') { $abs_due_dd = $value2; } // : 10
				 if($key2=='abs_due_mm') { $abs_due_mm = $value2; } // : 04
				 if($key2=='abs_due_yy') { $abs_due_yy = $value2; } // : 2558
				 if($key2=='abs_req_dd') { $abs_req_dd = $value2; } // : 01
				 if($key2=='abs_req_mm') { $abs_req_mm = $value2; } // : 05
				 if($key2=='abs_req_yy') { $abs_req_yy = $value2; } // : 2558
				 if($key2=='abs_ejc_dd') { $abs_ejc_dd = $value2; } // :
				 if($key2=='abs_ejc_mm') { $abs_ejc_mm = $value2; } // :
				 if($key2=='abs_ejc_yy') { $abs_ejc_yy = $value2; } // :
				 if($key2=='abs_ejc_gaz_dd') { $abs_ejc_gaz_dd = $value2; } // :
				 if($key2=='abs_ejc_gaz_mm') { $abs_ejc_gaz_mm = $value2; } // :
				 if($key2=='abs_ejc_gaz_yy') { $abs_ejc_gaz_yy = $value2; } // :
				 if($key2=='abs_ejc_gaz_book') { $abs_ejc_gaz_book = $value2; } // :
				 if($key2=='abs_ejc_gaz_part') { $abs_ejc_gaz_part = $value2; } // :
				 if($key2=='abs_ejc_gaz_page') { $abs_ejc_gaz_page = $value2; } // :
				 if($key2=='b_cou_set_dd') { $b_cou_set_dd = $value2; } // :
				 if($key2=='b_cou_set_mm') { $b_cou_set_mm = $value2; } // :
				 if($key2=='b_cou_set_yy') { $b_cou_set_yy = $value2; } // :
				 if($key2=='b_set_gaz_dd') { $b_set_gaz_dd = $value2; } // :
				 if($key2=='b_set_gaz_mm') { $b_set_gaz_mm = $value2; } // :
				 if($key2=='b_set_gaz_yy') { $b_set_gaz_yy = $value2; } // :
				 if($key2=='b_set_gaz_book') { $b_set_gaz_book = $value2; } // :
				 if($key2=='b_set_gaz_part') { $b_set_gaz_part = $value2; } // :
				 if($key2=='b_set_gaz_page') { $b_set_gaz_page = $value2; } // :
				 if($key2=='b_can_set_dd') { $b_can_set_dd = $value2; } //:
				 if($key2=='b_can_set_mm') { $b_can_set_mm = $value2; } // :
				 if($key2=='b_can_set_yy') { $b_can_set_yy = $value2; } // :
				 if($key2=='b_can_gaz_dd') { $b_can_gaz_dd = $value2; } // :
				 if($key2=='b_can_gaz_mm') { $b_can_gaz_mm = $value2; } // :
				 if($key2=='b_can_gaz_yy') { $b_can_gaz_yy = $value2; } // :
				 if($key2=='b_can_gaz_book') { $b_can_gaz_book = $value2; } // :
				 if($key2=='b_can_gaz_part') { $b_can_gaz_part = $value2; } // :
				 if($key2=='b_can_gaz_page') { $b_can_gaz_page = $value2; } // :
				 if($key2=='bkr_prot_dd') { $bkr_prot_dd = $value2; } // : 01
				 if($key2=='bkr_prot_mm') { $bkr_prot_mm = $value2; } // : 09
				 if($key2=='bkr_prot_yy') { $bkr_prot_yy = $value2; } // : 2558
				 if($key2=='bkr_gaz_dd') { $bkr_gaz_dd = $value2; } // : 02
				 if($key2=='bkr_gaz_mm') { $bkr_gaz_mm = $value2; } // : 02
				 if($key2=='bkr_gaz_yy') { $bkr_gaz_yy = $value2; } // : 2559
				 if($key2=='bkr_gaz_book') { $bkr_gaz_book = $value2; } // : 133
				 if($key2=='bkr_gaz_part') { $bkr_gaz_part = $value2; } // : 9ง
				 if($key2=='bkr_gaz_page') { $bkr_gaz_page = $value2; } // : 226
				 if($key2=='a_cou_set_dd') { $a_cou_set_dd = $value2; } // :
				 if($key2=='a_cou_set_mm') { $a_cou_set_mm = $value2; } // :
				 if($key2=='a_cou_set_yy') { $a_cou_set_yy = $value2; } // :
				 if($key2=='a_set_gaz_dd') { $a_set_gaz_dd = $value2; } // :
				 if($key2=='a_set_gaz_mm') { $a_set_gaz_mm = $value2; } // :
				 if($key2=='a_set_gaz_yy') { $a_set_gaz_yy = $value2; } //:
				 if($key2=='a_set_gaz_book') { $a_set_gaz_book = $value2; } // :
				 if($key2=='a_set_gaz_part') { $a_set_gaz_part = $value2; } // :
				 if($key2=='a_set_gaz_page') { $a_set_gaz_page = $value2; } // :
				 if($key2=='a_can_set_dd') { $a_can_set_dd = $value2; } // :
				 if($key2=='a_can_set_mm') { $a_can_set_mm = $value2; } // :
				 if($key2=='a_can_set_yy') { $a_can_set_yy = $value2; } // :
				 if($key2=='a_can_gaz_dd') { $a_can_gaz_dd = $value2; } // :
				 if($key2=='a_can_gaz_mm') { $a_can_gaz_mm = $value2; } // :
				 if($key2=='a_can_gaz_yy') { $a_can_gaz_yy = $value2; } // :
				 if($key2=='a_can_gaz_book') { $a_can_gaz_book = $value2; } // :
				 if($key2=='a_can_gaz_part') { $a_can_gaz_part = $value2; } // :
				 if($key2=='a_can_gaz_page') { $a_can_gaz_page = $value2; } // :
				 if($key2=='a_due_set_dd') { $a_due_set_dd = $value2; } // :
				 if($key2=='a_due_set_mm') { $a_due_set_mm = $value2; } // :
				 if($key2=='a_due_set_yy') { $a_due_set_yy = $value2; } // :
				 if($key2=='c_bkr_dd') { $c_bkr_dd = $value2; } // :
				 if($key2=='c_bkr_mm') { $c_bkr_mm = $value2; } // :
				 if($key2=='c_bkr_yy') { $c_bkr_mm = $value2; } //:
				 if($key2=='c_gaz_dd') { $c_gaz_dd = $value2; } // :
				 if($key2=='c_gaz_mm') { $c_gaz_mm = $value2; } // :
				 if($key2=='c_gaz_yy') { $c_gaz_yy = $value2; } // :
				 if($key2=='c_gaz_book') { $c_gaz_book = $value2; } // :
				 if($key2=='c_gaz_part') { $c_gaz_part = $value2; } // :
				 if($key2=='c_gaz_page') { $c_gaz_page = $value2; } // :
				 if($key2=='r_bkr_dd') { $r_bkr_dd = $value2; } // :
				 if($key2=='r_bkr_mm') { $r_bkr_mm = $value2; } // :
				 if($key2=='r_bkr_yy') { $r_bkr_yy = $value2; } // :
				 if($key2=='r_gaz_dd') { $r_gaz_dd = $value2; } // :
				 if($key2=='r_gaz_mm') { $r_gaz_mm = $value2; } // :
				 if($key2=='r_gaz_yy') { $r_gaz_yy = $value2; } // :
				 if($key2=='r_gaz_book') { $r_gaz_book = $value2; } // :
				 if($key2=='r_gaz_part') { $r_gaz_part = $value2; } // :
				 if($key2=='r_gaz_page') { $r_gaz_page = $value2; } // :
				 if($key2=='df_expire_dd') { $df_expire_dd = $value2; } // :
				 if($key2=='df_expire_mm') { $df_expire_mm = $value2; } // :
				 if($key2=='df_expire_yy') { $df_expire_yy = $value2; } // :
				 if($key2=='df_manage_dd') { $df_manage_dd = $value2; } // :
				 if($key2=='df_manage_mm') { $df_manage_mm = $value2; } // :
				 if($key2=='df_manage_yy') { $df_manage_yy = $value2; } // :
				 if($key2=='df_manage_ejc_dd') { $df_manage_ejc_dd = $value2; } // :
				 if($key2=='df_manage_ejc_mm') { $df_manage_ejc_mm = $value2; } // :
				 if($key2=='df_manage_ejc_yy') { $df_manage_ejc_yy = $value2; } // :
				 if($key2=='re_bkr_dd') { $re_bkr_dd = $value2; } // :
				 if($key2=='re_bkr_mm') { $re_bkr_mm = $value2; } // :
				 if($key2=='re_bkr_yy') { $re_bkr_yy = $value2; } // :
				 if($key2=='uacc_dd') { $uacc_dd = $value2; } // :
				 if($key2=='uacc_mm') { $uacc_mm = $value2; } // :
				 if($key2=='uacc_yy') { $uacc_yy = $value2; } // :
				 if($key2=='s_bkr_dd') { $s_bkr_dd = $value2; } // :
				 if($key2=='s_bkr_mm') { $s_bkr_mm = $value2; } // :
				 if($key2=='s_bkr_yy') { $s_bkr_yy = $value2; } // :
				 if($key2=='close_dd') { $close_dd = $value2; } // :
				 if($key2=='close_mm') { $close_mm = $value2; } // :
				 if($key2=='close_yy') { $close_yy = $value2; } // :
				 if($key2=='req_dd') { $req_dd = $value2; } // : 08
				 if($key2=='req_mm') { $req_mm = $value2; } // : 09
				 if($key2=='req_yy') { $req_yy = $value2; } // : 2552
				 if($key2=='oth_dd') { $oth_dd = $value2; } // :
				 if($key2=='oth_mm') { $oth_mm = $value2; } // :
				 if($key2=='oth_yy') { $oth_yy = $value2; } // :
				 if($key2=='remark') { $remark = $value2; } // :
				 if($key2=='corrupt') { $corrupt = $value2; } // :
				 if($key2=='lastupdate') { $lastupdate = $value2; } // : 2018-05-23
			  }//if
			 
		//*******************************************************************************
	
?>

<div class=Section1></div>
<!--<page size="A4" layout="portrait">A4 portrait</page>-->
<page size="A4">
	<table id="tbp1" width="750" border="0" align="center" cellpadding="0" cellspacing="0" >
    	<tr>
    		<td align="right" style="text-align:right;" class="thfont3min">วันที่ออกรายงาน <?php echo " {$now} "; ?></td>
 		</tr>
        <tr>
        	<td align="center" class="headTitle thfont3">
            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png" width="50" height="45"><br />
               <b> สำนักงานประกันสังคม </b> <br />
               <b> รายงานสถานประกอบการ ที่เคยถูกศาลมีคำสั่งพิทักษ์ทรัพย์ </b><br />
            </td>
        </tr>
        <tr>
        	<td  class="thfont3">
            	<div style="font-size:19px;">
                	<br>
                	<div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่</b> <?=date("d/m/Y")?> &nbsp;&nbsp;&nbsp; <b>เวลา</b> <?=date("H.i")?> น.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>จำเลย</b> : <?=$df_name?>&nbsp;&nbsp;<?=$df_surname?> &nbsp;&nbsp;&nbsp; <b>หมายเลขบัตรประชาขน / ทะเบียนนิติบุคคล</b> : <?=$df_id?></div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>เลขบัญชีนายจ้าง ประกันสังคม</b> : <?=$lrc_accno?> &nbsp;&nbsp;&nbsp; </div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>เรื่องที่</b> : <?=$recv_no?>/<?=$recv_yr?> &nbsp;&nbsp;&nbsp;&nbsp; <?=$court_name?></div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>คดีหมายเลขดำที่</b> : &nbsp;&nbsp; <?=$black_case?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>คดีหมายเลขแดงที่</b> : &nbsp;&nbsp; <?=$red_case?></div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>โดยโจทก์</b> : &nbsp;&nbsp; <?=$plaintiff1?></div>
                    <br>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่พิทักษ์ทรัพย์ชั่วคราว</b> <?php if($tmp_prot_dd){ ?><?=$tmp_prot_dd?>/<?=$tmp_prot_mm?>/<?=$tmp_prot_yy?> <?php }else{ echo "-"; } ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>วันที่ถอนพิทักษ์ทรัพย์ชั่วคราว</b> <?php if($tmp_ejc_dd){ ?><?=$tmp_ejc_dd?>/<?=$tmp_ejc_mm?>/<?=$tmp_ejc_yy?>  <?php }else{ echo "-"; } ?></div>
                     <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่พิทักษ์ทรัพย์เด็ดขาด</b> &nbsp;&nbsp; <?php if($abs_prot_dd){ ?><?=$abs_prot_dd?>/<?=$abs_prot_mm?>/<?=$abs_prot_yy?><?php }else{ echo "-"; } ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>ราชกิจจาเล่มที่</b>&nbsp;&nbsp;&nbsp; <?php if($abs_gaz_book){ ?> <?=$abs_gaz_book?> <?php }else{ echo "-"; } ?> <b>ตอนที่</b> &nbsp;&nbsp; <?php if($abs_gaz_part){ ?><?=$abs_gaz_part?> <?php }else{ echo "-"; } ?> <b>หน้าที่</b>&nbsp;&nbsp; <?php if($abs_gaz_page){ ?> <?=$abs_gaz_page?> <?php }else{ echo "-"; } ?> <b>ลงวันที่</b> &nbsp;&nbsp; <?php if($abs_gaz_dd){ ?><?=$abs_gaz_dd?>/<?=$abs_gaz_mm?>/<?=$abs_gaz_yy?> <?php }else{ echo "-"; } ?></div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่ถอนพิทักษ์ทรัพย์เด็ดขาด</b> <?php if($abs_ejc_dd){ ?> <?=$abs_ejc_dd?>/<?=$abs_ejc_mm?>/<?=$abs_ejc_dd?> <?php }else{ echo "-"; } ?>  </div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่ประนอมหนี้ก่อนล้มละลาย</b> <?php if($b_cou_set_dd){ ?><?=$b_cou_set_dd?>/<?=$b_cou_set_mm?>/<?=$b_cou_set_yy?> <?php }else{ echo "-"; } ?> </div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่ยกเลิกประนอมหนี้ก่อนล้มฯและพิพากษาให้ล้มละลาย</b> <?php if($b_can_set_dd){ ?><?=$b_can_set_dd?>/<?=$b_can_set_mm?>/<?=$b_can_set_yy?> <?php }else{ echo "-"; } ?> </div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่ประนอมหนี้หลังล้มละลาย</b> <?php if($a_cou_set_dd){ ?><?=$a_cou_set_dd?>/<?=$a_cou_set_mm?>/<?=$a_cou_set_yy?> <?php }else{ echo "-"; } ?> </div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่ยกเลิกประนอมหนี้หลังล้มฯและพิพากษาให้ล้มละลาย</b> <?php if($a_can_set_dd){ ?><?=$a_can_set_dd?>/<?=$a_can_set_mm?>/<?=$a_can_set_yy?> <?php }else{ echo "-"; } ?> </div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่พิพากษาให้ล้มละลาย</b> &nbsp;&nbsp; <?php if($bkr_prot_dd){ ?><?=$bkr_prot_dd?>/<?=$bkr_prot_mm?>/<?=$bkr_prot_yy?> <?php }else{ echo "-"; } ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>ราชกิจจาเล่มที่</b> &nbsp;&nbsp;&nbsp; <?php if($bkr_gaz_book){ ?><?=$bkr_gaz_book?> <?php }else{ echo "-"; } ?> <b>ตอนที่</b> &nbsp;&nbsp; <?php if($bkr_gaz_part){ ?><?=$bkr_gaz_part?>  <?php }else{ echo "-"; } ?> <b>หน้าที่ </b>&nbsp;&nbsp; <?php if($bkr_gaz_page){ ?><?=$bkr_gaz_page?> <?php }else{ echo "-"; } ?> <b>ลงวันที่</b> &nbsp;&nbsp; <?php if($bkr_gaz_dd){ ?><?=$bkr_gaz_dd?>/<?=$bkr_gaz_mm?>/<?=$bkr_gaz_yy?> <?php }else{ echo "-"; } ?></div>
                    
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่ยกเลิกการล้มละลาย</b> <?php if($c_bkr_dd){ ?><?=$c_bkr_dd?>/<?=$c_bkr_dd?>/<?=$c_bkr_dd?> <?php }else{ echo "-"; } ?> </div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่ศาลสั่งให้จัดการทรัพย์มรดก</b> <?php if($df_manage_dd){ ?><?=$df_manage_dd?>/<?=$df_manage_mm?>/<?=$df_manage_yy?> <?php }else{ echo "-"; } ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>วันที่ยกเลิกจัดการทรัพย์มรดก</b> <?php if($df_manage_ejc_dd){ ?><?=$df_manage_ejc_dd?>/<?=$df_manage_ejc_mm?>/<?=$df_manage_ejc_yy?>  <?php }else{ echo "-"; } ?></div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่พิจารณาคดีใหม่</b> <?php if($re_bkr_dd){ ?><?=$re_bkr_dd?>/<?=$re_bkr_mm?>/<?=$re_bkr_yy?> <?php }else{ echo "-"; } ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>วันที่ยกฟ้อง</b> <?php if($uacc_dd){ ?><?=$uacc_dd?>/<?=$uacc_mm?>/<?=$uacc_yy?> <?php }else{ echo "-"; } ?></div>
                    <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่จำหน่ายคดี่</b> <?php if($s_bkr_dd){ ?><?=$s_bkr_dd?>/<?=$s_bkr_mm?>/<?=$s_bkr_yy?> <?php }else{ echo "-"; } ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>วันที่ปลดการล้มละลาย</b> <?php if($r_bkr_dd){ ?><?=$r_bkr_dd?>/<?=$r_bkr_mm?>/<?=$r_bkr_yy?> <?php }else{ echo "-"; } ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>วันที่ปิดคดี</b> <?php if($close_dd){ ?><?=$close_dd?>/<?=$close_mm?>/<?=$close_yy?> <?php }else{ echo "-"; } ?></div>
                     <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>วันที่ลูกหนี้พ้นจากการเป็นบุคคลล้มละลาย</b> <?php if($oth_dd){ ?><?=$oth_dd?>/<?=$oth_mm?>/<?=$oth_yy?> <?php }else{ echo "-"; } ?> </div>
                     <div class="row">
                     	<div class="col-md-12 col-lg-12">
                        	<br><br><br>
                        </div>
                     </div> 
                      
                     <div style="text-align:left; margin-bottom:5px;"><b>หมายเหตุ : </b></div> 
                     <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; อ้างอิงข้อมูล จาก กรมบังคับคดี LED โดยเรียกใช้้อมูลผ่าน บริการ Web Service </div>
                     <div class="row">
                     	<div class="col-md-12 col-lg-12">
                        	<br>
                        </div>
                     </div> 
                     <div style="text-align:left; margin-bottom:5px;"><b>ผู้พิมพ์รายงาน : </b></div> 
                     <div style="text-align:left; margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$usrprint?> </div>
                     
                </div>
            </td>
        </tr>
    </table>
</page>

<div id="menup1">
    <a href="javascript:;" onClick="print();" title="Print Preview">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/print-icon.png" width="59" height="59">
    </a>
</div>


<?php
 			}//foreach
		  }//if
		}//foreach
?>    
</body>
</html>
