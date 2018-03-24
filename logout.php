<?php   
	session_start();  
	unset($_SESSION['sess_name']);  
	session_destroy();  
	header("location:login.php");  
?> 