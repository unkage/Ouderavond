<?php
include("connect.php");
if(isset($_GET["s"])){
	if ( 
		mysql_query("TRUNCATE TABLE `aanmelding_ouders`")
	&&
		mysql_query("TRUNCATE TABLE `aanmeldingen`")
	&&
		mysql_query("TRUNCATE TABLE `email_verandering`")
	&&
		mysql_query("TRUNCATE TABLE `stamgroep_leraar`")
	&&
		mysql_query("TRUNCATE TABLE `leerlingen`")
	&&
		mysql_query("TRUNCATE TABLE `leerling_leraar`")
	&&
		mysql_query("TRUNCATE TABLE `verzorgers`")
	&&
		mysql_query("TRUNCATE TABLE `leraren`")
	&&
		mysql_query("TRUNCATE TABLE `aanmelding_leerlingen`")
	&&
		mysql_query("TRUNCATE TABLE `verzorger_leerling`")
	&&
		mysql_query("UPDATE  `leraren` SET  `afspraken` =  ''")
	){
		echo "Succesvol verwijderd";
	}else{
		echo "Er is een MYSQL error, neem contact op met de beheerder. " . mysql_error();
	}
}else{
	echo "<p>Weet u zeker dat u alle data wilt verwijderden, dit kan niet meer ongedaan worden gemaakt.</p>";
	echo "<p><a href=\"empty.php?s=sure\">Ja</a> <a href=\"./\">Ga terug</a></p>";
}
?>