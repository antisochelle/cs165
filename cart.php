<?php
	# Include connection to DB
	include('config.php');

	# Session
	session_start();
	
	# Get userID
	$userID = $_SESSION['login_user'];
	
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
	    
	    <p><strong>Order history:</strong></p>
	    <table>
	    	<tr>
				<th>Product Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Quantity Ordered</th>
				<th>Date Ordered</th>
			</tr>
		
	    <?php 
	        # Query for order history
			$query = "SELECT productName, productDescription, productPrice, orderQuantity, orderDate FROM Products, Orders WHERE Orders.productNumber=Products.productNumber AND Orders.cartNumber IN (SELECT cartNumber FROM Carts WHERE userID='$userID') AND Orders.orderStatus='OK';";
			$result = pg_query($pg_conn, $query);
			if ($result){
			    
			    # Print order history in table
				while ($row = pg_fetch_row($results)){ ?>
		            <tr>
                        <td><?php echo $row[0]; ?></td>
    			        <td><?php echo $row[1]; ?></td>
    			        <td><?php echo $row[2]; ?></td>
    			        <td><?php echo $row[3]; ?></td>
    			        <td><?php echo $row[4]; ?></td>
                    </tr>
				<?php }
			} else {
			    print "<p>ERROR</p>\n";
			}
			
	    ?>
	    </table>
	    
	    <form action="login.php" method="post">
            <button type="submit">BACK</button> 
        </form>
	
	</div>

</body>

</html>