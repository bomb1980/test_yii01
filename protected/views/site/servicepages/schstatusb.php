<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search Status P</title>
</head>

<body>
<?php
  $now = date_create('now')->format('Y-m-d H:i:s');
  $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  $daten1 = date('Y-m-d H:i:s');
?>
<?php
	$startdate = $bgdatep . "T00:00:00+07:00";
	$enddate = $eddatep . "T23:59:59+07:00";
	
	$datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
	$datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
?>
	<div  class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
    <?php
	
		$q = new CDbCriteria( array(
    		'condition' => "registerdate = :registerdate and crop_remark = :crop_remark ",         // no quotes around :match
    		'params'    => array(':registerdate' => "{$datesch1}", ':crop_remark' => "B")  // Aha! Wildcards go here
		));
		
        $resultb = CropinfoTmpTb::model()->findAll($q);
		$countb = count($resultb);
		
		echo "จำนวน : {$countb} รายการ";
	?>
    </div>

</body>
</html>