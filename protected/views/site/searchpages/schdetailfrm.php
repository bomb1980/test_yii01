<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Detail Corpinfo</title>
<script>
	$(document).ready(function() {
		//loaddbranch();
		loadcommittee();
		loaddetailcorp();
	});
	
	/*function loaddbranch(){
		var data1 = 'action=sch&regisnum=<?=$registernumber?>';
		$('#dbranch').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschbranch'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#dbranch").html(da);
			}
		});	
	}*/
	
	function loadcommittee(){
		 var data1 = 'action=sch&regisnum=<?=$registernumber?>';
	   $('#dcommittee').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	   $.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschcommittee'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#dcommittee").html(da);
			}
		});
	}
	
	function loaddetailcorp(){
		var data1 = 'action=sch&regisnum=<?=$registernumber?>';
	   $('#ddetailcorp').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	   $.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschdetailcrop'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#ddetailcorp").html(da);
			   
			}
		});
	}
	
</script>
</head>

<body>
<?php
	//echo "{$action}, {$crop_id}, {$registernumber}"; 
?>
	<div class="row">
    	<div class="col-md-12">
        	<div class="row">
            	<!--<div class="col-md-6">
                   <div id="dbranch"></div>
                </div><!--col-md-4-->
                <div class="col-md-12">
                	<div class="row">
                    	<div class="col-md-12">
                        
                        	 <div class="panel panel-danger">
                                  <div class="panel-heading">
                                      <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลเจ้าของกิจการ</font>
                                  </div>
                                  <div class="panel-body">
                                      <div id="dcommittee">เจ้าของกิจการ</div>
                                  </div>
                              </div>
                        	
                        </div><!--col-md-12-->
                    </div><!--row-->
                    <div class="row">
                    	<div class="col-md-12">
                        	 <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> รายละเอียดกิจการ</font>
                                </div>
                                <div class="panel-body">
                                    <div id="ddetailcorp">รายละเอียดกิจการ</div>
                                </div>
                            </div>
                        	
                        </div><!--col-md-12-->
                    </div><!--row-->
                </div><!--col-md-8-->
            </div><!--row-->
        </div><!--col-md-12-->
    </div><!--row-->
</body>
</html>