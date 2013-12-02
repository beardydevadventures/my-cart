<?php
require('../includes/db.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
$pid = isset($_GET['pid']) ? $_GET['pid'] : null;

$sth = $dbh->query("UPDATE product_variation
		SET archive = '0'
		WHERE id = '$id'");

header("Location: ../admin/products-edit.php?id=" . $pid);
?>