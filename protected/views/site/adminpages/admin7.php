<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Data Management</title>
<script>
	$(document).ready(function() {
		$('.panel').lobiPanel({
			reload: false,
			close: false,
			editTitle: false,
			sortable: true
			//minimize: false
		});
	});

	function gettablename(tbn){
		var data1 = 'action=gettablename&tbn=' + tbn;
		var tbntt = ' ' + tbn;
		if(tbn=='wpddb'){
			$("#tdwpddb").css("background-color","#E6E9FD");
			$("#tdwpdlogdb").css("background-color","");
			$("#tdwpdreportdb").css("background-color","");
			$("#tdetpdb").css("background-color","");
		}else if(tbn=='wpdlogdb'){
			$("#tdwpddb").css("background-color","");
			$("#tdwpdlogdb").css("background-color","#E6E9FD");
			$("#tdwpdreportdb").css("background-color","");
			$("#tdetpdb").css("background-color","");
		}else if(tbn=='wpdreportdb'){
			$("#tdwpddb").css("background-color","");
			$("#tdwpdlogdb").css("background-color","");
			$("#tdwpdreportdb").css("background-color","#E6E9FD");
			$("#tdetpdb").css("background-color","");
		}else if(tbn=='etpdb'){
			$("#tdwpddb").css("background-color","");
			$("#tdwpdlogdb").css("background-color","");
			$("#tdwpdreportdb").css("background-color","");
			$("#tdetpdb").css("background-color","#E6E9FD");
		}
		
		//alert(data1);
		$("#udbid").html("Use - " + tbn);
		$("#udb1").val(tbn);
		$('#tbn').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
        	type: "POST", 
        	url: "<?php echo Yii::app()->createAbsoluteUrl('site/gettablename'); ?>",      
        	data: data1,         
        	success: function (da)
        	{
				$("#dbntt").html(tbntt);
				$('#tbn').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
           		$("#tbn").html(da);
        	}
    	});     
	}//function
	

function executesql(){
    var sqlc = $("#sqlcommand").val();
	var udb1 = $("#udb1").val();
	//alert(sqlc + "," + udb1);
	
	if(!udb1){
		BootstrapDialog.alert('<font class="thfont5">?????????????????????????????? Database Name !</font>');
	}else if(!sqlc){
		BootstrapDialog.alert('<font class="thfont5">??????????????????????????? sql command !</font>');	
	}else{
		//alert('test');
		var data1 = 'action=execsql&sqlc=' + sqlc + '&udb1=' + udb1;
		//alert(data1);
		//exit();
		
		$("#sqlr").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		$.ajax({
        	type: "POST", 
        	url: "<?php echo Yii::app()->createAbsoluteUrl('site/executesqlc'); ?>",      
        	data: data1,         
        	success: function (da)
        	{
				$("#sqlr").html(da);
        	}
    	});//ajax     
			
	}//if
}//function

function executesqlrun(){
	var sqlcr = $("#sqlcommand").val();
	var udb1 = $("#udb1").val();
	if(udb1){ //?????????????????????????????????????????? wpddb
		if(sqlcr){
			var data1 = 'action=execsqlrun&sqlcr=' + sqlcr + '&udb1=' + udb1;
			$("#sqlr").html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
			$.ajax({
				type: "POST", 
				url: "<?php echo Yii::app()->createAbsoluteUrl('site/executesqlcr'); ?>",      
				data: data1,         
				success: function (da)
				{
					$("#sqlr").html(da);
				}
			});//ajax
		}else{
			BootstrapDialog.alert('<font class="thfont5">??????????????????????????? sql command !</font>');
		}
	}else{
		BootstrapDialog.alert('<font class="thfont5">?????????????????????????????? Database Name !</font>');
	}

}//function

</script>
</head>

<body>
	<div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        	<div class="row">
            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                	<div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-database"></i><font class="thfont5" style="font-size:24px;"> Database Name</font>
                        </div><!--panel heading-->
                        <div class="panel-body">
                            <div id="dbn" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                                <table class="thfont5">
                                	<tr><td id="tdwpddb"><i class="fa fa-cube"></i> <span style="color:#3333FF; cursor:pointer;" onClick="javascript:gettablename('wpddb');">wpddb</span></td></tr>
                                    <tr><td id="tdwpdlogdb"><i class="fa fa-cube"></i> <span style="color:#3333FF; cursor:pointer;" onClick="javascript:gettablename('wpdlogdb')">wpdlogdb</span></td></tr>
                                    <tr><td id="tdwpdreportdb"><i class="fa fa-cube"></i> <span style="color:#3333FF; cursor:pointer;" onClick="javascript:gettablename('wpdreportdb');">wpdreportdb</span></td></tr>
                                    <tr><td id="tdetpdb"><i class="fa fa-cube"></i> <span style="color:#3333FF; cursor:pointer;" onClick="javascript:gettablename('etpdb');">etpdb</span></td></tr>
                                </table>
                            </div>
                        </div><!--panelbody-->
                    </div><!--panel-->
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                	<div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-table"></i><font class="thfont5" style="font-size:24px;"><span id="dbntt"> Table Name</span></font>
                        </div><!--panel heading-->
                        <div class="panel-body" style="">
                            <div id="tbn" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                                
                            </div>
                        </div><!--panelbody-->
                    </div><!--panel-->
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            	<div class="panel panel-warning">
                    <div class="panel-heading">
                        <i class="fa fa-sitemap"></i><font class="thfont5" style="font-size:24px;"> SQL Command <span id="udbid"></span></font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="sqlc" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                            <div class="form-group">
 							 	<!--<label for="sqlcommand">SQL:</label>-->
  								<textarea class="form-control thfont5" rows="2" id="sqlcommand" placeholder="select * from... "></textarea>				
                                <input type="hidden" id="udb1" value="wpddb">
							</div>
                            <div class="form-group">
                            	<button class="btn btn-warning thfont5" onClick="javascript:executesql();"><i class="fa fa-bolt"></i> Execute</button>
                                <button class="btn btn-danger thfont5" onClick="javascript:executesqlrun();"><i class="fa fa-play"></i> Run</button>
                            </div>
                        </div>
                    </div><!--panelbody-->
                </div><!--panel-->    
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            	<div class="panel panel-success">
                    <div class="panel-heading">
                        <i class="fa fa-tasks"></i><font class="thfont5" style="font-size:24px;"><span id="dtn"> Data</span></font>
                    </div><!--panel heading-->
                    <div class="panel-body">
                        <div id="sqlr" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                            
                        </div>
                    </div><!--panelbody-->
                </div><!--panel-->     
            </div>
        </div>
    </div>
</body>
</html>