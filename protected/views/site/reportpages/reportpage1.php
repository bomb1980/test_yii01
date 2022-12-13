<?php
	//$slv = $_GET['slv'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Report page1</title>
</head>

<body>
	<?php
		$total_record = 55; //จำนวน record ทั้งหมด ที่ดึงออกมาจาก ฐานข้อมูลได้
		$perpage = 25; //จำนวน record ที่ต้องการให้แสดงต่อ 1 หน้า
		$total_page = ceil($total_record / $perpage);  //จำนวนหน้าทั้งหมด
		$beginpage = 1; //เลขหน้าเริ่มต้น
		$endpage = $total_page; //เลขหน้าสุดท้าย
		$rowt = $total_record; //จำนวน record ทั้งหมดที่จะให้แสดง
		$rowl = 1; //เลขแถวที่ต้องการให้เริ่มต้น
		for($i=$beginpage;$i<=$endpage;$i++){
	?>
    	<div class="page-break<?=($i==1)?"-no":""?>">&nbsp;</div>
		<page size='A4'>
       
<table id="tbp1" width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right" style="text-align:right;">Page <?php echo " {$i}/{$endpage} "; ?></td>
  </tr>
  <tr>
    <td align="center" class="headTitle" style="font-size:15px;">ใบรับฝากรวม<br />
      RECEIPT FOR BULK POSTING <?=$slv?> <br /></td>
  </tr>
  <tr>
    <td align="left">
    <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td align="center"><div class="chk_box"></div></td>
          <td align="left">ไปรษณียภัณฑ์</td>
          <td align="center"><div class="chk_box"></div></td>
          <td align="left">ลงทะเบียน</td>
          <td align="center"><div class="chk_box"></div></td>
          <td align="left">รับรอง</td>
        </tr>
        <tr>
          <td>ได้รับฝาก</td>
          <td align="center">&nbsp;</td>
          <td align="left">Letter-Post items</td>
          <td align="center">&nbsp;</td>
          <td align="left">Registered</td>
          <td>&nbsp;</td>
          <td align="left">Certified</td>
        </tr>
        <tr>
          <td>Received</td>
          <td align="center"><div class="chk_box"></div></td>
          <td align="left">พัสดุไปรษณีย์</td>
          <td align="center"><div class="chk_box"></div></td>
          <td align="left">รับประกัน</td>
          <td>&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="left">Parcels</td>
          <td align="center">&nbsp;</td>
          <td align="left">Insured</td>
          <td>&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="left"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td width="200" align="center"> ไว้ดังนี้ ตราประจำวัน</td>
        </tr>
        <tr>
          <td>จาก
            <input name="textfield" type="text" class="box_data1" id="textfield" style="text-align:left;width:500px;"   /></td>
          <td align="center">As Follows Date Stamp</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="left">From</td>
  </tr>
  <tr>
    <td align="left">
    <table width="750" border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-top:5px double #000;">
        <tr>
          <td width="50" rowspan="2" class="headerTitle01"  align="center" valign="middle">ลำดับ<br />
            No.</td>
          <td width="200" rowspan="2" class="headerTitle01"    align="center" valign="middle">นามผู้รับ<br />
            Name Of Addressee</td>
          <td width="130" rowspan="2" class="headerTitle01"    align="center" valign="middle">ปลายทาง<br />
            Destination</td>
          <td width="70" rowspan="2" class="headerTitle01"   align="center" valign="middle">เลขที่<br />
            Number</td>
          <td width="100" rowspan="2" class="headerTitle01"    align="center" valign="middle">น้ำหนัก (กรัม)<br />
            Weight (Grammes)</td>
          <td colspan="2" class="headerTitle01"    align="center" valign="bottom">ค่าบริการ<br />
            Postal Charge</td>
          <td width="100" rowspan="2" class="headerTitle01_r"   align="center" valign="middle">หมายเหตุ<br />
            Remarks</td>
        </tr>
        <tr>
          <td width="70"   align="center" valign="bottom" class="headerTitle01">บาท<br />
            Baht</td>
          <td width="30" class="headerTitle01"   align="center" valign="bottom">สต.
            Stg.</td>
        </tr>
        
        <?php 
			$rowstart = 1;
			$rowstop = 25;
			for($l=$rowstart;$l<=$rowstop;$l++){   
		?>
        <tr>
          <td height="20" align="center" class="left_bottom">
		  	<?php 
				if($rowt>0){
					echo "{$rowl}";
				}
			?>
          </td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_right_bottom">&nbsp;</td>
        </tr>
        <?php 
				$rowt = $rowt - 1;
				$rowl = $rowl + 1;
			} //for $l
		?>
        <tr>
          <td height="20" align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_bottom">&nbsp;</td>
          <td align="left" class="left_right_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" align="left" style="border-top:2px solid #000;">รวมทั้งสิ้น 
            Total
            <input name="textfield2" type="text" class="box_data1" id="textfield2" style="text-align:center;width:250px;"   />
            ฉบับ/ห่อ
            Pieces</td>
          <td align="center" style="border-top:2px solid #000;">เป็นเงิน 
            Amount</td>
          <td height="20" align="left" class="left_bottom" style="border-bottom:5px double #000;border-top:2px solid #000;">&nbsp;</td>
          <td align="left" class="left_right_bottom" style="border-bottom:5px double #000;border-top:2px solid #000;">&nbsp;</td>
          <td align="left" style="border-top:2px solid #000;">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" align="left">- ใบรับฝากนี้ใช้เป็นหลักฐานการฝากส่ง โปรดเก็บรักษาไว้จนหมดอายุ<br />
            การสอบสวน คือ ระยะเวลา 6 เดือน นับจากวันต่อจากวันที่ฝากส่ง<br /></td>
          <td width="50%" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="left">- การติดต่อในเรื่องใดเกี่ยวกับการฝากส่ง ต้องนำใบฝากฉบับนี้<br />
            มาแสดงทุกครั้ง มิฉะนั้น ปณท อาจไม่ทำการตรวจสอบหรือสอบสวนให้</td>
          <td align="left"><table width="300" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100" align="right">พนักงานรับฝาก</td>
                <td width="62%"><input name="textfield10" type="text" class="box_data1" id="textfield10" style="text-align:center;width:200px;"   /></td>
              </tr>
              <tr>
                <td align="right">Counter Clerk</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
        </page>
    <?php
		
		} //for $i
	?>
</body>
</html>