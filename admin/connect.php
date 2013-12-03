<?php	
//connect script  ::
$db = mysql_connect("localhost","root","");
mysql_select_db("ouderavond_db",$db)
or die ("fout bij openen datebase<br>" . mysql_error() . mysql_errno());
?>