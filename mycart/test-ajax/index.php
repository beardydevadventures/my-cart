<style>
/********************** CLIENT'S STYLING *********************/
html, *
{
	font-family: calibri;
}

html
{
	 font-size: 100%;
}

/********************** MYCART'S STYLING *********************/
div#mycartplugin *
{
	margin: 0;
	padding: 0;
	font-family: verdana;
	list-style: none;
	text-decoration: none;
	background-color: transparent;
}

div#mycartplugin img
{
  width: auto;
  height: auto;
  max-width: 100%;
  vertical-align: middle;
  border: 0;
}

</style>
<div>
	<h2>Header</h2>
	<p>Lorem <strong>ipsum</strong> and some more place holder text here.</p>
	<ul>
		<li>a</li>
		<ul>
			<li>123</li>
		</ul>
		<li>b</li>
	</ul>
</div>

<div 
id = "mycartplugin" 
style="
	background-color: lightgrey;
">
	<h2>MyCart Plugin</h2>
	<ul>
		<li>Item</li>
			<ul>
				<li>Sub-item</li>
				<li style="">Sub-item</li>
			</ul>
		<li>Item</li>
		<li>Item</li>
		<li>Item</li>
			<ul>
				<li>Sub-item</li>
				<li>Sub-item</li>
			</ul>
		<li>Item</li>
	</ul>
	<p>This is some <strong>place holder text</strong> poop biscuits.</p>
</div><!-- mycartplugin -->

<div>
	<h3>Footer</h3>
	<p>Lorem ipsum and some more place holder text here.</p>
</div>