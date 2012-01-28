<?php


//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());


if((!isset($_POST['type'])) && isset($_POST['location']))
{
	echo "Searching by location: <br /><br />";
	$location = $_POST['location'];
	$result = mysql_query("SELECT * FROM accommodation WHERE location='$location'") or die(mysql_error());
	while($row = mysql_fetch_array($result))
	{
		echo "Name: ".$row['name']."<br />";
	}
}
else if((isset($_POST['type'])) && !isset($_POST['location']))
{
	echo "Searching by type: <br /><br />";
	$type = $_POST['type'];
	$result = mysql_query("SELECT * FROM accommodation WHERE type='$type'") or die(mysql_error());
	while($row = mysql_fetch_array($result))
	{
		echo "Name: ".$row['name']."<br />";
	}
}

mysql_close($con);

?>