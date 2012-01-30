<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Search Accommodation</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
	<script type='text/javascript' src='prototype.js'></script>

	<script type='text/javascript'>
	function ajaxrequest()
	{
		var l = $("location").value;
		var t = $("type").value;
	
		var request = new Ajax.Request('searchscript.php',{method: 'get',
			parameters: 'location=' + l + '&type=' + t,
			onComplete: responseReceived });
	}


	function responseReceived(xmlHTTP)
	{
		var accomArray = xmlHTTP.responseXML.getElementsByTagName("place");
		
		var html = "";

		for(var i=0; i < accomArray.length; i++)
		{
			var id = accomArray[i].getElementsByTagName("id")[0].firstChild.nodeValue;
			var name = accomArray[i].getElementsByTagName("name")[0].firstChild.nodeValue;
			var type = accomArray[i].getElementsByTagName("type")[0].firstChild.nodeValue;
			var location = accomArray[i].getElementsByTagName("location")[0].firstChild.nodeValue;
			var latitude = accomArray[i].getElementsByTagName("latitude")[0].firstChild.nodeValue;
			var longitude = accomArray[i].getElementsByTagName("longitude")[0].firstChild.nodeValue;
			var availability = accomArray[i].getElementsByTagName("availability")[0].firstChild.nodeValue;
						

			html = html + "<tr>" +
			"<td>" + id + "&nbsp;</td>" +
			"<td>" + name + "&nbsp;&nbsp;</td>" +
			"<td>" + type + "&nbsp;</td>" +
			"<td>" + location + "&nbsp;&nbsp;</td>" +
			"<td>" + latitude + "&nbsp;</td>" +
			"<td>" + longitude + "&nbsp;</td>" +
			"<td>" + availability + "&nbsp;</td>" +
			"</tr>";
		}
	
		$("searchaccomresponse").innerHTML = "<table><tr class='accomtitles'><td>ID</td><td>Name</td><td>Type</td><td>Location</td><td>Latitude</td><td>Longitude</td><td>Availability</td></tr>"+html+"</table>";
					
		
	}
	</script>

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
			<form>
				<table>
				<tr><td> Location: </td> <td><input type="text" id="location"/></td></tr>
				<br /><br />
				<tr><td> Type: </td> <td><input type="text" id="type"/></td</tr>
				<tr><td> <input type="button" value="Search" onclick="ajaxrequest()"/> </td></tr>
				</table>
			</form>

			<div id="searchaccomresponse"></div>
		</div>


	</div>
	
</body>
</html>