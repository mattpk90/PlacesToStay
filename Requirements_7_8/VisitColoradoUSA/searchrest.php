<?php
    header("Content-type: application/json");
    $location = $_GET["location"];
    $type = $_GET["type"];

    $connection = curl_init();
    curl_setopt($connection, CURLOPT_URL, "localhost/assignment/searchscript.php?location=$location&type=$type");
    //curl_setopt($connection, CURLOPT_URL, "http://edward.solent.ac.uk/students/mkennedy/assignment/searchscript.php?location=$location&type=$type");
    curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($connection,CURLOPT_HEADER, 0);
    $response = curl_exec($connection);

    //echo curl_getinfo($connection, CURLINFO_HTTP_CODE);

    $httpcode = curl_getinfo($connection, CURLINFO_HTTP_CODE);

    if($httpcode == "200"){
        header("HTTP/1.1 200 OK");
        echo $response;
        exit;
    }
    else if($httpcode == "400"){
        header("HTTP/1.1 400 Missing Fields");
        echo "400 Missing fields";
        exit;
    }
    else if($httpcode == "404"){
        header("HTTP/1.1 404 No Accommodation Found");
        echo "404 no accom found";
        exit;
    }
    else if($httpcode == "401"){
        header("HTTP/1.1 401 Unauthorized Access");
        echo "401 Unauthorized access";
        exit;
    }
    else{
    	header("HTTP/1.1 200 OK");
        echo $httpcode;         
    }
?>