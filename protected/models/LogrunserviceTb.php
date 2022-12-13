<?php

/**
 * This is the model class for table "logrunservice_tb".
 *
 * The followings are the available columns in table 'logrunservice_tb':
 * @property integer $lrs_id
 * @property string $lrs_servicename
 * @property string $lrs_rundate
 * @property string $lrs_resultrecord
 * @property string $lrs_createby
 * @property string $lrs_created
 * @property string $lrs_updateby
 * @property string $lrs_modified
 * @property string $lrs_remark
 * @property integer $lrs_status
 */
class LogrunserviceTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LogrunserviceTb the static model class
	 */
	
	//=== เริ่ม การเปลี่ยน database connection เป็น db2 ====//
	public static $conection; // Model attribute
	
	public function getDbConnection(){

		if(self::$conection!==null)
			return self::$conection;
	
		else{
			self::$conection = Yii::app()->db2; // main.php - DB config name ต้องไปกำหนด db2 ในไฟลื main.php ของ config ด้วย
	
			if(self::$conection instanceof CDbConnection){
				self::$conection->setActive(true);
				return self::$conection;
			}
			else
				throw new CDbException(Yii::t('yii',"Active Record requires a '$conection' CDbConnection application component."));
		}
	}
	//=== จบ การเปลี่ยน database connection เป็น db2 ====// 
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'logrunservice_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lrs_servicename, lrs_rundate, lrs_resultrecord, lrs_createby, lrs_created, lrs_updateby, lrs_modified', 'required'),
			array('lrs_status', 'numerical', 'integerOnly'=>true),
			array('lrs_servicename, lrs_resultrecord', 'length', 'max'=>255),
			array('lrs_createby, lrs_updateby', 'length', 'max'=>100),
			array('lrs_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lrs_id, lrs_servicename, lrs_rundate, lrs_resultrecord, lrs_createby, lrs_created, lrs_updateby, lrs_modified, lrs_remark, lrs_status', 'safe', 'on'=>'search'),
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
			'lrs_id' => 'Lrs',
			'lrs_servicename' => 'Lrs Servicename',
			'lrs_rundate' => 'Lrs Rundate',
			'lrs_resultrecord' => 'Lrs Resultrecord',
			'lrs_createby' => 'Lrs Createby',
			'lrs_created' => 'Lrs Created',
			'lrs_updateby' => 'Lrs Updateby',
			'lrs_modified' => 'Lrs Modified',
			'lrs_remark' => 'Lrs Remark',
			'lrs_status' => 'Lrs Status',
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

		$criteria->compare('lrs_id',$this->lrs_id);
		$criteria->compare('lrs_servicename',$this->lrs_servicename,true);
		$criteria->compare('lrs_rundate',$this->lrs_rundate,true);
		$criteria->compare('lrs_resultrecord',$this->lrs_resultrecord,true);
		$criteria->compare('lrs_createby',$this->lrs_createby,true);
		$criteria->compare('lrs_created',$this->lrs_created,true);
		$criteria->compare('lrs_updateby',$this->lrs_updateby,true);
		$criteria->compare('lrs_modified',$this->lrs_modified,true);
		$criteria->compare('lrs_remark',$this->lrs_remark,true);
		$criteria->compare('lrs_status',$this->lrs_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}