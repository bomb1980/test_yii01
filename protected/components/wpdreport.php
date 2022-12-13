<?php

class wpdreport extends CApplicationComponent{
	
	
	
	public function createcrop_v_bran($cropid, $registernumber){
	
		//กำหนด username
/*
		if(Yii::app()->user->username){
			$username = Yii::app()->user->username;
		}else{
			$username = "sys";
		}
*/
		$username = "sys";
		//กำหนด เลข ssobranch ของ user
/*
		if(Yii::app()->user->address){
 			$brachcode = Yii::app()->user->address;
		}else{
			$brachcode = "-";
		}	
*/		
		$brachcode = "-";
		//echo "{$username}, {$brachcode}, {$cropid}, {$registernumber} <br>";
		
		//--- get branch data ------//
		$qbrn = new CDbCriteria( array(
			'condition' => "crop_id = :crop_id and registernumber = :registernumber and ordernumber = :ordernumber ORDER BY crop_id DESC LIMIT 0,1 ",
			'params'    => array(':crop_id' => $cropid, ':registernumber' => $registernumber, ':ordernumber' => '0') 
		));
		$rbrn = BranchTmpTb::model()->findAll($qbrn);
		$cbrn = count($rbrn);
		if($cbrn>0){
		   foreach ($rbrn as $rows){
				
			   	$brch_id = $rows->brch_id;
			   	$crop_id = $rows->crop_id;
			   	$registernumber = $rows->registernumber;
			   	$tsic = $rows->tsic;
				$corptype = $rows->corptype;
				$ordernumber = $rows->ordernumber;
				$name = $rows->name;
				$houseid = $rows->houseid;
				$housenumber = $rows->housenumber;
				$buildingname = $rows->buildingname;
				$buildingnumber = $rows->buildingnumber;
				$buildingfloor = $rows->buildingfloor;
				$village = $rows->village;
				$moo = $rows->moo;
				$soi = $rows->soi;
				$road = $rows->road;
				$tumbon = $rows->tumbon;
				$tumboncode = $rows->tumboncode;
				$ampur = $rows->ampur;
				$ampurcode = $rows->ampurcode;
				$province = $rows->province;
				$provincecode = $rows->provincecode;
				$zipcode = $rows->zipcode;
				$phonenumber = $rows->phonenumber;
				$faxnumber = $rows->faxnumber;
				$email = $rows->email;
				$brch_remark = $rows->brch_remark;
				$brch_createby = $rows->brch_createby;
				$brch_createtime = $rows->brch_createtime;
				$brch_updateby = $rows->brch_updateby;
				$brch_updatetime = $rows->brch_updatetime;
				$brch_status = $rows->brch_status;
				
				//echo "{$brch_id},{$crop_id},{$registernumber},{$tsic},{$corptype},{$ordernumber},{$name},{$houseid},{$housenumber},{$buildingname},{$buildingnumber},{$buildingfloor}, {$village},{$moo},{$soi},{$road},{$tumbon},{$tumboncode},{$ampur},{$ampurcode},{$province},{$provincecode},{$zipcode},{$phonenumber},{$faxnumber},{$email},{$brch_remark},{$brch_createby},{$brch_createtime},{$brch_updateby},{$brch_updatetime},{$brch_status} <br>";
				
				
				
				//get cropinfo 
				$qcf1=CropinfoTmpTb::model()->findByAttributes(array('crop_id'=>$crop_id, 'registernumber'=>$registernumber));
				 $registername = $qcf1->registername;
				 $acc_no = $qcf1->acc_no;
				 $acc_bran = $qcf1->acc_bran;
				 $tsic = $qcf1->tsic;
				 $tsicname = $qcf1->tsicname;
				 $corptype = $qcf1->corptype;
				 $corptypename = $qcf1->corptypename;
				 $registerdate = $qcf1->registerdate;
				 $updateddate = $qcf1->updateddate;
				 $updateentry = $qcf1->updateentry;
				 $accountingdate = $qcf1->accountingdate;
				 $authorizedcapital = $qcf1->authorizedcapital;
				 $statuscode = $qcf1->statuscode;
				 $cpower = $qcf1->cpower;
				 $crop_remark = $qcf1->crop_remark;
				 $crop_createby = $qcf1->crop_createby;
				 $crop_createtime = $qcf1->crop_createtime;
				 $crop_updateby = $qcf1->crop_updateby;
				 $crop_updatetime = $qcf1->crop_updatetime;
				 $crop_status = $qcf1->crop_status;
				 
				 //echo "{$registername}, {$acc_no}, {$acc_bran}, {$tsic}, {$tsicname}, {$corptype}, {$corptypename}, {$registerdate}, {$updateddate}, {$updateddate}, {$updateentry}, {$accountingdate}, {$authorizedcapital}, {$statuscode}, {$cpower}, {$crop_remark}, {$crop_createby}, {$crop_createtime}, {$crop_updateby}, {$crop_updatetime}, {$crop_status} <br>";
				 
				
				
				//get address
				if($housenumber!="-"){
					$housenumberf = $housenumber;
				}else{
					$housenumberf = "";
				}
				
				if($buildingname!="-"){
					$buildingnamef = " "  . $buildingname;
				}else{
					$buildingnamef = "";
				}
				
				if($buildingnumber!="-"){
					$buildingnumberf = " " . $buildingnumber;
				}else{
					$buildingnumberf = "";
				}
				
				if($buildingfloor!="-"){
					$buildingfloorf = " " . $buildingfloor;
				}else{
					$buildingfloorf = "";
				}
				
				if($village!="-"){
					$villagef = " " . $village;
				}else{
					$villagef = "";
				}
				
				if($moo!="-"){
					$moof = " ม." . $moo;
				}else{
					$moof = "";
				}
				
				if($soi!="-"){
					$soif = " " . $soi;
				}else{
					$soif = "";
				}
				
				if($road!="-"){
					$roadf = " " . $road;
				}else{
					$roadf = "";
				}
				
				if($tumbon!="-"){
					$tumbonf = " " . $tumbon;
				}else{
					$tumbonf = "";
				}
				
				if($ampur!="-"){
					$ampurf = " " . $ampur;
				}else{
					$ampurf = "";
				}
				
				if($province!="-"){
					$provincef = " " . $province;
				}else{
					$provincef = "";
				}
				
				if($zipcode!="-"){
					$zipcodef = " " . $zipcode;
				}else{
					$zipcodef = "";
				}
				
				$addressf = $housenumberf . $buildingnamef . $buildingnumberf . $buildingfloorf . $villagef . $moof . $soif . $roadf . $tumbonf . $ampurf . $provincef . $zipcodef;
				
				//echo "{$addressf} <br>";
				
				
				 //search data from crop_v_bran
				 //$qcvb=CropVBran::model()->findByAttributes(array('crop_id'=>$crop_id, 'registernumber'=>$registernumber));
				 $qcvb = new CDbCriteria( array(
					'condition' => "crop_id = :crop_id and registernumber = :registernumber ORDER BY crop_id DESC LIMIT 0,1 ",
					'params'    => array(':crop_id' => $cropid, ':registernumber' => $registernumber) 
				 ));
				 $cvb = CropVBran::model()->findAll($qcvb);
				 $ccvb = count($cvb);
				 if($ccvb==0){ //ยังไม่มีข้อมูล
				 
				 
				 $ampcode = $provincecode . "" . $ampurcode;
				
				//echo "{$ampcode} <br>";	
					
				 //get ssobranchcode from wpd_sps_lt_ssobran
				//$qsb=WpdSpnLtSsobran::model()->findByAttributes(array('ZONE_AMPUR_CODE'=>$ampcode));
				//echo "<pre>"; var_dump($qsb);  echo "</pre><br>";
				
				$qsb = new CDbCriteria( array(
					'condition' => "ZONE_AMPUR_CODE = :ZONE_AMPUR_CODE ORDER BY ZONE_AMPUR_CODE DESC LIMIT 0,1 ",
					'params'    => array(':ZONE_AMPUR_CODE' => $ampcode) 
				));
				$rsb2 = WpdSpnLtSsobran::model()->findAll($qsb);
				//echo "<pre>"; var_dump($rsb2); echo "</pre><br>";
				$crsb2 = count($rsb2);
				if($crsb2>0){
				  foreach ($rsb2 as $rows2){
					  
					  $SSO_BRAN_CODE2 = $rows2->SSO_BRAN_CODE;
					  $SSO_BRN_NAME2 = $rows2->SSO_BRN_NAME;
					  $ZONE_AMPUR_CODE2 = $rows2->ZONE_AMPUR_CODE;
					  $ZONE_AMPUR_NAME2 = $rows2->ZONE_AMPUR_NAME;
					  
					  //echo "{$SSO_BRAN_CODE2}-, {$SSO_BRN_NAME2}-, {$ZONE_AMPUR_CODE2}-, {$ZONE_AMPUR_NAME2}- <br>";
					  
				  }//foreach*/
				}else{//if
				     
					 $ampcode1 = $provincecode . "01";
					 $qsb2 = new CDbCriteria( array(
						  'condition' => "ZONE_AMPUR_CODE = :ZONE_AMPUR_CODE ORDER BY ZONE_AMPUR_CODE DESC LIMIT 0,1 ",
						  'params'    => array(':ZONE_AMPUR_CODE' => $ampcode1) 
					  ));
					 $rsb3 = WpdSpnLtSsobran::model()->findAll($qsb2);	
					 $crsb3 = count($rsb3);
					 if($crsb3>0){
					   	 foreach ($rsb3 as $rows3){
							$SSO_BRAN_CODE2 = $rows3->SSO_BRAN_CODE;
					  		$SSO_BRN_NAME2 = $rows3->SSO_BRN_NAME;
					  		$ZONE_AMPUR_CODE2 = $rows3->ZONE_AMPUR_CODE;
					  		$ZONE_AMPUR_NAME2 = $rows3->ZONE_AMPUR_NAME;
						 }//foreach
					 }else{
					   $SSO_BRAN_CODE2 = "-"; //$rows2->SSO_BRAN_CODE;
					   $SSO_BRN_NAME2 = "-"; //$rows2->SSO_BRN_NAME;
					   $ZONE_AMPUR_CODE2 = "-"; //$rows2->ZONE_AMPUR_CODE;
					   $ZONE_AMPUR_NAME2 = "-"; //$rows2->ZONE_AMPUR_NAME;
					 }
				}
				
				//ค้นหารายการสถานะนิติบุคคลที่มีลูกจ้างหรือยัง
				//$emps=EmpstateTb::model()->findByAttributes(array('ems_accno'=>$acc_no, 'ems_registernumber'=>$registernumber));
				$qemps = new CDbCriteria( array(
					'condition' => "ems_accno = :ems_accno and  ems_registernumber = :ems_registernumber",
					'params'    => array(':ems_accno' => $acc_no, ':ems_registernumber' => $registernumber ) 
				));
				$emps = EmpstateTb::model()->findAll($qemps);	
				$cemps = count($emps);
				if($emps){ //เปลี่ยนสถานะการมีลูกจ้างแล้ว B
					foreach ($cemps as $rows4){
						$ems_email = $rows4->ems_email;
 						$ems_numofemp = $rows4->ems_numofemp;
 						$ems_totalsalary = $rows4->ems_totalsalary;
					}
				}else{ //ยังไม่เปลี่ยนสถานะ P
					$ems_email = $email;
 					$ems_numofemp = 0;
 					$ems_totalsalary = 0.00;
				}
				
				
				 
				 //insert data to crop_v_bran
					 $CropVBran = new CropVBran();
					 
					 $CropVBran->brch_id = $brch_id;
					 $CropVBran->crop_id = $crop_id;
					 $CropVBran->registernumber = $registernumber;
					 $CropVBran->ordernumber = $ordernumber;
					 $CropVBran->ampcode = $ampcode;
					 $CropVBran->SSO_BRAN_CODE = $SSO_BRAN_CODE2;
					 $CropVBran->SSO_BRN_NAME = $SSO_BRN_NAME2;
					 $CropVBran->ZONE_AMPUR_NAME = $ZONE_AMPUR_NAME2;
					 $CropVBran->registerdate = $registerdate;
					 $CropVBran->registername = $registername;
					 $CropVBran->tsic = $tsic;
					 $CropVBran->tsicname = $tsicname;
					 $CropVBran->address = $addressf;
					 $CropVBran->email = $ems_email;
					 $CropVBran->numofemp = $ems_numofemp;
 					 $CropVBran->totalsalary = $ems_totalsalary;
					 $CropVBran->phonenumber = $phonenumber;
					 $CropVBran->faxnumber = $faxnumber;
					 $CropVBran->acc_no = $acc_no;
					 $CropVBran->acc_bran = $acc_bran;
					 $CropVBran->crop_remark = "P";//$crop_remark;
					 $CropVBran->crop_createtime = $crop_createtime;
					 $CropVBran->crop_updatetime = $crop_updatetime;
					 $CropVBran->crop_status = 2;//$crop_status;
					 if($CropVBran->save()){
						  //echo CJSON::encode(array('status' => 'success'));
						 //echo "insert data is success!";
					 }else{
						 //echo "can't insert data!";
						//echo CJSON::encode(array('status' => 'error'));
						//echo CJSON::encode($Users->getErrors());
					 }
					 
				 }
				
				
		   }
		}else{
			echo "ไม่พบข้อมูล สำนักงาน <br>";	
		}
			
	}//function
	
