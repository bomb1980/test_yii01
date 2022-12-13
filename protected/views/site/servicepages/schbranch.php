<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search CropInfo</title>
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
<script>
	$(document).ready(function() {
		
 /*   	//$('#wpddt1').DataTable();
		// Setup - add a text input to each footer cell
		$('#scropinfo1 tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		} );
	 
		// DataTable
		var table = $('#scropinfo1').DataTable({
			"scrollX": true,
			"searching": false,
			"paging":   false,
        	"ordering": false,
        	"info":     false	
		});
		
		
		
		
	 
		// Apply the search
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
		
		$('.panel').lobiPanel({
       		reload: false,
    		close: false,
    		editTitle: false
			//minimize: false
		});
	*/
	});
</script>

</head>

<body>
	<!--<span style="thfont5">ข้อมูลบริษัท : </span>-->
	<table id="sbranch1" cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
    
      <tbody>
      <?php
	  	$rowno = 1;
		$model = BranchTmpTb::model()->findAllByAttributes(array('registernumber'=>$regisnum));
		foreach ($model as $rows){
			$registernumber = $rows->registernumber;
			if($registernumber=='-'){
				$registernumber = '';
			}
			$ordernumber = $rows->ordernumber;
			if($ordernumber=='-'){
				$ordernumber = '';
			}
			$name = $rows->name;
			if($name=='-'){
				$name = '';
			}
			$housenumber = $rows->housenumber;
			if($housenumber=='-'){
				$housenumber = '';
			}
			$village = $rows->village;
			if($village=='-'){
				$village = '';
			}
			$moo = $rows->moo;
			if($moo=='-'){
				$moo = '';
			}
			$soi = $rows->soi;
			if($soi=='-'){
				$soi = '';
			}
			$road = $rows->road;
			if($road=='-'){
				$road = '';
			}
			$tumbon = $rows->tumbon;
			if($tumbon=='-'){
				$tumbon = '';
			}
			$ampur = $rows->ampur;
			if($ampur=='-'){
				$ampur = '';
			}
			$province = $rows->province;
			if($province=='-'){
				$province = '';
			}
			$zipcode = $rows->zipcode;
			if($zipcode=='-'){
				$zipcode = '';
			}
			$phonenumber = $rows->phonenumber;
			if($phonenumber=='-'){
				$phonenumber = '';
			}
			$faxnumber = $rows->faxnumber;
			if($faxnumber=='-'){
				$faxnumber = '';
			}
			$email = $rows->email;
			if($email=='-'){
				$email = '';
			}
	  	
	  ?>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">ชื่อสาขา :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$name?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">เลขที่ :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$housenumber?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">หมู่บ้าน :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$village?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">หมู่ที่ :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$moo?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">ซอย :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$soi?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">ถนน:</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$road?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">ตำบล :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$tumbon?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">อำเภอ :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$ampur?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">จังหวัด :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$province?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">รหัสไปรษณีย์ :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$zipcode?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">เบอร์โทร :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$phonenumber?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">เบอร์แฟกซ์ :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$faxnumber?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:30%; font-weight:bold;">อีเมล์ :</td>
              <td style="text-align:left; width:70%; padding-left:15px;"><?=$email?></td>
          </tr>
          
       <?php
      	    $rowno += 1;
		}//foreach ($model as $rows){
	  ?>     
          
      </tbody>
     
  </table>
  

  
</body>
</html>