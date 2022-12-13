<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search By Date</title>
<script>

	$(document).ready(function() {
		$( "#bgdate" ).datepicker();
		$( "#eddate" ).datepicker();
	});

	function setenddate(){
		//$("#eddate").focus();
		$("#eddate").val($("#bgdate").val());
	}
	
	var newda="";
	var upda="";
	function  callschcropbydate(){
		//alert('ok');
		//BootstrapDialog.alert('ok');	
		
		var bgdate = $("#bgdate").val();
		var eddate = $("#eddate").val();
		
		
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
		}else
		if(newda == 0){
			BootstrapDialog.alert('<font class="thfont5">กรุณาเลือก "รายการใหม่" !</font>');
		}else{
			//send ajax function
			$("#rowresult1").show();
			ajaxsendparamssbd(bgdate,eddate,newda,upda);
		}
	}
	
	function ajaxsendparamssbd(bgdatep,eddatep,newdap,updap){

		var data1 = 'bgdatep=' + bgdatep + '&eddatep=' + eddatep + '&newdap=' + newdap + '&updap=' + updap;
		
		//alert(data1);
		
		$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschbydate'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			}
		});
		
	}
	
	function chkbgdate(){
		
		var bgdate = $("#bgdate").val();
		var eddate = $("#eddate").val();
		
		
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
			BootstrapDialog.alert('กรุณาเลือกวันที่เริ่มต้นก่อน !');
			$("#eddate").val("");
			$("#bgdate").focus();
			$("#bgdate").select();
		}else
		if(bgdate > eddate){
			BootstrapDialog.alert('กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !');
			$("#eddate").val("");
			$("#eddate").focus();
			$("#eddate").select();	
		}else
		if(newda != 0){
			//BootstrapDialog.alert('กรุณาเลือก "รายการใหม่" !');
		}
	}
</script>
</head>

<body>
<?php
	$now = date_create('now')->format('m/d/Y');
?>
	<div class="about_title thfont5" style="font-size:30px;">ค้นหาข้อมูลนิติบุคคล ตามวันที่จดทะเบียนนิติบุคคล</div>
    	<div class="row"><!--row-->
    		<div class="col-md-12"><!--rcorners-->
    			<div class="row">
                	<div class="col-md-3">
                      <div class="form-group">
                          <p class="thfont4" style="">
                          	<label for="bgdate">จากวันที่:</label> 
                            <input type="text" class="form-control thfont5" id="bgdate" onChange="javascript:setenddate();" style="height:auto;" value="<?=$now?>" readonly>
                          </p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <p class="thfont4" style="">
                          	<label for="eddate">ถึงวันที่:</label> 
                            <input type="text" class="form-control thfont5" id="eddate" onChange="javascript:chkbgdate();" style="height:auto;" value="<?=$now?>" readonly>
                          </p>
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        	<p class="thfont4" style="">
                            	<label for="">ประเภทข้อมูล:</label>
                                <div class="form-check form-check-inline">
                                	<input class="form-check-input" type="checkbox" id="newdata" value="1" checked>
                                	<label class="form-check-label thfont3" for="newdata">รายการใหม่</label>&nbsp;&nbsp;
                                	<input class="form-check-input" type="checkbox" id="upddata" value="2" disabled>
                                	<label class="form-check-label thfont3" for="upddata">รายการที่ปรับปรุง</label>
                            	</div>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                    	<div class="form-group">
                        	<p class="" style=""><br><br>
                               <button class="btn btn-info" onClick="javascript:callschcropbydate();"><i class="fa fa-search"></i><font class="thfont5"> ค้นหาข้อมูลนิติบุคคล</font></button>
                            </p>
                        </div>
                    </div>
            	</div><!--row-->
    		</div><!--rcorners-->
    	</div><!--row-->
        
        <div class="row">
        	<div class="col-md-12">
            	<div class="row" id="rowresult1" style="display:none;">
                	<div class="col-md-12">
                    	<div class="panel panel-info">
                        	<div class="panel-heading">
                        		<i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลนิติบุคคล</font>
                    		</div><!--panel heading-->
                            <div class="panel-body">
                            	<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                                	
                                </div>
                            </div><!--panelbody-->
                        </div><!--panel-->
                    </div><!--col-md-12-->
                </div>
            </div><!--col-md-12-->
        </div><!--row-->
    
</body>
</html>