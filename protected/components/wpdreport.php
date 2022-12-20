<?php

class wpdreport extends CApplicationComponent
{

	public function createcrop_v_bran($cropid, $registernumber, $cropinfotmptb = NULL)
	{

		$qbrn = new CDbCriteria([
			'condition' => "crop_id = :crop_id ORDER BY ordernumber ASC LIMIT 0,1 ",
			'params'    => [':crop_id' => $cropid]
		]);

		//branch_tmp_tb
		$rbrn = BranchTmpTb::model()->findAll($qbrn);


		foreach ($rbrn as $rows) {

			// arr( $rows );

			$brch_id = $rows->brch_id;
			$crop_id = $rows->crop_id;
			$registernumber = $rows->registernumber;
			$tsic = $rows->tsic;
			$ordernumber = $rows->ordernumber;

			$housenumber = $rows->housenumber;
			$buildingname = $rows->buildingname;
			$buildingnumber = $rows->buildingnumber;
			$buildingfloor = $rows->buildingfloor;
			$village = $rows->village;
			$moo = $rows->moo;
			$soi = $rows->soi;
			$road = $rows->road;
			$tumbon = $rows->tumbon;
			$ampur = $rows->ampur;
			$ampurcode = $rows->ampurcode;
			$province = $rows->province;
			$provincecode = $rows->provincecode;
			$zipcode = $rows->zipcode;
			$phonenumber = $rows->phonenumber;
			$faxnumber = $rows->faxnumber;
			$email = $rows->email;


			//get cropinfo 
			$qcf1 = CropinfoTmpTb::model()->findByAttributes(array('crop_id' => $crop_id));

			// arr($qcf1->registername);
			$registername = $qcf1->registername;
			$acc_no = $qcf1->acc_no;
			$acc_bran = $qcf1->acc_bran;
			$tsic = $qcf1->tsic;
			$tsicname = $qcf1->tsicname;

			$registerdate = $qcf1->registerdate;

			$crop_createtime = $qcf1->crop_createtime;
			$crop_updatetime = $qcf1->crop_updatetime;

			//get address
			if ($housenumber != "-") {
				$housenumberf = $housenumber;
			} else {
				$housenumberf = "";
			}

			if ($buildingname != "-") {
				$buildingnamef = " "  . $buildingname;
			} else {
				$buildingnamef = "";
			}

			if ($buildingnumber != "-") {
				$buildingnumberf = " " . $buildingnumber;
			} else {
				$buildingnumberf = "";
			}

			if ($buildingfloor != "-") {
				$buildingfloorf = " " . $buildingfloor;
			} else {
				$buildingfloorf = "";
			}

			if ($village != "-") {
				$villagef = " " . $village;
			} else {
				$villagef = "";
			}

			if ($moo != "-") {
				$moof = " ม." . $moo;
			} else {
				$moof = "";
			}

			if ($soi != "-") {
				$soif = " " . $soi;
			} else {
				$soif = "";
			}

			if ($road != "-") {
				$roadf = " " . $road;
			} else {
				$roadf = "";
			}

			if ($tumbon != "-") {
				$tumbonf = " " . $tumbon;
			} else {
				$tumbonf = "";
			}

			if ($ampur != "-") {
				$ampurf = " " . $ampur;
			} else {
				$ampurf = "";
			}

			if ($province != "-") {
				$provincef = " " . $province;
			} else {
				$provincef = "";
			}

			if ($zipcode != "-") {
				$zipcodef = " " . $zipcode;
			} else {
				$zipcodef = "";
			}

			$addressf = $housenumberf . $buildingnamef . $buildingnumberf . $buildingfloorf . $villagef . $moof . $soif . $roadf . $tumbonf . $ampurf . $provincef . $zipcodef;

			$qcvb = new CDbCriteria(array(
				'condition' => "crop_id = :crop_id ORDER BY crop_id DESC LIMIT 0, 1",
				'params' => array(':crop_id' => $cropid)
			));

			$cvb = CropVBran::model()->findAll($qcvb);

			if (count($cvb) == 0) { //ยังไม่มีข้อมูล

				$qsb = new CDbCriteria(array(
					'condition' => "ZONE_AMPUR_CODE = :ZONE_AMPUR_CODE ORDER BY ZONE_AMPUR_CODE DESC LIMIT 0,1",
					'params'    => array(':ZONE_AMPUR_CODE' => $ampurcode)
				));

				//wpd_spn_lt_ssobran
				$rsb2 = WpdSpnLtSsobran::model()->findAll($qsb);

				$SSO_BRAN_CODE2 = "-"; //$rows2->SSO_BRAN_CODE;
				$SSO_BRN_NAME2 = "-"; //$rows2->SSO_BRN_NAME;
				$ZONE_AMPUR_NAME2 = "-"; //$rows2->ZONE_AMPUR_NAME;
				foreach ($rsb2 as $rows2) {

					$SSO_BRAN_CODE2 = $rows2->SSO_BRAN_CODE;
					$SSO_BRN_NAME2 = $rows2->SSO_BRN_NAME;
					$ZONE_AMPUR_NAME2 = $rows2->ZONE_AMPUR_NAME;
				}

				//ค้นหารายการสถานะนิติบุคคลที่มีลูกจ้างหรือยัง
				//$emps=EmpstateTb::model()->findByAttributes(array('ems_accno'=>$acc_no, 'ems_registernumber'=>$registernumber));
				$qemps = new CDbCriteria(array(
					'condition' => "ems_accno = :ems_accno and  ems_registernumber = :ems_registernumber",
					'params'    => array(':ems_accno' => $acc_no, ':ems_registernumber' => $registernumber)
				));
				$emps = EmpstateTb::model()->findAll($qemps);
				
				$ems_email = $email;
				$ems_numofemp = 0;
				$ems_totalsalary = 0.00;
				foreach ($emps as $rows4) {
					$ems_email = $rows4->ems_email;
					$ems_numofemp = $rows4->ems_numofemp;
					$ems_totalsalary = $rows4->ems_totalsalary;
				}

				
				//insert data to crop_v_bran
				$CropVBran = new CropVBran();

				$CropVBran->totalsalary = $ems_totalsalary;
				$CropVBran->numofemp = $ems_numofemp;
				$CropVBran->email = $ems_email;
				$CropVBran->brch_id = $brch_id;
				$CropVBran->crop_id = $crop_id;
				$CropVBran->registernumber = $registernumber;
				$CropVBran->ordernumber = $ordernumber;
				$CropVBran->ampcode = $ampurcode;
				$CropVBran->SSO_BRAN_CODE = $SSO_BRAN_CODE2;
				$CropVBran->SSO_BRN_NAME = $SSO_BRN_NAME2;
				$CropVBran->ZONE_AMPUR_NAME = $ZONE_AMPUR_NAME2;
				$CropVBran->registerdate = $registerdate;
				$CropVBran->registername = $registername;
				$CropVBran->tsic = $tsic;
				$CropVBran->tsicname = $tsicname;
				$CropVBran->address = $addressf;
				$CropVBran->phonenumber = $phonenumber;
				$CropVBran->faxnumber = $faxnumber;
				$CropVBran->acc_no = $acc_no;
				$CropVBran->acc_bran = $acc_bran;
				$CropVBran->crop_remark = "P"; //$crop_remark;
				$CropVBran->crop_createtime = $crop_createtime;
				$CropVBran->crop_updatetime = $crop_updatetime;
				$CropVBran->crop_status = 2; //$crop_status;

				// echo json_encode($CropVBran);

				$CropVBran->save();
				 
			}
		}
	}

