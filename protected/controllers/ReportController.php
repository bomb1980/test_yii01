<?php
class ReportController extends Controller{
    /************************************************************************************************* */
	public function actionCallshowrptetp2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}
				//echo $bctid;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->render('/site/reportpages/reportetp2', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

    
    /************************************************************************************************** */
    public function actionCallsubrptetpsum2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$d1 = $_POST['d1'];
				$d2 = $_POST['d2'];
				$sso1 = $_POST['sso1'];
				$bct = $_POST['bct'];
				$bc = $_POST['bc'];
				//$ssos2 = $_POST['ssos2'];

				//formatdate
				$d1d = date_create($d1)->format('d');
				$d1m = date_create($d1)->format('m');
				$d1y = date_create($d1)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d1f1 = $d1y . "-" . $d1m . "-" . $d1d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d1 = date_create($d1f1)->format('Y-m-d');

				//formatdate
				$d2d = date_create($d2)->format('d');
				$d2m = date_create($d2)->format('m');
				$d2y = date_create($d2)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d2f2 = $d2y . "-" . $d2m . "-" . $d2d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d2 = date_create($d2f2)->format('Y-m-d');

				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($sso1 == '0') {
					$sso1t = "ทั่วประเทศ";
				} else if ($sso1 == '1050') {
					$sso1t = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $sso1));
					$bcn = $bcr->name;
					$sso1t = $bcn;
				}

				//echo "$action,$d1,$d2,$sso1,$bct,$bc,$sso1t,$ssos2";exit();


				$data1 = array('action' => $action, 'd1' => $d1, 'd2' => $d2, 'sso1' => $sso1, 'bct' => $bct, 'bc' => $bc, 'sso1t' => $sso1t);
				//var_dump($data1);
				//exit();

				$this->layout = 'nolayout';
				$this->pageTitle = 'report - ' . $sso1t;
				$this->render('/site/reportpages/reportsetp1subsum2', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

    public function actionCallshowrptetpsum2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}
				//echo $bctid;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->render('/site/reportpages/reportetp2', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

    public function downloadpdfdga()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				//$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				//$this->layout='nolayout';
				//$this->pageTitle='WPD - Report ';
				//$this->render('/site/searchpages/dgafinancial1'); //, $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		} //if
	} //function 

    public function actionCallsubrptetp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$d1 = $_POST['d1'];
				$d2 = $_POST['d2'];
				$sso1 = $_POST['sso1'];
				$bct = $_POST['bct'];
				$bc = $_POST['bc'];
				$ssos2 = $_POST['ssos2'];

				//formatdate
				$d1d = date_create($d1)->format('d');
				$d1m = date_create($d1)->format('m');
				$d1y = date_create($d1)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d1f1 = $d1y . "-" . $d1m . "-" . $d1d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d1 = date_create($d1f1)->format('Y-m-d');

				//formatdate
				$d2d = date_create($d2)->format('d');
				$d2m = date_create($d2)->format('m');
				$d2y = date_create($d2)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d2f2 = $d2y . "-" . $d2m . "-" . $d2d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d2 = date_create($d2f2)->format('Y-m-d');

				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($sso1 == '0') {
					$sso1t = "ทั่วประเทศ";
				} else if ($sso1 == '1050') {
					$sso1t = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $sso1));
					$bcn = $bcr->name;
					$sso1t = $bcn;
				}

				//echo "$action,$d1,$d2,$sso1,$bct,$bc,$sso1t,$ssos2";



				$data1 = array('action' => $action, 'd1' => $d1, 'd2' => $d2, 'sso1' => $sso1, 'bct' => $bct, 'bc' => $bc, 'sso1t' => $sso1t, 'ssos2' => $ssos2);
				//var_dump($data1);
				//exit();

				$this->layout = 'nolayout';
				$this->pageTitle = 'report - ' . $sso1t;
				$this->render('/site/reportpages/reportsetp1sub', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

    public function actionCallshowrptetp()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}
				//echo $bctid;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->render('/site/reportpages/reportetp', $data1);
				//*********************************************************	
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function

    public function actionCallshowrptled33()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$lrc_id = $_GET['lrc_id'];
				$lrc_accno = $_GET['lrc_accno'];
				$lrc_registernumber = $_GET['lrc_registernumber'];
				//echo "{$lrc_id},{$lrc_accno}";exit;

				//ค้นหาชื่อบริษัท
				$mrc = LedriskcropTb::model()->findByAttributes(array('lrc_registernumber' => $lrc_registernumber));
				if ($mrc) {
					$lrc_registername = $mrc->lrc_registername;
				} else {
					$lrc_registername = "-";
				}

				//ค้นหาชื่อ user
				$musr = Users::model()->findByAttributes(array('username' => Yii::app()->user->username));
				if ($musr) {
					$firstname = $musr->firstname;
					$lastname = $musr->lastname;
					$address = $musr->address;
					$username = $musr->username;

					$usrprint = $firstname . "  " . $lastname . " , " . $address . " , " . $username;
				} else {
					$usrprint = "-";
				}



				$data1 = array('lrc_id' => $lrc_id, 'lrc_accno' => $lrc_accno, 'lrc_registernumber' => $lrc_registernumber, 'lrc_registername' => $lrc_registername, 'usrprint' => $usrprint);

				$this->layout = 'nolayout';
				$this->pageTitle = 'report';
				$this->render('/site/reportpages/reportsled33sub', $data1);

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function


    public function actionCallshowrptled31()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}
				//echo $bctid;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->render('/site/reportpages/reportled31', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallsubrptled31()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$d1 = $_POST['d1'];
				$d2 = $_POST['d2'];
				$sso1 = $_POST['sso1'];
				$bct = $_POST['bct'];
				$bc = $_POST['bc'];
				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($sso1 == '0') {
					$sso1t = "ทั่วประเทศ";
				} else if ($sso1 == '1050') {
					$sso1t = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $sso1));
					$bcn = $bcr->name;
					$sso1t = $bcn;
				}

				$data1 = array('action' => $action, 'd1' => $d1, 'd2' => $d2, 'sso1' => $sso1, 'bct' => $bct, 'bc' => $bc, 'sso1t' => $sso1t);
				$this->layout = 'nolayout';
				$this->pageTitle = 'report - ' . $sso1t;
				$this->render('/site/reportpages/reportsled31sub', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallshowrptled32()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$ssobranch_code = $_GET['ssobranch_code'];
				//$d1 = $_GET['d1'];
				//$d2 = $_GET['d2'];
				//echo "{$ssobranch_code}";exit;
				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($ssobranch_code == '0') {
					$ssobranch_codet = "ทั่วประเทศ";
				} else if ($ssobranch_code == '1050') {
					$ssobranch_codet = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $ssobranch_code));
					$bcn = $bcr->name;
					$ssobranch_codet = $bcn;
				}

				$data1 = array('ssobranch_code' => $ssobranch_code, 'ssobranch_codet' => $ssobranch_codet);
				$this->layout = 'nolayout';
				$this->pageTitle = 'report - LED';
				$this->render('/site/reportpages/reportsled32sub', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallshowrpt31()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->address) {
					$user_bc = Yii::app()->user->address;
				}

				if ($user_bc == '1050') {
					$bctid = "1";
				} else {
					//ค้นหาประเภทของ barch_code
					$bct = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $user_bc));
					$bctid = $bct->ssobranch_type_id;
				}
				//echo $bctid;exit;
				$data1 = array('bc' => $user_bc, 'bct' => $bctid);
				$this->layout = 'nolayout';
				$this->pageTitle = 'WPD - Report ';
				$this->render('/site/reportpages/report31', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

    public function actionCallshowrpt1()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$this->layout = 'nolayout';
				$this->render('/site/reportpages/printformexcel2');
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}


    public function actionCallshowrpt()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				//echo "{$action} <br>";
				$data1 = array('action' => $action);
				$this->layout = 'nolayout';
				$this->render('/site/reportpages/printformexcel2', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}

	public function actionCallsubrpt()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$slv = $_POST['slv'];
				//echo "{$action}, {$slv} <br>";
				$data1 = array('action' => $action, 'slv' => $slv);
				$this->layout = 'nolayout';
				$this->render('/site/reportpages/reportpage1', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}


	public function actionCallsubrptetp2()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$action = $_POST['action'];
				$d1 = $_POST['d1'];
				$d2 = $_POST['d2'];
				$sso1 = $_POST['sso1'];
				$bct = $_POST['bct'];
				$bc = $_POST['bc'];
				//$ssos2 = $_POST['ssos2'];

				//formatdate
				$d1d = date_create($d1)->format('d');
				$d1m = date_create($d1)->format('m');
				$d1y = date_create($d1)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d1f1 = $d1y . "-" . $d1m . "-" . $d1d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d1 = date_create($d1f1)->format('Y-m-d');

				//formatdate
				$d2d = date_create($d2)->format('d');
				$d2m = date_create($d2)->format('m');
				$d2y = date_create($d2)->format('Y'); //-543;
				//$d1t = date_create($d1)->format('H:i:s');
				$d2f2 = $d2y . "-" . $d2m . "-" . $d2d; // " " . $d1t;
				//$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
				$d2 = date_create($d2f2)->format('Y-m-d');

				//ค้นหาชื่อ สปส รับผิดชอบ
				if ($sso1 == '0') {
					$sso1t = "ทั่วประเทศ";
				} else if ($sso1 == '1050') {
					$sso1t = "สำนักบริหารเทคโนโลยีสารสนเทศ";
				} else {
					$bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $sso1));
					$bcn = $bcr->name;
					$sso1t = $bcn;
				}

				//echo "$action,$d1,$d2,$sso1,$bct,$bc,$sso1t,$ssos2";



				$data1 = array('action' => $action, 'd1' => $d1, 'd2' => $d2, 'sso1' => $sso1, 'bct' => $bct, 'bc' => $bc, 'sso1t' => $sso1t);
				//var_dump($data1);
				//exit();

				$this->layout = 'nolayout';
				$this->pageTitle = 'report - ' . $sso1t;
				$this->render('/site/reportpages/reportsetp1sub2', $data1);
				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	} //function
    
   

    /************************************************************************************************* */
}
