<div class="top">
	<div class="userHeader">
		<div class="logo">
			<a href="index.php">
				<h3 style="font-family:Arial;letter-spacing:6px;">SALESGlide</h3>
			</a>
		</div>
		<div class="date">
			<?php echo date("Y-m-d"); ?>
		</div>
		<div class="rightTop">Welcome, <i>
				<?php
				@require "../app/Connect.php";
				$namee = $_SESSION['username'];
				$sql = "SELECT * FROM `users` WHERE `username`='$namee'";
				$result = $con->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo  $row['username'];
					}
				}
				?>
			</i>
			&nbsp;&nbsp;&nbsp;
			<a class="logoutBtn" href="logout.php">Logout</a>
		</div>
	</div>
</div>