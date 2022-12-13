<?php
set_time_limit(0);
ini_set("max_execution_time","0");
ini_set("memory_limit","9999M"); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>get text file risk company</title>
<script>
  $(document).ready(function() {
	  var table = $('#ledtf1').DataTable({
		 "scrollY": '50vh',
		 "paging": false,
		 "searching": true,
		 "ordering": false,
		 "autoWidth": true,
	  });
  });
  
  function chkriskcrop(ltf_name){
	//alert(ltf_name);  
	var ltf_name = ltf_name;
	var data1 = 'action=chkdatafile&ltf_name=' + ltf_name;
	//alert(data1);
	$('#tbrn2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/chkriskcrop'); ?>",      
		data: data1,         
		success: function (da)
		{
		   BootstrapDialog.alert(" <font class='thfont5'>" + da + "</font>");	
		   $("#tbrn2").load("<?php echo Yii::app()->createAbsoluteUrl('site/getriskcrop'); ?>");
		   $("#tbrn1").load("<?php echo Yii::app()->createAbsoluteUrl('site/gettxtfilesiskcrop'); ?>");
		}
	});
  }
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
	.table4_1 td:nth-of-type(5):after { content: "";}
	.table4_1 td:nth-of-type(6):before { content: ""; }
	.table4_1 td:nth-of-type(6):after { content: "";}
	
}
</style>
</head>

<body>
 <table id="ledtf1" class="table4_1 display row-border responsive nowrap">
 	<thead>
    	<tr>
        	<th>ชื่อไฟล์</th>
            <th>จำนวน</th>
            <th>สถานะ</th>
        </tr>
    </thead>
    <tbody>
    	<?php
		$qltf = new CDbCriteria( array(
			'condition' => "ltf_status >= :ltf_status ",         
			'params'    => array(':ltf_status' => "1"),
			'order' =>  "ltf_modified DESC"   
		));
		$mltf = LedtextfileTb::model()->findAll($qltf);
		$cltf = count($mltf);
		$rowno = 1;
		foreach ($mltf as $rows){
			 $ltf_id = $rows->ltf_id;
			 $ltf_name = $rows->ltf_name;
			 $ltf_path = $rows->ltf_path;
			 $ltf_countud = $rows->ltf_countud;
			 $ltf_statusud = $rows->ltf_statusud;
			 $ltf_statusupload = $rows->ltf_statusupload;
			 $ltf_createby = $rows->ltf_createby;
			 $ltf_created = $rows->ltf_created;
			 $ltf_updateby = $rows->ltf_updateby;
			 $ltf_modified = $rows->ltf_modified;
			 $ltf_remark = $rows->ltf_remark;
			 $ltf_status = $rows->ltf_status;
		?>
    	<tr>
        	<td><?=$ltf_name?></td>
            <td><div style="text-align:right;"><?=$ltf_countud?></div></td>
            <td><?php if($ltf_statusud=='N'){ ?><button class="btn btn-primary thfont5" onClick="chkriskcrop('<?=$ltf_name?>');"><i class="fa fa-check"></i> Check</button><?php }else{ ?><div style="color:#0C0;">Success</div><?php } ?></td>
        </tr>
        <?php
			$rowno += 1;	
		}//for
		?>
    </tbody>
 </table>
</body>
</html>