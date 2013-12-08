<?php
	$name1 = $_POST['var1'];
	$name2 = $_POST['var2'];
?>
<div class='mycart-wrapper'>
	<div class="mycart-header" style="<?=$header;?>">
		<p>a different menu that was auto-generated</p>
	</div>
	<div class="mycart-greeting" style="">
		<p>Greetings, <?=$name1?> & <?=$name2?></p>
	</div>

	<div class="mycart-products">
		<a href="product.php?id=1" class="mycart-product-link">Product 1</a><br />
		<a href="product.php?id=2" class="mycart-product-link">Product 2</a><br />
		<a href="product.php?id=3" class="mycart-product-link">Product 3</a><br />
	</div>
</div>