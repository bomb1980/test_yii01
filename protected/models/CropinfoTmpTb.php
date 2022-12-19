<?php

/**
 * This is the model class for table "cropinfo_tmp_tb".
 *
 * The followings are the available columns in table 'cropinfo_tmp_tb':
 * @property integer $crop_id
 * @property string $registernumber
 * @property string $registername
 * @property string $acc_no
 * @property string $acc_bran
 * @property string $tsic
 * @property string $tsicname
 * @property string $corptype
 * @property string $corptypename
 * @property string $registerdate
 * @property string $updateddate
 * @property string $updateentry
 * @property string $accountingdate
 * @property double $authorizedcapital
 * @property string $statuscode
 * @property string $cpower
 * @property string $crop_remark
 * @property string $crop_createby
 * @property string $crop_createtime
 * @property string $crop_updateby
 * @property string $crop_updatetime
 * @property integer $crop_status
 */
class CropinfoTmpTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CropinfoTmpTb the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}



	static function callGooApi($bgdatep = NULL, $eddatep = NULL, $newdap = NULL, $cronjob = true, $testJob = true )
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

			if ( $testJob == true ) {

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
						// arr($vo);

						// if (property_exists($vo, "branches")) {
						if (!empty($vo->branches->branch)) {

						// arr('adsdfdsfdsf');



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






	public static function getDatas($bgdatep = NULL)
	{

		$sql = "
			SELECT 
				*, 
				date_format( registerdate, '%m/%d/%Y' ) as t 
			FROM cropinfo_tmp_tb having t = :bgdatep  
		";

		$conn = Yii::app()->db;

		$command = $conn->createCommand($sql);

		$command->bindValue(":bgdatep", $bgdatep);

		return $command->queryAll();  
	}


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cropinfo_tmp_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('registernumber, registername, acc_no, acc_bran, tsic, tsicname, corptype, corptypename, registerdate, updateddate, updateentry, accountingdate, authorizedcapital, statuscode, cpower, crop_createby, crop_createtime, crop_updateby, crop_updatetime', 'required'),
			array('crop_status', 'numerical', 'integerOnly' => true),
			array('authorizedcapital', 'numerical'),
			array('registernumber', 'length', 'max' => 13),
			array('registername, tsicname, corptypename', 'length', 'max' => 1000),
			array('acc_no', 'length', 'max' => 10),
			array('acc_bran', 'length', 'max' => 6),
			array('tsic', 'length', 'max' => 5),
			array('corptype, updateentry, statuscode', 'length', 'max' => 1),
			array('accountingdate', 'length', 'max' => 4),
			array('cpower', 'length', 'max' => 5000),
			array('crop_createby, crop_updateby', 'length', 'max' => 100),
			array('crop_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('crop_id, registernumber, registername, acc_no, acc_bran, tsic, tsicname, corptype, corptypename, registerdate, updateddate, updateentry, accountingdate, authorizedcapital, statuscode, cpower, crop_remark, crop_createby, crop_createtime, crop_updateby, crop_updatetime, crop_status', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'crop_id' => 'Crop',
			'registernumber' => 'Registernumber',
			'registername' => 'Registername',
			'acc_no' => 'Acc No',
			'acc_bran' => 'Acc Bran',
			'tsic' => 'Tsic',
			'tsicname' => 'Tsicname',
			'corptype' => 'Corptype',
			'corptypename' => 'Corptypename',
			'registerdate' => 'Registerdate',
			'updateddate' => 'Updateddate',
			'updateentry' => 'Updateentry',
			'accountingdate' => 'Accountingdate',
			'authorizedcapital' => 'Authorizedcapital',
			'statuscode' => 'Statuscode',
			'cpower' => 'Cpower',
			'crop_remark' => 'Crop Remark',
			'crop_createby' => 'Crop Createby',
			'crop_createtime' => 'Crop Createtime',
			'crop_updateby' => 'Crop Updateby',
			'crop_updatetime' => 'Crop Updatetime',
			'crop_status' => 'Crop Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('crop_id', $this->crop_id);
		$criteria->compare('registernumber', $this->registernumber, true);
		$criteria->compare('registername', $this->registername, true);
		$criteria->compare('acc_no', $this->acc_no, true);
		$criteria->compare('acc_bran', $this->acc_bran, true);
		$criteria->compare('tsic', $this->tsic, true);
		$criteria->compare('tsicname', $this->tsicname, true);
		$criteria->compare('corptype', $this->corptype, true);
		$criteria->compare('corptypename', $this->corptypename, true);
		$criteria->compare('registerdate', $this->registerdate, true);
		$criteria->compare('updateddate', $this->updateddate, true);
		$criteria->compare('updateentry', $this->updateentry, true);
		$criteria->compare('accountingdate', $this->accountingdate, true);
		$criteria->compare('authorizedcapital', $this->authorizedcapital);
		$criteria->compare('statuscode', $this->statuscode, true);
		$criteria->compare('cpower', $this->cpower, true);
		$criteria->compare('crop_remark', $this->crop_remark, true);
		$criteria->compare('crop_createby', $this->crop_createby, true);
		$criteria->compare('crop_createtime', $this->crop_createtime, true);
		$criteria->compare('crop_updateby', $this->crop_updateby, true);
		$criteria->compare('crop_updatetime', $this->crop_updatetime, true);
		$criteria->compare('crop_status', $this->crop_status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
