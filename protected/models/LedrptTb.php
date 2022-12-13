<?php

/**
 * This is the model class for table "ledrpt_tb".
 *
 * The followings are the available columns in table 'ledrpt_tb':
 * @property integer $lrpt_id
 * @property string $lrpt_accno
 * @property string $lrpt_accbran
 * @property string $lrpt_registernumber
 * @property string $lrpt_registername
 * @property string $lrpt_address
 * @property string $lrpt_aumpur
 * @property string $lrpt_provice
 * @property string $lrpt_zipcode
 * @property string $lrpt_ssobrancode
 * @property string $lrpt_ssobranname
 * @property string $lrpt_responsecode
 * @property string $lrpt_bkr_prot
 * @property string $lrpt_req
 * @property string $lrpt_lastupdate
 * @property string $lrpt_abs_prot
 * @property string $lrpt_abs_gaz
 * @property string $lrpt_abs_due
 * @property string $lrpt_calldate
 * @property string $lrpt_df_id
 * @property string $lrpt_df_name
 * @property string $lrpt_df_surname
 * @property string $lrpt_createby
 * @property string $lrpt_created
 * @property string $lrpt_updateby
 * @property string $lrpt_modified
 * @property string $lrpt_remark
 * @property integer $lrpt_status
 */
class LedrptTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedrptTb the static model class
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
		return 'ledrpt_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lrpt_createby, lrpt_created, lrpt_updateby, lrpt_modified', 'required'),
			array('lrpt_id, lrpt_status', 'numerical', 'integerOnly'=>true),
			array('lrpt_accno, lrpt_accbran, lrpt_registernumber, lrpt_registername, lrpt_address, lrpt_aumpur, lrpt_provice, lrpt_zipcode, lrpt_ssobrancode, lrpt_ssobranname, lrpt_responsecode, lrpt_bkr_prot, lrpt_req, lrpt_lastupdate, lrpt_abs_prot, lrpt_abs_gaz, lrpt_abs_due, lrpt_df_id, lrpt_df_name, lrpt_df_surname', 'length', 'max'=>255),
			array('lrpt_createby, lrpt_updateby', 'length', 'max'=>100),
			array('lrpt_calldate, lrpt_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lrpt_id, lrpt_accno, lrpt_accbran, lrpt_registernumber, lrpt_registername, lrpt_address, lrpt_aumpur, lrpt_provice, lrpt_zipcode, lrpt_ssobrancode, lrpt_ssobranname, lrpt_responsecode, lrpt_bkr_prot, lrpt_req, lrpt_lastupdate, lrpt_abs_prot, lrpt_abs_gaz, lrpt_abs_due, lrpt_calldate, lrpt_df_id, lrpt_df_name, lrpt_df_surname, lrpt_createby, lrpt_created, lrpt_updateby, lrpt_modified, lrpt_remark, lrpt_status', 'safe', 'on'=>'search'),
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
			'lrpt_id' => 'Lrpt',
			'lrpt_accno' => 'Lrpt Accno',
			'lrpt_accbran' => 'Lrpt Accbran',
			'lrpt_registernumber' => 'Lrpt Registernumber',
			'lrpt_registername' => 'Lrpt Registername',
			'lrpt_address' => 'Lrpt Address',
			'lrpt_aumpur' => 'Lrpt Aumpur',
			'lrpt_provice' => 'Lrpt Provice',
			'lrpt_zipcode' => 'Lrpt Zipcode',
			'lrpt_ssobrancode' => 'Lrpt Ssobrancode',
			'lrpt_ssobranname' => 'Lrpt Ssobranname',
			'lrpt_responsecode' => 'Lrpt Responsecode',
			'lrpt_bkr_prot' => 'Lrpt Bkr Prot',
			'lrpt_req' => 'Lrpt Req',
			'lrpt_lastupdate' => 'Lrpt Lastupdate',
			'lrpt_abs_prot' => 'Lrpt Abs Prot',
			'lrpt_abs_gaz' => 'Lrpt Abs Gaz',
			'lrpt_abs_due' => 'Lrpt Abs Due',
			'lrpt_calldate' => 'Lrpt Calldate',
			'lrpt_df_id' => 'Lrpt Df',
			'lrpt_df_name' => 'Lrpt Df Name',
			'lrpt_df_surname' => 'Lrpt Df Surname',
			'lrpt_createby' => 'Lrpt Createby',
			'lrpt_created' => 'Lrpt Created',
			'lrpt_updateby' => 'Lrpt Updateby',
			'lrpt_modified' => 'Lrpt Modified',
			'lrpt_remark' => 'Lrpt Remark',
			'lrpt_status' => 'Lrpt Status',
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

		$criteria->compare('lrpt_id',$this->lrpt_id);
		$criteria->compare('lrpt_accno',$this->lrpt_accno,true);
		$criteria->compare('lrpt_accbran',$this->lrpt_accbran,true);
		$criteria->compare('lrpt_registernumber',$this->lrpt_registernumber,true);
		$criteria->compare('lrpt_registername',$this->lrpt_registername,true);
		$criteria->compare('lrpt_address',$this->lrpt_address,true);
		$criteria->compare('lrpt_aumpur',$this->lrpt_aumpur,true);
		$criteria->compare('lrpt_provice',$this->lrpt_provice,true);
		$criteria->compare('lrpt_zipcode',$this->lrpt_zipcode,true);
		$criteria->compare('lrpt_ssobrancode',$this->lrpt_ssobrancode,true);
		$criteria->compare('lrpt_ssobranname',$this->lrpt_ssobranname,true);
		$criteria->compare('lrpt_responsecode',$this->lrpt_responsecode,true);
		$criteria->compare('lrpt_bkr_prot',$this->lrpt_bkr_prot,true);
		$criteria->compare('lrpt_req',$this->lrpt_req,true);
		$criteria->compare('lrpt_lastupdate',$this->lrpt_lastupdate,true);
		$criteria->compare('lrpt_abs_prot',$this->lrpt_abs_prot,true);
		$criteria->compare('lrpt_abs_gaz',$this->lrpt_abs_gaz,true);
		$criteria->compare('lrpt_abs_due',$this->lrpt_abs_due,true);
		$criteria->compare('lrpt_calldate',$this->lrpt_calldate,true);
		$criteria->compare('lrpt_df_id',$this->lrpt_df_id,true);
		$criteria->compare('lrpt_df_name',$this->lrpt_df_name,true);
		$criteria->compare('lrpt_df_surname',$this->lrpt_df_surname,true);
		$criteria->compare('lrpt_createby',$this->lrpt_createby,true);
		$criteria->compare('lrpt_created',$this->lrpt_created,true);
		$criteria->compare('lrpt_updateby',$this->lrpt_updateby,true);
		$criteria->compare('lrpt_modified',$this->lrpt_modified,true);
		$criteria->compare('lrpt_remark',$this->lrpt_remark,true);
		$criteria->compare('lrpt_status',$this->lrpt_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}