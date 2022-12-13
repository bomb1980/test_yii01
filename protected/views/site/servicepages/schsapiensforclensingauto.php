<?php
  $schdate = $schdate;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>schsapiensforclensing</title>
</head>

<body>

    <?php
	  $rowno = 1;
	  
	  $startdate = $schdate . "T00:00:00+07:00";
  	  $enddate = $schdate . "T23:59:59+07:00";
	  
	  $datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
	  $datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
	  
	  $qsbd = new CDbCriteria( array(
		  'condition' => "sad_modified between :datesch1 and :datesch2 ",         
		  'params'    => array(':datesch1' => "{$datesch1}", ':datesch2' => "{$datesch2}")  
	  ));
	  $modelsbd = SapeinsalldataTb::model()->findAll($qsbd);
	  $countsbd = count($modelsbd);	
	  	
		
	  foreach ($modelsbd as $rows){
		   $sad_id = $rows->sad_id;
		   $sad_regisno = $rows->sad_regisno;
		   $sad_accno = $rows->sad_accno;
		   $sad_createby = $rows->sad_createby;
		   $sad_created = $rows->sad_created;
		   $sad_updateby = $rows->sad_updateby;
		   $sad_modified = $rows->sad_modified;
		   $sad_remark = $rows->sad_remark;
		   $sad_status = $rows->sad_status;
		   
		   $cifm=CropinfoTmpTb::model()->findByAttributes(array('registernumber'=>$sad_regisno));
		   if($cifm){
			 $registername = $cifm->registername;
			 $acc_no = $cifm->acc_no;
			 $registerdate = $cifm->registerdate;
			 $crop_remark = $cifm->crop_remark;
			 $crop_status = $cifm->crop_status;
			 //เริ่มตรวจสอบว่า เลขบัญชีนายจ้างใน sapeins กับ เลขบัญชีนายจ้างใน wpd ว่าตรงกันหรือไม่
			 if($sad_accno!=$acc_no){ //กรณีไม่เท่ากัน
			 	//เริ่มทำการ cleansing data 
				//เริ่มกำหนด transection
				  //==== try start =================================================================================	
				  $transaction = Yii::app()->db->beginTransaction();
				  try{
					  //เริ่ม update data=====================================
						  $sts = 0; 
						  //insert CleansingTb
						  $clsd=CleansingTb::model()->findByAttributes(array('clsg_registernumber'=>$sad_regisno));
						  if(!$clsd){
							  $CleansingTb = new CleansingTb();
							  $CleansingTb->clsg_registernumber = $sad_regisno;
							  $CleansingTb->clsg_wpdaccno = $acc_no;
							  $CleansingTb->clsg_sapainsaccno = $sad_accno;
							  $CleansingTb->clsg_registername = $registername;
							  $CleansingTb->clsg_createby = 'sys';
							  $CleansingTb->clsg_created = date('Y-m-d H:i:s');
							  $CleansingTb->clsg_updateby = 'sys';
							  $CleansingTb->clsg_modified = date('Y-m-d H:i:s');
							  $CleansingTb->clsg_remark = 'y';
							  $CleansingTb->clsg_status = 1;
							  if($CleansingTb->save()){
								  //echo "{$r}, {$regis_no}, {$acc_no_wpd}, {$acc_no_sapeins} <br>";
								  $sts = 0;
								  //update data to table cropinfo_tmp ====================
								  $cif=CropinfoTmpTb::model()->findByAttributes(array('registernumber'=>$sad_regisno));
								  if($cif){
									  $cif->acc_no = $sad_accno;
									  $cif->crop_updateby = 'sys';
									  $cif->crop_updatetime = date('Y-m-d H:i:s');
									  $cif->crop_remark = "A";
									  $cif->crop_status = 4;
									  if($cif->save()){
										  $sts = 0;
										  //$msg3 = "update data is success.";
										  // update accnumber===============================
											$anb=AccnumberTb::model()->findByAttributes(array('acc_regis_no'=>$sad_regisno));
											if($anb){
											  $anb->acc_active_flag = 'C';
											  $anb->acc_updateby = 'sys';
											  $anb->acc_modified = date('Y-m-d H:i:s');
											  $anb->acc_remark = $sad_accno;
											  $anb->acc_status = 5;
											  if($anb->save()){
												$sts = 0;
												// update EmpstateTb =============================================
												$est=EmpstateTb::model()->findByAttributes(array('ems_registernumber'=>$sad_regisno));
												if($est){
												  $est->ems_updateby = 'sys';
												  $est->ems_modified = date('Y-m-d H:i:s');
												  $est->ems_remark = $sad_accno;
												  $est->ems_status = 2;
												  if($est->save()){
													  $sts = 0;
												  }else{
													  $sts = 2;
												  }//if
												}//if
												
												  //update crop_v_bran =========================================
												  $cvb=CropVBran::model()->findByAttributes(array('registernumber'=>$sad_regisno));
												  if($cvb){
													$cvb->acc_no = $sad_accno;
													$cvb->crop_remark = 'A';
													$cvb->crop_updatetime = date('Y-m-d H:i:s');
													$cvb->crop_status = 4;
													if($cvb->save()){
														$sts = 0;
													}else{
														$sts = 1;
													}
												  }//if
												
											  }else{//if
												  $sts = 3;
											  }//if
											}else{//if
											  $sts = 4;
											}//if
									  }else{//if
										  $sts = 5;
									  }
								  }//if
							  }//if
						  }//if
						  //จบ update data=====================================
							
					  $transaction->commit(); //ถ้าทำงานผ่า่นทุกฟังก์ชั่น
							
							$levremark = "cleansing step3 auto registernumber : " . $sad_regisno . " sapiens accno:" . $sad_accno . " wpd accno:" . $acc_no;
							$msgresult = Yii::app()->Clogevent->createlogevent("Cleansing", "Sapiens", "Wpd", "data", $levremark);
							
						   echo preg_replace("/\xEF\xBB\xBF/", "","cleansing step3 auto is success");	
							
				  }catch (\Exception $e){
					  $transaction->rollBack();
					  throw $e;
					  echo preg_replace("/\xEF\xBB\xBF/", "","cleansing step3 auto is failed");
				  }//try
				  //==== try stop =================================================================================
				  
			 }else{//if
			 	//echo preg_replace("/\xEF\xBB\xBF/", "","cleansing step3 auto not have data for cleansing");
			 }//if
			 $rowno = $rowno +1;
		   }else{//if
		   		//echo preg_replace("/\xEF\xBB\xBF/", "","cleansing step3 auto not have data for cleansing");
		   }//if
	  }//foreach
	  
	?>
	
</body>
</html>