<?php
$page ="sportklas";
include("../page/head.php");
$query = "SELECT COUNT(id) FROM sportklas"; 
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result)
$aantal = $row['COUNT(id)'];

while($row = mysql_fetch_array($result)){
	echo "Totaal " . $row['COUNT(id)'];
}
include("../page/foot.php");
?>