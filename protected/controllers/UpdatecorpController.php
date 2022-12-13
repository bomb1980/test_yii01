<?php
class UpdatecorpController extends Controller
{
	public function actionIndex()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************

				ini_set('memory_limit', '-1');

				//$this->layout = 'nolayout';
				//$this->render('/site/searchpages/callegaservice', $data1);
				$this->render('index');
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

	public function actionSavefile()
	{

		if (Yii::app()->request->isPostRequest) {
			ini_set('memory_limit', '2048M');

			$csvMimes = array(
				'text/x-comma-separated-values',
				'text/comma-separated-values',
				'application/octet-stream',
				'application/vnd.ms-excel',
				'application/x-csv',
				'text/x-csv',
				'text/csv',
				'application/csv',
				'application/excel',
				'application/vnd.msexcel',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			);

			$csvMimes = array(
				'text/plain'
			);
			if (!empty($_FILES['uploadBtn']['name']) && in_array($_FILES['uploadBtn']['type'], $csvMimes)) {

				//$uploads_dir = Yii::app()->basePath . '/views/partial/' . "d80_2.txt";
				$uploads_dir = Yii::app()->basePath . '/runtime';

				isset( $_FILES['uploadBtn']['tmp_name'] ) ? $tmp_name = $_FILES['uploadBtn']['tmp_name'] : $tmp_name = "";
				isset( $_FILES['uploadBtn']['name'] ) ? $name = $_FILES['uploadBtn']['name'] : $name = "";
				if( !empty( $tmp_name ) && !empty( $name ) ) {
					$name = "d80_2.txt";
					if( move_uploaded_file($tmp_name, "$uploads_dir/$name") ){
						echo json_encode(array('status' => 'success', 'msg' => '',));
					}else{
						echo json_encode(array('status' => 'error', 'msg' => 'อัพโหลดไม่สำเร็จ',));
					}
				}

			}
		}
	}
}
