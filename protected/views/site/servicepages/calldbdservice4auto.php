<!DOCTYPE html PUBLIC>
<html>
<head>
<meta charset="utf-8" />
<title>Gen SSO Account number</title>
<script>
	$(document).ready(function() {
		$('#wpddt1 tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		} );
		var table = $('#wpddt1').DataTable({
			"scrollX": true,	
		});
		table.columns().every( function () {
			var that = this;
	 
			$( 'input', this.footer() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
						.search( this.value )
						.draw();
				}
			});
		});
		
	});
</script>
</head>

<body>
<?php

	  $username = "sys";
	  $brachcode = "-";
 

  $now = date_create('now')->format('Y-m-d H:i:s');
  $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  $daten1 = date('Y-m-d H:i:s');
  
  $startdate = $bgdatep . "T00:00:00+07:00";
  $enddate = $eddatep . "T23:59:59+07:00";
  
  $startdate = date_create($startdate)->format('Y-m-d') . "T00:00:00+07:00";
  $enddate = date_create($enddate)->format('Y-m-d') . "T23:59:59+07:00";
	
  $rundate = date_create($bgdatep)->format('Ymd');
	
  echo "Date formate : {$startdate}, {$enddate} <br>";
  
  $datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
  $datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
  
  $q = new CDbCriteria( array(
	  'condition' => "registerdate = :registerdate AND crop_remark = :crop_remark ",
	  'params'    => array(':registerdate' => $datesch1, 'crop_remark' => 'N' )
  ));
  $r = CropinfoTmpTb::model()->findAll($q);
  $c = count($r);
  echo "Count of data is update {$c} Record. <br>";
   
  $model = CropinfoTmpTb::model()->findAllByAttributes(array('registerdate'=>$datesch1));
  $countmedel = count($model);
  
  echo "Count of data : {$countmedel} Record.<br>";	
  
?>
<div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
      <table id="wpddt1" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
      <thead>
          <tr>
              <!--<th>ลำดับ</th>-->
              <th>ชื่อนิติบุคคล</th>
              <th>เลขนิติบุคคล 13 หลัก</th>
              <th>เลขประกันสังคม 10 หลัก</th>
              <th>วันที่จดทะเบียน</th>
              <th>email</th>
              <th>สถานะส่ง email</th>
              <th>สถานะ</th>
             
          </tr>
      </thead>
      <tbody>
      <?php
	    $sendmailno = 0;
	  	$rowno = 1;
		foreach ($model as $rows){
			$registername = $rows->registername;
			$registernumber = $rows->registernumber;
			$acc_no = $rows->acc_no;
			$acc_bran = $rows->acc_bran;
			$registerdate = $rows->registerdate;
			$crop_remark = $rows->crop_remark;
			$crop_status = $rows->crop_status;
			
			//** send email *******
			$qemail=BranchTmpTb::model()->findByAttributes(array('registernumber'=>$registernumber));
			$corpemail = $qemail->email;
			$statemail = $qemail->brch_status;
			$brnremark = $qemail->brch_remark; //ดึงขอมูลสาขาเพิ่มเพื่อส่งให้ etp
		if($statemail == 1){
			if($corpemail != '-'){
				if(!empty($corpemail)){
				//if($sendmailno==0){
					$ema = $corpemail;
					$accno = $acc_no;
					$brnno = "000000";
					if(Yii::app()->Clogevent->sendmail($ema, $accno, $brnno, $registername)){
						//*** update status branch ******
						$upbs=BranchTmpTb::model()->findByAttributes(array('registernumber'=>$registernumber));
						$upbs->brch_status = 2;
						if($upbs->save()){
							//$msg3 = "update data is success.";
							Yii::app()->Clogevent->instetp($registernumber);
						}else{
							//$msg3 = "can't update data.";
						}
						$sendmailno += 1;
						$statussendemail = "ส่งฉบับที่ 1 แล้ว";
					}else{
						$statussendemail = "no";
					}
				//} 
				}
			}else{
				$statussendemail = "no";
			}//
		}else{
			$statussendemail = "ส่งฉบับที่ 1 แล้ว";
		}//if
			
	  ?>
          <tr <?php if($crop_remark=='B'){  ?> style="background-color:#FFFFC6;" <?php }else if($crop_remark=='A'){ ?> style="background-color:#CEFFDB;" <?php } ?>>
              <!--<td style="text-align:center;"><?//$rowno?></td>-->
              <td><?=$registername?></td>
              <td style="text-align:center;"><?=$registernumber?></td>
              <td style="text-align:center;"><?=$acc_no?></td>
              <td style="text-align:center;"><?=$registerdate?></td>
              <td style="text-align:center;"><?=$corpemail?></td>
              <td style="text-align:center;"><?=$statussendemail?></td>
              <td style="color:red; text-align:center;"><span class="badge thfont3" style="color:#FF6;"><?=$crop_remark?></span></td>
             
          </tr>
      <?php
	  		
			
			
	  
      	    $rowno += 1;
		}//foreach ($model as $rows){
			
	  ?>  
      </tbody>
      <tfoot>
          <tr>
              <!--<th>ลำดับ</th>-->
              <th>ชื่อนิติบุคคล</th>
              <th>เลขนิติบุคคล 13 หลัก</th>
              <th>เลขประกันสังคม 10 หลัก</th>
              <th>วันที่จดทะเบียน</th>
              <th>email</th>
              <th>สถานะส่ง email</th>
              <th>สถานะ</th>
             
          </tr>
      </tfoot>
  </table>
</body>
</html>