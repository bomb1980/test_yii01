<?php

/**
 * This is the model class for table "wpd_spn_lt_ssobran".
 *
 * The followings are the available columns in table 'wpd_spn_lt_ssobran':
 * @property string $SSO_BRAN_CODE
 * @property string $SSO_BRN_NAME
 * @property string $ZONE_AMPUR_CODE
 * @property string $ZONE_AMPUR_NAME
 */
class WpdSpnLtSsobran extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WpdSpnLtSsobran the static model class
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
		return 'wpd_spn_lt_ssobran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SSO_BRAN_CODE, SSO_BRN_NAME, ZONE_AMPUR_CODE, ZONE_AMPUR_NAME', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SSO_BRAN_CODE, SSO_BRN_NAME, ZONE_AMPUR_CODE, ZONE_AMPUR_NAME', 'safe', 'on'=>'search'),
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
			'SSO_BRAN_CODE' => 'Sso Bran Code',
			'SSO_BRN_NAME' => 'Sso Brn Name',
			'ZONE_AMPUR_CODE' => 'Zone Ampur Code',
			'ZONE_AMPUR_NAME' => 'Zone Ampur Name',
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

		$criteria->compare('SSO_BRAN_CODE',$this->SSO_BRAN_CODE,true);
		$criteria->compare('SSO_BRN_NAME',$this->SSO_BRN_NAME,true);
		$criteria->compare('ZONE_AMPUR_CODE',$this->ZONE_AMPUR_CODE,true);
		$criteria->compare('ZONE_AMPUR_NAME',$this->ZONE_AMPUR_NAME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}