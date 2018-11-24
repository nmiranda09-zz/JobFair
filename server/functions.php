<?php 

	function register() {
		if(!isset($_SESSION)) {
		    session_start();
		}

		include "server/db_conn.php";
		  
		if (isset($_POST['register'])) {
			$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
			$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$type = mysqli_real_escape_string($db, $_POST['type']);
			$password = mysqli_real_escape_string($db, $_POST['password']);
			$confirm_pass = mysqli_real_escape_string($db, $_POST['confirm_pass']);

		  	$sql_checkusername = "SELECT * FROM tbl_users WHERE username='$username'";
		  	$checkusername_query = mysqli_query($db, $sql_checkusername);

		  	if (mysqli_num_rows($checkusername_query) > 0) {
		  	  	array_push($errors, 'Sorry, username already taken.');
				include "server/errors.php"; 	
		  	} else if ($password != $confirm_pass) {
		  	 	array_push($errors, 'Passwords do not match.');
				include "server/errors.php";	
		  	} else {

		        $password = md5($password);
				
				$sql_register = "INSERT INTO tbl_users (firstname, lastname, username, type, password) VALUES ('$firstname', '$lastname', '$username', '$type', '$password')";
				mysqli_query($db, $sql_register);

		  		$_SESSION['id'] = $id;
				$_SESSION['type'] = $type;
				$_SESSION['company'] = $company;
				$_SESSION['salary'] = $salary;
				$_SESSION['education_level'] = $education_level;
				$_SESSION['school'] = $school;
				$_SESSION['experience'] = $experience;
				$_SESSION['skills'] = $skills;
				$_SESSION['description'] = $description;
				$_SESSION['firstname'] = $firstname;
				$_SESSION['lastname'] = $lastname;
	  			$_SESSION['loggedin'] = 'true';
				header('location: account.php');
		  	}
		}
	}

	function login() {
		if(!isset($_SESSION)) {
		    session_start();
		}

		include "server/db_conn.php";

		if (isset($_POST['login'])) {
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$password = mysqli_real_escape_string($db, $_POST['password']);

			$sql_checkdata = "SELECT * FROM tbl_users WHERE username = '$username'";
		  	$checkdata_query = mysqli_query($db, $sql_checkdata);

		  	while($rows = mysqli_fetch_array($checkdata_query)) {
		  		 $firstname = $rows['firstname'];
		  		 $id = $rows['id'];
		  		 $type = $rows['type'];
		  	}

			if (count($errors) == 0) {
				$password = md5($password);
				$sql_login = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";
		  		$login_query = mysqli_query($db, $sql_login);

		  		if (mysqli_num_rows($login_query) > 0) {
		  			$_SESSION['id'] = $id;
					$_SESSION['type'] = $type;
					$_SESSION['company'] = $company;
					$_SESSION['salary'] = $salary;
					$_SESSION['education_level'] = $education_level;
					$_SESSION['school'] = $school;
					$_SESSION['experience'] = $experience;
					$_SESSION['skills'] = $skills;
					$_SESSION['description'] = $description;
					$_SESSION['firstname'] = $firstname;
					$_SESSION['lastname'] = $lastname;
		  			$_SESSION['loggedin'] = 'true';
					header('location: account.php');
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
		} else {
			session_destroy();
		}

		if (session_destroy()) {
			unset($_SESSION['firstname']);
			unset($_SESSION['lastname']);
			unset($_SESSION['education_level']);
			unset($_SESSION['school']);
			unset($_SESSION['description']);
			unset($_SESSION['company']);
			unset($_SESSION['salary']);
			unset($_SESSION['skills']);
			unset($_SESSION['id']);
			unset($_SESSION['type']);
			unset($_SESSION['loggedin']);
			header("Location: login.php");
		}
	}

	function jobpost() {
		include "server/db_conn.php";
		  
		if (isset($_POST['job_post'])) {
			$id = $_SESSION['id'];
			$title = mysqli_real_escape_string($db, $_POST['title']);
			$type = mysqli_real_escape_string($db, $_POST['type']);
			$salary = mysqli_real_escape_string($db, $_POST['salary']);
			$category = mysqli_real_escape_string($db, $_POST['category']);
			$description = mysqli_real_escape_string($db, $_POST['description']);
			$date = mysqli_real_escape_string($db, date('l m-d-Y'));
			$status = mysqli_real_escape_string($db, "Open");

			$sql_getCatId = mysqli_query($db, "SELECT id FROM tbl_categories WHERE cat_name = '$category'");
	        $getCatId_query = mysqli_fetch_array ($sql_getCatId);
	     
	        $catId= $getCatId_query['id'];

			$sql_jobpost = "INSERT INTO tbl_jobs (title, type, salary, category, description, date, status, user_posted_id) VALUES ('$title', '$type', '$salary', '$catId', '$description', '$date', '$status', '$id')";
			mysqli_query($db, $sql_jobpost);

			if (count($errors) == 0) {
				?>
					<div class="success">
				<?php
						array_push($errors, 'Job posted successfully.');
						include "server/errors.php";
				?>
					</div>
				<?php
			}
		}
	}

	function jobseekers() {
		include "server/db_conn.php";

		$sql_getjobseekers = "SELECT * FROM tbl_users WHERE type = 'Jobseeker' ORDER BY id DESC";
	  	$getjobseekers_query = mysqli_query($db, $sql_getjobseekers);

	  	if (mysqli_num_rows($getjobseekers_query) == 0) { 
			array_push($errors, 'No jobseekers available.');
			include "server/errors.php";
		} else {

		  	while ($rows = mysqli_fetch_array($getjobseekers_query)) {
		  		$id = $rows['id'];
			  	$firstname = $rows['firstname'];
			  	$lastname = $rows['lastname'];
			  	$experience = $rows['experience'];
			  	$description = $rows['description'];
			  	$education_level = $rows['education_level'];
			  	$school = $rows['school'];
			  	$profilePicture = $rows['profile_picture'];

			?>
				<div class="jobseeker">
					<div class="photo">
	    				<?php if(empty($profilePicture)): ?>
		  					<img src="images/users.svg" alt="Profile Picture">
		  				<?php else: ?>
		  					
		  					<img src="<?php echo 'files/'.$profilePicture; ?>">
		  				<?php endif; ?>	
	    			</div>
	    			
	    			<div class="info">
	    				<span class="name"><?php echo $firstname . ' ' .$lastname; ?></span>
	    				<div>
		    				<span class="headline">
		    					<img src="images/information.svg" alt="Information"/>
		    					<?php if(empty($experience)): ?>
			    					<?php echo 'No Info'; ?></span>
			    				<?php else: ?>
			    					<?php echo $experience; ?></span>
			    				<?php endif; ?>
		    				</span>
		    				<span class="salary">
		    					<img src="images/salary.png" alt="Salary"/>
		    					<?php if(empty($salary)): ?>
			    					<?php echo 'No Info'; ?></span>
			    				<?php else: ?>
			    					<?php echo $salary; ?></span>
			    				<?php endif; ?>
		    				</span>
		    				<span class="education-level">
		    					<img src="images/level.svg" alt="Education Level"/>
		    					<?php if(empty($education_level)): ?>
			    					<?php echo 'No Info'; ?></span>
			    				<?php else: ?>
			    					<?php echo $education_level; ?></span>
			    				<?php endif; ?>
		    					</span>
		    				<span class="school">
		    					<img src="images/building.svg" alt="School"/>
		    					<?php if(empty($school)): ?>
			    					<?php echo 'No Info'; ?></span>
			    				<?php else: ?>
			    					<?php echo $school; ?></span>
			    				<?php endif; ?>	
		    				</span>
	    				</div>
	    				<label>About me:</label>
		    			<span class="outline">
		    				<?php if(empty($description)): ?>
		    					<?php echo 'No information available.'; ?></span>
		    				<?php else: ?>
		    					<?php echo $description; ?></span>
		    				<?php endif; ?>
		    			<?php echo "<a href = 'messageform.php?id=".$id."'"; ?> title="Send Messages">Send Message</a>	
	    			</div>
				</div>
			<?php
			}
		}
	}

	function getJobPostUpdate() {
		?><div class="jobpost"><?php
			jobPosted();
		?></div><?php
	}

	function jobSearch() {
		include "server/db_conn.php";

		if (isset($_POST['filterSearch'])) {
			filterJobs();
		} else {

			$sql_getjobpostupdate = "SELECT * FROM tbl_jobs WHERE status='Open' ORDER BY id DESC";
		  	$getjobpostupdate_query = mysqli_query($db, $sql_getjobpostupdate);

		  	while ($rows = mysqli_fetch_array($getjobpostupdate_query)) {
			  	$title = $rows['title'];
			  	$type = $rows['type'];
			  	$salary = $rows['salary'];
			  	$category = $rows['category'];
			  	$description = $rows['description'];
			  	$date = $rows['date'];
			  	$id = $rows['id'];

			  	$sql_getCatName = mysqli_query($db, "SELECT * FROM tbl_categories WHERE id = '$category'");
		        $getCatName_query = mysqli_fetch_array ($sql_getCatName);
		     
		        $catName= $getCatName_query['cat_name'];
			?>
				<div class="jobpost">
					<span class="category"><?php echo $catName; ?></span>
					<span class="jobtitle"><?php echo $title; ?></span>
	    			<span class="date"><img src="images/calendar.png"><?php echo $date; ?></span>
	    			<span class="type"><img src="images/jobtype.svg"><?php echo $type; ?></span>
	    			<span class="salary"><img src="images/salary.png">$<?php echo $salary; ?>/hr</span>
	    			<label>Overview:</label>
	    			<span class="description"><?php echo $description; ?></span>
	    			<?php echo "<a href = 'readmore.php?id=".$id."'>"?>Read More</a>
				</div>
			<?php
			}
		}
	}

	function filterJobs() {
		include "server/db_conn.php";

		$categoryFilter = mysqli_real_escape_string($db, $_POST['category']);

		$sql_filter = mysqli_query($db, "SELECT * FROM tbl_categories WHERE cat_name = '$categoryFilter'");
		$filter_query = mysqli_fetch_array($sql_filter);

		$categoryId = $filter_query['id'];
		$categoryName = $filter_query['cat_name'];

		$sql_getjobpostupdate = "SELECT * FROM tbl_jobs WHERE category='$categoryId' ORDER BY id DESC";
  		$getjobpostupdate_query = mysqli_query($db, $sql_getjobpostupdate);

  		if (mysqli_num_rows($getjobpostupdate_query) == 0) {
  			array_push($errors, 'No '.$categoryName.' jobs available.');
			include "server/errors.php";
  		} else {
		  	while ($rows = mysqli_fetch_array($getjobpostupdate_query)) {
			  	$title = $rows['title'];
			  	$jobsCategory = $rows['category'];
			  	$type = $rows['type'];
			  	$salary = $rows['salary'];
			  	$description = $rows['description'];
			  	$date = $rows['date'];
			  	$id = $rows['id'];

			  	$sql_getCatName = mysqli_query($db, "SELECT * FROM tbl_categories WHERE id = '$jobsCategory'");
		        $getCatName_query = mysqli_fetch_array ($sql_getCatName);
		     
		        $catName= $getCatName_query['cat_name'];
			?>
				<div class="jobpost">
					<span class="category"><?php echo $catName; ?></span>
					<span class="jobtitle"><?php echo $title; ?></span>
					<span class="type"><img src="images/jobtype.svg"><?php echo $type; ?></span>
	    			<span class="date"><img src="images/calendar.png"><?php echo $date; ?></span>
	    			<span class="salary"><img src="images/salary.png">$<?php echo $salary; ?>/hr</span>
	    			<label>Overview:</label>
	    			<span class="description"><?php echo $description; ?></span>
	    			<?php echo "<a href = 'readmore.php?id=".$id."'>"?>Read More</a>
				</div>
			<?php
			}
		}
	}

	function description() {
		include "server/db_conn.php";
		
		$id = $_GET['id'];

		$sql_getjobpostupdate = "SELECT * FROM tbl_jobs WHERE id = '$id'";
	  	$getjobpostupdate_query = mysqli_query($db, $sql_getjobpostupdate);

	  	if ($rows = mysqli_fetch_array($getjobpostupdate_query)) {
		  	$title = $rows['title'];
		  	$type = $rows['type'];
		  	$salary = $rows['salary'];
		  	$category = $rows['category'];
		  	$description = $rows['description'];
		  	$date = $rows['date'];
		  	$status = $rows['status'];

		  	$sql_getCatName = mysqli_query($db, "SELECT * FROM tbl_categories WHERE id = '$category'");
	        $getCatName_query = mysqli_fetch_array ($sql_getCatName);
	     
	        $catName= $getCatName_query['cat_name'];
		?>
			<span class="category"><?php echo $catName; ?></span>
			<h1 class="jobtitle"><?php echo $title; ?></h1>
			<div>
				<span class="date"><img src="images/calendar.png"><?php echo $date ?></span>
				<span class="type"><img src="images/jobtype.svg"><?php echo $type; ?></span>
				<span class="salary"><img src="images/salary.png">$<?php echo $salary; ?>/hr</span>	
			</div>
			
			<label>Description</label>
			<span class="description"><?php echo $description; ?></span>
		<?php
		}
	}

	function applyForm() {
		include "server/db_conn.php";

		$id = $_SESSION["id"];
		$jobId = $_GET['id'];

		$applied = mysqli_real_escape_string($db, 'Yes');
		date_default_timezone_set('America/Denver');
		$dateTime = date('l m/d/Y H:i A', time());

	  	$sql_getUserId = mysqli_query($db, "SELECT * FROM tbl_users WHERE id = '$id'");
        $getUserId_query = mysqli_fetch_array ($sql_getUserId);

        $firstname = $getUserId_query['firstname'];
        $lastname = $getUserId_query['lastname'];

        $sql_checkApplication = "SELECT * FROM tbl_jobapplication WHERE job_id = '$jobId' AND user_id = '$id'";
        $checkApplication_query = mysqli_query($db, $sql_checkApplication);

        $rows = mysqli_fetch_array($checkApplication_query);

    	?>
    		<button onclick="history.go(-1);">Back</button>

    		<?php if($rows == true): ?>
				<button id="readmore-modal" class="readmore-btn" disabled>Applied</button>	
			<?php else: ?>
				<button id="readmore-modal" class="readmore-btn">Apply</button>	
			<?php endif; ?>

			<div id="modal-container" class="applyform-container">
				<form class="apply-form" method="post" action="" enctype="multipart/form-data">
					<span class="close-btn"><img src="images/close.png"></span>
					<h3>Easy Apply <img src="images/easy-apply.svg"></h3>
		            <legend>Required Fields *</legend>
		            <input type="text" name="firstname" placeholder="First Name *" value="<?php echo $firstname; ?>" disabled>
					<input type="text" name="lastname" placeholder="Last Name *" value="<?php echo $lastname; ?>" disabled>
					<label>Upload Resume/CV (.pdf, .doc, .docx)</label>
					<input type="file" name="fileTarget" required>
					<?php if($rows == true): ?>
						<input class="apply-btn" type="submit" value="Applied" disabled />
					<?php else: ?>
						<input class="apply-btn" type="submit" value="Send Application" name="apply" />
					<?php endif; ?>
				</form>
			</div>
			
		<?php

  		if (isset($_POST['apply'])) {
			$fileName = $_FILES['fileTarget']['name'];
	  		$target = "files/";		
			$fileTarget = $target.$fileName;
			$tempFileName = $_FILES["fileTarget"]["tmp_name"];
			$result = move_uploaded_file($tempFileName,$fileTarget);
			
			$allowedExts = array(
			  "pdf", 
			  "doc", 
			  "docx"
			);

			$pathinfo = pathinfo($fileName, PATHINFO_EXTENSION);

			if (in_array($pathinfo, $allowedExts)) {
				$result;

				$sql_addApplication = "INSERT INTO tbl_jobapplication (job_id, user_id, filename, date_applied) VALUES ('$jobId', '$id', '$fileName', '$dateTime')";
		  		mysqli_query($db, $sql_addApplication);

		  		$sql_insertEmpStatus = "UPDATE tbl_users SET emp_status='Pending' WHERE id='$id'";
		  		mysqli_query($db, $sql_insertEmpStatus);

				header('Location: '.$_SERVER['REQUEST_URI']);
			} else {
				?>
					<script>
						alert('Failed to apply on this job. Please upload either of the ff: .pdf, .doc or .docx');
					</script>
				<?php
			}
		} 
	}

	function editProfile() {
		include "server/db_conn.php"; 

		$id = $_SESSION['id'];
		$firstname = $_SESSION['firstname'];
  		$lastname = $_SESSION['lastname'];
  		$company = $_SESSION['company'];
  		$salary = $_SESSION['salary'];
  		$education_level = $_SESSION['education_level'];
  		$school = $_SESSION['school'];
  		$experience = $_SESSION['experience'];
  		$skills = $_SESSION['skills'];
  		$description = $_SESSION['description'];

		$sql_getUserId = "SELECT * FROM tbl_users WHERE id = '$id'";
	  	$getUserId_query = mysqli_query($db, $sql_getUserId);

	  	if ($rows = mysqli_fetch_array($getUserId_query)) {
	  		$id = $rows['id'];
	  		$firstname = $rows['firstname'];
	  		$lastname = $rows['lastname'];
	  		$company = $rows['company'];
	  		$salary = $rows['salary'];
	  		$education_level = $rows['education_level'];
	  		$school = $rows['school'];
	  		$experience = $rows['experience'];
	  		$skills = $rows['skills'];
	  		$profilePicture = $rows['profile_picture'];
	  		$description = $rows['description'];
	  		$image = $rows['profile_picture'];
	  		$target = "files/";
	  	}
	  	
	  	if(isset($_POST['save'])) {
	  		header('Location: '.$_SERVER['REQUEST_URI']);

	  		$fileExistsFlag = 0; 
			$fileName = $_FILES['profilePicture']['name'];
	  		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
	  		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);

			if ($_SESSION['type'] == 'Employer') {
				$company = mysqli_real_escape_string($db, $_POST['company']);	
			} else {
				$education_level = mysqli_real_escape_string($db, $_POST['education_level']);
				$school = mysqli_real_escape_string($db, $_POST['school']);
				$experience = mysqli_real_escape_string($db, $_POST['experience']);
		  		$skills = mysqli_real_escape_string($db, $_POST['skills']);
		  		$description = mysqli_real_escape_string($db, $_POST['description']);
		  		$salary = mysqli_real_escape_string($db, $_POST['salary']);
			}
			
	  		if($fileExistsFlag == 0) { 
				$target = "files/";		
				$fileTarget = $target.$fileName;
				$tempFileName = $_FILES["profilePicture"]["tmp_name"];
				$result = move_uploaded_file($tempFileName,$fileTarget);

				if($result) { 
					$sql_editProfilePic = "UPDATE tbl_users SET profile_picture='$fileName' WHERE id='$id'";
			  		mysqli_query($db, $sql_editProfilePic);

			  		if (count($errors) == 0) {
			  			?>
			  				<div class="success">
			  			<?php
								array_push($errors, 'Upload Successful.');
								include "server/errors.php";
						?>
							</div>
						<?php
					}	
				}
			}

			$sql_editProfile = "UPDATE tbl_users SET firstname='$firstname', lastname='$lastname', company='$company', education_level='$education_level',  school='$school', salary='$salary', experience='$experience', skills='$skills', description='$description' WHERE id='$id'";
		  		mysqli_query($db, $sql_editProfile);
		  		
		  		if (count($errors) == 0) {
		  			?>
		  				<div class="success">
		  			<?php
							array_push($errors, 'You have successfully edited your profile.');
							include "server/errors.php";
					?>
						</div>
					<?php
				}
	  		}
	  	?>

  		<form action="" method="post" enctype="multipart/form-data">
  			<div class="photo">
  				<?php if(empty($profilePicture)): ?>
  					<img src="images/users.svg" alt="Profile Picture">
  					<input id="file" type="file" name="profilePicture"/>
  				<?php else: ?>
  					
  					<img src="<?php echo $target.$image; ?>">
  					<input id="file" type="file" name="profilePicture"/>
  				<?php endif; ?>	
  			</div>
  			
	  		<input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="First Name *" required/>
	  		<input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Last Name *" required/>
	  		<?php if ($_SESSION['type'] == 'Employer'): ?>
	    		<input type="text" name="company" value="<?php echo $company; ?>" placeholder="Company Name *" required/>
	    	<?php else: ?>
	    		<input type="text" name="experience" value="<?php echo $experience; ?>" placeholder="Latest Job Title" required/>
	    		<input type="text" name="salary" value="<?php echo $salary; ?>" placeholder="Expected Salary (e.g $4 per hr) *" required/>
	    		<label>Education Level:</label>
	    		<select name="education_level" required>
	    			<option>Highschool Level</option>
	    			<option>College Level</option>
	    			<option>Bachelor's Degree</option>
	    			<option>Master's Degree</option>
	    		</select>
	    		<input type="text" name="school" value="<?php echo $school; ?>" placeholder="School *" required/>
	    		<label>Outline:</label>
	    		<textarea placeholder="Tell us about yourself." name="description" requred><?php echo $description; ?></textarea>
	    		<label>Skills:</label>
	    		<textarea placeholder="Skills Acquired (separate by comma e.g CSS, HTML5, etc)" name="skills" required><?php echo $skills; ?></textarea>
    		<?php endif; ?>
    		<button class="save-btn" type="submit" name="save">Save</button>
    	</form>

	  	<?php
	}

	function jobposted() {
		include "server/db_conn.php";

		$sql_getJobPosted =   "SELECT tbl_users.id, tbl_jobs.* FROM tbl_jobs, tbl_users WHERE tbl_jobs.user_posted_id = tbl_users.id ORDER BY tbl_jobs.id DESC ";

		$getJobPosted_query = mysqli_query($db, $sql_getJobPosted);

		if (mysqli_num_rows($getJobPosted_query) == 0) { 
			array_push($errors, 'No job posted available.');
			include "server/errors.php";
		} else {

			while ($rows = mysqli_fetch_array($getJobPosted_query)) {
				$title = $rows['title'];
			  	$date = $rows['date'];
			  	$id = $rows['id'];

			  	$sql_countApplication = "SELECT count(DISTINCT user_id) as applicants_count FROM tbl_jobapplication WHERE job_id='$id'";
				$countApplication_query = mysqli_query($db, $sql_countApplication);

				if ($rows = mysqli_fetch_array($countApplication_query)) { 
				    $applicants_count = $rows['applicants_count'];
				}

				?>
					<div>
						<span class="title"><?php echo $title; ?></span>
						<span class="date"><img src="images/calendar.png" alt="Date"><?php echo $date; ?></span>
						<span class="date"><?php echo 'Applied: '.$applicants_count; ?></span>
						<?php echo "<a href = 'applicants.php?id=".$id."'"; ?> title="Check Applicants">Check Applicants</a>
					</div>
				<?php
			}
		}
	}

	function applicants() {
		include "server/db_conn.php";

		$id = $_GET['id'];

		$sql_getJobTitle = "SELECT * FROM tbl_jobs WHERE id ='$id'";

		$getJobTitle_query = mysqli_query($db, $sql_getJobTitle);

		if ($rows = mysqli_fetch_array($getJobTitle_query)) {
			$title = $rows['title'];
		}

		?>
			<h1>Applicants for <b><?php echo $title; ?></b></h1>
		<?php

		$sql_getApplicants = "SELECT DISTINCT tbl_jobapplication.user_id as applicant_id, tbl_users.*, tbl_jobapplication.* FROM tbl_jobapplication, tbl_users WHERE tbl_jobapplication.job_id ='$id' AND tbl_jobapplication.user_id = tbl_users.id ORDER BY tbl_jobapplication.id DESC";

		$getApplicants_query = mysqli_query($db, $sql_getApplicants);
		

		if (mysqli_num_rows($getApplicants_query) == 0) { 
			array_push($errors, 'No applicants available.');
			include "server/errors.php";
		} else {
			while ($rows = mysqli_fetch_array($getApplicants_query)) {
				$applicant_id = $rows['applicant_id'];
			  	$firstname = $rows['firstname'];
			  	$lastname = $rows['lastname'];
			  	$salary = $rows['salary'];
			  	$experience = $rows['experience'];
			  	$description = $rows['description'];
			  	$education_level = $rows['education_level'];
			  	$school = $rows['school'];
			  	$profilePicture = $rows['profile_picture'];
			  	$target = 'files/';
			  	$file = $rows['filename'];
			  	$emp_status = $rows['emp_status'];

			  	$sql_applicantId = "SELECT id FROM tbl_users WHERE id = '$applicant_id'";

				$applicantId_query = mysqli_query($db, $sql_applicantId);

				while ($rows = mysqli_fetch_array($applicantId_query)) {
					$applicantId = $rows['id'];
				}
			?>
				<div class="jobseeker">
					<div class="photo">
	    				<?php if(empty($profilePicture)): ?>
		  					<img src="images/users.svg" alt="Profile Picture">
		  				<?php else: ?>
		  					
		  					<img src="<?php echo 'files/'.$profilePicture; ?>">
		  				<?php endif; ?>	
	    			</div>
	    			
	    			<div class="info">
	    				<div class="top-info">
	    					<span class="name"><?php echo $firstname . ' ' .$lastname; ?></span>

	    					<form action="" method="post">
							 	<select name="emp_status">
							 		<?php if(empty($emp_status)): ?>
							 			<option disabled selected>Select Status</option>
							 		<?php else: ?>
								    	<option disabled selected><?php echo $emp_status; ?></option>
								    <?php endif; ?>
								    <option>Application Received</option>
								    <option>Under Review</option>
								    <option>Interviewing</option>
								    <option>Job Offer</option>
								    <option>Hired</option>
								</select>

								<button type="submit" name="save" value="<?php echo $applicantId; ?>">Save</button>
							 </form>
							 <?php 
							 	if (isset($_POST['save'])) {
							 		header('Location: '.$_SERVER['REQUEST_URI']);

							 		$save = $_REQUEST['save'];

									$emp_status = mysqli_real_escape_string($db, $_POST['emp_status']);

									$sql_saveStatus = "UPDATE tbl_users SET emp_status='$emp_status' WHERE id='$save'";
				  					mysqli_query($db, $sql_saveStatus);	
								}
							 ?>
	    				</div>
	    				
	    				<div>
		    				<span class="headline">
		    					<img src="images/information.svg" alt="Information"/>
		    					<?php if(empty($experience)): ?>
			    					<?php echo 'No Info'; ?></span>
			    				<?php else: ?>
			    					<?php echo $experience; ?></span>
			    				<?php endif; ?>
		    				</span>
		    				<span class="salary">
		    					<img src="images/salary.png" alt="Salary"/>
		    					<?php if(empty($salary)): ?>
			    					<?php echo 'No Info'; ?></span>
			    				<?php else: ?>
			    					<?php echo $salary; ?></span>
			    				<?php endif; ?>
		    				</span>
		    				<span class="education-level">
		    					<img src="images/level.svg" alt="Education Level"/>
		    					<?php if(empty($education_level)): ?>
			    					<?php echo 'No Info'; ?></span>
			    				<?php else: ?>
			    					<?php echo $education_level; ?></span>
			    				<?php endif; ?>
		    					</span>
		    				<span class="school">
		    					<img src="images/building.svg" alt="School"/>
		    					<?php if(empty($school)): ?>
			    					<?php echo 'No Info'; ?></span>
			    				<?php else: ?>
			    					<?php echo $school; ?></span>
			    				<?php endif; ?>	
		    				</span>
	    				</div>
	    				<label>About me:</label>
		    			<span class="outline">
		    				<?php if(empty($description)): ?>
		    					<?php echo 'No information available.'; ?></span>
		    				<?php else: ?>
		    					<?php echo $description; ?>
		    				<?php endif; ?>
		    			</span>
		    			<div class="actions">
		    				<?php echo "<a href = 'messageform.php?id=".$applicantId."'"; ?> title="Send Messages">Send Message</a>
		    				<a href="<?php echo $target.$file; ?>" target="_blank">Download Resume</a>
		    			</div>
							
	    			</div>
				</div>
			<?php
			}
		}
	}

	function sendMessage() {
		include "server/db_conn.php";

		$receiverId = $_GET['id'];
		$senderId = $_SESSION['id'];

		$sql_getReceiver = "SELECT * FROM tbl_users WHERE id='$receiverId'";
		$getReceiver_query = mysqli_query($db, $sql_getReceiver);

		if($rows = mysqli_fetch_array($getReceiver_query)) {
			$firstname = $rows['firstname'];
			$lastname = $rows['lastname'];
		}

		if (isset($_POST['send'])) {
			$fileName = $_FILES['fileTarget']['name'];
	 		$message = mysqli_real_escape_string($db, $_POST['message']);
			$subject = mysqli_real_escape_string($db, $_POST['subject']);
			date_default_timezone_set('America/Denver');
			$dateTime = date('l m/d/Y H:i A', time());
			$target = "files/";		
			$fileTarget = $target.$fileName;
			$tempFileName = $_FILES["fileTarget"]["tmp_name"];
			$result = move_uploaded_file($tempFileName,$fileTarget);

			if (empty($result)) {
				$sql_sendMessage = "INSERT INTO tbl_messages (sender_id, receiver_id, message, subject, date_time, files) VALUES ('$senderId', '$receiverId', '$message', '$subject', '$dateTime', '$fileName')";
				mysqli_query($db, $sql_sendMessage);
				?>
					<div class="success">
				<?php
					array_push($errors, 'Message Sent');
					include "server/errors.php";
				?>
					</div>
				<?php
			} else {
				$allowedExts = array(
				  "pdf", 
				  "doc", 
				  "docx"
				); 

				$allowedMimeTypes = array( 
				  'application/msword',
				  'application/pdf',
				  'image/gif',
				  'image/jpeg',
				  'image/png'
				);

				if (!(in_array($fileName, $allowedExts)) && !(in_array($_FILES["fileTarget"]["type"], $allowedMimeTypes))) {
				  	array_push($errors, 'Message not sent. Please attach either of the ff: .pdf,.doc,.docx,.jpeg,.gif or .png');
					include "server/errors.php";
				} else {
					$result;
					$sql_sendMessage = "INSERT INTO tbl_messages (sender_id, receiver_id, message, subject, date_time, files) VALUES ('$senderId', '$receiverId', '$message', '$subject', '$dateTime', '$fileName')";
					mysqli_query($db, $sql_sendMessage);
					?>
						<div class="success">
					<?php
						array_push($errors, 'Message Sent');
						include "server/errors.php";
					?>
						</div>
					<?php
				}
			}
		}

		?>
			<h3>Send a message to <b><?php echo $firstname .' '. $lastname; ?></b></h3>
            <legend>Required Fields *</legend>	
            <form action="" method="post" enctype="multipart/form-data">
				<input type="text" name="subject" placeholder="Subject *" required autofocus />
	            <textarea name="message" placeholder="Compose your message *" requred></textarea>
	            <label>Attach a File (optional)</label>
	            <input type="file" name="fileTarget" />
	            <button type="submit" name="send">Send</button>
			</form>
		<?php
	}

	function messages() {
		include "server/db_conn.php";

		$id = $_SESSION['id'];

		$sql_getMessages = "SELECT DISTINCT subject,receiver_id FROM tbl_messages WHERE sender_id = '$id' ORDER BY id DESC";
		$getMessages_query = mysqli_query($db, $sql_getMessages);
		    

		if (mysqli_num_rows($getMessages_query) == 0) { 
			array_push($errors, 'No messages available.');
			include "server/errors.php";
		} else {
			while ($rows = mysqli_fetch_array($getMessages_query)) {
				$subject = $rows['subject'];
				$receiverId	 = $rows['receiver_id'];

				$sqlReceiver = mysqli_query($db, "SELECT * FROM tbl_messages WHERE receiver_id='$receiverId' And subject ='$subject'");
		        $data_receiver = mysqli_fetch_array ($sqlReceiver);
		     
		        $receiverId= $data_receiver['receiver_id'];

				?>
					<div class="messages">
						<span>Subject: </span>
						<a href="<?php echo 'messages.php?id='.$receiverId.''; ?>" title="<?php echo $subject; ?>"><?php echo $subject; ?></a>

						<span class="name">
							<?php 
								$sql_getUser = "SELECT id, firstname, lastname FROM tbl_users WHERE id = '$receiverId'";
								$getUser_query = mysqli_query($db, $sql_getUser);

								while ($rows = mysqli_fetch_array($getUser_query)) {
									$rowId = $rows['id'];
									$firstname = $rows['firstname'];
									$lastname = $rows['lastname'];

									echo 'Recepient: '.$firstname.' '.$lastname;
								}

							?>
						</span>
					</div>
				<?php
			}
		}
	}
	
	function conversation() {
		include "server/db_conn.php";

		$receiverId	= $_GET['id'];
		$id = $_SESSION['id'];

		$sql_getSubject = mysqli_query($db, "SELECT * FROM tbl_messages WHERE sender_id ='$receiverId' or receiver_id = '$receiverId' ORDER BY id DESC");
		$getSubject_query = mysqli_fetch_array ($sql_getSubject);
		$subject = $getSubject_query['subject']

		?><h3>Subject: <b><?php echo $subject; ?></b></h3>
		<div id="messagebox" class="messages-container">
		<?php

		$sql_Subject = "SELECT * FROM tbl_messages WHERE sender_id ='$receiverId' or receiver_id = '$receiverId'";
		$data_Subject = mysqli_query($db, $sql_Subject);
		
		while($row_subject = mysqli_fetch_array($data_Subject)){
			
			$sender = $row_subject['sender_id'];
			$receiver = $row_subject['receiver_id'];

			if($sender == $id or $receiver == $id){
				$message = $row_subject['message'];
				$dateTime = $row_subject['date_time'];
			    $rowFiles = $row_subject['files'];
				$filedbTarget = 'files/';

				$allowedExts = array(
				  "pdf", 
				  "doc", 
				  "docx",
				  "zip"
				);

				$allowedImgTypes = array( 
				  "gif",
				  "jpeg",
				  "png",
				  "jpg"
				);

				$pathinfo = pathinfo($rowFiles, PATHINFO_EXTENSION);

				$sqlgetNames = mysqli_query($db, "SELECT * FROM tbl_users WHERE id= '$sender'");
		        $getNames_query = mysqli_fetch_array ($sqlgetNames);
		     
		        $firstname = $getNames_query['firstname'];
		        $lastname = $getNames_query['lastname'];

		        ?>
		        <?php if($receiver == $receiverId): ?>
		        	<div class="messages sender">
		        		<span class="name"><?php echo "@ME"; ?></span>

						<span class="date-time"><?php echo $dateTime; ?></span>

						<span class="message"><?php echo $message; ?></span>

						<div class="files">
							<?php if(in_array($pathinfo, $allowedExts)): ?>
								<a href="<?php echo $filedbTarget.$rowFiles; ?>"><?php echo $rowFiles; ?></a>
							<?php endif; ?>

							<?php if(in_array($pathinfo, $allowedImgTypes)): ?>
								<img id="msg_img" src="<?php echo $filedbTarget.$rowFiles; ?>" class="message-img" />
							
								<div id="zoom_modal_ontainer" class="modal-zoom">
								  <span class="close">&times;</span>

								  <div class="zoom-content-container">
								  	<img id="img_zoom" src="<?php echo $filedbTarget.$rowFiles; ?>" />
								  </div>
								</div>
							<?php endif; ?>
						</div>
					</div>
		        <?php else: ?>
		        	<div class="messages receiver">
		        		<span class="name"><?php echo '@'.$firstname.''.$lastname; ?></span>

						<span class="date-time"><?php echo $dateTime; ?></span>

						<span class="message"><?php echo $message; ?></span>

						<div class="files">
							<?php if(in_array($pathinfo, $allowedExts)): ?>
								<a href="<?php echo $filedbTarget.$rowFiles; ?>"><?php echo $rowFiles; ?></a>
							<?php endif; ?>

							<?php if(in_array($pathinfo, $allowedImgTypes)): ?>
								<img id="msg_img" src="<?php echo $filedbTarget.$rowFiles; ?>" class="message-img" />
							
								<div id="zoom_modal_ontainer" class="modal-zoom">
								  <span class="close">&times;</span>

								  <div class="zoom-content-container">
								  	<img id="img_zoom" src="<?php echo $filedbTarget.$rowFiles; ?>" />
								  </div>
								</div>
							<?php endif; ?>
						</div>

		        	</div>
		        <?php endif; ?>	
		    <?php }
		}?></div>
		<div class="actions">
			<?php 
			$sqlUser= mysqli_query($db, "SELECT * FROM tbl_users WHERE id ='$receiverId'");
			$dataUser = mysqli_fetch_array ($sqlUser);
			 ?>
				<label>Send a reply to <?php echo '@'.$dataUser['firstname'].''.$dataUser['lastname']; ?>:</label>

				<form action="" method="post" enctype="multipart/form-data">
					<textarea name="message" placeholder="Enter message *" required autofocus></textarea>
					<input type="file" name="fileTarget" />
					<button type="submit" name="send">Send</button>

					<?php 
						if (isset($_POST['send'])) {
							header('Location: '.$_SERVER['REQUEST_URI']);

							$fileName = $_FILES['fileTarget']['name'];
					 		$message = mysqli_real_escape_string($db, $_POST['message']);
							$subject = mysqli_real_escape_string($db, $subject);
							date_default_timezone_set('America/Denver');
							$dateTime = date('l m/d/Y H:i A', time());
							$target = "files/";		
							$fileTarget = $target.$fileName;
							$tempFileName = $_FILES["fileTarget"]["tmp_name"];
							$result = move_uploaded_file($tempFileName,$fileTarget);

							if (empty($result)) {
								$sql_sendMessage = "INSERT INTO tbl_messages (sender_id, receiver_id, message, subject, date_time, files) VALUES ('$id', '$receiverId', '$message', '$subject', '$dateTime', '$fileName')";
								mysqli_query($db, $sql_sendMessage);
								
								?>
									<div class="success">
								<?php
									array_push($errors, 'Message Sent');
									include "server/errors.php";
								?>
									</div>
								<?php
							} else {
								$allowedExts = array(
								  "pdf", 
								  "doc", 
								  "docx",
								  "zip"
								); 

								$allowedImgTypes = array( 
								  'image/gif',
								  'image/jpeg',
								  'image/png'
								);

								if (!(in_array($fileName, $allowedExts)) && !(in_array($_FILES["fileTarget"]["type"], $allowedImgTypes))) {
								  	array_push($errors, 'Message not sent. Please attach either of the ff: .pdf, .doc, .docx, .jpeg, .gif, .zip or .png');
									include "server/errors.php";
								} else {
									$result;
									$sql_sendMessage = "INSERT INTO tbl_messages (sender_id, receiver_id, message, subject, date_time, files) VALUES ('$id', '$receiverId', '$message', '$subject', '$dateTime', '$fileName')";
									mysqli_query($db, $sql_sendMessage);
									
									?>
										<div class="success">
									<?php
										array_push($errors, 'Message Sent');
										include "server/errors.php";
									?>
										</div>
									<?php
								}
							}
						}
					?>
				</form>
			</div>
		<?php
	}

	function applications() {
		include "server/db_conn.php";

		$id = $_SESSION['id'];

		$sql_getApplications = "SELECT DISTINCT tbl_jobapplication.*, tbl_jobs.title, tbl_users.emp_status FROM tbl_jobapplication, tbl_jobs, tbl_users WHERE tbl_jobapplication.job_id = tbl_jobs.id AND tbl_jobapplication.user_id = '$id' AND tbl_users.id = '$id' ORDER BY tbl_jobapplication.id DESC";
		$getApplication_query = mysqli_query($db, $sql_getApplications);

		if (mysqli_num_rows($getApplication_query) == 0) { 
			array_push($errors, 'No applications available.');
			include "server/errors.php";
		} else {

			while ($rows = mysqli_fetch_array($getApplication_query)) {
				$title = $rows['title'];
				$empStatus = $rows['emp_status'];
				$jobId = $rows['job_id'];
				$dateApplied = $rows['date_applied'];

				?>
				<div class="applications">
					<a href="<?php echo 'info.php?id='.$jobId.''; ?>" /><?php echo $title; ?></a>
					<span>Application Status: <?php echo $empStatus; ?></span>
					<span>Date Applied: <?php echo $dateApplied; ?></span>
				</div>	
				<?php
			}
		}
	}

	function jobCategories() {
		include "server/db_conn.php";

		$sql_getJobCategories = "SELECT * FROM tbl_categories";
		$getJobCategories_query = mysqli_query($db, $sql_getJobCategories);

		?>
		<select name="category">
			<?php
			while ($rows = mysqli_fetch_array($getJobCategories_query)) {
				$name = $rows['cat_name'];
				
				?>
				<option value="<?php echo $rows['id']; ?>"><?php echo $name; ?></option>
				<?php
			}
		?>
		</select>
		<?php
	}

	function categorySearch() {
		include "server/db_conn.php";

		if (isset($_POST['categorySearch'])) {

			$categorySearch = mysqli_real_escape_string($db, $_POST['category']);
			$jobKeywords = mysqli_real_escape_string($db, $_POST['keywordSearch']);

			$sqlCategoryCheck = mysqli_query($db, "SELECT * FROM tbl_jobs WHERE category = '$categorySearch'");
			$dataCategoryCheck = mysqli_fetch_array($sqlCategoryCheck);
			$categoryID = $dataCategoryCheck['category'];

			$sqlCategory = mysqli_query($db,"SELECT * FROM tbl_categories WHERE id ='$categoryID'");
			$dataCategory = mysqli_fetch_array($sqlCategory);
			$categoryName = $dataCategory['cat_name'];

			$sql = "SELECT * FROM tbl_jobs WHERE title LIKE ?";

			?>
				<button class="back-btn" onclick="history.go(-1);"><i class="fa fa-caret-left"></i>Back</button>

			 	<h3>You search for: <b><?php echo $jobKeywords ?></b></h3>

			 	<div class="jobpost-container">
			 <?php

			 if($stmt = mysqli_prepare($db , $sql)){
			 	mysqli_stmt_bind_param($stmt, "s" , $param_term);

			 	$param_term = $_REQUEST['keywordSearch'] . "%";

			 	if(mysqli_stmt_execute($stmt)){
			 		$result = mysqli_stmt_get_result($stmt);

			 		if(mysqli_num_rows($result) > 0){
			 			while($row = mysqli_fetch_array($result , MYSQLI_ASSOC)){
			 				if($categorySearch == $categoryID){
				 				$title = $row['title'];
				 				$date = $row['date'];
				 				$date = $row['type'];
				 				$salary = $row['salary'];
				 				$description = $row['description'];
				 				
				 				?>
				 					<div class="jobpost">
										<span class="category"><?php echo $categoryName; ?></span>
										<span class="jobtitle"><?php echo $title; ?></span>
						    			<span class="date"><img src="images/calendar.png"><?php echo $date; ?></span>
						    			<span class="type"><img src="images/jobtype.svg"><?php echo $title; ?></span>
						    			<span class="salary"><img src="images/salary.png">$<?php echo $salary; ?>/hr</span>
						    			<label>Overview:</label>
						    			<span class="description"><?php echo $description; ?></span>
						    			<?php echo "<a href = 'readmore.php?id=".$categoryID."'>"?>Read More</a>
									</div>
				 				<?php
			 				} else {
					 		 	array_push($errors, 'No available jobs.');
								include "server/errors.php";
					 		}
			 			}
			 		} else {
			 		 	array_push($errors, 'No available jobs.');
						include "server/errors.php";
			 		}
			 	}
			 }

			 mysqli_stmt_close($stmt);
			 ?></div><?php
			 
		} else {
			$sql_allJobs = mysqli_query($db, "SELECT * FROM tbl_jobs, tbl_categories WHERE tbl_categories.id = tbl_jobs.category");

			?>
				<button class="back-btn" onclick="history.go(-1);"><i class="fa fa-caret-left"></i>Back</button>
				<h3>Available Jobs</h3>
				<div class="jobpost-container">
			<?php
				
			while ($allJobs_query = mysqli_fetch_array($sql_allJobs)) {
				$categoryID = $allJobs_query['category'];
				$categoryName = $allJobs_query['cat_name'];
				$title = $allJobs_query['title'];
 				$date = $allJobs_query['date'];
 				$type = $allJobs_query['type'];
 				$salary = $allJobs_query['salary'];
 				$description = $allJobs_query['description'];

 				?>
 					<div class="jobpost">
						<span class="category"><?php echo $categoryName; ?></span>
						<span class="jobtitle"><?php echo $title; ?></span>
		    			<span class="date"><img src="images/calendar.png"><?php echo $date; ?></span>
		    			<span class="type"><img src="images/jobtype.svg"><?php echo $type; ?></span>
		    			<span class="salary"><img src="images/salary.png">$<?php echo $salary; ?>/hr</span>
		    			<label>Overview:</label>
		    			<span class="description"><?php echo $description; ?></span>
		    			<?php echo "<a href = 'readmore.php?id=".$categoryID."'>"?>Read More</a>
					</div>
 				<?php 
 				?></div><?php
			}
		}
	}

	function categoryNames() {
		include "server/db_conn.php";

		$sql_displayCategoryNames = "SELECT * FROM tbl_categories";
		$displayCategoryNames_query = mysqli_query($db, $sql_displayCategoryNames);

		while ($rows = mysqli_fetch_array($displayCategoryNames_query)) {
			$categoryId = $rows['id'];
			$categoryName = $rows['cat_name'];

			$sql_getCatName = mysqli_query($db, "SELECT count(*) as category_count FROM tbl_jobs WHERE category = '$categoryId'");
	        $getCatName_query = mysqli_fetch_array ($sql_getCatName);
	     
	        $categoryCount= $getCatName_query['category_count'];

			?>
				<div class="categories">
					<div>
						<img src="images/category-icon.svg">
						<span><?php echo $categoryName; ?></span>
						<span>(<?php echo $categoryCount; ?> jobs available)</span>
					</div>

					<?php echo "<a class='see-all-btn' href = 'browse.php?id=".$categoryId."'>"?>Browse<i class="fa fa-caret-right"></i></a>
				</div>
			<?php
		}
	}

	function browseCategories() {
		include "server/db_conn.php";

		$categoryId = $_GET['id'];

		$sql_jobsByCategory = "SELECT * FROM tbl_jobs WHERE category = '$categoryId'";
		$jobsByCategory_query = mysqli_query($db, $sql_jobsByCategory);

		$sqlCategory = mysqli_query($db,"SELECT * FROM tbl_categories WHERE id ='$categoryId'");
			$dataCategory = mysqli_fetch_array($sqlCategory);
			$categoryName = $dataCategory['cat_name'];

			?>
				<button class="back-btn" onclick="history.go(-1);"><i class="fa fa-caret-left"></i>Back</button>

			 	<h3>Available Jobs for: <b><?php echo $categoryName ?></b></h3>

			 	<div class="jobpost-container">
			<?php

				if (mysqli_num_rows($jobsByCategory_query) == 0) { 
					array_push($errors, 'No jobs available.');
					include "server/errors.php";
				} else {
					while ($rows = mysqli_fetch_array($jobsByCategory_query)) {
						$title = $rows['title'];
						$date = $rows['date'];
						$type = $rows['type'];
						$salary = $rows['salary'];
						$description = $rows['description'];

						?>
		 					<div class="jobpost">
								<span class="category"><?php echo $categoryName; ?></span>
								<span class="jobtitle"><?php echo $title; ?></span>
				    			<span class="date"><img src="images/calendar.png"><?php echo $date; ?></span>
				    			<span class="type"><img src="images/jobtype.svg"><?php echo $type; ?></span>
				    			<span class="salary"><img src="images/salary.png">$<?php echo $salary; ?>/hr</span>
				    			<label>Overview:</label>
				    			<span class="description"><?php echo $description; ?></span>
				    			<?php echo "<a href = 'readmore.php?id=".$categoryId."'>"?>Read More</a>
							</div>
		 				<?php
					}
				}
		?>
			</div>
		<?php
	}
?>