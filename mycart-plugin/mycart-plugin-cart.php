
<?php 
	session_start();
	include('includes/db.inc.php');
	include('includes/colorArray.inc.php');
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
				<form name="login" id="login" action="mycart-plugin/functions/signin.function.php" method="post">
					<input type='text' name='uname' placeholder='Username'/>
					<input type='password' name='pword' placeholder='Password'/>
					<button class="mycart-plugin-btn-default" type='submit'>Log in</button>
				</form>
				<p><a class='mycart-plugin-link-white' href='mycart-plugin/register.php'>Forgot your password?</a></p>
			</div>
		<?php
	 }
	 else
	 {
	 	?>
	 		<a class='mycart-plugin-page-link' href="mycart-plugin/my-account.php">My Account</a> |
	 		<a class='mycart-plugin-page-link' href="mycart-plugin/functions/signout.function.php">Sign out</a>
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
//when a link is clicked
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

//sends the form data when submitted
$("#login").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax({
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data) 
        {
			CartRefresh();
        }
    });
    e.preventDefault(); //STOP default action
});

function CartRefresh(){
	//alert('working');
	/*
	$.ajax({
		url: "mycart-plugin/mycart-plugin-cart.php",
		dataType: 'html',
		success: function(data){
			$(".mycart-plugin-cart").html(data);
		}
	});
	*/
}

$("#login").submit(); //Submit  the FORM
//end form submit

$(".mycart-plugin .mycart-plugin-page-link").on('click', {
	vars: {}, // leave blank if empty
	method: 'post'
}, CallPage);
</script>