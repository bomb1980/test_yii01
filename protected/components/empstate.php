<?php
class empstate extends CApplicationComponent 
{
	 public $ems_id;
 	 public $ems_registernumber;
	 public $ems_accno;
	 public $ems_accbran;
	 public $ems_email;
	 public $ems_startdate;
	 public $ems_createby;
	 public $ems_created;
	 public $ems_updateby;
	 public $ems_modified;
	 public $ems_remark;
	 public $ems_status;
	 
	 public function checkexists(){
		$postdata = json_encode(
			array(
				'ems_registernumber' => $this->ems_registernumber,
				'ems_accno' => $this->ems_accno,
				'ems_accbran' => $this->ems_accbran
			)
		);
		
		//return $postdata;
		
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/empstate/checkexists.php';
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
		
		//return $content;

		$msg = $content_jsdc->message; 
		
		//return $msg;
		
		if($msg=='y'){
			return true;
		}else{
			return false;
		}
		
	 }//checkexists()
	 
	 public function create(){
		 $postdata = json_encode(
			array(
				'ems_registernumber' => $this->ems_registernumber,
				'ems_accno' => $this->ems_accno,
				'ems_accbran' => $this->ems_accbran,
				'ems_email' => $this->ems_email,
				'ems_startdate' => $this->ems_startdate,
				'ems_createby' => $this->ems_createby,
				'ems_created' => $this->ems_created,
				'ems_updateby' => $this->ems_updateby,
				'ems_modified' => $this->ems_modified,
				'ems_remark' => $this->ems_remark,
				'ems_status' => $this->ems_status
			)
		);
		
		//return $postdata;
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/empstate/create.php';
		
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
		
	 }//create()
}
?>