<?php ob_start(); session_start();
	if(!isset($_SESSION['admin']))
	{
		header('Location: ../admin/');
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Cart | Admin</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="../colorpicker/css/colorpicker.css">
	<link rel="stylesheet" type="text/css" href="../css/cms.css"/>
</head>
<body>
	<div class="pushy-footer-wrapper">
 	<div class="header-content">
		<div class="wrapper clearfix">
			<div class="clearfix">
				<a class="header-logo" href="home.php"><img class="logo" src="../img/logo-mycart.png" alt="My Cart"/></a>
				<div class="header-nav">
					<a href="../functions/adminsignin.function.php" class="btn btn-default">Logout</a>
				</div>
			</div>
		</div><!-- end wrapper -->
	</div><!-- end header-content -->
	<div class="nav-content">
		<div class="wrapper clearfix">
			<div class="inner clearfix">
				<div class="nav-main">
					<a href="home.php" class="btn btn-info"><span class="fa fa-home"></span> Home</a>
					<a href="products.php" class="btn btn-info"><span class="fa fa-pencil"></span> Products</a>
					<a href="categories.php" class="btn btn-info"><span class="fa fa-list-ol"></span> Categories</a>
					<a href="shipping.php" class="btn btn-info"><i class="fa fa-truck"></i> Shipping Rates</a>
					<a href="orders.php" class="btn btn-info"><span class="fa fa-list"></span> Orders</a>
				</div>
				<div class="nav-customize">
					<a href="preview.php" class="btn btn-invert"><i class="fa fa-eye"></i> Preview</a>
					<a href="customize.php" class="btn btn-warning"><span class="fa fa-cog"></span> Customize</a>
				</div>
			</div><!-- end clearfix -->
		</div><!-- end wrapper -->
	</div><!-- end nav-content -->