<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search CropInfo</title>
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
<script>

	$(document).ready(function() {
		
	});
	
	function ajaxschcropinfosp3(regisnum){
	
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
	
	function updateiden(ordernum,regisnum,fulname){
		var iden = $("#iden" + ordernum).val();
		if(iden){
			str =  new String(iden);	
			if(str.length < 13){
				BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขประจำตัว 13 หลัก ของ ' + fulname +  '<br> ให้ครบถ้วน !</font>'); 
				$("#iden" + ordernum).focus();
				$("#iden" + ordernum).select();
			}else{
				var data1 = 'action=update&ordernum=' + ordernum + "&regisnum=" + regisnum + "&iden=" + iden;
				$('#loading' + ordernum).html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' />");
				$.ajax({
					type: "POST", 
					url: "<?php echo Yii::app()->createAbsoluteUrl('site/callupdateiden'); ?>",      
					data: data1,         
					success: function (da)
					{
					   BootstrapDialog.alert('<font class="thfont5">บันทึกเลขประจำตัวเรียบร้อยแล้ว .</font>');
					   $("#idenres" + ordernum).html(da);
					   //$("#chgbtn1").removeAttr("disabled");
					   ajaxschcropinfosp3(regisnum);//โหลดหน้า อีกครั้ง
					}
				});
			}
			
		}else{
			BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขประจำตัว 13 หลัก ของ ' + fulname +  '<br> ให้ครบถ้วน !</font>');   
			$("#iden" + ordernum).focus();
			$("#iden" + ordernum).select();
		}
		
	}
	
</script>

</head>

<body>
	<!--<span style="thfont5">ข้อมูลบริษัท : </span>-->
	<table id="scommittee1" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
      <thead>
      	  <tr style="background-color:#6CC;">
              <td style="text-align:center; width:10%; font-weight:bold;">#</td>
              <td style="width:20%; font-weight:bold;">ชื่อ - สกุล (ไทย)</td>
              <td style="width:20%; font-weight:bold;">ชื่อ - สกุล (Eng)</td>
              <td style="text-align:center; width:20%; font-weight:bold;">เลขที่บัตรประจำตัว</td>
              <td style="width:10%; font-weight:bold;">สัญชาติ</td>
              <td style="text-align:center; width:20%; font-weight:bold;">ประเภท</td>
          </tr>
      </thead>
      <tbody>
      <?php
	  	$rowno = 1;
		$ordernumber_old=0;
		$model = CommitteeTmpTb::model()->findAllByAttributes(array('registernumber'=>$regisnum));
		foreach ($model as $rows){
			
			$registernumber = $rows->registernumber;
			$committeetype = $rows->committeetype;
			$ordernumber = $rows->ordernumber;
			$typeno = $rows->typeno;
			$identity = $rows->identity;
			$title = $rows->title;
			$firstname = $rows->firstname;
			$lastname = $rows->lastname;
			$englishtitle = $rows->englishtitle;
			$englishfirstname12 = $rows->englishfirstname12;
			$englishlastname = $rows->englishlastname;
			$nation = $rows->nation;
			
			$fullname = $title . $firstname . "  " . $lastname;
			
			$fullnameeng = $englishtitle . $englishfirstname12 . "  " . $englishlastname;
			
			if($ordernumber_old!=$ordernumber){
			
			if($committeetype=='K'){
				$committeetype = "กรรมการ";
			}else if($committeetype=='L'){
				$committeetype = "หุ้นส่วน";
			}
	  	
	  ?>
          <tr>
              <td style="text-align:center; width:5%;"><?=$ordernumber?></td>
              <td style="width:24%;"><?=$fullname?></td>
              <td style="width:24%;"><?=$fullnameeng?></td>
              <td style="text-align:center; width:22%;">
              <div id="idenres<?=$ordernumber?>">
			  	<?php if($identity!='-'){  ?>
                    <script> 
						//$("#chgbtn1").removeAttr("disabled"); 
                    </script> 
					<?=$identity?>
                <?php }else{ ?>
                	<script> 
						//$("#chgbtn1").attr("disabled", true); 
                    </script>
                    <div class="input-group">
                      <input type="text" id="iden<?=$ordernumber?>" class="form-control thfont3" placeholder="0000000000000" maxlength="13" onFocus="this.select()">
                        <span class="input-group-btn" id="loading<?=$ordernumber?>">
        					<button class="btn btn-warning" type="button" title="บันทีกเพิ่มเติม"  onClick="updateiden(<?=$ordernumber?>,'<?=$registernumber?>','<?=$fullname?>');"><i class="fa fa-edit"></i></button>
   						</span>
                    </div>
                <?php } ?>
                </div>     
              </td>
              <td style="text-align:center; width:10%;"><?=$nation?></td>
              <td style="text-align:center; width:20%;"><?=$committeetype?></td>
          </tr>
       <?php
	   		
	   		$ordernumber_old = $ordernumber;
			
      	    $rowno += 1;
			
			}//if($ordernumber_old!=$ordernumber){
				
				
		}//foreach ($model as $rows){
	  ?>     
          
      </tbody>
  </table>
  
  <?php 
  	$model2 = CropinfoTmpTb::model()->findAllByAttributes(array('registernumber'=>$regisnum)); 
	foreach ($model2 as $rows2){
		$cpower = $rows2->cpower;
	}
	if($cpower=='-'){
		$cpower = '';
	}
  ?>
  
  <table cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
  	<tr>
    	<td style="text-align:right; width:20%; font-weight:bold;">คณะกรรมการลงชื่อผูกพัน :</td>
       	<td style="text-align:left; width:80%; padding-left:15px;"><?=$cpower?></td>
    </tr>
  </table>
  
</body>
</html>