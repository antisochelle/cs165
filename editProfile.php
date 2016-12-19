<?php
	# Include connection to DB
	include('config.php');

	# Session
	session_start();
	
	# Get userID
	$userID = $_SESSION['login_user'];
	
	# Update user profile
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		# Get newName and newAddress from form
		$newName = $_POST['newName'];
		$newAddress = $_POST['newAddress'];
		
		# Make sure inputs are valid/if blank input, do not change
		if ($newName == ""){
		    $newName = 	$_SESSION['userName'];
		} 
		if (!$newAddress){
		    $newAddress = $_POST['newAddress'];
		} else {
		    $newAddress = "DI MO BINAGO WTF";
		}
		
		# Query the update
		$query = "UPDATE Users SET userName='$newName', userAddress='$newAddress' WHERE userID='$userID'";
		$result = pg_query($pg_conn, $query);
		if ($result){
		    $_SESSION['updateProfile'] = "Update profile success!";
		} else {
		    $_SESSION['updateProfile'] = "ERROR updating profile!";
		}
		header("location:profile.php");
		
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
		
	    <form method="post" action="">
	        <p>New name: <input type="text" name="newName" maxlength="50"></p>
	        <p>New address: <input type="text" name="newAddress" maxlength="100"></p>
	        <input type="submit" value="UPDATE PROFILE">
	    </form>
	
	</div>

</body>

</html>