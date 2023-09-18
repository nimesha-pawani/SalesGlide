<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['admin'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Add User</title>
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
		<div class="main" style="margin-top: 7%;">
			<a href="users.php" class="backtoproductsBtn">
				< View Users</a>
					<br><br><br><br><br><br>
					<center>
						<div class="adminSettingsformContainer">
							<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
								<table>
									<tr>
										<th>
											<label class="formfont" for="username"><b>Username</b></label>
										</th>
										<td>
											<input type="text" class="form-control" name="username" placeholder="Enter Username" required>
										</td>
									</tr>
									<tr>
										<th>
											<label class="formfont" for="role"><b>Role</b></label>
										</th>
										<td>
											<div class="options">
												<select name="role" class="form-control">
													<option class="options" value="">Choose Role</option>
													<option>Saler</option>
													<option>Admin</option>
												</select>
											</div>
										</td>
									</tr>
									<tr>
										<th>
											<label class="formfont" for="password"><b>Password</b></label>
										</th>
										<td>
											<input type="password" class="form-control" name="password" placeholder="Enter Password" required>
										</td>
									</tr>
									<tr>
										<th>
											<label class="formfont" for="password2"><b>Re-enter passowrd</b></label>
										</th>
										<td>
											<input type="password" class="form-control" name="password2" placeholder="Re-enter Password" required>
										</td>
									</tr>
								</table>
								<input type="submit" class="greenBtn" value="Add user">
							</form>
							<?php
							if ($_SERVER['REQUEST_METHOD'] == "POST") {
								require_once "../app/Connect.php";
								require_once "../app/Sale.php";
								$username = secureinput($_POST['username']);
								$password = secureinput($_POST['password']);
								$role = secureinput($_POST['role']);
								$password2 = secureinput($_POST['password2']);
								$pass = secureinput(md5(sha1($password)));
								if ($password != $password2) {
									echo '<div class="failalert" style="margin-top:30px;" >
									  		<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  		Password Must Match
							 			  </div>';
								} else {
									$sql = "INSERT INTO `users` VALUES ('$username','$role','$pass')";
									$result = $con->query($sql);
									if (!empty($result)) {
										echo '<div class="okalert" style="margin-top:30px;" >
									  			<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  			User Successfully Added
							 				  </div>';
									} else {
										echo '<div class="failalert" style="margin-top:30px;"  >
									  			<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  			Choose Another Username
							 				  </div>';
									}
								}
							}
							?>
						</div>
					</center>
		</div>
		<div class="commonFooter">
			SALESGlide &copy; <?php echo date("Y"); ?>
		</div>
	</div>
</body>

</html>