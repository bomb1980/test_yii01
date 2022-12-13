<?php

/**
 * This is the model class for table "committee_update_tb".
 *
 * The followings are the available columns in table 'committee_update_tb':
 * @property integer $cmit_id
 * @property integer $crop_id
 * @property string $registernumber
 * @property string $tsic
 * @property string $corptype
 * @property string $committeetype
 * @property integer $ordernumber
 * @property string $typeno
 * @property string $identity
 * @property string $birthday
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $englishtitle
 * @property string $englishfirstname12
 * @property string $englishlastname
 * @property string $nation
 * @property string $cmit_remark
 * @property string $cmit_createby
 * @property string $cmit_createtime
 * @property string $cmit_updateby
 * @property string $cmit_updatetime
 * @property integer $cmit_status
 */
class CommitteeUpdateTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CommitteeUpdateTb the static model class
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
		return 'committee_update_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('crop_id, registernumber, tsic, corptype, committeetype, ordernumber, typeno, identity, birthday, title, firstname, lastname, englishtitle, englishfirstname12, englishlastname, nation, cmit_createby, cmit_createtime, cmit_updateby, cmit_updatetime', 'required'),
			array('crop_id, ordernumber, cmit_status', 'numerical', 'integerOnly'=>true),
			array('registernumber, identity', 'length', 'max'=>13),
			array('tsic', 'length', 'max'=>5),
			array('corptype, committeetype, typeno', 'length', 'max'=>1),
			array('title', 'length', 'max'=>50),
			array('firstname, lastname, englishtitle, englishfirstname12, englishlastname', 'length', 'max'=>500),
			array('nation', 'length', 'max'=>2),
			array('cmit_createby, cmit_updateby', 'length', 'max'=>100),
			array('cmit_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cmit_id, crop_id, registernumber, tsic, corptype, committeetype, ordernumber, typeno, identity, birthday, title, firstname, lastname, englishtitle, englishfirstname12, englishlastname, nation, cmit_remark, cmit_createby, cmit_createtime, cmit_updateby, cmit_updatetime, cmit_status', 'safe', 'on'=>'search'),
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
			'cmit_id' => 'Cmit',
			'crop_id' => 'Crop',
			'registernumber' => 'Registernumber',
			'tsic' => 'Tsic',
			'corptype' => 'Corptype',
			'committeetype' => 'Committeetype',
			'ordernumber' => 'Ordernumber',
			'typeno' => 'Typeno',
			'identity' => 'Identity',
			'birthday' => 'Birthday',
			'title' => 'Title',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'englishtitle' => 'Englishtitle',
			'englishfirstname12' => 'Englishfirstname12',
			'englishlastname' => 'Englishlastname',
			'nation' => 'Nation',
			'cmit_remark' => 'Cmit Remark',
			'cmit_createby' => 'Cmit Createby',
			'cmit_createtime' => 'Cmit Createtime',
			'cmit_updateby' => 'Cmit Updateby',
			'cmit_updatetime' => 'Cmit Updatetime',
			'cmit_status' => 'Cmit Status',
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

		$criteria->compare('cmit_id',$this->cmit_id);
		$criteria->compare('crop_id',$this->crop_id);
		$criteria->compare('registernumber',$this->registernumber,true);
		$criteria->compare('tsic',$this->tsic,true);
		$criteria->compare('corptype',$this->corptype,true);
		$criteria->compare('committeetype',$this->committeetype,true);
		$criteria->compare('ordernumber',$this->ordernumber);
		$criteria->compare('typeno',$this->typeno,true);
		$criteria->compare('identity',$this->identity,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('englishtitle',$this->englishtitle,true);
		$criteria->compare('englishfirstname12',$this->englishfirstname12,true);
		$criteria->compare('englishlastname',$this->englishlastname,true);
		$criteria->compare('nation',$this->nation,true);
		$criteria->compare('cmit_remark',$this->cmit_remark,true);
		$criteria->compare('cmit_createby',$this->cmit_createby,true);
		$criteria->compare('cmit_createtime',$this->cmit_createtime,true);
		$criteria->compare('cmit_updateby',$this->cmit_updateby,true);
		$criteria->compare('cmit_updatetime',$this->cmit_updatetime,true);
		$criteria->compare('cmit_status',$this->cmit_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}