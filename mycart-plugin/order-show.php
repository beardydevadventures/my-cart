<?php
	include('includes/header.inc.php');
	
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
<div class="cart-page clearfix">
	<h2><?php echo($username['fname']);?> Orders</h2>
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
		<ul>
			<li>Order No.</li>
			<li>Time Ordered</li>
			<li>Sent</li>
			<li>Delivery Addr</li>
			<li>Paypal Transaction Id</li>
		</ul>
		<?php
		$order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, o.id, o.deliveryAddr, o.paypalId
				FROM `order` o
				WHERE o.id = '$oid'
				AND o.customerId = '$uid'");
		
		$order->setFetchMode(PDO::FETCH_ASSOC);
		
		while($oItem = $order->fetch())
		{
			echo("<ul>");
			echo("<li>" . $oItem['id'] . "</li>");
			echo("<li>" . $oItem['dateTimeOrdered'] . "</li>");
			echo("<li>" . $oItem['dateTimeSent'] . "</li>");
			echo("<li>" . $oItem['deliveryAddr'] . "</li>");
			echo("<li>" . $oItem['paypalId'] . "</li>");
			echo("</ul>");
		}
		?>
		<h2>Products</h2>
		<ul>
			<li>Product No.</li>
			<li>Title</li>
			<li>Description</li>
			<li>Cost</li>
			<li>Quantity</li>
		</ul>
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
			echo("<a href='products-show.php?id=" . $product['id'] . "'><ul>");
			echo("<li>" . $product['id'] . "</li>");
			echo("<li>" . $product['name'] . "</li>");
			echo("<li>" . $product['description'] . "</li>");
			echo("<li>$ " . $product['cost'] . "</li>");
			echo("<li>" . $product['quantity'] . "</li>");
			echo("</ul></a>");
			
			$runningTotal += $product['cost'] * $product['quantity'];
		}
		
		echo("<h2>Total: $$runningTotal</h2>");
		
	}
	else
	{
		echo("<h2>Uh Oh there has been an error.</h2>");
	}
	?>
</div>
<?php
	include('includes/footer.inc.php');
?>