	public function updatetob($cropid, $registernumber)
	{
		//update status is B
		//echo "{$cropid},{$registernumber} <br>";
		$qcvbu = CropVBran::model()->findByAttributes(array('crop_id' => $cropid, 'registernumber' => $registernumber));

		$qcvbu->crop_remark = "B";
		$qcvbu->crop_updatetime = date('Y-m-d H:i:s');
		$qcvbu->crop_status = "3";
		if ($qcvbu->save()) {
			//echo "update data is success!";
			//echo CJSON::encode(array('status' => 'success'));
		} else {
			//echo "can't update data!";
			//echo CJSON::encode(array('status' => 'error'));
			//echo CJSON::encode($updateusa->getErrors());
		} //if
	} //function


	public function updatetoa($cropid, $registernumber)
	{
		//update status is B
		$qcvbu = CropVBran::model()->findByAttributes(array('crop_id' => $cropid, 'registernumber' => $registernumber));
		$qcvbu->crop_remark = "A";
		$qcvbu->crop_updatetime = date('Y-m-d H:i:s');
		$qcvbu->crop_status = "4";
		if ($qcvbu->save()) {
			//echo "update data is success!";
			//echo CJSON::encode(array('status' => 'success'));
		} else {
			//echo "can't update data!";
			//echo CJSON::encode(array('status' => 'error'));
			//echo CJSON::encode($updateusa->getErrors());
		} //if
	} //function

}//class
