<?php
include('call_web_service.php');

$location = $_POST["location"];
$type = $_POST["type"];

/*$reviewID = $_POST["accidreview"];
$review = $_POST["review"];

$id = $_POST["id"];
$startdate = $_POST["startdate"];
$enddate = $_POST["enddate"];
$room = $_POST["room"];*/

if($location != ""){
	$searchResult = call_web_service("http://localhost/assignment/searchscript.php?location=$location&type=$type", "GET");
	//$searchResult = call_web_service("http://edward.solent.ac.uk/students/mkennedy/assignment/searchscript.php?location=$location&type=$type", "GET"); 
}

$xmlresponse = htmlentities($searchResult["content"]);
//$xml = simplexml_load_string($xmlresponse);

if($response["code"]==401){
	echo "ERROR: You don't have permission to use the web service in this way";
}

echo $xmlresponse;
?>