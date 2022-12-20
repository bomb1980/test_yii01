<?php 
// use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="vCard template project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<base href="<?php echo Yii::app()->getBaseUrl(true); ?>">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/css/form.css" />


	<link rel="shortcut icon" href="/themes/vcard/images/ssol2.png">

	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/bootstrap-4.1.2/bootstrap.min.css">

	<script src="/themes/vcard/js/jquery-3.2.1.min.js"></script>
	<script src="/themes/vcard/styles/bootstrap-4.1.2/popper.js"></script>
	<script src="/themes/vcard/styles/bootstrap-4.1.2/bootstrap.min.js"></script>

	<link rel="stylesheet" href="/themes/jquery-ui-1.12.1/jquery-ui.css">
	<script src="/themes/jquery-ui-1.12.1/jquery-ui.js"></script>

	<link rel="stylesheet" type="text/css" href="/themes/vcard/plugins/bootstrap/bootstrap.min.css">
	<script src="/themes/vcard/plugins/bootstrap/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/themes/vcard/plugins/datatable/css/jquery.dataTables.min.css">
	<script src="/themes/vcard/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="/themes/vcard/plugins/datatable/js/dataTables.buttons.min.js"></script>
	<script src="/themes/vcard/plugins/datatable/js/jszip.min.js"></script>
	<script src="/themes/vcard/plugins/datatable/js/pdfmake.min.js"></script>
	<script src="/themes/vcard/plugins/datatable/js/vfs_fonts.js"></script>
	<script src="/themes/vcard/plugins/datatable/js/buttons.html5.min.js"></script>
	<script src="/themes/vcard/plugins/datatable/js/buttons.print.min.js"></script>
	<script src="/themes/vcard/plugins/datatable/js/buttons.colVis.min.js"></script>


	<!-- <title>Read Users</title> -->

	<!--Include this css file in the <head> tag -->
	<link rel="stylesheet" href="/themes/vcard/plugins/lobipanel/lib/jquery-ui.min.css" />
	<link rel="stylesheet" href="/themes/vcard/plugins/lobipanel/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/themes/vcard/plugins/lobipanel/dist/css/lobipanel.min.css" />

	<!--Include these script files in the <head> or <body> tag-->
	<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/plugins/lobipanel/lib/jquery.1.11.min.js"></script>-->
	<script src="/themes/vcard/plugins/lobipanel/lib/jquery-ui.min.js"></script>
	<script src="/themes/vcard/plugins/lobipanel/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/themes/vcard/plugins/lobipanel/dist/js/lobipanel.min.js"></script>

	<!-- include bootstrap dialog -->
	<link rel="stylesheet" type="text/css" href="/themes/vcard/plugins/bootstrapdialog/css/bootstrap-dialog.min.css">
	<script src="/themes/vcard/plugins/bootstrapdialog/js/bootstrap-dialog.min.js"></script>

	<link href="/themes/vcard/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/plugins/mCustomScrollbar/jquery.mCustomScrollbar.css">

	<link rel="stylesheet" type="text/css" href="/themes/vcard/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/plugins/OwlCarousel2-2.2.1/animate.css">



	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/responsive.css">

	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/contact.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/contact_responsive.css">

	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/education.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/education_responsive.css">

	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/experience.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/experience_responsive.css">

	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/portfolio.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/portfolio_responsive.css">

	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/services.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/services_responsive.css">

	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/skills.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/skills_responsive.css">

	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/testimonials.css">
	<link rel="stylesheet" type="text/css" href="/themes/vcard/styles/testimonials_responsive.css">


	<script src="/themes/vcard/plugins/greensock/TweenMax.min.js"></script>
	<script src="/themes/vcard/plugins/greensock/TimelineMax.min.js"></script>
	<script src="/themes/vcard/plugins/greensock/animation.gsap.min.js"></script>
	<script src="/themes/vcard/plugins/greensock/ScrollToPlugin.min.js"></script>
	<script src="/themes/vcard/plugins/progressbar/progressbar.js"></script>

	<script type="text/javascript" src="/themes/vcard/plugins/highcharts/highcharts.js"></script>
	<script type="text/javascript" src="/themes/vcard/plugins/highcharts/exporting.js"></script>
	<script type="text/javascript" src="/themes/vcard/plugins/highcharts/modules/data.js"></script>
	<script type="text/javascript" src="/themes/vcard/plugins/highcharts/modules/drilldown.js"></script>

	<script src="/themes/vcard/plugins/mCustomScrollbar/jquery.mCustomScrollbar.js"></script>
	<!--<script src="/themes/vcard/plugins/easing/easing.js"></script>-->
	<script src="/themes/vcard/plugins/parallax-js-master/parallax.min.js"></script>

	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
	<script src="/themes/vcard/plugins/Isotope/isotope.pkgd.min.js"></script>
	<script src="/themes/vcard/plugins/Isotope/fitcolumns.js"></script>
	<script src="/themes/vcard/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>

	<script src="/themes/vcard/js/custom.js"></script>
	<script src="/themes/vcard/js/services.js"></script>
	<script src="/themes/vcard/js/contact.js"></script>
	<script src="/themes/vcard/js/education.js"></script>
	<script src="/themes/vcard/js/experience.js"></script>
	<script src="/themes/vcard/js/portfolio.js"></script>
	<script src="/themes/vcard/js/skills.js"></script>
	<script src="/themes/vcard/js/testimonials.js"></script>

	<script>
		/*
	function indexpage(){
		$("#c1").load("indexpage.php");	
	}
	*/

		function cactive(n) {

		}

		function togglegeninfo1() {
			$("#geninfo1").toggle("slow");
			//$("#geninfo1").hide();
		}

		function chkelm(chkid) {
			if (document.getElementById(chkid).value != "") {
				$("#" + chkid + "").removeClass("invalid").addClass("valid");
				$("#st_" + chkid + "").html("");
			} else {
				$("#" + chkid + "").removeClass("valid").addClass("invalid");
				$("#st_" + chkid + "").html("เป็นค่าว่างไม่ได้");
			}
		}

		function checkKey(n) {
			if (window.event.keyCode == 13) { //Enter
				if (n == "lg1") {
					chkelm(n);
					$('#lg2').focus();
				}
				if (n == "lg2") {
					chkelm(n);
					chklogin('lg', 2);
				}
			} else if (window.event.keyCode == 37) { //Left
				//
			} else if (window.event.keyCode == 38) { //Up
				//
			} else if (window.event.keyCode == 39) { //Right
				//
			} else if (window.event.keyCode == 40) { //Down
				//
			} else {
				//
			}
		}
	</script>

	<style type="text/css">
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

		.fontcolor1 {
			color: #FCB103;
			font-weight: bold;
		}

		input.invalid,
		textarea.invalid,
		select.invalid {
			border: 1px solid red;
		}

		input.valid,
		textarea.valid,
		select.valid {
			border: 1px solid green;
		}


		.ui-datepicker-trigger {
			margin-left: 5px;
			/*margin-top: 8px;
	 margin-bottom: -3px;*/
		}

		.mytextbox {
			padding: 5px 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
	</style>

</head>

<body>
	<?php

	// exit;
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
	<div class="super_container">

		<!-- Header -->

		<header class="header">
			<div class="header_content d-flex flex-row align-items-center justify-content-start">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssol2.png" width="90" height="90" onClick="javascript:togglegeninfo1();">
				<div class="logo"> W<span>P</span>D
					<!--<span>.</span>CV-->
				</div>

				<div id="mymemu" class="main_nav d-flex flex-row align-items-end justify-content-start">
					<?php if (!Yii::app()->user->isGuest) { ?>
						<ul id="ulmain1" class="d-flex flex-row align-items-center justify-content-start">
							<li>
								<a href="javascript:togglegeninfo1();"><?php echo "{$user_firstname}, {$user_lastname} ● {$user_address}"; ?></a></li>
							<?php if ($user_access_level == 'admin') { ?>
								<li id="m1" onClick="javascript:cactive(this.id);">
									<!-- class="active" -->
									<?php echo CHtml::link('<i class="fa fa-home"></i> About', array('site/index')); ?>
								</li>
							<?php } ?>
							<?php if ($user_access_level == 'admin') { ?>
								<li id="m2" onClick="javascript:cactive(this.id);">
									<?php echo CHtml::link('<i class="fa fa-cog"></i> Services', array('site/services')); ?>
								</li>
							<?php } ?>
							<li id="m3" onClick="javascript:cactive(this.id);">
								<?php echo CHtml::link('<i class="fa fa-search"></i> Search', array('site/searchs')); ?>
							</li>
							<li id="m4" onClick="javascript:cactive(this.id);">
								<?php echo CHtml::link('<i class="fa fa-book"></i> Report', array('site/reports')); ?>
							</li>
							<?php if ($user_access_level == 'admin' || $user_access_level == 'admin-audit') { ?>
								<li id="m5" onClick="javascript:cactive(this.id);">
									<?php echo CHtml::link('<i class="fa fa-cogs"></i> Admin', array('site/admins')); ?>
								</li>
							<?php } ?>
							<li id="m6" onClick="javascript:cactive(this.id);">
								<?php echo CHtml::link('<i class="fa fa-sign-out"></i> Logout', array('site/logout')); ?>
							</li>
						</ul>
					<?php } else { ?>
						<ul class="d-flex flex-row align-items-center justify-content-start">
							<li><a href="javascript:;">ENTREPRENEUR ● DATA CENTER</a></li>
						</ul>
					<?php } ?>
					 
				</div>

				<!-- Menu -->
				<div class="menu">
					<div class="menu_content d-flex flex-row align-items-start justify-content-end">
						<?php if (!Yii::app()->user->isGuest) {  ?>
							<div class="hamburger ml-auto">menu</div>
							<div class="menu_nav text-right">
								<ul>
									<?php if ($user_access_level == 'admin') { ?>
										<li class="ml-auto">
											<!--<a href="index.php"><i class="fa fa-home"></i> About</a>-->
											<?php echo CHtml::link('<i class="fa fa-home"></i> About', array('site/index')); ?>
										</li>
									<?php } ?>
									<?php if ($user_access_level == 'admin') { ?>
										<li class="ml-auto">
											<!--<a href="#"><i class="fa fa-cog"></i> Services</a>-->
											<?php echo CHtml::link('<i class="fa fa-cog"></i> Services', array('site/services')); ?>
										</li>
									<?php } ?>
									<li class="ml-auto">
										<!--<a href="#"><i class="fa fa-search"></i> Search</a>-->
										<?php echo CHtml::link('<i class="fa fa-search"></i> Search', array('site/searchs')); ?>
									</li class="ml-auto">
									<li>
										<!--<a href="#"><i class="fa fa-book"></i> Report</a>-->
										<?php echo CHtml::link('<i class="fa fa-book"></i> Report', array('site/reports')); ?>
									</li>
									<?php if ($user_access_level == 'admin') { ?>
										<li class="ml-auto">
											<!--<a href="#"><i class="fa fa-cogs"></i> Admin</a>-->
											<?php echo CHtml::link('<i class="fa fa-cogs"></i> Admin', array('site/admins')); ?>
										</li>
									<?php } ?>
									<li class="ml-auto">
										<!--<a href="#"><i class="fa fa-sign-out"></i> Logout</a>-->
										<?php echo CHtml::link('<i class="fa fa-sign-out"></i> Logout', array('site/logout')); ?>
									</li>
									<!--<li class="ml-auto"><a href="education.php">Education</a></li>
							<li class="ml-auto"><a href="portfolio.php">Portfolio</a></li>
							<li class="ml-auto"><a href="testimonials.php">Testimonials</a></li>
							<li class="ml-auto"><a href="contact.php">Contact</a></li>-->
								</ul>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</header>

		<div class="content_container" id="c1">
			<!--content_container-->

			<div class="main_content_outer d-flex flex-xl-row flex-column align-items-start  justify-content-start">
				<!--   -->


				<!-- General Information -->
				<div id="geninfo1" class="general_info flex-xl-column flex-md-row flex-column" style="display:none;">
					<!-- d-flex  -->
					<div>
						<div class="general_info_image">
							<!---->
							<div class="background_image" style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssop1.jpg)"></div>
							<?php if (!Yii::app()->user->isGuest) { //if(isset(Yii::app()->session['user_loginname'])) { 
							?>
								<div class="header_button_2">
									<a href="#" charset="thfont3"><?php echo "{$user_firstname}, {$user_lastname} : {$user_address}"; ?></a>
									<div class="d-flex flex-column align-items-center justify-content-center">
										<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/test_3.jpg" width="100%" height="auto" alt="">
										<!--style="border-radius: 50%;"-->
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="general_info_content" style=" padding-left:10px;">
						<!-- style=" background-image: linear-gradient(to bottom, #000010, #000099 , #000010);"-->
						<div class="general_info_content_inner mCustomScrollbar" data-mcs-theme="minimal-dark">
							<!--<div class="general_info_title">General Information</div>-->
							<ul class="general_info_list">
								<li class=" flex-row align-items-center justify-content-start">
									<!--d-flex-->
									<div class="general_info_icon d-flex flex-column align-items-start justify-content-center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_1.png" alt=""></div>
									<div class="general_info_text"><span class="thfont3">สำนักงานประกันสังคม สํานักงานใหญ่</span></div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="general_info_icon d-flex flex-column align-items-start justify-content-center"></div>
									<div class="general_info_text">Location:
										<p><span class="thfont3">เลขที่ 88/28 หมู่ 4 ถนนติวานนท์ ตำบลตลาดขวัญ อำเภอเมือง จังหวัดนนทบุรี รหัสไปรษณีย์ 11000</span></p>
									</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="general_info_icon d-flex flex-column align-items-start justify-content-center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_2.png" alt=""></div>
									<div class="general_info_text">
										Application: <span>WPD :
											<script>
												document.write(new Date().toLocaleString('en-us', {
													month: 'long'
												}));
											</script>
											<script>
												document.write(new Date().getDate());
											</script>,
											<script>
												document.write(new Date().getFullYear());
											</script>
										</span>
									</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="general_info_icon d-flex flex-column align-items-start justify-content-center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_3.png" alt=""></div>
									<div class="general_info_text"><a href="mailto:info@sso.go.th?subject=wpd_app">info@sso.go.th </a></div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="general_info_icon d-flex flex-column align-items-start justify-content-center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_4.png" alt=""></div>
									<div class="general_info_text thfont3">+66 0-2956-2345 สายด่วน 1506</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="general_info_icon d-flex flex-column align-items-start justify-content-center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_5.png" alt=""></div>
									<div class="general_info_text"><a href="mailto:info@sso.go.th">www.sso.go.th</a></div>
								</li>
							</ul>

							<!-- Social -->
							<div class="social_container" style="padding-bottom:20px;">
								<ul class="d-flex flex-row align-items-start justify-content-start">
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- General Information -->


				<!-- Main Content -->

				<div class="main_content">
					<!---->

					<!-- contenner start -->
					<?php echo $content; ?>
					<!-- contenner end -->

				</div>

			</div>
		</div>

		<div align='center'>
			<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
			Copyright &copy;<script>
				document.write(new Date().getFullYear());
			</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">TCM Technology</a>
			<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
		</div>

	</div>
	</div>


</body>

</html>