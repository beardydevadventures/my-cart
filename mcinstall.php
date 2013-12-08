<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Cart | Setup</title>
	<link rel="stylesheet" href="mycart-plugin/css/bootstrap.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="mycart-plugin/css/cms.css"/>
</head>
<body>
	<div class="pushy-footer-wrapper">
 	<div class="header-content">
		<div class="wrapper clearfix">
			<div class="clearfix">
				<img class="logo" src="mycart-plugin/img/logo-mycart.png" alt="My Cart"/>
			</div>
		</div><!-- end wrapper -->
	</div><!-- end header-content -->
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="signin-container">
				<h4>Setup My Cart</h4>
				<form action="mycart-plugin/installer.php" method="post">
					<label>Your Details</label>				
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user"></i>
							</div>
							<input type="username" name="un" class="form-control" placeholder="Username" spellcheck="false"/>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-envelope" style='font-size: 14px'></i>
							</div>
							<input type="username" name="em" class="form-control" placeholder="Email" spellcheck="false"/>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-lock"></i>
							</div>
							<input type="password" name="pw" class="form-control" placeholder="Password" spellcheck="false"/>
						</div>
						<div class="input-group" style="margin-top: -5px">
							<div class="input-group-addon">
								<i class="fa fa-lock"></i>
							</div>
							<input type="password" name="pwch" class="form-control" placeholder="Repeat" spellcheck="false"/>
						</div>
					</div>
					<label>Database Details</label>
					<div class="form-group db-details">
						<input type="text" name="dbn" class="form-control" placeholder="Database name" />
						<input type="text" name="dbu" class="form-control" placeholder="Database username" />
						<input type="text" name="dbp" class="form-control" placeholder="Database password" />
						<input type="text" name="dbh"class="form-control" placeholder="Database host" />
					</div>
					<input class="btn btn-primary btn-success" type="submit" value="Set up My Cart!"/>
				</form>
			</div><!-- signin-container -->
		</div><!-- end wrapper -->
<?php include("mycart-plugin/includes/cms-footer.inc.php"); ?>