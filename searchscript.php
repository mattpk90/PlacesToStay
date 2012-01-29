<?php
header("Content-type: text/xml");

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());


$location = $_GET["location"];
$type = $_GET["type"];

if(($location != '') && ($type != ''))
{
	$result = mysql_query("SELECT * FROM accommodation WHERE type='$type' AND location='$location'") or die(mysql_error());
	
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo "<accommodation>";

	while($row = mysql_fetch_array($result))
	{
		echo "<place>";			
		echo "<id>$row[ID]</id>";
		echo "<name>$row[name]</name>";
		echo "<type>$row[type]</type>";
		echo "<location>$row[location]</location>";
		echo "<latitude>$row[latitude]</latitude>";
		echo "<longitude>$row[longitude]</longitude>";
		echo "<availability>$row[availability]</availability>";
		echo "</place>";
	}
	echo "</accommodation>";
}
else if(($type == '') && ($location != ''))
{
	$location = $_GET['location'];
	$result = mysql_query("SELECT * FROM accommodation WHERE location='$location'") or die(mysql_error());

	echo '<?xml version="1.0" encoding="UTF-8" ?>';	
	echo "<accommodation>";

	while($row = mysql_fetch_array($result))
	{	
		echo "<place>";	
		echo "<id>$row[ID]</id>";
		echo "<name>$row[name]</name>";
		echo "<type>$row[type]</type>";
		echo "<location>$row[location]</location>";
		echo "<latitude>$row[latitude]</latitude>";
		echo "<longitude>$row[longitude]</longitude>";
		echo "<availability>$row[availability]</availability>";
		echo "</place>";
	}
	echo "</accommodation>";
}
else
{
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo "<accommodation>";
	echo "<place>";
	echo "<error>100</error>";
	echo "</place>";
	echo "</accommodation>";
}

mysql_close($con);

?>