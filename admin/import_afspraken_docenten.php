<?php
include("connect.php");
$content = $_POST["dagdeel1"];
$array = preg_split("/([A-Z]{3,5})/",$content,-1,PREG_SPLIT_DELIM_CAPTURE);

for($i=1;$i<count($array);$i++){
	$lines[$i] = preg_split("/\n/",$array[$i]);
	//print_r($lines[$i]);
	$afkorting = $lines[$i-1][count($lines[$i-1])-1];
	echo "$afkorting <br />\n";
	$datum = $lines[$i][3];
	$afspraken = "";
	for ($j=0;$j<count($lines[$i]);$j++){
		if (strlen($lines[$i][$j])>2){
			$afspraken .= $lines[$i][$j] . "<br />";
			}
		}
	$afspraken = mysql_real_escape_string($afspraken);
	$sql_res = mysql_query("UPDATE  `leraren` SET  `afspraken_d1` =  '$afspraken' WHERE  `leraren`.`afkorting` ='$afkorting';");
	}
echo "Dagdeel 1 succesvol geimporteerd<br />\n";
$content = $_POST["dagdeel2"];
$array = preg_split("/([A-Z]{3,5})/",$content,-1,PREG_SPLIT_DELIM_CAPTURE);

for($i=1;$i<count($array);$i++){
	$lines[$i] = split("\n",$array[$i]);
	//print_r($lines[$i]);
	$afkorting = $lines[$i-1][count($lines[$i-1])-1];
	echo "$afkorting <br />\n";
	$datum = $lines[$i][3];
	$afspraken = "";
	for ($j=0;$j<count($lines[$i]);$j++){
		if (strlen($lines[$i][$j])>2){
			$afspraken .= $lines[$i][$j] . "<br />";
			}
		}
	$afspraken = mysql_real_escape_string($afspraken);
	$sql_res = mysql_query("UPDATE  `leraren` SET  `afspraken_d2` =  '$afspraken' WHERE  `leraren`.`afkorting` ='$afkorting';");
	}
echo "Dagdeel 2 succesvol geimporteerd<br />\n";
echo "Alles succesvol geimporteerd";
?>
