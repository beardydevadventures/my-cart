$(function(){
	// Product Page -- initiate removeProduct Modal
	$(".products .remove").click(function(){
		$("#removeProductModal").modal("show");
		return false;
	})

	// Product Page -- remove the product
	$("#btn-remove").click(function(){
		$("#removeProductModal").modal("hide");
	});

	// go to corresponding link
	function goToLink() {
		window.location = $(this).find("a").attr("href");
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
	
});