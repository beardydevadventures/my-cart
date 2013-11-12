<?php include("../includes/cms-header.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Shipping Rates</h2>
				</div>
			</div><!-- end page-heading clear-fix -->
			<h4 class="inline">View Shipping Rates</h4><a href="shipping-edit.php"><i class="icon-edit"></i> Edit</a>
			<table class="shipping table table-hover">
				<thead>
					<tr>
						<td>Australia</td>
						<td></td>
						<td><i class="icon-globe"></i> International</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<tr class="row-link">
						<td>Standard Shipping Rate</td>
						<td><a href="shipping-edit.php">$10.00</a></td>
						<td>International Shipping Rate</td>
						<td><a href="shipping-edit.php">$20.00</a></td>
					</tr>
					<tr class="row-link">
						<td>Heavy Shipping Rate</td>
						<td><a href="shipping-edit.php">$20.00</a></td>
						<td>International Heavy Shipping Rate</td>
						<td><a href="shipping-edit.php">$30.00</a></td>
					</tr>
				</tbody>
			</table>
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>