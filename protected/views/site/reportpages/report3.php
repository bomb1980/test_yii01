<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>WPD REPORT</title>
<script>
	$(document).ready(function() {
		$('.panel').lobiPanel({
       		reload: false,
    		close: false,
			editTitle: false,
			sortable: true
			//minimize: false
		});
	});
</script>
</head>

<body>
	<div class="row">
    
    	<div class="col-md-12 thfont5">
        	<div class="panel panel-danger"><!--panel-->
            	<div class="panel-heading"><!--header-->
                    <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> WPD Report</font>
                </div><!--header-->
                <div class="panel-body"><!--body-->
                    <div id="rpn1" class="thfont5">
                    	<!--<span>
                        	<p class="thfont5">&deg; <a href="javascript:;" onClick="javascript:showreport('1');">ตัวอย่างรายงาน 1</a></p>
                            <p class="thfont5">&deg; <a href="javascript:;" onClick="javascript:showreport('2');">ตัวอย่างรายงาน 2</a></p>
                            <p class="thfont5">&deg; <a href="javascript:;" onClick="javascript:showreport('3');">ตัวอย่างรายงาน 3</a></p>
                            <p class="thfont5">&deg; <a href="<?php //echo Yii::app()->createAbsoluteUrl('site/callshowrpt1'); ?>" target="_blank">ตัวอย่างรายงาน 4</a></p>
                        </span>-->
                        <!-- /////////////////////////////////////////////////////////////////////////// -->
                        <div class="services_container d-flex flex-row flex-wrap align-items-start justify-content-start">
                        
                            <!-- Report1 -->
                                <div class="service">
                                    <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                                        <div>
                                            <div class="service_icon">
                                                <div style="font-size:50px; color:#666;"><i class="fa fa-bar-chart"></i></div>
                                            </div>
                                        </div>
                                        <div class="service_title thfont5" style="font-size:30px;">
                                        	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/callshowrpt31'); ?>" target="_blank">รายงานสรุปผลสถานะการขึ้นทะเบียนนายจ้าง</a>
                                        </div>
                                    </div>
                                    <div class="service_text">
                                        <p class="thfont5">รายงานสรุปผลสถานะการขึ้นทะเบียนนายจ้าง แยกตามเขตพื้นที่ สำนักงานประกันสังคมที่รับผิดชอบ ขึ้นทะบียนนายจ้างอัตโนมัติแล้ว สถานะเป็น P , ขึ้นทะเบียนลูกจ้างแล้ว สถานะเป็น B , นำเข้าข้อมูลในระบบซาเปี้ยนแล้ว สถานะเป็น A</p>
                                    </div>
                                </div>
                                
                            <!-- Report2 -->
                           <div class="service">
                                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                                    <div>
                                        <div class="service_icon">
                                            <div style="font-size:50px; color:#666;"><i class="fa fa-pie-chart"></i></div>
                                        </div>
                                    </div>
                                    <div class="service_title" style="font-size:30px;">
                                    	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/callshowrptled31'); ?>" target="_blank">รายงานสรุปสถานประกอบการถูกฟ้องล้มละลาย</a>
                                    </div>
                                </div>
                                <div class="service_text">
                                    <p class="thfont5">รายงานรายชื่อสถานประกอบการที่ถูกฟ้องล้มละลาย แยกตามเขตพื้นที่ สำนักงานประกันสังคมที่รับผิดชอบ โดยแสดงชื่อ และ ที่อยู่ ของสถานประกอบการนิติบุคคล ตามช่วงวันที่ และ สปส. รับผิดชอบ</p>
                                </div>
                            </div>
                            
                            <!-- Report3 -->
                            <!--<div class="service">
                                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                                    <div>
                                        <div class="service_icon">
                                            <div style="font-size:50px; color:#666;"><i class="fa fa-pie-chart"></i></div>
                                        </div>
                                    </div>
                                    <div class="service_title" style="font-size:30px;">รายงาน 3</div>
                                </div>
                                <div class="service_text">
                                    <p class="thfont5">รายละเอียดรายงาน 3 รายละเอียดรายงาน 3 รายละเอียดรายงาน 3 รายละเอียดรายงาน 3 รายละเอียดรายงาน 3 รายละเอียดรายงาน 3 รายละเอียดรายงาน 3รายละเอียดรายงาน 3.</p>
                                </div>
                            </div>-->
                            
                            <!-- Report4 -->
                            <div class="service">
                                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                                    <div>
                                        <div class="service_icon">
                                            <div style="font-size:50px; color:#666;"><i class="fa fa-line-chart"></i></div>
                                        </div>
                                    </div>
                                    <div class="service_title" style="font-size:30px;"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/callshowrptetp'); ?>" target="_blank">รายงานการติดตามสถานประกอบการซึ่งมีสถานะเป็น P (pending)</a></div>
                                </div>
                                <div class="service_text">
                                    <p class="thfont5">รายงานติดตามสถานประกอบการซึ่งมีสถานะเป็น P (pending) ที่พบว่าไม่พบสปก. ไม่เปิดดำเนินกิจการ โดยมีการตอบกลับแบบสอบถามกลับมา 3 สถานะ ได้แก่ ยังไม่เปิดดำเนินกิจการ (NE) , เปิดกิจการแล้ว แต่ไม่มีลูกจ้าง (ZR), ยกเลิกจากกรมพัฒนาธุรกิจการค้า (CL)</p>
                                </div>
                            </div>
                            <!-- //Report4 -->
                            
                            <!-- Report5 -->
                            <div class="service">
                                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                                    <div>
                                        <div class="service_icon">
                                            <div style="font-size:50px; color:#666;"><i class="fa fa-area-chart"></i></div>
                                        </div>
                                    </div>
                                    <div class="service_title" style="font-size:30px;"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/callshowrptetpsum2'); ?>" target="_blank">รายงานสรุปผลการติดตามสถานประกอบการซึ่งมีสถานะ P (Pending)</a></div>
                                </div>
                                <div class="service_text">
                                    <p class="thfont5">เป็นรายงานสรุปผลการติดตามสถานประกอบการซึ่งมีสถานะเป็น P(pending) ทั่วประเทศเรียงตามลำดับ สปส. รับผิดชอบ</p>
                                </div>
                            </div>
                            <!-- //Report5 -->

                            <!-- Report6 -->
                            <div class="service">
                                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                                    <div>
                                        <div class="service_icon">
                                            <div style="font-size:50px; color:#666;"><i class="fa fa-envelope"></i></div>
                                        </div>
                                    </div>
                                    <div class="service_title" style="font-size:30px;"><a href="<?php echo Yii::app()->createAbsoluteUrl('report/callshowrptetp2'); ?>" target="_blank">รายงานการติดตามสถานประกอบการซึ่งมีสถานะเป็น P2 (pending)</a></div>
                                </div>
                                <div class="service_text">
                                    <p class="thfont5">รายงานติดตามสถานประกอบการซึ่งมีสถานะเป็น P2 (pending) ที่พบว่าสปก. ไม่ตอบกลับอีเมลฉบับที่ 2 โดยสถานะที่ต้องตอบกลับแบบสอบถามทั้ง 3 สถานะ ได้แก่ ยังไม่เปิดดำเนินกิจการ (NE) , เปิดกิจการแล้ว แต่ไม่มีลูกจ้าง (ZR), ยกเลิกจากกรมพัฒนาธุรกิจการค้า (CL)</p>
                                </div>
                            </div>
                            <!-- //Report6 -->
                            
                           </div>
                           <!-- /////////////////////////////////////////////////////////////////////////// -->
                    </div>
                </div><!--body-->
            </div><!--panel-->
        </div><!--col-md-12-->
        
        
    </div>
</body>
</html>