<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Search By Date</title>
<script>
	$(document).ready(function() {
		
		
		
		$('.panel').lobiPanel({
       		reload: false,
    		close: false,
			editTitle: false,
			sortable: true
			//minimize: false
		});
		
    	//$('#wpddt1').DataTable();
		// Setup - add a text input to each footer cell
		$('#sbdtb tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width:100%; padding-left:3px;" />' );
		} );
	 
		// DataTable
		var table = $('#sbdtb').DataTable({
			"scrollX": true,
			"order": [[ 3, "asc" ]],	
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
  $now = date_create('now')->format('Y-m-d H:i:s');
  $tomorrow = date_create('+1 day')->format('Y-m-d H:i:s');
  $datedbd2 = date_create('2019-02-04T23:59:59+07:00')->format('Y-m-d H:i:s');
  $daten1 = date('Y-m-d H:i:s');
  
  $startdate = $bgdatep . "T00:00:00+07:00";
  $enddate = $eddatep . "T23:59:59+07:00";
  
  //echo "{$startdate},{$enddate}";
?>
	 <table id="sbdtb" class="display row-border responsive nowrap" style="width:100%; height:auto; color:#003;">
     	<thead>
          <tr>
              <!--<th>ลำดับ</th>-->
              <th>ชื่อนิติบุคคล</th>
              <th>เลขนิติบุคคล 13 หลัก</th>
              <th>เลขประกันสังคม 10 หลัก</th>
              <th>วันที่จดทะเบียน</th>
              <th>สถานะ</th>
             
          </tr>
      	</thead>
        <tbody>
        <?php
	  		$rowno = 1;
			
			$datesch1 = date_create($startdate)->format('Y-m-d H:i:s');
			$datesch2 = date_create($enddate)->format('Y-m-d H:i:s');
			
			//$model = CropinfoTmpTb::model()->findAllByAttributes(array('registerdate'=>$datesch1));
			//registerdate between '2019-05-17 00:00:00' and '2019-05-17 00:00:00'
			
			if(Yii::app()->user->access_code=='1'){
			  $bc = str_split(Yii::app()->user->address,2);	
			  $bcd = "0" . $bc[0];
			  $qsbd = new CDbCriteria( array(
				  'condition' => "registerdate between :datesch1 and :datesch2 ",         
				  'params'    => array(':datesch1' => "{$datesch1}", ':datesch2' => "{$datesch2}")  
			  ));	
			}else{
			  $bc = str_split(Yii::app()->user->address,2);	
			  $bcd = "0" . $bc[0];
			  $qsbd = new CDbCriteria( array(
				  'condition' => "registerdate between :datesch1 and :datesch2 and registernumber like :bcd ",         
				  'params'    => array(':datesch1' => "{$datesch1}", ':datesch2' => "{$datesch2}", ':bcd' => "{$bcd}%")  
			  ));	
			}
			$modelsbd = CropinfoTmpTb::model()->findAll($qsbd);
			$countsbd = count($modelsbd);
			
			foreach ($modelsbd as $rows){
			  $registername = $rows->registername;
			  $registernumber = $rows->registernumber;
			  $acc_no = $rows->acc_no;
			  $acc_bran = $rows->acc_bran;
			  $registerdate = $rows->registerdate;
			  $crop_remark = $rows->crop_remark;
			  $crop_status = $rows->crop_status;
			  
			  $registerdatef = date_create($registerdate)->format('d-m-Y');
				
		?>
        	 <tr <?php if($crop_remark=='B'){  ?> style="background-color:#FFFFC6;" <?php }else if($crop_remark=='A'){ ?> style="background-color:#CEFFDB;" <?php } ?>>
                  <!--<td style="text-align:center;"><?=$rowno?></td>-->
                  <td><?=$registername?></td>
                  <td style="text-align:center;"><?=$registernumber?></td>
                  <td style="text-align:center;"><?=$acc_no?></td>
                  <td style="text-align:center;"><?=$registerdatef?></td>
                  <td style="color:red; text-align:center;"><span class="badge thfont3" style="color:#FF6;"><?=$crop_remark?></span></td>
                 
              </tr>
         <?php
				$rowno += 1;
			}//foreach ($model as $rows){
		  ?>  
        </tbody>
        <tfoot>
            <tr>
                <!--<th>ลำดับ</th>-->
                <th>ชื่อนิติบุคคล</th>
                <th>เลขนิติบุคคล 13 หลัก</th>
                <th>เลขประกันสังคม 10 หลัก</th>
                <th>วันที่จดทะเบียน</th>
                <th>สถานะ</th>
                
            </tr>
        </tfoot>
     </table>
</body>
</html>