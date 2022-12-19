<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Show Text File</title>
	<script>
		$(document).ready(function() {

			$('.panel').lobiPanel({
				reload: false,
				close: false,
				editTitle: false,
				sortable: true
				//minimize: false
			});

			//$('#wpddt1').DataTable();
			// Setup - add a text input to each footer cell
			$('#gtftb tfoot th').each(function() {
				var title = $(this).text();
				$(this).html('<input type="text" placeholder="' + title + '" style="width:100%; padding-left:3px;" />');
			});

			// DataTable
			var table = $('#gtftb').DataTable({
				"scrollX": true,
				"order": [
					[4, "desc"]
				],
			});

			// Apply the search
			table.columns().every(function() {
				var that = this;

				$('input', this.footer()).on('keyup change', function() {
					if (that.search() !== this.value) {
						that
							.search(this.value)
							.draw();
					}
				});
			});

		});

		function calluploadfiletosftp(gtfid, gtfname, rowno) {
			//alert(gtfid + "," + gtfname);	
			var data1 = "action=upload" + "&gtfname=" + gtfname;
			$('#stupload' + rowno).html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/calluploadfiletosftp'); ?>",
				data: data1,
				success: function(da) {
					$('#stupload' + rowno).html(da);

				}
			});
		}
	</script>
</head>

<body>
	<div class="row">
		<div class="col-md-12">
			<table id="gtftb" class="display row-border responsive nowrap table4_1" style="width:100%; height:auto; color:#003;">
				<thead>
					<tr>
						<th>ชื่อ Text File</th>
						<th>จำนวรายการ</th>
						<th>สถานะการ Gen Text File</th>
						<th>สถานะ Upload to SFTP</th>
						<th>วันที่ Generate</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$rownum = 1;

					/*$qtf = new CDbCriteria( array(
						'condition' => "registername like :schtxt ",         
						'params'    => array(':schtxt' => "%{$schtxt}%")  
					));*/

					//gentextfile_tb
					foreach ($modeltf as $rows) {
						$gtf_id = $rows->gtf_id;
						$gtf_name = $rows->gtf_name;
						$gtf_path = $rows->gtf_path;
						$gtf_countgen = $rows->gtf_countgen;
						$gtf_statusgen = $rows->gtf_statusgen;
						$gtf_statusupload = $rows->gtf_statusupload;
						$gtf_createby = $rows->gtf_createby;
						$gtf_created = $rows->gtf_created;
						$gtf_updateby = $rows->gtf_updateby;
						$gtf_modified = $rows->gtf_modified; //วันที่ upload
						$gtf_remark = $rows->gtf_remark;
						$gtf_status = $rows->gtf_status;

						$gtf_createdf = date_create($gtf_created)->format('d-m-Y');

						//$link_path =  Yii::app()->request->baseUrl  . "/assets/exportfile/" . $gtf_name; 

						$link_path = Yii::app()->params['servicelocalpath'] . "/wpdtextfile/" . $gtf_name;

					?>
						<tr>
							<td>dfdfdddf<a download href='<?= $link_path ?>'> <?= $gtf_name ?></a></td>
							<td style="text-align:center;"><?= $gtf_countgen ?> รายการ</td>
							<td style="text-align:center; color:green;"><?= $gtf_statusgen ?></td>
							<td style="text-align:center; color:green;">
								<div id="stupload<?= $rownum ?>">
									<?php if ($gtf_statusupload == 'n') { ?>
										<button class="btn btn-primary" title="อัปโหลดไฟล์ขึ้น SFTP" onClick="javascript:calluploadfiletosftp(<?= $gtf_id ?>,'<?= $gtf_name ?>',<?= $rownum ?>);"><i class="fa fa-upload"></i>
											<font class="thfont5" style="height:auto;">Upload to SFTP</font>
										</button>
									<?php } else { ?>
										Success
									<?php } ?>
								</div>
							</td>
							<td style="text-align:center;"><?= $gtf_created ?></td>
						</tr>
					<?php
						$rownum += 1;
					} //foreach ($modeltf as $rows){
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>ชื่อ Text File</th>
						<th>จำนวรายการ</th>
						<th>สถานะการ Gen Text File</th>
						<th>สถานะ Upload to SFTP</th>
						<th>วันที่ Generate</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!--col-md-12-->
	</div>
	<!--row-->
	<?php
	 
	 

	$lremark = "แสดงรายการtextfileที่เคยสร้างไว้แล้วในระบบ&จำนวน=" . count($modeltf) . "ไฟล์";
	$msgresult = Yii::app()->Clogevent->createlogevent("runservice5", "servicepage", "runservice5", "service5", $lremark);

	?>
</body>

</html>