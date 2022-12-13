<?php
// Read 14 characters starting from the 21st character
$section = file_get_contents('http://platformext.rd.go.th/TaxData/api/GetHeaderPNDInformationSos/%7B%22dlnNo%22:%22%E0%B8%A0%E0%B8%87%E0%B8%94100000720020211003012560061302041404%22,%22UID%22:%220000072025600613301014057%22%7D');

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
$titleCode= ($json['responseData']['taxpayerInformation']['titleCode']);
$fnameWhld= ($json['responseData']['taxpayerInformation']['fitstName']);
$snameWhld= ($json['responseData']['taxpayerInformation']['surName']);
//echo("****************************************************************************");
$buildName= ($json['responseData']['currentAddressInformation']['buildName']);
$roomNo= ($json['responseData']['currentAddressInformation']['roomNo']);
$floorNo= ($json['responseData']['currentAddressInformation']['floorNo']);
$villageName= ($json['responseData']['currentAddressInformation']['villageName']);
$addNo= ($json['responseData']['currentAddressInformation']['addNo']);
$mooNo= ($json['responseData']['currentAddressInformation']['mooNo']);
$soi= ($json['responseData']['currentAddressInformation']['soi']);
$streetName= ($json['responseData']['currentAddressInformation']['streetName']);
$moiCode= ($json['responseData']['currentAddressInformation']['moiCode']);
$postalCode= ($json['responseData']['currentAddressInformation']['postalCode']);

//echo("****************************************************************************");
$totNum= ($json['responseData']['masterInformation']['totNum']);
$totAmt= ($json['responseData']['masterInformation']['totAmt']);
$totTax= ($json['responseData']['masterInformation']['totTax']);

//echo("****************************************************************************");
$incType401N= ($json['responseData']['summaryInformation']['incType401N']);
$numItem401N= ($json['responseData']['summaryInformation']['numItem401N']);
$incAmt401N= ($json['responseData']['summaryInformation']['incAmt401N']);
$taxAmt401N= ($json['responseData']['summaryInformation']['taxAmt401N']);

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
                    <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลผู้เสียภาษีอากร</font>
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
                                    }else if($submitNo == ""){
                                        echo "ERROR !!";
                                        
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
            
        </div><!--rowresult1-->
            </div><!--col-md-12-->
            <div class="row" id="rowresult2">
            <div class="col-xs-12 col-md-12 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลที่อยู่ตามหน้าแบบผู้เสียภาษีอากร</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <tr>
                            <td>อาคาร :</td>
                            <td><?= $buildName?></td>
                            </tr>
                            <tr>
                            <td>ห้องเลขที่ :</td>
                            <td><?= $roomNo?></td>
                            </tr>
                            <tr>
                            <td>ชั้นที่ :</td>
                            <td><?= $floorNo?></td>
                            </tr>
                            <tr>
                            <td>หมู่บ้าน :</td>
                            <td><?= $villageName?></td>
                            </tr>
                            <tr>
                            <td>เลขที่ :</td>
                            <td><?= $addNo?></td>
                            </tr>
                            <tr>
                            <td>หมู่ที่ :</td>
                            <td><?= $mooNo?></td>
                            </tr>
                            <tr>
                            <td>ตรอก/ซอย :</td>
                            <td><?= $soi?></td>
                            </tr>
                            <tr>
                            <td>ถนน :</td>
                            <td><?= $streetName?></td>
                            </tr>
                            <tr>
                            <td>รหัสตำบล อำเภอ จังหวัด(MOI) :</td>
                            <td><?= $moiCode?></td>
                            </tr>
                            <tr>
                            <td>รหัสไปรษณีย์ :</td>
                            <td><?= $postalCode?></td>
                            </tr>
                           </table>
                       
                        </div>
                        </div>
                    </div><!--panelbody-->
                </div><!--panel-->


         
                
                <div class="col-xs-12 col-md-12 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลสรุปตามหน้าแบบ</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <tr>
                                <td>รวมจำนวนราย :</td> 
                                <td><?= $totNum?></td>
                                </tr>
                                <tr>
                                <td>รวมเงินได้ทั้งสิ้น :</td>
                                <td><?= $totAmt?></td>
                                
                                </tr>
                                <tr>
                                <td>รวมภาษีนำส่ง :</td>
                                <td><?= $totTax?></td>
                                
                                </tr>
                               
                           </table>
                       
                        </div>
                        </div>
                        
                    </div><!--panelbody-->
              

                    <div class="panel panel-info">
                    <div class="panel-heading">
                      <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลสรุปตามหน้าแบบแยกตามมาตรา</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <tr>
                                <td>มาตราตามรหัสแบบ :</td> 
                                <td><?= $incType401N?></td>
                                </tr>
                                <tr>
                                <td>จำนวนราย :</td>
                                <td><?= $numItem401N?></td>
                                
                                </tr>
                                <tr>
                                <td>จำนวนเงินได้ :</td>
                                <td><?= $incAmt401N?></td>
                                
                                </tr>
                                </tr>
                                <tr>
                                <td>จำนวนภาษีนำส่ง :</td>
                                <td><?= $incAmt401N?></td>
                                
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