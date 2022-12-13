<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Show file name on sftp</title>
<script>
	function selecttxtfile(fns){
		$("#dlt1").val(fns);
		dilgfn.close();
	}//function
</script>
</head>

<body>
<?php
	//var_dump($result);
	foreach ($result as $key => $value){
?>
	<div><a href="javascript:;" onClick="javascript:selecttxtfile('<?=$value?>');"><i class="fa fa-file"></i>  <?=$value?> </a></div>
<?php
	}//foreach
?>
</body>
</html>