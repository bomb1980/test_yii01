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
<title>User All</title>
<script>
	$(document).ready(function() {
		
		$('#usatb tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder=" '+title+'"  style="width:100%; padding-left:3px;" />' );
		});
		// DataTable
    	var table = $('#usatb').DataTable({
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
<?php
/*
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $contact_number
 * @property string $address
 * @property string $username
 * @property string $password
 * @property string $access_level
 * @property string $access_code
 * @property integer $status
 * @property string $image
 * @property string $created
 * @property string $modified
*/
?>
<body>
<table id="usatb" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
	<thead>
      <tr>
          <th style=" text-align:center; width:5%;">ID</th>
          <th style="width:15%;">ชื่อ</th>
          <th style="width:15%;">สกุล</th>
          <th style="width:10%;">branchcode</th>
          <th style="width:10%;">branchtype</th>
          <th style="width:15%;">username</th>
          <th style="width:10%;">email</th>
          <th style="width:10%;">เบอร์โทรศัพท์</th>
          <th style="text-align:center; width:5%;">แก้ไข</th>
          <th style="text-align:center; width:5%;">ลบ</th>
      </tr>
    </thead>
    <tbody>
    <?php
		$qusa = new CDbCriteria( array(
					'condition' => "status like :status ",         
					'params'    => array(':status' => "1")  
		));
		$modelusa = Users::model()->findAll($qusa);
		$countusa = count($modelusa);
		$rowno = 1;
		foreach ($modelusa as $rows){
		    $id = $rows->id; 
			$firstname = $rows->firstname;
			$lastname = $rows->lastname;
			$email = $rows->email;
			$contact_number = $rows->contact_number;
			$address = $rows->address;
			$username = $rows->username;
			$password = $rows->password;
			$access_level = $rows->access_level;
			$access_code = $rows->access_code;
			$status = $rows->status;
			$image = $rows->image;
		  	$created = $rows->created;
			$modified = $rows->modified;
			
			$fullname = $firstname . "  " . $lastname;
	?>
      <tr>
        <td style=" text-align:center; width:5%;"><?=$id?></td>
        <td style="width:15%;"><?=$firstname?></td>
        <td style="width:15%;"><?=$lastname?></td>
        <td style="width:10%;"><?=$address?></td>
        <td style="width:10%;"><?=$access_code?></td>
        <td style="width:15%;"><?=$username?></td>
        <td style="width:10%;"><?=$email?></td>
        <td style="width:10%;"><?=$contact_number?></td>
        <td style="text-align:center; width:5%;"><button class="btn btn-warning .btn-sm" onClick="javascript:loadusafrm('chg',<?=$id?>);"><i class="fa fa-edit"></i></button></td>
        <td style="text-align:center; width:5%;"><button class="btn btn-danger .btn-sm" onClick="javascript:calldelusa('del',<?=$id?>,'<?=$fullname?>');" <?php if($user_access_level!='admin'){ ?> disabled <?php } ?>><i class="fa fa-trash"></i></button></td>
      </tr>
    <?php
		  $rowno += 1;
	  }//foreach ($model as $rows){
	?>  
    </tbody>
    <tfoot>
    	<tr>
          <th style=" text-align:center; width:5%;">ID</th>
          <th style="width:15%;">ชื่อ</th>
          <th style="width:15%;">สกุล</th>
          <th style="width:10%;">branchcode</th>
          <th style="width:10%;">branchtype</th>
          <th style="width:15%;">username</th>
          <th style="width:10%;">email</th>
          <th style="width:10%;">เบอร์โทรศัพท์</th>
          <td style="text-align:center; width:5%;"></td>
          <td style="text-align:center; width:5%;"></td>
        </tr>
    </tfoot>
</table>
</body>
</html>