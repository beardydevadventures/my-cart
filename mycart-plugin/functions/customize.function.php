<?php 
// adds customizations colours to database
require('../includes/db.inc.php');

//main styles
$pmcol = isset($_POST['primary-color']) ? $_POST['primary-color'] : "";
$sccol = isset($_POST['secondary-color']) ? $_POST['secondary-color'] : "";

//font styles
$hdfont = isset($_POST['heading-font']) ? $_POST['heading-font'] : "";
$bdfont = isset($_POST['body-font']) ? $_POST['body-font'] : "";
$hdcol = isset($_POST['heading-color']) ? $_POST['heading-color'] : "";
$bdcol = isset($_POST['body-color']) ? $_POST['body-color'] : "";
$hdsize = isset($_POST['heading-size']) ? $_POST['heading-size'] : "";
$bdsize = isset($_POST['body-size']) ? $_POST['body-size'] : "";

//link styles
$lkcol = isset($_POST['link-color']) ? $_POST['link-color'] : "";
$lkhovcol = isset($_POST['link-hover-color']) ? $_POST['link-hover-color'] : "";
$lkactcol = isset($_POST['link-active-color']) ? $_POST['link-active-color'] : "";

//menu styles
$mnucol = isset($_POST['menu-color']) ? $_POST['menu-color'] : "";
$mnufontcol = isset($_POST['menu-font-color']) ? $_POST['menu-font-color'] : "";
$sbmncol = isset($_POST['sub-menu-color']) ? $_POST['sub-menu-color'] : "";
$sbmnfontcol = isset($_POST['sub-menu-font-color']) ? $_POST['sub-menu-font-color'] : "";
$sbmnhovcol = isset($_POST['sub-menu-hover-color']) ? $_POST['sub-menu-hover-color'] : "";
$submnfonthovcol = isset($_POST['sub-menu-font-hover-color']) ? $_POST['sub-menu-font-hover-color'] : "";

//button styles
$btncol = isset($_POST['button-color']) ? $_POST['button-color'] : "";
$btnfontcol = isset($_POST['button-font-color']) ? $_POST['button-font-color'] : "";
$btnhovcol = isset($_POST['button-hover-color']) ? $_POST['button-hover-color'] : "";
$btnfonthovcol = isset($_POST['button-font-hover-color']) ? $_POST['button-font-hover-color'] : "";
$btnactcol = isset($_POST['button-active-color']) ? $_POST['button-active-color'] : "";
$btnfontactcol = isset($_POST['button-font-active-color']) ? $_POST['button-font-active-color'] : "";

//puts all values into an array
$values = array('primary-color' => $pmcol, 
		'secondary-color' => $sccol, 
		'heading-font' => $hdfont, 
		'body-font' => $bdfont, 
		'heading-color' => $hdcol, 
		'body-color' => $bdcol,
		'heading-size' => $hdsize,
		'body-size' => $bdsize,
		'link-color' => $lkcol,
		'link-hover-color' => $lkhovcol,
		'link-active-color' => $lkactcol,
		'menu-color' => $mnucol,
		'menu-font-color' => $mnufontcol,
		'sub-menu-color' => $sbmncol,
		'sub-menu-font-color' => $sbmnfontcol,
		'sub-menu-hover-color' => $sbmnhovcol,
		'sub-menu-font-hover-color' => $submnfonthovcol,
		'button-color' => $btncol, 
		'button-font-color' => $btnfontcol, 
		'button-hover-color' => $btnhovcol, 
		'button-font-hover-color' => $btnfonthovcol, 
		'button-active-color' => $btnactcol, 
		'button-font-active-color' => $btnfontactcol);

//print_r($values);

//adds values to array
$i = 1;

foreach($values as $name => $value)
{
	$sth = $dbh->query("UPDATE setting
			SET	value = '$value'
			WHERE name = '$name'");
	/*$sth = $dbh->query("INSERT INTO setting
			SET	value = '$value',
			name = '$name'");*/
	
			$i++;
}

print_r($values);
//go back to customize.php
header("Location: ../admin/customize.php");
?>