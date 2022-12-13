<?php

/**
 * This is the model class for table "ssobran_v_allstate".
 *
 * The followings are the available columns in table 'ssobran_v_allstate':
 * @property string $ssobranch_code
 * @property string $name
 * @property string $P
 * @property string $B
 * @property string $A
 */
class SsobranVAllstate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SsobranVAllstate the static model class
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
		return 'ssobran_v_allstate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ssobranch_code', 'length', 'max'=>60),
			array('name', 'length', 'max'=>600),
			array('P, B, A', 'length', 'max'=>42),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ssobranch_code, name, P, B, A', 'safe', 'on'=>'search'),
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
			'ssobranch_code' => 'Ssobranch Code',
			'name' => 'Name',
			'P' => 'P',
			'B' => 'B',
			'A' => 'A',
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

		$criteria->compare('ssobranch_code',$this->ssobranch_code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('P',$this->P,true);
		$criteria->compare('B',$this->B,true);
		$criteria->compare('A',$this->A,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}