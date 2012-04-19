<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Accommodation</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
	<link rel="stylesheet" type="text/css" href="jquery-ui-css.css" />
	<script type='text/javascript' src='jquery.js'></script>
	<script type='text/javascript' src='jquery-ui.js'></script>

	<script type='text/javascript'>
	$(document).ready(onLoad);

	function onLoad(){
		$("#startdate").datepicker({ dateFormat: 'yy/mm/dd' });
		$("#enddate").datepicker({ dateFormat: 'yy/mm/dd' });
	}

	function fontSize(s){
		var currentFontSize = $('html').css('font-size');
		var currentFontSizeNum = parseFloat(currentFontSize, 10);
		if(s == "u")
		{		
			var fontPlus = currentFontSizeNum*1.2;
			$("html").css('font-size', fontPlus);
		}
		else if(s == "d")
		{
			var fontMinus = currentFontSizeNum*0.8;
			$("html").css('font-size', fontMinus);
		}
	}

	function resultsCustomise(){
		var bgCol = $("#searchbg").val();
		var textCol = $("#searchtext").val();
		if(bgCol == '' && textCol != ''){ $("#searchaccomresponse").css({color: textCol}); }
		else if(textCol == '' && bgCol != ''){ $("#searchaccomresponse").css({backgroundColor: bgCol}); }
		else if(bgCol != '' && textCol != ''){ $("#searchaccomresponse").css({backgroundColor: bgCol, color: textCol}); }
	}

	function ajaxsearch()
	{
		var l = $("#location").val();
		var t = $("#type").val();
	
		var request = $.ajax({
                url: 'searchscript.php',
                type: 'GET',
                dataType: 'json',
                data: {location: l, type: t},
                success: searchReceived,
                error: searchError
            });
	}

	function searchError(jqXHR, textStatus, errorThrown)
	{
		if(errorThrown == "Location_Missing"){
			$("#searchaccomresponse").html("Please enter a location.");
		}
		else if(errorThrown == "No Accommodation Found"){
			$("#searchaccomresponse").html("No accommodation found in that location.");
		}
		else if(errorThrown == "Unauthorized Access"){
			$("#searchaccomresponse").html("Unauthorised access.");
		}
	}

	function searchReceived(response)
	{
		$("#searchaccomresponse").html("");
		$("#searchaccomresponse").append("<table>");
		for(var i=0; i<response.length; i++){
			$("#searchaccomresponse").append("<tr><td>"+response[i].name+"</td>"+
				"<td>"+response[i].type+"</td>"+
				"<td>"+response[i].location+"</td>"+
				"<td>"+response[i].latitude+"</td>"+
				"<td>"+response[i].longitude+"</td>"+
				"<td>"+response[i].availability+"</td>"+
				"</tr>");
		}
		$("#searchaccomresponse").append("</table>");
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

				<form class="ajaxtable" action="reviewrest.php" method="get">
					<table>
					<tr><td> Accommodation ID: </td> <td><input type="text" name="accidreview"/></td></tr>
					<tr><td> Review: </td> <td><input type="text" name="review"/></td</tr>
					<tr><td> <input type="submit" value="Add Review"/> </td></tr>
					</table><br /><br />
				</form>

				<form class="ajaxtable" action="bookrest.php" method="post">
					<table>
					<tr><td> Accommodation ID: </td> <td><input type="text" name="accidbook"/></td></tr>
					<tr><td> Start Date: </td> <td><input type="text" name="startdate" id="startdate"/></td></tr>
					<tr><td> End Date: </td> <td><input type="text" name="enddate" id="enddate"/></td></tr>
					<tr><td> Room: </td> <td><input type="text" name="room"/></td></tr>
					<tr><td> <input type="submit" value="Add Booking"/> </td></tr>
					</table>
				</form>
			</div>


			<div id="middle">
				<div id="searchaccomresponse"></div>
			</div>

			<div id="right">
				<div id="buttonDiv">
					Background:<br />
					<input id="searchbg" size="10"/><br />
					Text:<br />
					<input id="searchtext" size="10"/><br />
					<button onclick="resultsCustomise()">Change</button><br />

					Font Size:<br />
					<button onclick="fontSize('u')">Increase</button>
					<button onclick="fontSize('d')">Decrease</button>
				</div>
			</div>
			
		</div>
	</div>
	
</body>
</html>