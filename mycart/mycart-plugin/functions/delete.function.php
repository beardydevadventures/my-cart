<?php
require('../includes/db.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

$sth = $dbh->query("UPDATE product
		SET archive = '0'
		WHERE id = '$id'");

header("Location: ../admin/products.php");
?>