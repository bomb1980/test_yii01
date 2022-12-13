<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Cheng Status Form</title>
</head>

<body>
	<div class="row">
    	<div class="col-md-12">
        	
            <table id="chgstatus1" cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
    
      			<tbody>
                	<?php
					$dataReader=CJSON::decode($encode);
					$crop_id = $dataReader[0]['crop_id'];
					$registername = $dataReader[0]['registername'];
					$registernumber = $dataReader[0]['registernumber'];
					$acc_no = $dataReader[0]['acc_no'];
					$acc_bran = $dataReader[0]['acc_bran'];
					$registerdate = $dataReader[0]['registerdate'];
					$crop_remark = $dataReader[0]['crop_remark'];
					$crop_status = $dataReader[0]['crop_status'];
					
					$now = date_create('now')->format('Y-m-d H:i:s');
  					$tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  					$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  					$daten1 = date('Y-m-d H:i:s');
					
					$now2 = date('d-m-Y');
					
					$registerdatef = date_create($registerdate)->format('d-m-Y');
					
					?>
                	<tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">ชื่อกิจการ :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$registername?></td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">เลขนิติบุคคล 13 หลัก :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$registernumber?></td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">เลข สปส. 10 หลัก :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$acc_no?></td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">วันที่จดทะเบียน :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$registerdatef?></td>
                    </tr>
                    <tr>
                    	<td style="text-align:right; width:40%; font-weight:bold;">สถานะ :</td>
                        <td style="text-align:left; width:60%; padding-left:15px;"><?=$crop_remark?></td>
                    </tr>
                    
                </tbody>
            </table>
           <div style="color:#003;"> ได้ทำการขึ้นทะเบียนลูกจ้าง เรียบร้อยแล้ว ณ. วันที่ <?=$now2?> <br> กรุณาคลิก ปุ่ม Save เพื่อทำการบันทึกสถานะ </div>
            
        </div>
    </div>
</body>
</html>