<?php
//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());

$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());

$result=mysql_query("SELECT * FROM bookings") or die(mysql_error());
if ($_SERVER["REQUEST_METHOD"]=="GET")
{
		header("Content-type: application/json");
		header("HTTP/1.1 200 OK");
	   
		while($row = mysql_fetch_assoc($result))
		{
				$response[] = $row;
		}
		echo json_encode($response);
	   
}
elseif ($_SERVER["REQUEST_METHOD"]=="DELETE")
{
		header("Content-type: application/json");
		header("HTTP/1.1 401 Unauthorized Access");
}
elseif ($_SERVER["REQUEST_METHOD"]=="PUT")
{
		header("Content-type: application/json");
		header("HTTP/1.1 401 Unauthorized Access");
}
?>