<?php
class logevent extends CApplicationComponent
{

	public $accnosapains;

	public function sendmail($ema, $accno, $brnno, $cropname, $txtsubject = NULL, $txtbody = NULL, $txtsendform = NULL)
	{

		$ema = 'bombbomb1980@gmail.com';

		if (empty($txtsubject)) {

			$txtsubject = "แจ้งผลการขี้นทะเบียนนายจ้างประกันสังคม";
		}

		if (empty($txtsendform)) {
			$txtsendform = "สำนักงานประกันสังคม";
		}

		if (empty($txtbody)) {

			$txtbody = "&nbsp;&nbsp;&nbsp;สำนักงานประกันสังคม ได้กำหนดเลขที่บัญชีนายจ้างให้ท่านคือ {$accno} สถานประกอบการชื่อ  {$cropname} เมื่อท่านมีการจ้างลูกจ้าง ให้ท่านใช้เลขที่บัญชีนายจ้างตามที่แจ้ง และ ติดต่อขึ้นทะเบียนลูกจ้าง/ผู้ประกันตน ภายใน 30 วันนับจากวันที่เริ่มจ้างงาน  ที่ สปส. ณ ที่ตั้ง สำนักงานใหญ่ของท่าน กรณีมีข้อสงสัยสอบถามรายละเอียดได้ที่สายด่วน 1506 <br>&nbsp;&nbsp;&nbsp;หากยังไม่ดำเนินกิจการหรือไม่มีลูกจ้าง ขอความร่วมมือท่านตอบแบบสำรวจอิเล็กทรอนิกส์ ตามข้อมูลจริง เนื่องจากข้อมูลดังกล่าวจะถูกนำมาใช้ในการวิเคราะห์เพื่อประโยชน์ต่อการคุ้มครองสิทธิที่พึงมีพึงได้ตามกฎหมาย และขอขอบคุณมา ณ โอกาสนี้ : <br> CLICK เพื่อตอบแบบสำรวจ (<a href='https://www.sso.go.th/etp/addressform.php?emadd={$ema}&et=1'>ตอบแบบสอบถาม อิเล็กทรอนิกส์</a>)";
		}

		if (Yii::app()->params['testJob']) {

			$mailer = new PHPMailer();
			$mailer->IsSMTP(); 
			$mailer->Host = Yii::app()->params['mailerHost'];
			$mailer->Port = 25; //587; //25
			$mailer->SMTPAuth = TRUE;
			$mailer->From = Yii::app()->params['mailerFrom'];
			$mailer->Username = Yii::app()->params['mailerUsername'];
			$mailer->Password = Yii::app()->params['mailerPassword'];
			$mailer->IsHTML(true);
			$mailer->FromName = iconv('utf-8', 'tis-620', $txtsendform);
			$mailer->Body = iconv('utf-8', 'tis-620', $txtbody);
			$mailer->Subject = iconv('utf-8', 'tis-620', $txtsubject);
			$mailer->AddAddress($ema);
			$mailer->Send();
		} else {
			
			$mailer = new PHPMailer();
			$mailer->IsSMTP(); // $mailer->Mailer = "mail"; ////$mailer->IsSMTP();
			$mailer->Host = 'smtp.sso.go.th'; //'smtp.gmail.com'; //'smtp.sso.go.th'
			$mailer->Port = 25; //587; //25
			$mailer->SMTPAuth = FALSE;
			$mailer->From = 'no-reply@sso.go.th'; //'day.jakkrit@gmail.com'; //'no-reply@sso.go.th';
			$mailer->IsHTML(true);
			$mailer->FromName = iconv('utf-8', 'tis-620', $txtsendform);
			$mailer->Body = iconv('utf-8', 'tis-620', $txtbody);
			$mailer->Subject = iconv('utf-8', 'tis-620', $txtsubject);
			$mailer->AddAddress($ema); //$ema
			$mailer->Send();
		}

		if (!$mailer->Send()) {

			return false;
		}

		arr('afsdfdfs');

		return true;

		$Sendemailcorp = new Sendemailcorp();

		$Sendemailcorp->crop_name = $accno;
		$Sendemailcorp->crop_email = $ema;
		$Sendemailcorp->access_code = $brnno;
		$Sendemailcorp->status = 2;
		$Sendemailcorp->created = date('Y-m-d H:i:s');
		$Sendemailcorp->modified = date('Y-m-d H:i:s');
		$Sendemailcorp->save();
	}





