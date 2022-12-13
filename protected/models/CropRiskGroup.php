<?php

/**
 * This is the model class for table "crop_risk_group".
 *
 * The followings are the available columns in table 'crop_risk_group':
 * @property integer $crg_id
 * @property string $sso_accno
 * @property string $sso_accbran
 * @property string $crg_registernum
 * @property string $crg_cropname
 * @property string $crg_cropaddrss
 * @property string $crg_brancode
 * @property string $crg_createby
 * @property string $crg_created
 * @property string $crg_updateby
 * @property string $crg_modified
 * @property string $crg_remark
 * @property integer $crg_status
 */
class CropRiskGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CropRiskGroup the static model class
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
		return 'crop_risk_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('crg_createby, crg_created, crg_updateby, crg_modified', 'required'),
			array('crg_status', 'numerical', 'integerOnly'=>true),
			array('sso_accno, crg_brancode', 'length', 'max'=>10),
			array('sso_accbran', 'length', 'max'=>6),
			array('crg_registernum', 'length', 'max'=>13),
			array('crg_cropname', 'length', 'max'=>255),
			array('crg_createby, crg_updateby', 'length', 'max'=>100),
			array('crg_cropaddrss, crg_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('crg_id, sso_accno, sso_accbran, crg_registernum, crg_cropname, crg_cropaddrss, crg_brancode, crg_createby, crg_created, crg_updateby, crg_modified, crg_remark, crg_status', 'safe', 'on'=>'search'),
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
			'crg_id' => 'Crg',
			'sso_accno' => 'Sso Accno',
			'sso_accbran' => 'Sso Accbran',
			'crg_registernum' => 'Crg Registernum',
			'crg_cropname' => 'Crg Cropname',
			'crg_cropaddrss' => 'Crg Cropaddrss',
			'crg_brancode' => 'Crg Brancode',
			'crg_createby' => 'Crg Createby',
			'crg_created' => 'Crg Created',
			'crg_updateby' => 'Crg Updateby',
			'crg_modified' => 'Crg Modified',
			'crg_remark' => 'Crg Remark',
			'crg_status' => 'Crg Status',
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

		$criteria->compare('crg_id',$this->crg_id);
		$criteria->compare('sso_accno',$this->sso_accno,true);
		$criteria->compare('sso_accbran',$this->sso_accbran,true);
		$criteria->compare('crg_registernum',$this->crg_registernum,true);
		$criteria->compare('crg_cropname',$this->crg_cropname,true);
		$criteria->compare('crg_cropaddrss',$this->crg_cropaddrss,true);
		$criteria->compare('crg_brancode',$this->crg_brancode,true);
		$criteria->compare('crg_createby',$this->crg_createby,true);
		$criteria->compare('crg_created',$this->crg_created,true);
		$criteria->compare('crg_updateby',$this->crg_updateby,true);
		$criteria->compare('crg_modified',$this->crg_modified,true);
		$criteria->compare('crg_remark',$this->crg_remark,true);
		$criteria->compare('crg_status',$this->crg_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}