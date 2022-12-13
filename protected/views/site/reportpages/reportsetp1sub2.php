<?php

use function GuzzleHttp\Psr7\str;

set_time_limit(0);
ini_set("max_execution_time", "0");
ini_set("memory_limit", "9999M");
//$slv = $_GET['slv'];
$df1d = date_create($d1)->format('d');
$df1m = date_create($d1)->format('m');
$df1y = date_create($d1)->format('Y') + 543;
$df1dmy = $df1y . "-" . $df1m . '-' . $df1d;
$df1 = date_create($df1dmy)->format('d/m/Y'); //date("d/m/Y", $d1);

$df2d = date_create($d2)->format('d');
$df2m = date_create($d2)->format('m');
$df2y = date_create($d2)->format('Y') + 543;
$df2dmy = $df2y . "-" . $df2m . '-' . $df2d;
$df2 = date_create($df2dmy)->format('d/m/Y'); //date("d/m/Y", $d2);

$sso1 = $sso1;
$bct = $bct;
$bc = $bc;
$sso1t = $sso1t;


$sso1str01 = substr($sso1, 0, 2);
$sso1str = $sso1; //substr($sso1,0,2) . "%";  //เปลี่ยนเงื่อนไขในการดูรายงานให้ตรงกับเลข baran_code 4 หลัก หรือ 2 หลัก
$datesch1 = date_create($d1)->format('Y-m-d');
$datesch2 = date_create($d2)->format('Y-m-d');

/*echo "<br><br><br><br>";
		echo "$action,$d1,$d2,$sso1,$bct,$bc,$sso1t,$ssos2";
		echo "<br><br><br><br>";
		echo "$datesch1, $datesch2";*/
//echo "<br><br><br>";

/*$criteria = new CDbCriteria();
		$criteria->select = 'oel_id, oel_registernumber, oel_accno, oel_registername, oel_emailaddress, oel_registerdate, oel_updatedate, oel_emailtype, oel_answer, oel_remark, oel_status';
		$criteria->condition = 'oel_registerdate Between :bdate And :edate And oel_status = :ans_status';
		$criteria->params = array(':bdate'=>"{$datesch1}", ':edate'=>"{$datesch2}", ':ans_status'=>"P");*/

/*$criteria = new CDbCriteria();
		$criteria->select = 'oel_id, oel_registernumber, oel_accno, oel_registername, oel_emailaddress, oel_registerdate, oel_updatedate, oel_emailtype, oel_answer, oel_remark, oel_status';
		$criteria->condition = 'oel_registerdate Between :bdate And :edate AND oel_answer = :oel_answer AND oel_status = :ans_status';
		$criteria->params = array(':bdate'=>"{$datesch1}", ':edate'=>"{$datesch2}", ':oel_answer'=>"{$ssos2str}", ':ans_status'=>"P");*/

/*$criteria = new CDbCriteria();
		$criteria->select = 'oel_id, oel_registernumber, oel_accno, oel_registername, oel_emailaddress, oel_registerdate, oel_updatedate, oel_emailtype, oel_answer, oel_remark, oel_status';
		$criteria->condition = 'oel_registerdate Between :bdate And :edate  AND oel_remark= :oel_remark AND oel_status= :oel_status';
		$criteria->params = array(':bdate'=>"{$datesch1}", ':edate'=>"{$datesch2}", ':oel_remark'=> "{$sso1}" ,':oel_status'=>"P");*/

/*$criteria = new CDbCriteria();
		$criteria->select = 'oel_id, oel_registernumber, oel_accno, oel_registername, oel_emailaddress, oel_registerdate, oel_updatedate, oel_emailtype, oel_answer, oel_remark, oel_status';
		$criteria->condition = 'oel_registerdate Between :bdate And :edate AND oel_answer= :oel_answer AND oel_remark= :oel_remark AND oel_status= :oel_status';
		$criteria->params = array(':bdate'=>"{$datesch1}", ':edate'=>"{$datesch2}", ':oel_answer'=>"{$ssos2str}", ':oel_remark'=> "{$sso1}" ,':oel_status'=>"P");*/

