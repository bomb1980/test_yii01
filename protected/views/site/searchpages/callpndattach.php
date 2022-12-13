<?php
/*
$dlnNo2 = [
    "dlnNo" => urlencode($dlnNo),
    "setPage" => $setPage
];
$json = json_encode($dlnNo2);

$json = str_replace('{', '%7B', $json);
$json = str_replace('}', '%7D', $json);
$json = str_replace('"', '%22', $json);

$url = 'https://platformext.rd.go.th/SSOService/wht/GetAttachPNDInfoDetA/' . $json;

//https://platformext.rd.go.th/SSOService/wht/GetAttachPNDInfoDetA/{"dlnNo":"ภงด100006000118300203012562021102195411","setPage":"1"}

$curl = curl_init();

curl_setopt_array($curl, array(
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

$result = json_decode($response, TRUE);

if (json_last_error() === JSON_ERROR_NONE) {
    //echo $response;
} else {
    echo "กรุณาค้นหาใหม่อีกครั้ง !! ";
    exit();
}
$json = $result;
*/

$detailInformation = ($json['responseData']['detailInformation']);

$headerInformation = ($json['responseData']['headerInformation']);


//echo("****************************************************************************");

$NID = $headerInformation['NID'];
$branchNo = $headerInformation['branchNo'];
$formCode = $headerInformation['formCode'];
$submitNo = $headerInformation['submitNo'];
$taxYear = $headerInformation['taxYear'];
$dlnNo = $headerInformation['dlnNo'];
//$taxMonth= ($json['responseData']['taxMonth']);

if ($formCode == "ภงด1ก") {
    $pnd = "pnd01a";
} elseif ($formCode == "ภงด1") {
    $pnd = "pnd01";
}

?>



<div class="col-xs-12 col-md-12 col-lg-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-address-book"></i>
            <font class="thfont5" style="font-size:24px;"> ข้อมูลผู้เสียภาษีอากร</font>
        </div>

    </div>

