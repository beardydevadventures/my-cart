<?php 
	$return = array();
	$return['found'] = true;
	$return['data'] = 
'<h2>Striped T-shirt</h2>
<img title="Product" alt="" src="placeholder.jpg"/>
<div class="product-side" style="background-color:#00ff00;">
	<div></div>
</div>
<p class="desc">Description of item. Here is some content. Item description will be written in this part of the container. This is text describing the item.</p>';
	
	// store css
	$return['css'] = array();

	// styles for the description
	$return['css']['background-color'] = '#0f0|#desc';
	$return['css']['color'] = '#ff0|#desc';

	// styles for the heading
	// $return['css']['color'] = '#'
	
	//echo(json_encode($return));
?>
	{
		"found":true,
		"data":"<h2 class=\"title\">Striped T-shirt<\/h2>\r\n<img title=\"Product\" alt=\"\" src=\"placeholder.jpg\"\/><div class=\"product-side\" style=\"background-color:#00ff00;\"><div><\/div><\/div><p class=\"desc\">Description of item. Here is some content. Item description will be written in this part of the container. This is text describing the item.<\/p>",
		"css":
			{
				"background-color":"#E03C1F|.desc",
				"color":"#fff|.desc",
				"color":"#973417|.title"
			}
	}