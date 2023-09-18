<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['admin'])) {
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
		<div class="main" style="margin-top: 8%;">
			<h3>Today Sales</h3>
			<table class="productTable">
				<thead>
					<tr class="info">
						<th>Product Id</th>
						<th>Quantity</th>
						<th>Total Price</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
					<?php
					@require "../app/Connect.php";
					$day = date('d');
					$month = date('m');
					$year = date('Y');
					$sql = "SELECT * FROM `sales` WHERE `day`='$day' AND `month`='$month' AND `year`='$year' ORDER BY `sales_id` DESC";
					$result = $con->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
					?>
							<tr>
								<td style="padding-left: 20px;"># <?php
																	$sqll = "SELECT * FROM `products` WHERE `product_id`='" . $row['product_id'] . "'";
																	$resultt = $con->query($sqll);
																	if ($resultt->num_rows > 0) {
																		while ($roww = $resultt->fetch_assoc()) {
																			echo $roww['product_name'];
																		}
																	}
																	?>
								</td>
								<td style="text-align: center;"><?php echo $row['quantity']; ?></td>
								<td style="text-align: center;"><?php echo number_format($row['total_price']); ?> LKR</td>
								<td style="text-align: center;"><?php echo $row['date_added']; ?></td>
							</tr>
					<?php
						}
					} else {
						echo "";
					}
					?>

				</tbody>
			</table>
			<h4 align="right">Total Sales:
				<?php
				$sql = "SELECT sum(total_price) AS aa FROM `sales` WHERE `day`='$day' AND `month`='$month' AND `year`='$year'";
				$result = $con->query($sql);
				while ($row = $result->fetch_array()) {
					echo "<b>" . number_format($row['aa']);
				}
				?>
				LKR
				</b></h4>

			<h3>Generate report</h3>
			<center>
				<div class="form-holder">
					<form class="form-inline" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-inline" role="form">
						<div class="">
							<select name="day" class="form-inline-options">
								<option value="">Choose Day</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
								<option>16</option>
								<option>17</option>
								<option>18</option>
								<option>19</option>
								<option>20</option>
								<option>21</option>
								<option>22</option>
								<option>23</option>
								<option>24</option>
								<option>25</option>
								<option>26</option>
								<option>27</option>
								<option>28</option>
								<option>29</option>
								<option>30</option>
								<option>31</option>
							</select>
						</div>
						<div class="">
							<select name="month" class="form-inline-options">
								<option value="">Choose Month</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
							</select>
						</div>
						<div class="">
							<select name="year" class="form-inline-options">
								<option value="">Choose Year</option>
								<option>2020</option>
								<option>2021</option>
								<option>2022</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" value="View Report">View Report</button>
						</div>
					</form>
				</div>
				<?php
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					require_once "../app/Connect.php";
					require_once "../app/Sale.php";

					$day = secureinput($_POST['day']);
					$month = secureinput($_POST['month']);
					$year = secureinput($_POST['year']);


					if (empty($day) and empty($month) and !empty($year)) {
						$sql = "SELECT * FROM `sales` WHERE  `year`='$year' ORDER BY `sales_id` DESC";
						$result = $con->query($sql);
						if ($result->num_rows > 0) {
				?>
							<br>
							<h3> Yearly sales report of <?php echo "$year"; ?></h3>
							<table class="productTable">
								<thead>
									<tr class="info">
										<th>Product Id</th>
										<th>Quantity</th>
										<th>Total Price</th>
										<th>Time</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($row = $result->fetch_assoc()) {
									?>
										<tr>
											<td style="padding-left: 20px;"># <?php
																				$sqll = "SELECT * FROM `products` WHERE `product_id`='" . $row['product_id'] . "'";
																				$resultt = $con->query($sqll);
																				if ($resultt->num_rows > 0) {
																					while ($roww = $resultt->fetch_assoc()) {
																						echo $roww['product_name'];
																					}
																				}
																				?>
											</td>
											<td style="text-align: center;"><?php echo $row['quantity']; ?></td>
											<td style="text-align: center;"><?php echo number_format($row['total_price']); ?> LKR</td>
											<td style="text-align: center;"><?php echo $row['date_added']; ?></td>
										</tr>
									<?php
									}
									echo "</tbody></table><h3 align='right'><?php echo $year; ?> Total sales : ";
									$sql = "SELECT sum(total_price) AS aa FROM `sales` WHERE `year`='$year'";
									$result = $con->query($sql);
									while ($row = $result->fetch_array()) {
										echo number_format($row['aa']);
									}
									?>
									LKR
									</b></h3>
								<?php

							} else {
								echo "<br><b>No data Available</b>";
							}
						} else if (empty($day) and !empty($month) and !empty($year)) {
							$sql = "SELECT * FROM `sales` WHERE `month`='$month' AND `year`='$year' ORDER BY `sales_id` DESC";
							$result = $con->query($sql);
							if ($result->num_rows > 0) {
								?>
									<br>
									<h3> Monthly sales report of <?php echo "$month/$year"; ?></h3>
									<table class="productTable">
										<thead>
											<tr class="info">
												<th>Product Id</th>
												<th>Quantity</th>
												<th>Total Price</th>
												<th>Time</th>
											</tr>
										</thead>
										<tbody>
											<?php
											while ($row = $result->fetch_assoc()) {
											?>
												<tr>
													<td style="padding-left: 20px;"># <?php
																						$sqll = "SELECT * FROM `products` WHERE `product_id`='" . $row['product_id'] . "'";
																						$resultt = $con->query($sqll);
																						if ($resultt->num_rows > 0) {
																							while ($roww = $resultt->fetch_assoc()) {
																								echo $roww['product_name'];
																							}
																						}
																						?>
													</td>
													<td style="text-align: center;"><?php echo $row['quantity']; ?></td>
													<td style="text-align: center;"><?php echo number_format($row['total_price']); ?> LKR</td>
													<td style="text-align: center;"><?php echo $row['date_added']; ?></td>
												</tr>
											<?php

											}
											echo "</tbody></table><h3 align='right'><?php echo $year; ?> Total sales : ";
											$sql = "SELECT sum(total_price) AS aa FROM `sales` WHERE `month`='$month' AND `year`='$year'";
											$result = $con->query($sql);
											while ($row = $result->fetch_array()) {
												echo number_format($row['aa']);
											}
											?>
											LKR
											</b></h3>
										<?php
									} else {
										echo "<br><b>No data Available</b>";
									}
								} else if (!empty($day) and !empty($month) and !empty($year)) {
									$sql = "SELECT * FROM `sales` WHERE `day`='$day' AND `month`='$month' AND `year`='$year' ORDER BY `sales_id` DESC";
									$result = $con->query($sql);
									if ($result->num_rows > 0) {
										?>
											<br>
											<h3> Daily sales report of <?php echo "$day/$month/$year"; ?></h3>
											<table class="productTable">
												<thead>
													<tr class="info">
														<th>Product Id</th>
														<th>Quantity</th>
														<th>Total Price</th>
														<th>Time</th>
													</tr>
												</thead>
												<tbody>
													<?php
													while ($row = $result->fetch_assoc()) {
													?>
														<tr>
															<td style="padding-left: 20px;"># <?php
																								$sqll = "SELECT * FROM `products` WHERE `product_id`='" . $row['product_id'] . "'";
																								$resultt = $con->query($sqll);
																								if ($resultt->num_rows > 0) {
																									while ($roww = $resultt->fetch_assoc()) {
																										echo $roww['product_name'];
																									}
																								}
																								?>
															</td>
															<td style="text-align: center;"><?php echo $row['quantity']; ?></td>
															<td style="text-align: center;"><?php echo number_format($row['total_price']); ?> LKR</td>
															<td style="text-align: center;"><?php echo $row['date_added']; ?></td>
														</tr>
													<?php
													}
													echo "</tbody></table><h3 align='right'><?php echo $year; ?> Total sales : ";
													$sql = "SELECT sum(total_price) AS aa FROM `sales` WHERE `day`='$day' AND `month`='$month' AND `year`='$year'";
													$result = $con->query($sql);
													while ($row = $result->fetch_array()) {
														echo number_format($row['aa']);
													}
													?>
													LKR
													</b></h3>
										<?php
									} else {
										echo "<br><b>No data Available</b>";
									}
								} else {
									echo "<br> <b><span style=\"color: red;\"> Invalid input format for report generation! </span> </b>";
								}
							}
										?>
			</center>

		</div>
		<div class="commonFooter">
			SALESGlide &copy; <?php echo date("Y"); ?>
		</div>
	</div>
</body>

</html>