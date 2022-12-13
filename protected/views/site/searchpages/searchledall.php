<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>LED Search</title>
<script>
$(document).ready(function() {
	//$('#wpddt1').DataTable();
		// Setup - add a text input to each footer cell
		$('#sbitb tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		} );
	 
		// DataTable
		var table = $('#sbitb').DataTable({
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
});
</script>
</head>

<body>
	<?php
	 $modelled = LedrptTb::model()->findAll();
	 $countled = count($modelled);
	 
	 if($countled>0){
	?>
	<table id="sbitb" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
    <thead>
      <tr>
      	  <th>Print</th>
          <th>ลำดับ</th>
          <th>ACC_NO</th>
          <th>ACC_BRAN</th>
          <th>RIG_NO</th>
          <th>NAME</th>
          <th>ADDRESS</th>
          <th>อำเภอ</th>
          <th>จังหวัด</th>
          <th>รหัสไปรษณีย์</th>
          <th>สปส.<br>รับผิดชอบ</th>
          <th>ชื่อ สปส.<br>รับผิดชอบ</th>
          <th>วันที่พิพากษา<br>ล้มละลาย</th>
          <th>วันที่ฟ้อง</th>
          <th>วันที่อัพเดท<br>ล่าสุด</th>
          <th>วันที่พิทักษ์<br>ทรัพย์เด็ดขาด</th>
          <th>วันที่ประกาศ<br>ราชกิจจา</th>
          <th>วันที่ครบกำหนด<br>ยื่นคำขอรับ<br>ชำระหนี้</th>
          <th>เลขบัตรประชาชน<br>/เลขนิติบุคคล</th>
          <th>ชื่อ<br>จำเลย</th>
          <th>นามสกุล<br>จำเลย</th>
      </tr>
    </thead>
    <tbody>
    	<?php
	  		$rowno = 1;
			
			foreach ($modelled as $rows){
				$lrpt_id = $rows->lrpt_id;
				$lrpt_accno = $rows->lrpt_accno;
				$lrpt_accbran = $rows->lrpt_accbran;
				$lrpt_registernumber = $rows->lrpt_registernumber;
				$lrpt_registername = $rows->lrpt_registername;
				$lrpt_address = $rows->lrpt_address;
				$lrpt_aumpur = $rows->lrpt_aumpur;
				$lrpt_provice = $rows->lrpt_provice;
				$lrpt_zipcode = $rows->lrpt_zipcode;
				$lrpt_ssobrancode = $rows->lrpt_ssobrancode;
				$lrpt_ssobranname = $rows->lrpt_ssobranname;
				$lrpt_responsecode = $rows->lrpt_responsecode;
				$lrpt_bkr_prot = $rows->lrpt_bkr_prot;
				$lrpt_req = $rows->lrpt_req;
				$lrpt_lastupdate = $rows->lrpt_lastupdate;
				$lrpt_abs_prot = $rows->lrpt_abs_prot;
				$lrpt_abs_gaz = $rows->lrpt_abs_gaz;
				$lrpt_abs_due = $rows->lrpt_abs_due;
				$lrpt_calldate = $rows->lrpt_calldate;
				$lrpt_df_id = $rows->lrpt_df_id;
				$lrpt_df_name = $rows->lrpt_df_name;
				$lrpt_df_surname = $rows->lrpt_df_surname;
				$lrpt_createby = $rows->lrpt_createby;
				$lrpt_created = $rows->lrpt_created;
				$lrpt_updateby = $rows->lrpt_updateby;
				$lrpt_modified = $rows->lrpt_modified;
				//$lrpt_remark = $rows-lrpt_remark;
				//$lrpt_status = $rows->lrpt_status;
		?>
    	<tr>
          <td><button class="btn btn-success thfont5"><i class="fa fa-print"></i></button></td>	
          <td><?=$rowno?></td>
          <td><?=$lrpt_accno?></td>
          <td><?=$lrpt_accbran?></td>
          <td><?=$lrpt_registernumber?></td>
          <td><?=$lrpt_registername?></td>
          <td><?=$lrpt_address?></td>
          <td><?=$lrpt_aumpur?></td>
          <td><?=$lrpt_provice?></td>
          <td><?=$lrpt_zipcode?></td>
          <td><?=$lrpt_ssobrancode?></td>
          <td><?=$lrpt_ssobranname?></td>
          <td><?=$lrpt_bkr_prot?></td>
          <td><?=$lrpt_req?></td>
          <td><?=$lrpt_lastupdate?></td>
          <td><?=$lrpt_abs_prot?></td>
          <td><?=$lrpt_abs_gaz?></td>
          <td><?=$lrpt_abs_due?></td>
          <td><?=$lrpt_df_id?></td>
          <td><?=$lrpt_df_name?></td>
          <td><?=$lrpt_df_surname?></td>
      	</tr>
        <?php
				$rowno += 1;
			}//for
		?>
    </tbody>
    <tfoot>
      <tr>
      	  <th>#</th>
          <th>ลำดับ</th>
          <th>ACC_NO</th>
          <th>ACC_BRAN</th>
          <th>RIG_NO</th>
          <th>NAME</th>
          <th>ADDRESS</th>
          <th>อำเภอ</th>
          <th>จังหวัด</th>
          <th>รหัสไปรษณีย์</th>
          <th>สปส.<br>รับผิดชอบ</th>
          <th>ชื่อ สปส.<br>รับผิดชอบ</th>
          <th>วันที่พิพากษา<br>ล้มละลาย</th>
          <th>วันที่ฟ้อง</th>
          <th>วันที่อัพเดท<br>ล่าสุด</th>
          <th>วันที่พิทักษ์<br>ทรัพย์เด็ดขาด</th>
          <th>วันที่ประกาศ<br>ราชกิจจา</th>
          <th>วันที่ครบกำหนด<br>ยื่นคำขอรับ<br>ชำระหนี้</th>
          <th>เลขบัตรประชาชน<br>/เลขนิติบุคคล</th>
          <th>ชื่อ<br>จำเลย</th>
          <th>นามสกุล<br>จำเลย</th>
      </tr>
  </tfoot>
</table>
<?php

	 }else{
		 echo "ไม่พบข้อมูลสถานประกอบการที่ถูกฟ้องล้มละลาย!";
	 }//if
?>
</body>
</html>