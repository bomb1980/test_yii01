<?php

/**
 * This is the model class for table "wpdtxtfile_tb".
 *
 * The followings are the available columns in table 'wpdtxtfile_tb':
 * @property integer $wpdtf_id
 * @property string $wpdtf_filename
 * @property string $wpdtf_path
 * @property integer $wpdtf_numrec
 * @property string $wpdtf_createby
 * @property string $wpdtf_created
 * @property string $wpdtf_updateby
 * @property string $wpdtf_modified
 * @property string $wpdtf_remark
 * @property integer $wpdtf_status
 */
class WpdtxtfileTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WpdtxtfileTb the static model class
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
		return 'wpdtxtfile_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wpdtf_filename, wpdtf_createby, wpdtf_created, wpdtf_updateby, wpdtf_modified', 'required'),
			array('wpdtf_numrec, wpdtf_status', 'numerical', 'integerOnly'=>true),
			array('wpdtf_filename', 'length', 'max'=>200),
			array('wpdtf_createby, wpdtf_updateby', 'length', 'max'=>100),
			array('wpdtf_path, wpdtf_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('wpdtf_id, wpdtf_filename, wpdtf_path, wpdtf_numrec, wpdtf_createby, wpdtf_created, wpdtf_updateby, wpdtf_modified, wpdtf_remark, wpdtf_status', 'safe', 'on'=>'search'),
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
			'wpdtf_id' => 'Wpdtf',
			'wpdtf_filename' => 'Wpdtf Filename',
			'wpdtf_path' => 'Wpdtf Path',
			'wpdtf_numrec' => 'Wpdtf Numrec',
			'wpdtf_createby' => 'Wpdtf Createby',
			'wpdtf_created' => 'Wpdtf Created',
			'wpdtf_updateby' => 'Wpdtf Updateby',
			'wpdtf_modified' => 'Wpdtf Modified',
			'wpdtf_remark' => 'Wpdtf Remark',
			'wpdtf_status' => 'Wpdtf Status',
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

		$criteria->compare('wpdtf_id',$this->wpdtf_id);
		$criteria->compare('wpdtf_filename',$this->wpdtf_filename,true);
		$criteria->compare('wpdtf_path',$this->wpdtf_path,true);
		$criteria->compare('wpdtf_numrec',$this->wpdtf_numrec);
		$criteria->compare('wpdtf_createby',$this->wpdtf_createby,true);
		$criteria->compare('wpdtf_created',$this->wpdtf_created,true);
		$criteria->compare('wpdtf_updateby',$this->wpdtf_updateby,true);
		$criteria->compare('wpdtf_modified',$this->wpdtf_modified,true);
		$criteria->compare('wpdtf_remark',$this->wpdtf_remark,true);
		$criteria->compare('wpdtf_status',$this->wpdtf_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}