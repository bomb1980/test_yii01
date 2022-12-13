<?php
class gentextfile extends CApplicationComponent 
{
	//object properties
	public $gtf_id;
	public $gtf_name;
	public $gtf_path;
	public $gtf_countgen;
	public $gtf_statusgen;
	public $gtf_statusupload;
	public $gtf_createby;
	public $gtf_created;
	public $gtf_updateby;
	public $gtf_modified;
	public $gtf_remark;
	public $gtf_status;
	
	
	//************* local config *********************************************
	/*private $host = "172.16.19.36"; //172.16.11.13
	private $port = 22; 
	private $username = "wpdusr";  //ssowpd , wpdusr
	private $userssossv = "ssossv01";
	private $pub_key = "C:/xampp/htdocs/wpdapi/api/uploadfile/ssh2/wpd_rsa_id.pub"; 
	private $pri_key = "C:/xampp/htdocs/wpdapi/api/uploadfile/ssh2/wpd_rsa_id";
	private $passphrase = "vi6Iu"; 
	public $conn;
	
	public $localpathf = "C:/xampp/htdocs/wpdtextfile/"; //"/usr/share/nginx/html/ssowpd/assets/exportfile/";  //
	public $remotepathf = "/home/wpdusr/uploaddir/";
	
	public $localpathd = "C:/xampp/htdocs/wpdtextfile/out/";
	public $remotepathd =  "/home/wpdusr/uploaddir/";
	
	public $localpathled = "C:/xampp/htdocs/wpdtextfile/led/";
	public $remotepathled =  "/home/wpdusr/uploaddir/";*/
	//***********************************************************************
	
	
	//************* dev config **********************************************
	/*
	private $host = "172.16.11.13"; //172.16.11.13
	private $port = 22; 
	private $username = "ssowpd";  //ssowpd , wpdusr
	private $userssossv = "ssossv01";
	private $pub_key = "/opt/share/etc/ssh2/wpd_rsa_id.pub"; 
	private $pri_key = "/opt/share/etc/ssh2/wpd_rsa_id";
	private $passphrase = "vi6Iu"; 
	public $conn;
	
	public $localpathf = "/opt/share/html/wpdtextfile/";  //
	public $remotepathf = "/in/";
	
	public $localpathd = "/opt/share/html/wpdtextfile/out/";  //
	public $remotepathd =  "/out/";
	
	public $localpathled = "/opt/share/html/wpdtextfile/led/";
	public $remotepathled =  "/out/";
	
	*/
	//************************************************************************
	
	//************* uat config **********************************************
	/*
	private $host = "172.16.11.13"; //172.16.11.13
	private $port = 22; 
	private $username = "ssowpd";  //ssowpd , wpdusr
	private $userssossv = "ssossv01";
	private $pub_key = "/opt/share/etc/ssh2/wpd_rsa_id.pub"; 
	private $pri_key = "/opt/share/etc/ssh2/wpd_rsa_id";
	private $passphrase = "vi6Iu"; 
	public $conn;
	
	public $localpathf = "/opt/share/html/wpdtextfile/";  //
	public $remotepathf = "/in/";
	
	public $localpathd = "/opt/share/html/wpdtextfile/out/";  //
	public $remotepathd =  "/out/";
	
	public $localpathled = "/opt/share/html/wpdtextfile/led/";
	public $remotepathled =  "/out/";
	*/
	//************************************************************************
	
	//********* production config ********************************************
	
	
	private $host = "172.16.11.13"; //172.16.11.13
	private $port = 22; 
	
	private $username = "ssowpd";  //ssowpd , wpdusr
	private $userssossv = "ssossv01";
	
	private $pub_key = "/opt/share/etc/ssh2/wpd_rsa_id.pub"; 
	private $pri_key = "/opt/share/etc/ssh2/wpd_rsa_id";
	private $passphrase = "vi6Iu"; 
	public $conn;
	
	private $pub_key2 = "/opt/share/etc/ssh2/wpdcore_rsa.pub"; 
	private $pri_key2 = "/opt/share/etc/ssh2/wpdcore_rsa";
	private $passphrase2 = "vi6Iu"; 
	public $conn2;
	
	
	public $localpathf = "/opt/share/html/wpdtextfile/";  //
	public $remotepathf = "/in/";
	
	public $localpathd = "/opt/share/html/wpdtextfile/out/";  //
	public $remotepathd =  "/out/";
	
	public $localpathled = "/opt/share/html/wpdtextfile/led/";
	public $remotepathled =  "/out/";
	
	//************************************************************************
	
	public function getConnectionsftp(){
	
		$this->conn = null;
		$this->conn = ssh2_connect($this->host, $this->port); 
		if(ssh2_auth_pubkey_file($this->conn, $this->username, $this->pub_key, $this->pri_key, $this->passphrase)) {
			return true;
		}else{
			return false;
		}
		//return $this->conn;
	}
	
	public function getConnectionsftpssv(){
	
		$this->conn = null;
		$this->conn = ssh2_connect($this->host, $this->port); 
		if(ssh2_auth_pubkey_file($this->conn, $this->userssossv, $this->pub_key2, $this->pri_key2, $this->passphrase2)) {
			return true;
		}else{
			return false;
		}
		//return $this->conn;
	}
	
	public function create(){
		
		$postdata = json_encode(
			array(
				'gtf_name' => $this->gtf_name,
				'gtf_path' => $this->gtf_path,
				'gtf_countgen' => $this->gtf_countgen,
				'gtf_statusgen' => $this->gtf_statusgen,
				'gtf_statusupload' => $this->gtf_statusupload,
				'gtf_createby' => $this->gtf_createby,
				'gtf_created' => $this->gtf_created,
				'gtf_updateby' => $this->gtf_updateby,
				'gtf_modified' => $this->gtf_modified,
				'gtf_remark' => $this->gtf_remark,
				'gtf_status' => $this->gtf_status
			)
		);
		
		//return $postdata;
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/gentextfile/create.php';
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
		
		/*$this->gtf_name = "my name is day jakkrit";
		$content = $this->gtf_name;
		return $content;*/
		
	}//create()
	
	public function gentest(){
		$this->gtf_name = "my name is day jakkrit";
		$content = $this->gtf_name;
		return $content;
	}
	
	public function counttodaygen(){
		$postdata = json_encode(
			array(
				'gtf_remark' => $this->gtf_remark
			)
		);
		
		//echo $postdata;
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/gentextfile/countgentextfile.php';
		
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
		$content_jdc = json_decode($content);
		$numrows = $content_jdc->numrows; 
		
		return $numrows;
		
		
	}//counttodaygen()
	
	public function uploadtf(){
		$postdata = json_encode(
			array(
				'gtf_name' => $this->gtf_name
			)
		);
		//echo $postdata;
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/uploadfile/uploadtosftp.php';
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
		$content_jdc = json_decode($content);
		$msg = $content_jdc->status; 
		return $msg;
	}
	
	
	public function uploadfiletosftp($fname){
		$host = "172.16.19.36"; //172.16.11.13
		$port = 22; 
		$username = "wpdusr";  //ssowpd , wpdusr
		$pub_key = "C:/xampp/htdocs/wpdapi/api/uploadfile/ssh2/wpd_rsa_id.pub"; 
		$pri_key = "C:/xampp/htdocs/wpdapi/api/uploadfile/ssh2/wpd_rsa_id";
		$passphrase = "vi6Iu"; 
		$conn;
	}
	
}//class gentextfile
?>
