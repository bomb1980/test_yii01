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

	$username = "sys";
	$brachcode = "-";

	$now = date_create('now')->format('Y-m-d H:i:s');
	$tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
	$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
	$daten1 = date('Y-m-d H:i:s');

	$startdate = $bgdatep . "T00:00:00+07:00";
	$enddate = $eddatep . "T23:59:59+07:00";

	$startdate = date_create($startdate)->format('Y-m-d') . "T00:00:00+07:00";
	$enddate = date_create($enddate)->format('Y-m-d') . "T23:59:59+07:00";

	$rundate = date_create($bgdatep)->format('Ymd');

	echo "Date formate : {$startdate}, {$enddate} <br>";

	$datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
	$datesch2 = date_create($enddate)->format('Y-m-d H:i:s');

	$q = new CDbCriteria(array(
		'condition' => "registerdate = :registerdate AND crop_remark = :crop_remark ",
		'params'    => array(':registerdate' => $datesch1, 'crop_remark' => 'N')
	));

	// cropinfo_tmp_tb
	$r = CropinfoTmpTb::model()->findAll($q);
	$r = CropinfoTmpTb::model()->findAll();

	// arr( $r );

	// exit;
	$c = count($r);
	echo "Count of data is update {$c} Record. <br>";
	foreach ($r as $rows) {


		// arr( $rows );

		$crop_id = $rows->crop_id;
		$registernumber = $rows->registernumber;

		$regisarr = str_split($registernumber);
		$provicecode = $regisarr[1] . $regisarr[2];

		$q2 = new CDbCriteria(array(
			'condition' => "prvi_code = :prvi_code ",
			'params'    => array(':prvi_code' => $provicecode)
		));
		$r2 = ProviceTb::model()->findAll($q2);
		$c2 = count($r2);
		foreach ($r2 as $rows) {
			$prvi_id = $rows->prvi_id;
			$lastnum = $rows->prvi_remark;
		}
		$rowcountpv = $lastnum + 1;

		$dg12 = $provicecode;

		$dg3 = "2";

		$dg49 = str_pad($rowcountpv, 6, 0, STR_PAD_LEFT);

		$accno = $dg12 . $dg3 . $dg49;

		$sarray = str_split($accno);


		// arr($sarray);

		//****** gen check digit ****************************
		$dd1 = $sarray[0] * 10;
		$dd2 = $sarray[1] * 9;
		$dd3 = $sarray[2] * 8;
		$dd4 = $sarray[3] * 7;
		$dd5 = $sarray[4] * 6;
		$dd6 = $sarray[5] * 5;
		$dd7 = $sarray[6] * 4;
		$dd8 = $sarray[7] * 3;
		$dd9 = $sarray[8] * 2;

		$sumdd = $dd1 + $dd2 + $dd3 + $dd4 + $dd5 + $dd6 + $dd7 + $dd8 + $dd9;
		$mod11 = $sumdd % 11;
		if ($mod11 == 0) {
			$div11 = 1;
		} else if ($mod11 == 1) {
			$div11 = 0;
		} else {
			$div11 = 11 - $mod11;
		}
		//****** end gen check digit ****************************  

		$accnogen = $dg12 . $dg3 . $dg49 . $div11;

		//****** update provicetb ********************************
		$update1 = ProviceTb::model()->findByPk($prvi_id);
		// $update1 = ProviceTb::model()->findByPk(1);
		// arr( $rows );


		$update1->prvi_remark = $rowcountpv;

		//provice_tb
		if ($update1->save()) {
			$msgerr = "update data is success.";
		} else {
			$msgerr = $update1->getErrors();
			echo "{$msgerr}<br>";
		}


		// arr($prvi_id);

		//******* update cropinfo **********************************
		$update2 = CropinfoTmpTb::model()->findByPk($crop_id);
		$update2->acc_no = $accnogen;
		$update2->crop_remark = "P";
		$update2->crop_updateby = $username;
		$update2->crop_updatetime = date('Y-m-d H:i:s');
		$update2->crop_status = 2;
		if ($update2->save()) {

			// arr($update2);
			$msgerr = "update data is success.";
			//****** insert accnumber_tb ****************************************
			$AccnumberTb = new AccnumberTb();
			$AccnumberTb->acc_no = $accnogen;
			$AccnumberTb->acc_bran = "000000";
			$AccnumberTb->acc_regis_no = $registernumber;
			$AccnumberTb->acc_active_flag = "N";
			$AccnumberTb->acc_using_date = date('Y-m-d H:i:s');
			$AccnumberTb->acc_createby = $username;
			$AccnumberTb->acc_created = date('Y-m-d H:i:s');
			$AccnumberTb->acc_updateby = $username;
			$AccnumberTb->acc_modified = date('Y-m-d H:i:s');
			$AccnumberTb->acc_remark = "P";
			$AccnumberTb->acc_status = 2;
			if ($AccnumberTb->save()) {

				$msgerr2 = "update data is success.";
				$cropid = $crop_id;
				$registernumber = $registernumber;
				Yii::app()->Cwpdreport->createcrop_v_bran($cropid, $registernumber);
			} else {
				 
				$msgerr2 = $AccnumberTb->getErrors();
				echo "{$msgerr2}<br>";
			}
		} else {
			$msgerr = $update2->getErrors();
			echo "{$msgerr}<br>";
		}

		//echo "{$registernumber}, {$provicecode} , {$accnogen}, {$msgerr} <br>";	

	} //foreach

	$lremark = "generateเลขประกันสังคม10หลัก:service1&เปลี่ยนสถานะจากPเป็นB:จำนวนrecord" . $c;
	$msgresult = Yii::app()->Clogevent->createlogeventauto("runservice", "servicepage", "runservice1", "service1", $lremark);


	$model = CropinfoTmpTb::model()->findAllByAttributes(array('registerdate' => $datesch1));
	// $model = CropinfoTmpTb::model()->findAll();
	$countmedel = count($model);

	echo "Count of data : {$countmedel} Record.<br>";

	?>
	<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
		<table id="wpddt1" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
			<thead>
				<tr>
					<!--<th>ลำดับ</th>-->
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
					$registername = $rows->registername;
					$registernumber = $rows->registernumber;
					$acc_no = $rows->acc_no;
					$acc_bran = $rows->acc_bran;
					$registerdate = $rows->registerdate;
					$crop_remark = $rows->crop_remark;
					$crop_status = $rows->crop_status;

				?>
					<tr <?php if ($crop_remark == 'B') {  ?> style="background-color:#FFFFC6;" <?php } else if ($crop_remark == 'A') { ?> style="background-color:#CEFFDB;" <?php } ?>>
						<!--<td style="text-align:center;"><? //$rowno
												?></td>-->
						<td><?= $registername ?></td>
						<td style="text-align:center;"><?= $registernumber ?></td>
						<td style="text-align:center;"><?= $acc_no ?></td>
						<td style="text-align:center;"><?= $registerdate ?></td>
						<td style="color:red; text-align:center;"><span class="badge thfont3" style="color:#FF6;"><?= $crop_remark ?></span></td>

					</tr>
				<?php




					$rowno += 1;
				} //foreach ($model as $rows){

				?>
			</tbody>
			<tfoot>
				<tr>
					<!--<th>ลำดับ</th>-->
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