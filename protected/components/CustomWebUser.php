<?php
	
class CustomWebUser extends CWebUser
{
	private $_usermodel;
	private $_membermodel;
	
	public function getUser()
	{
		$this->_usermodel=lkup_user::getUserid(Yii::app()->user->id);
		//$this->_usermodel=lkup_user::getUserid(1);
		return true;
	}	
	
	public function getInfo($fieldcode)
	{	
		if($this->_usermodel===null) {$this->getUser();}
		$user = $this->_usermodel;
		if($fieldcode=='displayname'){ 
			$returnval = trim(stripslashes($user[0]['displayname'])); 
		}else if($fieldcode=='uid'){ 
			$returnval = $user[0]['uid'];
		}else{
			$returnval = $user[0][$fieldcode];
		}

		return $returnval;
	}

	public function getMember($id=null){
		//$this->_usermodel=lkup_user::getUserid(Yii::app()->user->id);
		if ($id==null) $id=1;
		$this->_membermodel = lkup_user::getUserid($id);
		return true;
	}
	public function getMemberInfo($fieldcode,$id){
		if($this->_membermodel===null) {$this->getMember($id);}
		$user = $this->_membermodel;
		$returnval = $user[0][$fieldcode];
		return $returnval;
	}	

	public function clearInfo()
	{	
		unset($this->_usermodel);
		return true;
	}

}