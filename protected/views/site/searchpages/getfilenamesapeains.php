<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>get filename wpd</title>
<style>
.tablen {
  border-collapse: collapse;
  text-align:center;
}
.tablen th{
  border: 1px solid black;
  text-align:center;
  color:#333;
}
.tablen td{
  border: 1px solid black;
  text-align:center;
  color:#333;
  cursor:pointer;
}
.tablen tr:nth-child(odd){
	background-color:#dbf2fe;
}
.tablen tr:nth-child(even){
	background-color:#fdfdfd;
}
</style>
</head>

<body>
<?php
$log_directory = $_SERVER['DOCUMENT_ROOT'] . "/wpdtextfile/sapains/";
$results_array = array();
if(is_dir($log_directory)){
	if ($handle = opendir($log_directory)){
		//Notice the parentheses I added:
		while(($file = readdir($handle)) !== FALSE){
			$results_array[] = $file;
		}//while
		closedir($handle);
	}//if
}//if

//Output findings
/*foreach($results_array as $value)
{
    echo $value . '<br />';
}*/
?>
<div style="overflow-x:hidden; overflow-y:auto; height:300px;">
 <div class="row">
 	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    	<table class="tablen">
        	<thead>
            	<tr>
                	<th>ลำดับ</th>
                    <th>ชื่อไฟล์</th>
                </tr>
            </thead>
            <tbody>
            	<?php
					$rown = 1;
					foreach($results_array as $value){
						if (!in_array($value,array(".",".."))){
							$filen = $value;
						
				?>
            	<tr>
                	<td><?=$rown?></td>
                    <td><?=$filen?></td>
                </tr>
                <?php
							$rown += 1;
						}//if
					}//foreach
				?>
            </tbody>
        </table>
    </div>
 </div>
</div>	
</body>
</html>