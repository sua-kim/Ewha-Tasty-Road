<?php

//Params to connect to database
$dbHost = "localhost";
$dbUser = "team19";
$dbPass = "team19";
$dbName = "team19";

// Connection to database
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Error output when there is no connection
if ($conn->connect_error) {
    die("Database connection failed!".$conn->connect_error);
}

?>
