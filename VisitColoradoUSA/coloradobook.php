<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Booking</title>
	<link rel="stylesheet" type="text/css" href="../main.css" />
	<?php
		$accid = $_POST["accidbook"];
		$start = $_POST["startdate"];
		$end = $_POST["enddate"];
		$room = $_POST["room"];

		$connection = curl_init();
		curl_setopt($connection, CURLOPT_URL, "http://localhost/assignment/bookroom.php?accid=$accid&startdate=$start&enddate=$end&room=$room");
		curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($connection,CURLOPT_HEADER, 0);
		$response = curl_exec($connection);
	?>
</head>

<body>
	<div id="container">
		<div id="logo"><img src="images/logo.png" alt="logo"/></div>

		<div id="navigation">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="ajaxfront.php">Accommodation</a></li>
				<li><a href="../index.php">PlacesToStay</a></li>
			</ul>
		</div>

		<div id="stage">
			<?php
				/*$data = array();
				$currentTag = null;

				$xml ="<students>".
				"<student><name>Rob Stevenson</name>" .
				     "<course>Computer Network Management</course></student>".
				          "<student><name>Jamie Bailey</name>".
				    "<course>Computer Studies</course></student>".
				    "</students>";

				$parser=xml_parser_create();
				xml_set_element_handler($parser, "foundAnOpeningTag","foundAClosingTag");
				xml_set_character_data_handler($parser, "foundSomeText");
				xml_parse($parser,$xml);
				xml_parser_free($parser);

				for($count=0; $count < count($data["name"]); $count++)
				{
				    echo "Name ". $data["name"][$count]. " Course ". $data["course"][$count]. "<br/>";
				}

				// Function to handle opening tags.
				function foundAnOpeningTag($parser,$tag,$attributes)
				{
				    global $currentTag;
				    $currentTag = strtolower($tag);
				}

				// Function to handle closing tags.
				function foundAClosingTag($parser,$tag)
				{
				    global $currentTag;
				    $currentTag = null;
				}

				// Function to handle characters within tags.
				function foundSomeText($parser,$characters)
				{
				    global $data, $currentTag;
				    $data[$currentTag][] = $characters;
				}*/


				echo $response;
			?>
		</div>
	</div>
</body>
</html>