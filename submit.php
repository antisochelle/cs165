<?php
   include('config.php');
   session_start();
   
   $userID = $_SESSION['login_user'];
   
   # Get cartNum
   $cartNum = $_SESSION['cartNumber'];
   
   # Update orderStatus = 'OK'
   $query = "UPDATE Orders SET orderStatus='OK' WHERE cartNumber=$cartNum";
	$result = pg_query($pg_conn, $query);
	if ($result){
	   
	   # Update productQuantity (productQuantity minus orderQuantity)
	   
	   # Go back to cart
		header("location:cart.php");
	} else {
	   echo "ERROR update!";
	}
   
   
?>