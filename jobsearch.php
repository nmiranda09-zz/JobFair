<?php
	include "server/functions.php"; 
	register();
	login();
?>

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
	    	<div class="left-column">
	    		<h3>Available Jobs</h3>

	    		<div class="jobsearch-container">
	    			<div class="jobsearch-filter-container">
		    			<label>Filter by:</label>
		    			<select>
		    				<option>Web Development</option>
		    			</select>
		    			<form action="jobsearch.php" method="post">
		    				<button name="filtersearch-btn">Search</button>
		    			</form>

		    		</div>

		    		<div class="search-container">
	    				<?php jobsearch(); ?>
		    		</div>
	    		</div>
	    	</div>

	    	<div class="right-column">
	    		<div class="recent-application-container">
	    			<h3>My Recent Applications</h3>

	    			<div class="jobpost-container">	
	    			</div>
	    			
	    		</div>
	    	</div>
	    </div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>