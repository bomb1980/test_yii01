<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search Detail Corp</title>
<script>

	function ajaxschcropinfosp4(regisnum){
		var data1 = 'action=sch&regisnum=' + regisnum;
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschcropinfosp'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#cres1").html(da);
			   
			}
		});   
   }//function ajaxschcropinfo(regisnum){

	function updatetsic(rgn){
		var tsiccode = $("#tsiccode").val();	
		var tsicdetial = $("#tsicdetial").val();
		if(!tsiccode){
			BootstrapDialog.alert('<font class="thfont5">ข้อมูลรหัส tsic เป็นค่าว่างไม่ได้!</font>');
			$("#tsiccode").focus();
		}else if(!tsicdetial){
			BootstrapDialog.alert('<font class="thfont5">ข้อมูลรายละเอียด tsic เป็นค่าว่างไม่ได้</font>');
			$("#tsicdetial").focus();
		}else{
			//BootstrapDialog.alert('<font class="thfont5">ป้อนข้อมูลครบแล้ว รอสักครู่</font>');	
			$('#tsicdiv').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <font style='color:red;'>กำลังปรับปรุงข้อมูล กรุณารอสักครู่...</font>");
			var data1 = 'action=update&regisnum=' + rgn + '&tsiccode=' + tsiccode + '&tsicdetial=' + tsicdetial;
			$.ajax({
				type: "POST", 
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/callupdatetsic'); ?>",      
				data: data1,         
				success: function (da)
				{
				   BootstrapDialog.alert('<font class="thfont5">บันทึก tsic เรียบร้อยแล้ว .</font>');
				   $("#strtsic1").html(da);
				   //$("#chgbtn1").removeAttr("disabled");
				   ajaxschcropinfosp4(rgn);//โหลดหน้า อีกครั้ง
				}
			});
		}
	}//function
	
	function showtxtupdatetsic(){
		//alert('test');
		$("#strtsic1").toggle();
		$("#strtsic2").toggle();
	}//function 
	
	function updatetsic2(rgn){
		var tsiccode = $("#tsiccode_e").val();	
		var tsicdetial = $("#tsicdetial_e").val();
		str =  new String(tsiccode);
		if(!tsiccode){
			BootstrapDialog.alert('<font class="thfont5">ข้อมูลรหัส tsic เป็นค่าว่างไม่ได้!</font>');
			$("#tsiccode").focus();
		}else if(!tsicdetial){
			BootstrapDialog.alert('<font class="thfont5">ข้อมูลรายละเอียด tsic เป็นค่าว่างไม่ได้</font>');
			$("#tsicdetial").focus();
		}else if(str.length < 5){
			BootstrapDialog.alert('<font class="thfont5">ข้อมูลรหัส tsic ความยาวน้อยกว่า 5 ตัวอักษรไม่ได้!</font>');
			$("#tsiccode").focus();
		}else{
			//BootstrapDialog.alert('<font class="thfont5">ป้อนข้อมูลครบแล้ว รอสักครู่</font>');	
			//$('#tsicdiv').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <font style='color:red;'>กำลังปรับปรุงข้อมูล กรุณารอสักครู่...</font>");
			var data1 = 'action=update&regisnum=' + rgn + '&tsiccode=' + tsiccode + '&tsicdetial=' + tsicdetial;
			$.ajax({
				type: "POST", 
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/callupdatetsic'); ?>",      
				data: data1,         
				success: function (da)
				{
				   BootstrapDialog.alert('<font class="thfont5">บันทึก tsic เรียบร้อยแล้ว .</font>');
				   showtxtupdatetsic();
				   $('#strtsic1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <font style='color:red;'>กำลังปรับปรุงข้อมูล กรุณารอสักครู่...</font>");
				   $("#strtsic1").html(da);
				   //$("#chgbtn1").removeAttr("disabled");
				   ajaxschcropinfosp4(rgn);//โหลดหน้า อีกครั้ง
				   
				}
			});
		}
	}//function
	
</script>
<style>
.table4_1 table {
	width:100%;
	margin:15px 0;
	border:0;
}
.table4_1 th {
	background-color:#93DAFF;
	color:#000000
}
.table4_1,.table4_1 th,.table4_1 td {
	font-size:0.95em;
	/*text-align:center;*/
	padding:4px;
	border-collapse:collapse;
}
.table4_1 th,.table4_1 td {
	border: 1px solid #c1e9fe;
	border-width:1px 0 1px 0
}
.table4_1 tr {
	border: 1px solid #c1e9fe;
}
.table4_1 tr:nth-child(odd){
	background-color:#dbf2fe;
}
.table4_1 tr:nth-child(even){
	background-color:#fdfdfd;
}


@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	.table4_1 table, .table4_1 thead, .table4_1 tbody, .table4_1 th, .table4_1 td, .table4_1 tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	.table4_1 thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	.table4_1 tr { border: 1px solid #ccc; }
	
	.table4_1 td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	.table4_1 td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	.table4_1 button{
		width:80%;
		height:100%;
	}
	
	/*
	Label the data
	*/
	.table4_1 td:nth-of-type(1):before { content: ""; }
	.table4_1 td:nth-of-type(2):before { content: ""; }
	.table4_1 td:nth-of-type(3):before { content: ""; }
	.table4_1 td:nth-of-type(4):before { content: ""; }
	.table4_1 td:nth-of-type(5):before { content: ""; }
	.table4_1 td:nth-of-type(5):after { content: "";}
	.table4_1 td:nth-of-type(6):before { content: ""; }
	.table4_1 td:nth-of-type(6):after { content: "";}
	
}
</style>
</head>

<body>
<table id="sbranch1" cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
    
      <tbody>
      <?php
	  	$rowno = 1;
		$model = CropinfoTmpTb::model()->findAllByAttributes(array('registernumber'=>$regisnum));
		foreach ($model as $rows){
			$registername = $rows->registername;
			$registernumber = $rows->registernumber;
			$acc_no = $rows->acc_no;
			$acc_bran = $rows->acc_bran;
			$registerdate = $rows->registerdate;
			$crop_remark = $rows->crop_remark;
			$crop_status = $rows->crop_status;
			$tsic = $rows->tsic;
			$tsicname = $rows->tsicname;
			$corptype = $rows->corptype;
			$corptypename = $rows->corptypename;
			$accountingdate = $rows->accountingdate;
			$authorizedcapital = $rows->authorizedcapital;
			$cpower = $rows->cpower;
			
			$crop_remark = $rows->crop_remark;
			$crop_status = $rows->crop_status; 
			
			
			//ค้นหาจำนวนลูกจ้าง และ จำนวนค่าแรง
			$model3 = EmpstateTb::model()->findAllByAttributes(array('ems_registernumber'=>$regisnum));
			$cm3 = count($model3);
			if($cm3>0){
				foreach ($model3 as $rows3){
					$email = $rows3->ems_email;
					$numofemp = $rows3->ems_numofemp;
					$totalsalary = $rows3->ems_totalsalary;
				}
			}else{
				$email = '';
				$numofemp = 0;
				$totalsalary = 0;
			}
			
			
			if($tsic=='-'){
				$tsic = '';
			}
			
			if($tsicname=='-'){
				$tsicname = '';
				
			}
			
			if($cpower=='-'){
				$cpower = '';
				
			}
			
			//$Budget = number_format($Budget,0,".",",");
			$authorizedcapitalf = number_format($authorizedcapital,0,".",",");
			
	  	
	  ?>
          <tr>
              <td style="text-align:right; width:20%; font-weight:bold;">ชื่อกิจการ :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$registername?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:20%; font-weight:bold;">ประเภท :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$corptypename?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:20%; font-weight:bold;">ทุนจดทะเบียน :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$authorizedcapitalf?> บาท</td>
          </tr>
          <tr>
              <td style="text-align:right; width:20%; font-weight:bold;">
			  	<?php if($crop_remark=='P'){ ?>
                	<?php if($tsic){ ?>
                	  <button class="" title="แก้ไข" onClick="javascript:showtxtupdatetsic();"><i class="fa fa-edit"></i></button>
                    <?php } ?>  
				<?php } ?> 
                TSIC :
              </td>
              <td style="text-align:left; width:80%; padding-left:15px;">
              	<div id="tsicdiv">
                	<?php if($tsic){  ?>
                    	<div class="row">
                        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			  					<div id="strtsic1">
									<?=$tsic?> :: <?=$tsicname?>
                                </div>
                                <div id="strtsic2" style="display:none;">  
                                	<div class="row">
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                            <input type="text" id="tsiccode_e" class="form-control thfont3" placeholder="รหัส tsic" maxlength="5" onFocus="this.select()" value="<?=$tsic?>"> 
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                            <input type="text" id="tsicdetial_e" class="form-control thfont3" placeholder="รายละเอียด tsic" onFocus="this.select()" value="<?=$tsicname?>">
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                            <button class="btn btn-success" title="บันทึก" onClick="javascript:updatetsic2('<?=$registernumber?>');"><i class="fa fa-save"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                    	
                    	<div class="row">
                        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			  					<div id="strtsic1"  style="display:none;">
									<?=$tsic?> :: <?=$tsicname?>
                                </div>
                                <div id="strtsic2">  
                                	<div class="row">
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                            <input type="text" id="tsiccode_e" class="form-control thfont3" placeholder="รหัส tsic" maxlength="5" onFocus="this.select()" value="<?=$tsic?>"> 
                                        </div> ::
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <input type="text" id="tsicdetial_e" class="form-control thfont3" placeholder="รายละเอียด tsic" onFocus="this.select()" value="<?=$tsicname?>">
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                            <button class="btn btn-success" title="บันทึก" onClick="javascript:updatetsic2('<?=$registernumber?>');"><i class="fa fa-save"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php } ?>
                </div>
              </td>
          </tr>
          <!--<tr>
              <td style="text-align:right; width:20%; font-weight:bold;">รายละเอียดกิจการ :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"></td>
          </tr>-->
          <tr>
          	  <td style="text-align:right; width:20%; font-weight:bold;">จำนวนลูกจ้าง :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$numofemp?> คน</td>
          </tr>
          <tr>
          	  <td style="text-align:right; width:20%; font-weight:bold;">จำนวนเงินค่าจ้าง :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$totalsalary?> บาท</td>
          </tr>
       <?php
      	    $rowno += 1;
		}//foreach ($model as $rows){
	  ?>     
          
      </tbody>
     
  </table>
</body>
</html>