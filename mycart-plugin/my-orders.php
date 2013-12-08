<?php
	session_start();
	include('includes/db.inc.php');
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
			<h4>Order #<?= str_pad($oid, 6, '0', STR_PAD_LEFT); ?></h4>
			<table class="mycart-plugin-orders-table">
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
				echo("<td>");
					if($oItem['dateTimeSent'] == Null)
                    {
                        echo('<span class="mycart-plugin-warning">Processing</span>');
                    }
                    else
                    {
                        echo('<span class="mycart-plugin-success">Dispatched</span>');
                    }
				echo("</td>");
				echo("</tr></tbody>");
			}
			?>
			</table>
			<h4>Products</h4>
			<table class="mycart-plugin-cart-table">
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
				/*$products = $dbh->query("SELECT p.id, p.name, pv.description, pc.cost, po.quantity
						FROM product p, product_order po, product_cost pc, product_variation pv 
						WHERE po.orderId = '$oid'
						AND po.productId = p.id
						AND po.productVarId = pv.id
						AND po.productId = pc.productId"); - this works */

				$products = $dbh->query("SELECT id, name, description, cost, quantity, dateTime
		
									FROM (
										SELECT p.id, p.name, pv.description, po.quantity, pc.cost, pc.dateTime
										FROM product p, product_order po, product_cost pc, product_variation pv
										WHERE po.orderId = '$oid'
										AND po.productId = p.id
										AND po.productVarId = pv.id
										AND po.productId = pc.productId
										AND pc.dateTime <= '$date'
										ORDER BY pc.dateTime DESC 
									) product
			
									GROUP BY product.id
									ORDER BY product.dateTime DESC");

				$products->setFetchMode(PDO::FETCH_ASSOC);
				
				$runningTotal = 0;
				
				while($product = $products->fetch())
				{
					echo("<tr>");
					echo("<td>" . $product['id'] . "</td>");
					echo("<td><a role='link' class='mycart-plugin-page-link' href='mycart-plugin/products-show.php?id=" . $product['id'] . "'>" . $product['name'] . "</a></td>");
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
			<div class="mycart-plugin-cart-bottom">
				<h4>Total &dollar;<?= number_format($runningTotal, 2) ?></h4>
				<p><a role="link" class="mycart-plugin-page-link" href='mycart-plugin/my-account.php'>Back to My Account</a></p>
			</div>
			<?php
		}
		else
		{
			echo("<h2>Uh Oh there has been an error.</h2>");
		}
		?>
		<div class="mycart-plugin-clearfix"></div>
	</div><!-- end mycart-plugin-content -->
	<script src="mycart-plugin/js/store.js"></script>
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

	$(".mycart-plugin .mycart-plugin-page-link").on('click', {
		vars: {}, // leave blank if empty
		method: 'post'
	}, CallPage);
	</script>