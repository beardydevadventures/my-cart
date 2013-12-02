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
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/cms.css"/>
</head>
<body>
	<div class="pushy-footer-wrapper">
 	<div class="header-content">
		<div class="wrapper clearfix">
			<div class="clearfix">
				<img class="logo" src="../img/logo-mycart.png" alt="My Cart"/>
			</div>
		</div><!-- end wrapper -->
	</div><!-- end header-content -->
	<div class="body-content">
		<div class="wrapper clearfix">
			<div class="signin-container">
				<h4>Log in</h4>
				<form action="../functions/adminsignin.function.php" method="post">				
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-user"></i>
						</span>
						<input type="text" name="un" class="form-control" placeholder="username" spellcheck="false"/>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-lock"></i>
						</span>
						<input type="password" name="pw" class="form-control" placeholder="password" spellcheck="false"/>
					</div>
					<input class="btn btn-primary btn-sm" type="submit" value="Log in"/>
					<a href="#">Forgot your password?</a>
				</form>
			</div><!-- signin-container -->
		</div><!-- end wrapper -->
<?php include("../includes/cms-footer.inc.php"); ?>