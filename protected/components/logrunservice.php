<?php
class logrunservice extends CApplicationComponent 
{
	 public $lrs_id;
	 public $lrs_servicename;
	 public $lrs_rundate;
	 public $lrs_resultrecord;
	 public $lrs_createby;
	 public $lrs_created;
	 public $lrs_updateby;
	 public $lrs_modified;
	 public $lrs_remark;
	 public $lrs_status;
	 
	 public function checkexists(){
		$postdata = json_encode(
			array(
				'lrs_servicename' => $this->lrs_servicename,
				'lrs_remark' => $this->lrs_remark
			)
		);
		
		//return $postdata;
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/logrunservice/checkexists.php';
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
			//echo "have data";
		}else{
			return false;
			//echo "no data";
		}
		 
	 }//checkexists()
	 
	 
	  public function checkexists2(){
		  $postdata = json_encode(
			  array(
				  'lrs_servicename' => $this->lrs_servicename,
				  'lrs_remark' => $this->lrs_remark
			  )
		  );
		  
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/logrunservice/checkexists2.php';
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
		return $content;
		  
	  }
	 
	 public function create(){
		$postdata = json_encode(
			array(
				'lrs_servicename' => $this->lrs_servicename,
				'lrs_rundate' => $this->lrs_rundate,
				'lrs_resultrecord' => $this->lrs_resultrecord,
				'lrs_createby' => $this->lrs_createby,
				'lrs_created' => $this->lrs_created,
				'lrs_updateby' => $this->lrs_updateby,
				'lrs_modified' => $this->lrs_modified,
				'lrs_remark' => $this->lrs_remark,
				'lrs_status' => $this->lrs_status
			)
		);
		
		//return $postdata;
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/logrunservice/create.php';
		
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
	 
	 
}//logrunservice
?>