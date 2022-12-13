<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search CropInfo</title>
<script>
	$(document).ready(function() {
		
		$('[data-toggle="tooltip"]').tooltip();
		
		$('#scropinfo2 tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		} );
	 
		// DataTable
		var table = $('#scropinfo2').DataTable({
			"scrollX": true,
			"searching": false,
			"paging":   false,
        	"ordering": false,
        	"info":     false	
		});
	});
	
	var dilg2 = "";
	
	function callupdatestatus2(action,crop_id,registernumber,accno,accbranch){
		
		//alert(action + "," + crop_id + "," + registernumber);
		
		var rall =0;
		var strpath = "";
		 var data1 = 'action=' + action + '&crop_id=' + crop_id + '&registernumber=' + registernumber + '&accno=' + accno + '&accbranch' + accbranch;
		 dilg2 = new BootstrapDialog({
			 type: BootstrapDialog.TYPE_WARNING,
			 //size: BootstrapDialog.SIZE_WIDE,
			 title: "<i class='fa fa-edit'></i><font class='thfont5'> แก้ไขสถานะการขึ้นทะเบียนลูกจ้าง </font>",
			 message: $('<div></div>').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading..."),
			 message: $('<div class="thfont5"></div>').load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/chgstatusfrmsp2') ."'" ; ?>, { action: action, crop_id: crop_id, registernumber: registernumber  }),
			 draggable: true,
			closable: true,	
			closeByBackdrop: false,
			closeByKeyboard: false,
			buttons: [{
				id: 'btn0',
				label: "<i class='fa fa-window-close'></i><font class='thfont5'> ปิด</font>",
				cssClass: 'btn-secondary',
				action: function(dialogItself){			
					dialogItself.close();
				}
			},{
				id: 'btn1',
				label: "<i class='fa fa-check'></i>&nbsp;<font class='thfont5'> บันทึก</font>",
				cssClass: 'btn-primary',
				//hotkey: 13, //enter
				action: function(dialogItself){
					
					r1 = chkdatabefore();
					
					if(r1==0){
						var d1 = $("#dateemp").val();
						var d2 = $("#emailcorp").val();
						var numemp1 = $("#numemp1").val();
						var numemp2 = $("#numemp2").val();
					    ajaxupdatestatus1sp(action,crop_id,registernumber,d1,d2,accno,accbranch,numemp1,numemp2);
					}else{
						//
					}
					
				}
			}]
			
		 });
		 
		 dilg2.open(); 
	}//function callupdatestatus1(action,crop_id,registernumber){
		
	function chkdatabefore(){
		
		var r1 = 0;
		var r2 = 0;
		var r3 = 0;
		var rall = 0;
		var d1 = $("#dateemp").val();
		var d2 = $("#emailcorp").val();
		var d3 = $("#numemp1").val();
		var d4 = $("#numemp2").val();
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		var parts1 =d1.split('-');
		var mydate1 = parts1[2] + parts1[1] + parts1[0];//new Date(parts1[2], parts1[1]-1, parts1[0]);
	   
		
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var year = d.getFullYear()+543;
		
		var str = "" + 12;
		var pad = "00";
		var ans = pad.substring(0, pad.length - str.length) + str;
		
		var month1 = "" + month;
		var day1 = "" + day;
		
		
		var month2 = pad.substring(0, pad.length - month1.length) + month1;
		var day2 = pad.substring(0, pad.length - day1.length) + day1;
		
		var mydate2 = year.toString() + month2.toString() + day2.toString();//new Date(year, month, day);
		
		//alert(mydate1 + ',' + mydate2 + ',' + ans + ',' + month2 + ',' + day2);
		
		
		if(d1==""){
			r0 = 1;
			$("#errmsg1").show();
			$("#errmsg1").html("ข้อมูลวันที่เป็นค่าว่างไม่ได้!");
			$("#dateemp").removeClass("valid").addClass("invalid");
			//$("#dateemp").focus();
			//$("#dateemp").select();
		}else{
			if(mydate1<=mydate2){
				r0 = 0;
				//$("#errmsg1").html(mydate1 + "/" + mydate2);
				$("#dateemp").removeClass("invalid").addClass("valid");
				$("#errmsg1").html("");
				$("#errmsg1").hide();
			}else{
				r0 = 1;
				$("#errmsg1").show();
				//$("#errmsg1").html(mydate1 + "/" + mydate2);
				$("#errmsg1").html("วันที่มีลูกจ้าง มากกว่าวันที่ปัจจุบันไม่ได้!");
				$("#dateemp").removeClass("valid").addClass("invalid");
			}
			
			
		}
		
		
		
		if(d2==""){
			$("#errmsg2").show();
			$("#errmsg2").html("ข้อมูล email เป็นค่าว่างไม่ได้!");
			$("#emailcorp").focus();
			$("#emailcorp").select();
			$("#emailcorp").removeClass("valid").addClass("invalid");
			r1 = 1;
		}else{
			$("#errmsg2").html("");
			$("#errmsg2").hide();
			$("#emailcorp").removeClass("invalid").addClass("valid");
			r1 = 0;
			if(regex.test(d2)){
				$("#errmsg2").html("");
				$("#errmsg2").hide();
				$("#emailcorp").removeClass("invalid").addClass("valid");
				r1 = 0;
			}else{
				$("#errmsg2").show();
				$("#errmsg2").html("ข้อมูล email ไม่ตรงตามรุปแบบ!");
				$("#emailcorp").removeClass("valid").addClass("invalid");
				$("#emailcorp").focus();
				$("#emailcorp").select();
				r1 = 1;
			}
		}
		
		if((d3=="") || (d3=="-") || (d3==0)){ //parseInt();
			$("#errmsgnumemp1").show();
			$("#errmsgnumemp1").html("ข้อมูล จำนวนลูกจ้าง เป็นค่าว่างหรือศูนย์ไม่ได้!");
			$("#numemp1").removeClass("valid").addClass("invalid");
			r2 = 1;
		}else{
			$("#errmsgnumemp1").html("");
			$("#errmsgnumemp1").hide();
			$("#numemp1").removeClass("invalid").addClass("valid");
			r2 = 0;
		}
		
		if((d4=="") || (d4=="-") || (d4==0)){
			$("#errmsgnumemp2").show();
			$("#errmsgnumemp2").html("ข้อมูล จำนวนค่าจ้าง เป็นค่าว่างหรือศูนย์ไม่ได้!");
			$("#numemp2").removeClass("valid").addClass("invalid");
			r3 = 1;
		}else{
			$("#errmsgnumemp2").html("");
			$("#errmsgnumemp2").hide();
			$("#numemp2").removeClass("invalid").addClass("valid");
			r3 = 0;
		}
		
		//r2=0;
		//r3=0;
		
		if((r0==0) && (r1==0) && (r2==0) && (r3==0)){
			rall = 0
		}else{
			rall = 1;
		}
		
		return rall;
	}//function	
	
	function ajaxupdatestatus1sp(action,crop_id,registernumber,d1,d2,accno,accbranch, numemp1, numemp2){
		//alert(action + "," + crop_id + "," + registernumber);	
		var data1 = 'action=' + action + '&crop_id=' + crop_id + '&registernumber=' + registernumber + "&d1=" + d1 + "&e1=" + d2 + "&accno=" + accno + "&accbranch=" + accbranch + "&numemp1=" + numemp1 + "&numemp2=" + numemp2;
		$('#cres1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callupdatestatus2'); ?>",      
			data: data1,         
			success: function (msg)
			{
				/*$("#cres1").html(msg);
				dilg2.close();*/
				var obj = jQuery.parseJSON(msg);
				//alert(obj.status);
				//dilg2.close();
				if(obj.status=='success'){
					dilg2.close();
					BootstrapDialog.alert('<font class="thfont5">แก้ไขข้อมูล เรียบร้อย !</font>');
					$("#cres1").load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/callschcropinfosp1') ."'" ; ?>, { action: action, regisnum: registernumber });
					//$("#cres1").html(msg);
				}else
				if(obj.status=='error'){
					dilg2.close();
					BootstrapDialog.alert('<font class="thfont5">ไม่สามารถแก้ไขข้อมูลได้!</font>');		
				}
			}
		});
		
		
	}//function
	
