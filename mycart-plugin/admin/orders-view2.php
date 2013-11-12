<?php include("../includes/cms-header.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Orders</h2>
				</div>
				<div class="page-nav">
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
			<h4>View Order</h4>
			<div class="panel panel-default">
				<div class="panel-heading">Order Details</div>
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
						<tr>
							<td><a href="#"># 1322</a></td>
							<td>14 June, 2013</td>
							<td>Stan Smith</td>
							<td><span class="text-success">Dispatched</span></td>
							<td>$64.99</td>
						</tr>
					</tbody>
				</table>
			</div><!-- end panel -->
			

			<div class="panel panel-default">
				<div class="panel-heading">Order Products</div>
				<table class="orders table table-hover">
					<thead>
						<tr>
							<td>Product</td>
							<td>Option</td>
							<td>Quantity</td>
							<td>Sub Total</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Denim Jeans</td>
							<td>Size 32</td>
							<td>1</td>
							<td>$29.99</td>
						</tr>
						<tr>
							<td>AFL Cap</td>
							<td>San Francisco 49ers</td>
							<td>1</td>
							<td>$15.99</td>
						</tr>
					</tbody>
				</table>
			</div><!-- end panel -->

			<div class="panel panel-primary pull-left">
				<div class="panel-heading">Order Shipping Address</div>
				<div class="panel-body">
					Stan Smith<br>
					456 Real Rd <br>
					West End<br>
					4001 <br>
					Australia
				</div>
			</div><!-- end panel -->

			<div class="panel panel-success pull-left dispatch-notice" style="margin-left: 20px;">
				<div class="panel-heading">Order Dispatched</div>
				<div class="panel-body min-height">
					<a class="btn btn-success disabled" data-toggle="modal" href="#myModal"><i class="icon-check"></i> Dispatched</a>
				</div>
			</div>


			
			<div class="clearfix"></div>

		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>