<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 
	private $_id; 
	
	 
	public function authenticate()
	{
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		
		$user = Users::model()->findByAttributes(array('username'=>$this->username));
		
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
		*/
		
		//*****************************************************************************************
		
		$user = Users::model()->findByAttributes(array('username'=>$this->username));
		
		if($user===null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		//else if($user->password!==$this->password) //else if($user->password!==md5($this->password))
		}//$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->id;
			
			$this->setState('firstname', $user->firstname);
			Yii::app()->session['firstname'] = $user->firstname;
			
			$this->setState('lastname', $user->lastname);
			Yii::app()->session['lastname'] =  $user->lastname;
			
			$this->setState('email', $user->email);
			Yii::app()->session['email'] =  $user->email;
			
			$this->setState('username', $user->username);
			Yii::app()->session['username'] =  $user->username;
			
			$this->setState('access_level', $user->access_level);
			Yii::app()->session['access_level'] =  $user->access_level;
			
			$this->setState('address', $user->address); //branchcode
			Yii::app()->session['address'] =  $user->address;
			
			$this->setState('access_code', $user->access_code); //typebranchcode
			Yii::app()->session['access_code'] =  $user->access_code;
			
			
			$this->errorCode=self::ERROR_NONE;	
		}
		return !$this->errorCode;
		
		//********************************************************************************************
		
	}
	
	public function getId()
	{
		return $this->_id;	
	}
	
	
}