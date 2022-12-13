<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Service 1</title>
<style>
.rcorners {
  border-radius: 10px;
  border: 1px solid #666;
  padding: 5px;
  margin-bottom: 5px;
}
</style>
<script>
	$(document).ready(function() {
		$('.panel').lobiPanel({
       		reload: false,
    		close: false,
    		editTitle: false,
			sortable: true
			//minimize: false
		});
		
				// Setup - add a text input to each footer cell
		$('#example tfoot th').each( function () {
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'"  style="width:100%; padding-left:3px;" />' ); //placeholder="'+title+'"
		} );
		
		// DataTable
    	var table = $('#example').DataTable({
			"scrollX": true,	
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
			} );
		} );
		
	

	}); //$(document).ready(function() {

   function schcropinfo(){
	   var cnumb = $("#cnumb").val();
	   var str = new String(cnumb);
	   if(!cnumb){
			BootstrapDialog.alert('<font class="thfont5"> กรุณาป้อนข้อมูลเลขนิติบุคคล 13 หลัก ! </font>');   
			$("#cnumb").focus();
	   }else{
		   	//BootstrapDialog.alert("str.length is:" + str.length);
			if(str.length < 13){
				BootstrapDialog.alert(" <font class='thfont5'>กรุณาตรวจสอบความยาว เลขนิติบุคคลให้ครบ 13 หลัก! </font>");
			}else{
				$("#rowresult1").show();
				$("#rowresult2").show();
				$("#rowresult3").show();
				ajaxschcropinfo(cnumb);
			}
	   }
   }
   
   function ajaxschcropinfo(regisnum){
	   
	   //alert("cripinfo");
	
		var data1 = 'action=sch&regisnum=' + regisnum;
		
		$('#re1').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
		
		$.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschcropinfo'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re1").html(da);
			   ajaxschcommittee(regisnum);
			   
			}
		});
		
		   
   }//function ajaxschcropinfo(regisnum){
	   
   function ajaxschcommittee(regisnum){
	   
	   //alert("committee");
	   
	   var data1 = 'action=sch&regisnum=' + regisnum;
	   $('#re2').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	   $.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschcommittee'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re2").html(da);
			   ajaxschbranch(regisnum);
			   ajaxschdetailcrop(regisnum);
			   
			}
		});
		
   }
   
   function ajaxschbranch(regisnum){
	   
	    //alert("brach");
	   
	   var data1 = 'action=sch&regisnum=' + regisnum;
	   $('#re3').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	   $.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschbranch'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re3").html(da);
			   
			   
			}
		});
		
		
   }
   
   function ajaxschdetailcrop(regisnum){
	   var data1 = 'action=sch&regisnum=' + regisnum;
	   $('#re3').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
	   $.ajax({
			type: "POST", 
			url: "<?php echo Yii::app()->createAbsoluteUrl('site/callschdetailcrop'); ?>",      
			data: data1,         
			success: function (da)
			{
			   $("#re4").html(da);
			   
			}
		});
	   
   }
   
</script>
<style>
	th {
	  /*height: 50px;*/
	  /*font-weight:lighter;
	  text-align: center;*/
	  /*background-color: #cccccc;*/
	}
</style>

</head>

<body>
	<div class="about_title thfont5" style="font-size:30px;">Check Profile & Activate Status</div>
    	<div class="row">
    		<div class="col-md-12"><!--rcorners-->
            
            	<div class="row"><!--row-->
                	<div class="col-md-3">
                      <div class="form-group">
                          <p class="thfont4" style="">เลขนิติบุคคล 13 หลัก: <input type="text" class="form-control thfont5" id="cnumb" placeholder="0000000000000" maxlength="13" onfocus="this.select();" onClick="this.select();"></p>
                      </div>
                    </div>
                    <div class="col-md-3">
                    	<div class="form-group">
                        	<p class="" style=""><br><br>
                            	<button class="btn btn-info thfont5" onClick="javascript:schcropinfo();"><i class="fa fa-search"></i> ค้นหา ข้อมูลนิติบุคคล </button></p>
                        </div>
                    </div>
            	</div><!--row-->
                
            </div>
        </div>
        
        
        <div class="row" id="rowresult1">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลนิติบุคคล</font>
                    </div>
                    <div class="panel-body">
                        <div id="re1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        
                        </div>
                    </div>
                </div>
           </div>
        </div><!--row-->
        
  <div class="row" id="rowallresult23">
     <div class="col-md-4">   
        <div class="row" id="rowresult2" style="display:none;">
            <div class="col-md-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลสำนักงาน</font>
                    </div>
                    <div class="panel-body">
                        <div id="re3" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        
                        </div>
                    </div>
                </div>
           </div>
        </div><!--row-->
      </div>
      <div class="col-md-8">
        <div class="row" id="rowresult3" style="display:none;">
            <div class="col-md-12">
            	
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> ข้อมูลเจ้าของกิจการ</font>
                    </div>
                    <div class="panel-body">
                        <div id="re2" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <i class="fa fa-address-book"></i><font class="thfont5" style="font-size:24px;"> รายละเอียดกิจการ</font>
                    </div>
                    <div class="panel-body">
                        <div id="re4" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                        
                        </div>
                    </div>
                </div>
                
                
                
           </div>
        </div><!--row-->
      </div>
    </div><!--row-->
        
</body>
</html>