
<?php
// Read 14 characters starting from the 21st character
//$action = $_POST['action'];
$schtxt = $_POST['schtxt'];
$seltxt = $_POST['seltxt'];



//exit;
// Read 14 characters starting from the 21st character
//$section = file_get_contents('http://platformext.rd.go.th/SSOWS/GetInfoPND50?nid='.$seltxt.'&year='.$schtxt.'');
//$section = str_replace("null","-",$section);
//$json = json_decode($section, true);

$section = file_get_contents('http://platformext.rd.go.th/TaxData/api/GetListPNDInformationSos/%7B%22NIDSearch%22:%22'.$seltxt.'%22,%22branchNo%22:%22000000%22,%22formCode%22:%22PND1%22,%22taxYear%22:%22'.$schtxt.'%22,%22taxMonthBegin%22:%225%22,%22taxMonthEnd%22:%225%22,%22NIDStatus%22:%220%22%7D');

$json = json_decode($section, true);
//echo $json['responseStatus'];
//var_dump($json['responseData']);
//echo("****************************************************************************");
$rpstatus =($json['responseStatus']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา
$rpdata =($json['responseData']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา

if($rpstatus == 'OK'){
    //echo "ok";
    
}else if($rpdata == 'null'){
    $rptxterr =($json['responseError']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา
    echo $rptxterr;
    
    exit;
}else{
    echo 'เกิดความผิดพลาด กรุณาลองใหม่อีกครั้ง';
    exit;
}


$NIDSearch =($json['responseData']['NIDSearch']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา
//echo("****************************************************************************");
$NID =($json['responseData']['detailInformation']['0']['NID']);
$branchNo =($json['responseData']['detailInformation']['0']['branchNo']);
$formCode =($json['responseData']['detailInformation']['0']['formCode']);
$submitNo =($json['responseData']['detailInformation']['0']['submitNo']);
$taxYear =($json['responseData']['detailInformation']['0']['taxYear']);
$dlnNo =($json['responseData']['detailInformation']['0']['dlnNo']);
$taxMonth= ($json['responseData']['detailInformation']['0']['taxMonth']);
$NIDStatus =($json['responseData']['detailInformation']['0']['NIDStatus']);



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
                    <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลตอบกลับ</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                            <!--result data-->
                            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <tr>
                                <td class="col-xs-12 col-md-12 col-lg-3">เลขประจำตัวผู้เสียภาษีอากร :</td>
                                <td><?= $NID?></td>
                                </tr>
                                <tr>
                                <td>รหัสสาขา :</td>
                                <td><?= $branchNo?></td>
                                </tr>
                                <tr>
                                <td>รหัสแบบ :</td>
                                <td><?= $formCode?></td>
                                </tr>
                                <tr>
                                <td>ยื่นปกติ/ยื่นเพิ่มเติม :</td>
                                <td><?= $submitNo?></td>
                                </tr>
                                <tr>
                                <td>ปีที่ชำระภาษี :</td>
                                <td><?= $taxYear?></td>
                                </tr>
                                <tr>
                                <td>เลขคุมเอกสาร :</td>  
                                <td><?= $dlnNo?></td>
                                </tr>
                                <tr>
                                <td>เดือนที่ชำระภาษี :</td> 
                                <td><?= $taxMonth?></td>
                                </tr>
                                <tr>
                                <td>สถานะของเลขประจำตัวผู้เสียภาษีอากร :</td> 
                                <td>
                                <?php 
                                if($NIDStatus == "0"){
                                    echo "สถานะเป็นผู้หักภาษี ณ ที่จ่าย";
                                }else if($NIDStatus == "1"){
                                    echo "สถานะเป็นผู้ถูกหักภาษี ณ ที่จ่าย";
                                }else{
                                    echo "ERROR! ! !";
                                }
                                
                                ?></td>
                                </tr>
                            </table>
                        </div>
                        </div>
                    </div><!--panelbody-->
                </div><!--panel-->
            
    
  </table>
</body>
</html>