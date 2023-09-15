<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['saler'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Saler Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>

<body>
	<?php include "includes/top.php"; ?>
	<div class="wrapper">
		<?php
		include "includes/left.php";
		?>
		<div class="main" style="margin-top:5%;"><br>
			<div class="box">
				<center>
					<h3 style="margin: 10px 0px;">Welcome To SALESGlide!</h3>
				</center><br>
				<p style="padding-left: 10px; font-size:x-large;">
					In your Dashboard you can:
				<p>
				<ul style="padding-left: 100px;font-size:large;">
					<li><b>Add Sales</b></li><br>
					<li><b>Edit Sales</b></li><br>
					<li><b>View Products</b></li><br>
					<li><b>Change your Account Password</b></li>
				</ul>
				</p>
				</p>

			</div>
		</div>
		<div class="userFooter">
			SALESGlide &copy; <?php echo date("Y"); ?>
		</div>
	</div>
</body>

</html>