<?php

/**
 * This is the model class for table "sapainstxtfile_tb".
 *
 * The followings are the available columns in table 'sapainstxtfile_tb':
 * @property integer $sptf_id
 * @property string $sptf_filename
 * @property string $sptf_path
 * @property integer $sptf_numrec
 * @property string $sptf_createby
 * @property string $sptf_created
 * @property string $sptf_updateby
 * @property string $sptf_modified
 * @property string $sptf_remark
 * @property integer $sptf_status
 */
class SapainstxtfileTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SapainstxtfileTb the static model class
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
		return 'sapainstxtfile_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sptf_filename, sptf_createby, sptf_created, sptf_updateby, sptf_modified', 'required'),
			array('sptf_numrec, sptf_status', 'numerical', 'integerOnly'=>true),
			array('sptf_filename', 'length', 'max'=>200),
			array('sptf_createby, sptf_updateby', 'length', 'max'=>100),
			array('sptf_path, sptf_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sptf_id, sptf_filename, sptf_path, sptf_numrec, sptf_createby, sptf_created, sptf_updateby, sptf_modified, sptf_remark, sptf_status', 'safe', 'on'=>'search'),
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
			'sptf_id' => 'Sptf',
			'sptf_filename' => 'Sptf Filename',
			'sptf_path' => 'Sptf Path',
			'sptf_numrec' => 'Sptf Numrec',
			'sptf_createby' => 'Sptf Createby',
			'sptf_created' => 'Sptf Created',
			'sptf_updateby' => 'Sptf Updateby',
			'sptf_modified' => 'Sptf Modified',
			'sptf_remark' => 'Sptf Remark',
			'sptf_status' => 'Sptf Status',
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

		$criteria->compare('sptf_id',$this->sptf_id);
		$criteria->compare('sptf_filename',$this->sptf_filename,true);
		$criteria->compare('sptf_path',$this->sptf_path,true);
		$criteria->compare('sptf_numrec',$this->sptf_numrec);
		$criteria->compare('sptf_createby',$this->sptf_createby,true);
		$criteria->compare('sptf_created',$this->sptf_created,true);
		$criteria->compare('sptf_updateby',$this->sptf_updateby,true);
		$criteria->compare('sptf_modified',$this->sptf_modified,true);
		$criteria->compare('sptf_remark',$this->sptf_remark,true);
		$criteria->compare('sptf_status',$this->sptf_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}