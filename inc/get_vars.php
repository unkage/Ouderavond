<?php
$res = func_mysql_query("
	SELECT *
	FROM `verzorgers`
	WHERE id = '".$id."'
	LIMIT 0 , 1");
$inf_array = mysql_fetch_array($res);

$old_post_res = func_mysql_query("
	SELECT post
	FROM `aanmelding_leerlingen`
	WHERE verzorger_id = '".$id."'
	ORDER BY `aanmelding_leerlingen`.`id` DESC
	LIMIT 0 , 1");

function csv_to_array($csv){
		$csv_lines = preg_split("/\n/",$csv);
		for($i=0;!empty($csv_lines[$i]);$i++){
				$arr = preg_split("/=/",$csv_lines[$i]);
				$res[$arr[0]] = $arr[1];
			}
		return $res;
	}
if (mysql_num_rows($old_post_res)>0){
	$old_post_arr = mysql_fetch_array($old_post_res);
	$old_post = csv_to_array($old_post_arr["post"]);
}else{
	$old_post_csv = 
"day=0
time=G";
	$old_post = csv_to_array($old_post_csv);
}
