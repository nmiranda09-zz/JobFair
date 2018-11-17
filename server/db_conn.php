<?php
	$db = mysqli_connect('localhost', 'root', '', 'jobfair_db') or die('Could not connect to database');

	if ($db->connect_error) {
	    die("Connection failed: " . $db->connect_error);
	} 

	$errors = array();
?>