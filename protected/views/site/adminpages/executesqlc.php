<?php

//echo "{$sqlc}, {$udb1}"; // 'action' => $action, 'sqlc' => $sqlc, 'udb1' => $udb1);
if($udb1=="wpddb"){
	$connection = Yii::app()->db;//get connection
}else if($udb1=="wpdlogdb"){
	$connection = Yii::app()->db2;//get connection
}else if($udb1=="wpdreportdb"){
	$connection = Yii::app()->db3;//get connection
}else if($udb1=="etpdb"){
	$connection = Yii::app()->db4;//get connection
}


$tbnsql = explode(" ",$sqlc); //แยกคำสั่งออกมาเป็น ส่วนๆ เพื่อหาชื่อ table

	//$tbnsql[0]; //คำสั่ง select
	//$tbnsql[1]; //* หรือ fieldname
	//$tbnsql[2]; //from
	//$tbnsql[3]; //table name
	//$tbnsql[4]; //where , 
	//echo $tbnsql[3];
	
$sqlaction = $tbnsql[0];
$tbn1 = $tbnsql[3];

			
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?> execute sql command</title>
<script>
$(document).ready(function() {
	
	$('#fntb tfoot th').each( function () {
		var title = $(this).text();
		  $(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
	});
	
	
	if (typeof dataTable != 'undefined') {
		dataTable.destroy();
	}
	// DataTable
	var table = $('#fntb').DataTable({
		"responsive": true,
		"scrollX": true,
		//"order": [[ 3, "desc" ]],	
		"scrollY":        '50vh',
        "scrollCollapse": true,
        "paging":         true,
		"searching": true,
		"ordering": true,
		"autoWidth": true,
		"processing": true,
		"serverSide": true,
		"ajax": {
			  url:"<?php echo Yii::app()->createAbsoluteUrl("site/listdata2"); ?>",
			  "data": {
				"action": "listdata",
				"tbn1" : "<?=$tbn1?>",
				"udb1" : "<?=$udb1?>",
				"txtsql" : "<?=$sqlc?>",
			  },
			  type: "post",  // method  , by default get
			  dataType: "json",
			  error: function () {  // error handling
				  $(".employee-grid-error").html("");
				  $("#fntb").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				  $("#fntb_processing").css("display", "none");
			  }
		  },
		"lengthMenu": [ [ 10, 25, 50, 100], [ 10, 25, 50, 100] ],  
		"columnDefs": [
			{ "className": "dt-left", "targets": "_all" }
		 ],
		"dom": 'Blfptrip', //'Bflrtip',
		"buttons": {
			buttons: [
			{ extend: 'copy', text: '<i class="fa fa-copy"></i> Copy to clipboard', className: 'btn btn-success thfont5' },
			{ extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Export to excel', className: 'btn btn-primary thfont5' },
			//{ extend: 'columnsToggle' }
			//{ extend: 'colvis' }
			]
		},
	});
	
	//$('select[name=fntb_length]').addClass("form-control");
	//$('select[name=fntb_length]').css("width", "70px");
	
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

        <table id="fntb" class="table4_1 display row-border responsive nowrap">
        	<thead>
            	<tr>
                	<th>#</th>
                <?php
					foreach ($connection->schema->getTable($tbn1)->getColumnNames() as $columnName) {
				?>
                	<th><?=$columnName?></th>
                <?php		
					}//for
				?>
                </tr>
            </thead>
            <tbody>
            	<?php 
					/*if(strtolower($sqlaction)=='select'){
						try{
							$rawData = $connection->createCommand($sqlc)->queryAll(); //execute(); //queryAll();
							foreach($rawData as $key => $value) {
								*/
				?>
            	<!--<tr>-->
            	<?php
							/*  if(is_array($value)){	
								  foreach($value as $key2 => $value2) {	*/
				  ?>
								  <!--<td><?//$value2?></td>-->
				  <?php		
							/*	  }
							  }else{
								   //echo  $value . "<br>";
							  }
							}//foreech
						}catch (Exception $e){
	  						print_r($e->getMessage());
      						die();
    					}
					}//if(strtolower($sqlaction)=='select'){
						*/
				?>
                <!--</tr>-->
            </tbody>
            <tfoot>
            	<tr>
                	<th>#</th>
                <?php
					foreach ($connection->schema->getTable($tbn1)->getColumnNames() as $columnName){
				?>
                	<th><?=$columnName?></th>
                 <?php		
						//print $fieldnames[$i];
					}//for
				?>   
                </tr>
            </tfoot>
        </table>
        <?php
		
	//}//if
//}//foreach 
?>
</body>
</html>