	public function sendmail__($ema, $accno, $brnno, $cropname)
	{
		// arr('addfdfsdsf');

		$txtsubject = "แจ้งผลการขี้นทะเบียนนายจ้างประกันสังคม";
		$txtbody = "&nbsp;&nbsp;&nbsp;สำนักงานประกันสังคม ได้กำหนดเลขที่บัญชีนายจ้างให้ท่านคือ {$accno} สถานประกอบการชื่อ  {$cropname} เมื่อท่านมีการจ้างลูกจ้าง ให้ท่านใช้เลขที่บัญชีนายจ้างตามที่แจ้ง และ ติดต่อขึ้นทะเบียนลูกจ้าง/ผู้ประกันตน ภายใน 30 วันนับจากวันที่เริ่มจ้างงาน  ที่ สปส. ณ ที่ตั้ง สำนักงานใหญ่ของท่าน กรณีมีข้อสงสัยสอบถามรายละเอียดได้ที่สายด่วน 1506 <br>&nbsp;&nbsp;&nbsp;หากยังไม่ดำเนินกิจการหรือไม่มีลูกจ้าง ขอความร่วมมือท่านตอบแบบสำรวจอิเล็กทรอนิกส์ ตามข้อมูลจริง เนื่องจากข้อมูลดังกล่าวจะถูกนำมาใช้ในการวิเคราะห์เพื่อประโยชน์ต่อการคุ้มครองสิทธิที่พึงมีพึงได้ตามกฎหมาย และขอขอบคุณมา ณ โอกาสนี้ : <br> CLICK เพื่อตอบแบบสำรวจ (<a href='https://www.sso.go.th/etp/addressform.php?emadd={$ema}&et=1'>ตอบแบบสอบถาม อิเล็กทรอนิกส์</a>)";
		$txtsendform = "สำนักงานประกันสังคม";

		$mailer = new PHPMailer();
		$mailer->IsSMTP(); // $mailer->Mailer = "mail"; ////$mailer->IsSMTP();
		$mailer->Host = 'smtp.sso.go.th'; //'smtp.gmail.com'; //'smtp.sso.go.th'
		$mailer->Port = 25; //587; //25
		$mailer->SMTPAuth = FALSE;
		$mailer->From = 'no-reply@sso.go.th'; //'day.jakkrit@gmail.com'; //'no-reply@sso.go.th';
		$mailer->IsHTML(true);
		$mailer->FromName = iconv('utf-8', 'tis-620', $txtsendform);
		$mailer->Body = iconv('utf-8', 'tis-620', $txtbody);
		$mailer->Subject = iconv('utf-8', 'tis-620', $txtsubject);
		$mailer->AddAddress($ema); //$ema

		/*
		$mailer->AddAddress($contact_email);
		$mailer->AddAddress = $contact_email;
		$mailer->AddAddress $_POST['email']; (taken from the html form)
		*/
		/*
		$mailer->WordWrap = 50; // set word wrap to 50 characters
		$mailer->IsHTML(true); // set email format to HTML
		$mailer->Subject = $_POST['subject'];
		$message = "Hi[name]".$_POST['fullname']." \r\n <br>Email Adrress :".$_POST['email']." \r\n <br> \r \n".$_POST['query'];
		$mailer->Body = $message;
		*/

		$mailer->Send();


		arr('afddfdasfsdf');



		if (!$mailer->Send()) {
			//echo "Message was not sent<br/ >";
			//echo "Mailer Error: " . $mailer->ErrorInfo;
			return false;
		} else {
			//****** insert data ****************************************
			$Sendemailcorp = new Sendemailcorp();

			$Sendemailcorp->crop_name = $accno;
			$Sendemailcorp->crop_email = $ema;
			$Sendemailcorp->access_code = $brnno;
			$Sendemailcorp->status = 2;
			$Sendemailcorp->created = date('Y-m-d H:i:s');
			$Sendemailcorp->modified = date('Y-m-d H:i:s');

			if ($Sendemailcorp->save()) {
				//echo CJSON::encode(array('status' => 'success'));
				//echo preg_replace("/\xEF\xBB\xBF/", "","yes <br>");
				//echo "Message has been sent";
				return true;
			} else {
				//echo CJSON::encode(array('status' => 'error'));
				//echo CJSON::encode($Users->getErrors());
				//echo preg_replace("/\xEF\xBB\xBF/", "","no <br>");
				return false;
			}
			//*********************************************************
		} //if

	}



