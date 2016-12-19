<?php
	# Include connection to DB
	include('config.php');

	# Session
	session_start();
	
	# Get userID
	$userID = $_SESSION['login_user'];
	
	# Update item quantity
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		# Query the update
		$orderNum = $_POST['orderNum'];
		$orderQuantity = $_POST['quantity'];
		
		$query = "UPDATE Orders SET orderQuantity=$orderQuantity WHERE orderNumber=$orderNum";
		$result = pg_query($pg_conn, $query);
		if ($result){
			header("location:cart.php");
		} else {
			$error = "UPDATE FAILED!";
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

</style>

<body>
	
	<!--HEADER-->
	<div class="top" style="position: fixed; top: 0px; left: 0px; right: 0px;">
		<a href="https://cs165.herokuapp.com/login.php" class="logo">B E S H I E</a>
		<form action="index.php" method="post" class="submit" style="margin-top: 4px;">
          <button type="submit" class="submit">LOG OUT</button>
        </form>
		
	</div>

	<!--BODY-->
	<div class="mainbody">
	    
	    <p><strong>My cart:</strong></p>
	    <table>
	    	<tr>
	            <th>Order Number</th>
				<th>Product Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Quantity Ordered</th>
			</tr>
		
	    <?php 
	        # Query for order history
			$query = "SELECT orderNumber, productName, productDescription, productPrice, productQuantity, orderQuantity FROM Products, Orders WHERE Orders.productNumber = Products.productNumber AND Orders.cartNumber IN (SELECT cartNumber FROM Carts WHERE userID='$userID') AND Orders.orderStatus='NOT OK';";
			$result = pg_query($pg_conn, $query);
			$count = pg_num_rows($result);
			if ($result and ($count > 0)){
			    
			    # Print order history in table
			    while ($row = pg_fetch_row($result)) { ?>
			    	<form method="post" action="">
			        <tr>
			        	<!-- Added a hidden input type to get orderNum -->
				        <td><?php echo "<input type=\"hidden\" name=\"orderNum\" value=\"".$row[0]."\">"; echo $row[0]; ?></td>
				        <td><?php echo $row[1]; ?></td>
				        <td><?php echo $row[2]; ?></td>
				        <td><?php echo $row[3]; ?></td>
				        
				        <td><input type="number" name="quantity" min="1" max="<?php echo $row[4]; ?>" value="<?php echo $row[5]; ?>"></td>
			        	<td><input type="submit" value="UPDATE" <?php echo $status; ?>></td>
			        </tr>
			        </form>
			    <?php }       
			    
			}
			
	    ?>
	    </table>
	    
	    <hr>
	   
		<form action="cart.php" method="post">
		    <button type="submit">BACK</button> 
		</form>
		
		<p><?php echo $error ?></p>
	
	</div>

</body>

</html>