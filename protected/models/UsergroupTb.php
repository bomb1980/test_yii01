<?php

/**
 * This is the model class for table "usergroup_tb".
 *
 * The followings are the available columns in table 'usergroup_tb':
 * @property integer $ug_id
 * @property string $ug_name
 * @property string $ug_createby
 * @property string $ug_created
 * @property string $ug_updateby
 * @property string $ug_modified
 * @property string $ug_remark
 * @property integer $ug_status
 */
class UsergroupTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsergroupTb the static model class
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
		return 'usergroup_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ug_name, ug_createby, ug_created, ug_updateby, ug_modified', 'required'),
			array('ug_status', 'numerical', 'integerOnly'=>true),
			array('ug_name', 'length', 'max'=>255),
			array('ug_createby, ug_updateby', 'length', 'max'=>100),
			array('ug_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ug_id, ug_name, ug_createby, ug_created, ug_updateby, ug_modified, ug_remark, ug_status', 'safe', 'on'=>'search'),
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
			'ug_id' => 'Ug',
			'ug_name' => 'Ug Name',
			'ug_createby' => 'Ug Createby',
			'ug_created' => 'Ug Created',
			'ug_updateby' => 'Ug Updateby',
			'ug_modified' => 'Ug Modified',
			'ug_remark' => 'Ug Remark',
			'ug_status' => 'Ug Status',
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

		$criteria->compare('ug_id',$this->ug_id);
		$criteria->compare('ug_name',$this->ug_name,true);
		$criteria->compare('ug_createby',$this->ug_createby,true);
		$criteria->compare('ug_created',$this->ug_created,true);
		$criteria->compare('ug_updateby',$this->ug_updateby,true);
		$criteria->compare('ug_modified',$this->ug_modified,true);
		$criteria->compare('ug_remark',$this->ug_remark,true);
		$criteria->compare('ug_status',$this->ug_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}