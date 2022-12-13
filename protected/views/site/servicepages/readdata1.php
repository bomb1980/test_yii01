<?php
	$data = simplexml_load_file(Yii::app()->basePath . '/config/data2.xml') or die("Error: Cannot create object");
	
	echo "<pre>"; var_dump($data); echo "</pre>";
	
?>