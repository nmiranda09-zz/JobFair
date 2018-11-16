<?php 
	function register() {
		if(!isset($_SESSION)) {
		    session_start();
		}

		include "server/db_conn.php";
		  
		if (isset($_POST['register'])) {
			$firstname = mysql_real_escape_string($_POST['firstname']);
			$lastname = mysql_real_escape_string($_POST['lastname']);
			$username = mysql_real_escape_string($_POST['username']);
			$type = mysql_real_escape_string($_POST['type']);
			$password = mysql_real_escape_string($_POST['password']);
			$confirm_pass = mysql_real_escape_string($_POST['confirm_pass']);

		  	$sql_checkusername = "SELECT * FROM tbl_users WHERE username='$username'";
		  	$checkusername_query = mysqli_query($db, $sql_checkusername);

		  	

		  	if (mysqli_num_rows($checkusername_query) > 0) {
		  	  	array_push($errors, 'Sorry, username already taken.');
				include "server/errors.php"; 	
		  	} else if ($password != $confirm_pass) {
		  	 	array_push($errors, 'Passwords do not match.');
				include "server/errors.php";	
		  	} else {
		  		while($rows = $checkusername_query->fetch_assoc()) {
		  		 $firstname = $rows['firstname'];
		  		 $type = $rows['type'];
		  	}
		        $password = md5($password);
				
				$sql_register = "INSERT INTO tbl_users (firstname, lastname, username, type, password, confirm_pass) VALUES ('$firstname', '$lastname', '$username', '$type', '$password', '$confirm_pass')";
				mysqli_query($db, $sql_register);

				$_SESSION['type'] = $type;
	  			$_SESSION['firstname'] = $firstname;
	  			$_SESSION['loggedin'] = 'true';
				header('location: index.php');
		  	}
		}
	}

	function login() {
		if(!isset($_SESSION)) {
		    session_start();
		}

		include "server/db_conn.php";

		if (isset($_POST['login'])) {
			$username = mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password']);

			$sql_checkdata = "SELECT * FROM tbl_users WHERE username = '$username'";
		  	$checkdata_query = mysqli_query($db, $sql_checkdata);

		  	while($rows = $checkdata_query->fetch_assoc()) {
		  		 $firstname = $rows['firstname'];
		  		 $type = $rows['type'];
		  	}

			if (count($errors) == 0) {
				$password = md5($password);
				$sql_login = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";
		  		$login_query = mysqli_query($db, $sql_login);

		  		if (mysqli_num_rows($login_query) > 0) {
		  			$_SESSION['type'] = $type;
		  			$_SESSION['id'] = $id;
		  			$_SESSION['firstname'] = $firstname;
		  			$_SESSION['loggedin'] = 'true';
					header('location: index.php');
		  		} else {
	          		array_push($errors, 'Invalid username or password.');
			  		include "server/errors.php";
	        	}
			}
		}
	}

	function logout() {
		if (empty($_SESSION)) {
			session_start();
		}

		if (session_destroy()) {
			unset($_SESSION['username']);
			header("Location: login.php");
			exit;
		}
	}

	function jobpost() {
		include "server/db_conn.php";
		  
		if (isset($_POST['job_post'])) {
			$title = mysql_real_escape_string($_POST['title']);
			$type = mysql_real_escape_string($_POST['type']);
			$salary = mysql_real_escape_string($_POST['salary']);
			$category = mysql_real_escape_string($_POST['category']);
			$description = mysql_real_escape_string($_POST['description']);
			$date = date('l d-m-Y');
			$status = 'Open';

			$sql_jobpost = "INSERT INTO tbl_jobs (title, type, salary, category, description, date, status) VALUES ('$title', '$type', '$salary', '$category', '$description', '$date', $status)";
			mysqli_query($db, $sql_jobpost);

			if (count($errors) == 0) {
				array_push($errors, 'Job posted successfully.');
				include "server/errors.php";
			}
		}
	}

	function jobseekers() {
		include "server/db_conn.php";

		$sql_getjobseekers = "SELECT * FROM tbl_users WHERE type = 'Jobseeker'";
	  	$getjobseekers_query = mysqli_query($db, $sql_getjobseekers);

	  	while ($rows = $getjobseekers_query->fetch_assoc()) {
		  	$firstname = $rows['firstname'];
		  	$lastname = $rows['lastname'];
		?>
			<div class="jobseeker">
				<div class="photo">
    				<img src="images/users.svg" />
    			</div>
    			
    			<div class="info">
    				<span class="name"><?php echo $firstname . ' ' .$lastname; ?></span>
    				<span class="headline">Web Developer</span>
    				<span class="school-graduated">La Consolacion College - Bacolod</span>
	    			<span class="outline">I don't want to work.</span>
	    			<button type="submit">Check Profile</button>	
    			</div>
			</div>
		<?php
		}
	}

	function getJobPostUpdate() {
		include "server/db_conn.php";

		$sql_getjobpostupdate = "SELECT * FROM tbl_jobs";
	  	$getjobpostupdate_query = mysqli_query($db, $sql_getjobpostupdate);

	  	while ($rows = $getjobpostupdate_query->fetch_assoc()) {
		  	$title = $rows['title'];
		  	$status = $rows['status'];
		?>
			<div class="jobpost">
				<span class="jobtitle"><?php echo $title; ?></span>
    			<span class="jobapplication">Applied: 3</span>
    			<span class="status">Status: <?php echo $status; ?></span>
    			<button>Check Applicants</button>
			</div>
		<?php
		}
	}

	function jobSearch() {
		include "server/db_conn.php";

		$sql_getjobpostupdate = "SELECT * FROM tbl_jobs WHERE status='Open'";
	  	$getjobpostupdate_query = mysqli_query($db, $sql_getjobpostupdate);

	  	while ($rows = $getjobpostupdate_query->fetch_assoc()) {
		  	$title = $rows['title'];
		  	$type = $rows['type'];
		  	$salary = $rows['salary'];
		  	$category = $rows['category'];
		  	$description = $rows['description'];
		  	$date = $rows['date'];
		  	$id = $rows['id'];
		?>
			<div class="jobpost">
				<span class="category"><?php echo $category; ?></span>
				<span class="jobtitle"><?php echo $title; ?></span>
    			<span class="date"><img src="images/calendar.png"><?php echo $date; ?></span>
    			<span class="salary"><img src="images/salary.png">$<?php echo $salary; ?>/hr</span>
    			<label>Overview:</label>
    			<span class="description"><?php echo $description; ?></span>
    			<?php echo "<a href = 'readmore.php?id=".$id."'>"?>Read More</a>
			</div>
		<?php
		}
	}

	function description() {
		include "server/db_conn.php";
		
		$id = $_GET['id'];

		$sql_getjobpostupdate = "SELECT * FROM tbl_jobs WHERE id = '$id'";
	  	$getjobpostupdate_query = mysqli_query($db, $sql_getjobpostupdate);


	  	if ($rows = $getjobpostupdate_query->fetch_assoc()) {
		  	$title = $rows['title'];
		  	$type = $rows['type'];
		  	$salary = $rows['salary'];
		  	$category = $rows['category'];
		  	$description = $rows['description'];
		  	$date = $rows['date'];
		  	$status = $rows['status'];
		?>
			<div class="jobpost">
				<span class="category"><?php echo $category; ?></span>
				<h1 class="jobtitle"><?php echo $title; ?></h1>
				<div>
					<span class="date"><img src="images/calendar.png"><?php echo $date ?></span>
    				<span class="salary"><img src="images/salary.png">$<?php echo $salary; ?>/hr</span>	
				</div>
    			
    			<label>Description</label>
    			<span class="description"><?php echo $description; ?></span>

    			<div class="actions">
    				<button onclick="history.go(-1);">Back</button>
    				<button id="readmore-modal" class="readmore-btn">Apply</button>	

    				
    				<div id="modal-container" class="applyform-container">

    					<form class="apply-form" method="post" action="" enctype="multipart/form-data">
    						<span class="close-btn"><img src="images/close.png"></span>
    						
    						<h3>Easy Apply <img src="images/easy-apply.svg"></h3>
				            <legend>Required Fields *</legend>
				            <?php applyForm(); ?>
    					</form>
    				</div>
    			</div>
    			
			</div>
		<?php
		}
	}

	function applyForm() {
		include "server/db_conn.php";

		if (empty($_SESSION)) {
			session_start();
		}

		$firstname = $_SESSION["firstname"];
		$submitted = '0';

		$sql_getUserId = "SELECT * FROM tbl_users WHERE firstname = '$firstname'";
	  	$getUserId_query = mysqli_query($db, $sql_getUserId);

	  	if ($rows = $getUserId_query->fetch_assoc()) {
	  		$id = $rows['id'];
	  		$lastname = $rows['lastname'];
	  	}?>
	  		<input type="text" name="firstname" placeholder="First Name *" value="<?php echo $firstname ?>" disabled>
			<input type="text" name="lastname" placeholder="Last Name *" value="<?php echo $lastname; ?>" disabled>
			<label>Upload Resume/CV</label>
			<input type="file" name="fileTarget" required>
			<input class="apply-btn" type="submit" value="Send Application" name="apply" 
			  <?php 
			  	//Saving file to a directory and save filename to database
				if (isset($_POST['apply'])) {
					$jobId = $_GET['id'];		
					$userId = $id;
					$fileExistsFlag = 0; 
					$fileName = $_FILES['fileTarget']['name'];

					$sql_checkFile = "SELECT filename FROM tbl_jobapplication WHERE filename='$fileName'";	
					$checkFile_query = mysqli_query($db, $sql_checkFile);

					while($row = mysqli_fetch_array($checkFile_query)) {
						if($rows['filename'] == $fileName) {
							$fileExistsFlag = 1;
						}		
					}

					if($fileExistsFlag == 0) { 
						$target = "files/";		
						$fileTarget = $target.$fileName;
						$tempFileName = $_FILES["fileTarget"]["tmp_name"];
						$result = move_uploaded_file($tempFileName,$fileTarget);
						
						if($result) { 
							$sql_addApplication = "INSERT INTO tbl_jobapplication (job_id, user_id, filename) VALUES ('$jobId', '$userId', '$tempFileName')";
					  		mysqli_query($db, $sql_addApplication);

					  		if (count($errors) == 0) {
								array_push($errors, 'You have successfully applied to this job.');
								echo "disabled='true'";
							}			
						}
					}
				}?>
				/>
	  	<?php
		  	include "server/errors.php";
	}
?>