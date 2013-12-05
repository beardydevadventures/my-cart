<?php
	session_start();
	
	if(isset($_SESSION['uid']))
	{
		unset($_SESSION['uid']);
		
		include('../mycart-plugin-store.php');
	}
?>