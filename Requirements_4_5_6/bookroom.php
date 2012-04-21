<?php
parse_str(file_get_contents('php://input'),$put_vars);
$accid = $put_vars['accidbook'];
$startdate = $put_vars['startdate'];
$enddate = $put_vars['enddate'];
$room = $put_vars['room'];

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());

if($accid == "" || $startdate == "" || $enddate == "" || $room == "")
{
    //Invalid, need all fields.
	header("HTTP/1.1 400 Missing Fields");
    exit;
}

//Check accommodation exists.
$result=mysql_query("SELECT * FROM accommodation WHERE ID='$accid'") or die(mysql_error());
if(mysql_num_rows($result)==0)
{
	header("HTTP/1.1 404 No Accommodation Found");
    exit;
}

if ($_SERVER["REQUEST_METHOD"]=="GET")
{
	header("HTTP/1.1 401 Unauthorized Access");
}
elseif ($_SERVER["REQUEST_METHOD"]=="DELETE")
{
	header("HTTP/1.1 401 Unauthorized Access");
	
}
elseif ($_SERVER["REQUEST_METHOD"]=="PUT")
{
	header("HTTP/1.1 200 OK");
	mysql_query("INSERT INTO bookings (accid, startdate, enddate, room) 
						VALUES ('$accid','$startdate', '$enddate', '$room')");
}

mysql_close($con);
?>