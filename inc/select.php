<?php

/*
a function for error handling in queries
@return result of query($q)
*/
function func_mysql_query($q){
		if (!$res = mysql_query($q)){
				echo "MYSQL ERROR: ".$q . mysql_error();		
			}
			return $res;
	}
function get_subjects(){
		$res = func_mysql_query("SELECT *
FROM `vakken`");
		while($arr = mysql_fetch_array($res)){
				$ret[$arr["afkorting"]] = $arr["vak_naam"];
			}
		return $ret;
	}
function vakken_naam($vakken,$vak){
	$naam = $vakken[preg_replace("/[0-9]/","",$vak)];
	if (empty($naam)){
			return $vak;
		}else{
			return $naam;	
		}
	}
function func_get_leraren($leerling_nummer){
	/*
		Wanneer de persoon een leerling-afhankelijk rooster heeft, wordt deze geretourneerd. 
		Wanneer dit niet het geval is wordt het klassenrooster geretourneerd.	
	*/
	$res_teacher = func_mysql_query("
		SELECT leraren.vnaam , leraren.tussenv , leraren.anaam, leerling_leraar.vak, leraren.afkorting
		FROM `leerling_leraar` , `leraren`
		WHERE leerling_leraar.leerling_nummer = '".$leerling_nummer."'
		AND leerling_leraar.leraar_afkorting = leraren.afkorting
                AND leerling_leraar.leraar_afkorting != ''
		GROUP BY leerling_leraar.leraar_afkorting");
	/*$res2_teacher = func_mysql_query("
		SELECT leraren.vnaam, leraren.tussenv, leraren.anaam, stamgroep_leraar.vak, leraren.afkorting
		FROM `leerlingen` , `leraren` , stamgroep_leraar, `vakken`
		WHERE (
		leerlingen.stamgroep = stamgroep_leraar.stamgroep
		AND leerlingen.leerling_nummer = '".$leerling_nummer."'
		AND stamgroep_leraar.leraar_afkorting = leraren.afkorting
		)
		GROUP BY stamgroep_leraar.leraar_afkorting
		LIMIT 0 , 30");*/
	if (mysql_num_rows($res_teacher)>0){
			return $res_teacher;		
		}else{
			return $res2_teacher;			
			}
	}


function is_selected($argument,$needle,$array,$value){
	if ($array[$argument] == $needle){
			return $value;		
		}	
	}
function draw_list($id,$old_post){
	$vakken = get_subjects();
	$res = func_mysql_query("
	SELECT leerlingen.vnaam, leerlingen.leerling_nummer, leerlingen.stamgroep, leerlingen.anaam
	FROM `leerlingen` , `verzorger_leerling`, `verzorgers`
	WHERE verzorger_leerling.verzorger_id = verzorgers.id
	AND verzorgers.id = '".$id."'
	AND verzorger_leerling.leerling_nummer = leerlingen.leerling_nummer
	GROUP BY leerlingen.vnaam
	LIMIT 0 , 30");
	echo "<ul>";
	$leerlingen = "";
	while($arr = mysql_fetch_array($res)){
		$leerlingen .= $arr["leerling_nummer"]." ";
		echo "<li class=\"student_header\"> &nbsp;".htmlentities($arr["vnaam"],ENT_COMPAT,"UTF-8")." ".htmlentities($arr["anaam"],ENT_COMPAT,"UTF-8")." (".$arr["stamgroep"]." ".$arr["leerling_nummer"].")<ul>";
		$res_teacher = func_get_leraren($arr["leerling_nummer"]);
		while($arr_teacher = mysql_fetch_array($res_teacher)){
			echo "<li>
			<input class=\"teachers\" id=\"".$arr["leerling_nummer"] . "_".$arr_teacher["afkorting"] . "\" name=\"".$arr["leerling_nummer"] . "_".$arr_teacher["afkorting"] . "\" type=\"checkbox\" ".is_selected($arr["leerling_nummer"] . "_".$arr_teacher["afkorting"],"on",$old_post,"checked")."/>
			<label for=\"".$arr["leerling_nummer"] . "_".$arr_teacher["afkorting"] . "\">
			".htmlentities($arr_teacher["vnaam"]) . " " . htmlentities($arr_teacher["tussenv"]) . " " . htmlentities($arr_teacher["anaam"]) . " (" . htmlentities(vakken_naam($vakken,$arr_teacher["vak"])) .")
			</label>
			</li>";
		}
		echo "</ul></li>";
		}
	
	echo "</ul>";
	echo "<input type=\"hidden\" value=\"".$leerlingen."\" name=\"leerlingen\" />";
}
/*
SQL QUERYs

SELECT leraren.vnaam, leraren.tussenv, leraren.anaam, leerling_leraar.vak, leraren.afkorting
FROM `leerlingen` , `leerling_leraar` , `leraren` , stamgroep_leraar
WHERE (
leerlingen.leerling_nummer = leerling_leraar.leerling_nummer
AND leerlingen.leerling_nummer = '300885'
AND leerling_leraar.leraar_afkorting = leraren.afkorting
)
OR (
leerlingen.stamgroep = stamgroep_leraar.stamgroep
AND leerlingen.leerling_nummer = '316447'
AND stamgroep_leraar.leraar_afkorting = leraren.afkorting
)
GROUP BY leerling_leraar.leraar_afkorting
LIMIT 0 , 30

SELECT leraren.vnaam, leraren.tussenv, leraren.anaam, stamgroep_leraar.vak, leraren.afkorting
FROM `leerlingen` , `leraren` , stamgroep_leraar
WHERE (
leerlingen.stamgroep = stamgroep_leraar.stamgroep
AND leerlingen.leerling_nummer = '316447'
AND stamgroep_leraar.leraar_afkorting = leraren.afkorting
)
GROUP BY stamgroep_leraar.leraar_afkorting
LIMIT 0 , 30
*/
