<?php
/*
$dlnNo2 = [
    "dlnNo" => urlencode($dlnNo)
];
$json = json_encode($dlnNo2);

$json = str_replace('{', '%7B', $json);
$json = str_replace('}', '%7D', $json);
$json = str_replace('"', '%22', $json); 

$url = 'https://platformext.rd.go.th/SSOService/wht/GetHeaderPNDInfoDetA/' . $json; //echo $url;exit;


//'https://platformext.rd.go.th/SSOService/wht/GetHeaderPNDInfoDetA/%7B%22dlnNo%22:%22%E0%B8%A0%E0%B8%87%E0%B8%94100006000118300203012562031102200209%22%7D'
//'https://platformext.rd.go.th/SSOService/wht/GetHeaderPNDInfoDetA/%7B%22dlnNo%22:%22%E0%B8%A0%E0%B8%87%E0%B8%94100006000118300203012562031102200209%22%7D'

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

//echo $response;
$json = $result;
*/

//var_dump($json);exit;


//var_dump($sortpndmonth);
//echo count($sortpndmonth);
//$sokey =array_keys($sortpndmonth);
//print_r($sokey);

$sortpndmonth = ($json['responseData']['summaryInformation']);

////exit();
//echo $json['responseStatus'];
//var_dump($json['responseData']);
//echo("****************************************************************************");

$NID = ($json['responseData']['NID']);
$branchNo = ($json['responseData']['branchNo']);
$formCode = ($json['responseData']['formCode']);
$submitNo = ($json['responseData']['submitNo']);
$taxYear = ($json['responseData']['taxYear']);
$dlnNo = ($json['responseData']['dlnNo']);
//$taxMonth = ($json['responseData']['taxMonth']);
$taxMonth = "";
if (array_key_exists('taxMonth',$json['responseData'])){
    $taxMonth = ($json['responseData']['taxMonth']);
}

//echo("****************************************************************************");
$titleCode = ($json['responseData']['taxpayerInformation']['titleCode']);
$fnameWhld = ($json['responseData']['taxpayerInformation']['fitstName']);
$snameWhld = ($json['responseData']['taxpayerInformation']['surName']);
//echo("****************************************************************************");
$buildName = ($json['responseData']['currentAddressInformation']['buildName']);
$roomNo = ($json['responseData']['currentAddressInformation']['roomNo']);
$floorNo = ($json['responseData']['currentAddressInformation']['floorNo']);
$villageName = ($json['responseData']['currentAddressInformation']['villageName']);
$addNo = ($json['responseData']['currentAddressInformation']['addNo']);
$mooNo = ($json['responseData']['currentAddressInformation']['mooNo']);
$soi = ($json['responseData']['currentAddressInformation']['soi']);
$streetName = ($json['responseData']['currentAddressInformation']['streetName']);
$moiCode = ($json['responseData']['currentAddressInformation']['moiCode']);
$postalCode = ($json['responseData']['currentAddressInformation']['postalCode']);

//echo("****************************************************************************");
$totNum = ($json['responseData']['masterInformation']['totNum']);
$totAmt = ($json['responseData']['masterInformation']['totAmt']);
$totTax = ($json['responseData']['masterInformation']['totTax']);

//echo("****************************************************************************");
//$incType401N = ($json['responseData']['summaryInformation']['incType401N']);
//$numItem401N = ($json['responseData']['summaryInformation']['numItem401N']);
//$incAmt401N = ($json['responseData']['summaryInformation']['incAmt401N']);
//$taxAmt401N = ($json['responseData']['summaryInformation']['taxAmt401N']);

