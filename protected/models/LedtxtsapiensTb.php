<?php

/**
 * This is the model class for table "ledtxtsapiens_tb".
 *
 * The followings are the available columns in table 'ledtxtsapiens_tb':
 * @property integer $lts_id
 * @property string $lts_name
 * @property integer $lts_allrec
 * @property integer $lts_emptyrec
 * @property integer $lts_errlgrec
 * @property integer $lts_errtprec
 * @property integer $lts_okrec
 * @property integer $lts_numfile
 * @property string $lts_createby
 * @property string $lts_created
 * @property string $lts_updateby
 * @property string $lts_modified
 * @property string $lts_remark
 * @property integer $lts_status
 */
class LedtxtsapiensTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedtxtsapiensTb the static model class
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
		return 'ledtxtsapiens_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lts_name, lts_createby, lts_created, lts_updateby, lts_modified', 'required'),
			array('lts_allrec, lts_emptyrec, lts_errlgrec, lts_errtprec, lts_okrec, lts_numfile, lts_status', 'numerical', 'integerOnly'=>true),
			array('lts_name', 'length', 'max'=>255),
			array('lts_createby, lts_updateby', 'length', 'max'=>100),
			array('lts_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lts_id, lts_name, lts_allrec, lts_emptyrec, lts_errlgrec, lts_errtprec, lts_okrec, lts_numfile, lts_createby, lts_created, lts_updateby, lts_modified, lts_remark, lts_status', 'safe', 'on'=>'search'),
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
			'lts_id' => 'Lts',
			'lts_name' => 'Lts Name',
			'lts_allrec' => 'Lts Allrec',
			'lts_emptyrec' => 'Lts Emptyrec',
			'lts_errlgrec' => 'Lts Errlgrec',
			'lts_errtprec' => 'Lts Errtprec',
			'lts_okrec' => 'Lts Okrec',
			'lts_numfile' => 'Lts Numfile',
			'lts_createby' => 'Lts Createby',
			'lts_created' => 'Lts Created',
			'lts_updateby' => 'Lts Updateby',
			'lts_modified' => 'Lts Modified',
			'lts_remark' => 'Lts Remark',
			'lts_status' => 'Lts Status',
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

		$criteria->compare('lts_id',$this->lts_id);
		$criteria->compare('lts_name',$this->lts_name,true);
		$criteria->compare('lts_allrec',$this->lts_allrec);
		$criteria->compare('lts_emptyrec',$this->lts_emptyrec);
		$criteria->compare('lts_errlgrec',$this->lts_errlgrec);
		$criteria->compare('lts_errtprec',$this->lts_errtprec);
		$criteria->compare('lts_okrec',$this->lts_okrec);
		$criteria->compare('lts_numfile',$this->lts_numfile);
		$criteria->compare('lts_createby',$this->lts_createby,true);
		$criteria->compare('lts_created',$this->lts_created,true);
		$criteria->compare('lts_updateby',$this->lts_updateby,true);
		$criteria->compare('lts_modified',$this->lts_modified,true);
		$criteria->compare('lts_remark',$this->lts_remark,true);
		$criteria->compare('lts_status',$this->lts_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}