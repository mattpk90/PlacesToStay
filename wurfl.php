<?php
	define('WURFL_DIR','wurfl-php-1.3.1');
	require_once(WURFL_DIR."/WURFL/Application.php");
	$config=WURFL_DIR."/examples/resources/wurfl-config.xml";

	$factory = new WURFL_WURFLManagerFactory(new WURFL_Configuration_XmlConfig($config));
    $mgr = $factory->create(true);
    $device=$mgr->getDeviceForUserAgent($_SERVER['HTTP_USER_AGENT']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>WURFL</title>
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
				<li><a href="map.html">Map</a></li>
			</ul>
		</div>
		<div>
			<?php			
				echo "Device brand name " . $device->getCapability("brand_name");
				echo "<br />";
				echo "Device model name " . $device->getCapability("model_name");
				echo "<br />";
			?>
		</div>
	</div>
</body>
</html>