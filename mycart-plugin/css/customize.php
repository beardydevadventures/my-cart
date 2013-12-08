<?php
    header("Content-type: text/css; charset: UTF-8");

    include ('../includes/db.inc.php');
    include ('../includes/colorArray.inc.php');

	$headingFont = $colArray['heading-font'];
	$headingColor = $colArray['heading-color'];
	$headingSize = $colArray['heading-size'];

	$bodyFont = $colArray['body-font'];
	$bodyColor = $colArray['body-color'];
	$bodySize = $colArray['body-size'];

	$linkColor = $colArray['link-color'];
	$linkHoverColor = $colArray['link-hover-color'];
	$linkActiveColor = $colArray['link-active-color'];

	$menuColor = $colArray['menu-color'];
	$menuFontColor = $colArray['menu-font-color'];

	$subMenuColor = $colArray['sub-menu-color'];
	$subMenuHoverColor = $colArray['sub-menu-hover-color'];

	$subMenuFontColor = $colArray['sub-menu-font-color'];
	$subMenuFontHoverColor = $colArray['sub-menu-font-hover-color'];

	$buttonColor = $colArray['button-color'];
	$buttonHoverColor = $colArray['button-hover-color'];
	$buttonActiveColor = $colArray['button-active-color'];

	$buttonFontColor = $colArray['button-font-color'];
	$buttonFontHoverColor = $colArray['button-font-hover-color'];
	$buttonFontActiveColor = $colArray['button-font-active-color'];
?>
.mycart-plugin button,
.mycart-plugin .mycart-plugin-btn,
.mycart-plugin input[type="submit"],
.mycart-plugin .mycart-plugin-btn-success {
	background-color: <?= $buttonColor ?> !important;
	border-color: <?= $buttonColor ?> !important;
	color: <?= $buttonFontColor ?> !important;
}

.mycart-plugin button:hover,
.mycart-plugin .mycart-plugin-btn:hover,
.mycart-plugin input[type="submit"]:hover,
.mycart-plugin .mycart-plugin-btn-success:hover {
	background-color: <?= $buttonHoverColor ?> !important;
	border-color: <?= $buttonHoverColor ?> !important;
	color: <?= $buttonFontColor ?> !important;
}

.mycart-plugin button:active,
.mycart-plugin .mycart-plugin-btn:active,
.mycart-plugin input[type="submit"]:active,
.mycart-plugin .mycart-plugin-btn-success:active,
.mycart-plugin button:focus,
.mycart-plugin .mycart-plugin-btn:focus,
.mycart-plugin input[type="submit"]:focus,
.mycart-plugin .mycart-plugin-btn-success:focus
 {
	background-color: <?= $buttonActiveColor ?> !important;
	border-color: <?= $buttonActiveColor ?> !important;
	color: <?= $buttonFontColor ?> !important;
}

.mycart-plugin .mycart-plugin-cart-icon {
	background-color: <?= $menuColor ?> !important;
}

.mycart-plugin a {
	color: <?= $linkColor ?> !important;
	font-family: <?= $bodyFont ?> !important;
	font-size: <?= $bodySize ?> !important;
}

.mycart-plugin a:hover {
	color: <?= $linkHoverColor ?> !important;
	font-family: <?= $bodyFont ?> !important;
	font-size: <?= $bodySize ?> !important;
}

.mycart-plugin a:active {
	color: <?= $linkActiveColor ?> !important;
	font-family: <?= $bodyFont ?> !important;
	font-size: <?= $bodySize ?> !important;
}

.mycart-plugin p,
.mycart-plugin span,
.mycart-plugin label,
.mycart-plugin select,
.mycart-plugin input,
.mycart-plugin div,
.mycart-plugin table > tbody > tr > td {
	font-family: <?= $bodyFont ?> !important;
	color: <?= $bodyColor ?> !important;
	font-size: <?= $bodySize ?> !important;
}


.mycart-plugin h1,
.mycart-plugin h2,
.mycart-plugin h3,
.mycart-plugin h4,
.mycart-plugin table > thead > tr > td {
	font-family: <?= $headingFont ?> !important;
	color: <?= $headingColor ?> !important;
}

.mycart-plugin h1 {
	font-size: <?= $headingSize ?> !important;
}

.mycart-plugin h2 {
	font-size: <?= ($headingSize - 2) ?>px !important;
}

.mycart-plugin h3 {
	font-size: <?= ($headingSize - 4) ?>px !important;
}

.mycart-plugin h4 {
	font-size: <?= ($headingSize - 6) ?>px !important;
}


.mycart-plugin table > thead > tr > td {
	font-weight: normal !important;
}

.mycart-plugin .mycart-plugin-nav {
	background-color: <?= $menuColor ?> !important;
}

.mycart-plugin .mycart-plugin-nav > ul > li > ul {
	background-color: <?= $subMenuColor ?> !important;
}

.mycart-plugin .mycart-plugin-nav > ul > li > ul > li > a:hover {
	background-color: <?= $subMenuHoverColor ?> !important;
	color: <?= $subMenuFontHoverColor ?> !important;
	font-family: <?= $bodyFont ?> !important;
}

.mycart-plugin .mycart-plugin-nav a {
	color: <?= $menuFontColor ?> !important;
	font-family: <?= $bodyFont ?> !important;
}

.mycart-plugin .mycart-plugin-nav > ul > li > ul > li > a {
	color: <?= $subMenuFontColor ?> !important;
	font-family: <?= $bodyFont ?> !important;
}