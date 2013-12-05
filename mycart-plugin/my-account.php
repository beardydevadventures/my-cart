<?php
	session_start();
	include('includes/db.inc.php');
	include('includes/colorArray.inc.php');
	include('includes/nav.inc.php');
	
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
	<div class="mycart-plugin-content">
		<h2><?php echo($username['fname']);?>'s Account</h2>
		<table>
			<thead>
				<tr>
					<td>Order No.</td>
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
					WHERE o.customerId = '$uid'");
			
			$order->setFetchMode(PDO::FETCH_ASSOC);
			
			while($oItem = $order->fetch())
			{
				echo("<tbody><tr class='mycart-plugin-row-link'>");
				echo("<td><a href='my-orders.php?oid=" . $oItem['id'] . "'>" . $oItem['id'] . "</a></td>");
				$date = $oItem['dateTimeOrdered'];
				$newDate = date("d-m-Y", strtotime($date));
				echo("<td>" . $newDate . "</td>");
				echo("<td>" . $oItem['deliveryAddr'] . "</td>");
				echo("<td>" . $oItem['paypalId'] . "</td>");
				echo("<td>");
				if($oItem['dateTimeSent'] == Null)
					{
						echo('<span class="mycart-plugin-warning">Processing</span>');
					}
					else
					{
						echo('<span class="mycart-plugin-success">Posted</span>');
					}
				echo("</td>");
				echo("</tr></tbody>");
			}
			?>
			</tbody>
		</table>
		<div class="mycart-plugin-clearfix"></div>
	</div><!-- end mycart-plugin-content -->