<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */

	private $idtoken_logout;

	/*function init(){
		//if(Yii::app()->user->isGuest){
			//parent::chkLogin(); 
		//}
	}*/

	public function actionCalldbdservice2auto()
	{

		// echo 'dsafddsds';

		$conn = Yii::app()->db;

		if (false) {

			$bgdatep = date('m/d/Y');
			$eddatep = date('m/d/Y');
		} else {

			$bgdatep = '12/16/2022';
			$eddatep = '12/16/2022';
		}
		$bgdatep = isset( $_POST['bgdatep'])?  $_POST['bgdatep']: date('m/d/Y');
		$eddatep = isset( $_POST['eddatep'])?  $_POST['eddatep']: date('m/d/Y');

		$this->callGooApi($bgdatep, $eddatep, $newdap = 1);


		$sql = "
			SELECT 
				*, 
				date_format( registerdate, '%m/%d/%Y' ) as t 
			FROM cropinfo_tmp_tb having t = :bgdatep  
		";

		$command = $conn->createCommand($sql);

		$command->bindValue(":bgdatep", $bgdatep);

		$model = $command->queryAll();

		echo json_encode([
			'success' => 1,
			'data' => $model,

		]);

	
	}

	public function actionCalldbdservice2()
	{

		// arr(date('Y-m-d'));

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {

				$conn = Yii::app()->db;

				if (true) {

					$bgdatep = $_POST['bgdatep'];
					$eddatep = $_POST['eddatep'];
				} else {

					$bgdatep = '12/16/2022';
					$eddatep = '12/16/2022';
				}

				$this->callGooApi($bgdatep, $eddatep, $newdap = 1);

				$sql = "
					SELECT 
						*, 
						date_format( registerdate, '%m/%d/%Y' ) as t 
					FROM cropinfo_tmp_tb having t = :bgdatep  
				";

				$command = $conn->createCommand($sql);

				$command->bindValue(":bgdatep", $bgdatep);

				$model = $command->queryAll();  //var_dump($rows);exit;

				$data1 = [
					'bgdatep' => $bgdatep,
					'eddatep' => $eddatep,
					'newdap' => 1,
					'updap' => 0,
					'model' => $model,
					'countmedel' => count($model),

				];

				// $data1['test'] = $test;

				$this->layout = 'nolayout';

				$this->render('/site/servicepages/calldbdservice2', $data1);
			} else {
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else {
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}


	private function callGooApi($bgdatep = NULL, $eddatep = NULL, $newdap = NULL, $cronjob = true)
	{
		// exit;


		if ($cronjob == true) {

			$username = "sys";
		} else {

			$username = "sys";
			if (Yii::app()->user->username) {
				$username = Yii::app()->user->username;
			}
		}

		 $startdate = $bgdatep . "T00:00:00+07:00";

		//  '<br>';
		$enddate = $eddatep . "T23:59:59+07:00";

		 $startdate = date_create($startdate)->format('Y-m-d') . "T00:00:00+07:00";

		//  '<br>';
		$enddate = date_create($enddate)->format('Y-m-d') . "T23:59:59+07:00";


		 $rundate = date_create($bgdatep)->format('Ymd');

		//  '<br>';

		//  "data formate : {$startdate}, {$enddate} <br>";
		// exit;

		$qlrs = new CDbCriteria(array(
			'condition' => "lrs_remark = :lrs_remark ",
			'params'    => array(':lrs_remark' => $rundate)
		));


		//wpdlogdb.logrunservice_tb 
		$rlrs = LogrunserviceTb::model()->findAll($qlrs);

		if ($newdap == 1) {

			if (true) {

				$testData['CorpInfoList']['corpInfo'][0] = [
					'cpower' => 'cpower',
					'tsic' => 87878,
					'corpType' => 1,
					'tsicName' => 87878,
					'corpTypeName' => 87878,
					'registerNumber' => '3100203295971',
					'registerName' => 87878,
					'registerDate' => '2022-12-16 22:22:01',
					'updatedDate' => '2022-01-01 22:22:01',
					'updatedEntry' => '1',
					'branches' => [
						'branch' =>  [
							[
								'name' => 'aaaaaaaaa',
								'orderNumber' => 1,
								'houseId' => 99,
								'houseNumber' => 99,
								'buildingName' => 'dsddssdsdsd',
								'buildingNumber' => '0515',
								'buildingFloor' => '4',
								'village' => '45',
								'moo' => '9',
								'Soi' => 'โรงเหล้า',
								'Road' => 'รถไฟ',
								'tumbon' => 'บางซื่อ',
								'ampur' => 'บางซื่อ',
								'province' => 'กทม.',
								'tumbonCode' => '12345',
								'ampurCode' => '1036',
								'provinceCode' => '12345',
								'zipCode' => '10800',
								'phoneNumber' => '08563787',
								'faxNumber' => '08563787',
								'email' => 'bombbomb1980@gmail.com',
							],
						]
					],
					'committees' => [
						'committee' => [
							[
								'committeeType' => '1',
								'orderNumber' => 99,
								'identityType' => 1,
								'identity' => 99,
								'title' => 'นาย',
								'firstName' => 'ปิยพงษ์',
								'lastName' => 'ไวถนอมทรัพย์',
								'englishTitle' => 'mr.',
								'englishFirstName' => 'piyapong',
								'englishLastName' => 'waitanomthap',
								'nationality' => 'th',
								'dateOfBirth' => '1980-11-16',
							],
						]
					],
				];

				$testData = json_encode($testData);

				$data = json_decode($testData);
			} else {

				//https://wsg.sso.go.th:443/corpinfo-webservice-v5/CorpInfoWebService?wsdl
				//https://wsg.sso.go.th/corpinfo-webservice-v2/CorpInfoWebService?wsdl
				$fullPathToWsdl = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CorpInfoWebServiceV5.wsdl';

				//   arr($fullPathToWsdl);
				$client = new SoapClient($fullPathToWsdl, [
					'stream_context' => stream_context_create([
						'ssl' => [
							'verify_peer' => false,
							'verify_peer_name' => false,
						],
					]),
				]);

				$params = array(
					"subscribeId" => '6211003', //usersso
					"pincode" => 'P@ssw0rd', //pinsso
					"corpInfoFilter" => array("corpType" => '*', "tsic" => '*', "province" => '*'),
					"registerDateRange" => array("startDate" => $startdate, "endDate" => $enddate),
					"changeDateRange" => null, //$changeDateRange, 
					"newEntry" => true, //true
					"changedEntry" => false, //false,
					"recordOffset" => 0,
					"recordLimit" => 1000
					//registerNumber => "0103555016414"
				);

				$data = $client->GetCorpInfoService($params);
			}

			$CorpInfoList = [];

			if (property_exists($data->CorpInfoList, "corpInfo")) {
				if (is_array($data->CorpInfoList->corpInfo)) {

					$CorpInfoList = $data->CorpInfoList->corpInfo;
				} else {

					$CorpInfoList[] = $data->CorpInfoList->corpInfo;
				}
				$rowno = 1;
				$dupstate = 0; //ค่าเริ่มต้น
				foreach ($CorpInfoList as $ko => $vo) {

					$ciftm = CropinfoTmpTb::model()->findByAttributes(array('registernumber' => $vo->registerNumber));

					$lastcrop_id = NULL;

					if ($ciftm) {

						continue;
						// $lastcrop_id = $ciftm->crop_id ;

						// arr($lastcrop_id );
					}

					$tsic = "-";
					if (property_exists($vo, "tsic")) {
						$tsic = $vo->tsic;
					}


					$tsicName = "-";
					if (property_exists($vo, "tsicName")) {
						$tsicName = $vo->tsicName;
					}

					$corpType = "-";
					if (property_exists($vo, "corpType")) {
						$corpType = $vo->corpType;
					}

					$registerNumber = '-';
					if (property_exists($vo, "registerNumber")) {
						$registerNumber = $vo->registerNumber;
					}


					if (property_exists($vo, "registerDate")) {
						$registerDate = $vo->registerDate;
						// arr($registerDate); exit;

						$registerDate =  date_create($registerDate)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
					} else {
						$registerDate =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');  //date('Y-m-d H:i:s');
					}

					$updatedDate =  date('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
					if (property_exists($vo, "updatedDate")) {
						$updatedDate = $vo->updatedDate;
					}

					//cropinfo_tmp_tb
					$CropinfoMasTb = new CropinfoTmpTb();

					$CropinfoMasTb->corptype = isset($vo->corpType) ? $vo->corpType : '-';
					$CropinfoMasTb->corptypename = isset($vo->corpTypeName) ? $vo->corpTypeName : '-';
					$CropinfoMasTb->registernumber = $registerNumber;
					$CropinfoMasTb->registername = isset($vo->registerName) ? $vo->registerName : '-';
					$CropinfoMasTb->cpower = isset($vo->cpower) ? $vo->cpower : '-';
					$CropinfoMasTb->statuscode = isset($vo->statusCode) ? $vo->statusCode : '-';
					$CropinfoMasTb->accountingdate = isset($vo->accountingdate) ? $vo->accountingdate : '-';
					$CropinfoMasTb->authorizedcapital =  isset($vo->authorizedCapital) ? $vo->authorizedCapital : 0;
					$CropinfoMasTb->updateentry =  isset($vo->updatedEntry) ? $vo->updatedEntry : '-';
					$CropinfoMasTb->updateddate = $updatedDate;
					$CropinfoMasTb->acc_no = "0000000000";
					$CropinfoMasTb->acc_bran = "000000";
					$CropinfoMasTb->tsic = $tsic;
					$CropinfoMasTb->tsicname = $tsicName;
					$CropinfoMasTb->registerdate = $registerDate;
					$CropinfoMasTb->crop_remark = "N";
					$CropinfoMasTb->crop_createby = $username;
					$CropinfoMasTb->crop_createtime = date('Y-m-d H:i:s');
					$CropinfoMasTb->crop_updateby = $username;
					$CropinfoMasTb->crop_updatetime = date('Y-m-d H:i:s');
					$CropinfoMasTb->crop_status = 1;

					$lastcrop_id = NULL;
					if ($CropinfoMasTb->save()) {

						$lastcrop_id = $CropinfoMasTb->crop_id;
					}

					if ($lastcrop_id) {

						if (!empty($vo->committees->committee)) {

							if (is_array($vo->committees->committee)) {

								$gogo = $vo->committees->committee;
							} else {
								$gogo = [];

								$gogo[] = $vo->committees->committee;
							}


							$crow = 1;
							foreach ($gogo as $kg => $vg) {

								$committeeType = "-";
								if (property_exists($vg, "committeeType")) {
									$committeeType = $vg->committeeType;
								}


								$orderNumber = '-';
								if (property_exists($vg, "orderNumber")) {
									$orderNumber = $vg->orderNumber;
								}


								$identityType = "-";
								if (property_exists($vg, "identityType")) {
									$identityType = $vg->identityType;
								}

								$identity = "-";
								if (property_exists($vg, "identity")) {
									$identity = $vg->identity;
								}

								$title = "-";
								if (property_exists($vg, "title")) {
									$title = $vg->title;
								}



								$firstName = "-";
								if (property_exists($vg, "firstName")) {
									$firstName = $vg->firstName;
								}



								$lastName = '-';
								if (property_exists($vg, "lastName")) {
									$lastName = $vg->lastName;
								}


								$englishTitle = "-";
								if (property_exists($vg, "englishTitle")) {
									$englishTitle = $vg->englishTitle;
								}



								$englishFirstName = "-";
								if (property_exists($vg, "englishFirstName")) {
									$englishFirstName = $vg->englishFirstName;
								}




								$englishLastName = "-";
								if (property_exists($vg, "englishLastName")) {
									$englishLastName = $vg->englishLastName;
								}



								$nationality = "-";
								if (property_exists($vg, "nationality")) {
									$nationality = $vg->nationality;
								}


								if (property_exists($vg, "dateOfBirth")) {
									$dateOfBirth = date_create($vg->dateOfBirth)->format('Y-m-d H:i:s');
								} else {
									$dateOfBirth = date_create('1901-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');
								}


								//committee_tmp_tb
								$CommitteeMasTb = new CommitteeTmpTb();
								//* @property integer $cmit_id
								$CommitteeMasTb->crop_id = $lastcrop_id;
								$CommitteeMasTb->registernumber = $registerNumber;
								$CommitteeMasTb->tsic = $tsic;
								$CommitteeMasTb->corptype = $corpType;
								$CommitteeMasTb->committeetype = $committeeType;
								$CommitteeMasTb->ordernumber = $orderNumber;
								$CommitteeMasTb->typeno = $identityType;
								$CommitteeMasTb->identity = $identity;
								$CommitteeMasTb->birthday = $dateOfBirth;
								$CommitteeMasTb->title = $title;
								$CommitteeMasTb->firstname = $firstName;
								$CommitteeMasTb->lastname = $lastName;
								$CommitteeMasTb->englishtitle = $englishTitle;
								$CommitteeMasTb->englishfirstname12 =  $englishFirstName;
								$CommitteeMasTb->englishlastname = $englishLastName;
								$CommitteeMasTb->nation = $nationality;
								$CommitteeMasTb->cmit_remark = "-";
								$CommitteeMasTb->cmit_createby = $username;
								$CommitteeMasTb->cmit_createtime = date('Y-m-d H:i:s');
								$CommitteeMasTb->cmit_updateby = $username;
								$CommitteeMasTb->cmit_updatetime = date('Y-m-d H:i:s');
								$CommitteeMasTb->cmit_status = 1;

								$CommitteeMasTb->save();
							}
						}

						// if (property_exists($vo, "branches")) {
						if (!empty($vo->branches->branch)) {



							if (is_array($vo->branches->branch)) {

								$gogo = $vo->branches->branch;
							} else {

								$gogo = [];
								$gogo[] = $vo->branches->branch;
							}

							$brow = 1;
							foreach ($gogo as $kg => $vg) {

								$name = "-";
								if (property_exists($vg, "name")) {
									$name = $vg->name;
								}

								$orderNumber = 0;
								if (property_exists($vg, "orderNumber")) {
									$orderNumber = $vg->orderNumber;
								}

								$houseId = "-";
								if (property_exists($vg, "houseId")) {
									$houseId = $vg->houseId;
								}


								$houseNumber = "-";

								if (property_exists($vg, "houseNumber")) {
									$houseNumber = $vg->houseNumber;
								}


								$buildingName = "-";
								if (property_exists($vg, "buildingName")) {
									$buildingName = $vg->buildingName;
								}



								$buildingNumber = "-";
								if (property_exists($vg, "buildingNumber")) {
									$buildingNumber = $vg->buildingNumber;
								}


								$buildingFloor = "-";
								if (property_exists($vg, "buildingFloor")) {
									$buildingFloor = $vg->buildingFloor;
								}



								$village = "-";
								if (property_exists($vg, "village")) {
									$village = $vg->village;
								}



								$moo = '-';
								if (property_exists($vg, "moo")) {
									$moo = $vg->moo;
								}


								$Soi = '-';
								if (property_exists($vg, "Soi")) {
									$Soi = $vg->Soi;
								}


								$Road = "-";
								if (property_exists($vg, "Road")) {
									$Road = $vg->Road;
								}



								$tumbon = '-';
								if (property_exists($vg, "tumbon")) {
									$tumbon = $vg->tumbon;
								}



								$ampur = "-";
								if (property_exists($vg, "ampur")) {
									$ampur = $vg->ampur;
								}



								$province = "-";
								if (property_exists($vg, "province")) {
									$province = $vg->province;
								}



								$tumbonCode = "-";
								if (property_exists($vg, "tumbonCode")) {
									$tumbonCode = $vg->tumbonCode;
								}


								$ampurCode = "-";
								if (property_exists($vg, "ampurCode")) {
									$ampurCode = $vg->ampurCode;
								}


								$provinceCode = "-";

								if (property_exists($vg, "provinceCode")) {
									$provinceCode = $vg->provinceCode;
								}



								$zipCode = "-";
								if (property_exists($vg, "zipCode")) {
									$zipCode = $vg->zipCode;
								}



								$phoneNumber = "-";
								if (property_exists($vg, "phoneNumber")) {
									$phoneNumber = $vg->phoneNumber;
								}


								$faxNumber = "-";
								if (property_exists($vg, "faxNumber")) {
									$faxNumber = $vg->faxNumber;
								}


								$email = "-";
								if (property_exists($vg, "email")) {
									$email = $vg->email;
								}


								//ค้นหา สปส รับผิดชอบ ----------------------------------------------------------

								$SSO_BRAN_CODE = '-';
								if ($ampurCode != "-") {

									$qldd1 = new CDbCriteria(array(
										'condition' => "ZONE_AMPUR_CODE = :ZONE_AMPUR_CODE ORDER BY ZONE_AMPUR_CODE DESC LIMIT 0,1 ",
										'params'    => array(':ZONE_AMPUR_CODE' => $ampurCode)  //  $statusgt
									));
									$dd1 = WpdSpnLtSsobran::model()->findAll($qldd1);


									foreach ($dd1 as $rows) {
										$SSO_BRAN_CODE = $rows->SSO_BRAN_CODE;
									}
								}


								$BranchMasTb = new BranchTmpTb();

								$BranchMasTb->brch_remark = $SSO_BRAN_CODE;
								$BranchMasTb->crop_id = $lastcrop_id;
								$BranchMasTb->registernumber = $registerNumber;
								$BranchMasTb->tsic = $tsic;
								$BranchMasTb->corptype = $corpType;
								$BranchMasTb->ordernumber = $orderNumber;
								$BranchMasTb->name = $name;
								$BranchMasTb->houseid = $houseId;
								$BranchMasTb->housenumber = $houseNumber;
								$BranchMasTb->buildingname = $buildingName;
								$BranchMasTb->buildingnumber = $buildingNumber;
								$BranchMasTb->buildingfloor = $buildingFloor;
								$BranchMasTb->village = $village;
								$BranchMasTb->moo = $moo;
								$BranchMasTb->soi = $Soi;
								$BranchMasTb->road = $Road;
								$BranchMasTb->tumbon = $tumbon;
								$BranchMasTb->tumboncode = $tumbonCode;
								$BranchMasTb->ampur = $ampur;
								$BranchMasTb->ampurcode = $ampurCode;
								$BranchMasTb->province = $province;
								$BranchMasTb->provincecode = $provinceCode;
								$BranchMasTb->zipcode = $zipCode;
								$BranchMasTb->phonenumber = $phoneNumber;
								$BranchMasTb->faxnumber = $faxNumber;
								$BranchMasTb->email = $email;
								$BranchMasTb->brch_createby = $username;
								$BranchMasTb->brch_createtime = date('Y-m-d H:i:s');
								$BranchMasTb->brch_updateby = $username;
								$BranchMasTb->brch_updatetime = date('Y-m-d H:i:s');
								$BranchMasTb->brch_status = 1;

								$BranchMasTb->save();
							}
						}
					}
				}
			}


			$countcorpinfo = count($CorpInfoList);



			//logrunservice_tb
			$LogrunserviceTb = new LogrunserviceTb();
			//* @property integer $lrs_id
			$LogrunserviceTb->lrs_servicename = "service1";
			$LogrunserviceTb->lrs_rundate = date('Y-m-d H:i:s');
			$LogrunserviceTb->lrs_resultrecord = $countcorpinfo;
			$LogrunserviceTb->lrs_createby = $username;
			$LogrunserviceTb->lrs_created = date('Y-m-d H:i:s');
			$LogrunserviceTb->lrs_updateby = $username;
			$LogrunserviceTb->lrs_modified = date('Y-m-d H:i:s');
			$LogrunserviceTb->lrs_remark = $rundate;
			$LogrunserviceTb->lrs_status = "1";

			if ($LogrunserviceTb->save()) {
				$lremark = "runserviceดึงข้อมูลจากdbd:service1&" . $rundate . "&จำนวนrecord=" . $countcorpinfo;
				$msgresult = Yii::app()->Clogevent->createlogevent("runservice", "servicepage", "runservice1", "service1", $lremark);
			} else {
				$msgerror =  $LogrunserviceTb->getErrors();
				echo "{$msgerror}";
			}
		}
	}







	///site/services หลังจากกดปุ่มรัน service ต่างๆ 
	public function actionOpenservice($id = NULL)
	{
		//open page directly from url 
		if (!empty($id)) {

			if (!Yii::app()->user->isGuest) {
				if (isset(Yii::app()->user->username)) {

					$snum = $id;
					$lremark = "เปิดเมนูย่อยservice:" . $snum;
					$msgresult = Yii::app()->Clogevent->createlogevent("open", "servicepage", "openservicepage", "subservice", $lremark);
					// $this->layout = 'nolayout';

					if ($snum == 1) { //Call DBD WebService


						$this->render('/site/servicepages/dbd_webservice');
					} else if ($snum == 5) { //Export textfile & Upload to SFTP

						$this->render('/site/servicepages/service5');
					} else if ($snum == 6) { //Call LED Webservice

						$this->render('/site/servicepages/service6');
					} else if ($snum == 7) { //Data Cleansing

						$this->render('/site/servicepages/service7');
					} else if ($snum == 8) { //Gen Textfile Old WPD

						$this->render('/site/servicepages/service8');
					} else if ($snum == 9) { //RD service(ภงด. กรมสรรพากร)

						$this->render('/site/servicepages/service9');
					} else {

						$this->render('/site/servicepages/service' . $snum);
					}
				} else { //if
					$idplib = new Idplib();
					$idplib->getIdpinfo();
				}
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else {

			if (!Yii::app()->user->isGuest) {
				if (isset(Yii::app()->user->username)) {

					$snum = $_POST['snum'];
					$lremark = "เปิดเมนูย่อยservice:" . $snum;
					$msgresult = Yii::app()->Clogevent->createlogevent("open", "servicepage", "openservicepage", "subservice", $lremark);
					$this->layout = 'nolayout';

					if ($snum == 1) { //Call DBD WebService

						$this->render('/site/servicepages/service1');
					} else if ($snum == 5) { //Export textfile & Upload to SFTP

						$this->render('/site/servicepages/service5');
					} else if ($snum == 6) { //Call LED Webservice

						$this->render('/site/servicepages/service6');
					} else if ($snum == 7) { //Data Cleansing

						$this->render('/site/servicepages/service7');
					} else if ($snum == 8) { //Gen Textfile Old WPD

						$this->render('/site/servicepages/service8');
					} else if ($snum == 9) { //RD service(ภงด. กรมสรรพากร)

						$this->render('/site/servicepages/service9');
					} else {

						$this->render('/site/servicepages/service' . $snum);
					}
				} else { //if
					$idplib = new Idplib();
					$idplib->getIdpinfo();
				}
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		}
	}


	//หน้ารวมปุ่ม service ต่างๆ
	public function actionServices($id = NULL, $gogo = NULL)
	{

		if (!Yii::app()->user->isGuest) {

			if (isset(Yii::app()->user->username)) {
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "servicepage", "openservicepage", "services", "เปิดหน้าservice");
				$this->render('/site/servicepages/allservices');
			} else {
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else {
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}


	public function actionIndex()
	{
		$connection = Yii::app()->db; //get connection

		if (!Yii::app()->user->isGuest) { //if(!isset(Yii::app()->session['sub'])){ //
			//ถ้า login แล้ว
			//update status user is 2 --------------------------------
			if (isset(Yii::app()->user->username)) {

				// arr(Yii::app()->user->username);exit;
				$suser = Users::model()->findByAttributes(array('username' => Yii::app()->user->username, 'status' => 1));
				if ($suser) {

					$connection->createCommand()->update('users', ['status' => 2, 'modified' => date('Y-m-d H:i:s')], 'id = ' . $suser->id);

					$msgresult = Yii::app()->Clogevent->createlogevent("login", "loginpage", "login", "userstb", "เข้าสู่ระบบ");
				}

				if (Yii::app()->user->access_level == 'admin') {
					$this->render('index');
				} else {
					$this->render('/site/searchpages/searchs');
				}
			} else {
				echo preg_replace("/\xEF\xBB\xBF/", "", "กรุณาติดต่อผู้ดูแลระบบ เพื่อตรวจสอบสิทธ์การใช้งานโปรแกรม WPD !");
			}
		} else {


			$model = new LoginForm;
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
			if (isset($_POST['LoginForm'])) {
				$model->attributes = $_POST['LoginForm'];

				if ($model->validate() && $model->login())
					$this->redirect(Yii::app()->user->returnUrl);
			}

			$this->render('login', array('model' => $model));
		}
	}

	public function actionLogout()
	{
		if (!Yii::app()->user->isGuest) {


			if (isset(Yii::app()->user->username)) {

				$suser = Users::model()->findByAttributes(['username' => Yii::app()->user->username]);

				if ($suser) {
					$connection = Yii::app()->db; //get connection

					$connection->createCommand()->update('users', ['status' => 1], 'id = ' . $suser->id);

					$msgresult = Yii::app()->Clogevent->createlogevent("logout", "loginpage", "logout", "userstb", "ออกจากระบบ");
				}

				Yii::app()->session->destroy();
				Yii::app()->user->logout();

				$this->redirect('/');

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}




	public function actionTest($a = NULL, $b = NULL)
	{

		// $cty_id = 1;
		// $conn = Yii::app()->db;
		// $sql = "SELECT * FROM corptype_tb WHERE cty_id =:cty_id";


		// $command = $conn->createCommand($sql);
		// $command->bindValue(":cty_id", $cty_id);
		// $rowA = $command->queryAll();
		// arr($rowA);
	}



	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}



	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionShowabout()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "aboutpage", "openabountpage", "about", "เปิดหน้าAbout");
				$this->render('index');
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo preg_replace("/\xEF\xBB\xBF/", "", $error['message']);
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */

	public function actionContact()
	{
		$model = new ContactForm;
		if (isset($_POST['ContactForm'])) {
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate()) {
				$headers = "From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
				Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', array('model' => $model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo preg_replace("/\xEF\xBB\xBF/", "", CActiveForm::validate($model));
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}



	public function actionOpenhome()
	{
		if (!Yii::app()->user->isGuest) {
			$this->layout = 'nolayout';
			$this->render('home');
		}
	}



	public function actionSearchs()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "searchpage", "opensearchpage", "search", "เปิดหน้าsearch");
				$this->render('/site/searchpages/searchs');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionReports()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "reportpage", "openreportpage", "report", "เปิดหน้าreport");
				$this->render('/site/reportpages/reports');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionAdmins()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "adminpage", "openadminpage", "admin", "เปิดหน้าadmin");
				$this->render('/site/adminpages/admins');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}




	public function actionOpenpnd()
	{

		//$idplib = new Idplib();
		//$idplib->getIdpinfo();

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$snum = $_POST['snum'];
				$lremark = "เปิดเมนูย่อยsearch:" . $snum;
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "searchpage", "opensearchpage", "subsearch", $lremark);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/pnd' . $snum);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}


	public function actionOpensearch()
	{

		//$idplib = new Idplib();
		//$idplib->getIdpinfo();

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$snum = $_POST['snum'];
				$lremark = "เปิดเมนูย่อยsearch:" . $snum;
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "searchpage", "opensearchpage", "subsearch", $lremark);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/search' . $snum);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionOpenreport()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$snum = $_POST['snum'];
				$lremark = "เปิดเมนูย่อยreport:" . $snum;
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "reportpage", "openreportpage", "subreport", $lremark);
				$this->layout = 'nolayout';
				$this->render('/site/reportpages/report' . $snum);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionOpenadmin()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$snum = $_POST['snum'];
				$lremark = "เปิดเมนูย่อยadmin:" . $snum;
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "adminpage", "openadminpage", "subadmin", $lremark);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/admin' . $snum);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionOpenadminuser()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$snum = $_POST['snum'];
				$lremark = "เปิดเมนูย่อยadminuser:" . $snum;
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "adminuserpage", "openadminuserpage", "subadminuser", $lremark);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/admin1' . $snum);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalldbdservice()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				//bgdatep,eddatep,newdap,updap
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];
				//echo 'ส่งข้อมูลสำเร็จ.' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
				$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
				$this->layout = 'nolayout';
				//$this->render('/site/servicepages/callaspservice');
				$this->render('/site/servicepages/calldbdservice', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}





	public function actionCalldbdservice3()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];
				//echo 'ส่งข้อมูลสำเร็จ.' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
				$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/calldbdservice3', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalldbdservice3auto()
	{

		$bgdatep = $_POST['bgdatep'];
		$eddatep = $_POST['eddatep'];
		$newdap = $_POST['newdap'];
		$updap = $_POST['updap'];
		//echo 'ส่งข้อมูลสำเร็จ.' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
		$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
		$this->layout = 'nolayout';
		$this->render('/site/servicepages/calldbdservice3auto', $data1);
	}

	public function actionCalldbdservice4()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];
				//echo 'ส่งข้อมูลสำเร็จ.' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
				$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/calldbdservice4', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalldbdservice4auto()
	{

		$bgdatep = $_POST['bgdatep'];
		$eddatep = $_POST['eddatep'];
		$newdap = $_POST['newdap'];
		$updap = $_POST['updap'];
		//echo 'ส่งข้อมูลสำเร็จ.' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
		$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
		$this->layout = 'nolayout';
		$this->render('/site/servicepages/calldbdservice4auto', $data1);
	}


	public function actionCallwpdservice1()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$bgdatep = $_POST['bgdatep'];
				$rundate = date_create($bgdatep)->format('Ymd');
				//echo "{$action}";
				Yii::app()->Clogrunservice->lrs_servicename = "service1";
				Yii::app()->Clogrunservice->lrs_remark = $rundate; //date('Ymd'); //$rundate;	

				$resultlrs = Yii::app()->Clogrunservice->checkexists2();

				echo preg_replace("/\xEF\xBB\xBF/", "", "{$resultlrs}");
				/*if(!Yii::app()->Clogrunservice->checkexists2()){
			echo "No data";
		}else{
			echo "Have data";
		}*/
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallservice2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$aa = $_POST['aa'];
				Yii::app()->CWpdApi->registernumber = "0905562002699"; //กำหนดค่าให้ property in class
				Yii::app()->CCropinfo_tmp->registernumber = "0905562002699"; //กำหนดค่าให้ property in class
				$msg1 = Yii::app()->CWpdApi->getVersion();
				$msg2 = Yii::app()->CCropinfo_tmp->create_corpinfo_temp();
				$msg3 = Yii::app()->CWpdApi->getVar1();
				echo preg_replace("/\xEF\xBB\xBF/", "", "Test Callservice {$aa} : {$msg1} <br> {$msg2}, {$msg3}");
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallservice3()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$provicecode = $_POST['provicecode']; //รับค่าจาก view
				$registernumber = $_POST['registernumber'];
				Yii::app()->CGenAccNo->provice_code = $provicecode; //กำหนดค่าให้ propreties
				Yii::app()->CGenAccNo->registernumber = $registernumber;
				//$msg3 = Yii::app()->CGenAccNo->getVar1();
				$numrows = Yii::app()->CGenAccNo->RowsCount();
				Yii::app()->CGenAccNo->rowcountnew = intval($numrows) + 1;
				$newrow = Yii::app()->CGenAccNo->rowcountnew;
				$genacc = Yii::app()->CGenAccNo->genAccNumber(); //เรียกใช้ method 
				$createnumprovice = Yii::app()->CGenAccNo->updatenumprovice();
				//$createc = Yii::app()->CGenAccNo->CreateNewAcc(); 
				echo preg_replace("/\xEF\xBB\xBF/", "", "{$numrows},-{$genacc}-, {$newrow}, {$createnumprovice}"); //{$numrows}, {$newrow}, {$createnumprovice}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallservice4()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				if ($action == "add") {
					/*
			$f1 = iconv("utf-8","tis-620","8000");
			$f2 = iconv("utf-8","tis-620","25620501");
			$f3 = iconv("utf-8","tis-620","102016");
			$f4 = iconv("utf-8","tis-620","8320000025");
			$f5 = iconv("utf-8","tis-620","000000");
			$f6 = iconv("utf-8","tis-620","0835562007340");
			$f7 = iconv("utf-8","tis-620","อีซี่ ทัวร์ เพอร์ซันนอล เทเลอร์");
			$f8 = iconv("utf-8","tis-620","01");
			$f9 = iconv("utf-8","tis-620","52/134 หมู่.2");
			$f10 = iconv("utf-8","tis-620","ตำบลวิชิต");
			$f11 = iconv("utf-8","tis-620","8301");
			$f12 = iconv("utf-8","tis-620","83");
			$f13 = iconv("utf-8","tis-620","83000");
			$f14 = iconv("utf-8","tis-620","0645406893");
			$f15 = iconv("utf-8","tis-620","0645406893");
			$f16 = iconv("utf-8","tis-620","25620601");
			$f17 = iconv("utf-8","tis-620","");
			*/

					Yii::app()->CGenAccNo->provice_code = "11"; //กำหนดค่าให้ propreties
					Yii::app()->CGenAccNo->registernumber = "0115562012587";

					//set data to properties
					Yii::app()->CCropinfo_tmp->registernumber = "0115562012587"; // VARCHAR( 13 ) NOT NULL COMMENT 'เลขทะเบียนนิติบุคคล' ,
					Yii::app()->CCropinfo_tmp->registername = "คุ้มหลวง ทูยู"; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อที่ใช้จดทะเบียน' ,
					Yii::app()->CCropinfo_tmp->acc_no = Yii::app()->CGenAccNo->genAccNumber(); // VARCHAR( 10 ) NOT NULL COMMENT 'เลขที่บัญชี' ,
					Yii::app()->CCropinfo_tmp->acc_bran = "000000"; // VARCHAR( 6 ) NOT NULL COMMENT 'สาขา' ,
					Yii::app()->CCropinfo_tmp->tsic = "47612"; // VARCHAR( 5 ) NOT NULL COMMENT 'รหัส tsic' ,
					Yii::app()->CCropinfo_tmp->tsicname = "ร้านขายปลีกเครื่องเขียนและเครื่องใช้สำนักงาน"; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อ tsic' ,
					Yii::app()->CCropinfo_tmp->corptype = "5"; // VARCHAR( 1 ) NOT NULL COMMENT 'รหัสประเภทธุรกิจ' ,
					Yii::app()->CCropinfo_tmp->corptypename = "บริษัทจำกัด"; // VARCHAR( 1000 ) NOT NULL COMMENT 'ชื่อประเภท' ,
					Yii::app()->CCropinfo_tmp->registerdate = "2019-05-01 00:00:00"; // DATETIME NOT NULL COMMENT 'วันที่จดทะเบียน' ,
					Yii::app()->CCropinfo_tmp->updateddate = "1900-01-01 00:00:00"; // DATETIME NOT NULL COMMENT 'วันที่มีการแก้ไขข้อมูลล่าสุด' ,
					Yii::app()->CCropinfo_tmp->updateentry = "0"; // VARCHAR( 1 ) NOT NULL COMMENT 'มีการแก้ไขข้อมูลหลังจากลงทะเบียน' ,
					Yii::app()->CCropinfo_tmp->accountingdate = "3112"; // VARCHAR( 4 ) NOT NULL COMMENT 'รอบปีบัญชี' ,
					Yii::app()->CCropinfo_tmp->authorizedcapital = "1000000"; // Double(20 ,2) NOT NULL COMMENT 'ทุนจดทะเบียน' ,
					Yii::app()->CCropinfo_tmp->statuscode = "1"; // VARCHAR( 1 ) NOT NULL COMMENT 'สถานะนิติบุคคล' ,
					Yii::app()->CCropinfo_tmp->cpower = "กรรมการหนึ่งคนลงลายมือชื่อและประทับตราสำคัญของบริษัท"; // VARCHAR( 5000 ) NOT NULL COMMENT 'จำนวนหรือชื่อกรรมการที่ลงชื่อผูกพัน' ,
					Yii::app()->CCropinfo_tmp->crop_remark = "-"; // TEXT NULL COMMENT 'หมายเหตุ' ,
					Yii::app()->CCropinfo_tmp->crop_createby = "sys"; // VARCHAR( 100 ) NOT NULL COMMENT 'สร้างโดย' ,
					Yii::app()->CCropinfo_tmp->crop_createtime = date('Y-m-d H:i:s'); // DATETIME NOT NULL COMMENT 'วันที่สร้าง' ,
					Yii::app()->CCropinfo_tmp->crop_updateby = "sys"; // VARCHAR( 100 ) NOT NULL COMMENT 'แก้ไขโดย' ,
					Yii::app()->CCropinfo_tmp->crop_updatetime = date('Y-m-d H:i:s'); // DATETIME NOT NULL COMMENT 'วันที่แก้ไข' ,
					Yii::app()->CCropinfo_tmp->crop_status = 1; // TINYINT( 1 ) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ' ,

					if (!Yii::app()->CCropinfo_tmp->regexists()) {
						$createc = Yii::app()->CGenAccNo->CreateNewAcc();
						$msg_result = Yii::app()->CCropinfo_tmp->create();
					} else {
						$msg_result = "มีรายการข้อมูลเลขนิติบุคคล : " . Yii::app()->CCropinfo_tmp->registernumber . " อยู่ในระบบแล้ว.";
					}


					echo preg_replace("/\xEF\xBB\xBF/", "", "{$msg_result},");
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallservice5()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				Yii::app()->CCropinfo_tmp->registernumber = "0115562012587";
				//$msg_result = Yii::app()->CWpdApi->regexists();
				if (Yii::app()->CCropinfo_tmp->regexists()) {
					echo preg_replace("/\xEF\xBB\xBF/", "", "มีข้อมูลอยู่แล้ว");
				} else {
					echo preg_replace("/\xEF\xBB\xBF/", "", "ยังไม่มีข้อมูล");
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //public function actionCallservice5(){

	public function actionAddcommittee()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				echo preg_replace("/\xEF\xBB\xBF/", "", "{$action},");

				//กำหนดค่า ให้ properties ใน class
				Yii::app()->CCommittee_tmp->crop_id = Yii::app()->CCropinfo_tmp->getlastcorpid();
				Yii::app()->CCommittee_tmp->registernumber = "0115562012587"; //** select
				Yii::app()->CCommittee_tmp->tsic = "47612"; //** select
				Yii::app()->CCommittee_tmp->corptype = "5";  //** select
				Yii::app()->CCommittee_tmp->committeetype = "K";
				Yii::app()->CCommittee_tmp->ordernumber = 1;
				Yii::app()->CCommittee_tmp->typeno = "1";
				Yii::app()->CCommittee_tmp->identity = "1100800307965";
				Yii::app()->CCommittee_tmp->birthday = "1986-10-24 00:00:00";
				Yii::app()->CCommittee_tmp->title = "น.ส.";
				Yii::app()->CCommittee_tmp->firstname = "จันท์สุดา";
				Yii::app()->CCommittee_tmp->lastname = "นวมรัตน์";
				Yii::app()->CCommittee_tmp->englishtitle = "Ms.";
				Yii::app()->CCommittee_tmp->englishfirstname12 = "JANSUDA";
				Yii::app()->CCommittee_tmp->englishlastname = "NAWAMARAT";
				Yii::app()->CCommittee_tmp->nation = "TH";
				Yii::app()->CCommittee_tmp->cmit_remark = "-";
				Yii::app()->CCommittee_tmp->cmit_createby = "sys";
				Yii::app()->CCommittee_tmp->cmit_createtime = date('Y-m-d H:i:s');
				Yii::app()->CCommittee_tmp->cmit_updateby = "sys";
				Yii::app()->CCommittee_tmp->cmit_updatetime = date('Y-m-d H:i:s');
				Yii::app()->CCommittee_tmp->cmit_status = 1;

				if (!Yii::app()->CCommittee_tmp->committeeexists()) {
					$msg_result = Yii::app()->CCommittee_tmp->create();
				} else {
					$msg_result = preg_replace("/\xEF\xBB\xBF/", "", "มีรายการเลขที่บัตรประจำตัว : " . Yii::app()->CCommittee_tmp->identity . " อยู่ในระบบแล้ว.");
				}

				echo "{$msg_result},";
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionGetlastcorpid()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$lastcropid = Yii::app()->CCropinfo_tmp->getlastcorpid();
				echo preg_replace("/\xEF\xBB\xBF/", "", "{$action}, {$lastcropid}");
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionChkcommitteeexists()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				echo preg_replace("/\xEF\xBB\xBF/", "", "{$action}, ");
				Yii::app()->CCommittee_tmp->crop_id = 1;
				Yii::app()->CCommittee_tmp->registernumber = "0115562012587";
				Yii::app()->CCommittee_tmp->committeetype = "K";
				Yii::app()->CCommittee_tmp->ordernumber = 1;
				Yii::app()->CCommittee_tmp->identity = "1100800307965";
				if (Yii::app()->CCommittee_tmp->committeeexists()) {
					echo preg_replace("/\xEF\xBB\xBF/", "", "มีข้อมูลอยู่แล้ว");
				} else {
					echo preg_replace("/\xEF\xBB\xBF/", "", "ยังไม่มีข้อมูล");
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //public function actionChkcommitteeexists(){

	public function actionAddbbranch()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				echo preg_replace("/\xEF\xBB\xBF/", "", "{$action}, ");

				Yii::app()->CBranch_tmp->crop_id = Yii::app()->CCropinfo_tmp->getlastcorpid();
				Yii::app()->CBranch_tmp->registernumber = "0115562012587";
				Yii::app()->CBranch_tmp->tsic = "47612";
				Yii::app()->CBranch_tmp->corptype = "5";
				Yii::app()->CBranch_tmp->ordernumber = 1;
				Yii::app()->CBranch_tmp->name = "สำนักงานใหญ่";
				Yii::app()->CBranch_tmp->houseid = "11031785426";
				Yii::app()->CBranch_tmp->housenumber = "111/418";
				Yii::app()->CBranch_tmp->buildingname = "-";
				Yii::app()->CBranch_tmp->buildingnumber = "-";
				Yii::app()->CBranch_tmp->buildingfloor = "-";
				Yii::app()->CBranch_tmp->village = "-";
				Yii::app()->CBranch_tmp->moo = "4";
				Yii::app()->CBranch_tmp->soi = "-";
				Yii::app()->CBranch_tmp->road = "-";
				Yii::app()->CBranch_tmp->tumbon = "บางแก้ว";
				Yii::app()->CBranch_tmp->tumboncode = "02";
				Yii::app()->CBranch_tmp->ampur = "บางพลี";
				Yii::app()->CBranch_tmp->ampurcode = "03";
				Yii::app()->CBranch_tmp->province = "สมุทรปราการ";
				Yii::app()->CBranch_tmp->provincecode = "11";
				Yii::app()->CBranch_tmp->zipcode = "10540";
				Yii::app()->CBranch_tmp->phonenumber = "0922460043";
				Yii::app()->CBranch_tmp->faxnumber = "-";
				Yii::app()->CBranch_tmp->email = "-";
				Yii::app()->CBranch_tmp->brch_remark = "-";
				Yii::app()->CBranch_tmp->brch_createby = "sys";
				Yii::app()->CBranch_tmp->brch_createtime = date('Y-m-d H:i:s');
				Yii::app()->CBranch_tmp->brch_updateby = "sys";
				Yii::app()->CBranch_tmp->brch_updatetime = date('Y-m-d H:i:s');
				Yii::app()->CBranch_tmp->brch_status = 1;

				if (!Yii::app()->CBranch_tmp->branchexists()) {
					$msg_result = Yii::app()->CBranch_tmp->create();
				} else {
					$msg_result = "มีรายการสาขา : " . Yii::app()->CBranch_tmp->name . " อยู่ในระบบแล้ว.";
				}

				echo preg_replace("/\xEF\xBB\xBF/", "", "{$msg_result},");

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschcropinfo()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/schcropinfo', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschcropinfosp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schcropinfosp', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschcropinfosp1()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schcropinfosp1', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschcommittee()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/schcommittee', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschcommitteesp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schcommitteesp', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschbranch()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/schbranch', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschbranchsp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schbranchsp', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschdetailcrop()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/schdetailcrop', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschdetailcropsp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schdetailcropsp', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschdetailcropsp2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				//echo "{$action},{$regisnum}";
				$data1 = array('action' => $action, 'regisnum' => $regisnum);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schdetailcropsp', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionChgstatusfrm()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$crop_id = $_POST['crop_id'];
				$registernumber = $_POST['registernumber'];
				//echo "{$action},{$crop_id},{$registernumber}";
				//$match = addcslashes($eid, '%_'); // escape LIKE's special characters
				$q = new CDbCriteria(array(
					'condition' => "crop_id = :crop_id",         // no quotes around :match
					'params'    => array(':crop_id' => "{$crop_id}")  // Aha! Wildcards go here
				));
				$model = CropinfoTmpTb::model()->findAll($q);
				$encode = CJSON::encode($model);
				//echo "{$encode}";
				$data1 = array('encode' => $encode); //, 'action'=>$action, 'crop_id'=>$crop_id, 'registernumber'=>$registernumber 
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/chgstatusfrm', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionChgstatusfrmsp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$crop_id = $_POST['crop_id'];
				$registernumber = $_POST['registernumber'];
				//echo "{$action},{$crop_id},{$registernumber}";
				//$match = addcslashes($eid, '%_'); // escape LIKE's special characters
				$q = new CDbCriteria(array(
					'condition' => "crop_id = :crop_id",         // no quotes around :match
					'params'    => array(':crop_id' => "{$crop_id}")  // Aha! Wildcards go here
				));
				$model = CropinfoTmpTb::model()->findAll($q);
				$encode = CJSON::encode($model);
				//echo "{$encode}";
				$data1 = array('encode' => $encode); //, 'action'=>$action, 'crop_id'=>$crop_id, 'registernumber'=>$registernumber 
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/chgstatusfrmsp', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionChgstatusfrmsp2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$crop_id = $_POST['crop_id'];
				$registernumber = $_POST['registernumber'];
				//echo "{$action},{$crop_id},{$registernumber}";
				//ค้นหาข้อมูลเดิมก่อนแก้ไข จาก EmpstateTb
				$empdm = EmpstateTb::model()->findByAttributes(array('ems_registernumber' => $registernumber));
				$ems_email = $empdm->ems_email;
				$ems_startdate = $empdm->ems_startdate;
				$ems_numofemp = $empdm->ems_numofemp;
				$ems_totalsalary = $empdm->ems_totalsalary;
				//insert log before edit
				$levremark = "คลิกปุ่มแก้ไขข้อมูลการขึ้นทะเบียนลูกจ้างWPD_ข้อมูลเดิม" .  $registernumber . "&" . $ems_email . "&" . $ems_startdate . "&" . $ems_numofemp . "&" . $ems_totalsalary;
				$msgresult = Yii::app()->Clogevent->createlogevent($action, "BeforeEditData", "EmpstateTb", "BeforeEditEmpstateTb", $levremark);
				//$match = addcslashes($eid, '%_'); // escape LIKE's special characters
				$q = new CDbCriteria(array(
					'condition' => "crop_id = :crop_id",         // no quotes around :match
					'params'    => array(':crop_id' => "{$crop_id}")  // Aha! Wildcards go here
				));
				$model = CropinfoTmpTb::model()->findAll($q);
				$encode = CJSON::encode($model);
				//echo "{$encode}";
				$data1 = array('encode' => $encode); //, 'action'=>$action, 'crop_id'=>$crop_id, 'registernumber'=>$registernumber 
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/chgstatusfrmsp2', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallupdatestatus1()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$crop_id = $_POST['crop_id'];
				$registernumber = $_POST['registernumber'];
				$d1 = $_POST['d1']; //วันที่มีลูกจ้าง
				$e1 = $_POST['e1']; //email ติดต่อกลับ
				$accno = $_POST['accno']; //เลขประกันสังคม 10 หลัก
				$accbranch = $_POST['accbranch']; //เลขสาขา 6 หลัก
				$numemp1 = $_POST['numemp1'];
				$numemp2 = $_POST['numemp2'];

				$d1d = date_create($d1)->format('d');
				$d1m = date_create($d1)->format('m');
				$d1y = date_create($d1)->format('Y') - 543;
				$d1t = date_create($d1)->format('H:i:s');
				$d1f1 = $d1y . "-" . $d1m . "-" . $d1d . " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d1f = date_create($d1f1)->format('Y-m-d H:i:s');

				if ($e1 == "") {
					$e1 = "-";
				}
				if (!$e1) {
					$e1 = "-";
				}
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				//echo "{$action},{$crop_id},{$registernumber}, {$d1f}, {$e1}, {$accno}, {$accbranch} <br>"

				//ค้นหา status ใน cropinfo_tmp ก่อนว่าเป็น A หรือไม่ --------------------------------------------------------------------
				$cit = CropinfoTmpTb::model()->findByAttributes(array('registernumber' => $registernumber));
				$crop_remark = $cit->crop_remark;	//A
				$crop_status = $cit->crop_status; //4

				if ($crop_remark != 'A') {

					$qems = new CDbCriteria(array(
						'condition' => "ems_registernumber = :ems_registernumber ",
						'params'    => array(':ems_registernumber' => $registernumber)
					));
					$mems = EmpstateTb::model()->findAll($qems);
					$cems = count($mems);
					if ($cems == 0) {
						$EmpstateTb = new EmpstateTb();
						$EmpstateTb->ems_registernumber = $registernumber;
						$EmpstateTb->ems_accno = $accno;
						$EmpstateTb->ems_accbran = $accbranch;
						$EmpstateTb->ems_email = $e1;
						$EmpstateTb->ems_startdate = $d1f;
						$EmpstateTb->ems_numofemp = $numemp1;
						$EmpstateTb->ems_totalsalary = $numemp2;
						$EmpstateTb->ems_createby = $username;
						$EmpstateTb->ems_created = date('Y-m-d H:i:s');
						$EmpstateTb->ems_updateby = $username;
						$EmpstateTb->ems_modified = date('Y-m-d H:i:s');
						$EmpstateTb->ems_remark = "-";
						$EmpstateTb->ems_status = 1;
						if ($EmpstateTb->save()) {
							$msg = "add data is success";
							//***** update CropinfoTmpTb ***************************
							$ucif = CropinfoTmpTb::model()->findBySQL('SELECT * FROM cropinfo_tmp_tb WHERE crop_id =' . $crop_id . ' AND registernumber =' . $registernumber);
							$ucif->crop_updateby = $username;
							$ucif->crop_updatetime = date('Y-m-d H:i:s');
							$ucif->crop_remark = "B";
							$ucif->crop_status = 3;
							if ($ucif->save()) {
								$msg2 = "update data cropinfo is success.";
								//update status crop_v_bran
								$cropid = $crop_id;
								$registernumber = $registernumber;
								Yii::app()->Cwpdreport->updatetob($cropid, $registernumber);

								//********* update accnumber_tb *******************
								$anb = AccnumberTb::model()->findByAttributes(array('acc_no' => $accno, 'acc_regis_no' => $registernumber));
								$anb->acc_updateby = $username;
								$anb->acc_modified = date('Y-m-d H:i:s');
								$anb->acc_remark = "B";
								$anb->acc_status = 3;
								if ($anb->save()) {
									$msg3 = "update data is success.";
								} else {
									$msg3 = "can't update data.";
								}
								ob_clean();
								echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'success')));
							} else {
								$msg2 = $ucif->getErrors();
								ob_clean();
								echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'error')));
							}
							$levremark = "ปรับปรุงสถานะนิติบุคคลเป็นB&เพิ่มข้อมูลสถานนิติบุคคล" . $crop_id . "&" . $registernumber . "&" . $accno . "&" . $e1;
							$msgresult = Yii::app()->Clogevent->createlogevent("Update", "UpdateStatusPage", "UpdatestatustoB", "CropInfo&Empstate", $levremark);
						} else {
							$msg = $EmpstateTb->getErrors();
							ob_clean();
							echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'error')));
						}
					} //if($cems==0){

				} else { //if($crop_remark!='A')
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'success')));
				} //if($crop_remark!='A')

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


	public function actionCallupdatestatus2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************

				$action = $_POST['action'];
				$crop_id = $_POST['crop_id'];
				$registernumber = $_POST['registernumber'];
				$d1 = $_POST['d1']; //วันที่มีลูกจ้าง
				$e1 = $_POST['e1']; //email ติดต่อกลับ
				$accno = $_POST['accno']; //เลขประกันสังคม 10 หลัก
				$accbranch = $_POST['accbranch']; //เลขสาขา 6 หลัก
				$numemp1 = $_POST['numemp1'];
				$numemp2 = $_POST['numemp2'];

				$d1d = date_create($d1)->format('d');
				$d1m = date_create($d1)->format('m');
				$d1y = date_create($d1)->format('Y') - 543;
				$d1t = date_create($d1)->format('H:i:s');
				$d1f1 = $d1y . "-" . $d1m . "-" . $d1d . " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d1f = date_create($d1f1)->format('Y-m-d H:i:s');

				//echo "{$action},{$crop_id},{$registernumber}, {$d1}, {$e1}, {$accno}, {$accbranch}, {$numemp1}, {$numemp2}, {$d1f}";


				if ($e1 == "") {
					$e1 = "-";
				}
				if (!$e1) {
					$e1 = "-";
				}
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}

				//update data to EmpstateTb
				$mempst = EmpstateTb::model()->findByAttributes(array('ems_registernumber' => $registernumber)); //, 
				if ($mempst) {
					$mempst->ems_email = $e1;
					$mempst->ems_startdate = $d1f;
					$mempst->ems_numofemp = $numemp1;
					$mempst->ems_totalsalary = $numemp2;
					$mempst->ems_updateby = Yii::app()->user->username;
					$mempst->ems_modified = date('Y-m-d H:i:s');
					if ($mempst->save()) {
						$msg2 = "Update is Success";
						$levremark = "แก้ไขสถานะนิติบุคคลกรณีบันทึกครั้งแรกผิด" . $crop_id . "&" . $registernumber . "&" . $accno . "&" . $e1 . "&" . $d1f . "&" . $numemp1 . "&" . $numemp2;
						$msgresult = Yii::app()->Clogevent->createlogevent("Update", "AfterEdit", "AfterEditEmpState", "AfterEditEmpstate", $levremark);
						ob_clean();
						echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'success')));
					} else {
						$msg2 = $mrc->getErrors();
						ob_clean();
						echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'error')));
					} //if  
				} //if


				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function



	public function actionCallschstatusp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];
				//echo 'P-' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
				$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
				$this->layout = 'nolayout';
				//$this->render('/site/servicepages/callaspservice');
				$this->render('/site/servicepages/schstatusp', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschstatusb()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];
				//echo 'B-' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
				$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
				$this->layout = 'nolayout';
				//$this->render('/site/servicepages/callaspservice');
				$this->render('/site/servicepages/schstatusb', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschstatusa()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];
				//echo 'A-' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
				$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
				$this->layout = 'nolayout';
				//$this->render('/site/servicepages/callaspservice');
				$this->render('/site/servicepages/schstatusa', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallgentextfile()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$statusgt = $_POST['statusgt'];
				//echo "{$action},{$statusgt}";
				$data1 = array('action' => $action, 'statusgt' => $statusgt);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/gentextfile', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallgentextfileauto()
	{

		$action = $_POST['action'];
		$statusgt = $_POST['statusgt'];
		//echo "{$action},{$statusgt}";
		$data1 = array('action' => $action, 'statusgt' => $statusgt);
		$this->layout = 'nolayout';
		$this->render('/site/servicepages/gentextfileauto', $data1);
	} //function

	public function actionCallschbydate()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];
				//echo 'ส่งข้อมูลสำเร็จ.' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
				$levremark = "ค้นหาข้อมูลนิติบุคคลตามวันที่:" . $bgdatep . "&" . $eddatep . "&" . $eddatep . "&" . $newdap . "&" . $updap;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByDate", "Search", "CropInfo", $levremark);
				$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schbydate', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschbyinfo()
	{

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}

				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "CropInfo", $levremark);

				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schbyinfo', $data1);

				//ค้นหาข้อมุลในฐานข้อมูล WPD ก่อนว่ามีหรือไม่
				/*if($seltxt == "2"){
			//echo "{$action},{$schtxt},{$seltxt} <br>";
			$qwpd = new CDbCriteria( array(
				'condition' => "registernumber = :schtxt ",         
				'params'    => array(':schtxt' => "{$schtxt}")  
			));
			$modelwpd = CropinfoTmpTb::model()->findAll($qwpd);
			$countwpd = count($modelwpd);
			//echo "{$countwpd} <br>";
			if($countwpd == 0){ 
				//echo "not have data in wpd.";	
				//เรียกใช้ web service dbd รายตัว
				Yii::app()->CCropinfo_tmp->registernumber = $schtxt; //กำหนดค่าให้ property in class
				Yii::app()->CCropinfo_tmp->username = $username; 
				Yii::app()->CCropinfo_tmp->GetinfoByRN(); //call dbd webservice methode
				Yii::app()->CCropinfo_tmp->GenSsoNumber(); //call genssonumber method
				
				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout='nolayout';
				$this->render('/site/searchpages/schbyinfo', $data1);
				
			}else{
				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout='nolayout';
				$this->render('/site/searchpages/schbyinfo', $data1);
			}
		}else{
			$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
			$this->layout='nolayout';
			$this->render('/site/searchpages/schbyinfo', $data1);
		}*/

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschcrop6()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}

				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "CropInfo", $levremark);



				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schbyinfo2', $data1);




				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschcrop62()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}

				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "CropInfo", $levremark);



				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/2', $data1);




				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschinfodbd()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt},{$username}";
				$levremark = "search DBD :" . $seltxt . "&" . $schtxt;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "CropInfo", $levremark);
				Yii::app()->CCropinfo_tmp->registernumber = $schtxt; //กำหนดค่าให้ property in class
				Yii::app()->CCropinfo_tmp->username = $username;
				//$dbddata = Yii::app()->CCropinfo_tmp->Getinfofrmdbd(); //ดึง xml data จาก dbd
				$dbddata = Yii::app()->CCropinfo_tmp->GetinfofrmdbdV5();
				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt, 'dbddata' => $dbddata);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schinfofrmdbd', $data1);

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallschandsavecropinfo()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}

				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";
				//ค้นหาข้อมุลในฐานข้อมูล WPD ก่อนว่ามีหรือไม่
				if ($seltxt == "2") {
					//echo "{$action},{$schtxt},{$seltxt} <br>";
					$qwpd = new CDbCriteria(array(
						'condition' => "registernumber = :schtxt ",
						'params'    => array(':schtxt' => "{$schtxt}")
					));
					$modelwpd = CropinfoTmpTb::model()->findAll($qwpd);
					$countwpd = count($modelwpd);
					//echo "{$countwpd} <br>";
					if ($countwpd == 0) { //กรณีที่ยังไม่มีสถานประกอบการนั้นอยู่ในระบบ wpd

						//เริ่มกำหนด transection
						$transaction = Yii::app()->db->beginTransaction();

						try {

							//เรียกใช้ web service dbd รายตัว
							Yii::app()->CCropinfo_tmp->registernumber = $schtxt; //กำหนดค่าให้ property in class
							Yii::app()->CCropinfo_tmp->username = $username;
							Yii::app()->CCropinfo_tmp->GetinfoByRN(); //call dbd webservice methode ดึงข้อมูลใหม่จาก DBD
							Yii::app()->CCropinfo_tmp->GenSsoNumber(); //call genssonumber method สร้างเลข 10 หลักประกันสังคม

							$transaction->commit(); //ถ้าทำงานผ่า่นทุกฟังก์ชั่น

							$levremark = "insert data from DBD and gen acc_no : " . $schtxt;
							$msgresult = Yii::app()->Clogevent->createlogevent("Insert", "Cropinfo_tmp", "InsertByUser", "CropInfo", $levremark);

							echo "บันทึกข้อมูลสถานประกอบการ {$schtxt} เพิ่มเติมใน WPD เรียบร้อยแล้ว.";
						} catch (\Exception $e) {
							$transaction->rollBack();
							throw $e;
							echo "ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเกิดข้อผิดพลาดในการประมวลผลของระบบ กรุณาติดต่อผู้ดูแลระบบ !";
						} //try
					} else { //กรณีที่มีข้อมูลสถานประกอบการอยุ่แล้ว
						$transaction = Yii::app()->db->beginTransaction();
						try {

							Yii::app()->CCropinfo_tmp->registernumber = $schtxt;
							Yii::app()->CCropinfo_tmp->username = $username;

							if (Yii::app()->CCropinfo_tmp->BackupBrn()) { //backup สาขาสำนักงานใหญ่
								echo "บันทึกปรับปรุงข้อมูลสถานประกอบการ {$schtxt} เรียบร้อยแล้ว.";
							} else {
								echo "ไม่สามารถ ปรับปรุงข้อมูลสถานประกอบการ {$schtxt} !";
							}
							Yii::app()->CCropinfo_tmp->UpdateBrn(); //update ที่ตั้งสำนักงานใหญ่
							Yii::app()->CCropinfo_tmp->BackupCommittee(); //backup committee
							Yii::app()->CCropinfo_tmp->UpdateCommittee(); //update committee


							Yii::app()->CGenAccNo->registernumber = $schtxt;
							Yii::app()->CGenAccNo->CheckAndGenAccno(); //เรียกใช้ฟังก์ชั่น ตรวจสอบและ gen เลข 10 หลักใหม่


							$transaction->commit();


							$levremark = "update data bran & comittee from DBD : " . $schtxt;
							$msgresult = Yii::app()->Clogevent->createlogevent("Update", "bran_committee", "UpdateByUser", "branandcommitee", $levremark);
						} catch (\Exception $e) {
							$transaction->rollBack();
							throw $e;
							echo "มีข้อมูลสถานประกอบการ เลขที่นิติบุคคล {$schtxt} <br> อยู่ในระบบแล้ว ไม่สามารถบันทึกซ้ำได้ !";
						} //try
					}
				} else {
					echo "ไม่สามารถบันทึกข้อมูลได้ เนื่องจากเกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ !";
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionSchdetailfrm()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$crop_id = $_POST['crop_id'];
				$registernumber = $_POST['registernumber'];
				//echo "{$action},{$crop_id},{$registernumber}";
				$data1 = array('action' => $action, 'crop_id' => $crop_id, 'registernumber' => $registernumber);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schdetailfrm', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallshowtextfile()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				//echo "{$action}";
				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/showtextfile', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallusergroupfrm()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$usgid = $_POST['usgid'];
				$data1 = array('action' => $action, 'usgid' => $usgid);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/usergroupfrm', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallusergroup()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				//echo "{$action}";
				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/usergroup', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalladdusg()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$ug_name = $_POST['ustxt1'];
				$ug_remark = $_POST['ustxt2'];
				$ug_createby = "sys";
				$ug_created = date('Y-m-d H:i:s');
				$ug_updateby = "sys";
				$ug_modified = date('Y-m-d H:i:s');
				$ug_status = 1;
				//echo "{$action},{$action},{$ug_remark}";
				$q = new CDbCriteria(array(
					'condition' => "ug_name = :ug_name ",
					'params'    => array(':ug_name' => $ug_name)
				));
				$musg = UsergroupTb::model()->findAll($q);
				$countusg = count($musg);
				if ($countusg == 0) {
					$UsergroupTb = new UsergroupTb();
					$UsergroupTb->ug_name = $ug_name;
					$UsergroupTb->ug_remark = $ug_remark;
					$UsergroupTb->ug_createby = $ug_createby;
					$UsergroupTb->ug_created = $ug_created;
					$UsergroupTb->ug_updateby = $ug_updateby;
					$UsergroupTb->ug_modified = $ug_modified;
					$UsergroupTb->ug_status = $ug_status;
					if ($UsergroupTb->save()) {
						//actionCallusergroup();
						//echo "y";
						ob_clean();
						echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'success')));
					} else {
						//echo "n";
						ob_clean();
						echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'error')));
					}
				} else { //if($countusg==0)
					//echo "d";
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'errordup')));
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //actionCalladdusg()

	public function actionCallchgusg()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$udid = $_POST['udid'];
				$action = $_POST['action'];
				$ug_name = $_POST['ustxt1'];
				$ug_remark = $_POST['ustxt2'];
				$ug_updateby = "sys";
				$ug_modified = date('Y-m-d H:i:s');
				$ug_status = 1;
				//echo "{$action},{$udid}, {$ug_name}, {$ug_remark}";
				//echo CJSON::encode(array('status' => 'success'));
				$updateusg = UsergroupTb::model()->findByPk($udid);
				$updateusg->ug_name = $ug_name;
				$updateusg->ug_remark = $ug_remark;
				$updateusg->ug_updateby = $ug_updateby;
				$updateusg->ug_modified = $ug_modified;
				if ($updateusg->save()) {
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'success')));
				} else {
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'error')));
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalldelusg()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$deid = $_POST['deid'];
				$dename = $_POST['dename'];
				//echo "{$action},{$deid}, {$dename}";
				try {
					$deleteusg = UsergroupTb::model()->findByPk($deid);
					$deleteusg->delete();
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'success')));
				} catch (Exception $e) {
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'error')));
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalluserall()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				//echo "{$action}";
				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/userall', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallusafrm()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$usaid = $_POST['usaid'];
				$data1 = array('action' => $action, 'usaid' => $usaid);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/userfrm', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalladdusa()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$firstname = $_POST['usatxt1'];
				$lastname = $_POST['usatxt2'];
				$email = $_POST['usatxt5'];
				$contact_number = $_POST['usatxt6'];
				$address = $_POST['usatxt7'];
				$username = $_POST['usatxt3'];
				$password = $_POST['usatxt4'];
				$access_level = $_POST['usatxt9'];
				$access_code = $_POST['usatxt8'];
				$status = 1;
				$image = "-";
				$created = date('Y-m-d H:i:s');
				$modified = date('Y-m-d H:i:s');
				//echo "{$firstname}, {$lastname}, {$email}, {$contact_number}, {$address}, {$username}, {$password}, {$access_level}, {$access_code}, {$status}, {$image}, {$created}, {$modified}";
				$q = new CDbCriteria(array(
					'condition' => "username = :username ",
					'params'    => array(':username' => $username)
				));
				$susa = Users::model()->findAll($q);
				$countusa = count($susa);
				if ($countusa == 0) {
					$Users = new Users();
					$Users->firstname = $firstname;
					$Users->lastname = $lastname;
					$Users->email = $email;
					$Users->contact_number = $contact_number;
					$Users->address = $address;
					$Users->username = $username;
					$Users->password = $password;
					$Users->access_level = $access_level;
					$Users->access_code = $access_code;
					$Users->status = $status;
					$Users->image = $image;
					$Users->created = $created;
					$Users->modified = $modified;
					if ($Users->save()) {
						ob_clean();
						echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'success')));
					} else {
						ob_clean();
						echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'error')));
						//echo CJSON::encode($Users->getErrors());
					}
				} else { //if($countusg==0)
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'errordup')));
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallchgusa()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$udid = $_POST['udid'];
				$action = $_POST['action'];
				$firstname = $_POST['usatxt1'];
				$lastname = $_POST['usatxt2'];
				$email = $_POST['usatxt5'];
				$contact_number = $_POST['usatxt6'];
				$username = $_POST['usatxt3'];
				$password = $_POST['usatxt4'];
				$address = $_POST['usatxt7'];
				$access_level = $_POST['usatxt9'];
				$access_code = $_POST['usatxt8'];
				$modified = date('Y-m-d H:i:s');
				//echo "{$firstname}, {$lastname}, {$email}, {$contact_number}, {$username}, {$password}, {$address}, {$access_level}, {$access_code}"; exit;
				//echo CJSON::encode(array('status' => 'success'));
				$updateusa = Users::model()->findByPk($udid);

				$updateusa->firstname = $firstname;
				$updateusa->lastname = $lastname;
				$updateusa->email = $email;
				$updateusa->contact_number = $contact_number;
				$updateusa->address = $address;
				$updateusa->username = $username;
				$updateusa->password = $password;
				$updateusa->access_level = $access_level;
				$updateusa->access_code = $access_code;
				$updateusa->modified = $modified;

				if ($updateusa->save()) {
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'success')));
				} else {
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'error')));
					//echo CJSON::encode($updateusa->getErrors());
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalldelusa()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$deid = $_POST['deid'];
				$dename = $_POST['dename'];
				//echo "{$action},{$deid}, {$dename}";
				try {
					$deleteusa = Users::model()->findByPk($deid);
					$deleteusa->delete();
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'success')));
				} catch (Exception $e) {
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'error')));
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCreatelogevent()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$msgresult = Yii::app()->Clogevent->createlogevent("testadd", "tPage", "tCause", "tData", "tRemark");
				echo preg_replace("/\xEF\xBB\xBF/", "", "{$action}, {$msgresult}");
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalluploadfile()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				/*
		$action = $_POST['action'];
		$tfid = $_POST['tfid'];
		//echo "{$action},{$tfid} <br>";
		//$sqlstring = "SELECT * FROM gentextfile_tb WHERE gtf_id =" . $tfid;
		//$getpathfile = GentextfileTb::model()->findBySQL($sqlstring);
		$getpathfile = GentextfileTb::model()->findByPk($tfid);
		$gtf_name = $getpathfile->gtf_name;
		$gtf_path = $getpathfile->gtf_path;
		//echo "{$action},{$tfid}, {$gtf_name}, {$gtf_path} <br>";
		Yii::app()->Cgentextfile->gtf_name = $gtf_name;
		Yii::app()->Cgentextfile->gtf_path = $gtf_path;
		$uploadftxt = Yii::app()->Cgentextfile->uploadtf();
		//echo "{$uploadftxt}";
		if($uploadftxt=='Y'){
			$updattf = GentextfileTb::model()->findByPk($tfid);
			$updattf->gtf_statusupload = "y";
			$updattf->gtf_updateby = $username;
 			$updattf->gtf_modified = date('Y-m-d H:i:s');
			if($updattf->save()){
				$levremark = "uploadtextfiletosftpserver:" . $tfid . "&" . $gtf_name . "&" . $gtf_path;
				$msgresult = Yii::app()->Clogevent->createlogevent("Upload", "UploadfiltToSFTP", "Upload", "gentextfiletb", $levremark);
				echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => 'success')));
			}else{
				echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => 'error')));
			}
		}else{
			 echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => 'error')));
		}
		*/
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionShowfile()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				//echo "{$action}";
				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/showallfile', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalldbdbyrn()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				//echo "{$action}";	
				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/calldbdbyrn', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalladdaccno()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				echo "{$action} <br>";
				//****** insert accnumber_tb ****************************************
				$intsdata = new AccnumberTb();

				$intsdata->acc_no = "-";
				$intsdata->acc_bran = "-";
				$intsdata->acc_regis_no = "-";
				$intsdata->acc_active_flag = "-";
				$intsdata->acc_using_date = "";
				$intsdata->acc_createby = "sys";
				$intsdata->acc_created = "";
				$intsdata->acc_updateby = "sys";
				$intsdata->acc_modified = "";
				$intsdata->acc_remark = "-";
				$intsdata->acc_status = 1;

				if ($intsdata->save()) {
					//echo CJSON::encode(array('status' => 'success'));
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", "yes <br>");
				} else {
					//echo CJSON::encode(array('status' => 'error'));
					//echo CJSON::encode($Users->getErrors());
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", "no <br>");
				}
				//*********************************************************
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallshowrpt()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				//echo "{$action} <br>";
				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/reportpages/printformexcel2', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallsubrpt()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$slv = $_POST['slv'];
				//echo "{$action}, {$slv} <br>";
				$data1 = array('action' => $action, 'slv' => $slv);
				$this->layout = 'nolayout';
				$this->render('/site/reportpages/reportpage1', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallshowrpt1()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$this->layout = 'nolayout';
				$this->render('/site/reportpages/printformexcel2');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallshowrptled31()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}
				//echo $bctid;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->render('/site/reportpages/reportled31', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallsubrptled31()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$d1 = $_POST['d1'];
				$d2 = $_POST['d2'];
				$sso1 = $_POST['sso1'];
				$bct = $_POST['bct'];
				$bc = $_POST['bc'];
				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($sso1 == '0') {
					$sso1t = "ทั่วประเทศ";
				} else if ($sso1 == '1050') {
					$sso1t = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $sso1));
					$bcn = $bcr->name;
					$sso1t = $bcn;
				}

				$data1 = array('action' => $action, 'd1' => $d1, 'd2' => $d2, 'sso1' => $sso1, 'bct' => $bct, 'bc' => $bc, 'sso1t' => $sso1t);
				$this->layout = 'nolayout';
				$this->pageTitle = 'report - ' . $sso1t;
				$this->render('/site/reportpages/reportsled31sub', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallshowrptled32()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$ssobranch_code = $_GET['ssobranch_code'];
				//$d1 = $_GET['d1'];
				//$d2 = $_GET['d2'];
				//echo "{$ssobranch_code}";exit;
				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($ssobranch_code == '0') {
					$ssobranch_codet = "ทั่วประเทศ";
				} else if ($ssobranch_code == '1050') {
					$ssobranch_codet = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $ssobranch_code));
					$bcn = $bcr->name;
					$ssobranch_codet = $bcn;
				}

				$data1 = array('ssobranch_code' => $ssobranch_code, 'ssobranch_codet' => $ssobranch_codet);
				$this->layout = 'nolayout';
				$this->pageTitle = 'report - LED';
				$this->render('/site/reportpages/reportsled32sub', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallshowrpt31()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}
				//echo $bctid;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->render('/site/reportpages/report31', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallsubrpt31()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$d1 = $_POST['d1'];
				$d2 = $_POST['d2'];
				$sso1 = $_POST['sso1'];
				$bct = $_POST['bct'];
				$bc = $_POST['bc'];

				//formatdate
				$d1d = date_create($d1)->format('d');
				$d1m = date_create($d1)->format('m');
				$d1y = date_create($d1)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d1f1 = $d1y . "-" . $d1m . "-" . $d1d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d1 = date_create($d1f1)->format('Y-m-d');

				//formatdate
				$d2d = date_create($d2)->format('d');
				$d2m = date_create($d2)->format('m');
				$d2y = date_create($d2)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d2f2 = $d2y . "-" . $d2m . "-" . $d2d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d2 = date_create($d2f2)->format('Y-m-d');

				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($sso1 == '0') {
					$sso1t = "ทั่วประเทศ";
				} else if ($sso1 == '1050') {
					$sso1t = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $sso1));
					$bcn = $bcr->name;
					$sso1t = $bcn;
				}

				$data1 = array('action' => $action, 'd1' => $d1, 'd2' => $d2, 'sso1' => $sso1, 'bct' => $bct, 'bc' => $bc, 'sso1t' => $sso1t);
				$this->layout = 'nolayout';
				$this->pageTitle = 'report - ' . $sso1t;
				$this->render('/site/reportpages/reports31sub', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallshowrpt32()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$ssobranch_code = $_GET['ssobranch_code'];
				$d1 = $_GET['d1'];
				$d2 = $_GET['d2'];
				//echo "{$ssobranch_code},{$d1},{$d2}";exit;
				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($ssobranch_code == '0') {
					$ssobranch_codet = "ทั่วประเทศ";
				} else if ($ssobranch_code == '1050') {
					$ssobranch_codet = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $ssobranch_code));
					$bcn = $bcr->name;
					$ssobranch_codet = $bcn;
				}

				$data1 = array('ssobranch_code' => $ssobranch_code, 'd1' => $d1, 'd2' => $d2, 'ssobranch_codet' => $ssobranch_codet);
				$this->layout = 'nolayout';
				$this->pageTitle = 'report - ' . $ssobranch_codet;
				$this->render('/site/reportpages/reports32sub', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}



	public function actionCallcripvbran()
	{ //insert crop_v_bran เมื่อ ดึงข้อมูลจาก dbd มาลงฐานข้อมูล
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$m = $_POST['m'];
				//echo "{$action}, {$m} <br>";
				$cropid = 3404;
				$registernumber = "0605562001211";
				Yii::app()->Cwpdreport->createcrop_v_bran($cropid, $registernumber);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallupdatetob()
	{ //update crop_v_bran status is b เมื่อ ขึ้นทะเบียนลูกจ้าง
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$m = $_POST['m'];
				//echo "{$action}, {$m} <br>";
				$cropid = 3404;
				$registernumber = "0605562001211";
				Yii::app()->Cwpdreport->updatetob($cropid, $registernumber);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallupdatetoa()
	{ //update crop_v_bran status is a เมื่อ gen textfile ออกไปแล้ว
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$m = $_POST['m'];
				//echo "{$action}, {$m} <br>";
				$cropid = 3404;
				$registernumber = "0605562001211";
				Yii::app()->Cwpdreport->updatetoa($cropid, $registernumber);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallgettxtdata()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$fn1 = $_POST['fn1']; //ชื่อ textfile 
				$minrec = $_POST['minrec'];
				//echo "{$action},{$fn1}";
				$data1 = array('action' => $action, 'fn1' => $fn1, 'minrec' => $minrec);
				$this->layout = 'nolayout';
				//$this->render('/site/servicepages/callaspservice');
				$this->render('/site/servicepages/gettxtdata', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallajaxjson()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				/*if(isset(Yii::app()->user->username)){
	  		$username = Yii::app()->user->username;
 		}else{
	  		$username = "sys";
  		}
		
		
		$sso_accno_arr = CJSON::decode($_POST['sso_accno_arr']);
		$sso_accbran_arr = CJSON::decode($_POST['sso_accbran_arr']);
		$crg_registernum_arr = CJSON::decode($_POST['crg_registernum_arr']);
		$crg_cropname_arr = CJSON::decode($_POST['crg_cropname_arr']);
		$crg_cropaddrss_arr = CJSON::decode($_POST['crg_cropaddrss_arr']);
		$crg_brancode_arr = CJSON::decode($_POST['crg_brancode_arr']);
		
		$countarray1 = count($sso_accno_arr);
		ini_set('max_execution_time', 3600); 
		$time_start = microtime(true);
		for($i=0;$i<=$countarray1-1;$i++){
			$selq = CropRiskGroup::model()->findByAttributes(array('crg_registernum'=>$t3));
			if(empty($selq)){
			  $CropRiskGroup = new CropRiskGroup();
			  $CropRiskGroup->sso_accno = $sso_accno_arr[$i];
			  $CropRiskGroup->sso_accbran = $sso_accbran_arr[$i];
			  $CropRiskGroup->crg_registernum = $crg_registernum_arr[$i];
			  $CropRiskGroup->crg_cropname = $crg_cropname_arr[$i];
			  $CropRiskGroup->crg_cropaddrss = $crg_cropaddrss_arr[$i];
			  $CropRiskGroup->crg_brancode = $crg_brancode_arr[$i];
			  $CropRiskGroup->crg_createby = $username;
			  $CropRiskGroup->crg_created = date('Y-m-d H:i:s');
			  $CropRiskGroup->crg_updateby = $username;
			  $CropRiskGroup->crg_modified = date('Y-m-d H:i:s');
			  $CropRiskGroup->crg_remark = "-";
			  $CropRiskGroup->crg_status = 1;
			  $CropRiskGroup->save();
			}
		}
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start)/60;
		echo '<b>Total Execution Time:</b> '.$execution_time.' Mins <br>';
		*/
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}




	public function actionCallsendmail()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$ema = $_POST['ema'];
				$accno = $_POST['accno'];
				$brnno = $_POST['brnno'];

				$msgresult = Yii::app()->Clogevent->sendmail($ema, $accno, $brnno);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalluploadfiletosftp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (isset(Yii::app()->user->username)) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				//$time_start = microtime(true);

				$action = $_POST['action'];
				$gtfname = $_POST['gtfname'];

				$localFile = Yii::app()->Cgentextfile->localpathf . $gtfname; //'wpd25620517.txt';
				$remoteFile = Yii::app()->Cgentextfile->remotepathf . $gtfname; //'wpd25620517.txt';

				if (Yii::app()->Cgentextfile->getConnectionsftp()) {
					$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
					$contents = file_get_contents($localFile);
					$putfile = file_put_contents("ssh2.sftp://" . intval($sftp) . "$remoteFile", $contents);
					//echo "success";
					//echo preg_replace("/\xEF\xBB\xBF/", "","Success");
					$anb = GentextfileTb::model()->findByAttributes(array('gtf_name' => $gtfname));
					//$anb = GentextfileTb::model()->findByPk($gtfid);
					$anb->gtf_statusupload = 'y';
					$anb->gtf_updateby = $username;
					$anb->gtf_modified = date('Y-m-d H:i:s');
					$anb->gtf_status = 2;
					if ($anb->save()) {
						//$msg3 = "update data is success.";
						$msgresult = Yii::app()->Clogevent->createlogevent("upload", "showtextfile", "uploadtextfiletosftp", "upload", "uploadtextfiletosftp");
						ob_clean();
						echo "Success";
					} else {
						//$msg3 = "can't update data.";
						//echo "Upload Success but Can't update status GentextfileTb.";
						ob_clean();
						echo "Failed";
					}
				} else {
					//echo "failed"; 
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", "Failed");
				}



				//****** call wpdapi service ********************************************************
				/*
			$url = 'http://localhost/wpdapi/api/uploadfile/uploadtosftp.php?fn1=' . $gtfname ;
			
			$arrContextOptions=array(
				"http" => array(
				  "method" => "GET",
				  "header" =>
					  //"Consumer-Key: 8400dfa3-4fe3-43b9-b830-060d948d75cf", 
					  "Content-Type: application/json; charset=utf-8;\r\n".
					  "Connection: keep-alive\r\n",
					  "ignore_errors" => true,
					  "timeout" => (float)30.0,
					  //"content" => $data,
				),
				"ssl"=>array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
				),
			);  
			
			$content = file_get_contents($url, false, stream_context_create($arrContextOptions));
			
			//echo "{$content} <br>";
			
			if($content){
				//echo "Success";
				//update gentextfile_tb
				$anb=GentextfileTb::model()->findByAttributes(array('gtf_name'=>$gtfname));
				//$anb = GentextfileTb::model()->findByPk($gtfid);
				$anb->gtf_statusupload = 'y';
				$anb->gtf_updateby = $username;
				$anb->gtf_modified = date('Y-m-d H:i:s');
				$anb->gtf_status = 2;
				if($anb->save()){
					//$msg3 = "update data is success.";
					echo "Success";
				}else{
					//$msg3 = "can't update data.";
					//echo "Upload Success but Can't update status GentextfileTb.";
					echo "Failed";
				}
			}else{
				echo "Failed";
			}
			*/
				//***********************************************************************************
				//$time_end = microtime(true);
				//$execution_time = ($time_end - $time_start)/60;
				//echo '<b>timeuses:</b> '.$execution_time.' Mins <br>';	
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCalluploadfiletosftpauto()
	{


		$username = "sys";

		//$time_start = microtime(true);

		$action = $_POST['action'];
		$gtfname = $_POST['gtfname'];

		$localFile = Yii::app()->Cgentextfile->localpathf . $gtfname; //'wpd25620517.txt';
		$remoteFile = Yii::app()->Cgentextfile->remotepathf . $gtfname; //'wpd25620517.txt';

		if (Yii::app()->Cgentextfile->getConnectionsftp()) {
			$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
			$contents = file_get_contents($localFile);
			$putfile = file_put_contents("ssh2.sftp://" . intval($sftp) . "$remoteFile", $contents);
			//echo "success";
			//echo preg_replace("/\xEF\xBB\xBF/", "","Success");
			$anb = GentextfileTb::model()->findByAttributes(array('gtf_name' => $gtfname));
			//$anb = GentextfileTb::model()->findByPk($gtfid);
			$anb->gtf_statusupload = 'y';
			$anb->gtf_updateby = $username;
			$anb->gtf_modified = date('Y-m-d H:i:s');
			$anb->gtf_status = 2;
			if ($anb->save()) {
				//$msg3 = "update data is success.";
				$msgresult = Yii::app()->Clogevent->createlogeventauto("upload", "showtextfile", "uploadtextfiletosftp", "upload", "uploadtextfiletosftp");
				ob_clean();
				echo "Success";
			} else {
				//$msg3 = "can't update data.";
				//echo "Upload Success but Can't update status GentextfileTb.";
				ob_clean();
				echo "Failed";
			}
		} else {
			//echo "failed"; 
			ob_clean();
			echo preg_replace("/\xEF\xBB\xBF/", "", "Failed");
		}



		/*
			$url = 'http://localhost/wpdapi/api/uploadfile/uploadtosftp.php?fn1=' . $gtfname ;
			
			$arrContextOptions=array(
				"http" => array(
				  "method" => "GET",
				  "header" =>
					  //"Consumer-Key: 8400dfa3-4fe3-43b9-b830-060d948d75cf", 
					  "Content-Type: application/json; charset=utf-8;\r\n".
					  "Connection: keep-alive\r\n",
					  "ignore_errors" => true,
					  "timeout" => (float)30.0,
					  //"content" => $data,
				),
				"ssl"=>array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
				),
			);  
			
			$content = file_get_contents($url, false, stream_context_create($arrContextOptions));
			
			//echo "{$content} <br>";
			
			if($content){
				//echo "Success";
				//update gentextfile_tb
				$anb=GentextfileTb::model()->findByAttributes(array('gtf_name'=>$gtfname));
				//$anb = GentextfileTb::model()->findByPk($gtfid);
				$anb->gtf_statusupload = 'y';
				$anb->gtf_updateby = $username;
				$anb->gtf_modified = date('Y-m-d H:i:s');
				$anb->gtf_status = 2;
				if($anb->save()){
					//$msg3 = "update data is success.";
					
					echo "Success";
				}else{
					//$msg3 = "can't update data.";
					//echo "Upload Success but Can't update status GentextfileTb.";
					echo "Failed";
				}
			}else{
				echo "Failed";
			}
			*/

		//$time_end = microtime(true);
		//$execution_time = ($time_end - $time_start)/60;
		//echo '<b>timeuses:</b> '.$execution_time.' Mins <br>';	
	}

	public function actionCallupdateiden()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//******************************************************
				$action = $_POST['action'];
				$ordernum = $_POST['ordernum'];
				$regisnum = $_POST['regisnum'];
				$iden = $_POST['iden'];
				//echo "{$iden}";
				//update identity committees
				$upcomt = CommitteeTmpTb::model()->findByAttributes(array('registernumber' => $regisnum, 'ordernumber' => $ordernum));
				$upcomt->identity = $iden;
				$upcomt->cmit_updateby = Yii::app()->user->username;
				$upcomt->cmit_updatetime = date('Y-m-d H:i:s');
				if ($upcomt->save()) {
					$txt1 = 'update_identity_' . $iden;
					$msgresult = Yii::app()->Clogevent->createlogevent("update", "committee", "identity", "update", $txt1);
					echo "{$iden}";
				} else {
					echo "";
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallupdatetsic()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//******************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				$tsiccode = $_POST['tsiccode'];
				$tsicdetial = $_POST['tsicdetial'];
				//echo "{$action}, {$regisnum}, {$tsiccode}, {$tsicdetial}";
				$upcif = CropinfoTmpTb::model()->findByAttributes(array('registernumber' => $regisnum));
				$upcif->tsic = $tsiccode;
				$upcif->tsicname = $tsicdetial;
				$upcif->crop_updateby = Yii::app()->user->username;
				$upcif->crop_updatetime = date('Y-m-d H:i:s');
				if ($upcif->save()) {
					$txt1 = 'update_tsic_' . $tsiccode . '-' . $tsicdetial . '-' . Yii::app()->user->username;
					$msgresult = Yii::app()->Clogevent->createlogevent("update", "tsic", "schdetailcropsp", "update", $txt1);
					echo "{$tsiccode} :: {$tsicdetial}";
				}
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionSchfrmwpd()
	{

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (isset(Yii::app()->user->username)) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาสถานประกอบการที่ถูกฟ้องล้มละลาย:" . $seltxt . "&" . $schtxt;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "CropInfo", $levremark);

				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/searchledfrmwpd', $data1); //schbyinfo


				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionGetfilenameall()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (isset(Yii::app()->user->username)) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				//*********************************************************
				$action = $_POST['action'];
				$fns = $_POST['fns'];

				$levremark = "เปิดpopupแสดงชื่อtextfile:" . $fns . "&" . $action . "by" . $username;
				$msgresult = Yii::app()->Clogevent->createlogevent("Searchpages", "getfilenameall", "Search7", "getfilenameall", $levremark);

				$data1 = array('action' => $action, 'fns' => $fns);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/getfilenameall', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionDownloadtxtfilefrmsftp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (isset(Yii::app()->user->username)) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				//*********************************************************
				$action = $_POST['action'];
				$dwntxt = $_POST['dwntxt'];


				$localpathf = Yii::app()->Cgentextfile->localpathd . $dwntxt; //"C:/xampp/htdocs/wpdtextfile/out/" . $dwntxt;
				$remotepathf = Yii::app()->Cgentextfile->remotepathd . $dwntxt; //"/home/wpdusr/uploaddir/" . $dwntxt; //T8000_D621030.txt";

				// checking whether file exists or not 
				if (file_exists($localpathf)) {
					echo "ไฟล์ชื่อ : {$dwntxt} มีอยู่แล้ว";
				} else {
					if (Yii::app()->Cgentextfile->getConnectionsftp()) {
						$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
						$contents = file_get_contents("ssh2.sftp://" . intval($sftp) . "$remotepathf");
						if (file_put_contents($localpathf, $contents)) {

							//เพิ่มรายการไฟล์ที่ donwload ลงใน table SapainstxtfileTb  *******
							$SapainstxtfileTb = new SapainstxtfileTb();
							$SapainstxtfileTb->sptf_filename = $dwntxt;
							$SapainstxtfileTb->sptf_path = $localpathf;
							$SapainstxtfileTb->sptf_numrec = 0;
							$SapainstxtfileTb->sptf_createby = $username;
							$SapainstxtfileTb->sptf_created = date('Y-m-d H:i:s');
							$SapainstxtfileTb->sptf_updateby = $username;
							$SapainstxtfileTb->sptf_modified = date('Y-m-d H:i:s');
							$SapainstxtfileTb->sptf_remark = "-";
							$SapainstxtfileTb->sptf_status = 1;
							if ($SapainstxtfileTb->save()) {
								//	
							} else {
								//
							} //if
							//*******************************************************

							echo "Success to download {$dwntxt} <br>";
						} else {
							echo "Failed to download {$dwntxt} <br>";
						}
					}
				} //if

				//================================================================

				//echo "{$action}, {$dwntxt}";
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionDownloadtxtfilefrmsftpauto()
	{

		$action = $_POST['action'];
		$dwntxt = $_POST['dwntxt'];


		$localpathf = Yii::app()->Cgentextfile->localpathd . $dwntxt; //"C:/xampp/htdocs/wpdtextfile/out/" . $dwntxt;
		$remotepathf = Yii::app()->Cgentextfile->remotepathd . $dwntxt; //"/home/wpdusr/uploaddir/" . $dwntxt; //T8000_D621030.txt";

		// checking whether file exists or not 
		if (file_exists($localpathf)) {
			echo "The file $localpathf exists";
		} else {
			if (Yii::app()->Cgentextfile->getConnectionsftp()) {
				$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
				$contents = file_get_contents("ssh2.sftp://" . intval($sftp) . "$remotepathf");
				if (file_put_contents($localpathf, $contents)) {
					echo "Success to download $dwntxt <br>";
				} else {
					echo "Failed to download $dwntxt <br>";
				}
			}
		} //if


	} //function

	public function actionGetfilenamealltb()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (isset(Yii::app()->user->username)) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				//*********************************************************
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/getfilenamealltb');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCalldbdservice5()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];
				$fntxt1 = $_POST['fntxt1'];
				//echo 'ส่งข้อมูลสำเร็จ.' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
				$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap, 'fntxt1' => $fntxt1);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/calldbdservice5', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCalldbdservice5auto()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];
				$fntxt1 = $_POST['fntxt1'];
				//echo 'ส่งข้อมูลสำเร็จ.' . $bgdatep . ',' . $eddatep . ',' . $newdap . ',' . $updap;
				$data1 = array('bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap, 'fntxt1' => $fntxt1);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/calldbdservice5auto', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionGettablename()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$tbn = $_POST['tbn'];
				//echo "{$action},{$tbn}";
				$ListTB = lkup_data::getTBName($tbn);
				$data1 = array('action' => $action, 'tbn' => $tbn, 'ListTB' => $ListTB);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/gettablename', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionGetfieldname()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$tbn1 = $_POST['tbn1']; //ชื่อตาราง
				$tbn = $_POST['tbn']; //ชื่อฐานข้อมูล
				//echo "{$action},{$tbn1},{$tbn}";
				$data1 = array('action' => $action, 'tbn1' => $tbn1, 'tbn' => $tbn);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/getfielddata', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionExecutesqlc()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$sqlc = $_POST['sqlc'];
				$udb1 = $_POST['udb1'];
				//echo "{$action},{$sqlc},{$udb1}";
				$data1 = array('action' => $action, 'sqlc' => $sqlc, 'udb1' => $udb1);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/executesqlc', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionExecutesqlcr()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$sqlcr = $_POST['sqlcr'];
				$udb1 = $_POST['udb1'];
				//echo "{$action},{$sqlcr}";
				$data1 = array('action' => $action, 'sqlcr' => $sqlcr,  'udb1' => $udb1);
				$this->layout = 'nolayout';
				$this->render('/site/adminpages/executesqlcr', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionListdata()
	{
		//$action = $_POST['action'];
		//echo $action;
		//exit;
		$page = 1;
		if (!empty($_POST['page'])) $page = (int)$_POST['page'];

		$recordsPerPage = 10;
		if (!empty($_POST['length'])) $recordsPerPage = (int)$_POST['length'];

		$start = 0;
		if (!empty($_POST['start'])) $start = (int)$_POST['start'];

		$noOfRecords = 0;

		//echo "{$page}, {$recordsPerPage}, {$start} ";

		/*$q = new CDbCriteria( array(
			'condition' => "lrpt_status = :lrpt_status ",         
			'params'    => array(':lrpt_status' => 1)  
		));
		$leddata = LedrptTb::model()->findAll($q);
		$countled = count($leddata);*/

		$conn = Yii::app()->db;

		$sql = "SET @rownum := 0;";
		$command = $conn->createCommand($sql)->execute();

		$sql = "SELECT * FROM wpddb.ledrpt_tb";
		$sql = "
		 SELECT * FROM (SELECT @rownum := @rownum+1 AS NUMBER, wpddb.ledrpt_tb.* FROM  wpddb.ledrpt_tb ORDER BY lrpt_id) AS TBL
			WHERE NUMBER BETWEEN :rowstart AND :rowend 
			ORDER BY lrpt_id;
		";

		$command = $conn->createCommand($sql);
		$command->bindValue(":rowstart", ($start + 1));
		$command->bindValue(":rowend", ($start + $recordsPerPage));
		/*if(!empty($this->FSearch)){
			$command->bindValue(":Condition", "%" . $FSearch . "%"); 	
		}*/
		$rows = $command->queryAll();


		//var_dump($rows);exit;

		$arr = array();
		foreach ($rows as $dataitem) {
			//$new =  array_push($dataitem,"xxx");
			$arr[] = array_values($dataitem);
		}

		$jsondata = json_encode($arr);

		$sql = "SELECT COUNT(*) As ct FROM wpddb.ledrpt_tb";

		$command = $conn->createCommand($sql);
		$rows = $command->queryAll();
		$noOfRecords =  $rows[0]['ct'];

		//var_dump($jsondata);

		echo '{"recordsTotal":' . $noOfRecords . ',"recordsFiltered":' . $noOfRecords . ',"data":' . $jsondata . '}';

		//var_dump($_POST);
		//exit;
	} //function 

	public function actionListdata2()
	{

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************


				$action = $_POST['action'];
				$tbn1 = $_POST['tbn1']; //tablename
				$udb1 = $_POST['udb1']; //databasename
				$txtsql = $_POST['txtsql']; //sql command ที่ user key

				if ($udb1 == "wpddb") {
					$conn = Yii::app()->db; //get connection
				} else if ($udb1 == "wpdlogdb") {
					$conn = Yii::app()->db2; //get connection
				} else if ($udb1 == "wpdreportdb") {
					$conn = Yii::app()->db3; //get connection
				} else if ($udb1 == "etpdb") {
					$conn = Yii::app()->db4; //get connection
				}

				//var_dump($_POST);

				$dbtb = $udb1 . "." . $tbn1;

				//echo "{$action},{$tbn1},{$udb1}";

				$draw = $_POST['draw']; //ลำดับที่ตารางที่จะเอาข้อมููลไปเขียน

				$columns = $_POST['columns']; //array columns 
				//var_dump($columns);

				$columnsdata = $_POST['columns'][1]['data']; //ลำดับที่ collums เริ่มต้นที่ 0
				$colname = $_POST['columns'][1]['name']; //ชื่อ column
				$colsch = $_POST['columns'][1]['searchable']; //เปิดให้ search true or false
				$colord = $_POST['columns'][1]['orderable']; //อนุญาติให้จัดเรียง true or false
				$colschtxt = $_POST['columns'][1]['search']['value']; //ข้อความค้นหาในคอลัมน์ 1
				$colschtype = $_POST['columns'][1]['search']['regex']; //ประเภทการค้นหาในคอลัมน์ true or false

				$countcolumns = count($columns);  //จำนวนคอลัมน์ที่กำหนดไว้ในส่วน header

				$ordercol = $_POST['order'][0]['column']; //การจัดเรียงเริ่มต้น
				$ordertype = $_POST['order'][0]['dir']; //ประเภทของการจัดเรียง

				$start = $_POST['start']; //จำนวน record เริ่มต้นต่อ 1 หน้า 0
				$length = $_POST['length']; //จำนวน record สุดท้าย / หน้า 10
				$page = 1;
				if (!empty($_POST['page'])) $page = $_POST['page'];  //เลขหน้าที่คลิกเข้ามา กรณีไม่มีข้อมูลจะไม่มีเลขหน้า

				$searchtxt = $_POST['search']['value']; //คำค้นหารวมที่พิมพ์เข้ามา
				$searchtype = $_POST['search']['regex']; //การค้นหา true or false

				$orderb = "";
				if (strstr($txtsql, 'order')) {
					$orderb = substr($txtsql, strpos($txtsql, 'order'), strlen($txtsql));
				} else {
					$orderb = "";
				}


				$Condition = "";
				if (strstr($txtsql, 'where')) {
					$Condition = substr($txtsql, strpos($txtsql, 'where'), strlen($txtsql));
				} else {
					$Condition = "";
				}

				if (strstr($Condition, 'order')) {
					$Condition = substr($Condition, 0, strpos($Condition, 'order'));
				} else {
					$Condition = $Condition;
				}

				$fn = $conn->schema->getTable($tbn1)->getColumnNames(); //fieldname

				if ($Condition != "") {
					for ($i = 0, $ien = count($columns); $i < $ien; $i++) {
						if ($_POST['columns'][$i]['search']['value'] != "") {
							$Condition = $Condition . " AND " . $fn[$i - 1] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
						} //if
					} //for
				} else { //if
					$fistno = 1;
					for ($i = 0, $ien = count($columns); $i < $ien; $i++) {
						if ($_POST['columns'][$i]['search']['value'] != "") {
							if ($fistno == 1) {
								$Condition = $Condition . " WHERE " . $fn[$i - 1] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
								$fistno += 1;
							} else {
								$Condition = $Condition . " AND " . $fn[$i - 1] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
							} //if
						} //if
					} //for
				} //if

				if ($Condition != "") {
					if ($_POST['search']['value'] != "") {
						$firstnos = 1;
						for ($i = 0, $ien = count($columns) - 1; $i < $ien; $i++) {
							if ($firstnos == 1) {
								$Condition = $Condition . " AND " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							} else if ($firstnos > 1) {
								$Condition = $Condition . " OR " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							}
						} //for
					} //if
				} else { //if
					if ($_POST['search']['value'] != "") {
						$firstnos = 1;
						for ($i = 0, $ien = count($columns) - 1; $i < $ien; $i++) {
							if ($firstnos == 1) {
								$Condition = $Condition . " WHERE " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							} else if ($firstnos == 2) {
								$Condition = $Condition . " AND " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							} else {
								$Condition = $Condition . " OR " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							}
						} //for
					} //if
				}

				if ($orderb != "") {
					$Condition = $Condition . " " . $orderb;
				} else {
					$Condition = $Condition;
				}

				//echo "{$countcolumns},{$Condition}";
				//exit;

				//echo "{$draw}, {$countcolumns}, {$columnsdata}, {$colname}, {$colsch}, {$colord}, {$colschtxt} , {$colschtype}, {$ordercol}, {$ordertype}, {$start}, {$length}, {$page}, {$searchtxt}, {$searchtype}, {$tbn1}, {$udb1}, {$txtsql}";

				//exit;


				$page = 1;
				if (!empty($_POST['page'])) $page = (int)$_POST['page'];

				$recordsPerPage = 10;
				if (!empty($_POST['length'])) $recordsPerPage = (int)$_POST['length'];

				$start = 0;
				if (!empty($_POST['start'])) $start = (int)$_POST['start'];

				$noOfRecords = 0;

				$sql = "SET @rownum := 0;";
				$command = $conn->createCommand($sql)->execute();

				//$sql = "SELECT * FROM " . $udb1 . "." . $tbn1;

				$sqldbtball = $udb1 . "." . $tbn1 . ".*"; //wpddb.ledrpt_tb.*
				$sqldbtb = $udb1 . "." . $tbn1;

				//echo "{$sqldbtball}"; exit;

				$sql = "
		 SELECT * FROM (SELECT @rownum := @rownum+1 AS NUMBER, " . $sqldbtball . " FROM  " . $sqldbtb . " " . $Condition . " ) AS TBL
			WHERE NUMBER BETWEEN :rowstart AND :rowend ;
		";

				$command = $conn->createCommand($sql);
				$command->bindValue(":rowstart", ($start + 1));
				$command->bindValue(":rowend", ($start + $recordsPerPage));

				$rows = $command->queryAll();

				$arr = array();
				foreach ($rows as $dataitem) {
					$arr[] = array_values($dataitem);
				}

				$jsondata = json_encode($arr);

				$sql = "SELECT COUNT(*) As ct FROM " . $sqldbtb . " " . $Condition;

				$command = $conn->createCommand($sql);
				$rows = $command->queryAll();
				$noOfRecords =  $rows[0]['ct'];

				ob_clean();
				echo '{"recordsTotal":' . $noOfRecords . ',"recordsFiltered":' . $noOfRecords . ',"data":' . $jsondata . '}';

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function 

	public function actionGettxtfilesiskcrop()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/gettxtfilesiskcrop');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionGetriskcrop()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/getriskcrop');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionDownloadtxtfileledfrmsftp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (isset(Yii::app()->user->username)) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				//*********************************************************
				$action = $_POST['action'];
				$dlt = $_POST['dlt'];

				//echo "{$action}, {$dlt}";

				$localpathf = Yii::app()->Cgentextfile->localpathled . $dlt; //"C:/xampp/htdocs/wpdtextfile/out/" . $dwntxt;
				$remotepathf = Yii::app()->Cgentextfile->remotepathled . $dlt; //"/home/wpdusr/uploaddir/" . $dwntxt; //T8000_D621030.txt";

				// checking whether file exists or not 
				if (file_exists($localpathf)) {
					echo "มีไฟล์ {$dlt} อยู่แล้ว!";
				} else {
					if (Yii::app()->Cgentextfile->getConnectionsftp()) {
						$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
						$contents = file_get_contents("ssh2.sftp://" . intval($sftp) . "$remotepathf");
						if (file_put_contents($localpathf, $contents)) {
							//*** insert data to LedtextfileTb.php ******
							$LedtextfileTb = new LedtextfileTb();
							$LedtextfileTb->ltf_name = $dlt;
							$LedtextfileTb->ltf_path = $localpathf;
							$LedtextfileTb->ltf_countud = "0";
							$LedtextfileTb->ltf_statusud = "N";
							$LedtextfileTb->ltf_statusupload = "N";
							$LedtextfileTb->ltf_createby = $username;
							$LedtextfileTb->ltf_created = date('Y-m-d H:i:s');
							$LedtextfileTb->ltf_updateby = $username;
							$LedtextfileTb->ltf_modified = date('Y-m-d H:i:s');
							$LedtextfileTb->ltf_remark = "-";
							$LedtextfileTb->ltf_status = "1";
							if ($LedtextfileTb->save()) {
								$msg = "Success to download {$dlt} <br>";
								//$msgresult = Yii::app()->Clogevent->createlogevent("Update", "UpdateStatusPage", "UpdatestatustoB", "CropInfo&Empstate", $levremark);	
							} else {
								$msg = $EmpstateTb->getErrors();
								//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => 'error')));
							}
							//*******************************************  
							echo $msg;
						} else {
							echo "Failed to download {$dlt} <br>";
						}
					}
				} //if


				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


	public function actionChkriskcrop()
	{

		set_time_limit(0);
		ini_set("max_execution_time", "0");
		ini_set("memory_limit", "9999M");

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************

				$action = $_POST['action'];
				$ltf_name = $_POST['ltf_name'];
				//echo "{$action},{$ltf_name}";
				//**** นับจำนวนบรรทัดทั้งหมดใน textfile ******** //
				$minrec = 0;
				$linecount = 0;
				$handle = fopen(Yii::app()->Cgentextfile->localpathled . $ltf_name, "r");
				$time_start = microtime(true);
				while (!feof($handle)) {
					$line = fgets($handle);
					$linecount++;
				}
				fclose($handle);
				//echo $linecount; echo "<br>";
				$time_end = microtime(true);
				$execution_time = ($time_end - $time_start) / 60;
				//echo '<b>Total Execution Time:</b> '.$execution_time.' Mins'; echo "<br>";
				//**** นับจำนวนบรรทัดทั้งหมดใน textfile ******** //	
				//********
				$linecount = $linecount; //5000;
				//********

				//echo "{$action},{$ltf_name}, {$execution_time}, {$linecount} ";
				//*************************** ประกาศตัวแปร array ********
				$lrc_id_arr = array();
				$lrc_accno_arr = array();
				$lrc_bran_arr = array();
				$lrc_registernumber_arr = array();
				$lrc_registername_arr = array();
				$lrc_ssocode1_arr = array();
				$lrc_ssocode2_arr = array();
				$lrc_address_arr = array();
				$lrc_amphur_arr = array();
				$lrc_province_arr = array();
				$lrc_zipcode_arr = array();
				/*$lrc_createby
			$lrc_created
			$lrc_updateby
			$lrc_modified
			$lrc_remark
			$lrc_status*/
				//***************************************************
				$line = -1;
				$min = $minrec; //บรรทัดเริ่มต้น บรรทัดแรกสุด คือ 0
				$max = $linecount; //$min + 1000;//42632; //บรรทัดสุดท้ายที่จะให้ดึง

				if (($myfile = fopen(Yii::app()->Cgentextfile->localpathled . $ltf_name, "r")) !== FALSE) {
					$time_start = microtime(true);
					$rownum = 0;
					$rowempty = 0;
					$rowlength = 0;
					$rownonum = 0;
					$rowduplicate = 0;
					$numofintsert = 0;
					while (!feof($myfile)) {
						$line++;
						if (($line >= $min && $line <= $max)) {
							$datastr  = fgets($myfile);
							$arraystr = explode(";", $datastr);
							if (!empty($arraystr[0])) {
								$t0 = trim($arraystr[0]); // เลขประกันสังคม 10 หลัก
							} else {
								$t0 = "";
							}
							if (!empty($arraystr[1])) {
								$t1 = trim($arraystr[1]); // เลขสาขา 6 หลัก
							} else {
								$t1 = "";
							}
							if (!empty($arraystr[2])) {
								$t2 = trim($arraystr[2]); // เลขทะเบียนพาณิชย์ 13 หลัก
							} else {
								$t2 = "";
							}
							if (!empty($arraystr[3])) {
								$t3 = trim($arraystr[3]); // ชื่อสถานประกอบการ
							} else {
								$t3 = "";
							}
							if (!empty($arraystr[4])) {
								$t4 = trim($arraystr[4]); // bran_code สปส เร่งรัดหนี้
							} else {
								$t4 = "";
							}
							if (!empty($arraystr[5])) {
								$t5 = trim($arraystr[5]); // bran_code สปส รับผิดชอบ
							} else {
								$t5 = "";
							}
							if (!empty($arraystr[6])) {
								$t6 = trim($arraystr[6]); // ที่อยู่
							} else {
								$t6 = "";
							}
							if (!empty($arraystr[7])) {
								$t7 = trim($arraystr[7]); // อำเภอ
							} else {
								$t7 = "";
							}
							if (!empty($arraystr[8])) {
								$t8 = trim($arraystr[8]); // จังหวัด
							} else {
								$t8 = "";
							}
							if (!empty($arraystr[9])) {
								$t9 = trim($arraystr[9]); // รหัสไปรษณีย์ 
							} else {
								$t9 = "";
							}

							$t3f = iconv('tis-620', 'utf-8', $t3); // ชื่อสถานประกอบการ
							$t6f = iconv('tis-620', 'utf-8', $t6); // ที่อยู่
							$t7f = iconv('tis-620', 'utf-8', $t7); // อำเภอ
							$t8f = iconv('tis-620', 'utf-8', $t8); // จังหวัด

							$crop_address = $t6f . " " .  $t7f . " " . $t8f . " " . $t9;

							if (!empty($t2)) { //ถ้าเลข 13 หลัก เป็นค่าว่าง หรือ null
								$lent2 = strlen($t2);
								if ($lent2 == 13) { //ถ้าตัวเลขทะเบียน เท่ากับ 13 หลัก
									if (is_numeric($t2) && $t2 > 0 && $t2 == round($t2, 0)) { //ถ้าเป็นตัวเลขทั้งหมด
										$lrc_accno_arr[] = $t0;
										$lrc_bran_arr[] = $t1;
										$lrc_registernumber_arr[] = $t2;
										$lrc_registername_arr[] = $t3f;
										$lrc_ssocode1_arr[] = $t4;
										$lrc_ssocode2_arr[] = $t5;
										$lrc_address_arr[] = $t6f;
										$lrc_amphur_arr[] = $t7f;
										$lrc_province_arr[] = $t8f;
										$lrc_zipcode_arr[] = $t9;

										//echo "{$rownum}, {$line}, {$t0}, {$t1}, {$t2}, {$t3f}, {$t4}, {$t5}, {$t6f}, {$t7f}, {$t8f}, {$t9}"; echo "<br>";

										$rownum += 1;

										$selq = LedriskcropTb::model()->findByAttributes(array('lrc_registernumber' => $t2));
										if (empty($selq)) {
											$LedriskcropTb = new LedriskcropTb();
											$LedriskcropTb->lrc_accno = $t0;
											$LedriskcropTb->lrc_bran = $t1;
											$LedriskcropTb->lrc_registernumber = $t2;
											$LedriskcropTb->lrc_registername = $t3f;
											$LedriskcropTb->lrc_ssocode1 = $t4;
											$LedriskcropTb->lrc_ssocode2 = $t5;
											$LedriskcropTb->lrc_address = $t6f;
											$LedriskcropTb->lrc_amphur = $t7f;
											$LedriskcropTb->lrc_province = $t8f;
											$LedriskcropTb->lrc_zipcode = $t9;
											$LedriskcropTb->lrc_createby = Yii::app()->user->username;
											$LedriskcropTb->lrc_created = date('Y-m-d H:i:s');
											$LedriskcropTb->lrc_updateby = Yii::app()->user->username;
											$LedriskcropTb->lrc_modified = date('Y-m-d H:i:s');
											$LedriskcropTb->lrc_remark = "-";
											$LedriskcropTb->lrc_status = 1;
											if ($LedriskcropTb->save()) {
												$msg = "insert data is success.";
												$numofintsert += 1;
											} else { //if
												$msg = $LedriskcropTb->getErrors();
											} //if
											//echo "{$msg} <br>";
										} //if
									} //if
								} //if
							} //if

						} //if

					} //while

					fclose($myfile);

					//update status text file ***************
					$qltf = LedtextfileTb::model()->findByAttributes(array('ltf_name' => $ltf_name));
					$qltf->ltf_countud = $numofintsert;
					$qltf->ltf_statusud = "Y";
					$qltf->ltf_updateby = Yii::app()->user->username;
					$qltf->ltf_modified = date('Y-m-d H:i:s');
					$qltf->ltf_status = 2;
					if ($qltf->save()) {
						$msg3 = "update data is success.";
					} else {
						$msg3 = $qltf->getErrors();
					}
					//***************************************

					$time_end = microtime(true);
					$execution_time = ($time_end - $time_start) / 60;
					echo '<b> ตรวจสอบไฟล์ :</b> ' . $ltf_name  . ' เรียบร้อย <br>';
					echo '<b> เพิ่มรายการจำนวน :</b> ' . $numofintsert  . ' รายการ <br>';
					echo '<b>ใช้เวลา :</b> ' . $execution_time . ' Mins <br>';
				} //if

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


	public function actionListdatariskcrop2()
	{

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************


				$action = $_POST['action'];
				$tbn1 = $_POST['tbn1']; //tablename
				$udb1 = $_POST['udb1']; //databasename
				$txtsql = $_POST['txtsql']; //sql command ที่ user key

				$ssocodeusr =  Yii::app()->user->address;
				$ssocodeusrsub =  substr(Yii::app()->user->address, 0, -2);

				//หาว่าเป็นส่วนกลางหรือจังหวัด จาก mas_ssobranch
				$mmsb = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $ssocodeusr)); //mas_ssobranch
				if ($mmsb) {
					$ssobranch_type_id = $mmsb->ssobranch_type_id;
				} else {
					$ssobranch_type_id = 2;
				}

				if ($ssocodeusr == "1050") {
					$ssobranch_type_id = 1;
				}

				//echo "{$ssobranch_type_id}"; exit;

				if ($udb1 == "wpddb") {
					$conn = Yii::app()->db; //get connection
				} else if ($udb1 == "wpdlogdb") {
					$conn = Yii::app()->db2; //get connection
				} else if ($udb1 == "wpdreportdb") {
					$conn = Yii::app()->db3; //get connection
				}

				//var_dump($_POST);

				$dbtb = $udb1 . "." . $tbn1;

				//echo "{$action},{$tbn1},{$udb1},{$txtsql}"; exit;

				$draw = $_POST['draw']; //ลำดับที่ตารางที่จะเอาข้อมููลไปเขียน
				$columns = $_POST['columns']; //array columns 
				$columnsdata = $_POST['columns'][1]['data']; //ลำดับที่ collums เริ่มต้นที่ 0
				$colname = $_POST['columns'][1]['name']; //ชื่อ column
				$colsch = $_POST['columns'][1]['searchable']; //เปิดให้ search true or false
				$colord = $_POST['columns'][1]['orderable']; //อนุญาติให้จัดเรียง true or false
				$colschtxt = $_POST['columns'][1]['search']['value']; //ข้อความค้นหาในคอลัมน์ 1
				$colschtype = $_POST['columns'][1]['search']['regex']; //ประเภทการค้นหาในคอลัมน์ true or false
				$countcolumns = count($columns);  //จำนวนคอลัมน์ที่กำหนดไว้ในส่วน header
				$ordercol = $_POST['order'][0]['column']; //การจัดเรียงเริ่มต้น
				$ordertype = $_POST['order'][0]['dir']; //ประเภทของการจัดเรียง
				$start = $_POST['start']; //จำนวน record เริ่มต้นต่อ 1 หน้า 0
				$length = $_POST['length']; //จำนวน record สุดท้าย / หน้า 10

				$page = 1;
				if (!empty($_POST['page'])) $page = $_POST['page'];  //เลขหน้าที่คลิกเข้ามา กรณีไม่มีข้อมูลจะไม่มีเลขหน้า

				$searchtxt = $_POST['search']['value']; //คำค้นหารวมที่พิมพ์เข้ามา
				$searchtype = $_POST['search']['regex']; //การค้นหา true or false

				$orderb = "";
				if (strstr($txtsql, 'order')) { //ค้นหาว่ามีคำว่า order หรือปล่าว
					$orderb = substr($txtsql, strpos($txtsql, 'order'), strlen($txtsql));
				} else {
					$orderb = "";
				}

				$Condition = ""; //ตรวจสอบว่ามีคำว่า where หรือปล่าว
				if (strstr($txtsql, 'where')) {
					$Condition = substr($txtsql, strpos($txtsql, 'where'), strlen($txtsql));
				} else {
					$Condition = "";
				}

				if (strstr($Condition, 'order')) { //ตัดคำหลัง order ออกไป
					$Condition = substr($Condition, 0, strpos($Condition, 'order'));
				} else {
					$Condition = $Condition;
				}

				$fn = $conn->schema->getTable($tbn1)->getColumnNames(); //fieldname get


				if ($Condition != "") {
					for ($i = 0, $ien = count($columns); $i < $ien; $i++) {
						if ($_POST['columns'][$i]['search']['value'] != "") {
							$Condition = $Condition . " AND " . $fn[$i - 1] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
						} //if
					} //for
				} else { //if
					$fistno = 1;
					for ($i = 0, $ien = count($columns); $i < $ien; $i++) {
						if ($_POST['columns'][$i]['search']['value'] != "") {
							if ($fistno == 1) {
								$Condition = $Condition . " WHERE " . $fn[$i - 1] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
								$fistno += 1;
							} else {
								$Condition = $Condition . " AND " . $fn[$i - 1] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
							} //if
						} //if
					} //for
				} //if

				if ($Condition != "") {
					if ($_POST['search']['value'] != "") {
						$firstnos = 1;
						for ($i = 0, $ien = count($columns) - 1; $i < $ien; $i++) {
							if ($firstnos == 1) {
								$Condition = $Condition . " AND " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							} else if ($firstnos > 1) {
								$Condition = $Condition . " OR " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							}
						} //for
					} //if
				} else { //if
					if ($_POST['search']['value'] != "") {
						$firstnos = 1;
						for ($i = 0, $ien = count($columns) - 1; $i < $ien; $i++) {
							if ($firstnos == 1) {
								$Condition = $Condition . " WHERE " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							} else if ($firstnos == 2) {
								$Condition = $Condition . " AND " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							} else {
								$Condition = $Condition . " OR " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							}
						} //for
					} //if
				}


				if ($orderb != "") {
					$Condition = $Condition . " " . $orderb;
				} else {
					$Condition = $Condition;
				}

				//เพิ่มเงื่อนไขในกรณีที่ เป็น เจ้าหน้าที่ จังหวัด	
				/*if($Condition==""){
			if($ssobranch_type_id==1){
				$Condition = $Condition;
			}else{
				$Condition = $Condition . " WHERE lrc_ssocode1 LIKE '" . $ssocodeusrsub . "%' OR lrc_ssocode2 LIKE '" . $ssocodeusrsub . "%' ";
			}
		}else{
			if($ssobranch_type_id==1){
				$Condition = $Condition;
			}else{
				$Condition = $Condition . " AND lrc_ssocode1 LIKE '" . $ssocodeusrsub . "%' OR lrc_ssocode2 LIKE '" . $ssocodeusrsub . "%' ";      }
		}//if*/

				//echo "{$Condition}"; exit;

				$page = 1;
				if (!empty($_POST['page'])) $page = (int)$_POST['page'];

				$recordsPerPage = 10;
				if (!empty($_POST['length'])) $recordsPerPage = (int)$_POST['length'];

				$start = 0;
				if (!empty($_POST['start'])) $start = (int)$_POST['start'];

				$noOfRecords = 0;

				$sql = "SET @rownum := 0;";
				$command = $conn->createCommand($sql)->execute();

				//$sql = "SELECT * FROM " . $udb1 . "." . $tbn1;

				$sqldbtball = $udb1 . "." . $tbn1 . ".*"; //wpddb.ledrpt_tb.*
				$sqldbtb = $udb1 . "." . $tbn1;

				//echo "{$sqldbtball}"; exit;

				$sql = "
		 SELECT * FROM (SELECT @rownum := @rownum+1 AS NUMBER, " . $sqldbtball . " FROM  " . $sqldbtb . " " . $Condition . " ) AS TBL
			WHERE NUMBER BETWEEN :rowstart AND :rowend ;
		";


				$command = $conn->createCommand($sql);
				$command->bindValue(":rowstart", ($start + 1));
				$command->bindValue(":rowend", ($start + $recordsPerPage));

				$rows = $command->queryAll();
				//$noOfRecords = count($rows);


				//echo count($rows);exit;

				//var_dump($rows);exit;

				$arr = array();
				foreach ($rows as $dataitem) {

					$arr[] = array_values($dataitem);
				}

				$jsondata = json_encode($rows); //$arr

				//var_dump($jsondata);exit;

				$sql = "SELECT COUNT(*) As ct FROM " . $sqldbtb . " " . $Condition;

				$command = $conn->createCommand($sql);
				$rows = $command->queryAll();
				$noOfRecords =  $rows[0]['ct'];


				ob_clean();
				echo '{"recordsTotal":' . $noOfRecords . ',"recordsFiltered":' . $noOfRecords . ',"data":' . $jsondata . '}';

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


	public function actionListdatariskcrop()
	{

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************


				$action = $_POST['action'];
				$tbn1 = $_POST['tbn1']; //tablename
				$udb1 = $_POST['udb1']; //databasename
				$txtsql = $_POST['txtsql']; //sql command ที่ user key

				if ($udb1 == "wpddb") {
					$conn = Yii::app()->db; //get connection
				} else if ($udb1 == "wpdlogdb") {
					$conn = Yii::app()->db2; //get connection
				} else if ($udb1 == "wpdreportdb") {
					$conn = Yii::app()->db3; //get connection
				}

				//var_dump($_POST);

				$dbtb = $udb1 . "." . $tbn1;

				//echo "{$action},{$tbn1},{$udb1},{$txtsql}"; exit;

				$draw = $_POST['draw']; //ลำดับที่ตารางที่จะเอาข้อมููลไปเขียน
				$columns = $_POST['columns']; //array columns 
				$columnsdata = $_POST['columns'][1]['data']; //ลำดับที่ collums เริ่มต้นที่ 0
				$colname = $_POST['columns'][1]['name']; //ชื่อ column
				$colsch = $_POST['columns'][1]['searchable']; //เปิดให้ search true or false
				$colord = $_POST['columns'][1]['orderable']; //อนุญาติให้จัดเรียง true or false
				$colschtxt = $_POST['columns'][1]['search']['value']; //ข้อความค้นหาในคอลัมน์ 1
				$colschtype = $_POST['columns'][1]['search']['regex']; //ประเภทการค้นหาในคอลัมน์ true or false
				$countcolumns = count($columns);  //จำนวนคอลัมน์ที่กำหนดไว้ในส่วน header
				$ordercol = $_POST['order'][0]['column']; //การจัดเรียงเริ่มต้น
				$ordertype = $_POST['order'][0]['dir']; //ประเภทของการจัดเรียง
				$start = $_POST['start']; //จำนวน record เริ่มต้นต่อ 1 หน้า 0
				$length = $_POST['length']; //จำนวน record สุดท้าย / หน้า 10

				$page = 1;
				if (!empty($_POST['page'])) $page = $_POST['page'];  //เลขหน้าที่คลิกเข้ามา กรณีไม่มีข้อมูลจะไม่มีเลขหน้า

				$searchtxt = $_POST['search']['value']; //คำค้นหารวมที่พิมพ์เข้ามา
				$searchtype = $_POST['search']['regex']; //การค้นหา true or false

				$orderb = "";
				if (strstr($txtsql, 'order')) { //ค้นหาว่ามีคำว่า order หรือปล่าว
					$orderb = substr($txtsql, strpos($txtsql, 'order'), strlen($txtsql));
				} else {
					$orderb = "";
				}

				$Condition = ""; //ตรวจสอบว่ามีคำว่า where หรือปล่าว
				if (strstr($txtsql, 'where')) {
					$Condition = substr($txtsql, strpos($txtsql, 'where'), strlen($txtsql));
				} else {
					$Condition = "";
				}

				if (strstr($Condition, 'order')) { //ตัดคำหลัง order ออกไป
					$Condition = substr($Condition, 0, strpos($Condition, 'order'));
				} else {
					$Condition = $Condition;
				}

				$fn = $conn->schema->getTable($tbn1)->getColumnNames(); //fieldname get

				if ($Condition != "") {
					for ($i = 0, $ien = count($columns); $i < $ien; $i++) {
						if ($_POST['columns'][$i]['search']['value'] != "") {
							$Condition = $Condition . " AND " . $fn[$i - 1] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
						} //if
					} //for
				} else { //if
					$fistno = 1;
					for ($i = 0, $ien = count($columns); $i < $ien; $i++) {
						if ($_POST['columns'][$i]['search']['value'] != "") {
							if ($fistno == 1) {
								$Condition = $Condition . " WHERE " . $fn[$i - 1] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
								$fistno += 1;
							} else {
								$Condition = $Condition . " AND " . $fn[$i - 1] . " LIKE '%" . $_POST['columns'][$i]['search']['value'] . "%'";
							} //if
						} //if
					} //for
				} //if

				if ($Condition != "") {
					if ($_POST['search']['value'] != "") {
						$firstnos = 1;
						for ($i = 0, $ien = count($columns) - 1; $i < $ien; $i++) {
							if ($firstnos == 1) {
								$Condition = $Condition . " AND " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							} else if ($firstnos > 1) {
								$Condition = $Condition . " OR " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							}
						} //for
					} //if
				} else { //if
					if ($_POST['search']['value'] != "") {
						$firstnos = 1;
						for ($i = 0, $ien = count($columns) - 1; $i < $ien; $i++) {
							if ($firstnos == 1) {
								$Condition = $Condition . " WHERE " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							} else if ($firstnos == 2) {
								$Condition = $Condition . " AND " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							} else {
								$Condition = $Condition . " OR " . $fn[$i] . " LIKE '%" . $_POST['search']['value'] . "%'";
								$firstnos += 1;
							}
						} //for
					} //if
				}

				if ($orderb != "") {
					$Condition = $Condition . " " . $orderb;
				} else {
					$Condition = $Condition;
				}



				$page = 1;
				if (!empty($_POST['page'])) $page = (int)$_POST['page'];

				$recordsPerPage = 10;
				if (!empty($_POST['length'])) $recordsPerPage = (int)$_POST['length'];

				$start = 0;
				if (!empty($_POST['start'])) $start = (int)$_POST['start'];

				$noOfRecords = 0;

				$sql = "SET @rownum := 0;";
				$command = $conn->createCommand($sql)->execute();

				//$sql = "SELECT * FROM " . $udb1 . "." . $tbn1;

				$sqldbtball = $udb1 . "." . $tbn1 . ".*"; //wpddb.ledrpt_tb.*
				$sqldbtb = $udb1 . "." . $tbn1;

				//echo "{$sqldbtball}"; exit;


				$sql = "
		   SELECT * FROM (SELECT @rownum := @rownum+1 AS NUMBER, " . $sqldbtball . " FROM  " . $sqldbtb . " " . $Condition . " ) AS TBL
			  WHERE NUMBER BETWEEN :rowstart AND :rowend ;
		  ";


				$command = $conn->createCommand($sql);
				$command->bindValue(":rowstart", ($start + 1));
				$command->bindValue(":rowend", ($start + $recordsPerPage));

				$rows = $command->queryAll();

				//var_dump($rows);exit;

				$arr = array();
				foreach ($rows as $dataitem) {

					/*$strbtn ='
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-icon btn-info waves-effect waves-classic" title="แสดงโปรไฟล์"><i class="icon md-file" aria-hidden="true"></i>test</button>
				</div>
				';
			$dataitem['btn'] = $strbtn ;
			*/

					$arr[] = array_values($dataitem);
				}

				$jsondata = json_encode($rows); //$arr

				//var_dump($jsondata);exit;

				$sql = "SELECT COUNT(*) As ct FROM " . $sqldbtb . " " . $Condition;

				$command = $conn->createCommand($sql);
				$rows = $command->queryAll();
				$noOfRecords =  $rows[0]['ct'];

				echo '{"recordsTotal":' . $noOfRecords . ',"recordsFiltered":' . $noOfRecords . ',"data":' . $jsondata . '}';

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionLoadtxtlog()
	{
?>
		<table id="txtlog" class="thfont5">
			<?php
			if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
				$protocol = "https://";
			} else {
				$protocol = "http://";
			}
			$url = $protocol . $_SERVER["HTTP_HOST"];

			$logpath =  $_SERVER['DOCUMENT_ROOT'] . "/wpdcore/ledtextfile/sapiens"; //server local
			//$logpath = Yii::app()->Cgentextfile->localpathled ; //server uat						
			$fileList = glob($logpath . '/log_*.TXT');
			foreach ($fileList as $filename) {

				//echo $filename, '<br>'; 
				$arrfile = explode("/", $filename);
				//echo end($arrfile), '<br/>';
				//echo($logpath ."/" . end($arrfile));
				$file_url =  str_replace($_SERVER['DOCUMENT_ROOT'], '', $url . $filename);

			?>
				<tr>
					<td id="<?php echo ($filename) ?>"><i class="icon fa-file-text"></i> <span style="color:#3333FF; cursor:pointer;" onClick="javascript:getfile('<?php echo end($arrfile) ?>','<?php echo ($file_url) ?>');"><?php echo end($arrfile) ?></span></td>

				</tr>
			<?php
			}

			?>
		</table>
<?php
	}

	public function actionOpenfileonftp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];

				$ignored = array('.', '..', '.svn', '.htaccess');

				$localDir  = Yii::app()->Cgentextfile->localpathled; //'C:/xampp/htdocs/downloadfile'; //$localpathled;
				$remoteDir = Yii::app()->Cgentextfile->remotepathled; //'/home/wpdusr/uploaddir'; //$remotepathled; 

				$files = array();
				if (Yii::app()->Cgentextfile->getConnectionsftp()) {
					$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
					$dir = 'ssh2.sftp://' . intval($sftp) . $remoteDir;

					$dir_path   = scandir($dir); //var_dump($dir_path);

					$year = date('Y');
					$file_filter = 'T8000_W' . substr((string)((int)$year + 543), 2); //echo $file_filter; exit;
					$result = array_filter(
						$dir_path,
						function ($value) use (&$file_filter) {
							return (strpos($value, $file_filter) === 0);
						}

					);

					foreach ($result as $file) {
						if (in_array($file, $ignored)) continue;
						$files[$file] = filemtime($dir . '/' . $file);
					}

					arsort($files);
					$files = array_keys($files);
				} //if


				$data1 = array('action' => $action, 'result' => $files);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/getfilenameonsftp', $data1);

				exit;

				$dir = "D:\Server\www\wpdtextfile\led";
				$files = array();
				foreach (scandir($dir) as $file) {
					if (in_array($file, $ignored)) continue;
					$files[$file] = filemtime($dir . '/' . $file);
				}

				arsort($files);
				$files = array_keys($files);
				//var_dump($files);

				$result = array_filter(
					$files,
					function ($value) {
						return (strpos($value, 'T8000_W') === 0);
					}
				);

				$data1 = array('action' => $action, 'result' => $result);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/getfilenameonsftp', $data1);

				exit;

				$localDir  = Yii::app()->Cgentextfile->localpathled; //'C:/xampp/htdocs/downloadfile'; //$localpathled;
				$remoteDir = Yii::app()->Cgentextfile->remotepathled; //'/home/wpdusr/uploaddir'; //$remotepathled; 


				if (Yii::app()->Cgentextfile->getConnectionsftp()) {
					$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
					$files    = scandir('ssh2.sftp://' . intval($sftp) . $remoteDir);
					if (!empty($files)) {
						foreach ($files as $key => $value) {
							if (!in_array($value, array(".", ".."))) {
								if (is_dir($remoteDir . DIRECTORY_SEPARATOR . $value)) {
									$result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
								} else { //if
									$result[] = $value;
								} //if
							} //if
						} //foreach
					} //if
				} //if

				$result = array_filter(
					$files,
					function ($value) {
						return (strpos($value, 'T8000_W') === 0);
					}
				);

				//var_dump($result);
				$data1 = array('action' => $action, 'result' => $result);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/getfilenameonsftp', $data1);

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


	public function loadtxtlog()
	{
	}


	public function actionChkmasleddata()
	{

		set_time_limit(0);
		ini_set("max_execution_time", "0");
		ini_set("memory_limit", "9999M");

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				//echo "{$action}";
				//get data from ledrpt_tb
				$q = new CDbCriteria(array(
					'condition' => "lrpt_status = :lrpt_status ",
					'params'    => array(':lrpt_status' => 1)
				));
				$mLedrptTb = LedrptTb::model()->findAll($q);
				$c = count($mLedrptTb);
				if ($c != 0) {
					$time_start = microtime(true); //เริ่มจับเวลา
					$rc = 0;
					$scc = 0;
					$sce = 0;
					$sc = 0;
					foreach ($mLedrptTb as $rows) {
						$accno = $rows->lrpt_accno;
						$registernumber = trim($rows->lrpt_registernumber);
						//echo "{$registernumber}, {$accno} <br>";
						//เปรียบเทียบข้อมูลกับ ข้อมูลกลุ่มเสี่ยง
						$mrc = LedriskcropTb::model()->findByAttributes(array('lrc_registernumber' => $registernumber, 'lrc_status' => 1)); //, 
						if ($mrc) {
							//echo "y,{$registernumber} <br>";
							//เปลี่ยนสถานะกลุ่มเสี่ยง
							$mrc->lrc_updateby = Yii::app()->user->username;
							$mrc->lrc_modified = date('Y-m-d H:i:s');
							$mrc->lrc_status = 2;
							if ($mrc->save()) {
								$msg = "update data is success.";
								$scc = $scc + 1; //จำนวนสำเร็จ
								$sc = 0; //สถานะ error
							} else {
								$msg = $mrc->getErrors();
								$sce = $sce + 1; //จำนวน error
								$sc = 1; //สถานะ error
							} //if  
						} //if
						$rc += 1;
					} //for
					$time_end = microtime(true);
					$execution_time = ($time_end - $time_start) / 60;
					if ($sc === 0) {
						echo "ปรับปรุงข้อมูลสำเร็จ, ใช้เวลา : {$execution_time} นาที, จำนวนรายการทั้งหมด : {$rc} รายการ สำเร็จ : {$scc} รายการ, ล้มเหลว : {$sce} รายการ";
					} else {
						echo "มีปัญหาในการปรับปรุงข้อมูล , ใช้เวลา : {$execution_time} นาที, จำนวนรายการทั้งหมด : {$rc} รายการ สำเร็จ : {$scc} รายการ, ล้มเหลว : {$sce} รายการ";
					}
				} //if


				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallshowrptled33()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$lrc_id = $_GET['lrc_id'];
				$lrc_accno = $_GET['lrc_accno'];
				$lrc_registernumber = $_GET['lrc_registernumber'];
				//echo "{$lrc_id},{$lrc_accno}";exit;

				//ค้นหาชื่อบริษัท
				$mrc = LedriskcropTb::model()->findByAttributes(array('lrc_registernumber' => $lrc_registernumber));
				if ($mrc) {
					$lrc_registername = $mrc->lrc_registername;
				} else {
					$lrc_registername = "-";
				}

				//ค้นหาชื่อ user
				$musr = Users::model()->findByAttributes(array('username' => Yii::app()->user->username));
				if ($musr) {
					$firstname = $musr->firstname;
					$lastname = $musr->lastname;
					$address = $musr->address;
					$username = $musr->username;

					$usrprint = $firstname . "  " . $lastname . " , " . $address . " , " . $username;
				} else {
					$usrprint = "-";
				}



				$data1 = array('lrc_id' => $lrc_id, 'lrc_accno' => $lrc_accno, 'lrc_registernumber' => $lrc_registernumber, 'lrc_registername' => $lrc_registername, 'usrprint' => $usrprint);

				$this->layout = 'nolayout';
				$this->pageTitle = 'report';
				$this->render('/site/reportpages/reportsled33sub', $data1);

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallsearchledall()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/searchledall2');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function 

	public function actionCallserchreport()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/searchreport');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function 



	public function actionGetfile()
	{
		$file_path = $_GET['file_path'];
		$arrfile = explode("/", $file_path);
		$type = mime_content_type($file_path);
		header('Content-Type: ' . $type);
		header('Content-Length: ' . filesize($file_path));
		header('Content-Disposition: attachment;filename=' . urldecode(end($arrfile)));
		readfile($file_path);
	} //โหลด txt file ตาม get params


	public function actionWpdfortxtfile()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************
				$bgdate = $_POST['bgdate'];
				$eddate = $_POST['eddate'];
				//echo "{$bgdate},{$eddate}";
				$data1 = array('bgdate' => $bgdate, 'eddate' => $eddate);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/wpdfortxtfile', $data1);
				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionGentxtfilewpd()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************
				$bgdate = $_POST['bgdate'];
				$eddate = $_POST['eddate'];
				//echo "{$bgdate},{$eddate}";
				$data1 = array('bgdate' => $bgdate, 'eddate' => $eddate);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/gentxtfileforwpd', $data1);
				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function

	public function actionGetfilenamesapains()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************
				//echo "Get filename from sapains";
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/getfilenamesapains');
				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function

	public function actionGentxtfilesapeains()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************
				$tfn = $_POST['tfn'];
				//echo "{$tfn}";
				$data1 = array('tfn' => $tfn);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/gentxtfileforsapains', $data1);
				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function

	public function actionWritesapeainsall()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************
				$tfns = $_POST['tfns'];
				$tfnsa = "sapainsall.txt";
				//ตรวจสอบว่ามีเท็กซ์ไฟล์ชื่อ sapainsall.txt แล้วหรือยัง
				$filename = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/sapains/" . $tfnsa;
				$filename2 = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/sapains/" . $tfns;
				if (file_exists($filename)) {
					//------กรณีที่มีไฟล์อยู่แล้ว---------------------------------

				} else {
					//------กรณีที่ยังไม่มีไฟล์----------------------------------
					//------สร้างไฟล์ sapainsall.txt------------------------
					$file = fopen($filename, "w") or die("Unable to open file!");
					$content = "";
					fwrite($file, $content);
					fclose($file);
					//--------------------------------------------------
				} //if

				//เริ่มอ่านไฟล์ทั้งหมดว่ามีข้อมูลถึงบรรทัดไหน
				//echo readfile($filename);//อ่านไฟล์แสดงข้อมูลในไฟล์ และ จำนวน column
				if (readfile($filename2) != 0) { //แสดงว่ายังไเป็นไฟล์ว่างไม่มีข้อความ
					//อ่านไฟล์ที่2
					$myfile2 = fopen($filename2, "r") or die("Unable to open file!");
					$myfilecontent2 = fread($myfile2, filesize($filename2));
					fclose($myfile2);
					//เขียนไฟล์รวมต่อจากบรรทัดสุดท้าย
					$data = $myfilecontent2; // . PHP_EOL;
					$fp = fopen($filename, 'a') or die("Unable to open file!");
					if (fwrite($fp, $data)) {
						$wok = 'y';
					} else {
						$wok = 'n';
					}
					fclose($fp);
				} else { //if
					$wok = 'n';
				}

				if ($wok === 'y') { //ถ้าเขียนไฟล์เพิ่มสำเร็จ
					//อัปเดทข้อมูลสถานะในตาราง sapainstxtfile2_tb
					$anb = Sapainstxtfile2Tb::model()->findByAttributes(array('sptf_filename' => $tfns));
					$anb->sptf_updateby = Yii::app()->user->username;
					$anb->sptf_modified = date('Y-m-d H:i:s');
					$anb->sptf_remark = "-";
					$anb->sptf_status = 2;
					if ($anb->save()) {
						$msg3 = "update data is success.";
					} else {
						$msg3 = "can't update data.";
					}
					ob_clean();
					echo "y";
				} else { //if
					ob_clean();
					echo "n";
				}

				//echo "เชียนไฟล์รวม เรียบร้อยแล้ว.";

				/*$myfile = fopen($filename, "r") or die("Unable to open file!");
				//var_dump($myfile);
				//echo "{$myfile}";
				//echo fread($myfile,filesize($filename)); //read all contineus line 
				//echo fgets($myfile); //read 1 line
				/*while(!feof($myfile)) {// Output one line until end-of-file
				  echo fgets($myfile); //read ที่ละ 1 บรรทัด จนกว่าจะหมดทุกบรรทัด
				}*/
				//readfile to array
				/* $datastr  = fgets($myfile);
	             $arraystr = explode(";", $datastr);
	  			 $t1 = trim($arraystr[0]);
	  			 $t2 = trim($arraystr[1]);
	  			 $t3 = trim($arraystr[2]);
	  			 echo "{$t1}, {$t2}, {$t3}";*/
				//อ่านไฟล์เก็บไว้ในตัวแปร
				// $myfilecontent = fread($myfile,filesize($filename));
				//echo "{$myfilecontent}";
				//fclose($myfile);

				/*$myfile2 = fopen($filename2, "r") or die("Unable to open file!");
				$myfilecontent2 = fread($myfile2,filesize($filename2));
			fclose($myfile2);
			
			$newcontent = $myfilecontent . "\r\n" . $myfilecontent2;
			
			$data = $myfilecontent2; // . PHP_EOL;
			$fp = fopen($filename, 'a') or die("Unable to open file!");
			 fwrite($fp, $data);
			fclose($fp);*/

				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function 

	public function actionGetfilenamewpd()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************
				$action = $_POST['action'];

				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/getfilenamewpd', $data1);

				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function

	public function actionGetfilenamesapeains()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************
				$action = $_POST['action'];
				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/getfilenamesapeains', $data1);
				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function

	public function actionCleansingdata1()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************
				$action = $_POST['action'];
				$wpdtxt = $_POST['wpdtxt'];
				$sapeinstxt = $_POST['sapeinstxt'];
				$filenamewpd = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpd/" . $wpdtxt;
				$filenamesapeins = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/sapains/" . $sapeinstxt;

				//echo "{$action}, {$wpdtxt}, {$sapeinstxt} <br> {$filenamewpd} <br> {$filenamesapeins}";
				//$myfilewpd = fopen($filenamewpd, "r") or die("Unable to open file!"); //เปิดไฟล์แบบอ่านอย่างเดียว
				//echo fread($myfilewpd,filesize($filenamewpd)); //read all contineus line 
				//echo fgets($myfilewpd); //read 1 line
				/*while(!feof($myfilewpd)) {// Output one line until end-of-file
				  echo fgets($myfilewpd); //read ที่ละ 1 บรรทัด จนกว่าจะหมดทุกบรรทัด
				}*/
				//อ่านไฟล์เก็บไว้ในตัวแปร
				/*$myfilewpdcontent = fread($myfilewpd,filesize($filenamewpd));
				 echo "{$myfilewpdcontent}";*/
				//readfile to array
				/*$r = 1;
				 while(!feof($myfilewpd)) {
				 	$datastrwpd  = fgets($myfilewpd);
	             	$arraystrwpd = explode(",", $datastrwpd);
	  			 	$t1 = trim($arraystrwpd[0]);
	  			 	//$t2 = trim($arraystrwpd[1]);
	  			 	//$t3 = trim($arraystrwpd[2]);
	  			 	echo "{$r},{$t1} <br>";
					$r += 1;
				 }//*/
				//fclose($myfilewpd); //ปิดไฟล์

				$file_content_sapeins = file_get_contents($filenamesapeins);
				echo "{$file_content_sapeins}";


				$file_content_wpd = file_get_contents($filenamewpd);
				//echo "{$file_content_wpd}";
				$data = explode("\n", $file_content_wpd);
				foreach ($data as $key => $value) {
					//echo "{$key} : {$value}";
					$arraystrwpd = explode(",", $value);
					$registernumberwpd = trim($arraystrwpd[0]);
					echo "{$registernumberwpd}";

					//$content_clensing_string = strstr($file_content_sapeins, $registernumberwpd, true);
					//echo "{$content_clensing_string}";
					/*if (false !== $content_clensing_string) {
					echo "yes";
				}else{//if
					//
				}*/
				} //for

				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function

	public function actionUpdatecleansingdata()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************

				$action = $_POST['action'];
				$clstxt = $_POST['clstxt'];
				$filenamewpd = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpd/" . $clstxt;

				/*$regis_no[0]  = "0105562158662";
				$regis_no[1]  = "0485562000659";
				
				
				$acc_no_wpd[0] = "1020005378";
				$acc_no_wpd[1] = "4820000080";
				
				
				$acc_no_sapeins[0] = "1002921945";
				$acc_no_sapeins[1] = "4800000080";*/





				for ($i = 0; $i <= 823; $i++) {
					//echo "$regis_no[$i], $acc_no_wpd[$i], $acc_no_sapeins[$i]" . ", ";


					$regis_not = trim($regis_no[$i]);
					$acc_no_wpdt = trim($acc_no_wpd[$i]);
					$acc_no_sapeinst = trim($acc_no_sapeins[$i]);

					echo "{$i}, {$regis_not}, {$acc_no_wpdt}, {$acc_no_sapeinst} <br>";

					//$registername = "-";


					//เริ่ม update data=====================================
					$sts = 0;
					//insert CleansingTb
					$clsd = CleansingTb::model()->findByAttributes(array('clsg_registernumber' => $regis_not));
					if (!$clsd) {
						$CleansingTb = new CleansingTb();
						$CleansingTb->clsg_registernumber = $regis_not;
						$CleansingTb->clsg_wpdaccno = $acc_no_wpdt;
						$CleansingTb->clsg_sapainsaccno = $acc_no_sapeinst;
						$CleansingTb->clsg_registername = $registername;
						$CleansingTb->clsg_createby = Yii::app()->user->username;
						$CleansingTb->clsg_created = date('Y-m-d H:i:s');
						$CleansingTb->clsg_updateby = Yii::app()->user->username;
						$CleansingTb->clsg_modified = date('Y-m-d H:i:s');
						$CleansingTb->clsg_remark = 'y';
						$CleansingTb->clsg_status = 1;
						if ($CleansingTb->save()) {
							//echo "{$r}, {$regis_no}, {$acc_no_wpd}, {$acc_no_sapeins} <br>";
							$sts = 0;
							//update data to table cropinfo_tmp ====================
							$cif = CropinfoTmpTb::model()->findByAttributes(array('registernumber' => $regis_not));
							if ($cif) {
								$cif->acc_no = $acc_no_sapeinst;
								$cif->crop_updateby = Yii::app()->user->username;
								$cif->crop_updatetime = date('Y-m-d H:i:s');
								$cif->crop_remark = "A";
								$cif->crop_status = 4;
								if ($cif->save()) {
									$sts = 0;
									//$msg3 = "update data is success.";
									// update accnumber===============================
									$anb = AccnumberTb::model()->findByAttributes(array('acc_regis_no' => $regis_not));
									if ($anb) {
										$anb->acc_active_flag = 'C';
										$anb->acc_updateby = Yii::app()->user->username;
										$anb->acc_modified = date('Y-m-d H:i:s');
										$anb->acc_remark = $acc_no_sapeinst;
										$anb->acc_status = 5;
										if ($anb->save()) {
											$sts = 0;
											// update EmpstateTb =============================================
											$est = EmpstateTb::model()->findByAttributes(array('ems_registernumber' => $regis_not));
											if ($est) {
												$est->ems_updateby = Yii::app()->user->username;
												$est->ems_modified = date('Y-m-d H:i:s');
												$est->ems_remark = $acc_no_sapeinst;
												$est->ems_status = 2;
												if ($est->save()) {
													$sts = 0;
												} else {
													$sts = 2;
												} //if
											} //if

											//update crop_v_bran =========================================
											$cvb = CropVBran::model()->findByAttributes(array('registernumber' => $regis_not));
											if ($cvb) {
												$cvb->acc_no = $acc_no_sapeinst;
												$cvb->crop_remark = 'A';
												$cvb->crop_updatetime = date('Y-m-d H:i:s');
												$cvb->crop_status = 4;
												if ($cvb->save()) {
													$sts = 0;
												} else {
													$sts = 1;
												}
											} //if


										} else { //if
											$sts = 3;
										} //if
									} else { //if
										$sts = 4;
									} //if
								} else { //if
									$sts = 5;
								}
							} //if
						} //if
					} //if
					//จบ update data=====================================


				} //for $i


				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function

	public function actionDownloadtxtfilefrmsftpsapeinsauto()
	{

		$username = "sys";

		$action = $_POST['action'];
		$dwntxt = $_POST['dwntxt'];

		$localpathf = Yii::app()->Cgentextfile->localpathd . $dwntxt; //"C:/xampp/htdocs/wpdtextfile/out/" . $dwntxt;
		$remotepathf = Yii::app()->Cgentextfile->remotepathd . $dwntxt; //"/home/wpdusr/uploaddir/" . $dwntxt; //T8000_D621030.txt";

		// checking whether file exists or not 
		if (file_exists($localpathf)) {
			echo "ไฟล์ชื่อ : {$dwntxt} มีอยู่แล้ว";
		} else {
			if (Yii::app()->Cgentextfile->getConnectionsftp()) {
				$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
				$contents = file_get_contents("ssh2.sftp://" . intval($sftp) . "$remotepathf");
				if (file_put_contents($localpathf, $contents)) {

					//เพิ่มรายการไฟล์ที่ donwload ลงใน table SapainstxtfileTb  *******
					$SapainstxtfileTb = new SapainstxtfileTb();
					$SapainstxtfileTb->sptf_filename = $dwntxt;
					$SapainstxtfileTb->sptf_path = $localpathf;
					$SapainstxtfileTb->sptf_numrec = 0;
					$SapainstxtfileTb->sptf_createby = $username;
					$SapainstxtfileTb->sptf_created = date('Y-m-d H:i:s');
					$SapainstxtfileTb->sptf_updateby = $username;
					$SapainstxtfileTb->sptf_modified = date('Y-m-d H:i:s');
					$SapainstxtfileTb->sptf_remark = "-";
					$SapainstxtfileTb->sptf_status = 1;
					if ($SapainstxtfileTb->save()) {
						//	
					} else {
						//
					} //if
					echo "Success to download {$dwntxt} <br>";

					//เริ่มอ่าน textfile ที่ละบรรทัด แล้วเก็บค่าไว้ในตัวแปร array
					$data = file_get_contents($localpathf);
					$data   = explode("\n", $data);
					$ln = 0;
					for ($line = 0; $line < count($data); $line++) {
						$dataln   = explode("|", $data[$line]);
						if (isset($dataln[8])) {
							if (intval($dataln[8]) > 0) {
								$sad_regisno = trim($dataln[8]);
								$sapeinsalldataTb = SapeinsalldataTb::model()->findByAttributes(array('sad_regisno' => $sad_regisno));
								if ($sapeinsalldataTb) {
									//
								} else {
									$insert_sp = new SapeinsalldataTb();
									$insert_sp->sad_regisno = trim($dataln[8]);
									$insert_sp->sad_accno = trim($dataln[3]);
									$insert_sp->sad_createby = $username;
									$insert_sp->sad_created = date('Y-m-d H:i:s');
									$insert_sp->sad_updateby = $username;
									$insert_sp->sad_modified = date('Y-m-d H:i:s');
									$insert_sp->sad_remark = "N";
									$insert_sp->sad_status = 1;
									if ($insert_sp->save()) {
										echo "{$ln}, ha {$dataln[8]} <br>";
									} else { //if
										$msg = $insert_sp->getErrors();
										echo "{$ln},{$dataln[8]},{$dataln[3]} can't insert data <br>";
										print_r($msg);
									}
								} //if
							} else {
								//
							} //if

						} else {
							//echo "{$ln}, nh {$dataln[8]} <br>";
						}
						$ln += 1;
					} //for
					//echo "{$ln} <br>";
				} else {
					echo "Failed to download {$dwntxt} <br>";
				}
			}
		} //if

	} //function

	public function actionCleansingdatastep2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//**************************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];

				$registername = "-";

				//ค้นหาเลช 10 หลักของ wpd
				$accnumbertb = AccnumberTb::model()->findByAttributes(array('acc_regis_no' => $regisnum));
				if ($accnumbertb) {
					$acc_no_wpdt = $accnumbertb->acc_no;
				} //if

				//เริ่มค้นหาข้อมูลจาก SapeinsalldataTb
				$sapeinsalldataTb = SapeinsalldataTb::model()->findByAttributes(array('sad_regisno' => $regisnum));
				if ($sapeinsalldataTb) { //ถ้ามีเลขนี้อยู่ใน sapeins แล้ว
					//เรียกใช้ฟังก์ชั่น cleansing data
					$regis_not = $sapeinsalldataTb->sad_regisno;
					$acc_no_sapeinst = $sapeinsalldataTb->sad_accno;

					//echo "{$regis_not},{$acc_no_sapeinst}, {$acc_no_wpdt}";


					//เริ่ม update data=====================================
					$sts = 0;
					//insert CleansingTb
					$clsd = CleansingTb::model()->findByAttributes(array('clsg_registernumber' => $regis_not));
					if (!$clsd) {
						$CleansingTb = new CleansingTb();
						$CleansingTb->clsg_registernumber = $regis_not;
						$CleansingTb->clsg_wpdaccno = $acc_no_wpdt;
						$CleansingTb->clsg_sapainsaccno = $acc_no_sapeinst;
						$CleansingTb->clsg_registername = $registername;
						$CleansingTb->clsg_createby = Yii::app()->user->username;
						$CleansingTb->clsg_created = date('Y-m-d H:i:s');
						$CleansingTb->clsg_updateby = Yii::app()->user->username;
						$CleansingTb->clsg_modified = date('Y-m-d H:i:s');
						$CleansingTb->clsg_remark = 'y';
						$CleansingTb->clsg_status = 1;
						if ($CleansingTb->save()) {
							//echo "{$r}, {$regis_no}, {$acc_no_wpd}, {$acc_no_sapeins} <br>";
							$sts = 0;
							//update data to table cropinfo_tmp ====================
							$cif = CropinfoTmpTb::model()->findByAttributes(array('registernumber' => $regis_not));
							if ($cif) {
								$cif->acc_no = $acc_no_sapeinst;
								$cif->crop_updateby = Yii::app()->user->username;
								$cif->crop_updatetime = date('Y-m-d H:i:s');
								$cif->crop_remark = "A";
								$cif->crop_status = 4;
								if ($cif->save()) {
									$sts = 0;
									//$msg3 = "update data is success.";
									// update accnumber===============================
									$anb = AccnumberTb::model()->findByAttributes(array('acc_regis_no' => $regis_not));
									if ($anb) {
										$anb->acc_active_flag = 'C';
										$anb->acc_updateby = Yii::app()->user->username;
										$anb->acc_modified = date('Y-m-d H:i:s');
										$anb->acc_remark = $acc_no_sapeinst;
										$anb->acc_status = 5;
										if ($anb->save()) {
											$sts = 0;
											// update EmpstateTb =============================================
											$est = EmpstateTb::model()->findByAttributes(array('ems_registernumber' => $regis_not));
											if ($est) {
												$est->ems_updateby = Yii::app()->user->username;
												$est->ems_modified = date('Y-m-d H:i:s');
												$est->ems_remark = $acc_no_sapeinst;
												$est->ems_status = 2;
												if ($est->save()) {
													$sts = 0;
												} else {
													$sts = 2;
												} //if
											} //if

											//update crop_v_bran =========================================
											$cvb = CropVBran::model()->findByAttributes(array('registernumber' => $regis_not));
											if ($cvb) {
												$cvb->acc_no = $acc_no_sapeinst;
												$cvb->crop_remark = 'A';
												$cvb->crop_updatetime = date('Y-m-d H:i:s');
												$cvb->crop_status = 4;
												if ($cvb->save()) {
													$sts = 0;
												} else {
													$sts = 1;
												}
											} //if


										} else { //if
											$sts = 3;
										} //if
									} else { //if
										$sts = 4;
									} //if
								} else { //if
									$sts = 5;
								}
							} //if
						} //if
					} //if

					//จบ update data=====================================

					//echo preg_replace("/\xEF\xBB\xBF/", "","Y");
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'Y')));
				} else { //ถ้ายังไม่มี

					//echo preg_replace("/\xEF\xBB\xBF/", "","N");
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('status' => 'N')));
				} //if 
				//**************************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function

	public function actionCallschandsavecropinfo2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}

				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];

				//ค้นหา provicecode เดิมออกมา
				$modelbch = BranchTmpTb::model()->findByAttributes(array('registernumber' => $schtxt));
				$provincecode1 = $modelbch->provincecode;

				//ค้นหา provicecode จาก dbd


				//$fullPathToWsdl = $_SERVER['DOCUMENT_ROOT'] . "/wpdcore_local/protected/components/" . "CorpInfoWebService.wsdl";
				$fullPathToWsdl = $_SERVER['DOCUMENT_ROOT'] . "/wpdcore/protected/components/" . "CorpInfoWebServiceV5.wsdl";

				if (file_exists($fullPathToWsdl)) {
					//echo "The file {$fullPathToWsdl} exists";	
					try {
						$client = new SoapClient($fullPathToWsdl, [
							'stream_context' => stream_context_create([
								'ssl' => [
									'verify_peer' => false,
									'verify_peer_name' => false,
								],
							]),
						]);

						//V2---------------------------------------------------
						/*$params = array(
				"subscribeId" => 'usersso', //'6211003', //usersso
				"pincode" => 'pinsso', //'P@ssw0rd', //pinsso
				"registerNumber" => $schtxt //'0305562004027'
			 );*/
						//----------------------------------------------------
						//V5---------------------------------------------------
						$params = array(
							"subscribeId" => '6211003', //'6211003', //usersso
							"pincode" => 'P@ssw0rd', //'P@ssw0rd', //pinsso
							"registerNumber" => $schtxt //'0305562004027'
						);
						//----------------------------------------------------

						$data = $client->GetCorpInfoByRegisterNumberService($params);
					} catch (SoapFault $fault) { //catch (Exception $e){catch (SoapFault $fault){
						//echo "Exception: \n" . $e->getMessage() . "\n";
						//trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
						$data = "";
						//echo "พบปัญหาการเชื่อมต่อ Server => SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring}) <br> กรุณาติดต่อผู้ดูแลระบบ!";
					} //

					//echo '<pre>';var_dump($data);echo '</pre>'; 

				} else {
					//echo "The file wsdl: {$fullPathToWsdl} does not exist";
					//echo "ไม่พบไฟล์ wsdl สำหรับเรียกใช้ web service จาก dbd.";
				}

				//exit;

				if ($data) {
					//echo "have data";
					//-----------------------------------------------------------------
					//จัดการข้อมูล crop_info===========================================
					if (property_exists($data->CorpInfo, "tsic")) {
						$tsic_u = $data->CorpInfo->tsic;
					} else {
						$tsic_u = "-";
					}
					if (property_exists($data->CorpInfo, "tsicName")) {
						$tsicName_u = $data->CorpInfo->tsicName;
					} else {
						$tsicName_u = "-";
					}
					if (property_exists($data->CorpInfo, "corpType")) {
						$corpType_u = $data->CorpInfo->corpType;
					} else {
						$corpType_u = "-";
					}
					if (property_exists($data->CorpInfo, "corpTypeName")) {
						$corpTypeName_u = $data->CorpInfo->corpTypeName;
					} else {
						$corpTypeName_u = "-";
					}
					if (property_exists($data->CorpInfo, "registerName")) {
						$registerName_u = $data->CorpInfo->registerName;
					} else {
						$registerName_u = "-";
					}
					if (property_exists($data->CorpInfo, "registerDate")) {
						$registerDate_u = $data->CorpInfo->registerDate;
						$registerDate_u =  date_create($registerDate_u)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
					} else {
						$registerDate_u =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s');  //date('Y-m-d H:i:s');
					}
					if (property_exists($data->CorpInfo, "updatedDate")) {
						$updatedDate_u = $data->CorpInfo->updatedDate;
						$updatedDate_u =  date_create($updatedDate_u)->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
					} else {
						$updatedDate_u =  date_create('1900-01-01T00:00:00+07:00')->format('Y-m-d H:i:s'); //date('Y-m-d H:i:s');
					}
					if (property_exists($data->CorpInfo, "updatedEntry")) {
						$updatedEntry_u = $data->CorpInfo->updatedEntry;
					} else {
						$updatedEntry_u = '-';
					}
					if (empty($updatedEntry_u)) {
						$updatedEntry_u = '-';
					}
					if (property_exists($data->CorpInfo, "authorizedCapital")) {
						$authorizedCapital_u = $data->CorpInfo->authorizedCapital;
						// number_format($data->CorpInfoList->corpInfo[$f]->authorizedCapital,2,".",",");
					} else {
						$authorizedCapital_u = 0;
					}
					if (empty($authorizedCapital_u)) {
						$authorizedCapital_u = 0;
					}
					if (property_exists($data->CorpInfo, "accountingDate")) {
						$accountingDate_u = $data->CorpInfo->accountingDate;
					} else {
						$accountingDate_u = '-';
					}
					if (empty($accountingDate_u)) {
						$accountingDate_u = '-';
					}
					if (property_exists($data->CorpInfo, "statusCode")) {
						$statusCode_u = $data->CorpInfo->statusCode;
					} else {
						$statusCode_u = '-';
					}
					if (empty($statusCode_u)) {
						$statusCode_u = '-';
					}
					if (property_exists($data->CorpInfo, "cpower")) {
						$cpower_u = $data->CorpInfo->cpower;
					} else {
						$cpower_u = '-';
					}
					if (empty($cpower_u)) {
						$cpower_u = '-';
					}

					//echo "{$tsic_u}, {$tsicName_u}, {$corpType_u}, {$corpTypeName_u}, {$registerName_u}, {$registerDate_u}, {$updatedDate_u}, {$updatedEntry_u}, {$authorizedCapital_u},  {$accountingDate_u}, {$statusCode_u}, {$cpower_u} ";
					//exit;

					//----- ดึงข้อมูลเดิมออกมาเพื่อนำไป insert ในตาราง cropinfo_mas_tb -----------------------------
					$CropinfoTmpTb = CropinfoTmpTb::model()->findByAttributes(array('registernumber' => $schtxt));
					if ($CropinfoTmpTb) {
						$crop_id = $CropinfoTmpTb->crop_id;
						$registernumber = $CropinfoTmpTb->registernumber;
						$registername = $CropinfoTmpTb->registername;
						$acc_no = $CropinfoTmpTb->acc_no;
						$acc_bran = $CropinfoTmpTb->acc_bran;
						$tsic = $CropinfoTmpTb->tsic;
						$tsicname = $CropinfoTmpTb->tsicname;
						$corptype = $CropinfoTmpTb->corptype;
						$corptypename = $CropinfoTmpTb->corptypename;
						$registerdate = $CropinfoTmpTb->registerdate;
						$updateddate = $CropinfoTmpTb->updateddate;
						$updateentry = $CropinfoTmpTb->updateentry;
						$accountingdate = $CropinfoTmpTb->accountingdate;
						$authorizedcapital = $CropinfoTmpTb->authorizedcapital;
						$statuscode = $CropinfoTmpTb->statuscode;
						$cpower = $CropinfoTmpTb->cpower;
						$crop_remark = $CropinfoTmpTb->crop_remark;
						$crop_createby = $CropinfoTmpTb->crop_createby;
						$crop_createtime = $CropinfoTmpTb->crop_createtime;
						$crop_updateby = $CropinfoTmpTb->crop_updateby;
						$crop_updatetime = $CropinfoTmpTb->crop_updatetime;
						$crop_status = $CropinfoTmpTb->crop_status;

						//echo "{$registernumber},{$registername},{$acc_no},{$acc_bran},{$tsic},{$tsicname},{$corptype},{$corptypename},{$registerdate},{$updateddate},{$updateentry},{$accountingdate},{$authorizedcapital},{$statuscode},{$cpower},{$crop_remark},{$crop_status}";
						//exit;
						//-------- insert ข้อมูล ใน cropinfo_mas_tb ---------------------------------
						$CropinfoMasTb = new CropinfoMasTb();
						//$CropinfoMasTb->crop_id  = "";
						$CropinfoMasTb->registernumber = $registernumber;
						$CropinfoMasTb->registername = $registername;
						$CropinfoMasTb->acc_no = $acc_no;
						$CropinfoMasTb->acc_bran = $acc_bran;
						$CropinfoMasTb->tsic = $tsic;
						$CropinfoMasTb->tsicname = $tsicname;
						$CropinfoMasTb->corptype = $corptype;
						$CropinfoMasTb->corptypename = $corptypename;
						$CropinfoMasTb->registerdate = $registerdate;
						$CropinfoMasTb->updateddate = $updateddate;
						$CropinfoMasTb->updateentry = $updateentry;
						$CropinfoMasTb->accountingdate = $accountingdate;
						$CropinfoMasTb->authorizedcapital = $authorizedcapital;
						$CropinfoMasTb->statuscode = $statuscode;
						$CropinfoMasTb->cpower = $cpower;
						$CropinfoMasTb->crop_remark = $crop_remark;
						$CropinfoMasTb->crop_createby = Yii::app()->user->username;
						$CropinfoMasTb->crop_createtime = date('Y-m-d H:i:s');
						$CropinfoMasTb->crop_updateby = Yii::app()->user->username;
						$CropinfoMasTb->crop_updatetime = date('Y-m-d H:i:s');
						$CropinfoMasTb->crop_status = $crop_status;
						if ($CropinfoMasTb->save()) {
							$levremark = "backup data cropinfo registernumber : " . $schtxt . " by " . Yii::app()->user->username;
							$msgresult = Yii::app()->Clogevent->createlogevent("backupdata", "cropinfo", "backupdataByUser", "bran", $levremark);
						} //if

						//-------- จบการ insert data ใน cropinfo_mas_tb ----------------------------
					} //if
					//----- จบการดึงข้อมูล ------------------------------------------------------------------
					//----- ปรับปรุงข้อมูลสำหรับถานประกอบการตามรายการที่เลือกมา -----------------------------------------
					$cift = CropinfoTmpTb::model()->findByAttributes(array('registernumber' => $schtxt));
					if ($cift) {

						//$cift->crop_id = "";
						//$cift->registernumber = "";
						$cift->registername = $registerName_u;
						//$cift->acc_no = "";
						//$cift->acc_bran = "";
						$cift->tsic = $tsic_u;
						$cift->tsicname = $tsicName_u;
						$cift->corptype = $corpType_u;
						$cift->corptypename = $corpTypeName_u;
						//$cift->registerdate = $registerDate_u;
						$cift->updateddate = $updatedDate_u;
						$cift->updateentry = $updatedEntry_u;
						$cift->accountingdate = $accountingDate_u;
						$cift->authorizedcapital = $authorizedCapital_u;
						$cift->statuscode = $statusCode_u;
						$cift->cpower = $cpower_u;
						//$cift->crop_remark = "";
						//$cift->crop_createby = "";
						//$cift->crop_createtime = "";
						$cift->crop_updateby = Yii::app()->user->username;
						$cift->crop_updatetime = date('Y-m-d H:i:s');
						//$cift->crop_status = "";

						if ($cift->save()) {
							$levremark = "update data cropinfo registernumber : " . $schtxt . " by " . Yii::app()->user->username;
							$msgresult = Yii::app()->Clogevent->createlogevent("updatedata", "cropinfo", "updatedataByUser", "updatecropinfo", $levremark);
						} //if

					} //if
					//----- จบการปรับปรุงข้อมูล ---------------------------------------------------------------
					//=============================================================
					//-----------------------------------------------------------------
					if (property_exists($data->CorpInfo, "branches")) {
						if (is_array($data->CorpInfo->branches->branch)) {
							$countbranches = count($data->CorpInfo->branches->branch);
							$brow = 1;
							for ($b = 0; $b <= $countbranches - 1; $b++) {
								if (property_exists($data->CorpInfo->branches->branch[$b], "orderNumber")) {
									$orderNumber = $data->CorpInfo->branches->branch[$b]->orderNumber;
								} else {
									$orderNumber = 0;
								}
								if (empty($orderNumber)) {
									$orderNumber = 0;
								} //if
								if (property_exists($data->CorpInfo->branches->branch[$b], "provinceCode")) {
									$provinceCode = $data->CorpInfo->branches->branch[$b]->provinceCode;
								} else {
									$provinceCode = "-";
								}
								if (empty($provinceCode)) {
									$provinceCode = '-';
								} //if

								if ($orderNumber == 0) {
									//echo "{$orderNumber}, {$provinceCode}<br>";
									break;
								}
							} //for($b=0
						} else { //if(is_array($data->CorpInfoList->corpInfo[$f]->branches->branch))
							$countbranches = 1;
							if (property_exists($data->CorpInfo->branches->branch, "orderNumber")) {
								$orderNumber = $data->CorpInfo->branches->branch->orderNumber;
							} else {
								$orderNumber = 0;
							}
							if (empty($orderNumber)) {
								$orderNumber = 0;
							}
							if (property_exists($data->CorpInfo->branches->branch, "provinceCode")) {
								$provinceCode = $data->CorpInfo->branches->branch->provinceCode;
							} else {
								$provinceCode = "-";
							}
							if (empty($provinceCode)) {
								$provinceCode = '-';
							}

							//echo "{$orderNumber}, {$provinceCode}<br>";

						} //if is_array
					} //if

					//echo "{$orderNumber}, {$provinceCode}, {$provincecode1}<br>";

					if ($provincecode1 == $provinceCode) { //กรณีจังหวัดเท่ากัน แสดงว่าไม่จำเป็นต้อง update ให้ส่งค่า "X"
						//echo "X";
						ob_clean();
						echo preg_replace("/\xEF\xBB\xBF/", "", CJSON::encode(array('statusx' => 'X')));
					} else {
						$transaction = Yii::app()->db->beginTransaction();
						try {
							Yii::app()->CCropinfo_tmp->registernumber = $schtxt;
							Yii::app()->CCropinfo_tmp->username = $username;
							if (Yii::app()->CCropinfo_tmp->BackupBrn()) { //backup สาขาสำนักงานใหญ่
								echo "backup branch is succss. <br>";
							} else {
								echo "can't backup branch. <br>";
							}

							Yii::app()->CCropinfo_tmp->UpdateBrn(); //update ที่ตั้งสำนักงานใหญ่

							Yii::app()->CGenAccNo->registernumber = $schtxt;
							Yii::app()->CGenAccNo->CheckAndGenAccno(); //เรียกใช้ฟังก์ชั่น ตรวจสอบและ gen เลข 10 หลักใหม่

							$transaction->commit();

							$levremark = "update data bran" . $schtxt;
							$msgresult = Yii::app()->Clogevent->createlogevent("Update", "bran", "UpdateByUser", "bran", $levremark);

							echo "ระบบ wpd ทำการปรับปรุงข้อมูลที่อยู่สำนักงานเรียบร้อยแล้ว.";
						} catch (\Exception $e) {

							$transaction->rollBack();
							throw $e;

							echo "ระบบ wpd ไม่สามารถปรับปรุงข้อมูลที่อยู่สำนักงานจาก wpd ได้.";
						} //try
					} //if

				} else {
					//echo "not have data";
					//echo "ไม่พบข้อมูลจาก dbd";
				} //if($data)

				//*********************************************************

			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionSchsapiensdataforclensing()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$schdate = $_POST['schdate'];

				$schd = date_create($schdate)->format('d');
				$schm = date_create($schdate)->format('m');
				$schy = date_create($schdate)->format('Y');

				//echo "{$action}, {$schdate}, {$schd}, {$schm}, {$schy}";
				$data1 = array('action' => $action, 'schdate' => $schdate);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/schsapiensforclensing', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCleansing3()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$sad_regisno = $_POST['sad_regisno'];
				$sad_accno = $_POST['sad_accno'];
				$acc_no = $_POST['acc_no'];
				$regname = $_POST['regname'];
				//echo "{$action}, {$sad_regisno}, {$sad_accno}, {$acc_no}, {$regname}";

				//เริ่มกำหนด transection
				$transaction = Yii::app()->db->beginTransaction();
				try {

					//เริ่ม update data=====================================
					$sts = 0;
					//insert CleansingTb
					$clsd = CleansingTb::model()->findByAttributes(array('clsg_registernumber' => $sad_regisno));
					if (!$clsd) {
						$CleansingTb = new CleansingTb();
						$CleansingTb->clsg_registernumber = $sad_regisno;
						$CleansingTb->clsg_wpdaccno = $acc_no;
						$CleansingTb->clsg_sapainsaccno = $sad_accno;
						$CleansingTb->clsg_registername = $regname;
						$CleansingTb->clsg_createby = Yii::app()->user->username;
						$CleansingTb->clsg_created = date('Y-m-d H:i:s');
						$CleansingTb->clsg_updateby = Yii::app()->user->username;
						$CleansingTb->clsg_modified = date('Y-m-d H:i:s');
						$CleansingTb->clsg_remark = 'y';
						$CleansingTb->clsg_status = 1;
						if ($CleansingTb->save()) {
							//echo "{$r}, {$regis_no}, {$acc_no_wpd}, {$acc_no_sapeins} <br>";
							$sts = 0;
							//update data to table cropinfo_tmp ====================
							$cif = CropinfoTmpTb::model()->findByAttributes(array('registernumber' => $sad_regisno));
							if ($cif) {
								$cif->acc_no = $sad_accno;
								$cif->crop_updateby = Yii::app()->user->username;
								$cif->crop_updatetime = date('Y-m-d H:i:s');
								$cif->crop_remark = "A";
								$cif->crop_status = 4;
								if ($cif->save()) {
									$sts = 0;
									//$msg3 = "update data is success.";
									// update accnumber===============================
									$anb = AccnumberTb::model()->findByAttributes(array('acc_regis_no' => $sad_regisno));
									if ($anb) {
										$anb->acc_active_flag = 'C';
										$anb->acc_updateby = Yii::app()->user->username;
										$anb->acc_modified = date('Y-m-d H:i:s');
										$anb->acc_remark = $sad_accno;
										$anb->acc_status = 5;
										if ($anb->save()) {
											$sts = 0;
											// update EmpstateTb =============================================
											$est = EmpstateTb::model()->findByAttributes(array('ems_registernumber' => $sad_regisno));
											if ($est) {
												$est->ems_updateby = Yii::app()->user->username;
												$est->ems_modified = date('Y-m-d H:i:s');
												$est->ems_remark = $sad_accno;
												$est->ems_status = 2;
												if ($est->save()) {
													$sts = 0;
												} else {
													$sts = 2;
												} //if
											} //if

											//update crop_v_bran =========================================
											$cvb = CropVBran::model()->findByAttributes(array('registernumber' => $sad_regisno));
											if ($cvb) {
												$cvb->acc_no = $sad_accno;
												$cvb->crop_remark = 'A';
												$cvb->crop_updatetime = date('Y-m-d H:i:s');
												$cvb->crop_status = 4;
												if ($cvb->save()) {
													$sts = 0;
												} else {
													$sts = 1;
												}
											} //if

										} else { //if
											$sts = 3;
										} //if
									} else { //if
										$sts = 4;
									} //if
								} else { //if
									$sts = 5;
								}
							} //if
						} //if
					} //if
					//จบ update data=====================================

					$transaction->commit(); //ถ้าทำงานผ่า่นทุกฟังก์ชั่น

					$levremark = "cleansing step3 registernumber : " . $sad_regisno . " sapiens accno:" . $sad_accno . " wpd accno:" . $acc_no;
					$msgresult = Yii::app()->Clogevent->createlogevent("Cleansing", "Sapiens", "Wpd", "data", $levremark);
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", "Y");
				} catch (\Exception $e) {
					$transaction->rollBack();
					throw $e;
					ob_clean();
					echo preg_replace("/\xEF\xBB\xBF/", "", "N");
				} //try



				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //funciton

	public function actionSchsapiensdataforclensingauto()
	{

		$action = $_POST['action'];
		$schdate = $_POST['schdate'];

		$schd = date_create($schdate)->format('d');
		$schm = date_create($schdate)->format('m');
		$schy = date_create($schdate)->format('Y');

		//echo "{$action}, {$schdate}, {$schd}, {$schm}, {$schy}";

		$data1 = array('action' => $action, 'schdate' => $schdate);
		$this->layout = 'nolayout';
		$this->render('/site/servicepages/schsapiensforclensingauto', $data1);
	} //function

	public function actionGettextfileforsapiens2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];

				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/gettextfileforsapiens2', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionAddtextfileforsapiens()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$tfnt = $_POST['tfnt'];

				$textfilename = $tfnt;

				$mypath = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/" . $textfilename;

				//== create textfile ======
				$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/" . $textfilename, "w") or die("Unable to open file!");
				fclose($myfile);
				//== insert to table ======
				$insert_ndt = new Textfileforsapiens2Tb();
				$insert_ndt->tffs_name = $textfilename;
				$insert_ndt->tffs_numrec = 0;
				$insert_ndt->tffs_createby = Yii::app()->user->username;
				$insert_ndt->tffs_created = date('Y-m-d H:i:s');
				$insert_ndt->tffs_updateby = Yii::app()->user->username;
				$insert_ndt->tffs_modified = date('Y-m-d H:i:s');
				$insert_ndt->tffs_remark = $mypath;
				$insert_ndt->tffs_status = 1;
				if ($insert_ndt->save()) {
					$msg = "insert is success.";
					//echo preg_replace("/\xEF\xBB\xBF/", "","Y");
					//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => 'success')));
					//== insert log event ======================
					$levremark = "create textfile : " . $tfnt . " for old wpd";
					$msgresult = Yii::app()->Clogevent->createlogevent($action, "service8", "oldwpd", $tfnt, $levremark);
					//==========================================
				} else { //if
					$msg = $insert_sp->getErrors();
					//echo preg_replace("/\xEF\xBB\xBF/", "","N");
					//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => $msg)));
				}

				echo $msg;
				//=========================

				//===========================================

				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


	public function actionAddtextfileforsapiensauto()
	{

		$action = $_POST['action'];
		$tfnt = $_POST['tfnt'];

		$textfilename = $tfnt;

		$mypath = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/" . $textfilename;

		//== create textfile ======
		$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/" . $textfilename, "w") or die("Unable to open file!");
		fclose($myfile);
		//== insert to table ======
		$search_ndt = Textfileforsapiens2Tb::model()->findByAttributes(array('tffs_name' => $tfnt));
		if (!$search_ndt) { //not have file
			$insert_ndt = new Textfileforsapiens2Tb();
			$insert_ndt->tffs_name = $textfilename;
			$insert_ndt->tffs_numrec = 0;
			$insert_ndt->tffs_createby = 'sys';
			$insert_ndt->tffs_created = date('Y-m-d H:i:s');
			$insert_ndt->tffs_updateby = 'sys';
			$insert_ndt->tffs_modified = date('Y-m-d H:i:s');
			$insert_ndt->tffs_remark = $mypath;
			$insert_ndt->tffs_status = 1;
			if ($insert_ndt->save()) {
				$msg = "create and insert textfile is success.";
				//== insert log event ======================
				$levremark = "create textfile : " . $tfnt . " for old wpd by sys is success.";
				$msgresult = Yii::app()->Clogevent->createlogevent($action, "service8", "oldwpd", $tfnt, $levremark);
				//==========================================
			} else { //if
				$msg = $insert_sp->getErrors();
			} //if
		} else { //if
			$msg = "The file  \"" . $tfnt . "\" is already exists in the system.";
		}
		//=========================
		echo $msg;
	} //function

	public function actionWritedatatotextfile()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$tffs_id = $_POST['tffs_id'];
				$tffs_name = $_POST['tffs_name'];
				$data1 = array('action' => $action, 'tffs_id' => $tffs_id, 'tffs_name' => $tffs_name);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/writedatatotextfile', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallwpddataforsapiens()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$bgdatewt1 = $_POST['bgdatewt1'];
				$tffs_id = $_POST['tffs_id'];
				$tffs_name = $_POST['tffs_name'];
				$actionby = 'm';
				$data1 = array('action' => $action, 'bgdatewt1' => $bgdatewt1, 'tffs_id' => $tffs_id, 'tffs_name' => $tffs_name, 'actionby' => $actionby);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/callwpddataforsapiens', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallwpddataforsapiensauto()
	{
		$action = $_POST['action'];
		$bgdatewt1 = $_POST['bgdatewt1'];
		$actionby = 'a';
		//search tffs_id and tffs_name---------------------------------------------------------------------------
		$qry = new CDbCriteria(array(
			'condition' => "tffs_status < :tffs_status ",
			'params'    => array(':tffs_status' => 3),
			'order'		=> "tffs_id DESC",
			'limit'		=> 1
		));
		$modelarray = Textfileforsapiens2Tb::model()->findAll($qry);
		//var_dump($modelarray); exit;
		if ($modelarray) {
			$countmedel = count($modelarray);
			foreach ($modelarray as $rows) {
				$tffs_id = $rows->tffs_id;
				$tffs_name = $rows->tffs_name;
			} //for

			//echo "{$action}, {$bgdatewt1}, {$countmedel}, {$tffs_id}, {$tffs_name}"; exit;

			$data1 = array('action' => $action, 'bgdatewt1' => $bgdatewt1, 'tffs_id' => $tffs_id, 'tffs_name' => $tffs_name, 'actionby' => $actionby);
			$this->layout = 'nolayout';
			$this->render('/site/servicepages/callwpddataforsapiens', $data1);
		} else { //if
			//== insert log event ======================
			$tffs_name = "-";
			$levremark = "write data to textfile : " . $tffs_name . " for old wpd by sys is error";
			$msgresult = Yii::app()->Clogevent->createlogevent($action, "writetextfileoldwpd", "error", $tffs_name, $levremark);
			//==========================================
			echo $levremark;
		} //if
		//-------------------------------------------------------------------------------------------------------

	} //function

	public function actionDeletefileoldwpd()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$tffs_id = $_POST['tffs_id'];
				$tffs_name = $_POST['tffs_name'];
				//==update status table textfile=========================
				$utfw = Textfileforsapiens2Tb::model()->findByAttributes(array('tffs_id' => $tffs_id));
				$utfw->tffs_updateby = Yii::app()->user->username;
				$utfw->tffs_modified = date('Y-m-d H:i:s');
				$utfw->tffs_status = 0;
				if ($utfw->save()) {
					$msg = "update data is success.";
					//echo preg_replace("/\xEF\xBB\xBF/", "","Y");
					//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => 'success')));
					//== insert log event ======================
					$levremark = "delete textfile : " . $tffs_name . " for old wpd";
					$msgresult = Yii::app()->Clogevent->createlogevent($action, "gettextfileforsapiens2", "oldwpd", $tffs_name, $levremark);
					//==========================================
				} else {
					$msg = "can't update data.";
					//echo preg_replace("/\xEF\xBB\xBF/", "","N");
					//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => $msg)));
				}
				echo $msg;
				//=======================================================
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCalluploadfileoldwpdtosftp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (isset(Yii::app()->user->username)) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}

				$localpath_local = "/opt/share/html/wpdtextfile/wpdold/"; //"/opt/share/html/wpdtextfile/";
				$remotepath_local = "/out/ssossv1/"; //"/in/"; "/out/ssossv1"; "/out/ssossv2";

				$action = $_POST['action'];
				$gtfname = $_POST['tffs_name'];

				//echo "{$action},{$gtfname}"; exit;

				$localFile = $localpath_local . $gtfname; //path local
				$remoteFile = $remotepath_local . $gtfname; //path sftp

				if (Yii::app()->Cgentextfile->getConnectionsftpssv()) { //getConnectionsftpssv //getConnectionsftp
					$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
					$contents = file_get_contents($localFile);
					$putfile = file_put_contents("ssh2.sftp://" . intval($sftp) . "$remoteFile", $contents);
					//update table-------------------------------------------------------------------------
					$anb = Textfileforsapiens2Tb::model()->findByAttributes(array('tffs_name' => $gtfname));
					$anb->tffs_updateby = Yii::app()->user->username;
					$anb->tffs_modified = date('Y-m-d H:i:s');
					$anb->tffs_status = 3;
					if ($anb->save()) {
						//insert_log------------------------------------------------------------------------
						$levremark = "upload textfile oldwpd : " . $gtfname . " for old wpd by " . Yii::app()->user->username . " is success";
						$msgresult = Yii::app()->Clogevent->createlogevent($action, "textfileoldwpd", "uploadtextfile", $gtfname, $levremark);
						//----------------------------------------------------------------------------------
						//echo "Success";
						$msg = "Upload file is success.";
					} else {
						//echo "Failed";
						$msg = "Can't upload file.";
					}
					//---------------------------------------------------------------------------------------
				} else {
					//echo preg_replace("/\xEF\xBB\xBF/", "","Failed");
					$msg = "Can't connect SFTP Server.";
				} //if
				echo $msg;
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCalluploadfileoldwpdtosftpauto()
	{

		$localpath_local = "/opt/share/html/wpdtextfile/wpdold/"; //"/opt/share/html/wpdtextfile/";
		$remotepath_local = "/out/ssossv1/"; //"/in/"; "/out/ssossv1"; "/out/ssossv2";

		$action = $_POST['action'];

		//search tffs_id and tffs_name---------------------------------------------------------------------------
		$qry = new CDbCriteria(array(
			'condition' => "tffs_status < :tffs_status ",
			'params'    => array(':tffs_status' => 3),
			'order'		=> "tffs_id DESC",
			'limit'		=> 1
		));
		$modelarray = Textfileforsapiens2Tb::model()->findAll($qry);
		//var_dump($modelarray); exit;
		if ($modelarray) {
			$countmedel = count($modelarray);
			foreach ($modelarray as $rows) {
				$tffs_id = $rows->tffs_id;
				$tffs_name = $rows->tffs_name;
			} //for
			$gtfname = $tffs_name; //findname status = 2

			//echo "{$action},{$gtfname}"; exit;

			$localFile = $localpath_local . $gtfname; //path local
			$remoteFile = $remotepath_local . $gtfname; //path sftp

			if (Yii::app()->Cgentextfile->getConnectionsftpssv()) { ////getConnectionsftpssv //getConnectionsftp
				$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
				$contents = file_get_contents($localFile);
				$putfile = file_put_contents("ssh2.sftp://" . intval($sftp) . "$remoteFile", $contents);
				//update table-------------------------------------------------------------------------
				$anb = Textfileforsapiens2Tb::model()->findByAttributes(array('tffs_name' => $gtfname));
				$anb->tffs_updateby = "sys";
				$anb->tffs_modified = date('Y-m-d H:i:s');
				$anb->tffs_status = 3;
				if ($anb->save()) {
					//insert_log------------------------------------------------------------------------
					$levremark = "upload textfile oldwpd : " . $gtfname . " for old wpd by sys is success";
					$msgresult = Yii::app()->Clogevent->createlogevent($action, "textfileoldwpd", "uploadtextfile", $gtfname, $levremark);
					//----------------------------------------------------------------------------------
					$msg = "upload textfile is Success";
				} else {
					$msg = "upload textfile is Failed";
				}
				//---------------------------------------------------------------------------------------
			} else {
				$msg = "upload textfile is Failed";
			} //if

		} else { //if
			$msg = "upload textfile is Failed";
		} //if

		echo $msg;
	} //function

	public function actionCallcanceldatafrmdbd()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$bgdatecd1 = $_POST['bgdatecd1'];
				$st = "m";
				//echo "{$action}, {$bgdatecd1}"; exit;
				$data1 = array('action' => $action, 'bgdatecd1' => $bgdatecd1, 'st' => $st);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/calldbdserviceupdatedata', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function

	public function actionCallcanceldatafrmdbdauto()
	{

		$action = $_POST['action'];
		$bgdatecd1 = $_POST['bgdatecd1'];
		$st = "a";
		//echo "{$action}, {$bgdatecd1}"; exit;
		$data1 = array('action' => $action, 'bgdatecd1' => $bgdatecd1, 'st' => $st);
		$this->layout = 'nolayout';
		$this->render('/site/servicepages/calldbdserviceupdatedata', $data1);
	} //function

	public function actionGenmonthlytxtfile()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				//echo "{$action}"; exit;
				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/genmonthlytxtfile', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionAddtextfilemonthlyforsapiens()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$tfnt = $_POST['tfnt'];

				$textfilename = $tfnt;

				$mypath = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/monthly/" . $textfilename;

				//== create textfile ======
				$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/monthly/" . $textfilename, "w") or die("Unable to open file!");
				fclose($myfile);
				//== insert to table ======
				$qlc = new CDbCriteria(array(
					'condition' => "tffs_name = :tffs_name ", // ORDER BY tffs_id DESC LIMIT 0,1
					'params'    => array(':tffs_name' => $tfnt)  //  $statusgt
				));
				$rlc = MonthlytxtfileforsapiensTb::model()->findAll($qlc);
				if (!$rlc) {
					$insert_ndt = new MonthlytxtfileforsapiensTb();
					$insert_ndt->tffs_name = $textfilename;
					$insert_ndt->tffs_numrec = 0;
					$insert_ndt->tffs_createby = Yii::app()->user->username;
					$insert_ndt->tffs_created = date('Y-m-d H:i:s');
					$insert_ndt->tffs_updateby = Yii::app()->user->username;
					$insert_ndt->tffs_modified = date('Y-m-d H:i:s');
					$insert_ndt->tffs_remark = $mypath;
					$insert_ndt->tffs_status = 1;
					if ($insert_ndt->save()) {
						$msg = "insert is success.";
						//echo preg_replace("/\xEF\xBB\xBF/", "","Y");
						//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => 'success')));
						//== insert log event ======================
						$levremark = "create textfile monthly : " . $tfnt . " for old wpd by " . Yii::app()->user->username . " is success.";
						$msgresult = Yii::app()->Clogevent->createlogevent($action, "service8", "oldwpdmonthly", $tfnt, $levremark);
						//==========================================
					} else { //if
						$msg = $insert_sp->getErrors();
						//echo preg_replace("/\xEF\xBB\xBF/", "","N");
						//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => $msg)));
					} //if
				} else {
					$msg = "the " . $tfnt . " created in system alredy.";
					//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => $msg)));
				}

				echo $msg;
				//=========================

				//===========================================

				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionAddtextfilemonthlyforsapiensauto()
	{

		$action = $_POST['action'];
		$tfnt = $_POST['tfnt'];

		$textfilename = $tfnt;

		$mypath = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/monthly/" . $textfilename;

		//== create textfile ======
		$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/monthly/" . $textfilename, "w") or die("Unable to open file!");
		fclose($myfile);
		//== insert to table ======
		$qlc = new CDbCriteria(array(
			'condition' => "tffs_name = :tffs_name ", // ORDER BY tffs_id DESC LIMIT 0,1
			'params'    => array(':tffs_name' => $tfnt)  //  $statusgt
		));
		$rlc = MonthlytxtfileforsapiensTb::model()->findAll($qlc);
		if (!$rlc) {
			$insert_ndt = new MonthlytxtfileforsapiensTb();
			$insert_ndt->tffs_name = $textfilename;
			$insert_ndt->tffs_numrec = 0;
			$insert_ndt->tffs_createby = "sys";
			$insert_ndt->tffs_created = date('Y-m-d H:i:s');
			$insert_ndt->tffs_updateby = "sys";
			$insert_ndt->tffs_modified = date('Y-m-d H:i:s');
			$insert_ndt->tffs_remark = $mypath;
			$insert_ndt->tffs_status = 1;
			if ($insert_ndt->save()) {
				$msg = "insert is success.";
				//echo preg_replace("/\xEF\xBB\xBF/", "","Y");
				//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => 'success')));
				//== insert log event ======================
				$levremark = "create textfile monthly : " . $tfnt . " for old wpd by sys is success.";
				$msgresult = Yii::app()->Clogevent->createlogevent($action, "service8", "oldwpdmonthly", $tfnt, $levremark);
				//==========================================
			} else { //if
				$msg = $insert_sp->getErrors();
				//echo preg_replace("/\xEF\xBB\xBF/", "","N");
				//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => $msg)));
			} //if
		} else {
			$msg = "the " . $tfnt . " created in system alredy.";
			//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => $msg)));
		}
		ob_clean();
		echo $msg;
		//=========================


	} //function

	public function actionWritedatatotextfilemonthly()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$tffs_id = $_POST['tffs_id'];
				$tffs_name = $_POST['tffs_name'];

				$data1 = array('action' => $action, 'tffs_id' => $tffs_id, 'tffs_name' => $tffs_name);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/writedatatotextfilemonthly', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallwpddataforsapiensmonthly()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$bgdatewt2 = $_POST['bgdatewt2'];
				$tffs_id = $_POST['tffs_id'];
				$tffs_name = $_POST['tffs_name'];
				$actionby = 'm';

				//echo "{$action}, {$bgdatewt2}, {$tffs_id}, {$tffs_name}, {$actionby}"; exit;

				$data1 = array('action' => $action, 'bgdatewt2' => $bgdatewt2, 'tffs_id' => $tffs_id, 'tffs_name' => $tffs_name, 'actionby' => $actionby);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/callwpddataforsapiensmonthly', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if		
	} //function

	public function actionCallwpddataforsapiensmonthlyauto()
	{

		$action = $_POST['action'];
		$bgdatewt2 = $_POST['bgdatewt2'];
		$actionby = 'a';

		//search tffs_id and tffs_name---------------------------------------------------------------------------
		//$tffs_id = $_POST['tffs_id'];
		//$tffs_name = $_POST['tffs_name'];
		$qry = new CDbCriteria(array(
			'condition' => "tffs_status < :tffs_status ",
			'params'    => array(':tffs_status' => 3),
			'order'		=> "tffs_id DESC",
			'limit'		=> 1
		));
		$modelarray = MonthlytxtfileforsapiensTb::model()->findAll($qry);

		//echo "{$action}, {$bgdatewt2}, {$tffs_id}, {$tffs_name}, {$actionby}"; exit;

		if ($modelarray) {
			$countmedel = count($modelarray);
			foreach ($modelarray as $rows) {
				$tffs_id = $rows->tffs_id;
				$tffs_name = $rows->tffs_name;
			} //for

			$data1 = array('action' => $action, 'bgdatewt2' => $bgdatewt2, 'tffs_id' => $tffs_id, 'tffs_name' => $tffs_name, 'actionby' => $actionby);
			$this->layout = 'nolayout';
			$this->render('/site/servicepages/callwpddataforsapiensmonthly', $data1);
		} else { //if
			//== insert log event ======================
			$tffs_name = "-";
			$levremark = "write data to textfile monthly : " . $tffs_name . " for old wpd by sys is error";
			$msgresult = Yii::app()->Clogevent->createlogevent($action, "writetextfileoldwpdmonthly", "error", $tffs_name, $levremark);
			//==========================================
			echo $levremark;
		}
	} //function

	public function actionCalluploadmonthlyfileoldwpdtosftp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (isset(Yii::app()->user->username)) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}

				$localpath_local = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/monthly/"; //"/opt/share/html/wpdtextfile/";
				$remotepath_local = "/out/ssossv2/"; //"/in/"; "/out/ssossv1"; "/out/ssossv2"; /out/uat/

				$action = $_POST['action'];
				$gtfname = $_POST['tffs_name'];

				//echo "{$action},{$gtfname}"; exit;

				$localFile = $localpath_local . $gtfname; //path local
				$remoteFile = $remotepath_local . $gtfname; //path sftp

				if (Yii::app()->Cgentextfile->getConnectionsftpssv()) { //getConnectionsftpssv
					$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
					$contents = file_get_contents($localFile);
					$putfile = file_put_contents("ssh2.sftp://" . intval($sftp) . "$remoteFile", $contents);
					//update table-------------------------------------------------------------------------
					$anb = MonthlytxtfileforsapiensTb::model()->findByAttributes(array('tffs_name' => $gtfname));
					$anb->tffs_updateby = Yii::app()->user->username;
					$anb->tffs_modified = date('Y-m-d H:i:s');
					$anb->tffs_status = 3;
					if ($anb->save()) {
						//insert_log------------------------------------------------------------------------
						$levremark = "upload textfile oldwpd monthly : " . $gtfname . " for old wpd by " . Yii::app()->user->username . " is success";
						$msgresult = Yii::app()->Clogevent->createlogevent($action, "textfileoldwpdmonthly", "uploadtextfilemonthly", $gtfname, $levremark);
						//----------------------------------------------------------------------------------
						//echo "Success";
						$msg = "Upload file is Success.";
					} else {
						//echo "Failed";
						$msg = "Can't upload file.";
					}
					//---------------------------------------------------------------------------------------
				} else {
					//echo preg_replace("/\xEF\xBB\xBF/", "","Failed");
					$msg = "Can't Connect to SFTP Server";
				} //if
				echo $msg;
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


	public function actionCalluploadmonthlyfileoldwpdtosftpauto()
	{

		$username = "sys";

		$localpath_local = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/wpdold/monthly/"; //"/opt/share/html/wpdtextfile/";
		$remotepath_local = "/out/ssossv2/"; //"/in/"; "/out/ssossv1"; "/out/ssossv2"; /out/uat/

		$action = $_POST['action'];
		$gtfname = $_POST['tffs_name'];

		//echo "{$action},{$gtfname}"; exit;

		$localFile = $localpath_local . $gtfname; //path local
		$remoteFile = $remotepath_local . $gtfname; //path sftp

		if (Yii::app()->Cgentextfile->getConnectionsftpssv()) { //getConnectionsftpssv
			$sftp = ssh2_sftp(Yii::app()->Cgentextfile->conn);
			$contents = file_get_contents($localFile);
			$putfile = file_put_contents("ssh2.sftp://" . intval($sftp) . "$remoteFile", $contents);
			//update table-------------------------------------------------------------------------
			$anb = MonthlytxtfileforsapiensTb::model()->findByAttributes(array('tffs_name' => $gtfname));
			$anb->tffs_updateby = $username;
			$anb->tffs_modified = date('Y-m-d H:i:s');
			$anb->tffs_status = 3;
			if ($anb->save()) {
				//insert_log------------------------------------------------------------------------
				$levremark = "upload textfile oldwpd monthly : " . $gtfname . " for old wpd by " . $username . " is success";
				$msgresult = Yii::app()->Clogevent->createlogevent($action, "textfileoldwpdmonthly", "uploadtextfilemonthly", $gtfname, $levremark);
				//----------------------------------------------------------------------------------
				//echo "Success";
				$msg = "Upload file is success.";
			} else {
				//echo "Failed";
				$msg = "Can't upload file.";
			}
			//---------------------------------------------------------------------------------------
		} else {
			//echo preg_replace("/\xEF\xBB\xBF/", "","Failed");
			$msg = "Can't connect SFTP Server.";
		} //if

	} //function


	public  function actionDeletefilemonthlyoldwpd()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$tffs_id = $_POST['tffs_id'];
				$tffs_name = $_POST['tffs_name'];
				//==update status table textfile=========================
				$utfw = MonthlytxtfileforsapiensTb::model()->findByAttributes(array('tffs_id' => $tffs_id));
				$utfw->tffs_updateby = Yii::app()->user->username;
				$utfw->tffs_modified = date('Y-m-d H:i:s');
				$utfw->tffs_status = 0;
				if ($utfw->save()) {
					$msg = "update data is success.";
					//echo preg_replace("/\xEF\xBB\xBF/", "","Y");
					//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => 'success')));
					//== insert log event ======================
					$levremark = "delete textfile monthly : " . $tffs_name . " for old wpd";
					$msgresult = Yii::app()->Clogevent->createlogevent($action, "gettextfileforsapiens2monthly", "oldwpdmonthly", $tffs_name, $levremark);
					//==========================================
				} else {
					$msg = "can't update data.";
					//echo preg_replace("/\xEF\xBB\xBF/", "","N");
					//echo preg_replace("/\xEF\xBB\xBF/", "",CJSON::encode(array('status' => $msg)));
				} //if
				ob_clean();
				echo $msg;
				//=======================================================
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallotpdata()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];

				//echo "{$action},{$bgdatep},{$eddatep},{$newdap},{$updap}";
				$data1 = array('action' => $action, 'bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/callotpdata', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


	public function actionCallegaservice()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$txt1 = $_POST['txt1'];
				$txt2 = $_POST['txt2'];

				//echo "{$action} , {$txt1}, {$txt2}";
				$data1 = array('action' => $action, 'txt1' => $txt1, 'txt2' => $txt2);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/callegaservice', $data1);

				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallegaservice2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$txt1 = $_POST['txt1'];
				$txt2 = $_POST['txt2'];

				//echo "{$action} , {$txt1}, {$txt2}";
				$data1 = array('action' => $action, 'txt1' => $txt1, 'txt2' => $txt2);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/callegaservice2', $data1);

				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallshowrptetp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}
				//echo $bctid;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->render('/site/reportpages/reportetp', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallsubrptetp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$d1 = $_POST['d1'];
				$d2 = $_POST['d2'];
				$sso1 = $_POST['sso1'];
				$bct = $_POST['bct'];
				$bc = $_POST['bc'];
				$ssos2 = $_POST['ssos2'];

				//formatdate
				$d1d = date_create($d1)->format('d');
				$d1m = date_create($d1)->format('m');
				$d1y = date_create($d1)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d1f1 = $d1y . "-" . $d1m . "-" . $d1d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d1 = date_create($d1f1)->format('Y-m-d');

				//formatdate
				$d2d = date_create($d2)->format('d');
				$d2m = date_create($d2)->format('m');
				$d2y = date_create($d2)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d2f2 = $d2y . "-" . $d2m . "-" . $d2d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d2 = date_create($d2f2)->format('Y-m-d');

				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($sso1 == '0') {
					$sso1t = "ทั่วประเทศ";
				} else if ($sso1 == '1050') {
					$sso1t = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $sso1));
					$bcn = $bcr->name;
					$sso1t = $bcn;
				}

				//echo "$action,$d1,$d2,$sso1,$bct,$bc,$sso1t,$ssos2";



				$data1 = array('action' => $action, 'd1' => $d1, 'd2' => $d2, 'sso1' => $sso1, 'bct' => $bct, 'bc' => $bc, 'sso1t' => $sso1t, 'ssos2' => $ssos2);
				//var_dump($data1);
				//exit();

				$this->layout = 'nolayout';
				$this->pageTitle = 'report - ' . $sso1t;
				$this->render('/site/reportpages/reportsetp1sub', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


	public function actionChkandgenaccno()
	{

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$regisnum = $_POST['regisnum'];
				$accnum = $_POST['accnum'];
				$accnum2 = substr($accnum, 0, -8);

				$pvcode = "";
				$modelb = BranchTmpTb::model()->findByAttributes(array('registernumber' => $regisnum));
				if ($modelb) {
					$pvcode = $modelb->provincecode;
				} else {
					$pvcode = "-";
				}

				//echo "{$action},{$regisnum},{$accnum},{$accnum2},{$pvcode}";
				//ตรวจสอบค่า เลข 2 หลักข้างหน้า กับ รหัสจังหวัด ว่าตรงกันหรือไม่============================
				if ($accnum2 == $pvcode) {
					//ถ้ารหัสจังหวัดตรงกัน
					echo "เลขนายจ้าง 10 หลัก {$accnum} ตรงกันกับ รหัสจังหวัด {$pvcode} อยู่แล้ว! ";
				} else {
					//ถ้ารหัสจังหวัดไม่ตรงกัน
					//--------ค้นหาว่า มี running number ของ จังหวัดเป็นเท่าไหร่ เริ่ม gen accno ---------------------
					$q2 = new CDbCriteria(array(
						'condition' => "prvi_code = :prvi_code ",
						'params'    => array(':prvi_code' => $pvcode)
					));
					$r2 = ProviceTb::model()->findAll($q2);
					$c2 = count($r2);
					foreach ($r2 as $rows) {
						$prvi_id = $rows->prvi_id;
						$lastnum = $rows->prvi_remark;
					}
					$rowcountpv = $lastnum + 1;

					$dg12 = $pvcode;
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
					if ($mod11 == 0) {
						$div11 = 1;
					} else if ($mod11 == 1) {
						$div11 = 0;
					} else {
						$div11 = 11 - $mod11;
					}
					//****** end gen check digit ****************************  
					$accnogen = $dg12 . $dg3 . $dg49 . $div11; //accno is gen
					//echo "{$accnogen}";

					//****** update provicetb ********************************
					$update1 = ProviceTb::model()->findByPk($prvi_id);
					$update1->prvi_remark = $rowcountpv;
					if ($update1->save()) {
						$msgerr = "update data is success.";
					} else {
						$msgerr = $update1->getErrors();
						//echo "{$msgerr}<br>";
					}
					//***** ค้นหา crop_id **************************************
					$q = new CDbCriteria(array(
						'condition' => "registernumber = :registernumber",
						'params'    => array(':registernumber' => $regisnum)
					));
					$r = CropinfoTmpTb::model()->findAll($q);
					$c = count($r);
					foreach ($r as $rows) {
						$crop_id = $rows->crop_id;
					}

					//******* update cropinfo **********************************
					$update2 = CropinfoTmpTb::model()->findByPk($crop_id);
					$update2->acc_no = $accnogen;
					//$update2->crop_remark = "P";
					$update2->crop_updateby = Yii::app()->user->username;
					$update2->crop_updatetime = date('Y-m-d H:i:s');
					//$update2->crop_status = 2;
					if ($update2->save()) {
						$msgerr = "y";
						//******* update accno **********************************
						$uaccno = AccnumberTb::model()->findByAttributes(array('acc_regis_no' => $regisnum));
						$uaccno->acc_no = $accnogen;
						$uaccno->acc_updateby = Yii::app()->user->username;
						$uaccno->acc_modified = date('Y-m-d H:i:s');
						if ($uaccno->save()) {
							$msgerr = "y";
							//****** update crop_v_bran ******************************
							$ucropvb = CropVBran::model()->findByAttributes(array('registernumber' => $regisnum));
							$ucropvb->acc_no = $accnogen;
							$ucropvb->crop_updatetime = date('Y-m-d H:i:s');
							if ($ucropvb->save()) {
								$msgerr = "y";
							} else { //if
								$msgerr = $update1->getErrors();
							}
						} else { //if
							$msgerr = $update1->getErrors();
						}
					} else { //if
						$msgerr = $update1->getErrors();
					}

					if ($msgerr == 'y') {
						echo "gen เลขนายจ้าง 10 หลัก ใหม่ตรงกับจังหวัด เรียบร้อยแล้ว!";
					} else {
						echo "ไม่สามารถ gen เลขนายจ้าง 10 หลักได้ เกิดข้อผิดผลาดบางอย่าง!";
					}
				} //if
				//======================================================================

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if

	} //function

	public function downloadpdfdga()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				//$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				//$this->layout='nolayout';
				//$this->pageTitle='WPD - Report ';
				//$this->render('/site/searchpages/dgafinancial1'); //, $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function 

	public function actionCallshowrptetp2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}

				$txt1 = $_GET['txt1'];
				$txt2 = $_GET['txt2'];
				$pdfdata = $_GET['pdfdata'];

				//ค้นหาชื่อนิติบุคคล จากเลข 13 หลัก txt1
				if ($txt1) {
					$corpname_mo1 = CropinfoTmpTb::model()->findByAttributes(array('registernumber' => $txt1));
					$corpname1 = $corpname_mo1->registername;
				}

				//echo $bctid ."," . $txt1 . "," . $txt2 ;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid, 'txt1' => $txt1, 'txt2' => $txt2, 'pdfdata' => $pdfdata, 'corpname1' => $corpname1);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->renderPartial('/site/searchpages/dgafinancial1', $data1); //, $data1
				//$this->renderPartial('/site/mypage1/tcpdfpage');
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionSendemail3()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$bgdatep = $_POST['bgdatep'];
				$eddatep = $_POST['eddatep'];
				$newdap = $_POST['newdap'];
				$updap = $_POST['updap'];

				//echo "{$action},{$bgdatep},{$eddatep},{$newdap},{$updap}"; exit;

				$data1 = array('action' => $action, 'bgdatep' => $bgdatep, 'eddatep' => $eddatep, 'newdap' => $newdap, 'updap' => $updap);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/callotpdata3', $data1);
				//*********************************************************	
			} else {
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			} //if
		} else {
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if

	} //function

	public function actionSendemail3auto()
	{
		$this->layout = 'nolayout';
		$this->render('/site/servicepages/callotpdata3auto');
	} //function

	public function actionCallshowrptetpsum2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}
				//echo $bctid;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->render('/site/reportpages/reportetp2', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallsubrptetpsum2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$d1 = $_POST['d1'];
				$d2 = $_POST['d2'];
				$sso1 = $_POST['sso1'];
				$bct = $_POST['bct'];
				$bc = $_POST['bc'];
				//$ssos2 = $_POST['ssos2'];

				//formatdate
				$d1d = date_create($d1)->format('d');
				$d1m = date_create($d1)->format('m');
				$d1y = date_create($d1)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d1f1 = $d1y . "-" . $d1m . "-" . $d1d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d1 = date_create($d1f1)->format('Y-m-d');

				//formatdate
				$d2d = date_create($d2)->format('d');
				$d2m = date_create($d2)->format('m');
				$d2y = date_create($d2)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d2f2 = $d2y . "-" . $d2m . "-" . $d2d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d2 = date_create($d2f2)->format('Y-m-d');

				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($sso1 == '0') {
					$sso1t = "ทั่วประเทศ";
				} else if ($sso1 == '1050') {
					$sso1t = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $sso1));
					$bcn = $bcr->name;
					$sso1t = $bcn;
				}

				//echo "$action,$d1,$d2,$sso1,$bct,$bc,$sso1t,$ssos2";exit();


				$data1 = array('action' => $action, 'd1' => $d1, 'd2' => $d2, 'sso1' => $sso1, 'bct' => $bct, 'bc' => $bc, 'sso1t' => $sso1t);
				//var_dump($data1);
				//exit();

				$this->layout = 'nolayout';
				$this->pageTitle = 'report - ' . $sso1t;
				$this->render('/site/reportpages/reportsetp1subsum2', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

	public function actionCallpnd101()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;

				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/callpnd101');
			}
		}
	} //function

	public function actionCallpnd102()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;

				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/callpnd102');
			}
		}
	} //function


	public function actionCallpnd103()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;

				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/callpnd103');
			}
		}
	} //function


	public function actionCallpnd50()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;

				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$this->render('/site/servicepages/callpnd50');
			}
		}
	} //function
}//class
