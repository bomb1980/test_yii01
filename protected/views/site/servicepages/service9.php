<script>
  openpnd(101); //ทำให้หน้า pnd101 เป็นหน้า default เมื่อเข้าหน้านี้
  function callpnd1012() {
    var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createAbsoluteUrl('site/callpnd101'); ?>",
      data: data1,
      success: function(da) {
        //$("#relsave1").html(da);
        $('#pain').html(da);
      }
    });
  }

  function openpnd(snum) {
    $("#a2").show("slow");
    var data1 = 'snum=' + snum;
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createAbsoluteUrl('site/openpnd'); ?>",
      data: data1,
      success: function(da) {
        if (da == 'Y') {
          $("#a2").html(da);
        } else {
          $("#a2").html(da);
        }
      }
    });
    window.scrollTo(500, 0);
  }

  function callpnd101() {
    seltxt = $("#seltxt").val();
    str = new String(seltxt);
    if (str.length < 13) {
      BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ที่ต้องการค้นหา !</font>');
    } else if (str.length = 13) {
      if (isNaN(str)) {
        BootstrapDialog.alert("กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ให้ถูกต้อง <br/>");
      } else {
        schtxt = $("#schtxt").val();
        str = new String(schtxt);
        if (str.length < 4) {
          BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนพ.ศ. !</font>');
        } else {
          if (isNaN(str)) {
            BootstrapDialog.alert("กรุณาป้อนพ.ศ.ให้ถูกต้อง <br/>");
          } else {
            var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
          }
        
        }


        $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->createAbsoluteUrl('site/callpnd101'); ?>",
          data: data1,
          success: function(da) {
            //$("#relsave1").html(da);
            $('#pain').html(da);
          }
        });
      }

    }

  }

  function callpnd102() {
    seltxt = $("#seltxt").val();
    str = new String(seltxt);
    if (str.length < 13) {
      BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ที่ต้องการค้นหา !</font>');
    } else if (str.length = 13) {
      if (isNaN(str)) {
        BootstrapDialog.alert("กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ให้ถูกต้อง <br/>");
      } else {
        schtxt = $("#schtxt").val();
        str = new String(schtxt);
        if (str.length < 4) {
          BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนพ.ศ. !</font>');
        } else {
          if (isNaN(str)) {
            BootstrapDialog.alert("กรุณาป้อนพ.ศ.ให้ถูกต้อง <br/>");
          } else {
            var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
          }
        
        }

        $('#pain').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");

        $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->createAbsoluteUrl('site/callpnd102'); ?>",
          data: data1,
          success: function(da) {
            //$("#relsave1").html(da);
            $('#pain').html(da);
          }
        });
      }

    }

  }

  function callpnd103() {
    seltxt = $("#seltxt").val();
    str = new String(seltxt);
    if (str.length < 13) {
      BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ที่ต้องการค้นหา !</font>');
    } else if (str.length = 13) {
      if (isNaN(str)) {
        BootstrapDialog.alert("กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ให้ถูกต้อง <br/>");
      } else {
        schtxt = $("#schtxt").val();
        str = new String(schtxt);
        if (str.length < 4) {
          BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนพ.ศ. !</font>');
        } else {
          if (isNaN(str)) {
            BootstrapDialog.alert("กรุณาป้อนพ.ศ.ให้ถูกต้อง <br/>");
          } else {
            var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
          }
        
        }

        $('#pain').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
        $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->createAbsoluteUrl('site/callpnd103'); ?>",
          data: data1,
          success: function(da) {
            //$("#relsave1").html(da);
            $('#pain').html(da);
          }
        });
      }

    }

  }

  function callpnd50() {
    seltxt = $("#seltxt").val();
    str = new String(seltxt);
    if (str.length < 13) {
      BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ที่ต้องการค้นหา !</font>');
    } else if (str.length = 13) {
      if (isNaN(str)) {
        BootstrapDialog.alert("กรุณาป้อนข้อมูลเลขเลขประจำตัวผู้เสียภาษีอากร ให้ถูกต้อง <br/>");
      } else {
        schtxt = $("#schtxt").val();
        str = new String(schtxt);
        if (str.length < 4) {
          BootstrapDialog.alert('<font class="thfont5">กรุณาป้อนพ.ศ. !</font>');
        } else {
          if (isNaN(str)) {
            BootstrapDialog.alert("กรุณาป้อนพ.ศ.ให้ถูกต้อง <br/>");
          } else {
            var data1 = 'action=sch&schtxt=' + schtxt + "&seltxt=" + seltxt;
          }
        
        }

        $('#pain').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/preloader-01.gif' height='30' width='30' /> <br> Loading...");
        $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->createAbsoluteUrl('site/callpnd50'); ?>",
          data: data1,
          success: function(da) {
            //$("#relsave1").html(da);
            $('#pain').html(da);
          }
        });
      }

    }

  }


