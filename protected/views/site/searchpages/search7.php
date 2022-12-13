<script>
	function showtxt(seltxt) {
		//alert(seltxt);
		if (seltxt == 'PND1') {
			$("#btn1").attr("data-valbtn", "PND1");
		}
		if (seltxt == 'PND1A') {
			$("#btn1").attr("data-valbtn", "PND1A");
		}
		if (seltxt == 'PND50') {
			$("#btn1").attr("data-valbtn", "PND50");

		}
	}

	function callpnd() {
		var element = document.getElementById('btn1');
		var dataID = element.getAttribute('data-valbtn');
		if (dataID == "PND1") {
			callpnd101();
		}
		if (dataID == "PND50") {
			callpnd50();
		}
		if(dataID == "PND1A"){
			callpndPND1A();
		}

	}

	function callpnd101() {
		var selopt = $("#sel1 option:selected").val();
		var seltxt = $("#seltxt").val();
		var schtxt = $("#schtxt").val();
		seltxt = $("#seltxt").val();
		str = new String(seltxt);
		if (str.length < 13) {
			BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ที่ต้องการค้นหา !</font>');
		} else if (str.length = 13) {
			if (isNaN(str)) {
				BootstrapDialog.alert("กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ให้ถูกต้อง <br/>");
			} else {
				schtxt = $("#schtxt").val();
				str = new String(schtxt);
				if (str.length < 4) {
					BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนพ.ศ. !</font>');
				} else {
					if (isNaN(str)) {
						BootstrapDialog.alert("กรุณาป้อนพ.ศ.ให้ถูกต้อง <br/>");
					} else {
						var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt + "&selopt=" + selopt;
					}

				}
			}

		}

		//str = new String(schtxt);
		ajaxcallpnd101(selopt, seltxt, schtxt);

	}

	function callpndPND1A() {
		var selopt = $("#sel1 option:selected").val();
		var seltxt = $("#seltxt").val();
		var schtxt = $("#schtxt").val();
		seltxt = $("#seltxt").val();
		str = new String(seltxt);
		if (str.length < 13) {
			BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ที่ต้องการค้นหา !</font>');
		} else if (str.length = 13) {
			if (isNaN(str)) {
				BootstrapDialog.alert("กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ให้ถูกต้อง <br/>");
			} else {
				schtxt = $("#schtxt").val();
				str = new String(schtxt);
				if (str.length < 4) {
					BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนพ.ศ. !</font>');
				} else {
					if (isNaN(str)) {
						BootstrapDialog.alert("กรุณาป้อนพ.ศ.ให้ถูกต้อง <br/>");
					} else {
						var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt + "&selopt=" + selopt;
					}

				}
			}

		}

		var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt + "&selopt=" + selopt;
		$.ajax({
				url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/callpnd1a'); ?>",
				method: "POST",
				data: data1,
				beforeSend: function() {
					$("#btn1").prop("disabled", true);
					$('#pain').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
				},
			})
			.done(function(data) {
				$("#pain").html(data);
			})
			.fail(function(jqXHR, status, error) {
				// Triggered if response status code is NOT 200 (OK)
				//alert(jqXHR.responseText);
				$('#pain').html('');
			})
			.always(function() {				
				$("#btn1").prop("disabled", false);
			});


	}


	function callpnd50() {
		var selopt = $("#sel1 option:selected").val();
		var seltxt = $("#seltxt").val();
		var schtxt = $("#schtxt").val();
		seltxt = $("#seltxt").val();
		str = new String(seltxt);
		if (str.length < 13) {
			BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ที่ต้องการค้นหา 50!</font>');
			exit();
		} else if (str.length = 13) {
			if (isNaN(str)) {
				BootstrapDialog.alert("กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ให้ถูกต้อง <br/>");
				exit();
			} else {
				schtxt = $("#schtxt").val();
				str = new String(schtxt);
				if (str.length < 4) {
					BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนพ.ศ. !</font>');
					exit();
				} else {
					if (isNaN(str)) {
						BootstrapDialog.alert("กรุณาป้อนพ.ศ.ให้ถูกต้อง <br/>");
						exit();
					} else {
						var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt + "&selopt=" + selopt;
					}

				}
			}

		}
		//str = new String(schtxt);
		ajaxcallpnd50(selopt, seltxt, schtxt);
	}


	function ajaxcallpnd50(selopt, seltxt, schtxt) {
		var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt + "&selopt=" + selopt;
		$('#pain').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/callpnd50'); ?>",
			data: data1,
			success: function(da) {

				$("#pain").html(da);


			}
		});

	}


	///pnd101////////////////////////////////////////////////////////////////////////////////////////////////////


	function ajaxcallpnd101(selopt, seltxt, schtxt) {
		var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt + "&selopt=" + selopt;
		$('#pain').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/callpnd101'); ?>",
			data: data1,
			success: function(da) {

				$("#pain").html(da);


			}
		});

	}

	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}
	//pnd101///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Test print A4</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png">
	<!-- ******************************************************************************************************************************-->


	<!-- ******************************************************************************************************************************-->

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<style>
	#div-1 {
		background-color: #EBEBEB;
		font-size: 20px;
		font-style: "thfont5";


	}

	.row {
		font-size: 20px;

	}

	#dropdown_status {
		width: 30%;
		font-size: 15px;
		height: 95%;
	}

	#datepicker {
		width: 30%;
		font-size: 15px;
		height: 95%;
	}
