<?php ob_start(); session_start(); 
	if(isset($_SESSION['admin']))
	{
		header('Location: ../admin/home.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Cart | Admin</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/cms.css"/>
</head>
<body>
	<div class="pushy-footer-wrapper">
	<div class="header-content">
		<div class="wrapper clearfix">
				<img class="client-logo" src="../img/placeholder-logo.png" alt="Logo"/>
		</div><!-- end wrapper -->
	</div><!-- end header-content -->
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="signin-container">
				<h4>Log in</h4>
				<form action="../functions/adminsignin.function.php" method="post">				
					<div class="form-group">
						<span class="glyphicon glyphicon-user"></span>
						<input type="text" name="un"class="form-control" placeholder="username" spellcheck="false"/>
					</div>
					<div class="form-group">
						<span class="glyphicon glyphicon-lock"></span>
						<input type="password" name="pw" class="form-control" placeholder="password" spellcheck="false"/>
					</div>
					<input class="btn btn-primary btn-mini" type="submit" value="Log in"/>
					<a href="#">Forgot your password?</a>
				</form>
			</div><!-- signin-container -->
		</div><!-- end wrapper -->
<?php include("../includes/cms-footer.inc.php"); ?>