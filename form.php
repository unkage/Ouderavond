<script type="">
function isValidEmail(str) {
   return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
}

</script>
<?php
if (isset($_REQUEST["wachtwoord"])){
$wachtwoord = $_REQUEST["wachtwoord"];
}else{
	$wachtwoord = $_REQUEST["md5_wachtwoord"];
	}
$naam = $_REQUEST["naam"];
include("inc/select.php");
include("inc/login.php");
if ($id = login($naam,$wachtwoord)){
	include("inc/get_vars.php");
?>       	
<h2>Selecteer de leraren</h2>
<p>
U bent ingelogd als <?php echo htmlentities($inf_array["vnaam"],ENT_COMPAT,"UTF-8")?> <?php echo htmlentities($inf_array["tussenv"],ENT_COMPAT,"UTF-8")?> <?php echo htmlentities($inf_array["anaam"],ENT_COMPAT,"UTF-8")?>. Vink hieronder de docenten aan die u wenst te spreken. Per kind mag u
drie docenten aanvinken. 
Wilt u de tijdwensen met enige terughoudendheid gebruiken? Want hoe meer vrijheden we hebben
bij het roosteren, des te gunstiger dit uitpakt. De specifieke tijdwens is alleen bedoeld voor degenen
die weinig andere opties hebben. We proberen er rekening mee te houden, maar kunnen niets
toezeggen.
</p>
<form action="aangemeld.php" method="post">
<?php
draw_list($id,$old_post);
?>
<table>
<tr class="table_bl">
<td>Dagwens:</td>
<td>
<input class="radio" type="radio" name="day" value="1" <?php echo is_selected("day","1",$old_post,"checked");?> id="d_0" /><label for="d_0">dinsdag 26 maart</label><br />
<input class="radio" type="radio" name="day" value="2" <?php echo is_selected("day","2",$old_post,"checked"); ?> id="d_1" /><label for="d_1">donderdag 28 maart</label><br />
<input class="radio" type="radio" name="day" value="0" <?php echo is_selected("day","0",$old_post,"checked"); ?> id="d_null" /><label for="d_null">geen voorkeur<label><br />
</td>
<td>
<input class="radio" type="hidden" name="day_pref" value="A" id="a" />
</td>
</tr>
<tr>
<td>Tijdwens:</td>
<td>
<input class="radio" type="radio" name="time" value="V" id="v" <?php echo is_selected("time","V",$old_post,"checked"); ?>/><label for="v">vroeg</label><br />
<input class="radio" type="radio" name="time" value="L" id="l" <?php echo is_selected("time","L",$old_post,"checked"); ?>/><label for="l">laat</label><br />
<input class="radio" type="radio" name="time" value="G" id="time_null"<?php echo is_selected("time","G",$old_post,"checked"); ?>/><label for="time_null">geen voorkeur</label><br />
</td>
</tr>
<tr class="table_bl">
<td>Specifieke tijdwens:</td>
<td>
<input type="text" name="time_spec" value="<?php echo $old_post["time_spec"] ?>" />
</td>
<td>
</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>
<tr>
<td>Opmerkingen:</td>
<td><textarea name="opmerkingen" ><?php echo $old_post["opmerkingen"]; ?></textarea></td>
</tr>
</table>
<input type="hidden" name="md5_wachtwoord" value="<?php echo $wachtwoord ?>" />
<input type="hidden" name="naam" value="<?php echo $naam ?>" />
<input type="hidden" name="id" value="<?php echo $id ?>" />
<input type="hidden" name="vnaam" value="<?php echo $inf_array["vnaam"]?>" />
<input type="hidden" name="anaam" value="<?php echo $inf_array["anaam"]?>" />
<input type="hidden" name="tussenv" value="<?php echo $inf_array["tussenv"]?>" />
<input type="hidden" name="oud_email" value="<?php echo $inf_array["email"]?>" />
<input type="submit" value="Aanmelden" />

</form>
<?php
}else{
?>
<h2>Aanmelden</h2>
<p>Op deze pagina kunt u handmatig aanmelden voor de ouderavonden. <i>Het opgegeven e-mail adres komt niet voor in de database.</i></p>
<p>

<form action="selecteren.php" method="get">
<table>
<tr>
    <td>Email adres</td><td><input type="text" name="naam" /></td><td>&nbsp;</td>
</tr>
<tr>
  <td></td><td><input type="submit" value="Aanmelden" /></td>
</tr>
</table>
</form>
<?php
}
?>