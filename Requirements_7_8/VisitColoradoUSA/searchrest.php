<?php
    header("Content-type: application/json");
    $location = $_GET["location"];
    $type = $_GET["type"];

    $connection = curl_init();
    curl_setopt($connection, CURLOPT_URL, "http://edward/students/mkennedy/assignment/Requirements_4_5_6/searchscript.php?location=$location&type=$type");
    curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($connection,CURLOPT_HEADER, 0);
    $response = curl_exec($connection);
    $httpcode = curl_getinfo($connection, CURLINFO_HTTP_CODE);

    if($httpcode == "400"){
        header("HTTP/1.1 400 Missing Fields");
        echo "400 Missing fields";
    }
    else if($httpcode == "404"){
        header("HTTP/1.1 404 No Accommodation Found");
        echo "404 no accom found";
    }
    else if($httpcode == "200"){
        header("HTTP/1.1 200 OK");
        echo $response;
    }
    else if($httpcode == "401"){
        header("HTTP/1.1 401 Unauthorized Access");
        echo "401 Unauthorized access";
    }
?>