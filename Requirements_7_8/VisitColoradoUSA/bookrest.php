<?php 
	include('call_web_service.php');

	$id = $_GET["accidbook"];
	$startdate = $_GET["startdate"];
	$enddate = $_GET["enddate"];
	$room = $_GET["room"];

	$vars = "accidbook=".$id."&startdate=".$startdate."&enddate=".$enddate."&room=".$room;

	$bookResult = call_web_service("http://edward/students/mkennedy/assignment/Requirements_4_5_6/bookroom.php", "PUT", $vars); 

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