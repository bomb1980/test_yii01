<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Service 6</title>
 <style>
           .login-dialog .modal-dialog {
				overflow-y: initial !important
            }
			.login-dialog .modal-body {
                height: 75vh;
				overflow-y: auto;
            }


        </style>
<script>
	$(document).ready(function() {
		
		$('.panel').lobiPanel({
       		reload: false,
    		close: false,
    		editTitle: false
			//minimize: false
		});

		$("#tbrn1").load("<?php echo Yii::app()->createAbsoluteUrl('site/gettxtfilesiskcrop'); ?>");	
		$("#tbrn2").load("<?php echo Yii::app()->createAbsoluteUrl('site/getriskcrop'); ?>");	
		
	});
	
	function downloadtxtfileled(){	
		  var dlt = $("#dlt1").val();
		  var data1 = 'action=downloadfileled&dlt=' + dlt;
		  if(dlt){
		  	$('#tbrn1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> DownLoading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/downloadtxtfileledfrmsftp'); ?>",      
				data: data1,         
				success: function (da)
				{
				   BootstrapDialog.alert(" <font class='thfont5'>" + da + "</font>");	
				   $("#tbrn1").load("<?php echo Yii::app()->createAbsoluteUrl('site/gettxtfilesiskcrop'); ?>");
				}
			});
		  }else{
			 BootstrapDialog.alert(" <font class='thfont5'>กรุณาพิมพ์ชื่อ text file ที่ต้องการ download</font>");
		  }
	  }//function
	  
	var dilgfn = "";
	  
	function schtxtfile(){
		var action = 'schtextfile';
		var fns = 'txtfile';
		var data1 = 'action=schtextfile';
		dilgfn = new BootstrapDialog({
			type: BootstrapDialog.TYPE_WARNING,
			//size: BootstrapDialog.SIZE_WIDE,
			title: "<i class='fa fa-file'></i><font class='thfont5'> SFTP Files </font>",
			message: $('<div></div>').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading..."),
			message: $('<div class="thfont5"></div>').load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/openfileonftp') ."'" ; ?>, { action: action, fns: fns  }),
			draggable: false,
			closable:false,	
			closeByBackdrop: false,
			closeByKeyboard: false,
			cssClass: 'login-dialog',
			buttons: [{
				id: 'btn0',
				label: "<i class='fa fa-window-close'></i><font class='thfont5'> ปิด</font>",
				cssClass: 'btn-secondary',
				action: function(dialogItself){			
					dialogItself.close();
				}
			}]
		});
		dilgfn.open();
	}//function
	
	
	function chkmasdata(){
		var action = 'chkmasleddata';
		//alert(action);
		$('#tbrn2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Checking...");
		 var data1 = 'action=' + action;
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/chkmasleddata'); ?>",      
			data: data1,         
			success: function (da)
			{
				//$("#tbrn2").html(da);
			   BootstrapDialog.alert(" <font class='thfont5'>" + da + "</font>");	
			   $("#tbrn2").load("<?php echo Yii::app()->createAbsoluteUrl('site/getriskcrop'); ?>");
			}
		});
	}

	function loaderrtxtlog(){
		var action = 'schtextfile';
		var fns = 'txtfile';
		var data1 = 'action=schtextfile';
		dilgfn = new BootstrapDialog({
			type: BootstrapDialog.TYPE_WARNING,
			//size: BootstrapDialog.SIZE_WIDE,
			title: "<i class='fa fa-file'></i><font class='thfont5'> Log Text Files </font>",
			message: $('<div></div>').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading..."),
			message: $('<div class="thfont5"></div>').load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/loadtxtlog') ."'" ; ?>, { action: action, fns: fns  }),
			draggable: false,
			closable:false,	
			closeByBackdrop: false,
			closeByKeyboard: false,
			buttons: [{
				id: 'btn0',
				label: "<i class='fa fa-window-close'></i><font class='thfont5'> ปิด</font>",
				cssClass: 'btn-secondary',
				action: function(dialogItself){			
					dialogItself.close();
				}
			}]
		});
		dilgfn.open();
	}//function
	
/*	function getdatatxtfiletodb(fn1,minrec){
		var data1 = 'action=gettxtdata&fn1=' + fn1 + '&minrec=' + minrec;
		$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callgettxtdata'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});
	}
	
	function ledservicecall(){
		var data1 = 'action=callledservice';
		$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('led/callledservicecall'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});
	}
	
	function sendmail(ema,accno,brnno){
		var data1 = 'action=sendmail&ema=' + ema + "&accno=" + accno + "&brnno=" + brnno;
		$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callsendmail'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});
	}
	*/
	function getfile(filename, dataUrl) {
    // Construct the 'a' element
    var link = document.createElement("a");
    link.download = filename;
    link.target = "_blank";

    // Construct the URI
    link.href = dataUrl;
    document.body.appendChild(link);
    link.click();

    // Cleanup the DOM
    document.body.removeChild(link);
    delete link;
}

