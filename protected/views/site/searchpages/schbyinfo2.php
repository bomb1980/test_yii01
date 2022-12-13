<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">



	<script>
		$(function() {

		});
	</script>
</head>
<style>
	.bst-dialog {
		width: 800px;
	}
</style>
<script>
	$(document).ready(function() {
		var myDate = new Date();
		var prettyDate = (myDate.getMonth() + 1) + '/' + myDate.getDate() + '/' + myDate.getFullYear();
		//var prettyDate = myDate.getDate()+ '-' + ( myDate.getMonth()+1)  + '-' + myDate.getFullYear();

		$('#datepicker').datepicker({
			dateFormat: "dd-mm-yy",
			todayBtn: "linked",
			changeYear: true,
			autoclose: true,
			todayHighlight: true,
			isBuddhist: true,
			//minDate: new Date(prettyDate),

		});
		$('#datepicker2').datepicker({
			dateFormat: "dd-mm-yy",
			todayBtn: "linked",
			changeYear: true,
			autoclose: true,
			todayHighlight: true,
			isBuddhist: true,


		});

		/*$('.panel').lobiPanel({
       		reload: false,
    		close: false,
			editTitle: false,
			sortable: true
			//minimize: false
		});*/
		//$( "#datepicker" ).datepicker();
		//	$('[data-toggle="tooltip"]').tooltip();

		//$('#wpddt1').DataTable();
		// Setup - add a text input to each footer cell
		$('#sbitb tfoot th').each(function() {
			var title = $(this).text();
			$(this).html('<input type="text" placeholder="' + title + '" style="width:100%; padding-left:3px;" />');
		});
		/*
		// DataTable
		var table = $('#sbitb').DataTable({
			"scrollX": true,
			"order": [[ 3, "desc" ]],	
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
			});
		});*/

	});
</script>

