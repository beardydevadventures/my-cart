<?php include("../includes/cms-header.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="page-head clearfix">
				<div class="page-heading">
					<h2>Products</h2>
				</div>
				<div class="page-nav">
					<div class="page-nav-1">
						<a href="products-edit.php" class="btn btn-success"><i class="fa fa-plus"></i> Create New Product</a>
					</div><!--  end page-nav-1 -->
					<div class="page-nav-2">
						<div class="input-group">
							<input type="search" class="form-control" placeholder="Search Orders"/>
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
						</div><!-- end input-group -->
					</div><!-- end page-nav-2 -->
				</div><!-- end page-nav -->
			</div><!-- end page-head clear-fix -->
			<h4 class="inline">View All Products</h4>
			<table class="products table table-hover">
				<thead>
					<tr>
						<td>Image</td>
						<td>Item</td>
						<td>Quantity</td>
						<td>Retail Price</td>
						<td>Sale Price</td>
						<td>Remove</td>
					</tr>
				</thead>
				<?php 
				require('../includes/db.inc.php');
				
				//gets the products as well as its most recent price
				$dateTime = date("Y-m-d H:i:s");
				
				$sth = $dbh->query("SELECT id, name, cost, image, dateTime

								FROM (
								SELECT p.id, p.name, p.image, pp.cost, pp.dateTime
								FROM product p, category c, product_category pc, product_cost pp
								WHERE p.id = pc.productId
								AND c.id = pc.categoryId
								AND p.archive = 1
								AND p.id = pp.productId
								ORDER BY pp.dateTime DESC
								) product
								
								GROUP BY product.id
								ORDER BY product.dateTime DESC");
	
				$sth->setFetchMode(PDO::FETCH_ASSOC);
				?>
				<tbody>
				<?php 
				//echoes each prdocut onto the page
				while($product = $sth->fetch() )
				{
				?>
					<tr class="row-link">
						<td><img src="../<?php echo($product['image']);?>" height="50" width="40"/></td>
						<td><a href="products-edit.php?id=<?php echo($product['id']);?>"><?php echo($product['name']);?></a></td>
						<?php
						//gets the lowest val of products 
						$prodId = $product['id'];
						
						$vth = $dbh->query("SELECT quantity
										FROM product_variation
										WHERE productId = '$prodId'
										ORDER BY quantity ASC");

						$vth->setFetchMode(PDO::FETCH_ASSOC);
						
						$varAm = $vth->fetch();
						
						if($varAm['quantity'] <= 0 )
						{
							echo( '<td><span class="label label-danger" style="opacity: .7;">Out of Stock</span></td>' );
						}
						elseif($varAm['quantity'] > 0 && $varAm['quantity'] <= 5)
						{
							echo( '<td><span class="label label-warning" style="opacity: .7;">Low</span></td>' );
						}
						elseif($varAm['quantity'] > 5 )
						{
							echo( '<td><span class="label label-success" style="opacity: .7;">In Stock</span></td>' );
						}
						
						?>
						<td>$<?php echo($product['cost']);?></td>
						<td>$<?php echo($product['cost']);?></td>
						<td><button class="btn btn-danger btn-sm remove" productId="<?php echo($product['id']);?>" productName="<?php echo($product['name']);?>"><i class="fa fa-times"></i></button></td>
					</tr>				
				<?php 
				}
				?>
				</tbody>
			</table>

			<!-- modal for remove product -->
			<div class="modal fade" id="removeProductModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-cross"></i></button>
							<h4 class="modal-title">Remove Product</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure you want to remove <b id="prodremName">Blaq Shirt</b> from your store?</p>
						</div>
						<div class="modal-footer">
							<button id="btn-remove" class="btn btn-lg btn-success"><i class="fa fa-trash-o"></i> Remove</button>
							<button class="btn btn-lg btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</div><!-- end modal-content -->
				</div><!-- end modal-dialog -->
			</div><!-- end modal -->

		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>