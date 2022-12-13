<?php
	$ctc = "0105557151809";//$_GET['ctc'];//"EN";
	//echo "{$ctc}";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Call Service DBD</title>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>

<body>
<div id="a1">
<h2 class="art-postheader">Call Service DBD</h2>
    <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout">
        <div class="art-content-layout-row">
            <div class="art-layout-cell layout-item-0" style="width: 100%" >
                <p>
                	<div class="row">
                    	<div class="col-md-12">
                        	<h3>CropInfo</h3>
							<p>Search by RegisterNumber : <?=$ctc?></p>
                            
                            <?php
								$client = new SoapClient("http://localhost:50096/getCropInfo.asmx?WSDL",
									array(
										"trace"      => 1,     // enable trace to view what is happening
										"exceptions" => 0,     // disable exceptions
										"cache_wsdl" => 0)     // disable any caching on the wsdl, encase you alter the wsdl server
								);
								 
								$params = array(
									'strRegisNum' => "0105557151809"
								);
								 
								 $data = $client->resultCropInfo($params);
								
								 echo '<pre>';
									var_dump($data);
								 echo '</pre>'; 
							 ?>
                            
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                        	<!--Committee-->
                            <h3>Committee</h3>
                            <?php
                            $client = new SoapClient("http://localhost:50096/getCommittee.asmx?WSDL",
									array(
										"trace"      => 1,     // enable trace to view what is happening
										"exceptions" => 0,     // disable exceptions
										"cache_wsdl" => 0)     // disable any caching on the wsdl, encase you alter the wsdl server
								);
								 
								$params = array(
									'strRegisNum' => "0105557151809"
								);
								 
								 $data = $client->resultCommittee($params);
								
								 echo '<pre>';
									var_dump($data);
								 echo '</pre>';
							?> 
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                        <h3>Branch</h3>
                        	<!--branch-->
                          <?php
                            $client = new SoapClient("http://localhost:50096/getBranch.asmx?WSDL",
									array(
										"trace"      => 1,     // enable trace to view what is happening
										"exceptions" => 0,     // disable exceptions
										"cache_wsdl" => 0)     // disable any caching on the wsdl, encase you alter the wsdl server
								);
								 
								$params = array(
									'strRegisNum' => "0105557151809"
								);
								 
								 $data = $client->resultBranch($params);
								
								 echo '<pre>';
									var_dump($data);
								 echo '</pre>';
							?>   
                        </div>
                    </div>
               	</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>