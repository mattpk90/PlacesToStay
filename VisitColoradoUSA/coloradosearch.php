<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="../main.css" />
	<?php
		$location = $_POST["location"];
		$type = $_POST["type"];

		$connection = curl_init();
		curl_setopt($connection, CURLOPT_URL, "http://localhost/assignment/searchscript.php?location=$location&type=$type");
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
				$data = array();
				$currentTag = null;

				$parser=xml_parser_create();
				xml_set_element_handler($parser, "foundAnOpeningTag","foundAClosingTag");
				xml_set_character_data_handler($parser, "foundSomeText");
				xml_parse($parser,$response);
				xml_parser_free($parser);
				//echo $response;
				echo "<table>";
				echo "<tr><td>ID</td><td>Name</td><td>Type</td><td>Location</td><td>Latitude</td><td>Longitude</td><td>Availability</td></tr>";

				for($count=0; $count < count($data["name"]); $count++)
				{
				    echo "<tr>".
				    "<td>".$data["id"][$count]."</td>".
				    "<td>".$data["name"][$count]."</td>".
				    "<td>".$data["type"][$count]."</td>".
				    "<td>".$data["location"][$count]."</td>".
				    "<td>".$data["latitude"][$count]."</td>".
				    "<td>".$data["longitude"][$count]."</td>".
				    "<td>".$data["availability"][$count]."</td>".
				    "</tr>";
				}
				echo "</table>";
				
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
				}
			?>
		</div>
	</div>
</body>
</html>