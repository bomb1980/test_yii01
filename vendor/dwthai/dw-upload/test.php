<?php
include("vendor/autoload.php");
use DwThai\DwUpload;
if(!empty($_FILES['image'])){
	$str = DwUpload::DwUpload($_FILES['image'],'./',true);
	echo $str;
}
?>
<form method="post" enctype="multipart/form-data" action="">
        <input type="file" name="image" value=""/>
        <input type="submit" name="btn" value="Upload Now !"/>
</form>
