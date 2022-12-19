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

<div class="container" id="page">
	<div id="header">
		<div class="top-menus">
		<?php echo CHtml::link('help','https://www.yiiframework.com/doc/guide/1.1/en/topics.gii'); ?> |
		<?php echo CHtml::link('webapp',Yii::app()->homeUrl); ?> |
		<a href="http://www.yiiframework.com">yii</a>
		<?php if(!Yii::app()->user->isGuest): ?>
			| <?php echo CHtml::link('logout',array('default/logout')); ?>
		<?php endif; ?>
		</div>
		<div id="logo"><?php echo CHtml::link(CHtml::image($this->module->assetsUrl.'/images/logo.png'),array('default/index')); ?></div>
	</div><!-- header -->

	<?php echo $content; ?>

</div><!-- page -->

<div id="footer">
	<?php echo Yii::powered(); ?>
	<br/>A product of <a href="http://www.yiisoft.com">Yii Software LLC</a>.
</div><!-- footer -->

</body>

 
</html>