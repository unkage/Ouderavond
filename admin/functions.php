<?php
function get_text_content($url) {
	return strip_tags(file_get_contents($url));
}

function mysql_do_query($query){
	//echo $query;
		if (!$res = mysql_query($query)){
				echo mysql_error();	
				//exit;		
			}
		return $res;
	}
/*
@w1 a string of the first word
@w2 a string of the second word
@type a int of the kind of link (first, after, last)
@noreturn
*/
function mysql_add_link($number,$teacher,$subject){
			//echo "mysql_add_link ( $teacher , $number , $subject ) \n";
			$res_w = mysql_do_query("INSERT INTO leerling_leraar (leerling_nummer, leraar_afkorting, vak) VALUES ('".$number."','".$teacher."','".$subject."')");	
}
function at_line($line,$text){
		$array = preg_split("/\r\n/",$text);	
		return $array[$line];
	}
function str_to_number($string){
	$string = str_replace(".","",$string);
	$string = preg_split("/,/",$string);
	return $string[0];
	}
function get_ouders_id($vnaam,$tussenv,$anaam,$email,$login_naam,$wachtwoord,$id){
		$res_w = mysql_do_query("SELECT id FROM verzorgers WHERE (vnaam LIKE '$vnaam' AND tussenv LIKE '$tussenv' AND anaam LIKE '$anaam' AND email LIKE '$email') ORDER BY id DESC LIMIT 0,1");
		$arr_w = mysql_fetch_array($res_w);
		if (isset($arr_w["id"])){
			return $arr_w["id"];
		}
					$res_w = mysql_do_query("INSERT INTO `verzorgers` (
`id` ,
`vnaam` ,
`tussenv` ,
`anaam` ,
`email`,
`inlognaam`,
`wachtwoord`
)
VALUES (
'$id', '$vnaam', '$tussenv' , '$anaam', '$email', '$login_naam', '$wachtwoord'
);
");	
	$res_w = mysql_do_query("SELECT id FROM verzorgers WHERE (vnaam = '$vnaam' AND tussenv = '$tussenv' AND anaam = '$anaam' AND email = '$email') ORDER BY id DESC LIMIT 0,1");
	$arr_w = mysql_fetch_array($res_w);
	return $arr_w["id"];
	}

function mysql_add_link_parent($leerling_nummer,$vnaam,$tussenv,$anaam,$email,$login_naam,$wachtwoord,$id){
			echo "mysql_add_link ( $leerling_nummer,$vnaam,$tussenv,$anaam,$email ) \n";
			$res_w = mysql_do_query("INSERT INTO `verzorger_leerling` (`verzorger_id`, `leerling_nummer`) VALUES ('".get_ouders_id($vnaam,$tussenv,$anaam,$email,$login_naam,$wachtwoord,$id)."','".$leerling_nummer."');");	
	}
function get_name($leerling_nummer){
	$res_w = mysql_do_query("SELECT  `vnaam` ,  `stamgroep` 
FROM  `leerlingen` 
WHERE  `leerling_nummer` =  '$leerling_nummer'
LIMIT 0 , 30");	
	$arr = mysql_fetch_array($res_w);
	return $arr["vnaam"]." ".$arr["stamgroep"];
}
?>
