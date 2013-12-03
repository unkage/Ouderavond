<?php
//header("Content-type: application/octet-stream");
//header("Content-Disposition: attachment; filename=\"export_mail.txt\"");
//include("file_handling.php");
include("connect.php");

/*$file = "export_mail.txt";
file_upload('export_mail',$file);
$content = file_get_contents($file);
*/
$content = $_POST["text"];
$array = preg_split("/Bergweg 4/",$content);
/*
Ostrea Lyceum vest. Oost
Bergweg 4
Goes
[vnaam] [anaam]
[klas]
[datum]
de heer [naam] om [tijd] in de [locatie].
De volgende docenten zijn afwezig. Ze zullen contact met u opnemen.
mevrouw [naam]
*/

for($i=1;$i<count($array);$i++){
	$lines[$i] = preg_split("/\n/",$array[$i]);
	
	print_r($lines);
	$verzorger_id = $lines[$i][1];
	$datum = $lines[$i][3];
	$afspraken = "";
	for ($j=4;$j<count($lines[$i]);$j++){
		if (strlen($lines[$i][$j])>2){
			$afspraken .= $lines[$i][$j] . "<br />";
			}
		}
	$afspraken = mysql_real_escape_string($afspraken);
echo $afspraken;
	/*$naam_array = split(" ",$naam);de heer F.M. van Lamoen om 19:48 in lokaal 144.<br />
	$vnaam = trim($naam_array[0]);
	$anaam = trim($naam_array[count($naam_array)-1]);*/

	$sql_res = mysql_query("UPDATE  `aanmelding_ouders` SET  `afspraak_datum` =  '$datum', `afspraken` =  '$afspraken' WHERE  `aanmelding_ouders`.`verzorger_id` =$verzorger_id;
");
/*
	SELECT verzorgers.email, verzorgers.vnaam, verzorgers.tussenv, verzorgers.anaam
	FROM leerlingen, verzorger_leerling, verzorgers, aanmelding_ouders
	WHERE leerlingen.`vnaam` LIKE '$vnaam'
	AND leerlingen.`anaam` LIKE '$anaam'
	AND leerlingen.leerling_nummer = aanmelding_ouders.leerling_nummer
	AND verzorgers.id = aanmelding_ouders.verzorger_id
	LIMIT 0 , 30*/
/*
	$sql_array = mysql_fetch_array($sql_res);
	$mail = $sql_array["email"];
	$vnaam_ouder = $sql_array["vnaam"];
	$anaam_ouder = $sql_array["anaam"];
	$tussenv_leerling = $sql_array["letussenv"];
	$tussenv_ouder = $sql_array["tussenv"];
	echo '"'.trim($naam,"\n\r\t") . "\"\t";
	echo '"'.trim($anaam,"\n\r\t") . "\"\t";
	echo '"'.trim($tussenv_leerling,"\n\r\t") . "\"\t";
	echo '"'.str_replace(trim($anaam,"\n\r\t"),"",trim($naam,"\n\r\t")) . "\"\t";
	echo '"'.trim($klas,"\n\r\t") . "\"\t";
	echo '"'.trim($datum,"\n\r\t") . "\"\t";
	echo '"'.$mail . "\"\t";
	echo '"'.$vnaam_ouder . "\"\t";
	echo '"'.$tussenv_ouder . "\"\t";
	echo '"'.$anaam_ouder . "\"\t";
	$afspraken_arr = split("\n",$afspraken);
	for ($j=0;isset($afspraken_arr[$j]);$j++){
		echo '"'.trim($afspraken_arr[$j],"\n\r\t") . "\"\t";
	}
	echo "\n";*/
	}
?>
