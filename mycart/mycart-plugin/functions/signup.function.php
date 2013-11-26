<?php
	include("../includes/db.inc.php");
	
	//general details
	$fname = isset($_POST['fname']) ? $_POST['fname'] : header("Location: ../signup.php");
	$lname = isset($_POST['lname']) ? $_POST['lname'] : header("Location: ../signup.php");
	$phone = isset($_POST['phone']) ? $_POST['phone'] : header("Location: ../signup.php");
	$email = isset($_POST['email']) ? $_POST['email'] : header("Location: ../signup.php");
	$pword = isset($_POST['pword']) ? $_POST['pword'] : header("Location: ../signup.php");
	$pconf = isset($_POST['pconf']) ? $_POST['pconf'] : header("Location: ../signup.php");
	
	//billing address
	$addr = isset($_POST['addr']) ? $_POST['addr'] : header("Location: ../signup.php");
	$addrs = isset($_POST['addrs']) ? $_POST['addrs'] : header("Location: ../signup.php");
	$city = isset($_POST['city']) ? $_POST['city'] : header("Location: ../signup.php");
	$country = isset($_POST['country']) ? $_POST['country'] : header("Location: ../signup.php");
	$state = isset($_POST['state']) ? $_POST['state'] : header("Location: ../signup.php");
	$zip = isset($_POST['zip']) ? $_POST['zip'] : header("Location: ../signup.php");
	
	$baddr = "$addr \n $addrs \n $city \n $country \n $state, $zip";
	
	//check box unchecked get other information
	if(!isset($_POST['checkbox']))
	{
		//postage address (if box was checked)
		$addr2 = isset($_POST['addr2']) ? $_POST['addr2'] : header("Location: ../signup.php");
		$addrs2 = isset($_POST['addrs2']) ? $_POST['addrs2'] : header("Location: ../signup.php");
		$city2 = isset($_POST['city2']) ? $_POST['city2'] : header("Location: ../signup.php");
		$country2 = isset($_POST['country2']) ? $_POST['country2'] : header("Location: ../signup.php");
		$state2 = isset($_POST['state2']) ? $_POST['state2'] : header("Location: ../signup.php");
		$zip2 = isset($_POST['zip2']) ? $_POST['zip2'] : header("Location: ../signup.php");
		
		$paddr = "$addr2 \n $addrs2 \n $city2 \n $country2 \n $state2, $zip2";
	}
	else
	{
		$paddr = $baddr;
	}
	
	if($pword != $pconf)
	{
		header("Location: ../signup.php");
	}
	
	$sth = $dbh->query("INSERT INTO customer SET
			fname='$fname',
			lname='$lname',
			password='$pword',
			email='$email',
			phone='$phone',
			address='$baddr',
			shipping='$paddr'");
	
	header("Location: ../confirm.php");
	//This script needs to send confirmation email, encrypt the password
?>