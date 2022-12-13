<?php

class branch_tmp extends CApplicationComponent
{
	//object properties
	public $brch_id;
	public $crop_id;
	public $registernumber; 
	public $tsic; 
	public $corptype; 
	public $ordernumber; 
	public $name; 
	public $houseid; 
	public $housenumber; 
	public $buildingname; 
	public $buildingnumber; 
	public $buildingfloor;
	public $village; 
	public $moo; 
	public $soi; 
	public $road; 
	public $tumbon; 
	public $tumboncode; 
	public $ampur; 
	public $ampurcode; 
	public $province; 
	public $provincecode; 
	public $zipcode; 
	public $phonenumber; 
	public $faxnumber;
	public $email; 
	public $brch_remark; 
	public $brch_createby; 
	public $brch_createtime; 
	public $brch_updateby; 
	public $brch_updatetime; 
	public $brch_status; 
	
	public function create(){
		$postdata = json_encode(
			array(
				'crop_id' => $this->crop_id,
				'registernumber' => $this->registernumber, 
				'tsic' => $this->tsic, 
				'corptype' => $this->corptype, 
				'ordernumber' => $this->ordernumber, 
				'name' => $this->name, 
				'houseid' => $this->houseid, 
				'housenumber' => $this->housenumber, 
				'buildingname' => $this->buildingname, 
				'buildingnumber' => $this->buildingnumber, 
				'buildingfloor' => $this->buildingfloor,
				'village' => $this->village, 
				'moo' => $this->moo, 
				'soi' => $this->soi, 
				'road' => $this->road, 
				'tumbon' => $this->tumbon, 
				'tumboncode' => $this->tumboncode, 
				'ampur' => $this->ampur, 
				'ampurcode' => $this->ampurcode, 
				'province' => $this->province, 
				'provincecode' => $this->provincecode, 
				'zipcode' => $this->zipcode,
				'phonenumber' => $this->phonenumber, 
				'faxnumber' => $this->faxnumber,
				'email' => $this->email, 
				'brch_remark' => $this->brch_remark, 
				'brch_createby' => $this->brch_createby, 
				'brch_createtime' => $this->brch_createtime, 
				'brch_updateby' => $this->brch_updateby, 
				'brch_updatetime' => $this->brch_updatetime, 
				'brch_status' => $this->brch_status
			)
		);
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/branch_temp/create.php';
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
		
	}//public function create(){
		
	public function branchexists(){
		$postdata = json_encode(
			array(
				'crop_id' => $this->crop_id,
				'registernumber' => $this->registernumber,
			  	'tsic' =>$this->tsic,
			    'corptype' =>$this->corptype,
				'ordernumber' => $this->ordernumber, 
				'name' => $this->name,
				'housenumber' =>$this->housenumber
			)
		);
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/branch_temp/branchexists.php';
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
		
		//return $msg;
		
		if($msg=='y'){
			return true;
		}else{
			return false;
		}
		
	}//public function committeeexists(){
		
}

?>