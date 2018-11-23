<?php 
	include "server/functions.php";
	login();
	register(); 

	$idCheck = $_SESSION['id'];
?>
<?php if($idCheck != ""): ?>

<!DOCTYPE html>
<html>
<head>
	<title>My Account - JobFair</title>
	<?php include "meta.php"; ?>
</head>
<body class="account-index">
	<?php include "header.php"; ?>

	<div class="page-main">
	    <div class="page-wrapper">
	    	<div class="left-column">
	    		<h3>My Account</h3>

	    		<div class="tab-container">
				  <ul class="tab-list">
				    <li><a class="tab active" href="#profile">Profile</a></li>

				    <?php if ($_SESSION['type'] == 'Employer'): ?>
				    	<li><a class="tab" href="#jobposts">Job Posts</a></li>
			    	<?php else: ?>
			    		<li><a class="tab" href="#applications">Applications</a></li>
			    	<?php endif; ?>
				    
				    <li><a class="tab" href="#messages">Messages</a></li>
				  </ul>
	    		</div>
	    	</div>

	    	<div class="right-column">
	    		<div class="tab-content show" id="profile">
				    <?php include "editprofile.php"; ?>
				</div>
				
				<?php if ($_SESSION['type'] == 'Employer'): ?>
					<div class="tab-content" id="jobposts">
					  	 <h3>Job Posts</h3>
					     
					     <?php include "jobposted.php"; ?>
					</div>
				<?php else: ?>
					<div class="tab-content" id="applications">
					  	 <h3>Applications</h3>
					  	 <div class="applications-container">
					     	<?php applications(); ?>
					     </div>
					</div>
				<?php endif; ?>	
				
				<div class="tab-content" id="messages">
				  	 <h3>Messages</h3>
				  	 <div class="messagebox-container">
				  	 	<?php messages(); ?>
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