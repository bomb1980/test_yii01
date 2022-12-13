<?php

	$data = simplexml_load_file(Yii::app()->basePath . '/config/data.xml') or die("Error: Cannot create object");
	
	echo "<pre>"; var_dump($data); echo "</pre>";
	
	$val3 = $data[0]->corpInfo; //อ้างอิงถึง object corpInfo
	//echo "<pre>"; var_dump($val3); echo "</pre>";
	
	$a = (array)$data; //แปลง $data เป็นรูปแบบ array
    //echo "<pre>"; print_r($a); echo "</pre>";
	
	$keys = array_keys((array)$data[0]->corpInfo); //เก็บ key ของ corpinfo 
    //echo "<pre>"; var_dump($keys); echo "</pre>";
	
	echo "<pre>";
	
	for($i=0;$i<=9;$i++){
	   
	   $ii = $i+1;
	   echo "{$ii} <br>";
	   foreach($data[0]->corpInfo[$i] as $key => $value) {
    		//do something with your $key and $value;
			$countcommittees = count($data[0]->corpInfo[$i]->committees->committee)-1;
			$countbranches = count($data[0]->corpInfo[$i]->branches->branch)-1;
			if($key != 'committees' && $key != 'branches'){
    			echo "{$key} = {$value} <br>";
			}else if($key == 'committees'){
				echo "countcommittees: <br>";
				for($c=0;$c<=$countcommittees;$c++){
					$cc = $c+1;
					echo "{$cc} <br>";
					foreach($data[0]->corpInfo[$i]->committees->committee[$c] as $key => $value){
						echo "&nbsp;&nbsp;&nbsp;{$key} = {$value} <br>";
					}
				}
			}else if($key == 'branches'){
				echo "branches: <br>";
				for($b=0;$b<=$countbranches;$b++){
					$bb = $b+1;
					echo "{$bb} <br>";
					foreach($data[0]->corpInfo[$i]->branches->branch[$b] as $key => $value){
						echo "&nbsp;&nbsp;&nbsp;{$key} = {$value} <br>";
					}
				}
			}
	   }
	   echo "<hr><br>";
   }// for
   
   echo "</pre>";
	
?>