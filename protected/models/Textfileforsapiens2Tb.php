<?php

/**
 * This is the model class for table "textfileforsapiens2_tb".
 *
 * The followings are the available columns in table 'textfileforsapiens2_tb':
 * @property integer $tffs_id
 * @property string $tffs_name
 * @property integer $tffs_numrec
 * @property string $tffs_createby
 * @property string $tffs_created
 * @property string $tffs_updateby
 * @property string $tffs_modified
 * @property string $tffs_remark
 * @property integer $tffs_status
 */
class Textfileforsapiens2Tb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Textfileforsapiens2Tb the static model class
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
		return 'textfileforsapiens2_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tffs_name, tffs_createby, tffs_created, tffs_updateby, tffs_modified', 'required'),
			array('tffs_numrec, tffs_status', 'numerical', 'integerOnly'=>true),
			array('tffs_name', 'length', 'max'=>255),
			array('tffs_createby, tffs_updateby', 'length', 'max'=>100),
			array('tffs_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tffs_id, tffs_name, tffs_numrec, tffs_createby, tffs_created, tffs_updateby, tffs_modified, tffs_remark, tffs_status', 'safe', 'on'=>'search'),
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
			'tffs_id' => 'Tffs',
			'tffs_name' => 'Tffs Name',
			'tffs_numrec' => 'Tffs Numrec',
			'tffs_createby' => 'Tffs Createby',
			'tffs_created' => 'Tffs Created',
			'tffs_updateby' => 'Tffs Updateby',
			'tffs_modified' => 'Tffs Modified',
			'tffs_remark' => 'Tffs Remark',
			'tffs_status' => 'Tffs Status',
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

		$criteria->compare('tffs_id',$this->tffs_id);
		$criteria->compare('tffs_name',$this->tffs_name,true);
		$criteria->compare('tffs_numrec',$this->tffs_numrec);
		$criteria->compare('tffs_createby',$this->tffs_createby,true);
		$criteria->compare('tffs_created',$this->tffs_created,true);
		$criteria->compare('tffs_updateby',$this->tffs_updateby,true);
		$criteria->compare('tffs_modified',$this->tffs_modified,true);
		$criteria->compare('tffs_remark',$this->tffs_remark,true);
		$criteria->compare('tffs_status',$this->tffs_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}