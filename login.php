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
		<a href="https://cs165.herokuapp.com/" class="logo">B E S H I E</a>
		<form action="index.php" method="post" class="submit" style="margin-top: 4px;">
          <button type="submit" class="submit">LOG OUT</button>
        </form>
		
	</div>

	<!--BODY-->
	<div class="mainbody">
	    
		<form action="profile.php" method="post">
		    
		    Welcome, <?php echo htmlspecialchars($_POST['userID']); ?>! <br>
		    
            <button type="submit">View Profile</button>
            <button type="submit" formaction="cart.php">View Order History</button>
            <button type="submit" formaction="cart.php">View My Cart</button> 
        </form>
        
        <?php
			# This function reads your DATABASE_URL config var and returns a connection
			# string suitable for pg_connect. Put this in your app.
			function pg_connection_string_from_database_url() {
			  extract(parse_url($_ENV["DATABASE_URL"]));
			  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
			}
			# Here we establish the connection. Yes, that's all.
			$pg_conn = pg_connect(pg_connection_string_from_database_url());
			# Now let's use the connection for something silly just to prove it works:
			$result = pg_query($pg_conn, "SELECT relname FROM pg_stat_user_tables WHERE schemaname='public'");
			print "\n";
			if (!pg_num_rows($result)) {
			  print("Your connection is working, but your database is empty.\nFret not. This is expected for new apps.\n");
			} else {
			  print "<p>Tables in your database:</p>\n";
			  print "<ul>\n";
			  while ($row = pg_fetch_row($result)) { print("<li>$row[0]</li>\n"); }
			}
			print "</ul>\n";
			
			# Get list of userID
			$userID = pg_query($pg_conn, "SELECT userID FROM Users");
			print "<p> Users in your database:</p>\n";
			print "<ul>";
			while ($row = pg_fetch_row($userID)){
				print("<li>$row[0]</li>");
			}
			print "</ul>";
		?>
		
		<table>
			<tr>
				<th>Product Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Status</th>
				<th>In Stock</th>
			</tr>
		
			<?php		
			#Get list of products from Products
			$products = pg_query($pg_conn, "SELECT productName, productDescription, productPrice, productStatus, productQuantity FROM Products");
			while ($row = pg_fetch_row($products)){ ?>
			
				<tr>
					<td><?php print ("$row[0]"); ?></td>
					<td><?php print ("$row[1]"); ?></td>
					<td><?php print ("$row[2]"); ?></td>
					<td><?php print ("$row[3]"); ?></td>
					<td><?php print ("$row[4]"); ?></td>
				</tr>
			
			<?php } ?>

		</table>
		
	</div>

</body>

</html>