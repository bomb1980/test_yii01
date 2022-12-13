<?php	
set_time_limit(0);
ini_set("max_execution_time","0");
ini_set("memory_limit","9999M"); 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Data Cleansing</title>


<script>
$(document).ready(function() {
	$( "#bgdate" ).datepicker();
	$( "#eddate" ).datepicker();
	$( "#sapiensdate" ).datepicker();
		//dateFormat: "dd-mm-yy"
	//});	
	
	
	$('.panel').lobiPanel({
       		reload: false,
    		close: false,
    		editTitle: false
			//minimize: false
	});
	
	opensv(1);
	
});


function chkaccno(){
	var bgdate = $("#bgdate").val();
	var eddate = $("#eddate").val();
	var fntxt1 = $("#txt1").val(); 
	
	if($('#newdata').is(':checked')){
		newda = $("#newdata").val();
	}else{
		newda = 0;	
	}
	
	if($('#upddata').is(':checked')){
		upda = $("#upddata").val();
	}else{
		upda = 0;	
	}
	if(!bgdate){
		BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
		$("#eddate").val("");
		$("#bgdate").focus();
		$("#bgdate").select();
	}else
	if(bgdate > eddate){
		BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
		$("#eddate").val("");
		$("#eddate").focus();
		$("#eddate").select();	
	}else{
		//send ajax function
		$("#rowresult1").show();
		ajaxsendparams5(bgdate,eddate,newda,upda,fntxt1);

	}
	
function ajaxsendparams5(bgdatep,eddatep,newdap,updap,fntxt1){

	var data1 = 'bgdatep=' + bgdatep + '&eddatep=' + eddatep + '&newdap=' + newdap + '&updap=' + updap + "&fntxt1=" + fntxt1;
	//alert(data1);
	$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	$.ajax({
		type: "POST", 
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/calldbdservice5'); ?>",      
		data: data1,         
		success: function (da)
		{
		   $("#re1").html(da);
		   
		}
	});
}
		
}

function setenddate(){
	$("#eddate").focus();
	$("#eddate").val($("#bgdate").val());
}

var dilgfn = "";

function showalltextfile(){
	var fns = $("#txt1").val();
	var action = "showfilename";
	//alert(fns);	
	var data1 = 'action=' + action + '&fns=' + fns;
	//open dialog show textfile all
	dilgfn = new BootstrapDialog({
		type: BootstrapDialog.TYPE_WARNING,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<i class='fa fa-file'></i><font class='thfont5'> เลือก textfile จาก sapains </font>",
		message: $('<div></div>').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading..."),
		message: $('<div class="thfont5"></div>').load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/getfilenameall') ."'" ; ?>, { action: action, fns: fns  }),
		draggable: true,
		closable: true,	
		closeByBackdrop: false,
		closeByKeyboard: false,
		buttons: [{
			id: 'btn0',
			label: "<i class='fa fa-window-close'></i><font class='thfont5'> ปิด</font>",
			cssClass: 'btn-secondary',
			action: function(dialogItself){			
				dialogItself.close();
			}
		/*},{
			id: 'btn1',
			label: "<i class='fa fa-check'></i>&nbsp;<font class='thfont5'> เลือก</font>",
			cssClass: 'btn-primary',
			//hotkey: 13, //enter
			action: function(dialogItself){
				//aust3.close();
				/*r1 = chkdatabefore();
				if(r1==0){
					var d1 = $("#dateemp").val();
					var d2 = $("#emailcorp").val();
					var numemp1 = $("#numemp1").val();
					var numemp2 = $("#numemp2").val();
					ajaxupdatestatus1sp(action,crop_id,registernumber,d1,d2,accno,accbranch,numemp1,numemp2);
				}else{
					//
				}
			}*/
		}]
		
	});
	dilgfn.open();
}
</script>

