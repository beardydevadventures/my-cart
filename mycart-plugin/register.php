<?php 
	include('includes/db.inc.php');
	include('includes/colorArray.inc.php');
	include('includes/nav.inc.php');
?>	
<div class="mycart-plugin-content">
	<h2>Register</h2>
	<form class="mycart-plugin-checkout-form" action="functions/signup.function.php" method="post">
		<div class="mycart-plugin-checkout">
			<h3>Your Details</h3>
			<div class="mycart-plugin-form-group">
				<input type="hidden" name="billing" value="billing"/>
				<label>First Name</label>
				<input type="text" name="fname" autofocus required/>
			</div>
			<div class="mycart-plugin-form-group">
				<label>Last Name</label>
				<input type="text" name="lname" required/>
			</div>
			<div class="mycart-plugin-form-group">
				<label>Contact Number</label>
				<input type="text" name="phone" required/>
			</div>
			<div class="mycart-plugin-form-group">
				<label>Email</label>
				<input type="email" name="email" required/>
				<p>Your email will only be used to contact you and to log in.</p>
			</div>
			<div class="mycart-plugin-form-group">
				<label>Password</label>
				<input type="password" name="pword" required/>
			</div>
			<div class="mycart-plugin-form-group">
				<label>Confirm Password</label>
				<input type="password" name="pconf" required/>
			</div>
		</div>
		<div class="mycart-plugin-clearfix"></div>

		<div class="mycart-plugin-checkout-left">
			<h3>Billing Address</h3>
			<div class="mycart-plugin-form-group">
				<label>Address</label>
				<input type="text" name="addr" required/>
			</div>
			<div class="mycart-plugin-form-group">
				<label>Address</label>
				<input type="text" name="addrs"/>
			</div>
			<div class="mycart-plugin-form-group">
				<label>Suburb/&#8203City</label>
				<input type="text" name="city" required/>
			</div>
			<div class="mycart-plugin-form-group">
				<label>Country</label>
				<select name="country">
					<?php include 'includes/country.inc.php';?>
				</select>
			</div>
			<div class="mycart-plugin-form-group">
				<label>State/&#8203Province</label>
				<input type="text" name="state" required/>
			</div>
			<div class="mycart-plugin-form-group">
				<label>Postal/&#8203Zip Code</label>
				<input type="text" name="zip" required/>
			</div>
			<div class="mycart-plugin-form-group">
				<label class="mycart-plugin-form-hide"></label>
				<div class="mycart-plugin-form-input"><input type="checkbox" class="mycart-plugin-toggle-checkbox" name="checkbox" checked/> Ship item(s) to my billing address</div>
			</div>
		</div><!-- end checkout-billing -->

		<div class="mycart-plugin-checkout-right">
			<h3>Shipping Address</h3>
			<p class="mycart-plugin-toggle-show">Item(s) will be shipped to my billing address</p>
			<div class="mycart-plugin-toggle-hide">
				<div class="mycart-plugin-form-group">
					<label>Address</label>
					<input type="text" name="addr2"/>
				</div>
				<div class="mycart-plugin-form-group">
					<label>Address</label>
					<input type="text" name="addrs2"/>
				</div>
				<div class="mycart-plugin-form-group">
					<label>Suburb/&#8203City</label>
					<input type="text" name="city2"/>
				</div>
				<div class="mycart-plugin-form-group">
					<label>Country</label>
					<select name="country2">
						<?php include 'includes/country.inc.php';?>
					</select>
				</div>
				<div class="mycart-plugin-form-group">
					<label>State/&#8203Province</label>
					<input type="text" name="state2"/>
				</div>
				<div class="mycart-plugin-form-group">
					<label>Postal/&#8203Zip Code</label>
					<input type="text" name="zip2"/>
				</div>
			</div><!-- end toggle-content -->
		</div><!-- end checkout-shipping -->
		<div class="mycart-plugin-clearfix"></div>
		<div class="mycart-plugin-form-group"><button class="mycart-plugin-btn-success" type="submit" name="submit">Register</button></div>
	</form>
	<div class="mycart-plugin-clearfix"></div>
</div><!-- end mycart-plugin-content -->
<script type="text/javascript" src="mycart-plugin/js/store.js"></script>
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