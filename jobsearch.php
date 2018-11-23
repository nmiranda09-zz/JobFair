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
	<title>Jobsearch - JobFair</title>
	<?php include "meta.php"; ?>
</head>
<body class="jobsearch-index">
	<?php include "header.php"; ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="main-column">
	    		<div class="left-column">
		    		<h3>Available Jobs</h3>

		    		<div class="jobsearch-container">
		    			<form class="jobsearch-filter-container" action="" method="post">
		    				<label>Filter by:</label>
		    				<?php jobCategories(); ?>
		    				<button name="filterSearch">Go</button>
		    			</form>

			    		<div class="search-container">
		    				<?php jobsearch(); ?>
			    		</div>
		    		</div>
		    	</div>

		    	<div class="right-column">
		    		<div class="recent-application-container">
		    			<h3>My Applications</h3>

		    			<div class="jobpost-container">	
		    				<?php applications(); ?>
		    			</div>
		    			
		    		</div>
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