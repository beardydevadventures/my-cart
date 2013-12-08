<?php

	//user details
	$un = isset($_POST['un']) ? $_POST['un'] : "";
	$em = isset($_POST['em']) ? $_POST['em'] : "";
	$pw = isset($_POST['pw']) ? $_POST['pw'] : "";
	$pw = isset($_POST['pwch']) ? $_POST['pwch'] : "";

	//db details
	$host = isset($_POST['dbh']) ? $_POST['dbh'] : "";
	$dbname = isset($_POST['dbn']) ? $_POST['dbn'] : "";
	$user = isset($_POST['dbu']) ? $_POST['dbu'] : "";
	$pass = isset($_POST['dbp']) ? $_POST['dbp'] : "";

	//placeholder database information
	/*$host = "localhost";
	$dbname = "mycart_test";
	$user = "root";
	$pass = "";*/
	
	$dbh = null;
	
	// Check database connection
	try
	{
		//PDO DB Connection
		$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	}
	catch (PDOException $e) 
	{
    	print "Error!: " . $e->getMessage() . "<br/>";
    	die();
	}

	// Create tables in database
	$sth = $dbh->query("
			CREATE TABLE IF NOT EXISTS category 
			(
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				description VARCHAR(30),
				parentId INT
			);
			
			INSERT INTO category
			(description, parentId)
			VALUES
			('Main Category', '0'),
			('Test Category', '1');
			
			CREATE TABLE IF NOT EXISTS customer 
			(
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				fname VARCHAR(30),
				lname VARCHAR(30),
				password VARCHAR(30),
				email VARCHAR(30),
				phone VARCHAR(30),
				address TEXT,
				shipping TEXT
			);
			
			INSERT INTO customer
			(fname, lname, password, email, phone, address, shipping)
			VALUES
			('admin', '$un', '$pw', '$em', '', '', ''),
			('John', 'Smith', 'password', 'jsmith@example.com', '12345678', '123 Street Dr, Suburb Country STATE, 4321', '123 Street Dr, Suburb Country STATE, 4321');
			
			CREATE TABLE IF NOT EXISTS `order` 
			(
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				customerId INT,
				dateTimeOrdered DATETIME,
				paypalId VARCHAR(50),
				dateTimeSent DATETIME,
				trackingId INT,
				deliveryAddr TEXT
			);
			
			INSERT INTO `order`
			(customerId, dateTimeOrdered, paypalId, dateTimeSent, trackingId, deliveryAddr)
			VALUES
			('2', '11/25/2013 20:02:26', 'F9A8L3S4E', NULL, '', '123 Street Dr, Suburb Country STATE, 4321');
			
			CREATE TABLE IF NOT EXISTS product
			(
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				name VARCHAR(30),
				description TEXT,
				image VARCHAR(200),
				archive TINYINT
			);
			
			INSERT INTO product
			(name, description, image, archive)
			VALUES
			('Test Product', 'This is your first test item. Please feel free to play around with the content and start creating some of your own products.', 'img/product-images/testImage.png', '1');
			
			CREATE TABLE IF NOT EXISTS product_category 
			(
				productId INT,
				categoryId INT
			);
			
			INSERT INTO product_category 
			(productId, categoryId)
			VALUES
			('1', '2');
			
			CREATE TABLE IF NOT EXISTS product_cost
			(
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				productId INT,
				dateTime DATETIME,
				cost DECIMAL(10, 2)
			);
			
			INSERT INTO product_cost 
			(productId, dateTime, cost)
			VALUES
			('1','11/25/2013 20:02:26', '0.01');
			
			CREATE TABLE IF NOT EXISTS product_order
			(
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				orderId INT,
				productId INT,
				productVarId INT,
				quantity INT
			);
			
			INSERT INTO product_order 
			(orderId, productId, productVarId, quantity)
			VALUES
			('1', '1', '1', '1');
			
			CREATE TABLE IF NOT EXISTS product_variation
			(
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				description VARCHAR(30),
				productId INT,
				quantity INT,
				archive TINYINT
			);
			
			INSERT INTO product_variation 
			(description, productId, quantity, archive)
			VALUES
			('Test Option, 1', '1', '0', '1'),
			('Test Option, 2', '1', '1', '1'),
			('Test Option, 3', '1', '6', '1');
			
			CREATE TABLE IF NOT EXISTS setting
			(
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				name VARCHAR(50),
				value VARCHAR(50)
			);
			
			INSERT INTO setting 
			(name, value)
			VALUES
			('heading-font', 'helvetica'),
			('body-font', 'arial'),
			('heading-color', '#333333'),
			('body-color', '#444444'),
			('heading-size', '20px'),
			('body-size', '16px'),
			('link-color', '#F14A03'),
			('link-hover-color', '#FD7439'),
			('link-active-color', '#DD4402'),
			('menu-color', '#F14A03'),
			('menu-font-color', '#FFFFFF'),
			('sub-menu-color', '#F14A03'),
			('sub-menu-font-color', '#FFFFFF'),
			('sub-menu-hover-color', '#FD7439'),
			('sub-menu-font-hover-color', '#FFFFFF'),
			('button-color', '#F14A03'),
			('button-font-color', '#FFFFFF'),
			('button-hover-color', '#FD7439'),
			('button-font-hover-color', '#FFFFFF'),
			('button-active-color', '#DD4402'),
			('button-font-active-color', '#FFFFFF')			
			");

	// If query worked make database file and admin.php with link to admin file
	if ($sth)
	{
		echo ("Mycart database was created successfully");
		
		//db.inc.php file
		$fh = fopen("includes/db.inc.php", "w+");
		
		$data = "<?php" . "\n" . '$host="' . $host . '";' . "\n" . '$dbname="' . $dbname . '";' . "\n" . '$user="' . $user . '";' . "\n" . '$pass="' . $pass . '";' . "\n\n" . '$dbh = null;' . "\n\n" . '//PDO DB Connection' . "\n" . '$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);' . "\n" . "?>";
		
		fwrite($fh, $data);
		
		fclose($fh);
		
		//admin.php file
		$fh = fopen("../mcadmin.php", "w+");
		
		$data = "<?php" . "\n" . "header( 'Location: mycart-plugin/admin/' );" . "\n" . "?>";
		
		fwrite($fh, $data);
		
		fclose($fh);
		
		//go to cms admin page
		header( 'Location: admin/' );
	}
	else
	{
		echo ("Error creating Mycart Database");
	}

?>