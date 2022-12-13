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
	
	<script>
		function showtxt(seltxt) {
			//alert(seltxt);
			if (seltxt == '1') {
				$("#txt1").val("");
				$("#dtxt1").show();
				$("#dtxt2").hide();
				$("#dtxt3").hide();
				$("#txt1").focus();
				$("#txt1").select();
			}
			if (seltxt == '2') {
				$("#txt2").val("");
				$("#dtxt1").hide();
				$("#dtxt2").show();
				$("#dtxt3").hide();
				$("#txt2").focus();
				$("#txt2").select();
			}
			if (seltxt == '3') {
				$("#txt3").val("");
				$("#dtxt1").hide();
				$("#dtxt2").hide();
				$("#dtxt3").show();
				$("#txt3").focus();
				$("#txt3").select();
			}
		}

		function callschcrop6() {
			seltxt = $("#sel1").val();
			//alert(seltxt);
			var schtxt = ""; // 
			var str = ""; //new String(cnumb);
			if (seltxt == '1') {
				schtxt = $("#txt1").val();
				if (schtxt) {
					str = new String(schtxt);
					ajaxcallschcrop6(seltxt, schtxt);
				//	ajaxUpdatecorppdata(seltxt, schtxt);
				} else {
					BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลชื่อนิติบุคคล ที่ต้องการค้นหา !</font>');
					$("#txt1").focus();
					$("#txt1").select();
				}
			}
			if (seltxt == '2') {
				schtxt = $("#txt2").val();
				if (schtxt) {
					str = new String(schtxt);
					if (str.length < 13) {
						BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขนิติบุคคล 13 หลัก ที่ต้องการค้นหา ให้ครบถ้วน !</font>');
						$("#txt2").focus();
						$("#txt2").select();
					} else {
						ajaxcallschcrop6(seltxt, schtxt);
						//ajaxUpdatecorppdata(seltxt, schtxt);

					}
				} else {
					BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขนิติบุคคล 13 หลัก ที่ต้องการค้นหา !</font>');
					$("#txt2").focus();
					$("#txt2").select();
				}
			}
			if (seltxt == '3') {
				schtxt = $("#txt3").val();
				if (schtxt) {
					str = new String(schtxt);
					if (str.length < 10) {
						BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขประกันสังคม 10 หลัก ที่ต้องการค้นหา ให้ครบถ้วน !</font>');
						$("#txt3").focus();
						$("#txt3").select();
					} else {
						ajaxcallschcrop6(seltxt, schtxt);
						//ajaxUpdatecorppdata(seltxt, schtxt);
					}
				} else {
					BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขประกันสังคม 10 หลัก ที่ต้องการค้นหา !</font>');
					$("#txt3").focus();
					$("#txt3").select();
				}
			}
		}

		function ajaxcallschcrop6(seltxt, schtxt) {
			var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
			//alert(data1);
			var myDate = new Date();
			var prettyDate = (myDate.getMonth()+1) + '/' + myDate.getDate()  + '/' + myDate.getFullYear();
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('corp/callschcrop6'); ?>",
				data: data1,
				success: function(da) {
					$("#rowresult1").show();
					$("#rowresult2").hide();
					$("#re1").html(da);
				
				
				}
			});
		}

		function ajaxUpdatecorppdata(seltxt, schtxt) {
			var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
			//alert(data1);
			$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('corp/Updatecorpdata'); ?>",
				data: data1,
				success: function(da) {
					$("#rowresult1").show();
					$("#rowresult2").hide();
					$("#re1").html(da);

				}
			});
			//alert(data1);
		}

		function backtotable() {
			$("#rowresult1").show();
			$("#rowresult2").hide();
			callschcropbyinfo();
		}
		var myDate = new Date();
		var prettyDate = (myDate.getMonth()+1) + '/' + myDate.getDate()  + '/' + myDate.getFullYear();
		
		$(document).ready(function() {
			
			//$( "#bgdate" ).datepicker();
			//$( "#eddate" ).datepicker();
			
			$( "#datepicker2" ).datepicker({
				dateFormat: "dd-mm-yy"
			});
			
		
			
		});
		
		
	
		
		
	</script>
