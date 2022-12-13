<?php	
set_time_limit(0);
ini_set("max_execution_time","0");
ini_set("memory_limit","9999M"); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Service 8</title>
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


<script>

$(document).ready(function() {
	$( "#bgdate" ).datepicker();
	$( "#eddate" ).datepicker();
	$( "#sapiensdate" ).datepicker();
	$( "#bgdatecd1" ).datepicker();
	
	$("#f1").show();
	$("#f2").hide();
		//dateFormat: "dd-mm-yy"
	//});	
	$('.panel').lobiPanel({
       		reload: false,
    		close: false,
    		editTitle: false
			//minimize: false
	});
	
	gettextfileforsapiens2(); //โหลดข้อมูลจาก table มาแสดงใน datatable เลย
	
});

</script>
<script>
	
	function gettextfileforsapiens2(){
		$('#f1').show();
		$('#f2').hide();
		$('#f3').hide();
		$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		var data1 = 'action=gettextfileforsapiens2';
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/gettextfileforsapiens2'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			}
		});
	}//function 
	
	function genmonthlytxtfile(){
		$('#f1').hide();
		$('#f2').hide();
		$('#f3').show();
		$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		var data1 = 'action=genmonthlytxtfile';
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/genmonthlytxtfile'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			}
		});
	}//function
	
	function addtextfile(){
		var tfn = $("#txtfn1").val();
		tfnt = tfn + ".txt";
		if(tfn){
			var data1 = 'action=addtextfile' +  '&tfnt=' + tfnt;
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST", 
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/addtextfileforsapiens'); ?>",      
				data: data1,         
				success: function (da)
				{
				   //var obj = jQuery.parseJSON(da);	
				   //if(obj.status=='success'){	
				      BootstrapDialog.alert('<font class="thfont5">' + da + ' !</font>');
				   	  gettextfileforsapiens2();
				   //}else{
					  //$('#re1').html("เกิดข้อผิดพลาดในการสร้าง textfile กรุณาตรวสอบฟังก์ชั่น addtextfileforsapiens ใน controller. <br> " + da + ".");  
				   //}
				}//success
			});//ajax
		}else{//if
			BootstrapDialog.alert('<font class="thfont5"> กรุณาพิมพ์ชื่อเท๊กซ์ไฟล์ !</font>');
			$("#txtfn1").focus();
			$("#txtfn1").select();
		}//if
	}//function
	
	function addtextfilemonthly(){
		var tfn = $("#txtfn2").val();
		tfnt = tfn + ".txt";
		//alert(tfnt);
		
		if(tfn){
			var data1 = 'action=addtextfilemonthly' +  '&tfnt=' + tfnt;
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST", 
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/addtextfilemonthlyforsapiens'); ?>",      
				data: data1,         
				success: function (da)
				{
				  // var obj = jQuery.parseJSON(da);	
				   //if(obj.status=='success'){	
				   	  //genmonthlytxtfile();
				   //}else{
					  //$('#re1').html("เกิดข้อผิดพลาดในการสร้าง textfile กรุณาตรวสอบฟังก์ชั่น addtextfilemonthlyforsapiens ใน controller. <br> " + da + ".");  
					  BootstrapDialog.alert('<font class="thfont5">' + da + ' !</font>');
					  genmonthlytxtfile();
				   //}
				}//success
			});//ajax
		}else{//if
			BootstrapDialog.alert('<font class="thfont5"> กรุณาพิมพ์ชื่อเท๊กซ์ไฟล์ !</font>');
			$("#txtfn2").focus();
			$("#txtfn2").select();
		}//if
		
	}//function
	
	function callcanceldatafrmdbd(){
		
		var bgdatecd1 = $("#bgdatecd1").val();
		
		if(bgdatecd1){
			//BootstrapDialog.alert('<font class="thfont5">' + bgdatecd1 + '</font>');
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			var data1 = 'action=showdatacancelfrmdbd&bgdatecd1=' + bgdatecd1;
			$.ajax({
			  type: "POST", 
			  url: "<?php echo Yii::app()->createAbsoluteUrl('site/callcanceldatafrmdbd'); ?>",      
			  data: data1,         
			  success: function (da)
			  {
				 $("#re1").html(da);
			  }
			});
		}else{
			BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ต้องการดึงข้อมูล !</font>');
			$("#bgdatecd1").focus();
			$("#bgdatecd1").select();
		}//if
		
	}//function
	
	function showdatetocalldata(){
		$('#f1').hide();
		$('#f2').show();
		$('#f3').hide();
		$('#re1').html("");
	}//function
	
