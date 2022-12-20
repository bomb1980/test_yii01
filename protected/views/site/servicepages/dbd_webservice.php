<?php
set_time_limit(0);
ini_set("max_execution_time", "0");
ini_set("memory_limit", "9999M");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Service 1</title>
	<style>
		.rcorners {
			border-radius: 10px;
			border: 1px solid #666;
			padding: 5px;
			margin-bottom: 5px;
		}

		.ui-datepicker-trigger {
			margin-left: 3px;
			margin-bottom: 5px;
			width: 30px;
			height: 30px;
		}

		.ui-datepicker {
			margin-top: 1px;
		}

		.mytextbox {
			padding: 5px 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
	</style>
	<script>
		$(document).ready(function() {

			$('.panel').lobiPanel({
				reload: false,
				close: false,
				editTitle: false
				//minimize: false
			});

			$("#bgdate").datepicker();
			$("#eddate").datepicker();


			// Setup - add a text input to each footer cell
			$('#example tfoot th').each(function() {
				var title = $(this).text();
				$(this).html('<input type="text" placeholder="' + title + '"  style="width:100%; padding-left:3px;" />'); //placeholder="'+title+'"
			});

			// DataTable
			var table = $('#example').DataTable({
				"scrollX": true,
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


		var newda = "";
		var upda = "";

		function sendparams() {
			//alert('ok');
			//BootstrapDialog.alert('ok');	
			var bgdate = $("#bgdate").val();
			var eddate = $("#eddate").val();


			if ($('#newdata').is(':checked')) {
				newda = $("#newdata").val();
			} else {
				newda = 0;
			}

			if ($('#upddata').is(':checked')) {
				upda = $("#upddata").val();
			} else {
				upda = 0;
			}

			if (!bgdate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
				$("#eddate").val("");
				$("#bgdate").focus();
				$("#bgdate").select();
			} else
			if (bgdate > eddate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
				$("#eddate").val("");
				$("#eddate").focus();
				$("#eddate").select();
			} else
			if (newda == 0) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือก "รายการใหม่" !</font>');
			} else {
				//send ajax function
				$("#rowresult1").show();
				ajaxsendparams(bgdate, eddate, newda, upda);
			}
		}

		function chkbgdate() {

			var bgdate = $("#bgdate").val();
			var eddate = $("#eddate").val();


			if ($('#newdata').is(':checked')) {
				newda = $("#newdata").val();
			} else {
				newda = 0;
			}

			if ($('#upddata').is(':checked')) {
				upda = $("#upddata").val();
			} else {
				upda = 0;
			}

			if (!bgdate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
				$("#eddate").val("");
				$("#bgdate").focus();
				$("#bgdate").select();
			} else
			if (bgdate > eddate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
				$("#eddate").val("");
				$("#eddate").focus();
				$("#eddate").select();
			} else
			if (newda != 0) {
				//BootstrapDialog.alert('กรุณาเลือก "รายการใหม่" !');
			}
		}

		function ajaxsendparams(bgdatep, eddatep, newdap, updap) {

			var data1 = 'bgdatep=' + bgdatep + '&eddatep=' + eddatep + '&newdap=' + newdap + '&updap=' + updap;

			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/calldbdservice'); ?>",
				data: data1,
				success: function(da) {
					$("#re1").html(da);

				}
			});
		}

		function setenddate() {
			//alert($("#bgdate").val());
			$("#eddate").focus();
			$("#eddate").val($("#bgdate").val());
			//var bgdate = $("#bgdate").val();
			//var eddate = $("#eddate").val();
			//$("#eddate").val() = bgdate;
		}

		function dbdtest() {

			// alert('dbdtest');
			var bgdate = $("#bgdate").val();
			var eddate = $("#eddate").val();


			if ($('#newdata').is(':checked')) {
				newda = $("#newdata").val();
			} else {
				newda = 0;
			}

			if ($('#upddata').is(':checked')) {
				upda = $("#upddata").val();
			} else {
				upda = 0;
			}

			if (!bgdate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
				$("#eddate").val("");
				$("#bgdate").focus();
				$("#bgdate").select();
			} else
			if (bgdate > eddate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
				$("#eddate").val("");
				$("#eddate").focus();
				$("#eddate").select();
			} else
			if (newda == 0) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือก "รายการใหม่" !</font>');
			} else {
				//send ajax function
				$("#rowresult1").show();
				ajaxsendparams2(bgdate, eddate, newda, upda);
			}
		}

		function wpdtest() {
			//alert("wpdtest1");
			var bgdate = $("#bgdate").val();
			var data1 = 'action=tst&bgdatep=' + bgdate;
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/callwpdservice1'); ?>",
				data: data1,
				success: function(da) {
					$("#re1").html(da);

				}
			});

		}

		function ajaxsendparams2(bgdatep, eddatep, newdap, updap) {

			var data1 = 'bgdatep=' + bgdatep + '&eddatep=' + eddatep + '&newdap=' + newdap + '&updap=' + updap;
			//alert(data1);
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/calldbdservice2'); ?>",
				data: data1,
				success: function(da) {
					$("#re1").html(da);

				}
			});
		}

		function genaccno() {
			var bgdate = $("#bgdate").val();
			var eddate = $("#eddate").val();

			if ($('#newdata').is(':checked')) {
				newda = $("#newdata").val();
			} else {
				newda = 0;
			}

			if ($('#upddata').is(':checked')) {
				upda = $("#upddata").val();
			} else {
				upda = 0;
			}

			if (!bgdate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
				$("#eddate").val("");
				$("#bgdate").focus();
				$("#bgdate").select();
			} else
			if (bgdate > eddate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
				$("#eddate").val("");
				$("#eddate").focus();
				$("#eddate").select();
			} else
			if (newda == 0) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือก "รายการใหม่" !</font>');
			} else {
				//send ajax function
				$("#rowresult1").show();
				ajaxsendparams3(bgdate, eddate, newda, upda);
			}
		}


		function ajaxsendparams3(bgdatep, eddatep, newdap, updap) {

			var data1 = 'bgdatep=' + bgdatep + '&eddatep=' + eddatep + '&newdap=' + newdap + '&updap=' + updap;
			//alert(data1);
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/calldbdservice3'); ?>",
				data: data1,
				success: function(da) {
					$("#re1").html(da);

				}
			});
		}

		function sendemail() {
			var bgdate = $("#bgdate").val();
			var eddate = $("#eddate").val();

			if ($('#newdata').is(':checked')) {
				newda = $("#newdata").val();
			} else {
				newda = 0;
			}

			if ($('#upddata').is(':checked')) {
				upda = $("#upddata").val();
			} else {
				upda = 0;
			}
			if (!bgdate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
				$("#eddate").val("");
				$("#bgdate").focus();
				$("#bgdate").select();
			} else
			if (bgdate > eddate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
				$("#eddate").val("");
				$("#eddate").focus();
				$("#eddate").select();
			} else
			if (newda == 0) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือก "รายการใหม่" !</font>');
			} else {
				//send ajax function
				$("#rowresult1").show();
				ajaxsendparams4(bgdate, eddate, newda, upda);
			}

		}

		function ajaxsendparams4(bgdatep, eddatep, newdap, updap) {

			var data1 = 'bgdatep=' + bgdatep + '&eddatep=' + eddatep + '&newdap=' + newdap + '&updap=' + updap;
			//alert(data1);
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/calldbdservice4'); ?>",
				data: data1,
				success: function(da) {
					$("#re1").html(da);

				}
			});
		}

		function otpdata() {
			//alert('test ');	
			var data1 = 'action=openotpdata';
			//alert(data1);

			var bgdate = $("#bgdate").val();
			var eddate = $("#eddate").val();

			if ($('#newdata').is(':checked')) {
				newda = $("#newdata").val();
			} else {
				newda = 0;
			}

			if ($('#upddata').is(':checked')) {
				upda = $("#upddata").val();
			} else {
				upda = 0;
			}
			if (!bgdate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
				$("#eddate").val("");
				$("#bgdate").focus();
				$("#bgdate").select();
			} else
			if (bgdate > eddate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
				$("#eddate").val("");
				$("#eddate").focus();
				$("#eddate").select();
			} else
			if (newda == 0) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือก "รายการใหม่" !</font>');
			} else {
				//data1 = data1 + '&bgdatep=' + bgdatep + '&eddatep=' + eddatep + '&newdap=' + newdap + '&updap=' + updap;
				//send ajax function
				$("#rowresult1").show();
				//ajaxsendparams4(bgdate,eddate,newda,upda);
				//alert(bgdate + ',' + eddate + ',' + newda,upda);
				data1 += '&bgdatep=' + bgdate + '&eddatep=' + eddate + '&newdap=' + newda + '&updap=' + upda;
				//alert(data1);
				$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl('site/callotpdata'); ?>",
					data: data1,
					success: function(da) {
						$("#re1").html(da);

					}
				});

			}


		} //function

		function sendemail3() {
			var data1 = 'action=sendemail3';
			var bgdate = $("#bgdate").val();
			var eddate = $("#eddate").val();

			if ($('#newdata').is(':checked')) {
				newda = $("#newdata").val();
			} else {
				newda = 0;
			}

			if ($('#upddata').is(':checked')) {
				upda = $("#upddata").val();
			} else {
				upda = 0;
			}
			if (!bgdate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่เริ่มต้นก่อน !</font>');
				$("#eddate").val("");
				$("#bgdate").focus();
				$("#bgdate").select();
			} else
			if (bgdate > eddate) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือกวันที่ให้มากกว่าวันทีเริ่มเต้น !</font>');
				$("#eddate").val("");
				$("#eddate").focus();
				$("#eddate").select();
			} else
			if (newda == 0) {
				BootstrapDialog.alert('<font class="thfont5">กรุณาเลือก "รายการใหม่" !</font>');
			} else {
				$("#rowresult1").show();
				data1 += '&bgdatep=' + bgdate + '&eddatep=' + eddate + '&newdap=' + newda + '&updap=' + upda;
				//alert(data1);

				$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");

				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl('site/sendemail3'); ?>",
					data: data1,
					success: function(da) {
						$("#re1").html(da);

					}
				});

			}


		} //function
	</script>