</style>

<body>

	<div class="about_title thfont5" style="font-size:30px;">ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคล ด้วยเลขประจำตัวผู้เสียภาษีอากร (เลขนิติบุคคล 13 หลัก) และ ปีภาษี (พ.ศ.)</div>
	<div class="row">
		<!--row-->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<!--rcorners-->
			<div class="">
				<!--row-->

				<div class="col-xs-12 col-xm-12 col-md-2 col-lg-2">
					<div class="form-group">
						<p class="thfont5" style="">
							<label for="sel1">เลือกค้นหาจาก :</label>
							<select class="form-control thfont5" id="sel1" style="height:auto;" onChange="javascript:showtxt(this.value);">
								<option value="PND1" selected>ภงด.1</option>
								<option value="PND1A">ภงด.1ก</option>
								<option value="PND50">ภงด.50</option>
							</select>
						</p>
					</div>
					<!--formgroup-->
				</div>
				<!--cal-md-3-->
				<div class="col-xs-12 col-xm-12 col-md-4 col-lg-4">

					<!--formgroup-->
					<div class="form-group" id="dtxt1">
						<p class="thfont5" style="">
							<label class="thfont5" for="txt1">เลขประจำตัวผู้เสียภาษีอากร (เลขนิติบุคคล 13 หลัก) :</label>
							<input type="text" class="form-control thfont5" id="seltxt" style="height:auto;" placeholder="0000000000000" maxlength="13" onFocus="this.select()">
						</p>
					</div>
					<!--formgroup-->
				</div>
				<!--cal-md-4-->
				<div class="col-xs-12 col-xm-12 col-md-2 col-lg-2">

					<!--formgroup-->
					<div class="form-group">
						<p class="thfont5" style="">

							<label class="thfont5" for="txt2">ปีภาษี (พ.ศ.):</label>
							<input type="text" class="form-control thfont5" id="schtxt" style="height:auto;" placeholder="0000" maxlength="4" onFocus="this.select()">

						</p>
					</div>
					<!--formgroup-->
				</div>


				<div class="col-md-3">
					<div class="form-group" style="" id="dbtn">
						<p class="thfont5" style="padding-top:32px;">
							<label class="thfont5" for="btn"></label>
							<button class="btn btn-info" id="btn1" onClick="javascript:callpnd();" data-valbtn="PND1"><i class="fa fa-search"></i>
								<font class="thfont5"> ค้นหา</font>
							</button>
						</p>
					</div>
					<!--formgroup-->
				</div>
				<!--cal-md-3-->

			</div>
			<!--row-->
		</div>
		<!--rcorners-->
	</div>
	<!--row-->


	</div>
	</div>

	</div>
	<div class="row" id="rowresult1">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-address-book"></i>
					<font class="thfont5" style="font-size:24px;"> ข้อมูลรายการภาษีเงินได้นิติบุคคล ด้วยเลขทะเบียนพาณิชย์ </font>
				</div>
				<!--panel heading-->
				<div class="panel-body">
					<div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
						<!--result data-->
						<div id="pain">
						</div>
					</div>
				</div>
				<!--panelbody-->
			</div>
			<!--panel-->
		</div>
		<!--col-md-12-->
	</div>
	<!--rowresult1-->
	</div>


</body>

</html>