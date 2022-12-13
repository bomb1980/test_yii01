<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search By Infomation</title>
<script>
	function showtxt(seltxt){
		//alert(seltxt);
		if(seltxt=='1'){
			$("#txt1").val("");
			$("#dtxt1").show();
			$("#dtxt2").hide();
			$("#dtxt3").hide();
			$("#txt1").focus();
			$("#txt1").select();
		}
		if(seltxt=='2'){
			$("#txt2").val("");
			$("#dtxt1").hide();
			$("#dtxt2").show();
			$("#dtxt3").hide();
			$("#txt2").focus();
			$("#txt2").select();
		}
		if(seltxt=='3'){
			$("#txt3").val("");
			$("#dtxt1").hide();
			$("#dtxt2").hide();
			$("#dtxt3").show();
			$("#txt3").focus();
			$("#txt3").select();
		}
	}
	
	function callschcropbyinfo(){
		seltxt = $("#sel1").val();
		//alert(seltxt);
		var schtxt = ""; // 
	    var str = ""; //new String(cnumb);
		if(seltxt=='1'){
			schtxt = $("#txt1").val();
			if(schtxt){
				str =  new String(schtxt);
				ajaxcallschbyinfo(seltxt,schtxt);
			}else{
				BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลชื่อนิติบุคคล ที่ต้องการค้นหา !</font>');   
				$("#txt1").focus();
				$("#txt1").select();
			}
		}
		if(seltxt=='2'){
			schtxt = $("#txt2").val(); 
			if(schtxt){
				str =  new String(schtxt);
				if(str.length < 13){
					BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขนิติบุคคล 13 หลัก ที่ต้องการค้นหา ให้ครบถ้วน !</font>'); 
					$("#txt2").focus();
					$("#txt2").select();
				}else{
					ajaxcallschbyinfo(seltxt,schtxt);
				}
			}else{
				BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขนิติบุคคล 13 หลัก ที่ต้องการค้นหา !</font>');   
				$("#txt2").focus();
				$("#txt2").select();
			}
		}
		if(seltxt=='3'){
			schtxt = $("#txt3").val();
			if(schtxt){
				str =  new String(schtxt);
				if(str.length < 10){
					BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขประกันสังคม 10 หลัก ที่ต้องการค้นหา ให้ครบถ้วน !</font>');  
					$("#txt3").focus();
					$("#txt3").select();
				}else{
					ajaxcallschbyinfo(seltxt,schtxt);
				}
			}else{
				BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขประกันสังคม 10 หลัก ที่ต้องการค้นหา !</font>');   
				$("#txt3").focus();
				$("#txt3").select();
			} 
		}
	}
	
	function ajaxcallschbyinfo(seltxt,schtxt){
		var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
		//alert(data1);
		$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschbyinfo'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#rowresult1").show();	
			   $("#rowresult2").hide();
			   $("#re1").html(da);
			   
			}
		});
	}
	
	function backtotable(){
		$("#rowresult1").show();
		$("#rowresult2").hide();
		callschcropbyinfo();		
	}
</script>
</head>

