<!DOCTYPE html>
<html>
<head>
	<title>Login - JobFair</title>
	<?php include "meta.php"; ?>
</head>
<body class="login-index">
	<?php include "header.php"; ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="inner-wrapper">
	    		<form class="form" action="login.php" method="post">
		            <h3>Login to your account</h3>
		            <legend>Required Fields *</legend>
		            <?php 
		            	include "server/functions.php";
		            	login();
		            ?>
		            <input type="text" name="username" placeholder="Username *" required>
		            <input type="password" name="password" placeholder="Password *" required>
		            <input class="login-btn" type="submit" value="login" name="login">
		        </form>

		        <div class="info-container">
		        	<h3>New to JobFair?</h3>
		        	<p>Create an account <a href="register.php">here</a> to get started.</p>
		        </div>
	    	</div>
	    </div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>