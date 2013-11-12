<?php include("../includes/cms-header.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Shipping Rates</h2>
				</div>
			</div><!-- end page-heading clear-fix -->
			<h4>Edit Shipping Rates</h4>
			<form action="shipping.php" method="POST">
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
						<tr>
							<td>Standard Shipping Rate</td>
							<td><input type="text" class="form-control decimal" value="10.00"/></td>
							<td>International Shipping Rate</td>
							<td><input type="text" class="form-control decimal" value="20.00"/></td>
						</tr>
						<tr>
							<td>Heavy Shipping Rate</td>
							<td><input type="text" class="form-control decimal" value="20.00"/></td>
							<td>International Heavy Shipping Rate</td>
							<td><input type="text" class="form-control decimal" value="30.00"/></td>
						</tr>
					</tbody>
				</table>
				<button type="submit" class="btn btn-success">Update</button>
				<a class="btn btn-default" href="shipping.php"> Cancel</a>
			</form>
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>