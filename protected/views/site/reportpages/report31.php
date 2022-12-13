<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Test print A4</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png">

<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/js/jquery-3.2.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/jquery-ui-1.12.1/jquery-ui.css">

<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/jquery-ui-1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<style>

@import url("<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/webfonts/thcharmau/stylesheet.css");
@import url("<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/webfonts/vivak/stylesheet.css");
@import url("<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/webfonts/thsarabun/stylesheet.css");

body {
  background: rgb(204,204,204); 
  font-family:Arial, "times New Roman", tahoma;
  font-size:12px;
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
    size: A4;
    margin: 0;
}

.headTitle {
    font-size:12px;
    font-weight:bold;
    text-transform:uppercase;
}
.headerTitle01 {
    border:1px solid #333333;
    border-left:2px solid #000;
    border-bottom-width:2px;
    border-top-width:2px;
    font-size:11px;
}
.headerTitle01_r {
    border:1px solid #333333;
    border-left:2px solid #000;
    border-right:2px solid #000;
    border-bottom-width:2px;
    border-top-width:2px;
    font-size:11px;
}
/* สำหรับช่องกรอกข้อมูล  */
.box_data1 {
    font-family:Arial, "times New Roman", tahoma;
    height:18px;
    border:0px dotted #333333;
    border-bottom-width:1px;
}
/* กำหนดเส้นบรรทัดซ้าย  และด้านล่าง */
.left_bottom {
    border-left:2px solid #000;
    border-bottom:1px solid #000;
}
/* กำหนดเส้นบรรทัดซ้าย ขวา และด้านล่าง */
.left_right_bottom {
    border-left:2px solid #000;
    border-bottom:1px solid #000;
    border-right:2px solid #000;
}
/* สร้างช่องสี่เหลี่ยมสำหรับเช็คเลือก */
.chk_box {
    display:block;
    width:10px;
    height:10px;
    overflow:hidden;
    border:1px solid #000;
}

/* สร้างปุ่มพิมพ์ */
.btn_print {
	text-align:center;
	width:2cm;
	height:1cm;
}

/* รายการตัวเลือก */
#s1{
	/*text-align:center;
	padding-left:30px;*/
}

/* css ส่วนสำหรับการแบ่งหน้าข้อมูลสำหรับการพิมพ์ */
@media all
{
    .page-break { display:none; }
    .page-break-no{ display:none; }
}

@media print {
  body, page[size="A4"] {
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
  	size: A4;
  	margin: 0;
  }
  
  #bp1, #s1, #menup1{
    display:none;
  }			 
}


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

.fontcolor1{
	color:#FCB103;
	font-weight:bold;
}

input.invalid, textarea.invalid, select.invalid{
	border: 1px solid red;
}
input.valid, textarea.valid, select.valid{
	border: 1px solid green;
}


.ui-datepicker-trigger {
	 margin-left:5px;
	 /*margin-top: 8px;
	 margin-bottom: -3px;*/
	}
.mytextbox {
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

#rpttoolbar{
	height:auto;/*35px; */
	text-align:center;
	vertical-align:central;
	color:#FFF; 
	overflow: hidden;
  	background-color:#036;
  	position: fixed;
  	top: 0;
  	width: 100%;
	padding-top:5px;
	padding-bottom:5px;
	border-bottom-style:outset;
	border-bottom-width:6px;
	box-shadow: 5px 5px 15px 5px rgba(50, 50, 50, .5);
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
</style>

<script type="text/javascript">
	$(document).ready(function() {
			
		//$( "#bgdate" ).datepicker();
		//$( "#eddate" ).datepicker();
		$( "#datepicker1" ).datepicker({
			dateFormat: "dd-mm-yy"	
		});
		$( "#datepicker2" ).datepicker({
			dateFormat: "dd-mm-yy"
		});
		
		
	});
	
	
	
	function selectbrn(sv1){
		
		var data1 = "action=showrpt&slv=" + sv1;
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callsubrpt31'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#rp1").html(da);
			   
			}
		});
	}
	
