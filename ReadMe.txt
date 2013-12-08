
    _  _   _   _   _   _    _  ____    __  ____
   / \/ \  \\_//  //  /_\  | \ _  _    ||- ||__
  //\__/\\  \ /   || /___\ | /  ||     ||- ||
 //      \\ //    \\//   \\| \  ||     \\  /|
                                       	\-- |
                                         __||
                                        \___/
                                        *   *

/*** Hi There ***/
Thankyou for downloading my-cart. The fruitation of an idea on one cold dark night then developed between two universaty students slaving over their computers for two trimesters.


/*** Installing mycart ***/
To install mycart you need to do the following.

1. Download the mycart-plugin.zip files

	- Assuming by you reading this that you have allready done that

2. Set up a database on you provider
	
	Mycart will require the following details for setting up your database
	1. Name of your database
	2. Username for the database login
	3. Password for that username
	4. The providers address for the database

3. Copy over the following in the mycart-plugin.zip to your websites www folder

	- mcinstall.php file
	- mycart-plugin folder

4. Navigate to the mcinstall.php that is on your website and fill out your details

	- www.examplesite.com/mcinstall.php

5. On your websites shop page paste the following in the header.

	<!-- jquery -->
	(Only paste this if you do not have jquery on your site)
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

	
	
	<!-- mycart-plugin styling -->
	
	<link rel="stylesheet" type="text/css" href="mycart-plugin/css/font-awesome.css">
	
	<link rel="stylesheet" type="text/css" href="mycart-plugin/css/store.css"/>
	
	<link rel="stylesheet" type="text/css" href="mycart-plugin/css/customize.php"/>

	
	
	<!-- mycart-plugin fancybox libraries -->
	
	<link rel="stylesheet" href="mycart-plugin/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	
	<script type="text/javascript" src="mycart-plugin/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	
	<style type="text/css">
		
		.fancybox-custom .fancybox-skin {
			
			box-shadow: 0 0 50px #222;
		
		}
	
	</style>
	
	
	<!-- mycart js-->
	<script type="text/javascript" src="mycart-plugin/js/mycart.js"></script>

6. On your website shop page paste the following where you would like the users cart to show

	<!-- ============ mycart-plugin CART ============ -->
			
	<div class="mycart-plugin mycart-plugin-cart"></div>

7. On your website shop page paste the following where you would like your store to show

	<!-- ============ mycart-plugin STORE ============ -->
	
	<div class="mycart-plugin mycart-plugin-store"></div>

8. And your done navigate to the mcadmin.php file to start adding your products and make some money

	- www.examplesite.com/mcadmin.php






















