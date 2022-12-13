<?php

/**
 * This is the model class for table "logevent_tb".
 *
 * The followings are the available columns in table 'logevent_tb':
 * @property integer $log_id
 * @property string $log_user
 * @property string $log_action
 * @property string $log_page
 * @property string $log_cause
 * @property string $log_date
 * @property string $log_data
 * @property string $log_ip
 * @property string $log_remark
 * @property integer $log_status
 */
class LogeventTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LogeventTb the static model class
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
		return 'logevent_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('log_user, log_action, log_page, log_cause, log_date, log_data, log_ip', 'required'),
			array('log_status', 'numerical', 'integerOnly'=>true),
			array('log_user', 'length', 'max'=>100),
			array('log_action, log_page, log_cause, log_data, log_ip', 'length', 'max'=>255),
			array('log_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('log_id, log_user, log_action, log_page, log_cause, log_date, log_data, log_ip, log_remark, log_status', 'safe', 'on'=>'search'),
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
			'log_id' => 'Log',
			'log_user' => 'Log User',
			'log_action' => 'Log Action',
			'log_page' => 'Log Page',
			'log_cause' => 'Log Cause',
			'log_date' => 'Log Date',
			'log_data' => 'Log Data',
			'log_ip' => 'Log Ip',
			'log_remark' => 'Log Remark',
			'log_status' => 'Log Status',
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

		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('log_user',$this->log_user,true);
		$criteria->compare('log_action',$this->log_action,true);
		$criteria->compare('log_page',$this->log_page,true);
		$criteria->compare('log_cause',$this->log_cause,true);
		$criteria->compare('log_date',$this->log_date,true);
		$criteria->compare('log_data',$this->log_data,true);
		$criteria->compare('log_ip',$this->log_ip,true);
		$criteria->compare('log_remark',$this->log_remark,true);
		$criteria->compare('log_status',$this->log_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
}