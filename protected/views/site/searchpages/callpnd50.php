<?php
/*
// Read 14 characters starting from the 21st character
$aContext = array(
    "http" => array(
        //'proxy'           => 'tcp://172.16.11.95:8080',
        //'request_fulluri' => true,
        "method" => "GET",
        "header" =>
        "username: rdsso\r\npassword: -hZtdG.68+c3L+g$",
        "Connection: close\r\n",
        "ignore_errors" => true,
        "timeout" => (float)30.0,
    ),
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);
$cxContext = stream_context_create($aContext);

//$sFile = file_get_contents('http://platformext.rd.go.th/SSOWS/GetInfoPND50?nid=' . $seltxt . '&year=' . $schtxt . '', False, $cxContext);


////////////////////////////////////////////////////////////////////////////////
//main local service 
//$section = file_get_contents('http://platformext.rd.go.th/SSOWS/GetInfoPND50?nid='.$seltxt.'&year='.$schtxt.'');
$section = file_get_contents('https://platformext.rd.go.th/SSOService/cit/GetInfoPND50?nid=' . $seltxt . '&year=' . $schtxt . '', False, $cxContext);
$section = str_replace("null", "-", $section);
$json = json_decode($section, true);

*/
//echo $json['responseStatus'];
//var_dump($json['responseData']);
//echo("****************************************************************************");

//$NIDSearch =($json['SSO']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา
//echo("****************************************************************************");
if (is_null($json)) {
    echo "ไม่พบข้อมูลกรุณาค้นหาใหม่อีกครั้ง !! ";
    exit();
}

if (!array_key_exists('SSO', $json)) {
    echo "กรุณาค้นหาใหม่อีกครั้ง !! ";
    exit();
}

$TXP_NID = ($json['SSO']['0']['TXP_NID']);
$TAX_YEAR = ($json['SSO']['0']['TAX_YEAR']);
$TXP_TTL_TEXT = ($json['SSO']['0']['TXP_TTL_TEXT']);
$TXP_C_NAME = ($json['SSO']['0']['TXP_C_NAME']);
$ADDR_BLD_TEXT = ($json['SSO']['0']['ADDR_BLD_TEXT']);
$ADDR_ROOM_TEXT = ($json['SSO']['0']['ADDR_ROOM_TEXT']);
$ADDR_FLOOR_TEXT = ($json['SSO']['0']['ADDR_FLOOR_TEXT']);
$ADDR_VIL_TEXT = ($json['SSO']['0']['ADDR_VIL_TEXT']);
$ADDR_HOUSE_TEXT = ($json['SSO']['0']['ADDR_HOUSE_TEXT']);
$ADDR_MOO_TEXT = ($json['SSO']['0']['ADDR_MOO_TEXT']);
$ADDR_SOI_TEXT = ($json['SSO']['0']['ADDR_SOI_TEXT']);
$ADDR_STREET_TEXT = ($json['SSO']['0']['ADDR_STREET_TEXT']);
$ADDR_SUB_DIST_ID = ($json['SSO']['0']['ADDR_SUB_DIST_ID']);
$ADDR_DIST_ID = ($json['SSO']['0']['ADDR_DIST_ID']);
$ADDR_PROV_ID = ($json['SSO']['0']['ADDR_PROV_ID']);
$ADDR_POST_CODE_TEXT = ($json['SSO']['0']['ADDR_POST_CODE_TEXT']);
$PER_FROM_DATE = ($json['SSO']['0']['PER_FROM_DATE']);
$PER_TO_DATE = ($json['SSO']['0']['PER_TO_DATE']);
$SUB_IND = ($json['SSO']['0']['SUB_IND']);
$SUB_CNT = ($json['SSO']['0']['SUB_CNT']);
$MFGC_SAL_TOT_AMT = ($json['SSO']['0']['MFGC_SAL_TOT_AMT']);
$SELE_PSN_EXP_TOT_AMT = ($json['SSO']['0']['SELE_PSN_EXP_TOT_AMT']);

