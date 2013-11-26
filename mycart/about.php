<?php ob_start(); session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>My Cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="robots" content="index, follow"/>
	<link rel="stylesheet" type="text/css" href="css/client.css"/>

	<!-- jquery -->
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

	<!-- mycart-plugin styling -->
	<link rel="stylesheet" type="text/css" href="mycart-plugin/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="mycart-plugin/css/store.css"/>
	<!-- <script type="text/javascript" src="js/main.js"></script> --> <!-- now loaded straight from the AJAX plugin call -->

	<!-- mycart-plugin fancybox libraries -->
	<link rel="stylesheet" href="mycart-plugin/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<script type="text/javascript" src="mycart-plugin/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
	<!-- jquery libraries -->
	<script type="text/javascript">
	$(function(){
		$.ajax({
			url: "mycart-plugin/mycart-plugin-cart.php",
			dataType: 'html',
			success: function(data){
				$(".mycart-plugin-cart").html(data);
			}
		});
		$.ajax({
			url: "mycart-plugin/mycart-plugin-store.php",
			dataType: 'html',
			success: function(data){
				$(".mycart-plugin-store").html(data);
			}
		});
	});
	</script>
</head>
<body lang="en">
<div class="wrapper clearfix">
	<div class="header">
		<h1>Example Website</h1>
		<div class="cart-container">
			<!-- ============ mycart-plugin CART ============ -->
			<div class="mycart-plugin mycart-plugin-cart"></div>
		</div><!-- cart-container -->
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li><li>
				<a href="about.php">About</a></li><li>
				<a href="shop.php">Shop</a></li><li>
				<a href="gallery.php">Gallery</a></li><li>
				<a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</div><!-- header -->
	<h2>About Us</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea, nisi, impedit, aspernatur sint voluptatum odit aperiam soluta explicabo nesciunt earum quo voluptates. Voluptate, vel, quod ratione ullam deserunt commodi quaerat.</p>
	<div class="footer">
		<ul>
			<li><span class="client-span">ABC</span></li><!-- 
		 --><li><span class="client-span">123</span></li>
		</ul>
		<p>Thank you for visiting my Example Website. Please be sure to collect your FREE internet points on your way out.</p>
		<p style="font-size: .9em; color: #555;">2013 &copy; Example Website. All rights reserved.</p>
	</div><!-- footer -->
</div><!-- wrapper -->
</body>
</html>