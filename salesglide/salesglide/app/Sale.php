<?php
function addSales()
{
	@require 'Connect.php';
	$product = secureinput($_POST['product']);
	$quantity = secureinput($_POST['quantity']);

	if (!empty($product) && !empty($quantity) && ($quantity != 0)) {
		$sqll = "SELECT * FROM `products` WHERE `product_id`='$product'";
		$resultt = $con->query($sqll);
		if (!empty($resultt)) {
			$row = $resultt->fetch_array();
			$price = $row['product_price'];
			$name = $row['product_name'];
			$total_price = $price * $quantity;
			$quant = $row['product_quantity'];
			$new_quantity = $quant - $quantity;
			if ($new_quantity < 0) {
				echo "<div class=\"failalert\" style=\"margin-top:60px;\" >
									  		  <span class=\"closebtn\" onclick=\"this.parentElement.style.display=\'none\';\">&times;</span> 
									  		  Only " . $quant . " " . $name . " remain in Store
							 			     </div>";
			} else {
				$sql = "INSERT INTO `sales` VALUES ('','$product','$quantity','',CURRENT_TIMESTAMP," . date('d') . "," . date('m') . "," . date('Y') . ")";
				$result = $con->query($sql);
				if (!empty($result)) {
					$id = $con->insert_id;
					$sqlll = "UPDATE `sales` SET `total_price`='$total_price' WHERE `sales_id`='$id'";
					$resulttt = $con->query($sqlll);
					if (!empty($resulttt)) {
						$total = $new_quantity * $price;


						$sql1 = "UPDATE `products` SET `product_quantity`='$new_quantity',`total_amount`='$total' WHERE `product_id`='$product'";
						$result1 = $con->query($sql1);
						if (!empty($result1)) {
							echo '<div class="okalert" style="margin-top:60px;" >
									  		  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  		  Successfully Added
							 			     </div>';
						}
					}
				}
			}
		}
	} else {
		echo '<div class="failalert" style="margin-top:60px;" >
									  		  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
									  		  All fields are required!
							 			     </div>';
	}
}

function secureinput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
