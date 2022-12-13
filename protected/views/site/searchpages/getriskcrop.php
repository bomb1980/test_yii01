<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>get risk company</title>
<script>
$(document).ready(function() {
	
	$('#rctb1 tfoot th').each( function () {
		var title = $(this).text();
		  $(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
	});
	
	if (typeof dataTable != 'undefined') {
		dataTable.destroy();
	}
	
	// DataTable
	var table = $('#rctb1').DataTable({
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
			  url:"<?php echo Yii::app()->createAbsoluteUrl("site/listdatariskcrop"); ?>",
			  "data": {
				"action": "listdata",
				"tbn1" : "ledriskcrop_tb",
				"udb1" : "wpddb",
				"txtsql" : "SELECT * FROM wpddb.ledriskcrop_tb",
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
		/*"columns": [                               
		  { "data": "NUMBER"},
		  //{ "data": "lrc_id"},
		  //{ "data": "lrc_id"},
		  //{ defaultContent: '<input type="button" class="deleteTrans" value="Delete"/>'}
        ],*/
		"columnDefs": [
			{ 
			  	"className": "dt-left", 
			  	"targets": "_all",
				//"data": null,
				//"defaultContent": "<input type='button' class='deleteTrans' value='Delete'/>" 
			},
			{
                "targets": [ 0 ], 
				"render": function (data, type, row, meta){
        			if (type === 'display'){
						if(row.lrc_status=== '2'){
            				data = '<a style="text-decoration:none;"  href="<?php echo Yii::app()->createAbsoluteUrl('site/callshowrptled33'); ?>?lrc_id=' + row.lrc_id  + '&lrc_accno=' + row.lrc_accno + '&lrc_registernumber=' + row.lrc_registernumber + '" target="_blank"><button style="padding-left:5px; padding-right:5px;"><span style="font-size:20px;"><i class="fa fa-print"></i></span></button></a>';
						}else{
							data = null;
						}
        			}else{
						data = null;
					}
        			return data;
    			}
				//"data": null,
				//"defaultContent": "<button class='btn btn-success thfont5'><i class='fa fa-print'></i></button>",
                //"visible": false,
                //"searchable": false,
            },
			{
				"targets": [ 1 ],
				"data": "lrc_id",
			},
			{
				"targets": [ 2 ],
				"data": "lrc_accno",
			},
			{
				"targets": [ 3 ],
				"data": "lrc_bran",
			},
			{
				"targets": [ 4 ],
				"data": "lrc_registernumber",
			},
			{
				"targets": [ 5 ],
				"data": "lrc_registername",
			},
			{
				"targets": [ 6 ],
				"data": "lrc_ssocode1",
			},
			{
				"targets": [ 7 ],
				"data": "lrc_ssocode2",
			},
			{
				"targets": [ 8 ],
				"data": "lrc_address",
			},
			{
				"targets": [ 9 ],
				"data": "lrc_amphur",
			},
			{
				"targets": [ 10 ],
				"data": "lrc_province",
			},
			{
				"targets": [ 11 ],
				"data": "lrc_zipcode",
			},
			{
				"targets": [ 12 ],
				"data": "lrc_createby",
			},
			{
				"targets": [ 13 ],
				"data": "lrc_created",
			},
			{
				"targets": [ 14 ],
				"data": "lrc_updateby",
			},
			{
				"targets": [ 15 ],
				"data": "lrc_modified",
			},
			{
				"targets": [ 16 ],
				"data": "lrc_remark",
			},
			{
				"targets": [ 17 ],
				"data": "lrc_status",
			}
		],
		"createdRow": function( row, data, dataIndex){
			//alert(data["lrc_accno"]);
		  if( data["lrc_status"] ==  "2"){
			  //$(row).addClass('redClass');
			  $(row).css('background-color', '#FFD7D7')
		  }
        },
		"dom": 'Blfptrip', //'Bflrtip',
		"buttons": {
			buttons: [
			//{ extend: 'copy', text: '<i class="fa fa-copy"></i> Copy to clipboard', className: 'btn btn-success thfont5' },
			//{ extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Export to excel', className: 'btn btn-primary thfont5' },
			//{ extend: 'columnsToggle' }
			//{ extend: 'colvis' }
			]
		},
	});
	
	$('#rctb1 tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        //alert( data['lrc_accno'] +"'s salary is: "+ data['lrc_registernumber'] );
		//<a style='text-decoration:none' href=\"<?php echo Yii::app()->createAbsoluteUrl('site/callshowrptled33',  array('lrc_id' => '1000001873')); ?>\" target='_blank'></a>
    } );
	
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

 <table id="rctb1" class="table4_1 display row-border responsive nowrap">
 	<thead>
    	<tr>
           <th>#</th>
           <th>id</th>
           <th>เลขบัญชี<br>นายจ้าง</th>
           <th>เลขสาขา</th>
           <th>เลขนิติบุคคล 13 หลัก</th>
           <th>ชื่อสถานประกอบการ</th>
           <th>สปส.<br>รับผิดชอบ</th>
           <th>สปส.<br>เร่งรัดหนี้</th>
           <th>ที่อยู่</th>
           <th>อำเภอ</th>
           <th>จังหวัด</th>
           <th>รหัสไปรษณีย์</th>
           <th>บันทึกโดย</th>
           <th>บันทึกเมื่อ</th>
           <th>ปรับปรุงโดย</th>
           <th>ปรับปรุงเมื่อ</th>
           <th>หมายเหตุ</th>
           <th>สถานะ</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    	<tr>
           <th>#</th>
           <th>id</th>
           <th>เลขบัญชี<br>นายจ้าง</th>
           <th>เลขสาขา</th>
           <th>เลขนิติบุคคล 13 หลัก</th>
           <th>ชื่อสถานประกอบการ</th>
           <th>สปส.<br>รับผิดชอบ</th>
           <th>สปส.<br>เร่งรัดหนี้</th>
           <th>ที่อยู่</th>
           <th>อำเภอ</th>
           <th>จังหวัด</th>
           <th>รหัสไปรษณีย์</th>
           <th>บันทึกโดย</th>
           <th>บันทึกเมื่อ</th>
           <th>ปรับปรุงโดย</th>
           <th>ปรับปรุงเมื่อ</th>
           <th>หมายเหตุ</th>
           <th>สถานะ</th>
        </tr>
    </tfoot>
 </table>
</body>
</html>