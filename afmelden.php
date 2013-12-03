<?php
$page ="sportklas";
include("../page/head.php");
$md5_code = md5($_GET["code"]);
$email = $_GET["email"];
if (isset($_GET["conf"])){
if (mysql_query("DELETE FROM `sportklas` WHERE `code` = '$md5_code' AND `email` = '$email' LIMIT 1")){
		echo "Succesvol verwijderd";
	}
}else{
?>
<h2>Afmelden</h2>
<form action="afmelden.php" method="get">
	<input type="hidden" value="<? echo $_GET["code"] ?>" name="code" />
    <input type="hidden" value="<? echo $_GET["email"] ?>" name="email" />
    <input type="hidden" name="conf" value="ja" />
    <input type="submit" value="Afmelden" />
</form>

<?php
}
include("../page/foot.php");
?>