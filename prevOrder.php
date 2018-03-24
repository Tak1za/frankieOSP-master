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
	mysqli_select_db($con, 'user-order') or die("Cannot select database");
	$sql="SELECT * FROM orders WHERE email='$email'";
	$result=mysqli_query($con, $sql);
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

<h1>Previous Orders</h1>
<hr>
	<table style="margin-top: 0px; text-align: center;">
		<tr>
			<th>Date-Time</th>
			<th>Email ID</th>
			<th>Club Sandwich</th>
			<th>Dill Salmon</th>
			<th>Super Salad</th>
			<th>Mexican Barbacoa</th>
			<th>Total</th>
		</tr>
		<?php
				while($row=mysqli_fetch_assoc($result)){
					$date=$row['datetime'];
					$em=$row['email'];
					$cs=$row['clubsandwich'];
					$ds=$row['dillsalmon'];
					$ss=$row['supersalad'];
					$mb=$row['mexicanbarbacoa'];
					$to=$row['total'];
					echo "<tr><td>$date</td><td>$em</td><td>$cs</td><td>$ds</td><td>$ss</td><td>$mb</td><td>$to</td></tr>";
				}	
		?>
	</table>
<hr>
	<header></header>

<?
	}
	include('includes/footer.php');
?>
