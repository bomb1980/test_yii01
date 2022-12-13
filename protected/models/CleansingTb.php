<?php

/**
 * This is the model class for table "cleansing_tb".
 *
 * The followings are the available columns in table 'cleansing_tb':
 * @property integer $clsg_id
 * @property string $clsg_registernumber
 * @property string $clsg_wpdaccno
 * @property string $clsg_sapainsaccno
 * @property string $clsg_registername
 * @property string $clsg_createby
 * @property string $clsg_created
 * @property string $clsg_updateby
 * @property string $clsg_modified
 * @property string $clsg_remark
 * @property integer $clsg_status
 */
class CleansingTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CleansingTb the static model class
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
		return 'cleansing_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('clsg_registernumber, clsg_wpdaccno, clsg_sapainsaccno, clsg_registername, clsg_createby, clsg_created, clsg_updateby, clsg_modified', 'required'),
			array('clsg_status', 'numerical', 'integerOnly'=>true),
			array('clsg_registernumber', 'length', 'max'=>13),
			array('clsg_wpdaccno, clsg_sapainsaccno', 'length', 'max'=>10),
			array('clsg_registername', 'length', 'max'=>1000),
			array('clsg_createby, clsg_updateby', 'length', 'max'=>100),
			array('clsg_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('clsg_id, clsg_registernumber, clsg_wpdaccno, clsg_sapainsaccno, clsg_registername, clsg_createby, clsg_created, clsg_updateby, clsg_modified, clsg_remark, clsg_status', 'safe', 'on'=>'search'),
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
			'clsg_id' => 'Clsg',
			'clsg_registernumber' => 'Clsg Registernumber',
			'clsg_wpdaccno' => 'Clsg Wpdaccno',
			'clsg_sapainsaccno' => 'Clsg Sapainsaccno',
			'clsg_registername' => 'Clsg Registername',
			'clsg_createby' => 'Clsg Createby',
			'clsg_created' => 'Clsg Created',
			'clsg_updateby' => 'Clsg Updateby',
			'clsg_modified' => 'Clsg Modified',
			'clsg_remark' => 'Clsg Remark',
			'clsg_status' => 'Clsg Status',
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

		$criteria->compare('clsg_id',$this->clsg_id);
		$criteria->compare('clsg_registernumber',$this->clsg_registernumber,true);
		$criteria->compare('clsg_wpdaccno',$this->clsg_wpdaccno,true);
		$criteria->compare('clsg_sapainsaccno',$this->clsg_sapainsaccno,true);
		$criteria->compare('clsg_registername',$this->clsg_registername,true);
		$criteria->compare('clsg_createby',$this->clsg_createby,true);
		$criteria->compare('clsg_created',$this->clsg_created,true);
		$criteria->compare('clsg_updateby',$this->clsg_updateby,true);
		$criteria->compare('clsg_modified',$this->clsg_modified,true);
		$criteria->compare('clsg_remark',$this->clsg_remark,true);
		$criteria->compare('clsg_status',$this->clsg_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}