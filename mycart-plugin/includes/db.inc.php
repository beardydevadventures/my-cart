<?php
$host="localhost";
$dbname="mycart-test1";
$user="root";
$pass="";

$dbh = null;

//PDO DB Connection
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
?>