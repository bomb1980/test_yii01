<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PndController extends Controller
{
	public $pnd50 = [];
	public $pnd01 = [];
	public $pnd01a = [];
	public $attachpna = [];

	public function beforeAction($action)
	{
		if (Yii::app()->session->contains('pnd50'))
			$this->pnd50 = Yii::app()->session['pnd50'];

		if (Yii::app()->session->contains('pnd01'))
			$this->pnd01 = Yii::app()->session['pnd01'];

		if (Yii::app()->session->contains('pnd01a'))
			$this->pnd01a = Yii::app()->session['pnd01a'];

		if (Yii::app()->session->contains('attachpna'))
			$this->attachpna = Yii::app()->session['attachpna'];
		return parent::beforeAction($action);
	}

	public function afterAction($action)
	{
		Yii::app()->session['pnd50'] = $this->pnd50;
		Yii::app()->session['pnd01'] = $this->pnd01;
		Yii::app()->session['pnd01a'] = $this->pnd01a;
		Yii::app()->session['attachpna'] = $this->attachpna;

		return parent::afterAction($action);
	}

	public function actionOpenpnd()
	{

		//$idplib = new Idplib();
		//$idplib->getIdpinfo();

		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				//*********************************************************
				$snum = $_POST['snum'];
				$lremark = "เปิดเมนูย่อยsearch:" . $snum;
				$msgresult = Yii::app()->Clogevent->createlogevent("open", "searchpage", "opensearchpage", "subsearch", $lremark);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/pnd' . $snum);
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

	public function actionCallpnd101()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				$selopt = $_POST['selopt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคลประเภท" . $selopt . "ด้วย:" . $seltxt . "&" . $schtxt;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "Revenue", $levremark);

				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';

				$json = $this->Callpnd01($seltxt, $schtxt);
				$this->pnd01 = $json;
				$data = array('json' => $json, 'nid' => $seltxt, 'year' => $schtxt);

				$this->render('/site/searchpages/callpnd101', $data);
			}
		}
	} //function

	function Callpnd01($nid, $year)
	{

		$param = [
			'NIDSearch' => $nid,
			'branchNo' => '000000',
			'formCode' => 'PND1',
			'taxYear' => $year,
			'taxMonthBegin' => '0',
			'taxMonthEnd' => '12',
			'NIDStatus' => '0'
		];
		$json = json_encode($param);

		$json = str_replace('{', '%7B', $json);
		$json = str_replace('}', '%7D', $json);
		$json = str_replace('"', '%22', $json);

		$url = 'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/' . $json;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			//CURLOPT_URL => 'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/%7B%22NIDSearch%22:%220835557013779%22,%22branchNo%22:%22000000%22,%22formCode%22:%22PND1%22,%22taxYear%22:%222562%22,%22taxMonthBegin%22:%221%22,%22taxMonthEnd%22:%221%22,%22NIDStatus%22:%220%22%7D',
			CURLOPT_URL => $url,
			//proxy suport
			//CURLOPT_PROXY => '172.16.11.95',
			//CURLOPT_PROXYPORT => '8080',
			//CURLOPT_PROXYTYPE => 'HTTP',
			//CURLOPT_HTTPPROXYTUNNEL => 1, //end proxy
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'username: rdsso',
				'password: -hZtdG.68+c3L+g$'
			),
		));

		$response = curl_exec($curl);

		if (curl_errno($curl)) {
			echo 'Curl error: ' . curl_error($curl);
			exit;
		}
		curl_close($curl);

		$resjson = json_decode($response, true);

		if (json_last_error() === JSON_ERROR_NONE) {
			//echo $response;
		} else {
			echo "กรุณาค้นหาใหม่อีกครั้ง !! ";
			exit();
		}
		return $resjson;
	}

	function CallGetHeader($dlnNo)
	{
		$dlnNo2 = [
			"dlnNo" => urlencode($dlnNo)
		];
		$json = json_encode($dlnNo2);

		$json = str_replace('{', '%7B', $json);
		$json = str_replace('}', '%7D', $json);
		$json = str_replace('"', '%22', $json);

		$url = 'https://platformext.rd.go.th/SSOService/wht/GetHeaderPNDInfoDetA/' . $json; //echo $url;exit;


		//'https://platformext.rd.go.th/SSOService/wht/GetHeaderPNDInfoDetA/%7B%22dlnNo%22:%22%E0%B8%A0%E0%B8%87%E0%B8%94100006000118300203012562031102200209%22%7D'
		//'https://platformext.rd.go.th/SSOService/wht/GetHeaderPNDInfoDetA/%7B%22dlnNo%22:%22%E0%B8%A0%E0%B8%87%E0%B8%94100006000118300203012562031102200209%22%7D'

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			//proxy suport
			//CURLOPT_PROXY => '172.16.11.95',
			//CURLOPT_PROXYPORT => '8080',
			//CURLOPT_PROXYTYPE => 'HTTP',
			//CURLOPT_HTTPPROXYTUNNEL => 1, //end proxy
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'username: rdsso',
				'password: -hZtdG.68+c3L+g$'
			),
		));

		$response = curl_exec($curl);

		if (curl_errno($curl)) {
			echo 'Curl error: ' . curl_error($curl);
			exit;
		}

		curl_close($curl);

		$result = json_decode($response, TRUE);

		if (json_last_error() === JSON_ERROR_NONE) {
			//echo $response;
		} else {
			echo "กรุณาค้นหาใหม่อีกครั้ง !! ";
			exit();
		}

		return $result;
	}

	function DateThai($strDate)
	{
		$strYear		=		date("Y", strtotime($strDate)) + 543;
		$strMonth =		date("n", strtotime($strDate));
		$strDay =		date("j", strtotime($strDate));
		$strHour =		date("H", strtotime($strDate));
		$strMinute =		date("i", strtotime($strDate));
		$strSeconds =	date("s", strtotime($strDate));
		$strMonthCut = array(
			"", "มกราคม",
			"กุมภาพันธ์",
			"มีนาคม",
			"เมษายน",
			"พฤษภาคม",
			"มิถุนายน",
			"กรกฎาคม",
			"สิงหาคม",
			"กันยายน",
			"ตุลาคม",
			"พฤศจิกายน",
			"ธันวาคม"
		);
		$strMonthThai = $strMonthCut[$strMonth];
		$strYearCut = substr($strYear, 2, 2); //เอา2ตัวท้ายของปี .พ.ศ. 
		return "$strDay $strMonthThai $strYear";
	} //end function DateThai

	public function actionExportpnd01()
	{
		//$js = $this->pnd01;
		//var_dump($js);exit;

		$this->layout = 'nolayout';
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				error_reporting(E_ALL | E_STRICT);
				try {
					ini_set('memory_limit', '2048M');
					ini_set('max_execution_time', 0);

					$nid = $_REQUEST['nid'];
					$year = $_REQUEST['year'];

					$pnd = null;
					if (!empty($_REQUEST['pnd'])) $pnd = $_REQUEST['pnd'];

					$pnd_txt = "";
					if (is_null($pnd_txt)) {
						$pnd_txt = "ภงด";
					}
					if ($pnd == "pnd01") {
						$pnd_txt = "ภงด 1";
						$json = $this->pnd01;
					} elseif ($pnd == "pnd01a") {
						$pnd_txt = "ภงด 1ก";
						$json = $this->pnd01a;
					}

					//$json = $this->Callpnd01($nid, $year);
					//$json = $this->pnd01;

					$sortpndmonth = $json['responseData']['detailInformation'];
					$marks = array();
					$marks2 = array();

					foreach ($sortpndmonth as $key => $row) {
						$marks[$key] = $row['taxMonth'];
						$marks2[$key] = $row['dlnNo'];
					}

					array_multisort($marks, $marks2, SORT_ASC, $sortpndmonth);

					//count($sortpndmonth);
					$NIDSearch = ($json['responseData']['NIDSearch']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา

					$write_array = array();
					$fileName = "excel.xlsx";
					$fileName = 'download_' . date('Ymd_His') . ".xlsx";

					$spreadsheet = new Spreadsheet();

					for ($i = 0; $i <= (count($sortpndmonth) - 1); $i++) {

						$NID = ($sortpndmonth[$i]['NID']);
						$branchNo = ($sortpndmonth[$i]['branchNo']);
						$formCode = ($sortpndmonth[$i]['formCode']);
						$submitNo = ($sortpndmonth[$i]['submitNo']);
						$taxYear = ($sortpndmonth[$i]['taxYear']);
						$dlnNo = ($sortpndmonth[$i]['dlnNo']);
						$taxMonth = ($sortpndmonth[$i]['taxMonth']);
						$NIDStatus = ($sortpndmonth[$i]['NIDStatus']);
						$totSetOfAttach = ($sortpndmonth[$i]['totSetOfAttach']);

						$levremark = "ส่งออกข้อมูลรายการภาษีเงินได้นิติบุคคลประเภท " . $formCode . " ด้วย:" . $dlnNo . "&" . $taxYear;
						$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "Revenue", $levremark);


						$json = $this->CallGetHeader($dlnNo);
						$fnameWhld = $json['responseData']['taxpayerInformation']['fitstName'];
						$totNum = $json['responseData']['masterInformation']['totNum'];
						$write_array[] = array("รายงานผู้เสียภาษีเงินได้ภาษีอากร {$pnd_txt} ของสถานประกอบการ " . $fnameWhld . " เลขประจำตัวผู้เสียภาษีอากร " . $NIDSearch,);

						$write_array[] = array("ลำดับ", "คำนำหน้า", "ชื่อ", "นามสกุล", "เลขบัตรประชาชน", "มาตราตามรหัสแนบ", "วันเดือนปีที่จ่าย", "จำนวนเงินได้ที่จ่าย", "จำนวนเงินภาษีที่หักและนำส่ง");

						$k = 1;
						for ($j = 1; $j <= $totSetOfAttach; $j++) {

							$jsatt = $this->GetAttachPND($dlnNo, $j);
							$detailInformation = $jsatt['responseData']['detailInformation'];

							foreach ($detailInformation as $rows) {

								$personalInformation = $rows['personalInformation'];
								$attachDetailInformation = $rows['attachDetailInformation'];

								$detail_array = array();
								foreach ($attachDetailInformation as $key => $vals) {
									switch ($key) {
										case (strpos($key, 'incType') !== false);
											$pieces = explode("Desc", $key);
											if (count($pieces) == 2) {
												break;
											} else {
												$detail_array['incType'] = $vals;
												break;
											}
										case (strpos($key, 'paidDate') !== false);
											$paidDate = $vals;
											if (DateTime::createFromFormat("Y-m-d", $vals) !== false) {
												//echo $vals;
												$paidDate = $this->DateThai($vals);
											}
											$detail_array['paidDate'] = $paidDate;
											break;
										case (strpos($key, 'paidAmt') !== false);
											$detail_array['paidAmt'] = $vals;
											break;
										case (strpos($key, 'taxAmt') !== false);
											$detail_array['taxAmt'] = $vals;
											break;
										default:
											//$detail_array[] = $vals;
									}
								}


								$write_array[] = [$k, $personalInformation['titleCode'], $personalInformation['fnameWhld'], $personalInformation['snameWhld'], $personalInformation['NIDWhld'], $detail_array['incType'], $detail_array['paidDate'], $detail_array['paidAmt'], $detail_array['taxAmt']];

								//$write_array[] = [$k, $personalInformation['titleCode'], $personalInformation['fnameWhld'], $personalInformation['snameWhld']];
								$k++;
							}
						}

						$spreadsheet->createSheet();
						$spreadsheet->getDefaultStyle()->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
						$spreadsheet->setActiveSheetIndex($i);
						$spreadsheet->getActiveSheet()->fromArray($write_array, NULL, 'A1');
						$spreadsheet->getActiveSheet()->setTitle("ภงด01_" . $taxMonth);


						$spreadsheet->getActiveSheet()->mergeCells("A1:I1");
						$spreadsheet->getActiveSheet()->getStyle("A1")->getAlignment()->applyFromArray(
							[
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							]
						);
						//$spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
						foreach (range('A', 'I') as $columnID) {
							//$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
						}
						$spreadsheet->getActiveSheet()->getColumnDimension("A")->setWidth(6);
						$spreadsheet->getActiveSheet()->getColumnDimension("B")->setWidth(8.5);
						$spreadsheet->getActiveSheet()->getColumnDimension("C")->setWidth(20);
						$spreadsheet->getActiveSheet()->getColumnDimension("D")->setWidth(20);
						$spreadsheet->getActiveSheet()->getColumnDimension("E")->setWidth(15);
						$spreadsheet->getActiveSheet()->getColumnDimension("F")->setWidth(17);
						$spreadsheet->getActiveSheet()->getColumnDimension("G")->setWidth(13);
						$spreadsheet->getActiveSheet()->getColumnDimension("H")->setWidth(15.5);
						$spreadsheet->getActiveSheet()->getColumnDimension("I")->setWidth(24);


						$spreadsheet->getActiveSheet()->getStyle("B2:I2")->getAlignment()->applyFromArray(
							[
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							]
						);

						$styleArray = [
							'font' => [
								'name'  => 'TH Sarabun New',
								'size'  => 16,
							],/*
						'alignment' => [
							'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
						],*/
							'borders' => [
								'top' => [
									'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								],
								'right' => [
									'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								],
								'bottom' => [
									'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								],
								'left' => [
									'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								],
							],
						];

						for ($l = 1; $l <= $k + 1; $l++) {
							//$spreadsheet->getActiveSheet()->getStyle('A' . $i . ':' . 'A' . $i)->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('A' . $l . ':' . 'I' . $l)->applyFromArray($styleArray);

							$spreadsheet->getActiveSheet()->getStyle('A' . $l . ':' . 'A' . $l)->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('B' . $l . ':' . 'B' . $l)->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('C' . $l . ':' . 'C' . $l)->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('D' . $l . ':' . 'D' . $l)->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('E' . $l . ':' . 'E' . $l)->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('F' . $l . ':' . 'F' . $l)->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('G' . $l . ':' . 'G' . $l)->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('H' . $l . ':' . 'H' . $l)->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('I' . $l . ':' . 'I' . $l)->applyFromArray($styleArray);
						}

						//$spreadsheet->getActiveSheet()->getStyle('A1:' . 'I' . $k+1)->applyFromArray($styleArray);

						//$spreadsheet->getActiveSheet()->getStyle('A1:B12')->applyFromArray($styleArray);
						$spreadsheet->getActiveSheet()->getStyle('H3:I' . ($k + 1))->getNumberFormat()->setFormatCode('###,###,##0.00');
						$spreadsheet->getActiveSheet()->getStyle('E3:E' . ($k + 1))->getNumberFormat()->setFormatCode('@');
						$spreadsheet->getActiveSheet()->getStyle('E3:E' . ($k + 1))->getNumberFormat()->setFormatCode('#');
						/*$spreadsheet->getActiveSheet()->getStyle("B11:B12")->getAlignment()->applyFromArray(
						[
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
						]
					);*/

						$write_array = [];
					}

					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					header('Content-Disposition: attachment;filename="' . $fileName . '"');
					header('Cache-Control: max-age=0');
					header('Cache-Control: max-age=1');
					header('Cache-Control: cache, must-revalidate');
					header('Pragma: public');

					ob_start();
					$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
					$writer->save("php://output");
					$content = ob_get_contents();
					ob_clean();

					$response =  array(
						'status' => 'success',
						'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($content)
					);
					echo json_encode($response);
				} catch (\Exception $e) {
					echo json_encode(array('msg' => $e->getMessage()));
				}

				//CallGetHeader
			}
		}
	}

	public function actionExportpnd01page()
	{
		//$js = $this->pnd01;
		//var_dump($js);exit;

		$this->layout = 'nolayout';
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				error_reporting(E_ALL | E_STRICT);
				try {
					ini_set('memory_limit', '2048M');
					ini_set('max_execution_time', 0);

					$setPage = null;
					if (!empty($_REQUEST['setPage'])) $setPage = $_REQUEST['setPage'];

					$pnd = null;
					if (!empty($_REQUEST['pnd'])) $pnd = $_REQUEST['pnd'];

					$pnd_txt = "";
					if (is_null($pnd_txt)) {
						$pnd_txt = "ภงด";
					}
					if ($pnd == "pnd01") {
						$pnd_txt = "ภงด 1";
						$json = $this->pnd01;
					} elseif ($pnd == "pnd01a") {
						$pnd_txt = "ภงด 1ก";
						$json = $this->pnd01a;
					}
				
					//$json = $this->Callpnd01($nid, $year);
					//$json = $this->pnd01;

					$sortpndmonth = $json['responseData']['detailInformation'];
					//var_dump($sortpndmonth);
					//exit;

					$filterdlnNo = null;
					if (!empty($_REQUEST['dlnNo'])) $filterdlnNo = $_REQUEST['dlnNo'];

					$marks = array();
					$marks2 = array();

					foreach ($sortpndmonth as $key => $row) {
						$marks[$key] = $row['taxMonth'];
						$marks2[$key] = $row['dlnNo'];
					}

					array_multisort($marks, $marks2, SORT_ASC, $sortpndmonth);

					//count($sortpndmonth);
					$NIDSearch = ($json['responseData']['NIDSearch']); //เลขประจำตัวผู้เสียภาษีอากรที่ค้นหา

					$write_array = array();
					$fileName = "excel.xlsx";
					$fileName = 'download_' . date('Ymd_His') . ".xlsx";

					$spreadsheet = new Spreadsheet();

					for ($i = 0; $i <= (count($sortpndmonth) - 1); $i++) {

						$NID = ($sortpndmonth[$i]['NID']);
						$branchNo = ($sortpndmonth[$i]['branchNo']);
						$formCode = ($sortpndmonth[$i]['formCode']);
						$submitNo = ($sortpndmonth[$i]['submitNo']);
						$taxYear = ($sortpndmonth[$i]['taxYear']);
						$dlnNo = ($sortpndmonth[$i]['dlnNo']);
						$taxMonth = ($sortpndmonth[$i]['taxMonth']);
						$NIDStatus = ($sortpndmonth[$i]['NIDStatus']);
						$totSetOfAttach = ($sortpndmonth[$i]['totSetOfAttach']);

						if ($dlnNo == $filterdlnNo) {				

							
							$json = $this->CallGetHeader($dlnNo);
							$fnameWhld = $json['responseData']['taxpayerInformation']['fitstName'];
							$totNum = $json['responseData']['masterInformation']['totNum'];
							$write_array[] = array("รายงานผู้เสียภาษีเงินได้ภาษีอากร {$pnd_txt} ของสถานประกอบการ " . $fnameWhld . " เลขประจำตัวผู้เสียภาษีอากร " . $NIDSearch,);

							$write_array[] = array("ลำดับ", "คำนำหน้า", "ชื่อ", "นามสกุล", "เลขบัตรประชาชน", "มาตราตามรหัสแนบ", "วันเดือนปีที่จ่าย", "จำนวนเงินได้ที่จ่าย", "จำนวนเงินภาษีที่หักและนำส่ง");

							$jsatt = $this->attachpna;
							$detailInformation = $jsatt['responseData']['detailInformation'];
							//$p = $jsatt['responseData']['detailInformation'][0]['personalInformation']['page'];

							$levremark = "ส่งออกข้อมูลรายการภาษีเงินได้นิติบุคคลประเภท " . $formCode . " ด้วย:" . $filterdlnNo . "&" . $taxYear . "Page".$setPage;
							$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "Revenue", $levremark);
							$k = 1;
							foreach ($detailInformation as $rows) {

								$personalInformation = $rows['personalInformation'];
								$attachDetailInformation = $rows['attachDetailInformation'];

								$detail_array = array();
								foreach ($attachDetailInformation as $key => $vals) {
									switch ($key) {
										case (strpos($key, 'incType') !== false);
											$pieces = explode("Desc", $key);
											if (count($pieces) == 2) {
												break;
											} else {
												$detail_array['incType'] = $vals;
												break;
											}
										case (strpos($key, 'paidDate') !== false);
											$paidDate = $vals;
											if (DateTime::createFromFormat("Y-m-d", $vals) !== false) {
												//echo $vals;
												$paidDate = $this->DateThai($vals);
											}
											$detail_array['paidDate'] = $paidDate;
											break;
										case (strpos($key, 'paidAmt') !== false);
											$detail_array['paidAmt'] = $vals;
											break;
										case (strpos($key, 'taxAmt') !== false);
											$detail_array['taxAmt'] = $vals;
											break;
										default:
											//$detail_array[] = $vals;
									}
								}


								$write_array[] = [$personalInformation['seqNo'], $personalInformation['titleCode'], $personalInformation['fnameWhld'], $personalInformation['snameWhld'], $personalInformation['NIDWhld'], $detail_array['incType'], $detail_array['paidDate'], $detail_array['paidAmt'], $detail_array['taxAmt']];

								//$write_array[] = [$k, $personalInformation['titleCode'], $personalInformation['fnameWhld'], $personalInformation['snameWhld']];
								$k++;
							}


							$spreadsheet->createSheet();
							$spreadsheet->getDefaultStyle()->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
							//$spreadsheet->setActiveSheetIndex($i);
							$spreadsheet->setActiveSheetIndex(0);
							$spreadsheet->getActiveSheet()->fromArray($write_array, NULL, 'A1');
							$spreadsheet->getActiveSheet()->setTitle("ภงด01_" . $taxMonth);


							$spreadsheet->getActiveSheet()->mergeCells("A1:I1");
							$spreadsheet->getActiveSheet()->getStyle("A1")->getAlignment()->applyFromArray(
								[
									'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
								]
							);
							//$spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
							foreach (range('A', 'I') as $columnID) {
								//$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
							}
							$spreadsheet->getActiveSheet()->getColumnDimension("A")->setWidth(6);
							$spreadsheet->getActiveSheet()->getColumnDimension("B")->setWidth(8.5);
							$spreadsheet->getActiveSheet()->getColumnDimension("C")->setWidth(20);
							$spreadsheet->getActiveSheet()->getColumnDimension("D")->setWidth(20);
							$spreadsheet->getActiveSheet()->getColumnDimension("E")->setWidth(15);
							$spreadsheet->getActiveSheet()->getColumnDimension("F")->setWidth(17);
							$spreadsheet->getActiveSheet()->getColumnDimension("G")->setWidth(13);
							$spreadsheet->getActiveSheet()->getColumnDimension("H")->setWidth(15.5);
							$spreadsheet->getActiveSheet()->getColumnDimension("I")->setWidth(24);


							$spreadsheet->getActiveSheet()->getStyle("B2:I2")->getAlignment()->applyFromArray(
								[
									'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
								]
							);

							$styleArray = [
								'font' => [
									'name'  => 'TH Sarabun New',
									'size'  => 16,
								],/*
							'alignment' => [
								'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							],*/
								'borders' => [
									'top' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									],
									'right' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									],
									'bottom' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									],
									'left' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									],
								],
							];

							for ($l = 1; $l <= $k + 1; $l++) {
								//$spreadsheet->getActiveSheet()->getStyle('A' . $i . ':' . 'A' . $i)->applyFromArray($styleArray);
								$spreadsheet->getActiveSheet()->getStyle('A' . $l . ':' . 'I' . $l)->applyFromArray($styleArray);

								$spreadsheet->getActiveSheet()->getStyle('A' . $l . ':' . 'A' . $l)->applyFromArray($styleArray);
								$spreadsheet->getActiveSheet()->getStyle('B' . $l . ':' . 'B' . $l)->applyFromArray($styleArray);
								$spreadsheet->getActiveSheet()->getStyle('C' . $l . ':' . 'C' . $l)->applyFromArray($styleArray);
								$spreadsheet->getActiveSheet()->getStyle('D' . $l . ':' . 'D' . $l)->applyFromArray($styleArray);
								$spreadsheet->getActiveSheet()->getStyle('E' . $l . ':' . 'E' . $l)->applyFromArray($styleArray);
								$spreadsheet->getActiveSheet()->getStyle('F' . $l . ':' . 'F' . $l)->applyFromArray($styleArray);
								$spreadsheet->getActiveSheet()->getStyle('G' . $l . ':' . 'G' . $l)->applyFromArray($styleArray);
								$spreadsheet->getActiveSheet()->getStyle('H' . $l . ':' . 'H' . $l)->applyFromArray($styleArray);
								$spreadsheet->getActiveSheet()->getStyle('I' . $l . ':' . 'I' . $l)->applyFromArray($styleArray);
							}

							//$spreadsheet->getActiveSheet()->getStyle('A1:' . 'I' . $k+1)->applyFromArray($styleArray);

							//$spreadsheet->getActiveSheet()->getStyle('A1:B12')->applyFromArray($styleArray);
							$spreadsheet->getActiveSheet()->getStyle('H3:I' . ($k + 1))->getNumberFormat()->setFormatCode('###,###,##0.00');
							$spreadsheet->getActiveSheet()->getStyle('E3:E' . ($k + 1))->getNumberFormat()->setFormatCode('@');
							$spreadsheet->getActiveSheet()->getStyle('E3:E' . ($k + 1))->getNumberFormat()->setFormatCode('#');
							/*$spreadsheet->getActiveSheet()->getStyle("B11:B12")->getAlignment()->applyFromArray(
							[
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
							]
						);*/

							$write_array = [];
							break;
						}
					}

					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					header('Content-Disposition: attachment;filename="' . $fileName . '"');
					header('Cache-Control: max-age=0');
					header('Cache-Control: max-age=1');
					header('Cache-Control: cache, must-revalidate');
					header('Pragma: public');

					ob_start();
					$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
					$writer->save("php://output");
					$content = ob_get_contents();
					ob_clean();

					$response =  array(
						'status' => 'success',
						'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($content)
					);
					echo json_encode($response);
				} catch (\Exception $e) {
					echo json_encode(array('msg' => $e->getMessage()));
				}

				//CallGetHeader
			}
		}
	}


	public function actionCallpnd1a()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				$selopt = $_POST['selopt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคลประเภท" . $selopt . "ด้วย:" . $seltxt . "&" . $schtxt;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "Revenue", $levremark);

				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';

				$json = $this->Callpnd01a($seltxt, $schtxt);
				$this->pnd01a = $json;
				$data = array('json' => $json, 'nid' => $seltxt, 'year' => $schtxt);

				$this->render('/site/searchpages/callpnd1a', $data);
			}
		}
	} //function

	function Callpnd01a($nid, $year)
	{
		$param = [
			'NIDSearch' => $nid,
			'branchNo' => '000000',
			'formCode' => 'PND1A',
			'taxYear' => $year,
			'taxMonthBegin' => '0',
			'taxMonthEnd' => '12',
			'NIDStatus' => '0'
		];
		$json = json_encode($param);

		$json = str_replace('{', '%7B', $json);
		$json = str_replace('}', '%7D', $json);
		$json = str_replace('"', '%22', $json);

		$url = 'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/' . $json;

		//'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/%7B%22NIDSearch%22:%220835557013779%22,%22branchNo%22:%22000000%22,%22formCode%22:%22PND1%22,%22taxYear%22:%222562%22,%22taxMonthBegin%22:%220%22,%22taxMonthEnd%22:%220%22,%22NIDStatus%22:%220%22%7D'
		//'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/%7B%22NIDSearch%22:%220835557013779%22,%22branchNo%22:%22000000%22,%22formCode%22:%22PND1%22,%22taxYear%22:%222562%22,%22taxMonthBegin%22:%221%22,%22taxMonthEnd%22:%221%22,%22NIDStatus%22:%220%22%7D'

		$curl = curl_init();
		curl_setopt_array($curl, array(
			//CURLOPT_URL => 'https://platformext.rd.go.th/SSOService/wht/GetListPNDInfoDetA/%7B%22NIDSearch%22:%220835557013779%22,%22branchNo%22:%22000000%22,%22formCode%22:%22PND1%22,%22taxYear%22:%222562%22,%22taxMonthBegin%22:%221%22,%22taxMonthEnd%22:%221%22,%22NIDStatus%22:%220%22%7D',
			CURLOPT_URL => $url,
			//proxy suport
			//CURLOPT_PROXY => '172.16.11.95',
			//CURLOPT_PROXYPORT => '8080',
			//CURLOPT_PROXYTYPE => 'HTTP',
			//CURLOPT_HTTPPROXYTUNNEL => 1, //end proxy
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'username: rdsso',
				'password: -hZtdG.68+c3L+g$'
			),
		));

		$response = curl_exec($curl);

		if (curl_errno($curl)) {
			echo 'Curl error: ' . curl_error($curl);
			exit;
		}
		curl_close($curl);

		$json = json_decode($response, true);

		if (json_last_error() === JSON_ERROR_NONE) {
			//echo $response;
		} else {
			echo "กรุณาค้นหาใหม่อีกครั้ง !! ";
			exit();
		}
		return $json;
	}
	public function actionCallpnd102()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$dlnNo = $_POST['dlnNo'];
				//echo "{$action},{$schtxt},{$seltxt}";

				//$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;
				$levremark = "ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคลด้วย:" . $dlnNo;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "Revenue", $levremark);

				$json = $this->CallGetHeader($dlnNo);
				$data = array('dlnNo' => $dlnNo, 'json' => $json);
				$this->layout = 'nolayout';

				$this->render('/site/searchpages/callpnd102', $data);
			}
		}
	} //function


	public function actionCallpnd103()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$dlnNo = $_POST['dlnNo'];
				$setPage = $_POST['setPage'];
				//echo "{$action},{$schtxt},{$seltxt}";

				//$levremark = "ค้นหาข้อมูลนิติบุคคลด้วย:" . $seltxt . "&" . $schtxt;
				$levremark = "ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคลตามข้อมูลใบแนบเป็นรายบุคคลด้วย:" . $dlnNo;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "Revenue", $levremark);

				$json = $this->GetAttachPND($dlnNo, $setPage);
				$this->attachpna = $json;

				$data = array('dlnNo' => $dlnNo, 'setPage' => $setPage , 'json' => $json);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/callpnd103', $data);
			}
		}
	} //function

	public function actionGetAttachPND()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$dlnNo = $_POST['dlnNo'];
				$setPage = $_POST['setPage'];

				$levremark = "ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคลตามข้อมูลใบแนบเป็นรายบุคคลและช่วงของแผ่นด้วย:" . $dlnNo . "&" . $setPage;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "Revenue", $levremark);

				$data = array('dlnNo' => $dlnNo, 'setPage' => $setPage);
				$this->layout = 'nolayout';

				$json = $this->GetAttachPND($dlnNo, $setPage);
				$this->attachpna = $json;

				$data = array('json' => $json, 'dlnNo' => $dlnNo, 'setPage' => $setPage);

				$this->render('/site/searchpages/callpndattach', $data);
			}
		}
	}
	function GetAttachPND($dlnNo, $setPage)
	{
		$dlnNo2 = [
			"dlnNo" => urlencode($dlnNo),
			"setPage" => $setPage
		];
		$json = json_encode($dlnNo2);

		$json = str_replace('{', '%7B', $json);
		$json = str_replace('}', '%7D', $json);
		$json = str_replace('"', '%22', $json);

		$url = 'https://platformext.rd.go.th/SSOService/wht/GetAttachPNDInfoDetA/' . $json;

		//https://platformext.rd.go.th/SSOService/wht/GetAttachPNDInfoDetA/{"dlnNo":"ภงด100006000118300203012562021102195411","setPage":"1"}

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			//proxy suport
			//CURLOPT_PROXY => '172.16.11.95',
			//CURLOPT_PROXYPORT => '8080',
			//CURLOPT_PROXYTYPE => 'HTTP',
			//CURLOPT_HTTPPROXYTUNNEL => 1, //end proxy
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'username: rdsso',
				'password: -hZtdG.68+c3L+g$'
			),
		));

		$response = curl_exec($curl);

		if (curl_errno($curl)) {
			echo 'Curl error: ' . curl_error($curl);
			exit;
		}

		curl_close($curl);

		$result = json_decode($response, TRUE);

		if (json_last_error() === JSON_ERROR_NONE) {
			//echo $response;
		} else {
			echo "กรุณาค้นหาใหม่อีกครั้ง !! ";
			exit();
		}
		return $result;
	}

	public function actionCallpnd50()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {
				$action = $_POST['action'];
				$schtxt = $_POST['schtxt'];
				$seltxt = $_POST['seltxt'];
				$selopt = $_POST['selopt'];
				//echo "{$action},{$schtxt},{$seltxt}";

				$levremark = "ค้นหาข้อมูลรายการภาษีเงินได้นิติบุคคลประเภท" . $selopt . "ด้วย:" . $seltxt . "&" . $schtxt;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "Revenue", $levremark);

				$data1 = array('action' => $action, 'schtxt' => $schtxt, 'seltxt' => $seltxt);
				$this->layout = 'nolayout';
				$json = $this->Callpnd50($seltxt, $schtxt);
				$this->pnd50 = $json;
				$data = array('json' => $json, 'nid' => $seltxt, 'year' => $schtxt);

				$this->render('/site/searchpages/callpnd50', $data);
			}
		}
	} //function

	public function actionExportpnd50()
	{
		$this->layout = 'nolayout';
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {

				$nid = $_REQUEST['nid'];
				$year = $_REQUEST['year'];
				//$json = $this->Callpnd50($nid, $year);
				$json = $this->pnd50;
				//var_dump($json);

				if (is_null($json)) {
					echo "ไม่พบข้อมูลกรุณาค้นหาใหม่อีกครั้ง !! ";
					exit();
				}
				if (!array_key_exists('SSO', $json)) {
					echo "กรุณาค้นหาใหม่อีกครั้ง !! ";
					exit();
				}

				$TXP_NID = ($json['SSO']['0']['TXP_NID']);
				$TAX_YEAR = ($json['SSO']['0']['TAX_YEAR']);
				$TXP_TTL_TEXT = ($json['SSO']['0']['TXP_TTL_TEXT']);
				$TXP_C_NAME = ($json['SSO']['0']['TXP_C_NAME']);
				$ADDR_BLD_TEXT = $json['SSO']['0']['ADDR_BLD_TEXT'] == "-" ?  "" : $json['SSO']['0']['ADDR_BLD_TEXT'];
				$ADDR_ROOM_TEXT = $json['SSO']['0']['ADDR_ROOM_TEXT'] == "-" ?  "" : $json['SSO']['0']['ADDR_ROOM_TEXT'];
				$ADDR_FLOOR_TEXT = $json['SSO']['0']['ADDR_FLOOR_TEXT'] == "-" ?  "" : $json['SSO']['0']['ADDR_FLOOR_TEXT'];
				$ADDR_VIL_TEXT = $json['SSO']['0']['ADDR_VIL_TEXT'] == "-" ?  "" : $json['SSO']['0']['ADDR_VIL_TEXT'];
				$ADDR_HOUSE_TEXT = $json['SSO']['0']['ADDR_HOUSE_TEXT'] == "-" ?  "" : $json['SSO']['0']['ADDR_HOUSE_TEXT'];
				$ADDR_MOO_TEXT = $json['SSO']['0']['ADDR_MOO_TEXT'] == "-" ?  "" : $json['SSO']['0']['ADDR_MOO_TEXT'];
				$ADDR_SOI_TEXT = ($json['SSO']['0']['ADDR_SOI_TEXT']);
				$ADDR_STREET_TEXT = ($json['SSO']['0']['ADDR_STREET_TEXT']);
				$ADDR_SUB_DIST_ID = ($json['SSO']['0']['ADDR_SUB_DIST_ID']);
				$ADDR_DIST_ID = ($json['SSO']['0']['ADDR_DIST_ID']);
				$ADDR_PROV_ID = ($json['SSO']['0']['ADDR_PROV_ID']);
				$ADDR_POST_CODE_TEXT = ($json['SSO']['0']['ADDR_POST_CODE_TEXT']);
				$PER_FROM_DATE = ($json['SSO']['0']['PER_FROM_DATE']);
				$PER_TO_DATE = ($json['SSO']['0']['PER_TO_DATE']);
				$SUB_IND = ($json['SSO']['0']['SUB_IND']);
				$SUB_CNT = ($json['SSO']['0']['SUB_CNT']);
				$MFGC_SAL_TOT_AMT = ($json['SSO']['0']['MFGC_SAL_TOT_AMT']);
				$SELE_PSN_EXP_TOT_AMT = ($json['SSO']['0']['SELE_PSN_EXP_TOT_AMT']);

				if (is_null($TXP_NID)) {
					echo $TXP_NID;
					echo "มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้งค่ะ";
					exit;
				}

				$levremark = "ส่งออกข้อมูลรายการภาษีเงินได้นิติบุคคลประเภท ภงด.50 " . "ด้วย:" . $TXP_NID . "&" . $TAX_YEAR;
				$msgresult = Yii::app()->Clogevent->createlogevent("Search", "SearchByInfo", "Search", "Revenue", $levremark);

				if (Yii::app()->user->username) {
					$username = Yii::app()->user->username;
				} else {
					$username = "sys";
				}
				Yii::app()->CCropinfo_tmp->registernumber = $TXP_NID; //กำหนดค่าให้ property in class
				Yii::app()->CCropinfo_tmp->username = $username;
				//$dbddata = Yii::app()->CCropinfo_tmp->Getinfofrmdbd(); //ดึง xml data จาก dbd
				$data = Yii::app()->CCropinfo_tmp->GetinfofrmdbdV5();

				$addressp = "";
				if (property_exists($data->CorpInfo, "branches")) { //var_dump( $data->CorpInfo->branches->branch ); exit;


					if (is_object($data->CorpInfo->branches->branch) || is_array($data->CorpInfo->branches->branch)) {
						//if (is_array($data->CorpInfo->branches->branch)) {
						$array = json_decode(json_encode($data->CorpInfo->branches->branch), true); //var_dump(count($array) );exit;
						foreach ($array as $key => $value) {
							if (is_array($value)) {
								if (array_key_exists('name', $value)) {
									if ($value['name'] == "สำนักงานใหญ่") {
										if (array_key_exists('name', $value)) {
											$name = $value['name'] . " ";
										}
										if (empty($name)) {
											$name = '';
										}

										if (array_key_exists('orderNumber', $value)) {
											$orderNumber = $value['orderNumber'] . " ";
										}
										if (empty($orderNumber)) {
											$orderNumber = 0;
										}

										if (array_key_exists('houseId', $value)) {
											$houseId = $value['houseId'] . " ";
										}
										if (empty($houseId)) {
											$houseId = '';
										}

										if (array_key_exists('houseNumber', $value)) {
											$houseNumber = $value['houseNumber'] . " ";
										}
										if (empty($houseNumber)) {
											$houseNumber = '';
										}

										if (array_key_exists('buildingName', $value)) {
											$buildingName = $value['buildingName'] . " ";
										}
										if (empty($buildingName)) {
											$buildingName = '';
										}

										if (array_key_exists('buildingNumber', $value)) {
											$buildingNumber = $value['buildingNumber'] . " ";
										}
										if (empty($buildingNumber)) {
											$buildingNumber = '';
										}

										if (array_key_exists('buildingFloor', $value)) {
											$buildingFloor = "ชั้น " . $value['buildingFloor'] . " ";
										}
										if (empty($buildingFloor)) {
											$buildingFloor = '';
										}

										if (array_key_exists('village', $value)) {
											$village = $value['village'] . " ";
										}
										if (empty($village)) {
											$village = '';
										}

										if (array_key_exists('moo', $value)) {
											$moo = $value['moo'] . " ";
										}
										if (empty($moo)) {
											$moo = '';
										}

										if (array_key_exists('soi', $value)) {
											$Soi = $value['soi'] . " ";
										}
										if (empty($Soi)) {
											$Soi = '';
										}

										if (array_key_exists('road', $value)) {
											$Road = "ถนน " . $value['road'] . " ";
										}
										if (empty($Road)) {
											$Road = '';
										}

										if (array_key_exists('tumbon', $value)) {
											$tumbon = "ตำบล/แขวง " . $value['tumbon'] . " ";
										}
										if (empty($tumbon)) {
											$tumbon = '';
										}

										if (array_key_exists('ampur', $value)) {
											$ampur = "อำเภอ/เขต " . $value['ampur'] . " ";
										}
										if (empty($ampur)) {
											$ampur = '';
										}

										if (array_key_exists('province', $value)) {
											$province = "จังหวัด " . $value['province'] . " ";
										}
										if (empty($province)) {
											$province = '';
										}

										if (array_key_exists('tumbonCode', $value)) {
											$tumbonCode =  $value['tumbonCode'] . " ";
										}
										if (empty($tumbonCode)) {
											$tumbonCode = '';
										}

										if (array_key_exists('ampurCode', $value)) {
											$ampurCode =  $value['ampurCode'] . " ";
										}
										if (empty($ampurCode)) {
											$ampurCode = '';
										}

										if (array_key_exists('provinceCode', $value)) {
											$provinceCode =  $value['provinceCode'] . " ";
										}
										if (empty($provinceCode)) {
											$provinceCode = '';
										}

										if (array_key_exists('zipCode', $value)) {
											$zipCode =  $value['zipCode'] . " ";
										}
										if (empty($zipCode)) {
											$zipCode = '';
										}

										if (array_key_exists('phoneNumber', $value)) {
											$phoneNumber =  $value['phoneNumber'] . " ";
										}
										if (empty($phoneNumber)) {
											$phoneNumber = '';
										}

										if (array_key_exists('faxNumber', $value)) {
											$faxNumber =  $value['faxNumber'] . " ";
										}
										if (empty($faxNumber)) {
											$faxNumber = '';
										}

										if (array_key_exists('email', $value)) {
											$email =  $value['email'] . " ";
										}
										if (empty($email)) {
											$email = '';
										}
										break;
									};
								}
							} else { //echo $key . " = " . $value . "<br>";
								if (strpos($key, 'name') !== false) {
									$name = $value;
								}
								if (empty($name)) {
									$name = '';
								}

								if (strpos($key, 'orderNumber') !== false) {
									$orderNumber = $value . " ";
								}
								if (empty($orderNumber)) {
									$orderNumber = 0;
								}

								if (strpos($key, 'houseId') !== false) {
									$houseId = $value . " ";
								}
								if (empty($houseId)) {
									$houseId = '';
								}

								if (strpos($key, 'houseNumber') !== false) {
									$houseNumber = $value . " ";
								}
								if (empty($houseNumber)) {
									$houseNumber = '';
								}

								if (strpos($key, 'buildingName') !== false) {
									$buildingName = $value . " ";
								}
								if (empty($buildingName)) {
									$buildingName = '';
								}

								if (strpos($key, 'buildingNumber') !== false) {
									$buildingNumber = $value . " ";
								}
								if (empty($buildingNumber)) {
									$buildingNumber = '';
								}

								if (strpos($key, 'buildingFloor') !== false) {
									$buildingFloor = "ชั้น " . $value . " ";
								}
								if (empty($buildingFloor)) {
									$buildingFloor = '';
								}

								if (strpos($key, 'village') !== false) {
									$village = $value . " ";
								}
								if (empty($village)) {
									$village = '';
								}

								if (strpos($key, 'moo') !== false) {
									$moo = "หมู่ " . $value . " ";
								}
								if (empty($moo)) {
									$moo = '';
								}

								if (strpos($key, 'soi') !== false) {
									$Soi = $value . " ";
								}
								if (empty($Soi)) {
									$Soi = '';
								}

								if (strpos($key, 'road') !== false) {
									$Road = "ถนน " . $value . " ";
								}
								if (empty($Road)) {
									$Road = '';
								}

								if ($key == 'tumbon') {
									$tumbon = "ตำบล/แขวง " . $value . " ";
								}
								if (empty($tumbon)) {
									$tumbon = '';
								}

								if ($key == 'ampur') {
									$ampur = "อำเภอ/เขต " . $value . " ";
								}
								if (empty($ampur)) {
									$ampur = '';
								}

								if ($key == 'province') {
									$province = "จังหวัด " . $value . " ";
								}
								if (empty($province)) {
									$province = '';
								}

								if (strpos($key, 'tumbonCode') !== false) {
									$tumbonCode =  $value . " ";
								}
								if (empty($tumbonCode)) {
									$tumbonCode = '';
								}

								if (strpos($key, 'ampurCode') !== false) {
									$ampurCode =  $value . " ";
								}
								if (empty($ampurCode)) {
									$ampurCode = '';
								}

								if (strpos($key, 'provinceCode') !== false) {
									$provinceCode =  $value . " ";
								}
								if (empty($provinceCode)) {
									$provinceCode = '';
								}

								if (strpos($key, 'zipCode') !== false) {
									$zipCode =  $value . " ";
								}
								if (empty($zipCode)) {
									$zipCode = '';
								}

								if (strpos($key, 'phoneNumber') !== false) {
									$phoneNumber =  $value . " ";
								}
								if (empty($phoneNumber)) {
									$phoneNumber = '';
								}

								if (strpos($key, 'faxNumber') !== false) {
									$faxNumber =  $value . " ";
								}
								if (empty($faxNumber)) {
									$faxNumber = '';
								}

								if (strpos($key, 'email') !== false) {
									$email =  $value . " ";
								}
								if (empty($email)) {
									$email = '';
								}
							}
						}

						//echo "&nbsp;&nbsp;&nbsp; {$name}, {$orderNumber}, {$houseId}, {$houseNumber}, {$buildingName}, {$buildingNumber}, {$buildingFloor}, {$village}, {$moo}, {$Soi}, {$Road}, {$tumbon}, {$ampur}, {$province}, {$tumbonCode}, {$ampurCode}, {$provinceCode}, {$zipCode}, {$phoneNumber}, {$faxNumber}, {$email} <br>";

						$addressp = $houseNumber .  $buildingName  . $buildingNumber  . $buildingFloor  . $village .  $moo  . $Soi . $Road  . $tumbon  . $ampur .  $province  . $zipCode;
						//echo $addressp;
						//exit;
					}
				}

				$write_array = array();
				$fileName = "excel.xlsx";
				$fileName = 'download_' . date('Ymd_His') . ".xlsx";
				$write_array[] = array("รายละเอียด ภงด.50",);
				$write_array[] = array("คำนำหน้าชื่อ", $TXP_TTL_TEXT);
				$write_array[] = array("ชื่อสถานประกอบการ", $TXP_C_NAME);
				$write_array[] = array("เลขประจำตัวผู้เสียภาษีอากร", $TXP_NID);
				$write_array[] = array("ที่ตั้งสถานประกอบการ", $addressp);
				$write_array[] = array("รอบปีบัญชี", $TAX_YEAR);
				$year = substr($PER_FROM_DATE, 0, 4);
				$month = substr($PER_FROM_DATE, 4, 2);
				$day = substr($PER_FROM_DATE, 6);
				$write_array[] = array("วันเริ่มต้น", $day . "/" . $month . "/" . $year);
				$year1 = substr($PER_TO_DATE, 0, 4);
				$month1 = substr($PER_TO_DATE, 4, 2);
				$day1 = substr($PER_TO_DATE, 6);
				$write_array[] = array("วันสิ้นสุด", $day1 . "/" . $month1 . "/" . $year1);
				$SUB_INDe = "";
				if ($SUB_IND == "1") {
					$SUB_INDe = "ยื่นปกติ";
				} else if ($SUB_IND == "2") {
					$SUB_INDe = "ยื่นเพิ่มเติม";
				} else if ($SUB_IND == "3") {
					$SUB_INDe = "ชำระล่วงหน้า";
				} else {
					$SUB_INDe = "ERROR! ! !";
				}
				$write_array[] = array("สถานะการยื่น", $SUB_INDe);
				$write_array[] = array("ยื่นเพิ่มเติมครั้งที่", $SUB_CNT);
				$write_array[] = array("เงินเดือนและค่าจ้างแรงงาน ทั้งจากกิจการที่ได้รับการยกเว้นภาษีเงินได้และกิจการที่ต้องเสียภาษีเงินได้", $MFGC_SAL_TOT_AMT);
				$write_array[] = array("รายจ่ายเกี่ยวกับพนักงาน ทั้งจากกิจการที่ได้รับยกเว้นภาษีเงินได้และกิจการที่ต้องเสียภาษีเงินได้", $SELE_PSN_EXP_TOT_AMT);

				$spreadsheet = new Spreadsheet();
				$spreadsheet->getDefaultStyle()->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
				$spreadsheet->setActiveSheetIndex(0);
				$spreadsheet->getActiveSheet()->fromArray($write_array, NULL, 'A1');
				$spreadsheet->getActiveSheet()->setTitle("My Excel");
				foreach (range('A', 'B') as $col) {
					//$spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
				}
				$spreadsheet->getActiveSheet()->mergeCells("A1:B1");
				$spreadsheet->getActiveSheet()->getStyle("A1")->getAlignment()->applyFromArray(
					[
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					]
				);
				$spreadsheet->getActiveSheet()->getColumnDimension("A")->setWidth(35);
				$spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
				$spreadsheet->getActiveSheet()->getStyle("A1:A12")->getAlignment()->setWrapText(true);

				//Set table outer borders
				$styleArray = [
					'font' => [
						'name'  => 'TH Sarabun New',
						'size'  => 16,
					],/*
					'alignment' => [
						'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					],*/
					'borders' => [
						'top' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						],
						'right' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						],
						'bottom' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						],
						'left' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						],
					],
				];

				for ($i = 1; $i <= 12; $i++) {
					$spreadsheet->getActiveSheet()->getStyle('A' . $i . ':' . 'A' . $i)->applyFromArray($styleArray);
					$spreadsheet->getActiveSheet()->getStyle('B' . $i . ':' . 'B' . $i)->applyFromArray($styleArray);
				}

				//$spreadsheet->getActiveSheet()->getStyle('A1:B12')->applyFromArray($styleArray);
				$spreadsheet->getActiveSheet()->getStyle('B11:B12')->getNumberFormat()->setFormatCode('###,###,##0.00');
				$spreadsheet->getActiveSheet()->getStyle("B11:B12")->getAlignment()->applyFromArray(
					[
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
					]
				);

				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="' . $fileName . '"');
				header('Cache-Control: max-age=0');
				header('Cache-Control: max-age=1');
				header('Cache-Control: cache, must-revalidate');
				header('Pragma: public');

				ob_start();
				$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
				$writer->save("php://output");
				$content = ob_get_contents();
				ob_clean();
				//return $content;

				$response =  array(
					'status' => 'success',
					'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($content)
				);
				echo json_encode($response);
			}
		}
	}

	function Callpnd50($nid, $year)
	{
		$aContext = array(
			/*
			'http' => array(
				'proxy'           => 'tcp://172.16.11.95:8080',
				'request_fulluri' => true,
			),*/
			"http" => array(
				//'proxy'           => 'tcp://172.16.11.95:8080',
				//'request_fulluri' => true,
				"method" => "GET",
				"header" =>
				"username: rdsso\r\npassword: -hZtdG.68+c3L+g$",
				"Connection: close\r\n",
				"ignore_errors" => true,
				"timeout" => (float)30.0,
			),
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);
		$cxContext = stream_context_create($aContext);

		//$sFile = file_get_contents('http://platformext.rd.go.th/SSOWS/GetInfoPND50?nid=' . $seltxt . '&year=' . $schtxt . '', False, $cxContext);


		////////////////////////////////////////////////////////////////////////////////
		/* main local service */
		//$section = file_get_contents('http://platformext.rd.go.th/SSOWS/GetInfoPND50?nid='.$seltxt.'&year='.$schtxt.'');
		$section = file_get_contents('https://platformext.rd.go.th/SSOService/cit/GetInfoPND50?nid=' . $nid . '&year=' . $year . '', False, $cxContext);
		$section = str_replace("null", "-", $section);
		$json = json_decode($section, true);
		return $json;
	}

	public function actionCallpnd1s()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {

				$dlnNo = $_POST['dlnNo'];

				//echo "{$action},{$schtxt},{$seltxt}";



				$data1 = array('dlnNo' => $dlnNo);
				$this->layout = 'nolayout';
				$this->render('/site/searchpages/callpnd50');
			}
		}
	} //function

	public function actionCallallpnd()
	{
		if (!Yii::app()->user->isGuest) {
			if (isset(Yii::app()->user->username)) {

				$dlnNo = $_POST['dlnNo'];

				//echo "{$action},{$schtxt},{$seltxt}";



				$data1 = array('dlnNo' => $dlnNo);
				$this->layout = 'nolayout';
				//$this->render('/site/servicepages/callpnd50');
			}
		}
	} //function			

}
