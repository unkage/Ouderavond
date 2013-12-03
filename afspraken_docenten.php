<?php
$page ="ouderavond_select";
include("../page/head.php");
$naam = mysql_real_escape_string($_REQUEST["naam"]);
?>
<h2>Gemaakte afspraken docenten</h2>
<?
$res = mysql_query("SELECT * 
FROM leraren
WHERE afkorting =  '$naam'");

$arr = mysql_fetch_array($res);
echo "<p>Beste " . $arr["vnaam"] .", </p><p>";
echo "";
echo $arr["afspraken_d1"];
echo "<br />";
echo $arr["afspraken_d2"];
?>
</p>
<p>
Mocht u verhinderd zijn dan kan u dit telefonisch of via info@ostrealyceum.nl laten weten.
</p>
<?
include("../page/foot.php");
?>