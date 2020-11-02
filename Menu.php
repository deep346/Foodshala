 <?php 
session_start();
$con = mysqli_connect("localhost", "root", "root", "food");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"],
                'item_category'		=>	$_POST["hidden_category"]
 		);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"],
            'item_category'		 =>	$_POST["hidden_category"]
            
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="Menu.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title> </title>
		<link rel="stylesheet" href="css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body style="background-color:#bdc3c7">
		<br />
		<div id="main-wrapper">
         <center><h2>FoodShala</h2> 
		<form action="Menu.php" method="post">
			<div class="imgcontainer">
				<img src="image/food.png" alt="food" class="image">
				 
			</div>
			</center>
			 
			 
			<?php
            
            
				$query = "SELECT * FROM fooditem ORDER BY id ASC";
				$result = mysqli_query($con, $query);
				if(mysqli_num_rows($result) > 0)
				{
                    
					 while($row = mysqli_fetch_array($result))
                    { 
				?>
			<div class="col-md-4">
				<form method="post" action="Menu.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						 <img src="image/<?php echo $row["image"]; ?>"  class="all_images"/><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">Rs. <?php echo $row["price"]; ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
						<input type="hidden" name="hidden_category" value="<?php echo $row["category"]; ?>" />


						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
						
						 
		 </div>
		 
	 
		 

				 
				</form>
			</div>
			 
				 
			 <?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						 
						<th width="15%">Total</th>
						<th width="5%">Action</th>
						<th width="20%">Category</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>Rs.<?php echo $values["item_price"]; ?></td>
						<td>Rs.<?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="Menu.php" action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
						<td><?php echo $values["item_category"]; ?></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">Rs. <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
				 
					<?php
					}
					?>
					 
			 		<div class="inner_container">
			<button type="button" name="order" class="order_button" >Order</button><br>
		 
			</div>
						
				</table>
			</div>
		</div>
	</div>
	<br />
	</body>
</html>

 