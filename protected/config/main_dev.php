<?php

$dbhost = 'mysql:host=127.0.0.1;';

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'WPD',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
	),

	'modules' => array(
		// uncomment the following to enable the Gii tool

		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'Tcm@123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
		),

	),

	// application components
	'components' => array(

		'CWpdApi' => array('class' => 'WpdApi',),
		'CIdpLogin' => array('class' => 'IdpLogin',),
		'CGenAccNo' => array('class' => 'GenAccNo',),
		'CCropinfo_tmp' => array('class' => 'cropinfo_tmp',),
		'CCommittee_tmp' => array('class' => 'committee_tmp',),
		'CBranch_tmp' => array('class' => 'branch_tmp',),
		'Cgentextfile' => array('class' => 'gentextfile'),
		'Caccnumbertb' => array('class' => 'accnumbertb'),
		'Cempstate' => array('class' => 'empstate'),
		'Clogrunservice' => array('class' => 'logrunservice'),
		'Clogevent' => array('class' => 'logevent'),
		'Cwpdreport' => array('class' => 'wpdreport'),
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'class' => "CustomWebUser",
			// 'enableSession' => false,
			//'authTimeout' => 300, //กำหนดให้ออกจากระบบหลังจากไม่ได้ใช้งานเป็นเวลา 5 นาที //300 คือเวลาเป็นวินาทีได้มาจาก 60 วินาที × 5 นาที มื่อดูการตั้งค่าทั้งหมดจะได้ลักษณะดังนี้
			// 'identityClass' => 'common\models\User',
			// 'enableAutoLogin' => false,
			// 'enableSession' => false,
			// 'loginUrl' => '',
		),
		'request' => array(
			'enableCsrfValidation' => false,
		),

		// uncomment the following to enable URLs in path-format

		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				// 'defaults' => ['id' => 7878787],
			),
			'showScriptName' => false,
			// 'suffix' => '.html',
			// 'enablePrettyUrl' => true,
		),

		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database

		'db' => array(
			//'connectionString' => 'mysql:host=172.20.91.51;dbname=wpddb',
			'connectionString' => $dbhost . 'dbname=wpddb',
			'emulatePrepare' => true,
			'username' => 'root', //wpdusr //root //root
			'password' => '', //CDEVwpddb@2019 //'' 
			'charset' => 'utf8',
		),

		'db2' => array(
			//'connectionString' => 'mysql:host=172.20.91.51;dbname=wpdlogdb',
			'connectionString' => $dbhost . 'dbname=wpdlogdb',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'class'   => 'CDbConnection'
		),

		'db3' => array(
			//'connectionString' => 'mysql:host=172.20.91.51;dbname=wpdreportdb',
			'connectionString' => $dbhost . 'dbname=wpdreportdb',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'class'   => 'CDbConnection'
		),

		'db4' => array(
			//'connectionString' => 'mysql:host=172.20.91.51;dbname=etpdb',
			'connectionString' => $dbhost . 'dbname=etpdb',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'class'   => 'CDbConnection'
		),

		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'CommonFnc' => array(
			'class' => 'CommonFnc',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	// using Yii::app()->params['checkRequestHeaders']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
		'servicepath' => "https://wpdws.sso.go.th",
		'ngixpath' => "/opt/share/html", //--Yii::app()->params['ngixpath']
		'servicelocalpath' => "http://localhost",
		'ledtextfile' => "http://localhost/wpdtextfile",
		'prg_ctrl' => array('authCookieDuration' => 7),
		'urllogout1' => "https://idpws02uat.sso.go.th:443/oidc/logout?id_token_hint=",
		'urllogout2' => "&post_logout_redirect_uri=https://uat2.sso.go.th/wpdcore/&state=state_2",
		'checkRequestHeaders' => "re400Mahk1ObnovUOAzo6kNeg5oNiWEMcrZiqaec",
		'testJob' => true,

	),
);
