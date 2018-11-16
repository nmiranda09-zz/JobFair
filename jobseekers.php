<?php
	include "server/functions.php"; 
	register();
	login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Jobseekers - JobFair</title>
	<?php include "meta.php"; ?>
</head>
<body class="jobseekers-index">
	<?php include "header.php"; ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="left-column">
	    		<h3>Available Jobseekers</h3>

	    		<div class="jobseekers-container">
	    			<?php jobseekers(); ?>
	    		</div>
	    	</div>

	    	<div class="right-column">
	    		<div class="jobpost-update-container">
	    			<h3>Job Post Update</h3>

	    			<div class="jobpost-container">
	    				<?php getJobPostUpdate(); ?>	
	    			</div>
	    			
	    		</div>
	    	</div>
	    </div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>