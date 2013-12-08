
$(function(){
	$.ajax({
		url: "mycart-plugin/mycart-plugin-cart.php",
		dataType: 'html',
		success: function(data){
			$(".mycart-plugin-cart").html(data);
		}
	});
	$.ajax({
		url: "mycart-plugin/mycart-plugin-store.php",
		dataType: 'html',
		success: function(data){
			$(".mycart-plugin-store").html(data);
		}
	});
});