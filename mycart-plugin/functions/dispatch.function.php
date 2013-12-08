<?php
//changes the dateTime on the order field
include('../includes/db.inc.php');

$oid = isset($_GET['id']) ? $_GET['id'] : null;
$dateTime = date("Y-m-d H:i:s");

//update order table with date
$sth = $dbh->query("UPDATE `order`
		SET dateTimeSent = '$dateTime'
		WHERE id = '$oid'");

//this will send the customer an email when run

header("Location: ../admin/orders-view.php?id=$oid");
?>