<?php

/**
 * This is the model class for table "accnumber_tb".
 *
 * The followings are the available columns in table 'accnumber_tb':
 * @property integer $acc_id
 * @property string $acc_no
 * @property string $acc_bran
 * @property string $acc_regis_no
 * @property string $acc_active_flag
 * @property string $acc_using_date
 * @property string $acc_createby
 * @property string $acc_created
 * @property string $acc_updateby
 * @property string $acc_modified
 * @property string $acc_remark
 * @property integer $acc_status
 */
class AccnumberTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AccnumberTb the static model class
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
		return 'accnumber_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('acc_no, acc_bran, acc_regis_no, acc_active_flag, acc_using_date, acc_createby, acc_created, acc_updateby, acc_modified', 'required'),
			array('acc_status', 'numerical', 'integerOnly'=>true),
			array('acc_no', 'length', 'max'=>10),
			array('acc_bran', 'length', 'max'=>6),
			array('acc_regis_no', 'length', 'max'=>13),
			array('acc_active_flag', 'length', 'max'=>1),
			array('acc_createby, acc_updateby', 'length', 'max'=>100),
			array('acc_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('acc_id, acc_no, acc_bran, acc_regis_no, acc_active_flag, acc_using_date, acc_createby, acc_created, acc_updateby, acc_modified, acc_remark, acc_status', 'safe', 'on'=>'search'),
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
			'acc_id' => 'Acc',
			'acc_no' => 'Acc No',
			'acc_bran' => 'Acc Bran',
			'acc_regis_no' => 'Acc Regis No',
			'acc_active_flag' => 'Acc Active Flag',
			'acc_using_date' => 'Acc Using Date',
			'acc_createby' => 'Acc Createby',
			'acc_created' => 'Acc Created',
			'acc_updateby' => 'Acc Updateby',
			'acc_modified' => 'Acc Modified',
			'acc_remark' => 'Acc Remark',
			'acc_status' => 'Acc Status',
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

		$criteria->compare('acc_id',$this->acc_id);
		$criteria->compare('acc_no',$this->acc_no,true);
		$criteria->compare('acc_bran',$this->acc_bran,true);
		$criteria->compare('acc_regis_no',$this->acc_regis_no,true);
		$criteria->compare('acc_active_flag',$this->acc_active_flag,true);
		$criteria->compare('acc_using_date',$this->acc_using_date,true);
		$criteria->compare('acc_createby',$this->acc_createby,true);
		$criteria->compare('acc_created',$this->acc_created,true);
		$criteria->compare('acc_updateby',$this->acc_updateby,true);
		$criteria->compare('acc_modified',$this->acc_modified,true);
		$criteria->compare('acc_remark',$this->acc_remark,true);
		$criteria->compare('acc_status',$this->acc_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}