<?php include('call_web_service.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Book Room</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>

	<div id="container">
		<div id="logo"><img src="images/logo.png" alt="logo"/></div>

		<div id="navigation">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="ajaxfront.php">Accommodation</a></li>
				<li><a href="VisitColoradoUSA/index.php">VisitColoradoUSA</a></li>
				<li><a href="wurfl.php">WURFL</a></li>
				<li><a href="map.html">Map</a></li>
			</ul>
		</div>

		<div id="stage">
			<?php
				$id = $_POST["accidbook"];
				$startdate = $_POST["startdate"];
				$enddate = $_POST["enddate"];
				$room = $_POST["room"];

				$bookResult = call_web_service("http://localhost/assignment/bookroom.php?accid=$id&startdate=$startdate&enddate=$enddate&room=$room", "PUT");
				//$reviewResult = call_web_service("http://edward.solent.ac.uk/students/mkennedy/assignment/bookroom.php?accid=$id&startdate=$startsate&enddate=$enddate&room=$room", "PUT"); 
				
				if($bookResult["code"] == 200){
					echo "Booking Confirmed. <br />";
					echo "ID: $id <br />
					Start Date: $startdate  <br />
					End Date: $enddate <br />
					Room: $room";
				}
				else if($bookResult["code"] == 404){
					echo "No accommodation found with that ID.";
				}
				else if($bookResult["code"] == 400){
					echo "ID Missing.";
				}
				else if($bookResult["code"] == 401){
					echo "You don't have permission to use the web service in this way";
				}

			?>
		</div>
	</div>
</body>
</html>