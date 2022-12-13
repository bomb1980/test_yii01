<?php
class usergroup extends CApplicationComponent 
{
 public $ug_id;
 public $ug_name;
 public $ug_createby;
 public $ug_created;
 public $ug_updateby;
 public $ug_modified;
 public $ug_remark;
 public $ug_status;
 
 public function create(){
	 $postdata = json_encode(
		  array(
			  'ug_name' => $this->ug_name,
			  'ug_createby' => $this->ug_createby,
			  'ug_created' => $this->ug_created,
			  'ug_updateby' => $this->ug_updateby,
			  'ug_modified' => $this->ug_modified,
			  'ug_remark' => $this->ug_remark,
			  'ug_status' => $this->ug_status
		  )
	  );
	  
	  $url = Yii::app()->params['servicepath'] . '/wpdapi/api/usergroup/create.php';
	  
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
 
 public function update(){
	 
 }//update()
 
 public function delete(){
	 
 }//delete()
 
}//usergroup
?>