<?php
	define('TITLE', "Login | Franklin's Fine Dining");
	include('includes/header.php');
?>

<h1>Login</h1>
<p>You are just one step away from treating yourself!</p>

<hr>

<?php
	if(isset($_POST['login_submit'])){
		$email=trim($_POST['email']);
		$pass=$_POST['pass'];

		if(!$email || !$pass){
			echo '<h4 class="error"><center>All fields required.</center></h4><center><a href="login.php" class="button block">Go back and try again</a></center>';
			exit;
		}
		else{
			$con=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
			mysqli_select_db($con, 'user-registration') or die("Cannot select database");

			$query=mysqli_query($con, "SELECT * FROM users WHERE email='".$email."' AND password='".$pass."'");
			$numrows=mysqli_num_rows($query);
			if($numrows!=0){
				while($row=mysqli_fetch_assoc($query)){
					$dbemail=$row['email'];
					$dbpass=$row['password'];
					$name=$row['name'];
					$addr=$row['address'];
				}

				if($email==$dbemail && $pass==$dbpass){
					session_start();
					$_SESSION['sess_name']=$name;
					$_SESSION['sess_email']=$dbemail;
					$_SESSION['sess_addr']=$addr;
					$_SESSION['sess_pwd']=$dbpass;
					header("Location: orderMenu.php");
				}
			}
			else{
					echo '<h4 class="error"><center>Invalid Email or Password! Please try again.</center></h4>';;
			}
		}
	}
?>
<center>
	<form method="post" action="" id="contact-form">
		<label for="email">Email</label>
		<input type="email" name="email" id="email">

		<label for="pass">Password</label>
		<input type="password" name="pass" id="pass">

		<input type="submit" name="login_submit" class="button next" value="Login" style="width: 47%;">
	</form>
<center>

<hr>

<?php
	include('includes/footer.php');
?>
