<?php
	define("TITLE", "Edit Password | Franklin's Fine Dining");
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

<h1>Edit Password</h1>
<hr>

<center>
<form method="post" action="" id="contact-form">
	<label for="oldpass">Current Password</label>
	<input type="text" name="oldpass" id="oldpass" style="text-align: center;">
	<label for="email">Email</label>
	<input type="email" name="email" id="email" style="text-align: center;">
	<label for="newname">Enter New Password</label>
	<input type="password" name="newpass" id="newpass" style="text-align: center;">
	<input type="submit" name="pass_submit" class="button next" value="Change Password" style="width: 47%;">
</form>
<?php
	if(isset($_POST['pass_submit'])){
		$oldPass=$_POST['oldpass'];
		$newPass=$_POST['newpass'];
		$email=$_POST['email'];
		if(!$newPass || !$email || !$oldPass){
			echo '<h4 class="error"><center>All fields required.</center>';
		}
		else{
			$con=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
			mysqli_select_db($con, 'user-registration') or die("Cannot select database");

			$query=mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$oldPass'");
			$numrows=mysqli_num_rows($query);
			if($numrows==0){
				echo '<h4 class="error"><center>Current Password is wrong!</center>';
			}
			else{
				$sql_query=mysqli_query($con, "UPDATE users SET password='$newPass' WHERE email='$email'");
				if($sql_query){
				echo "<h5><center>Your password has successfully been changed! Changes will appear next time you log in.</center></h5>";
				}
				else{
					echo "Oops! Try Again!";
				}
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