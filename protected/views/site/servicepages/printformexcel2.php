<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Test print A4</title>
<!--<script src="http://code.jquery.com/jquery-latest.min.js"></script>-->
<script src="jquery-latest.min.js"></script>
<style>

body {
  /*background: rgb(204,204,204); 
  font-family:Arial, "times New Roman", tahoma;
  font-size:12px;*/
}

#rp1{
	background: rgb(204,204,204);
	padding-top:5px;
	padding-bottom:5px;
	font-family:Arial, "times New Roman", tahoma;
	font-size:12px;
	overflow:scroll;
	height:600px;
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
  padding-right: 0.5cm;
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
	text-align:center;
}

/* css ส่วนสำหรับการแบ่งหน้าข้อมูลสำหรับการพิมพ์ */
@media all
{
    .page-break { display:none; }
    .page-break-no{ display:none; }
}

@media print {

  /*body * {
    visibility: hidden;
  }
  
  #tbp1 *, #section-to-print, #section-to-print * {
    visibility: visible;
  }*/
  	
  page[size="A4"] {
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
  
  #bp1, #s1{
    display:none;
  }			 
}
</style>
<?php
	$fullPathToReport = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'reportpage1.php';
?>
<script type="text/javascript">
	
/*	$(document).ready(function() {
		var data1 = "action=showrpt&slv=m0";
		$('#rp1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callsubrpt'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#rp1").html(da);
			   
			}
		});	
		//$("#rp1").load("reportpage1.php?slv=m0");
		//$("#rp1").load("<?php echo Yii::app()->createAbsoluteUrl('site/dashboards'); ?>");
	});
	
	function selectbrn(sv1){
		$("#rp1").load("reportpage1.php?slv=" + sv1 + "");
	}*/
</script>

</head>

<body>
	<div id="s1" class="thfont5">
    	<select id="ss1" onChange="javascript:selectbrn(this.value);">
          <option value="m0"><--select--></option>
          <option value="m1">listdata1</option>
          <option value="m2">listdata2</option>
          <option value="m3">listdata3</option>
          <option value="m4">listdata4</option>
        </select>
    </div>
    <br>
	<div style="text-align:center">
    <input class="btn_print thfont5" type="button" name="bp1" id="bp1" value="Print" onClick="print();">
    
    </div>
    <div id="rp1" class="">
    	<?php 
			//echo "{$fullPathToReport}";
		?>
    </div>
</body>
</html>