<?php

/*
$schtxt = $_POST['schtxt'];
$seltxt = $_POST['seltxt'];


$param = [
    'NIDSearch' => $seltxt,
    'branchNo' => '000000',
    'formCode' => 'PND1A',
    'taxYear' => $schtxt,
    'taxMonthBegin' => '0',
    'taxMonthEnd' => '12',
    'NIDStatus' => '0'
];
$json = json_encode($param);

$json = str_replace('{', '%7B', $json);
$json = str_replace('}', '%7D', $json);
$json = str_replace('"', '%22', $json);

$url = 'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/' . $json;

//'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/%7B%22NIDSearch%22:%220835557013779%22,%22branchNo%22:%22000000%22,%22formCode%22:%22PND1%22,%22taxYear%22:%222562%22,%22taxMonthBegin%22:%220%22,%22taxMonthEnd%22:%220%22,%22NIDStatus%22:%220%22%7D'
//'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/%7B%22NIDSearch%22:%220835557013779%22,%22branchNo%22:%22000000%22,%22formCode%22:%22PND1%22,%22taxYear%22:%222562%22,%22taxMonthBegin%22:%221%22,%22taxMonthEnd%22:%221%22,%22NIDStatus%22:%220%22%7D'

$curl = curl_init();
curl_setopt_array($curl, array(
    //CURLOPT_URL => 'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/%7B%22NIDSearch%22:%220835557013779%22,%22branchNo%22:%22000000%22,%22formCode%22:%22PND1%22,%22taxYear%22:%222562%22,%22taxMonthBegin%22:%221%22,%22taxMonthEnd%22:%221%22,%22NIDStatus%22:%220%22%7D',
    CURLOPT_URL => $url,
    //proxy suport
    //CURLOPT_PROXY => '172.16.11.95',
    //CURLOPT_PROXYPORT => '8080',
    //CURLOPT_PROXYTYPE => 'HTTP',
    //CURLOPT_HTTPPROXYTUNNEL => 1, //end proxy
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'username: rdsso',
        'password: -hZtdG.68+c3L+g$'
    ),
));

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'Curl error: ' . curl_error($curl);
    exit;
}
curl_close($curl);

$json = json_decode($response, true);

if (json_last_error() === JSON_ERROR_NONE) {
    //echo $response;
} else {
    echo "กรุณาค้นหาใหม่อีกครั้ง !! ";
    exit();
}
*/

