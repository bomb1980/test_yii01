<?php
class committee_tmp extends CApplicationComponent 
{
	//object properties
	  public $cmit_id; // INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'ลำดับเจ้าของกิจการ' , ";
	  public $crop_id; // INT NOT NULL COMMENT 'ลำดับสถานประกอบการ' , ";
	  public $registernumber; // VARCHAR( 13 ) NOT NULL COMMENT 'เลขทะเบียนนิติบุคคล' , ";
	  public $tsic; // VARCHAR( 5 ) NOT NULL COMMENT 'รหัส tsic' , ";
	  public $corptype; // VARCHAR( 1 ) NOT NULL COMMENT 'รหัสประเภทธุรกิจ' , ";
	  public $committeetype; // VARCHAR( 1 ) NOT NULL COMMENT 'รหัสประเภทกรรมการ K=กรรมการผู้เป็นหุ้นส่วน,L=หุ้นส่วนผู้จัดการ' , ";
	  public $ordernumber; // INT NOT NULL COMMENT 'ลำดับ' , ";
	  public $typeno; // VARCHAR( 1 ) NOT NULL COMMENT 'เลขที่ประเภท' , ";
	  public $identity; // VARCHAR( 13 ) NOT NULL COMMENT 'เลขบัตรประจำตัวประชาชน' , ";
	  public $birthday; // DATETIME NOT NULL COMMENT 'วันเดือนปีเกิด' , ";
	  public $title; // VARCHAR( 50 ) NOT NULL COMMENT 'คำนำหน้าชื่อ' , ";
	  public $firstname; // VARCHAR( 500 ) NOT NULL COMMENT 'ชื่อกรรมการ' , ";
	  public $lastname; // VARCHAR( 500 ) NOT NULL COMMENT 'นามสกุลกรรมการ' , ";
	  public $englishtitle; // VARCHAR( 500 ) NOT NULL COMMENT 'คำนำหน้าชื่อ (อังกฤษ)' , ";
	  public $englishfirstname12; // VARCHAR( 500 ) NOT NULL COMMENT 'ชื่อกรรมการ (อังกฤษ)' , ";
	  public $englishlastname; // VARCHAR( 500 ) NOT NULL COMMENT 'นามสกุลกรรมการ (อังกฤษ)' , ";
	  public $nation; // VARCHAR( 2 ) NOT NULL COMMENT 'สัญชาติการรมการ' , ";
	  public $cmit_remark; // TEXT NULL COMMENT 'หมายเหตุ' , ";
	  public $cmit_createby; // VARCHAR( 100 ) NOT NULL COMMENT 'สร้างโดย' , ";
	  public $cmit_createtime; // DATETIME NOT NULL COMMENT 'วันที่สร้าง' , ";
	  public $cmit_updateby; // VARCHAR( 100 ) NOT NULL COMMENT 'แก้ไขโดย' , ";
	  public $cmit_updatetime; // DATETIME NOT NULL COMMENT 'วันที่แก้ไข' , ";
	  public $cmit_status; // TINYINT( 1 ) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ' , ";
	  
	 
	
	public function create(){
		$postdata = json_encode(
			array(
				'crop_id' => $this->crop_id, 
				'registernumber' => $this->registernumber,
				'tsic' => $this->tsic, 
				'corptype' => $this->corptype,
				'committeetype' => $this->committeetype,
				'ordernumber' => $this->ordernumber, 
				'typeno' => $this->typeno,
				'identity' => $this->identity, 
				'birthday' => $this->birthday,
				'title' => $this->title, 
				'firstname' => $this->firstname,
				'lastname' => $this->lastname,
				'englishtitle' => $this->englishtitle,
				'englishfirstname12' => $this->englishfirstname12, 
				'englishlastname' => $this->englishlastname, 
				'nation' => $this->nation, 
				'cmit_remark' => $this->cmit_remark,
				'cmit_createby' => $this->cmit_createby, 
				'cmit_createtime' => $this->cmit_createtime, 
				'cmit_updateby' => $this->cmit_updateby, 
				'cmit_updatetime' => $this->cmit_updatetime, 
				'cmit_status' => $this->cmit_status
			)
		);
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/committee_temp/create.php';
		$opts = array(
			"http" => array (
				"method" => "POST",
				 "header" =>
					"Content-Type: application/xml; charset=utf-8;\r\n".
					"Connection: close\r\n",
					"ignore_errors" => true,
					"timeout" => (float)30.0,
					"content" => $postdata,
					//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		
		$content = file_get_contents($url, false, stream_context_create($opts));
		$content_jsdc = json_decode($content);
		
		$msg = $content_jsdc->message; 
		
		return $msg;
		
	}//public function create(){
		
	public function committeeexists(){
		$postdata = json_encode(
			array(
				'crop_id' => $this->crop_id,
				'registernumber' => $this->registernumber,
				'committeetype' => $this->committeetype,
				'ordernumber' => $this->ordernumber,
				'identity' => $this->identity
			)
		);
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/committee_temp/committeeexists.php';
		$opts = array(
			"http" => array (
				"method" => "POST",
				 "header" =>
					"Content-Type: application/xml; charset=utf-8;\r\n".
					"Connection: close\r\n",
					"ignore_errors" => true,
					"timeout" => (float)30.0,
					"content" => $postdata,
					//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$content = file_get_contents($url, false, stream_context_create($opts));
		$content_jsdc = json_decode($content);

		$msg = $content_jsdc->message; 
		
		//return $msg;
		
		if($msg=='y'){
			return true;
		}else{
			return false;
		}
		
		
	}//public function committeeexists(){
	
}
?>