if (is_null($TXP_NID)) {
    echo $TXP_NID;
    echo "มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้งค่ะ";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="row" id="rowresult1">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-1">
            <button class="btn btn-info" id="btnexport" onclick="javascript:exportpnd();"><i class="fa fa-file-excel-o fa-3x" style="color:green"></i>
                <font class="thfont5"> Export</font>
            </button>
            <div id="imgprocess" style="display:none">
                <img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...
            </div>

        </div>

        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-info">

                <div class="panel-heading">
                    <i class="fa fa-address-book"></i>
                    <font class="thfont5" style="font-size:24px;"> ข้อมูลตอบกลับ</font>
                </div>
                <!--panel heading-->
                <div class="panel-body">
                    <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <!--result data-->
                        <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                            <tr>
                                <td class="col-xs-12 col-md-12 col-lg-4">เลขประจำตัวผู้เสียภาษีอากร :</td>
                                <td><?= $TXP_NID ?></td>
                            </tr>
                            <tr>
                                <td>ปีภาษี :</td>
                                <td><?= $TAX_YEAR ?></td>
                            </tr>
                            <tr>
                                <td>คำนำหน้าชื่อ :</td>
                                <td><?= $TXP_TTL_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อ :</td>
                                <td><?= $TXP_C_NAME ?></td>
                            </tr>
                            <tr>
                                <td>ชื่ออาคาร :</td>
                                <td><?= $ADDR_BLD_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>ห้องที่ :</td>
                                <td><?= $ADDR_ROOM_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>ชั้นที่ :</td>
                                <td><?= $ADDR_FLOOR_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อหมู่บ้าน :</td>
                                <td><?= $ADDR_VIL_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>บ้านเลขที่ :</td>
                                <td><?= $ADDR_HOUSE_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>หมู่ที่ :</td>
                                <td><?= $ADDR_MOO_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>ตรอก/ซอย :</td>
                                <td><?= $ADDR_SOI_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>ถนน :</td>
                                <td><?= $ADDR_STREET_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>รหัส ตำบล/แขวง :</td>
                                <td><?= $ADDR_SUB_DIST_ID ?></td>
                            </tr>
                            <tr>
                                <td>รหัส อำเภอ/เขต :</td>
                                <td><?= $ADDR_DIST_ID ?></td>
                            </tr>
                            <tr>
                                <td>รหัสจังหวัด :</td>
                                <td><?= $ADDR_PROV_ID ?></td>
                            </tr>
                            <tr>
                                <td>รหัสไปรษณีย์ :</td>
                                <td><?= $ADDR_POST_CODE_TEXT ?></td>
                            </tr>
                            <tr>
                                <td>วันเริ่มต้นรอบระยะเวลาบัญชี :</td>
                                <td>
                                    <?php
                                    $year = substr($PER_FROM_DATE, 0, 4);
                                    $month = substr($PER_FROM_DATE, 4, 2);
                                    $day = substr($PER_FROM_DATE, 6);
                                    echo $day . "/" . $month . "/" . $year;

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>วันสิ้นสุดต้นรอบระยะเวลาบัญชี :</td>
                                <td>
                                    <?php
                                    $year1 = substr($PER_TO_DATE, 0, 4);
                                    $month1 = substr($PER_TO_DATE, 4, 2);
                                    $day1 = substr($PER_TO_DATE, 6);
                                    echo $day1 . "/" . $month1 . "/" . $year1;
                                    //echo $month1;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>สถานะการยื่นแบบ :</td>
                                <td><?php
                                    if ($SUB_IND == "1") {
                                        echo "ยื่นปกติ";
                                    } else if ($SUB_IND == "2") {
                                        echo "ยื่นเพิ่มเติม";
                                    } else if ($SUB_IND == "3") {
                                        echo "ชำระล่วงหน้า";
                                    } else {
                                        echo "ERROR! ! !";
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>ยื่นเพิ่มเติมครั้งที่ :</td>
                                <td><?= $SUB_CNT ?></td>
                            </tr>
                            <tr>
                                <td>เงินเดือนและค่าจ้างแรงงาน ทั้งจากกิจการที่ได้รับการยกเว้นภาษีเงินได้และกิจการที่ต้องเสียภาษีเงินได้ :</td>
                                <td><?= $MFGC_SAL_TOT_AMT ?></td>
                            </tr>
                            <tr>
                                <td>รายจ่ายเกี่ยวกับพนักงาน ทั้งจากกิจการที่ได้รับยกเว้นภาษีเงินได้ และ กิจการที่ต้องเสียภาษีเงินได้ :</td>
                                <td><?= $SELE_PSN_EXP_TOT_AMT ?></td>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
            <!--panelbody-->
        </div>
        <!--panel-->


        </table>
        <script>
            function exportpnd() {
                //window.location.href = "<?php echo Yii::app()->createAbsoluteUrl('pnd/exportpnd50'); ?>";
                //window.open("<?php echo Yii::app()->createAbsoluteUrl('pnd/exportpnd50?nid=' . $nid . '&year=' . $year); ?>", '_blank');

                $("#btnexport").prop("disabled", true);

                var result = confirm("ต้องการดาวน์โหลดรายละเอียด ภงด.50 <?php echo $nid; ?> ?");
                if (!result) {
                    $("#btnexport").prop("disabled", false);
                    return;
                }

                $.ajax({
                        url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/exportpnd50'); ?>",
                        method: "POST",
                        dataType: 'json',
                        data: {
                            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
                            'nid': '<?php echo $nid ?>',
                            "year": '<?php echo $year; ?>',
                        },
                        beforeSend: function() {
                            $('#imgprocess').show();
                        },
                    })
                    .done(function(data) {

                        if (data.status == 'success') {
                            var d = new Date();
                            year = d.getFullYear();
                            month = ("0" + (d.getMonth() + 1)).slice(-2);
                            day = ("0" + d.getDate()).slice(-2)

                            var hour = ('0' + d.getHours()).slice(-2);
                            var mins = ('0' + d.getMinutes()).slice(-2);
                            var sec = ('0' + d.getSeconds()).slice(-2);

                            var fileName = 'downloadPND50_<?php echo $nid; ?>_' + year + month + day + "_" + hour + mins + sec;

                            var $a = $("<a>");
                            $a.attr("href", data.file);
                            $("body").append($a);
                            $a.attr("download", fileName + ".xlsx");
                            $a[0].click();
                            $a.remove();
                            $("#btnexport").prop("disabled", false);
                        } else {
                            alert(data.msg);
                            $("#btnexport").prop("disabled", false);
                        }
                        /*
                        		if (data.status == 'success') {
                        		  $("#btnadd").prop("disabled", false);
                        		  alert('เพิ่มข้อความสำหรับส่งให้สมาชิกเรียบร้อย');
                        		  window.location.href = '' + data.msg + '';
                        		} else {
                        		  alert(data.msg);
                        		  $("#btnadd").prop("disabled", false);
                        		}
                        */
                    })
                    .fail(function(jqXHR, status, error) {
                        // Triggered if response status code is NOT 200 (OK)
                        //alert(jqXHR.responseText);

                    })
                    .always(function() {
                        $('#imgprocess').hide();
                        $("#btnexport").prop("disabled", false);
                    });


            }
        </script>
</body>

</html>