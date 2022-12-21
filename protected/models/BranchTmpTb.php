<?php

/**
 * This is the model class for table "branch_tmp_tb".
 *
 * The followings are the available columns in table 'branch_tmp_tb':
 * @property integer $brch_id
 * @property integer $crop_id
 * @property string $registernumber
 * @property string $tsic
 * @property string $corptype
 * @property integer $ordernumber
 * @property string $name
 * @property string $houseid
 * @property string $housenumber
 * @property string $buildingname
 * @property string $buildingnumber
 * @property string $buildingfloor
 * @property string $village
 * @property string $moo
 * @property string $soi
 * @property string $road
 * @property string $tumbon
 * @property string $tumboncode
 * @property string $ampur
 * @property string $ampurcode
 * @property string $province
 * @property string $provincecode
 * @property string $zipcode
 * @property string $phonenumber
 * @property string $faxnumber
 * @property string $email
 * @property string $brch_remark
 * @property string $brch_createby
 * @property string $brch_createtime
 * @property string $brch_updateby
 * @property string $brch_updatetime
 * @property integer $brch_status
 */
class BranchTmpTb extends CActiveRecord
{
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	 
	public function tableName()
	{
		return 'branch_tmp_tb';
	}

	public static function getDatas( $bgdatep = NULL )
	{

		$sql = "
			SELECT 
				b.*,
				c.registername, 
				c.registernumber, 
				c.acc_no, 
				c.acc_bran, 
				c.registerdate, 
				c.crop_remark, 
				c.crop_status,
				date_format( c.registerdate, '%m/%d/%Y' ) as t 
			FROM branch_tmp_tb b
			JOIN cropinfo_tmp_tb c ON b.crop_id = c.crop_id
			having t = :bgdatep  
		";
			
		$conn = Yii::app()->db;

		$command = $conn->createCommand($sql);

		$command->bindValue( ":bgdatep", $bgdatep );

		return $command->queryAll();  
	}

	 
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('crop_id, registernumber, tsic, corptype, ordernumber, name, houseid, housenumber, buildingname, buildingnumber, buildingfloor, village, moo, soi, road, tumbon, tumboncode, ampur, ampurcode, province, provincecode, zipcode, phonenumber, faxnumber, email, brch_createby, brch_createtime, brch_updateby, brch_updatetime', 'required'),
			array('crop_id, ordernumber, brch_status', 'numerical', 'integerOnly'=>true),
			array('registernumber', 'length', 'max'=>13),
			array('tsic', 'length', 'max'=>5),
			array('corptype', 'length', 'max'=>1),
			array('name, houseid, housenumber, buildingname, buildingnumber, buildingfloor, village, moo, soi, road, tumbon, ampur, province, zipcode, phonenumber, faxnumber, email', 'length', 'max'=>500),
			array('tumboncode, ampurcode, provincecode', 'length', 'max'=>10),
			array('brch_createby, brch_updateby', 'length', 'max'=>100),
			array('brch_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('brch_id, crop_id, registernumber, tsic, corptype, ordernumber, name, houseid, housenumber, buildingname, buildingnumber, buildingfloor, village, moo, soi, road, tumbon, tumboncode, ampur, ampurcode, province, provincecode, zipcode, phonenumber, faxnumber, email, brch_remark, brch_createby, brch_createtime, brch_updateby, brch_updatetime, brch_status', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'brch_id' => 'Brch',
			'crop_id' => 'Crop',
			'registernumber' => 'Registernumber',
			'tsic' => 'Tsic',
			'corptype' => 'Corptype',
			'ordernumber' => 'Ordernumber',
			'name' => 'Name',
			'houseid' => 'Houseid',
			'housenumber' => 'Housenumber',
			'buildingname' => 'Buildingname',
			'buildingnumber' => 'Buildingnumber',
			'buildingfloor' => 'Buildingfloor',
			'village' => 'Village',
			'moo' => 'Moo',
			'soi' => 'Soi',
			'road' => 'Road',
			'tumbon' => 'Tumbon',
			'tumboncode' => 'Tumboncode',
			'ampur' => 'Ampur',
			'ampurcode' => 'Ampurcode',
			'province' => 'Province',
			'provincecode' => 'Provincecode',
			'zipcode' => 'Zipcode',
			'phonenumber' => 'Phonenumber',
			'faxnumber' => 'Faxnumber',
			'email' => 'Email',
			'brch_remark' => 'Brch Remark',
			'brch_createby' => 'Brch Createby',
			'brch_createtime' => 'Brch Createtime',
			'brch_updateby' => 'Brch Updateby',
			'brch_updatetime' => 'Brch Updatetime',
			'brch_status' => 'Brch Status',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('brch_id',$this->brch_id);
		$criteria->compare('crop_id',$this->crop_id);
		$criteria->compare('registernumber',$this->registernumber,true);
		$criteria->compare('tsic',$this->tsic,true);
		$criteria->compare('corptype',$this->corptype,true);
		$criteria->compare('ordernumber',$this->ordernumber);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('houseid',$this->houseid,true);
		$criteria->compare('housenumber',$this->housenumber,true);
		$criteria->compare('buildingname',$this->buildingname,true);
		$criteria->compare('buildingnumber',$this->buildingnumber,true);
		$criteria->compare('buildingfloor',$this->buildingfloor,true);
		$criteria->compare('village',$this->village,true);
		$criteria->compare('moo',$this->moo,true);
		$criteria->compare('soi',$this->soi,true);
		$criteria->compare('road',$this->road,true);
		$criteria->compare('tumbon',$this->tumbon,true);
		$criteria->compare('tumboncode',$this->tumboncode,true);
		$criteria->compare('ampur',$this->ampur,true);
		$criteria->compare('ampurcode',$this->ampurcode,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('provincecode',$this->provincecode,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('phonenumber',$this->phonenumber,true);
		$criteria->compare('faxnumber',$this->faxnumber,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('brch_remark',$this->brch_remark,true);
		$criteria->compare('brch_createby',$this->brch_createby,true);
		$criteria->compare('brch_createtime',$this->brch_createtime,true);
		$criteria->compare('brch_updateby',$this->brch_updateby,true);
		$criteria->compare('brch_updatetime',$this->brch_updatetime,true);
		$criteria->compare('brch_status',$this->brch_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}