<?php
	$ssocodeusr =  Yii::app()->user->address;
	$ssocodeusrsub =  substr(Yii::app()->user->address, 0, -2);
	
	//หาว่าเป็นส่วนกลางหรือจังหวัด จาก mas_ssobranch
	$mmsb = MasSsobranch::model()->findByAttributes(array('ssobranch_code'=>$ssocodeusr)); //mas_ssobranch
	if($mmsb){
		$ssobranch_type_id = $mmsb->ssobranch_type_id;
	}else{
		$ssobranch_type_id = 2;
	}
	
	if($ssocodeusr=="1050"){
		$ssobranch_type_id = 1;	
	}
	
	//ถ้าเป็นจังหวัดให้ ตัดเลช 2 หลักแรกออกมา เพื่อไปใส่เงื่อนไข
	if($ssobranch_type_id == 1){
		$strsqlled = "SELECT * FROM wpddb.ledriskcrop2_tb";
	}else if($ssobranch_type_id == 2){
		$strsqlled = "SELECT * FROM wpddb.ledriskcrop2_tb where  lrc_ssocode1 like '" . $ssocodeusrsub ."%' and lrc_ssocode2 like '" . $ssocodeusrsub . "%'";
	}
	
	//echo "{$ssocodeusrsub}, {$ssobranch_type_id}"; exit;
	
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Show risk group</title>
<style>
.w1{
	width:15px;
}
</style>

<script>


