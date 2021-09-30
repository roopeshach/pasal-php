<?php 
include('functions.php');
include('inc/home_header.php');

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
		<div class="col-md-12">
				<h2 style="text-align: center;">Admin Home</h2>
			</div>
			<div class="col-md-12">
				<img src="../slider/banner.png" alt="">
				<br><br>
			</div>

		</div>
		<div class="row">
			
			<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">No. of products </h5>
				<p class="card-text">
					<?php
					$conn = mysqli_connect("localhost", "root", "", "pasal");
					$result = mysqli_query($conn, "SELECT * FROM product");
					$num_rows = mysqli_num_rows($result);
					echo "<h2>". $num_rows ."</h2>";
					?>
				</p>
			</div>

			<div class="card-body">
				<h5 class="card-title">No. of categories </h5>
				<p class="card-text">
					<?php
					$conn = mysqli_connect("localhost", "root", "", "pasal");
					$result = mysqli_query($conn, "SELECT * FROM category");
					$num_rows = mysqli_num_rows($result);
					echo "<h2>". $num_rows ."</h2>";
					?>
				</p>
			</div>

			<div class="card-body">
				<h5 class="card-title">No. of orders </h5>
				<p class="card-text">
					<?php
					$conn = mysqli_connect("localhost", "root", "", "pasal");
					$result = mysqli_query($conn, "SELECT * FROM orders");
					$num_rows = mysqli_num_rows($result);
					echo "<h2>". $num_rows ."</h2>";
					?>
				</p>
			</div>

</div>
		</div>
	</div>
	

</body>
</html>