	public function updatetob($cropid, $registernumber){
		//update status is B
		//echo "{$cropid},{$registernumber} <br>";
		$qcvbu=CropVBran::model()->findByAttributes(array('crop_id'=>$cropid, 'registernumber'=>$registernumber));
		
		$qcvbu->crop_remark = "B";
		$qcvbu->crop_updatetime = date('Y-m-d H:i:s');
		$qcvbu->crop_status = "3";
		if($qcvbu->save()){
			//echo "update data is success!";
			//echo CJSON::encode(array('status' => 'success'));
		}else{
			//echo "can't update data!";
			//echo CJSON::encode(array('status' => 'error'));
			//echo CJSON::encode($updateusa->getErrors());
		}//if
	}//function
	
	
	public function updatetoa($cropid, $registernumber){
		//update status is B
		$qcvbu=CropVBran::model()->findByAttributes(array('crop_id'=>$cropid, 'registernumber'=>$registernumber));
		//$ccvbu = count($qcvbu);
		$qcvbu->crop_remark = "A";
		$qcvbu->crop_updatetime = date('Y-m-d H:i:s');
		$qcvbu->crop_status = "4";
		if($qcvbu->save()){
			//echo "update data is success!";
			//echo CJSON::encode(array('status' => 'success'));
		}else{
			//echo "can't update data!";
			//echo CJSON::encode(array('status' => 'error'));
			//echo CJSON::encode($updateusa->getErrors());
		}//if
	}//function
	
}//class

?>
