<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_card";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

if(!$connection){
    die("Connection failed: " . mysqli_connect_error());
}
