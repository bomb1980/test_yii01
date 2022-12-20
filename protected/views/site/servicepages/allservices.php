<?php
$this->pageTitle = Yii::app()->name . ' - Services';
$this->breadcrumbs = array(
    'Services',
);

//  exit;
?>
<div class="row" style="padding-bottom:10px;">
    <?php if (isset($this->breadcrumbs)) : ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links' => $this->breadcrumbs,
        )); ?>
        <!-- breadcrumbs -->
    <?php endif ?>
</div>
<div id="a1">
    <div class="" style="padding-bottom:15px;">
        <div class="main_subtitle fontcolor1">ENTREPRENEUR ● DATA CENTER</div>
        <!--<div class="main_title">All Services</div>-->
    </div>
    <div id="as1" style="padding-bottom:15px;">
        <div class="services_container d-flex flex-row flex-wrap align-items-start justify-content-start">
            <!-- Service1 -->
            <div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div>
                        <div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_10.png" alt=""></div>
                    </div>
                    <div class="service_title">Call DBD WebService</div>
                </div>
                <div class="service_text">
                    <p class="thfont5">ดึงช้อมูลสถานประกอบการที่มีการขึ้นทะเบียนใหม่ผ่าน เว็บเซอร์วิส ของกรมพัฒนาธุรกิจการค้า DBD และ Mapping เลข 13 หลัก กับ เลข 10 หลัก สถานะเป็น P .</p>
                </div>
                <!-- <div class="text-right"><button class="btn btn-info btn-small" onClick="javascript:hideallservice('1');"><i class="
fa fa-power-off"></i> Run</button></div> -->
                <div class="text-right"><a target="_blank" class="btn btn-info btn-small" href="<?php echo Yii::app()->createAbsoluteUrl('site/openservice',['id'=>1]) ?>"><i class="
fa fa-power-off"></i> Run</a></div>
            </div>

            <div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div>
                        <div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_14.png" alt=""></div>
                    </div>
                    <div class="service_title">Export textfile & Upload to SFTP</div>
                </div>
                <div class="service_text">
                    <p class="thfont5">ทำการ ส่งออกข้อมูลสถานประกอบการที่ สถานะเป็น B ออกเป็น Textfile ตามรูปแบบที่ SAPIENS กำหนด แล้ว Upload ขึ้น SFTP เพื่อให้ SAPIENS นำเข้าข้อมูลในระบบ และเปลี่ยนสถานะเป็น A .</p>
                </div>
                <!-- <div class="text-right"><button class="btn btn-info btn-small" onClick="javascript:hideallservice('5');"><i class="
fa fa-power-off"></i> Run</button></div> -->

<div class="text-right"><a target="_blank" class="btn btn-info btn-small" href="<?php echo Yii::app()->createAbsoluteUrl('site/openservice',['id'=>5]) ?>"><i class="
fa fa-power-off"></i> Run</a></div>
            </div>

            <!-- Service6 -->
            <div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div>
                        <div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_15.png" alt=""></div>
                    </div>
                    <div class="service_title">Call LED Webservice</div>
                </div>
                <div class="service_text">
                    <p class="thfont5">ตรวจสอบช้อมูลสถานประกอบการที่มีถูกฟ้องล้มละลาย ผ่าน service ของกรมบังคับคดี ตามรายการสถานประกอบการกลุ่มเลี่่ยงของ สปส .</p>
                </div>
                <!-- <div class="text-right"><button class="btn btn-info btn-small" onClick="javascript:hideallservice('6');"><i class="
fa fa-power-off"></i> Run</button></div> -->

<div class="text-right"><a target="_blank" class="btn btn-info btn-small" href="<?php echo Yii::app()->createAbsoluteUrl('site/openservice',['id'=>6]) ?>"><i class="
fa fa-power-off"></i> Run</a></div>
            </div>
            <!-- //Service6 -->

            <!-- Service7 -->
            <div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div>
                        <div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_15.png" alt=""></div>
                    </div>
                    <div class="service_title">Data Cleansing</div>
                </div>
                <div class="service_text">
                    <p class="thfont5">ตรวจสอบข้อมูลสถานประกอบการที่มีเลขบัญชีนายจ้างในระบบ sapains แล้วหรือไม่ ถ้ามีหากมีในระบบ sapains แล้ว ระบบ wpd จะทำการ update เลขบัญชีนายจ้าง 10 หลัก ให้ตรงกับระบบ sapains และ เปลี่ยนสถานะสถานประกอบการเป็น A.</p>
                </div>
                <!-- <div class="text-right"><button class="btn btn-info btn-small" onClick="javascript:hideallservice('7');"><i class="
