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
	<title>Messages - JobFair</title>
	<?php include "meta.php"; ?>
</head>
<body class="messages-index">
	<?php include "header.php"; ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="main-column">
	    		<div class="conversation-container">
		    		<button class="back-btn" onclick="history.go(-1);"><i class="fa fa-caret-left"></i>Back</button>
					<?php conversation(); ?>
		    	</div>
	    	</div>
	    </div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>
<script>
	document.getElementById('messagebox').scrollTop = 9999999;
</script>
<?php else: ?>
	<?php header('location: login.php'); ?>
<?php endif; ?>