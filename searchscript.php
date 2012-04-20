<?php
$location = $_GET["location"];
$type = $_GET["type"];

//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());

mysql_query("INSERT INTO acc_reviews (accid, review) VALUES ('1','hghjjh')");
if($location == "")
{
    //Invalid search, need a location.
    header("Content-type: application/json");
	header("HTTP/1.1 400 Location_Missing");
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
	header("Content-type: application/json");
	header("HTTP/1.1 404 No Accommodation Found");
    exit;
}

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

mysql_close($con);
?>