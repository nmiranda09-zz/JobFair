<?php 
	include "server/functions.php";
	login();
	register(); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>My Account - JobFair</title>
	<?php include "meta.php" ?>
</head>
<body class="account-index">
	<?php include "header.php" ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="left-column">
	    		<h3>My Account</h3>

	    		<ul>
	    			<li><a href="#"><span>Profile</span></a></li>
	    			<li><a href="#"><span>Job Posts</span></a></li>
	    			<li><a href="#"><span>Messages</span></a></li>
	    		</ul>
	    	</div>

	    	<div class="right-column">
	    		<div class="profile-container"></div>
	    		<div class="jospost-container"></div>
	    		<div class="messages-container"></div>
	    	</div>
	    </div>
	</div>

	<?php include "footer.php" ?>
</body>
</html>