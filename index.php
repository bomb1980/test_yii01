<?php

date_default_timezone_set('Asia/Bangkok');

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
#$config=dirname(__FILE__).'/protected/config/main_uat.php';
$config=dirname(__FILE__).'/protected/config/main_dev.php';

//$yiit='/ssowpd/themes/IdPOAth/vendor/autoload.php';
//$yiit=dirname(__FILE__).'/themes/IdPOAth/vendor/autoload.php';
//require_once($yiit);

$yiiidplib = dirname(__FILE__).'/themes/vcard/plugins/idplib/idpfunc.php';
require_once($yiiidplib);

$yiiphpmailler = dirname(__FILE__).'/themes/vcard/plugins/phpmailer/class.phpmailer.php';
require_once($yiiphpmailler);
require __DIR__ . '/protected/vendor/autoload.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();