	public function createlogevent($laction, $lpage, $lcause, $ldata, $lremark)
	{

		//$this->log_id;
		$LogeventTb = new LogeventTb();

		if (isset(Yii::app()->user->username)) {
			$username = Yii::app()->user->username;
		} else {
			$username = "sys";
		}

		if (isset(Yii::app()->user->address)) {
			$brachcode = Yii::app()->user->address;
		} else {
			$brachcode = "-";
		}

		$LogeventTb->log_user = $username;
		$LogeventTb->log_action = $laction;
		$LogeventTb->log_page = $lpage;
		$LogeventTb->log_cause = $lcause;
		$LogeventTb->log_date = date('Y-m-d H:i:s');
		$LogeventTb->log_data = $ldata;
		$LogeventTb->log_ip = $brachcode;
		$LogeventTb->log_remark = $lremark;
		$LogeventTb->log_status = 1;

		if ($LogeventTb->save()) {
			$msg = "add data is success";
		} else {
			$msg = $LogeventTb->getErrors();
		}

		return $msg;
	}


	public function createlogeventauto($laction, $lpage, $lcause, $ldata, $lremark)
	{

		//$this->log_id;
		$LogeventTb = new LogeventTb();


		$username = "sys";
		$brachcode = "-";

		$LogeventTb->log_user = $username;
		$LogeventTb->log_action = $laction;
		$LogeventTb->log_page = $lpage;
		$LogeventTb->log_cause = $lcause;
		$LogeventTb->log_date = date('Y-m-d H:i:s');
		$LogeventTb->log_data = $ldata;
		$LogeventTb->log_ip = $brachcode;
		$LogeventTb->log_remark = $lremark;
		$LogeventTb->log_status = 1;

		if ($LogeventTb->save()) {
			$msg = "add data is success";
		} else {
			$msg = $LogeventTb->getErrors();
		}

		return $msg;
	}

