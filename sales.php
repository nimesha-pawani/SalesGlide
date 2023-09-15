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
	<div class="settingsWrapper">
		<?php
		include "includes/left.php";
		?>
		<div class="main" style="margin-top: 8%;">
			<a href="addsales.php" class="addProductBtn"> + Add Sales</a><br><br>
			<table class="productTable">
				<thead>
					<tr class="info">
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Total Price</th>
						<th>Date</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					@require "../app/Connect.php";
					$sql = "SELECT * FROM `sales` ORDER BY `sales_id` DESC";
					$result = $con->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
					?>
							<tr>
								<td># <?php
										$sqll = "SELECT * FROM `products` WHERE `product_id`='" . $row['product_id'] . "'";
										$resultt = $con->query($sqll);
										if ($resultt->num_rows > 0) {
											while ($roww = $resultt->fetch_assoc()) {
												echo $roww['product_name'];
											}
										}
										?>
								</td>
								<td style='text-align:center;'><?php echo $row['quantity']; ?></td>
								<td style='text-align:center;'><?php echo number_format($row['total_price']); ?> LKR</td>
								<td style='text-align:center;'><?php echo $row['date_added']; ?></td>
								<td width="40px">
									<center><a href="editsales.php?sales_id=<?php echo $row['sales_id']; ?>"><img src="../Images/edit.png" alt="edit" height="20px" width="20px"></a></center>
								</td>
							</tr>
					<?php
						}
					} else {
						echo "No Sales Available";
					}
					?>

				</tbody>
			</table>
		</div>
		<div class="userFooter">
			SALESGlide &copy; <?php echo date("Y"); ?>
		</div>
	</div>
</body>

</html>