<?php

/**
 * This is the model class for table "provice_tb".
 *
 * The followings are the available columns in table 'provice_tb':
 * @property integer $prvi_id
 * @property string $prvi_code
 * @property string $prvi_name
 * @property string $prvi_remark
 * @property string $prvi_createby
 * @property string $prvi_createtime
 * @property string $prvi_updateby
 * @property string $prvi_updatetime
 * @property integer $prvi_status
 */
class ProviceTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProviceTb the static model class
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
		return 'provice_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prvi_code, prvi_name', 'required'),
			array('prvi_status', 'numerical', 'integerOnly'=>true),
			array('prvi_code', 'length', 'max'=>10),
			array('prvi_name, prvi_createby, prvi_updateby', 'length', 'max'=>100),
			array('prvi_remark, prvi_createtime, prvi_updatetime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('prvi_id, prvi_code, prvi_name, prvi_remark, prvi_createby, prvi_createtime, prvi_updateby, prvi_updatetime, prvi_status', 'safe', 'on'=>'search'),
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
			'prvi_id' => 'Prvi',
			'prvi_code' => 'Prvi Code',
			'prvi_name' => 'Prvi Name',
			'prvi_remark' => 'Prvi Remark',
			'prvi_createby' => 'Prvi Createby',
			'prvi_createtime' => 'Prvi Createtime',
			'prvi_updateby' => 'Prvi Updateby',
			'prvi_updatetime' => 'Prvi Updatetime',
			'prvi_status' => 'Prvi Status',
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

		$criteria->compare('prvi_id',$this->prvi_id);
		$criteria->compare('prvi_code',$this->prvi_code,true);
		$criteria->compare('prvi_name',$this->prvi_name,true);
		$criteria->compare('prvi_remark',$this->prvi_remark,true);
		$criteria->compare('prvi_createby',$this->prvi_createby,true);
		$criteria->compare('prvi_createtime',$this->prvi_createtime,true);
		$criteria->compare('prvi_updateby',$this->prvi_updateby,true);
		$criteria->compare('prvi_updatetime',$this->prvi_updatetime,true);
		$criteria->compare('prvi_status',$this->prvi_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}