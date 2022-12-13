<?php

/**
 * This is the model class for table "corptype_tb".
 *
 * The followings are the available columns in table 'corptype_tb':
 * @property integer $cty_id
 * @property string $cty_typecode
 * @property string $cty_typenameshort
 * @property string $cty_typenamefull
 * @property string $cty_busstypecode
 * @property string $cty_prefixname
 * @property string $cty_suffixname
 */
class CorptypeTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CorptypeTb the static model class
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
		return 'corptype_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cty_typecode, cty_typenameshort, cty_typenamefull, cty_busstypecode, cty_prefixname, cty_suffixname', 'required'),
			array('cty_typecode', 'length', 'max'=>1),
			array('cty_typenameshort', 'length', 'max'=>50),
			array('cty_typenamefull, cty_prefixname, cty_suffixname', 'length', 'max'=>100),
			array('cty_busstypecode', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cty_id, cty_typecode, cty_typenameshort, cty_typenamefull, cty_busstypecode, cty_prefixname, cty_suffixname', 'safe', 'on'=>'search'),
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
			'cty_id' => 'Cty',
			'cty_typecode' => 'Cty Typecode',
			'cty_typenameshort' => 'Cty Typenameshort',
			'cty_typenamefull' => 'Cty Typenamefull',
			'cty_busstypecode' => 'Cty Busstypecode',
			'cty_prefixname' => 'Cty Prefixname',
			'cty_suffixname' => 'Cty Suffixname',
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

		$criteria->compare('cty_id',$this->cty_id);
		$criteria->compare('cty_typecode',$this->cty_typecode,true);
		$criteria->compare('cty_typenameshort',$this->cty_typenameshort,true);
		$criteria->compare('cty_typenamefull',$this->cty_typenamefull,true);
		$criteria->compare('cty_busstypecode',$this->cty_busstypecode,true);
		$criteria->compare('cty_prefixname',$this->cty_prefixname,true);
		$criteria->compare('cty_suffixname',$this->cty_suffixname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}