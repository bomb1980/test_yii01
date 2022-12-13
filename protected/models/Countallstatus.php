<?php

/**
 * This is the model class for table "countallstatus".
 *
 * The followings are the available columns in table 'countallstatus':
 * @property integer $ssobid
 * @property string $registernumber
 * @property string $ssobranch_code
 * @property string $name
 * @property integer $P_status
 * @property integer $B_status
 * @property integer $A_status
 * @property string $stateP_Date
 */

	
 
class Countallstatus extends CActiveRecord
{
	
	public $SumOfP_status;
	public $SumOfB_status;
	public $SumOfA_status;
	
	//=== เริ่ม การเปลี่ยน database connection เป็น db3 ====//
	public static $conection3; // Model attribute
	
	public function getDbConnection(){

		if(self::$conection3!==null)
			return self::$conection3;
	
		else{
			self::$conection3 = Yii::app()->db3; // main.php - DB config name ต้องไปกำหนด db2 ในไฟลื main.php ของ config ด้วย
	
			if(self::$conection3 instanceof CDbConnection){
				self::$conection3->setActive(true);
				return self::$conection3;
			}
			else
				throw new CDbException(Yii::t('yii',"Active Record requires a '$conection' CDbConnection application component."));
		}
	}
	//=== จบ การเปลี่ยน database connection เป็น db3 ====//
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Countallstatus the static model class
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
		return 'countallstatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('P_status, B_status, A_status', 'numerical', 'integerOnly'=>true),
			array('registernumber', 'length', 'max'=>20),
			array('ssobranch_code', 'length', 'max'=>60),
			array('name, stateP_Date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ssobid, registernumber, ssobranch_code, name, P_status, B_status, A_status, stateP_Date', 'safe', 'on'=>'search'),
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
			'ssobid' => 'Ssobid',
			'registernumber' => 'Registernumber',
			'ssobranch_code' => 'Ssobranch Code',
			'name' => 'Name',
			'P_status' => 'P Status',
			'B_status' => 'B Status',
			'A_status' => 'A Status',
			'stateP_Date' => 'State P Date',
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

		$criteria->compare('ssobid',$this->ssobid);
		$criteria->compare('registernumber',$this->registernumber,true);
		$criteria->compare('ssobranch_code',$this->ssobranch_code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('P_status',$this->P_status);
		$criteria->compare('B_status',$this->B_status);
		$criteria->compare('A_status',$this->A_status);
		$criteria->compare('stateP_Date',$this->stateP_Date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}