</script>
</head>

<body>
<?php
  $model0 = CropinfoTmpTb::model()->findAllByAttributes(array('registernumber'=>$regisnum));
  foreach ($model0 as $rows0){
	  $crop_remark0 = $rows0->crop_remark;
	  $crop_updateby0 = $rows0->crop_updateby; //Yii::app()->session['username']
  }
  //echo "{$crop_remark0}"; exit();
?>
<table id="scropinfo2" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
	<thead>
        <tr>
            <th>ชื่อนิติบุคคล</th>
            <th>เลขนิติบุคคล 13 หลัก</th>
            <th>เลขประกันสังคม 10 หลัก</th>
            <th>วันที่จดทะเบียน</th>
            <th>สถานะ</th>
            <?php if(($crop_remark0=='B') && ($crop_updateby0==Yii::app()->session['username'])){ ?><th>Action</th><?php } ?>
        </tr>
    </thead>
    <tbody>
    <?php
	  
	  	$now = date_create('now')->format('Y-m-d H:i:s');
		$tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
		$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
		$daten1 = date('Y-m-d H:i:s');
	  
	  	$rowno = 1;
		$model = CropinfoTmpTb::model()->findAllByAttributes(array('registernumber'=>$regisnum));
		foreach ($model as $rows){
			$crop_id = $rows->crop_id;
			$registername = $rows->registername;
			$registernumber = $rows->registernumber;
			$acc_no = $rows->acc_no;
			$acc_bran = $rows->acc_bran;
			$registerdate = $rows->registerdate;
			$crop_remark = $rows->crop_remark;
			$crop_status = $rows->crop_status;
			
			$crop_createby = $rows->crop_createby;
			$crop_createtime = $rows->crop_createtime;
			$crop_updateby = $rows->crop_updateby;
			$crop_updatetime = $rows->crop_updatetime;
			
			//ตรวจสอบสถานะ ว่าเป็น P หรือไม่
			  if($crop_remark=='P'){
				$updateby = $crop_createby;
 			  	$modified = $crop_createtime;   
			  }else{
				$mest=EmpstateTb::model()->findByAttributes(array('ems_registernumber'=>$registernumber));
				if($mest){
			  		$updateby = $mest->ems_createby;
 			  		$modified = $mest->ems_created;
				}else{
					$updateby = $crop_createby;
 			  		$modified = $crop_createtime;
				}
			  }
			
			
		   $regisday = date_create($registerdate)->format('d');
		   $regismth = date_create($registerdate)->format('m');
		   $regisyer = date_create($registerdate)->format('Y')+543;
		   $registerdatef =  $regisday . "-" . $regismth . "-" . $regisyer;//date_create($registerdate)->format('d-m-Y');
	  	
	  ?>
    	<tr>
        	<td><?=$registername?></td>
            <td style="text-align:left;"><?=$registernumber?></td>
            <td style="text-align:left;"><?=$acc_no?></td>
            <td style="text-align:left;"><?=$registerdatef?></td>
            <td style="color:#FF0; text-align:left;"><span class="badge thfont3" data-toggle="tooltip" data-placement="left" title="<?=$updateby?> , <?=$modified?>" style="color:<?php  if($crop_remark!='P'){ ?> #FF0 <?php }else{ ?> #FF0 <?php } ?>;"><?=$crop_remark?></span></td>
            <?php if(($crop_remark0=='B') && ($crop_updateby0==Yii::app()->session['username'])){ ?>
            <td>
            	<button class="btn btn-warning thfont5" onClick="callupdatestatus2('chg',<?=$crop_id?>,'<?=$registernumber?>','<?=$acc_no?>','<?=$acc_bran?>');"><i class="fa fa-edit"></i> แก้ไข</button>
            </td>
			<?php } ?>
        </tr>
     <?php
      	    $rowno += 1;
		}//foreach ($model as $rows){
	  ?>     
    </tbody>  
</table>
</body>
</html>