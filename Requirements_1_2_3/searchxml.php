<?php
$location = $_GET["location"];
$type = $_GET["type"];

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());

$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());

if($location == "")
{
    //Invalid search, need a location.
    header("Content-type: text/html");
	header("HTTP/1.1 400 Location Missing");
	echo "HTTP/1.1 400 Location Missing";
    exit;
}

//Check location exists.
if($type != ""){
	$result=mysql_query("SELECT * FROM accommodation WHERE location='$location' AND type='$type'") or die(mysql_error());
}
else{
	$result=mysql_query("SELECT * FROM accommodation WHERE location='$location'") or die(mysql_error());
}
if(mysql_num_rows($result)==0)
{
	header("Content-type: text/html");
	header("HTTP/1.1 404 No Accommodation Found");
	echo "HTTP/1.1 404 No Accommodation Found";
    exit;
}

if ($_SERVER["REQUEST_METHOD"]=="GET")
{
	header("Content-type: text/xml");
	header("HTTP/1.1 200 OK");
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo "<accommodation>";

	while($row = mysql_fetch_array($result))
	{
		echo "<place>			
		<id>$row[ID]</id>
		<name>$row[name]</name>
		<type>$row[type]</type>
		<location>$row[location]</location>
		<latitude>$row[latitude]</latitude>
		<longitude>$row[longitude]</longitude>
		<availability>$row[availability]</availability>
		</place>";
	}
	echo "</accommodation>";
}
elseif ($_SERVER["REQUEST_METHOD"]=="DELETE")
{
	header("Content-type: text/html");
	header("HTTP/1.1 401 Unauthorized DELETE Access");
	echo "HTTP/1.1 401 Unauthorized DELETE Access";
}
elseif ($_SERVER["REQUEST_METHOD"]=="PUT")
{
	header("Content-type: text/html");
	header("HTTP/1.1 401 Unauthorized PUT Access");
	echo "HTTP/1.1 401 Unauthorized PUT Access";
}

mysql_close($con);
?>