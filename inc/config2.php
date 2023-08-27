<?php
session_start();
error_reporting(0);
$servername   = "localhost";
$username     = "steganom";
$password     = "10november2018";
$dbname       = "db_steganomail";
 
// Create connection
$mysqli           =   new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>