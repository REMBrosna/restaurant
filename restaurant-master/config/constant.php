<?php
session_start();
$SITEURL = "http://localhost/workspace/restaurant-master/";
$servername = "localhost";
$username = "root";
$password = "root";
$db = "restaurant";
// Create connection
$conn = new mysqli($servername, $username, $password);
$db_select = mysqli_select_db($conn, $db); //Selecting Database

?>