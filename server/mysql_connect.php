<?php
// 1. create a database connection
	$db_host = "localhost";
	$db_username = "vanity_sm";
	$db_pass = "murdoc06";
	$db_name = "vanity_sm";
	
//connect to database
	$connection = @mysqli_connect("$db_host","$db_username","$db_pass", "$db_name");
// Test if connection occured
	if(mysqli_connect_errno()){
		die("Database connection failed: ".
			mysqli_connect_error() .
			" (" . mysqli_connect_errno() . ")"
		);
	}
	
?>