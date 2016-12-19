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
		
		<p><strong><?php echo $_SESSION['updateProfile']; ?></strong></p>
		
		<?php
			# Get user info
			$query = "SELECT userID, userName, userAddress FROM Users WHERE userID='$userID'";
			$result = pg_query($pg_conn, $query);
			if ($result){
				$arr = pg_fetch_array($result, 0, PGSQL_NUM);

				# Echo user info
				echo "<p>Username: $userID</p>";
				echo "<p>Name: ".$arr[1]."</p>";
				echo "<p>Address: ".$arr[2]."</p><br>";
				
				# Set session variables
				$_SESSION['userName'] = $arr[1];
				$_SESSION['userAddress'] = $arr[2];
				
			} else {
				echo "<p>Doesnt work mamshie!</p>";
			}
			
		
		?>
		
		<form action="editProfile.php" method="get">
            <button type="submit">Edit Profile</button>
            <button type="submit" formaction="login.php">Back</button> 
        </form>
	</div>

</body>

</html>