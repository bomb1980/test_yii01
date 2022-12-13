<div id="a2">
      <div id="txtfilter1">
        <!--textbox filter-->
        <div class="about_title thfont5" style="font-size:30px;">(ภงด.1_03) ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคล ด้วยเลขประจำตัวผู้เสียภาษีอากร และ ปี พ.ศ. </div>
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