	public function sendmail3($ema, $accno, $brnno, $cropname)
	{ //use for production

		$txtsubject = "แจ้งผลการขี้นทะเบียนนายจ้างประกันสังคม";
		$txtbody = "&nbsp;&nbsp;&nbsp;สำนักงานประกันสังคม ได้กำหนดเลขที่บัญชีนายจ้างให้ท่านคือ {$accno} สถานประกอบการชื่อ  {$cropname} เมื่อท่านมีการจ้างลูกจ้าง ให้ท่านใช้เลขที่บัญชีนายจ้างตามที่แจ้ง และ ติดต่อขึ้นทะเบียนลูกจ้าง/ผู้ประกันตน ภายใน 30 วันนับจากวันที่เริ่มจ้างงาน  ที่ สปส. ณ ที่ตั้ง สำนักงานใหญ่ของท่าน กรณีมีข้อสงสัยสอบถามรายละเอียดได้ที่สายด่วน 1506 <br>&nbsp;&nbsp;&nbsp;หากยังไม่ดำเนินกิจการหรือไม่มีลูกจ้าง ขอความร่วมมือท่านตอบแบบสำรวจอิเล็กทรอนิกส์ ตามข้อมูลจริง เนื่องจากข้อมูลดังกล่าวจะถูกนำมาใช้ในการวิเคราะห์เพื่อประโยชน์ต่อการคุ้มครองสิทธิที่พึงมีพึงได้ตามกฎหมาย และขอขอบคุณมา ณ โอกาสนี้ : <br> CLICK เพื่อตอบแบบสำรวจ (<a href='https://www.sso.go.th/etp/addressform2.php?emadd={$ema}&et=2'>ตอบแบบสอบถาม อิเล็กทรอนิกส์</a>)";
		$txtsendform = "สำนักงานประกันสังคม";

		$mailer = new PHPMailer();
		$mailer->IsSMTP(); // $mailer->Mailer = "mail"; ////$mailer->IsSMTP();
		$mailer->Host = 'smtp.sso.go.th'; //'smtp.gmail.com'; //'smtp.sso.go.th'
		$mailer->Port = 25; //587; //25
		$mailer->SMTPAuth = FALSE;
		$mailer->From = 'no-reply@sso.go.th'; //'day.jakkrit@gmail.com'; //'no-reply@sso.go.th';
		$mailer->IsHTML(true);
		$mailer->FromName = iconv('utf-8', 'tis-620', $txtsendform);
		$mailer->Body = iconv('utf-8', 'tis-620', $txtbody);
		$mailer->Subject = iconv('utf-8', 'tis-620', $txtsubject);
		$mailer->AddAddress($ema); //$ema


		if (!$mailer->Send()) {
			//echo "Message was not sent<br/ >";
			//echo "Mailer Error: " . $mailer->ErrorInfo;
			return false;
		} else {
			//****** insert data ****************************************
			$Sendemailcorp = new Sendemailcorp();

			$Sendemailcorp->crop_name = $accno;
			$Sendemailcorp->crop_email = $ema;
			$Sendemailcorp->access_code = $brnno;
			$Sendemailcorp->status = 3;
			$Sendemailcorp->created = date('Y-m-d H:i:s');
			$Sendemailcorp->modified = date('Y-m-d H:i:s');

			if ($Sendemailcorp->save()) {
				//echo CJSON::encode(array('status' => 'success'));
				//echo preg_replace("/\xEF\xBB\xBF/", "","yes <br>");
				//echo "Message has been sent";
				return true;
			} else {
				//echo CJSON::encode(array('status' => 'error'));
				//echo CJSON::encode($Users->getErrors());
				//echo preg_replace("/\xEF\xBB\xBF/", "","no <br>");
				return false;
			}
			//*********************************************************
		} //if

	} //function



