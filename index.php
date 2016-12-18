<?php
	# Include connection to DB
	include("config.php");
	
	# Start the session
	session_start();
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		# Get userID and userPass from form
		$userID = test_input($_POST['userID']);
		$userPass = test_input($_POST['userPassword']);
		
		# Query if userID & userPass is in DB
		$query = "SELECT userID, userPass FROM Users WHERE userID='".$userID."' AND userPass='".$userPass."'";
		$getUser = pg_query($pg_conn, $query);
		
		# Check if query returns a success
		$count = pg_num_rows($getUser);
		if ($count == 1){
			$_SESSION['login_user'] = $userID;
			$error = "<p>FOUND YOU MAMSHIE!</p>";
			
			# Create header to redirect if successful!
			header("location:login.php");
		} else {
			$error = "<p>INVALID USERNAME OR PASSWORD BESHIE!</p>";
		}
	}
	
	# Get number of items in cart originally in DB
	$query = "SELECT orderStatus FROM Orders WHERE orderStatus='NOT OK' AND cartNumber IN (SELECT cartNumber FROM Carts WHERE userID IN (SELECT userID FROM Users WHERE userID='$userID'));";
	$result = pg_query($pg_conn, $query);
	$row = pg_num_rows($result);
	$_SESSION['itemCount'] = $row;

	# Getting clean inputs
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
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
		padding-bottom: 20px;
		margin-bottom: 100px;
		display: block;
	}

	.logo {
		font-size: 25px;
		color: white;
		text-decoration: none;
		margin: auto;
	}

	.login {
		margin-top: 7px;
		margin-right: 10px;
		margin-bottom: 0px;
		float: right;
	}

	.textbox {
		font-family: "Raleway", sans-serif;
		margin-right: 10px;
		margin-top: 3px;
		float: right;
	}

	.submit {
		font-family: "Montserrat", sans-serif;
		font-size: 15px;
		background-color: white;
		color: black;
		height: 21.5px;
		min-width: 50px;
		border: 0;
		margin-top: 3px;
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
		
		<form action="" method="post" class="textbox" style="margin-right: 30px;">
    		<button class="submit" type="submit" formaction="signup.php">SIGN UP</button>
    		<input class="submit" type="submit" value="Shop Now" style="margin-right: 10px;">
    		<input class="textbox" type="password" name="userPassword" placeholder="Password">
    		<input class="textbox" type="text" name="userID" placeholder="Username" maxlength="50">
		</form>
		
		<p class="login">Login:</p>
		
	</div>

	<!--BODY-->
	<div class="mainbody">
		<p>Hello BESHIE!</p>
		<p>Enter login credentials!</p>
		
		<?php echo $error; ?>
		
	</div>
	
</body>

</html>