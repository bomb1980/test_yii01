<?php
  $schdate = $schdate;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>schsapiensforclensing</title>
<script>
	$(document).ready(function() {
		$('.panel').lobiPanel({
       		reload: false,
    		close: false,
			editTitle: false,
			sortable: true
			//minimize: false
		});
		
		$('#spatb tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		} );
	 
		// DataTable
		var table = $('#spatb').DataTable({
			"scrollX": true,
			"order": [[ 0, "asc" ]],	
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
		
	});//document
	
	function cleansing3(sad_regisno,sad_accno,acc_no,row_no,regname){
		//alert(sad_regisno + "," + sad_accno + "," + acc_no + "," +row_no);
		$("#clrs" + row_no).html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Cleansing Data...");
		var data1 = 'sad_regisno=' + sad_regisno + '&sad_accno=' + sad_accno + '&acc_no=' + acc_no + '&regname=' + regname + '&action=clensingstep3';
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/cleansing3'); ?>",      
			data: data1,         
			success: function (da)
			{
				//BootstrapDialog.alert('<font class="thfont5">' + da + '</font>');
				if(da==='Y'){
			   		//$("#re1").html(da);
					BootstrapDialog.alert('<font class="thfont5"><i clss="fa fa-smile-o"></i> ระบบ wpd ทำการ cleansing data เรียบร้อยแล้ว.</font>');
					$("#wpdaccno" + row_no).html(sad_accno);
					$("#wpdstate" + row_no).html("A");
					$("#clrs" + row_no).html("");
					$("#btncls" + row_no).hide();
				}else if(da==='N'){
					BootstrapDialog.alert('<font class="thfont5"><i clss="fa fa-frown-o"></i> ระบบ wpd ไม่สามารถทำการ cleansing data ได้!</font>');
					$("#clrs" + row_no).html("");
				}//if
			}
		});
	}
	
</script>
</head>

<body>
<table id="spatb" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
	<thead>
  		<tr>
      		<th width="5%">ลำดับ</th>
      		<th>เลขนิติบุคคล 13 หลัก</th>
      		<th style="text-align:center;">เลขประกันสังคม<br> 10 หลัก Sapiens</th>
            <th style="text-align:center;">เลขประกันสังคม<br> 10 หลัก WPD</th>
      		<th>ชื่อนิติบุคคล</th>
      		<th>วันที่จดทะเบียน</th>
      		<th>สถานะ</th>
            <th>Status<br>Clensing</th>
  		</tr>
	</thead>
	<tbody>
    <?php
	  $rowno = 1;
	  
	  $startdate = $schdate . "T00:00:00+07:00";
  	  $enddate = $schdate . "T23:59:59+07:00";
	  
	  $datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
	  $datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
	  
	  $qsbd = new CDbCriteria( array(
		  'condition' => "sad_modified between :datesch1 and :datesch2 ",         
		  'params'    => array(':datesch1' => "{$datesch1}", ':datesch2' => "{$datesch2}")  
	  ));
	  $modelsbd = SapeinsalldataTb::model()->findAll($qsbd);
	  $countsbd = count($modelsbd);	
	  	
		
	  foreach ($modelsbd as $rows){
		   $sad_id = $rows->sad_id;
		   $sad_regisno = $rows->sad_regisno;
		   $sad_accno = $rows->sad_accno;
		   $sad_createby = $rows->sad_createby;
		   $sad_created = $rows->sad_created;
		   $sad_updateby = $rows->sad_updateby;
		   $sad_modified = $rows->sad_modified;
		   $sad_remark = $rows->sad_remark;
		   $sad_status = $rows->sad_status;
		   
		   $cifm=CropinfoTmpTb::model()->findByAttributes(array('registernumber'=>$sad_regisno));
		   if($cifm){
			 $registername = $cifm->registername;
			 $acc_no = $cifm->acc_no;
			 $registerdate = $cifm->registerdate;
			 $crop_remark = $cifm->crop_remark;
			 $crop_status = $cifm->crop_status;
		   
		   
	?>	   
	
		<tr>
    		<td><?=$rowno?></td>
      		<td><?=$sad_regisno?></td>
      		<td><?=$sad_accno?></td>
            <td><div id="wpdaccno<?=$rowno?>"><?=$acc_no?></div></td>
      		<td><?=$registername?></td>
      		<td><?=$registerdate?></td>
      		<td><div id="wpdstate<?=$rowno?>"><?=$crop_remark?></div></td>
            <td>
            	<?php if($sad_accno!=$acc_no){ ?>
            		<button class="btn btn-success thfont5" id="btncls<?=$rowno?>" onClick="javascript:cleansing3('<?=$sad_regisno?>','<?=$sad_accno?>','<?=$acc_no?>',<?=$rowno?>,'<?=$registername?>')"><i class="fa fa-check"></i> Cleansing</button>
                <?php } ?>
                <span id="clrs<?=$rowno?>"></span>
            </td>
    	</tr>
    <?php
			
				$rowno = $rowno +1;
			}//if
	  }//foreach
	?>
	
	</tbody>
    <tfoot>
    	<tr>
      		<th>ลำดับ</th>
      		<th>เลขนิติบุคคล 13 หลัก</th>
      		<th>เลขประกันสังคม<br> 10 หลัก Sapiens</th>
            <th>เลขประกันสังคม<br> 10 หลัก WPD</th>
      		<th>ชื่อนิติบุคคล</th>
      		<th>วันที่จดทะเบียน</th>
      		<th>สถานะ</th>
            <th>Status Cleansing</th>
  		</tr>
    </tfoot>
</table>
</body>
</html>