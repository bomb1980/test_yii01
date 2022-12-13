<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Service 2</title>
<script>
	function callservice2(){
		//alert("test");
		var data1 = "aa=2"; 
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callservice2'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});	
	}
	
	function callgenaccno(){
		var data1 = "provicecode=73&registernumber=0505562007725";	
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callservice3'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});	
	}
	
	function calladdcropinfo(){
		var data1 = "action=add";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callservice4'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});		
	}
	
	function callchkregexists(){
		var data1 = "action=chk";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callservice5'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});		
	}
	
	function calladdcommittee(){
		var data1 = "action=add";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/addcommittee'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});			
	}
	
	function getlastcropid(){
		var data1 = "action=sch";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/getlastcorpid'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});				
	}
	
	function chkcommitteeexists(){
		//alert("test");
		var data1 = "action=chk";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/chkcommitteeexists'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});				
	}
	
	function calladdbbranch(){
		//alert("test");
		var data1 = "action=add";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/addbbranch'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});					
	}
	
	function callcreatelogevent(){
		var data1 = "action=add";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/createlogevent'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});				
	}
	
	function callshowfile(){
		var data1 = "action=readfile";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/showfile'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});			
	}
	
	function calldbdbyrn(){
		var data1 = "action=callservicedbd";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/calldbdbyrn'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});				
	}
	
	function calladdaccno(){
		var data1 = "action=testaddaccno";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/calladdaccno'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});				
	}
	
	function callshowrpt(){
		var data1 = "action=showrpt";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callshowrpt'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});	
	}
	
	function callcripvbran(){
		var data1="action=add&m=cripvbarn";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callcripvbran'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});		
	}
	
	function callupdatetob(){
		var data1="action=chg&m=cropvbran";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callupdatetob'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});			
	}
	
	function callupdatetoa(){
		var data1="action=chg&m=cropvbran";
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callupdatetoa'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   
			}
		});		
	}
	
	function callshowrpt2(){
		var data1 = "action=showrpt";
		alert(data1);
		window.open("http://localhost/printtoform/printformexcel2.php");	
	}
	
	function loadp1(){
		//alert("test");
	$('#re1').load('http://localhost/printtoform/printformexcel2.php', function(response, status, xhr) {
			if (status == "error") {
				var msg = "Sorry but there was an error: ";
				alert(msg + xhr.status + " " + xhr.statusText);
			}
		});	
	}
	
	function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
    }

	
	function openPrintDialogue(){
	  $('<iframe>', {
		name: 'myiframe',
		class: 'printFrame'
	  })
	  .appendTo('body')
	  .contents().find('body')
	  .append(`
		<h1>Day Jakkrit Rungwong</h1>
		<img src='coupon.png' />
	  `);
	
	  window.frames['myiframe'].focus();
	  window.frames['myiframe'].print();
	
	  setTimeout(() => { $(".printFrame").remove(); }, 1000);
	  
	};

	$('#mybtn1').on('click', openPrintDialogue);
	
</script>
</head>
<?php
	$fullPath1 = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'printformexcel2.php';
?>
<body>
	Service 2 <br>
    <button class="btn btn-info" onClick="javascript:callservice2();"><i class="fa fa-cog"></i> call create corpinfo_temp</button>
    <button class="btn btn-info" onClick="javascript:callgenaccno();"> call gen Accno 10 digit</button>
    <button class="btn btn-info" onClick="javascript:calladdcropinfo();"> add cropinfo_temp</button>
    <button class="btn btn-info" onClick="javascript:callchkregexists();"> check Registernumber exists</button>
    <button class="btn btn-info" onClick="javascript:getlastcropid();">ค้นหา id ล่าสุด</button>
    <button class="btn btn-info" onClick="javascript:calladdcommittee();"> add committee_temp</button>
    <button class="btn btn-info" onClick="javascript:chkcommitteeexists()">เช็คว่ามี  committee หรือยัง?</button>
    <button class="btn btn-info" onClick="javascript:calladdbbranch();">เพิ่มสาขา</button>
    <button class="btn btn-primary" onClick="javascript:callcreatelogevent();">create logevent</button>
    <button class="btn btn-warning" onClick="javascript:callshowfile();">read & download file</button>
    <button class="btn btn-danger" onClick="javascript:calldbdbyrn();">CallDBDByRegisterName</button>
    <button class="btn btn-success" onClick="javascript:calladdaccno();">test add accnotb</button>
    <button class="btn btn-info" onClick="javascript:callshowrpt();">test show report</button>
    <button class="btn btn-warning" onClick="javascript:callshowrpt2();">show report new tab</button>
    <button class="btn btn-primary" onClick="javascript:loadp1();">show page by javascript</button>
    <button class="btn btn-success" onClick="javascript:callcripvbran();">insert crop_v_bran</button>
    <button class="btn btn-success" onClick="javascript:callupdatetob();">update crop_v_bran is B</button>
    <button class="btn btn-success" onClick="javascript:callupdatetoa();">update crop_v_bran is A</button>
    <br>
    <?php  //echo Html::a('Link', ['site/about'], ['target'=>'_blank']); ?>
    <?php //echo CHtml::link('Link Text',array('site/about','target'=>'_blank')); ?>
    <a href="<?php echo Yii::app()->createAbsoluteUrl('site/callshowrpt1'); ?>" target="_blank">Print Preview!</a>

    <br>
    <div id="re1"></div>
  
<?php    

	
	//echo "{$fullPath1} <br>";
	//== เรียกหน้าอื่นมาแสดงด้วย php ===============================================================
    /*$url = 'http://localhost/printtoform/printformexcel2.php';
	$arrContextOptions=array(
		"ssl"=>array(
			"verify_peer"=>false,
			"verify_peer_name"=>false,
		),
	);  
	$content = file_get_contents($url, false, stream_context_create($arrContextOptions));
	echo $content;
	echo "<br>";*/
	//=======================================================================================


	
?>
<div id="divToPrint" style="display:none;">
  <div style="width:200px;height:300px;">
           <?php echo "test Day Jakkrit <br>"; ?>  
  </div>
</div>
<div>
  <input type="button" value="print by javascript" onclick="PrintDiv();" />
  <br>
  <input type="button" value="print by iframe" id="mybtn1" />
</div>
    
</body>
</html>