<body>
	<div class="about_title thfont5" style="font-size:30px;">ค้นหาข้อมูลนิติบุคคล ตามรายการ</div>
    <div class="row"><!--row-->
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!--rcorners-->
        	<div class=""><!--row-->
            
            	<div class="col-xs-12 col-xm-12 col-md-3 col-lg-3">
            		<div class="form-group">
                    	<p class="thfont5" style="">
                        	<label for="sel1">ค้นหาจาก:</label>
                            <select class="form-control thfont5" id="sel1" style="height:auto;" onChange="javascript:showtxt(this.value);">
                              <option value="1">ชื่อนิติบุคคล</option>
                              <option value="2" selected>เลขนิติบุคคล 13 หลัก</option>
                              <option value="3">เลขบัญชีนายจ้าง 10 หลัก</option>
                            </select>
                        </p>
                    </div><!--formgroup-->
                </div><!--cal-md-3-->
                
                <div class="col-xs-12 col-xm-12 col-md-3 col-lg-3">
                	<div class="form-group" style="display:none;" id="dtxt1">
                		<p class="thfont5" style="">
                        	
  								<label class="thfont5" for="txt1">ชื่อนิติบุคคล:</label>
  								<input type="text" class="form-control thfont5" id="txt1" style="height:auto;" placeholder="ชื่อนิติบุคคล">
							
                        </p>
                	</div><!--formgroup-->
                    <div class="form-group" id="dtxt2">
                		<p class="thfont5" style="">
                        	
  								<label class="thfont5" for="txt2">เลขนิติบุคคล 13 หลัก:</label>
  								<input type="text" class="form-control thfont5" id="txt2" style="height:auto;" placeholder="0000000000000" maxlength="13" onFocus="this.select()">
							
                        </p>
                	</div><!--formgroup-->
                    <div class="form-group" style="display:none;" id="dtxt3">
                		<p class="thfont5" style="">
                        	
  								<label  class="thfont5" for="txt3">เลขบัญชีนายจ้าง 10 หลัก:</label>
  								<input type="text" class="form-control thfont5" id="txt3" style="height:auto;" placeholder="0000000000" maxlength="10" onFocus="this.select()">
							
                        </p>
                	</div><!--formgroup--> 
                </div><!--cal-md-3-->
                
                <div class="col-md-3">
                	<div class="form-group" style="" id="dbtn1">
                    	<p class="thfont5" style="padding-top:32px;">
                        	<label  class="thfont5" for="btn1"></label>
                    		<button  class="btn btn-info" id="btn1" onClick="javascript:callschcropbyinfo();"><i class="fa fa-search"></i><font class="thfont5"> ค้นหา</font></button>
                        </p>
                    </div><!--formgroup-->
                </div><!--cal-md-3-->
                
            </div><!--row-->
        </div><!--rcorners-->
    </div><!--row-->
    
    <div class="row">
        <div class="col-md-12">
        
            <div class="row" id="rowresult1" style="display:none;">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"><b> ข้อมูลนิติบุคคลจาก WPD</b></font>
                        </div><!--panel heading-->
                        <div class="panel-body">
                            <div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                                
                            </div>
                        </div><!--panelbody-->
                    </div><!--panel-->
                </div><!--col-md-12-->
            </div><!--rowresult1-->
            
             <div class="row" id="rowresult2" style="display:none;">
             	<div class="col-md-12">
                	<!--<div class="row" id="btnbacktb" style="padding-bottom:15px;">
                    	<div class="col-md-3">
                        	<button class="btn btn-primary" onClick="javascript:backtotable();" ><i class="fa fa-mail-reply"></i> <font class="thfont5">ย้อนกลับ</font></button>
                        </div>
                    </div><!--row-->
                	<div class="row">
                    	<div class="col-md-12">
                        
                        	<div class="panel panel-info"><!--panel-->
                                <div class="panel-heading">
                                    <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"><b> ข้อมูลนิติบุคคลจาก WPD</b></font>
                                </div>
                                <div class="panel-body">
                                    <div id="cres1" class="thfont5">ข้อมูล Cropinfo</div>
                                </div>
                            </div><!--panel-->
                        	
                        </div>
                    </div><!--row-->
                    <div class="row">
                    	<div class="col-md-4">
                        
                        	<div class="panel panel-danger"><!--panel-->
                                <div class="panel-heading">
                                    <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"><b> ข้อมูลสำนักงาน</b></font>
                                </div>
                                <div class="panel-body">
                                    <div id="cres2" class="thfont5">ข้อมูล branch</div>
                                </div>
                            </div><!--panel-->
                        	
                        </div><!--col-md-4-->
                        <div class="col-md-8">
                        	<div class="row">
                            	<div class="col-md-12">
                                	<div class="panel panel-danger"><!--panel-->
                                        <div class="panel-heading">
                                            <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"><b> ข้อมูลเจ้าของกิจการ</b></font>
                                        </div>
                                        <div class="panel-body">
                                            <div id="cres3" class="thfont5">ข้อมูล committee</div>
                                        </div>
                                    </div><!--panel-->
                                	
                                </div><!--col-md-12-->
                            </div><!--row-->
                            <div class="row">
                            	<div class="col-md-12">
                                	<div class="panel panel-danger"><!--panel-->
                                        <div class="panel-heading">
                                            <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"><b> รายละเอียดกิจการ</b></font>
                                        </div>
                                        <div class="panel-body">
                                            <div id="cres4" class="thfont5">ข้อมูล DetailCorp</div>
                                        </div>
                                    </div><!--panel-->
                                	
                                </div>
                            </div><!--row-->
                        </div><!--col-md-8-->
                    </div><!--row-->
                </div><!--rowresult2-->
             </div><!--row-->
            
        </div><!--col-md-12-->
    </div><!--row-->
</body>
</html>