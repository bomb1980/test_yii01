<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>otp data</title>
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

  if(Yii::app()->user->username){
	  $username = Yii::app()->user->username;
  }else{
	  $username = "sys";
  }
  
  if(Yii::app()->user->address){
	  $brachcode = Yii::app()->user->address;
  }else{
	  $brachcode = "-";
  }	
  
  //echo "{$action}, {$bgdatep}, {$eddatep}, {$newdap}, {$updap}"; echo "<br>";
  
  $tempDate = explode('/', $eddatep); 
  $d=mktime(00, 00, 00, $tempDate[0], $tempDate[1], $tempDate[2]);
  $date_30 = date('Y-m-d', strtotime("-30 days", $d));
  
  //echo "{$date_30}"; echo "<br>";
  
  //ดึงข้อมูลนายจ้าง ที่มีการส่งเมล์ ไปแล้วเมื่อวานมาแสดง
  $now = date_create('now')->format('Y-m-d H:i:s');
  $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  $daten1 = date('Y-m-d H:i:s');
  
  $startdate = $bgdatep . "T00:00:00+07:00";
  $enddate = $eddatep . "T23:59:59+07:00";
  
  $startdate = date_create($startdate)->format('Y-m-d') . "T00:00:00+07:00";
  $enddate = date_create($enddate)->format('Y-m-d') . "T23:59:59+07:00";
	
  $rundate = date_create($bgdatep)->format('Ymd');
  
  $datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
  $datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
  $datesch3 = date_create($date_30)->format('Y-m-d H:i:s');
  
  //echo "{$datesch1}, {$datesch2}, {$datesch3}";
  
  //ค้นหารายการ email ที่ส่งไปจาก table ของ etp OtpEmailTb
  $qetp = new CDbCriteria( array(
  	'condition' => "oel_registerdate <= :oel_registerdate AND (oel_answer is null or oel_answer = '') and oel_emailtype = :oel_emailtype and oel_status = :oel_status ",
	'params'    => array(':oel_registerdate' => $datesch3, 'oel_emailtype' => '1', 'oel_status' => 'P')
  ));
  //SELECT * FROM etpdb.otp_email_tb where (oel_answer is null or oel_answer = "") and oel_emailtype = '1' and oel_status = 'P';
  $retp = OtpEmailTb::model()->findAll($qetp);
  $cetp = count($retp); //จำนวนรายการอีเมล์ที่ยังไม่ได้ตอบกลับ
  
  if($cetp){
  	echo "จำนวน email  ที่ยังไม่มีการตอบกลับภายใน 30 นับจากวันที่ " . $eddatep . " มีจำนวน  : {$cetp} รายการ "; 
  }else{
	echo "ไม่พบรายการ ส่งเมล์ ตามเงื่อนไข";	  
  }
	
  //exit;
  
	  
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
              <th>ฉบับที่ส่งไปแล้ว</th>
              <th>สถานะ etp</th>
              <th>สถานะส่งฉบับ 3</th>
          </tr>
      </thead>
      <tbody>
      <?php
	    $sendmailno = 0;
	  	$rowno = 1;
		$etphd = "no";
		foreach ($retp as $rows){
			
			$registername = $rows->oel_registername;
			$registernumber = $rows->oel_registernumber;
			$acc_no = $rows->oel_accno;
			$registerdate = $rows->oel_registerdate;
			$crop_remark = $rows->oel_remark; //รหัสสาขา
			$crop_status = $rows->oel_status;
			$corpemail = $rows->oel_emailaddress;
			$emailtype = $rows->oel_emailtype; //ฉบัยที่
			
			if($emailtype=='1'){
				$emailtypetxt = 'ฉบับที่ 2';		
			}else{
				$emailtypetxt = 'ฉบับที่ 1';
			}
			
			$statetp3 = "No";
			//บันทึกข้อมูลลง etp ไว้รอการตอบกลับ ---------------------------------------------------------
			 $qlc = new CDbCriteria( array(
				'condition' => "oel_registernumber = :oel_registernumber AND  oel_accno = :oel_accno AND oel_emailtype = :oel_emailtype",
				'params'    => array(':oel_registernumber' => $registernumber, 'oel_accno' => $acc_no, 'oel_emailtype' => '2')
			  ));
			 $rlc = OtpEmailTb::model()->findAll($qlc);
			 if(!$rlc){
				 
			   $insert_etp = new OtpEmailTb();
			   
			   $insert_etp->oel_registernumber = $registernumber;
			   $insert_etp->oel_accno = $acc_no;
			   $insert_etp->oel_registername = $registername;
			   $insert_etp->oel_emailaddress = $corpemail;
			   $insert_etp->oel_registerdate = $registerdate;
			   $insert_etp->oel_emailtype = "2";
			   $insert_etp->oel_createby = "wpd";
			   $insert_etp->oel_createdate = date('Y-m-d H:i:s');
			   $insert_etp->oel_updateby = "wpd";
			   $insert_etp->oel_updatedate = date('Y-m-d H:i:s');
			   $insert_etp->oel_remark = $crop_remark;
			   $insert_etp->oel_status = $crop_status;
			   
			   if($insert_etp->save()){
				   //update status ฉบับที่ 2 เป็น P2 เพื่อใช้ตรวจสอบว่ามีการติดตามฉบับที่ 3 แล้ว
				   	$upst3=OtpEmailTb::model()->findByAttributes(array('oel_registernumber'=>$registernumber,'oel_emailtype'=>'1','oel_status'=>'P'));
					if($upst3){
						$upst3->oel_updateby = "wpd";
						$upst3->oel_updatedate = date('Y-m-d H:i:s');
						$upst3->oel_status = "P2";
						if($upst3->save()){
							//update as success
							$statetp3 = "Yes";		
						}//if
					}//if
				   $statetp3 = "Yes";
			   }else{
				   $statetp3 = "No";
			   }//if
			 }else{
			 	$statetp3 = "Yes";
			 }//if
			//--- end of save to etp -----------------------------------------------------------------
			
			//check for sendemail3 is alredy----
			$statussendemail3 = "No";
			$qlcsem = new CDbCriteria( array(
			  'condition' => "crop_name = :crop_name AND  status = :status",
			  'params'    => array(':crop_name' => $acc_no, 'status' => '3')
			));
			$rlcsem = Sendemailcorp::model()->findAll($qlcsem);
			if(!$rlcsem){
			//** send email 3 *******--------------------------------------------------------------------
				//-- call function sendeamil3 -----
				$ema = $corpemail;
				$accno = $acc_no;
				$brnno = "00000";
				$registername = $registername;
				if(Yii::app()->Clogevent->sendmail3($ema, $accno, $brnno, $registername)){ //sendemail as success return true
					$statussendemail3 = "Yes";
				}else{// sendemail as failed retrun false
					$statussendemail3 = "No";	
				}//if
			//** end of send email 3 *****---------------------------------------------------------------	
			}else{
				$statussendemail3 = "Yes";
			}//if
	
	  ?>
          <tr>
              <!--<td style="text-align:center;"><?//$rowno?></td>-->
              <td><?=$registername?></td>
              <td style="text-align:center;"><?=$registernumber?></td>
              <td style="text-align:center;"><?=$acc_no?></td>
              <td style="text-align:center;"><?=$registerdate?></td>
              <td style="text-align:left;"><?=$corpemail?></td>
              <td style="text-align:center;"><?=$emailtypetxt?></td>
              <td style="text-align:center;"><?=$statetp3?></td>
              <td style="text-align:center;"><?=$statussendemail3?></td>
             
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
              <th>สถานะ etp</th> 
          </tr>
      </tfoot>
  </table>
</div>

</body>
</html>