<?php
function updateproduct()
{
	@require 'Connect.php';
	
		$id = $_GET['id'];
		$name = secureinput($_POST['name']);
		$price = secureinput($_POST['price']);
		$quantity = secureinput($_POST['quantity']);

		$sql1 = "UPDATE `products` SET `product_quantity`='$quantity',`product_price`='$price',`product_name`='$name', WHERE `product_id`='$id'";
			$result1 = $con->query($sql1);
				if (!empty($result1))
				{
					echo "Successfully Updated";
				}

}

function secureinput($data)
	{
		$data = trim($data);
   		$data = stripslashes($data);
   		$data = htmlspecialchars($data);
   		return $data;
	}
?>