<script>
	function opensv(snum){
		var bgdate = "-";
		var eddate = "-";
		var tfn = "-";
		var data1 = 'snum=' + snum;
		if(snum===1){
			$("#hdt1").html(" WPD : Textfile");
			$("#r1").show();
			$("#r2").hide();
			$("#r3").hide();
			$("#r4").hide();
			
			$("#re2").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			
			$("#re2").load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/gentxtfilewpd') ."'" ; ?>, { bgdate: bgdate, eddate: eddate });
			
		}else if(snum===2){
			$("#hdt1").html(" SAPAINS : Textfile");
			$("#r1").hide();
			$("#r2").show();
			$("#r3").hide();
			$("#r4").hide();
			
			$("#re3").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$("#re3").load("<?php echo Yii::app()->createAbsoluteUrl('site/getfilenamesapains'); ?>");
			
			$("#re4").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$("#re4").load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/gentxtfilesapeains') ."'" ; ?>, { tfn: tfn });
			
			
		}else if(snum===3){
			$("#hdt1").html(" DATA CEANSING");
			$("#r1").hide();
			$("#r2").hide();
			$("#r3").show();
			$("#r4").hide();
			
			$("#pl02").html("");
			
			//$("#re5").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			
			//$("#re6").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			
		}else if(snum===4){
			$("#hdt1").html(" DATA CEANSING STEP3");
			$("#r1").hide();
			$("#r2").hide();
			$("#r3").hide();
			$("#r4").show();
		}//if
		
		//$("#re1").html(snum);
		/*var data1 = 'snum=' + snum;
		$.ajax({
        	type: "POST", 
        	url: "<?php //echo Yii::app()->createAbsoluteUrl('site/opensearch'); ?>",      
        	data: data1,         
        	success: function (da)
        	{
           		if(da=='Y'){
					$("#a2").html(da);
				}else{
					$("#a2").html(da);
				}
        	}
    	});     
		window.scrollTo(500, 0); 	*/
	}//function
	
	function selectdatawpd(){
		var bgdate = $("#bgdate").val();
		var eddate = $("#eddate").val();
		if(!bgdate){
			BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
			$("#eddate").val("");
			$("#bgdate").focus();
			$("#bgdate").select();
		}else
		if(bgdate > eddate){
			BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
			$("#eddate").val("");
			$("#eddate").focus();
			$("#eddate").select();	
		}else{
			//alert(bgdate + ',' + eddate);
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			ajaxselectdatawpd(bgdate,eddate);
		}//if
	}//function
	
	function ajaxselectdatawpd(bgdate,eddate){
		//alert(bgdate + ',' + eddate);	
		var data1 = 'bgdate=' + bgdate + '&eddate=' + eddate;
		//$("#re1").html(data1);
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/wpdfortxtfile'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			}
		});
	}//function
	
	function gentextfilewpd(){
		var bgdate = $("#bgdate").val();
		var eddate = $("#eddate").val();
		//alert(bgdate + "," + eddate);
		if(!bgdate){
			BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
			$("#eddate").val("");
			$("#bgdate").focus();
			$("#bgdate").select();
		}else
		if(bgdate > eddate){
			BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
			$("#eddate").val("");
			$("#eddate").focus();
			$("#eddate").select();	
		}else{
			//alert(bgdate + ',' + eddate);
			$('#re2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			ajaxgentxtfilewpd(bgdate,eddate);
		}//if
	}//function
	
	function ajaxgentxtfilewpd(bgdate,eddate){
		//$("#re2").html(bgdate + "," + eddate);
		var data1 = 'bgdate=' + bgdate + '&eddate=' + eddate;
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/gentxtfilewpd'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re2").html(da);
			}
		});
	}//function
	
function downloadtxtfile(){	
	var dwntxt = $("#txt1").val();
	var data1 = 'action=downloadfile&dwntxt=' + dwntxt;
	//alert(data1);
	$('#re3').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/downloadtxtfilefrmsftp'); ?>",      
		data: data1,         
		success: function (da)
		{
		   BootstrapDialog.alert(" <font class='thfont5'>" + da + "</font>");	
		   //$("#re3").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		   $("#re3").load("<?php echo Yii::app()->createAbsoluteUrl('site/getfilenamesapains'); ?>");
		}
	});
	
}//function

