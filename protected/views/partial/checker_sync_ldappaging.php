<?php
// The file has JSON type.
header('Content-Type: application/json');


if (isset(Yii::app()->session['progress'])) {
	$progress = Yii::app()->session['progress'];
	$obj = json_decode(Yii::app()->session['progress']);
	
    //echo $_SESSION['progress'];
    if ($obj->percent == 100) {  

        $execution_time = Yii::app()->session['executionTime'];
        if ( round(Yii::app()->session['executionTime']) > 0){
            $strTime = Yii::app()->CommonFnc->calctime( round(Yii::app()->session['executionTime']) );
        }else{
            $strTime = $execution_time . " millisecond";
        }
                
		$strcomplete = '<div class="alert alert-success alert-dismissible" role="alert"> <i class="icon fa-info" aria-hidden="true"></i>&nbsp;&nbsp;';
		$strcomplete .="จำนวนปรับปรุง : " . number_format(Yii::app()->session['total_user']) . " เร็คคอร์ด , ใช้เวลา {$strTime}";
        echo json_encode(array("percent" => $obj->percent, "message" => $strcomplete ));

        Yii::app()->session->remove('progress');
        Yii::app()->session->remove('executionTime');
        Yii::app()->session->remove('total_user');

    }else{
        echo json_encode(array("percent" => $obj->percent, "message" => $obj->message));
    }

} else {
    //echo '0';
	echo json_encode(array("percent" => 0, "message" => null));
}
