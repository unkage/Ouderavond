<?php
function encode_teacher($name){
		return str_replace(".","^",str_replace(" ","*",$name));
	}
function decode_teacher($code){
		return str_replace("^",".",str_replace("*"," ",$code));	
	}
error_reporting(0);
$page ="ouderavonden";
$wat = $page;
include("../page/head.php");

function func_mysql_query($q){
		if (!$res = mysql_query($q)){
			echo "MYSQL ERROR: ".$q . mysql_error();		
			}
			return $res;
	}
function array_to_csv($array){
		foreach ($array as $key => $value){
				$string .= $key."=".$value."\n";
			}
		return $string;
	}
$vnaam = mysql_real_escape_string($_POST["vnaam"]);
$anaam = mysql_real_escape_string($_POST["anaam"]);
$tussenv = mysql_real_escape_string($_POST["tussenv"]);
$email = mysql_real_escape_string($_POST["oud_email"]);
$email_oud = mysql_real_escape_string($_POST["oud_email"]);
$day = mysql_real_escape_string($_POST["day"]);
$day_pref = mysql_real_escape_string($_POST["day_pref"]);
$time = mysql_real_escape_string($_POST["time"]);
$time_spec = mysql_real_escape_string($_POST["time_spec"]);
$opmerkingen = mysql_real_escape_string($_POST["opmerkingen"]);
$leerlingen = preg_split("/ /",mysql_real_escape_string($_POST["leerlingen"]));
$code = randomcode(0, 20, false);
$md5_code = $_POST["md5_wachtwoord"];
$id = $_POST["id"];
$post_text = mysql_real_escape_string(array_to_csv($_POST));
$totaal_leraren_text = "";
//Verwijder de voorgaande aanmeldingen.
func_mysql_query("DELETE FROM  `aanmeldingen` WHERE  `ouder_id` =  \"$id\"");
foreach($_POST as $key => $value){
		if ($value == "on"){
				$arr = preg_split("/_/",$key);
				func_mysql_query("INSERT INTO `aanmeldingen` (`leraar_afkorting`, `leerling_nummer`, `ouder_id`, `voorkeuren`, `opmerkingen`, `id`, `datum`) VALUES ('".$arr[1]."', '".$arr[0]."', '$id', '$voorkeuren', '$opmerkingen', NULL, NOW());");			
				$leraren_text[$arr[0]] .= $arr[1] . " ";
				$totaal_leraren_text .= $arr[1] . " ";
			}
	}
for($i=0;!empty($leerlingen[$i]);$i++){
	func_mysql_query("
		INSERT INTO `aanmelding_leerlingen` (`id`, `leerling_nummer`, `leraren`, `dagwens`, `wens`, `tijdwens`, `verzorger_id`, `datum`, `opmerkingen`, post) VALUES (NULL, '".$leerlingen[$i]."', '".$leraren_text[$leerlingen[$i]]."', '".$day."', '".$day_pref.$time."', '".$time_spec."', '".$id."', NOW(), '".$opmerkingen."', '".$post_text."');
	");
}
func_mysql_query("
		INSERT INTO `aanmelding_ouders` (`id`, `leerling_nummer`, `leraren`, `dagwens`, `wens`, `tijdwens`, `verzorger_id`, `datum`, `opmerkingen`, post) VALUES (NULL, '".$leerlingen[0]."', '".$totaal_leraren_text."', '".$day."', '".$day_pref.$time."', '".$time_spec."', '".$id."', NOW(), '".$opmerkingen."', '".$post_text."');
	");
?>
	<?php
if (!empty($tussenv)){
	$tussenv .= " ";
}
$mail = "
Geachte $vnaam $tussenv$anaam,

U heeft zich via http://ostrealyceum.org/ouderavond/ opgegeven voor de $wat van het Ostrea Lyceum voor een gesprek met de volgende docenten: ".$totaal_leraren_text." 
U kunt de gegevens (docenten) wijzigen via: http://ouderavond.ostrealyceum.nl/ouderavond/selecteren.php?naam=$email Informatie over hoe laat u wordt verwacht komt later i.v.m. het rooster.

Met vriendelijke groet,
Ostrea Lyceum
";


//mail($email,"Aanmelding Ostrealyceum $wat",$mail,'From: info@ostrealyceum.nl');
$admin_mail = "
$vnaam $tussenv$anaam heeft zich aangemeld voor de ouderavond van het ostrealyceum, met de volgende gegevens:
Email:
$email
Opmerkingen:
$opmerkingen
Dag voorkeur:
$day_pref
Dag:
$day
Tijd:
$time
Specifieke tijd:
$time_spec
Leerlingen:
".$_POST["leerlingen"]."

Mail verstuurd aan $email vanaf info@ostrealyceum.nl:
$mail
";
//mail('info@lemio.nl, info@ostrealyceum.nl',"Aanmelding Ostrealyceum $wat",$admin_mail);

?>
<!--
<i>U heeft een e-mail gekregen op het volgende adres: <? echo $email ?>.</i>
-->
<i>U bent aangemeld.</i>
<table>
<tr>
	<th></th><th><? echo $wat ?></th>
</tr>
<tr>
	<td>Naam:</td><td><? echo htmlentities("$vnaam." .$tussenv." ".$anaam,ENT_COMPAT,"UTF-8") ?></td>
</tr>
<tr class="table_bl">
	<td>Email:</td><td><? echo $email ?></td>
</tr>
<tr>
	<td>Leraren geselecteerd:</td><td><?php  echo implode(" ",$leraren_text) ?></td>
</tr>
</table>

<?php //echo nl2br($mail) ?>

<?php
include("../page/foot.php");
?>
