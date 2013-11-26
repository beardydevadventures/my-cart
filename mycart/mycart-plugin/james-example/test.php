<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/client.css"/>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).on('ready', function(e) {
		$.ajax({
			url: 'plugin.php',
			dataType: 'html',
			success: function(data) {
				$("#mycart-body").html(data);


			}
		});

		$("#mycart-body").on('click', {
			url: 'newpage.php',
			vars: { var1: 'Matt Aisthorpe', var2: 'Phil Christopher' },
			method: 'post'
		}, CallPage);

		$(".mycart-product-plugin").on('click', {
			url: $(this).attr('href'),
			vars: { var1: 'Matt Aisthorpe', var2: 'Phil Christopher' },
			method: 'post'
		}, CallPage);


		function CallPage(e) {
			e.preventDefault();
			var data = e.data;
			$.ajax({
				url: data.url,
				type: data.method,
				data: data.vars,
				dataType: 'html',
				success: function(data) {
					$("#mycart-body").html(data);
				}
			});
			console.log(e.data);
		}
	});


	</script>

	<style>
		body, html {
			width: 100%;
			height: 100%;
		}
		#mycart-body {
			width: 100%;
			height: 400px;
			background-color: #7f8c8d;
		}
	</style>


	<link rel="stylesheet" href="css/plugin.css"/>
</head>
<body>
	<div id="mycart-cart"></div>
	<div id="mycart-body"></div>
</body>
</html>