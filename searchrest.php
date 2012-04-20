<?php
	/*$location = $_GET["location"];
	$type = $_GET["type"];

	$connection = curl_init();
	curl_setopt($connection, CURLOPT_URL, "../searchscript.php?location=$location&type=$type");
	curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($connection,CURLOPT_HEADER, 0);
	$response = curl_exec($connection);

	if($response['http_code'] == 200){
		header("HTTP/1.1 200 OK");
		echo "200 ok";
	}
	else if($response['http_code'] == 400){
		header("HTTP/1.1 400 Missing Fields");
		echo "400 Missing fields";
	}
	else if($response['http_code'] == 404){
		header("HTTP/1.1 404 No Accommodation Found");
		echo "404 no accom found";
	}
	else if($response['http_code'] == 401){
		header("HTTP/1.1 401 Unauthorized Access");
		echo "401 Unauthorized access";
	}*/
	echo "hi";
?>