<?php include("../includes/cms-header.inc.php"); ?>
	<div class="body-content">
		<div class="wrapper clearfix">
			<h2>Welcome Admin!</h2>
			
			<?php 
			
			require('../includes/db.inc.php');
			
			$sth = $dbh->query("SELECT COUNT(*) AS NumOrders
							FROM `order`
							WHERE dateTimeSent IS NULL");
			
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			
			$result = $sth->fetch();
			
			if($result['NumOrders'] <= 0)
			{
				echo('<p>You have no new orders that need dispatching.</p>');
			}
			else
			{
				echo('<p>You have <span class="text-danger">' . $result['NumOrders'] . '</span> orders that need dispatching <a href="orders.php" class="btn btn-xs btn-primary">View Orders</a></p>');
			}
			?>
			
			<?php 
			$sth = $dbh->query("SELECT p.name, pv.description, p.id
							FROM product_variation pv, product p
							WHERE pv.productID = p.id
							AND p.archive = 1
							AND pv.quantity = 0");

			$sth->setFetchMode(PDO::FETCH_ASSOC);
			
			while( $product = $sth->fetch() )
			{
				echo('<p><a href="products-edit.php?id=' . $product['id'] . '">' . $product['name'] . '</a> is <a href="products-edit.php?id=' . $product['id'] . '"><span class="btn btn-xs btn-danger">currently out of stock</span></a> of ' . $product['description'] . '</p>');
			}
			?>
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>