<?php
$lat = $_GET["lat"];
$lng = $_GET["lng"];
$name = $_GET["name"];
$type = $_GET["type"];
$rooms = $_GET["rooms"];

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());

$lat = round($lat, 6);
$lng = round($lng, 6);
mysql_query("INSERT INTO accommodation (name, type, location, latitude, longitude, availability) 
			VALUES ('$name', '$type', 'Southampton', '$lat','$lng', '$rooms')");

mysql_close($con);
?>