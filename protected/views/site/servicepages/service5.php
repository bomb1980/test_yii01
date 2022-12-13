<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Service 1</title>
<style>
.rcorners {
  border-radius: 10px;
  border: 1px solid #666;
  padding: 5px;
  margin-bottom: 5px;
}
</style>
<script>
	$(document).ready(function() {
		
		
		
		$('.panel').lobiPanel({
       		reload: false,
    		close: false,
			editTitle: false,
			sortable: true
			//minimize: false
		});
		
				// Setup - add a text input to each footer cell
		$('#example tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'"  style="width:100%; padding-left:3px;" />' ); //placeholder="'+title+'"
		} );
		
		// DataTable
    	var table = $('#example').DataTable({
			"scrollX": true,	
		});
		
		// Apply the search
		table.columns().every( function () {
			var that = this;
	 
			$( 'input', this.footer() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
						.search( this.value )
						.draw();
				}
			} );
		} );
		
		callshowtextfile();

	});


	var newda="";
	var upda="";
	function  callschcrop2(){
		//alert('ok');
		//BootstrapDialog.alert('ok');	
		var bgdate = $("#bgdate").val();
		var eddate = $("#eddate").val();
		
		
		if($('#newdata').is(':checked')){
			newda = $("#newdata").val();
		}else{
			newda = 0;	
		}
		
		if($('#upddata').is(':checked')){
			upda = $("#upddata").val();
		}else{
			upda = 0;	
		}
		
		if(!bgdate){
			BootstrapDialog.alert('กรุณาเลือกวันที่เริ่มต้นก่อน !');
			$("#eddate").val("");
			$("#bgdate").focus();
			$("#bgdate").select();
		}else
		if(bgdate > eddate){
			BootstrapDialog.alert('กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !');
			$("#eddate").val("");
			$("#eddate").focus();
			$("#eddate").select();	
		}else
		if(newda == 0){
			BootstrapDialog.alert('กรุณาเลือก "รายการใหม่" !');
		}else{
			//send ajax function
			$("#rowresult1").show();
			ajaxsendparams2(bgdate,eddate,newda,upda);
		}
	}
	
	function chkbgdate(){
		
		var bgdate = $("#bgdate").val();
		var eddate = $("#eddate").val();
		
		
		if($('#newdata').is(':checked')){
			newda = $("#newdata").val();
		}else{
			newda = 0;	
		}
		
		if($('#upddata').is(':checked')){
			upda = $("#upddata").val();
		}else{
			upda = 0;	
		}
		
		if(!bgdate){
			BootstrapDialog.alert('กรุณาเลือกวันที่เริ่มต้นก่อน !');
			$("#eddate").val("");
			$("#bgdate").focus();
			$("#bgdate").select();
		}else
		if(bgdate > eddate){
			BootstrapDialog.alert('กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !');
			$("#eddate").val("");
			$("#eddate").focus();
			$("#eddate").select();	
		}else
		if(newda != 0){
			//BootstrapDialog.alert('กรุณาเลือก "รายการใหม่" !');
		}
	}
	
	function ajaxsendparams2(bgdatep,eddatep,newdap,updap){

		var data1 = 'bgdatep=' + bgdatep + '&eddatep=' + eddatep + '&newdap=' + newdap + '&updap=' + updap;
		
		$('#res1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$('#res2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$('#res3').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschstatusp'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#res1").html(da);
			   
			}
		});
		
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschstatusb'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#res2").html(da);
			   
			}
		});
		
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschstatusa'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#res3").html(da);
			   
			}
		});
		
	}
	
	function setenddate(){
		$("#eddate").focus();
		$("#eddate").val($("#bgdate").val());
	}
	
	function callgentextfile(){
		var bgdate = $("#bgdate").val();
		var eddate = $("#eddate").val();
		
		//alert(bgdate + "," + eddate);
		
		var data1 = 'action=gent&statusgt=B';
		$('#res4').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callgentextfile'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#res4").html(da);
			}
		});
		
	}
	
	function callshowtextfile(){
		var data1 = 'action=sch';
		$('#res4').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");	
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callshowtextfile'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#res4").html(da);
			}
		});
	}
	
	function calluploadfile(tfid){
		//alert('id of textfile:' + tfid);	
		var data1 = 'action=upload&tfid=' + tfid;
		//alert(data1);
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/calluploadfile'); ?>",      
			data: data1,         
			success: function (da)
			{
			   var obj = jQuery.parseJSON(da);
			   if(obj.status=='success'){
				   //$("#res4").html(da);
			   	   callshowtextfile();
			   }else if(obj.status=='error'){
			   	   BootstrapDialog.alert('<font class="thfont5">ไม่สามารถ upload file ได้!</font>');
			   }
			   
			}
		});
	}
	
</script>


</head>

