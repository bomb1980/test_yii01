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
<title>User Group Data Table</title>
<script>
	$(document).ready(function() {
		
		$('#usgtb tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder=" '+title+'"  style="width:100%; padding-left:3px;" />' );
		});
		// DataTable
    	var table = $('#usgtb').DataTable({
			"scrollX": true,	
		});
		// Apply the search
		table.columns().every( function () {
			var that = this;
			$( 'input', this.footer() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
						.search( this.value )
						.draw();
				}
			});
		});
			
	});
</script>
</head>

<body>
<table id="usgtb" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
	<thead>
      <tr>
          <th style=" text-align:center; width:10%;">ID</th>
          <th style="width:20%;">ชื่อกลุ่ม</th>
          <th style="width:60%;">รายละเอียด</th>
          <th style="text-align:center; width:5%;">แก้ไข</th>
          <th style="text-align:center; width:5%;">ลบ</th>
      </tr>
    </thead>
    <tbody>
    <?php
		$qusg = new CDbCriteria( array(
					'condition' => "ug_status like :ug_status ",         
					'params'    => array(':ug_status' => "1")  
		));
		$modelusg = UsergroupTb::model()->findAll($qusg);
		$countusg = count($modelusg);
		$rowno = 1;
		foreach ($modelusg as $rows){
		    $ug_id = $rows->ug_id; 
		  	$ug_name = $rows->ug_name;
		  	$ug_createby = $rows->ug_createby;
		   	$ug_created = $rows->ug_created;
		   	$ug_updateby = $rows->ug_updateby;
		   	$ug_modified = $rows->ug_modified;
		   	$ug_remark = $rows->ug_remark;
		   	$ug_status = $rows->ug_status;
	?>
      <tr>
        <td style=" text-align:center; width:10%;"><?=$ug_id?></td>
        <td style="width:20%;"><?=$ug_name?></td>
        <td style="width:60%;"><?=$ug_remark?></td>
        <td style="text-align:center; width:5%;"><button class="btn btn-warning .btn-sm" onClick="javascript:loadusgfrm('chg',<?=$ug_id?>);" <?php if($user_access_level!='admin'){ ?> disabled <?php } ?>><i class="fa fa-edit"></i></button></td>
        <td style="text-align:center; width:5%;"><button class="btn btn-danger .btn-sm" onClick="javascript:calldelusg('del',<?=$ug_id?>,'<?=$ug_name?>');" <?php if($user_access_level!='admin'){ ?> disabled <?php } ?>><i class="fa fa-trash"></i></button></td>
      </tr>
    <?php
		  $rowno += 1;
	  }//foreach ($model as $rows){
	?>  
    </tbody>
    <tfoot>
    	<tr>
          <th style=" text-align:center; width:10%;">ID</th>
          <th style="width:20%;">ชื่อกลุ่ม</th>
          <th style="width:60%;">รายละเอียด</th>
          <td style="text-align:center; width:5%;"></td>
          <td style="text-align:center; width:5%;"></td>
        </tr>
    </tfoot>
</table>
</body>
</html>