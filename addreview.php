<?php
header("Content-type: text/xml");

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());


$accid = $_GET["accid"];
$review = $_GET["review"];

if(($accid != '') && ($review != ''))
{
	$result = mysql_query("SELECT * FROM accommodation WHERE id='$accid'") or die(mysql_error());
	
	$count = mysql_num_rows($result);
	if($count == 0)
	{
		echo '<?xml version="1.0" encoding="UTF-8" ?>';
		echo "<accommodation>";
		echo "<error>101</error>";
		echo "</accommodation>";
	}
	else
	{	
		mysql_query("INSERT INTO acc_reviews (accid, review) VALUES ('$accid','$review')");
		echo '<?xml version="1.0" encoding="UTF-8" ?>';
		echo "<accommodation>";
		echo "<success>200</success>";
		echo "</accommodation>";
	}
}
else
{
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo "<accommodation>";
	echo "<error>100</error>";
	echo "</accommodation>";
}

mysql_close($con);

?>