<?php 
	include('includes/db.inc.php');
	include('includes/colorArray.inc.php');
	include('includes/nav.inc.php');
?>	
<div class="mycart-plugin-content mycart-plugin-clearfix">
<?php
//if no id is found display random products, if id is found display products with that id 
$id = isset($_GET['id']) ? $_GET['id'] : null;

if(!$id)
{
	//expecting to change this to another layout later (shows pecials or newly updated products.)	
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
				<a class="mycart-plugin-page-link" href="mycart-plugin/products-show.php?id=<?php echo($row['id']);?>">
					<img src="mycart-plugin/<?php echo($row['image']);?>"></img>
					<p style="font-family: <?php echo($colArray['body-font']); ?> !important;"><?php echo($row['name']);?></p>
				</a>
				<p style="font-family: <?php echo($colArray['body-font']); ?> !important;">$<?php echo($row['cost']);?></p>
			</div>
		<?php
	}		
}
else
{
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
			<a class="mycart-plugin-page-link" href="mycart-plugin/products-show.php?id=<?php echo($row['id']);?>">
				<img src="mycart-plugin/<?php echo($row['image']);?>"/>
				<p style="font-family: <?php echo($colArray['body-font']); ?> !important;"><?php echo($row['name']);?></p>
			</a>
				<p style="font-family: <?php echo($colArray['body-font']); ?> !important;">$<?php echo($row['cost']);?></p>
		</div>
		<?php 
	}
}
?>
</div>
<div class="clearfix"></div>
<script type="text/javascript" src="mycart-plugin/js/store.js"></script>

<script>
function CallPage(e) {
	e.preventDefault();
	var data = e.data;
	console.log(e.currentTarget.href);
	$.ajax({
		url: e.currentTarget.href,
		type: data.method,
		data: data.vars,
		dataType: 'html',
		success: function(data) {
			$(".mycart-plugin-store").html(data);
		}
	});
}

$(".mycart-plugin .mycart-plugin-page-link").on('click', {
	vars: {}, // leave blank if empty
	method: 'post'
}, CallPage);
</script>