$(document).ready(function() {
	
	var scid = <?=$ssobranch_type_id?>;
	
	$('#rctb1 tfoot th').each( function () {
		var title = $(this).text();
		var scu = '<?=$ssocodeusr?>';
		var scrs = '<?=$ssocodeusrsub?>';
		
		
		/*if(title!='ssoc1' || title!='ssoc2'){
		  $(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		}else{
		  $(this).html('-');	
		}*/
		if(scid==1){
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );	
		}else{
		  if((title!='ssoc2') && (title!='ssoc1')){
			 $(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );	
		  }else{
			$(this).html( '<input type="text" placeholder="'+title+'" value="<?=$ssocodeusrsub?>" style="width:100%; padding-left:3px;" disabled />' ); //
			
			 /*table.columns( 3 );
        	 table.search( this.value );
        	 table.draw();	*/
		  }
		}//if
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
		"bFilter": false,
		"ajax": {
			  url:"<?php echo Yii::app()->createAbsoluteUrl("site/listdatariskcrop2"); ?>",
			  "data": {
				"action": "listdata",
				"tbn1" : "ledriskcrop2_tb",
				"udb1" : "wpddb",
				"txtsql" : "<?php echo $strsqlled ?>",//"SELECT * FROM wpddb.ledriskcrop2_tb where  lrc_ssocode1 like '73%' and lrc_ssocode2 like '73%'", //"SELECT * FROM wpddb.ledriskcrop2_tb",
			  },
			  type: "post",  // method  , by default get
			  dataType: "json",
			  error: function () {  // error handling
				  $(".employee-grid-error").html("");
				  $("#fntb").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				  $("#fntb_processing").css("display", "none");
			  }
			  
		  },
		"lengthMenu": [ [ 10, 25, 50, 100, 1000, 2000], [ 10, 25, 50, 100, 1000, 2000] ],  
		/*"columns": [                               
		  { "data": "NUMBER"},
		  //{ "data": "lrc_id"},
		  //{ "data": "lrc_id"},
		  //{ defaultContent: '<input type="button" class="deleteTrans" value="Delete"/>'}
        ],*/
		"columnDefs": [
			/*{ 
			  	"className": "dt-left", 
			  	"targets": "_all",
				//"data": null,
				//"defaultContent": "<input type='button' class='deleteTrans' value='Delete'/>" 
			},*/
			{
                "targets": [ 0 ], 
				"className": "dt-center w1",
				"render": function (data, type, row, meta){
        			if (type === 'display'){
						if(row.lrc_status=== '2'){
            				data = '<a style="text-decoration:none;" title="พิมพ์รายงานล่าสุด"  href="<?php echo Yii::app()->createAbsoluteUrl('site/callshowrptled33'); ?>?lrc_id=' + row.lrc_id  + '&lrc_accno=' + row.lrc_accno + '&lrc_registernumber=' + row.lrc_registernumber + '" target="_blank"><button class="btn btn-primary" style="padding-left:5px; padding-right:5px;"><span style="font-size:20px;"><i class="fa fa-print"></i></span></button></a>';
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
				"className": "dt-center w1",
				/*"data": null,
				"defaultContent": "<a href='javascript:;' onClick='javascript:callledservice();'><button class='btn btn-success'><span style='font-size:20px;'><i class='fa fa-check'></i> Check &nbsp;</span></button></a><div id='chkstatusid'></div>",*/		
				"render": function (data, type, row, meta){
					if (type === 'display'){
						data = "<a href='javascript:;' title='ตรวจสอบสถานะล่าสุดจาก LED' onClick='javascript:callledservice(\"" + row.lrc_registernumber + "\"," + row.lrc_id + ");'><button class='btn btn-success'><span style='font-size:20px;'><i class='fa fa-search'></i> </span></button></a><div id='chkstatus" + row.lrc_id + "'></div>";
					}else{
						data = null;	
					}
					return data;
				}//render
				
			},
			{
				"targets": [ 2 ],
				"className": "w1",
				"data": "lrc_accno",
			},
			{
				"targets": [ 3 ],
				"data": "lrc_bran",
				"visible": false,
                "searchable": false,
			},
			{
				"targets": [ 4 ],
				"data": "lrc_registernumber",
			},
			{
				"targets": [ 5 ],
				"width": "15%",
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
				"visible": false,
                "searchable": false,
			},
			{
				"targets": [ 9 ],
				"data": "lrc_amphur",
				"visible": false,
                "searchable": false,
			},
			{
				"targets": [ 10 ],
				"data": "lrc_province",
				"visible": false,
                "searchable": false,
			},
			{
				"targets": [ 11 ],
				"data": "lrc_zipcode",
				"visible": false,
                "searchable": false,
			},
			{
				"targets": [ 12 ],
				"data": "lrc_createby",
				"visible": false,
                "searchable": false,
			},
			{
				"targets": [ 13 ],
				"data": "lrc_created",
				"visible": false,
                "searchable": false,
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
				"visible": false,
                "searchable": false,
			},
			{
				"targets": [ 17 ],
				"className": "dt-center",
				"data": "lrc_status",
				/*"render": function (data, type, row, meta){
					if (type === 'display'){
						if(row.lrc_status=== '1'){
							data = 'ปกติ';
						}else if(row.lrc_status=== '2'){
							data = 'ถูกฟ้องฯ';
						}else{//if
							data = null;
						}//if
					}else{//if
						data = null;
					}//if
					return data;
				},//render
				"searchable": true,*/
			},
			{
				"targets": [ 18 ],
				"data": "lrpt_abs_prot",
			},
			{
				"targets": [ 19 ],
				"data": "lrpt_abs_gaz",
			},
			{
				"targets": [ 20 ],
				"data": "lrpt_abs_due",
			},
			{
				"targets": [ 21 ],
				"data": "lrpt_bkr_prot",
			}
		],
		"createdRow": function( row, data, dataIndex){
			//alert(data["lrc_accno"]);
		  if( data["lrc_status"] ==  "2"){
			  //$(row).addClass('redClass');
			  $(row).css('background-color', '#FFD7D7')
		  }
        },
		"dom": 'Blptrip', //'Bflrtip',
		"buttons": {
			buttons: [
			{ extend: 'copy', text: '<i class="fa fa-copy"></i> Copy to clipboard', className: 'btn btn-success thfont5' },
			{ extend: 'excel', text: '<i class="fa fa-file-excel-o"></i> Export to excel', className: 'btn btn-primary thfont5' },
			//{ extend: 'columnsToggle' }
			//{ extend: 'colvis', text: '<i class="fa fa-check"></i> Columns Visibility', className: 'btn btn-warning thfont5' }
			]
		},
		//"oSearch": {"sSearch": "73"},
	});
	
	if(scid===2){
		table.columns(6).search(<?=$ssocodeusrsub?>).draw();
	}
	
	$('#rctb1 tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        //alert( data['lrc_accno'] +"'s salary is: "+ data['lrc_registernumber'] );
		//<a style='text-decoration:none' href=\"<?php echo Yii::app()->createAbsoluteUrl('site/callshowrptled33',  array('lrc_id' => '1000001873')); ?>\" target='_blank'></a>
    } );
	
	//table.search(this.value).draw();
	//table.columns(6).search( this.value ).draw();
	
	table.columns().every( function () {
		var that = this;
		$( 'input', this.footer() ).on( 'keyup keypress change ', function () {
			if ( that.search() !== this.value ) {
				that
					.search( this.value )
					.draw();
			}
		});
	});
	
	/*$('#rctb1').on('load', function () {
		table.columns(6).search( this.value ).draw();
	});*/
	
	
	
});
function addtest(){
	$.ajax({
		type: "POST", 
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/addnewtest'); ?>",      
		success: function (da)
		{
		   console.log(da);
		//alert(da);
		}
	});
}

function serviceled(){
	$.ajax({
		type: "POST", 
		url: "<?php echo Yii::app()->createAbsoluteUrl('site/serviceled'); ?>",      
		success: function (da)
		{
		   console.log(da);
		//alert(da);
		}
	});
}


function callledservice(rgn, rid){
	         
	//alert("test" + "," + rgn + "," + rid);	
	var data1 = 'action=callledservice&rgn=' + rgn;
	var table = '';
	table = new $('#rctb1').DataTable(); //กำหนด instant datatable
	
	$('#chkstatus' + rid).html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	$.ajax({
		type: "POST", 
		url: "<?php echo Yii::app()->createAbsoluteUrl('led/callledservicecall'); ?>",      
		data: data1,         
		success: function (da)
		{
		   BootstrapDialog.alert(" <font class='thfont5'>" + da + "</font>");
		   $("#chkstatus" + rid).html("");
		   table.draw( 'page' ); 
		   //refeach datatable หน้าปัจจุบัน
		   //$('#rctb1').DataTable().ajax.reload();
		   //table.page( 'next' ).draw( 'page' );
		   //table.row(0).invalidate();
		   //table.row(0).invalidate().draw();
		   //$("#rctb1").ajax.reload();
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
	color:#000000;
}
.table4_1,.table4_1 th,.table4_1 td {
	font-size:0.91em;
	/*text-align:center;*/
	padding:0px;
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
		display:none;
		width:100%;
		height:100%;
	}
	
	.table4_1 tfoot{
		display:none;
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
<table  id="rctb1" class="table4_1"> <!--table4_1 display row-border responsive nowrap-->
 	<thead>
    	<tr>
           <th>#</th>
           <th>สอบถาม<br>สถานะ<br>ล่าสุด LED</th>
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
           <th>ตรวจสอบ<br>ล่าสุด<br>โดย</th>
           <th>ตรวจสอบ<br>ล่าสุด<br>เมื่อ</th>
           <th>หมายเหตุ</th>
           <th>สถานะ</th>
           <th>วันที่พิทักษ์<br>ทรัพย์เด็ดขาด</th>
           <th>วันที่ประกาศ<br>ในราชกิจจาฯ</th>
           <th>วันที่ครบกำหนด<br>ยื่นคำขอฯ</th>
           <th>วันที่พิพากษา<br>ให้ล้มละลาย</th>
        </tr>
    </thead>
    <tbody style="color:#000;">
    </tbody>
    <tfoot>
    	<tr>
           <th>#</th>
           <th>สอบถามสถานะ</th>
           <th>เลขบัญชีนายจ้าง</th>
           <th>เลขสาขา</th>
           <th>เลขนิติบุคคล 13 หลัก</th>
           <th>ชื่อสถานประกอบการ</th>
           <th>ssoc1</th>
           <th>ssoc2</th>
           <th>ที่อยู่</th>
           <th>อำเภอ</th>
           <th>จังหวัด</th>
           <th>รหัสไปรษณีย์</th>
           <th>บันทึกโดย</th>
           <th>บันทึกเมื่อ</th>
           <th>ตรวจสอบล่าสุดโดย</th>
           <th>ตรวจสอบล่าสุดมื่อ</th>
           <th>หมายเหตุ</th>
           <th>สถานะ</th>
           <th>วันที่พิทักษ์ทรัพย์เด็ดขาด</th>
           <th>วันที่ประกาศในราชกิจจาฯ</th>
           <th>วันที่ครบกำหนดยื่นคำขอฯ</th>
           <th>วันที่พิพากษาให้ล้มละลาย</th>
        </tr>
    </tfoot>
 </table>
</body>
</html>