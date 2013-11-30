<?php

	$return = array();
	$return[0]['id'] = 1;
	$return[0]['name'] = "Pineapple";
	$return[0]['type'] = "Fruit";
	$return[0]['qty'] = 2;
	$return[0]['color'] = "#FEE6AB";

	$return[1]['id'] = 2;
	$return[1]['name'] = "Carrot";
	$return[1]['type'] = "Vegetable";
	$return[1]['qty'] = 14;
	$return[1]['color'] = "#FEC6AB";

	$return[2]['id'] = 3;
	$return[2]['name'] = "Watermelon";
	$return[2]['type'] = "Fruit";
	$return[2]['qty'] = 4;
	$return[2]['color'] = "#FAAFDA";


	echo(json_encode($return));
?>