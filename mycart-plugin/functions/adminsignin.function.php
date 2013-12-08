<?php
	session_start();
	
	include("../includes/db.inc.php");

	$uname = isset($_POST['un']) ? $_POST['un'] : header("Location: ../admin/");
	$pword = isset($_POST['pw']) ? $_POST['pw'] : header("Location: ../admin/");
	
	$login = $dbh->query("SELECT COUNT(*) AS adminFound, c.id
			FROM customer c
			WHERE c.password = '$pword'
			AND (c.email = '$uname' OR c.lname = '$uname')
			AND c.fname = 'admin'");
	
	$login->setFetchMode(PDO::FETCH_ASSOC);
		
	$login = $login->fetch();
	
	if($login['adminFound'] == 1)
	{
		$_SESSION['admin'] = $login['id'];
	
		header('Location: ../admin/');
	}
	else
	{
		unset($_SESSION['admin']);
		
		header('Location: ../admin/');
	}
?>
	
	