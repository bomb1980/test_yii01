<?php
class GenAccNo extends CApplicationComponent 
{
	//object properties
	public $provice_code;
	public $registernumber;
	
	public $rowcountnew;
	
	public $prvi_remark;
	
	public $d12;
	public $d3;
	public $d49;
	public $d10;
	
	public $accno;
	
	public $acc_no;
	public $acc_bran;
	public $acc_regis_no;
	public $acc_active_flag;
	
	
	//object method
	public function getVar1(){
		return $this->provice_code; //ใช้งาน porperties ใน class นี้
	}
	
	public function genAccNumber(){
		
		$this->d12 = $this->provice_code;
		
		$this->d3 = "2";
		
		$this->d49 = $padded_num = str_pad($this->RowsCount()+1, 6, 0, STR_PAD_LEFT); //$this->RowsCount();
		
		$this->accno = $this->d12 . $this->d3 . $this->d49;
		
		$sarray = str_split((string)$this->accno);
		
		
		//****** gen check digit ****************************
		  $dd1 =  $sarray[0] * 10;
		  $dd2 =  $sarray[1] *	9;
		  $dd3 =  $sarray[2] *	8;
		  $dd4 =  $sarray[3] *	7;
		  $dd5 =  $sarray[4] *	6;
		  $dd6 =  $sarray[5] *	5;
		  $dd7 =  $sarray[6] *	4;
		  $dd8 =  $sarray[7] *	3;
		  $dd9 =  $sarray[8] *	2;
		  
		  $sumdd = $dd1 + $dd2 + $dd3 + $dd4 + $dd5 + $dd6 + $dd7 + $dd8 + $dd9;	
		  $mod11 = $sumdd % 11; 
		  if($mod11==0){
			 $div11 = 1;
		  }else if($mod11==1){
			 $div11 = 0; 
		  }else{
			 $div11 = 11-$mod11;  
		  }
		 //****** end gen check digit ****************************  
		
		$accnogen = $this->d12 . $this->d3 . $this->d49 . $div11;
		
		$this->acc_no = $accnogen;
		
		return $accnogen;
		
	}
	
	public function RowsCount(){
		
		//-------------------- นับจำนวนจาก จำนวน Accnumber ทั้งหมด --------------------------------------------------------
		/*
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/accnumber/acccount.php';  //https://wpdws.sso.go.th/
		$opts = array(
			"http" => array (
				"method" => "POST",
				 "header" =>
					"Content-Type: application/xml; charset=utf-8;\r\n".
					"Connection: close\r\n",
					"ignore_errors" => true,
					"timeout" => (float)30.0,
					//"content" => $postdata,
					//'Content-type: application/xwww-form-urlencoded',
			),
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		
		$content = file_get_contents($url, false, stream_context_create($opts));
		
		$content_jdc = json_decode($content);
		$numrows = $content_jdc->numrows; 
		
		return $numrows;
		*/
		//-------------------- นับจำนวนจาก จำนวน Accnumber ทั้งหมด --------------------------------------------------------
		
		//--------------------- ดึงจำนวนที่บันทึกไว้ในตาราง province -----------------------------------------------------------
		$postdata = json_encode(
			array(
				'provice_code' => $this->provice_code
			)
		);
		
		//return $postdata;
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/provice/getrunnumber.php';
		
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
		
		//return $content_jdc;
		
		//var_dump($content_jdc);
		
		$numrows = $content_jdc->prvi_remark; 
		
		return $numrows;
		
		//return intval($numrows);*/
		
		//------------------------------------------------------------------------------------------------------------
	}
	
	public function CreateNewAcc(){
		// Set the POST data
		$postdata = json_encode(
			array(
			
				'acc_no' => $this->acc_no,
				'acc_bran' => "000000",
				'acc_regis_no' => $this->registernumber,
				'acc_active_flag' => "N"
			
			)
		);//$postdata = json_encode(
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/accnumber/create.php';//https://wpd.sso.go.th/
		
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
		
		$result_create = $content_jdc->message; 
		
		if($result_create=="Y"){
			$msgr = "Accnumber was created.";
		}else if($result_create=="N"){
			$msgr = "Unable to create accnumber.";
		}else if($result_create=="D"){
			$msgr = "Unable to create accnumber. Data is incomplete.";
		}
		
		return $msgr;
		
		return $result_create;
		
		
			
	}//public function CreateNewAcc(){
	
