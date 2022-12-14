<?php
class WpdApi extends CApplicationComponent
{

	public $dbnameselect;
	public $tablenameselect;

	public $corpinfo_temp_params = array();

	// object properties
	public $crop_id; // INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'ลำดับ' ,
	public $registernumber; // VARCHAR( 13 ) NOT NULL COMMENT 'เลขทะเบียนนิติบุคคล' ,
	public $registername; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อที่ใช้จดทะเบียน' ,
	public $acc_no; // VARCHAR( 10 ) NOT NULL COMMENT 'เลขที่บัญชี' ,
	public $acc_bran; // VARCHAR( 6 ) NOT NULL COMMENT 'สาขา' ,
	public $tsic; // VARCHAR( 5 ) NOT NULL COMMENT 'รหัส tsic' ,
	public $tsicname; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อ tsic' ,
	public $corptype; // VARCHAR( 1 ) NOT NULL COMMENT 'รหัสประเภทธุรกิจ' ,
	public $corptypename; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อประเภท' ,
	public $registerdate; // DATETIME NOT NULL COMMENT 'วันที่จดทะเบียน' ,
	public $updateddate; // DATETIME NOT NULL COMMENT 'วันที่มีการแก้ไขข้อมูลล่าสุด' ,
	public $updateentry; // VARCHAR( 1 ) NOT NULL COMMENT 'มีการแก้ไขข้อมูลหลังจากลงทะเบียน' ,
	public $accountingdate; // VARCHAR( 4 ) NOT NULL COMMENT 'รอบปีบัญชี' ,
	public $authorizedcapital; // Double(20 ,2) NOT NULL COMMENT 'ทุนจดทะเบียน' ,
	public $statuscode; // VARCHAR( 1 ) NOT NULL COMMENT 'สถานะนิติบุคคล' ,
	public $cpower; // VARCHAR( 5000 ) NOT NULL COMMENT 'จำนวนหรือชื่อกรรมการที่ลงชื่อผูกพัน' ,
	public $crop_remark; // TEXT NULL COMMENT 'หมายเหตุ' ,
	public $crop_createby; // VARCHAR( 100 ) NOT NULL COMMENT 'สร้างโดย' ,
	public $crop_createtime; // DATETIME NOT NULL COMMENT 'วันที่สร้าง' ,
	public $crop_updateby; // VARCHAR( 100 ) NOT NULL COMMENT 'แก้ไขโดย' ,
	public $crop_updatetime; // DATETIME NOT NULL COMMENT 'วันที่แก้ไข' ,
	public $crop_status; // TINYINT( 1 ) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ' ,

	public function getVar1()
	{
		return $this->registernumber; //ใช้งาน porperties ใน class นี้
	}

	public function getVersion()
	{
		$mystring = ' Day Jakkrit CMyClass v.0.0.1 ';
		return $mystring;
	}

	public function create_corpinfo_temp()
	{
		// Set the POST data
		$postdata = json_encode(
			array(
				'registernumber' => $this->registernumber,
				'registername' => 'อาภรณ์ โพรเกรสชั่น จำกัด',
				'acc_no' => '1234567890',
				'acc_bran' => '000000',
				'tsic' => '10802',
				'tsicname' => 'การผลิตอาหารสำเร็จรูปสำหรับเลี้ยงปศุสัตว์ในฟาร์ม',
				'corptype' => '5',
				'corptypename' => 'บริษัทจำกัด',
				'registerdate' => '2019-04-29 00:00:00',
				'updateddate' => '2019-04-29 00:00:00',
				'updateentry' => '-',
				'accountingdate' => '2804',
				'authorizedcapital' => '1000000',
				'statuscode' => '1',
				'cpower' => 'กรรมการหนึ่งคนลงลายมือชื่อ และประทับตราสำคัญของบริษัท',
				'crop_remark' => '-',
				'crop_createby' => 'admin',
				'crop_createtime' => '2019-04-29 00:00:00',
				'crop_updateby' => 'admin',
				'crop_updatetime' => '2019-04-29 00:00:00',
				'crop_status' => '1'
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


		$url = 'http://localhost/wpdapi/api/cropinfo_temp/create.php';
		//https://wpd.sso.go.th/

		$content = file_get_contents($url, false, stream_context_create($opts));

		//echo "<pre>";
		//	echo $content;
		//echo "</pre> <br>";

		$content2 = json_decode($content);

		$thismsg = $content2->message;

		//echo "{$thismsg}, <br>";

		return $thismsg;
	}
}
