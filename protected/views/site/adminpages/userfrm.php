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
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>User Form</title>
<style>

.table4_1 table {
	width:100%;
	margin:15px 0;
	border:0;
}
.table4_1 th {
	background-color:#93DAFF;
	color:#000000
}
.table4_1,.table4_1 th,.table4_1 td {
	font-size:0.95em;
	/*text-align:center;*/
	padding:4px;
	border-collapse:collapse;
}
.table4_1 th,.table4_1 td {
	border: 1px solid #c1e9fe;
	border-width:1px 0 1px 0
}
.table4_1 tr {
	border: 1px solid #c1e9fe;
}
.table4_1 tr:nth-child(odd){
	background-color:#dbf2fe;
}
.table4_1 tr:nth-child(even){
	background-color:#fdfdfd;
}



@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	.table4_1 table, .table4_1 thead, .table4_1 tbody, .table4_1 th, .table4_1 td, .table4_1 tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	.table4_1 thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	.table4_1 tr { border: 1px solid #ccc; }
	
	.table4_1 td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	.table4_1 td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	.table4_1 button{
		width:80%;
		height:100%;
	}
	
	/*
	Label the data
	*/
	.table4_1 td:nth-of-type(1):before { content: ""; }
	.table4_1 td:nth-of-type(2):before { content: ""; }
	.table4_1 td:nth-of-type(3):before { content: ""; }
	.table4_1 td:nth-of-type(4):before { content: ""; }
	.table4_1 td:nth-of-type(5):before { content: ""; }
	.table4_1 td:nth-of-type(5):after { content: "";}
	.table4_1 td:nth-of-type(6):before { content: ""; }
	.table4_1 td:nth-of-type(6):after { content: "";}
	
}

</style>
</head>

<body>
<?php
	if($usaid!=0 && $action=='chg'){
		$q = new CDbCriteria( array(
					'condition' => "id = :id ",         
					'params'    => array(':id' => $usaid)  
		));
		$musa = Users::model()->findAll($q);
		$countusa = count($musa);
		foreach ($musa as $rows){
			$firstname = $rows->firstname;
			$lastname = $rows->lastname;
			$email = $rows->email;
			$contact_number = $rows->contact_number;
			$username = $rows->username;
			$password = $rows->password;
			$modified = $rows->modified;
			$address = $rows->address;
			$access_code = $rows->access_code;
			$access_level = $rows->access_level;
		}
	}else{
			$firstname = "";
			$lastname = "";
			$email = "";
			$contact_number = "";
			$username = "";
			$password = "";
			$modified = "";
			$address = "";
			$access_code ="";
			$access_level = "";
	}
