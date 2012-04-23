<?php
	//define('WURFL_DIR','/var/www/wurfl-php-1.2.1');
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
	<?php 
		if($device->getCapability("is_wireless_device") == "true"){
			echo "<link rel='stylesheet' type='text/css' href='mobile.css'/>";
		}
		else{
			echo "<link rel='stylesheet' type='text/css' href='../main.css'/>";
		}
	?>
</head>

<body>

	<div id="container">
		<div id="logo"><img src="../images/logo.png" alt="logo"/></div>

		<div id="navigation">
			<ul>
				<li><a href="../index.php">Home</a></li>
			</ul>
		</div>
		<div id="stage">
			<?php			
				$a = $_SERVER['HTTP_USER_AGENT'];
				echo "The user agent is " .$a;
				echo "<br />";				
				echo "Device brand name " . $device->getCapability("brand_name");
				echo "<br />";
				echo "Device model name " . $device->getCapability("model_name");
				echo "<br />";
				echo "Screen resolution: ". $device->getCapability("resolution_width")."x".$device->getCapability("resolution_height");
				echo "<br />";
				echo "Wireless Device: ". $device->getCapability("is_wireless_device");
			?>
		</div>
	</div>
</body>
</html>