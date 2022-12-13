<?php

/**
 * This is the model class for table "empstate_tb".
 *
 * The followings are the available columns in table 'empstate_tb':
 * @property integer $ems_id
 * @property string $ems_registernumber
 * @property string $ems_accno
 * @property string $ems_accbran
 * @property string $ems_email
 * @property string $ems_startdate
 * @property integer $ems_numofemp
 * @property double $ems_totalsalary
 * @property string $ems_createby
 * @property string $ems_created
 * @property string $ems_updateby
 * @property string $ems_modified
 * @property string $ems_remark
 * @property integer $ems_status
 */
class EmpstateTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpstateTb the static model class
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
		return 'empstate_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ems_registernumber, ems_accno, ems_accbran, ems_email, ems_startdate, ems_createby, ems_created, ems_updateby, ems_modified', 'required'),
			array('ems_numofemp, ems_status', 'numerical', 'integerOnly'=>true),
			array('ems_totalsalary', 'numerical'),
			array('ems_registernumber', 'length', 'max'=>13),
			array('ems_accno', 'length', 'max'=>10),
			array('ems_accbran', 'length', 'max'=>6),
			array('ems_email', 'length', 'max'=>255),
			array('ems_createby, ems_updateby', 'length', 'max'=>100),
			array('ems_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ems_id, ems_registernumber, ems_accno, ems_accbran, ems_email, ems_startdate, ems_numofemp, ems_totalsalary, ems_createby, ems_created, ems_updateby, ems_modified, ems_remark, ems_status', 'safe', 'on'=>'search'),
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
			'ems_id' => 'Ems',
			'ems_registernumber' => 'Ems Registernumber',
			'ems_accno' => 'Ems Accno',
			'ems_accbran' => 'Ems Accbran',
			'ems_email' => 'Ems Email',
			'ems_startdate' => 'Ems Startdate',
			'ems_numofemp' => 'Ems Numofemp',
			'ems_totalsalary' => 'Ems Totalsalary',
			'ems_createby' => 'Ems Createby',
			'ems_created' => 'Ems Created',
			'ems_updateby' => 'Ems Updateby',
			'ems_modified' => 'Ems Modified',
			'ems_remark' => 'Ems Remark',
			'ems_status' => 'Ems Status',
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

		$criteria->compare('ems_id',$this->ems_id);
		$criteria->compare('ems_registernumber',$this->ems_registernumber,true);
		$criteria->compare('ems_accno',$this->ems_accno,true);
		$criteria->compare('ems_accbran',$this->ems_accbran,true);
		$criteria->compare('ems_email',$this->ems_email,true);
		$criteria->compare('ems_startdate',$this->ems_startdate,true);
		$criteria->compare('ems_numofemp',$this->ems_numofemp);
		$criteria->compare('ems_totalsalary',$this->ems_totalsalary);
		$criteria->compare('ems_createby',$this->ems_createby,true);
		$criteria->compare('ems_created',$this->ems_created,true);
		$criteria->compare('ems_updateby',$this->ems_updateby,true);
		$criteria->compare('ems_modified',$this->ems_modified,true);
		$criteria->compare('ems_remark',$this->ems_remark,true);
		$criteria->compare('ems_status',$this->ems_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}