</script>

</head>

<body>
	<div id="as2" style="padding-bottom:20px;">
    	<?php echo CHtml::link('<i class="fa fa-mail-reply"></i> back to All Services', array('site/services')); ?>
    </div>
    <div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    		<div class="about_title thfont5" style="font-size:30px;">ตรวจสอบข้อมูลสถานประกอบการถูกฟ้องล้มละลาย จาก LED (Call LED Webservice)</div>
    	</div>
    </div>
    <!--<div class="row" style="margin-top:15px;">
   		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!--rcorners-->
            <!--<button class="btn btn-primary" onClick="javascript:getdatatxtfiletodb('T8000_W620909.TXT',0);"><i class="fa fa-download"></i> Get Data textfile to DB</button>
            <button class="btn btn-info" onClick="javascript:ledservicecall();"><i class="fa fa-save"></i> call LED Service</button>
            <button class="btn btn-success" onClick="javascript:sendmail('day.jakkrit@gamail.com','01234569874','000000');"><i class="fa fa-envelope" aria-hidden="true"></i> SendMail</button>
        </div>
    </div>-->
      <!--row-->	
      <div class="row" style="margin-top:15px;" id="rowresult1">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="panel panel-info">
                  <div class="panel-heading">
                      <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลสถานประกอบการกลุ่มเสี่ยง</font>
                  </div>
                  <div class="panel-body">
                      <div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                      	 <div class="row">
     					 	<div class="col-xs-12 col-sm-12 col-xd-4 col-lg-4">
                            	<div class="panel panel-success">
                                	<div class="panel-heading"> 
                                 		<i class="fa fa-file"></i> text file กลุ่มเสี่ยง
                                    </div>
                                    <div class="panel-body">
                                    	
                                        <div class="row">
                                    		<div class="col-xs-12 col-xm-12 col-md-12 col-lg-12">
                                        		<div class="form-group" >
                                                    <div class="thfont4" style="">Download Textfile Sapains from SFTP:
                                                        <div class="input-group">
                                                            <input type="text" class="form-control thfont5" id="dlt1" style="height:auto;" placeholder="T8000_Wyymmdd.TXT" value="">
                                                            <span class="input-group-btn" id="loading1">
                                                                <button class="btn btn-warning thfont5" type="button" title="download textfile from sftp"  onClick="javascript:downloadtxtfileled();"><i class="fa fa-download"></i></button>
                                                                <button class="btn btn-success thfont5" type="button" title="search text file on sftp" onClick="schtxtfile();"><i class="fa fa-search"></i></button>
                                                            
															</span>
                                                        </div>
                                                    </div>
                                                </div>
                                        	</div>
                                        </div><!--row-->
                                        
                                        <div class="row">
                                        	<div class="col-xs-12 col-xm-12 col-md-12 col-lg-12">
                                            	<div id="tbrn1">
                                                	table textfile name
                                                </div>
                                            </div>
                                        </div><!--row-->
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-xd-8 col-lg-8">
                            	<div class="panel panel-info">
                                	<div class="panel-heading"> 
                                 		<i class="fa fa-address-card"></i> สถานประกอบการกลุ่มเสี่ยง
                                    </div>
                                    <div class="panel-body">
                                        
                                        <div class="row">
                                        	<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                            	<button class="btn btn-primary thfont5" onClick="chkmasdata();"><i class="fa fa-check"></i> ตรวจสอบข้อมูลหลัก</button>
                                            </div>
											<div>
                                            	<button class="btn btn-warning thfont5" onClick="loaderrtxtlog();"><i class="fa fa-file-text-o"></i> ตรวจค่าที่ไม่สามารถเพิ่มได้</button>
                                            </div>
											
                                        </div>
                                        <div class="row">
                                        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            	<hr>
                                            </div>
											
                                        </div>
                                    	<div class="row">
                                        	<div class="col-xs-12 col-xm-12 col-md-12 col-lg-12">
                                            	<div id="tbrn2">
                                    				table risk company
                                                 </div>
                                            </div>
                                        </div><!--row-->
                                        
                                    </div>
                                </div>
                            </div>
                         </div>
                      </div>
                  </div>
              </div>
         </div>
      </div>
      

</body>
</html>