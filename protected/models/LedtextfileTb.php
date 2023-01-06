<?php

/**
 * This is the model class for table "ledtextfile_tb".
 *
 * The followings are the available columns in table 'ledtextfile_tb':
 * @property integer $ltf_id
 * @property string $ltf_name
 * @property string $ltf_path
 * @property string $ltf_countud
 * @property string $ltf_statusud
 * @property string $ltf_statusupload
 * @property string $ltf_createby
 * @property string $ltf_created
 * @property string $ltf_updateby
 * @property string $ltf_modified
 * @property string $ltf_remark
 * @property integer $ltf_status
 */
class LedtextfileTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedtextfileTb the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getDatas2($ltf_id = NULL ) {

		$filters = array(
			'condition' => "ltf_status >= 1",
			'params'    => [],
			'order' =>  "ltf_modified DESC"
		);

		if( !empty( $ltf_id ) ) {
			$filters['condition'] .= " AND ltf_id = :ltf_id";
			$filters['params'][':ltf_id'] = $ltf_id;
		}

		$qltf = new CDbCriteria($filters);

		return self::model()->findAll($qltf);
	}

	public static function getDatas($ltf_id = NULL ) {

		$qltf = new CDbCriteria(array(
			'condition' => "ltf_id = :ltf_id ",
			'params'    => array(':ltf_id' => $ltf_id),
			'order' =>  "ltf_modified DESC"
		));
		return self::model()->findAll($qltf);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ledtextfile_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ltf_name, ltf_path, ltf_countud, ltf_statusud, ltf_statusupload, ltf_createby, ltf_created, ltf_updateby, ltf_modified', 'required'),
			array('ltf_status', 'numerical', 'integerOnly'=>true),
			array('ltf_name', 'length', 'max'=>255),
			array('ltf_countud, ltf_statusud, ltf_statusupload', 'length', 'max'=>10),
			array('ltf_createby, ltf_updateby', 'length', 'max'=>100),
			array('ltf_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ltf_id, ltf_name, ltf_path, ltf_countud, ltf_statusud, ltf_statusupload, ltf_createby, ltf_created, ltf_updateby, ltf_modified, ltf_remark, ltf_status', 'safe', 'on'=>'search'),
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
			'ltf_id' => 'Ltf',
			'ltf_name' => 'Ltf Name',
			'ltf_path' => 'Ltf Path',
			'ltf_countud' => 'Ltf Countud',
			'ltf_statusud' => 'Ltf Statusud',
			'ltf_statusupload' => 'Ltf Statusupload',
			'ltf_createby' => 'Ltf Createby',
			'ltf_created' => 'Ltf Created',
			'ltf_updateby' => 'Ltf Updateby',
			'ltf_modified' => 'Ltf Modified',
			'ltf_remark' => 'Ltf Remark',
			'ltf_status' => 'Ltf Status',
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

		$criteria->compare('ltf_id',$this->ltf_id);
		$criteria->compare('ltf_name',$this->ltf_name,true);
		$criteria->compare('ltf_path',$this->ltf_path,true);
		$criteria->compare('ltf_countud',$this->ltf_countud,true);
		$criteria->compare('ltf_statusud',$this->ltf_statusud,true);
		$criteria->compare('ltf_statusupload',$this->ltf_statusupload,true);
		$criteria->compare('ltf_createby',$this->ltf_createby,true);
		$criteria->compare('ltf_created',$this->ltf_created,true);
		$criteria->compare('ltf_updateby',$this->ltf_updateby,true);
		$criteria->compare('ltf_modified',$this->ltf_modified,true);
		$criteria->compare('ltf_remark',$this->ltf_remark,true);
		$criteria->compare('ltf_status',$this->ltf_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}