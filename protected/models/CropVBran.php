<?php

/**
 * This is the model class for table "crop_v_bran".
 *
 * The followings are the available columns in table 'crop_v_bran':
 * @property integer $cbid
 * @property integer $brch_id
 * @property integer $crop_id
 * @property string $registernumber
 * @property integer $ordernumber
 * @property string $ampcode
 * @property string $SSO_BRAN_CODE
 * @property string $SSO_BRN_NAME
 * @property string $ZONE_AMPUR_NAME
 * @property string $registerdate
 * @property string $registername
 * @property string $tsic
 * @property string $tsicname
 * @property string $address
 * @property string $email
 * @property integer $numofemp
 * @property double $totalsalary
 * @property string $phonenumber
 * @property string $faxnumber
 * @property string $acc_no
 * @property string $acc_bran
 * @property string $crop_remark
 * @property string $crop_createtime
 * @property string $crop_updatetime
 * @property integer $crop_status
 */
class CropVBran extends CActiveRecord
{
	
	//=== เริ่ม การเปลี่ยน database connection เป็น db3 ====//
	public static $conection2; // Model attribute
	
	public function getDbConnection(){

		if(self::$conection2!==null)
			return self::$conection2;
	
		else{
			self::$conection2 = Yii::app()->db3; // main.php - DB config name ต้องไปกำหนด db2 ในไฟลื main.php ของ config ด้วย
	
			if(self::$conection2 instanceof CDbConnection){
				self::$conection2->setActive(true);
				return self::$conection2;
			}
			else
				throw new CDbException(Yii::t('yii',"Active Record requires a '$conection' CDbConnection application component."));
		}
	}
	//=== จบ การเปลี่ยน database connection เป็น db3 ====//
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CropVBran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crop_v_bran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brch_id, crop_id, ordernumber, numofemp, crop_status', 'numerical', 'integerOnly'=>true),
			array('totalsalary', 'numerical'),
			array('registernumber', 'length', 'max'=>13),
			array('ampcode, SSO_BRAN_CODE, SSO_BRN_NAME, ZONE_AMPUR_NAME, address', 'length', 'max'=>255),
			array('tsic', 'length', 'max'=>5),
			array('acc_no', 'length', 'max'=>10),
			array('acc_bran', 'length', 'max'=>6),
			array('registerdate, registername, tsicname, email, phonenumber, faxnumber, crop_remark, crop_createtime, crop_updatetime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cbid, brch_id, crop_id, registernumber, ordernumber, ampcode, SSO_BRAN_CODE, SSO_BRN_NAME, ZONE_AMPUR_NAME, registerdate, registername, tsic, tsicname, address, email, numofemp, totalsalary, phonenumber, faxnumber, acc_no, acc_bran, crop_remark, crop_createtime, crop_updatetime, crop_status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
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
			'cbid' => 'Cbid',
			'brch_id' => 'Brch',
			'crop_id' => 'Crop',
			'registernumber' => 'Registernumber',
			'ordernumber' => 'Ordernumber',
			'ampcode' => 'Ampcode',
			'SSO_BRAN_CODE' => 'Sso Bran Code',
			'SSO_BRN_NAME' => 'Sso Brn Name',
			'ZONE_AMPUR_NAME' => 'Zone Ampur Name',
			'registerdate' => 'Registerdate',
			'registername' => 'Registername',
			'tsic' => 'Tsic',
			'tsicname' => 'Tsicname',
			'address' => 'Address',
			'email' => 'Email',
			'numofemp' => 'Numofemp',
			'totalsalary' => 'Totalsalary',
			'phonenumber' => 'Phonenumber',
			'faxnumber' => 'Faxnumber',
			'acc_no' => 'Acc No',
			'acc_bran' => 'Acc Bran',
			'crop_remark' => 'Crop Remark',
			'crop_createtime' => 'Crop Createtime',
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

		$criteria=new CDbCriteria;

		$criteria->compare('cbid',$this->cbid);
		$criteria->compare('brch_id',$this->brch_id);
		$criteria->compare('crop_id',$this->crop_id);
		$criteria->compare('registernumber',$this->registernumber,true);
		$criteria->compare('ordernumber',$this->ordernumber);
		$criteria->compare('ampcode',$this->ampcode,true);
		$criteria->compare('SSO_BRAN_CODE',$this->SSO_BRAN_CODE,true);
		$criteria->compare('SSO_BRN_NAME',$this->SSO_BRN_NAME,true);
		$criteria->compare('ZONE_AMPUR_NAME',$this->ZONE_AMPUR_NAME,true);
		$criteria->compare('registerdate',$this->registerdate,true);
		$criteria->compare('registername',$this->registername,true);
		$criteria->compare('tsic',$this->tsic,true);
		$criteria->compare('tsicname',$this->tsicname,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('numofemp',$this->numofemp);
		$criteria->compare('totalsalary',$this->totalsalary);
		$criteria->compare('phonenumber',$this->phonenumber,true);
		$criteria->compare('faxnumber',$this->faxnumber,true);
		$criteria->compare('acc_no',$this->acc_no,true);
		$criteria->compare('acc_bran',$this->acc_bran,true);
		$criteria->compare('crop_remark',$this->crop_remark,true);
		$criteria->compare('crop_createtime',$this->crop_createtime,true);
		$criteria->compare('crop_updatetime',$this->crop_updatetime,true);
		$criteria->compare('crop_status',$this->crop_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}