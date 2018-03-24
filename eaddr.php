<?php
	define("TITLE", "Edit Address | Franklin's Fine Dining");
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

<h1>Edit Address</h1>
<hr>

<center>
<form method="post" action="" id="contact-form">
	<label for="oldaddr">Current Address</label>
	<textarea id="oldaddr" name="oldaddress" placeholder="<?= $_SESSION['sess_addr']; ?>" style="text-align: center;"></textarea>
	<label for="email">Email</label>
	<input type="email" name="email" id="email" style="text-align: center;">
	<label for="newaddr">Enter New Address</label>
	<textarea id="newaddr" name="newaddress" style="text-align: center;"></textarea>
	<input type="submit" name="address_submit" class="button next" value="Change Address" style="width: 47%;">
</form>
<?php
	if(isset($_POST['address_submit'])){
		$newAddr=$_POST['newaddress'];
		$email=$_POST['email'];
		if(!$newAddr || !$email){
			echo '<h4 class="error"><center>All fields required.</center>';
		}
		else{
			$con=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
			mysqli_select_db($con, 'user-registration') or die("Cannot select database");

			$query=mysqli_query($con, "UPDATE users SET address='$newAddr' WHERE email='$email'");

			if($query){
				echo "<h5><center>Your address has successfully been changed! Changes will appear next time you log in.</center></h5>";
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