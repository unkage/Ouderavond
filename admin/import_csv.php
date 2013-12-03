<?php
//error_reporting(E_ALL);
include("connect.php");
include("functions.php");
include("file_handling.php");
$header = 1; //1 bij wel een kolomaanduiding aan de bovenkant, 0 bij geen.
$comma = "\t";
file_upload('ouders',"ouders.csv");
//file_upload('leraren',"leraren.csv");
echo "<br />";
$file_array = file("ouders.csv");
/*
Door dit script wordt(en) er een nieuwe rij(en) aangemaakt in de tabel verzorgers, en een link van de rij van de leerling naar de rij van de ouders in 'ouders leerling'
*/
for($i=$header;isset($file_array[$i]);$i++){
	$file_array[$i] = mb_convert_encoding($file_array[$i],  "ISO-8859-1", "UTF-8");
	$content = preg_split("/$comma/",$file_array[$i]);
	$j=0;
//&#65279;Leerlingnummer	Volledige Naam	Docent		Afkorting	Geslacht	Lesgroep	VakAfk	Verzorger id	Email	Naam ouders	Leerlingnummer	Straat	Postcode	Plaatsnaam
	$leerling_nummer = str_to_number(mysql_escape_string($content[$j++]));
	$vnaam = mysql_escape_string($content[$j++]);
	$docent = mysql_escape_string($content[$j++]);
	$afk_docent = mysql_escape_string($content[$j++]);
	$geslacht = mysql_escape_string($content[$j++]);
	$stamgroep = substr(mysql_escape_string($content[$j++]),0,2);
	$vak = mysql_escape_string($content[$j++]);
	$verzorger_id = str_to_number(mysql_escape_string($content[$j++]));
	$verzorger_email = mysql_escape_string($content[$j++]);
	$verzorger_vnaam = mysql_escape_string($content[$j++]);	
	//$tussenv = mysql_escape_string($content[2]);
	//$anaam = mysql_escape_string($content[3]);

	//$verzorger_tussenv = mysql_escape_string($content[5]);
	//$verzorger_anaam = mysql_escape_string($content[6]);
	/*

	$huisnummer = mysql_escape_string($content[9]);
	$postcode = mysql_escape_string($content[10]);*/

	$inlognaam = $verzorger_id;//mysql_escape_string($content[12]);
	$password = md5($verzorger_id . $stamgroep . $leerling_nummer);
	mysql_add_link($leerling_nummer,$afk_docent,$vak);	
	mysql_do_query("INSERT INTO `leraren` (`afkorting`, `vnaam`, `tussenv`, `anaam`, `geslacht`) VALUES ('$afk_docent', '$docent', '', '','".strtolower($geslacht)."');");
	mysql_do_query("INSERT INTO `leerlingen` (`leerling_nummer`, `vnaam`, `tussenv`, `anaam`, `stamgroep`, `rooster_toegevoegd`) VALUES ('$leerling_nummer', '$vnaam', '$tussenv', '$anaam', '$stamgroep', '0');");	
	mysql_add_link_parent($leerling_nummer,$verzorger_vnaam,$verzorger_tussenv,$verzorger_anaam,$verzorger_email,$inlognaam,$password,$verzorger_id);
	}
/*
$file_array = file("leraren.csv");

Door dit script worden de leraren toegevoegd.

for($i=$header;isset($file_array[$i]);$j++){
	$file_array[$i] = mb_convert_encoding($file_array[$i], "ISO-8859-1");
	$content = split($comma,$file_array[$i]);
	$afkorting = mysql_escape_string($content[0]);
	$vnaam = mysql_escape_string($content[1]);
	$tussenv = mysql_escape_string($content[2]);
	$anaam = mysql_escape_string($content[3]);
	
	}
*/
?>
