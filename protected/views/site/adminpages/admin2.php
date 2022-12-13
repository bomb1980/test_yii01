<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>User</title>
<script>
$(document).ready(function() {
	
  $('.panel').lobiPanel({
	  reload: false,
	  close: false,
	  editTitle: false,
	  sortable: true
	  //minimize: false
  });	
	
  loadusatb();
	
});

function loadusatb(){
	var data1 = 'action=opn';
	$('#usap1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	$.ajax({
		type: "POST", 
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/calluserall'); ?>",      
		data: data1,         
		success: function (da)
		{
		   $("#usap1").html(da);
		}
	});	
}

var dilg = "";
function loadusafrm(action,usaid){
	//alert(action + "," + usaid);	
	var data = "usaid=" + usaid + "&action=" + action;	
	var typedilg = "";
	var titledilg = "";
	if(action=='opn'){
		typedilg = BootstrapDialog.TYPE_INFO;
		titledilg = "<i class='fa fa-plus'></i><font class='thfont5'> เพิ่มผู้ใช้งาน </font>";
	}else if(action=='chg'){
		typedilg = BootstrapDialog.TYPE_WARNING;
		titledilg = "<i class='fa fa-edit'></i><font class='thfont5'> ปรับปรุงผู้ใช้งาน </font>";
	}
	dilg = new BootstrapDialog({
		type: typedilg,
		size: BootstrapDialog.SIZE_NORMAL,
		title: "" + titledilg + "",
		message: $('<div></div>').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading..."),
		message: $('<div></div>').load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/callusafrm') ."'" ; ?>, { usaid: usaid, action: action }),
		draggable: true,
		closable: true,	
		closeByBackdrop: false,
		closeByKeyboard: false,
		buttons: [{
			id: 'btn0',
			label: "<i class='fa fa-window-close'></i> Close",
			cssClass: 'btn-secondary',
			action: function(dialogItself){			
				dialogItself.close();
			}
		},{
			id: 'btn1',
			label: "<i class='fa fa-check'></i>&nbsp; Save",
			cssClass: 'btn-primary',
			//hotkey: 13, //enter
			action: function(dialogItself){
				//aust3.close();
				if(action=='opn'){
					callcreatenewusa('add','usatxt',9);
				}else if(action=='chg'){
					callupdateusa('chg','usatxt',9,usaid);
				}
			}
		}]
	});//dilg
	dilg.open();
}

function callcreatenewusa(action,n1,n2){
	//alert(action + "," + n1 + "," + n2);
	var ste=0;
	var data="";
	var el = []; //new FormData($("#frm")[0])
	var i=0;
	for(i=1; i<=n2 ; i++){ //วนลูปตรวจสอบ ค่าว่าง
		el[i] = $("#" + n1 + i + "").val();
		if(el[i]==""){
			ste += 1;	
		}
		if(i==1){
		   data = data + "" + n1 + i + "=" + el[i];		
		}else{
		   data = data + "&" + n1 + i + "=" + el[i];	
		}
		chkelm("" + n1 + i + ""); //เปลี่ยน class ถ้าเป็นค่าว่าง
	}//for
	//alert(ste);
	data = data + "&action=" + action;
	//alert(data);
	if(ste==0){
		$.ajax({
		type: "POST", 
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/calladdusa'); ?>",      
		data: data,         
		success: function (result)
		{	//$("#usap1").html(result);
		   var obj = jQuery.parseJSON(result);
		   if(obj.status=='success'){
			 BootstrapDialog.alert('<font class="thfont5">เพิ่มรายการเสร็จเรียบร้อยแล้ว!</font>');  
			 loadusatb();
			 dilg.close();
			 //clear form-----
			 for(i=1; i<=n2 ; i++){
				 $("#" + n1 + i + "").val("");
			 }//for(i=1; i<=n2 ; i++)
		   }else if(obj.status=='error'){
			   BootstrapDialog.alert('<font class="thfont5">ไม่สามารถเพิ่มรายการได้!</font>');
		   }else if(obj.status=='errordup'){
			   BootstrapDialog.alert('<font class="thfont5">ไม่สามารถเพิ่มรายการได้ เนื่องจากรายการซ้ำกับข้อมูลที่มีอยู่แล้ว!</font>');
		   }
		}
		});
	}else{
		BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลให้ครบถ้วน!</font>');
	}//if
}//callcreatenewusa

