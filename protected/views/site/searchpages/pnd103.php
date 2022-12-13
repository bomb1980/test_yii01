<script>
  function callpnd103(dlnNo) {
    var dlnNo = $("#dlnNo").val();
    dlnNo = $("#dlnNo").val();
    str = new String(dlnNo);
    var data1 = 'action=dlnNo' + dlnNo;
    //str = new String(schtxt);
    

    ajaxcallpnd103(dlnNo);
  
  }


  function ajaxcallpnd103(dlnNo) {
    var data1 = 'dlnNo='+ dlnNo;
    //alert(data1);
    //exit();
    $('#pain').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createAbsoluteUrl('pnd/callpnd103'); ?>",
      data: data1,
      success: function(da) {

        $("#pain").html(da);
        
      }
    });

  }
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<div id="a2">
      <div id="txtfilter1">
        <!--textbox filter-->
        <div class="about_title thfont5" style="font-size:30px;">(ภงด.1_03) ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคล ด้วยเลขประจำตัวผู้เสียภาษีอากร และ ปี พ.ศ. </div>
        <div class="row">
          <div class=" col-xs-12 col-md-2 col-lg-2">
            <p class="thfont5" style="">
              <label class="thfont5" for="txt1">เลขคุมเอกสาร :</label>
              <input type="text" class="form-control thfont5" id="dlnNo" style="height:auto;" placeholder="0000000000000"  onFocus="this.select()">
            </p>
          </div>
          <div class=" col-xs-12 col-md-2 col-lg-2">
            <p class="thfont5" style="">
              <label class="thfont5" for="txt1">เลขประจำตัวประชาชน :</label>
              <input type="text" class="form-control thfont5" id="NIDWhld" style="height:auto;" placeholder="0000000000000"  onFocus="this.select()">
            </p>
          </div>
          <div class="col-xs-12 col-md-2 col-lg-2">
            <div class="form-group" style="" id="dbtn1">
              <p class="thfont5" style="padding-top:32px;">
                <label class="thfont5" for="btn1"></label>
                <button class="btn btn-info" id="btn1" onClick="javascript:callpnd103();"><i class="fa fa-search"></i>
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
      <div class="row" id="rowresult1">
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