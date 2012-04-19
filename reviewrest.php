<?php include('call_web_service.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Add Review</title>
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
				$reviewID = $_GET["accidreview"];
				$review = $_GET["review"];

				//fix for only first word of review being added to db
				//replaces spaces with _, changed back to spaces in addreview.php
				$review = str_replace(" ", "_", $review);

				$reviewResult = call_web_service("http://localhost/assignment/addreview.php?accid=$reviewID&review=$review", "PUT");
				//$reviewResult = call_web_service("http://edward.solent.ac.uk/students/mkennedy/assignment/addreview.php?accid=$reviewID&review=$review", "PUT");

				if($reviewResult["code"] == 200){
					$review = str_replace("_", " ", $review);
					echo "Review Added. <br />";
					echo "ID: $reviewID <br />
					Review: $review";
				}
				else if($reviewResult["code"] == 400){
					echo "ID missing.";
				}
				else if($reviewResult["code"] == 404){
					echo "No accommodation found with that ID.";
				}
				else if($reviewResult["code"] == 401){
					echo "You don't have permission to use the web service in this way";
				}
			?>
		</div>
	</div>
</body>
</html>