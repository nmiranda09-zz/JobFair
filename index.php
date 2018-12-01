<?php
	include "server/functions.php"; 
	register();
	login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>JobFair - Your easiest job finder online.</title>
	<?php include "meta.php"; ?>
</head>
<body class="main-index">
	<?php include "header.php"; ?>
	
	<div class="page-main">
		<div class="get-started-container">
			<h1>Looking for a Job?</h1>
			<p>To get started search your desired jobs below.</p>

			<div class="search-container">
				<form action="categorysearch.php" method="post">
					<input type="text" name="keywordSearch" placeholder="Keywords" required />

					<?php jobCategories(); ?>

					<button type="submit" name="categorySearch">Search</button>
				</form>			
			</div>
		</div>

		<div class="page-wrapper">
			<div class="job-category-list">
				<strong>Browse Jobs By Categories</strong>

				<div class="categories-container">
					<?php categoryNames(); ?>	
				</div>
			</div>

			<!-- <div class="top-employers-container">
				<strong>Top Employers</strong>
				
				<ul>
					<li>
						<a href="#"><img src="images/employer-logo.png" title="employer-logo"/></a>
						<span>Hired 2000 jobseekers in JobFair.</span>
					</li>
					
					<li>
						<a href="#"><img src="images/employer-logo.png" title="employer-logo"/></a>
						<span>Hired 1000 jobseekers in JobFair.</span>
					</li>

					<li>
						<a href="#"><img src="images/employer-logo.png" title="employer-logo"/></a>
						<span>Hired 3000 jobseekers in JobFair.</span>
					</li>

					<li>
						<a href="#"><img src="images/employer-logo.png" title="employer-logo"/></a>
						<span>Hired 500 jobseekers in JobFair</span>
					</li>
				</ul>
			</div> -->
		</div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>