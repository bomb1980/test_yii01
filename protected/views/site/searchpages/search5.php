<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>

		$(document).ready(function() {
			$('.panel').lobiPanel({
					reload: false,
					close: false,
					editTitle: false,
					sortable: true
					//minimize: false
			});
		});


	function callegasch(){
		
		var txt1 = $("#txt1").val();
		var txt2 = $("#txt2").val();
		
		//alert(txt1 + "," + txt2);
		//exit();
		seltxt = "";
		if(txt1){
			str =  new String(txt1);
			if(str.length < 13){
				BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขนิติบุคคล 13 หลัก ที่ต้องการค้นหา ให้ครบถ้วน !</font>'); 
				$("#txt1").focus();
				$("#txt1").select();
				seltxt = "n";
				exit();
			}else{
				seltxt = "y";	
			}
		}else{
			BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขนิติบุคคล 13 หลัก ที่ต้องการค้นหา !</font>');   
			$("#txt1").focus();
			$("#txt1").select();
			seltxt = "n";
			exit();
		}
		
		if(txt2){
			str2 =  new String(txt2);
			if(str2.length < 4){
				BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนปีงบการเงิน (พ.ศ.) ที่ต้องการค้นหา ให้ครบถ้วน !</font>'); 
				$("#txt2").focus();
				$("#txt2").select();
				seltxt = "n";
				exit();
			}else{
				seltxt = "y";
			}
		}else{//if
			BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนปีงบปการเงิน (พ.ศ.)  ที่ต้องการค้นหา !</font>');   
			$("#txt2").focus();
			$("#txt2").select();
			seltxt = "n";
			exit();
		}
		
		if(seltxt == "y"){
			//alert("ok");
			$('#resega1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> Loading...");
			
		     var data1 = "action=callegaservice&txt1=" + txt1 + "&txt2=" + txt2;
			 
			 //alert(data1);
			 
			$.ajax({
				type: "POST", 
				url: "<?php echo Yii::app()->createAbsoluteUrl('ega/callegaservice'); ?>",      
				data: data1,         
				success: function (da)
				{
				   $("#resega1").html(da);
				   //BootstrapDialog.alert('<font class="thfont5">' + da + '</font>');
				   //$('#resega1').html(""); 
				}
			});
			
		}else if(seltxt == "n"){
			//alert("error");
			BootstrapDialog.alert('<font class="thfont5">ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบข้อมูลอีกครั้ง !</font>');
		}
		
			
	}//function
</script>
</head>

<body>
	<div id="txtfilter1">
    	<!--textbox filter-->
        <div class="about_title thfont5" style="font-size:30px;">ค้นหาข้อมูลงบการเงินสถานประกอบการจาก EGA ด้วยเลขทะเบียนพาณิชย์ 13 หลัก และ ปี พ.ศ.</div>
       <div class="row">
        <div class=" col-xs-12 col-md-2 col-lg-2">
        	<p class="thfont5" style="">            	
  				<label class="thfont5" for="txt1">เลขนิติบุคคล 13 หลัก:</label>
  				<input type="text" class="form-control thfont5" id="txt1" style="height:auto;" placeholder="0000000000000" maxlength="13" onFocus="this.select()">		
        	</p>
        </div>
        <div class="col-xs-12 col-md-2 col-lg-2">
        	<p class="thfont5" style="">
            	<label class="thfont5" for="txt2">ปีงบการเงิน (พ.ศ.):</label>
  				<input type="text" class="form-control thfont5" id="txt2" style="height:auto;" placeholder="0000" maxlength="4" onFocus="this.select()">
            </p>
        </div>
        <div class="col-xs-12 col-md-2 col-lg-2">
        	<div class="form-group" style="" id="dbtn1">
            	<p class="thfont5" style="padding-top:32px;">
                	<label  class="thfont5" for="btn1"></label>
                    <button  class="btn btn-info" id="btn1" onClick="javascript:callegasch();"><i class="fa fa-search"></i><font class="thfont5"> ค้นหา</font></button>
                </p>
            </div><!--formgroup-->
        </div><!--cal-md-3-->
       </div><!--row--> 
    </div><!--txtfilter1-->
    <hr>
    <div class="row" id="rowresult1">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลงบการเงิน จาก EGA</font>
                </div><!--panel heading-->
                <div class="panel-body">
                    <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <!--result data-->
                    </div>
                </div><!--panelbody-->
            </div><!--panel-->
        </div><!--col-md-12-->
    </div><!--rowresult1-->
            
    
</body>
</html>