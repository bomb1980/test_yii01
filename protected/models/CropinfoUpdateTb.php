<?php

/**
 * This is the model class for table "cropinfo_update_tb".
 *
 * The followings are the available columns in table 'cropinfo_update_tb':
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
class CropinfoUpdateTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CropinfoUpdateTb the static model class
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
		return 'cropinfo_update_tb';
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
			array('crop_status', 'numerical', 'integerOnly'=>true),
			array('authorizedcapital', 'numerical'),
			array('registernumber', 'length', 'max'=>13),
			array('registername, tsicname, corptypename', 'length', 'max'=>1000),
			array('acc_no', 'length', 'max'=>10),
			array('acc_bran', 'length', 'max'=>6),
			array('tsic', 'length', 'max'=>5),
			array('corptype, updateentry, statuscode', 'length', 'max'=>1),
			array('accountingdate', 'length', 'max'=>4),
			array('cpower', 'length', 'max'=>5000),
			array('crop_createby, crop_updateby', 'length', 'max'=>100),
			array('crop_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('crop_id, registernumber, registername, acc_no, acc_bran, tsic, tsicname, corptype, corptypename, registerdate, updateddate, updateentry, accountingdate, authorizedcapital, statuscode, cpower, crop_remark, crop_createby, crop_createtime, crop_updateby, crop_updatetime, crop_status', 'safe', 'on'=>'search'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('crop_id',$this->crop_id);
		$criteria->compare('registernumber',$this->registernumber,true);
		$criteria->compare('registername',$this->registername,true);
		$criteria->compare('acc_no',$this->acc_no,true);
		$criteria->compare('acc_bran',$this->acc_bran,true);
		$criteria->compare('tsic',$this->tsic,true);
		$criteria->compare('tsicname',$this->tsicname,true);
		$criteria->compare('corptype',$this->corptype,true);
		$criteria->compare('corptypename',$this->corptypename,true);
		$criteria->compare('registerdate',$this->registerdate,true);
		$criteria->compare('updateddate',$this->updateddate,true);
		$criteria->compare('updateentry',$this->updateentry,true);
		$criteria->compare('accountingdate',$this->accountingdate,true);
		$criteria->compare('authorizedcapital',$this->authorizedcapital);
		$criteria->compare('statuscode',$this->statuscode,true);
		$criteria->compare('cpower',$this->cpower,true);
		$criteria->compare('crop_remark',$this->crop_remark,true);
		$criteria->compare('crop_createby',$this->crop_createby,true);
		$criteria->compare('crop_createtime',$this->crop_createtime,true);
		$criteria->compare('crop_updateby',$this->crop_updateby,true);
		$criteria->compare('crop_updatetime',$this->crop_updatetime,true);
		$criteria->compare('crop_status',$this->crop_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}