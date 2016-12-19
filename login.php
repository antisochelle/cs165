<?php
	include("session.php");

	# Get userID
	$userID = $_SESSION['login_user'];

	# Get cartNumber
	$query = "SELECT cartNumber FROM Carts WHERE userID='$userID'";
	$result = pg_query($pg_conn, $query);
	if ($result){
		while ($row = pg_fetch_row($result)){
			$_SESSION['cartNumber'] = $row[0];
			$cartNum = $_SESSION['cartNumber'];
		}
	}
	
	# Insert in Orders after clicking "Add to cart"
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		# Get quantity added to cart itemCount
		$itemCount = $_SESSION['itemCount'] + $_POST['quantity'];
		$_SESSION['itemCount'] = $itemCount;
		
		# Get prodNum chosen
		$_SESSION['prodNum'] = $_POST['prodNum'];
		$prodNum = $_SESSION['prodNum'];
		
		# Get orderNum
		$query = "SELECT COUNT(*) FROM Orders";
		$result = pg_query($pg_conn, $query);
		while ($row = pg_fetch_row($result)){
			$orderNum = $row[0] + 1;
		}
		
		# Set order details (orderNum, cartNum, prodNum, itemCount AS orderQuantity, orderStatus, orderDate -- do this directly in query using now())
		$orderStatus = "NOT OK";
		
		# INSERTING INTO ORDERS
		$query = "INSERT INTO Orders (orderNumber, cartNumber, productNumber, orderQuantity, orderStatus, orderDate) VALUES ($orderNum,$cartNum,$prodNum,$itemCount,'$orderStatus',now());";
		if (pg_query($pg_conn, $query)){
			$orderSuccess = "Added order!";
			$_SESSION['orderNum'] = $orderNum;
		} else {
			$orderSuccess = "Error! Order not added!";
		}
		
	}

?>

<!DOCTYPE html>
<html>

<title>CS 165 APP</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">
	body {font-family: "Montserrat", sans-serif;}

	.top {
		background: black;
		color: white;
		max-height: 70px;
		padding-left: 50px;
		padding-top: 20px;
		padding-right: 50px;
		padding-bottom: 20px;
		display: block;
	}

	.logo {
		font-size: 25px;
		color: white;
		text-decoration: none;
		margin: auto;
	}

	.submit {
		font-family: "Montserrat", sans-serif;
		font-size: 15px;
		background-color: white;
		color: black;
		height: 21.5px;
		min-width: 50px;
		border: 0;
		float: right;
	}

	.mainbody {
		margin-left: 50px;
		margin-top: 100px;
	}
	
	th, td {
    	padding: 10px;
	}
	
	input[type=number]{
    	width: 60px;
    }
	
</style>

<body>
	
	<!--HEADER-->
	<div class="top" style="position: fixed; top: 0px; left: 0px; right: 0px;">
		<a href="https://cs165.herokuapp.com/login.php" class="logo">B E S H I E</a>
		<form action="logout.php" method="post" class="submit" style="margin-top: 4px;">
          <button type="submit" class="submit">LOG OUT</button>
        </form>
		
	</div>

	<!--BODY-->
	<div class="mainbody">

	    <p>Welcome, <?php print_r($userID); ?>! </p><br>
		
		<form action="cart.php" method="post">
            <button type="submit" formaction="profile.php">View Profile</button>
            <button type="submit" formaction="orders.php">View Order History</button>
            <button type="submit">View My Cart</button> 
        </form>
		
		<br>
		<table>
			<tr>
				<th>Product Name</th>
				<th>Description</th>
				<th>Status</th>
				<th>In Stock</th>
				<th>Price</th>
			</tr>
			
			<?php
			
			#Get list of products from Products
			$products = pg_query($pg_conn, "SELECT * FROM Products");
			while ($row = pg_fetch_row($products)){ ?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<tr>
					<td><?php echo "<input type=\"hidden\" name=\"prodNum\" value=\"".$row[0]."\">"; print ("$row[1]"); ?></td>
					<td><?php echo "<input type=\"hidden\" name=\"prodNum\" value=\"".$row[0]."\">"; print ("$row[2]"); ?></td>
					<td><?php echo "<input type=\"hidden\" name=\"prodNum\" value=\"".$row[0]."\">"; print ("$row[3]"); ?></td>
					<td><?php echo "<input type=\"hidden\" name=\"prodNum\" value=\"".$row[0]."\">"; print ("$row[4]"); ?></td>
					<td><?php echo "<input type=\"hidden\" name=\"prodNum\" value=\"".$row[0]."\">"; print ("$row[5]"); ?></td>
					
					<?php
						# Disable "Add to cart" feature if "out of stock"
						$status = ""; 
						if ($row[4] == 0){
							$status = "disabled";
						}
					?>
					
					<td><input type="number" name="quantity" min="0" max="<?php print ("$row[4]"); ?>" <?php echo $status; ?>></td>
					<td><input type="submit" value="Add to cart" <?php echo $status; ?>></td>
				</tr>
				</form>
			
			<?php } ?>

		</table>

			
		<!-- PHP ADDING ITEMCOUNT -->
	
		<hr>

		<p style="margin-top: 10px;"><strong>Items in cart:</strong> <?php echo $itemCount ?></p>
		<p>Cart number: <?php echo $cartNum ?></p>
		<p>Product number: <?php echo $prodNum ?></p>
		<p><?php echo $orderSuccess ?></p>

	</div>

</body>

</html>