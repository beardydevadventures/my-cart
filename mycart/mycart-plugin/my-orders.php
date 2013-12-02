<?php
	include('includes/db.inc.php');
	include('includes/colorArray.inc.php');
	include('includes/nav.inc.php');
	
	if(!isset($_GET['oid']) && !isset($_SESSION['uid']))
	{
		header('Location: signup.php');
	}
	else
	{
		$oid = $_GET['oid'];
		$uid = $_SESSION['uid'];
	}
	
	$username = $dbh->query("SELECT c.fname
			FROM customer c
			WHERE c.id = '$uid'");
	
	$username->setFetchMode(PDO::FETCH_ASSOC);
	
	$username = $username->fetch();
?>
	<div class="mycart-plugin-content">
		<h2><?php echo($username['fname']);?>'s Order Summary</h2>
		<?php 
		$coh = $dbh->query("SELECT COUNT(*) AS NumOrders
				FROM `order` o
				WHERE o.id = '$oid'
				AND o.customerId = '$uid'");
		
		$coh->setFetchMode(PDO::FETCH_ASSOC);
		
		$ord = $coh->fetch();
		
		if($ord['NumOrders'] != 0)
		{
		?>
			<h3>Order #<?= str_pad($oid, 6, '0', STR_PAD_LEFT); ?></h3>
			<table>
				<thead>
					<tr>
						<td>Date Ordered</td>
						<td>Delivery Address</td>
						<td>Paypal Transaction</td>
						<td>Order Status</td>
					</tr>
				</thead>
				<tbody>
			<?php
			$order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, o.id, o.deliveryAddr, o.paypalId
					FROM `order` o
					WHERE o.id = '$oid'
					AND o.customerId = '$uid'");
			
			$order->setFetchMode(PDO::FETCH_ASSOC);
			
			while($oItem = $order->fetch())
			{
				echo("<tbody><tr>");
				$date = $oItem['dateTimeOrdered'];
				$newDate = date("d-m-Y", strtotime($date));
				echo("<td>" . $newDate . "</td>");
				echo("<td>" . $oItem['deliveryAddr'] . "</td>");
				echo("<td>" . $oItem['paypalId'] . "</td>");
				echo("<td><span class='mycart-plugin-warning'>Processing</span></td>");
				echo("</tr></tbody>");
			}
			?>
			</table>
			<h3>Products</h3>
			<table>
				<thead>
					<tr>
						<td>Item No.</td>
						<td>Item</td>
						<td>Options</td>
						<td>Quantity</td>
						<td>Sale Price</td>
						<td>Sub Total</td>
					</tr>
				</thead>
				<tbody>
				<?php
				$products = $dbh->query("SELECT p.id, p.name, pv.description, pc.cost, po.quantity
						FROM product p, product_order po, product_cost pc, product_variation pv 
						WHERE po.orderId = '$oid'
						AND po.productId = p.id
						AND po.productVarId = pv.id
						AND po.productId = pc.productId");
				
				$products->setFetchMode(PDO::FETCH_ASSOC);
				
				$runningTotal = 0;
				
				while($product = $products->fetch())
				{
					echo("<tr>");
					echo("<td>" . $product['id'] . "</td>");
					echo("<td><a role='link' href='products-show.php?id=" . $product['id'] . "'>" . $product['name'] . "</a></td>");
					echo("<td>" . $product['description'] . "</td>");
					echo("<td>" . $product['quantity'] . "</td>");
					echo("<td>$ " . number_format($product['cost'], 2) . "</td>");
					echo("<td>$ " . number_format($product['cost'] * $product['quantity'], 2) . "</td>");
					echo("</tr>");
					
					$runningTotal += $product['cost'] * $product['quantity'];
				}
				?>
				</tbody>
			</table>
			<?php
			echo("<h3>Total: $" . number_format($runningTotal, 2) . "</h3>");
		}
		else
		{
			echo("<h2>Uh Oh there has been an error.</h2>");
		}
		?>
		<p><a role="link" href='my-account.php'>Back to My Account</a></p>
		<div class="mycart-plugin-clearfix"></div>
	</div><!-- end mycart-plugin-content -->