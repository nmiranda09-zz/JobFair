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
	<title>Job Description - Your easiest job finder online.</title>
	<?php include "meta.php" ?>
</head>
<body class="description-index">
	<?php include "header.php" ?>

	<div class="page-main">
		<div class="page-wrapper">
			<div class="job-description">
				<button class="back-btn" onclick="history.go(-1);"><i class="fa fa-caret-left"></i>Back</button>
				<?php description(); ?>
			</div>
		</div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>
<?php else: ?>
	<?php header('location: login.php'); ?>
<?php endif; ?>