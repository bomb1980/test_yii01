<?php
class CorpController extends Controller{
    public function actionCallschcrop6()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}

				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "CropInfo", $levremark);
			
				
				
				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/schbyinfo2', $data1);
				
			
				

				//*********************************************************
			} else { //if
				$idplib = new Idplib();
				$idplib->getIdpinfo();
			}
		} else { //if
			$idplib = new Idplib();
			$idplib->getIdpinfo();
		}
	}
    public function actionUpdatecorpdata()
	{
        
     //  var_dump($_POST);
     
     $pasportnumber = $_POST['pasportnumber'] ;
     $datepicker = $_POST['datepicker'];
     $datepicker2 = $_POST['datepicker2'];
     $registernumber = $_POST['registernumber'];
     $dropdown_status = $_POST['dropdown_status'];
     $oel_id = $_POST['oel_id'];
     error_reporting(E_ALL | E_STRICT);
       try{      

        $conn = Yii::app()->db3;
		$sql = "select * from crop_v_bran where registernumber like :registernumber; ";

		$command = $conn->createCommand($sql);
		$command->bindValue(":registernumber", $registernumber);
        $rowsA = $command->queryAll();
		$chkstatus = $rowsA[0]['crop_remark'];
        $accno = $rowsA[0]['acc_no'];
        if($chkstatus == 'A'){
            throw new Exception('ไม่สามารถบันทึกข้อมูลออกตรวจ สปก. สถานะ A ได้');
        }

        $start_format = NULL;
        if($dropdown_status =="AL"){
            $conn = Yii::app()->db4;
            $sql = "select * from otp_email_tb where oel_registernumber = :registernumber; "; 
            $command = $conn->createCommand($sql);
            $command->bindValue(":registernumber", $registernumber);
            $row = $command->queryAll();
            if(count($row)==0){
                 //throw new Exception('ไม่พบข้อมูลOK');
                 $oel_registernumber ="";
                 $oel_accno="";
                 $oel_registername="";
                 $oel_emailaddress="";
                 $oel_emailtype="";
                 $oel_registerdate="";
                 $oel_createdate="";
                 $oel_createby="";
                 $oel_updatedate="";
                 $oel_updateby="";
                 $oel_remark="";
                 $oel_status="";
                 //$oel_answer="";
                 
                 $conn = Yii::app()->db3;
                 $sql = "SELECT registernumber as oel_registernumber, acc_no as oel_accno ,registername as oel_registername ,email as oel_emailaddress,'1' as oel_emailtype , registerdate as oel_registerdate , crop_createtime as oel_createdate,'sys' as oel_createby,crop_updatetime as oel_updatedate , 'sys' as oel_updateby,SSO_BRAN_CODE as oel_remark,crop_remark as oel_status FROM wpdreportdb.crop_v_bran where crop_remark = 'P' and registernumber =:registernumber ;"; 
                 $command = $conn->createCommand($sql);
                 $command->bindValue(":registernumber", $registernumber);
                 $rowps = $command->queryAll();
                 $oel_registernumber =  $rowps[0]['oel_registernumber'];
                 $oel_accno =  $rowps[0]['oel_accno'];
                 $oel_registername =  $rowps[0]['oel_registername'];
                 $oel_emailaddress =  $rowps[0]['oel_emailaddress'];
                 $oel_emailtype =  $rowps[0]['oel_emailtype'];
                 $oel_registerdate =  $rowps[0]['oel_registerdate'];
                 $oel_createdate = $rowps[0]['oel_createdate'];
                 $oel_createby =  $rowps[0]['oel_createby'];
                 $oel_updatedate =  $rowps[0]['oel_updatedate'];
                 $oel_updateby =  $rowps[0]['oel_updateby'];
                 $oel_remark =  $rowps[0]['oel_remark'];
                 $oel_status =  $rowps[0]['oel_status'];
 
                 //$noOfRecords2 =  $rowps[1]['oel_accno'];
 
                 //echo($oel_registernumber."***".$oel_accno."***".$oel_registername."***".$oel_emailaddress."***".$oel_emailtype."***".$oel_registerdate."***".$oel_createdate."***".$oel_createby."***".$oel_updatedate."***".$oel_updateby."***".$oel_remark."***".$oel_status);
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $conn = Yii::app()->db4;
                $sql2 = "INSERT INTO etpdb.otp_email_tb (
                oel_registernumber 
                ,oel_accno 
                ,oel_registername 
                ,oel_emailaddress
                ,oel_emailtype
                ,oel_registerdate
                ,oel_createdate
                ,oel_createby
                ,oel_updatedate
                ,oel_updateby
                ,oel_remark
                ,oel_status
                ,oel_answer)
                value
                (:oel_registernumber
                ,:oel_accno
                ,:oel_registername
                ,:oel_emailaddress
                ,:oel_emailtype
                ,:oel_registerdate
                ,:oel_createdate
                ,:oel_createby
                ,:oel_updatedate
                ,:oel_updateby
                ,:oel_remark
                ,:oel_status
                ,:oel_answer);"; 
                $cmd = $conn->createCommand($sql2);
                $cmd->bindValue(":oel_registernumber", $oel_registernumber);
                $cmd->bindValue(":oel_accno", $oel_accno);
                $cmd->bindValue(":oel_registername", $oel_registername);
                $cmd->bindValue(":oel_emailaddress", $oel_emailaddress);
                $cmd->bindValue(":oel_emailtype", $oel_emailtype);
                $cmd->bindValue(":oel_registerdate", $oel_registerdate);
                $cmd->bindValue(":oel_createdate", $oel_createdate);
                $cmd->bindValue(":oel_createby", $oel_createby);
                $cmd->bindValue(":oel_updatedate", $oel_updatedate);
                $cmd->bindValue(":oel_updateby", $oel_updateby);
                $cmd->bindValue(":oel_remark", $oel_remark);
                $cmd->bindValue(":oel_status", $oel_status);
                $cmd->bindValue(":oel_answer", $dropdown_status);

              
                $cmd->execute();
               
            }

             //var_dump(count($row));
            //exit();
         if($datepicker == "-"){
            $date2 = DateTime::createFromFormat("d-m-Y", $datepicker2);
            $survey_format = $date2->format('Y-m-d 00:00');
            $conn = Yii::app()->db3;    
            $sql = "update crop_v_bran set crop_ex_opendate = null, survey_date = :survey_date , numofemp = :pasportnumber where registernumber = :registernumber;";
            $command = $conn->createCommand($sql);
            $command->bindValue(":registernumber", $registernumber);
            $command->bindValue(":survey_date", $survey_format);
            $command->bindValue(":pasportnumber", $pasportnumber);
            $command->execute();
            
            $conn = Yii::app()->db4;
            $sql = "update otp_email_tb set oel_answer = :dropdown_status where oel_registernumber = :registernumber and oel_id = :oel_id;";
            $command = $conn->createCommand($sql);
            $command->bindValue(":registernumber", $registernumber);
            $command->bindValue(":dropdown_status", $dropdown_status);
            $command->bindValue(":oel_id", $oel_id);
            $command->execute();    
            //echo("บันทึกสำเร็จ");
            ////zr status
         }else{


            ////zr status
            $date = DateTime::createFromFormat("d-m-Y", $datepicker);
            $date2 = DateTime::createFromFormat("d-m-Y", $datepicker2);
            $start_format = $date->format('Y-m-d 00:00');
            $survey_format = $date2->format('Y-m-d 00:00');
            $conn = Yii::app()->db3;    
            $sql = "update crop_v_bran set crop_ex_opendate = :start_format, survey_date = :survey_date , numofemp = :pasportnumber where registernumber = :registernumber;";
            $command = $conn->createCommand($sql);
            $command->bindValue(":registernumber", $registernumber);
            $command->bindValue(":start_format", $start_format);
            $command->bindValue(":survey_date", $survey_format);
            $command->bindValue(":pasportnumber", $pasportnumber);
            $command->execute();
            
            $conn = Yii::app()->db4;
            $sql = "update otp_email_tb set oel_answer = :dropdown_status where oel_registernumber = :registernumber and oel_id = :oel_id;";
            $command = $conn->createCommand($sql);
            $command->bindValue(":registernumber", $registernumber);
            $command->bindValue(":dropdown_status", $dropdown_status);
            $command->bindValue(":oel_id", $oel_id);
            $command->execute();    
            //echo("บันทึกสำเร็จ");
            ////zr status
        }   
         
    }else{
            $conn = Yii::app()->db4;
            $sql = "select * from otp_email_tb where oel_registernumber = :registernumber; "; 
            $command = $conn->createCommand($sql);
            $command->bindValue(":registernumber", $registernumber);
            $row = $command->queryAll();
            
            //var_dump(count($row));
            //exit();
         

            if(count($row)==0){
                //throw new Exception('ไม่พบข้อมูลOK');
                $oel_registernumber ="";
                $oel_accno="";
                $oel_registername="";
                $oel_emailaddress="";
                $oel_emailtype="";
                $oel_registerdate="";
                $oel_createdate="";
                $oel_createby="";
                $oel_updatedate="";
                $oel_updateby="";
                $oel_remark="";
                $oel_status="";
                //$oel_answer="";
                
                $conn = Yii::app()->db3;
                $sql = "SELECT registernumber as oel_registernumber, acc_no as oel_accno ,registername as oel_registername ,email as oel_emailaddress,'1' as oel_emailtype , registerdate as oel_registerdate , crop_createtime as oel_createdate,'sys' as oel_createby,crop_updatetime as oel_updatedate , 'sys' as oel_updateby,SSO_BRAN_CODE as oel_remark,crop_remark as oel_status FROM wpdreportdb.crop_v_bran where crop_remark = 'P' and registernumber =:registernumber ;"; 
                $command = $conn->createCommand($sql);
                $command->bindValue(":registernumber", $registernumber);
                $rowps = $command->queryAll();
                $oel_registernumber =  $rowps[0]['oel_registernumber'];
                $oel_accno =  $rowps[0]['oel_accno'];
                $oel_registername =  $rowps[0]['oel_registername'];
                $oel_emailaddress =  $rowps[0]['oel_emailaddress'];
                $oel_emailtype =  $rowps[0]['oel_emailtype'];
                $oel_registerdate =  $rowps[0]['oel_registerdate'];
                $oel_createdate = $rowps[0]['oel_createdate'];
                $oel_createby =  $rowps[0]['oel_createby'];
                $oel_updatedate =  $rowps[0]['oel_updatedate'];
                $oel_updateby =  $rowps[0]['oel_updateby'];
                $oel_remark =  $rowps[0]['oel_remark'];
                $oel_status =  $rowps[0]['oel_status'];

                //$noOfRecords2 =  $rowps[1]['oel_accno'];

                //echo($oel_registernumber."***".$oel_accno."***".$oel_registername."***".$oel_emailaddress."***".$oel_emailtype."***".$oel_registerdate."***".$oel_createdate."***".$oel_createby."***".$oel_updatedate."***".$oel_updateby."***".$oel_remark."***".$oel_status);
               /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               $conn = Yii::app()->db4;
               $sql2 = "INSERT INTO etpdb.otp_email_tb (
                oel_registernumber 
               ,oel_accno 
               ,oel_registername 
               ,oel_emailaddress
               ,oel_emailtype
               ,oel_registerdate
               ,oel_createdate
               ,oel_createby
               ,oel_updatedate
               ,oel_updateby
               ,oel_remark
               ,oel_status
               ,oel_answer)
               value
               (:oel_registernumber
               ,:oel_accno
               ,:oel_registername
               ,:oel_emailaddress
               ,:oel_emailtype
               ,:oel_registerdate
               ,:oel_createdate
               ,:oel_createby
               ,:oel_updatedate
               ,:oel_updateby
               ,:oel_remark
               ,:oel_status
               ,:oel_answer);"; 
               $cmd = $conn->createCommand($sql2);
               $cmd->bindValue(":oel_registernumber", $oel_registernumber);
               $cmd->bindValue(":oel_accno", $oel_accno);
               $cmd->bindValue(":oel_registername", $oel_registername);
               $cmd->bindValue(":oel_emailaddress", $oel_emailaddress);
               $cmd->bindValue(":oel_emailtype", $oel_emailtype);
               $cmd->bindValue(":oel_registerdate", $oel_registerdate);
               $cmd->bindValue(":oel_createdate", $oel_createdate);
               $cmd->bindValue(":oel_createby", $oel_createby);
               $cmd->bindValue(":oel_updatedate", $oel_updatedate);
               $cmd->bindValue(":oel_updateby", $oel_updateby);
               $cmd->bindValue(":oel_remark", $oel_remark);
               $cmd->bindValue(":oel_status", $oel_status);
               $cmd->bindValue(":oel_answer", $dropdown_status);

             
               $cmd->execute();

            }
            
            $sql = "update otp_email_tb set oel_answer = :dropdown_status where oel_registernumber = :registernumber and oel_id = :oel_id;";
            $command = $conn->createCommand($sql);
            $command->bindValue(":registernumber", $registernumber);
            $command->bindValue(":dropdown_status", $dropdown_status);
            $command->bindValue(":oel_id", $oel_id);
            $command->execute();
            
            
            ////// ถ้าหาไม่เจอใน otp บังคับให้ระบบยกเลิกการค้นหา
            $date2 = DateTime::createFromFormat("d-m-Y", $datepicker2);
            $survey_format = $date2->format('Y-m-d 00:00');
            $conn = Yii::app()->db3;    
            $sql = "update crop_v_bran set survey_date = :survey_date, numofemp = '0' , crop_ex_opendate = Null where registernumber = :registernumber;";
            $command = $conn->createCommand($sql);
            $command->bindValue(":survey_date", $survey_format);
            $command->bindValue(":registernumber", $registernumber);
            $command->execute();
            // echo("บันทึกสำเร็จ");
        }
            $levremark = "ปรับปรุงผลการออกตรวจนิติบุคคล" . $registernumber . "&" . $accno . "&" . $survey_format . "&" . $dropdown_status . "&" . $pasportnumber . "&" . $start_format;
            $msgresult = Yii::app()->Clogevent->createlogevent("Update", "UpdateCropInfo", "Update", "CropInfo&Cropsurvey", $levremark);

           // return TRUE;
            echo json_encode(array('msg' => 'success'));
        }catch (\Exception $e)
            {
           // var_dump($e);
           // return FALSE;
             echo json_encode(array('msg' => $e->getMessage()));
            }

       
    }  //function 

    /************************************************************************************************* */
}
