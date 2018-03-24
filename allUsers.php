<?php
	session_start();
	if(!isset($_SESSION['sess_email'])){
		header("location: login.php");
	}
	else{
?>

<?php
	define("TITLE","Previous Orders | Franklin's Fine Dining");
	include('includes/header.php');
	$email=$_SESSION['sess_email'];
?>

<?php
	$con=mysqli_connect('localhost', 'root', '') or die(mysqli_error());
	mysqli_select_db($con, 'user-registration') or die("Cannot select database");
	$sql="SELECT * FROM users";
	$result=mysqli_query($con, $sql);
?>

<center><h4>Welcome, <?= $_SESSION['sess_name']; ?></h4></center>
<br><br><br>
<center>
	<div id="nav"> 
		<?php include('includes/adminProfileNav.php'); ?>
	</div><!--nav-->
	<br><br>
</center>

<h1>All Customers</h1>
<hr>
	<table style="margin-top: 0px; text-align: center;">
		<tr>
			<th>Name</th>
			<th>Email ID</th>
			<th>Address</th>
			<th>Credits</th>
		</tr>
		<?php
				while($row=mysqli_fetch_assoc($result)){
					$na=$row['name'];
					$em=$row['email'];
					$cs=$row['address'];
					$ds=$row['credits'];
					echo "<tr><td>$na</td><td>$em</td><td>$cs</td><td>$ds</td></tr>";
				}	
		?>
	</table>
<hr>

<?
	}
	include('includes/footer.php');
?>