</div>
<?php
foreach ($detailInformation as $rows) {
    $personalInformation = $rows['personalInformation'];
    $attachDetailInformation = $rows['attachDetailInformation'];


?>
    <div class="col-xs-12 col-md-12 col-lg-6">
        <div class="panel panel-info">

            <div class="panel-heading">
                <i class="fa fa-address-book"></i>
                <font class="thfont5" style="font-size:24px;"> ข้อมูลผู้มีเงินได้ลำดับที่ <?php echo $personalInformation['seqNo']; ?></font>
            </div>
            <div class="panel-body">
                <div id="resega2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                    <table class="table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="margin-bottom: 1px;">
                        <tr>
                            <td>รหัสคำนำหน้าชื่อ :</td>
                            <td><?php echo $personalInformation['titleCode'] ?></td>
                        </tr>
                        <tr>
                            <td>ชื่อผู้เสียภาษีอากร :</td>
                            <td><?php echo $personalInformation['fnameWhld'] ?></td>

                        </tr>
                        <tr>
                            <td>นามสกุลผู้เสียภาษีอากร :</td>
                            <td><?php echo $personalInformation['snameWhld'] ?></td>

                        </tr>
                        <tr>
                            <td>รหัสประจำตัวผู้เสียภาษีอากร :</td>
                            <td><?php echo $personalInformation['NIDWhld'] ?></td>

                        </tr>
                        <tr>
                            <td>หน้าที่ :</td>
                            <td><?php echo $personalInformation['page'] ?></td>

                        </tr>

                    </table>

                </div>
            </div>
            <div class="panel-heading">
                <i class="fa fa-address-book"></i>
                <font class="thfont5" style="font-size:24px;"> ข้อมูลรายการใบแนบของผู้มีเงินได้</font>
            </div>
            <div class="panel-body">
                <div id="resega2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                    <table class="table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <?php foreach ($attachDetailInformation as $key => $vals) { ?>
                            <tr>
                                <td><?php

                                    switch ($key) {
                                        case (strpos($key, 'incType') !== false);
                                            $pieces = explode("Desc", $key);
                                            if (count($pieces) == 2) {
                                                echo "รายละเอียดมาตราตามรหัสแบบ";
                                                break;
                                            } else {
                                                echo "มาตราตามรหัสแนบ";
                                                break;
                                            }
                                        case (strpos($key, 'paidDate') !== false);
                                            echo "วันเดือนปีที่จ่าย";
                                            break;
                                        case (strpos($key, 'paidAmt') !== false);
                                            echo "จำนวนเงินได้ที่จ่าย";
                                            break;
                                        case (strpos($key, 'taxAmt') !== false);
                                            echo "จำนวนเงิน ภาษีที่หักและนำส่ง";
                                            break;
                                        default:
                                            echo $key;
                                    }
                                    ?>
                                </td>
                                <td><?= $vals ?></td>
                            </tr>

                        <?php } ?>

                        <?php /* ?>
                                <tr>
                                    <td>มาตรารหัสแบบ :</td>
                                    <td><?php echo $attachDetailInformation['incType402I']; ?></td>
                                </tr>
                                <tr>
                                    <td>รายละเอียดมาตราตามรหัสแบบ :</td>
                                    <td><?php echo $attachDetailInformation['incTypeDesc402I']; ?></td>
                                </tr>
                                <tr>
                                    <td>วันเดือนปีที่จ่าย :</td>
                                    <td><?php echo $attachDetailInformation['paidDate402I']; ?></td>
                                </tr>
                                <tr>
                                    <td>จำนวนเงินได้ที่จ่าย :</td>
                                    <td><?php echo $attachDetailInformation['paidAmt402I']; ?></td>
                                </tr>
                                <tr>
                                    <td>จำนวนภาษีที่จ่าย :</td>
                                    <td><?php echo $attachDetailInformation['taxAmt402I']; ?></td>
                                </tr>
<?php */ ?>
                    </table>


                </div>
            </div>

        </div>
    </div>


<?php } ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="pl-4">
        <button class="btn btn-info" id="btnexportpage" onclick="javascript:exportpndpage();"><i class="fa fa-file-excel-o fa-3x" style="color:green"></i>
            <font class="thfont5"> Export</font>
        </button>
        <div id="imgprocess" style="display:none">
            <img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...
        </div>
    </div>
</div>
<script>
    function exportpndpage() {

        $("#btnexportpage").prop("disabled", true);

        var result = confirm("ต้องการดาวน์โหลดรายละเอียด <?php echo $dlnNo; ?> ?");
        if (!result) {
            $("#btnexportpage").prop("disabled", false);
            return;
        }

        $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/exportpnd01page'); ?>",
                method: "POST",
                dataType: 'json',
				contentType: "application/x-www-form-urlencoded;charset=utf-8",
                data: {
                    'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
                    'dlnNo': '<?php echo $dlnNo ?>',
                    "setPage": <?php echo $setPage; ?>,
                    "pnd": '<?php echo $pnd;?>',
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

                    var fileName = 'downloadPND01_<?php echo $dlnNo; ?>_Page<?php echo $setPage;?>_' + year + month + day + "_" + hour + mins + sec;

                    var $a = $("<a>");
                    $a.attr("href", data.file);
                    $("body").append($a);
                    $a.attr("download", fileName + ".xlsx");
                    $a[0].click();
                    $a.remove();
                    $("#btnexportpage").prop("disabled", false);
                } else {
                    alert(data.msg);
                    $("#btnexportpage").prop("disabled", false);
                }

            })
            .fail(function(jqXHR, status, error) {
                // Triggered if response status code is NOT 200 (OK)
                //alert(jqXHR.responseText);

            })
            .always(function() {
                $('#imgprocess').hide();
                $("#btnexportpage").prop("disabled", false);
            });
    }
</script>
<!--col-md-12-->