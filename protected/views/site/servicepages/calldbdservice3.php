<!DOCTYPE html PUBLIC>
<html>

<head>
	<meta charset="utf-8" />
	<title>Gen SSO Account number</title>
	<script>
		$(document).ready(function() {
			$('#wpddt1 tfoot th').each(function() {
				var title = $(this).text();
				$(this).html('<input type="text" placeholder="' + title + '" style="width:100%; padding-left:3px;" />');
			});
			var table = $('#wpddt1').DataTable({
				"scrollX": true,
			});
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
	</script>
</head>

<body>
	<?php

	
	$lremark = "generateเลขประกันสังคม10หลัก:service1&เปลี่ยนสถานะจากPเป็นB:จำนวนrecord";
	$msgresult = Yii::app()->Clogevent->createlogevent("runservice", "servicepage", "runservice1", "service1", $lremark);


	$countmedel = count($model);

	echo "Count of data : {$countmedel} Record.<br>";

	?>
	<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
		<table id="wpddt1" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
			<thead>
				<tr>
					<th>ชื่อนิติบุคคล</th>
					<th>เลขนิติบุคคล 13 หลัก</th>
					<th>เลขประกันสังคม 10 หลัก</th>
					<th>วันที่จดทะเบียน</th>
					<th>สถานะ</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sendmailno = 0;
				$rowno = 1;
				foreach ($model as $rows) {

					$crop_remark = $rows['crop_remark'];
				?>
					<tr <?php if ($crop_remark == 'B') {  ?> style="background-color:#FFFFC6;" <?php } else if ($crop_remark == 'A') { ?> style="background-color:#CEFFDB;" <?php } ?>>
						<td><?= $rows['registername'] ?></td>
						<td style="text-align:center;"><?= $rows['registernumber'] ?></td>
						<td style="text-align:center;"><?= $rows['acc_no'] ?></td>
						<td style="text-align:center;"><?= $rows['registerdate'] ?></td>
						<td style="color:red; text-align:center;"><span class="badge thfont3" style="color:#FF6;"><?= $rows['crop_remark'] ?></span></td>

					</tr>
				<?php $rowno += 1;
				} 

				?>
			</tbody>
			<tfoot>
				<tr>
					<th>ชื่อนิติบุคคล</th>
					<th>เลขนิติบุคคล 13 หลัก</th>
					<th>เลขประกันสังคม 10 หลัก</th>
					<th>วันที่จดทะเบียน</th>
					<th>สถานะ</th>

				</tr>
			</tfoot>
		</table>
</body>

</html>