<?php
	include "server/functions.php"; 
	register();
	login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Job Description - Your easiest job finder online.</title>
	<?php include "meta.php" ?>
</head>
<body class="description-index">
	<?php include "header.php" ?>

	<div class="page-main">
		<div class="page-wrapper">
			<?php description(); ?>
		</div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>