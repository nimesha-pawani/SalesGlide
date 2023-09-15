<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['admin'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Edit User</title>
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
					<br><br><br><br><br>
					<center>
						<div class="adminSettingsformContainer" style="margin-top: 100px;">
							<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
								<table>
									<tr>
										<th>
											<label class="formfont" for="name"><b>User Name</b></label>
										</th>
										<td>
											<input type="text" class="form-control" name="name" value="<?php
																										require_once '../app/Connect.php';
																										$username = $_GET['username'];
																										$sql = "SELECT * FROM `users` WHERE `username`='$username'";
																										$result = $con->query($sql);
																										if ($result->num_rows > 0) {
																											while ($row = $result->fetch_assoc()) {
																												echo $row['username'];
																											}
																										}
																										?>" required disabled="disabled">
										</td>
									</tr>
									<tr>
										<th>
											<label class="formfont" for="role"><b>Role</b></label>
										</th>
										<td>
											<select name="role" class="options">
												<option value="">Choose Role</option>
												<option>Saler</option>
												<option>Admin</option>
											</select>
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
								<input type="submit" class="greenBtn" value="Update user">
							</form>
							<?php
							if ($_SERVER['REQUEST_METHOD'] == "POST") {
								require_once "../app/Sale.php";
								@require "../app/Connect.php";
								$username = $_GET['username'];
								$role = secureinput($_POST['role']);
								$password = secureinput($_POST['password']);
								$password2 = secureinput($_POST['password2']);
								$pass = secureinput(md5(sha1($password)));
								if ($password != $password2) {
									echo '<div class="failalert" style="margin-top:30px;" >
									  		<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  		Password Must Match
							 			  </div>';
								} else {
									$sql1 = "UPDATE `users` SET `role`='$role',`password`='$pass' WHERE `username`='$username'";
									$result1 = $con->query($sql1);
									if (!empty($result1)) {
										echo '<div class="okalert" style="margin-top:30px;" >
									  			<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  			User successfully updated
							 				  </div>';
										header("Location: users.php");
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