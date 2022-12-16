<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Test Call DBD</title>

</head>

<body>
	<?php




	// $datesch1 = '2022-01-01 22:22:01';


	// $model = CropinfoTmpTb::model()->findAllByAttributes(array('registerdate' => $datesch1));

	// $model = CropinfoTmpTb::model()->findAll();


	// echo "Count of data : {$countmedel} Record.<br>";

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
				$rowno = 1;
				foreach ($model as $rows) {


					$registername = $rows['registername'];
					$registernumber = $rows['registernumber'];
					$acc_no = $rows['acc_no'];
					$acc_bran = $rows['acc_bran'];
					$registerdate = $rows['registerdate'];
					$crop_remark = $rows['crop_remark'];
					$crop_status = $rows['crop_status'];


				?>
					<tr <?php if ($crop_remark == 'B') {  ?> style="background-color:#FFFFC6;" <?php } else if ($crop_remark == 'A') { ?> style="background-color:#CEFFDB;" <?php } ?>>

						<td><?= $registername ?></td>
						<td style="text-align:center;"><?= $registernumber ?></td>
						<td style="text-align:center;"><?= $acc_no ?></td>
						<td style="text-align:center;"><?= $registerdate ?></td>
						<td style="color:red; text-align:center;"><span class="badge thfont3" style="color:#FF6;"><?= $crop_remark ?></span></td>

					</tr>
				<?php
					$rowno += 1;
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
							that.search(this.value)
								.draw();
						}
					});
				});

			});
		</script>
</body>

</html>