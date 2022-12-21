<?php
class Sftpserver{

	private $host = "172.16.11.13"; //172.16.11.13
	private $port = 22; 
	private $username = "ssowpd";  //ssowpd , wpdusr
	private $pub_key =  "/opt/share/etc/ssh2/wpd_rsa_id.pub";
	private $pri_key = "/opt/share/etc/ssh2/wpd_rsa_id";
	private $passphrase = "vi6Iu"; 
	public $conn;
	
	public $localpathf = "/opt/share/html/wpdtextfile/"; //"/usr/share/nginx/html/ssowpd/assets/exportfile/";  //
	public $remotepathf = "/in/";
	
	public function getConnectionsftp(){
	
		$this->conn = null;
		$this->conn = ssh2_connect($this->host, $this->port); 
		if(ssh2_auth_pubkey_file($this->conn, $this->username, $this->pub_key, $this->pri_key, $this->passphrase)) {
			//echo "Authentication succeeded. <br>"; 
			return true;
		}else{
			//echo "Authentication failed. <br>"; 
			return false;
		}
		//return $this->conn;
	}
}
?>