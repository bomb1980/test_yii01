<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Execute SQL Command</title>
<style>
.tablen {
  border-collapse: collapse;
}

.tablen, .thn, .tdn {
  border: 1px solid black;
}
</style>
</head>
<?php
	  $sqlcr = $sqlcr; //strtolower($sqlcr);	
	  $sqlcmdtype = "-"; //ตรวจสอบว่ามีคำว่า  หรือปล่าว
	  if (strstr($sqlcr, 'select' )) {
			//$Condition = substr($txtsql,strpos($txtsql,'where'),strlen($txtsql));
			$sqlcmdtype = 'select';
	  } else {
			//$Condition = "";
			if (strstr($sqlcr, 'insert' )) {
				//$Condition = substr($txtsql,strpos($txtsql,'where'),strlen($txtsql));
				$sqlcmdtype = 'insert';
			} else {
				  //$Condition = "";
				  if (strstr($sqlcr, 'update' )) {
						//$Condition = substr($txtsql,strpos($txtsql,'where'),strlen($txtsql));
						$sqlcmdtype = 'update';
				  } else {
						//$Condition = "";
						if (strstr($sqlcr, 'delete' )) {
							  //$Condition = substr($txtsql,strpos($txtsql,'where'),strlen($txtsql));
							  $sqlcmdtype = 'delete';
						} else {
							  //$Condition = "";
							  $sqlcmdtype = '-';
						}
				  }
			}
	  }
      

	if($udb1=="wpddb"){
		$conn = Yii::app()->db;//get connection
	}else if($udb1=="wpdlogdb"){
		$conn = Yii::app()->db2;//get connection
	}else if($udb1=="wpdreportdb"){
		$conn = Yii::app()->db3;//get connection
	}else if($udb1=="etpdb"){
		$conn = Yii::app()->db4;//get connection
	}//if//if
	
	
	//$conn = Yii::app()->db; 
	//echo "{$sqlcr}<br>"; 
	//$sql = "select * from accnumber_tb";
	if($sqlcmdtype=='select'){
		$time_start = microtime(true); 
			$command = $conn->createCommand($sqlcr);
			$rows= $command->queryAll(); //sql respons data array
			$rowsn= $command->execute(); //sql respons action rows number
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start)/60;
		echo "จำนวนค้นหา : {$rowsn} เร็คคอร์ด , ใช้เวลา {$execution_time} นาที";
	}else if($sqlcmdtype=='insert'){
		if(Yii::app()->session['username']==='kporntima'){
		$time_start = microtime(true);
			$command = $conn->createCommand($sqlcr);
			$rowsn= $command->execute();
			//$rowsn = 0;
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start)/60;
		echo "จำนวนเพิ่ม : {$rowsn} เร็คคอร์ด , ใช้เวลา {$execution_time} นาที";
		}else{
			echo "คุณไม่สามารถ insert ข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ!";		
		}
	}else if($sqlcmdtype=='update'){
		if(Yii::app()->session['username']==='kporntima'){
		$time_start = microtime(true);
			$command = $conn->createCommand($sqlcr);
			$rowsn= $command->execute();
		//$rowsn = 0;	
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start)/60;
		echo "จำนวนปรับปรุง : {$rowsn} เร็คคอร์ด , ใช้เวลา {$execution_time} นาที";
		}else{
			echo "คุณไม่สามารถ update ข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ!";		
		}
	}else if($sqlcmdtype=='delete'){
		if(Yii::app()->session['username']==='kporntima'){
		$time_start = microtime(true);
			$command = $conn->createCommand($sqlcr);
			$rowsn= $command->execute();
			//$rowsn = 0;
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start)/60;
		echo "จำนวนลบ : {$rowsn} เร็คคอร์ด , ใช้เวลา {$execution_time} นาที";
		}else{
			echo "คุณไม่สามารถ update ข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ!";		
		}
	}//if
	
	//var_dump($rows);
	//echo "{$rows}";
	
	
?>
<body>
<div style="overflow: auto; height:400px;">
<?php if($sqlcmdtype=='select'){  ?>
<table class="tablen" style="white-space:nowrap;width:100%;">
	<?php 

		if($rowsn){
	?>
	 <tr>
	<?php
      foreach($rows[0] as $key => $value) {
          echo "<td class='tdn' style='width:auto; text-align:center; background-color:#6F9;'>{$key}</td>"; // Would output "subkey" in the example array 
      }//foreach
    ?>
    </tr>
	<?php				
		  $rn = 0;
		  while($rn < $rowsn)
		  {
	  ?>
      <tr>	
      <?php
			foreach($rows[$rn] as $key => $value) {
				//echo "{$key} : "; // Would output "subkey" in the example array
				echo "<td class='tdn' style='width:auto; text-align:center;'>{$value}</td>"; 
			}//foreach
		  //echo "<br>";
		  $rn = $rn +1;
		  
		  }//while
	  ?>
      </tr>
    <?php
		}else{//if
			//echo "no data 0 record.";
		}
    ?>
    
</table>
<?Php }//if ?>
</div>
</body>
</html>