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
//var_dump($json);exit;
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
        <div class="col-xs-12 col-md-12 col-lg-12">

            <script>
                $(document).ready(function() {

                    getattachpnd(1);

                    var elems = Array.prototype.slice.call(document.querySelectorAll('.page-link'));
                    elems.forEach(function(el) {
                        el.onclick = function() {
                            if ($(el).parent().hasClass('active')) {
                                return;
                            }
                            page = $(el).data("page")
                            getattachpnd(page);
                            $('.page-item').removeClass('active');
                            $(el).parent().addClass('active'); //console.log($(p).id);
                        }
                    });

                });

                function getattachpnd(page) {
                    var data = {
                        'dlnNo': '<?php echo $dlnNo; ?>',
                        'setPage': page
                    }
                    $('#pageresult').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/getattachpnd'); ?>",
                        data: data,
                        success: function(da) {
                            $("#pageresult").html(da);
                        }
                    });

                }
            </script>
            <div class="row pt-3 pl-4 pb-1">
                <div class="pl-4">
                    <button class="btn btn-info" id="btnexportpage" onclick="javascript:exportpndpage();"><i class="fa fa-file-excel-o fa-3x" style="color:green"></i>
                        <font class="thfont5"> Export</font>
                    </button>
                    <div id="imgprocess" style="display:none">
                        <img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...
                    </div>
                </div>
            </div>
            <?php
            if ($setPage > 1) {
            ?>


                <div style="padding-left:15px;">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item active">
                                <span class="page-link" data-page="1">
                                    1
                                    <span class="sr-only">(current)</span>
                                </span>
                            </li>
                            <?php
                            for ($i = 2; $i <= $setPage; $i++) {
                            ?>
                                <li class="page-item"><a class="page-link" data-page="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                            ?>

                        </ul>
                    </nav>
                </div>

            <?php } ?>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-address-book"></i>
                    <font class="thfont5" style="font-size:24px;"> ข้อมูลผู้เสียภาษีอากร</font>
                </div>
                <!--panel heading-->
                <div class="panel-body">
                    <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <!--result data-->
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <tr>
                                <td>เลขประจำตัวผู้เสียภาษีอากร :</td>
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
                                <td><?php
                                    if ($submitNo == "0") {
                                        echo "ยื่นปกติ";
                                    } else {
                                        echo "ยื่นเพิ่มเติมครั้งที่" . " " . $submitNo;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>ปีที่ชำระภาษี :</td>
                                <td><?= $taxYear ?></td>
                            </tr>
                            <tr>
                                <td>เลขคุมเอกสาร :</td>
                                <td><?= $dlnNo ?></td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
            <!--panelbody-->
        </div>
        <!--panel-->

    </div>
    <!--rowresult1-->

    <div class="row" id="pageresult">
    </div>
    <?php /* ?>
    <!--col-md-12-->
    <div class="row" id="rowresult2">

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

                            </table>

                        </div>
                    </div>

                </div>
            </div>

        <?php } ?>

    </div>
    <!--col-md-12-->
<?php */ ?>

    </table>
</body>

</html>