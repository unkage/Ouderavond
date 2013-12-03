<?php
$page ="ouderavond";
include("../page/head.php");
?>       	
<h2>Aanmelden</h2>
<p>Op deze pagina kunt u handmatig aanmelden voor de ouderavonden.</p>
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
include("../page/foot.php");
?>