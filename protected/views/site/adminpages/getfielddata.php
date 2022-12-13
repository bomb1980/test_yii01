<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Data field columns</title>
<script>
$(document).ready(function() {
	
	$('#fntb tfoot th').each( function () {
		var title = $(this).text();
		$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
	});
	
	// DataTable
	var table = $('#fntb').DataTable({
		"scrollX": true,
		//"order": [[ 3, "desc" ]],	
		scrollY:        '50vh',
        scrollCollapse: true,
        paging:         false,
		"dom": 'Bflrtip',
		"buttons": {
			buttons: [
			{ extend: 'copy', text: '<i class="fa fa-copy"></i> Copy to clipboard', className: 'btn btn-success thfont5' },
			{ extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Export to excel', className: 'btn btn-primary thfont5' },
			//{ extend: 'columnsToggle' }
			//{ extend: 'colvis' }
			]
		},
	});
	
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
	padding:5px;
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
	.table4_1 td:nth-of-type(1)
	.table4_1 td:nth-of-type(2)
	.table4_1 td:nth-of-type(3)
	.table4_1 td:nth-of-type(4)
	.table4_1 td:nth-of-type(5)
	.table4_1 td:nth-of-type(6)
	
	
}

</style>
</head>

<body>
<?php
	//echo "{$tbn1},{$tbn}";
if($tbn=="wpddb"){
	$connection = Yii::app()->db;//get connection
}else if($tbn=="wpdlogdb"){
	$connection = Yii::app()->db2;//get connection
}else if($tbn=="wpdreportdb"){
	$connection = Yii::app()->db3;//get connection
}
	
$dbSchema = $connection->schema;
//or $connection->getSchema();
$tables = $dbSchema->getTables();//returns array of tbl schema's
foreach($tables as $tbl)
{
    //echo $tbl->rawName, ':<br/>', implode(', ', $tbl->columnNames), '<br/>';
	
	$tbn2 =	str_replace("`","",$tbl->rawName); 
	$modelname = str_replace("_","",$tbn2);
	
	if($tbn2==$tbn1){
		//var_dump($tbl->columnNames);
		//echo "{$modelname}";
		//var_dump($modeldata);
		//echo $cems;
		
		$fieldnames = $tbl->columnNames;
		$cfn = count($fieldnames);
		
		
		?>
        <table id="fntb" class="table4_1 display row-border responsive nowrap">
        	<thead>
            	<tr>
                <?php
					for ($i = 0; $i < $cfn; $i++) {
				?>
                	<th><?=$fieldnames[$i]?></th>
                <?php		
						//print $fieldnames[$i];
					}//for
				?>
                </tr>
            </thead>
            <tbody>
            	<?php 
					//$modeldata = $modelname::model()->findAll();
					//foreach ($modeldata as $rows){
					$criteria = new CDbCriteria;
					//$criteria->condition = 'content_1=:c';
					$criteria->limit = 100;
					//$criteria->params = array(':c' => $id);	
					$modeldata = $modelname::model()->findAll($criteria);
					$cems = count($modeldata);
					foreach ($modeldata as $rows){
						
				?>
            	<tr>
            	<?php
						//for ($i = 0; $i < $cfn; $i++) {
						 foreach($rows as $key => $p){		
				?>
                			<td><?=$rows[$key]?></td>
                <?php		
				    	 }//foreach2
						 
					}//foreach1	
						
				?>
                </tr>
            </tbody>
            <tfoot>
            	<tr>
                <?php
					for ($i = 0; $i < $cfn; $i++) {
				?>
                	<th><?=$fieldnames[$i]?></th>
                 <?php		
						//print $fieldnames[$i];
					}//for
				?>   
                </tr>
            </tfoot>
        </table>
        <?php
		
	}//if
}
?>
</body>
</html>