?>
<div class="row">
    <div class="col-md-12">
    	<table id="usafrmtb" cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
        	<tbody>
        		<tr>
                    <td style="text-align:right; width:30%; font-weight:bold;">ชื่อ :</td>
                    <td style="text-align:left; width:70%; padding-left:15px;">
                        <input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="form-control thfont5" style="height:auto;" id="usatxt1" value="<?=$firstname?>" placeholder="ชื่อ">
                        <span style="color:red; font-size:16px; display:none;" id="errusa1"></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right; width:30%; font-weight:bold;">นามสกุล :</td>
                    <td style="text-align:left; width:70%; padding-left:15px;">
                        <input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="form-control thfont5" style="height:auto;" id="usatxt2" value="<?=$lastname?>" placeholder="นามสกุล">
                        <span style="color:red; font-size:16px; display:none;" id="errusa2"></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right; width:30%; font-weight:bold;">username :</td>
                    <td style="text-align:left; width:70%; padding-left:15px;">
                        <input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="form-control thfont5" style="height:auto;" id="usatxt3" value="<?=$username?>" placeholder="username">
                        <span style="color:red; font-size:16px; display:none;" id="errusa3"></span>
                    </td>
                </tr>
                <tr style="display:none;">
                    <td style="text-align:right; width:30%; font-weight:bold;">password :</td>
                    <td style="text-align:left; width:70%; padding-left:15px;">
                        <input type="password" onFocus="this.select()" onBlur="chkelm(this.id);" class="form-control thfont5" style="height:auto;" id="usatxt4" value="-" placeholder="password">
                        <span style="color:red; font-size:16px; display:none;" id="errusa4"></span>
                    </td>
                </tr>
                 <tr style="display:none;">
                    <td style="text-align:right; width:30%; font-weight:bold;">email :</td>
                    <td style="text-align:left; width:70%; padding-left:15px;">
                        <input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="form-control thfont5" style="height:auto;" id="usatxt5" value="-" placeholder="example@email.com">
                        <span style="color:red; font-size:16px; display:none;" id="errusa5"></span>
                    </td>
                </tr>
                <tr style="display:none;">
                    <td style="text-align:right; width:30%; font-weight:bold;">เบอร์โทรศัพท์ :</td>
                    <td style="text-align:left; width:70%; padding-left:15px;">
                        <input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="form-control thfont5" style="height:auto;" id="usatxt6" value="-" placeholder="0000000000">
                        <span style="color:red; font-size:16px; display:none;" id="errusa6"></span>
                    </td>
                </tr>
                <tr>
                	<td style="text-align:right; width:30%; font-weight:bold;">branch code :</td>
                    <td style="text-align:left; width:70%; padding-left:15px;">
                          <!--<input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="form-control thfont5" style="height:auto;" id="usatxt7" value="<?=$address?>" placeholder="0000">-->
                          <select class="form-control thfont5" style="height:auto;" id="usatxt7">
                          	<?php
                          		$ssobc = MasSsobranch::model()->findAll();
								$countssobc = count($ssobc);
								foreach($ssobc as $rows){
									$ssobc_code = $rows->ssobranch_code;
									$ssobc_name = $rows->name;
									$ssobc_shortname = $rows->shortname;
									$ssobc_ssobranch_type_id = $rows->ssobranch_type_id;
									
										
							?>
                            
                            	<option value="<?=$ssobc_code?>" <?php if($address==$ssobc_code){ ?> selected <?php } ?>><?=$ssobc_code?>:<?=$ssobc_name?></option>
                            <?php
								}//foreach
							?>
                          </select>
                        <span style="color:red; font-size:16px; display:none;" id="errusa7"></span>
                    </div>
                    </div>
                    </td>
                </tr>
                <tr>
                	<td style="text-align:right; width:30%; font-weight:bold;">branch type :</td>	
                    <td style="text-align:left; width:70%; padding-left:15px;">
                        <!--<input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="form-control thfont5" style="height:auto;" id="usatxt8" value="" placeholder="">-->
                        <select class="form-control thfont5" style="height:auto;" id="usatxt8">
                        	<?php
								$q2 = new CDbCriteria( array(
									'condition' => "status = :status ",         
									'params'    => array(':status' => 1)  
								));
								$mbt = MasSsobranchType::model()->findAll($q2);
								$countbt = count($mbt);
								foreach ($mbt as $rows){
									$id = $rows->id;
 									$name = $rows->name;
								
							?>
                        	<option value="<?=$id?>" <?php if($access_code==$id){ ?> selected <?php } ?>><?=$name?></option>
                            <?php
								}//foreach
							?>
                        </select>
                        <span style="color:red; font-size:16px; display:none;" id="errusa8"></span>
                    </td>
                </tr>
                <tr>
                	<td style="text-align:right; width:30%; font-weight:bold;">user level :</td>
                    <td style="text-align:left; width:70%; padding-left:15px;">
                        <!--<input type="text" onFocus="this.select()" onBlur="chkelm(this.id);" class="form-control thfont5" style="height:auto;" id="usatxt9" value="" placeholder="">-->
                        <select class="form-control thfont5" style="height:auto;" id="usatxt9">
                          <?php
						  	$q3 = new CDbCriteria( array(
								'condition' => "ug_status = :ug_status ",         
								'params'    => array(':ug_status' => 1)  
							));
							$mug = UsergroupTb::model()->findAll($q3);
							$countug = count($mug);
							foreach ($mug as $rows){
								$ug_id = $rows->ug_id;
 								$ug_name = $rows->ug_name;
								
									//if($ug_name=='admin'){
									  //if($user_access_level=='admin'){	
									 	///continue;	
							
						  ?>	
                          <option value="<?=$ug_name?>" <?php if($access_level==$ug_name){ ?> selected <?php } ?> <?php if($user_access_level!='admin' && $ug_name=='admin'){ ?> disabled <?php } ?>><?=$ug_name?></option>
                          <?php
						  			  //}//if
									//}//if

						  	}//for
						  ?>
                        </select>
                        <span style="color:red; font-size:16px; display:none;" id="errusa9"></span>
                    </td>
                </tr>
        	</tbody>
        </table>
    </div><!--col-md-12-->
</div><!--row-->
</body>
</html>