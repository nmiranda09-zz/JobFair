<?php
	include "server/functions.php"; 
	register();
	login();

	$idCheck = $_SESSION['id'];
?>
<?php if($idCheck != ""): ?>

<!DOCTYPE html>
<html>
<head>
	<title>Post a Job - JobFair</title>
	<?php include "meta.php"; ?>
</head>
<body class="jobpost-index">
	<?php include "header.php"; ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="main-column">
	    		<form class="form" method="post" action="jobpost.php">
		            <h3>Create a Job Post</h3>
		            <legend>Required Fields *</legend>
		            <?php jobpost(); ?>
		           	<input type="text" name="title" placeholder="Job Title *" required>
		           	<select name="type">
		           		<option>Freelance</option>
		           		<option>Contractual</option>
		           		<option>Part Time</option>
		           		<option>Full Time</option>
		           	</select>
		           	<label>Salary per hr in $?</label>
		            <input type="number" name="salary" placeholder="Expected Salary *" required>
		            <label>What cateogory?</label>
		            <?php jobCategories(); ?>

		            <textarea name="description" placeholder="Job Description *"></textarea>
		            <input class="jobpost-btn" type="submit" value="Post" name="job_post">
		        </form>

		        <div class="info-container">
		        	<h3>Reminder <?php echo $_SESSION['firstname']; ?></h3>
		        	<p>You have a maximum of 5 job posting in this basic free account, renewable after 30days, also each post will be posted in JobFair for 30days. If you want to increase the number posts in your account, please upgrade to Pro or Premium <a href="#">here</a>.</p>
		        </div>
	    	</div>
	    </div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>
<?php else: ?>
	<?php header('location: login.php'); ?>
<?php endif; ?>