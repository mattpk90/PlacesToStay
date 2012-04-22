<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>GPS</title>
    <link rel="stylesheet" type="text/css" href="../main.css"/>
    <link rel="stylesheet" type="text/css" href="../lib/leaflet.css"/>
    <link rel="stylesheet" type="text/css" href="../lib/jquery-ui-css.css" />
    <script type="text/javascript" src="../lib/leaflet.js"></script>
    <script type='text/javascript' src='../lib/jquery.js'></script>
    <script type='text/javascript' src='../lib/jquery-ui.js'></script>
    <script type="text/javascript">
    var map;
    function init()
    {
        map = new L.Map ("map1");
        var attrib="Map data copyright OpenStreetMap contributors, CC-by-SA";

        var layerOSM = new L.TileLayer
            ("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                { attribution: attrib } );            
        map.addLayer(layerOSM);

        var populate = $.ajax({
                url: '../Requirements_10/fetchplaces.php',
                data: {id: ""},
                dataType: 'json'
            });

        populate.done(function(response) {
            for(var i=0; i<response.length; i++){
                var a, b = 0;
                a = new L.LatLng(response[i].latitude,response[i].longitude);
                b = new L.Marker(a);

                map.addLayer(b);
                b.bindPopup(response[i].name);
                a++;
                b++;
            }
        });

        populate.fail(function(jqXHR, textStatus) {
          alert( "Error retrieving places: " + textStatus );
        });

        if(navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition (processPosition, handleError);
        }
        else
        {
            alert("Sorry, geolocation not supported in this browser");
            var pos = new L.LatLng(50.9079,-1.4015);
            map.setView(pos, 14);
        }

         function processPosition(pos)
        {
            var pos = new L.LatLng(pos.coords.latitude,pos.coords.longitude);
            map.setView(pos, 14);
        }

        function handleError(err)
        {
            alert('An error occurred: ' + err.code);
        }
        //map.on("click", onMapClick);
    }
    </script>
</head>

<body onload="init()">

    <div id="container">
        <div id="logo"><img src="../images/logo.png" alt="logo"/></div>

        <div id="navigation">
            <ul>
                <li><a href="../index.php">Home</a></li>
            </ul>
        </div>
        <div id="map1" style="width:800px; height:400px"> </div>
        <div id="mapPanel"></div>
    </div>
</body>
</html>