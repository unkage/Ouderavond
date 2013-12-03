<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administratie panel</title>
</head>
<body>
<style>
body{
	font-family: sans-serif;
}
#page{
margin-left: auto;
margin-right: auto;
width: 970px;
border: 1px solid black;
padding: 20px;
}
</style>
<div id="page"> 
<h1>Tijdlijn</h1>
<img src="diagram.png" />
<p>
<ol>
	<li>Ouders worden gemaild (deze mail moet aanpasbaar zijn voor de systeembeheerder) met een uniek ID waarmee ze afspraken kunnen maken. Het aanmeldformulier gaat open.</li>
	<li>Aanmeldformulier wordt gesloten er wordt (automatisch) geroosterd; aangeraden wordt om dit 's nachts te doen. Na het roosteren kan er tot 3 nog handmatig via PHPmyAdmin aanpassingen gedaan worden.</li>
	<li>Ouders worden gemaild (deze mail moet aanpasbaar zijn voor de systeembeheerder) met de datum en tijd van hun afspraken.</li>
	<li>Datum 1 van de ouderavond</li>
	<li>Datum 2 van de ouderavond</li>
</ol>
</p>
<h1>Stap 1 (importeren van gegevens)</h1>
<?php
include("form.php");
?>
<p>
<a href="empty.php">Leeg alle ingevulde formulieren, dus niet alle leraren leerlingen en de connecties daar tussen.</a>
</p>

<p>
<a href="empty_all.php">Leeg alle data.</a>
</p>

<h1>Stap 2 (exporteren naar OuderavondExpert)</h1>
<p>
<a href="export_autohotkey.php">Download</a> het autohotkey bestand voor OuderavondExpert. (De computer moet dus Autohotkey voor Windows bevatten <a href="http://www.autohotkey.com/">http://www.autohotkey.com/</a>) Dit zorgt er automatisch voor dat  wanneer je ouderavond expert open hebt staan (ook inactief) deze automatisch wordt ingevuld, dit kan enkele minuten in beslag nemen, (seconde per leerling). (Let op dat alle leerlingen vooraf verwijderd zijn anders ontstaan er problemen.)
</p>
<p>
<a href="export_docenten.php.php">Download de docententabel.</a>
</p>

<h1>Stap 3 (importeren van brieven)</h1>
<h2>
	Een informatie bestand uploaden (tekst) (De export van OuderavondExpert).
</h2>
<p>Het bestand moet aan de volgende voorwaarden voldoen:</p>
<pre>
Ostrea Lyceum vest. Oost
Bergweg 4
Goes
[vnaam] [anaam]
[klas]
[datum]
de heer/mevrouw [naam] om [tijd] in de [locatie].
(De volgende docenten zijn afwezig. Ze zullen contact met u opnemen.
mevrouw/de heer [naam])
</pre>
<p>
	Dit kan door het eerst te exporteren als PDF formaat, 
	daarna alles te selecteren in Adobe Acrobat (pro) en dat dan plakken in een tekst bestand.
</p>
<form enctype="multipart/form-data" action="import_afspraken_verzorgers.php" method="POST">
<table>
    <tr>
	<td>Tekst</td><td><textarea name="text" col="100"></textarea> </td>
	</tr>
	<tr>
	<td>Verzenden</td><td><input type="submit" value="Upload File" /></td>
	</tr>
</table>
</form>
<p>Afspraken docenten:</p>
<form enctype="multipart/form-data" action="import_afspraken_docenten.php" method="POST">
<table>
    <tr>
	<td>Dagdeel 1</td><td><textarea name="dagdeel1" cols="100"></textarea> </td>
	</tr>
        <tr>
	<td>Dagdeel 2</td><td><textarea name="dagdeel2" cols="100"></textarea> </td>
	</tr>
	<tr>
	<td>Verzenden</td><td><input type="submit" value="Upload File" /></td>
	</tr>
</table>
</form>
</div>
</body>
</html>