//echo("****************************************************************************");






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
                                    } else if ($submitNo == "") {
                                        echo "ERROR !!";
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
                            <tr>
                                <td>เดือนที่ชำระภาษี :</td>
                                <td><?= $taxMonth ?></td>
                            </tr>
                            <tr>
                                <td>รหัสคำนำหน้าชื่อ :</td>
                                <td><?= $titleCode ?></td>
                            </tr>
                            <tr>
                                <td>ชื่อผู้เสียภาษีอากร :</td>
                                <td><?= $fnameWhld ?></td>
                            </tr>
                            <tr>
                                <td>นามสกุลผู้เสียภาษีอากร :</td>
                                <td><?= $snameWhld ?></td>
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
    </div>
    <!--col-md-12-->
    <div class="row" id="rowresult2">
        <div class="col-xs-12 col-md-12 col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-address-book"></i>
                    <font class="thfont5" style="font-size:24px;"> ข้อมูลที่อยู่ตามหน้าแบบผู้เสียภาษีอากร</font>
                </div>
                <!--panel heading-->
                <div class="panel-body">
                    <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <tr>
                                <td>อาคาร :</td>
                                <td><?= $buildName ?></td>
                            </tr>
                            <tr>
                                <td>ห้องเลขที่ :</td>
                                <td><?= $roomNo ?></td>
                            </tr>
                            <tr>
                                <td>ชั้นที่ :</td>
                                <td><?= $floorNo ?></td>
                            </tr>
                            <tr>
                                <td>หมู่บ้าน :</td>
                                <td><?= $villageName ?></td>
                            </tr>
                            <tr>
                                <td>เลขที่ :</td>
                                <td><?= $addNo ?></td>
                            </tr>
                            <tr>
                                <td>หมู่ที่ :</td>
                                <td><?= $mooNo ?></td>
                            </tr>
                            <tr>
                                <td>ตรอก/ซอย :</td>
                                <td><?= $soi ?></td>
                            </tr>
                            <tr>
                                <td>ถนน :</td>
                                <td><?= $streetName ?></td>
                            </tr>
                            <tr>
                                <td>รหัสตำบล อำเภอ จังหวัด(MOI) :</td>
                                <td><?= $moiCode ?></td>
                            </tr>
                            <tr>
                                <td>รหัสไปรษณีย์ :</td>
                                <td><?= $postalCode ?></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <!--panelbody-->
        </div>
        <!--panel-->




        <div class="col-xs-12 col-md-12 col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-address-book"></i>
                    <font class="thfont5" style="font-size:24px;"> ข้อมูลสรุปตามหน้าแบบ</font>
                </div>
                <!--panel heading-->
                <div class="panel-body">
                    <div id="resega2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <tr>
                                <td>รวมจำนวนราย :</td>
                                <td><?= $totNum ?></td>
                            </tr>
                            <tr>
                                <td>รวมเงินได้ทั้งสิ้น :</td>
                                <td><?= $totAmt ?></td>

                            </tr>
                            <tr>
                                <td>รวมภาษีนำส่ง :</td>
                                <td><?= $totTax ?></td>

                            </tr>

                        </table>

                    </div>
                </div>

            </div>
            <!--panelbody-->


            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-address-book"></i>
                    <font class="thfont5" style="font-size:24px;"> ข้อมูลสรุปตามหน้าแบบแยกตามมาตรา</font>
                </div>
                <!--panel heading-->
                <div class="panel-body">
                    <div id="resega2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <?php foreach ($sortpndmonth as $key => $vals) { ?>
                                <tr>
                                    <td><?php
                                        switch ($key) {
                                            case (strpos($key, 'incType') !== false);
                                                echo "มาตราตามรหัสแนบ";
                                                break;
                                            case (strpos($key, 'numItem') !== false);
                                                echo "จำนวนราย";
                                                break;
                                            case (strpos($key, 'incAmt') !== false);
                                                echo "จำนวนเงินได้" . "(" . $key . ")";
                                                break;
                                            case (strpos($key, 'taxAmt') !== false);
                                                echo "จำนวนภาษีที่นำส่ง" . "(" . $key . ")";
                                                break;
                                            default:
                                                echo $key;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $vals ?></td>
                                </tr>
                                <tr>
                                <?php  } ?>

                        </table>
                    </div>
                </div>
            </div>
            <!--panelbody-->
        </div>
        <!--panel-->



    </div>
    <!--col-md-12-->



    </table>

</body>

</html>