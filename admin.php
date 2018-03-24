<?php
	session_start();
	if(!isset($_SESSION['sess_email'])){
		header("location: login.php");
	}
	else{
?>

<?php
	define("TITLE", "Order | Franklin's Fine Dining");
	include('includes/header.php');
?>

<center><h4>Welcome, <?= $_SESSION['sess_name']; ?></h4></center>
	<br><br><br>
<center>

	<div id="nav"> 
		<?php include('includes/adminProfileNav.php'); ?>
	</div><!--nav-->
	<br><br>
</center>

<?php
}
	include('includes/footer.php');
?>