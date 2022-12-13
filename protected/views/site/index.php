<?php
/*if(!isset(Yii::app()->session['user_loginname'])){
 	Yii::app()->CIdpLogin->getIdPinfo();
}*/
?>

<?php
 $this->pageTitle=Yii::app()->name . ' - About';
 $this->breadcrumbs=array(
	'About',
 );
?>

<div class="row" style="padding-bottom:10px;">
<?php if(isset($this->breadcrumbs)):?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    )); ?><!-- breadcrumbs -->
<?php endif?>
</div>
<div id="a1">
   
   <div class="" style="padding-bottom:20px;"><!--main_title_container d-flex flex-column align-items-start justify-content-end-->
      <div class="main_subtitle fontcolor1">ENTREPRENEUR ● DATA CENTER </div>
      <div class="main_title">WPD</div>
   </div>
   
    <div class="about_title">Description</div>
    <div class="thfont4" style="padding-bottom:20px;">
        <p class="thfont4">ระบบ WPD คือ ระบบรวบรวมฐานข้อมูลผู้ประกอบการมาไว้เป็นศูนย์กลาง เพื่อใช้สำหรับให้บริการข้อมูลในรูปแบบของ Web Service ซึ่งจะเชื่อมโยงข้อมูลกับ หน่วยงานภาครัฐอื่นๆ เช่น กรมธุรกิจการค้า, (DBD) เพื่อตอบสนอง แผนการขับเคลื่อนการอำนวยความสะดวกในการประกอบธุรกิจ (Doing Business) และ สามารถดำเนินการรวมขั้นตอนการจดทะเบียนธุรกิจ การจดทะเบียนภาษีมูลค่าเพิ่ม การขึ้นทะเบียนลูกจ้าง ให้สะดวกรวดเร็ว ลดขั้นตอนการดำเนินการของผู้ประกอบการให้ได้รับความสะดวกมากขึ้น.
        </p>
    </div>
    
    <div class="about_title" style="padding-bottom:20px;">Process Diagrams</div>
    <div style="padding-bottom:20px;">
    	<p class="thfont4">
        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/processd1.jpg" width="100%" height="auto" />
        </p>
    </div>
    
    
       <div class="services_container d-flex flex-row flex-wrap align-items-start justify-content-start">
        <!-- Service1 -->
            <!--<div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div>
                        <div class="service_icon">
                            <!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_10.png" alt="">
                            <div style="font-size:50px; color:#666;"><i class="fa fa-bar-chart"></i></div>
                        </div>
                    </div>
                    <div class="service_title">Fast WPD services</div>
                </div>
                <div class="service_text">
                    <p class="thfont5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
                </div>
            </div>-->
            
        <!-- Service2 -->
        <!--<div class="service">
            <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                <div>
                    <div class="service_icon">
                        <!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_11.png" alt="">
                        <div style="font-size:50px; color:#666;"><i class="fa fa-pie-chart"></i></div>
                    </div>
                </div>
                <div class="service_title">Documentations</div>
            </div>
            <div class="service_text">
                <p class="thfont5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
            </div>
        </div>-->
        
       </div>
    
    
    
    <!-- Milestone -->
    <!--<div class="milestone text-center">
        <div class="milestone_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_6.png" alt=""></div>
        <div class="milestone_counter" data-end-value="14">0</div>
        <div class="milestone_text">Years of Experience</div>
    </div>-->

    <!-- Milestone -->
    <!--<div class="milestone text-center">
        <div class="milestone_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_7.png" alt=""></div>
        <div class="milestone_counter" data-end-value="1000" data-sign-before="+">0</div>
        <div class="milestone_text">Happy Clients</div>
    </div>-->

    <!-- Milestone -->
    <!--<div class="milestone text-center">
        <div class="milestone_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_8.png" alt=""></div>
        <div class="milestone_counter" data-end-value="14" data-sign-after="k">0</div>
        <div class="milestone_text">Followers on FB</div>
    </div>-->

    <!-- Milestone -->
    <!--<div class="milestone text-center">
        <div class="milestone_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_9.png" alt=""></div>
        <div class="milestone_counter" data-end-value="732">0</div>
        <div class="milestone_text">Finished Projects</div>
    </div>-->
   
   <div style="padding-top:20px;">-</div>
    
   
</div><!--a1-->

<script>
	$(document).ready(function() {
		$("#m1").addClass( "active" );
		//$('#a1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		//$("#a1").load("<?php echo Yii::app()->createAbsoluteUrl('site/openhome'); ?>");
	});
</script>