<?php
$accid = $_GET["accid"];
$review = $_GET["review"];

$review = str_replace("_", " ", $review);

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());

if($accid == "")
{
    //Invalid search, need an ID.
    header("Content-type: text/xml");
	header("HTTP/1.1 400 Accommodation ID Missing");
    exit;
}

//Check accommodation exists.
$result=mysql_query("SELECT * FROM accommodation WHERE id='$accid'") or die(mysql_error());
if(mysql_num_rows($result)==0)
{
	header("Content-type: text/xml");
	header("HTTP/1.1 404 No Accommodation Found");
    exit;
}

if ($_SERVER["REQUEST_METHOD"]=="GET")
{
	header("Content-type: text/xml");
	header("HTTP/1.1 401 Unauthorized GET Access");
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
	mysql_query("INSERT INTO acc_reviews (accid, review) VALUES ('$accid','$review')");
}

mysql_close($con);
?>