<?php
header("Content-type: text/xml");

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());


$accid = $_GET["accid"];
$startdate = $_GET["startdate"];
$enddate = $_GET["enddate"];
$room = $_GET["room"];

if(($accid != '') && ($startdate != '') && ($enddate != '') && ($room != ''))
{
	$result = mysql_query("SELECT * FROM accommodation WHERE id='$accid'") or die(mysql_error());
	
	$count = mysql_num_rows($result);
	if($count == 0)
	{
		echo '<?xml version="1.0" encoding="UTF-8" ?>';
		echo "<accommodation>";
		echo "<error code='101'>Accommodation does not exist in the database.</error>";
		echo "</accommodation>";
	}
	else
	{	
		mysql_query("INSERT INTO bookings (accid, startdate, enddate, room) 
						VALUES ('$accid','$startdate', '$enddate', '$room')");
		echo '<?xml version="1.0" encoding="UTF-8" ?>';
		echo "<accommodation>";
		echo "<success code='200'>Operation successful.</success>";
		echo "</accommodation>";
	}
}
else
{
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo "<accommodation>";
	echo "<error code='100'>Missing fields.</error>";
	echo "</accommodation>";
}

mysql_close($con);

?>