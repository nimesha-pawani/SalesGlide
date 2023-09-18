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
			<a href="products.php" class="backtoproductsBtn"> < View Products</a>
			<br><br><br><br><br>
			<center>
				<div class="adminSettingsformContainer">
					<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
						<table>
							<tr>
								<th>
									<label class="formfont" for="name"><b>Product Name</b></label>
								</th>
								<td>
									<input type="text" class="form-control" name="name" value="<?php
																								require_once '../app/Connect.php';
																								$id = $_GET['id'];
																								$sql = "SELECT * FROM `products` WHERE `product_id`='$id'";
																								$result = $con->query($sql);
																								if ($result->num_rows > 0) {
																									while ($row = $result->fetch_assoc()) {
																										echo $row['product_name'];
																									}
																								}
																								?>" required>
								</td>
							</tr>
							<tr>
								<th>
									<label class="formfont" for="price"><b>Price</b></label>
								</th>
								<td>
									<input type="number" class="form-control" name="price" value="<?php
																								require_once '../app/Connect.php';
																								$id = $_GET['id'];
																								$sql = "SELECT * FROM `products` WHERE `product_id`='$id'";
																								$result = $con->query($sql);
																								if ($result->num_rows > 0) {
																									while ($row = $result->fetch_assoc()) {
																										echo $row['product_price'];
																									}
																								}
																								?>" required>

								</td>
							</tr>
							<tr>
								<th>
									<label class="formfont" for="quantity"><b>Quantity</b></label>
								</th>
								<td>
									<input type="number" class="form-control" name="quantity" value="<?php
																									require_once '../app/Connect.php';
																									$id = $_GET['id'];
																									$sql = "SELECT * FROM `products` WHERE `product_id`='$id'";
																									$result = $con->query($sql);
																									if ($result->num_rows > 0) {
																										while ($row = $result->fetch_assoc()) {
																											echo number_format($row['product_quantity']);
																										}
																									}
																									?>" required>
								</td>
							</tr>
						</table>
						<input type="submit" class="greenBtn" value="Update Product">
					</form>
				<?php
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					require_once "../app/editProduct.php";
					@require "../app/Connect.php";
					$id = $_GET['id'];
					$name = secureinput($_POST['name']);
					$price = secureinput($_POST['price']);
					$quantity = secureinput($_POST['quantity']);
					$total = $quantity * $price;

					$sql1 = "UPDATE `products` SET `product_quantity`='$quantity',`product_price`='$price',`product_name`='$name',`total_amount`='$total' WHERE `product_id`='$id'";
					$result1 = $con->query($sql1);
					if (!empty($result1)) {
						echo '<div class="okalert" >
									  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  Successfully Updated!
							 </div>';
						header("Location: products.php");
					}else{
						echo '<div class="failalert" >
									  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  Update failed!
							 </div>';
					}
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