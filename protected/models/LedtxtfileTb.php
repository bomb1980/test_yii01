<?php

/**
 * This is the model class for table "ledtxtfile_tb".
 *
 * The followings are the available columns in table 'ledtxtfile_tb':
 * @property integer $ltf_id
 * @property string $ltf_name
 * @property integer $ltf_callrec
 * @property integer $ltf_resprec
 * @property string $ltf_createby
 * @property string $ltf_created
 * @property string $ltf_updateby
 * @property string $ltf_modified
 * @property string $ltf_remark
 * @property integer $ltf_status
 */
class LedtxtfileTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedtxtfileTb the static model class
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
		return 'ledtxtfile_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ltf_name, ltf_createby, ltf_created, ltf_updateby, ltf_modified', 'required'),
			array('ltf_callrec, ltf_resprec, ltf_status', 'numerical', 'integerOnly'=>true),
			array('ltf_name', 'length', 'max'=>255),
			array('ltf_createby, ltf_updateby', 'length', 'max'=>100),
			array('ltf_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ltf_id, ltf_name, ltf_callrec, ltf_resprec, ltf_createby, ltf_created, ltf_updateby, ltf_modified, ltf_remark, ltf_status', 'safe', 'on'=>'search'),
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
			'ltf_id' => 'Ltf',
			'ltf_name' => 'Ltf Name',
			'ltf_callrec' => 'Ltf Callrec',
			'ltf_resprec' => 'Ltf Resprec',
			'ltf_createby' => 'Ltf Createby',
			'ltf_created' => 'Ltf Created',
			'ltf_updateby' => 'Ltf Updateby',
			'ltf_modified' => 'Ltf Modified',
			'ltf_remark' => 'Ltf Remark',
			'ltf_status' => 'Ltf Status',
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

		$criteria->compare('ltf_id',$this->ltf_id);
		$criteria->compare('ltf_name',$this->ltf_name,true);
		$criteria->compare('ltf_callrec',$this->ltf_callrec);
		$criteria->compare('ltf_resprec',$this->ltf_resprec);
		$criteria->compare('ltf_createby',$this->ltf_createby,true);
		$criteria->compare('ltf_created',$this->ltf_created,true);
		$criteria->compare('ltf_updateby',$this->ltf_updateby,true);
		$criteria->compare('ltf_modified',$this->ltf_modified,true);
		$criteria->compare('ltf_remark',$this->ltf_remark,true);
		$criteria->compare('ltf_status',$this->ltf_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}