//$modelast = OtpEmailTb::model()->findAll($criteria);
//$modelast = Countallstatus::model()->findBySQL($sqlrpt);
//$countast = count($modelast);

//echo "{$countast}";		  

//exit();



$this->pageTitle = 'report - ' . $sso1t;
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png">

	<title>Report page1</title>
	<script>
		function dilldownrpt1() {
			//alert('test');	
		}
	</script>
	<style>
		@import url("<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/webfonts/thcharmau/stylesheet.css");
		@import url("<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/webfonts/vivak/stylesheet.css");
		@import url("<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/webfonts/thsarabun/stylesheet.css");

		.thfont1 {
			font-family: thcharmau;
			font-size: 21px;
		}

		.thfont2 {
			font-family: vivak;
			font-size: 21px;
		}

		.thfont3 {
			font-family: THSarabun;
			font-size: 21px;
		}

		.thfont4 {
			font-family: THSarabun;
			font-size: 26px;
			color: #666;
		}

		.thfont5 {
			font-family: THSarabun;
			font-size: 24px;
			line-height: normal;
			/*font-weight:bold;*/
		}

		.thfont6 {
			font-family: THSarabun;
			font-size: 18px;
			line-height: normal;
			/*font-weight:bold;*/
		}

		a:link {
			color: black;
			background-color: transparent;
			text-decoration: none;
		}

		a:visited {
			color: black;
			background-color: transparent;
			text-decoration: none;
		}

		a:hover {
			color: red;
			background-color: transparent;
			text-decoration: underline;
		}

		a:active {
			color: black;
			background-color: transparent;
			text-decoration: underline;
		}
	</style>
</head>

