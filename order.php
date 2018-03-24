<?php
	session_start();
	define('TITLE', "Order | Franklin's Fine Dining");
	include('includes/header.php');
?>

<h1>Order</h1>
<p>Get into our records to place an order &mdash; bet you won't regret it!</p>

<hr>

<?php

	function validEmail($str){
		return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}
	if(isset($_POST['register_submit'])){
		$name=trim($_POST['name']);
		$email=trim($_POST['email']);
		$pass=$_POST['pass'];
		$cpass=$_POST['cpass'];
		$addr=$_POST['address'];
		$captcha=$_POST['captcha'];

		if(!$name || !$email || !$pass || !$cpass || !$addr || !$captcha){
			echo '<h4 class="error"><center>All fields required.</center></h4><center><a href="order.php" class="button block">Go back and try again</a></center>';
			exit;
		}

		else if(!validEmail($email)){
			echo "<h4 class='error'><center>Email not in proper format</center></h4><center><a href='order.php' class='button block'>Go back and try again</a></center>";
			exit;
		}

		else if($pass!=$cpass){
			echo "<h4 class='error'><center>Passwords don't match.</center></h4><center><a href='order.php' class='button block'>Go back and try again</a></center>";
			exit;
		}

		else if($captcha!=$_SESSION['my_captcha']){
			echo "<h4 class='error'><center>Captcha doesn't match.</center></h4><center><a href='order.php' class='button block'>Go back and try again</a></center>";
			exit;
		}

		else{
			$con=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
			mysqli_select_db($con, 'user-registration') or die("Cannot selet database");

			$query=mysqli_query($con, "SELECT * FROM users WHERE email='".$email."'");
			$numrows=mysqli_num_rows($query);

			if($numrows==0){
				$sql="INSERT INTO users(name, email, password, address) VALUES('$name', '$email', '$pass', '$addr')";

				$result=mysqli_query($con, $sql);
				if($result){
					echo "<h4><center>Welcome to our records! <a href='login.php' style='text-decoration: none;'>Click here to Login</a></center></h4>";
				}
				else{
					"Oops! Try Again.";
				}
			}
			else{
				echo "<center>That email address is already registered! Please try again with another.<center>";
			}
		}


	}
?>


<center>
<form method="post" action="" id="contact-form">
			<label for="name">Your name</label>
			<input type="text" name="name" id="name">

			<label for="email">Your email</label>
			<input type="text" name="email" id="email">

			<label for="pass">Password</label>
			<input type="password" name="pass" id="pass">

			<label for="cpass">Confirm Password</label>
			<input type="password" name="cpass" id="cpass">

			<label for="address">Address</label>
			<textarea id="address" name="address"></textarea><br><br>

			<img src="captcha.php" width="325" height="80" style="text-align: center;"><br><br>
			<input type="text" name="captcha" placeholder="Fill the code above">
			<br>
			
			<a href="login.php" style="text-decoration: none;">Already in our records? Login here!</a>

			<input type="submit" name="register_submit" class="button next" value="Sign Up" style="width: 47%;">

</form>
</center>
<hr>

<?php
	include('includes/footer.php');
?>