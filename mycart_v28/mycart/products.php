<?php 
	include('includes/header.inc.php');
?>
<!--

	SHOP DIV
	
 -->
 <div class="mycart-plugin">	
	<?php 
		include('includes/db.inc.php');
		include('includes/nav.inc.php');
	?>	
	<div class="mycart-plugin-content mycart-plugin-clearfix">
	<?php
	//if no id is found display random products, if id is found display products with that id 
	$id = isset($_GET['id']) ? $_GET['id'] : null;
	
	if(!$id)
	{
		//expecting to change this to another layout later (shows pecials or newly updated products.)
		/*$sth = $dbh->query("SELECT distinct p.id AS Product, p.name, p.image, c.id, c.description, c.parentId, pc.productId, pc.categoryId, pp.productId, pp.dateTime, pp.cost
				FROM product p, category c, product_category pc, product_cost pp
				WHERE p.id = pc.productId
				AND c.id = pc.categoryId
				AND p.id = pp.productId
				ORDER BY RAND()
				LIMIT 0,6");*/
		
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
				ORDER BY product.dateTime DESC
				LIMIT 0,6");
	
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		
		//this $i variable is to distinguish which divs are the middle
		$i = 2;
		
		// populate list with categories
		while($row = $sth->fetch() )
		{
			?>
				<div class="mycart-plugin-product-grid">
					<a href="products-show.php?id=<?php echo($row['id']);?>">
						<img src="<?php echo($row['image']);?>"></img>
						<p><?php echo($row['name']);?></p>
					</a>
						<p>$<?php echo($row['cost']);?></p>
				</div>
			<?php
		}		
	}
	else
	{
		/*$sth = $dbh->query("SELECT p.id AS Product, p.name, p.image, c.id, c.description, c.parentId, pc.productId, pc.categoryId, pp.productId, pp.dateTime, pp.cost
				FROM product p, category c, product_category pc, product_cost pp
				WHERE p.id = pc.productId
				AND c.id = pc.categoryId
				AND p.id = pp.productId
				AND c.id = $id");*/

		$sth = $dbh->query("SELECT id, name, cost, image, dateTime

								FROM (
								SELECT p.id, p.name, p.image, pp.cost, pp.dateTime
								FROM product p, category c, product_category pc, product_cost pp
								WHERE p.id = pc.productId
								AND c.id = pc.categoryId
								AND p.archive = 1
								AND p.id = pp.productId
								AND c.id = '$id'
								ORDER BY pp.dateTime DESC
								) product

								GROUP BY product.id
								ORDER BY product.dateTime DESC");

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		
		//this $i variable is to distinguish which divs are the middle
		$i = 2;
		
		// populate list with categories
		while($row = $sth->fetch() )
		{
			?>			
			<div class="mycart-plugin-product-grid">
				<a href="products-show.php?id=<?php echo($row['id']);?>">
					<img src="<?php echo($row['image']);?>"></img>
					<p><?php echo($row['name']);?></p>
				</a>
					<p>$<?php echo($row['cost']);?></p>
			</div>
			<?php 
		}
	}
	?>
	</div>
	<div class="clearfix"></div>
</div><!-- mycart plugin -->
<?php 
	include('includes/footer.inc.php');
?>