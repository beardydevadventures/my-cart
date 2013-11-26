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
		'button-color' => $btncol, 
		'button-font-color' => $btnfontcol, 
		'button-hover-color' => $btnhovcol, 
		'button-font-hover-color' => $btnfonthovcol, 
		'button-active-color' => $btnactcol, 
		'button-font-active-color' => $btnfontactcol);

print_r($values);

//adds values to array
$i = 1;

foreach($values as $name => $value)
{
	$sth = $dbh->query("UPDATE setting
			SET name = '$name',
			value = '$value'
			WHERE id = $i");
	
			$i++;
}

//go back to customize.php
header("Location: ../admin/customize.php");
?>