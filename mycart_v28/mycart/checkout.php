<?php
	include("includes/header.inc.php");
	
	if(!isset($_SESSION['uid']))
	{
		header('Location: signup.php?return=checkout');
	}
?>
	<?php include('includes/nav.inc.php'); ?>
	<div class="cart-page clearfix">
		<h2>Checkout</h2>
		<?php
			//Gets information from each item from database
			$itemNo = 1;
			
			foreach($a as &$item)
			{
				$sth = $dbh->query("SELECT p.id, p.name, pp.productId, pp.cost, pv.id, pv.description
							FROM product p, product_cost pp, product_variation pv
							WHERE p.id = pp.productId
							AND pv.id = '$item[2]'
							AND p.id = '$item[0]'");
				
				$sth->setFetchMode(PDO::FETCH_ASSOC);
				
				// populate page with products stored in the order array if the quantity has been changed will update with new amount
				$row = $sth->fetch();
				
				//total for each row
				$rowTot = $row['cost'] * $item[1];
				
				$rowTot = round($rowTot, 2);
				
				echo("<ul>
						<li>" . $itemNo . ".</li>
						<li>" . $row['name'] . "</li>
						<li>" . $row['description'] . "</li>
						<li>$item[1] @ $" . $row['cost'] . "</li>
						<li>$" . number_format((float)$rowTot, 2, '.', '') . "</li>
					</ul>");
				$itemNo++;
			}
		?>
		<ul>
			<li></li>
			<li></li>
			<li></li>
			<li><b>Total</b></li>
			<li><b>$<?php echo(number_format((float)$cartTot, 2, '.', ''));?></b></li>
		</ul>
		<ul>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li>
					<a href="expressCheck.php"><input type="image" src="https://www.paypal.com/en_AU/AU/i/btn/btn_xpressCheckout.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"></a>
			</li>
		</ul>
	</div><!-- cart page -->
	
<?php
	include("includes/footer.inc.php");
?>