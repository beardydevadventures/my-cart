<?php 
include("../includes/cms-header.inc.php"); 

$srt = isset($_GET['srt']) ? $_GET['srt'] : '';
$srch = isset($_GET['srch']) ? $_GET['srch'] : '';
?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Orders</h2>
				</div>
				<div class="page-nav">
					<div class="page-nav-1">
						<form action='orders.php' method='get'>
							<select class="form-control" name="srt" onchange='this.form.submit()'>
								<option>Sort By</option>
								<option value="DESC">Sort by Dispatched</option>
								<option value="ASC">Sort by Undispatched</option>
								<option value="">Sort by Date Ordered</option>
							</select>
						</form>
					</div>
					<div class="page-nav-2">
						<div class="input-group">
							<form action='orders.php' method='get'>
								<input type="search" class="form-control" name="srch" onchange='this.form.submit()' placeholder="Search Orders"/>
							</form>	
								<span class="input-group-addon">
									<i class="fa fa-search"></i>
								</span>
						</div><!-- end input-group -->
					</div>
				</div><!-- end page-nav -->
			</div><!-- end page-heading clear-fix -->
			<h4 class="inline">View All Orders</h4>
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
					if($srch != '')
					{
						$order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, c.fname, c.lname
								FROM `order` o, customer c
								WHERE o.customerId = c.id
								AND (c.fname LIKE '%$srch%' OR o.id LIKE '%$srch%')
								");
					}
					else if($srt != '')
					{
						$order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, c.fname, c.lname
								FROM `order` o, customer c
								WHERE o.customerId = c.id
								ORDER BY o.dateTimeSent $srt");
					}
					else
					{
						$order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, c.fname, c.lname
								FROM `order` o, customer c
								WHERE o.customerId = c.id");
					}
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