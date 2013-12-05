<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Cart | Setup</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="mycart-plugin/css/cms.css"/>
</head>
<body>
	<div class="pushy-footer-wrapper">
	<div class="header-content">
		<div class="wrapper clearfix">
				<img class="client-logo" src="mycart-plugin/img/logo-mycart.png" width="250" height="auto" style="padding:15px" alt="Logo"/>
		</div><!-- end wrapper -->
	</div><!-- end header-content -->
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="signin-container">
				<h4>Set Up Mycart</h4>
				<form action="mycart-plugin/installer.php" method="post">				
					<div class="form-group">
						<p><span class="glyphicon glyphicon-user"></span>Username</p>
						<input type="username" name="un" class="form-control" placeholder="username" spellcheck="false"/>
					</div>
					<div class="form-group">
						<p><span class="glyphicon glyphicon-user"></span>Email</p>
						<input type="username" name="em" class="form-control" placeholder="email" spellcheck="false"/>
					</div>
					<div class="form-group">
						<p><span class="glyphicon glyphicon-lock"></span>Password</p>
						<input type="password" name="pw" class="form-control" placeholder="password" spellcheck="false"/>
						<input type="password" name="pwch" class="form-control" placeholder="repeat" spellcheck="false"/>
					</div>
					<div class="form-group">
						<p><span class="glyphicon icon-database-lock"></span>Database Details</p>
						<input type="text" name="dbn" class="form-control" placeholder="database name" />
						<input type="text" name="dbu" class="form-control" placeholder="db username" />
						<input type="text" name="dbp" class="form-control" placeholder="db password" />
						<input type="text" name="dbh"class="form-control" placeholder="database host" />
					</div>
					<input class="btn btn-primary btn-success" type="submit" value="Set up Mycart!"/>
				</form>
			</div><!-- signin-container -->
		</div><!-- end wrapper -->
<?php include("mycart-plugin/includes/cms-footer.inc.php"); ?>