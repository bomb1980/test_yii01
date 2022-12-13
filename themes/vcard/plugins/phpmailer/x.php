<?php

		require_once("class.phpmailer.php");

		$mailer = new PHPMailer();
		$mailer->Mailer = 'smtp';

		$mailer->Host = 'smtp.gmail.com'; //'172.16.11.190';
		$mailer->Port = '465';
		$mailer->SMTPAuth	= 'false';	

		$mailer->SMTPDebug = 2;

		$mailer->CharSet = 'utf-8';

		//ข้อมูลผู้ส่ง  (เมล์กลาง)	

		$mailer->From = 'day.jakkrit@gmail.com';//'suphat.k@sso.go.th';
		$mailer->FromName = 'ความคิดเห็นเกี่ยวกับระบบบริหารทรัพยากรบุคคลของพนง.';
		$mailer->AddAddress('day.jakkrit@gmail.com','');

		$mailer->Subject = '[intranet] DEV testemail ';
		$message = 'ชื่อผู้แสดงความคิดเห็น : \n\n';
		$message .= 'อีเมล์ผู้แสดงความคิดเห็น : \n\n';
		$message .= 'รายละเอียด : ' ;

		$mailer->IsHTML (false);			
		$mailer->Body = $message;				

        if(!$mailer->Send())
        {
            $add_error("Failed sending email!");
            return false;
        }




?>