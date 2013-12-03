<?php
$page ="ouderavond_select";
include("../page/head.php");
?>
<h2>Gemaakte afspraken</h2>
<p>Op deze pagina kunt u handmatig de afspraken voor de ouderavonden bekijken.</p>
<?
if ($_REQUEST["naam"] == ""){
	?>
	<form action="afspraken.php" method="get">
<table>
<tr>
    <td>Email adres</td><td><input type="text" name="naam" /></td><td>&nbsp;</td>
</tr>
<tr>
  <td></td><td><input type="submit" value="Aanmelden" /></td>
</tr>
</table>
</form>
	<?
	}else{
$naam = mysql_real_escape_string($_REQUEST["naam"]);

$res = mysql_query("SELECT * 
FROM aanmelding_ouders, verzorgers
WHERE verzorgers.email =  '$naam'
AND verzorgers.id = aanmelding_ouders.verzorger_id");

$arr = mysql_fetch_array($res);
echo "<p>Beste " . $arr["vnaam"] .", ";
echo "u wordt verwacht bij de volgende docenten op ";
echo "<b> ".$arr["afspraak_datum"]."</b>:";
echo "</p>";
echo $arr["afspraken"];
?>
<p>
Alle afspraken zijn gepland op locatie Oost (Bergweg 4) in de aula</p><p>
Mocht u verhinderd zijn dan kan u dit telefonisch of via info@ostrealyceum.nl laten weten.
</p>
<?
	}
include("../page/foot.php");
?>
