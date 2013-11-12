<?php ob_start(); session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>My Cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="robots" content="index, follow"/>
	<!-- mycart styling -->
	<!-- <link rel="stylesheet" type="text/css" href="css/normalize.css"/> -->
	<link rel="stylesheet" type="text/css" href="css/client.css"/>
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet"> -->
	
	<!-- jquery libraries -->
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

	<!-- main JavaScript -->
	<script src="js/main.js"></script>

	<!-- FancyBox libraries -->
	<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
</head>
<body lang="en">
<div class="wrapper clearfix">
	<div class="header">
		<h1>Example Website</h1>
		<div class="cart-container">
			<!--
					CART DIV		
			-->
			<div class="mycart-cart">
				<?php include('includes/cart.inc.php'); ?>
				<div class="cart-checkout">
					<a href="checkout.php" class="button">Checkout</a>
					<div class="links">
					<?php 
					 if(!isset($_SESSION['uid']))
					 {
					 	?>
					 	
					 		<a href="signup.php">login</a>
							<a href="signup.php">sign up</a>
						
						<?php
					 }
					 else
					 {
					 	?>
					 		<a href="userData.php">mystuff</a>
					 		<a href="functions/signout.function.php">sign out</a>
					 	<?php
					 	/*$uid = $_SESSION['uid'];
					 	
					 	$login = $dbh->query("SELECT c.fname
					 			FROM customer c
					 			WHERE c.id = '$uid'");
						
						$login->setFetchMode(PDO::FETCH_ASSOC);
						
						$login = $login->fetch();
					 	echo($login['fname']);*/
					 }
					?>
					</div>
				</div>
				<div class="cart-items">
					<a href="cart.php" title="View my cart">
						<img alt="My cart" src="img/logo_vert.svg"/>
						<p>My Cart </br>(<span><?php echo($cartItems);?> items</span>)</p>
					</a>
				</div>
			</div><!-- mycart-cart -->
			<!--
					END CART DIV		
			-->
		</div><!-- cart-container -->
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li><li>
				<a href="#">About</a></li><li>
				<a href="products.php">Shop</a></li><li>
				<a href="#">Gallery</a></li><li>
				<a href="#">Contact</a></li>
			</ul>
		</nav>
	</div><!-- header -->