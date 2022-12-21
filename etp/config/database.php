<?php
class Database{

	//$con=mysqli_connect('wpddb.sso.loc','appwpd','App@wpd','etpdb'); //uat
	//$con=mysqli_connect('C2WPDDBPRO001','appwpd','App@wpd','etpdb'); //prd
 
    // specify your own database credentials
    private $host = "C2WPDDBPRO001"; //localhost wpddb.sso.loc
    private $db_name ="etpdb";
    private $username = "appwpd"; //wpdusr //root
    private $password = "APP@wpd"; //"" CDEVwpddb@2019 //""
    public $conn;
    public $con1;
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
        
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8"); 
           $this->con1 = "ok";
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage(); 
           $this->con1 = "error";
        }
        //return $this->con1;
        return $this->conn;
        
    }
}
?>