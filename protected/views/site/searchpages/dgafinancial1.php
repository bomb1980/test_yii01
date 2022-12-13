<?php

$JuristicID = $txt1;
$StatementYear = $txt2;
$pdfdata = $pdfdata;
$corpname1 = $corpname1;

$pdfdataarray = explode(";", $pdfdata);
//echo $pdfdataarray[0];
//echo $pdfdataarray[22];

//echo "{$JuristicID}, {$StatementYear}, {$pdfdata}";
//exit;


require './vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
	//require_once 'test1.html';
    //$content = ob_get_clean();
	
	//$content = '<page style="font-family:freeserif;width:100%;font-size:16px;">นี้คือบทความภาษาไทย =>' . $aaa . '</page>';
      
	$content = '
	<page style="font-family:freeserif;width:100%;font-size:16px;">
	<div class="container">
     	<div class="row">
          	<div class="col-sm">
            	<div class="text-center"><b style="font-size:32px;">ตรวจสอบรายการในหนังสืองบการเงิน</b></div>
                <div class="container">
                	<div class="row">
                    	<div class="col-sm text-left"><b>ทะเบียนเลขที่:</b> => ' . $JuristicID . ' , ' .  $corpname1  . '</div>
                        <div class="col-sm text-sm-left text-md-right text-lg-right"><b>ปี (พ.ศ.):</b> => ' . $StatementYear . '</div>
                    </div>
                </div>			
          	</div>
        </div>
     </div>
     <hr>	   
      <div class="container">
        <div class="row">
          <div class="col-sm border border-success rounded" style="padding-bottom:10px;">
            	<div class="row">
                	<div class="col-sm" style="padding-top:10px;"><b><i class="fa fa-money"></i> ข้อมูลทั่วไป</b></div>
                </div>
                <hr>
                <div class="row"><div class="col-sm">1. ลูกหนี้การค้า <b> => ' . $pdfdataarray[1] . '</b> บาท</div></div>
                <div class="row"><div class="col-sm">2. จำนวนหุ้น <b>-ไม่มี-</b></div></div>
                
          </div>
          <div class="col-sm border border-success rounded" style="padding-left:30px; padding-bottom:10px;">
            	<div class="row">
                	<div class="col-sm" style="padding-top:10px;"><b><i class="fa fa-money"></i> งบแสดงสถานะการเงิน</b></div>
                </div>
                <hr>
                <div class="row"><div class="row"><div class="col-sm">1. สินค้าคงเหลือ => <b>  ' . $pdfdataarray[3] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">2. หนี้สินของผู้ถือหุ้น => <b>  ' . $pdfdataarray[4] . '</b></div></div></div>
                <div class="row"><div class="row"><div class="col-sm">3. ทุนจดทะเบียนที่ชำระแล้ว => <b> ' . $pdfdataarray[5] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">4. ที่ดิน อาคาร และอุปกรณ์  => <b>  ' . $pdfdataarray[6] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">5. ทุนจดทะเบียน => <b>  ' . $pdfdataarray[7] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">6. ส่วนของผู้ถือหุ้น => <b>  ' . $pdfdataarray[8] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">7. รวมสินทรัพย์  => <b>  ' . $pdfdataarray[9] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">8. รวมสินทรพัย์หมุนเวียน  => <b>  ' . $pdfdataarray[10] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">9. รวมหนี้สิน => <b>  ' . $pdfdataarray[11] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">10. รวมหนี้สินของผู้ถือหุ้น => <b> ' . $pdfdataarray[12] . '</b></div></div></div>
          </div>
          <div class="col-sm border border-success rounded" style="padding-left:30px; padding-bottom:10px;">
            	<div class="row">
                	<div class="col-sm" style="padding-top:10px;"><b><i class="fa fa-money"></i> งบกำไรขาดทุน</b></div>
                </div>
                <hr>
                <div class="row"><div class="row"><div class="col-sm">1. ค่าใช้จ่ายในการบริหาร => <b>  ' . $pdfdataarray[14] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">2. ต้นทุนขาย => <b> ' . $pdfdataarray[15] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">3. กำไรต่อหุ้น => <b> ' . $pdfdataarray[16] . '</b></div></div></div>
                <div class="row"><div class="row"><div class="col-sm">4. ภาษีเงินได้ => <b> ' . $pdfdataarray[17] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">5. ดอกเบี้ยจ่าย => <b> ' . $pdfdataarray[18] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">6. รายได้รวม => <b> ' . $pdfdataarray[19] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">7. รายได้จากการขาย => <b> ' . $pdfdataarray[20] . '</b> บาท</div></div></div>
                <div class="row"><div class="row"><div class="col-sm">8. รวมรายได้ =>  <b>' . $pdfdataarray[21] . '</b> บาท</div></div></div>
          </div>
        </div>
      </div>
      <hr>
      <div class="container">
      	<div class="row">
        	<div class="col-sm">
            	วันที่ตรวจสอบรายการในหนังสืองบการเงิน' . date("วันที่ d/m/Y เวลา H:i:s") . ' น.
            </div>
            
        </div>
      </div>
	  </page>';  
	  
    $html2pdf = new Html2Pdf('P', 'A4', 'fr'); //'P'
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
	ob_start();
    //$html2pdf->output('example1.pdf');
	//$html2pdf->output('/example1.pdf','F');
	$html2pdf->output('financail_' . $JuristicID . "_" . $StatementYear . '.pdf', 'D');
	//$html2pdf->Output('directory/file_xxxx.pdf', 'F');
} catch (Html2PdfException $e) {
    $html2pdf->clean();
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
?>