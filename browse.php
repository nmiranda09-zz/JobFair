<?php include "server/functions.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Browse by Category - JobFair</title>
	<?php include "meta.php"; ?>
</head>
<body class="jobsearch-index">
	<?php include "header.php"; ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="main-column">
	    		<div class="jobsearch-container">
	    			<?php browseCategories(); ?>
		    	</div>
	    	</div>
	    </div>
	</div>
	<?php include "footer.php" ?>
</body>
</html>