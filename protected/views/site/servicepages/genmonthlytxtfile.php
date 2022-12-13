<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Generate Monthly Textfile</title>
<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
		
		$('#tffstb tfoot td').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		});
		
		var table = $('#tffstb').DataTable({
			"scrollX": true,
			"order": [[ 0, "asc" ]],	
		});
		
		
		table.columns().every( function () {
			var that = this;
	 
			$( 'input', this.footer() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
						.search( this.value )
						.draw();
				}
			});
		});
	});
	
	
	var dilg1 = "";
	
	function writedatatotextfilemonthly(tffs_id,rowno,tffs_name){
		//alert('test , ' + rowno + ',' + tffs_name);
		var action = 'writedatatotextfilemonthly';
		dilg1 = new BootstrapDialog({
			type: BootstrapDialog.TYPE_WARNING,
			//size: BootstrapDialog.SIZE_WIDE,
			title: "<i class='fa fa-edit'></i><font class='thfont5'> เขียนข้อมูลลง text file : " + tffs_name + " </font>",
			message: $('<div></div>').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading..."),
			message: $('<div class="thfont5"></div>').load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/writedatatotextfilemonthly') ."'" ; ?>, { action: action, tffs_id: tffs_id, tffs_name: tffs_name  }),
			draggable: true,
			closable: true,	
			closeByBackdrop: false,
			closeByKeyboard: false,
		});
		
		 dilg1.open();
	}//function
	
	function deletefilemonthlyoldwpd(tffs_id,rowno,tffs_name){
		var data = "";
		data = "action=deltextfileoldwpd&tffs_id=" + tffs_id + "&tffs_name=" + tffs_name;
		BootstrapDialog.confirm({
			title: "<font class='thfont5'>ยืนยันการลบข้อมูล</font>",
			message: "<font class='thfont5'> ต้องการลบรายการข้อมูล '" + tffs_name + "'  ไช่ หรือ ไม่? </font>",
			type: BootstrapDialog.TYPE_DANGER,
			closable: true, 
	  		draggable: true, 
	  		btnOKLabel: 'OK', 
	  		btnCancelLabel: 'Cancel',
			callback: function(result) {
				if(result){
					$.ajax({
						type: "POST",
						url: "<?php echo Yii::app()->createAbsoluteUrl('site/deletefilemonthlyoldwpd'); ?>",
						data: data,
						success: function (msg){
							BootstrapDialog.alert('<i class="fa fa-close"></i><font class="thfont5"> ' + msg + ' </font>');
							genmonthlytxtfile();
						}//success
					});//ajax
				}//if
			}//callback
		});
	}//function
	
	
	function uploadmonthlyfileoldwpdtosftp(tffs_id, tffs_name, rowno){
		var data1 = "action=uploadoldwpd" + "&tffs_name=" + tffs_name;
		$('#owupload' + rowno).html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Uploading...");
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/calluploadmonthlyfileoldwpdtosftp'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $('#btnupload' + rowno).hide();	
			   $('#owupload' + rowno).html("Success");
			   $('#owupload' + rowno).css("color","#0C0");
			   
			   genmonthlytxtfile();
			}
		});  
	}//function
	
</script>
</head>

