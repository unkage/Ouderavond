<h2>
	Een informatie bestand uploaden (csv) (De lijst van de verzorger(s) en de leerlingen).
</h2>
<p>Het bestand moet aan de volgende voorwaarden voldoen:</p>
<ul>
	<li>Dit is de volgorde van de elementen: 
	Leerlingnummer(Query 2 met SOM);Volledige Naam;Docent;Afk;Lesgroep;Vak;ID-ouders;Email_ouders;Naam_ouders;Leerlingnummer(Query 1 met SOM);adres;pcode;plnaam</li>
	<li>Het bestand moet gescheiden zijn door een tab (\t)</li>
	<li>Er moet een headerbalk (Balk met informatie) zijn.</li>
	<li>Voor strings zijn geen accolades ("") nodig.</li>
	<li>Wanneer het bestand UTF-8 gecodeerd is werkt het het beste; dit is de directe export vanuit de WIS omgeving.</li>
</ul>
<p>
	
</p>
<form enctype="multipart/form-data" action="import_csv.php" method="POST">
<table>
	<tr>
	<td>Export vanuit SOM</td><td><input name="ouders" type="file" /></td>
	</tr>
	<tr>
	<td>Verzenden</td><td><input type="submit" value="Upload File" /></td>
	</tr>
</table>
</form>