	public function instetp($regisnum)
	{
		//ดึงข้อมูลที่ต้องการจาก Database***************************************************
		//ค้นหาข้อมูลจาก Crop_info_temp กับ bran_temp
		$model = CropinfoTmpTb::model()->findAllByAttributes(array('registernumber' => $regisnum));
		$countmedel = count($model);

		//echo "{$model->registername}";

		if ($countmedel == 1) {
			foreach ($model as $rows) {
				$registername = $rows->registername;
				$registernumber = $rows->registernumber;
				$acc_no = $rows->acc_no;
				$acc_bran = $rows->acc_bran;
				$registerdate = $rows->registerdate;
				$crop_remark = $rows->crop_remark;
				$crop_status = $rows->crop_status;

				//** send email *******
				$qemail = BranchTmpTb::model()->findByAttributes(array('registernumber' => $registernumber));
				$corpemail = $qemail->email;
				$statemail = $qemail->brch_status;
				$brnremark = $qemail->brch_remark; //ดึงขอมูลสาขาเพิ่มเพื่อส่งให้ etp
			} //if
		} //for

		//echo "{$registername}, {$brnremark}";

		//exit;

		$oel_registernumber = $registernumber;
		$oel_accno = $acc_no;
		$oel_registername = $registername;
		$oel_emailaddress = $corpemail;
		$oel_registerdate = $registerdate;
		$oel_emailtype = "1";
		$oel_createby = "wpd";
		$oel_createdate = date('Y-m-d H:i:s');
		$oel_updateby = "wpd";
		$oel_updatedate = date('Y-m-d H:i:s');
		$oel_remark = $brnremark;
		$oel_status = $crop_remark;
		//*************************************************************************

		//call service etp http://127.0.0.1/etp/otp_email_tb/insertemail.php *******
		// Set the POST data
		$postdata = json_encode(
			array(
				'oel_registernumber' => $oel_registernumber,
				'oel_accno' => $oel_accno,
				'oel_registername' => $oel_registername,
				'oel_emailaddress' => $oel_emailaddress,
				'oel_registerdate' => $oel_registerdate,
				'oel_emailtype' => $oel_emailtype,
				'oel_createby' => $oel_createby,
				'oel_createdate' => $oel_createdate,
				'oel_updateby' => $oel_updateby,
				'oel_updatedate' => $oel_updatedate,
				'oel_updateby' => $oel_updateby,
				'oel_updatedate' => $oel_updatedate,
				'oel_remark' => $oel_remark,
				'oel_status' => $oel_status
			)
		);

		//return $postdata;
		//echo $postdata;exit;

		//$url = Yii::app()->params['servicepath'] . '/wpdapi/api/cropinfo_temp/create.php';
		$url = 'https://c2wpdwspro001/etp/otp_email_tb/insertemail.php';
		//'https://www.sso.go.th/etp/otp_email_tb/insertemail.php';

		$opts = array(
			"http" => array(
				"method" => "POST",
				"header" =>
				"Content-Type: application/xml; charset=utf-8;\r\n" .
					"Connection: close\r\n",
				"ignore_errors" => true,
				"timeout" => (float)30.0,
				"content" => $postdata,
				//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$content = file_get_contents($url, false, stream_context_create($opts)); //เรียกใช้ services

		//return $content;

		$content_jsdc = json_decode($content);

		$msg = $content_jsdc->message;

		return $msg;
		//echo "{$msg}";

		//**************************************************************************
	} //function



	public function findaccno($filenamep, $accno, $registernumber, $registername)
	{

		ini_set("memory_limit", "1024M");

		$file = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/out/" . $filenamep;

		$searchfor = $registernumber;

		$file_content = file_get_contents($file);

		$content_before_string = strstr($file_content, $searchfor, true);

		if (false !== $content_before_string) {
			$line = count(explode(PHP_EOL, $content_before_string));
			$lines = file($file); //file in to an array
			$accnosp = explode("|", $lines[$line - 1]);
			$this->accnosapains = "{$accnosp[3]}";
			return true;
		} else {
			$this->accnosapains = "-";
			return false;
		}

		/*
		$data = file_get_contents($file);
		
		$data   = explode("\n", $data); 
		$ln = 0;
		for ($line = 0; $line < count($data); $line++) { 
		  if (strpos($data[$line], $searchfor) >= 0) { 
			  //die("String $string found at line number: $line"); 
			  $this->accnosapains = "{$line},{$ln}";
			  return true;
			  $ln += 1;
		  }else{
			  $this->accnosapains = '0000000000000';
			  return false;
		  }
		} 
		*/

		/*if($contents contains $searchfor){
			
		}*/
		/*if (strpos($contents, $searchfor) !== false) {
			 $this->accnosapains = '0000000000000';
			 return true;
		}else{
			$this->accnosapains = '0000000000000';
			 return false;
		}*/

		/*$pattern = preg_quote($searchfor, '/');
		$pattern = "/^.*$pattern.*\$/m";
		
		if(preg_match_all($pattern, $contents, $matches)){//preg_match_all($pattern, $contents, $matches)
		   //echo "Found matches sso accno = ";
		   $strall = implode("\n",$matches[0]);
		   $accnosp = explode("|", $strall);
		   //echo $accno[0];
		   if($filenamep=='BBMFT8000.txt'){
		   	 $this->accnosapains = $accnosp[0];
		   }else{
			 $this->accnosapains = $accnosp[3];   
		   }
		   
		   return true;
		}else{
		   //echo "No matches found";
		   //return false;
		}*/
	} //function


	function find_line_number_by_string($filename, $search, $case_sensitive = false)
	{

		$file = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/out/" . $filename;

		$line_number = '';
		if ($file_handler = fopen($file, "r")) {
			$i = 0;
			while ($line = fgets($file_handler)) {
				$i++;
				//case sensitive is false by default
				if ($case_sensitive == false) {
					$search = strtolower($search);  //convert file and search string
					$line = strtolower($line); 		//to lowercase
				}
				//find the string and store it in an array
				if (strpos($line, $search) !== false) {
					$line_number .=  $i . ",";
				}
			}
			fclose($file_handler);
		} else {
			return "File not exists, Please check the file path or filename";
		}
		//if no match found
		if (count($line_number)) {
			return substr($line_number, 0, -1);
		} else {
			return "No match found";
		}
	}
}//class
