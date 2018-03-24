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


<?php
	$email=$_SESSION['sess_email'];
	$con3=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
		mysqli_select_db($con3, 'user-registration') or die("Cannot select database");

		$result4=mysqli_query($con3, "SELECT * FROM users WHERE email='$email'");
		$numRows=mysqli_num_rows($result4);
		if($numRows!=0){
			while($row1=mysqli_fetch_assoc($result4)){
				$storeCredits=$row1['credits'];
			}
		}
?>
<!-- <a href="logout.php" style="text-decoration: none; float: right;" class="button next">Logout?</a><br> -->

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
<?php
	if(isset($_POST['order_submit'])){
		$qclub=$_POST['club'];
		$qdill=$_POST['dill'];
		$qsuper=$_POST['super'];
		$qmexican=$_POST['mexican'];
		$qtotal=(80*$qclub+120*$qdill+210*$qsuper+180*$qmexican);
		$email=$_SESSION['sess_email'];
		$credits=0;

		$con=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
		mysqli_select_db($con, 'user-order') or die("Cannot select database");

		$sql="SELECT * FROM orders WHERE email='$email'";
		$result=mysqli_query($con, $sql);
		$numrows=mysqli_num_rows($result);

		if($numrows%2!=0){
			$credits+=50;
		}

		if($qclub || $qdill || $qsuper || $qmexican !=0){
			$query=mysqli_query($con, "INSERT INTO orders(email, clubsandwich, dillsalmon, supersalad, mexicanbarbacoa, total) VALUES('$email', '$qclub', '$qdill', '$qsuper', '$qmexican', '$qtotal')");

		if($query){
			echo "<h4><center>Your order has been placed!</center></h4><center><h3>Total amount to be paid= Rs.$qtotal</h3></center>";
			$finalCredits=$storeCredits+$credits;
			$sql3="UPDATE users SET credits='$finalCredits' WHERE email='$email'";
			$result3=mysqli_query($con3, $sql3);
			if($result3){
				echo "<center><h4>You receive 50 credits for every 2nd purchase.</h4></center>";
			}
			else{
				echo "Oops!";
			}
		}
		else{
			echo "Oops! Try again!";
		}
		}	
		else{
			echo "<h4><center>You need to select atleast one item!</center></h4>";
		}
		
	}

	else if(isset($_POST['order_submit2'])){
		$qclub=$_POST['club'];
		$qdill=$_POST['dill'];
		$qsuper=$_POST['super'];
		$qmexican=$_POST['mexican'];
		$qtotal=(80*$qclub+120*$qdill+210*$qsuper+180*$qmexican);
		$email=$_SESSION['sess_email'];
		$credits=0;

		$con=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
		mysqli_select_db($con, 'user-order') or die("Cannot select database");

		$sql="SELECT * FROM orders WHERE email='$email'";
		$result=mysqli_query($con, $sql);
		$numrows=mysqli_num_rows($result);

		if($numrows%2!=0){
			$credits+=50;
		}

		if($qclub || $qdill || $qsuper || $qmexican !=0){
			if($storeCredits==0){
				echo "<h4><center>You dont have enough credits.</center></h4><center><h3>Choose cash on delivery instead</h3></center>";
			}
			else{
				$query=mysqli_query($con, "INSERT INTO orders(email, clubsandwich, dillsalmon, supersalad, mexicanbarbacoa, total) VALUES('$email', '$qclub', '$qdill', '$qsuper', '$qmexican', '$qtotal')");
			$amountPaid=$qtotal-$storeCredits;

			if($query){
				if($qtotal>$storeCredits){
					echo "<h4><center>Your order has been placed!</center></h4><center><h3>Total amount left to be paid on delivery = Rs.$amountPaid</h3></center>";
					$storeCredits=0;
					$sql3="UPDATE users SET credits='$storeCredits' WHERE email='$email'";
					$result3=mysqli_query($con3, $sql3);
					if(!$result3){
					    echo "Oops!";
					}
				}
				else{
					echo "<h4><center>Your order has been placed!</center></h4>";
					$finalCredits=$storeCredits-$qtotal	;
					$sql3="UPDATE users SET credits='$finalCredits' WHERE email='$email'";
					$result3=mysqli_query($con3, $sql3);
					if($result3){
						echo "<center><h4>You receive 50 credits for every 2nd purchase.</h4></center>";
					}
					else{
						echo "Oops!";
					}
				}
				
			}
			else{
				echo "Oops! Try again!";
			}
		}
			}

			
		else{
			echo "<h4><center>You need to select atleast one item!</center></h4>";
		}
	}
?>

<div id="menu-items">
<form method="post" action="" id="contact-form">
	<br>
	<h2>Our Delicious Menu</h2>
	<p>Like our team, our menu is small &mdash; but dang, does it ever pack a punch!</p>
	<p><em>Click any menu item to learn more about it.</em></p>
	<hr>
	<ul>
		<li>
			<a href="dish.php?item=club-sandwich">Club Sandwich</a><sup> Rs.</sup>80
	  		<input type="number" value="0" min="0" name="club" style="text-align: right; width: 50px;"/>
		</li>
		<li>
			<a href="dish.php?item=dill-salmon">Lemon  Dill Salmon </a><sup> Rs.</sup>120
	  		<input type="number" value="0" min="0" name="dill" style="text-align: right; width: 50px;"/>
		</li>
		<li>
			<a href="dish.php?item=super-salad">The Super Salad</a><sup> Rs.</sup>210
	  		<input type="number" value="0" min="0" name="super" style="text-align: right; width: 50px;"/>
		</li>
		<li>
			<a href="dish.php?item=club-sandwich">Mexican Barbacoa</a><sup> Rs.</sup>180
	  		<input type="number" value="0" min="0" name="mexican" style="text-align: right; width: 50px;"/>
		</li>
		<li>
			Your Credits = Rs. 
			<?php
				$con3=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
				mysqli_select_db($con3, 'user-registration') or die("Cannot select database");

				$result4=mysqli_query($con3, "SELECT * FROM users WHERE email='$email'");
				$numRows=mysqli_num_rows($result4);
				if($numRows!=0){
					while($row1=mysqli_fetch_assoc($result4)){
						$updatedCredits=$row1['credits'];
					}
				}else{
					$updatedCredits=0;
				}
				echo "$updatedCredits";	
			?>
		</li>
	</ul>	

<center><input type="submit" name="order_submit" class="button next" value="Cash on Delivery" style="width: 47%;"></center>
<center><input type="submit" name="order_submit2" class="button next" value="Pay using Credits" style="width: 47%;"></center>
</form>
</div>

<?php
	}
	include('includes/footer.php');
?>