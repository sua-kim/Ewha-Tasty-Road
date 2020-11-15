<?php

//Params to connect to database
$dbHost = "localhost:8080";
$dbUser = "team19";
$dbPass = "team19";
$dbName = "team19";

// Connection to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Error output when there is no connection
if (!$conn) {
    die("Database connection failed!");
} 
?>