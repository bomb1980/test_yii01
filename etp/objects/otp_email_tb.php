<?php
class otp_email_tb
{

	// database connection and table name
	private $conn;
	private $table_name = "otp_email_tb";

	// object properties
	public $oel_id;  //int(11) AI PK 
	public $oel_registernumber; //varchar(50) 
	public $oel_accno; //varchar(50) 
	public $oel_registername; //varchar(500) 
	public $oel_emailaddress; //varchar(200) 
	public $oel_otp; //varchar(10) 
	public $oel_expdatetime; //datetime 
	public $oel_registerdate; //datetime 
	public $oel_emailtype; //varchar(10) 
	public $oel_answer; //varchar(50) 
	public $oel_createby; //varchar(150) 
	public $oel_createdate; //datetime 
	public $oel_updateby; //varchar(150) 
	public $oel_updatedate; //datetime 
	public $oel_remark; //text 
	public $oel_status; //varchar(10)

	public $num;

	// constructor with $db as database connection
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// read products
	function read()
	{
		//select all query
		$query = "SELECT 
				o.oel_id,o.oel_registernumber,o.oel_accno,o.oel_registername,oel_accno,oel_registername,oel_emailaddress,
				oel_otp,oel_expdatetime,oel_registerdate,oel_emailtype,oel_answer,oel_createby,oel_createdate,
				oel_updateby,oel_updatedate,oel_remark,oel_status
			FROM " . $this->table_name . " o
			ORDER BY 
				o.oel_id DESC";

		// prepare query statement
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	function update()
	{

		// update query
		$query = "UPDATE
					" . $this->table_name . "
				SET
				 
				 oel_otp =oel_otp,//
				 oel_expdatetime =oel_expdatetime,//
				 oel_answer = oel_answer,//
				 oel_updateby = oel_updateby,//
				 oel_updatedate = oel_updatedate,//
				 oel_remark = oel_remark,//
				 oel_status = oel_status//

				WHERE
				oel_id = :oel_id";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->oel_id = htmlspecialchars(strip_tags($this->oel_id));
		$this->oel_registernumber = htmlspecialchars(strip_tags($this->oel_registernumber));
		$this->oel_accno = htmlspecialchars(strip_tags($this->oel_accno));
		$this->oel_registername = htmlspecialchars(strip_tags($this->oel_registername));
		$this->oel_emailaddress = htmlspecialchars(strip_tags($this->oel_emailaddress));
		$this->oel_otp = htmlspecialchars(strip_tags($this->oel_otp));
		$this->oel_expdatetime = htmlspecialchars(strip_tags($this->oel_expdatetime));
		$this->oel_registerdate = htmlspecialchars(strip_tags($this->oel_registerdate));
		$this->oel_answer = htmlspecialchars(strip_tags($this->oel_answer));
		$this->oel_createby = htmlspecialchars(strip_tags($this->oel_createby));
		$this->oel_createdate = htmlspecialchars(strip_tags($this->oel_createdate));
		$this->oel_updateby = htmlspecialchars(strip_tags($this->oel_updateby));
		$this->oel_updatedate = htmlspecialchars(strip_tags($this->oel_updatedate));
		$this->oel_status = htmlspecialchars(strip_tags($this->oel_status));


		// bind new values
		$stmt->bindParam(':oel_id', $this->oel_id);
		$stmt->bindParam(':oel_registernumber', $this->oel_registernumber);
		$stmt->bindParam(':oel_accno', $this->oel_accno);
		$stmt->bindParam(':oel_registername', $this->oel_registername);
		$stmt->bindParam(':oel_emailaddress', $this->oel_emailaddress);
		$stmt->bindParam(':oel_otp', $this->oel_otp);
		$stmt->bindParam(':oel_expdatetime', $this->oel_expdatetime);
		$stmt->bindParam(':oel_registerdate', $this->oel_registerdate);
		$stmt->bindParam(':oel_emailtype', $this->oel_emailtype);
		$stmt->bindParam(':oel_answer', $this->oel_answer);
		$stmt->bindParam(':oel_createby', $this->oel_createby);
		$stmt->bindParam(':oel_createdate', $this->oel_createdate);
		$stmt->bindParam(':oel_updateby', $this->oel_updateby);
		$stmt->bindParam(':oel_updatedate', $this->oel_updatedate);
		$stmt->bindParam(':oel_remark', $this->oel_remark);
		$stmt->bindParam(':oel_status', $this->oel_status);


		// execute the query
		if ($stmt->execute()) {

			return true;
		}

		return false;
	}

	function insertemail()
	{

		// query to insert record
		$query = "INSERT INTO " . $this->table_name . "
		SET
			oel_registernumber=:oel_registernumber,
			oel_accno=:oel_accno,
			oel_registername=:oel_registername,
			oel_emailaddress=:oel_emailaddress,
			oel_registerdate=:oel_registerdate,
			oel_emailtype=:oel_emailtype,
			oel_createby=:oel_createby,
			oel_createdate=:oel_createdate,
			oel_updateby=:oel_updateby,
			oel_updatedate=:oel_updatedate,
			oel_remark=:oel_remark,
			oel_status=:oel_status
		";



		// prepare query
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->oel_registernumber = htmlspecialchars(strip_tags($this->oel_registernumber));
		$this->oel_accno = htmlspecialchars(strip_tags($this->oel_accno));
		$this->oel_registername = htmlspecialchars(strip_tags($this->oel_registername));
		$this->oel_emailaddress = htmlspecialchars(strip_tags($this->oel_emailaddress));
		//$this->oel_otp=htmlspecialchars(strip_tags($this->oel_otp));
		//$this->oel_expdatetime=htmlspecialchars(strip_tags($this->oel_expdatetime));
		$this->oel_registerdate = htmlspecialchars(strip_tags($this->oel_registerdate));
		$this->oel_emailtype = htmlspecialchars(strip_tags($this->oel_emailtype));
		//$this->oel_answer=htmlspecialchars(strip_tags($this->oel_answer));
		$this->oel_createby = htmlspecialchars(strip_tags($this->oel_createby));
		$this->oel_createdate = htmlspecialchars(strip_tags($this->oel_createdate));
		$this->oel_updateby = htmlspecialchars(strip_tags($this->oel_updateby));
		$this->oel_updatedate = htmlspecialchars(strip_tags($this->oel_updatedate));
		$this->oel_remark = htmlspecialchars(strip_tags($this->oel_remark));
		$this->oel_status = htmlspecialchars(strip_tags($this->oel_status));



		// bind values
		$stmt->bindParam(":oel_registernumber", $this->oel_registernumber);
		$stmt->bindParam(":oel_accno", $this->oel_accno);
		$stmt->bindParam(":oel_registername", $this->oel_registername);
		$stmt->bindParam(":oel_emailaddress", $this->oel_emailaddress);
		//$stmt->bindParam(":oel_otp", $this->oel_otp);
		//$stmt->bindParam(":oel_expdatetime", $this->oel_expdatetime);
		$stmt->bindParam(":oel_registerdate", $this->oel_registerdate);
		$stmt->bindParam(":oel_emailtype", $this->oel_emailtype);
		//$stmt->bindParam(":oel_answer", $this->oel_answer);
		$stmt->bindParam(":oel_createby", $this->oel_createby);
		$stmt->bindParam(":oel_createdate", $this->oel_createdate);
		$stmt->bindParam(":oel_updateby", $this->oel_updateby);
		$stmt->bindParam(":oel_updatedate", $this->oel_updatedate);
		$stmt->bindParam(":oel_remark", $this->oel_remark);
		$stmt->bindParam(":oel_status", $this->oel_status);


		// execute query
		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	function chkemail()
	{
		// query to read single record
		$query = "SELECT
				o.oel_id,o.oel_registernumber,o.oel_accno,o.oel_registername,oel_accno,oel_registername,oel_emailaddress,
				oel_otp,oel_expdatetime,oel_registerdate,oel_emailtype,oel_answer,oel_createby,oel_createdate,
				oel_updateby,oel_updatedate,oel_remark,oel_status				
				FROM
					" . $this->table_name . " o
				WHERE
					o.oel_emailaddress = ? AND o.oel_registernumber = ? AND o.oel_emailtype = ?
				LIMIT
					0,1";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

		// bind id of product to be updated
		$stmt->bindParam(1, $this->oel_emailaddress);
		$stmt->bindParam(2, $this->oel_registernumber);
		$stmt->bindParam(3, $this->oel_emailtype);

		// execute query
		$stmt->execute();

		// 	echo "12345";
		if ($stmt->rowCount() == 0) {
			return false;
		} else {
			return true;
		}
	}


	/*
	// create product
	function create(){
	 
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					name=:name, price=:price, description=:description, category_id=:category_id, created=:created";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$this->created=htmlspecialchars(strip_tags($this->created));
	 
		// bind values
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":category_id", $this->category_id);
		$stmt->bindParam(":created", $this->created);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
	
	// used when filling up the update product form
	function readOne(){
	 
		// query to read single record
		$query = "SELECT
					c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
				FROM
					" . $this->table_name . " p
					LEFT JOIN
						categories cs
							ON p.category_id = c.id
				WHERE
					p.id = ?
				LIMIT
					0,1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of product to be updated
		$stmt->bindParam(1, $this->id);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		$this->name = $row['name'];
		$this->price = $row['price'];
		$this->description = $row['description'];
		$this->category_id = $row['category_id'];
		$this->category_name = $row['category_name'];
	}
	
	// update the product
	  function update(){
	   
		  // update query
		  $query = "UPDATE
					  " . $this->table_name . "
				  SET
					  name = :name,
					  price = :price,
					  description = :description,
					  category_id = :category_id
				  WHERE
					  id = :id";
	   
		  // prepare query statement
		  $stmt = $this->conn->prepare($query);
	   
		  // sanitize
		  $this->name=htmlspecialchars(strip_tags($this->name));
		  $this->price=htmlspecialchars(strip_tags($this->price));
		  $this->description=htmlspecialchars(strip_tags($this->description));
		  $this->category_id=htmlspecialchars(strip_tags($this->category_id));
		  $this->id=htmlspecialchars(strip_tags($this->id));
	   
		  // bind new values
		  $stmt->bindParam(':name', $this->name);
		  $stmt->bindParam(':price', $this->price);
		  $stmt->bindParam(':description', $this->description);
		  $stmt->bindParam(':category_id', $this->category_id);
		  $stmt->bindParam(':id', $this->id);
	   
		  // execute the query
		  if($stmt->execute()){
			  return true;
		  }
	   
		  return false;
	  }
	  
	  // delete the product
	  function delete(){
	   
		  // delete query
		  $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
	   
		  // prepare query
		  $stmt = $this->conn->prepare($query);
	   
		  // sanitize
		  $this->id=htmlspecialchars(strip_tags($this->id));
	   
		  // bind id of record to delete
		  $stmt->bindParam(1, $this->id);
	   
		  // execute query
		  if($stmt->execute()){
			  return true;
		  }
	   
		  return false;
		   
	  }
	  
	  // search products
	  function search($keywords){
	   
		  // select all query
		  $query = "SELECT
					  c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
				  FROM
					  " . $this->table_name . " p
					  LEFT JOIN
						  categories c
							  ON p.category_id = c.id
				  WHERE
					  p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
				  ORDER BY
					  p.created DESC";
	   
		  // prepare query statement
		  $stmt = $this->conn->prepare($query);
	   
		  // sanitize
		  $keywords=htmlspecialchars(strip_tags($keywords));
		  $keywords = "%{$keywords}%";
	   
		  // bind
		  $stmt->bindParam(1, $keywords);
		  $stmt->bindParam(2, $keywords);
		  $stmt->bindParam(3, $keywords);
	   
		  // execute query
		  $stmt->execute();
	   
		  return $stmt;
	  }
	  
	  // read products with pagination
	  public function readPaging($from_record_num, $records_per_page){
	   
		  // select query
		  $query = "SELECT
					  c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
				  FROM
					  " . $this->table_name . " p
					  LEFT JOIN
						  categories c
							  ON p.category_id = c.id
				  ORDER BY p.created DESC
				  LIMIT ?, ?";
	   
		  // prepare query statement
		  $stmt = $this->conn->prepare( $query );
	   
		  // bind variable values
		  $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
		  $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
	   
		  // execute query
		  $stmt->execute();
	   
		  // return values from database
		  return $stmt;
	  }
	  
	  // used for paging products
	  public function count(){
		  $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
	   
		  $stmt = $this->conn->prepare( $query );
		  $stmt->execute();
		  $row = $stmt->fetch(PDO::FETCH_ASSOC);
	   
		  return $row['total_rows'];
	  }
		  */
}
