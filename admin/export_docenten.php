<?php

header("Content-type: application/download\n");
header("Content-disposition: attachment; filename=docenten_export.txt\n\n");
echo "CODE"."\t"."NAAM"."\t"."GESLACHT";
include("connect.php");
include("functions.php");
$result = mysql_do_query("SELECT * FROM leraren WHERE afkorting != '' GROUP BY afkorting ");
while($arr = mysql_fetch_array($result)){
echo "\r\n";
echo $arr["afkorting"]."\t";
echo $arr["vnaam"]."\t";
echo $arr["geslacht"]."\t";

}
?>