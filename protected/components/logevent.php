<?php
class logevent extends CApplicationComponent
{

	public $accnosapains;

	

	public function instetp($regisnum = NULL, $crop_id = NULL, $rows = array(), $new_version = false)
	{

		if (!empty($rows)) {

			$registername = $rows['registername'];
			$registernumber = $rows['registernumber'];
			$acc_no = $rows['acc_no'];
			$registerdate = $rows['registerdate'];
			$crop_remark = $rows['crop_remark'];
			$corpemail = $rows['email'];
			$brnremark = $rows['brch_remark'];

			$etpdata = OtpEmailTb::getDatas($registernumber);
			
			if ($etpdata) {
				return true;
			} else {

				$otp_email_tb = new OtpEmailTb();
				$otp_email_tb->oel_registernumber = $rows['registernumber']; //varchar(50) 
				$otp_email_tb->oel_accno = $rows['acc_no']; //varchar(50) 
				$otp_email_tb->oel_registername = $rows['registername']; //varchar(500) 
				$otp_email_tb->oel_emailaddress = $rows['email']; //varchar(200) 
				$otp_email_tb->oel_registerdate = $rows['registerdate']; //datetime 
				$otp_email_tb->oel_emailtype = 1; //varchar(10) 
				$otp_email_tb->oel_createby = 'wpd'; //varchar(150) 
				$otp_email_tb->oel_updateby = 'wpd'; //varchar(150) 
				$otp_email_tb->oel_remark = $rows['brch_remark']; //text 
				$otp_email_tb->oel_status = $rows['crop_remark']; //varchar(10)
				$otp_email_tb->oel_createdate = date('Y-m-d H:i:s'); //datetime 
				$otp_email_tb->oel_updatedate = date('Y-m-d H:i:s'); //datetime
				if( $otp_email_tb->save() ) {
					return true;

				}

			}

			return false;
		} else {

			if (!empty($crop_id)) {

				$model = CropinfoTmpTb::model()->findAllByAttributes(array('crop_id' => $crop_id));
			} else {

				$model = CropinfoTmpTb::model()->findAllByAttributes(array('registernumber' => $regisnum));
			}

			$registername = NULL;
			$registernumber = NULL;
			$acc_no = NULL;
			$registerdate = NULL;
			$crop_remark = NULL;
			$corpemail = NULL;
			$brnremark = NULL;

			foreach ($model as $rows) {
				$registername = $rows->registername;
				$registernumber = $rows->registernumber;
				$acc_no = $rows->acc_no;
				$registerdate = $rows->registerdate;
				$crop_remark = $rows->crop_remark;
				$getFirstBranch = BranchTmpTb::getFirstBranch($rows->crop_id);

				foreach ($getFirstBranch as $ka => $va) {

					$corpemail = $va['email'];
					
					$brnremark = $va['brch_remark'];
				}
			}
		}

		$postdata = json_encode(
			array(
				'oel_registernumber' => $registernumber,
				'oel_accno' => $acc_no,
				'oel_registername' => $registername,
				'oel_emailaddress' => $corpemail,
				'oel_registerdate' => $registerdate,
				'oel_emailtype' => 1,
				'oel_createby' => Yii::app()->user->username,
				'oel_createdate' => date('Y-m-d H:i:s'),
				'oel_updateby' => Yii::app()->user->username,
				'oel_updatedate' => date('Y-m-d H:i:s'),
				'oel_remark' => $brnremark,
				'oel_status' => $crop_remark
			)
		);

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

		// $url = 'https://c2wpdwspro001/etp/otp_email_tb/insertemail.php';
		//'https://www.sso.go.th/etp/otp_email_tb/insertemail.php';
		$url = Yii::app()->params['servicepath'] . '/otp_email_tb/insertemail.php';

		$content = file_get_contents($url, false, stream_context_create($opts)); //เรียกใช้ services

		$content_jsdc = json_decode($content);

		if (isset($content_jsdc->message)) {

			return $content_jsdc->message;
		}

		return false;
	}

	public function sendmail($ema, $accno, $brnno, $cropname, $txtsubject = NULL, $txtbody = NULL, $txtsendform = NULL)
	{
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

			$ema = 'bombbomb1980@gmail.com';
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
			// if (!$mailer->Send()) {

			// 	return false;
			// }
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
			if (!$mailer->Send()) {

				return false;
			}
		}

		$Sendemailcorp = new Sendemailcorp();
		$Sendemailcorp->crop_name = $accno;
		$Sendemailcorp->crop_email = $ema;
		$Sendemailcorp->access_code = $brnno;
		$Sendemailcorp->status = 2;
		$Sendemailcorp->created = date('Y-m-d H:i:s');
		$Sendemailcorp->modified = date('Y-m-d H:i:s');

		if ($Sendemailcorp->save()) {

			return true;
		}

		return false;
	}

	public function sendmail3($ema, $accno, $brnno, $cropname)
	{ //use for production

		$txtsubject = "แจ้งผลการขี้นทะเบียนนายจ้างประกันสังคม";
		$txtbody = "&nbsp;&nbsp;&nbsp;สำนักงานประกันสังคม ได้กำหนดเลขที่บัญชีนายจ้างให้ท่านคือ {$accno} สถานประกอบการชื่อ  {$cropname} เมื่อท่านมีการจ้างลูกจ้าง ให้ท่านใช้เลขที่บัญชีนายจ้างตามที่แจ้ง และ ติดต่อขึ้นทะเบียนลูกจ้าง/ผู้ประกันตน ภายใน 30 วันนับจากวันที่เริ่มจ้างงาน  ที่ สปส. ณ ที่ตั้ง สำนักงานใหญ่ของท่าน กรณีมีข้อสงสัยสอบถามรายละเอียดได้ที่สายด่วน 1506 <br>&nbsp;&nbsp;&nbsp;หากยังไม่ดำเนินกิจการหรือไม่มีลูกจ้าง ขอความร่วมมือท่านตอบแบบสำรวจอิเล็กทรอนิกส์ ตามข้อมูลจริง เนื่องจากข้อมูลดังกล่าวจะถูกนำมาใช้ในการวิเคราะห์เพื่อประโยชน์ต่อการคุ้มครองสิทธิที่พึงมีพึงได้ตามกฎหมาย และขอขอบคุณมา ณ โอกาสนี้ : <br> CLICK เพื่อตอบแบบสำรวจ (<a href='https://www.sso.go.th/etp/addressform2.php?emadd={$ema}&et=2'>ตอบแบบสอบถาม อิเล็กทรอนิกส์</a>)";
		$txtsendform = "สำนักงานประกันสังคม";

		if (Yii::app()->params['testJob']) {

			$ema = 'bombbomb1980@gmail.com';
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
			// if (!$mailer->Send()) {

			// 	return false;
			// }
		}
		else {
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
				 
				return false;
			} 
		}

		$Sendemailcorp = new Sendemailcorp();
		$Sendemailcorp->crop_name = $accno;
		$Sendemailcorp->crop_email = $ema;
		$Sendemailcorp->access_code = $brnno;
		$Sendemailcorp->status = 3;
		$Sendemailcorp->created = date('Y-m-d H:i:s');
		$Sendemailcorp->modified = date('Y-m-d H:i:s');

		if ($Sendemailcorp->save()) {
			
			return true;
		} 

		return false;
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
