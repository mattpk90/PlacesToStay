<?php
$id = $_GET["id"];
//$con = mysql_connect('localhost', 'mkennedy', 'tRuBU3re') or die(mysql_error());
//mysql_select_db('mkennedy') or die(mysql_error());
	
$con = mysql_connect('localhost', 'root') or die(mysql_error());
mysql_select_db('placestostay') or die(mysql_error());

if($id != ""){
	$result=mysql_query("SELECT latitude, longitude FROM accommodation WHERE ID='$id'") or die(mysql_error());

	if(mysql_num_rows($result)==0)
	{
	    header("Content-type: application/json");
	    header("HTTP/1.1 404 No Places");
	    exit;
	}
	else{
		header("Content-type: application/json");
	    header("HTTP/1.1 200 OK");
	       
	    while($row = mysql_fetch_assoc($result))
	    {
	        $response[] = $row;
	    }
	    echo json_encode($response);
	}
}else
{
	$result=mysql_query("SELECT * FROM accommodation") or die(mysql_error());
	 
	if(mysql_num_rows($result)==0)
	{
	    header("Content-type: application/json");
	    header("HTTP/1.1 404 No Places");
	    exit;
	}
	else{
		header("Content-type: application/json");
	    header("HTTP/1.1 200 OK");
	       
	    while($row = mysql_fetch_assoc($result))
	    {
	        $response[] = $row;
	    }
	    echo json_encode($response);
	}
}

mysql_close($con);
?>