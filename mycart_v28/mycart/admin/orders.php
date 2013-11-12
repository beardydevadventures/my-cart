<?php include("../includes/cms-header.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Orders</h2>
				</div>
				<div class="page-nav">
					<div class="page-nav-1">
						<select class="form-control">
							<option>View All Orders</option>
							<option>Sort by Undispatched</option>
							<option>Sort by Date Ordered</option>
						</select>
					</div>
					<div class="page-nav-2">
						<div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="icon-search"></i></button>
							</span>
							<input type="search" class="form-control" placeholder="Search Orders"/>
						</div><!-- end input-group -->
					</div>
				</div><!-- end page-nav -->
			</div><!-- end page-heading clear-fix -->
			<h4>View All Orders</h4>
			<table class="orders table table-hover">
				<thead>
					<tr>
						<td>Order Number</td>
						<td>Date Ordered</td>
						<td>Customer</td>
						<td>Order Status</td>
						<td>Total Cost</td>
					</tr>
				</thead>
				<tbody>
					<?php 
					include('../includes/db.inc.php');
					
					$order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, c.fname, c.lname
							FROM `order` o, customer c
							WHERE o.customerId = c.id");
					
					$order->setFetchMode(PDO::FETCH_ASSOC);
					
					while($oItem = $order->fetch())
					{
						echo("<tr class='row-link'>");
						echo('<td><a class="order-link" href="orders-view.php?id=' . $oItem['id'] . '"> # ' . $oItem['id'] . "</td>");
						echo("<td>" . date("d F, Y", strtotime($oItem['dateTimeOrdered'])) . "</td>");
						echo("<td>" . $oItem['fname'] . " ". $oItem['lname'] . "</td>");
						echo("<td>"); 
						if($oItem['dateTimeSent'] == Null)
						{
							echo('<span class="label label-danger">Not ready</span>');
						}
						else
						{
							echo('<span class="label label-success">Dispatched</span>');
						}
						echo("</td>");
						
						$ordId = $oItem['id'];
						
						$products = $dbh->query("SELECT pc.cost, po.quantity
								FROM product p, product_order po, product_cost pc, product_variation pv
								WHERE po.orderId = '$ordId'
								AND po.productId = p.id
								AND po.productVarId = pv.id
								AND po.productId = pc.productId");
						
						$products->setFetchMode(PDO::FETCH_ASSOC);
				
						$runningTotal = 0;
				
						while($product = $products->fetch())
						{
							$runningTotal += $product['cost'] * $product['quantity'];
						}
						
						echo("<td>$$runningTotal</td>");
						echo("</tr>");
					}
					?>
				</tbody>
			</table>
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>