</head>
<style>
	#div-1 {
		background-color: #EBEBEB;
		font-size:20px;
		font-style: "thfont5";
	
		
	}
	.row{
		font-size:20px;
		
	}
	#dropdown_status{
		width:30% ;
		font-size:15px;
		height: 95%;
	}
	#datepicker{
		width:30% ;
		font-size:15px;
		height: 95%;
	}
</style>

<body>

	<div class="about_title thfont5" style="font-size:30px;">หน้าบันทึกผลการติดตามผ่านระบบ</div>
	<div class="row">
		<!--row-->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<!--rcorners-->
			<div class="">
				<!--row-->

				<div class="col-xs-12 col-xm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<p class="thfont5" style="">
							<label for="sel1">ค้นหาจาก:</label>
							<select class="form-control thfont5" id="sel1" style="height:auto;" onChange="javascript:showtxt(this.value);">
								<!-- <option value="1">ชื่อนิติบุคคล</option>-->
								<option value="2" selected>เลขนิติบุคคล 13 หลัก</option>
								<!--<option value="3">เลขบัญชีนายจ้าง 10 หลัก</option>-->
							</select>
						</p>
					</div>
					<!--formgroup-->
				</div>
				<!--cal-md-3-->

				<div class="col-xs-12 col-xm-12 col-md-3 col-lg-3">
					<div class="form-group" style="display:none;" id="dtxt1">
						<p class="thfont5" style="">

							<label class="thfont5" for="txt1">ชื่อนิติบุคคล:</label>
							<input type="text" class="form-control thfont5" id="txt1" style="height:auto;" placeholder="ชื่อนิติบุคคล">

						</p>
					</div>
					<!--formgroup-->
					<div class="form-group" id="dtxt2">
						<p class="thfont5" style="">

							<label class="thfont5" for="txt2">เลขนิติบุคคล 13 หลัก:</label>
							<input type="text" class="form-control thfont5" id="txt2" style="height:auto;" placeholder="0000000000000" maxlength="13" onFocus="this.select()">

						</p>
					</div>
					<!--formgroup-->
					<div class="form-group" style="display:none;" id="dtxt3">
						<p class="thfont5" style="">

							<label class="thfont5" for="txt3">เลขบัญชีนายจ้าง 10 หลัก:</label>
							<input type="text" class="form-control thfont5" id="txt3" style="height:auto;" placeholder="0000000000" maxlength="10" onFocus="this.select()">

						</p>
					</div>
					<!--formgroup-->
				</div>
				<!--cal-md-3-->

				<div class="col-md-3">
					<div class="form-group" style="" id="dbtn1">
						<p class="thfont5" style="padding-top:32px;">
							<label class="thfont5" for="btn1"></label>
							<button class="btn btn-info" id="btn1" onClick="javascript:callschcrop6();"><i class="fa fa-search"></i>
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
	

	
	<div class="row">
		<div class="col-md-12">
			<div class="row" id="rowresult1" style="display:none;">
				<div class="col-md-12">
					<div class="panel panel-info">
						<div class="panel-heading">
							<i class="fa fa-address-book"></i>
							<font class="thfont5" style="font-size:24px;"><b> ข้อมูลนิติบุคคลจาก WPD</b></font>
						</div>
						<!--panel heading-->
						<div class="panel-body">
							<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">

							</div>
						</div>
						<!--panelbody-->
					</div>
					<!--panel-->
				</div>
				<!--col-md-12-->
			</div>
			<!--rowresult1-->

			<div class="row" id="rowresult2" style="display:none;">
				<div class="col-md-12">
					<!--<div class="row" id="btnbacktb" style="padding-bottom:15px;">
                    	<div class="col-md-3">
                        	<button class="btn btn-primary" onClick="javascript:backtotable();" ><i class="fa fa-mail-reply"></i> <font class="thfont5">ย้อนกลับ</font></button>
                        </div>
                    </div><!--row-->
					<div class="row">
						<div class="col-md-12">

							<div class="panel panel-info">
								<!--panel-->
								<div class="panel-heading">
									<i class="fa fa-address-book"></i>
									<font class="thfont5" style="font-size:24px;"><b> ข้อมูลนิติบุคคลจาก WPD</b></font>
								</div>
								<div class="panel-body">
									<div id="cres1" class="thfont5">ข้อมูล Cropinfo</div>
								</div>
							</div>
							<!--panel-->

						</div>
					</div>
					<!--row-->
					<div class="row">
						<div class="col-md-4">

							<div class="panel panel-danger">
								<!--panel-->
								<div class="panel-heading">
									<i class="fa fa-address-book"></i>
									<font class="thfont5" style="font-size:24px;"><b> ข้อมูลสำนักงาน</b></font>
								</div>
								<div class="panel-body">
									<div id="cres2" class="thfont5">ข้อมูล branch</div>
								</div>
							</div>
							<!--panel-->

						</div>
						<!--col-md-4-->
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-danger">
										<!--panel-->
										<div class="panel-heading">
											<i class="fa fa-address-book"></i>
											<font class="thfont5" style="font-size:24px;"><b> ข้อมูลเจ้าของกิจการ</b></font>
										</div>
										<div class="panel-body">
											<div id="cres3" class="thfont5">ข้อมูล committee</div>
										</div>
									</div>
									<!--panel-->

								</div>
								<!--col-md-12-->
							</div>
							<!--row-->
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-danger">
										<!--panel-->
										<div class="panel-heading">
											<i class="fa fa-address-book"></i>
											<font class="thfont5" style="font-size:24px;"><b> รายละเอียดกิจการ</b></font>
										</div>
										<div class="panel-body">
											<div id="cres4" class="thfont5">ข้อมูล DetailCorp</div>
										</div>
									</div>
									<!--panel-->

								</div>
							</div>
							<!--row-->
						</div>
						<!--col-md-8-->
					</div>
					<!--row-->
				</div>
				<!--rowresult2-->
			</div>
			<!--row-->

		</div>
		<!--col-md-12-->
	</div>
	<!--row-->
					<script>
						function addItem(elmt) {
							$("#test").prop("disabled", true);
							var modal = $("#myModal")
							var dropdown_status = modal.find('#dropdown_status').val();
							var pasportnumber = modal.find('#txtPassportNumber').val();
							var datepicker = modal.find('#datepicker').val();
							var registernumber = modal.find('#registernumber').val();

							if (dropdown_status == 0) {
								alert('กรุณาระเลือกสถานะ');
								return;
							}
							if (dropdown_status == "AL") {
								if (pasportnumber == "") {
									alert('กรุณาระบุจำนวนลูกจ้าง');
									return;
								}
								if (datepicker == "") {
									alert('กรุณาเลือกวันที่คาดว่าจะเปิดทำการ');
									return;
								}
							}
							$('#re3').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");

							var result = confirm("ต้องการบันทึกข้อมูลใช่หรือไม่ ?");
							if (!result) {
								$("#test").prop("disabled", false);
								return;
							}


							$.ajax({
									url: "<?php echo Yii::app()->createAbsoluteUrl('corp/Updatecorpdata'); ?>",
									method: "POST",
									dataType: "json",
									data: {
										'dropdown_status': dropdown_status,
										'pasportnumber': pasportnumber,
										'datepicker': datepicker,
										'registernumber': registernumber
									},
								})
								.done(function(data) {
									if (data.msg == 'success') {
										$("#test").prop("disabled", false);
										alert('บันทึกข้อมูลสำเร็จ');
										$('#re3').html("");
										callschcrop6();
										$('body').removeClass('modal-open');
										$('#myModal').modal('hide');
										$('.modal-backdrop').remove();
							

									} else {
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

				</div>
			</div>

		</div>
	</div>


</body>

</html>