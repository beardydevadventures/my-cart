<?php
	session_start();
	ob_start();
	
	//includes database here and on the main section of mycart.
	include("db.inc.php");
	
	//checks to see if user has made cart, makes cart if not, and displays cart contents and total
	
	//total amount of cart to be echoed in checkout
	$_SESSION['total'] = 0.00;
	
	//totals to be echoed out in cart
	$cartItems = 0;
	$cartTot = 0.00;
	
	$isCart = isset($_SESSION['cart']);
	
	if(!$isCart)
	{
		$_SESSION['cart'] = array();
	}
	
	//if an id and quantity are given in the header adds the item to the cart
	$id = isset($_GET['id']) ? $_GET['id'] : null;
	$qt = isset($_GET['qt']) ? $_GET['qt'] : null;
	$var = isset($_GET['vr']) ? $_GET['vr'] : null;
	$item = array();
	
	if($id && $qt && $var)
	{
		array_push($item, $id, $qt, $var);
		array_push($_SESSION['cart'], $item);
	}
	
	$cart = $_SESSION['cart'];
	
	//goes through cart and stores all items into a new array. This is to combines duplicate items in the cart array
	
	//placeholder array
	$a = array();
	
	foreach($cart as $product)
	{
		//no products found
		$found = false;
		
		//goes through $a 
		for($i = 0; $i < count($a); $i++)
		{
			//if product and $a ids match adds the totals together
			if($product[0] == $a[$i][0] && $product[2] == $a[$i][2])
			{
				$a[$i][1] = $product[1] + $a[$i][1];
				$found = true;
			}
		}
		
		//if product is not found in $a adds it to the array
		if(!$found)
		{
			array_push($a, $product);
		}
	}

	//updates cart with new amount from checkout
	$upId = isset($_GET['upd']) ? $_GET['upd'] : null;
	$upQt = isset($_GET['nqt']) ? $_GET['nqt'] : null;
	$upVar = isset($_GET['nvr']) ? $_GET['nvr'] : null;
	
	if($upId && $upQt && $upVar)
	{
		for($i = 0; $i < count($a); $i++)
		{
			//if product value is set to zero or less removes from array
			if($upId == $a[$i][0] && $upQt <= 0)
			{
				unset($a[$i]);
			}
			
			//if product and $a ids and variation match makes new total
			if($upId == $a[$i][0] && $upVar == $a[$i][2])
			{
				$a[$i][1] = $upQt;
			}//else if id an qt are same change variation
			else if($upId == $a[$i][0] && $upQt == $a[$i][1])
			{
				$a[$i][2] = $upVar;
			}	
		}

		//echo("cart-update-ID");
	}
	
	//removes product from cart
	$remId = isset($_GET['rid']) ? $_GET['rid'] : null;
	$remVar = isset($_GET['rvr']) ? $_GET['rvr'] : null;
	if($remId && $remVar)
	{
		for($i = 0; $i < count($a); $i++)
		{
			//if product and $a ids match makes new total
			if($remId == $a[$i][0] && $remVar == $a[$i][2])
			{
				unset($a[$i]);
			}
		}
	}
	
	//adds the new array to cart
	$_SESSION['cart'] = $a;

	//Gets the price for each item from database and totals it up for the cart
	foreach($a as &$item)
	{
		/*$cartsth = $dbh->query("SELECT p.id, pp.productId, pp.cost
							FROM product p, product_cost pp
							WHERE p.id = pp.productId
							AND p.id = '$item[0]'");*/

		$cartsth = $dbh->query("SELECT COUNT(*) AS results, id, name, image, description, cost, image, dateTime
		
								FROM (
								SELECT p.id, p.name, p.image, pp.cost, pp.dateTime, p.description
								FROM product p, category c, product_category pc, product_cost pp
								WHERE p.id = pc.productId
								AND c.id = pc.categoryId
								AND p.archive = 1
								AND p.id = pp.productId
								AND p.id = '$item[0]'
								ORDER BY pp.dateTime DESC
								) product
		
								GROUP BY product.id
								ORDER BY product.dateTime DESC");

		$cartsth->setFetchMode(PDO::FETCH_ASSOC);

		// populate page with products stored in the order array if the quantity has been changed will update with new amount
		$cartrow = $cartsth->fetch();
	
		$cartItems = $cartItems + $item[1];
		
		$cartTot = $cartTot + $cartrow['cost'] * $item[1];
		
		$cartTot = number_format((float)$cartTot, 2, '.', '');
		$_SESSION['total'] = $cartTot;
	}

	// echo("$cartItems|$cartTot");
	//print_r($_SESSION['cart']);
?>