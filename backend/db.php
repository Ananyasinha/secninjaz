<?php 
	session_start();

	$timezone = "Asia/Calcutta";
	date_default_timezone_set($timezone);
	$datetime = date('Y-m-d H:i:s');
	$date     = date('Y-m-d');

	$host 	  = "localhost";
	$user 	  = "root";
	$pass 	  = "";
	$db 	  = "secninjaz";
	
	$conn 	  = new mysqli($host,$user,$pass,$db);

?>