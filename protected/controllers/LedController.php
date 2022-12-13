<?php
class LedController extends Controller
{
	public function actionAddnewledtmp()
	{
		$fs = fopen( $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/led/file_lock.lock","w"); 
		$hasLock = flock($fs,LOCK_EX | LOCK_NB);
		if(!$hasLock) {
			//die("lock process");
			http_response_code(402);
			exit;
		}

		if (!Yii::app()->request->isPostRequest) {
			http_response_code(401);
			fclose($fs);
			exit;
		}

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {

				$createby = Yii::app()->user->username;

				$d = date('Y-m-d');
				$yearter = intval(date("Y")) + 543;

				$yearter2 = substr($yearter, 2);
				//echo $yearter2;
				$monter = date("m");
				$monter2 = date('m', strtotime($d . " -1 month"));
				$yearter3 = date('Y', strtotime($d . " -1 month")) + 543;
				$yearter4 = substr($yearter3, 2);
				//$dayter = date("d") ;
				$dayter = date("d");

				if ($dayter > 7 && $dayter < 21) {
					$dayter = date("07");
					$chkdaycut = ($yearter2 . $monter . $dayter);
				} else if ($dayter <= 7) {
					$dayter = date("21");

					if ($monter == 1) {
						$chkdaycut = ($yearter4 . $monter2 . $dayter);
					} else {
						$chkdaycut = ($yearter2 . $monter2 . $dayter);
					}
				} else {
					$dayter = date("21");
					$chkdaycut = ($yearter2 . $monter . $dayter);
				} //กำหนดค่า date fotmat
				$daycut = $chkdaycut;

				/////$checkdoc = $_SERVER['DOCUMENT_ROOT'] . "/wpdcore/ledtextfile/sapiens/T8000_W$daycut.txt"; //local เซิฟเวอร์
				/////$checkdoc =  Yii::app()->Cgentextfile->localpathled . "T8000_W$daycut.TXT"; //เซิฟเวอร์ uat
				$checkdoc2 = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/led"; //server local
				$checkdoc = $checkdoc2 . "/T8000_W$daycut.TXT";

				//$checkdoc2 = Yii::app()->Cgentextfile->localpathled ; //server uat
				//$checkdoc = $checkdoc2 . "T8000_W$daycut.TXT" ;
				if (!file_exists($checkdoc)) {
					echo ("ไม่พบไฟล์ที่ใช้งาน");
					flock($fs,LOCK_UN);
					fclose($fs);
					exit();
				}

				$this->rm_log($checkdoc2);
				$sql = "DELETE FROM ledriskcrop_tb ";
				$conn = Yii::app()->db;
				$command = $conn->createCommand($sql);
				$x = $command->execute();

				$text = file($checkdoc); // path text file
				//$text = file($checkdoc);

				//exit();
				//var_dump($text);
				//exit();

				//echo($checkdoc);

				ini_set('max_execution_time', 0);
				$i = 0; //นับค่าที่ถูกเพิ่มจริงๆลงในdb
				$countnum = 0;

				foreach ($text as $index => $value) {
					// echo $value."<br />";

					$pieces = explode(";", $value);

					$data0 = trim($pieces[0]);
					$data1 = trim($pieces[1]);
					$data2 = trim($pieces[2]);
					$data3 = trim($pieces[3]);
					$data4 = trim($pieces[4]);
					$data5 = trim($pieces[5]);
					$data6 = $pieces[6];
					$data7 = trim($pieces[7]);
					$data8 = trim($pieces[8]);
					$data9 = trim($pieces[9]);

					if ($data2 != "" && strlen($data2) == 13 && is_numeric($data2)) {


						//////////////////////////////////////////////	
						$conn = Yii::app()->db;
						$sq2 = " INSERT IGNORE INTO ledriskcrop_tb(
							lrc_accno,
							lrc_bran,
							lrc_registernumber,
							lrc_registername,
							lrc_ssocode1, 
							lrc_ssocode2,
							lrc_address , 
							lrc_amphur,
							lrc_province,
							lrc_zipcode,
							lrc_createby, 
							lrc_created,
							lrc_updateby,
							lrc_modified, 
							lrc_remark,
							lrc_status
					)
					
					VALUES 
					(       :lrc_accno,
							:lrc_bran,
							:lrc_registernumber,
							:lrc_registername,
							:lrc_ssocode1, 
							:lrc_ssocode2,
							:lrc_address , 
							:lrc_amphur,
							:lrc_province,
							:lrc_zipcode,
							:lrc_createby, 
							:lrc_created,
							:lrc_updateby,
							:lrc_modified, 
							:lrc_remark,
							:lrc_status
							)
					";


						$command = $conn->createCommand($sq2);
						$command->bindValue(":lrc_accno", $data0);
						$command->bindValue(":lrc_bran", $data1);
						$command->bindValue(":lrc_registernumber", $data2);
						$command->bindValue(":lrc_registername",  iconv("tis-620", "utf-8", $data3));
						$command->bindValue(":lrc_ssocode1", $data4);
						$command->bindValue(":lrc_ssocode2", $data5);
						$command->bindValue(":lrc_address", iconv("tis-620", "utf-8", $data6));
						$command->bindValue(":lrc_amphur", iconv("tis-620", "utf-8", $data7));
						$command->bindValue(":lrc_province", iconv("tis-620", "utf-8", $data8));
						$command->bindValue(":lrc_zipcode", $data9);
						$command->bindValue(":lrc_createby", $createby);
						$command->bindValue(":lrc_created", date('Y-m-d H:i:s'));
						$command->bindValue(":lrc_updateby", $createby);
						$command->bindValue(":lrc_modified", date('Y-m-d H:i:s'));
						$command->bindValue(":lrc_remark", '-');
						$command->bindValue(":lrc_status", '1');
						$y = $command->execute();
						if ($y == 1) {
							$i++;
						} else {
							//	$this->wh_log($value,$checkdoc2);
						};
					} else {

						$this->wh_log($value, $checkdoc2);
					};

					if ($countnum == $text) {
						echo ("break complete");
						break;
					}
				}
				$conn = Yii::app()->db;
				$sql = 	"SELECT si1.*
				FROM ledriskcrop_tb AS si1
				JOIN (SELECT lrc_registernumber
					FROM ledriskcrop_tb
					GROUP BY lrc_registernumber
					HAVING COUNT(lrc_registernumber) > 1) AS si2
				ON si1.lrc_registernumber = si2.lrc_registernumber ORDER BY lrc_registernumber";

				$command = $conn->createCommand($sql);
				$rows = $command->queryAll();
				$rowlrc_registernumber = array();
				if (count($rows) > 0) {
					foreach ($rows as $dataitem) {
						$rowsAarr = array(
							'lrc_accno' => iconv("utf-8", "tis-620", $dataitem['lrc_accno']),
							'lrc_bran' => iconv("utf-8", "tis-620", $dataitem['lrc_bran']),
							'lrc_registernumber' => iconv("utf-8", "tis-620", $dataitem['lrc_registernumber']),
							'lrc_registername' => iconv("utf-8", "tis-620", $dataitem['lrc_registername']),
							'lrc_ssocode1' => iconv("utf-8", "tis-620", $dataitem['lrc_ssocode1']),
							'lrc_ssocode2' => iconv("utf-8", "tis-620", $dataitem['lrc_ssocode2']),
							'lrc_address' => iconv("utf-8", "tis-620", $dataitem['lrc_address']),
							'lrc_amphur' => iconv("utf-8", "tis-620", $dataitem['lrc_amphur']),
							'lrc_province' => iconv("utf-8", "tis-620", $dataitem['lrc_province']),
							'lrc_zipcode' => iconv("utf-8", "tis-620", $dataitem['lrc_zipcode'])

						);

						$rowlrc_registernumber[] = "'" . iconv("utf-8", "tis-620", $dataitem['lrc_registernumber']) . "'";
						$this->wh_log(implode(";", $rowsAarr) . "\n", $checkdoc2);
					}
				}

				if ($rowlrc_registernumber == 1) {
					$xs = implode(",", $rowlrc_registernumber);
					$sql = "
					DELETE FROM ledriskcrop_tb 
					WHERE lrc_registernumber IN ($xs)";

					$command = $conn->createCommand($sql);
					$command->execute();
				}

				if (file_exists($checkdoc)) {
					$sql = "SELECT COUNT(*)As ct FROM ledriskcrop_tb";

					$command = $conn->createCommand($sql);
					$rows = $command->queryAll();
					$noOfRecords =  $rows[0]['ct'];
					$d = 0;


					if (file_exists($checkdoc)) {
						if (unlink($checkdoc)) {
							echo ("ค่าที่สามารถบันทึกได้ ");
							echo ($noOfRecords);
							echo (" ราย จากทั้งหมดทั้งหมด ");
							echo count($text); //นับค่าที่ถูกอ่านจาก textfile
							echo (" ราย: บันทึก Textfile ลง Database เรียบร้อย");
						} else {
							echo ("บันทึก Textfile ลง Database ไม่สำเร็จ");
						}
					}

					$this->wh_log2($noOfRecords, $d, $checkdoc2, $text);
				}

				//$this->wh_log2($i,$d,$checkdoc2,$value);
				//var_dump($rowlrc_registernumber);


				//echo ("\n"."ค่าแรก".$countnum ."ค่าสอง". $text);
				flock($fs,LOCK_UN);
				fclose($fs);
				exit();


				//$this->chkledtmp($i,$checkdoc,$text,$checkdoc2);


			} else { //if
				http_response_code(401);
				flock($fs,LOCK_UN);
				fclose($fs);
				exit;
			}
		} else { //if
			http_response_code(401);
			flock($fs,LOCK_UN);
			fclose($fs);
			exit;
		}
		flock($fs,LOCK_UN);
		fclose($fs);;

	} //function

	function chkledtmp($i, $cdd, $tx, $checkdoc2)
	{

		$createby = Yii::app()->user->username;


		$yearter = intval(date("Y")) + 543;
		$yearter2 = substr($yearter, 2);
		//echo $yearter2;
		$monter = date("m");
		//$dayter = date("d") ;
		$dayter = date("d");

		$daycut = ($yearter2 . $monter . $dayter);

		//$checkdoc = $_SERVER['DOCUMENT_ROOT'] . "/wpdcore/ledtextfile/sapiens/T8000_W$daycut.txt"; //local เซิฟเวอร์
		//$checkdoc =  Yii::app()->Cgentextfile->localpathled . "T8000_W$daycut.TXT"; //เซิฟเวอร์ uat
		$checkdoc2 = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/led"; //server local
		$checkdoc = $checkdoc2 . "/log_$daycut.TXT";

		//$checkdoc2 = Yii::app()->Cgentextfile->localpathled ; //server uat
		//$checkdoc = $checkdoc2 . "/log_$daycut.TXT" ; // server uat;
		if (!file_exists($checkdoc)) {
			echo ("ไม่พบไฟล์ที่ใช้งาน");
			exit();
		}
		$text = file($checkdoc); // path text file


		//exit();
		//var_dump($text);
		//exit();

		//echo($checkdoc);

		ini_set('max_execution_time', 0);
		$d = 0; //นับค่าที่ถูกเพิ่มจริงๆลงในdb
		foreach ($text as $index => $value) {


			$pieces = explode(";", $value);


			$data2 = trim($pieces[2]);
			if ($data2 != "" && strlen($data2) == 13 && is_numeric($data2)) {
				$conn = Yii::app()->db;
				$sql = "
					SELECT * FROM ledriskcrop_tb 
					WHERE lrc_registernumber =:lrc_registernumber";


				$command = $conn->createCommand($sql);
				$command->bindValue(":lrc_registernumber", $data2);
				$rowA = $command->queryAll();
				if (count($rowA) == 1) {

					foreach ($rowA as $dataitem) {
						$rowsAarr = array(
							'lrc_accno' => iconv("utf-8", "tis-620", $dataitem['lrc_accno']),
							'lrc_bran' => iconv("utf-8", "tis-620", $dataitem['lrc_bran']),
							'lrc_registernumber' => iconv("utf-8", "tis-620", $dataitem['lrc_registernumber']),
							'lrc_registername' => iconv("utf-8", "tis-620", $dataitem['lrc_registername']),
							'lrc_ssocode1' => iconv("utf-8", "tis-620", $dataitem['lrc_ssocode1']),
							'lrc_ssocode2' => iconv("utf-8", "tis-620", $dataitem['lrc_ssocode2']),
							'lrc_address' => iconv("utf-8", "tis-620", $dataitem['lrc_address']),
							'lrc_amphur' => iconv("utf-8", "tis-620", $dataitem['lrc_amphur']),
							'lrc_province' => iconv("utf-8", "tis-620", $dataitem['lrc_province']),
							'lrc_zipcode' => iconv("utf-8", "tis-620", $dataitem['lrc_zipcode'])

						);
					}
					$this->wh_log(implode(";", $rowsAarr) . "\n", $checkdoc2);
				}


				$sql = "
					DELETE FROM ledriskcrop_tb 
					WHERE lrc_registernumber =:lrc_registernumber";


				$command = $conn->createCommand($sql);
				$command->bindValue(":lrc_registernumber", $data2);
				$x = $command->execute();
				if ($x == 1) {
					$d++;
				}
			}
		}
		if (file_exists($cdd)) {

			if (unlink($cdd)) {
				echo ("ค่าที่สามารถบันทึกได้ ");
				echo ($i - $d);
				echo (" ราย จากทั้งหมดทั้งหมด ");
				echo count($tx); //นับค่าที่ถูกอ่านจาก textfile
				echo (" ราย: บันทึก Textfile ลง Database เรียบร้อย");
			} else {
				echo ("บันทึก Textfile ลง Database ไม่สำเร็จ");
			}
			$this->wh_log2($i, $d, $checkdoc2, $tx);
		} else {
			echo ("$cdd file not exists");
		}
	}

	public function actionCallledservicecall()
	{
		ini_set('max_execution_time', 0);
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$time_start = microtime(true);

				$action = $_POST['action'];
				$rgn =  $_POST['rgn'];
				//echo "{$action}";

				$url = 'https://wsg.sso.go.th:443/v1/GdxWebServiceSam';				
				//$url = 'https://uatwsg.sso.go.th:443/v1/GdxWebServiceSam';
				//$url = 'https://services.led.go.th/v1/GdxWebServiceSam'; 

				$data = json_encode(
					array(
						"username" => "SSO001",
						"password" => "",
						"type" => "DATA",
						"firstName" => "",
						"lastName" => "",
						"idCard" => "{$rgn}",
						"reqHeader" => array(
							"transID" => "SSO20180620",
							"rqAppID" => "SSO",
							"transDateTimestamp" => "20180620",
							"terminalID" => "terminalID",
							"ip" => "127.0.0.1",
							"branchCode" => "001"
						)
					)
				); //echo $data;;exit;

				$arrContextOptions = array(
					"http" => array(
						"method" => "POST",
						"header" =>
						//"Consumer-Key: 8400dfa3-4fe3-43b9-b830-060d948d75cf", 
						"Content-Type: application/json; charset=utf-8;\r\n" .
							"Connection: keep-alive\r\n",
						"ignore_errors" => true,
						"timeout" => (float)30.0,
						"content" => $data,
					),
					"ssl" => array(
						"verify_peer" => false,
						"verify_peer_name" => false,
					),
				);

				$content = file_get_contents($url, false, stream_context_create($arrContextOptions));

				//echo "<pre>";
				//echo "{$content} <br>";
				//echo "</pre> <br>";
				$abs_prot = "";
				$abs_gaz = "";
				$abs_due = "";
				$bkr_prot = "";
				$req_dt = "";
				$lastudt = "";
				$df_id = "";
				$df_name = "";
				$df_surname = "";

				$json = json_decode($content, true);
				foreach ($json as $key => $value) {

					if (!is_array($value)) {
						if ($key == 'responseCode') {
							if ($value == '000') {
								//echo $key . '=>' . $value . '<br>';
								$msg = "บุคคลหรือธุรกิจที่ได้รับคำสั่งจากศาล (ถูกฟ้องล้มละลาย)";
								$st = 2;
							} else if ($value == '904') {
								$msg = "ไม่พบบุคคลหรือธุรกิจที่ได้รับคำสั่งจากศาล (ไม่ถูกฟ้องล้มละลาย)";
								$st = 1;
							} else if ($value == '909') {
								$msg = "ระบบผิดพลาด";
								$st = 1;
							} else if ($value == '901') {
								$msg = "ไม่อนุญาตแอป";
								$st = 1;
							} else if ($value == '902') {
								$msg = "TransId ไม่ตรงกัน";
								$st = 1;
							} else if ($value == '902') {
								$msg = "ID ผู้ใช้ไม่ได้รับอนุญาต";
								$st = 1;
							}
						} //if
					} //if

					if ($st === 2) {
						if ($key == 'data') {
							//var_dump($value);echo "<br>";
							foreach ($value[0] as $key2 => $value2) {
								//echo "{$key2}:{$value2}<br>";
								//วันที่พิทักษ์ทรัพย์เด็ดขาด
								if ($key2 == 'abs_prot_dd') {
									if ($value2) {
										$abs_prot = $abs_prot . $value2 . "-";
									} else {
										$abs_prot = "";
									} //if
								} //if
								if ($key2 == 'abs_prot_mm') {
									if ($value2) {
										$abs_prot = $abs_prot . $value2 . "-";
									} else {
										$abs_prot = "";
									} //if
								} //if
								if ($key2 == 'abs_prot_yy') {
									if ($value2) {
										$abs_prot = $abs_prot . $value2 . "";
									} else {
										$abs_prot = "";
									} //if
								} //if

								//วันที่ประกาศในราชกิจจาฯ
								if ($key2 == 'abs_gaz_dd') {
									if ($value2) {
										$abs_gaz = $abs_gaz . $value2 . "-";
									} else {
										$abs_gaz = "";
									} //if
								} //if
								if ($key2 == 'abs_gaz_mm') {
									if ($value2) {
										$abs_gaz = $abs_gaz . $value2 . "-";
									} else {
										$abs_gaz = "";
									} //if
								} //if
								if ($key2 == 'abs_gaz_yy') {
									if ($value2) {
										$abs_gaz = $abs_gaz . $value2 . "";
									} else {
										$abs_gaz = "";
									} //if
								} //if

								//วันครบกำหนดยื่นคำขอรับชำระหนี้
								if ($key2 == 'abs_due_dd') {
									if ($value2) {
										$abs_due = $abs_due . $value2 . "-";
									} else {
										$abs_due = "";
									} //if
								} //if
								if ($key2 == 'abs_due_mm') {
									if ($value2) {
										$abs_due = $abs_due . $value2 . "-";
									} else {
										$abs_due = "";
									} //if
								} //if
								if ($key2 == 'abs_due_yy') {
									if ($value2) {
										$abs_due = $abs_due . $value2 . "";
									} else {
										$abs_due = "";
									} //if
								} //if

								//วันที่พิพากษาให้ล้มละลาย
								if ($key2 == 'bkr_prot_dd') {
									if ($value2) {
										$bkr_prot = $bkr_prot . $value2 . "-";
									} else {
										$bkr_prot = "";
									} //if
								} //if
								if ($key2 == 'bkr_prot_mm') {
									if ($value2) {
										$bkr_prot = $bkr_prot . $value2 . "-";
									} else {
										$bkr_prot = "";
									} //if
								} //if
								if ($key2 == 'bkr_prot_yy') {
									if ($value2) {
										$bkr_prot = $bkr_prot . $value2 . "";
									} else {
										$bkr_prot = "";
									} //if
								} //if

								//วันที่ฟ้อง
								if ($key2 == 'req_dd') {
									if ($value2) {
										$req_dt = $req_dt . $value2 . "-";
									} else {
										$req_dt = "";
									} //if
								} //if
								if ($key2 == 'req_mm') {
									if ($value2) {
										$req_dt = $req_dt . $value2 . "-";
									} else {
										$req_dt = "";
									} //if
								} //if
								if ($key2 == 'req_yy') {
									if ($value2) {
										$req_dt = $req_dt . $value2 . "";
									} else {
										$req_dt = "";
									} //if
								} //if

								//วันทีปรับปรุงล่าสุด
								if ($key2 == 'lastupdate') {
									if ($value2) {
										$lastudt = $lastudt . $value2;
									} else {
										$lastudt = "";
									} //if
								} //if

								//เลขประจำตัว
								if ($key2 == 'df_id') {
									if ($value2) {
										$df_id = $df_id . $value2;
									} else {
										$df_id = "";
									} //if
								} //if

								//ชื่อจำเลย
								if ($key2 == 'df_name') {
									if ($value2) {
										$df_name = $df_name . $value2;
									} else {
										$df_name = "";
									} //if
								} //if

								//สกุลจำเลย
								if ($key2 == 'df_surname') {
									if ($value2) {
										$df_surname = $df_surname . $value2;
									} else {
										$df_surname = "";
									} //if
								} //if

							} //foreach

						} //if
					} //if

				} //foreach

				//echo "{$abs_prot} , {$abs_gaz}, {$abs_due}, {$bkr_prot}, {$req_dt}, {$lastudt}, {$df_id}, {$df_name}, {$df_surname}";
				//เริ่มบันทึกข้อมูล update model Ledriskcrop2Tb
				if ($st === 2) {
					$msg3 = "วันที่พิทักษ์ทรัพย์เด็ดขาด => {$abs_prot} <br> วันที่ประกาศในราชกิจจา => {$abs_gaz} <br> วันที่ครบกำหนดยื่นคำขอฯ => {$abs_due} <br> วันที่ฟ้อง => {$req_dt} <br> วันที่ปรับปรุงล่าสุด => {$lastudt} <br>วันที่พิพากษาให้ล้มละลาย => {$bkr_prot} <br>";
				} else if ($st === 1) {
					$msg3 = "";
				}
				//exit;

				//บันทึกว่า มีการ สอบถามข้อมูลล่าสุดเมื่อไหร่โดยใคร
				$mrc = Ledriskcrop2Tb::model()->findByAttributes(array('lrc_registernumber' => $rgn)); //, 
				if ($mrc) {
					//echo "y,{$registernumber} <br>";
					//เปลี่ยนสถานะกลุ่มเสี่ยง
					if ($st === 1) {
						$mrc->lrc_updateby = Yii::app()->user->username;
						$mrc->lrc_modified = date('Y-m-d H:i:s');
						$mrc->lrc_status = $st;
						if ($mrc->save()) {
							$msg2 = "";
							//$scc = $scc + 1; //จำนวนสำเร็จ
							//$sc = 0; //สถานะ error
						} else {
							$msg2 = $mrc->getErrors();
							//$sce = $sce + 1; //จำนวน error
							//$sc = 1; //สถานะ error
						} //if 
					} //if

					if ($st === 2) {
						$mrc->lrc_updateby = Yii::app()->user->username;
						$mrc->lrc_modified = date('Y-m-d H:i:s');
						$mrc->lrc_status = $st;
						$mrc->lrpt_abs_prot = $abs_prot;
						$mrc->lrpt_abs_gaz = $abs_gaz;
						$mrc->lrpt_abs_due = $abs_due;
						$mrc->lrpt_bkr_prot = $bkr_prot;
						$mrc->lrpt_req = $req_dt;
						$mrc->lrpt_lastupdate = $lastudt;
						$mrc->lrpt_df_id = $df_id;
						$mrc->lrpt_df_name = $df_name;
						$mrc->lrpt_df_surname = $df_surname;
						if ($mrc->save()) {
							$msg2 = "";
							//$scc = $scc + 1; //จำนวนสำเร็จ
							//$sc = 0; //สถานะ error
						} else {
							$msg2 = $mrc->getErrors();
							//$sce = $sce + 1; //จำนวน error
							//$sc = 1; //สถานะ error
						} //if 
					} //if

				} //if

				echo "เลข 13 หลัก: {$rgn}<br>{$msg}, {$msg2} <br>";
				echo "{$msg3} <br>";

				$time_end = microtime(true);
				$execution_time = ($time_end - $time_start) / 60;
				echo '<b>ใช้เวลาเรียก service:</b> ' . $execution_time . ' Mins <br>';
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

	public function rm_log($logpath)
	{
		//$log_filename =  $_SERVER['DOCUMENT_ROOT'] . "/wpdcore/ledtextfile/sapiens";
		$yearter = intval(date("Y")) + 543;
		$yearter2 = substr($yearter, 2);

		$monter = date("m");
		$dayter = date("d");

		$log_file_data = $logpath . '/log_' . $yearter2 . $monter . $dayter . '.TXT';

		if (file_exists($log_file_data)) {
			unlink($log_file_data);
			// and do some other stuff
		}

	}

	public function wh_log($log_msg, $logpath)
	{
		//$log_filename =  $_SERVER['DOCUMENT_ROOT'] . "/wpdcore/ledtextfile/sapiens";
		$yearter = intval(date("Y")) + 543;
		$yearter2 = substr($yearter, 2);
		//echo $yearter2;
		$monter = date("m");
		//$dayter = date("d") ;
		$dayter = date("d");
		if (!file_exists($logpath)) {
			// create directory/folder uploads.
			mkdir($logpath, 0777, true);
		}
		$log_file_data = $logpath . '/log_' . $yearter2 . $monter . $dayter . '.TXT';
		file_put_contents($log_file_data, $log_msg, FILE_APPEND);
	}

	public function wh_log2($i, $d, $logpath, $tx)
	{
		//$log_filename =  $_SERVER['DOCUMENT_ROOT'] . "/wpdcore/ledtextfile/sapiens";
		$yearter = intval(date("Y")) + 543;
		$yearter2 = substr($yearter, 2);
		//echo $yearter2;
		$monter = date("m");
		//$dayter = date("d") ;
		$dayter = date("d");
		$ctx = count($tx);

		if (!file_exists($logpath)) {
			// create directory/folder uploads.
			mkdir($logpath, 0777, true);
		}
		$log_file_data = $logpath . '/log_' . $yearter2 . $monter . $dayter . '.TXT';

		$my_text_file = ($log_file_data);
		$all_lines = file($my_text_file);
		$number_of_lines = count($all_lines);

		$ctws = "นำเข้าได้" . $i . "ราย" . " " . "จากทั้งหมด" . " " . count($tx) . "ราย" . " " . "ที่ไม่สามารถเพิ่มได้" . $number_of_lines . "ราย";
		$ctws2 = iconv("utf-8", "tis-620", $ctws);

		file_put_contents($log_file_data, $ctws2, FILE_APPEND);
	}
	
	
	public function actionServiceled()
	{

		ini_set('max_execution_time', 0);
		$conn = Yii::app()->db;
		$sql = "
				select * from 
				ledriskcrop_tb where lrc_remark != '1'
				LIMIT 25000
				";
		$command = $conn->createCommand($sql); ///คำสั่งของ YIIสร้างคอมมานให้ตัวแปร
		$rowsA = $command->queryAll(); ///คำสั่งของ YII sql select ต้องcreatecommandก่อน

		foreach ($rowsA as $dataitem) {
			$data2 = $dataitem['lrc_registernumber'];

			$rowsAarr = array(
				'lrc_accno' => $dataitem['lrc_accno'],
				'lrc_bran' => $dataitem['lrc_bran'],
				'lrc_registernumber' => $dataitem['lrc_registernumber'],
				'lrc_registername' => $dataitem['lrc_registername'],
				'lrc_ssocode1' => $dataitem['lrc_ssocode1'],
				'lrc_ssocode2' => $dataitem['lrc_ssocode2'],
				'lrc_address' => $dataitem['lrc_address'],
				'lrc_amphur' => $dataitem['lrc_amphur'],
				'lrc_province' => $dataitem['lrc_province'],
				'lrc_zipcode' => $dataitem['lrc_zipcode']

			);
			sleep(1);
			$user_app = LedController::Newcallledservicecall($data2, $rowsAarr);
		}
	}



	public function Newcallledservicecall($data2, $rowsArr)
	{
		ini_set('max_execution_time', 0);
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$time_start = microtime(true);

				// $action = $_POST['action'];
				$rgn =  $data2;
				//echo "{$action}";

				$url = 'https://wsg.sso.go.th:443/v1/GdxWebServiceSam';
				//$url = 'https://services.led.go.th/v1/GdxWebServiceSam';

				$data = json_encode(
					array(
						"username" => "SSO001",
						"password" => "",
						"type" => "DATA",
						"firstName" => "",
						"lastName" => "",
						"idCard" => "{$rgn}",
						"reqHeader" => array(
							"transID" => "SSO20180620",
							"rqAppID" => "SSO",
							"transDateTimestamp" => "20180620",
							"terminalID" => "terminalID",
							"ip" => "127.0.0.1",
							"branchCode" => "001"
						)
					)
				);

				$arrContextOptions = array(
					"http" => array(
						"method" => "POST",
						"header" =>
						//"Consumer-Key: 8400dfa3-4fe3-43b9-b830-060d948d75cf", 
						"Content-Type: application/json; charset=utf-8;\r\n" .
							"Connection: keep-alive\r\n",
						"ignore_errors" => true,
						"timeout" => (float)60.0,
						"content" => $data,
					),
					"ssl" => array(
						"verify_peer" => false,
						"verify_peer_name" => false,
					),
				);


				$content = file_get_contents($url, false, stream_context_create($arrContextOptions));
				//echo "<pre>";
				//echo "{$content} <br>";
				//echo "</pre> <br>";
				$abs_prot = "";
				$abs_gaz = "";
				$abs_due = "";
				$bkr_prot = "";
				$req_dt = "";
				$lastudt = "";
				$df_id = "";
				$df_name = "";
				$df_surname = "";

				$json = json_decode($content, true);
				$conn = Yii::app()->db;
				$sql = "
					DELETE FROM ledriskcrop_tb
					WHERE lrc_registernumber =:lrc_registernumber 
					";
				//update ledriskcrop_tb 
				//SET lrc_remark = '1' 
				//where lrc_registernumber =:lrc_registernumber 

				$command = $conn->createCommand($sql);
				$command->bindValue(":lrc_registernumber", $data2);
				$command->execute();  //คำสั่งของ YII sql update delete ต้องcreatecommandก่อน

				foreach ($json as $key => $value) {

					if (!is_array($value)) {
						if ($key == 'responseCode') {
							if ($value == '000') {
								//echo $key . '=>' . $value . '<br>';
								$msg = "บุคคลหรือธุรกิจที่ได้รับคำสั่งจากศาล (ถูกฟ้องล้มละลาย)";
								$st = 2;
							} else if ($value == '904') {
								$msg = "ไม่พบบุคคลหรือธุรกิจที่ได้รับคำสั่งจากศาล (ไม่ถูกฟ้องล้มละลาย)";
								$st = 1;
							} else if ($value == '909') {
								$msg = "ระบบผิดพลาด";
								$st = 1;
							} else if ($value == '901') {
								$msg = "ไม่อนุญาตแอป";
								$st = 1;
							} else if ($value == '902') {
								$msg = "TransId ไม่ตรงกัน";
								$st = 1;
							} else if ($value == '902') {
								$msg = "ID ผู้ใช้ไม่ได้รับอนุญาต";
								$st = 1;
							}
						} //if
					} //if

					if ($st === 2) {
						if ($key == 'data') {
							//var_dump($value);echo "<br>";
							foreach ($value[0] as $key2 => $value2) {
								//echo "{$key2}:{$value2}<br>";
								//วันที่พิทักษ์ทรัพย์เด็ดขาด
								if ($key2 == 'abs_prot_dd') {
									if ($value2) {
										$abs_prot = $abs_prot . $value2 . "-";
									} else {
										$abs_prot = "";
									} //if
								} //if
								if ($key2 == 'abs_prot_mm') {
									if ($value2) {
										$abs_prot = $abs_prot . $value2 . "-";
									} else {
										$abs_prot = "";
									} //if
								} //if
								if ($key2 == 'abs_prot_yy') {
									if ($value2) {
										$abs_prot = $abs_prot . $value2 . "";
									} else {
										$abs_prot = "";
									} //if
								} //if

								//วันที่ประกาศในราชกิจจาฯ
								if ($key2 == 'abs_gaz_dd') {
									if ($value2) {
										$abs_gaz = $abs_gaz . $value2 . "-";
									} else {
										$abs_gaz = "";
									} //if
								} //if
								if ($key2 == 'abs_gaz_mm') {
									if ($value2) {
										$abs_gaz = $abs_gaz . $value2 . "-";
									} else {
										$abs_gaz = "";
									} //if
								} //if
								if ($key2 == 'abs_gaz_yy') {
									if ($value2) {
										$abs_gaz = $abs_gaz . $value2 . "";
									} else {
										$abs_gaz = "";
									} //if
								} //if

								//วันครบกำหนดยื่นคำขอรับชำระหนี้
								if ($key2 == 'abs_due_dd') {
									if ($value2) {
										$abs_due = $abs_due . $value2 . "-";
									} else {
										$abs_due = "";
									} //if
								} //if
								if ($key2 == 'abs_due_mm') {
									if ($value2) {
										$abs_due = $abs_due . $value2 . "-";
									} else {
										$abs_due = "";
									} //if
								} //if
								if ($key2 == 'abs_due_yy') {
									if ($value2) {
										$abs_due = $abs_due . $value2 . "";
									} else {
										$abs_due = "";
									} //if
								} //if

								//วันที่พิพากษาให้ล้มละลาย
								if ($key2 == 'bkr_prot_dd') {
									if ($value2) {
										$bkr_prot = $bkr_prot . $value2 . "-";
									} else {
										$bkr_prot = "";
									} //if
								} //if
								if ($key2 == 'bkr_prot_mm') {
									if ($value2) {
										$bkr_prot = $bkr_prot . $value2 . "-";
									} else {
										$bkr_prot = "";
									} //if
								} //if
								if ($key2 == 'bkr_prot_yy') {
									if ($value2) {
										$bkr_prot = $bkr_prot . $value2 . "";
									} else {
										$bkr_prot = "";
									} //if
								} //if

								//วันที่ฟ้อง
								if ($key2 == 'req_dd') {
									if ($value2) {
										$req_dt = $req_dt . $value2 . "-";
									} else {
										$req_dt = "";
									} //if
								} //if
								if ($key2 == 'req_mm') {
									if ($value2) {
										$req_dt = $req_dt . $value2 . "-";
									} else {
										$req_dt = "";
									} //if
								} //if
								if ($key2 == 'req_yy') {
									if ($value2) {
										$req_dt = $req_dt . $value2 . "";
									} else {
										$req_dt = "";
									} //if
								} //if

								//วันทีปรับปรุงล่าสุด
								if ($key2 == 'lastupdate') {
									if ($value2) {
										$lastudt = $lastudt . $value2;
									} else {
										$lastudt = "";
									} //if
								} //if

								//เลขประจำตัว
								if ($key2 == 'df_id') {
									if ($value2) {
										$df_id = $df_id . $value2;
									} else {
										$df_id = "";
									} //if
								} //if

								//ชื่อจำเลย
								if ($key2 == 'df_name') {
									if ($value2) {
										$df_name = $df_name . $value2;
									} else {
										$df_name = "";
									} //if
								} //if

								//สกุลจำเลย
								if ($key2 == 'df_surname') {
									if ($value2) {
										$df_surname = $df_surname . $value2;
									} else {
										$df_surname = "";
									} //if
								} //if

							} //foreach

						} //if
					} //if

				} //foreach
				//deleteตรงนี้

				//echo "{$abs_prot} , {$abs_gaz}, {$abs_due}, {$bkr_prot}, {$req_dt}, {$lastudt}, {$df_id}, {$df_name}, {$df_surname}";
				//เริ่มบันทึกข้อมูล update model Ledriskcrop2Tb
				if ($st === 2) {
					$msg3 = "วันที่พิทักษ์ทรัพย์เด็ดขาด => {$abs_prot} <br> วันที่ประกาศในราชกิจจา => {$abs_gaz} <br> วันที่ครบกำหนดยื่นคำขอฯ => {$abs_due} <br> วันที่ฟ้อง => {$req_dt} <br> วันที่ปรับปรุงล่าสุด => {$lastudt} <br>วันที่พิพากษาให้ล้มละลาย => {$bkr_prot} <br>";
				} else if ($st === 1) {
					$msg3 = "";
				}
				//exit;

				//บันทึกว่า มีการ สอบถามข้อมูลล่าสุดเมื่อไหร่โดยใคร
				$mrc = Ledriskcrop2Tb::model()->findByAttributes(array('lrc_registernumber' => $rgn)); //, 

				if ($mrc) {
					//echo "y,{$registernumber} <br>";
					//เปลี่ยนสถานะกลุ่มเสี่ยง
					if ($st === 1) {
						$mrc->lrc_updateby = Yii::app()->user->username;
						$mrc->lrc_modified = date('Y-m-d H:i:s');
						$mrc->lrc_status = $st;
						if ($mrc->save()) {
							$msg2 = "";
							//$scc = $scc + 1; //จำนวนสำเร็จ
							//$sc = 0; //สถานะ error
						} else {
							$msg2 = $mrc->getErrors();
							//$sce = $sce + 1; //จำนวน error
							//$sc = 1; //สถานะ error
						} //if 
					} //if

					if ($st === 2) {
						$mrc->lrc_updateby = Yii::app()->user->username;
						$mrc->lrc_modified = date('Y-m-d H:i:s');
						$mrc->lrc_status = $st;
						$mrc->lrpt_abs_prot = $abs_prot;
						$mrc->lrpt_abs_gaz = $abs_gaz;
						$mrc->lrpt_abs_due = $abs_due;
						$mrc->lrpt_bkr_prot = $bkr_prot;
						$mrc->lrpt_req = $req_dt;
						$mrc->lrpt_lastupdate = $lastudt;
						$mrc->lrpt_df_id = $df_id;
						$mrc->lrpt_df_name = $df_name;
						$mrc->lrpt_df_surname = $df_surname;
						if ($mrc->save()) {
							$msg2 = "";
							//$scc = $scc + 1; //จำนวนสำเร็จ
							//$sc = 0; //สถานะ error
						} else {
							// $msg2 = $mrc->getErrors();
							$msg2 = "";
							//$sce = $sce + 1; //จำนวน error
							//$sc = 1; //สถานะ error
						}
					} //if 
				} else {
					$conn = Yii::app()->db;
					$sq3 = "INSERT IGNORE INTO ledriskcrop2_tb(
					lrc_accno,
					lrc_bran,
					lrc_registernumber,
					lrc_registername,
					lrc_ssocode1,
					lrc_ssocode2,
					lrc_address,
					lrc_amphur,
					lrc_province,
					lrc_zipcode,
					lrc_createby,
					lrc_created,
					lrc_updateby,
					lrc_modified,
					lrc_remark,
					lrc_status,
					lrpt_abs_prot,
					lrpt_abs_gaz,
					lrpt_abs_due,
					lrpt_bkr_prot,
					lrpt_req,
					lrpt_lastupdate,
					lrpt_df_id,
					lrpt_df_name,
					lrpt_df_surname
					)
					VALUES
					(
						:lrc_accno,
						:lrc_bran,
						:lrc_registernumber,
						:lrc_registername,
						:lrc_ssocode1,
						:lrc_ssocode2,
						:lrc_address,
						:lrc_amphur,
						:lrc_province,
						:lrc_zipcode,
						:lrc_createby,
						:lrc_created,
						:lrc_updateby,
						:lrc_modified,
						:lrc_remark,
						:lrc_status,
						:lrpt_abs_prot,
						:lrpt_abs_gaz,
						:lrpt_abs_due,
						:lrpt_bkr_prot,
						:lrpt_req,
						:lrpt_lastupdate,
						:lrpt_df_id,
						:lrpt_df_name,
						:lrpt_df_surname
						)
					";


					$command = $conn->createCommand($sq3);
					$command->bindValue(":lrc_accno", $rowsArr['lrc_accno']);
					$command->bindValue(":lrc_bran", $rowsArr['lrc_bran']);
					$command->bindValue(":lrc_registernumber", $rowsArr['lrc_registernumber']);
					$command->bindValue(":lrc_registername", $rowsArr['lrc_registername']);
					$command->bindValue(":lrc_ssocode1", $rowsArr['lrc_ssocode1']);
					$command->bindValue(":lrc_ssocode2", $rowsArr['lrc_ssocode2']);
					$command->bindValue(":lrc_address", $rowsArr['lrc_address']);
					$command->bindValue(":lrc_amphur", $rowsArr['lrc_amphur']);
					$command->bindValue(":lrc_province", $rowsArr['lrc_province']);
					$command->bindValue(":lrc_zipcode", $rowsArr['lrc_zipcode']);
					$command->bindValue(":lrc_createby", Yii::app()->user->username);
					$command->bindValue(":lrc_created", date('Y-m-d H:i:s'));
					$command->bindValue(":lrc_updateby", Yii::app()->user->username);
					$command->bindValue(":lrc_modified", date('Y-m-d H:i:s'));
					$command->bindValue(":lrc_remark", '-');
					$command->bindValue(":lrc_status", $st);
					$command->bindValue(":lrpt_abs_prot", $abs_prot);
					$command->bindValue(":lrpt_abs_gaz", $abs_gaz);
					$command->bindValue(":lrpt_abs_due", $abs_due);
					$command->bindValue(":lrpt_bkr_prot", $bkr_prot);
					$command->bindValue(":lrpt_req", $req_dt);
					$command->bindValue(":lrpt_lastupdate", $lastudt);
					$command->bindValue(":lrpt_df_id", $df_id);
					$command->bindValue(":lrpt_df_name", $df_name);
					$command->bindValue(":lrpt_df_surname", $df_surname);
					$command->execute();
				}


				$msg2 = "";

				echo "เลข 13 หลัก: {$rgn}<br>{$msg}, {$msg2} <br>";
				echo "{$msg3} <br>";

				$time_end = microtime(true);
				$execution_time = ($time_end - $time_start) / 60;
				echo '<b>ใช้เวลาเรียก service:</b> ' . $execution_time . ' Mins <br>';
				//*********************************************************
			} else { //if
				http_response_code(401);
				exit;
			}
		} else { //if
			http_response_code(401);
				exit;
		}
	} //function

	public function actionLoadimportresultled()
	{
		$checkdoc2 = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/led";

		$yearter = intval(date("Y")) + 543;
		$yearter2 = substr($yearter, 2);

		$monter = date("m");
		$dayter = date("d");

		$log_file_data = $checkdoc2 . '/log_' . $yearter2 . $monter . $dayter . '.TXT';

		if (file_exists($log_file_data)) {
			$arrfile = explode("/", $log_file_data);
			$type = mime_content_type($log_file_data);
			header('Content-Type: ' . $type);
			header('Content-Length: ' . filesize($log_file_data));
			header('Content-Disposition: attachment;filename=' . urldecode(end($arrfile)));
			readfile($log_file_data);
		}else{
			echo "ไม่พบไฟล์";
		}

	} //โหลด txt file ตาม get params

}
