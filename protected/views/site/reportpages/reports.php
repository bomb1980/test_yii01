<?php
/*if(!isset(Yii::app()->session['user_loginname'])){
 	Yii::app()->CIdpLogin->getIdPinfo();
}*/
?>

<?php
 $this->pageTitle=Yii::app()->name . ' - Reports';
 $this->breadcrumbs=array(
	'Reports',
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
	function openreport(snum){
		/*$("#a2").slideDown("500", function () {
    		$("#a2").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
    		$("#a2").load("<?php echo Yii::app()->createAbsoluteUrl('site/dashboards'); ?>");
		});*/	
		$("#a2").show("slow");
		var data1 = 'snum=' + snum;
		$.ajax({
        	type: "POST", 
        	url: "<?php echo Yii::app()->createAbsoluteUrl('site/openreport'); ?>",      
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
      <!--<div class="main_title">Report</div>-->
   	</div>
    
    <div id="myDIV" style="padding-bottom:15px;">
  		<!--<button class="mybtn myactive" onclick="javascript:openreport(1);"><i class="fa fa-bar-chart"></i> Dashboard</button>
  		<button class="mybtn" onclick="javascript:openreport(2);"><i class="fa fa-database"></i> Transection Log</button>-->
        <button class="mybtn myactive" onclick="javascript:openreport(3);"><i class="fa fa-newspaper-o"></i> WPD Report</button>
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
		$('#a2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		//$("#a2").load("<?php echo Yii::app()->createAbsoluteUrl('site/dashboards'); ?>");
		$("#m4").addClass( "active" );
		$("#geninfo1").hide("fast");
		openreport(3);
		
	});
</script>