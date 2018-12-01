<div class="loader-container">
	<div class="loader"></div>
</div>

<header>
	<div class="logo-container">
		<a href="index.php">
			<img src="images/logo.png" alt="JobFair"/>
		</a>

		<span>- Your easiest job finder online.</span>
	</div>

	<div class="menu-container">
		<div class="menu-box">
			<div class="menu"></div>
		</div>
	</div>

	<div class="account-container">
		<?php if (isset($_SESSION['firstname'])): ?>
			<strong><?php echo "Welcome '{$_SESSION['firstname']}'"; ?></strong>
		<?php endif; ?>

		<?php if (isset($_SESSION['loggedin']) == 'true'): ?>
			<?php if ($_SESSION['type'] == 'Employer'): ?>
	    		<a class="postjob-btn" href="jobpost.php" title="Post a Job">Post a Job</a>
	    		<a class="jobseekers-btn" href="jobseekers.php" title="Jobseekers">
	    		Jobseekers</a>
	    	<?php else: ?>
	    		<a class="jobsearch-btn" href="jobsearch.php" title="Job Search">Job Search</a>
    		<?php endif; ?>
    		<a class="account-btn" href="account.php" title="Account">Account</a>
    		<a class="logout-btn" href="logout.php" title="Logout">Logout</a>
 		<?php else: ?>
			<a class="login-btn" href="login.php" title="Login">Login</a>
			<a class="register-btn" href="register.php" title="Register">Register</a>
		
		<?php endif; ?>
		
	</div>
</header>