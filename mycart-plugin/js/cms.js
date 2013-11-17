$(function(){
	// Product Page -- initiate removeProduct Modal
	$(".products .remove").click(function(){
		//$('.prodLink').preventDefault();
		$("#removeProductModal").modal("show");
		
		var pname = $(this).attr('productName');
		var pid = $(this).attr('productId');
		$("#prodremName").html(pname);
		$('#btn-remove').attr('prodremId', pid);
	});

	// Product Page -- remove the product
	$("#btn-remove").click(function(){
		$("#removeProductModal").modal("hide");
		var remurl = "../functions/delete.function.php?id=" + $(this).attr('prodremId');
		console.log(remurl);
		window.location = remurl;
	});

	// go to corresponding link
	function goToLink(e) {
		if($(this).hasAttr('productName'))
		{
			e.preventDefault();
		}
		else
		{
			window.location = $(this).find("a").attr("href");
		}
	}
	
	// Order Page -- when you click on the table row, take the corresponding page
	$(".orders .row-link").click(goToLink);
	$(".products .row-link").click(goToLink);
	$(".shipping .row-link").click(goToLink);

	// Order Page -- dispatch notice
	$("#btn-dispatch").click(function(){
		$(".dispatch-notice").removeClass("panel-danger");
		$(".dispatch-notice").addClass("panel-success");
		$(".dispatch-notice a").removeClass("btn-danger");
		$(".dispatch-notice a").addClass("btn-success disabled");
		$(".dispatch-notice a").html("<i class='icon-check'></i> Dispatched");
		$(".dispatch-notice").addClass("panel-success");
		$(".dispatch-notice i").addClass("icon-check");
		$(".dispatch-notice .panel-heading").html("Order Dispatched");
		$("#dispatchOrderModal").modal("hide");

		$(".orders .text-danger").removeClass("text-danger").addClass("text-success").html("Dispatched");
	});

	// Shipping Page -- decimal place format when finished typing	
	$(".decimal").on("change", function(){
		if(isNaN(parseFloat(this.value)))
		{
			// alert("not a number");
		}
		else
		{
			$(this).val(parseFloat($(this).val()).toFixed(2));
		}
	});
	
	// textarea tinyMCE
    tinymce.init({
        selector: 'textarea',
        content_css: '../css/tinymce.css' 
    });
    
    // New Product - add new option panel
	function addOption(){
		// find out how many options already exist
		var numItems = $(".form-selecting .form-group").length;
		// find the text value of the last option
		var lastOption = $(".form-selecting > div:nth-child("+numItems+") > div > input").val();
		// create a 'new' option pre-filled with last option and increment id's
		var htmlFormGroup = '<div class="form-group"><label for="inputOption' + (numItems) + '" class="col-lg-2 control-label">Option</label><div class="col-lg-10"><input type="text" class="form-control" id="inputOption' + (numItems) + '" placeholder="Color, size, type etc" value="' + lastOption + '" name="inputOption[]"/><input type="text" class="form-control" id="inputQuantity' + (numItems) + '" placeholder="Quantity" name="inputQuantity[]"/></div></div>';

		$(".form-selecting > div:nth-child("+numItems+")").after(htmlFormGroup);
	}

	// New Product -- add new option button
	$("#addOption").on("click", addOption);

	$('.form-selecting').on("keypress", function(e) {
		if(e.keyCode == 13 || e.keyCode == 9)
		{
			addOption();
			var numItems = $(".form-selecting .form-group").length;
			var lastOption = $(".form-selecting > div:nth-child("+numItems+") > div > input[id^='inputOption']").focus();
		}
		return e.keyCode != 13;
	});

	$("#removeOption").on("click",function(){
	});
	
	
	var primaryColor;
	$('.primary-color').colorpicker().on('changeColor', function(e){
		primaryColor = e.color.toHex();
		$(".mask-color-1").css("background-color", primaryColor);
	});

	var secondaryColor;
	$('.secondary-color').colorpicker().on('changeColor', function(e){
		secondaryColor = e.color.toHex();
		$(".mask-color-2").css("background-color", secondaryColor);
	});

	var buttonColor = "#F0F0F0";
	$('.button-color').colorpicker().on('changeColor', function(e){
		buttonColor = e.color.toHex();
		$(".mycart-button").css("background-color", buttonColor);
	});

	var buttonHoverColor = '#cccccc'; 
	$('.button-hover-color').colorpicker().on('changeColor', function(e){
		buttonHoverColor = e.color.toHex();
		$(".mycart-button").on("mouseover", function(){
			$(this).css("background-color", buttonHoverColor);
		}).mouseout(function(){
			$(this).css("background-color", buttonColor);
		});
	});

	var buttonActiveColor = "#aaaaaa";
	$('.button-active-color').colorpicker().on('changeColor', function(e){
		buttonActiveColor = e.color.toHex();
		$(".mycart-button").on("mousedown", function(){
			$(this).css("background-color", buttonActiveColor);
		}).mouseup(function(){
			$(this).css("background-color", buttonColor);
		});
	});

	var buttonFontColor = "#333333";
	$('.button-font-color').colorpicker().on('changeColor', function(e){
		buttonFontColor = e.color.toHex();
		$(".mycart-button").css("color", buttonFontColor);
	});

	var buttonFontHoverColor = "#333333";
	$('.button-font-hover-color').colorpicker().on('changeColor', function(e){
		buttonFontHoverColor = e.color.toHex();
		$(".mycart-button").on("mouseover", function(){
			$(this).css("color", buttonFontHoverColor);
		}).mouseout(function(){
			$(this).css("color", buttonFontColor);
		});
	});

	var buttonFontActiveColor = "#333333";
	$('.button-font-active-color').colorpicker().on('changeColor', function(e){
		buttonFontActiveColor = e.color.toHex();
		$(".mycart-button").on("mousedown", function(){
			$(this).css("color", buttonFontActiveColor);
		}).mouseup(function(){
			$(this).css("color", buttonFontColor);
		});
	});

	var headingColor = "#333333";
	$('.heading-color').colorpicker().on('changeColor', function(e){
		headingColor = e.color.toHex();
		$(".mycart-heading").css("color", headingColor);
	});

	var bodyColor = "#333333";
	$('.body-color').colorpicker().on('changeColor', function(e){
		bodyColor = e.color.toHex();
		$(".mycart-body").css("color", bodyColor);
	});

	$('.heading-font').on("change", function(){
		var headingFont = $(this).val();
		$('.mycart-heading').css('font-family', headingFont);
	});

	$('.body-font').on("change", function(){
		var bodyFont = $(this).val();
		$('.mycart-body').css('font-family', bodyFont);
	});
});