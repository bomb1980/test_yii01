<?php
   $emadd=$_GET['emadd'];
   $et=$_GET['et'];

   //echo "{$emadd}, {$et}";
   //exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ETP E-mail and OTP</title>
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="icon" href="images/ssol2.png">
<script src="jquery-3.5.1.min.js"></script>
<script src="bootstrap.min.js"></script> 
<style type="text/css">
    .shadow1 {
        border: 1px solid;
        padding: 10px;
        box-shadow: 5px 10px #888888;
    }   
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
    body {
        
  
  
}
    

</style>
</head>
<body>


<div id="a1"></div>

<style>
    .field_error{color:red;}
</style>    
</body>
</html>                                		                            

<script>
$(document).ready(function(){
    loadformlogin(); 
});

function loadformlogin(){
    var data1 = 'action=loadformlogin';
    $.ajax({
        type:"POST",
        url: "formchklogin.php",
        data: data1,
        success: function(x)
        {
            $("#a1").html(x);
        }
    });
}

function loadform1(emadd,oel_id,et){
    var data1 = 'action=loadform1&emadd=' + emadd + '&oel_id=' + oel_id + '&et=' + et;
    //alert(data1);
    $.ajax({
        type:"POST",
        url: "form1.php",
        data: data1,
        success: function(x)
        {
            $("#a1").html(x);
        }
    });
}

function check13digits(){
    var emadd = '<?php echo $emadd ;?>';
    var et = '<?php echo $et ;?>';
    var oel_id = $("#oel_id").val() ; //ดึงค่า valจาก textbox มาเก็บไว้ในตัวแปร

//alert(emadd + ',' + et + ',' + oel_id);

var isANumber = isNaN(oel_id) === false;
   if(oel_id.length === 13){
        //alert("13dgit");
            if (isANumber){
                let isnum = /^\d+$/.test(oel_id);
                //alert("กรุณาใส่เลข 13 หลักให้ถูกต้อง");
            }else{
                alert("กรุณาใส่เลข 13 หลักให้ถูกต้อง");
                exit();
            }
    }else{
        alert("กรุณาใส่เลข 13 หลัก");
        exit();
    }
    

if(oel_id){    
// alert(emadd);
// alert(oel_id);
//alert(et);
 var data1 = "";
     data1+='emadd='+emadd;
     data1+='&oel_id='+oel_id;//view ส่งข้อความไปยังcontoller ผ่านAjax
     data1+='&et='+et;
	 
	 //alert(data1);
	
    $.ajax({
        type:"POST",
        url: "otp_email_tb/check.php ",
        data: data1,
        success: function(x)
        {
		//alert(x);
        if(x=="ERROR"){
            alert ('ไม่พบข้อมูล');
        }else{
            loadform1(emadd,oel_id,et);
        }
        //window.location.href = x;
        //window.location.replace(x);
        }
    });
}else{
    alert ('กรุณาป้อนเลข13หลัก');  
}


}//function

function loadthankyoupage(){
    var data1 = 'action=loadthankyoupage';
   // var str = "ขอบคุณสำหรับการตอบแบบสอบถาม <br>";
  //      str = "สำนักงานประกันสังคมฯ ได้รับข้อมูลของท่านเรียบร้อยแล้ว <br>";
  //  $("#a1").html(str);
    //alert(data1);
    $.ajax({
        type:"POST",
        url: "thankyoupage.php",
        data: data1,
        success: function(x)
        {
            $("#a1").html(x);
        }
    });
}


</script>