</script>

<?php
/*if(!isset(Yii::app()->session['user_loginname'])){
 	Yii::app()->CIdpLogin->getIdPinfo();
}*/

$ssobrncode = Yii::app()->user->address;
$pvcode = substr($ssobrncode, 0, 2);

if ($ssobrncode != '1050') {
  //ค้นหาว่า เป็นส่วนกลางหรือจังหวัด
  $bcr = MasSsobranch::model()->findByAttributes(array('ssobranch_code' => $ssobrncode));
  $bcn = $bcr->name;
  $bct = $bcr->ssobranch_type_id;
} else {
  $bct = 1;
}

if ($bct == 1) {
  if ($ssobrncode == '1057') {
    $perled = 'y';
  } else if ($ssobrncode == '1054') {
    $perled = 'y';
  } else if ($ssobrncode == '1050') {
    $perled = 'y';
  } else {
    $perled = 'n';
  }
} else {
  $perled = 'y';
}


?>
<?php
if (!Yii::app()->user->isGuest) {
  if (Yii::app()->user->getId()) {
    $user_id = Yii::app()->user->getId();
  }
  if (Yii::app()->user->firstname) {
    $user_firstname = Yii::app()->user->firstname;
  }
  if (Yii::app()->user->lastname) {
    $user_lastname = Yii::app()->user->lastname;
  }
  if (Yii::app()->user->email) {
    $user_email = Yii::app()->user->email;
  }
  if (Yii::app()->user->access_level) {
    $user_access_level = Yii::app()->user->access_level;
  }
  if (Yii::app()->user->address) {
    $user_address = Yii::app()->user->address;
  }
  if (Yii::app()->user->access_code) {
    $user_access_code = Yii::app()->user->access_code;
  }
  if (Yii::app()->user->username) {
    $user_username = Yii::app()->user->username;
  }
}
?>
<style>
  /* Style the buttons */
  .mybtn {
    border: none;
    border-radius: 5px;
    outline: none;
    padding: 10px 16px;
    background-color: #f1f1f1;
    cursor: pointer;
    font-size: 18px;
  }

  /* Style the active class, and buttons on mouse-over */
  .myactive,
  .mybtn:hover {
    background-color: #666;
    color: white;
  }
</style>
<script>
  // Add active class to the current button (highlight it)
  var header = document.getElementById("myDIV");
  var btns = header.getElementsByClassName("mybtn");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("myactive");
      current[0].className = current[0].className.replace(" myactive", "");
      this.className += " myactive";
    });
  }
</script>

<div id="a1">

  <div class="" style="padding-bottom:15px;">

    <div id="myDIV" style="padding-bottom:15px;">
      <button class="mybtn myactive" onclick="javascript:openpnd(101);"><i class="fa fa-address-card"></i> ภงด.1_01 (PND.1_01) </button>
      <!--<button class="mybtn " onclick="javascript:opensearch(2);"><i class="fa fa-calendar"></i> Search By Date</button>-->
      <button class="mybtn" onclick="javascript:openpnd(102);" title="Department Of Bussiness Development"><i class="fa fa-institution"></i> ภงด.1_02 (PND.1_02) </button>
      <button class="mybtn" onclick="javascript:openpnd(103);" title="Department Of Bussiness Development"><i class="fa fa-institution"></i> ภงด.1_03 (PND.1_03) </button>
      <button class="mybtn" onclick="javascript:openpnd(50);" title="Department Of Bussiness Development"><i class="fa fa-institution"></i> ภงด.50 (PND.50) </button>
      <?php if ($user_access_level == 'admin' || $user_access_level == 'financial' || $user_access_level == 'admin-audit') { ?>
       <!-- <button class="mybtn" onclick="javascript:opensearch();" title="DGA Service งบการเงิน"><i class="fa fa-area-chart"></i> ภงด.1_03 (PND.1_03)</button>-->
      <?php } ?>
      <?php if ($perled == 'y') { ?>
      <!--<button class="mybtn" onclick="javascript:callpnd101();" title="Legal Execution Department"><i class="fa fa-institution"></i>ภงด.50 (PND50) </button>-->
      <?php } ?>

    </div>

    <div id="a2">

    </div>

  </div>