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
		
		<p class="login">Welcome, <?php echo htmlspecialchars($_POST['userID']); ?>.</p>
		
		<form action="index.php" method="post" class="textbox" style="margin-right: 50px;">
    		<button class="submit" type="submit">LOG OUT</button>
		</form>
		
	</div>

	<!--BODY-->
	<div class="mainbody">
		Hi <?php echo htmlspecialchars($_POST['userID']); ?>.
		Your password is <?php echo $_POST['userPassword']; ?>. Nako.

		<p><a href="index.php">Go back</a></p>


	</div>

</body>

</html>