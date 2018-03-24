<?php
	define("TITLE", "Edit Name | Franklin's Fine Dining");
	include('includes/header.php');
?>

<?php
	session_start();
	if(!isset($_SESSION['sess_email'])){
		header("location: login.php");
	}
	else{
?>

<center><h4>Welcome, <?= $_SESSION['sess_name']; ?></h4></center>
<br><br><br>
<center>
	<div id="nav"> 
		<?php include('includes/adminProfileNav.php'); ?>
	</div><!--nav-->
	<br><br>
</center>

<h1>Admin Profile</h1>
<hr>

<center>
<form method="post" action="" id="contact-form">
	<label for="name">Your Name</label>
	<input type="text" name="name" id="name" value="<?= $_SESSION['sess_name']; ?>" style="text-align: center;">
	<label for="email">Email</label>
	<input type="email" name="email" id="email" value="<?= $_SESSION['sess_email']; ?>" style="text-align: center;">
	<label for="address">Enter New Name</label>
	<textarea id="address" name="address" placeholder="<?= $_SESSION['sess_addr']; ?>" style="text-align: center;"></textarea>
</form>
<hr>
</center>

<?php
	}
	include('includes/footer.php');
?>