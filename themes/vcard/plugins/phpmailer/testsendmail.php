<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$to="day.jakkrit@gmail.com";
$header.= "Content-type: text/html; charset=windows-874\n"; 
$header.="from: day.jakkrit@gmail.com";
$subject="ทดสอบการส่งอีเมล์โดยใช้ ArGoSoft Mail Server";
$msg.="ถ้าคุณได้รับอีเมล์นี้";
$msg.="แสดงว่าคุณเป็นคนที่โชคดีที่สุดในโลก";
if(mail($to,$subject,$msg,$header))
{
echo "ส่งอีเมล์เรียบร้อยแล้ว";
}
else
{
echo "ไม่สามารถส่งอีเมล์ได้";
}
?>
</body>
</html>