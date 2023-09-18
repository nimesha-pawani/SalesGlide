<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['admin'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Admin - Settings</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>

<body>
	<?php include "includes/top.php"; ?>
	<div class="settingsWrapper">
		<?php
		include "includes/left.php";
		?>
		<div class="main">
			<h3>Change Password</h3>
			<br>
			<br>
			<br>
			<center>
				<div class="adminSettingsformContainer">
					<form  action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
						<table style="width:60%;">
							<tr>
								<th>
									<label class="formfont" for="oldpassword"><b>Current Password</b></label>
								</th>
								<td>
									<input type="password" name="oldpassword" placeholder="Enter Current Password" required>
								</td>
							</tr>
							<tr>
								<th>
									<label class="formfont" for="newpassword"><b>New Password</b></label>
								</th>
								<td>
									<input type="password" name="newpassword" placeholder="Enter New Password" required>
								</td>
							</tr>
							<tr>
								<th>
									<label class="formfont" for="newpassword"><b>Repeat new Password</b></label>
								</th>
								<td>
									<input type="password" name="rnewpassword" placeholder="Re-enter New Password" required>
								</td>
							</tr>
						</table>
						<input type="submit" class="greenBtn" value="Update Password">
					</form>
					<?php
					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						require_once "../app/Sale.php";
						extract($_POST);
						$password = md5(sha1(secureinput($_POST['oldpassword'])));
						$newpassword = secureinput($newpassword);
						$rnewpassword = secureinput($rnewpassword);
						$pass = secureinput(md5(sha1($_POST['newpassword'])));
						if ($newpassword != $rnewpassword) {
							echo '<div class="failalert" id="failalert">
									  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  Passwords does not match!
								</div>';
						} else {
							@require_once "../app/Connect.php";
							$username = $_SESSION['username'];
							$sql = "UPDATE  `users` SET `password`='$pass' WHERE `username`='$username' AND `password`='$password'";
							$result = $con->query($sql);
							if (!empty($result)) {
								echo '<div class="okalert">
									  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  Succesfully Updated!
								</div>';
							}
						}
					}
					?>
				</div>
			</center>
		</div>
		<div class="userFooter" style="bottom: 0;">
			SALESGlide &copy; <?php echo date("Y"); ?>
		</div>
	</div>
</body>

</html>