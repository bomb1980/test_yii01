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
                    <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ???????????????????????????????????????????????????????????????</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                            <!--result data-->
                            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <tr>
                                <td>?????????????????????????????????????????????????????????????????????????????? :</td>
                                <td><?= $NID?></td>
                                </tr>
                                <tr>
                                <td>???????????????????????? :</td>
                                <td><?= $branchNo?></td>
                                </tr>
                                <tr>
                                <td>????????????????????? :</td>
                                <td><?= $formCode?></td>
                                </tr>
                                <tr>
                                <td>????????????????????????/??????????????????????????????????????? :</td>
                                <td><?php
                                    if($submitNo == "0")
                                    {
                                        echo "????????????????????????";
                                    }else if($submitNo == ""){
                                        echo "ERROR !!";
                                        
                                    }else{
                                        echo "???????????????????????????????????????????????????????????????" ." ".$submitNo;

                                    }
                                    ?></td>
                                </tr>
                                <tr>
                                <td>??????????????????????????????????????? :</td>
                                <td><?= $taxYear?></td>
                                </tr>
                                <tr>
                                <td>???????????????????????????????????? :</td>  
                                <td><?= $dlnNo?></td>
                                </tr>
                                <tr>
                                <td>???????????????????????????????????????????????? :</td> 
                                <td><?= $taxMonth?></td>
                                </tr>
                                <tr>
                                <td>???????????????????????????????????????????????? :</td> 
                                <td><?= $titleCode?></td>
                                </tr>
                                <tr>
                                <td>????????????????????????????????????????????????????????? :</td> 
                                <td><?= $fnameWhld?></td>
                                </tr>
                                <tr>
                                <td>?????????????????????????????????????????????????????????????????? :</td> 
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
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ??????????????????????????????????????????????????????????????????????????????????????????????????????????????????</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <tr>
                            <td>??????????????? :</td>
                            <td><?= $buildName?></td>
                            </tr>
                            <tr>
                            <td>?????????????????????????????? :</td>
                            <td><?= $roomNo?></td>
                            </tr>
                            <tr>
                            <td>????????????????????? :</td>
                            <td><?= $floorNo?></td>
                            </tr>
                            <tr>
                            <td>???????????????????????? :</td>
                            <td><?= $villageName?></td>
                            </tr>
                            <tr>
                            <td>?????????????????? :</td>
                            <td><?= $addNo?></td>
                            </tr>
                            <tr>
                            <td>????????????????????? :</td>
                            <td><?= $mooNo?></td>
                            </tr>
                            <tr>
                            <td>????????????/????????? :</td>
                            <td><?= $soi?></td>
                            </tr>
                            <tr>
                            <td>????????? :</td>
                            <td><?= $streetName?></td>
                            </tr>
                            <tr>
                            <td>???????????????????????? ??????????????? ?????????????????????(MOI) :</td>
                            <td><?= $moiCode?></td>
                            </tr>
                            <tr>
                            <td>???????????????????????????????????? :</td>
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
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ????????????????????????????????????????????????????????????</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <tr>
                                <td>????????????????????????????????? :</td> 
                                <td><?= $totNum?></td>
                                </tr>
                                <tr>
                                <td>?????????????????????????????????????????????????????? :</td>
                                <td><?= $totAmt?></td>
                                
                                </tr>
                                <tr>
                                <td>???????????????????????????????????? :</td>
                                <td><?= $totTax?></td>
                                
                                </tr>
                               
                           </table>
                       
                        </div>
                        </div>
                        
                    </div><!--panelbody-->
              

                    <div class="panel panel-info">
                    <div class="panel-heading">
                      <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ?????????????????????????????????????????????????????????????????????????????????????????????</font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="resega2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <tr>
                                <td>????????????????????????????????????????????? :</td> 
                                <td><?= $incType401N?></td>
                                </tr>
                                <tr>
                                <td>???????????????????????? :</td>
                                <td><?= $numItem401N?></td>
                                
                                </tr>
                                <tr>
                                <td>???????????????????????????????????? :</td>
                                <td><?= $incAmt401N?></td>
                                
                                </tr>
                                </tr>
                                <tr>
                                <td>?????????????????????????????????????????? :</td>
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