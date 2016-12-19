<?php
	# Include connection to DB
	include('config.php');

	# Session
	session_start();
	
	# Get userID
	$userID = $_SESSION['login_user'];
	
	# Get new productNumber
	$query = "SELECT productNumber FROM Products";
	$result = pg_query($pg_conn, $query);
	$prodNum = 0;
	if ($result){
		while ($row = pg_fetch_row($result)){
			if ($row[0] >= $prodNum){
				$prodNum = $row[0];
			}
		}
		$prodNum = $prodNum + 1;
	}
	
	# Set variables
	$prodName = $prodDesc = $prodStatus = $prodQuantity = $prodPrice = "";
	
	
	# Create new product
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		# Get input
		$prodName = test_input($_POST['prodName']);
		$prodDesc = test_input($_POST['prodDesc']);
		$prodStatus = test_input($_POST['prodStatus']);
		$prodQuantity = $_POST['prodQuantity'];
		$prodPrice = $_POST['prodPrice'];
		
		# Insert into products table
		$query = "INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES ($prodNum, '$prodName', '$prodDesc', '$prodStatus', $prodQuantity, $prodPrice::float8::numeric::money);";
		$result = pg_query($pg_conn, $query);
		if ($result){
			header("location:login.php");
		} else {
			echo "ERROR ADDING PRODUCT HUHU SORRY";
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
	
	.error {color: #FF0000;}

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
		
		<p><span class="error">* Please fill in everything! Thanks BESHIE!</span></p>
		
	    <form method="post" action="">
	        <p>Product name: <input type="text" name="prodName" maxlength="50" required></p>
	        <p>Product description: <textarea name="prodDesc" required></textarea></p>
	        <p>Product status: <input type="radio" name="prodStatus" value="Available" checked>Available<input type="radio" name="prodStatus" value="Out of stock">Out of stock</p>
	        <p>Product quantity: <input type="number" name="prodQuantity" min="1" value="1" required></p>
	        <p>Product price: <input type="number" name="prodPrice" min="0" value="10" step="any" required></p>
	        <input type="submit" value="ADD PRODUCT">
	    </form>
	    
	    <form method="post" action="login.php">
	    	<input type="submit" value="BACK">
	    </form>
	
	</div>

</body>

</html>