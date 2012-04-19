<?php
header("Content-type: text/xml");

$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
mysql_select_db('mkennedy') or die(mysql_error());
	
//$con = mysql_connect('localhost', 'root') or die(mysql_error());
//mysql_select_db('placestostay') or die(mysql_error());


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
		echo "<place>";
		echo "<error code='101'>Accommodation does not exist in the database.</error>";
		echo "</place>";
		echo "</accommodation>";
	}
	else
	{	
		mysql_query("INSERT INTO acc_reviews (accid, review) VALUES ('$accid','$review')");
		echo '<?xml version="1.0" encoding="UTF-8" ?>';
		echo "<accommodation>";
		echo "<place>";
		echo "<success code='200'>Operation successful.</success>";
		echo "</place>";
		echo "</accommodation>";
	}
}
else
{
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo "<accommodation>";
	echo "<place>";
	echo "<error code='100'>Missing fields.</error>";
	echo "</place>";
	echo "</accommodation>";
}

mysql_close($con);

?>



<?php
$accid = $_GET["accid"];
$review = $_GET["review"];

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());


if($accid == "")
{
    //Invalid search, need a location.
    header("Content-type: text/xml");
	header("HTTP/1.1 400 Missing Data");
    exit;
}

//Check location exists.
$result=mysql_query("SELECT * FROM accommodation WHERE accid='$id'") or die(mysql_error());
if(mysql_num_rows($result)==0)
{
	header("Content-type: text/xml");
	header("HTTP/1.1 404 No Accommodation Found");
    exit;
}

if ($_SERVER["REQUEST_METHOD"]=="GET")
{
	header("Content-type: text/xml");
	header("HTTP/1.1 400 Bad Request");
}
elseif ($_SERVER["REQUEST_METHOD"]=="DELETE")
{
	header("Content-type: text/xml");
	header("HTTP/1.1 401 Unauthorized DELETE Access");
	
}
elseif ($_SERVER["REQUEST_METHOD"]=="PUT")
{
	header("Content-type: text/xml");
	header("HTTP/1.1 200 OK");
	$putData= file_get_contents('php://input');
	//parse xml and insert to db with it
}

mysql_close($con);
?>