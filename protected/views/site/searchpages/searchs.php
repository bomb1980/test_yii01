<?php
/*if(!isset(Yii::app()->session['user_loginname'])){
 	Yii::app()->CIdpLogin->getIdPinfo();
}*/

 $ssobrncode = Yii::app()->user->address;
 $pvcode = substr($ssobrncode,0,2);
 
 if($ssobrncode!='1050'){
   //ค้นหาว่า เป็นส่วนกลางหรือจังหวัด
   $bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code'=>$ssobrncode));
   $bcn = $bcr->name;	
   $bct = $bcr->ssobranch_type_id;
  }else{
	 $bct = 1; 
  }
   
   if($bct==1){
	   if($ssobrncode=='1057'){
		  $perled = 'y';	 
	   }else if($ssobrncode=='1054'){
		   $perled = 'y';
	   }else if($ssobrncode=='1050'){
		   $perled = 'y';
	   }else{
		   $perled = 'n';
	   }
   }else{
	  $perled = 'y';
   }
 

?>

<?php
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
	  
  }
?>

<?php
 $this->pageTitle=Yii::app()->name . ' - Search';
 $this->breadcrumbs=array(
	'Search',
 );
?>


<div class="row" style="padding-bottom:10px;">
<?php if(isset($this->breadcrumbs)):?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    )); ?><!-- breadcrumbs -->
<?php endif?>
</div>
<script>
	function opensearch(snum){
		$("#a2").show("slow");
		var data1 = 'snum=' + snum;
		$.ajax({
        	type: "POST", 
        	url: "<?php echo Yii::app()->createAbsoluteUrl('site/opensearch'); ?>",      
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
.mypndbtn {
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

<div id="a1">

	<div class="" style="padding-bottom:15px;">
      <div class="main_subtitle fontcolor1">ENTREPRENEUR ● DATA CENTER</div>
      <!--<div class="main_title">Search</div>-->
   	</div>
    
     <div id="myDIV" style="padding-bottom:15px;">
  		<button class="mybtn myactive" onclick="javascript:opensearch(1);"><i class="fa fa-address-card"></i> ขึ้นทะเบียนลูกจ้าง SSO</button>
  		<!--<button class="mybtn " onclick="javascript:opensearch(2);"><i class="fa fa-calendar"></i> Search By Date</button>-->
        <button class="mybtn" onclick="javascript:opensearch(3);" title="Department Of Bussiness Development"><i class="fa fa-institution"></i> DBD : กรมพัฒนาธุรกิจการค้า</button>
        <?php if($user_access_level=='admin' || $user_access_level=='financial' || $user_access_level=='admin-audit' ){ ?>
        <button class="mybtn" onclick="javascript:opensearch(5);" title="DGA Service งบการเงิน"><i class="fa fa-area-chart"></i> DGA : งบการเงิน</button>
        <?php } ?>
        <?php if($perled=='y'){ ?>
        <button class="mybtn" onclick="javascript:opensearch(4);" title="Legal Execution Department"><i class="fa fa-institution"></i> LED : กรมบังคับคดี (ล้มละลาย) </button>
        <?php } ?>
	    <button class="mybtn " onclick="javascript:opensearch(6);"><i class="fa fa-pencil-square-o"></i>บันทึกผลตรวจสอบ</button>
		<?php if($user_access_level=='admin' || $user_access_level=='financial' || $user_access_level=='admin-audit' ){ ?>
	    <button class="mybtn " onclick="javascript:opensearch(7);"><i class="fa fa-pencil-square-o"></i>ภงด. กรมสรรพากร</button>
		<?php } ?>

		
	</div>
    
    <div id="a2"></div>
    
</div>

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
		//$('#a1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		//$("#a1").load("<?php echo Yii::app()->createAbsoluteUrl('site/openhome'); ?>");
		$("#m3").addClass( "active" );
		$("#geninfo1").hide("fast");
		opensearch(1);
	});
</script>