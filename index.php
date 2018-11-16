<?php
	include "server/functions.php"; 
	register();
	login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>JobFair - Your easiest job finder online.</title>
	<?php include "meta.php" ?>
</head>
<body class="main-index">
	<?php include "header.php" ?>

	<div class="page-main">
		<div class="get-started-container">
			<h1>Looking for a Job?</h1>
			<p>To get started search your desired jobs below.</p>

			<div class="search-container">
				<input type="search" name="" placeholder="Keywords" />
				<select>
					<option>Category 1</option>
					<option>Category 2</option>
					<option>Category 3</option>
					<option>Category 4</option>
					<option>Category 5</option>
				</select>
				<button type="submit">Search</button>
			</div>
		</div>

		<div class="recent-job-listing-container">
			<strong>Recent Job Postings</strong>

			<ul>
				<li><a href="#"><span>Job Post 1</span></a></li>
				<li><a href="#"><span>Job Post 1</span></a></li>
				<li><a href="#"><span>Job Post 1</span></a></li>
				<li><a href="#"><span>Job Post 1</span></a></li>
				<li><a href="#"><span>Job Post 1</span></a></li>
			</ul>

			<a class="see-all-btn" href="#">See all job postings</a>
		</div>

		<div class="top-employers-container">
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
		</div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>