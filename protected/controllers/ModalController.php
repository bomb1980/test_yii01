<?php

class ModalController extends Controller
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
	
	public function actionTest8()
	{
		$this->renderPartial('calendar', array("data" => null));
	}
	

	public function actionSearchUserLDAP()
	{
		if (Yii::app()->request->isPostRequest) {
			$txtsearch = $_POST['txtsearch'];
			if (is_null($txtsearch)) {
				exit;
			}
		}
		$data = lkup_user::LDAP_LIST("*" . $txtsearch . "*");
		//var_dump($data);
		//$data = null;

		$this->renderPartial('searchuser', array("data" => $data));
		
	}
	

	public function actionListuserrole()
	{
		if (Yii::app()->request->isPostRequest) {

			$user_id = $_POST['user_id'];
			$ssobranch_code = $_POST['ssobranch_code'];
			if (is_null($user_id) || is_null($ssobranch_code)) {
				exit;
			}

			$model = new CommonAction;
			$model->Add_mas_user_permission($user_id, $ssobranch_code);

			$data = lkup_user::getAppPermission();
			$permis = lkup_user::getUserPermission($user_id);

			$this->renderPartial('listuserrole', array("data" => $data, "permis" => $permis, "user_id" => $user_id, "ssobranch_code"=>$ssobranch_code ));
		}
	}

	public function actionSelective()
	{
		if (Yii::app()->request->isPostRequest) {

			$members = $_POST['members'];
			$selected = $_POST['selected'];

			if (is_null($members) || is_null($selected)) {
				exit;
			}
			/*
			$model=new CommonAction;
			$model->Add_mas_user_permission($user_id, $ssobranch_code);

			$data = lkup_user::getAppPermission();
			$permis = lkup_user::getUserPermission($user_id);

			$this->renderPartial('selective',array("data"=> $data, "permis"=> $permis, "user_id"=> $user_id));
			*/

			$portraitsurl = Yii::app()->params['prg_ctrl']['url']['portraits'];

			$modelform = lkup_calendar::getExecutive(null, "0,1");

			$members  = array();

			foreach ($modelform as $dataitem) {
				$strmember = "{
                  id: '{$dataitem['user_id']}',
                  name: '{$dataitem['name']}',
				  avatar: '{$portraitsurl}/{$dataitem['file_name']}',
				  work_status: '{$dataitem['work_status']}'
                }
                ";
				$members[] = $strmember;
			}

			$this->renderPartial('selective', array("members" => $members, "selected" => $selected));
		}
	}

	public function actionRenderpdf(){
		
		$id = $_GET['id'];
		if (filter_var($id, FILTER_VALIDATE_INT)) {
			$conn = Yii::app()->db;
			$sql = "SELECT * FROM trn_file WHERE id=:id AND obj_type in ('1','8','9','10') ";
			$command = $conn->createCommand($sql);
			$command->bindValue(":id", $id);	
			$rows= $command->queryAll();  //var_dump($rows);exit;
			$filename =  basename($rows[0]['file_path']);
			if(count(explode( '.', $filename)) >1){
				$file_path = urldecode($rows[0]['file_path']);
			}else{
				$file_path = urldecode($rows[0]['file_path']) . urldecode($rows[0]['file_name']) ;
			}
			//echo $file_path; exit;
			if(count($rows) > 0){
				$this->renderPartial('renderpdf', array("file_path" => $file_path) );
			}else{
				echo("The file does not exist");
			}

			
		} else {
			echo("Variable is not an numeric");
		}


	}

	public function actionEditcustomcontent()
	{
		if (Yii::app()->request->isPostRequest) {

			$list_id = $_POST['list_id'];
			if (is_null($list_id)) {
				exit;
			}

			$filecode =  Yii::app()->CommonFnc->genstring();
			$this->renderPartial('editcustomcontent', array("filecode" => $filecode, "list_id" => $list_id));
		}
	}
	
	public function actionEditbranchcollection()
	{
		if (Yii::app()->request->isPostRequest) {

			$list_id = $_POST['list_id'];
			if (is_null($list_id)) {
				exit;
			}

			$filecode =  Yii::app()->CommonFnc->genstring();
			$this->renderPartial('editbranchcollection', array("filecode" => $filecode, "list_id" => $list_id));
		}
	}

	public function actionEditcustomcontentpermission()
	{
		if (Yii::app()->request->isPostRequest) {

			$id = $_POST['id'];
			if (is_null($id)) {
				exit;
			}

			if (!filter_var($id, FILTER_VALIDATE_INT)) {
				exit;

			}
			$conn = Yii::app()->db;
			$sql = "SELECT * FROM mas_custom_content_category WHERE id=:id ";
			$command = $conn->createCommand($sql);
			$command->bindValue(":id", $id);	
			$rows= $command->queryAll(); 
			$this->renderPartial('editcustomcontentpermission', array( "id" => $id, "data"=> $rows) );
		}
	}

	public function actionEditdownloadcollectiondetail()
	{
		if (Yii::app()->request->isPostRequest) {

			$list_id = $_POST['list_id'];
			if (is_null($list_id)) {
				exit;
			}

			$filecode =  Yii::app()->CommonFnc->genstring();
			$this->renderPartial('editdownloadcollectiondetail', array("filecode" => $filecode, "list_id" => $list_id));
		}
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
