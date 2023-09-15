<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['saler'])) {
	header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Sales</title>
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
			<a href="sales.php" class="backtoproductsBtn">
				< View Sales</a>
					<br><br><br><br><br>
					<center>
						<div class="adminSettingsformContainer">
							<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
								<table style="width:60%;">
									<tr>
										<th>
											<label class="formfont" for="name"><b>Product Name</b></label>
										</th>
										<td>
											<select type="select" name="product" class="options">
												<option value="0">-- Choose Product--</option>
												<?php
												require_once '../app/Connect.php';
												$sql = "SELECT * FROM `products` WHERE `product_quantity`>0 ORDER BY `product_name` ASC";
												$result = $con->query($sql);
												if ($result->num_rows > 0) {
													while ($row = $result->fetch_assoc()) {
														echo "<option value='" . $row['product_id'] . "'>" . $row['product_name'] . "</option>";
													}
												}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<th>
											<label class="formfont" for="quantity"><b>Quantity</b></label>
										</th>
										<td>
											<input type="text" class="form-control" name="quantity" placeholder="Enter Product Quantity" required>
										</td>
									</tr>
								</table>
								<input type="submit" class="greenBtn" value="Add Sales">
							</form>
							<?php
							if ($_SERVER['REQUEST_METHOD'] == "POST") {
								require_once "../app/Sale.php";
								addSales();
							}
							?>
					</center>

		</div>
		<div class="userFooter">
			SALESGlide &copy; <?php echo date("Y"); ?>
		</div>
	</div>
</body>

</html>