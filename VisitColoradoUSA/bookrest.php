<?php 
	include('call_web_service.php');

	$id = $_GET["accidbook"];
	$startdate = $_GET["startdate"];
	$enddate = $_GET["enddate"];
	$room = $_GET["room"];

	$bookResult = call_web_service("http://localhost/assignment/bookroom.php?accid=$id&startdate=$startdate&enddate=$enddate&room=$room", "PUT");
	//$reviewResult = call_web_service("http://edward.solent.ac.uk/students/mkennedy/assignment/bookroom.php?accid=$id&startdate=$startsate&enddate=$enddate&room=$room", "PUT"); 

	if($bookResult["code"] == 200){
		header("HTTP/1.1 200 OK");
		echo "200 ok";
	}
	else if($bookResult["code"] == 404){
		header("HTTP/1.1 404 No Accommodation Found");
		echo "404 no accom found";
	}
	else if($bookResult["code"] == 400){
		header("HTTP/1.1 400 Missing Fields");
		echo "400 missing fields";
	}
	else if($bookResult["code"] == 401){
		header("HTTP/1.1 401 Unauthorized Access");
		echo "401 Unauthorized access";
	}
?>