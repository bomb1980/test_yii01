<?php
/*if(!isset(Yii::app()->session['user_loginname'])){
 	Yii::app()->CIdpLogin->getIdPinfo();
}*/
if(!Yii::app()->user->isGuest) {
	if(Yii::app()->user->getId()){
		$user_id = Yii::app()->user->getId();
	}
	if(Yii::app()->user->firstname){
 		$user_firstname = Yii::app()->user->firstname;
	}
	if(Yii::app()->user->lastname){
 		$user_lastname = Yii::app()->user->lastname;
	}
	if(Yii::app()->user->email){
 		$user_email = Yii::app()->user->email;
	}
	if(Yii::app()->user->access_level){
 		$user_access_level = Yii::app()->user->access_level;
	}
	if(Yii::app()->user->address){
 		$user_address = Yii::app()->user->address;
	}
	if(Yii::app()->user->access_code){
 		$user_access_code = Yii::app()->user->access_code;
	}
	if(Yii::app()->user->username){
 		$user_username = Yii::app()->user->username;
	}
	
	/*$user_firstname = Yii::app()->session['firstname'];
	$user_lastname = Yii::app()->session['lastname'];
	$user_email = Yii::app()->session['email'];
	$user_access_level = Yii::app()->session['access_level'];
	$user_address = Yii::app()->session['address'];
	$user_access_code = Yii::app()->session['access_code'];*/
}
?>

<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<title>User Group Form</title>
</head>

<body>
<?php
	if($usgid!=0 && $action=='chg'){
		$q = new CDbCriteria( array(
					'condition' => "ug_id = :ug_id ",         
					'params'    => array(':ug_id' => $usgid)  
		));
		$musg = UsergroupTb::model()->findAll($q);
		$countusg = count($musg);
		foreach ($musg as $rows){
			$ug_id = $rows->ug_id;
		  	$ustxt1 = $rows->ug_name;
		   	$ustxt2 = $rows->ug_remark;
		}
	}else{
		$ustxt1 = "";
		$ustxt2 = "";
	}
?>
<div class=""><!--row-->
    <div class="col-md-3">
        <div class="form-group">
            <label class="thfont5" for="ustxt1">ชื่อกลุ่ม:</label>
            <input type="text" class="form-control thfont5" id="ustxt1" style="height:auto;" placeholder="ชื่อกลุ่ม" value="<?=$ustxt1?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="thfont5" for="ustxt2">รายละเอียด:</label>
            <input type="text" class="form-control thfont5" id="ustxt2" style="height:auto;" placeholder="รายละเอียด" value="<?=$ustxt2?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <p class="thfont5" style="padding-top:32px;">
                <button  class="btn btn-info" id="usbtn1" onClick="javascript:callcreatenewusg('add','ustxt',2);"  <?php if($usgid!=0 && $action=='chg'){ ?> style="display:none;" <?php } ?> <?php if($user_access_level!='admin'){ ?> disabled <?php } ?>><i class="fa fa-plus"></i><font class="thfont5"> เพิ่มกลุ่ม</font></button>
                <button  class="btn btn-warning" id="usbtn2" onClick="javascript:callupdateusg('chg','ustxt',2,<?=$usgid?>);" <?php if($usgid==0 && $action!='chg'){ ?> style="display:none;" <?php } ?>><i class="fa fa-edit"></i><font class="thfont5"> บันทึกการแก้ไข</font></button>
                <button class="btn btn-info" id="usbtn3" onClick="javascript:loadusgfrm('opn',0);" <?php if($usgid==0 && $action!='chg'){ ?> style="display:none;" <?php } ?>><i class="fa fa-reply"></i> <font class="thfont5">ยกเลิกการแก้ไข</font></button>
            </p>
        </div>
    </div>
</div><!--row-->
</body>
</html>