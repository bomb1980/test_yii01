<?php

/**
 * This is the model class for table "sendemailcorp".
 *
 * The followings are the available columns in table 'sendemailcorp':
 * @property integer $id
 * @property string $crop_name
 * @property string $crop_email
 * @property string $access_code
 * @property integer $status
 * @property string $created
 * @property string $modified
 */
class Sendemailcorp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sendemailcorp the static model class
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
		return 'sendemailcorp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('crop_name, crop_email, access_code, status, created, modified', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('crop_name', 'length', 'max'=>255),
			array('crop_email', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, crop_name, crop_email, access_code, status, created, modified', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'crop_name' => 'Crop Name',
			'crop_email' => 'Crop Email',
			'access_code' => 'Access Code',
			'status' => 'Status',
			'created' => 'Created',
			'modified' => 'Modified',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('crop_name',$this->crop_name,true);
		$criteria->compare('crop_email',$this->crop_email,true);
		$criteria->compare('access_code',$this->access_code,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}