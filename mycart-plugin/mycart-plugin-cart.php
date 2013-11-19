
<?php 
	include('includes/db.inc.php');
	include('includes/cart.inc.php');
?>
<div class="mycart-plugin-cart-links">
	<?php 
	 if(!isset($_SESSION['uid']))
	 {
	 	?>
	 		<a class='mycart-plugin-show-login'>Log in</a> |
			<a class='mycart-plugin-page-link' href="mycart-plugin/register.php">Register</a>
			<div class="mycart-plugin-login-container">
				<input type='text' name='uname' placeholder='Username'/>
				<input type='password' name='pword' placeholder='Password'/>
				<button class="mycart-plugin-btn-default" type='submit'>Log in</button>
				<p><a class='mycart-plugin-link-white' href='#'>Forgot your password?</a></p>
			</div>
		<?php
	 }
	 else
	 {
	 	?>
	 		<a href="my-account.php">My Account</a> |
	 		<a href="functions/signout.function.php">Sign out</a>
	 	<?php
	 }
	?>
</div>
<div class="mycart-plugin-cart-items">
	<a class="mycart-plugin-page-link" href="mycart-plugin/cart.php" title="View my cart">
		<img src="mycart-plugin/img/logo_vert.svg"/>My cart <span><?php
			echo((($_SESSION["total"]) != 0) ? "<b>&dollar;" . $_SESSION['total'] . "</b> " : "");
			echo("(");
			echo((($cartItems) !== 0)? ((($cartItems) == 1)? $cartItems . ' item' : $cartItems . ' items') : 'empty');
			?></span>)
	</a>
</div>
<script src="mycart-plugin/js/cart.js"></script>

<script>
function CallPage(e) {
	e.preventDefault();
	var data = e.data;
	console.log(e.currentTarget.href);
	$.ajax({
		url: e.currentTarget.href,
		type: data.method,
		data: data.vars,
		dataType: 'html',
		success: function(data) {
			$(".mycart-plugin-store").html(data);
		}
	});
}

$(".mycart-plugin .mycart-plugin-page-link").on('click', {
	vars: {}, // leave blank if empty
	method: 'post'
}, CallPage);
</script>