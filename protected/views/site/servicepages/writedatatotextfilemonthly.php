<?php
	//echo "{$action}, {$tffs_id}, {$tffs_name}, {$actionby}";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>writing data to textfile</title>
<script>
	$(document).ready(function() {
		$( "#bgdatewt2" ).datepicker();
	});
	
	function getandwritedatamonthly(tffs_id,tffs_name){
		var bgdatewt2 = $("#bgdatewt2").val();	
		if(bgdatewt2){
			$('#result1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			var data1 = 'action=getandwritedatamonthly&bgdatewt2=' + bgdatewt2 + '&tffs_id=' + tffs_id + '&tffs_name=' + tffs_name;
			$.ajax({
				type: "POST", 
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/callwpddataforsapiensmonthly'); ?>",      
				data: data1,         
				success: function (da)
				{
				   $("#result1").html(da);
				   genmonthlytxtfile();
				   //table.draw('page');
				}
			});
		}else{//if
			BootstrapDialog.alert('<font class="thfont5"> กรุณาเลือกวันที่ !</font>');
		}//if
	}//function
</script>
</head>

<body>
	<div class="row">
    	<div class="col-lg-6 col-md-6 col-xm-12 col-xs-12">
        	<div class="form-group">
            	<div class="thfont5" style="">
                	<input title="จากวันที่" type="text" class="form-control thfont5" id="bgdatewt2" onChange="javascipt:;" style="height:auto;" placeholder="mm/dd/yyyy">
                </div>
       		</div>
        </div>
        <div class="col-log-6 col-md-6 col-xm-12 col-xs-12">
        	<div class="input-group-btn" id="writing1">
            	<button class="btn btn-success thfont5" type="button" title="เขียนข้อมูลลง textfile"  onClick="javascript:getandwritedatamonthly(<?=$tffs_id?>,'<?=$tffs_name?>');"><i class="fa fa-edit"></i> เขียนข้อมูลรายเดือน</button>
            </div>
        </div>
    </div><!--row-->
    
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
        	<div id="result1" class="thfont5"></div>
        </div>
    </div><!--row-->
    
</body>
</html>