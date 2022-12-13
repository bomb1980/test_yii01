<?php

/**
 * This is the model class for table "gentextfile_tb".
 *
 * The followings are the available columns in table 'gentextfile_tb':
 * @property integer $gtf_id
 * @property string $gtf_name
 * @property string $gtf_path
 * @property string $gtf_countgen
 * @property string $gtf_statusgen
 * @property string $gtf_statusupload
 * @property string $gtf_createby
 * @property string $gtf_created
 * @property string $gtf_updateby
 * @property string $gtf_modified
 * @property string $gtf_remark
 * @property integer $gtf_status
 */
class GentextfileTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GentextfileTb the static model class
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
		return 'gentextfile_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gtf_name, gtf_path, gtf_countgen, gtf_statusgen, gtf_statusupload, gtf_createby, gtf_created, gtf_updateby, gtf_modified', 'required'),
			array('gtf_status', 'numerical', 'integerOnly'=>true),
			array('gtf_name', 'length', 'max'=>255),
			array('gtf_countgen, gtf_statusgen, gtf_statusupload', 'length', 'max'=>10),
			array('gtf_createby, gtf_updateby', 'length', 'max'=>100),
			array('gtf_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gtf_id, gtf_name, gtf_path, gtf_countgen, gtf_statusgen, gtf_statusupload, gtf_createby, gtf_created, gtf_updateby, gtf_modified, gtf_remark, gtf_status', 'safe', 'on'=>'search'),
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
			'gtf_id' => 'Gtf',
			'gtf_name' => 'Gtf Name',
			'gtf_path' => 'Gtf Path',
			'gtf_countgen' => 'Gtf Countgen',
			'gtf_statusgen' => 'Gtf Statusgen',
			'gtf_statusupload' => 'Gtf Statusupload',
			'gtf_createby' => 'Gtf Createby',
			'gtf_created' => 'Gtf Created',
			'gtf_updateby' => 'Gtf Updateby',
			'gtf_modified' => 'Gtf Modified',
			'gtf_remark' => 'Gtf Remark',
			'gtf_status' => 'Gtf Status',
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

		$criteria->compare('gtf_id',$this->gtf_id);
		$criteria->compare('gtf_name',$this->gtf_name,true);
		$criteria->compare('gtf_path',$this->gtf_path,true);
		$criteria->compare('gtf_countgen',$this->gtf_countgen,true);
		$criteria->compare('gtf_statusgen',$this->gtf_statusgen,true);
		$criteria->compare('gtf_statusupload',$this->gtf_statusupload,true);
		$criteria->compare('gtf_createby',$this->gtf_createby,true);
		$criteria->compare('gtf_created',$this->gtf_created,true);
		$criteria->compare('gtf_updateby',$this->gtf_updateby,true);
		$criteria->compare('gtf_modified',$this->gtf_modified,true);
		$criteria->compare('gtf_remark',$this->gtf_remark,true);
		$criteria->compare('gtf_status',$this->gtf_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}