</script>
</head>

<body>

<!--<div class="row">
  <div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
      <div class="about_title thfont5" style="font-size:30px;"> Generate Textfile for Sapiens</div>
  </div>
</div><!--row-->

<div class="row">
	<div id="myDIV" class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
		<button class="mybtn myactive thfont5" onclick="javascript:gettextfileforsapiens2();" title="Generate Weekly Textfile"><i class="fa fa-file"></i><font style="font-size:26px;"> Generate Weekly Textfile</font></button>
        <button class="mybtn thfont5" onClick="javascript:showdatetocalldata();" title="CallUpdateDatafrom DBD"><i class="fa fa-circle-o-notch"></i> <font style="font-size:26px;"> CallUpdateDatafrom DBD</font></button>
        <button class="mybtn thfont5" onClick="javascript:genmonthlytxtfile();" title="Generate Monthly Textfile"><i class="fa fa-file"></i><font style="font-size:26px;"> Generate Monthly Textfile</font></button>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
		&nbsp;
	</div>
</div>

<div class="row" id="rowresult1">
	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
		<div class="panel panel-info">
        	<div class="panel-heading">
                <i class="fa fa-file"></i><font class="thfont5" style="font-size:24px;"><span id="hdt1"> Textfile </span></font>
            </div>
            <div class="panel-body">
            
            	<!--id r1 -->
                <div id="r1" class="row">
                	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
                        <!-- row1 -->
                    	<div class="row" id="f1">
                        	<div class="col-lg-5 col-md-5 col-xm-12 col-xs-12">
                              <div class="form-group">
                                      <div class="input-group">
                                      		
                                          <input type="text" class="form-control thfont5" id="txtfn1" style="height:auto;" placeholder="ตั้งชื่อไฟล์" value="">
                                          <span class="input-group-btn" id="loading1">
                                                  <button class="btn btn-warning thfont5" type="button" title="เพิ่มเท๊กซ์ไฟล์"  onClick="javascript:addtextfile();"><i class="fa fa-plus-circle"></i> เพิ่มไฟล์</button>
                                          </span>
                                          
                                      </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row1 -->
                        <!-- row1 -->
                    	<div class="row" id="f2">
                        	<div class="col-lg-4 col-md-12 col-xm-12 col-xs-12">
                              <div class="form-group">
                                      <div class="input-group">
                                          <input title="ดึงข้อมูลที่ปรับปรุงในวันที่" type="text" class="form-control thfont5" id="bgdatecd1" onChange="javascipt:;" style="height:auto;" placeholder="mm/dd/yyyy">
                                          <span class="input-group-btn" id="loading1">
                                          		<button class="btn btn-success thfont5" type="button" title="ดึงข้อมูลที่มีการปรับปรุงจาก dbd"  onClick="javascript:callcanceldatafrmdbd();"><i class="fa fa-fighter-jet"></i> ดึงข้อมูลจาก dbd</button>
                                          </span>
                                      </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row1 -->
                        <!-- row1 -->
                    	<div class="row" id="f3">
                        	<div class="col-lg-5 col-md-5 col-xm-12 col-xs-12">
                              <div class="form-group">
                                      <div class="input-group">
                                      		
                                          <input type="text" class="form-control thfont5" id="txtfn2" style="height:auto;" placeholder="ตั้งชื่อไฟล์รายเดือน" value="">
                                          <span class="input-group-btn" id="loading1">
                                                  <button class="btn btn-warning thfont5" type="button" title="เพิ่มเท๊กซ์ไฟล์รายเดือน"  onClick="javascript:addtextfilemonthly();"><i class="fa fa-plus-circle"></i> เพิ่มไฟล์รายเดือน</button>
                                          </span>
                                          
                                      </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row1 -->
                        <!-- row2 -->
                        <div class="row">
                        	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
                    			<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                                	<!-- data table -->
                                </div>
                            </div>
                        </div>
                        <!-- end row2 -->
                    </div><!-- end col-->
                </div><!-- end row -->
                <!--end id r1 -->
            </div>
       </div>
	</div>
</div>

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