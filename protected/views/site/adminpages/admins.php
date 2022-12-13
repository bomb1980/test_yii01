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

<?php
 $this->pageTitle=Yii::app()->name . ' - Administrator';
 $this->breadcrumbs=array(
	'Administrator',
 );
?>
<div class="row" style="padding-bottom:10px;">
<?php if(isset($this->breadcrumbs)):?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    )); ?><!-- breadcrumbs -->
<?php endif?>
</div>

<style>
/* Style the buttons */
.mybtn {
  border: none;
  border-radius:5px;
  outline: none;
  padding: 10px 16px;
  background-color: #f1f1f1;
  cursor: pointer;
  font-size: 18px;
}

/* Style the active class, and buttons on mouse-over */
.myactive, .mybtn:hover {
  background-color: #666;
  color: white;
}
</style>

<script>
	/*function readusers(){
		$('#a2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$("#a2").load("<?php echo Yii::app()->createAbsoluteUrl('site/readusers'); ?>");
	}
	function readservices(){
		$('#a2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$("#a2").load("<?php echo Yii::app()->createAbsoluteUrl('site/readservices'); ?>");
	}*/
	
	function openadmin(snum){
		$("#a2").show("slow");
		var data1 = 'snum=' + snum;
		$.ajax({
        	type: "POST", 
        	url: "<?php echo Yii::app()->createAbsoluteUrl('site/openadmin'); ?>",      
        	data: data1,         
        	success: function (da)
        	{
           		if(da=='Y'){
					$("#a2").html(da);
				}else{
					$("#a2").html(da);
				}
        	}
    	});     
		window.scrollTo(500, 0); 	
	}
</script>

<div id="a1">

	<div class="" style="padding-bottom:15px;">
      <div class="main_subtitle fontcolor1">ENTREPRENEUR ● DATA CENTER</div>
      <!--<div class="main_title">Administrator</div>-->
   	</div>
    
 	<div id="myDIV" style="padding-bottom:15px;">
    	<?php if($user_access_level=='admin' || $user_access_level=='admin-audit'){ ?>
  		<button class="mybtn myactive" onclick="javascript:openadmin(1);"><i class="fa fa-users"></i> User Group</button>
        <?php } ?>
        <?php if($user_access_level=='admin' || $user_access_level=='admin-audit'){ ?>
  		<button class="mybtn" onclick="javascript:openadmin(2);"><i class="fa fa-user"></i> Users</button>
        <?php } ?>
        <?php if($user_access_level=='admin'){ ?>
        <button class="mybtn" onclick="javascript:openadmin(7);"><i class="fa fa-database"></i> Data Management</button>
        <?php } ?>
        
	</div>
    <div id="a2"></div>

<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("mybtn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("myactive");
  current[0].className = current[0].className.replace(" myactive", "");
  this.className += " myactive";
  });
}
</script>
<script>
	$(document).ready(function() {
		//$('#a2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		//$("#a2").load("<?php echo Yii::app()->createAbsoluteUrl('site/readusers'); ?>");
		$("#m5").addClass( "active" );
		//$("#geninfo1").hide("fast");
		openadmin(1);
	});
</script>
    
</div>