</head>

<body>
	<div id="as2" style="padding-bottom:20px;">
		<?php echo CHtml::link('<i class="fa fa-mail-reply"></i> back to All Services', array('site/services')); ?>
		<!--<button class="btn btn-info btn-small" ><i class="fa fa-mail-reply"></i> back to All Services</button>-->
	</div>

	<div class="about_title thfont5" style="font-size:30px;">เชื่อมโยงข้อมูลนิติบุคคล จาก DBD (Call DBD Webservice)</div>
	<div class="row">
		<div class="col-md-12">
			<!--rcorners-->
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<p class="thfont4" style="">จากวันที่: <input type="text" class="form-control thfont5" id="bgdate" onChange="setenddate();" style="height:auto;" placeholder="mm/dd/yyyy"></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<p class="thfont4" style="">ถึงวันที่: <input type="text" class="form-control thfont5" id="eddate" onChange="javascript:chkbgdate();" disabled style="height:auto;" placeholder="mm/dd/yyyy"></p>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<p class="thfont4" style="">
							ประเภทข้อมูล:
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="newdata" value="1" checked>
							<label class="form-check-label thfont3" for="newdata">รายการใหม่</label>&nbsp;&nbsp;
							<input class="form-check-input" type="checkbox" id="upddata" value="2" disabled>
							<label class="form-check-label thfont3" for="upddata">รายการที่ปรับปรุง</label>
						</div>
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<p class="" style=""><br><br>
							<!--<button class="btn btn-info" onClick="javascript:sendparams();"><i class="fa fa-download"></i> CALL DATA</button>-->
							<button class="btn btn-primary" onClick="javascript:dbdtest();"><i class="fa fa-download"></i> CALL DATA</button>
							<button class="btn btn-warning" onClick="javascript:genaccno();">GenAccNo</button>
							<button class="btn btn-success" onClick="javascript:sendemail();"><i class="fa fa-envelope" aria-hidden="true"></i> SendMail</button>
							<button class="btn btn-danger" onClick="javascript:otpdata();"><i class="fa fa-envelope" aria-hidden="true"></i> ETP data</button>
							<button class="btn btn-info" onClick="javascript:sendemail3();"><i class="fa fa-envelope"></i> Send Email 3</button>
						</p>
					</div>
				</div>
			</div>
			<!--row-->
		</div>
	</div>


	<div class="row" id="rowresult1">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-address-book"></i>
					<font class="thfont5" style="font-size:24px;"> ข้อมูลนิติบุคคล</font>
				</div>
				<div class="panel-body">
					<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">

					</div>
				</div>
			</div>
		</div>
	</div>
	<!--row-->


</body>

</html>