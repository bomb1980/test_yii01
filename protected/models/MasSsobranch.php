<?php

/**
 * This is the model class for table "mas_ssobranch".
 *
 * The followings are the available columns in table 'mas_ssobranch':
 * @property string $ssobranch_code
 * @property string $name
 * @property string $shortname
 * @property integer $ssobranch_type_id
 * @property string $status
 * @property string $create_by
 * @property string $catate_date
 * @property string $update_by
 * @property string $update_date
 */
class MasSsobranch extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MasSsobranch the static model class
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
		return 'mas_ssobranch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ssobranch_type_id', 'numerical', 'integerOnly'=>true),
			array('ssobranch_code, shortname, create_by, update_by', 'length', 'max'=>60),
			array('name', 'length', 'max'=>600),
			array('status', 'length', 'max'=>6),
			array('catate_date, update_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ssobranch_code, name, shortname, ssobranch_type_id, status, create_by, catate_date, update_by, update_date', 'safe', 'on'=>'search'),
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
			'ssobranch_code' => 'Ssobranch Code',
			'name' => 'Name',
			'shortname' => 'Shortname',
			'ssobranch_type_id' => 'Ssobranch Type',
			'status' => 'Status',
			'create_by' => 'Create By',
			'catate_date' => 'Catate Date',
			'update_by' => 'Update By',
			'update_date' => 'Update Date',
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

		$criteria->compare('ssobranch_code',$this->ssobranch_code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('shortname',$this->shortname,true);
		$criteria->compare('ssobranch_type_id',$this->ssobranch_type_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('catate_date',$this->catate_date,true);
		$criteria->compare('update_by',$this->update_by,true);
		$criteria->compare('update_date',$this->update_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}