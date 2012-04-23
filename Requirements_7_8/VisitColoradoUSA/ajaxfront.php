<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Accommodation</title>
	<link rel="stylesheet" type="text/css" href="../../main.css" />
	<link rel="stylesheet" type="text/css" href="../../lib/jquery-ui-css.css" />
	<script type='text/javascript' src='../../lib/jquery.js'></script>
	<script type='text/javascript' src='../../lib/jquery-ui.js'></script>

	<script type='text/javascript'>
	$(document).ready(onLoad);

	function onLoad(){
		$("#startdate").datepicker({ dateFormat: 'yy/mm/dd' });
		$("#enddate").datepicker({ dateFormat: 'yy/mm/dd' });
	}

	function ajaxsearch()
	{
		var l = $("#location").val();
		var t = $("#type").val();
		var searchrequest = $.ajax({
                url: 'searchrest.php',
                type: 'GET',
                dataType: 'json',
                data: {location: l, type: t},
                success: searchReceived,
                error: searchError
            });
	}

	function ajaxbook()
	{
		var bookid = $("#accidbook").val();
		var sd = $("#startdate").val();
		var ed = $("#enddate").val();
		var r = $("#room").val();
	
		var reviewrequest = $.ajax({
                url: 'bookrest.php',
                type: 'GET',
                data: {accidbook: bookid, startdate: sd, enddate: ed, room: r},
                success: bookReceived,
                error: bookError
            });
	}

	function searchError(jqXHR, textStatus, errorThrown)
	{
		if(errorThrown == "Missing Fields"){
			$("#response").html("Please enter a location.");
		}
		else if(errorThrown == "No Accommodation Found"){
			$("#response").html("No accommodation found in that location.");
		}
		else if(errorThrown == "Unauthorized Access"){
			$("#response").html("Unauthorised access.");
		}
	}

	function searchReceived(response)
	{
		$("#response").html("");
		//add headings to table: id name type etc
		$("#response").append("<table>");
		$("#response").append("<tr><td>ID</td><td>Name</td><td>Type</td><td>Location</td><td>Latitude</td><td>Longitude</td><td>Availability</td><td></td></tr>");
		for(var i=0; i<response.length; i++){
			$("#response").append("<tr><td>"+response[i].ID+"</td>"+
				"<td>"+unescape(response[i].name)+"</td>"+
				"<td>"+unescape(response[i].type)+"</td>"+
				"<td>"+unescape(response[i].location)+"</td>"+
				"<td>"+response[i].latitude+"</td>"+
				"<td>"+response[i].longitude+"</td>"+
				"<td>"+response[i].availability+"</td>"+
				"</tr>");
		}
		$("#response").append("</table>");
	}

	function bookError(jqXHR, textStatus, errorThrown)
	{	
		if(errorThrown == "Missing Fields"){
			$("#response").html("Please enter an accommodation ID.");
		}
		else if(errorThrown == "No Accommodation Found"){
			$("#response").html("No accommodation found with that ID.");
		}
		else if(errorThrown == "Unauthorized Access"){
			$("#response").html("Unauthorised access.");
		}
	}

	function bookReceived(response)
	{
		$("#response").html("Booking Added.");
	}
	</script>
</head>

<body>
	<div id="container">
		<div id="logo"><img src="images/logo.png" alt="logo"/></div>

		<div id="navigation">
			<ul>
				<li><a href="../../index.php">PlacesToStay</a></li>
			</ul>
		</div>

		<div id="stage">
			<div id="left">
				<table>
				<tr><td> Location: </td> <td><input type="text" id="location" name="location"/></td></tr>
				<tr><td> Type: </td> <td><input type="text" id="type" name="type"/></td</tr>
				<tr><td> <button onclick="ajaxsearch()">Search</button> </td></tr>
				</table>
				<br /><br />

				<table>
				<tr><td> Accommodation ID: </td> <td><input type="text" name="accidbook" id="accidbook"/></td></tr>
				<tr><td> Start Date: </td> <td><input type="text" name="startdate" id="startdate"/></td></tr>
				<tr><td> End Date: </td> <td><input type="text" name="enddate" id="enddate"/></td></tr>
				<tr><td> Room: </td> <td><input type="text" id="room" name="room"/></td></tr>
				<tr><td> <button onclick="ajaxbook()">Make Booking</button> </td></tr>
				</table>
			</div>

			<div id="middle">
				<div id="response"></div>
			</div>
		</div>
	</div>
	
</body>
</html>