<?php
function login($inlognaam,$wachtwoord){
	$res = func_mysql_query("SELECT id FROM verzorgers WHERE email = '$inlognaam'");
	if (mysql_num_rows($res)==0){
		return false;
	}else{
		$arr = mysql_fetch_array($res);
		return $arr['id'];
	}
}
?>