function schdata1(){
	var d1 = $("#datepicker1").val();
	var d2 = $("#datepicker2").val();
	var sso1 = $("#sso1").val();
	var sso1t = $("#sso1").text();
	var bct = <?=$bct?>;
	var bc = <?=$bc?>;
	var data1 = "";
	//alert(d1 + "," + d2);
	var parts1 =d1.split('-');
	var parts2 =d2.split('-');
	//alert(parts1[0] + "," + parts1[1] + "," + parts1[2]);
	var mydate1 = new Date(parts1[2], parts1[1], parts1[0]); 
	var mydate2 = new Date(parts2[2], parts2[1], parts2[0]); 
	//console.log(mydate.toDateString());
	//alert(mydate1 + "," + mydate2);
	
	if(d1){
		if(d2){
			if(mydate1<=mydate2){
				//sso1.val("0");
				//alert(d1 + "," + d2 + "," + sso1);
				$('#rp1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
				data1 = "action=showrpt&d1=" + d1 + "&d2=" + d2 + "&sso1=" + sso1 + "&bct=" + bct + "&bc=" + bc + "&sso1t=" + sso1t;
				$.ajax({
					type: "POST", 
					url: "<?php echo Yii::app()->createAbsoluteUrl('site/callsubrpt31'); ?>",      
					data: data1,         
					success: function (da)
					{
					   $("#rp1").html(da);
					   
					}
				});
			}else{
				alert("เลือกวันที่ไม่ถูกต้อง!");
			}//d1<d2
		}else{
			alert("วันที่เป็นค่าว่างไม่ได้!");
		}//d2
	}else{
		alert("วันที่เป็นค่าว่างไม่ได้!");
	}//d1*/
}
</script>

</head>

<body>
<?php
  $now = date_create('now')->format('m/d/Y');
  $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  $daten1 = date('Y-m-d H:i:s');
  
  $dfn =date_create('01-09-2019')->format('d-m-Y');
  $dfn2 =date_create('now')->format('d-m-Y');
  
  //$startdate = $bgdatep . "T00:00:00+07:00";
  //$enddate = $eddatep . "T23:59:59+07:00";
  //echo "{$now},{$tomorrow}";
?>
	
    <div id="s1">
    
    <div id="rpttoolbar">
        <div class="thfont5">
            <div style="float:left; width:30%; padding-bottom:5px;">
            	<div style="float:left; width:40%;">จากวันที่: <input type="text" id="datepicker1" class="thfont3" style="padding-left:5px; width:90px; border-radius:5px;" value="<?=$dfn?>" readonly></div>
                <div style="float:left; width:40%;">ถึงวันที่: <input type="text" id="datepicker2" class="thfont3" style="padding-left:5px; width:90px; border-radius:5px;" value="<?=$dfn2?>" readonly></div>
                
            </div>
            <div style="float:left; width:35%;">
            	<div style="float:left; width:100%;">
                	สปส. รับผิดชอบ: <select id="sso1" onChange="javascript:schdata1();" class="thfont3" style="border-radius:5px; padding-left:5px; padding-right:5px;" <?php if($bct!='1'){ ?> disabled <?php } ?>>
                    	<option value="0" <?php if($bct=='1'){ ?> selected <?php } ?>>ทั่วประเทศ</option>
                        <option value="1050" <?php if($bct!='1' && $bc=='1050'){ ?> selected <?php } ?>>1050:สำนักบริหารเทคโนโลยีสารสนเทศ</option>
                        <?php
							$model_ssobrn = MasSsobranch::model()->findAll(array("order" => "ssobranch_code"));
							$count_of_model_ssobrn = count($model_ssobrn);
							if($count_of_model_ssobrn>0){
								foreach ($model_ssobrn as $rows){
									$ssobranch_code = $rows->ssobranch_code;
									$name = $rows->name;
									$shortname = $rows->shortname; 
									$ssobranch_type_id = $rows->ssobranch_type_id;
						?>
                        <option value="<?=$ssobranch_code?>" <?php if($bct!='1' && $bc==$ssobranch_code){ ?> selected <?php } ?>><?=$ssobranch_code?>:<?=$name?></option>
                        <?php
								}//for
							}//if
                        ?>
                    </select>
                </div>
            </div>
   			<div style="float:left; width:20%; text-align:left;"><button onClick="javascript:schdata1();" class="thfont3" style="border-radius:5px;"><i class="fa fa-search" style="color:#666;"></i> ค้นหา</button></div>
        </div>
    </div>
        
    </div><!--id s1 -->
    
    <div id="menup1">
        <a href="javascript:;" onClick="print();" title="Print Preview">
        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/print-icon.png" width="59" height="59">
        </a>
    </div>
    
    <div id="rp1"></div>
    
</body>
</html>