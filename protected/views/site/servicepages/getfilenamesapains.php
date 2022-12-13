<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>get filename from sapains</title>
<style>
.tablen {
  border-collapse: collapse;
  text-align:center;
}
.tablen th{
  border: 1px solid black;
  text-align:center;
  color:#333;
}
.tablen td{
  border: 1px solid black;
  text-align:center;
  color:#333;
  cursor:pointer;
}
.tablen tr:nth-child(odd){
	background-color:#dbf2fe;
}
.tablen tr:nth-child(even){
	background-color:#fdfdfd;
}
</style>
<script>
	function writetxtsapains(tfn){
		$('#re4').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		var data1 = 'tfn=' + tfn;
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/gentxtfilesapeains'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re4").html(da);
			}
		});
	}//function
</script>
</head>

<body>
<?php
  $model = SapainstxtfileTb::model()->findAll();
  $countmedel = count($model);
  //echo "{$countmedel}";
  if($countmedel===0){
	echo "ไม่พบไฟล์ที่ download จาก sftp sapains <br>";  
  }else{
	echo "จำนวนไฟล์ที่ download จาก sftp sapains : {$countmedel} รายการ <br>";   
?>
<div style="overflow-x:hidden; overflow-y:auto; height:330px;">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
    	<table class="tablen">
        	<thead>
                <tr>
                    <th>No.</th>
                    <th>ชื่อไฟล์</th>
                    <th>สถานะ</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
				$rowno = 1;
				foreach ($model as $rows){
					$sptf_filename = $rows->sptf_filename;
					$sptf_path = $rows->sptf_path;
					$sptf_numrec = $rows->sptf_numrec;
					$sptf_createby = $rows->sptf_createby;
					$sptf_created = $rows->sptf_created;
					$sptf_updateby = $rows->sptf_updateby;
					$sptf_modified = $rows->sptf_modified;
					$sptf_remark = $rows->sptf_remark;
					$sptf_status = $rows->sptf_status;
					
					if($sptf_status==='1'){
						$sptf_status_txt = "ยังไม่เขียนไฟล์";
					}else{
						$sptf_status_txt = "เขียนไฟล์แล้ว";
					}
			?>
            
            	<tr <?php if($sptf_status==='2'){ ?> style="background-color:#FCF;" <?php } ?>>
                    <td><?=$rowno?></td>
                    <td><?=$sptf_filename?></td>
                    <td><?=$sptf_status_txt?></td>
                    <td>
                    	<?php
							if($sptf_status==='1'){
						?>
                    			<button class="btn btn-success thfont5" title="เขียนไฟล์" onClick="javascript:writetxtsapains('<?=$sptf_filename?>');"><i class="fa fa-edit"></i> </button>
                        <?php
							}//if
						?>
                    </td>
                </tr>
            
            <?php
					$rowno += 1;
				}//for
			?>
            </tbody>
        </table>
    </div>
  </div>
</div>	
<?php  
  }//if
?>
</body>
</html>