function cleansingdata1(){
	var wpdtxt = $("#txtwpd1").val();
	var sapeinstxt = $("#txtsapains1").val();
	if(wpdtxt){
		if(sapeinstxt){
			$("#pl02").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-09.gif' height='30' width='30' />");
			var data1 = 'action=cleansingfile&wpdtxt=' + wpdtxt + '&sapeinstxt=' + sapeinstxt;
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/cleansingdata1'); ?>",
				data: data1,
				success: function (da)
				{
					BootstrapDialog.alert(" <font class='thfont5'>" + da + "</font>");
				}
			});	
		}else{//if
			BootstrapDialog.alert(" <font class='thfont5'>กรุณา เลือกไฟล์ sapeins ที่ต้องการทำ Cleansing</font>");
		}//if
	}else{//if
		BootstrapDialog.alert(" <font class='thfont5'>กรุณา เลือกไฟล์ wpd ที่ต้องการทำ Cleansing</font>");
	}//if
}//function

var dilgfn2 = "";
function showwpdf(){
	var action = "showfilenamewpd";
	var data1 = 'action=' + action;
	dilgfn2 = new BootstrapDialog({
		type: BootstrapDialog.TYPE_SUCCESS,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<i class='fa fa-file'></i><font class='thfont5'> TEXTFILE WPD </font>",
		message: $('<div></div>').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-09.gif' height='30' width='30' /> <br> Loading..."),
		message: $('<div class="thfont5"></div>').load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/getfilenamewpd') ."'" ; ?>, { action: action}),
		draggable: true,
		closable: true,	
		closeByBackdrop: false,
		closeByKeyboard: false,
		buttons: [{
			id: 'btn0',
			label: "<i class='fa fa-window-close'></i><font class='thfont5'> ปิด</font>",
			cssClass: 'btn-secondary',
			action: function(dialogItself){			
				dialogItself.close();
			}
		}]
	});
	dilgfn2.open();
}//function

var dilgfn3 = "";
function showsapeainsf(){
	var action = "showfilenamewpd";
	var data1 = 'action=' + action;
	dilgfn3 = new BootstrapDialog({
		type: BootstrapDialog.TYPE_DANGER,
		//size: BootstrapDialog.SIZE_WIDE,
		title: "<i class='fa fa-file'></i><font class='thfont5'> TEXTFILE SAPEAINS </font>",
		message: $('<div></div>').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-09.gif' height='30' width='30' /> <br> Loading..."),
		message: $('<div class="thfont5"></div>').load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/getfilenamesapeains') ."'" ; ?>, { action: action}),
		draggable: true,
		closable: true,	
		closeByBackdrop: false,
		closeByKeyboard: false,
		buttons: [{
			id: 'btn0',
			label: "<i class='fa fa-window-close'></i><font class='thfont5'> ปิด</font>",
			cssClass: 'btn-secondary',
			action: function(dialogItself){			
				dialogItself.close();
			}
		}]
	});
	dilgfn3.open();
}//function

function updatecleansingdata(){
	var clstxt = $("#txtwpd1").val();	
	if(clstxt){
		$("#re7").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		var data1 = 'action=cleansingfile&clstxt=' + clstxt;
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/updatecleansingdata'); ?>",
			data: data1,
			success: function (da)
			{
				//BootstrapDialog.alert(" <font class='thfont5'>" + da + "</font>");
				$("#re7").html(da);
			}
		});	
	}else{//if
		BootstrapDialog.alert(" <font class='thfont5'>กรุณา เลือกไฟล์ที่ต้องการทำ Cleansing</font>");
	}//if
}

