<script>
  function callpnd50(){
    var seltxt = $("#seltxt").val();
		var schtxt = $("#schtxt").val();
    seltxt = $("#seltxt").val();
    str = new String(seltxt);
    if (str.length < 13) {
      BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ที่ต้องการค้นหา !</font>');
      exit();
    } else if (str.length = 13) {
      if (isNaN(str)) {
        BootstrapDialog.alert("กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ให้ถูกต้อง <br/>");
        exit();
      } else {
        schtxt = $("#schtxt").val();
        str = new String(schtxt);
        if (str.length < 4) {
          BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนพ.ศ. !</font>');
          exit();
        } else {
          if (isNaN(str)) {
            BootstrapDialog.alert("กรุณาป้อนพ.ศ.ให้ถูกต้อง <br/>");
            exit();
          } else {
            var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
          }
        
        }
      }

    }
    //str = new String(schtxt);
    ajaxcallpnd50(seltxt, schtxt);
  }


  function ajaxcallpnd50(seltxt, schtxt){
        var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
        $('#pain').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
        $.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/callpnd50'); ?>",
				data: data1,
				success: function(da) {
					
					$("#pain").html(da);
				
				
				}
			});
        
    }
</script>

<div id="a2">
      <div id="txtfilter1">
        <!--textbox filter-->
        <div class="about_title thfont5" style="font-size:30px;">(ภ.ง.ด.50) ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคล ด้วยเลขประจำตัวผู้เสียภาษีอากร และ ปี พ.ศ. </div>
        <div class="row">
          <div class=" col-xs-12 col-md-2 col-lg-2">
            <p class="thfont5" style="">
              <label class="thfont5" for="txt1">เลขประจำตัวผู้เสียภาษีอากร:</label>
              <input type="text" class="form-control thfont5" id="seltxt" style="height:auto;" placeholder="0000000000000" maxlength="13" onFocus="this.select()">
            </p>
          </div>
          <div class="col-xs-12 col-md-2 col-lg-2">
            <p class="thfont5" style="">
              <label class="thfont5" for="txt2">ปีงบการเงิน (พ.ศ.):</label>
              <input type="text" class="form-control thfont5" id="schtxt" style="height:auto;" placeholder="0000" maxlength="4" onFocus="this.select()">
            </p>
          </div>
          <div class="col-xs-12 col-md-2 col-lg-2">
            <div class="form-group" style="" id="dbtn1">
              <p class="thfont5" style="padding-top:32px;">
                <label class="thfont5" for="btn1"></label>
                <button class="btn btn-info" id="btn1" onClick="javascript:callpnd50();"><i class="fa fa-search"></i>
                  <font class="thfont5"> ค้นหา</font>
                </button>
              </p>
            </div>
            <!--formgroup-->
          </div>
          <!--cal-md-3-->
        </div>
        <!--row-->
      </div>
      <!--txtfilter1-->
      <div class="row" id="rowresult1" >
        <div class="col-xs-12 col-md-12 col-lg-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <i class="fa fa-address-book"></i>
              <font class="thfont5" style="font-size:24px;"> ข้อมูลรายการภาษีเงินได้นิติบุคคล ด้วยเลขทะเบียนพาณิชย์ </font>
            </div>
            <!--panel heading-->
            <div class="panel-body">
              <div id="resega1" class="thfont5" style="font-size:24px; color:#666; width:100%; height:auto;">
                <!--result data-->
                <div id="pain">
                </div>
              </div>
            </div>
            <!--panelbody-->
          </div>
          <!--panel-->
        </div>
        <!--col-md-12-->
      </div>
      <!--rowresult1-->

    </div>

    