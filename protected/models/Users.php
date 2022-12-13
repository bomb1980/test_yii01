<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $contact_number
 * @property string $address
 * @property string $username
 * @property string $password
 * @property string $access_level
 * @property string $access_code
 * @property integer $status
 * @property string $image
 * @property string $created
 * @property string $modified
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, email, contact_number, address, username, password, access_level, access_code, status, image, created, modified', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('firstname, lastname', 'length', 'max'=>32),
			array('email, contact_number', 'length', 'max'=>64),
			array('username', 'length', 'max'=>100),
			array('password, image', 'length', 'max'=>512),
			array('access_level', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstname, lastname, email, contact_number, address, username, password, access_level, access_code, status, image, created, modified', 'safe', 'on'=>'search'),
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
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'contact_number' => 'Contact Number',
			'address' => 'Address',
			'username' => 'Username',
			'password' => 'Password',
			'access_level' => 'Access Level',
			'access_code' => 'Access Code',
			'status' => 'Status',
			'image' => 'Image',
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
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('access_level',$this->access_level,true);
		$criteria->compare('access_code',$this->access_code,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}