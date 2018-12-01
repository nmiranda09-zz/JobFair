<!-- <?php //session_start(); ?> -->

<!DOCTYPE html>
<html>
<head>
	<title>Register - JobFair</title>
	<?php include "meta.php" ?>
</head>
<body class="register-index">
	<?php include "header.php" ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="main-column">
	    		<form class="form" method="post" action="register.php">
		            <h3>Create an account</h3>
		            <legend>Required Fields *</legend>
		            <?php
		            	include "server/functions.php";
						register();
		            ?>
		            <input type="text" name="firstname" placeholder="First Name *" required>
		            <input type="text" name="lastname" placeholder="Last Name *" required>
		            <label>Are you a?</label>
		            <select name="type">
		            	<option>Employer</option>
		            	<option>Jobseeker</option>
		            </select>
		            <input type="text" name="username" placeholder="Username *" required>
		            <input type="password" name="password" placeholder="Password *" required>
		            <input type="password" name="confirm_pass" placeholder="Confirm Password *" required>
		            <input class="register-btn" type="submit" value="register" name="register" />
		        </form>

		        <div class="info-container">
		        	<h3>Already have an account?</h3>
		        	<p>Please login <a href="login.php">here</a>.</p>
		        </div>
	    	</div>
	    </div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>