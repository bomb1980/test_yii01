<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<!-- General Information -->
			<div id="geninfo1" class="general_info d-flex flex-xl-column flex-md-row flex-column" >
				<div>
					<div class="general_info_image">
						<div class="background_image" style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/ssop1.jpg)"></div>
                        <?php if(!Yii::app()->user->isGuest) { ?>
						<div class="header_button_2">
							<a href="#" charset="thfont3"><?php echo "{$user_firstname}, {$user_lastname}"; ?></a>
							<div class="d-flex flex-column align-items-center justify-content-center">
                            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/test_3.jpg" width="100%" height="auto" alt=""><!--style="border-radius: 50%;"-->
                           	</div>
						</div>
                        <?php } ?>
					</div>
				</div>
				<div class="general_info_content" ><!--style=" background-image: linear-gradient(to bottom, #000010, #000099 , #000010);"-->
					<div class="general_info_content_inner mCustomScrollbar" data-mcs-theme="minimal-dark">
						<div class="general_info_title">General Information</div>
						<ul class="general_info_list">
							<li class="d-flex flex-row align-items-center justify-content-start">
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
                                    	<script>document.write(new Date().toLocaleString('en-us', { month: 'long' }));</script> 
                                        <script>document.write(new Date().getDate());</script>, 
										<script>document.write(new Date().getFullYear());</script></span>
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
						<div class="social_container">
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
            

</body>
</html>