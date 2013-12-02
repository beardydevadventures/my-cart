<?php
$host="localhost";
<<<<<<< HEAD
$dbname="mycartdb";
=======
$dbname="mycart-test";
>>>>>>> origin/Phill
$user="root";
$pass="";

$dbh = null;

//PDO DB Connection
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
?>