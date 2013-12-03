<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>

<body>
<script>
  $(function() {
    $( "#slider" ).slider({
      orientation: "horizontal",
	  min: 1,
      max: 10,
      value: 0,
      slide: refreshSwatch,
      change: refreshSwatch
    });
  });
  function refreshSwatch() {
	$( ".block").css( "background-color", "#666666");
	$( ".tijden").css( "background-color", "#666666");
    $( ".t" + $( "#slider" ).slider( "value" )).css( "background-color", "#FF0000");
	$( ".t" + ($( "#slider" ).slider( "value" )+1)).css( "background-color", "#FF6666");
	
	//$( "#tijd" + $( "#slider" ).slider( "value" )).css( "background-color", "#FF0000");
  }
  function allowDrop(ev)
{
ev.preventDefault();
}

function drag(ev)
{
ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev)
{
	
ev.preventDefault();
var data=ev.dataTransfer.getData("Text");
//if (ev.target.id==-1){
	alert("Weet je zeker dat je deze aanpassing wilt doorvoeren?" + data + " naar "+ ev.target.id);
	$("#"+data).
	$( "#"+ ev.target.id ).addClass
	//}else{
	alert("Dit is niet mogelijk in dit rooster.");
	//}
}
  </script>
<style>
.docent{
	width: 50px;
	}
.block{
	background-color:#666666;
	width: 50px;
	}
	.tijden{
	width: 50px;
	display:inline-block;
	background-color:#666666;
}
.t1{
	background-color:#FF0000;
	}
.t2{
	background-color:#FF6666;
	}
.names{
	
	width: 50px;
	/*-webkit-transform: rotate(-90deg); 
	-moz-transform: rotate(-90deg);	*/

	}

#slider{
	width: 500px;
}
</style>
<h1>Ouderavond rooster</h1>
<i>Tijd:</i>
<?
mysql_connect("localhost","root","");
	mysql_select_db("ouderavond_db");
$res_tijden = mysql_query("SELECT * FROM tijden");
	while($arr_tijden = mysql_fetch_array($res_tijden)){
		echo "<div class=\"tijden t".$arr_tijden["id"]."\">".$arr_tijden["val"]."</div>";
	}
?>
<div id="slider"></div>
<?php
$color[0] = "white";
$color[1] = "black";
/*
$res = mysql_query("SELECT * FROM aanmeldingen ORDER BY leraar_afkorting");
while($arr = mysql_fetch_array($res)){
		$big_arr[$arr["leraar_afkorting"]][$arr["ouder_id"]] == 1;
	}

for($i=0;isset($big_arr[$i]);$i++){
	echo "<tr><td></td>";
	for($i=0;isset($big_arr[$i]);$i++){
	}
echo "<tr />";
	*/
	
	
	$res_leraar = mysql_query("SELECT * FROM aanmeldingen GROUP BY leraar_afkorting");
	while($arr_leraar = mysql_fetch_array($res_leraar)){
		$res_ouders = mysql_query("SELECT * FROM aanmeldingen GROUP BY ouder_id");
		while($arr_ouders = mysql_fetch_array($res_ouders)){
			$table[$arr_leraar["leraar_afkorting"]][$arr_ouders["ouder_id"]]["tijd"] = -1;
			$table[$arr_leraar["leraar_afkorting"]][$arr_ouders["ouder_id"]]["id"] = -1;
		}
	}
	$res_aanmeld = mysql_query("SELECT * FROM aanmeldingen");
	while($arr_aanmeld = mysql_fetch_array($res_aanmeld)){
			$table[$arr_aanmeld["leraar_afkorting"]][$arr_aanmeld["ouder_id"]]["tijd"] = $arr_aanmeld["tijd"];
			$table[$arr_aanmeld["leraar_afkorting"]][$arr_aanmeld["ouder_id"]]["id"] = $arr_aanmeld["id"];
	}
  	echo "<table>";
	$res_ouders = mysql_query("SELECT verzorgers.vnaam
FROM aanmeldingen, verzorgers
WHERE aanmeldingen.ouder_id = verzorgers.id
GROUP BY ouder_id");

	echo "<tr>";
	echo "<td></td>";
		while($arr_ouders = mysql_fetch_array($res_ouders)){
			
			echo "<td class=\"names\">".$arr_ouders["vnaam"]."</td>";
		}
	echo "</tr>";
	foreach ($table as $rows => $row)
{
	echo "<tr><td class=\"docent\">$rows</td>";
	foreach ($row as $col => $cell)
	{
	echo "<td draggable=\"true\" ondragstart=\"drag(event)\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" id=\"data_".$cell["tijd"]."_" .$rows."_".$col. "_". $cell["id"]."\" class=\"block t".$cell["tijd"]."\" >&nbsp;".$cell["tijd"]."</td>";
	}	
  echo "</tr>";
}	
echo "</table>";
 ?>
 </table>
</body>
</html>
