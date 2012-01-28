<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Search Accommodation</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body id="home">

	<div id="container">
		<div id="logo"><img src="images/logo.png" alt="logo"/></div>

		<div id="navigation">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="searchaccom.php">Search Accommodation</a></li>
			</ul>
		</div>

		<div id="stage">
			<p>Search</p>
			<form action="searchscript.php" method="post">
				<table>
				<tr><td> Location: </td> <td><input type="text" name="location"/></td</tr>
				<tr><td> <input type="submit" value="Search"/> </td></tr>
				</table>
			</form>

			<form action="searchscript.php" method="post">
				<table>
				<tr><td> Type: </td> <td><input type="text" name="type"/></td</tr>
				<tr><td> <input type="submit" value="Search"/> </td></tr>
				</table>
			</form>
		</div>



	</div>
	

</body>
</html>