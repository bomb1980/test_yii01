<?php
class EgaController extends Controller{
    public function actionCallegaservice()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************

                                ini_set('memory_limit', '-1');

				$action = $_POST['action'];
				$txt1 = $_POST['txt1'];
				$txt2 = $_POST['txt2'];

				//echo "{$action} , {$txt1}, {$txt2}";
				$data1 = array('action' => $action, 'txt1' => $txt1, 'txt2' => $txt2);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/callegaservice', $data1);

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
}

?>
