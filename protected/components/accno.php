<?php
class accnumber extends CApplicationComponent 
{
	 public $acc_id;
	 public $acc_no;
	 public $acc_bran;
	 public $acc_regis_no;
	 public $acc_active_flag;
	 public $acc_using_date;
	 public $acc_createby;
	 public $acc_created;
	 public $acc_updateby;
	 public $acc_modified;
	 public $acc_remark;
	 public $acc_status;
	 
	 public function updateflag(){
		$postdata = json_encode(
			array(
				
				'acc_no' => $this->acc_no,
				'acc_regis_no' => $this->acc_regis_no,
				'acc_active_flag' => $this->acc_active_flag,
				'acc_updateby' => $this->acc_updateby,
				'acc_modified' => $this->acc_modified,
				'acc_remark' => $this->acc_remark,
				'acc_status' => $this->acc_status
			)
		);
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/accnumber/updateflag.php';
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
		
		//return $content; 
		
		$content_jsdc = json_decode($content);
		$msg = $content_jsdc->message; 
		return $msg;
		
		 
	 }//updateflag
	
}//class accnumbertb
?>