	public function accnoexists(){
		$postdata = json_encode(
			array(
				//'registernumber' => $this->registernumber
				'acc_no' => $this->acc_no,
				'acc_bran' => $this->acc_bran,
				'acc_regis_no' => $this->acc_regis_no
			)
		);	
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/accnumber/accnoexists.php';//https://wpd.sso.go.th/
		
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

		$msg = $content_jsdc->message; 
		
		//return $msg;
		
		if($msg=='y'){
			return true;
		}else{
			return false;
		}
		
	}//public function accnoexists(){
		
	public function updatenumprovice(){
		$postdata = json_encode(
			array(
				//'registernumber' => $this->registernumber
				'rowcountnew' => $this->rowcountnew,
				'provice_code' => $this->provice_code
			)
		);
		
		//return $postdata;
		
		$url = Yii::app()->params['servicepath'] . '/wpdapi/api/provice/updatenumprovice.php';//https://wpd.sso.go.th/
		
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
		
			
	}//function
	
	public function CheckAndGenAccno(){
		//ตรวจสอบ สถานะ ว่าเป็น P หรือปล่าว
		$mcrop=CropinfoTmpTb::model()->findByAttributes(array('registernumber'=>$this->registernumber, 'crop_remark'=>'P'));
		if($mcrop){//กรณีสถานะเป็น P
			//ตรวจสแบว่าจังหวัดเปลี่ยนหรือไม่
			$mbrntmp=BranchTmpTb::model()->findByAttributes(array('registernumber'=>$this->registernumber, 'ordernumber'=>0));
			if($mbrntmp){
				$provincecodetmp = $mbrntmp->provincecode;
				$provincecodetmp = $mbrntmp->provincecode;
				$ampurcodetmp = $mbrntmp->ampurcode;
				$brch_remarktmp = $mbrntmp->brch_remark;
				
			    $housenumber = $mbrntmp->housenumber;
			    $buildingname = $mbrntmp->buildingname;
			    $buildingnumber = $mbrntmp->buildingnumber;
			    $buildingfloor = $mbrntmp->buildingfloor;
			    $village = $mbrntmp->village;
			    $moo = $mbrntmp->moo;
			    $soi = $mbrntmp->soi;
			    $road = $mbrntmp->road;
			    $tumbon = $mbrntmp->tumbon;
			    $ampur = $mbrntmp->ampur;
			    $province = $mbrntmp->province;
			    $zipcode = $mbrntmp->zipcode;
			   
			}else{
				$provincecodetmp = "-";
			}//if
			
			/*
				$attribs = array('user_country'=>1 ,'user_gender'=>'M');
				$criteria = new CDbCriteria(array('order'=>'user_date_created DESC','limit'=>10));
				$criteria->addBetweenCondition('user_date_created', $date['date_start'], $date['date_end']);
				$rows = user::model()->findAllByAttributes($attribs, $criteria);
			*/
			$attribs = array('registernumber'=>$this->registernumber, 'ordernumber'=>0);
			$criteria = new CDbCriteria(array('order'=>'brch_id DESC','limit'=>1));
			$mbrnmas=BranchMasTb::model()->findByAttributes($attribs, $criteria);
			if($mbrnmas){
				$provincecodemas = $mbrnmas->provincecode;
				$provincecodemas = $mbrnmas->provincecode;
				$ampurcodemas = $mbrnmas->ampurcode;
				$brch_remarktmpmas = $mbrntmp->brch_remark;
			}else{
				$provincecodemas = "-";
			}//if
			
			if(trim($provincecodemas) != trim($provincecodetmp)){ //กรณีที่รหัสจังหวัดไม่เหมือนกัน
			    
				//echo "จังหวัดเปลี่ยนไป {$provincecodemas}, {$provincecodetmp} <br>";
			
				//เริ่ม gen เลข 10 หลัก ใหม่
				$q2 = new CDbCriteria( array(
			  		'condition' => "prvi_code = :prvi_code ",
			  		'params'    => array(':prvi_code' => $provincecodetmp)
				));	
				$r2 = ProviceTb::model()->findAll($q2);
				$c2 = count($r2);
				foreach ($r2 as $rows){
					$prvi_id = $rows->prvi_id;
					$lastnum = $rows->prvi_remark; //running number ล่าสุด
				}
				$rowcountpv = $lastnum + 1; //running number ใหม่
				
				$dg12 = $provincecodetmp;
				$dg3 = "2";
				$dg49 = str_pad($rowcountpv, 6, 0, STR_PAD_LEFT);
			
				$accno = $dg12 . $dg3 . $dg49;
				
				$sarray = str_split($accno);
			
			//****** gen check digit ****************************
			  $dd1 =  $sarray[0] * 10;
			  $dd2 =  $sarray[1] *	9;
			  $dd3 =  $sarray[2] *	8;
			  $dd4 =  $sarray[3] *	7;
			  $dd5 =  $sarray[4] *	6;
			  $dd6 =  $sarray[5] *	5;
			  $dd7 =  $sarray[6] *	4;
			  $dd8 =  $sarray[7] *	3;
			  $dd9 =  $sarray[8] *	2;
			  
			  $sumdd = $dd1 + $dd2 + $dd3 + $dd4 + $dd5 + $dd6 + $dd7 + $dd8 + $dd9;	
			  $mod11 = $sumdd % 11; 
			  if($mod11==0){
				 $div11 = 1;
			  }else if($mod11==1){
				 $div11 = 0; 
			  }else{
				 $div11 = 11-$mod11;  
			  }
			//****** end gen check digit ****************************  
			
			$accnogen = $dg12 . $dg3 . $dg49 . $div11;
			
			//echo "{$prvi_id}, {$lastnum}, {$rowcountpv}, {$accno}, {$accnogen} <br>"; 
			
			//เริ่มทำการ ปรับปรุงข้อมูลใน table ที่เกี่ยวข้อง
			 $q3 = new CDbCriteria( array(
				  'condition' => "registernumber = :registernumber ",
				  'params'    => array(':registernumber' => $this->registernumber )
			  ));
			 $r3 = CropinfoTmpTb::model()->findAll($q3);
			 $c3 = count($r3);
			 foreach ($r3 as $rows){
				  $crop_id3 = $rows->crop_id; 
				  $acc_no3 = $rows->acc_no;
				  $registername3 =  $rows->registername;
			 }//foreach
			 
			 $ampcode = $provincecodetmp . "" . $ampurcodetmp;
			 
			 if($housenumber != "-"){
				 $housenumber = $housenumber . " ";
			 }else{
				 $housenumber = "";
			 }//if
			 if($buildingname != "-"){
				 $buildingname = $buildingname . " ";
			 }else{
				 $buildingname = "";
			 }//if
			 if($buildingnumber  != "-"){
				 $buildingnumber = $buildingnumber . " ";
			 }else{
				 $buildingnumber = "";
			 }//if
			 if($buildingfloor  != "-"){
				 $buildingfloor = $buildingfloor . " ";
			 }else{
				 $buildingfloor = "";
			 }//if
			 if($village != "-"){
				 $village = $village . " ";
			 }else{
				 $village = "";
			 }//if
			 if($moo != "-"){
				 $moo = "ม." . $moo . " ";
			 }else{
				$moo = ""; 
			 }//if
			 if($soi != "-"){
				 $soi = $soi . " ";
			 }else{
				$soi = ""; 
			 }//if
			 if($road != "-"){
				 $road = $road . " ";
			 }else{
				$road = ""; 
			 }//if
			 if($tumbon != "-"){
				 $tumbon = $tumbon . " ";
			 }else{
				$tumbon = "";
			 }//if
			 if($ampur != "-"){
				 $ampur = $ampur . " ";
			 }else{
				$ampur = "";
			 }//if
			 if($province != "-"){
				 $province = $province . " ";
			 }else{
				 $province = "";
			 }//if
			 if($zipcode != "-"){
				 $zipcode = $zipcode . " ";
			 }else{
				 $zipcode = "";
			 }//if
			 
			 
			 
			 $addresscrop = $housenumber . $buildingname . $buildingnumber . $buildingfloor . $village . $moo . $soi . $road . $tumbon . $ampur . $province . $zipcode;
			 
			 $mssobrncode=MasSsobranch::model()->findByAttributes(array('ssobranch_code'=>$brch_remarktmp));
			  if($mssobrncode){
				  $ssoname = $mssobrncode->name;
			  }
			 
			 //echo "{$prvi_id}, {$lastnum}, {$rowcountpv}, {$accno}, {$accnogen}, {$crop_id3}, {$acc_no3} ,{$brch_remarktmp}, {$provincecodetmp}, {$ampurcodetmp} , {$ampcode}, {$addresscrop}, {$ssoname}, {$registername3} <br>"; 
			
			 //******* update cropinfo **********************************
			  $update2 = CropinfoTmpTb::model()->findByPk($crop_id3);
				  if($update2){
					$update2->acc_no = $accnogen;
					$update2->crop_updateby = Yii::app()->user->username;
					$update2->crop_updatetime = date('Y-m-d H:i:s');
					$update2->save();
				  }//if 
			 //***********************************************************
			 //******* update accnotb ************************************
			 	 $maccno=AccnumberTb::model()->findByAttributes(array('acc_regis_no'=>$this->registernumber));
				 if($maccno){
					 $maccno->acc_no = $accnogen;;
					 $maccno->acc_updateby = Yii::app()->user->username;
					 $maccno->acc_modified = date('Y-m-d H:i:s');
					 $maccno->save();
				 }//if
			 //**********************************************************
			 //****** update provicetb ********************************
				  $update1 = ProviceTb::model()->findByPk($prvi_id);
				  if($update1){
				  	$update1->prvi_remark = $rowcountpv;
					$update1->prvi_updateby = Yii::app()->user->username;
					$update1->prvi_updatetime = date('Y-m-d H:i:s');
				  	$update1->save();
				  }
			  //********************************************************
			  //***** update CropVBran *********************************
			  		$mcropvbrn=CropVBran::model()->findByAttributes(array('registernumber'=>$this->registernumber));
					if($mcropvbrn){
						$mcropvbrn->ampcode = $ampcode;
						$mcropvbrn->SSO_BRAN_CODE = $brch_remarktmp;
						$mcropvbrn->address = $addresscrop;
						$mcropvbrn->acc_no = $accnogen;
						$mcropvbrn->crop_updatetime = date('Y-m-d H:i:s');
						$mcropvbrn->save();
					}//if
			  //********************************************************
			  //***** update Countallstatus ****************************
			        //ค้นหาชื่อ ตาม sso_brancode
			  		$mcrs=Countallstatus::model()->findByAttributes(array('registernumber'=>$this->registernumber));
					if($mcrs){
						$mcrs->ssobranch_code = $brch_remarktmp;
						$mcrs->name = $ssoname;
						$mcrs->save();
					}//if
			  //********************************************************
			
			  //****** insert CleansingTb ******************************
			    $CleansingTb = new CleansingTb();
			  	$CleansingTb->clsg_registernumber = $this->registernumber;
			 	$CleansingTb->clsg_wpdaccno = $acc_no3;
			 	$CleansingTb->clsg_sapainsaccno = $accnogen;
			 	$CleansingTb->clsg_registername = $registername3;
			 	$CleansingTb->clsg_createby = Yii::app()->user->username;
			 	$CleansingTb->clsg_created = date('Y-m-d H:i:s');
			 	$CleansingTb->clsg_updateby = Yii::app()->user->username;
			 	$CleansingTb->clsg_modified = date('Y-m-d H:i:s');
			 	$CleansingTb->clsg_remark = "chg";
			 	$CleansingTb->clsg_status = 2;
				$CleansingTb->save();
			  //********************************************************
			  
			}else{//กรณีที่รหัสจังหวัด เหมือนกัน
				//
			}//if
			
		}else{//กรณี สถานะไม่เป็น P
			
		}//if
	}//function
	
}
?>