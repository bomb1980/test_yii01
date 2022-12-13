<?php
/*if(!isset(Yii::app()->session['user_loginname'])){
 	Yii::app()->CIdpLogin->getIdPinfo();
}*/
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

	/*$user_firstname = Yii::app()->session['firstname'];
	$user_lastname = Yii::app()->session['lastname'];
	$user_email = Yii::app()->session['email'];
	$user_access_level = Yii::app()->session['access_level'];
	$user_address = Yii::app()->session['address'];
	$user_access_code = Yii::app()->session['access_code'];*/
}
?>

<?php
$this->pageTitle = Yii::app()->name . ' - Administrator';
$this->breadcrumbs = array(
	'Administrator',
);
?>
<div class="row" style="padding-bottom:10px;">
	<?php if (isset($this->breadcrumbs)) : ?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links' => $this->breadcrumbs,
		)); ?>
		<!-- breadcrumbs -->
	<?php endif ?>
</div>

<style>
	/* Style the buttons */
	.mybtn {
		border: none;
		border-radius: 5px;
		outline: none;
		padding: 10px 16px;
		background-color: #f1f1f1;
		cursor: pointer;
		font-size: 18px;
	}

	/* Style the active class, and buttons on mouse-over */
	.myactive,
	.mybtn:hover {
		background-color: #666;
		color: white;
	}
</style>

<script>
	function openadmin(snum) {
		$("#a2").show("slow");
		var data1 = 'snum=' + snum;
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/openadmin'); ?>",
			data: data1,
			success: function(da) {
				if (da == 'Y') {
					$("#a2").html(da);
				} else {
					$("#a2").html(da);
				}
			}
		});
		window.scrollTo(500, 0);
	}
</script>

<div id="a1">

	<div class="" style="padding-bottom:15px;">
		<div class="main_subtitle fontcolor1">ENTREPRENEUR ● DATA CENTER</div>
		<!--<div class="main_title">Administrator</div>-->
	</div>

	<div id="op-group21" style="border-bottom: 1px solid #ebebeb; margin-top: 1.429rem;">

		<div class="form-group row pl-5 required form-inline">
			<div class="col-md-8 form-inline">
				<input type="text" class="form-control" id="line_subject" name="line_subject" value="" readonly>
				<label class="btn btn-primary col-md-2">
					<i class="fa fa-file"></i> เลือกไฟล์ <input type="file" style="display: none;" id="uploadBtn" name="uploadBtn" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .csv, text/plain" onchange="checkfile(this)">
				</label>
			</div>

		</div>

	</div>

	<div id="a2"></div>

	<button type="button" id="btnadd" name="btnadd" class="btn-primary btn waves-effect waves-classic" onclick="ajax_savepermission();">อัพโหลดไฟล์</button>

	<button class="btn btn-success" id="btn1" onclick="javascript:sync_data1();"><i class="fa fa-plus"></i>
		<font class="thfont5"> ปรับปรุงสถานะ</font>
	</button>

	<div class="sync_progress1 text-center">

	</div>

	<script>
		function ajax_savepermission() {
			if (document.getElementById("uploadBtn").files.length == 0) {
				console.log("no files selected");

				$('html, body').animate({
					scrollTop: $("#uploadBtn").offset().top - 100
				}, 2000);
				$("#uploadBtn").focus();

				$("#btnadd").prop("disabled", false);
				alert('กรุณาเลือกไฟล์');
				return;
			}

			var data = new FormData();
			data.append('uploadBtn', $('#uploadBtn')[0].files[0]);
			data.append('<?= Yii::app()->request->csrfTokenName ?>', '<?= Yii::app()->request->csrfToken ?>');

			$.ajax({
					url: "<?php echo Yii::app()->createAbsoluteUrl("/updatecorp/savefile") ?>",
					method: "POST",
					dataType: "json",
					enctype: 'multipart/form-data',
					contentType: false,
					cache: false,
					processData: false,
					data: data,
					beforeSend: function() {

					},
				})
				.done(function(data) {
					if (data.status == 'success') {
						alert('อัพโหลดไฟล์เรียบร้อย');
					} else {
						alert(data.msg);
					}

				})
				.fail(function(jqXHR, status, error) {
					// Triggered if response status code is NOT 200 (OK)
					//alert(jqXHR.responseText);

				})
				.always(function() {

				});



		}

		function checkfile(sender) {
			var validExts = new Array(".xlsx", ".xls", ".csv", ".txt", ".text");
			var fileExt = sender.value;
			fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
			if (validExts.indexOf(fileExt) < 0) {
				alert("Invalid file selected, valid files are of " +
					validExts.toString() + " types.");
				return false;
			} else {
				var file = $('#uploadBtn')[0].files[0].name;
				document.getElementById("line_subject").value = file;
				return true;
			}
		}

		$(document).ready(function() {

			//openadmin(1);
		});

		function sync_data1() {

			var result = confirm("ระบบการอัพเดตข้อมูลอาจใช้เวลานาน ต้องการทำงานต่อหรือไม่ ?");
			if (!result) {
				return;
			}


			$.ajax({
				url: "<?php echo Yii::app()->createAbsoluteUrl("partial/sync_datapaging"); ?>",
				method: "POST",
				cache: false,
				data: {
					'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
					'rand': '<?php echo time(); ?>',
				},
				success: function(data) {
					$(".sync_progress1").html(data);
				}
			});

			/*
			$('div.sync_progress1').dialog({
				closeOnEscape: false,
				modal: true,
				resizable: false,
				title: "ซิงค์ข้อมูลใน LDAP",
				open: function() {
					var win = $(window);

					$(this).parent().css({
						position: 'absolute',
						left: (win.width() - $(this).parent().outerWidth()) / 2,
						top: (win.height() - $(this).parent().outerHeight()) / 2
					});
					$('.ui-dialog').css({
						'z-index': 20000 // Could be any value but less than 1000.
					});
					$('.sync_progress1').css('overflow', 'hidden');

				},
				close: function() {
					$(".sync_progress1").html('');
					$('.ui-dialog-titlebar-close').css("display", "none");
					checkFields();
				},
				minWidth: 600,
				minHeight: 400,

			});
			*/
		}

		jQuery(document).ready(function($) {
			$(window).resize(function() {
				//$(".sync_progress").dialog("option", "position", "center");
			});

		});
	</script>

</div>