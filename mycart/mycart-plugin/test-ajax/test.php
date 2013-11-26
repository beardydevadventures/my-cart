<!doctype html>
<html>
<head>
	<title>Test Loading CSS</title>
	<style>
	#mycart
	{
		width: 100%;
		height: 100%;
		background-color: #FCB3A0;
	}
	</style>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			// some sorta AJAX call
			//$("#mycart").css("background-color", "#00ff00");
			//$("#mycart").append("AWW!<br /><p id='testP'>asdfasdfasdf</p>");
			//$("#mycart p#testP").css("color", "#f00");

			$.ajax({
				url: "product.php",
				dataType: "json",
				success: function(d){
					$("#mycart").append(d.data);
					var css = d.css;
					$.each(css, function(key, value){
						// split VALUE up into CSS val and WHERE TO APPLY IT
						var temp = Array();
						temp = value.split("|");
						
						$('#mycart ' + temp[1]).css(key, temp[0]);
					});
				}
			});
		});
	</script>
</head>
<body>
	<div id="mycart"></div>	
</body>
</html>