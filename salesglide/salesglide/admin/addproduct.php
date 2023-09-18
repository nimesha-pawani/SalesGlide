<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['admin'])) {
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Products</title>
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
			<a href="products.php" class="backtoproductsBtn">
				< View Products</a>
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
											<input type="text" class="form-control" name="name" placeholder="Enter Product Name" required>
										</td>
									</tr>
									<tr>
										<th>
											<label class="formfont" for="price"><b>Price</b></label>
										</th>
										<td>
											<input type="number" class="form-control" name="price" placeholder="Enter Product Price" required>
										</td>
									</tr>
									<tr>
										<th>
											<label class="formfont" for="quantity"><b>Quantity</b></label>
										</th>
										<td>
											<input type="number" class="form-control" name="quantity" placeholder="Enter Product Quantity" required>
										</td>
									</tr>
								</table>
								<input type="submit" class="greenBtn" value="Add product">
							</form>
							<?php
							if ($_SERVER['REQUEST_METHOD'] == "POST") {
								require_once "../app/Product.php";
								$products->addproduct();
							}
							?>
						</div>
					</center>
		</div>
		<div class="userFooter">
			SALESGlide &copy; <?php echo date("Y"); ?>
		</div>
	</div>
</body>

</html>