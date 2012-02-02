<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Accommodation</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
	<script type='text/javascript' src='prototype.js'></script>

	<script type='text/javascript'>
	function ajaxsearch()
	{
		var l = $("location").value;
		var t = $("type").value;
	
		var search_request = new Ajax.Request('searchscript.php',{method: 'get',
			parameters: 'location=' + l + '&type=' + t,
			onComplete: searchReceived });
	}

	function ajaxreview()
	{
		var r_id = $("accidreview").value;
		var r = $("review").value;
	
		var review_request = new Ajax.Request('addreview.php',{method: 'get',
			parameters: 'accid=' + r_id + '&review=' + r,
			onComplete: reviewReceived });
	}

	function ajaxbook()
	{
		var b_id = $("accidbook").value;
		var s_date = $("startdate").value;
		var e_date = $("enddate").value;
		var room = $("room").value;
	
		var book_request = new Ajax.Request('bookroom.php',{method: 'get',
			parameters: 'accid=' + b_id + '&startdate=' + s_date + '&enddate=' + e_date + '&room=' + room,
			onComplete: bookReceived });
	}


	//search
	function searchReceived(xmlHTTP)
	{
		var accomArray = xmlHTTP.responseXML.getElementsByTagName("place");
		
		var html = "";

		var nodeCount = accomArray[0].childNodes.length;
		if(nodeCount == 1)
		{
			//var errorNum = xmlHTTP.responseXML.getElementsByTagName("error")[0].getAttribute('code');
			var errorValue = xmlHTTP.responseXML.getElementsByTagName("error")[0].firstChild.nodeValue;

			html = html + "<tr>" +
			"<td>" + errorValue +"</td>" +
			"</tr>";
			$("searchaccomresponse").innerHTML = "<table><tr class='accomtitles'><td>Error</td></tr>"+html+"</table>";		
		}
		else
		{
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
	}


	//review
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


	//book
	function bookReceived(xmlHTTP)
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
			$("bookingresponse").innerHTML = "<table><tr class='accomtitles'><td>Error</td></tr>"+html+"</table>";
		}
		else
		{
			var successValue = xmlHTTP.responseXML.getElementsByTagName("success")[0].firstChild.nodeValue;
			html = html + "<tr>" +
			"<td>" + successValue +"</td>" +
			"</tr>";
			$("bookingresponse").innerHTML = "<table><tr class='accomtitles'><td>Success</td></tr>"+html+"</table>";
		}
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
			<form class="ajaxtable">
				<table>
				<tr><td> Location: </td> <td><input type="text" id="location"/></td></tr>
				<tr><td> Type: </td> <td><input type="text" id="type"/></td</tr>
				<tr><td> <input type="button" value="Search" onclick="ajaxsearch()"/> </td></tr>
				</table>
			</form>

			<div id="searchaccomresponse"></div>

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

			<form class="ajaxtable">
				<table>
				<tr><td> Accommodation ID: </td> <td><input type="text" id="accidbook"/></td></tr>
				<tr><td> Start Date: </td> <td><input type="text" id="startdate"/></td></tr>
				<tr><td> End Date: </td> <td><input type="text" id="enddate"/></td></tr>
				<tr><td> Room: </td> <td><input type="text" id="room"/></td></tr>
				<tr><td> <input type="button" value="Add Booking" onclick="ajaxbook()"/> </td></tr>
				</table>
			</form>

			<div id="bookingresponse"></div>
		</div>


	</div>
	
</body>
</html>