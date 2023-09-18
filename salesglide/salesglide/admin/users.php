<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['admin'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Users</title>
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
		<div class="main" style="margin-top: 8%;">
			<a href="adduser.php" class="addProductBtn"> + Add New User</a><br><br>
			<table class="productTable">
				<thead>
					<tr class="info">
						<th>Username</th>
						<th>Role</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
					@require "../app/Connect.php";
					$sql = "SELECT * FROM `users`";
					$result = $con->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
					?>
							<tr>
								<td style="padding-left: 10px;"><?php echo $row['username']; ?></td>
								<td style="text-align: center;"><?php echo $row['role']; ?></td>
								<td>
									<center><a href="edituser.php?username=<?php echo $row['username']; ?>"><img src="../Images/edit.png" alt="edit" height="20px" width="20px"></a></center>
								</td>
								<td>
									<center><a href="deleteuser.php?username=<?php echo $row['username']; ?>"><img src="../Images/delete.png" alt="delete" height="20px" width="20px"></a></center>
								</td>
							</tr>
					<?php
						}
					} else {
						echo "<h3>No Users Added</h3>";
					}
					?>

				</tbody>
			</table>
			<div class="userFooter">
				SALESGlide &copy; <?php echo date("Y"); ?>
			</div>
		</div>
	</div>
</body>

</html>