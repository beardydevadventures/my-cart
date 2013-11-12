<!DOCTYPE html>
<html>
<head>
	<title></title>

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
	
	$.ajax({
		url: "test2.php",
		dataType: "json",
		success: function(e){
			for(i=0; i < e.length; i++)
			{
				$("#item").append("<div class='product" + i + "'><h2>" + e[i].name + "<span> " + e[i].id + "</span</h2>");
				$("#item").append("<p>and we have " + e[i].qty + " left</p></div>");
				$(".product" + i).css("background-color", e[i].color);
			}
		}
	})

</script>

</head>
<body>
	<div id="item"></div>
</body>
</html>