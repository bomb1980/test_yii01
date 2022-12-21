<?php
    $emadd = $_POST['emadd'];
    $oel_id = $_POST['oel_id'];
    $et = $_POST['et'];
    $oelans = $_POST['oelans'];
    $dp2 = $_POST['dp2'];


    //echo "{$emadd},{$oel_id},{$et},{$oelans}";
    //exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ยืนยันด้วย OTP</title>
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
        min-height: 38px;
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
    <?php 
        $curtime = date("Y-m-d H:i:s");
        //$con=mysqli_connect('localhost','root','','etpdb');
		//$con=mysqli_connect('wpddb.sso.loc','appwpd','APP@wpd','etpdb'); //uat wpddb.sso.loc
		$con=mysqli_connect('C2WPDDBPRO001','appwpd','APP@wpd','etpdb'); //prd

        $res=mysqli_query($con,"select oel_expdatetime from otp_email_tb where oel_emailaddress='$emadd' and oel_registernumber='$oel_id' and oel_emailtype='$et'");
        $count=mysqli_num_rows($res);
        $row = $res->fetch_array(MYSQLI_ASSOC);
        $exptime = $row['oel_expdatetime'];

    ?>
<div class="login-form">
    <div class="shadow1">
    <img class="img-responsive center-block"src="images/ssol2.png" alt="SSO-LOGO" width="95" hight="95" style="padding-bottom: 10px;">
        <h2 class="text-center" style="color:#000099">กรอกรหัส OTP</h2>       
        <div class="form-group first_box">
            <input type="text" id="oel_otp" class="form-control" placeholder="กรุณาใส่เลข OTP" required="required" maxlength="5">
            <span id="email_error" class="field_error"></span>
        </div>
        <div class="form-group first_box">
            <button id="otpbtn" type="button" class="btn btn-primary btn-block" onclick="fn_DateCompare('<?=$exptime?>', '<?=$curtime?>');">ยืนยัน OTP</button>
        </div>
        <div id="countdown1" style="display:none;">OTP จะหมดอายุภายใน <span id="time">10:00</span> นาที!</div>

        
    </div>
</div>

<style>
    .field_error{color:red;}
</style>
</body>
</html>   
<script>
var interval;

function startTimer(duration, display) {
    
    var emadd = '<?php echo $emadd ;?>';
    var et = '<?php echo $et ;?>';
    var oel_id = '<?php echo $oel_id ;?>' ;
    var dp2 = '<?php echo $dp2 ;?>' ;
    var timer = duration, minutes, seconds;
    
    interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer <= 0) {
            //duration();
            clearInterval(this);
            stopinterval();
            $("#countdown1").hide();
            loadform1(emadd,oel_id,et); 
            stopinterval();   
            clearInterval(this);     
        }

    }, 1000);
}

function stopinterval(){
  clearInterval(interval); 
  //return false;
}

/*window.onload = function () {
    var tenMinutes = 60 * 10,
        display = document.querySelector('#time');
    startTimer(tenMinutes, display);
};*/

</script>
<script>

    $(document).ready(function(){
        $("#countdown1").show();
        var tenMinutes = 60 * 10,
        display = document.querySelector('#time');
        //interval = setInterval(display,1000);
        startTimer(tenMinutes, display);
        //loadformlogin(); 
    });
   
    /*$emadd = $_POST['emadd'];
    $oel_id = $_POST['oel_id'];
    $et = $_POST['et'];
    $oelans = $_POST['oelans'];*/

function submit_otp(){
    var emadd = "<?=$emadd?>";
    var oel_id = "<?=$oel_id?>";
    var et = "<?=$et?>";
    var oelans = "<?=$oelans?>";
    var dp2 = "<?=$dp2?>";


	var otp=jQuery('#oel_otp').val();
    //alert(otp);

    var isANumber = isNaN(otp) === false;

        if(otp.length === 5){
        // alert("7dgit");
                if (isANumber){
                    let isnum = /^\d+$/.test(otp);
                // alert("กรุณาใส่เลข 5 หลักให้ถูกต้อง");
                }else{
                    alert("ใส่เฉพาะเลข 5 หลักให้ถูกต้อง");
                    exit();
                }
        }else{
            alert("กรุณาใส่เลข 5 หลัก");
            exit();
        }

    if(otp){
	jQuery.ajax({
		url:'check_otp2.php',
		type:'post',
		data:'otp='+otp + '&emadd=' + emadd + '&oel_id=' + oel_id + '&et=' + et + '&oelans=' + oelans + '&dp2='+dp2 ,
		success:function(result){
			if(result=='yes'){
				//window.location='dashboard.php'
                //alert('thank you for your answer');
                loadthankyoupage();
               // loadformlogin();
			}
			if(result=='not_exist'){
				//jQuery('#otp_error').html('Please enter valid otp');
                alert('Please enter valid otp');
			}
		}
	});
    }else{
        alert('Please enter valid otp');
    }
}

function fn_DateCompare(DateA, DateB) {     // this function is good for dates > 01/01/1970 
//alert(DateA + "," + DateB);
var d = new Date($.now());
var ds = d.getFullYear() + "-" + (d.getMonth()+1).toString().padStart(2, "0") + "-" + d.getDate().toString().padStart(2, "0")+" "+d.getHours().toString().padStart(2, "0")+":"+d.getMinutes().toString().padStart(2, "0")+":"+d.getSeconds().toString().padStart(2, "0");
 var a = new Date(DateA); 
 var b = new Date(ds); 
//alert(a + "," + b);
 if(a>=b){ //ถ้า otp ยังไม่หมดอายุ
    //alert('OTP Not Expired');
    submit_otp();
 }else if(a<b){ //ถ้า otp หมดอายุ
     //alert('a more than b');
     alert("OTP Expired");
 }

} 

</script>