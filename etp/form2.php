<?php
    //data1 = 'action=loadform1&emadd=' + emadd + '&oel_id=' + oel_id + '&et=' + et;
    $emadd = $_POST['emadd'];
    $oel_id = $_POST['oel_id'];
    $et = $_POST['et'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>แบบสำรวจสถานประกอบการ</title>
<link rel="stylesheet" href="bootstrap.min.css">
<script src="jquery-3.5.1.min.js"></script>
<script src="bootstrap.min.js"></script> 
<style type="text/css">
	.login-form {
        font-family: "THSarabunPSK";
		width: 540px;
    	margin: 150px auto;
	}
    .login-form form {
        font-family: "THSarabunPSK";
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.3);
        padding: 15px;
    }
    .login-form h2 {
        font-family: "THSarabunPSK";
        margin: 0 0 15px;
    }
    .form-control, .btn {
        font-family: "THSarabunPSK";
        min-height: 3px;
        border-radius: 2px;
    }
   .btn {      
        font-family: "THSarabunPSK";  
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
<div class="shadow1">
    <img class="img-responsive center-block"src="images/ssol2.png" alt="SSO-LOGO" width="95" hight="95" style="padding-bottom: 10px;">

        <h2 class="text-center" style="color:#000099">แบบสำรวจสถานประกอบการ(ฉบับที่ 2)</h2>       
        <hr>
        <div class="form-check">
         <div class="col-md-12 margin-bottom-15" style=" font-size: 16px">
            <label class="radio-inline">
            <input type="radio" name="rdoActiveS" id="btn1" value="ZR" onclick="chk_value()">
            เปิดกิจการแล้วแต่ไม่มีลูกจ้าง
            </label><br><br>
            <label class="radio-inline">
            <input type="radio" name="rdoActiveS" id="btn2" value="NE" onclick="chk_value()">
            ยังไม่เปิดดำเนินกิจการ
            </label><br><br>  
            <label class="radio-inline">
            <input type="radio" name="rdoActiveS" id="btn3" value="CL"  onclick="chk_value()">
                มีลูกจ้าง จำนวน
            <input type="number" min="1" max="999" name="CLNUM" class="text-center"  id="dp2" value=""  disabled="disabled" data-rule-required="true" contenteditable="false" >
            คน ที่ยังไม่ได้ขึ้นทะเบียนประกันสังคม
            </label><hr>
        </div>
       <br>

        <script>
            function chk_value(){
                var enabled=document.getElementById('btn3').checked;
                document.getElementById('dp2').value = '';
                document.getElementById('dp2').disabled=!enabled;
            }
            </script>

        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block" onclick="javascript:send_otp();">ยืนยันแบบฟอร์ม</button>
        </div>
        <div id="proloader1" text-align="center;" style="display:none;">
            <img src="images/preloader-01.gif" width="20" hight="20" /> Loading...
        </div>
     
   </div>
</div>

<style>
    .field_error{color:red;}
</style>
</body>
</html>                                		                            

<script>
function loadotpform(){
    var data1 = 'action=loadotpform';
    $.ajax({
        type:"POST",
        url: "otp2.php",
        data: data1,
        success: function(x)
        {
            $("#a1").html(x);
        }
    });
}

function send_otp(){
    var emadd = "<?=$emadd?>";
    var oel_id = "<?=$oel_id?>";
    var et = "<?=$et?>";
	var email=emadd; //jQuery('#email').val();
    var oelans = "";
    var dp2=$("#dp2").val();
    if ($("#btn1").prop("checked")) {
        // do something
        oelans = "ZR";
    }else if($("#btn2").prop("checked")){
        oelans = "NE";
    }else if($("#btn3").prop("checked")){
        oelans = "CL";
    }
if(oelans){
    $("#proloader1").show();
	jQuery.ajax({
		url:'send_otp2.php',
		type:'post',
		data:'email='+email + '&oel_id=' + oel_id + '&et=' + et +'&dp2=' + dp2,
		success:function(result){
			if(result=='yes'){
                
                checkreport();
				//jQuery('.second_box').show();
				//jQuery('.first_box').hide();
			}
			if(result=='not_exist'){
				//jQuery('#email_error').html('Please enter valid email');
                alert('Please enter valid email');
			}
		}
	});

    }else{
        alert('กรุณาเลึอกตัวเลือก');
    }
}


function checkreport(){
    var emadd = "<?=$emadd?>";
    var oel_id = "<?=$oel_id?>";
    var et = "<?=$et?>";
    var oelans = "";
    var dp2=$("#dp2").val();
    if ($("#btn1").prop("checked")) {
        // do something
        oelans = "ZR";
    }else if($("#btn2").prop("checked")){
        oelans = "NE";
    }else if($("#btn3").prop("checked")){
        oelans = "CL";
    }
    if(oelans){
        var data1 = "";
        data1 = "emadd=" + emadd + "&oel_id=" + oel_id + "&et=" + et +  "&oelans=" + oelans + "&dp2=" + dp2;
        //alert(data1);
        $.ajax({
            type:"POST",
            url: "otp2.php",
            data: data1,
            success: function(x)
            {
                $("#a1").html(x);
                //loadotpform();
                //alert(x);
                //window.location.href = x;
                //window.location.replace(x);
            }
        });
    }else{
        alert('กรุณาเลือกตัวเลือก');
    }
      


    // OR
    /*if ($("#radio1").is(":checked")) {
        // do something
    }*/
    //var emadd = '<//?php echo $emadd ;?>';
    //var oel_answer = $("#oel_answer").val(); //ดึงค่า valจาก textbox มาเก็บไว้ในตัวแปร
    //alert(oel_answer);

// alert(oel_id);

 /*var data1 = "";
     //data1+='emadd='+emadd;
     data1+='&oel_answer='+oel_answer   ;//view ส่งข้อความไปยังcontoller ผ่านAjax
     alert(data1);
     
 
      $.ajax({
        type:"POST",
        url: "otp_email_tb/check.php ",
        data: data1,
        success: function(x)
        {
        if(x=="ERROR"){

            alert ('ไม่พบข้อมูล');
        }else{
            window.location.href = x;
        }
        //window.location.replace(x);
        }
    });*/

}
</script>