fa fa-power-off"></i> Run</button></div> -->


<div class="text-right"><a target="_blank" class="btn btn-info btn-small" href="<?php echo Yii::app()->createAbsoluteUrl('site/openservice',['id'=>7]) ?>"><i class="
fa fa-power-off"></i> Run</a></div>
            </div>
            <!-- //Service7 -->

            <!-- Service8 -->
            <div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div>
                        <div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_11.png" alt=""></div>
                    </div>
                    <div class="service_title">Gen Textfile Old WPD</div>
                </div>
                <div class="service_text">
                    <p class="thfont5">สร้าง textfile ตามรูปแบบที่ระบบ sapiens ต้องการ และ upload ขึ้น SFTP เพื่อให้ระบบ sapiens นำไปประมวลผลต่อไป</p>
                </div>
                <!-- <div class="text-right"><button class="btn btn-info btn-small" onClick="javascript:hideallservice('8');"><i class="
fa fa-power-off"></i> Run</button></div> -->


<div class="text-right"><a target="_blank" class="btn btn-info btn-small" href="<?php echo Yii::app()->createAbsoluteUrl('site/openservice',['id'=>8]) ?>"><i class="
fa fa-power-off"></i> Run</a></div>
            </div>
            <!-- //Service8 -->


            <!-- //Service9 -->
            <div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div>
                        <div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_11.png" alt=""></div>
                    </div>
                    <div class="service_title">RD service(ภงด. กรมสรรพากร)</div>
                </div>
                <div class="service_text">
                    <p class="thfont5">สร้าง textfile ตามรูปแบบที่ระบบ sapiens ต้องการ และ upload ขึ้น SFTP เพื่อให้ระบบ sapiens นำไปประมวลผลต่อไป</p>
                </div>
                <!-- <div class="text-right"><button class="btn btn-info btn-small" onClick="javascript:hideallservice('9');"><i class="
fa fa-power-off"></i> Run</button></div> -->

<div class="text-right"><a target="_blank" class="btn btn-info btn-small" href="<?php echo Yii::app()->createAbsoluteUrl('site/openservice',['id'=>9]) ?>"><i class="
fa fa-power-off"></i> Run</a></div>
            </div>
            <!-- //Service9 -->

        </div>
    </div>
    <div id="as2" style="display:none; padding-bottom:20px;">
        <button class="btn btn-info btn-small" onClick="javascript:showallservice();"><i class="fa fa-mail-reply"></i> back to All Services</button>
        <div id="as3" style="padding-top:20px;"></div>
    </div>

</div>


<script>
    $(document).ready(function() {
        //$('#a1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
        //$("#a1").load("<?php echo Yii::app()->createAbsoluteUrl('site/openhome'); ?>");
        $("#m2").addClass("active");
        $("#geninfo1").hide("fast");
    });

    function hideallservice(snum) {
        //$("#as1").hide("slow");
        //$("#as2").show("slow");
        var data1 = 'snum=' + snum;
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl('site/openservice'); ?>",
            data: data1,
            success: function(da) {
                if (da == 'Y') {
                    // alert("aaaaaaaaaaa");
                    $("#as1").html(da);
                    //BootstrapDialog.alert('เปิดหน้า Service สำเร็จ : ' + da);	
                } else {
                    // alert("bbbbbbbbbbbb");
                    $("#as1").html(da);
                    //BootstrapDialog.alert('ไม่สามารถเปิดหน้า Service ได้ : ' + da);
                }
            }
        });
        window.scrollTo(500, 0);
    }

    function showallservice() {

        $("#as1").load("<?php echo Yii::app()->createAbsoluteUrl('site/servicesb'); ?>");

    }
</script>