function callupdateusa(action,n1,n2,udid){
	//alert(action + "," + n1 + "," + n2 + "," + udid);
	var ste=0;
	var data="";
	var el = []; //new FormData($("#frm")[0])
	var i=0;
	for(i=1; i<=n2 ; i++){ //วนลูปตรวจสอบ ค่าว่าง
		el[i] = $("#" + n1 + i + "").val();
		if(el[i]==""){
			ste += 1;	
		}
		if(i==1){
		   data = data + "" + n1 + i + "=" + el[i];		
		}else{
		   data = data + "&" + n1 + i + "=" + el[i];	
		}
		chkelm("" + n1 + i + ""); //เปลี่ยน class ถ้าเป็นค่าว่าง
	}
	//alert(ste);
	data = data + "&action=" + action + "&udid=" + udid;
	//alert(data);
	if(ste==0){
		//-------- send data for add -------------------------
		$.ajax({
		type: "POST", 
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/callchgusa'); ?>",      
		data: data,         
		success: function (result)
		{	
			//$("#usap1").html(result);
			var obj = jQuery.parseJSON(result);
			//$("#usap1").html(obj.status);
		   if(obj.status=='success'){
			 BootstrapDialog.alert('<font class="thfont5">ปรับปรุงรายการเสร็จเรียบร้อยแล้ว!</font>');  
			 loadusatb();
			 dilg.close();
		   }else if(obj.status=='error'){
			   BootstrapDialog.alert('<font class="thfont5">ไม่สามารถปรับปรุงรายการได้!</font>');
		   }
		}
		});
	}else{
		BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลให้ครบถ้วน!</font>');
	}
}

function calldelusa(action,deid,dename){
	//alert(action + "," + deid + "," + dename);
	var data = "";
	data = "dename=" + dename + "&action=" + action + "&deid=" + deid;
	BootstrapDialog.confirm({
		title: "<font class='thfont5'>ยืนยันการลบข้อมูล</font>",
	  	message: "<font class='thfont5'> ต้องการลบรายการข้อมูล '" + dename + "'  ไช่ หรือ ไม่? </font>",
		type: BootstrapDialog.TYPE_DANGER,
		closable: true, 
	  	draggable: true, 
	  	btnOKLabel: 'OK', 
	  	btnCancelLabel: 'Cancel',
		callback: function(result) {
			if(result){
				$.ajax({
				  type: "POST", 
				  url: "<?php echo Yii::app()->createAbsoluteUrl('site/calldelusa'); ?>",      
				  data: data,         
				  success: function (msg)
					{	
						//$("#usp1").html(msg);
						var obj = jQuery.parseJSON(msg);
						//$("#usp1").html(obj.status);
					   if(obj.status=='success'){
						 BootstrapDialog.alert('<i class="fa fa-check"></i><font class="thfont5"> ลบรายการเสร็จเรียบร้อยแล้ว!</font>');  
						 loadusatb();
					   }else if(obj.status=='error'){
						   BootstrapDialog.alert('<i class="fa fa-close"></i><font class="thfont5"> ไม่สามารถลบรายการได้!</font>');
					   }
					}//success
				  }); //$.ajax({
				 
			}//if(result)
		}//callback
	});
}

</script>
</head>

<body>
<div class="about_title thfont5" style="font-size:30px;">ผู้ใช้งาน</div>
<div class="row" style="padding-top:15px;"><!--row-->
    <div class="col-md-12"><!--rcorners-->
        <div id="usaf1">
        	<button  class="btn btn-info" id="usabtn1" onClick="javascript:loadusafrm('opn',0);"><i class="fa fa-plus"></i><font class="thfont5"> เพิ่มผู้ใช้งาน</font></button>
        </div><!--usaf1-->
    </div><!--col-md-12-->
</div><!--row-->
<div class="row" style="padding-top:15px;"><!--row-->
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-user"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลผู้ใช้งาน</font>
            </div><!--panel heading-->
            <div class="panel-body">
                <div id="usap1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                    
                </div>
            </div><!--panelbody-->
        </div><!--panel-->
    </div><!--col-md-12-->
</div><!--row-->
</body>
</html>