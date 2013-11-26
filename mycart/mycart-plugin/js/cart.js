$(function(){
	// Log in form -- show/hide 
	$(".mycart-plugin .mycart-plugin-login-container").hide(0);

	$(".mycart-plugin .mycart-plugin-show-login").on("click", function(){
		$(".mycart-plugin .mycart-plugin-login-container").fadeToggle(0);
		$(".mycart-plugin .mycart-plugin-login-container input[type='text']").focus();
	});

	// Log in form -- HIDE when clicking outside of the container
	var mouse_is_inside = false;
    $('.mycart-plugin .mycart-plugin-login-container, .mycart-plugin .mycart-plugin-show-login').hover(function(){ 
        mouse_is_inside = true; 
    	}, function(){ 
        mouse_is_inside = false; 
    });
    $("html").mouseup(function(){ 
        if(! mouse_is_inside) $('.mycart-plugin .mycart-plugin-login-container').hide(0);
    });
});