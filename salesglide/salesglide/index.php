<?php
session_start();
if (!empty($_SESSION['username']) && !empty($_SESSION['saler'])) {
	@header("Location: ./saler");
} elseif (!empty($_SESSION['username']) && !empty($_SESSION['admin'])) {
	@header("Location: ./admin");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>SALESGlide</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style>
		body,
		html {
			height: 100%;
		}
	</style>
</head>

<body>
	<div class="commonHeader">
		<div class="logo">
			<h3 style="font-family:Arial;letter-spacing:6px;">SALESGlide</h3>
		</div>
		<div class="date">
			<?php echo date("Y-m-d"); ?>
		</div>
	</div>

	<div class="welcomeWrapper">
		<div class="column-66">
			<div class="hero-image"></div>
		</div>
		<div class="column-33">
			<a style="text-decoration: none;" href="login.php">
				<div class="navBtnLogin">
					Login<img style="float: right;margin-top:2px;" src="./Images/icons8-arrow-24.png" alt="" srcset="" height="40px" width="40px">
				</div>
			</a>
			<div class="infoHolder">
				<a href="./facility/help.html">
					<div class="tooltip"> > Facilities
						<span class="tooltiptext">Facilities provided through the system.</span>
					</div>
				</a>
				<br>
				<a href="./help/common_help/help.html">
					<div class="tooltip"> ? Help
						<span class="tooltiptext">Help pages to help in options.</span>
					</div>
				</a>
			</div>
		</div>
	</div>

	<div class="commonFooter">
		SALESGlide &copy; <?php echo date("Y"); ?>
	</div>
</body>

</html>