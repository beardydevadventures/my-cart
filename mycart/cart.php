<?php
	include('includes/header.inc.php');
?>
<!--

	SHOP DIV
	
 -->
 <div class="mycart-plugin">	
	<?php include('includes/nav.inc.php'); ?>
	<div class="mycart-plugin-content mycart-plugin-clearfix">
		<h2>Cart</h2>
		<?php
			//Gets information from each item from database $a is defined in cart.inc.php
			if(count($a) > 0)
			{
				?>
				<table>
					<thead>
						<tr>
							<td>Image</td>
							<td>Item</td>
							<td>Options</td>
							<td>Quantity</td>
							<td>Sale Price</td>
							<td>Sub Total</td>
							<td>Remove</td>
						</tr>
					</thead>
					<tbody>
				<?php

				foreach($a as &$item)
				{
					/*$sth = $dbh->query("SELECT p.id, p.name, pp.productId, pp.cost
								FROM product p, product_cost pp
								WHERE p.id = pp.productId
								AND p.id = '$item[0]'");*/
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
							<td><image src='" . $row['image'] . "' height='50' width='40' /></td>
							<td><a title='View Item' href='products-show.php?id=". $row['id'] . "'>" . $row['name'] . "</a></td>
							<td><form action='cart.php' method='get'><select name='nvr' onchange='this.form.submit()'>");
					
					$opsth = $dbh->query("SELECT p.id, pv.productId, pv.description, pv.id AS Var
									FROM product p, product_variation pv
									WHERE p.id = pv.productId
									AND p.id = '$item[0]'");
						
					$opsth->setFetchMode(PDO::FETCH_ASSOC);
				
					while($oprow = $opsth->fetch())
					{
						if($oprow['Var'] == $item[2])
						{
							echo("<option value='" . $oprow['Var'] . "' selected='selected'> " . $oprow['description'] . "</option>");
						}
						else
						{
							echo("<option value='" . $oprow['Var'] . "'>" . $oprow['description'] . "</option>");
						}
					} 
					
					echo("</select></td>
						<td><input type='hidden' name='upd' value='" . $row['id'] . "'><input class='mycart-plugin-input-text-small' type='text' name='nqt' onchange='this.form.submit()' min='0' size='3' maxlength='3' value='" . $item[1] . "'></form></td>
						<td>$" . $row['cost'] ."</td>
						<td>$" . number_format((float)$rowTot, 2, '.', '') . "</td>
						<td><a class='mycart-plugin-btn mycart-plugin-btn-danger' href='cart.php?rid=". $row['id'] . "&rvr=" . $item[2] . "'><i class='fa fa-times mycart-plugin-desktop-tag' title='Remove Item' alt='Remove' ></i><span class='mycart-plugin-mobile-tag'>Remove item</span></a></td>
						</tr>");
				}
				?>
				</tbody>
				</table>
				<p><b>Total</b></p>
				<p><b>$<?php echo(number_format((float)$cartTot, 2, '.', ''));?></b></p>
				<a class="mycart-plugin-btn mycart-plugin-btn-success" href="checkout.php">Checkout</a>
				<?php 
			}
			else
			{
				echo('<p>There are no items in your cart. <a role="link" href="products.php">Continue shopping!</a></p>');
			}
		?>
		<br/>
		<div class="shipping-div">
			<h2>Shipping</h2>
			<a role="link">Calculate shipping</a>
		</div>
	</div><!-- cart page -->
	<div class="clearfix"></div>
</div><!-- mycart plugin -->
<!--

	END OF SHOP DIV
	
 -->
 <?php
	include('includes/footer.inc.php');
?>