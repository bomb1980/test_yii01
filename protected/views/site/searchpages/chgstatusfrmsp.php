<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Cheng Status Form</title>
<script>
$(document).ready(function() {
    //$( "#dateemp" ).datepicker();
	//$( "#sdp1" ).datepicker();
	
	/*$( "#dateemp" ).datepicker({
      showOn: "both",
      buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
	  { dateFormat: 'dd-mm-yy' }
	  $( "#myVariable" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
    });*/
	
	$('#dateemp').datepicker({
		dateFormat: "dd-mm-yy",
		showOn: "both",
		buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/imagescalenda.png",
		buttonImageOnly: true,
		buttonText: "Select date",
		orientation: "top"
	});
	
	
	//$('#datepicker').datepicker("option", "dateFormat", "dd/mm/yy");
	
	
	/*$('#dateemp').datepicker({
		format: 'mm/dd/yyyy',
		startDate: '-3d'
	});*/
	
});
</script>
<script>
	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  //return regex.test(email);
	  //alert(regex.test(email));
	  if(regex.test(email)){
		  //  
	  }else{
		  BootstrapDialog.alert(" <font class='thfont5'>กรุณาตรวจสอบ email ให้ถูกต้องตามรูปแบบ! </font>");
		  $("#emailcorp").focus();
		  $("#emailcorp").select();
	  }
	}
	
</script>
<style>
/* This is the style for the trigger icon. The margin-bottom value causes the icon to shift down to center it. */
.ui-datepicker-trigger {
   margin-left:3px;
   /*margin-top: 8px;*/
   margin-bottom: 5px;
   width:30px;
   height:30px;
}
.ui-datepicker{
	margin-top: 10px;
	/*position: relative; 
	z-index: 1000;*/
}
.mytextbox {
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
</style>
</head>

<body>
	<div class="row">
    	<div class="col-md-12">
        	
            <table id="chgstatus1" cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
    
      			<tbody>
                	<?php
					$dataReader=CJSON::decode($encode);
					$crop_id = $dataReader[0]['crop_id'];
					$registername = $dataReader[0]['registername'];
					$registernumber = $dataReader[0]['registernumber'];
					$acc_no = $dataReader[0]['acc_no'];
					$acc_bran = $dataReader[0]['acc_bran'];
					$registerdate = $dataReader[0]['registerdate'];
					$crop_remark = $dataReader[0]['crop_remark'];
					$crop_status = $dataReader[0]['crop_status'];
					
					
					$now = date_create('now')->format('Y-m-d H:i:s');
  					$tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  					$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  					$daten1 = date('Y-m-d H:i:s');
					
					$now2 = date('d-m-Y');
					
					$nowday = date_create('now')->format('d');
			 		$nowmth = date_create('now')->format('m');
			 		$nowyer = date_create('now')->format('Y')+543;
					$now3 = $nowday . "-" . $nowmth . "-" . $nowyer; //date_create('now')->format('d-m-Y');
					
					$regisday = date_create($registerdate)->format('d');
			 		$regismth = date_create($registerdate)->format('m');
			 		$regisyer = date_create($registerdate)->format('Y')+543;
					
					$registerdatef = $regisday . "-" . $regismth . "-" . $regisyer; //date_create($registerdate)->format('d-m-Y');
					
					//check email from BranchTmpTb
					$qemail=BranchTmpTb::model()->findByAttributes(array('registernumber'=>$registernumber));
					$corpemail = $qemail->email;
					
					?>
                	<tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">ชื่อกิจการ :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$registername?></td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">เลขนิติบุคคล 13 หลัก :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$registernumber?></td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">เลข สปส. 10 หลัก :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$acc_no?></td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">สถานะ :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$crop_remark?></td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">วันที่จดทะเบียน :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$registerdatef?></td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">วันที่มีลูกจ้าง :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;">
							<input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="mytextbox thfont5" style="height:auto;" id="dateemp" value="<?=$now3?>" placeholder="" readonly><span id="inlineDate"></span>
                            <span style="color:red; font-size:16px; display:none;" id="errmsg1"></span>
                              <!--<div id="container" class="ui-widget">-->
                                <!--<input type="text" class="" id="dateemp"/>-->
                              <!--</div>-->
                        </td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">จำนวนลูกจ้าง :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;">
                        	<input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="mytextbox thfont5" style="height:auto;" id="numemp1" value="0" placeholder=""> คน &nbsp;
                            <span style="color:red; font-size:16px; display:none;" id="errmsgnumemp1"></span>
                        </td>
                        
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">จำนวนเงินค่าจ้าง :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;">
                        	<input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="mytextbox thfont5" style="height:auto;" id="numemp2" value="0.00" placeholder=""> บาท
                            <span style="color:red; font-size:16px; display:none;" id="errmsgnumemp2"></span>
                        </td>
                        
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">email :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;">
							<input type="text" onFocus="this.select()" onBlur="chkelm(this.id);"  class="form-control thfont5" style="height:auto;" id="emailcorp" placeholder="Example@email.com" value="<?=$corpemail?>">
                            <span style="color:red; font-size:16px; display:none;" id="errmsg2"></span>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
           <div style="color:#003;"> ได้ทำการยื่นเอกสารขึ้นทะเบียนลูกจ้าง เรียบร้อยแล้ว <br> กรุณาคลิก ปุ่ม Save เพื่อทำการบันทึกสถานะ </div>
            
        </div>
    </div>
</body>
</html>