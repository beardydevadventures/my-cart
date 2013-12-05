	<?php 
	//gets product id from header, if no id then sends user back to the view products page
	$id = isset($_GET['id']) ? $_GET['id'] : null;
	
	if(!$id)
	{
		header('Location: products.php');
	}
	else
	{
		//inputs mycart nav and gets db
		//include('includes/cart.inc.php');
		include('includes/db.inc.php');
		include('includes/colorArray.inc.php');
		include('includes/nav.inc.php');
		
		/*$sth = $dbh->query("SELECT p.id, p.description, p.name, p.image, p.quantity, pp.productId, pp.dateTime, pp.cost
				FROM product p, product_cost pp
				WHERE p.id = pp.productId
				AND p.id = $id");*/
		
		$sth = $dbh->query("SELECT id, name, image, description, cost, image, dateTime
		
								FROM (
								SELECT p.id, p.name, p.image, pp.cost, pp.dateTime, p.description
								FROM product p, category c, product_category pc, product_cost pp
								WHERE p.id = pc.productId
								AND c.id = pc.categoryId
								AND p.archive = 1
								AND p.id = pp.productId
								AND p.id = '$id'
								ORDER BY pp.dateTime DESC
								) product
		
								GROUP BY product.id
								ORDER BY product.dateTime DESC");
		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		
		$row = $sth->fetch();
	?>
		<div class="mycart-plugin-content mycart-plugin-clearfix">
			<div class="mycart-plugin-product-left">	
				<a class="fancybox-effects-b" href="mycart-plugin/<?php echo($row['image']);?>" data-fancybox-group="gallery" title="<?php echo($row['name']);?>"><img src="mycart-plugin/<?php echo($row['image']);?>" alt="" style="max-height: 350px;"/></a>
			</div>
			<div class="mycart-plugin-product-right">
				<form class="mycart-plugin-form-submit" action='mycart-plugin/products-show.php' method='get'>
					<h1><?php echo($row['name']);?></h1>
					<h2>$<?php echo($row['cost']);?></h2>
					<?php 
					//find another way to do quanitity
					/*if($row['quantity'] <= 0)
					{
						echo('<p class="mycart-plugin-danger">(out-of-stock)</p>');
					}
					else if($row['quantity'] > 0 && $row['quantity'] < 5) 
					{
						echo('<p class="mycart-plugin-warning">(low-stock)</p>');
					}
					else
					{*/
						echo('<p class="mycart-plugin-success">(in-stock)</p>');
					//}
					?>
					<div class="mycart-plugin-form-group">
						<select class="mycart-plugin-select-option" name='vr' id='vr'>
						<?php 
						$opsth = $dbh->query("SELECT p.id, pv.productId, pv.description, pv.id AS Var
								FROM product p, product_variation pv
								WHERE p.id = pv.productId
								AND pv.archive = '1'
								AND p.id = $id");
						
						$opsth->setFetchMode(PDO::FETCH_ASSOC);
						echo("<option value='' selected='selected'>Please select ... </option>");
						while($oprow = $opsth->fetch())
						{
							echo("<option value='" . $oprow['Var'] . "'>" . $oprow['description'] . "</option>");
						}
						?>
						</select>
					</div>
					<div class="mycart-plugin-form-group">
						<label>Qty <input class="mycart-plugin-input-text-small" type="text" name='qt' id='qt' value="1" size="3" maxlength="3" /><input type='hidden' name='id' id='id' value='<?php echo($id); ?>'></label>
					</div>
					<div class="mycart-plugin-form-group">
						<button class="mycart-plugin-btn-success" type="submit">Add to cart</button>
						<a class='mycart-plugin-hide mycart-plugin-page-link mycart-plugin-a-button' href='mycart-plugin/cart.php'>Added to cart. Checkout Now!</a>
					</div>
				</form>
			</div>
			<div class="mycart-plugin-clearfix"></div>
			<?php echo("<p>" . $row['description'] . "</p>"); ?>
		</div>
	<?php 
	}
	?>
	<script type="text/javascript" src="mycart-plugin/js/store.js"></script>
	<script>
	function CallPage(e) {
		e.preventDefault();
		var data = e.data;
		console.log(data.method);
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

	function CallForm(e) {
		$(".mycart-plugin .mycart-plugin-a-button").addClass("mycart-plugin-show");
		e.preventDefault();
		var data = e.data.vars;
		var qt = $("#qt").val();
		var vr = data.vr.options[data.vr.selectedIndex].value;
		console.log(qt);

		url = 'mycart-plugin/includes/cart.inc.php?id=' + data.id + "&vr=" + vr + "&qt=" + qt
		console.log(url);
		$.ajax({
			url: url,
			type: data.method,
			dataType: 'text',
			success: function(d) {
				console.log("Product " + data.id + " added!");
				console.log("CART TOTAL = " + d);
				$.ajax({
					url: "mycart-plugin/mycart-plugin-cart.php",
					dataType: 'html',
					success: function(data){
						$(".mycart-plugin-cart").html(data);
					}
				});
			}
		});
	}

	$(".mycart-plugin .mycart-plugin-page-link").on('click', {
		vars: { }, // leave blank if empty
		method: 'post'
	}, CallPage);

	$(".mycart-plugin .mycart-plugin-form-submit").on('submit', {
		vars: {
			id: document.getElementById("id").value,
			vr: document.getElementById("vr"),
			qt: document.getElementById("qt").value
		},
		method: 'post'
	}, CallForm);
	</script>