<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Show text file name</title>


<script>
$(document).ready(function() {
			
		$('#txtfn1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");	
		$("#txtfn1").load("<?php echo Yii::app()->createAbsoluteUrl('site/getfilenamealltb'); ?>");
	   
});

function selectfiletxt(fnv){
	//alert(fnv);
	$("#txt1").val(fnv);
	dilgfn.close();
}

/*
function downloadtxtfile(){	
	var dwntxt = $("#dwntxt1").val();
	var data1 = 'action=downloadfile&dwntxt=' + dwntxt;
	//alert(data1);
	$('#txtfn1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/downloadtxtfilefrmsftp'); ?>",      
		data: data1,         
		success: function (da)
		{
		   BootstrapDialog.alert(" <font class='thfont5'>" + da + "</font>");	
		   //$("#txtfn1").html(da);
		   $("#txtfn1").load("<?php echo Yii::app()->createAbsoluteUrl('site/getfilenamealltb'); ?>");
		}
	});
	 
}
*/
</script>
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
	.table4_1 td:nth-of-type(5):after  { content: ""; }
	.table4_1 td:nth-of-type(6):before { content: ""; }
	.table4_1 td:nth-of-type(6):after  { content: ""; }
	
}
</style>
</head>

<body>

</body>
	
	<!--<div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        	<div class="form-group" >
  			<div class="thfont4" style="">Download Textfile Sapains from SFTP:
            	<div class="input-group">
            		<input type="text" class="form-control thfont5" id="dwntxt1" style="height:auto;" placeholder="<?=$fns?>" value="<?=$fns?>">
                    <span class="input-group-btn" id="loading1">
        				<button class="btn btn-warning thfont5" type="button" title="download textfile from sftp"  onClick="javascript:downloadtxtfile();"><i class="fa fa-download"></i></button>
   					</span>
                </div>
            </div>
        </div>
        
        </div>
    </div>-->
    
	<div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div id="txtfn1"></div>
        </div>
    </div>
    
</html>