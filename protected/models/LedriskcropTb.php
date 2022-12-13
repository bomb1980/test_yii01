<?php

/**
 * This is the model class for table "ledriskcrop_tb".
 *
 * The followings are the available columns in table 'ledriskcrop_tb':
 * @property integer $lrc_id
 * @property string $lrc_accno
 * @property string $lrc_bran
 * @property string $lrc_registernumber
 * @property string $lrc_registername
 * @property string $lrc_ssocode1
 * @property string $lrc_ssocode2
 * @property string $lrc_address
 * @property string $lrc_amphur
 * @property string $lrc_province
 * @property string $lrc_zipcode
 * @property string $lrc_createby
 * @property string $lrc_created
 * @property string $lrc_updateby
 * @property string $lrc_modified
 * @property string $lrc_remark
 * @property integer $lrc_status
 */
class LedriskcropTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedriskcropTb the static model class
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
		return 'ledriskcrop_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lrc_accno, lrc_bran, lrc_registernumber, lrc_registername, lrc_ssocode1, lrc_ssocode2, lrc_address, lrc_amphur, lrc_province, lrc_zipcode, lrc_createby, lrc_created, lrc_updateby, lrc_modified', 'required'),
			array('lrc_status', 'numerical', 'integerOnly'=>true),
			array('lrc_accno, lrc_zipcode', 'length', 'max'=>10),
			array('lrc_bran', 'length', 'max'=>6),
			array('lrc_registernumber', 'length', 'max'=>13),
			array('lrc_registername', 'length', 'max'=>1000),
			array('lrc_ssocode1, lrc_ssocode2', 'length', 'max'=>4),
			array('lrc_amphur, lrc_province', 'length', 'max'=>255),
			array('lrc_createby, lrc_updateby', 'length', 'max'=>100),
			array('lrc_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lrc_id, lrc_accno, lrc_bran, lrc_registernumber, lrc_registername, lrc_ssocode1, lrc_ssocode2, lrc_address, lrc_amphur, lrc_province, lrc_zipcode, lrc_createby, lrc_created, lrc_updateby, lrc_modified, lrc_remark, lrc_status', 'safe', 'on'=>'search'),
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
			'lrc_id' => 'Lrc',
			'lrc_accno' => 'Lrc Accno',
			'lrc_bran' => 'Lrc Bran',
			'lrc_registernumber' => 'Lrc Registernumber',
			'lrc_registername' => 'Lrc Registername',
			'lrc_ssocode1' => 'Lrc Ssocode1',
			'lrc_ssocode2' => 'Lrc Ssocode2',
			'lrc_address' => 'Lrc Address',
			'lrc_amphur' => 'Lrc Amphur',
			'lrc_province' => 'Lrc Province',
			'lrc_zipcode' => 'Lrc Zipcode',
			'lrc_createby' => 'Lrc Createby',
			'lrc_created' => 'Lrc Created',
			'lrc_updateby' => 'Lrc Updateby',
			'lrc_modified' => 'Lrc Modified',
			'lrc_remark' => 'Lrc Remark',
			'lrc_status' => 'Lrc Status',
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

		$criteria->compare('lrc_id',$this->lrc_id);
		$criteria->compare('lrc_accno',$this->lrc_accno,true);
		$criteria->compare('lrc_bran',$this->lrc_bran,true);
		$criteria->compare('lrc_registernumber',$this->lrc_registernumber,true);
		$criteria->compare('lrc_registername',$this->lrc_registername,true);
		$criteria->compare('lrc_ssocode1',$this->lrc_ssocode1,true);
		$criteria->compare('lrc_ssocode2',$this->lrc_ssocode2,true);
		$criteria->compare('lrc_address',$this->lrc_address,true);
		$criteria->compare('lrc_amphur',$this->lrc_amphur,true);
		$criteria->compare('lrc_province',$this->lrc_province,true);
		$criteria->compare('lrc_zipcode',$this->lrc_zipcode,true);
		$criteria->compare('lrc_createby',$this->lrc_createby,true);
		$criteria->compare('lrc_created',$this->lrc_created,true);
		$criteria->compare('lrc_updateby',$this->lrc_updateby,true);
		$criteria->compare('lrc_modified',$this->lrc_modified,true);
		$criteria->compare('lrc_remark',$this->lrc_remark,true);
		$criteria->compare('lrc_status',$this->lrc_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}