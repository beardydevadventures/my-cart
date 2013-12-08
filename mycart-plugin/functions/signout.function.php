<?php
	session_start();
	
	if(isset($_SESSION['uid']))
	{
		unset($_SESSION['uid']);
		
		?>
		<script>
		$.ajax({
                url: "mycart-plugin/mycart-plugin-cart.php",
                dataType: 'html',
                success: function(data){
                    $(".mycart-plugin-cart").html(data);
                }
            });
		</script>
		<?php
		include('../mycart-plugin-store.php');
	}
?>