function selectdatasapiens(){
	var sapiensdate = $("#sapiensdate").val();
	if(!sapiensdate){
		BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
		$("#sapiensdate").val("");
		$("#sapiensdate").focus();
		$("#sapiensdate").select();	
	}else{
		$('#resapiens').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		var data1 = 'action=schdatasapiens&schdate=' + sapiensdate;
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/schsapiensdataforclensing'); ?>",
			data: data1,
			success: function (da)
			{
				//BootstrapDialog.alert(" <font class='thfont5'>" + da + "</font>");
				$("#resapiens").html(da);
			}
		});	
	}//if
}//function

	
</script>

<style>
.rcorners {
  border-radius: 10px;
  border: 1px solid #666;
  padding: 5px;
  margin-bottom: 5px;
}
.ui-datepicker-trigger {
   margin-left:3px;
   margin-bottom: 5px;
   width:30px;
   height:30px;
}
.ui-datepicker{
	margin-top: 1px;
}
.mytextbox {
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
</style>

<style>
/* Style the buttons */
.mybtn {
  border: none;
  border-radius:5px;
  outline: none;
  padding: 10px 16px;
  background-color: #f1f1f1;
  cursor: pointer;
  font-size: 18px;
}

/* Style the active class, and buttons on mouse-over */
.myactive, .mybtn:hover {
  background-color: #666;
  color: white;
}
</style>
<style>
.tablen {
  border-collapse: collapse;
  text-align:center;
}
.tablen th{
  border: 1px solid black;
  text-align:center;
  color:#333;
}
.tablen td{
  border: 1px solid black;
  text-align:center;
  color:#333;
  cursor:pointer;
}
.tablen tr:nth-child(odd){
	background-color:#dbf2fe;
}
.tablen tr:nth-child(even){
	background-color:#fdfdfd;
}
</style>
</head>

<body>
<?php
/*
$regisday = date_create($registerdate)->format('d');
$regismth = date_create($registerdate)->format('m');
$regisyer = date_create($registerdate)->format('Y')+543;
$registerdatef =  $regisday . "-" . $regismth . "-" . $regisyer;//date_create($registerdate)->format('d-m-Y');
$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
*/
$ytdd = date('d',strtotime("-1 days"));
$ytdm = date('m',strtotime("-1 days"));
$ytdy = date('y',strtotime("-1 days"))+43;
$ytd = "T8000_D" . $ytdy . $ytdm . $ytdd . ".txt";

$now = date_create('now')->format('m/d/Y');
$tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
$yesterday = date_create('-1 day')->format('m/d/Y');//format('Y-m-d H:i:s');

?>
<div class="row">
	<div id="myDIV" class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
		<button class="mybtn myactive thfont5" onclick="javascript:opensv(1);" title="WPD Textfile"><i class="fa fa-file"></i><font style="font-size:26px;"> WPD : textfile</font></button>
         <button class="mybtn thfont5" onclick="javascript:opensv(2);" title="SAPAINS Textfile"><i class="fa fa-file"></i><font style="font-size:26px;"> SAPAINS : textfile</font></button>
         <button class="mybtn thfont5" onclick="javascript:opensv(3);" title="DATA Cleansing"><i class="fa fa-institution"></i><font style="font-size:26px;"> DATA Cleansing</font></button>
         <button class="mybtn thfont5" onClick="javascript:opensv(4);" title="Data Cleansing step3"><i class="fa fa-database"></i><font style="font-size:26px;"> Data Cleansing step3</button> 
	</div>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
      <div class="about_title thfont5" style="font-size:30px;">WPD Data Cleansing with Sapains textfile</div>
  </div><!--col-->
</div><!--row-->

<!--<div class="row">
	<div class="col-lg-2 col-md-2 col-xm-2 col-xs-2">
    	<div class="form-group">
            <div class="thfont4" style="">เลือกข้อมูล จากวันที่: <input type="text" class="form-control thfont5" id="bgdate" onChange="setenddate();" style="height:auto;" placeholder="mm/dd/yyyy"></div>
        </div>
    </div><!--col-->
    <!--<div class="col-lg-2 col-md-2 col-xm-2 col-xs-2">
      <div class="form-group">
          <div class="thfont4" style="">ถึงวันที่: <input type="text" class="form-control thfont5" id="eddate" onChange="javascript:chkbgdate();" disabled style="height:auto;" placeholder="mm/dd/yyyy"></div>
      </div>
    </div><!--col-->
     <!--<div class="col-lg-3 col-md-3 col-xm-3 col-xs-3">
     	<div class="form-group">
  			<div class="thfont4" style="">Textfile Sapains:
            	<div class="input-group">
            		<input type="text" class="form-control thfont5" id="txt1" style="height:auto;" placeholder="<?=$ytd?>" value="<?=$ytd?>">
                    <span class="input-group-btn" id="loading1">
        					<button class="btn btn-warning thfont5" type="button" title="เลือกไฟล์ sapains"  onClick="javascript:showalltextfile();"><i class="fa fa-file"></i></button>
   					</span>
                </div>
            </div>
        </div>
     </div><!--col-->
     <!--<div class="col-lg-2 col-md-2 col-xm-2 col-xs-2">
     	<div class="form-group">
        	<div class="thfont4" style=""><br><button class="btn btn-success thfont5" onClick="javascript:chkaccno();"><i class="fa fa-check-circle-o"></i> ตรวจสอบข้อมูล</button></div>
        </div>
     </div>
</div><!--row-->

<div class="row" id="rowresult1">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"><span id="hdt1"> ข้อมูลนิติบุคคล</span></font>
            </div>
            <div class="panel-body">
            
                <!--id r1 -->
            	<div id="r1" class="row">
                	<div class="col-lg-6 col-md-6 col-xm-12 col-xs-12">
                        <div class="row">
                        	<div class="col-lg-4 col-md-4 col-xm-12 col-xs-12">
                            	<div class="form-group">
            						<div class="thfont5" style=""><input title="จากวันที่" type="text" class="form-control thfont5" id="bgdate" onChange="setenddate();" style="height:auto;" placeholder="mm/dd/yyyy"></div>
       							</div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xm-12 col-xs-12">
      							<div class="form-group">
          							<div class="thfont5" style=""><input title="ถึงวันที่" type="text" class="form-control thfont5" id="eddate" onChange="javascript:;" style="height:auto;" placeholder="mm/dd/yyyy"></div>
      							</div>
    						</div>
                            <div class="col-lg-4 col-md-4 col-xm-12 col-xs-12">
                            	<div class="form-group">
                                	<div class="thfont5" style="">  
                                    <button title="ค้นหาข้อมูล" class="thfont5 btn btn-success" onClick="javascript:selectdatawpd();"><i class="fa fa-search"></i></button> 
                                    <button title="gen textfile" class="thfont5 btn btn-danger" onClick="javascript:gentextfilewpd();"><i class="fa fa-file"></i></button>
                                    </div>    
                                </div>
                            </div>
                           
                        </div>
                        <div class="row">
                        	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
                    			<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xm-12 col-xs-12">
                    	<div id="re2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;"></div>
                    </div>
                </div>
                
                <!--id r2 -->
                <div id="r2" class="row">
                	<div class="col-lg-6 col-md-6 col-xm-12 col-xs-12">
                    	<div class="row">
                        	<div class="col-lg-8 col-md-8 col-xm-12 col-xs-12">
                              <div class="form-group">
                                      <div class="input-group">
                                          <input type="text" class="form-control thfont5" id="txt1" style="height:auto;" placeholder="<?=$ytd?>" value="<?=$ytd?>">
                                          <span class="input-group-btn" id="loading1">
                                                  <button class="btn btn-warning thfont5" type="button" title="เลือกไฟล์ sapains"  onClick="javascript:showalltextfile();"><i class="fa fa-file"></i></button>
                                          </span>
                                          <span class="input-group-btn" id="loading2">
                                                  <button class="btn btn-danger thfont5" type="button" title="download textfile from sftp"  onClick="javascript:downloadtxtfile();"><i class="fa fa-download"></i></button>
                                          </span>
                                      </div>
                                  
                              </div>
                           </div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
                    			<div id="re3" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                                	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xm-12 col-xs-12">
                    	<div id="re4" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;"></div>
                    </div>
                </div>
                
                <!--id r3 -->
                <div id="r3" class="row">
                	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
                    	<div class="row">
                        	<div class="col-lg-4 col-md-4 col-xm-12 col-xs-12" style="text-align:center;">
                            	<div class="form-group">
                                	<div class="input-group">
                                    	<input type="text" class="form-control thfont5" id="txtwpd1" style="height:auto;" placeholder="WPD TEXTFILE" value="">
                                        <span class="input-group-btn" id="loadingwpd1">
                                        	<button class="btn btn-warning thfont5" type="button" title="เลือกไฟล์ wpd"  onClick="javascript:showwpdf();"><i class="fa fa-file"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xm-12 col-xs-12" style="text-align:center;">
                            		<button class="btn btn-success thfont5" type="button" title="UPDATE CLEANSING DATA" onClick="javascript:updatecleansingdata();"><i class="fa fa-chevron-left"></i>------UPDATE CLEANSING DATA------<i class="fa fa-chevron-right"></i></button>
                            	<!--<button class="btn btn-success thfont5" type="button" title="CLEANSING DATA"  onClick="javascript:cleansingdata1();"><i class="fa fa-chevron-left"></i>------ CLEANSING ------<i class="fa fa-chevron-right"></i> <div id="pl02"></div></button>-->
                            </div>
                             <div class="col-lg-4 col-md-4 col-xm-12 col-xs-12" style="text-align:center;">
                             	<div id="re7" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;"></div>
                            	<!--<<div class="form-group">
                                	<div class="input-group">
                                    	input type="text" class="form-control thfont5" id="txtsapains1" style="height:auto;" placeholder="SAPAINS TEXTFILE" value="">
                                        <span class="input-group-btn" id="loadingsp1">
                                        	<button class="btn btn-warning thfont5" type="button" title="เลือกไฟล์ sapeains"  onClick="javascript:showsapeainsf();"><i class="fa fa-file"></i></button>
                                        </span>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                		<div class="row">
                			<div class="col-lg-6 col-md-6 col-xm-12 col-xs-12">
                    			<div id="re5" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;"></div>
                    		</div>
                    		<div class="col-lg-6 col-md-6 col-xm-12 col-xs-12">
                    			<div id="re6" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;"></div>
                    		</div>
                        </div>    
                    </div>
                </div><!--r3-->
                
                <!--id r4 -->
                <div id="r4" class="row thfont5">
                	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
                    	<div class="row">
                        	<div class="col-lg-2 col-md-2 col-xm-12 col-xs-12">
                            	<div class="form-group">
                                	<div class="input-group">
                                       <input title="วันที่" type="text" class="form-control thfont5" id="sapiensdate" onChange="" style="height:auto;" placeholder="dd/mm/yyyy" value="<?=$now?>">
                                    <span class="input-group-btn" id="schsapiensall">
                                    	<button title="ค้นหาข้อมูล" class="thfont5 btn btn-success" onClick="javascript:selectdatasapiens();"><i class="fa fa-search"></i></button> 
                                    </span>   
                                    </div> 
       							</div>
                            </div>    
                        </div>
                        <div class="row">
                			<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
                    			<div id="resapiens" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;"></div>
                    		</div>
                        </div>    
                    </div>
                </div><!--r4-->
                
            </div>
        </div>
   </div>
</div><!--row-->

</body>
</html>
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("mybtn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("myactive");
  current[0].className = current[0].className.replace(" myactive", "");
  this.className += " myactive";
  });
}
</script>
