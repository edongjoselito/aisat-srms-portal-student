<?php
  defined('DB_SERVER')? null : define('DB_SERVER', 'localhost');
  defined('DB_USER')? null : define('DB_USER', 'aisatpor_srms');
  defined('DB_PASS')? null : define('DB_PASS', '^dO-70(NO7U&');
  defined('DB_NAME')? null : define('DB_NAME', 'aisatpor_srms');

  $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if(mysqli_connect_errno()){
  	die("Database connection failed:" .
  	mysqli_connect_error() 
  	. "(" . mysqli_connect_errno . ")"
	  );
  }
?>