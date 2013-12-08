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
						<form class="search-form" action='orders.php' method='get'>
							<div class="input-group">
                        		<input type="search" class="form-control" name="srch" placeholder="Search Orders"/>
								<span class="input-group-btn">
									<button class="btn btn-default"><i class="fa fa-search"></i></button>
								</span>
							</div><!-- end input-group -->
		                </form> 
					</div>
				</div><!-- end page-nav -->
			</div><!-- end page-heading clear-fix -->
			
					<?php 
					include('../includes/db.inc.php');
					if($srch != '')
                    {
                        $order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, c.fname, c.lname
                                FROM `order` o, customer c
                                WHERE o.customerId = c.id
                                AND (c.fname LIKE '%$srch%' OR o.id LIKE '%$srch%')
                                ");

                        $orderResults = $dbh->query("SELECT COUNT(*) as results
                                FROM `order` o, customer c
                                WHERE o.customerId = c.id
                                AND (c.fname LIKE '%$srch%' OR o.id LIKE '%$srch%')
                                ");

                        $orderResults->setFetchMode(PDO::FETCH_ASSOC);
						$orderSearch = $orderResults->fetch();

						echo('<h4 class="inline">Search Orders for "' . $srch . '"</h4>');
                    }
                    else if($srt != '')
                    {
                        $order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, c.fname, c.lname
                                FROM `order` o, customer c
                                WHERE o.customerId = c.id
                                ORDER BY o.dateTimeSent $srt");

                        $orderSearch['results'] = 1;
                        if($srt == 'DESC')
                        {
                        	echo('<h4 class="inline">Sort Orders by Dispatched</h4>');
                        }
                        else
                        {
                        	echo('<h4 class="inline">Sort Orders by Undispatched</h4>');
                        }

                        
                    }
                    else
                    {
 
                        $order = $dbh->query("SELECT o.id, o.dateTimeOrdered, o.dateTimeSent, c.fname, c.lname
                                FROM `order` o, customer c
                                WHERE o.customerId = c.id");

                        $orderSearch['results'] = 1;

                        echo('<h4 class="inline">Sort Orders by Date Ordered</h4>');
                    }
                    
					$order->setFetchMode(PDO::FETCH_ASSOC);

					if($orderSearch['results'] != 0)
					{
					?>
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
						while($oItem = $order->fetch())
						{
							echo("<tr class='row-link'>");
							echo('<td><a class="order-link" href="orders-view.php?id=' . $oItem['id'] . '"> #' . str_pad($oItem['id'] , 6, '0', STR_PAD_LEFT) . "</td>");
							echo("<td>" . date("d F, Y", strtotime($oItem['dateTimeOrdered'])) . "</td>");
							echo("<td>" . $oItem['fname'] . " ". $oItem['lname'] . "</td>");
							echo("<td>"); 
							if($oItem['dateTimeSent'] == Null)
							{
								echo('<span class="label label-danger">Undispatched</span>');
							}
							else
							{
								echo('<span class="label label-success">Dispatched</span>');
							}
							echo("</td>");
							
							$ordId = $oItem['id'];
							$dateOrdered = $oItem['dateTimeOrdered'];
							
							$products = $dbh->query("SELECT id, name, description, cost, quantity, dateTime
		
									FROM (
										SELECT p.id, p.name, pv.description, po.quantity, pc.cost, pc.dateTime
										FROM product p, product_order po, product_cost pc, product_variation pv
										WHERE po.orderId = '$ordId'
										AND po.productId = p.id
										AND po.productVarId = pv.id
										AND po.productId = pc.productId
										AND pc.dateTime <= '$dateOrdered'
										ORDER BY pc.dateTime DESC
									) product
			
									GROUP BY product.id
									ORDER BY product.dateTime DESC");
							
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
					<?php
					}
					else
					{
						echo("<p>No orders founds.</p>");
					}
					?>
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>