<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Users</title>
	<?php $conn = Yii::app()->db;
	$sql = "
				select count(*) AS cts from ledriskcrop_tb
				";
	$command = $conn->createCommand($sql);
	$rows = $command->queryAll();
	$noOfRecords =  $rows[0]['cts'];

	?>



	<?php

	$checkdoc2 = $_SERVER['DOCUMENT_ROOT'] . "/wpdcore/ledtextfile/sapiens"; //server local
	//$checkdoc = $checkdoc2 . "/log_$daycut.TXT" ; //server uat
	$files = array_merge(glob($checkdoc2 . "/log_*.TXT"));
	$files = array_combine($files, array_map("filemtime", $files));
	arsort($files);

	$latest_file = key($files);
	$d = date("Y-m-d H:m", filemtime($latest_file));
	$n = date('y/m/d H:m', strtotime($d . " +543 year"));

	?>

	<script>
		function getfile(filename, dataUrl) {
			// Construct the 'a' element
			var link = document.createElement("a");
			link.download = filename;
			link.target = "_blank";

			// Construct the URI
			link.href = dataUrl;
			document.body.appendChild(link);
			link.click();

			// Cleanup the DOM
			document.body.removeChild(link);
			delete link;
		}





		$(document).ready(function() {

			$('.panel').lobiPanel({
				reload: false,
				close: false,
				editTitle: false,
				sortable: true
				//minimize: false
			});

			loadusgfrm('opn', 0);
			loadusgtb();

		});


		function hideallservice(snum) {
			$("#ad1").hide("slow");
			$("#ad2").show("slow");
			var data1 = 'snum=' + snum;
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/openadminuser'); ?>",
				data: data1,
				success: function(da) {
					if (da == 'Y') {
						$("#ad3").html(da);
					} else {
						$("#ad3").html(da);
					}
				}
			});
			window.scrollTo(500, 0);
		}

		function showallservice() {
			$("#ad2").hide("slow");
			$("#ad1").show("slow");
			$("#ad3").html("");
			window.scrollTo(500, 0);
		}

		function loadusgfrm(action, usgid) {
			var data1 = 'action=' + action + "&usgid=" + usgid;
			//$('#usgf1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/callusergroupfrm'); ?>",
				data: data1,
				success: function(da) {
					$("#usgf1").html(da);
				}
			});
		}

		function loadusgtb() {
			var data1 = 'action=opn';
			$('#usp1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/callusergroup'); ?>",
				data: data1,
				success: function(da) {
					$("#usp1").html(da);
				}
			});
		} //loadusgtb()

		function callcreatenewusg(action, n1, n2) {
			//alert(action + "," + n1 + "," + n2);
			var ste = 0;
			var data = "";
			var el = []; //new FormData($("#frm")[0])
			var i = 0;
			for (i = 1; i <= n2; i++) { //วนลูปตรวจสอบ ค่าว่าง
				el[i] = $("#" + n1 + i + "").val();
				if (el[i] == "") {
					ste += 1;
				}
				if (i == 1) {
					data = data + "" + n1 + i + "=" + el[i];
				} else {
					data = data + "&" + n1 + i + "=" + el[i];
				}
				chkelm("" + n1 + i + ""); //เปลี่ยน class ถ้าเป็นค่าว่าง
			}
			//alert(ste);
			data = data + "&action=" + action;
			//alert(data);
			if (ste == 0) {
				//-------- send data for add -------------------------
				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl('site/calladdusg'); ?>",
					data: data,
					success: function(result) { //$("#usp1").html(result);
						var obj = jQuery.parseJSON(result);
						if (obj.status == 'success') {
							BootstrapDialog.alert('<font class="thfont5">เพิ่มรายการเสร็จเรียบร้อยแล้ว!</font>');
							loadusgtb();
							//clear form-----
							for (i = 1; i <= n2; i++) {
								$("#" + n1 + i + "").val("");
							} //for(i=1; i<=n2 ; i++)
						} else if (obj.status == 'error') {
							BootstrapDialog.alert('<font class="thfont5">ไม่สามารถเพิ่มรายการได้!</font>');
						} else if (obj.status == 'errordup') {
							BootstrapDialog.alert('<font class="thfont5">ไม่สามารถเพิ่มรายการได้ เนื่องจากรายการซ้ำกับข้อมูลที่มีอยู่แล้ว!</font>');
						}
					}
				});
			} else {
				BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลให้ครบถ้วน!</font>');
			}

		} //callcreatenewusg(action,n1,n2)

		function callupdateusg(action, n1, n2, udid) {
			//alert(action + "," + n1 + "," + n2 + "," + udid);
			var ste = 0;
			var data = "";
			var el = []; //new FormData($("#frm")[0])
			var i = 0;
			for (i = 1; i <= n2; i++) { //วนลูปตรวจสอบ ค่าว่าง
				el[i] = $("#" + n1 + i + "").val();
				if (el[i] == "") {
					ste += 1;
				}
				if (i == 1) {
					data = data + "" + n1 + i + "=" + el[i];
				} else {
					data = data + "&" + n1 + i + "=" + el[i];
				}
				chkelm("" + n1 + i + ""); //เปลี่ยน class ถ้าเป็นค่าว่าง
			}
			//alert(ste);
			data = data + "&action=" + action + "&udid=" + udid;
			//alert(data);
			if (ste == 0) {
				//-------- send data for add -------------------------
				$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createAbsoluteUrl('site/callchgusg'); ?>",
					data: data,
					success: function(result) {
						var obj = jQuery.parseJSON(result);
						//$("#usp1").html(obj.status);
						if (obj.status == 'success') {
							BootstrapDialog.alert('<font class="thfont5">ปรับปรุงรายการเสร็จเรียบร้อยแล้ว!</font>');
							loadusgtb();
							loadusgfrm('opn', 0);
							//clear form-----
							for (i = 1; i <= n2; i++) {
								$("#" + n1 + i + "").val("");
							} //for(i=1; i<=n2 ; i++)
						} else if (obj.status == 'error') {
							BootstrapDialog.alert('<font class="thfont5">ไม่สามารถปรับปรุงรายการได้!</font>');
						}
					}
				});
			} else {
				BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลให้ครบถ้วน!</font>');
			}


		} //callupdateusg(action,n1,n2,udid)

		function calldelusg(action, deid, dename) {
			//alert(action + "," + deid);	
			var data = "";
			data = "dename=" + dename + "&action=" + action + "&deid=" + deid;
			BootstrapDialog.confirm({
				title: "<font class='thfont5'>ยืนยันการลบข้อมูล</font>",
				message: "<font class='thfont5'> ต้องการลบรายการข้อมูล '" + dename + "'  ไช่ หรือ ไม่? </font>",
				type: BootstrapDialog.TYPE_DANGER,
				closable: true,
				draggable: true,
				btnOKLabel: 'OK',
				btnCancelLabel: 'Cancel',
				callback: function(result) {
					if (result) {
						$.ajax({
							type: "POST",
							url: "<?php echo Yii::app()->createAbsoluteUrl('site/calldelusg'); ?>",
							data: data,
							success: function(msg) {
								//$("#usp1").html(msg);
								var obj = jQuery.parseJSON(msg);
								//$("#usp1").html(obj.status);
								if (obj.status == 'success') {
									BootstrapDialog.alert('<i class="fa fa-check"></i><font class="thfont5"> ลบรายการเสร็จเรียบร้อยแล้ว!</font>');
									loadusgtb();
									loadusgfrm('opn', 0);
									//clear form-----
									for (i = 1; i <= n2; i++) {
										$("#" + n1 + i + "").val("");
									} //for(i=1; i<=n2 ; i++)
								} else if (obj.status == 'error') {
									BootstrapDialog.alert('<i class="fa fa-close"></i><font class="thfont5"> ไม่สามารถลบรายการได้!</font>');
								}
							} //success
						}); //$.ajax({

					} //if(result)
				} //callback
			});

		}

		function addnewledtmp() {
			//$('#usp2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...").show("slow");;
			/*
			$.ajax({
				type: "POST", 
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/addnewledtmp'); ?>",      
				success: function(da)
				{
					$("#usp2").hide("slow");
					BootstrapDialog.alert(da);
					//echo(da);
				  	console.log(da);
				 
				}
				
			});*/

			request = $.ajax({
				url: "<?php echo Yii::app()->createAbsoluteUrl('led/addnewledtmp'); ?>",
				type: "post",
				timeout:0,
				beforeSend: function() {
					$('#btn_loadled').prop("disabled", true);
					$('#usp2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...").show("slow");;
				}
			});

			request.done(function(da, textStatus, jqXHR) {
				BootstrapDialog.alert(da);
			});
			request.fail(function(jqXHR, textStatus, errorThrown) {
				console.error(
					"The following error occurred: " +
					textStatus, errorThrown
				);
				if (jqXHR.status == 401) {
					BootstrapDialog.alert("กรุณาล็อกอินอีกครั้ง");
				}
				if (jqXHR.status == 402) {
					BootstrapDialog.alert("กรุณารอสักครู่");
				}
			});
			request.always(function() {
				$("#usp2").hide("slow");
				$('#usp2').html("");
				$("#btn_loadled").removeAttr('disabled');
			});

		}

		function serviceled() {
			/*
			$('#usp2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...").show("slow");
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/serviceled'); ?>",
				success: function(da) {

					if (da >= 1) {
						$("#usp2").hide("slow");
						console.log(da);
						alert(da);
					} else {
						$("#usp2").hide("slow");
						alert("จำนวนคงเหลือที่ยังไม่ได้ถาม LED : 0 รายการ ");
					}
				}
			});*/

			request = $.ajax({
				url: "<?php echo Yii::app()->createAbsoluteUrl('led/serviceled'); ?>",
				type: "post",
				timeout:0,
				beforeSend: function() {
					$('#btn_callled').prop("disabled", true);
					$('#usp2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...").show("slow");;
				}
			});

			request.done(function(da, textStatus, jqXHR) {
				if (da >= 1) {
					console.log(da);
					alert(da);
				} else {
					alert("จำนวนคงเหลือที่ยังไม่ได้ถาม LED : 0 รายการ ");
				}
			});
			request.fail(function(jqXHR, textStatus, errorThrown) {
				console.error(
					"The following error occurred: " +
					textStatus, errorThrown
				);
				if (jqXHR.status == 401) {
					BootstrapDialog.alert("กรุณาล็อกอินอีกครั้ง");
				}
			});
			request.always(function() {
				$("#usp2").hide("slow");
				$('#usp2').html("");
				$("#btn_callled").removeAttr('disabled');
			});

		}
		function loadimportresultled(){

			window.open('<?php echo Yii::app()->createAbsoluteUrl('led/loadimportresultled'); ?>', '_blank').focus();
		}
	</script>
</head>

<body>

	<div class="about_title thfont5" style="font-size:30px;">เรียกใช้งาน LED (ชั่วคราว)</div>
	<div class="row" style="padding-top:15px;">
		<!--row-->
		<div class="col-md-12">
			<!--rcorners-->
			<button type="button" class="btn btn-success" id="btn_loadled" onClick="javascript:addnewledtmp();"><i class="fa fa-plus"></i>
				<font class="thfont5"> เพิ่มข้อมูลจาก Textfile</font>
			</button>
			<button type="button" class="btn btn-success" id="btn_callled" onClick="javascript:serviceled();"><i class="fa fa-plus"></i>
				<font class="thfont5"> เรียก LED Service</font>
			</button>
			<button type="button" class="btn btn-success" id="btn_loadfileled" onClick="javascript:loadimportresultled();"><i class="fa fa-download"></i>
				<font class="thfont5"> ดาวน์โหลดผลลัพธ์</font>
			</button>
			<p>จำนวนคงเหลือที่ยังไม่ได้ถาม LED : <?php echo ($noOfRecords); ?> รายการ || อัพเดตล่าสุด :
				<?php
				if (file_exists($latest_file)) {
					echo ($n);
				} else {
					echo ("ไม่พบไฟล์ที่อัพเดต กรุณาคลิกปุ่มเพิ่มข้อมูลจาก Textfile");
				}
				?>
			</p>





			<div id="usp2">
			</div>
		</div>
		<!--col-md-12-->
	</div>
	<!--row-->
	</div>
	</div>
	<br>
	<div class="about_title thfont5" style="font-size:30px;">กลุ่มผู้ใช้งาน</div>
	<div class="row" style="padding-top:15px;">
		<!--row-->
		<div class="col-md-12">
			<!--rcorners-->
			<div id="usgf1">

			</div>
			<!--usgf1-->
		</div>
		<!--col-md-12-->
	</div>
	<!--row-->

	<div class="row" style="padding-top:15px;">
		<!--row-->
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-users"></i>
					<font class="thfont5" style="font-size:24px;"> ข้อมูลกลุ่มผู้ใช้งาน</font>
				</div>
				<!--panel heading-->
				<div class="panel-body">
					<div id="usp1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">

					</div>
				</div>
				<!--panelbody-->
			</div>
			<!--panel-->
		</div>
		<!--col-md-12-->
	</div>
	<!--row-->



	<!--<div id="ad1">
	<div  class="services_container d-flex flex-row flex-wrap align-items-start justify-content-start">
    
    	<div class="service">
        	<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                <div><div class="service_icon" style="font-size:50px; color:#666;"><i class="fa fa-cube"></i></div></div>
                <div class="service_title">User Category</div>
        	</div>
            <div class="service_text">
                <button class="btn btn-info" onClick="javascript:hideallservice(1);"><i class="fa fa-keyboard-o"></i> Manage</button>
            </div>
    	</div>
        
        <div class="service">
        	<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                <div><div class="service_icon" style="font-size:50px; color:#666;"><i class="fa fa-users"></i></div></div>
                <div class="service_title">All Users</div>
        	</div>
            <div class="service_text">
                <button class="btn btn-info" onClick="javascript:hideallservice(2);"><i class="fa fa-keyboard-o"></i> Manage</button>
            </div>
    	</div>
        
     </div>
  </div>
     
     <div id="ad2" style="display:none; padding-bottom:20px;">
    	<button class="btn btn-info btn-small" onClick="javascript:showallservice();"><i class="fa fa-mail-reply"></i> back to All Admin Users</button>
    	<div id="ad3"></div>
    </div>-->

</body>

</html>