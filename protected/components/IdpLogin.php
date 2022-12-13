<?php

class IdpLogin extends CApplicationComponent 
{
	//object properties
	public $access_token;
	public $refresh_token;
	public $expired_in;
	public $already_expired;
	public $user_loginname;
	public $user_firstname;
	public $user_lastname;
	public $user_email;
	
	public function getIdPinfo()
	{
		
		/*
		   //require __DIR__ . '/vendor/autoload.php';
		   //Yii::app()->basePath .
		   //Yii::app()->request->baseUrl;
		   //require_once Yii::app()->basePath . '/extensions/PearMail/Mail-1.2.0/Mail.php';
		   //require_once Yii::getPathOfAlias('application.extensions.my-php-file') . '.php';
		   //require_once Yii::app()->baseUrl . '/themes/IdPOAth/vendor/autoload.php';
		   //require_once(/ssowpd/themes/IdPOAth/vendor/autoload.php): failed to open stream: No such file or directory 
		   //require_once Yii::app()->basePath . '/themes/IdPOAth/vendor/autoload.php';
		   //require_once(/usr/share/nginx/html/ssowpd/protected/themes/IdPOAth/vendor/autoload.php): failed to open stream: No such file or directory 
		   
		   //$yiit='/ssowpd/themes/IdPOAth/vendor/autoload.php';
		   //require_once($yiit);
		   //$yiit=dirname(__FILE__).'/themes/IdPOAth/vendor/autoload.php';
		   //require_once($yiit);
		*/
		
		$idpmsg = "";	
		//==========================================
		$provider = new \League\OAuth2\Client\Provider\GenericProvider([
			'clientId'                => 'ypDnGLAuRNT8YX1YJa0Ffoi3uCQa',    // The client ID assigned to you by the provider
			'clientSecret'            => 'RGCZGcIFfNAgtohlGHwlr9ZwoNga',   // The client password assigned to you by the provider
			'scopes'		      	  => 'openid',
			'redirectUri'             => 'https://wpdws.sso.go.th/wpdcore/',
			'urlAuthorize'            => 'https://idp.dev.sso.loc:9443/oauth2/authorize',
			'urlAccessToken'          => 'https://idp.dev.sso.loc:9443/oauth2/token',
			'urlResourceOwnerDetails' => 'https://idp.dev.sso.loc:9443/oauth2/userinfo'
		]);
		
		// If we don't have an authorization code then get one
		if (!isset($_GET['code'])) {
		
			// Fetch the authorization URL from the provider; this returns the
			// urlAuthorize option and generates and applies any necessary parameters
			// (e.g. state).
			$authorizationUrl = $provider->getAuthorizationUrl();
		
			// Get the state generated for you and store it to the session.
			$_SESSION['oauth2state'] = $provider->getState();
		
			// Redirect the user to the authorization URL.
			header('Location: ' . $authorizationUrl);
			exit;
		
		// Check given state against previously stored one to mitigate CSRF attack
		} elseif (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {
		
			if (isset($_SESSION['oauth2state'])) {
				unset($_SESSION['oauth2state']);
			}
			
			exit('Invalid state');
		
		} else {
		
			try {
		
				// Try to get an access token using the authorization code grant.
				$accessToken = $provider->getAccessToken('authorization_code', [
					'code' => $_GET['code']
				]);
		
				// We have an access token, which we may use in authenticated
				// requests against the service provider's API.
				
				//echo 'Access Token: ' . $accessToken->getToken() . "<br>";
				//echo 'Refresh Token: ' . $accessToken->getRefreshToken() . "<br>";
				//echo 'Expired in: ' . $accessToken->getExpires() . "<br>";
				//echo 'Already expired? ' . ($accessToken->hasExpired() ? 'expired' : 'not expired') . "<br>";
		
				// Using the access token, we may look up details about the
				// resource owner.
				$resourceOwner = $provider->getResourceOwner($accessToken);
		
				//var_export($resourceOwner->toArray());
				
				$myarray = $resourceOwner->toArray();
				
				//array(3) { ["sub"]=> string(7) "ksukrit" ["family_name"]=> string(12) "KAMOLWATTANA" ["email"]=> string(18) "sukrit.k@sso.go.th" } 
				
				/*
					Access Token: bcc0d87b-492b-3cda-b388-a4fdbab5f39c
					Refresh Token: 2e90f175-4726-3465-b72f-c924926d5259
					Expired in: 1556857369
					Already expired? not expired
					array(4) { ["sub"]=> string(7) "ksukrit" ["given_name"]=> string(6) "SUKRIT" ["family_name"]=> string(12) "KAMOLWATTANA" ["email"]=> string(18) "sukrit.k@sso.go.th" }
					ksukrit
					SUKRIT
					KAMOLWATTANA
					sukrit.k@sso.go.th 
				*/
				
				//var_dump($myarray);
				
				//echo "<br>";
				//echo "{$myarray['sub']} <br>";
				//echo "{$myarray['given_name']} <br>";
				//echo "{$myarray['family_name']} <br>";
				//echo "{$myarray['email']} <br>";
				
				//set seession variable
				Yii::app()->session['access_token'] = $accessToken->getToken();
				Yii::app()->session['refresh_token'] = $accessToken->getRefreshToken();
				Yii::app()->session['expired_in'] = $accessToken->getExpires();
				Yii::app()->session['already_expired'] = ($accessToken->hasExpired() ? 'expired' : 'not expired'); //'expired' : 'not expired'
				Yii::app()->session['user_loginname'] = $myarray['sub'];
				Yii::app()->session['user_firstname'] = $myarray['given_name'];
				Yii::app()->session['user_lastname'] = $myarray['family_name'];
				Yii::app()->session['user_email'] = $myarray['email'];
				
				$this->access_token = Yii::app()->session['access_token'];
				$this->refresh_token = Yii::app()->session['refresh_token'];
				$this->expired_in = Yii::app()->session['expired_in'];
				$this->already_expired = Yii::app()->session['already_expired'];
				$this->user_loginname = Yii::app()->session['user_loginname'];
				$this->user_firstname = Yii::app()->session['user_firstname'];
				$this->user_lastname = Yii::app()->session['user_lastname'];
				$this->user_email = Yii::app()->session['user_email'];
				
				/*
					Yii::app()->session['var'] = 'value mindphp.com'; //ใช้งานตัวแปร sessioin ได้อัตโนมัติ
					echo Yii::app()->session['var']; // จะได้แสดงคำว่า "value mindphp.com"ถ้าจะยกเลิก session ตัวนั้นๆ ก็ใช้ 
					unset(Yii::app()->session['var']);หรือถ้าต้องการยกเลิกค่าต่างๆ ใน session ก็สามารถใช้
					Yii::app()->session->clear();และถ้าต้องการลบค่า session ที่เก็บไว้ที่ server ออกทั้งหมด สามารถใช้ 
					Yii::app()->session->destroy();
				*/
		
				// The provider provides a way to get an authenticated API request for
				// the service, using the access token; it returns an object conforming
				// to Psr\Http\Message\RequestInterface.
				$request = $provider->getAuthenticatedRequest(
					'GET',
					'https://idp.dev.sso.loc:9443/oauth2/userinfo',
					$accessToken
				);
			} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
		
				// Failed to get the access token or user details.
				exit($e->getMessage());
		
			}
		
		}
	//==========================================	
		if(isset(Yii::app()->session['access_token'])){
			$idpmsg = 'Y';
		}else{
			$idpmsg = 'N';
		}
		
		return $idpmsg;
	
	}//public function getIdPinfo()
	
}//class IdpLogin extends CApplicationComponent 

?>