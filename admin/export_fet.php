<?php
if ($_GET["d"]!=5){
//Debug mode
header("Content-type: application/download\n");
header("Content-disposition: attachment; filename=export_leerlingen.fet\n\n");
}else{
	header("Content-type: text/plain\n");
	}
error_reporting(E_ALL);
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; 
mysql_connect("localhost","root","");
mysql_select_db("ouderavond_db");
?>


<fet version="5.20.1">

<Institution_Name>Default institution</Institution_Name>

<Comments>Default comments</Comments>

<Hours_List>
<?php
	//Selecteer alle tijden
	$res = mysql_query("SELECT * FROM tijden");
	$rows = mysql_num_rows($res);
	echo "\t<Number>$rows</Number>";
	for ($i=1;$i<=$rows;$i++){
		echo "\t<Name>$i</Name>";
	}
?>
</Hours_List>
<Days_List>
<?php
	//Selecteer alle dagen
	$res = mysql_query("SELECT * FROM dagen");
	$rows = mysql_num_rows($res);
	echo "\t<Number>$rows</Number>";
	for ($i=1;$i<=$rows;$i++){
		echo "\t<Name>$i</Name>";
	}
?>
</Days_List>
<Students_List>
<?php
	//Selecteer alle aangemelde ouders
	$res = mysql_query("SELECT ouder_id FROM aanmeldingen GROUP BY ouder_id");
	while ($row = mysql_fetch_array($res)){
		echo "	<Year>
		<Name>".$row["ouder_id"]."</Name>
		<Number_of_Students>0</Number_of_Students>
	</Year>
";
	}
?>
</Students_List>
<Teachers_List>
<?php
	//Selecteer alle aangemelde ouders
	$res = mysql_query("SELECT leraar_afkorting FROM aanmeldingen GROUP BY leraar_afkorting");
	while ($row = mysql_fetch_array($res)){
		echo "	<Teacher>
		<Name>".$row["leraar_afkorting"]."</Name>
	</Teacher>
";
	}
?>
</Teachers_List>

<Subjects_List>
<?php
$i = 0;
	//Selecteer alle aangemelde afspraken, let op dat dit de laatste afspraken zijn!!! (NU NOG BUG)
	$res = mysql_query("SELECT leraar_afkorting,ouder_id FROM aanmeldingen GROUP BY leraar_afkorting,ouder_id");
	while ($row = mysql_fetch_array($res)){
	$i ++;
		echo "<Subject>
	<Name>".$row["ouder_id"]." ".$row["leraar_afkorting"]."</Name>
</Subject>";


	$activity .= "<Activity>
	<Teacher>".$row["leraar_afkorting"]."</Teacher>
	<Subject>".$row["ouder_id"]." ".$row["leraar_afkorting"]."</Subject>
	<Students>".$row["ouder_id"]."</Students>
	<Duration>1</Duration>
	<Total_Duration>1</Total_Duration>
	<Id>$i</Id>
	<Activity_Group_Id>0</Activity_Group_Id>
	<Active>true</Active>
	<Comments></Comments>
</Activity>
";
$room .= "<Room>
	<Name>".$row["ouder_id"]." ".$row["leraar_afkorting"]."</Name>
	<Building></Building>
	<Capacity>30000</Capacity>
</Room>
";
	$prefered_room .= "<ConstraintSubjectPreferredRoom>
	<Weight_Percentage>100</Weight_Percentage>
	<Subject>".$row["ouder_id"]." ".$row["leraar_afkorting"]."</Subject>
	<Room>".$row["ouder_id"]." ".$row["leraar_afkorting"]."</Room>
	<Active>true</Active>
	<Comments></Comments>
</ConstraintSubjectPreferredRoom>
";

	}
?>
</Subjects_List>

<Activity_Tags_List>
</Activity_Tags_List>

<Activities_List>
<?php echo $activity; ?>
</Activities_List>

<Buildings_List>
</Buildings_List>

<Rooms_List>
<?php echo $room; ?>
</Rooms_List>

<Time_Constraints_List>
<ConstraintBasicCompulsoryTime>
	<Weight_Percentage>100</Weight_Percentage>
	<Active>true</Active>
	<Comments></Comments>
</ConstraintBasicCompulsoryTime>
<ConstraintStudentsMaxDaysPerWeek>
	<Weight_Percentage>100</Weight_Percentage>
	<Max_Days_Per_Week>1</Max_Days_Per_Week>
	<Active>true</Active>
	<Comments></Comments>
</ConstraintStudentsMaxDaysPerWeek>
</Time_Constraints_List>

<Space_Constraints_List>
<ConstraintBasicCompulsorySpace>
	<Weight_Percentage>100</Weight_Percentage>
	<Active>true</Active>
	<Comments></Comments>
</ConstraintBasicCompulsorySpace>
<?php 
echo $prefered_room;
?>
<?php
$room_not_available = "";
echo $room_not_available;
?>
</Space_Constraints_List>

</fet>