$rpstatus = ($json['responseStatus']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา
$rpdata = ($json['responseData']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา

if ($rpstatus == 'OK') {
    //echo "ok";

} else if ($rpdata == 'null') {
    $rptxterr = ($json['responseError']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา
    echo $rptxterr;

    exit;
} else {
    echo 'เกิดความผิดพลาด กรุณาลองใหม่อีกครั้ง';
    exit;
}


$sortpndmonth = $json['responseData']['detailInformation'];
$marks = array();
$marks2 = array();

foreach ($sortpndmonth as $key => $row) {

    $marks[$key] = $row['taxMonth'];
    $marks2[$key] = $row['dlnNo'];
}

array_multisort($marks, $marks2, SORT_ASC, $sortpndmonth);

count($sortpndmonth);



//echo("****************************************************************************");



$NIDSearch = ($json['responseData']['NIDSearch']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา
//echo("****************************************************************************");



?>

<!DOCTYPE html>
<html lang="en">
<style>
    .selectnums {
        cursor: pointer;
    }

    .selectnums:hover {
        color: red !important;
        background-color: transparent;
        text-decoration: underline !important;
    }

    .selectnums:active {
        color: purple !important;
        background-color: transparent;
        text-decoration: underline !important;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-fullscreen-lg-down">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">ภาษีเงินได้บุคคลธรรมดา</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">GetHeader</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">GetAttach</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"></div>
                    <div class="tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">กำลังอยู่ระหว่างการปรับปรุงระบบ. . . . .</div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="row" id="rowresult1">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-address-book"></i>
                    <font class="thfont5" style="font-size:24px;"> ข้อมูลตอบกลับ</font>
                </div>
                <!--panel heading-->
                <div class="panel-body">
                    <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <?php foreach ($sortpndmonth as $key => $row) {
                            $NID = $row['NID'];
                            $branchNo = $row['branchNo'];
                            $formCode = $row['formCode'];
                            $submitNo = $row['submitNo'];
                            $taxYear = $row['taxYear'];
                            $dlnNo = $row['dlnNo'];
                            $taxMonth = $row['taxMonth'];
                            $NIDStatus = $row['NIDStatus'];
                            $totSetOfAttach = $row['totSetOfAttach'];
                        ?>

                            <!--result data-->
                            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <tr>
                                    <td class="col-xs-12 col-md-12 col-lg-3">เลขประจำตัวผู้เสียภาษีอากร :</td>
                                    <td><?= $NID ?></td>
                                </tr>
                                <tr>
                                    <td>รหัสสาขา :</td>
                                    <td><?= $branchNo ?></td>
                                </tr>
                                <tr>
                                    <td>รหัสแบบ :</td>
                                    <td><?= $formCode ?></td>
                                </tr>
                                <tr>
                                    <td>ยื่นปกติ/ยื่นเพิ่มเติม :</td>
                                    <td><?= $submitNo ?></td>
                                </tr>
                                <tr>
                                    <td>ปีที่ชำระภาษี :</td>
                                    <td><?= $taxYear ?></td>
                                </tr>
                                <tr>
                                    <td>เลขคุมเอกสาร :</td>
                                    <td><a style="color:blue" class="selectnums" data-id="<?= $dlnNo ?>" data-setpage="<?= $totSetOfAttach ?>" id="myBtn"><?= $dlnNo ?></a></td>

                                </tr>

                                <tr>
                                    <td>เดือนที่ชำระภาษี :</td>
                                    <td><?= $taxMonth ?></td>
                                </tr>
                                <tr>
                                    <td>สถานะของเลขประจำตัวผู้เสียภาษีอากร :</td>
                                    <td>
                                        <?php
                                        if ($NIDStatus == "0") {
                                            echo "สถานะเป็นผู้หักภาษี ณ ที่จ่าย";
                                        } else if ($NIDStatus == "1") {
                                            echo "สถานะเป็นผู้ถูกหักภาษี ณ ที่จ่าย";
                                        } else {
                                            echo "ERROR! ! !";
                                        }

                                        ?></td>
                                </tr>
                                <tr>
                                    <td>จำนวนช่วงของแผ่น</td>
                                    <td><?= $totSetOfAttach ?></td>
                                </tr>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!--panelbody-->
        </div>
        <!--panel-->
        <?php /*
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button class="btn btn-info" id="btnexport" onclick="javascript:exportpnd();"><i class="fa fa-file-excel-o fa-3x" style="color:green"></i>
                <font class="thfont5"> Export</font>
            </button>
            <div id="imgprocess" style="display:none">
                <img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...
            </div>

        </div>
        */
        ?>

        </table>
</body>

</html>
<script>
    function exportpnd() {

        $("#btnexport").prop("disabled", true);

        var result = confirm("ต้องการดาวน์โหลดรายละเอียด ภงด.01ก <?php echo $nid; ?> ?");
        if (!result) {
            $("#btnexport").prop("disabled", false);
            return;
        }

        $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/exportpnd01'); ?>",
                method: "POST",
                dataType: 'json',
                data: {
                    'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
                    'nid': '<?php echo $nid ?>',
                    "year": '<?php echo $year; ?>',
                    "pnd": 'pnd01a',
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

                    var fileName = 'downloadPND01A_<?php echo $nid; ?>_' + year + month + day + "_" + hour + mins + sec;

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

    $(document).ready(function() {
        $("#myModal").on("hide.bs.modal", function(e) {
            $("#nav-home-tab").trigger("click");
        });

        var elems = Array.prototype.slice.call(document.querySelectorAll('.selectnums'));
        elems.forEach(function(el) {
            el.onclick = function() {
                sw = $(el).data("id")
                setpage = $(el).data("setpage")
                ajaxcallpnd102(sw);
                ajaxcallpnd103(sw, setpage);
                $("#myModal").modal(el);


                //alert($sw);

            }
        });

        $("#myBtn").click(function() {

        });
    });


    /************************************************************************************************************************** */



    function ajaxcallpnd102(dlnNo) {
        var data1 = 'dlnNo=' + dlnNo;
        $('#nav-home').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/callpnd102'); ?>",
            data: data1,
            success: function(da) {
                $("#nav-home").html(da);


            }
        });

    }

    function ajaxcallpnd103(dlnNo, setPage) {
        var data1 = 'dlnNo=' + dlnNo;
        var data = {
            'dlnNo': dlnNo,
            'setPage': setPage
        }
        $('#nav-profile').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/callpnd103'); ?>",
            data: data,
            success: function(da) {
                $("#nav-profile").html(da);

            }
        });

    }
</script>