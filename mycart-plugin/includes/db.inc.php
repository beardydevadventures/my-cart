<?php
$host="localhost";
$dbname="shaunsface";
$user="root";
$pass="";

$dbh = null;

//PDO DB Connection
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
?>