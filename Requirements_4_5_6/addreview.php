<?php
parse_str(file_get_contents('php://input'),$put_vars);
$accid = $put_vars['accid'];
$review = $put_vars['review'];

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());

$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());

if($accid == "" || $review == "")
{
    //Invalid, need both fields.
	header("HTTP/1.1 400 Missing Fields");
	echo "400";
    exit;
}

//Check accommodation exists.
$result=mysql_query("SELECT * FROM accommodation WHERE id='$accid'") or die(mysql_error());
if(mysql_num_rows($result)==0)
{
	header("HTTP/1.1 404 No Accommodation Found");
	echo "404";
    exit;
}

if ($_SERVER["REQUEST_METHOD"]=="GET")
{
	header("HTTP/1.1 401 Unauthorized Access");
	echo "401";
}
elseif ($_SERVER["REQUEST_METHOD"]=="DELETE")
{
	header("HTTP/1.1 401 Unauthorized Access");
	echo "401";
}
elseif ($_SERVER["REQUEST_METHOD"]=="PUT")
{
	header("HTTP/1.1 200 OK");
	mysql_query("INSERT INTO acc_reviews (accid, review) VALUES ('$accid','$review')");
	echo "200";
}

mysql_close($con);
?>