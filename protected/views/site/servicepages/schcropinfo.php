<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search CropInfo</title>

<script>
	$(document).ready(function() {
		
    	//$('#wpddt1').DataTable();
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
	
	});
	
	var dilg1 = "";
	
	function callupdatestatus1(action,crop_id,registernumber){
		//alert(action + "," + crop_id + "," + registernumber);
		var strpath = "";
		 var data1 = 'action=' + action + '&crop_id=' + crop_id + '&registernumber=' + registernumber;
		 dilg1 = new BootstrapDialog({
			 type: BootstrapDialog.TYPE_WARNING,
			 title: "<i class='fa fa-edit'></i><font class='thfont5'> ปรับปรุงสถานะการขึ้นทะเบียนลูกจ้าง </font>",
			 message: $('<div></div>').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading..."),
			 message: $('<div class="thfont5"></div>').load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/chgstatusfrm') ."'" ; ?>, { action: action, crop_id: crop_id, registernumber: registernumber }),
			 draggable: true,
			closable: true,	
			closeByBackdrop: false,
			closeByKeyboard: false,
			buttons: [{
				id: 'btn0',
				label: "<i class='fa fa-window-close'></i><font class='thfont5'> Close</font>",
				cssClass: 'btn-secondary',
				action: function(dialogItself){			
					dialogItself.close();
				}
			},{
				id: 'btn1',
				label: "<i class='fa fa-check'></i>&nbsp;<font class='thfont5'> Save</font>",
				cssClass: 'btn-primary',
				//hotkey: 13, //enter
				action: function(dialogItself){
					//aust3.close();
					 ajaxupdatestatus1(action,crop_id,registernumber);
				}
			}]
			
		 });
		 
		 dilg1.open(); 
	}//function callupdatestatus1(action,crop_id,registernumber){
		
	function ajaxupdatestatus1(action,crop_id,registernumber){
		//alert(action + "," + crop_id + "," + registernumber);	
		var data1 = 'action=' + action + '&crop_id=' + crop_id + '&registernumber=' + registernumber;
		$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callupdatestatus1'); ?>",      
			data: data1,         
			success: function (msg)
			{
	
				if(msg=='y'){
					dilg1.close();
					BootstrapDialog.alert('ปรับปรุงสถานะข้อมูล เรียบร้อย !');
					$("#re1").load(<?php echo "'" . Yii::app()->createAbsoluteUrl('site/callschcropinfo') ."'" ; ?>, { action: action, regisnum: registernumber });
					//$("#re1").html(msg);
				}else
				if(msg=='n'){
					BootstrapDialog.alert('ไม่สามารถปรับปรุงสถานะข้อมูลได้!');		
				}
			}
		});
		
		
	}
		
</script>

</head>

<body>
	<!--<span style="thfont5">ข้อมูลบริษัท : </span>-->
	<table id="scropinfo1" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
      <thead>
          <tr>
              <th>ลำดับ</th>
              <th>ชื่อนิติบุคคล</th>
              <th>เลขนิติบุคคล 13 หลัก</th>
              <th>เลขประกันสังคม 10 หลัก</th>
              <th>วันที่จดทะเบียน</th>
              <th>สถานะ</th>
              <th>Action</th>
             
          </tr>
      </thead>
      <tbody>
      <?php
	  
	  	$now = date_create('now')->format('Y-m-d H:i:s');
		$tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
		$datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
		$daten1 = date('Y-m-d H:i:s');
	  
	  	$rowno = 1;
		$model = CropinfoTmpTb::model()->findAllByAttributes(array('registernumber'=>$regisnum));
		foreach ($model as $rows){
			$crop_id = $rows->crop_id;
			$registername = $rows->registername;
			$registernumber = $rows->registernumber;
			$acc_no = $rows->acc_no;
			$acc_bran = $rows->acc_bran;
			$registerdate = $rows->registerdate;
			$crop_remark = $rows->crop_remark;
			$crop_status = $rows->crop_status;
			
			$registerdatef = date_create($registerdate)->format('d-m-Y');
	  	
	  ?>
          <tr>
              <td style="text-align:center;"><?=$rowno?></td>
              <td><?=$registername?></td>
              <td style="text-align:center;"><?=$registernumber?></td>
              <td style="text-align:center;"><?=$acc_no?></td>
              <td style="text-align:center;"><?=$registerdatef?></td>
              <td style="color:red; text-align:center;"><span class="badge thfont3" style="color:<?php  if($crop_remark!='P'){ ?> #FF6 <?php }else{ ?> #3C9 <?php } ?>;"><?=$crop_remark?></span></td>
              <td><button class="btn btn-primary thfont5" <?php if($crop_remark!='P'){ ?> style="display:none;" <?php } ?> onClick="callupdatestatus1('chg',<?=$crop_id?>,'<?=$registernumber?>');" <?php  if($crop_remark!='P'){ ?> disabled <?php } ?> >ขึ้นทะเบียนลูกจ้าง</button></td>
          </tr>
       <?php
      	    $rowno += 1;
		}//foreach ($model as $rows){
	  ?>     
          
      </tbody>
      <!--<tfoot>
          <tr>
              <th>ชื่อนิติบุคคล</th>
              <th>จังหวัด</th>
              <th>เลขนิติบุคคล 13 หลัก</th>
              <th>เลขประกันสังคม 10 หลัก</th>
              <th>วันที่จดทะเบียน</th>
              <th>สถานะ</th>
              <th>เปลี่ยนสถานะ</th>
              
          </tr>
      </tfoot>-->
  </table>
  

  
</body>
</html>