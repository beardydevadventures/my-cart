<?php 
	include('includes/db.inc.php');
	include('includes/colorArray.inc.php');
	include('includes/nav.inc.php');
	include('includes/cart.inc.php');

	if(!isset($_SESSION['uid']))
	{
		header('Location: register.php');
	}
?>
<div class="mycart-plugin-content mycart-plugin-clearfix">
		<h2>Checkout</h2>
			<?php
		//cart id
		$a = $_SESSION['cart'];

		//Gets information from each item from database $a is defined in cart.inc.php
		?>
		<table class="mycart-plugin-cart-table">
			<thead>
				<tr>
					<td>Image</td>
					<td>Item</td>
					<td>Options</td>
					<td>Quantity</td>
					<td>Sale Price</td>
					<td>Sub Total</td>
				</tr>
			</thead>
			<tbody>
		<?php

		foreach($a as &$item)
		{

			$sth = $dbh->query("SELECT id, name, cost, image, dateTime
			
						FROM (
						SELECT p.id, p.name, p.image, pp.cost, pp.dateTime
						FROM product p, category c, product_category pc, product_cost pp
						WHERE p.id = pc.productId
						AND c.id = pc.categoryId
						AND p.archive = 1
						AND p.id = pp.productId
						AND p.id = '$item[0]'
						ORDER BY pp.dateTime DESC
						) product
			
						GROUP BY product.id
						ORDER BY product.dateTime DESC");
			
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			
			// populate page with products stored in the order array if the quantity has been changed will update with new amount
			$row = $sth->fetch();
			

			//total for each row
			$rowTot = $row['cost'] * $item[1];
			
			$rowTot = round($rowTot, 2);
			
			echo("<tr>
					<td><img src='mycart-plugin/" . $row['image'] . "' height='50' width='40' /></td>
					<td>" . $row['name'] . "</a></td>
					<td>");
			
			$opsth = $dbh->query("SELECT p.id, pv.productId, pv.description, pv.id AS Var
							FROM product p, product_variation pv
							WHERE p.id = pv.productId
							AND p.id = '$item[0]'
							AND pv.id = '$item[2]'");
				
			$opsth->setFetchMode(PDO::FETCH_ASSOC);
		
			$oprow = $opsth->fetch();
			echo($oprow['description']);
			
			echo("</td>
				<td>" . $item[1] . "</td>
				<td>$" . $row['cost'] ."</td>
				<td>$" . number_format((float)$rowTot, 2, '.', '') . "</td>
				</tr>");
		}
		?>
		</tbody>
		</table>
		<div class="mycart-plugin-cart-bottom">
			<h4>Shipping</h4>
			<p>Shipping costs are included!</p>
			<br/>
			<h4>Total $<?php echo(number_format((float)$cartTot, 2, '.', ''));?></h4>
			<a href="mycart-plugin/expressCheck.php"><input type="image" src="https://www.paypal.com/en_AU/AU/i/btn/btn_xpressCheckout.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"></a>
		</div>
	</div><!-- cart page -->
<div class="clearfix"></div>
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
			// yo MATT! here, on success call ANOTHER ajax call to
			// update the cart div
			$.ajax({
				url: "mycart-plugin/mycart-plugin-cart.php",
				dataType: 'html',
				success: function(data){
					$(".mycart-plugin-cart").html(data);
				}
			});
		}
	});
}

//$("#all_db").change(myDesiredFunc);

$(".mycart-plugin .mycart-plugin-page-link").on('click', {
	vars: {}, // leave blank if empty
	method: 'post'
}, CallPage);
</script>