<body>

	<?php

	$SSO_BRAN_CODE = array();
	$array_name = array();
	$array_p = array();
	$array_b = array();
	$array_a = array();
	$array_total = array();
	//////////////////////////กำหนดตัวแปร array เอาไว้ oeltb
	$oel_id_array = array();
	$oel_registernumber_array = array();
	$oel_accno_array = array();
	$oel_registername_array = array();
	$oel_emailaddress_array = array();
	$oel_registerdate_array = array();
	$oel_updatedate_array = array();
	$oel_emailtype_array = array();
	$oel_answer_array = array();
	$oel_remark_array = array();
	$oel_status_array = array();
	$crop_remark_array = array();
	///////////////////////กำหนดตัวแปร array เอาไว้ crop_V_branntb
	$cbid_array = array();
	$brch_id_array = array();
	$crop_id_array = array();
	$registerdate_array = array();
	$registername_array = array();
	$acc_no_array = array();
	$crop_remark_array = array();
	$crop_createtime_array = array();
	$crop_updatetime_array = array();
	$crop_status_array = array();
	$registernumber_array = array();


	$params = array();

	if ($sso1 == '0') { //ทั่วประเทศ

		if ($sso1 == '0') { //ถ้าเลือกดูทุกสถานะ
			$conn = Yii::app()->db3;
			$sql = "
				select * from 
				crop_v_bran where registerdate 
				between :bdate AND :edate and crop_remark='P'
 				
				";

			$params[':bdate'] = $datesch1;
			$params[':edate'] = $datesch2;
		} else { //เลิอกดูบางสถานะ
			$conn = Yii::app()->db4;
			$sql = "
			SELECT t1.*
					FROM otp_email_tb t1
					JOIN
					(
						SELECT MAX(oel_updatedate) ,MAX(oel_id) AS oel_id
						FROM otp_email_tb 
						WHERE oel_registerdate BETWEEN :bdate AND :edate and oel_answer =:oel_answer AND oel_answer is null and oel_emailtype='2' and (oel_status REGEXP '^[0-9]+$' OR oel_status IN('P','P2',''))
						GROUP BY oel_accno  
					) t2 ON t1.oel_id = t2.oel_id ORDER BY oel_accno;
		";
			$params[':bdate'] = $datesch1;
			$params[':edate'] = $datesch2;
		
		}
	} else {
		
		$conn = Yii::app()->db4;
		$sql = "
		SELECT t1.*
		FROM otp_email_tb t1
		JOIN
		(
			SELECT MAX(oel_updatedate) ,MAX(oel_id) AS oel_id
			FROM otp_email_tb 
			WHERE oel_registerdate BETWEEN :bdate AND :edate AND oel_remark=:oel_remark and oel_emailtype='2' AND oel_answer is null AND (oel_status REGEXP '^[0-9]+$' OR oel_status IN('','P2','P')) 
			GROUP BY oel_accno  
		) t2 ON t1.oel_id = t2.oel_id ORDER BY oel_accno;";
			$params[':bdate'] = $datesch1;
			$params[':edate'] = $datesch2;
			$params[':oel_remark'] = $sso1;
		}
	 //if

	 $command = $conn->createCommand($sql);
	 foreach ($params as $key => $value) {
		 $command->bindValue($key, $value);
	 }
 
	 $modelast = $command->queryAll();
	 unset($params);
	 $countast = count($modelast);
	//$xg = count($modelast);
	//echo($xg);
	//exit();

	if ($sso1 == '0') {


		if ($sso1 == '0') {
			$conn = Yii::app()->db4;
			$sql = "
			SELECT t1.*
			FROM otp_email_tb t1
			JOIN
			(
				SELECT MAX(oel_updatedate) ,MAX(oel_id) AS oel_id
				FROM otp_email_tb 
				WHERE oel_registerdate BETWEEN :bdate AND :edate AND oel_answer is null and oel_emailtype='2' AND (oel_status REGEXP '^[0-9]+$' OR oel_status IN('','P2','P')) 
				GROUP BY oel_accno  
			) t2 ON t1.oel_id = t2.oel_id ORDER BY oel_accno;";
			$command = $conn->createCommand($sql);


			$command->bindValue(":bdate", $datesch1);
			$command->bindValue(":edate", $datesch2);
		} 
		$rowsA = $command->queryAll();

		$arr_rowsA = array();
		foreach ($rowsA as $dataitem) {
			$arr_rowsA[$dataitem['oel_registernumber']] = $dataitem['oel_emailtype']; //เอาregister number ไปเชค oel_answer มาใส่ต่อท้าย

		}
	} else {
		
		$conn = Yii::app()->db4;
		$sql = "
		SELECT t1.*
		FROM otp_email_tb t1
		JOIN
		(
			SELECT MAX(oel_updatedate) ,MAX(oel_id) AS oel_id
			FROM otp_email_tb 
			WHERE oel_registerdate BETWEEN :bdate AND :edate AND oel_remark=:oel_remark and oel_emailtype='2' AND oel_answer is null AND (oel_status REGEXP '^[0-9]+$' OR oel_status IN('','P2','P')) 
			GROUP BY oel_accno  
		) t2 ON t1.oel_id = t2.oel_id ORDER BY oel_accno;";
			$params[':bdate'] = $datesch1;
			$params[':edate'] = $datesch2;
			$params[':oel_remark'] = $sso1;
		
	 //if

		$rowsA = $command->queryAll();

		$arr_rowsCO = array();
		foreach ($rowsA as $dataitem) {
			$arr_rowsCO[$dataitem['oel_registernumber']] = $dataitem['oel_remark'];
		}
		// var_dump($arr_rowsCO);
		// exit();

	}
	//var_dump($arr_rowsA);
	//$xs = count($arr_rowsA);
	//echo $xs;
	//exit();
	$sorta = array();
	if ($countast > 0) {
		$sumcol1 = 0;
		$sumcol2 = 0;
		$sumcol3 = 0;
		$sumcol4 = 0;
		foreach ($rowsA as $rows) {
			$oel_emailtype = '';
	

			if ($sso1 == '0') {
					$oel_emailtype = $arr_rowsA[$rows['oel_registernumber']];
			}else{
					$oel_emailtype = $countast[$rows['oel_registernumber']];
			}
		//	var_dump($oel_emailtype);
		//	exit();
				

				$cbid_array[] = $rows['oel_id'];
				$registernumber_array[] = $rows['oel_registernumber'];
				$acc_no_array[] = $rows['oel_accno'];
				$registername_array[] = $rows['oel_registername'];
				$registerdate_array[] = substr($rows['oel_registerdate'], 0, -9);
				$crop_updatetime_array[] = $rows['oel_updatedate'];
				$crop_status_array[] = $rows['oel_status'];
				

				if (array_key_exists($rows['oel_registernumber'], $modelast)) {

					$crop_remark_array[] =  $modelast[$rows['oel_registernumber']]; //$rows''['oel_remark']'';
					$crop_remark_str = $modelast[$rows['oel_registernumber']];
				} else {
					$crop_remark_array[] =  ""; //$rows''['oel_remark']'';
					$crop_remark_str = "";
				}
				$SSO_BRAN_CODE_array[] = $sso1; //สร้างอาเรมารับค่า crop_remark
				$oel_status_array[] =  $rows['oel_emailtype'];
				$rowse = '';
				if (!is_null($rows['oel_emailtype'])) {
					$rowse = $rows['oel_emailtype'];
				}
				$sorta[] = [
					'oel_id' => $rows['oel_id'],
					'oel_registernumber' => $rows['oel_registernumber'],
					'oel_accno' => $rows['oel_accno'],
					'oel_registername' => $rows['oel_registername'],
					'oel_registerdate' => substr($rows['oel_registerdate'], 0, -9),
					'oel_updatedate' => $rows['oel_updatedate'],
					'oel_status' => $rows['oel_status'],
					'crop_remark_str' => $crop_remark_str,
					'sso1' => $sso1,
					'oel_emailtype' => $rowse,

					
				];
		
		
		$sumcol1 = $sumcol1 + 1;
	}
			
	} else {

	?>
		<script>
			alert('ไม่พบรายการข้อมูล ตามเงื่อนไขที่เลือก!');
		</script>
	<?php
	}
	
	$marks = array();
	$marks2 = array();
	$x = array();

	

	foreach ($sorta as $key => $row) {
		
		$marks[$key] = $row['crop_remark_str'];
		$marks2[$key] = $row['oel_registernumber'];
	//	$marks3[$key] = $row['oel_emailtype'];
		if (is_null($row['oel_emailtype'])) {
			$x[$key] = '';
		} else {
			$x[$key] = $row['oel_emailtype'];
		}
		

		//$marks2[$key] = $row['oel_registernumber'];
		//$countsorta = $countsorta + 1 ;


	}


	//var_dump($sorta);
	


	//$oel_answer = array_column($sorta, 'oel_answer');
	//var_dump($oel_answer);



	//echo array_count_values(array_column($sorta, 'oel_answer'))[$countNE];
	//	$ar = array_replace($sorta,array_fill_keys(array_keys($sorta, NULL),''));





	//$countast = 50;

	//echo "{$array_name[2]},{$array_p[2]},{$array_b[2]},{$array_a[2]}<br>";
	?>
	<?php
	echo count($cbid_array);
	//exit();
	$total_record = count($cbid_array); //40; //จำนวน record ทั้งหมด ที่ดึงออกมาจาก ฐานข้อมูลได้
	//$total_record = $countast; //40; //จำนวน record ทั้งหมด ที่ดึงออกมาจาก ฐานข้อมูลได้
	$perpage = 30; //จำนวน record ที่ต้องการให้แสดงต่อ 1 หน้า
	$total_page = ceil($total_record / $perpage);  //จำนวนหน้าทั้งหมด
	$beginpage = 1; //เลขหน้าเริ่มต้น
	$endpage = $total_page; //เลขหน้าสุดท้าย
	$rowt = $total_record; //จำนวน record ทั้งหมดที่จะให้แสดง
	$rowl = 1; //เลขแถวที่ต้องการให้เริ่มต้น

	for ($i = $beginpage; $i <= $endpage; $i++) { //เริ่ม page
	?>
		<div class="page-break<?= ($i == 1) ? "-no" : "" ?>">&nbsp;</div>
		<page size='A4'>
			<!-- start page -->


			<table id="tbp1" width="750" border="0" align="center" cellpadding="0" cellspacing="0">
				<!-- report header -->
				<tr>
					<td align="right" style="text-align:right;" class="thfont3">หน้าที่ <?php echo " {$i}/{$endpage} "; ?></td>
				</tr>
				<tr>
					<td align="center" class="headTitle thfont3">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png" width="50" height="45"><br />
						รายงานการติดตามสถานประกอบการซึ่งมีสถานะเป็น P2 (pending) <br />
						<?= $sso1t ?> <br>
						<?php if ($df1 != $df2) {  ?>
							ตั้งแต่วันที่ <?= $df1 ?> ถึงวันที่ <?= $df2 ?> <br />
					</td>
				<?php } else {  ?>
					ประจำวันที่ <?= $df1 ?>
				<?php }  ?>
				</tr>
				<?php if ($i == $beginpage) {  ?>
					<tr>
						<td>
							วันที่ออกรายงาน :
							<?php
							//$d=mktime(11, 14, 54, 8, 12, 2014);
							//echo "Created date is " . date("Y-m-d h:i:sa", $d);
							$nd = date_create('now')->format('d');
							$nm = date_create('now')->format('m');
							$ny = date_create('now')->format('Y') + 543;
							$ndmy = $nd . "-" . $nm . '-' . $ny;
							echo date("{$ndmy} h:i:sa");
							?>
						</td>
					</tr>
				<?php } //if 
				?>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<!-- //report header -->

				<!-- report body -->
				<tr>
					<td>
						<table width="750" border="1" align="left" cellpadding="3" cellspacing="0" style="border-collapse:collapse;border-top:5px double #000;" class="thfont6">
							<tr height="50px;" bgcolor="#B7FFFF">
								<th width="50">ลำดับ</th>
								<th width="450">ชื่อสถานประกอบการ</th>
								<th width="125">เลขนิติบุคคล<br /> 13 หลัก</th>
								<th width="125">เลขนายจ้าง<br /> 10 หลัก</th>
								<th width="150">วันที่<br /> ขึ้นทะเบียน</th>

							</tr>
							<?php
							$rowstart = 1; //ลำดับแถวเริ่มต้น
							$rowstop = $perpage; //จำนวนบรรทัดต่อ 1 หน้า;
							$rowlarray = $rowl - 1; //เลขแถวเริ่มต้น ลบ1

							for ($l = $rowstart; $l <= $rowstop; $l++) {


							?>
								<tr height="25px;">
									<td style="text-align:center;"><?php if ($rowt > 0) {
																		echo "{$rowl}";
																	} ?> </td>
									<td style="text-align:center;"><?php if ($rowt > 0) {
																		echo $sorta[$rowl - 1]['oel_registername'];
																		//echo "{$registername_array[$rowl - 1]}";
																	} ?></td>
									<td style="text-align:center;"><?php if ($rowt > 0) {
																		echo $sorta[$rowl - 1]['oel_registernumber'];
																		//echo "{$registernumber_array[$rowl - 1]}";
																	} ?></td>
									<td style="text-align:center;"><?php if ($rowt > 0) {
																		echo $sorta[$rowl - 1]['oel_accno'];
																		//echo "{$acc_no_array[$rowl - 1]}";
																	} ?></td>
									<td style="text-align:center;"><?php if ($rowt > 0) {
																		echo $sorta[$rowl - 1]['oel_registerdate'];
																		//echo "{$registerdate_array[$rowl - 1]}";
																	} ?></td>

								
									
																	
																	


								</tr>
							<?php

								$rowt = $rowt - 1; //จำนวนเรคคอรืดทั้งหมด
								$rowl = $rowl + 1; //ลำดับที
							} //for 
							?>

							




							<?php if ($i == $endpage) {  ?>
								<!--<table>-->
								<tr style="background-color:#B7FFFF; line-height:20px;">
									<td></td>
									<td style="text-align:right; font-weight:bold;"></td>
									<td style="text-align:center; font-weight:bold;">รวมจำนวน :</td>
									<td style="text-align:center; font-weight:bold;"><?= number_format($sumcol1) ?></td>
									<td style="text-align:center; font-weight:bold;">รายการ</td>

								</tr>
								<!--</table>-->
							<?php } ?>

						</table>
					</td>
				</tr>
				<!-- //report body -->

			</table>


			<!-- //end page -->
		</page>
	<?php
	} //for $i page end page	
	?>

</body>

</html>