<?php
ini_set('memory_limit', '-1');
 session_start();

$content = null;

if(isset($_SESSION['content'])) {

  $content = $_SESSION['content'];
  unset($_SESSION['content']);
}


if(is_null($content)){
  echo("is null");
  exit();
}else{
	
	header('Content-type: application/pdf;');
	header('Content-Disposition: inline; filename=chai.pdf');
	header('Content-Transfer-Encoding: binary');
	header('Accept-Ranges: bytes');
	
	$data = base64_decode($content);
	echo $data;

  }

?>