<body>
<?php
	//$model = Textfileforsapiens2Tb::model()->findAll();
	$qusg = new CDbCriteria( array(
					'condition' => "tffs_status <> :tffs_status ",         
					'params'    => array(':tffs_status' => 0)  
		));
	$model = MonthlytxtfileforsapiensTb::model()->findAll($qusg);
  	$countmedel = count($model);
	
	if($model){
?>
<table id="tffstb" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
	<thead>
    	<tr>
        	<th style="text-align:center; width:2%;">ลำดับ</th>
            <th style="text-align:center; width:20%;">ชื่อไฟล์</th>
 			<th style="text-align:center;">จำนวนรายการ</th>
 			<th style="text-align:left;">สร้างโดย</th>
 			<th style="text-align:left;">สร้างเมื่อ</th>
 			<th style="text-align:left;">ปรับปรุงโดย</th>
 			<th style="text-align:left;">ปรับปรุงเมื่อ</th>
 			<!--<th style="text-align:center;">หมายเหตุ</th>-->
 			<!--<th style="text-align:center;">สถานะ</th>-->
            <th style="text-align:center; width:auto;">เขียนไฟล์</th>
            <th style="text-align:center; width:auto;">upload</th>
            <th style="text-align:center; width:auto;">delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
		$rowno = 1;
		foreach ($model as $rows){ 
			$tffs_id = $rows->tffs_id;
 			$tffs_name = $rows->tffs_name;
 			$tffs_numrec = $rows->tffs_numrec;
 			$tffs_createby = $rows->tffs_createby;
 			$tffs_created = $rows->tffs_created;
 			$tffs_updateby = $rows->tffs_updateby;
 			$tffs_modified = $rows->tffs_modified;
 			$tffs_remark = $rows->tffs_remark;
 			$tffs_status = $rows->tffs_status;
		
		    $link_path = Yii::app()->params['servicelocalpath'] . "/wpdtextfile/wpdold/monthly/" . $tffs_name;
	?>
    	<tr>
        	<td style="text-align:center;"><?=$rowno?></td>
        	<td><a download href='<?=$link_path?>'> <?=$tffs_name?> </a></td>
 			<td style="text-align:center;"><?=$tffs_numrec?> รายการ</td>
 			<td><?=$tffs_createby?></td>
 			<td><?=$tffs_created?></td>
 			<td><?=$tffs_updateby?></td>
 			<td><?=$tffs_modified?></td>
 			<!--<td><?$tffs_remark?></td>-->
 			<!--<td><?$tffs_status?></td>-->
            <td style="text-align:center;">
            	<?php if($tffs_status < 3){ ?>
            	<button class="btn btn-warning" title="เขียนข้อมูลลงเท็กซ์ไฟล์" onClick="javascript:writedatatotextfilemonthly(<?=$tffs_id?>,<?=$rowno?>,'<?=$tffs_name?>');"><i class="fa fa-edit"></i></button>
                <span></span>
                <?php }else{ ?>
                	<span style="color:#090;">Success</span>
                <?php } ?>
            </td>
            <td style="text-align:center;">
            	<?php if($tffs_status < 3){ ?>
            	<button id="btnupload<?=$rowno?>" class="btn btn-primary" title="อัปโหลดไฟล์ขึ้น SFTP Server" onClick="javascript:uploadmonthlyfileoldwpdtosftp(<?=$tffs_id?>,'<?=$tffs_name?>',<?=$rowno?>);"><i class="fa fa-upload"></i></button>
                <span  id="owupload<?=$rowno?>"></span>
                <?php }else{ ?>
                	<span  id="owupload<?=$rowno?>" style="color:#090;">Success</span>
                <?php } ?>
            </td>
            <td style="text-align:center;">
            	<?php if($tffs_status < 3){ ?>
            	<button class="btn btn-danger" title="ลบไฟล์" onClick="javascript:deletefilemonthlyoldwpd(<?=$tffs_id?>,<?=$rowno?>,'<?=$tffs_name?>');"><i class="fa fa-trash"></i></button>
                <span></span>
                <?php } ?>
            </td>
        </tr>
    <?php
			$rowno += 1;
		}//for
	?>
    </tbody>
    <tfoot>
        <td>-</td>
    	<td>ชื่อไฟล์</td>
        <td>จำนวนรายการ</td>
        <td>สร้างโดย</td>
        <td>สร้างเมื่อ</td>
        <td>ปรับปรุงโดย</td>
        <td>ปรับปรุงเมื่อ</td>
        <!--<td>หมายเหตุ</td>-->
        <!--<td>สถานะ</td>-->
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tfoot>
</table>	
<?php
	}else{ //if countmodel > 0
?>
		<div style="color:#F00;"><i class="fa fa-exclamation"></i> ยังไม่มีรายการ monthly textfile ในระบบ. </div>
<?php
	}//if countmodel > 0
?>
</body>
</html>