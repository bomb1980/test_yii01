<?php

/**
 * This is the model class for table "ledresponse_tb".
 *
 * The followings are the available columns in table 'ledresponse_tb':
 * @property integer $lrp_id
 * @property string $lrp_responseCode
 * @property string $lrp_responseMessage
 * @property integer $lrp_tws_id
 * @property string $lrp_recv_no
 * @property string $lrp_recv_yr
 * @property string $lrp_df_id
 * @property string $lrp_df_name
 * @property string $lrp_df_surname
 * @property string $lrp_no
 * @property string $lrp_court_name
 * @property string $lrp_court_type
 * @property string $lrp_black_case
 * @property string $lrp_black_yy
 * @property string $lrp_red_case
 * @property string $lrp_red_yy
 * @property string $lrp_plaintiff1
 * @property string $lrp_plaintiff2
 * @property string $lrp_plaintiff3
 * @property string $lrp_defendant1
 * @property string $lrp_defendant2
 * @property string $lrp_defendant3
 * @property double $lrp_case_capital
 * @property string $lrp_tmp_prot_dd
 * @property string $lrp_tmp_prot_mm
 * @property string $lrp_tmp_prot_yy
 * @property string $lrp_tmp_gaz_dd
 * @property string $lrp_tmp_gaz_mm
 * @property string $lrp_tmp_gaz_yy
 * @property string $lrp_tmp_gaz_book
 * @property string $lrp_tmp_gaz_part
 * @property string $lrp_tmp_gaz_page
 * @property string $lrp_ejc_dd
 * @property string $lrp_ejc_mm
 * @property string $lrp_ejc_yy
 * @property string $lrp_ejc_gaz_dd
 * @property string $lrp_ejc_gaz_mm
 * @property string $lrp_ejc_gaz_yy
 * @property string $lrp_ejc_gaz_book
 * @property string $lrp_ejc_gaz_part
 * @property string $lrp_ejc_gaz_page
 * @property string $lrp_abs_prot_dd
 * @property string $lrp_abs_prot_mm
 * @property string $lrp_abs_prot_yy
 * @property string $lrp_abs_gaz_dd
 * @property string $lrp_abs_gaz_mm
 * @property string $lrp_abs_gaz_yy
 * @property string $lrp_abs_gaz_book
 * @property string $lrp_abs_gaz_part
 * @property string $lrp_abs_gaz_page
 * @property string $lrp_abs_due_dd
 * @property string $lrp_abs_due_mm
 * @property string $lrp_abs_due_yy
 * @property string $lrp_abs_req_dd
 * @property string $lrp_abs_req_mm
 * @property string $lrp_abs_req_yy
 * @property string $lrp_abs_ejc_dd
 * @property string $lrp_abs_ejc_mm
 * @property string $lrp_abs_ejc_yy
 * @property string $lrp_abs_ejc_gaz_dd
 * @property string $lrp_abs_ejc_gaz_mm
 * @property string $lrp_abs_ejc_gaz_yy
 * @property string $lrp_abs_ejc_gaz_book
 * @property string $lrp_abs_ejc_gaz_part
 * @property string $lrp_abs_ejc_gaz_page
 * @property string $lrp_b_cou_set_dd
 * @property string $lrp_b_cou_set_mm
 * @property string $lrp_b_cou_set_yy
 * @property string $lrp_b_set_gaz_dd
 * @property string $lrp_b_set_gaz_mm
 * @property string $lrp_b_set_gaz_yy
 * @property string $lrp_b_set_gaz_book
 * @property string $lrp_b_set_gaz_part
 * @property string $lrp_b_set_gaz_page
 * @property string $lrp_b_can_set_dd
 * @property string $lrp_b_can_set_mm
 * @property string $lrp_b_can_set_yy
 * @property string $lrp_b_can_gaz_dd
 * @property string $lrp_b_can_gaz_mm
 * @property string $lrp_b_can_gaz_yy
 * @property string $lrp_b_can_gaz_book
 * @property string $lrp_b_can_gaz_part
 * @property string $lrp_b_can_gaz_page
 * @property string $lrp_bkr_prot_dd
 * @property string $lrp_bkr_prot_mm
 * @property string $lrp_bkr_prot_yy
 * @property string $lrp_bkr_gaz_dd
 * @property string $lrp_bkr_gaz_mm
 * @property string $lrp_bkr_gaz_yy
 * @property string $lrp_bkr_gaz_book
 * @property string $lrp_bkr_gaz_part
 * @property string $lrp_bkr_gaz_page
 * @property string $lrp_a_cou_set_dd
 * @property string $lrp_a_cou_set_mm
 * @property string $lrp_a_cou_set_yy
 * @property string $lrp_a_set_gaz_dd
 * @property string $lrp_a_set_gaz_mm
 * @property string $lrp_a_set_gaz_yy
 * @property string $lrp_a_set_gaz_book
 * @property string $lrp_a_set_gaz_part
 * @property string $lrp_a_set_gaz_page
 * @property string $lrp_a_can_set_dd
 * @property string $lrp_a_can_set_mm
 * @property string $lrp_a_can_set_yy
 * @property string $lrp_a_can_gaz_dd
 * @property string $lrp_a_can_gaz_mm
 * @property string $lrp_a_can_gaz_yy
 * @property string $lrp_a_can_gaz_book
 * @property string $lrp_a_can_gaz_part
 * @property string $lrp_a_can_gaz_page
 * @property string $lrp_a_due_set_dd
 * @property string $lrp_a_due_set_mm
 * @property string $lrp_a_due_set_yy
 * @property string $lrp_c_bkr_dd
 * @property string $lrp_c_bkr_mm
 * @property string $lrp_c_bkr_yy
 * @property string $lrp_c_gaz_dd
 * @property string $lrp_c_gaz_mm
 * @property string $lrp_c_gaz_yy
 * @property string $lrp_c_gaz_book
 * @property string $lrp_c_gaz_part
 * @property string $lrp_c_gaz_page
 * @property string $lrp_r_bkr_dd
 * @property string $lrp_r_bkr_mm
 * @property string $lrp_r_bkr_yy
 * @property string $lrp_r_gaz_dd
 * @property string $lrp_r_gaz_mm
 * @property string $lrp_r_gaz_yy
 * @property string $lrp_r_gaz_book
 * @property string $lrp_r_gaz_part
 * @property string $lrp_r_gaz_page
 * @property string $lrp_df_expire_dd
 * @property string $lrp_df_expire_mm
 * @property string $lrp_df_expire_yy
 * @property string $lrp_df_manage_dd
 * @property string $lrp_df_manage_mm
 * @property string $lrp_df_manage_yy
 * @property string $lrp_df_manage_ejc_dd
 * @property string $lrp_df_manage_ejc_mm
 * @property string $lrp_df_manage_ejc_yy
 * @property string $lrp_re_bkr_dd
 * @property string $lrp_re_bkr_mm
 * @property string $lrp_re_bkr_yy
 * @property string $lrp_uacc_dd
 * @property string $lrp_uacc_mm
 * @property string $lrp_uacc_yy
 * @property string $lrp_s_bkr_dd
 * @property string $lrp_s_bkr_mm
 * @property string $lrp_s_bkr_yy
 * @property string $lrp_close_dd
 * @property string $lrp_close_mm
 * @property string $lrp_close_yy
 * @property string $lrp_req_dd
 * @property string $lrp_req_mm
 * @property string $lrp_req_yy
 * @property string $lrp_oth_dd
 * @property string $lrp_oth_mm
 * @property string $lrp_oth_yy
 * @property string $lrp_remarkled
 * @property string $lrp_corrupt
 * @property string $lrp_lastupdate
 * @property string $lrp_createby
 * @property string $lrp_created
 * @property string $lrp_updateby
 * @property string $lrp_modified
 * @property string $lrp_remark
 * @property integer $lrp_status
 */
class LedresponseTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedresponseTb the static model class
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
		return 'ledresponse_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lrp_responseCode, lrp_responseMessage, lrp_tws_id, lrp_recv_no, lrp_createby, lrp_created, lrp_updateby, lrp_modified', 'required'),
			array('lrp_tws_id, lrp_status', 'numerical', 'integerOnly'=>true),
			array('lrp_case_capital', 'numerical'),
			array('lrp_responseCode', 'length', 'max'=>3),
			array('lrp_recv_no', 'length', 'max'=>6),
			array('lrp_recv_yr, lrp_black_yy, lrp_red_yy, lrp_tmp_prot_yy, lrp_tmp_gaz_yy, lrp_ejc_yy, lrp_ejc_gaz_yy, lrp_abs_prot_yy, lrp_abs_gaz_yy, lrp_abs_due_yy, lrp_abs_req_yy, lrp_abs_ejc_yy, lrp_abs_ejc_gaz_yy, lrp_b_cou_set_yy, lrp_b_set_gaz_yy, lrp_b_can_set_yy, lrp_b_can_gaz_yy, lrp_bkr_prot_yy, lrp_bkr_gaz_yy, lrp_a_cou_set_yy, lrp_a_set_gaz_yy, lrp_a_can_set_yy, lrp_a_can_gaz_yy, lrp_a_due_set_yy, lrp_c_bkr_yy, lrp_c_gaz_yy, lrp_r_bkr_yy, lrp_r_gaz_yy, lrp_df_expire_yy, lrp_df_manage_yy, lrp_df_manage_ejc_yy, lrp_re_bkr_yy, lrp_uacc_yy, lrp_s_bkr_yy, lrp_close_yy, lrp_req_yy, lrp_oth_yy', 'length', 'max'=>4),
			array('lrp_df_id, lrp_tmp_gaz_part, lrp_ejc_gaz_part, lrp_abs_gaz_part, lrp_abs_ejc_gaz_part, lrp_b_set_gaz_part, lrp_b_can_gaz_part, lrp_bkr_gaz_part, lrp_a_set_gaz_part, lrp_a_can_gaz_part, lrp_c_gaz_part, lrp_r_gaz_part', 'length', 'max'=>50),
			array('lrp_df_name, lrp_df_surname, lrp_plaintiff1, lrp_plaintiff2, lrp_plaintiff3, lrp_defendant1, lrp_defendant2, lrp_defendant3, lrp_remarkled', 'length', 'max'=>200),
			array('lrp_no', 'length', 'max'=>5),
			array('lrp_court_name', 'length', 'max'=>60),
			array('lrp_court_type, lrp_corrupt', 'length', 'max'=>1),
			array('lrp_black_case, lrp_red_case, lrp_tmp_gaz_book, lrp_ejc_gaz_book, lrp_abs_gaz_book, lrp_abs_ejc_gaz_book, lrp_b_set_gaz_book, lrp_b_can_gaz_book, lrp_bkr_gaz_book, lrp_a_set_gaz_book, lrp_a_can_gaz_book, lrp_c_gaz_book, lrp_r_gaz_book', 'length', 'max'=>20),
			array('lrp_tmp_prot_dd, lrp_tmp_prot_mm, lrp_tmp_gaz_dd, lrp_tmp_gaz_mm, lrp_ejc_dd, lrp_ejc_mm, lrp_ejc_gaz_dd, lrp_ejc_gaz_mm, lrp_abs_prot_dd, lrp_abs_prot_mm, lrp_abs_gaz_dd, lrp_abs_gaz_mm, lrp_abs_due_dd, lrp_abs_due_mm, lrp_abs_req_dd, lrp_abs_req_mm, lrp_abs_ejc_dd, lrp_abs_ejc_mm, lrp_abs_ejc_gaz_dd, lrp_abs_ejc_gaz_mm, lrp_b_cou_set_dd, lrp_b_cou_set_mm, lrp_b_set_gaz_dd, lrp_b_set_gaz_mm, lrp_b_can_set_dd, lrp_b_can_set_mm, lrp_b_can_gaz_dd, lrp_b_can_gaz_mm, lrp_bkr_prot_dd, lrp_bkr_prot_mm, lrp_bkr_gaz_dd, lrp_bkr_gaz_mm, lrp_a_cou_set_dd, lrp_a_cou_set_mm, lrp_a_set_gaz_dd, lrp_a_set_gaz_mm, lrp_a_can_set_dd, lrp_a_can_set_mm, lrp_a_can_gaz_dd, lrp_a_can_gaz_mm, lrp_a_due_set_dd, lrp_a_due_set_mm, lrp_c_bkr_dd, lrp_c_bkr_mm, lrp_c_gaz_dd, lrp_c_gaz_mm, lrp_r_bkr_dd, lrp_r_bkr_mm, lrp_r_gaz_dd, lrp_r_gaz_mm, lrp_df_expire_dd, lrp_df_expire_mm, lrp_df_manage_dd, lrp_df_manage_mm, lrp_df_manage_ejc_dd, lrp_df_manage_ejc_mm, lrp_re_bkr_dd, lrp_re_bkr_mm, lrp_uacc_dd, lrp_uacc_mm, lrp_s_bkr_dd, lrp_s_bkr_mm, lrp_close_dd, lrp_close_mm, lrp_req_dd, lrp_req_mm, lrp_oth_dd, lrp_oth_mm', 'length', 'max'=>2),
			array('lrp_tmp_gaz_page, lrp_ejc_gaz_page, lrp_abs_gaz_page, lrp_abs_ejc_gaz_page, lrp_b_set_gaz_page, lrp_b_can_gaz_page, lrp_bkr_gaz_page, lrp_a_set_gaz_page, lrp_a_can_gaz_page, lrp_c_gaz_page, lrp_r_gaz_page', 'length', 'max'=>10),
			array('lrp_createby, lrp_updateby', 'length', 'max'=>100),
			array('lrp_lastupdate, lrp_remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lrp_id, lrp_responseCode, lrp_responseMessage, lrp_tws_id, lrp_recv_no, lrp_recv_yr, lrp_df_id, lrp_df_name, lrp_df_surname, lrp_no, lrp_court_name, lrp_court_type, lrp_black_case, lrp_black_yy, lrp_red_case, lrp_red_yy, lrp_plaintiff1, lrp_plaintiff2, lrp_plaintiff3, lrp_defendant1, lrp_defendant2, lrp_defendant3, lrp_case_capital, lrp_tmp_prot_dd, lrp_tmp_prot_mm, lrp_tmp_prot_yy, lrp_tmp_gaz_dd, lrp_tmp_gaz_mm, lrp_tmp_gaz_yy, lrp_tmp_gaz_book, lrp_tmp_gaz_part, lrp_tmp_gaz_page, lrp_ejc_dd, lrp_ejc_mm, lrp_ejc_yy, lrp_ejc_gaz_dd, lrp_ejc_gaz_mm, lrp_ejc_gaz_yy, lrp_ejc_gaz_book, lrp_ejc_gaz_part, lrp_ejc_gaz_page, lrp_abs_prot_dd, lrp_abs_prot_mm, lrp_abs_prot_yy, lrp_abs_gaz_dd, lrp_abs_gaz_mm, lrp_abs_gaz_yy, lrp_abs_gaz_book, lrp_abs_gaz_part, lrp_abs_gaz_page, lrp_abs_due_dd, lrp_abs_due_mm, lrp_abs_due_yy, lrp_abs_req_dd, lrp_abs_req_mm, lrp_abs_req_yy, lrp_abs_ejc_dd, lrp_abs_ejc_mm, lrp_abs_ejc_yy, lrp_abs_ejc_gaz_dd, lrp_abs_ejc_gaz_mm, lrp_abs_ejc_gaz_yy, lrp_abs_ejc_gaz_book, lrp_abs_ejc_gaz_part, lrp_abs_ejc_gaz_page, lrp_b_cou_set_dd, lrp_b_cou_set_mm, lrp_b_cou_set_yy, lrp_b_set_gaz_dd, lrp_b_set_gaz_mm, lrp_b_set_gaz_yy, lrp_b_set_gaz_book, lrp_b_set_gaz_part, lrp_b_set_gaz_page, lrp_b_can_set_dd, lrp_b_can_set_mm, lrp_b_can_set_yy, lrp_b_can_gaz_dd, lrp_b_can_gaz_mm, lrp_b_can_gaz_yy, lrp_b_can_gaz_book, lrp_b_can_gaz_part, lrp_b_can_gaz_page, lrp_bkr_prot_dd, lrp_bkr_prot_mm, lrp_bkr_prot_yy, lrp_bkr_gaz_dd, lrp_bkr_gaz_mm, lrp_bkr_gaz_yy, lrp_bkr_gaz_book, lrp_bkr_gaz_part, lrp_bkr_gaz_page, lrp_a_cou_set_dd, lrp_a_cou_set_mm, lrp_a_cou_set_yy, lrp_a_set_gaz_dd, lrp_a_set_gaz_mm, lrp_a_set_gaz_yy, lrp_a_set_gaz_book, lrp_a_set_gaz_part, lrp_a_set_gaz_page, lrp_a_can_set_dd, lrp_a_can_set_mm, lrp_a_can_set_yy, lrp_a_can_gaz_dd, lrp_a_can_gaz_mm, lrp_a_can_gaz_yy, lrp_a_can_gaz_book, lrp_a_can_gaz_part, lrp_a_can_gaz_page, lrp_a_due_set_dd, lrp_a_due_set_mm, lrp_a_due_set_yy, lrp_c_bkr_dd, lrp_c_bkr_mm, lrp_c_bkr_yy, lrp_c_gaz_dd, lrp_c_gaz_mm, lrp_c_gaz_yy, lrp_c_gaz_book, lrp_c_gaz_part, lrp_c_gaz_page, lrp_r_bkr_dd, lrp_r_bkr_mm, lrp_r_bkr_yy, lrp_r_gaz_dd, lrp_r_gaz_mm, lrp_r_gaz_yy, lrp_r_gaz_book, lrp_r_gaz_part, lrp_r_gaz_page, lrp_df_expire_dd, lrp_df_expire_mm, lrp_df_expire_yy, lrp_df_manage_dd, lrp_df_manage_mm, lrp_df_manage_yy, lrp_df_manage_ejc_dd, lrp_df_manage_ejc_mm, lrp_df_manage_ejc_yy, lrp_re_bkr_dd, lrp_re_bkr_mm, lrp_re_bkr_yy, lrp_uacc_dd, lrp_uacc_mm, lrp_uacc_yy, lrp_s_bkr_dd, lrp_s_bkr_mm, lrp_s_bkr_yy, lrp_close_dd, lrp_close_mm, lrp_close_yy, lrp_req_dd, lrp_req_mm, lrp_req_yy, lrp_oth_dd, lrp_oth_mm, lrp_oth_yy, lrp_remarkled, lrp_corrupt, lrp_lastupdate, lrp_createby, lrp_created, lrp_updateby, lrp_modified, lrp_remark, lrp_status', 'safe', 'on'=>'search'),
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
			'lrp_id' => 'Lrp',
			'lrp_responseCode' => 'Lrp Response Code',
			'lrp_responseMessage' => 'Lrp Response Message',
			'lrp_tws_id' => 'Lrp Tws',
			'lrp_recv_no' => 'Lrp Recv No',
			'lrp_recv_yr' => 'Lrp Recv Yr',
			'lrp_df_id' => 'Lrp Df',
			'lrp_df_name' => 'Lrp Df Name',
			'lrp_df_surname' => 'Lrp Df Surname',
			'lrp_no' => 'Lrp No',
			'lrp_court_name' => 'Lrp Court Name',
			'lrp_court_type' => 'Lrp Court Type',
			'lrp_black_case' => 'Lrp Black Case',
			'lrp_black_yy' => 'Lrp Black Yy',
			'lrp_red_case' => 'Lrp Red Case',
			'lrp_red_yy' => 'Lrp Red Yy',
			'lrp_plaintiff1' => 'Lrp Plaintiff1',
			'lrp_plaintiff2' => 'Lrp Plaintiff2',
			'lrp_plaintiff3' => 'Lrp Plaintiff3',
			'lrp_defendant1' => 'Lrp Defendant1',
			'lrp_defendant2' => 'Lrp Defendant2',
			'lrp_defendant3' => 'Lrp Defendant3',
			'lrp_case_capital' => 'Lrp Case Capital',
			'lrp_tmp_prot_dd' => 'Lrp Tmp Prot Dd',
			'lrp_tmp_prot_mm' => 'Lrp Tmp Prot Mm',
			'lrp_tmp_prot_yy' => 'Lrp Tmp Prot Yy',
			'lrp_tmp_gaz_dd' => 'Lrp Tmp Gaz Dd',
			'lrp_tmp_gaz_mm' => 'Lrp Tmp Gaz Mm',
			'lrp_tmp_gaz_yy' => 'Lrp Tmp Gaz Yy',
			'lrp_tmp_gaz_book' => 'Lrp Tmp Gaz Book',
			'lrp_tmp_gaz_part' => 'Lrp Tmp Gaz Part',
			'lrp_tmp_gaz_page' => 'Lrp Tmp Gaz Page',
			'lrp_ejc_dd' => 'Lrp Ejc Dd',
			'lrp_ejc_mm' => 'Lrp Ejc Mm',
			'lrp_ejc_yy' => 'Lrp Ejc Yy',
			'lrp_ejc_gaz_dd' => 'Lrp Ejc Gaz Dd',
			'lrp_ejc_gaz_mm' => 'Lrp Ejc Gaz Mm',
			'lrp_ejc_gaz_yy' => 'Lrp Ejc Gaz Yy',
			'lrp_ejc_gaz_book' => 'Lrp Ejc Gaz Book',
			'lrp_ejc_gaz_part' => 'Lrp Ejc Gaz Part',
			'lrp_ejc_gaz_page' => 'Lrp Ejc Gaz Page',
			'lrp_abs_prot_dd' => 'Lrp Abs Prot Dd',
			'lrp_abs_prot_mm' => 'Lrp Abs Prot Mm',
			'lrp_abs_prot_yy' => 'Lrp Abs Prot Yy',
			'lrp_abs_gaz_dd' => 'Lrp Abs Gaz Dd',
			'lrp_abs_gaz_mm' => 'Lrp Abs Gaz Mm',
			'lrp_abs_gaz_yy' => 'Lrp Abs Gaz Yy',
			'lrp_abs_gaz_book' => 'Lrp Abs Gaz Book',
			'lrp_abs_gaz_part' => 'Lrp Abs Gaz Part',
			'lrp_abs_gaz_page' => 'Lrp Abs Gaz Page',
			'lrp_abs_due_dd' => 'Lrp Abs Due Dd',
			'lrp_abs_due_mm' => 'Lrp Abs Due Mm',
			'lrp_abs_due_yy' => 'Lrp Abs Due Yy',
			'lrp_abs_req_dd' => 'Lrp Abs Req Dd',
			'lrp_abs_req_mm' => 'Lrp Abs Req Mm',
			'lrp_abs_req_yy' => 'Lrp Abs Req Yy',
			'lrp_abs_ejc_dd' => 'Lrp Abs Ejc Dd',
			'lrp_abs_ejc_mm' => 'Lrp Abs Ejc Mm',
			'lrp_abs_ejc_yy' => 'Lrp Abs Ejc Yy',
			'lrp_abs_ejc_gaz_dd' => 'Lrp Abs Ejc Gaz Dd',
			'lrp_abs_ejc_gaz_mm' => 'Lrp Abs Ejc Gaz Mm',
			'lrp_abs_ejc_gaz_yy' => 'Lrp Abs Ejc Gaz Yy',
			'lrp_abs_ejc_gaz_book' => 'Lrp Abs Ejc Gaz Book',
			'lrp_abs_ejc_gaz_part' => 'Lrp Abs Ejc Gaz Part',
			'lrp_abs_ejc_gaz_page' => 'Lrp Abs Ejc Gaz Page',
			'lrp_b_cou_set_dd' => 'Lrp B Cou Set Dd',
			'lrp_b_cou_set_mm' => 'Lrp B Cou Set Mm',
			'lrp_b_cou_set_yy' => 'Lrp B Cou Set Yy',
			'lrp_b_set_gaz_dd' => 'Lrp B Set Gaz Dd',
			'lrp_b_set_gaz_mm' => 'Lrp B Set Gaz Mm',
			'lrp_b_set_gaz_yy' => 'Lrp B Set Gaz Yy',
			'lrp_b_set_gaz_book' => 'Lrp B Set Gaz Book',
			'lrp_b_set_gaz_part' => 'Lrp B Set Gaz Part',
			'lrp_b_set_gaz_page' => 'Lrp B Set Gaz Page',
			'lrp_b_can_set_dd' => 'Lrp B Can Set Dd',
			'lrp_b_can_set_mm' => 'Lrp B Can Set Mm',
			'lrp_b_can_set_yy' => 'Lrp B Can Set Yy',
			'lrp_b_can_gaz_dd' => 'Lrp B Can Gaz Dd',
			'lrp_b_can_gaz_mm' => 'Lrp B Can Gaz Mm',
			'lrp_b_can_gaz_yy' => 'Lrp B Can Gaz Yy',
			'lrp_b_can_gaz_book' => 'Lrp B Can Gaz Book',
			'lrp_b_can_gaz_part' => 'Lrp B Can Gaz Part',
			'lrp_b_can_gaz_page' => 'Lrp B Can Gaz Page',
			'lrp_bkr_prot_dd' => 'Lrp Bkr Prot Dd',
			'lrp_bkr_prot_mm' => 'Lrp Bkr Prot Mm',
			'lrp_bkr_prot_yy' => 'Lrp Bkr Prot Yy',
			'lrp_bkr_gaz_dd' => 'Lrp Bkr Gaz Dd',
			'lrp_bkr_gaz_mm' => 'Lrp Bkr Gaz Mm',
			'lrp_bkr_gaz_yy' => 'Lrp Bkr Gaz Yy',
			'lrp_bkr_gaz_book' => 'Lrp Bkr Gaz Book',
			'lrp_bkr_gaz_part' => 'Lrp Bkr Gaz Part',
			'lrp_bkr_gaz_page' => 'Lrp Bkr Gaz Page',
			'lrp_a_cou_set_dd' => 'Lrp A Cou Set Dd',
			'lrp_a_cou_set_mm' => 'Lrp A Cou Set Mm',
			'lrp_a_cou_set_yy' => 'Lrp A Cou Set Yy',
			'lrp_a_set_gaz_dd' => 'Lrp A Set Gaz Dd',
			'lrp_a_set_gaz_mm' => 'Lrp A Set Gaz Mm',
			'lrp_a_set_gaz_yy' => 'Lrp A Set Gaz Yy',
			'lrp_a_set_gaz_book' => 'Lrp A Set Gaz Book',
			'lrp_a_set_gaz_part' => 'Lrp A Set Gaz Part',
			'lrp_a_set_gaz_page' => 'Lrp A Set Gaz Page',
			'lrp_a_can_set_dd' => 'Lrp A Can Set Dd',
			'lrp_a_can_set_mm' => 'Lrp A Can Set Mm',
			'lrp_a_can_set_yy' => 'Lrp A Can Set Yy',
			'lrp_a_can_gaz_dd' => 'Lrp A Can Gaz Dd',
			'lrp_a_can_gaz_mm' => 'Lrp A Can Gaz Mm',
			'lrp_a_can_gaz_yy' => 'Lrp A Can Gaz Yy',
			'lrp_a_can_gaz_book' => 'Lrp A Can Gaz Book',
			'lrp_a_can_gaz_part' => 'Lrp A Can Gaz Part',
			'lrp_a_can_gaz_page' => 'Lrp A Can Gaz Page',
			'lrp_a_due_set_dd' => 'Lrp A Due Set Dd',
			'lrp_a_due_set_mm' => 'Lrp A Due Set Mm',
			'lrp_a_due_set_yy' => 'Lrp A Due Set Yy',
			'lrp_c_bkr_dd' => 'Lrp C Bkr Dd',
			'lrp_c_bkr_mm' => 'Lrp C Bkr Mm',
			'lrp_c_bkr_yy' => 'Lrp C Bkr Yy',
			'lrp_c_gaz_dd' => 'Lrp C Gaz Dd',
			'lrp_c_gaz_mm' => 'Lrp C Gaz Mm',
			'lrp_c_gaz_yy' => 'Lrp C Gaz Yy',
			'lrp_c_gaz_book' => 'Lrp C Gaz Book',
			'lrp_c_gaz_part' => 'Lrp C Gaz Part',
			'lrp_c_gaz_page' => 'Lrp C Gaz Page',
			'lrp_r_bkr_dd' => 'Lrp R Bkr Dd',
			'lrp_r_bkr_mm' => 'Lrp R Bkr Mm',
			'lrp_r_bkr_yy' => 'Lrp R Bkr Yy',
			'lrp_r_gaz_dd' => 'Lrp R Gaz Dd',
			'lrp_r_gaz_mm' => 'Lrp R Gaz Mm',
			'lrp_r_gaz_yy' => 'Lrp R Gaz Yy',
			'lrp_r_gaz_book' => 'Lrp R Gaz Book',
			'lrp_r_gaz_part' => 'Lrp R Gaz Part',
			'lrp_r_gaz_page' => 'Lrp R Gaz Page',
			'lrp_df_expire_dd' => 'Lrp Df Expire Dd',
			'lrp_df_expire_mm' => 'Lrp Df Expire Mm',
			'lrp_df_expire_yy' => 'Lrp Df Expire Yy',
			'lrp_df_manage_dd' => 'Lrp Df Manage Dd',
			'lrp_df_manage_mm' => 'Lrp Df Manage Mm',
			'lrp_df_manage_yy' => 'Lrp Df Manage Yy',
			'lrp_df_manage_ejc_dd' => 'Lrp Df Manage Ejc Dd',
			'lrp_df_manage_ejc_mm' => 'Lrp Df Manage Ejc Mm',
			'lrp_df_manage_ejc_yy' => 'Lrp Df Manage Ejc Yy',
			'lrp_re_bkr_dd' => 'Lrp Re Bkr Dd',
			'lrp_re_bkr_mm' => 'Lrp Re Bkr Mm',
			'lrp_re_bkr_yy' => 'Lrp Re Bkr Yy',
			'lrp_uacc_dd' => 'Lrp Uacc Dd',
			'lrp_uacc_mm' => 'Lrp Uacc Mm',
			'lrp_uacc_yy' => 'Lrp Uacc Yy',
			'lrp_s_bkr_dd' => 'Lrp S Bkr Dd',
			'lrp_s_bkr_mm' => 'Lrp S Bkr Mm',
			'lrp_s_bkr_yy' => 'Lrp S Bkr Yy',
			'lrp_close_dd' => 'Lrp Close Dd',
			'lrp_close_mm' => 'Lrp Close Mm',
			'lrp_close_yy' => 'Lrp Close Yy',
			'lrp_req_dd' => 'Lrp Req Dd',
			'lrp_req_mm' => 'Lrp Req Mm',
			'lrp_req_yy' => 'Lrp Req Yy',
			'lrp_oth_dd' => 'Lrp Oth Dd',
			'lrp_oth_mm' => 'Lrp Oth Mm',
			'lrp_oth_yy' => 'Lrp Oth Yy',
			'lrp_remarkled' => 'Lrp Remarkled',
			'lrp_corrupt' => 'Lrp Corrupt',
			'lrp_lastupdate' => 'Lrp Lastupdate',
			'lrp_createby' => 'Lrp Createby',
			'lrp_created' => 'Lrp Created',
			'lrp_updateby' => 'Lrp Updateby',
			'lrp_modified' => 'Lrp Modified',
			'lrp_remark' => 'Lrp Remark',
			'lrp_status' => 'Lrp Status',
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

		$criteria->compare('lrp_id',$this->lrp_id);
		$criteria->compare('lrp_responseCode',$this->lrp_responseCode,true);
		$criteria->compare('lrp_responseMessage',$this->lrp_responseMessage,true);
		$criteria->compare('lrp_tws_id',$this->lrp_tws_id);
		$criteria->compare('lrp_recv_no',$this->lrp_recv_no,true);
		$criteria->compare('lrp_recv_yr',$this->lrp_recv_yr,true);
		$criteria->compare('lrp_df_id',$this->lrp_df_id,true);
		$criteria->compare('lrp_df_name',$this->lrp_df_name,true);
		$criteria->compare('lrp_df_surname',$this->lrp_df_surname,true);
		$criteria->compare('lrp_no',$this->lrp_no,true);
		$criteria->compare('lrp_court_name',$this->lrp_court_name,true);
		$criteria->compare('lrp_court_type',$this->lrp_court_type,true);
		$criteria->compare('lrp_black_case',$this->lrp_black_case,true);
		$criteria->compare('lrp_black_yy',$this->lrp_black_yy,true);
		$criteria->compare('lrp_red_case',$this->lrp_red_case,true);
		$criteria->compare('lrp_red_yy',$this->lrp_red_yy,true);
		$criteria->compare('lrp_plaintiff1',$this->lrp_plaintiff1,true);
		$criteria->compare('lrp_plaintiff2',$this->lrp_plaintiff2,true);
		$criteria->compare('lrp_plaintiff3',$this->lrp_plaintiff3,true);
		$criteria->compare('lrp_defendant1',$this->lrp_defendant1,true);
		$criteria->compare('lrp_defendant2',$this->lrp_defendant2,true);
		$criteria->compare('lrp_defendant3',$this->lrp_defendant3,true);
		$criteria->compare('lrp_case_capital',$this->lrp_case_capital);
		$criteria->compare('lrp_tmp_prot_dd',$this->lrp_tmp_prot_dd,true);
		$criteria->compare('lrp_tmp_prot_mm',$this->lrp_tmp_prot_mm,true);
		$criteria->compare('lrp_tmp_prot_yy',$this->lrp_tmp_prot_yy,true);
		$criteria->compare('lrp_tmp_gaz_dd',$this->lrp_tmp_gaz_dd,true);
		$criteria->compare('lrp_tmp_gaz_mm',$this->lrp_tmp_gaz_mm,true);
		$criteria->compare('lrp_tmp_gaz_yy',$this->lrp_tmp_gaz_yy,true);
		$criteria->compare('lrp_tmp_gaz_book',$this->lrp_tmp_gaz_book,true);
		$criteria->compare('lrp_tmp_gaz_part',$this->lrp_tmp_gaz_part,true);
		$criteria->compare('lrp_tmp_gaz_page',$this->lrp_tmp_gaz_page,true);
		$criteria->compare('lrp_ejc_dd',$this->lrp_ejc_dd,true);
		$criteria->compare('lrp_ejc_mm',$this->lrp_ejc_mm,true);
		$criteria->compare('lrp_ejc_yy',$this->lrp_ejc_yy,true);
		$criteria->compare('lrp_ejc_gaz_dd',$this->lrp_ejc_gaz_dd,true);
		$criteria->compare('lrp_ejc_gaz_mm',$this->lrp_ejc_gaz_mm,true);
		$criteria->compare('lrp_ejc_gaz_yy',$this->lrp_ejc_gaz_yy,true);
		$criteria->compare('lrp_ejc_gaz_book',$this->lrp_ejc_gaz_book,true);
		$criteria->compare('lrp_ejc_gaz_part',$this->lrp_ejc_gaz_part,true);
		$criteria->compare('lrp_ejc_gaz_page',$this->lrp_ejc_gaz_page,true);
		$criteria->compare('lrp_abs_prot_dd',$this->lrp_abs_prot_dd,true);
		$criteria->compare('lrp_abs_prot_mm',$this->lrp_abs_prot_mm,true);
		$criteria->compare('lrp_abs_prot_yy',$this->lrp_abs_prot_yy,true);
		$criteria->compare('lrp_abs_gaz_dd',$this->lrp_abs_gaz_dd,true);
		$criteria->compare('lrp_abs_gaz_mm',$this->lrp_abs_gaz_mm,true);
		$criteria->compare('lrp_abs_gaz_yy',$this->lrp_abs_gaz_yy,true);
		$criteria->compare('lrp_abs_gaz_book',$this->lrp_abs_gaz_book,true);
		$criteria->compare('lrp_abs_gaz_part',$this->lrp_abs_gaz_part,true);
		$criteria->compare('lrp_abs_gaz_page',$this->lrp_abs_gaz_page,true);
		$criteria->compare('lrp_abs_due_dd',$this->lrp_abs_due_dd,true);
		$criteria->compare('lrp_abs_due_mm',$this->lrp_abs_due_mm,true);
		$criteria->compare('lrp_abs_due_yy',$this->lrp_abs_due_yy,true);
		$criteria->compare('lrp_abs_req_dd',$this->lrp_abs_req_dd,true);
		$criteria->compare('lrp_abs_req_mm',$this->lrp_abs_req_mm,true);
		$criteria->compare('lrp_abs_req_yy',$this->lrp_abs_req_yy,true);
		$criteria->compare('lrp_abs_ejc_dd',$this->lrp_abs_ejc_dd,true);
		$criteria->compare('lrp_abs_ejc_mm',$this->lrp_abs_ejc_mm,true);
		$criteria->compare('lrp_abs_ejc_yy',$this->lrp_abs_ejc_yy,true);
		$criteria->compare('lrp_abs_ejc_gaz_dd',$this->lrp_abs_ejc_gaz_dd,true);
		$criteria->compare('lrp_abs_ejc_gaz_mm',$this->lrp_abs_ejc_gaz_mm,true);
		$criteria->compare('lrp_abs_ejc_gaz_yy',$this->lrp_abs_ejc_gaz_yy,true);
		$criteria->compare('lrp_abs_ejc_gaz_book',$this->lrp_abs_ejc_gaz_book,true);
		$criteria->compare('lrp_abs_ejc_gaz_part',$this->lrp_abs_ejc_gaz_part,true);
		$criteria->compare('lrp_abs_ejc_gaz_page',$this->lrp_abs_ejc_gaz_page,true);
		$criteria->compare('lrp_b_cou_set_dd',$this->lrp_b_cou_set_dd,true);
		$criteria->compare('lrp_b_cou_set_mm',$this->lrp_b_cou_set_mm,true);
		$criteria->compare('lrp_b_cou_set_yy',$this->lrp_b_cou_set_yy,true);
		$criteria->compare('lrp_b_set_gaz_dd',$this->lrp_b_set_gaz_dd,true);
		$criteria->compare('lrp_b_set_gaz_mm',$this->lrp_b_set_gaz_mm,true);
		$criteria->compare('lrp_b_set_gaz_yy',$this->lrp_b_set_gaz_yy,true);
		$criteria->compare('lrp_b_set_gaz_book',$this->lrp_b_set_gaz_book,true);
		$criteria->compare('lrp_b_set_gaz_part',$this->lrp_b_set_gaz_part,true);
		$criteria->compare('lrp_b_set_gaz_page',$this->lrp_b_set_gaz_page,true);
		$criteria->compare('lrp_b_can_set_dd',$this->lrp_b_can_set_dd,true);
		$criteria->compare('lrp_b_can_set_mm',$this->lrp_b_can_set_mm,true);
		$criteria->compare('lrp_b_can_set_yy',$this->lrp_b_can_set_yy,true);
		$criteria->compare('lrp_b_can_gaz_dd',$this->lrp_b_can_gaz_dd,true);
		$criteria->compare('lrp_b_can_gaz_mm',$this->lrp_b_can_gaz_mm,true);
		$criteria->compare('lrp_b_can_gaz_yy',$this->lrp_b_can_gaz_yy,true);
		$criteria->compare('lrp_b_can_gaz_book',$this->lrp_b_can_gaz_book,true);
		$criteria->compare('lrp_b_can_gaz_part',$this->lrp_b_can_gaz_part,true);
		$criteria->compare('lrp_b_can_gaz_page',$this->lrp_b_can_gaz_page,true);
		$criteria->compare('lrp_bkr_prot_dd',$this->lrp_bkr_prot_dd,true);
		$criteria->compare('lrp_bkr_prot_mm',$this->lrp_bkr_prot_mm,true);
		$criteria->compare('lrp_bkr_prot_yy',$this->lrp_bkr_prot_yy,true);
		$criteria->compare('lrp_bkr_gaz_dd',$this->lrp_bkr_gaz_dd,true);
		$criteria->compare('lrp_bkr_gaz_mm',$this->lrp_bkr_gaz_mm,true);
		$criteria->compare('lrp_bkr_gaz_yy',$this->lrp_bkr_gaz_yy,true);
		$criteria->compare('lrp_bkr_gaz_book',$this->lrp_bkr_gaz_book,true);
		$criteria->compare('lrp_bkr_gaz_part',$this->lrp_bkr_gaz_part,true);
		$criteria->compare('lrp_bkr_gaz_page',$this->lrp_bkr_gaz_page,true);
		$criteria->compare('lrp_a_cou_set_dd',$this->lrp_a_cou_set_dd,true);
		$criteria->compare('lrp_a_cou_set_mm',$this->lrp_a_cou_set_mm,true);
		$criteria->compare('lrp_a_cou_set_yy',$this->lrp_a_cou_set_yy,true);
		$criteria->compare('lrp_a_set_gaz_dd',$this->lrp_a_set_gaz_dd,true);
		$criteria->compare('lrp_a_set_gaz_mm',$this->lrp_a_set_gaz_mm,true);
		$criteria->compare('lrp_a_set_gaz_yy',$this->lrp_a_set_gaz_yy,true);
		$criteria->compare('lrp_a_set_gaz_book',$this->lrp_a_set_gaz_book,true);
		$criteria->compare('lrp_a_set_gaz_part',$this->lrp_a_set_gaz_part,true);
		$criteria->compare('lrp_a_set_gaz_page',$this->lrp_a_set_gaz_page,true);
		$criteria->compare('lrp_a_can_set_dd',$this->lrp_a_can_set_dd,true);
		$criteria->compare('lrp_a_can_set_mm',$this->lrp_a_can_set_mm,true);
		$criteria->compare('lrp_a_can_set_yy',$this->lrp_a_can_set_yy,true);
		$criteria->compare('lrp_a_can_gaz_dd',$this->lrp_a_can_gaz_dd,true);
		$criteria->compare('lrp_a_can_gaz_mm',$this->lrp_a_can_gaz_mm,true);
		$criteria->compare('lrp_a_can_gaz_yy',$this->lrp_a_can_gaz_yy,true);
		$criteria->compare('lrp_a_can_gaz_book',$this->lrp_a_can_gaz_book,true);
		$criteria->compare('lrp_a_can_gaz_part',$this->lrp_a_can_gaz_part,true);
		$criteria->compare('lrp_a_can_gaz_page',$this->lrp_a_can_gaz_page,true);
		$criteria->compare('lrp_a_due_set_dd',$this->lrp_a_due_set_dd,true);
		$criteria->compare('lrp_a_due_set_mm',$this->lrp_a_due_set_mm,true);
		$criteria->compare('lrp_a_due_set_yy',$this->lrp_a_due_set_yy,true);
		$criteria->compare('lrp_c_bkr_dd',$this->lrp_c_bkr_dd,true);
		$criteria->compare('lrp_c_bkr_mm',$this->lrp_c_bkr_mm,true);
		$criteria->compare('lrp_c_bkr_yy',$this->lrp_c_bkr_yy,true);
		$criteria->compare('lrp_c_gaz_dd',$this->lrp_c_gaz_dd,true);
		$criteria->compare('lrp_c_gaz_mm',$this->lrp_c_gaz_mm,true);
		$criteria->compare('lrp_c_gaz_yy',$this->lrp_c_gaz_yy,true);
		$criteria->compare('lrp_c_gaz_book',$this->lrp_c_gaz_book,true);
		$criteria->compare('lrp_c_gaz_part',$this->lrp_c_gaz_part,true);
		$criteria->compare('lrp_c_gaz_page',$this->lrp_c_gaz_page,true);
		$criteria->compare('lrp_r_bkr_dd',$this->lrp_r_bkr_dd,true);
		$criteria->compare('lrp_r_bkr_mm',$this->lrp_r_bkr_mm,true);
		$criteria->compare('lrp_r_bkr_yy',$this->lrp_r_bkr_yy,true);
		$criteria->compare('lrp_r_gaz_dd',$this->lrp_r_gaz_dd,true);
		$criteria->compare('lrp_r_gaz_mm',$this->lrp_r_gaz_mm,true);
		$criteria->compare('lrp_r_gaz_yy',$this->lrp_r_gaz_yy,true);
		$criteria->compare('lrp_r_gaz_book',$this->lrp_r_gaz_book,true);
		$criteria->compare('lrp_r_gaz_part',$this->lrp_r_gaz_part,true);
		$criteria->compare('lrp_r_gaz_page',$this->lrp_r_gaz_page,true);
		$criteria->compare('lrp_df_expire_dd',$this->lrp_df_expire_dd,true);
		$criteria->compare('lrp_df_expire_mm',$this->lrp_df_expire_mm,true);
		$criteria->compare('lrp_df_expire_yy',$this->lrp_df_expire_yy,true);
		$criteria->compare('lrp_df_manage_dd',$this->lrp_df_manage_dd,true);
		$criteria->compare('lrp_df_manage_mm',$this->lrp_df_manage_mm,true);
		$criteria->compare('lrp_df_manage_yy',$this->lrp_df_manage_yy,true);
		$criteria->compare('lrp_df_manage_ejc_dd',$this->lrp_df_manage_ejc_dd,true);
		$criteria->compare('lrp_df_manage_ejc_mm',$this->lrp_df_manage_ejc_mm,true);
		$criteria->compare('lrp_df_manage_ejc_yy',$this->lrp_df_manage_ejc_yy,true);
		$criteria->compare('lrp_re_bkr_dd',$this->lrp_re_bkr_dd,true);
		$criteria->compare('lrp_re_bkr_mm',$this->lrp_re_bkr_mm,true);
		$criteria->compare('lrp_re_bkr_yy',$this->lrp_re_bkr_yy,true);
		$criteria->compare('lrp_uacc_dd',$this->lrp_uacc_dd,true);
		$criteria->compare('lrp_uacc_mm',$this->lrp_uacc_mm,true);
		$criteria->compare('lrp_uacc_yy',$this->lrp_uacc_yy,true);
		$criteria->compare('lrp_s_bkr_dd',$this->lrp_s_bkr_dd,true);
		$criteria->compare('lrp_s_bkr_mm',$this->lrp_s_bkr_mm,true);
		$criteria->compare('lrp_s_bkr_yy',$this->lrp_s_bkr_yy,true);
		$criteria->compare('lrp_close_dd',$this->lrp_close_dd,true);
		$criteria->compare('lrp_close_mm',$this->lrp_close_mm,true);
		$criteria->compare('lrp_close_yy',$this->lrp_close_yy,true);
		$criteria->compare('lrp_req_dd',$this->lrp_req_dd,true);
		$criteria->compare('lrp_req_mm',$this->lrp_req_mm,true);
		$criteria->compare('lrp_req_yy',$this->lrp_req_yy,true);
		$criteria->compare('lrp_oth_dd',$this->lrp_oth_dd,true);
		$criteria->compare('lrp_oth_mm',$this->lrp_oth_mm,true);
		$criteria->compare('lrp_oth_yy',$this->lrp_oth_yy,true);
		$criteria->compare('lrp_remarkled',$this->lrp_remarkled,true);
		$criteria->compare('lrp_corrupt',$this->lrp_corrupt,true);
		$criteria->compare('lrp_lastupdate',$this->lrp_lastupdate,true);
		$criteria->compare('lrp_createby',$this->lrp_createby,true);
		$criteria->compare('lrp_created',$this->lrp_created,true);
		$criteria->compare('lrp_updateby',$this->lrp_updateby,true);
		$criteria->compare('lrp_modified',$this->lrp_modified,true);
		$criteria->compare('lrp_remark',$this->lrp_remark,true);
		$criteria->compare('lrp_status',$this->lrp_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}