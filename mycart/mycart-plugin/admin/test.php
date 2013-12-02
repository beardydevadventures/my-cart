<link rel="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
<style>
	ul li {
		cursor: pointer;
	}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../js/jquery.mjs.nestedSortable.js"></script>
<script>
	$(function(){
		// $(".sortable").sortable();

		// $(".button").click(function(){
		// 	var sortedIDs = $(".sortable").sortable("toArray");
		// 	console.log(sortedIDs);
		// });

		$(".sortable").nestedSortable({
			handle: "div",
			items: "li",
			toleranceElement: "> div",
			maxLevels: "2",
			listType: "ul"
		});

		$(".button").on("click", function(){
			var test = $(".sortable").nestedSortable("toHierarchy");
			console.log(test);

			// var num = 0;
			// var cat = "";
			// var content = "";
			// var inputs = "";

			// for(var i=0; i<test["length"]; i++)
			// {
			// 	// content += "Category no." + (i + 1) + " is ID " + test[i]["id"] + "<br/>";
			// 	content += "Category " + (i+1) + " is " + $("#category_" + test[i]["id"]).find("div").html() + "<br/>";
			// 	// inputs += "<input type='hidden' name='catID" + (i+1) + "' value='" + (i+1)"'/>";
			// 	// inputs += "<input type='hidden' name='cat"
			// 	// inputs += "<input type='hidden' name='catID" + (i + 1) + "' value='" + test[i]["id"] + "'/>";
			// 	// inputs += "<input type='hidden' name='catDesc" + (i + 1) + "' value='" + $(". "test[i]["id"] + "'/>";
			// 	// inputs += "<input type='hidden' name='catParent" + (i + 1) + "' value='" + i + "'/>";

			// 	if(test[i]["children"])
			// 	{
			// 		// content += "Children exist!<br/>";
			// 		for(var j=0; j<test[i]["children"]["length"]; j++)
			// 		{
			// 			content += "Sub-category " + (j + 1) + " is " + $("#category_" + test[i]["children"][j]["id"]).find("div").html() + "<br/>";
			// 		}
			// 	}
			// }

			// $(".body").html(content);

			// console.log(num);

		});
	});
</script>
	<div class="body-content">
			<h4 class="inline">Edit Categories</h4>
			<p class="body"></p>

			<button class="button" type="button">Hierarchy</button>
			
			<ul class="sortable">
				<li id="category_1">
					<div>Shorts</div>
				</li>
				<li id="category_2">
					<div>Shirts</div>
				</li>
				<li id="category_3">
					<div>Jeans</div>
				</li>
				<li id="category_4">
					<div>Jackets</div>
				</li>
			</ul>

		</div><!-- end wrapper -->
	</div><!-- end body-content -->