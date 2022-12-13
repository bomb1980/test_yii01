<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Show All File in Directory</title>
</head>

<body>
<a href="http://localhost/ssowpd/assets/exportfile/">exportfile</a><br>
<a href="http://localhost/ssowpd/assets/exportfile/wpd20190624.txt">wpd20190624.txt</a><br>
<?php
$dir = $_SERVER['SERVER_NAME'].Yii::app()->request->baseUrl;
echo "{$dir}<br>"; //ผลลัพธ์ ==> localhost/ssowpd
//$result=parent::getViewPath();
$imagePath = YiiBase::getPathOfAlias("webroot").'/assets/exportfile/'; //ผลลัพธ์ ==> C:/xampp/htdocs/ssowpd/assets/exportfile/ 
$fname = "wpd20190624.txt";
$link_path1 =  Yii::app()->request->baseUrl  . "/assets/exportfile/" . $fname; // ผลลัพธ์ ==> /ssowpd/assets/exportfile/wpd20190624.txt 
$link_path2 =  Yii::app()->request->baseUrl  . "/assets/exportfile/" . $fname; // ผลลัพธ์ ==> /ssowpd/assets/exportfile/wpd20190624.txt 
$link_path3 =  Yii::app()->request->baseUrl  . "/assets/exportfile/";
$link_path4 = Yii::app()->basePath . "/assets/exportfile/"; //C:\xampp\htdocs\ssowpd\protected 
echo "{$link_path1} <br> {$link_path2} <br> {$link_path3} <br> {$imagePath} <br> {$link_path4} <br>";
?>
<a href="<?php Yii::app()->request->baseUrl ?>/ssowpd/assets/exportfile/wpd20190624.txt">exportfile</a><br>
<a href="<?=$link_path1?>">open file1</a><br>
<a download href="<?=$link_path1?>">download file2</a><br>
<a href="<?=$link_path3?>">opent directory file3</a><br>
<a href="<?=$imagePath?>">imagepath</a><br>
<a href="<?=$link_path4?>">file4</a><br>
<?php
   $dir = $imagePath;
   $files = scandir($dir);
    print_r($files);
?>
</body>
</html>