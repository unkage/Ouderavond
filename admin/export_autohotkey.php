<?php
if (isset($_GET["leerling"])){
$leerling = $_GET["leerling"];
$string = "AND leerling_nummer > $leerling";
}
if ($_GET["d"]!=5){
//Debug mode
header("Content-type: application/download\n");
header("Content-disposition: attachment; filename=export_leerlingen.ahk\n\n");
}else{
	header("Content-type: text/plain\n");
	}
/*
MouseClick, left,  486,  15
*/
?>WinWait, OuderavondExpert 6.2g - [Leerlingen],
IfWinNotActive, OuderavondExpert 6.2g - [Leerlingen], , WinActivate, OuderavondExpert 6.2g - [Leerlingen],
WinWaitActive, OuderavondExpert 6.2g - [Leerlingen],
Sleep, 10000
<?php
include("connect.php");
include("functions.php");
$result = mysql_do_query("
SELECT aanmelding_ouders. *, verzorgers. *
FROM aanmelding_ouders
INNER JOIN (
SELECT MAX( id ) AS id
FROM aanmelding_ouders
GROUP BY aanmelding_ouders.`verzorger_id`
)ids ON aanmelding_ouders.id = ids.id,  verzorgers 
WHERE aanmelding_ouders.`leerling_nummer` !=0 AND aanmelding_ouders.`leraren` != '' AND aanmelding_ouders.verzorger_id = verzorgers.id
$string
GROUP BY verzorger_id
");
while($arr = mysql_fetch_array($result)){
	preg_match("/leerlingen=([0-9[:space:]]*)\n/",$arr["post"],$leerlingen);
	$leerling = preg_split("/ /", $leerlingen[1]);
	$leerling_string = "";
	for($i=0;$i<count($leerling);$i++){
		$leerling_string .= get_name($leerling[$i])." ";
	}
	$leraren = preg_split("/ /",$arr["leraren"]);
		echo "Send, {SHIFTUP}".	"{TAB}".$arr["verzorger_id"]."{TAB}". $arr["vnaam"] ." (".$leerling_string."){TAB}".									"\nSleep, 100\nSend, {SHIFTDOWN}".strtolower($leraren[0])."{SHIFTUP}{TAB}{SHIFTDOWN}".strtolower($leraren[1])."{SHIFTUP}{TAB}{SHIFTDOWN}".strtolower($leraren[2])."{SHIFTUP}{TAB}{SHIFTDOWN}".strtolower($leraren[3])."{SHIFTUP}{TAB}{SHIFTDOWN}".strtolower($leraren[4])."{SHIFTUP}{TAB}{SHIFTDOWN}".strtolower($leraren[5])."{SHIFTUP}{TAB}{SHIFTDOWN}".strtolower($leraren[6])."{SHIFTUP}{TAB}{SHIFTDOWN}".strtolower($leraren[7])."{SHIFTUP}{TAB}{SHIFTDOWN}".strtolower($leraren[8])."{SHIFTUP}{TAB}{SHIFTDOWN}".strtolower($leraren[9])."{SHIFTUP}{TAB}".strtolower($arr["dagwens"])."{TAB}{SHIFTDOWN}".strtolower($arr["wens"])."{SHIFTUP}{TAB}\nSleep, 100\nSend, ".substr(strtolower(preg_replace('/[!?]/', '',$arr["tijdwens"])),0,39)."{TAB}{ENTER}\nSleep, 100\n";
	}
