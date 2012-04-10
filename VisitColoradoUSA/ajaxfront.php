<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Accommodation</title>
	<link rel="stylesheet" type="text/css" href="../main.css" />
	<link rel="stylesheet" type="text/css" href="../jquery-ui-css.css" />
	<script type='text/javascript' src='../prototype.js'></script>
	<script type='text/javascript' src='../jquery.js'></script>
	<script type='text/javascript' src='../jquery-ui.js'></script>

	<script type='text/javascript'>
	var $j = jQuery.noConflict();	
	$j(document).ready(onLoad);

	function onLoad(){	
		$j("#startdate").datepicker({ dateFormat: 'yy/mm/dd' });
		$j("#enddate").datepicker({ dateFormat: 'yy/mm/dd' });
	}

	function ajaxsearch()
	{
		var l = $("location").value;
		var t = $("type").value;
	
		var search_request = new Ajax.Request('../searchscript.php',{method: 'get',
			parameters: 'location=' + l + '&type=' + t,
			onComplete: searchReceived });
	}

	function ajaxreview()
	{
		var r_id = $("accidreview").value;
		var r = $("review").value;
	
		var review_request = new Ajax.Request('../addreview.php',{method: 'get',
			parameters: 'accid=' + r_id + '&review=' + r,
			onComplete: reviewReceived });
	}

	function reviewReceived(xmlHTTP)
	{		
		var html = "";

		//var successCode = xmlHTTP.responseXML.getElementsByTagName("success")[0].getAttribute('code');
		var checkResponse = xmlHTTP.responseXML.getElementsByTagName("place")[0].childNodes[0].nodeName;
		
		if(checkResponse == "error")
		{
			var errorValue = xmlHTTP.responseXML.getElementsByTagName("error")[0].firstChild.nodeValue;
			html = html + "<tr>" +
			"<td>" + errorValue +"</td>" +
			"</tr>";
			$("reviewresponse").innerHTML = "<table><tr class='accomtitles'><td>Error</td></tr>"+html+"</table>";
		}
		else
		{
			var successValue = xmlHTTP.responseXML.getElementsByTagName("success")[0].firstChild.nodeValue;
			html = html + "<tr>" +
			"<td>" + successValue +"</td>" +
			"</tr>";
			$("reviewresponse").innerHTML = "<table><tr class='accomtitles'><td>Success</td></tr>"+html+"</table>";
		}			
	}
	</script>

	<?php
		$connection = curl_init();
		curl_setopt($connection, CURLOPT_URL, "http://localhost/assignment/searchscript.php?location=denver&type=");
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
			</ul>
		</div>

		<div id="stage">
			<form class="ajaxtable" method="POST" action="coloradosearch.php">
				<table>
				<tr><td> Location: </td> <td><input type="text" id="location" name="location"/></td></tr>
				<tr><td> Type: </td> <td><input type="text" id="type" name="type"/></td</tr>
				<tr><td> <input type="submit" value="Search"/> </td></tr>
				</table>
			</form>

			<br /><br /><br /><br /><br /><br />

			<form class="ajaxtable">
				<table>
				<tr><td> Accommodation ID: </td> <td><input type="text" id="accidreview"/></td></tr>
				<tr><td> Review: </td> <td><input type="text" id="review"/></td</tr>
				<tr><td> <input type="button" value="Add Review" onclick="ajaxreview()"/> </td></tr>
				</table>
			</form>

			<div id="reviewresponse"></div>

			<br /><br /><br /><br /><br /><br />

			<form class="ajaxtable" action="coloradobook.php" method="POST">
				<table>
				<tr><td> Accommodation ID: </td> <td><input type="text" name="accidbook"/></td></tr>
				<tr><td> Start Date: </td> <td><input type="text" name="startdate" id="startdate"/></td></tr>
				<tr><td> End Date: </td> <td><input type="text" name="enddate" id="enddate"/></td></tr>
				<tr><td> Room: </td> <td><input type="text" name="room"/></td></tr>
				<tr><td> <input type="submit" value="Add Booking"/> </td></tr>
				</table>
			</form>
		</div>
	</div>
	
</body>
</html>