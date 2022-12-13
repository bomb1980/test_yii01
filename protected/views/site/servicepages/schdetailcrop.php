<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search Detail Corp</title>
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
<table id="sbranch1" cellpadding="5" class="table4_1 display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
    
      <tbody>
      <?php
	  	$rowno = 1;
		$model = CropinfoTmpTb::model()->findAllByAttributes(array('registernumber'=>$regisnum));
		foreach ($model as $rows){
			$registername = $rows->registername;
			$registernumber = $rows->registernumber;
			$acc_no = $rows->acc_no;
			$acc_bran = $rows->acc_bran;
			$registerdate = $rows->registerdate;
			$crop_remark = $rows->crop_remark;
			$crop_status = $rows->crop_status;
			$tsic = $rows->tsic;
			$tsicname = $rows->tsicname;
			$corptype = $rows->corptype;
			$corptypename = $rows->corptypename;
			$accountingdate = $rows->accountingdate;
			$authorizedcapital = $rows->authorizedcapital;
			$cpower = $rows->cpower;
			
			
			if($tsic=='-'){
				$tsic = '';
				
			}
			if($tsicname=='-'){
				$tsicname = '';
				
			}
			if($cpower=='-'){
				$cpower = '';
				
			}
			
			//$Budget = number_format($Budget,0,".",",");
			$authorizedcapitalf = number_format($authorizedcapital,0,".",",");
			
	  	
	  ?>
          <tr>
              <td style="text-align:right; width:20%; font-weight:bold;">ชื่อกิจการ :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$registername?></td>
          </tr>
         <tr>
              <td style="text-align:right; width:20%; font-weight:bold;">ประเภท :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$corptypename?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:20%; font-weight:bold;">TSIC :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$tsic?> :: <?=$tsicname?></td>
          </tr>
          <tr>
              <td style="text-align:right; width:20%; font-weight:bold;">ทุนจดทะเบียน :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$authorizedcapitalf?> บาท</td>
          </tr>
          <tr>
              <td style="text-align:right; width:20%; font-weight:bold;">จำนวนผู้มีอำนาจ :</td>
              <td style="text-align:left; width:80%; padding-left:15px;"><?=$cpower?></td>
          </tr>
          
       <?php
      	    $rowno += 1;
		}//foreach ($model as $rows){
	  ?>     
          
      </tbody>
     
  </table>
</body>
</html>