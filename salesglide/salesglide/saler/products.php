<?php 
session_start();
	if (empty($_SESSION['username'])&& empty($_SESSION['saler'])) {
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
<div class="settingsWrapper">
	<?php
		include "includes/left.php";
	?>
	<div class="main" style="margin-top: 8%;">
	<h3> Products</h3>
			<table class="productTable">
				<thead>
				<tr class="info">
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
				</tr>	
			</thead>
			<tbody>
			<?php 
				 	@require "../app/Connect.php";
				 	$sql = "SELECT * FROM `products` WHERE `product_quantity`>0  ORDER BY `product_name` ASC";
				 	$result = $con->query($sql);
				 	if ($result->num_rows> 0) {
				 		while ($row = $result->fetch_assoc()) {
				 			?>
				 			<tr>
								<td style="padding-left:10px;"><?php echo $row['product_name']; ?></td>
								<td style="text-align:center;"><?php echo number_format($row['product_price']); ?> LKR</td>
								<td style="text-align:center;"><?php echo $row['product_quantity']; ?></td>
							</tr>
				 			<?php
				 		}
				 	}
				 	else
				 	{
				 		echo "No Product Added";
				 	}
				 ?>
			</tbody>
		</table>
		<?php
			@require "../app/Connect.php";
			$sql = "SELECT sum(total_amount) AS bb FROM `products`";
			$result = $con->query($sql);
			while ($row = $result->fetch_array()) {
				echo "<div class='total'><b>Total Amount is: " . number_format($row['bb']) . " LKR</b></div>";
			}
		?>
	</div>
	<div class="userFooter">
	    SALESGlide &copy; <?php echo date("Y"); ?>
	</div>
</div>
</body>
</html>