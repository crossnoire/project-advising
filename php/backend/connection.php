<?php
	define("HOST", "localhost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DB", "project-advising");
	$conn = mysqli_connect(HOST, DBUSER, DBPASS, DB);
		 if ($conn->connect_errno) {
	         die("ERROR : -> ".$con->connect_error);
	     }


?>