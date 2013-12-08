<?php
// creates a new product or edits product if id is given
require('../includes/db.inc.php');

$id = isset($_POST['inputid']) ? $_POST['inputid'] : header("Location: ../admin/products.php");

$pname = isset($_POST['inputName']) ? $_POST['inputName'] : header("Location: ../admin/products-edit.php?id=$id");
$pcat = isset($_POST['inputCategory']) ? $_POST['inputCategory'] : header("Location: ../admin/products-edit.php?id=$id");
$pdesc = isset($_POST['inputDescription']) ? $_POST['inputDescription'] : header("Location: ../admin/products-edit.php?id=$id");
$pprice = isset($_POST['inputPrice']) ? $_POST['inputPrice'] : header("Location: ../admin/products-edit.php?id=$id");
$dateTime = date("Y-m-d H:i:s");
$pfile = $_FILES['fileToUpload'];

//if no id was given create new product and add new lines to tables and use this id
if($id == "")
{
	//create new entry in product table and get id
	$sth = $dbh->query("INSERT INTO product
			SET name = '$pname',
			description = '$pdesc',
			archive = '1'");

	$id = $dbh->lastInsertId();
	
	//create new entry in product category table
	$sth = $dbh->query("INSERT INTO product_category
			(categoryId, productId)
			VALUES
			('$pcat', '$id')");
}
else
{
	//update product table
	$sth = $dbh->query("UPDATE product
			SET name = '$pname',
			description = '$pdesc'
			WHERE id = '$id'");
	
	//update product category table
	$sth = $dbh->query("UPDATE product_category
			SET categoryId = '$pcat'
			WHERE productId = '$id'");
}

//sets price of product
$sth = $dbh->query("INSERT INTO product_cost 
					SET	productId = '$id',
					dateTime = '$dateTime',
					cost ='$pprice'");

//changes the image or ignores if no new image was given
if($pfile['error'] == 0)
{
	$pfile = $_FILES['fileToUpload'];
	
	$fn = $pfile['name'];
	
	$ext = pathinfo($fn, PATHINFO_EXTENSION);
	
	$fn= "$fn";
	
	$path = "../img/product-images/$fn";
	
	$dbpath = "img/product-images/$fn";
	
	if(copy($pfile['tmp_name'], $path))
	{
		$sth = $dbh->query("UPDATE product
				SET image='$dbpath'
				WHERE id = '$id'");
	}
	else
	{
		echo("didn't copy!");
	}
} 
else
{
	$pfile['error'];
}

//gets all the variations as arrays and goes through adding them or updating them in the database
$pid = isset($_POST['inputId']) ? $_POST['inputId'] : header("Location: ../admin/products-edit.php?id=$id");
$popt = isset($_POST['inputOption']) ? $_POST['inputOption'] : header("Location: ../admin/products-edit.php?id=$id");
$pqnt = isset($_POST['inputQuantity']) ? $_POST['inputQuantity'] : header("Location: ../admin/products-edit.php?id=$id");

for($i = 0; $i < count($popt); $i++)
{
	if($popt[$i] != '' || $pqnt[$i] != '')
	{
		if(isset($pid[$i]))
		{
			$popt[$i];
			$pqnt[$i];
			$sth = $dbh->query("UPDATE product_variation
					SET quantity='$pqnt[$i]'
					WHERE id = '$pid[$i]'
					AND description = '$popt[$i]'");
		}
		else
		{
			$sth = $dbh->query("INSERT INTO product_variation
					SET quantity='$pqnt[$i]',
					description = '$popt[$i]',
					productId = '$id',
					archive = '1'");
		}
	}
}

header("Location: ../admin/products-edit.php?id=" . $id);
?>























