<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>wpd for txtfile</title>
<script>
	$(document).ready(function() {
		
	});
</script>
<style>
.tablen {
  border-collapse: collapse;
  text-align:center;
}
.tablen, .thn, .tdn {
  border: 1px solid black;
  text-align:center;
}

.tablen tr:nth-child(odd){
	background-color:#dbf2fe;
}
.tablen tr:nth-child(even){
	background-color:#fdfdfd;
}




</style>
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
  

	
  $now = date_create('now')->format('Y-m-d H:i:s');
  $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  $daten1 = date('Y-m-d H:i:s');
  
  $startdate = $bgdate . "T00:00:00+07:00";
  $enddate = $eddate . "T23:59:59+07:00";
  
  $startdate = date_create($startdate)->format('Y-m-d') . "T00:00:00+07:00";
  $enddate = date_create($enddate)->format('Y-m-d') . "T23:59:59+07:00";
	
  $rundate = date_create($bgdate)->format('Ymd');
  
  $datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
  $datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
  
  $model = CropinfoTmpTb::model()->findAllByAttributes(array('registerdate'=>$datesch1));
  $countmedel = count($model);
  
  echo "Count of data : {$countmedel} Record.<br>";
  
?>
  <div style="overflow-x:hidden; overflow-y:auto; height:300px;">
	<div class="row">
    	<div class="col-lg-12 col-md-12 col-xm-12 col-xs-12">
        	<table class="tablen">
            	<thead>
                	<tr>
                    	<th class="thn">No.</th>
                    	<th class="thn">เลขนิติบุคคล 13 หลัก</th>
                        <th class="thn">เลขบัญชีนายจ้าง 10 หลัก</th>
                        <th class="thn">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
				  $rowno = 1;
				  foreach ($model as $rows){
					  $registername = $rows->registername;
					  $registernumber = $rows->registernumber;
					  $acc_no = $rows->acc_no;
					  $acc_bran = $rows->acc_bran;
					  $registerdate = $rows->registerdate;
					  $crop_remark = $rows->crop_remark;
					  $crop_status = $rows->crop_status;
				?>
                	<tr>
                    	<td class="tdn"><?=$rowno?></td>
                    	<td class="tdn"><?=$registernumber?></td>
                        <td class="tdn"><?=$acc_no?></td>
                        <td class="tdn"><?=$crop_remark?></td>
                    </tr>
                <?php
					  $rowno += 1;
				  }//foreach ($model as $rows){
				?>  
                </tbody>
            </table>
        </div>
    </div>
  </div>
</body>
</html>