<body>

	<?php
	if (!Yii::app()->user->isGuest) {
		if (Yii::app()->user->getId()) {
			$user_id = Yii::app()->user->getId();
		}
		if (Yii::app()->user->firstname) {
			$user_firstname = Yii::app()->user->firstname;
		}
		if (Yii::app()->user->lastname) {
			$user_lastname = Yii::app()->user->lastname;
		}
		if (Yii::app()->user->email) {
			$user_email = Yii::app()->user->email;
		}
		if (Yii::app()->user->access_level) {
			$user_access_level = Yii::app()->user->access_level;
		}
		if (Yii::app()->user->address) {
			$user_address = Yii::app()->user->address;
		}
		if (Yii::app()->user->access_code) {
			$user_access_code = Yii::app()->user->access_code;
		}
		if (Yii::app()->user->username) {
			$user_username = Yii::app()->user->username;
		}
	}
	?>

	<?php


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
	///////////////////////กำหนดตัวแปร array เอาไว้
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
	$numofemp_array = array();
	$crop_ex_opendate = array();
	$params = array();
	//echo "{$action}, {$seltxt}, {$schtxt}"; 

	if ($seltxt == '1') {

		//if(Yii::app()->user->access_code=='1'){
		//$bc = str_split(Yii::app()->user->address,2);	
		//$bcd = "0" . $bc[0];
		$qsbi = new CDbCriteria(array(
			'condition' => "oel_registername like :schtxt ",
			'params'    => array(':schtxt' => "%{$schtxt}%")
		));
		//}else{
		//$bc = str_split(Yii::app()->user->address,2);	
		//$bcd = "0" . $bc[0];
		//$qsbi = new CDbCriteria( array(
		//'condition' => "registername like :schtxt and registernumber like :bcd",         
		//'params'    => array(':schtxt' => "%{$schtxt}%", ':bcd' => "{$bcd}%")  
		//));	
		//}
	}

	if ($seltxt == '2') {
		
		set_time_limit(0);
		ini_set("max_execution_time", "0");
		ini_set("memory_limit", "9999M");

		$conn = Yii::app()->db4;
		$sql = "select * from otp_email_tb where oel_registernumber like :registernumber ORDER BY oel_emailtype desc LIMIT 1
		;  ";

		$command = $conn->createCommand($sql);
		$command->bindValue(":registernumber", $schtxt);
	}
	$rowsA = $command->queryAll();
	$oel_id = '';

	if (count($rowsA) > 0) {
		$oel_id = $rowsA[0]['oel_id'];
	}

	$arr_rowsA = array();
	foreach ($rowsA as $dataitem) {
		//$arr_rowsA[$dataitem['oel_registernumber']] =array( $dataitem['oel_answer'],$dataitem['oel_status']); //เอาregister number ไปเชค oel_answer มาใส่ต่อท้าย

		if (is_numeric($dataitem['oel_status'])) {
			$arr_rowsA[$dataitem['oel_registernumber']] = array($dataitem['oel_answer'], $dataitem['oel_status']); //เอาregister number ไปเชค oel_answer,oel_status มาใส่ต่อท้าย
		} else {
			$arr_rowsA[$dataitem['oel_registernumber']] = array($dataitem['oel_answer'], '-'); //เอาregister number ไปเชคในเงื่อนไขถ้าไม่ใช่ตัวเลข oel_answer,'-' มาใส่ต่อท้าย
		}
	}

	if ($seltxt == '2') {
		
		set_time_limit(0);
		ini_set("max_execution_time", "0");
		ini_set("memory_limit", "9999M");

		$conn = Yii::app()->db3;
		$sql = "select * from crop_v_bran where registernumber like :registernumber; ";

		$command = $conn->createCommand($sql);
		$command->bindValue(":registernumber", $schtxt);
	}
	
	$rowsA = $command->queryAll();
	
	if(count($rowsA)>0){
	}else{
		echo "<font style='color:red;'><i class='fa fa-warning'></i> ไม่พบข้อมูลสถานประกอบการนิติบุคคล เลขที่ : {$schtxt} ,<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กรุณาตรวจสอบ เลขนิติบุคคลที่ใช้ค้นหาอีกครั้ง. <br></font>";
		exit();
	}


	

	$chkstatus = $rowsA[0]['crop_remark'];


	$arr_rowsCO = array();

	foreach ($rowsA as $dataitem) {
		$arr_rowsCO[$dataitem['registernumber']] = $dataitem['crop_remark'];
		$arr_rowsCO[$dataitem['registernumber']] = $dataitem['numofemp'];
		$arr_rowsCO[$dataitem['registernumber']] = $dataitem['crop_ex_opendate'];
	}




	if ($seltxt == '3') {
		/*if(Yii::app()->user->access_code=='1'){
		  $bc = str_split(Yii::app()->user->address,2);	
		  $bcd = "0" . $bc[0];*/
		$qsbi = new CDbCriteria(array(
			'condition' => "acc_no = :schtxt ",
			'params'    => array(':schtxt' => "{$schtxt}"),
			'order' =>  "registerdate DESC"
		));
		/*}else{
		  $bc = str_split(Yii::app()->user->address,2);	
		  $bcd = "0" . $bc[0];
		  $qsbi = new CDbCriteria( array(
			  'condition' => "acc_no = :schtxt and registernumber like :bcd",         
			  'params'    => array(':schtxt' => "{$schtxt}", ':bcd' => "{$bcd}%")  
		  ));	
		}*/
	}



	//$modelsbi = OtpEmailTb::model()->findAll($qsbi);
	//$countsbi = count($modelsbi);

	if (count($arr_rowsCO) > 0) {
		//echo($dataitem['oel_status']);
		//exit();

	
	?>

		<table id="sbitb" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
			<thead>
				<tr>
					<!--<th>ลำดับ</th>-->
					<th style="text-align:center;">ชื่อนิติบุคคล</th>
					<th style="text-align:center;">เลขนิติบุคคล 13 หลัก</th>
					<th style="text-align:center;">เลขประกันสังคม 10 หลัก</th>
					<!-- <th style="text-align:center;">วันที่จดทะเบียน</th>-->
					<th style="text-align:center;">สถานะ</th>
					<!--<th>บันทึกโดย</th>
          <th>บันทึกเมื่อ</th>
          <th>ปรับปรุงโดย</th>
          <th>ปรับปรุงเมื่อ</th>-->
					<th style="text-align:center;">ผลสำรวจ</th>
					<th style="text-align:center;">จำนวนลูกจ้าง</th>
					<th style="text-align:center;">วันที่คาดว่าจะเปิดกิจการ</th>
					<th style="text-align:center;">วันที่รับแจ้งผล/วันที่ออกตรวจ สปก. </th>

				</tr>
			</thead>
			<tbody>
				<?php

				$rowno = 1;

				foreach ($rowsA as $rows) {
					$oel_answer = array("", "");

					if ($seltxt == '2') {
						if (array_key_exists($rows['registernumber'], $arr_rowsA)) {
							$oel_answer = $arr_rowsA[$rows['registernumber']];
						}
					} else {
						foreach ($rowsA as $dataitem) {

							if ($dataitem['registernumber'] == $rows['oel_registernumber']) { //เปรียนเทียบเลขที่ผู้สมัครของสอง DB 
								$oel_answer = array($dataitem['crop_remark'], ""); //สร้างตัวแปรมารับค่า $dataitem เข้าไปไว้ในตัวแปร $crop_remark

							}
						}
					}

					$cbid_array[] = $rows['cbid'];
					$registernumber_array[] = $rows['brch_id'];
					$acc_no_array[] = $rows['acc_no'];
					$registername_array[] = $rows['registername'];
					$registerdate_array[] = substr($rows['registerdate'], 0, -9);
					$crop_updatetime_array[] = $rows['crop_updatetime'];
					$crop_status_array[] = $rows['crop_status'];
					$crop_remark_array[] = $rows['crop_remark'];
					$crop_ex_opendate_array = $rows['crop_ex_opendate'];
					$survey_date_array = $rows['survey_date'];
					//	 $SSO_BRAN_CODE_array[] = $sso1; //สร้างอาเรมารับค่า crop_remark

					//$time = strtotime($crop_ex_opendate_array);
					//$newformat = date('Y-m-d' ,$time);



					$oel_answer_array[] = $oel_answer;
					$cbid_array[] = $rows['cbid'];
					$registernumber_array[] = $rows['registernumber'];
					$acc_no_array[] = $rows['acc_no'];
					$registername_array[] = $rows['registername'];
					$address_array[] = $rows['address'];
					$registerdate_array[] = substr($rows['registerdate'], 0, -9);
					$crop_updatetime_array[] = $rows['crop_updatetime'];
					$crop_status_array[] = $rows['crop_status'];
					$crop_remark_array[] = $rows['crop_remark'];
					$numofemp_array[] = $rows['numofemp'];
					//$SSO_BRAN_CODE_array[] = $sso1; //สร้างอาเรมารับค่า crop_remark
					//$oel_status_array[] = $rows['oel_status'];
					//ตรวจสอบสถานะ ว่าเป็น P หรือไม่



				}

				/***************************************************************** */
				/*foreach ($countsbi as $rows){
				$cbid_array[] = $rows['cbid'];
				$registernumber_array[] = $rows['brch_id'];
				$acc_no_array[] = $rows['acc_no'];
				$registername_array[] = $rows['registername'];
				$registerdate_array[] = substr($rows['registerdate'], 0, -9);
				$crop_updatetime_array[] = $rows['crop_updatetime'];
				$crop_status_array[] = $rows['crop_status'];
				$crop_remark_array[] =$rows['crop_remark'];
			//	 $SSO_BRAN_CODE_array[] = $sso1; //สร้างอาเรมารับค่า crop_remark
			//	$oel_status_array[] = $oel_answer;
				$cbid_array[] = $rows['cbid'];
				$registernumber_array[] = $rows['registernumber'];
				$acc_no_array[] = $rows['acc_no'];
				$registername_array[] = $rows['registername'];
				$registerdate_array[] = substr($rows['registerdate'], 0, -9);
				$crop_updatetime_array[] = $rows['crop_updatetime'];
				$crop_status_array[] = $rows['crop_status'];
				$crop_remark_array[] =$rows['crop_remark'];
				//$SSO_BRAN_CODE_array[] = $sso1; //สร้างอาเรมารับค่า crop_remark
				//$$oel_answer_array[] = $rows['crop_remark'];
			  //ตรวจสอบสถานะ ว่าเป็น P หรือไม่
			
		  	echo($rows['cbid'] . "____");
			echo($rows['brch_id']. "____");
			echo($rows['acc_no']. "____");
			echo($rows['registername']. "___");
			echo(substr($rows['registerdate'], 0, -9). "____");
			echo($rows['crop_updatetime']. "____");
			echo($rows['crop_remark']. "____");
			
			exit();*/

				/*if($crop_remark=='P'){
				$updateby = $crop_createby;
 			  	$modified = $crop_createtime;   
			  }else{
				//echo $registernumber;  exit;
				$mest=EmpstateTb::model()->findByAttributes(array('ems_registernumber'=>$registernumber));
				//var_dump($mest);exit;
				//var_dump($mest->ems_updateby);exit;
				if($mest){
			  		$updateby = $mest->ems_createby;
 			  		$modified = $mest->ems_created;
				}else{
					$updateby = $crop_createby;
 			  		$modified = $crop_createtime;
				}
			  }*/



				// $regisday = date_create($registerdate)->format('d');
				// $regismth = date_create($registerdate)->format('m');
				// $regisyer = date_create($registerdate)->format('Y')+543;
				// $registerdatef = $regisday . "-" . $regismth . "-" . $regisyer;//date_create($registerdate)->format('d-m-Y');
				/*  สีเหลือง : #FF6; สีเขียว : #6F6  */
				//echo($oel_id); 
				//// echo($oel_registername);
				// echo($oel_registernumber);
				// echo($oel_accno);
				// echo($oel_remark);
				// echo($oel_registerdate);
				//  echo($oel_answer); 
				//  echo($oel_status);


				?>
				<tr><?
					echo ($rows['cbid'] . "____");
					echo ($rows['brch_id'] . "____");
					echo ($rows['acc_no'] . "____");
					echo ($rows['registernumber'] . "___");
					echo ($rows['registername'] . "___");
					echo (substr($rows['registerdate'], 0, -9) . "____");
					echo ($rows['crop_updatetime'] . "____");
					echo ($rows['crop_remark'] . "____");
					echo ($oel_answer_array[] = $oel_answer . "____");



					?>
					<!--<td style="text-align:center;"><?= $rowno ?></td>-->
					<!--<?= $rows['cbid'] ?>-->

					</td>
					<td style="text-align:center;"><?= $rows['registername'] ?></td>
					<td style="text-align:center;">
						<?= $rows['registernumber'] ?>
						<?php if ($user_access_level == 'admin') { ?>
							&nbsp;
							<font color="#3300CC" style="cursor:pointer;">
								<a href="('<?= $rows['registernumber'] ?>','<?= $rows['acc_no'] ?>','<?= $rows['acc_no'] ?>');"></a>
							</font>
						<?php } ?>
						<div id="accno<?= $rowno ?>"></div>
					</td>
					<td style="text-align:center;"><?= $rows['acc_no'] ?></td>
					<!--	<td style="text-align:center;"><?= substr($rows['registerdate'], 0, -9) ?></td>-->
					<td style="color:red; text-align:center;"><span class="badge thfont3" data-toggle="tooltip" data-placement="right" style="color:#FF0;"><?= $rows['crop_remark']; ?></span></td>
					<td style="color:red; text-align:center;"><span class="badge thfont3" data-toggle="tooltip" data-placement="right" style="color:#FF0;"><?= (count($oel_answer_array) != 0 ? $oel_answer_array[0][0] : ""); ?></span></td>
					<td style="text-align:center;"><?= $rows['numofemp']; ?></td>

					<td style="text-align:center;"><?= $rows['crop_ex_opendate']; ?></td>
					<td style="text-align:center;"><?= $rows['survey_date']; ?></td>
					<!-- <td style="text-align:center;">
				<button  type="button" class="btn btn-primary" data-key="<?= $schtxt ?>" data-whatever="<?= $oel_answer_array[0][1] ?>" data-whatever2="<?= $oel_answer_array[0][0] ?>" 
				data-accno="<?= $rows['acc_no'] ?>" data-regisname="<?= $rows['registername'] ?>"  data-address="<?= $rows['address'] ?>"
				data-crop_remark="<?= $rows['crop_remark'] ?>" data-registdate="<?= substr($rows['registerdate'], 0, -9) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o"></i><font class="thfont5"> แก้ไขข้อมูล</font>
               <button type="button" class="btn btn-warning"  onclick="calleditdialog()">TestDialog</button>-->
					</td>
				</tr>

			<?php

			$rowno += 1;
			$chkstatus = $rows['crop_remark'];
		} //if

		else {
			echo ("เลขนิติบุคคล 13 หลักไม่ถูกต้อง");
			exit();
		}


			?>
			</tbody>

		</table>
		<?php

		?>
		<script>
			function ShowHideDiv() {
				var ddlPassport = document.getElementById("dropdown_status");
				var dvPassport = document.getElementById("dvPassport");
				var dvDateop = document.getElementById("dvDateop");
				dvPassport.style.display = ddlPassport.value == "AL" ? "" : "none";
				dvDateop.style.display = ddlPassport.value == "AL" ? "" : "none";

			}
		</script>

		<!--*********************************************************************************************************************************-->
		<style>
			.table4_1 table {
				width: 100%;
				margin: 15px 0;
				border: 0;
			}

			.table4_1 th {
				background-color: #93DAFF;
				color: #000000
			}

			.table4_1,
			.table4_1 th,
			.table4_1 td {
				font-size: 0.95em;
				/*text-align:center;*/
				padding: 4px;
				border-collapse: collapse;
			}

			.table4_1 th,
			.table4_1 td {
				border: 1px solid #c1e9fe;
				border-width: 1px 0 1px 0
			}

			.table4_1 tr {
				border: 1px solid #c1e9fe;
			}

			.table4_1 tr:nth-child(odd) {
				background-color: #dbf2fe;
			}

			.table4_1 tr:nth-child(even) {
				background-color: #fdfdfd;
			}



			@media only screen and (max-width: 760px),
			(min-device-width: 768px) and (max-device-width: 1024px) {

				/* Force table to not be like tables anymore */
				.table4_1 table,
				.table4_1 thead,
				.table4_1 tbody,
				.table4_1 th,
				.table4_1 td,
				.table4_1 tr {
					display: block;
				}

				/* Hide table headers (but not display: none;, for accessibility) */
				.table4_1 thead tr {
					position: absolute;
					top: -9999px;
					left: -9999px;
				}

				.table4_1 tr {
					border: 1px solid #ccc;
				}

				.table4_1 td {
					/* Behave  like a "row" */
					border: none;
					border-bottom: 1px solid #eee;
					position: relative;
					padding-left: 50%;
				}

				.table4_1 td:before {
					/* Now like a table header */
					position: absolute;
					/* Top/left values mimic padding */
					top: 6px;
					left: 6px;
					width: 45%;
					padding-right: 10px;
					white-space: nowrap;
				}

				.table4_1 button {
					width: 80%;
					height: 100%;
				}

				/*
	Label the data
	*/
				.table4_1 td:nth-of-type(1):before {
					content: "";
				}

				.table4_1 td:nth-of-type(2):before {
					content: "";
				}

				.table4_1 td:nth-of-type(3):before {
					content: "";
				}

				.table4_1 td:nth-of-type(4):before {
					content: "";
				}

				.table4_1 td:nth-of-type(5):before {
					content: "";
				}

				.table4_1 td:nth-of-type(5):after {
					content: "";
				}

				.table4_1 td:nth-of-type(6):before {
					content: "";
				}

				.table4_1 td:nth-of-type(6):after {
					content: "";
				}

			}
		</style>
		<script>
			function addItem(elmt) {
				var dataval = $("#upddatas")
				var dropdown_status = dataval.find('#dropdown_status').val();
				var pasportnumber = dataval.find('#txtPassportNumber').val();
				var datepicker = dataval.find('#datepicker').val();
				var datepicker2 = dataval.find('#datepicker2').val();
				var registernumber = dataval.find('#registernumber').val();


				if (pasportnumber == "") {
					pasportnumber = 0
				}
				if (datepicker == "") {
					datepicker = ("-");
				}
				if (datepicker2 == '') {
					alert('กรุณาระบุวันที่ให้ครบถ้วน');
					return;
				}
				if (dropdown_status == 0) {
					alert('กรุณาเลือกสถานะ');
					return;
				}


				var result = confirm("ต้องการบันทึกข้อมูลใช่หรือไม่ ?");
				if (!result) {
					$("#subclick").prop("disabled", false);
					return;
				} else {
					$('#re3').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");

				}

				$.ajax({

						url: "<?php echo Yii::app()->createAbsoluteUrl('corp/Updatecorpdata'); ?>",
						method: "POST",
						dataType: "json",
						data: {
							'dropdown_status': dropdown_status,
							'pasportnumber': pasportnumber,
							'datepicker': datepicker,
							'datepicker2': datepicker2,
							'registernumber': registernumber,

							<?php 
							if($oel_id == ''){
								echo "'oel_id': ''," ;
							}else{
								echo "'oel_id':" . $oel_id;
							}
							?>
							
						}

					})
					.done(function(data) {

						if (data.msg == 'success') {

							$('#re3').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");

							alert('บันทึกข้อมูลสำเร็จ');
							$('#re3').html("");
							callschcrop6();
							$('body').removeClass('modal-open');
							$('#myModal').modal('hide');
							$('.modal-backdrop').remove();


						} else {
							$('#re3').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
							console.log(data.msg);
							alert("เกิดปัญหาระหว่างบันทึก กรุณาลองใหม่อีกครั้ง");

							$("#test").prop("disabled", false);
							$('#re3').html("");
						}

					})
					.fail(function(jqXHR, status, error) {
						// Triggered if response status code is NOT 200 (OK)
						//alert(jqXHR.responseText);

					})
					.always(function() {
						$("#test").prop("disabled", false);
						$('#re3').html("");
					});


				//$("#re3").show();
				//$('body').removeClass('modal-open');

				//$('#myModal').modal('hide');
				//$('.modal-backdrop').remove();
				//$("#re3").hide();	



			}
		</script>
		<style type="text/css">
			.inner-addon {
				position: relative;
			}

			/* style icon */
			.inner-addon .glyphicon {
				position: absolute;
				padding: 9px;
				pointer-events: none;
			}

			/* align icon */
			.left-addon .glyphicon {
				left: 0px;
			}

			.right-addon .glyphicon {
				right: 0px;
			}

			/* add padding  */
			.left-addon input {
				padding-left: 30px;
			}

			.right-addon input {
				padding-right: 30px;
			}
		</style>
		<div class="col-md-12">
			<table id="upddatas" cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">

				<tr>
					<td style="text-align:right; width:30%; font-weight:bold;">เลขทะเบียน 13 หลัก :</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<?= $rows['registernumber'] ?>
						<input type="hidden" id="registernumber" value=<?= $rows['registernumber'] ?>>
					</td>
				</tr>
				<tr>
					<td style="text-align:right; width:30%; font-weight:bold;">เลข 10 หลักประกันสังคม :</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<?= $rows['acc_no'] ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right; width:30%; font-weight:bold;">ชื่อสถานประกอบการ :</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<?= $rows['registername'] ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right; width:30%; font-weight:bold;">ที่อยู่ :</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<?= $rows['address'] ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right; width:30%; font-weight:bold;">สถานะ :</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<?= $rows['crop_remark'] ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right; width:30%; font-weight:bold;">วันที่ขึ้นทะเบียน :</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<?= substr($rows['registerdate'], 0, -9) ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right; width:30%; font-weight:bold;">วันที่รับแจ้งผล/วันที่ออกตรวจ สปก. :</td>
					<td style="text-align:left; width:70%; padding-left:15px; padding-right:48%;">
						<?php
						 $survey_format = date('d-m-Y');
						 $date2 = DateTime::createFromFormat("Y-m-d 00:00:00", $rows['survey_date']);
						 if($date2){
							$survey_format = $date2->format('d-m-Y');
						 }

						//substr($rows['survey_date'], 0, -9)
						?>
						<div class="inner-addon left-addon" style="text-align:left;"><i class="glyphicon glyphicon-calendar"><br></i><input class="form-control input-lg" type="text" id="datepicker2" style="font-size:25px;" placeholder="<?= substr($rows['survey_date'], 0, -9) ?>" value="<?php echo $survey_format; ?>" autocomplete="off" />
						</div>

					</td>
				</tr>

				<tr>
					<?php
					$oel_answer = (count($oel_answer_array) != 0 ? $oel_answer_array[0][0] : "");
					?>
					<td style="text-align:right; width:30%; font-weight:bold;">ผลการตรวจสอบ :</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<select name="status" id="dropdown_status" class="form-control" style="font-size:25px;" onchange="ShowHideDiv()">
						<option value="0" style="font-size:25px;" selected="true" disabled="disabled">--กรุณาเลือก--</option>
							<option value="NE" style="font-size:25px;" <?php echo $oel_answer=="NE"? "selected":"" ?> >NE</option>
							<option value="ZR" style="font-size:25px;" <?php echo $oel_answer=="ZR"? "selected":"" ?> >ZR</option>
							<option value="CL" style="font-size:25px;" <?php echo $oel_answer=="CL"? "selected":"" ?> >CL</option>
							<option value="AL" style="font-size:25px;" <?php echo $oel_answer=="AL"? "selected":"" ?> >AL</option>
						</select>
					</td>
				</tr>
				
				<?php 
				$numofemp = (count($numofemp_array) != 0 ? $numofemp_array[0] : 0);

				$display = $oel_answer=="AL"? "":"display:none";

				 $opendate_format = date('d-m-Y');
				 $date2 = DateTime::createFromFormat("Y-m-d 00:00:00", $rows['crop_ex_opendate']);
				 if($date2){
					$opendate_format = $date2->format('d-m-Y');
				 }


				?>
				<tr style="<?php echo $display;?>" id="dvPassport">
					<td style="text-align:right; width:30%; font-weight:bold;">จำนวนลูกจ้าง :</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<input type="number" min="0" id="txtPassportNumber" value="<?php echo $numofemp;  ?>" style="font-size:25px;  width:15%;" class="form-control" />
					</td>
				</tr>

				<tr style="<?php echo $display;?>" id="dvDateop">
					<td style="text-align:right; width:30%; font-weight:bold;">วันที่คาดว่าจะเปิดกิจการ :</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<div class="inner-addon left-addon" style="text-align:left;"><i class="glyphicon glyphicon-calendar"><br></i><input class="form-control" type="text" placeholder="<?= $opendate_format ?>" id="datepicker" style="font-size:25px;" autocomplete="off" />

						</div>

					</td>

				</tr>
				<tr>
					<td style="text-align:right; width:30%; font-weight:bold;">
						<div id="re3"></div>
					</td>
					<td style="text-align:left; width:70%; padding-left:15px;">
						<?php
						if ($rows['crop_remark'] == 'A') { ?>
							<button type="button" class="btn btn-primary" id="subclick" disabled><a style="font-size: 20px;">บันทึก </a></button>

						<?php exit();
						} else { ?>
							<button type="button" class="btn btn-primary" id="subclick" onClick='addItem(this)'><a style="font-size: 20px;">บันทึก </a></button>
						<?php } ?>

						<!--<button type="button" class="btn btn-danger">ยกเลิก</button>-->

					</td>

				</tr>
		</div>
		</table>
		</div>





</body>

</html>