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
	<title>Send a Message - JobFair</title>
	<?php include "meta.php"; ?>
</head>
<body class="message-index">
	<?php include "header.php"; ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="main-column">
	    		<div class="sendmsg-container">
		    		<button class="back-btn" onclick="history.go(-1);"><i class="fa fa-caret-left"></i>Back</button>
					<?php sendMessage(); ?>
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