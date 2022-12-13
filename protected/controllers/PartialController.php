<?php

class PartialController extends Controller
{
	function init()
	{
		//parent::chkLogin();  //Check Sigle Sing-On Module
		$this->layout = 'main_empty';
	}

	public function actionIndex()
	{
		$this->render('index');
	}



	public function actionSync_ldap()
	{
		if (Yii::app()->request->isPostRequest) {
			$this->renderPartial('sync_ldap');
		}
	}
	public function actionChecker_sync_ldap()
	{
		//if (Yii::app()->request->isPostRequest) {
		$this->renderPartial('checker_sync_ldap', array('rand' => $_GET['rand']));
		//}
	}
	public function actionProcess_sync_ldap()
	{
		$this->renderPartial('process_sync_ldap');
	}

	public function actionSync_datapaging()
	{
		if (Yii::app()->request->isPostRequest) {
			$this->renderPartial('sync_datapaging');
		}
	}


	public function actionProcess_sync_datapaging()
	{
		$this->renderPartial('process_sync_datapaging');
	}
	public function actionChecker_sync_ldappaging()
	{
		//if (Yii::app()->request->isPostRequest) {
		$this->renderPartial('checker_sync_ldappaging', array('rand' => $_GET['rand']));
		//}
	}
	public function actionChecker_sync_datapagingall()
	{
		//if (Yii::app()->request->isPostRequest) {
		$this->renderPartial('checker_sync_datapagingall', array('rand' => $_GET['rand']));
		//}
	}


	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}
