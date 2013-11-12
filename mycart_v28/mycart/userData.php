<?php
	include('includes/header.inc.php');
	
	if(!isset($_SESSION['uid']))
	{
		header('Location: signup.php');
	} 
	else
	{
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
	<ul>
		<li>Order No.</li>
		<li>Time Ordered</li>
		<li>Sent</li>
		<li>Delivery Addr</li>
		<li>PaypalId</li>
	</ul>
	<?php 
	$order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, o.id, o.deliveryAddr, o.paypalId
			FROM `order` o
			WHERE o.customerId = '$uid'");
	
	$order->setFetchMode(PDO::FETCH_ASSOC);
	
	while($oItem = $order->fetch())
	{
		echo("<a href='order-show.php?oid=" . $oItem['id'] . "'><ul>");
		echo("<li>" . $oItem['id'] . "</li>");
		echo("<li>" . $oItem['dateTimeOrdered'] . "</li>");
		echo("<li>" . $oItem['dateTimeSent'] . "</li>");
		echo("<li>" . $oItem['deliveryAddr'] . "</li>");
		echo("<li>" . $oItem['paypalId'] . "</li>");
		echo("</ul></a>");
	}
	?>
</div>
<?php
	include('includes/footer.inc.php');
?>