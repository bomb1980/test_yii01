<?php
class Idplib{
	
	public $accesstoken;
	public $refreshtoken;
	public $idtoken;
	public $expires;
	public $hasexpired;
	
	public $sub; //username
	public $SSOinitials; //คำนำหน้าชื่อ
	public $SSOfirstname; //ชื่อ
	public $SSOsurname; //นามสกุล
	public $SSOworkingdepdescription; //สำนักงาน
	public $SSOpersonclass; //ระดับชั้นเจ้าหน้าที่
	public $SSOpersonposition; //ตำแหน่งงาน
	public $SSObranchCode;//รหัสสาขา
	
	public $vd2;
	
	
	public function getIdpinfo(){

		

		//require '/opt/share/html/wpdcore/themes/vcard/plugins/idplib/vendor/autoload.php';
		//$key = sprintf('file://%s/server.pem', realpath('/opt/share/html/wpdcore/themes/vcard/plugins/idplib'));

		require($_SERVER['DOCUMENT_ROOT'] . '/wpdcore/themes/vcard/plugins/idplib/vendor/autoload.php');
		$key = sprintf('file://%s/server.pem', realpath(__DIR__));
		
		$signer   = new \Lcobucci\JWT\Signer\Rsa\Sha256();
		$provider = new \OpenIDConnectClient\OpenIDConnectProvider([
			'clientId'                => 'fvTJfffT_l2ftcKAn2MCqJJjUn4a',
			'clientSecret'            => 'W1VCo5TC46IRwXqOO5ywgiDnqyEa',
			'idTokenIssuer'           => 'https://idpws02uat.sso.go.th:443/oauth2/token',
			// Your server
			'redirectUri'             => 'https://uat2.sso.go.th/wpdcore/',
			'urlAuthorize'            => 'https://idpws02uat.sso.go.th:443/oauth2/authorize',
			'urlAccessToken'          => 'https://idpws02uat.sso.go.th:443/oauth2/token',
			'urlResourceOwnerDetails' => 'https://idpws02uat.sso.go.th:443/oauth2/userinfo',
			// Find the public key here: https://github.com/bshaffer/oauth2-demo-php/blob/master/data/pubkey.pem
			// to test against brentertainment.com
			'publicKey'               => $key,
		],
			[
				'signer' => $signer
			]
		);
		
		// send the authorization request
		if (empty($_GET['code'])) {
			$redirectUrl = $provider->getAuthorizationUrl();
			header(sprintf('Location: %s', $redirectUrl), true, 302);
			return;
		}
		
		// receive authorization response
		try {
			$token = $provider->getAccessToken('authorization_code', [
				'code' => $_GET['code']
			]);
		} catch (\OpenIDConnectClient\Exception\InvalidTokenException $e) {
			$errors = $provider->getValidatorChain()->getMessages();
			echo $e->getMessage();
			var_dump($errors);
			return;
		} catch (\Exception $e) {
			echo $e->getMessage();
			$errors = $provider->getValidatorChain()->getMessages();
			var_dump($errors);
			return;
		}
		
		$this->accesstoken = $token;
		$this->refreshtoken = $token->getRefreshToken();
		$this->idtoken = $token->getIdToken();
		$this->expires =  $token->getExpires() ; //($accessToken->hasExpired() ? 'expired' : 'not expired')
		$this->hasexpired = ($token->hasExpired() ? 'expired' : 'not expired');
		$allclaims = $token->getIdToken()->getClaims();
		
		Yii::app()->session['accesstoken'] = $this->accesstoken;
		Yii::app()->session['idtoken'] = $this->idtoken;

		
		
		foreach($allclaims as $key=>$value){
			//echo $key.' : '.$value.'<br />';
			if($key=='sub'){
				$this->sub = $value;
				Yii::app()->session['sub'] = $this->sub;
			}
			if($key=='SSOinitials'){
				$this->SSOinitials = $value;
				Yii::app()->session['SSOinitials'] = $this->SSOinitials;
			}
			if($key=='SSOfirstname'){
				$this->SSOfirstname = $value;
				Yii::app()->session['SSOfirstname'] = $this->SSOfirstname;
			}
			if($key=='SSOsurname'){
				$this->SSOsurname = $value;
				Yii::app()->session['SSOsurname'] = $this->SSOsurname;
			}
			if($key=='SSOworkingdepdescription'){
				$this->SSOworkingdepdescription = $value;
				Yii::app()->session['SSOworkingdepdescription'] = $this->SSOworkingdepdescription;
			}
			if($key=='SSOpersonclass'){
				$this->SSOpersonclass = $value;
				Yii::app()->session['SSOpersonclass'] = $this->SSOpersonclass;
			}
			if($key=='SSOpersonposition'){
				$this->SSOpersonposition = $value;
				Yii::app()->session['SSOpersonposition'] = $this->SSOpersonposition;
			}
			if($key=='SSObranchCode'){
				$this->SSObranchCode = $value;
				Yii::app()->session['SSObranchCode'] = $this->SSObranchCode;
			}
		}//foreach($allclaims as $key=>$value){
		
		
	}//function getIdPinfo()
	
	public function setStateuser(){
		
	/*	$arr = (array)$this->sub;
		$values = array_values($arr);
		Yii::app()->user->setState("sub", end($values));

		$arr = (array)$this->SSOinitials;
		$values = array_values($arr);
		Yii::app()->user->setState("SSOinitials", end($values));

		$arr = (array)$this->SSOfirstname;
		$values = array_values($arr);
		Yii::app()->user->setState("SSOfirstname", end($values));

		$arr = (array)$this->SSOsurname;
		$values = array_values($arr);
		Yii::app()->user->setState("SSOsurname", end($values));

		$arr = (array)$this->SSOworkingdepdescription;
		$values = array_values($arr);
		Yii::app()->user->setState("SSOworkingdepdescription", end($values));

		$arr = (array)$this->SSOpersonclass;
		$values = array_values($arr);
		Yii::app()->user->setState("SSOpersonclass", end($values));
	
		$arr = (array)$this->SSOpersonposition;
		$values = array_values($arr);
		Yii::app()->user->setState("SSOpersonposition", end($values));
	
		$arr = (array)$this->SSObranchCode;
		$values = array_values($arr);
		Yii::app()->user->setState("SSObranchCode", end($values));
		*/
		
	}
	
	
	public function clsStateuser(){
		
		/*Yii::app()->user->setState("sub", null);
		Yii::app()->user->setState("SSOinitials", null);
		Yii::app()->user->setState("SSOfirstname", null);
		Yii::app()->user->setState("SSOsurname", null);
		Yii::app()->user->setState("SSOworkingdepdescription", null);
		Yii::app()->user->setState("SSOpersonclass", null);
		Yii::app()->user->setState("SSOpersonposition", null);
		Yii::app()->user->setState("SSObranchCode", null);*/
		
		
	}
	
	
	
}//class Idpfunc
?>
