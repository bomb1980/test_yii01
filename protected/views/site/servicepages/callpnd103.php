<?php
// Read 14 characters starting from the 21st character
$section = file_get_contents('http://platformext.rd.go.th/TaxData/api/GetAttachPNDInformationSos/%7B%22dlnNo%22:%22%E0%B8%A0%E0%B8%87%E0%B8%94100000720020211003012560061302041404%22,%22UID%22:%220000072025600613301014057%22,%22NIDWhld%22:%223309700158189%22%7D');

$json = json_decode($section, true);
//echo $json['responseStatus'];
//var_dump($json['responseData']);
//echo("****************************************************************************");

$NID =($json['responseData']['NID']);
$branchNo =($json['responseData']['branchNo']);
$formCode =($json['responseData']['formCode']);
$submitNo =($json['responseData']['submitNo']);
$taxYear =($json['responseData']['taxYear']);
$dlnNo =($json['responseData']['dlnNo']);
$taxMonth= ($json['responseData']['taxMonth']);

//echo("****************************************************************************");
$NIDWhld= ($json['responseData']['personalInformation']['NIDWhld']);
$titleCode= ($json['responseData']['personalInformation']['titleCode']);
$fnameWhld= ($json['responseData']['personalInformation']['fnameWhld']);
$snameWhld= ($json['responseData']['personalInformation']['snameWhld']);
//echo("****************************************************************************");
$incType401N= ($json['responseData']['attachDetailInformation']['incType401N']);
$incTypeDesc401N= ($json['responseData']['attachDetailInformation']['incTypeDesc401N']);
$paidDate401N= ($json['responseData']['attachDetailInformation']['paidDate401N']);
$paidAmt401N= ($json['responseData']['attachDetailInformation']['paidAmt401N']);
$taxAmt401N= ($json['responseData']['attachDetailInformation']['taxAmt401N']);



        

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
                                <td>เลขประจำตัวผู้เสียภาษีอากร :</td>
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
                                <td><?php
                                    if($submitNo == "0")
                                    {
                                        echo "ยื่นปกติ";
                                    }else{
                                        echo "ยื่นเพิ่มเติมครั้งที่" ." ".$submitNo;

                                    }
                                    ?></td>
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
                                
                            </table>
                        </div>
                        </div>
                    </div><!--panelbody-->
                </div><!--panel-->
            
        </div><!--rowresult1-->
            </div><!--col-md-12-->
            <div class="row" id="rowresult2">
            <div class="col-xs-12 col-md-12 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลแนบรายละเอียด</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <tr>
                            <td>มาตรารหัสแบบ :</td>
                            <td><?= $incType401N?></td>
                            </tr>
                            <tr>
                            <td>รายละเอียดมาตราตามรหัสแบบ :</td>
                            <td><?= $incTypeDesc401N?></td>
                            </tr>
                            <tr>
                            <td>วันเดือนปีที่จ่าย :</td>
                            <td><?= $paidDate401N?></td>
                            </tr>
                            <tr>
                            <td>จำนวนเงินที่จ่าย :</td>
                            <td><?= $paidAmt401N?></td>
                            </tr>
                           </table>
                       
                        </div>
                        </div>
                    </div><!--panelbody-->
                </div><!--panel-->
                <div class="col-xs-12 col-md-12 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลส่วนบุคคล</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <tr>
                                <td>รหัสคำนำหน้าชื่อ :</td> 
                                <td><?= $titleCode?></td>
                                </tr>
                                <tr>
                                <td>ชื่อผู้เสียภาษีอากร :</td>
                                <td><?= $fnameWhld?></td>
                                
                                </tr>
                                <tr>
                                <td>นามสกุลผู้เสียภาษีอากร :</td>
                                <td><?= $snameWhld?></td>
                                
                                </tr>
                               
                           </table>
                       
                        </div>
                        </div>
                    </div><!--panelbody-->
                </div><!--panel-->
                
            </div><!--col-md-12-->
       
           

    
   
  </table>
</body>
</html>