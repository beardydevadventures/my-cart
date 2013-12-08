<?php 
	include("../includes/cms-header.inc.php"); 
	require('../includes/db.inc.php');
?>
	<div class="body-content">
		<div class="wrapper clearfix">
			

			<?php 
			$sth = $dbh->query("SELECT lname
							FROM customer
							WHERE id = " . $_SESSION['admin'] );
							
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			
			$name = $sth->fetch();
			
			echo('<h2>Welcome ' . ucfirst($name['lname']) . '</h2>');
			
			$sth = $dbh->query("SELECT COUNT(*) AS NumOrders
							FROM `order`
							WHERE dateTimeSent IS NULL");
			
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			
			$result = $sth->fetch();
			
			if($result['NumOrders'] <= 0)
			{
				?>
				<div class="panel panel-success">
					<div class="panel-heading">All orders up-to-date</div>
					<div class="panel-body">
						<p>You have no new orders that need dispatching.</p>					
					</div>
				</div>
				<?php
			}
			else
			{
				?>
				<div class="panel panel-danger">
					<div class="panel-heading">Orders to be dispatched</div>
					<div class="panel-body">
						<p>You have <span class="text-danger"><?= $result['NumOrders'] ?></span> orders that need dispatching <a href="orders.php" class="btn btn-xs btn-primary">View Orders</a></p>
					</div>
				</div>
				<?php 
			}
			?>
		
			<?php 
			$sth = $dbh->query("SELECT COUNT(*) as results
							FROM product_variation pv, product p
							WHERE pv.productID = p.id
							AND p.archive = 1
							AND pv.archive = 1
							AND pv.quantity = 0");

			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$productResults = $sth->fetch();
			if($productResults['results'] != 0)
			{
				$sth = $dbh->query("SELECT p.name, pv.description, p.id
								FROM product_variation pv, product p
								WHERE pv.productID = p.id
								AND p.archive = 1
								AND pv.archive = 1
								AND pv.quantity = 0");

				$sth->setFetchMode(PDO::FETCH_ASSOC);
				?>
				<div class="panel panel-danger">
					<div class="panel-heading">Out of stock products</div>
					<div class="panel-body">
				<?php
					while( $product = $sth->fetch() )
					{
						echo('<p><a href="products-edit.php?id=' . $product['id'] . '">' . $product['name'] . '</a> is <a href="products-edit.php?id=' . $product['id'] . '"><span class="btn btn-xs btn-danger">currently out of stock</span></a> of ' . $product['description'] . '</p>');
					}
				?>
					</div>
				</div>
				<?php
			}
			?>
		</div><!-- end wrapper -->
	</div><!-- end body-content -->
<?php include("../includes/cms-footer.inc.php"); ?>