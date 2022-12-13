<?php

/**
 * This is the model class for table "sapeinsalldata_tb".
 *
 * The followings are the available columns in table 'sapeinsalldata_tb':
 * @property integer $sad_id
 * @property string $sad_regisno
 * @property string $sad_accno
 * @property string $sad_createby
 * @property string $sad_created
 * @property string $sad_updateby
 * @property string $sad_modified
 * @property string $sad_remark
 * @property integer $sad_status
 */
class SapeinsalldataTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SapeinsalldataTb the static model class
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
		return 'sapeinsalldata_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sad_regisno, sad_accno', 'required'),
			array('sad_status', 'numerical', 'integerOnly'=>true),
			array('sad_regisno', 'length', 'max'=>13),
			array('sad_accno', 'length', 'max'=>10),
			array('sad_createby, sad_updateby', 'length', 'max'=>100),
			array('sad_created, sad_modified, sad_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sad_id, sad_regisno, sad_accno, sad_createby, sad_created, sad_updateby, sad_modified, sad_remark, sad_status', 'safe', 'on'=>'search'),
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
			'sad_id' => 'Sad',
			'sad_regisno' => 'Sad Regisno',
			'sad_accno' => 'Sad Accno',
			'sad_createby' => 'Sad Createby',
			'sad_created' => 'Sad Created',
			'sad_updateby' => 'Sad Updateby',
			'sad_modified' => 'Sad Modified',
			'sad_remark' => 'Sad Remark',
			'sad_status' => 'Sad Status',
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

		$criteria->compare('sad_id',$this->sad_id);
		$criteria->compare('sad_regisno',$this->sad_regisno,true);
		$criteria->compare('sad_accno',$this->sad_accno,true);
		$criteria->compare('sad_createby',$this->sad_createby,true);
		$criteria->compare('sad_created',$this->sad_created,true);
		$criteria->compare('sad_updateby',$this->sad_updateby,true);
		$criteria->compare('sad_modified',$this->sad_modified,true);
		$criteria->compare('sad_remark',$this->sad_remark,true);
		$criteria->compare('sad_status',$this->sad_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}