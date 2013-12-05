<?php
// creates the categories in the database
require('../includes/db.inc.php');

//cat is a json feed given from the form submit
$cat = isset($_POST['categories']) ? $_POST['categories'] : ""; //header("Location: ../admin/categories.php");

//decode the josn
$cat = json_decode($cat, true);

$sth = $dbh->query("TRUNCATE TABLE category;");
$sth = $dbh->query("ALTER TABLE category AUTO_INCREMENT = 1");

$sth = $dbh->query("INSERT INTO category
		SET	description = 'Main Category',
		parentId = '0'");

//loops through json feed and adds to database
for($i = 0; $i < count($cat['categories']); $i++) 
{
	echo "Category $i is " . $cat['categories'][$i]["catDesc"] . " with the ID parent being " . $cat['categories'][$i]["parentID"] . "<br/>";
	
	//vars to be added to database
	$catName = $cat['categories'][$i]["catDesc"];
	$catParId = $cat['categories'][$i]["parentID"];
	
	//create new entry in product table and get id
	$sth = $dbh->query("INSERT INTO category
			SET	description = '$catName',
			parentId = '$catParId'");
	
	$lid = $dbh->lastInsertId();
			
	if (isset($cat['categories'][$i]["children"]))
	{
		for($j = 0; $j < count($cat['categories'][$i]["children"]); $j++)
		{
			echo "Category $j is " . $cat['categories'][$i]["children"][$j]['catDesc'] . " with the ID parent being " . $cat['categories'][$i]["children"][$j]["parentID"] . "<br/>";
			
			$subCatName = $cat['categories'][$i]["children"][$j]['catDesc'];
			
			$sth = $dbh->query("INSERT INTO category
					SET	description = '$subCatName',
					parentId = '$lid'");
		}
	}
	
	echo("<br/>");
	
	//go to cms customisation page
		header( 'Location: ../admin/categories.php' );
}
?>