<body>
<!--
	<div class="about_title thfont5" style="font-size:30px;">Export textfile & Upload to SFTP</div>
    	<div class="row">
    		<div class="col-md-12"><!--rcorners
            	<div class="row">
                	<div class="col-md-3">
                      <div class="form-group">
                          <p class="thfont4" style="">จากวันที่: <input type="date" class="form-control thfont5" id="bgdate" onChange="javascript:setenddate();" ></p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <p class="thfont4" style="">ถึงวันที่: <input type="date" class="form-control thfont5" id="eddate" onChange="javascript:chkbgdate();" disabled></p>
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        	<p class="thfont4" style="">
                            	ประเภทข้อมูล:
                                <div class="form-check form-check-inline">
                                	<input class="form-check-input" type="checkbox" id="newdata" value="1" checked>
                                	<label class="form-check-label thfont3" for="newdata">รายการใหม่</label>&nbsp;&nbsp;
                                	<input class="form-check-input" type="checkbox" id="upddata" value="2" disabled>
                                	<label class="form-check-label thfont3" for="upddata">รายการที่ปรับปรุง</label>
                            	</div>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                    	<div class="form-group">
                        	<p class="" style=""><br><br>
                                </p>
                        </div>
                    </div>
            	</div><!--row
                <div class="row">
                	<div class="col-md-12">
                    	<button class="btn btn-info" onClick="javascript:callschcrop2();"><i class="fa fa-search"></i><font class="thfont5"> ค้นหาข้อมูลนิติบุคคล</font></button>
                        <!--<button class="btn btn-info" onClick="javascript:sendparams();"><i class="fa fa-file"></i> <font class="thfont5">Generate Text File </font></button>
                    </div>
                </div><!--row
                
            </div>
        </div>
        <br>
        
        <div class="row" id="rowresult1">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลนิติบุคคล</font>
                    </div>
                    <div class="panel-body">
                        <div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                         <div class="row">
                         	<div class="col-md-4">
                            	<div class="panel panel-warning">
                                	<div class="panel-heading">
                        				<i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> รายการสถานะเป็น P</font>
                    				</div><!-- panel heading 
                                    <div class="panel-body">
                                    	<div id="res1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                                        
                                        </div>
                                    </div><!--panel body 
                                    <div class="panel-footer">
                                    	<button class="btn btn-info"><i class="fa fa-newspaper-o"></i><font class="thfont5"> Detail</font></button>
                                    </div><!--panel footer
                                </div><!-- panel 
                            </div><!--col
                            <div class="col-md-4">
                            	<div class="panel panel-warning">
                                	<div class="panel-heading">
                        				<i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> รายการสถานะเป็น B</font>
                    				</div><!-- panel heading 
                                    <div class="panel-body">
                                    	<div id="res2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                                        
                                        </div>
                                    </div><!--panel body 
                                     <div class="panel-footer">
                                    	<button class="btn btn-info"><i class="fa fa-newspaper-o"></i><font class="thfont5"> Detail</font></button>
                                        <!--<button class="btn btn-primary" onClick="javascript:callgentextfile();"><i class="fa fa-file"></i><font class="thfont5"> Generate Text File </font></button>-->
                                    </div><!--panel footer
                                </div><!-- panel 
                            </div><!--col
                            <div class="col-md-4">
                            	<div class="panel panel-warning">
                                	<div class="panel-heading">
                        				<i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> รายการสถานะเป็น A</font>
                    				</div><!-- panel heading 
                                    <div class="panel-body">
                                    	<div id="res3" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                                        
                                        </div>
                                    </div><!--panel body 
                                     <div class="panel-footer">
                                    	<button class="btn btn-info"><i class="fa fa-newspaper-o"></i><font class="thfont5"> Detail</font></button>
                                    </div><!--panel footer
                                </div><!-- panel 
                            </div><!--col
                            
                         </div><!--row
                        
                            
                            	
                            
        
                        </div>
                    </div>
                </div>
           </div>
        </div><!--row-->
        
        <div class="row">
        	<div class="col-md-12">
            	<div class="about_title thfont5" style="font-size:30px;">Export textfile & Upload to SFTP</div>
            </div>
        </div>
        
        <div class="row">
        	<div class="col-md-12">
            	 <button class="btn btn-primary" onClick="javascript:callgentextfile();"><i class="fa fa-file"></i><font class="thfont5"> Generate Text File </font></button>
                 <button class="btn btn-info" onClick="javascript:callshowtextfile();"><i class="fa fa-file"></i><font class="thfont5"> Show Text Files</font></button>
            </div>
        </div><!--row-->
        
        <div class="row" style="padding-top:15px;">
          <div class="col-md-12">
              <div class="panel panel-info">
                  <div class="panel-heading">
                      <i class="fa fa-file"></i><font class="thfont5" style="font-size:24px;"> รายการ Text file</font>
                  </div><!-- panel heading -->
                  <div class="panel-body">
                      <div id="res4" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                          
                      </div>
                  </div><!--panel body -->
                  <div class="panel-footer">
                      
                  </div><!--panel footer-->
              </div>
        </div>
      </div>
        
</body>
</html>