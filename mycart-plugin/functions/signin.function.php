<?php
	session_start();

	include("../includes/db.inc.php");

	$uname = isset($_POST['uname']) ? $_POST['uname'] : header("Location: ../products.php");
	$pword = isset($_POST['pword']) ? $_POST['pword'] : header("Location: ../products.php");
	//$page = isset($_POST['pagefrom']) ? $_POST['pagefrom'] : header("Location: ../products.php");
	
	$login = $dbh->query("SELECT c.id
			FROM customer c
			WHERE c.password = '$pword'
			AND c.email = '$uname'");
	
	$login->setFetchMode(PDO::FETCH_ASSOC);
		
	$login = $login->fetch();
	
	$_SESSION['uid'] = $login['id'];
?>
	
	