<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Accommodation</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
	<link rel="stylesheet" type="text/css" href="jquery-ui-css.css" />
	<script type='text/javascript' src='prototype.js'></script>
	<script type='text/javascript' src='jquery.js'></script>
	<script type='text/javascript' src='jquery-ui.js'></script>

	<script type='text/javascript'>
	var $j = jQuery.noConflict();	
	$j(document).ready(onLoad);

	function onLoad(){
		$j("#startdate").datepicker({ dateFormat: 'yy/mm/dd' });
		$j("#enddate").datepicker({ dateFormat: 'yy/mm/dd' });
	}

	function fontSize(s){
		var currentFontSize = $j('html').css('font-size');
		var currentFontSizeNum = parseFloat(currentFontSize, 10);
		if(s == "u")
		{		
			var fontPlus = currentFontSizeNum*1.2;
			$j("html").css('font-size', fontPlus);
		}
		else if(s == "d")
		{
			var fontMinus = currentFontSizeNum*0.8;
			$j("html").css('font-size', fontMinus);
		}
	}

	function resultsCustomise(t){
		var a, b, c;
		if(t == "s"){
			a = "#searchbg";
			b = "#searchtext";
			c = "#searchaccomresponse";
		}
		else if(t == "r"){
			a = "#reviewbg";
			b = "#reviewtext";
			c = "#reviewresponse";
		}
		else if(t == "b"){
			a = "#bookbg";
			b = "#booktext";
			c = "#bookingresponse";
		}

		var bgCol = $j(a).val();
		var textCol = $j(b).val();
		if(bgCol == '' && textCol != ''){ $j(c).css({color: textCol}); }
		else if(textCol == '' && bgCol != ''){ $j(c).css({backgroundColor: bgCol}); }
		else if(bgCol != '' && textCol != ''){ $j(c).css({backgroundColor: bgCol, color: textCol}); }
	}

	function ajaxsearch()
	{
		var l = $("location").value;
		var t = $("type").value;
	
		var search_request = new Ajax.Request('searchscript.php',{method: 'get',
			parameters: 'location=' + l + '&type=' + t,
			onComplete: searchReceived });
	}

	function searchReceived(xmlHTTP)
	{
		if(xmlHTTP.status == 400){
			$j("#searchaccomresponse").html("Please enter a location.");
		}
		else if(xmlHTTP.status == 404){
			$j("#searchaccomresponse").html("No accommodation found in that location.");
		}
		else if(xmlHTTP.status == 401){

			$j("#searchaccomresponse").html("Unauthorised access.");
		}
		else if(xmlHTTP.status == 200){
			var accomArray = xmlHTTP.responseXML.getElementsByTagName("place");		
			var html = "";

			for(var i=0; i < accomArray.length; i++)
			{						
				html = html + "<tr>" +
				"<td>" + accomArray[i].getElementsByTagName("id")[0].firstChild.nodeValue + "&nbsp;</td>" +
				"<td>" + accomArray[i].getElementsByTagName("name")[0].firstChild.nodeValue + "&nbsp;&nbsp;</td>" +
				"<td>" + accomArray[i].getElementsByTagName("type")[0].firstChild.nodeValue + "&nbsp;</td>" +
				"<td>" + accomArray[i].getElementsByTagName("location")[0].firstChild.nodeValue + "&nbsp;&nbsp;</td>" +
				"<td>" + accomArray[i].getElementsByTagName("latitude")[0].firstChild.nodeValue + "&nbsp;</td>" +
				"<td>" + accomArray[i].getElementsByTagName("longitude")[0].firstChild.nodeValue + "&nbsp;</td>" +
				"<td>" + accomArray[i].getElementsByTagName("availability")[0].firstChild.nodeValue + "&nbsp;</td>" +
				"</tr>";
			}
			$j("#searchaccomresponse").html("<table><tr class='accomtitles'><td>ID</td><td>Name</td><td>Type</td>"+
				"<td>Location</td><td>Latitude</td><td>Longitude</td><td>Availability</td></tr>"+html+"</table>");	
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
			<div id="left">
				<form>
					<table>
					<tr><td> Location: </td> <td><input type="text" id="location" name="location"/></td></tr>
					<tr><td> Type: </td> <td><input type="text" id="type" name="type"/></td</tr>
					<tr><td> <input type="button" value="Search" onclick="ajaxsearch()"/> </td></tr>
					</table>
				</form><br /><br />

				<form class="ajaxtable" action="rest_client.php" method="post">
					<table>
					<tr><td> Accommodation ID: </td> <td><input type="text" id="accidreview"/></td></tr>
					<tr><td> Review: </td> <td><input type="text" id="review"/></td</tr>
					<tr><td> <input type="submit" value="Add Review"/> </td></tr>
					</table><br /><br />
				</form>

				<form class="ajaxtable" action="rest_client.php" method="post">
					<table>
					<tr><td> Accommodation ID: </td> <td><input type="text" id="accidbook"/></td></tr>
					<tr><td> Start Date: </td> <td><input type="text" id="startdate"/></td></tr>
					<tr><td> End Date: </td> <td><input type="text" id="enddate"/></td></tr>
					<tr><td> Room: </td> <td><input type="text" id="room"/></td></tr>
					<tr><td> <input type="submit" value="Add Booking"/> </td></tr>
					</table>
				</form>
			</div>


			<div id="middle">
				<div id="searchaccomresponse"></div>
				<br /><br />

				<div id="reviewresponse"></div>

				<br /><br />

				<div id="bookingresponse"></div>
				<br /><br />
			</div>

			<div id="right">
				<div id="buttonDiv">
					Background:<br />
					<input id="searchbg" size="10"/><br />
					Text:<br />
					<input id="searchtext" size="10"/><br />
					<button onclick="resultsCustomise('s')">Change</button><br />

					Background:<br />
					<input id="reviewbg" size="10"/><br />
					Text:<br />
					<input id="reviewtext" size="10"/><br />
					<button onclick="resultsCustomise('r')">Change</button><br />

					Background:<br />
					<input id="bookbg" size="10"/><br />
					Text:<br />
					<input id="booktext" size="10"/><br />
					<button onclick="resultsCustomise('b')">Change</button><br /><br />

					Font Size:<br />
					<button onclick="fontSize('u')">Increase</button>
					<button onclick="fontSize('d')">Decrease</button>
				</div>
			</div>
			
		</div>
	</div>
	
</body>
</html>