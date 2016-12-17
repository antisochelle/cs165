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

	<?php
		# This function reads your DATABASE_URL config var and returns a connection
		# string suitable for pg_connect. Put this in your app.
		function pg_connection_string_from_database_url() {
		  extract(parse_url($_ENV["DATABASE_URL"]));
		  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
		}
		
		# Establish connection
		$pg_conn = pg_connect(pg_connection_string_from_database_url());
	?>

	<?php
		# Define variables for userID and userPass for checking if valid
		$userID = $userPass = $success = $row = "";
	
		#Checking if given empty login input
		if (empty($_POST['userID'])) {
			$success = "error.php";
			echo "<p>NO INPUT WTF</p>";
		} 
		else {
			echo "<p>PWE</p>";
			$userID = test_input($_POST['userID']);
		  	$userPass =test_input($_POST['userPassword']);
		  	
		  	$getUser = pg_query($pg_conn, "SELECT userID, userPass FROM Users WHERE userID='".$userID."' AND userPass='".$userPass."'");
		  	if ($row = pg_fetch_row($getUser) == 0){
		  		$success = "error.php";
		  		echo "<p>wala kadito mamshie</p>";
		  	} else {
		  		echo "<p>MAMSHIE I FOUND YOU</p>";
		  		$success = "login.php";
		  		while ($row = pg_fetch_row($getUser)){
			  		$userID = $row[0];
			  		$userPass = "HEHEHE SECRET";
		  		}
		  	}
		}
		
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>


	<!--HEADER-->
	<div class="top" style="position: fixed; top: 0px; left: 0px; right: 0px;">
		<a href="https://cs165.herokuapp.com/" class="logo">B E S H I E</a>
		
		<form action="<?php echo $success; ?>" method="post" class="textbox" style="margin-right: 30px;">
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
	
		<?php
			
			echo "<p>ID: ",$userID,", Password: ",$userPass,"</p>";
			echo "<p>success: ",$success,"</p>";
		?>

	</div>
	
</body>

</html>