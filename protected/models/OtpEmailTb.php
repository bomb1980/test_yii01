<?php

/**
 * This is the model class for table "otp_email_tb".
 *
 * The followings are the available columns in table 'otp_email_tb':
 * @property integer $oel_id
 * @property string $oel_registernumber
 * @property string $oel_accno
 * @property string $oel_registername
 * @property string $oel_emailaddress
 * @property string $oel_otp
 * @property string $oel_expdatetime
 * @property string $oel_registerdate
 * @property string $oel_emailtype
 * @property string $oel_answer
 * @property string $oel_createby
 * @property string $oel_createdate
 * @property string $oel_updateby
 * @property string $oel_updatedate
 * @property string $oel_remark
 * @property string $oel_status
 */

class OtpEmailTb extends CActiveRecord
{

	//=== เริ่ม การเปลี่ยน database connection เป็น db4 ====//
	public static $conection4; // Model attribute

	public static function getNoAnswerMail($params = [])
	{

		$tempDate = explode('/', $params['eddatep']);

		$date_30 = date('Y-m-d', strtotime("-30 days", mktime(00, 00, 00, $tempDate[0], $tempDate[1], $tempDate[2])));
		// arr($date_30, 0);

		$qetp = new CDbCriteria(array(
			'condition' => "oel_registerdate <= :date_30 AND ( oel_answer is null or oel_answer = '' ) AND oel_emailtype = 1 AND oel_status = 'P'",
			'params' => array(':date_30' => $date_30)
		));

		//SELECT * FROM etpdb.otp_email_tb where (oel_answer is null or oel_answer = "") and oel_emailtype = '1' and oel_status = 'P';
		return self::model()->findAll($qetp);
	}

	public function getDbConnection()
	{

		if (self::$conection4 !== null)
			return self::$conection4;

		else {
			//etpdb
			self::$conection4 = Yii::app()->db4; // main.php - DB config name ต้องไปกำหนด db2 ในไฟลื main.php ของ config ด้วย

			if (self::$conection4 instanceof CDbConnection) {
				self::$conection4->setActive(true);
				return self::$conection4;
			} else
				throw new CDbException(Yii::t('yii', "Active Record requires a '$conection' CDbConnection application component."));
		}
	}

	public function tableName()
	{
		return 'otp_email_tb';
	}




	public static function getDatas($registernumber = NULL)
	{

		$attributes = ['oel_registernumber' => $registernumber];


		return self::model()->findByAttributes($attributes);
	}


	//=== จบ การเปลี่ยน database connection เป็น db4 ====//


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OtpEmailTb the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}




	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('oel_registernumber, oel_accno, oel_registername, oel_emailaddress, oel_registerdate', 'required'),
			array('oel_registernumber, oel_accno, oel_answer', 'length', 'max' => 50),
			array('oel_registername', 'length', 'max' => 500),
			array('oel_emailaddress', 'length', 'max' => 200),
			array('oel_otp, oel_emailtype, oel_status', 'length', 'max' => 10),
			array('oel_createby, oel_updateby', 'length', 'max' => 150),
			array('oel_expdatetime, oel_createdate, oel_updatedate, oel_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('oel_id, oel_registernumber, oel_accno, oel_registername, oel_emailaddress, oel_otp, oel_expdatetime, oel_registerdate, oel_emailtype, oel_answer, oel_createby, oel_createdate, oel_updateby, oel_updatedate, oel_remark, oel_status', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'oel_id' => 'Oel',
			'oel_registernumber' => 'Oel Registernumber',
			'oel_accno' => 'Oel Accno',
			'oel_registername' => 'Oel Registername',
			'oel_emailaddress' => 'Oel Emailaddress',
			'oel_otp' => 'Oel Otp',
			'oel_expdatetime' => 'Oel Expdatetime',
			'oel_registerdate' => 'Oel Registerdate',
			'oel_emailtype' => 'Oel Emailtype',
			'oel_answer' => 'Oel Answer',
			'oel_createby' => 'Oel Createby',
			'oel_createdate' => 'Oel Createdate',
			'oel_updateby' => 'Oel Updateby',
			'oel_updatedate' => 'Oel Updatedate',
			'oel_remark' => 'Oel Remark',
			'oel_status' => 'Oel Status',
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

		$criteria = new CDbCriteria;

		$criteria->compare('oel_id', $this->oel_id);
		$criteria->compare('oel_registernumber', $this->oel_registernumber, true);
		$criteria->compare('oel_accno', $this->oel_accno, true);
		$criteria->compare('oel_registername', $this->oel_registername, true);
		$criteria->compare('oel_emailaddress', $this->oel_emailaddress, true);
		$criteria->compare('oel_otp', $this->oel_otp, true);
		$criteria->compare('oel_expdatetime', $this->oel_expdatetime, true);
		$criteria->compare('oel_registerdate', $this->oel_registerdate, true);
		$criteria->compare('oel_emailtype', $this->oel_emailtype, true);
		$criteria->compare('oel_answer', $this->oel_answer, true);
		$criteria->compare('oel_createby', $this->oel_createby, true);
		$criteria->compare('oel_createdate', $this->oel_createdate, true);
		$criteria->compare('oel_updateby', $this->oel_updateby, true);
		$criteria->compare('oel_updatedate', $this->oel_updatedate, true);
		$criteria->compare('oel_remark', $this->oel_remark, true);
		$criteria->compare('oel_status', $this->oel_status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
