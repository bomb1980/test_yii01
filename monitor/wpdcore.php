<?php
# $ php -f db-connect-test.php
$dbname = 'wpddb';
$dbuser = 'appwpd';
$dbpass = 'APP@wpd';
$dbhost = 'C2WPDDBPRO001:3306';

$link = mysqli_connect($dbhost, $dbuser, $dbpass) or header("HTTP/1.0 500 Internal Server Error") or die("WPDCore Nginx PHP-FPM Mysql (Down)");
echo "WPDCore Nginx PHP-FPM Mysql (Up)";
mysqli_close($link);
?>
