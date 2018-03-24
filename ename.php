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
		<?php include('includes/userProfileNav.php'); ?>
	</div><!--nav-->
	<br><br>
	<div id="nav"> 
		<?php include('includes/userNav.php'); ?>
	</div><!--nav-->
	<br><br>
	<div id="nav"> 
		<?php include('includes/userEditNav.php'); ?>
	</div><!--nav-->
</center>

<h1>Edit Name</h1>
<hr>

<center>
<form method="post" action="" id="contact-form">
	<label for="oldname">Current Name</label>
	<input type="text" name="oldname" id="oldname" value="<?= $_SESSION['sess_name']; ?>" style="text-align: center;">
	<label for="email">Email</label>
	<input type="email" name="email" id="email" style="text-align: center;">
	<label for="newname">Enter New Name</label>
	<input type="text" name="newname" id="newname" style="text-align: center;">
	<input type="submit" name="name_submit" class="button next" value="Change Name" style="width: 47%;">
</form>
<?php
	if(isset($_POST['name_submit'])){
		$newName=$_POST['newname'];
		$email=$_POST['email'];
		if(!$newName || !$email){
			echo '<h4 class="error"><center>All fields required.</center>';
		}
		else{
			$con=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
			mysqli_select_db($con, 'user-registration') or die("Cannot select database");

			$query=mysqli_query($con, "UPDATE users SET name='$newName' WHERE email='$email'");

			if($query){
				echo "<h5><center>Your name has successfully been changed! Changes will appear next time you log in.</center></h5>";
			}
			else{
				echo "Oops! Try Again!";
			}
		}
	}
?>
<hr>
</center>

<?php
	}
	include('includes/footer.php');
?>