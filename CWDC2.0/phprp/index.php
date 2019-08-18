<?php
	$link = mysqli_connect("localhost","root","ubi16","userdb");
	if(mysqli_connect_error())
		die("Connection unsuccessful.");
	if(array_key_exists('email',$_POST) AND array_key_exists('password',$_POST))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$query = "SELECT id FROM user WHERE email = '".mysqli_real_escape_string($link,$email)."'";
		$result = mysqli_query($link,$query);
		if(mysqli_num_rows($result) > 0)
		{
			echo "You are already registered.<br>";
		}
		else
		{
			$query = "INSERT INTO user (email,password,name) VALUES ('".mysqli_real_escape_string($link,$email)."','".mysqli_real_escape_string($link,$password)."','".mysqli_real_escape_string($link,$name)."')";
			if(mysqli_query($link,$query))
				echo "Welcome aboard ".$name.".";
			else
				echo "Sorry, we can't process the request right now.";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Simple form</title>
	</head>
	<body>
		<form method="post">
			<label for="name">Name:</label>
			<input id="name" type="text" name="name" placeholder="Your name." required>
			<label for="email">Email:</label>
			<input id="email" type="text" name="email" placeholder="Your email address." required>
			<label for="password">Password:</label>
			<input id="password" type="password" name="password" required>
			<input type="submit" id="submit" value="Submit">
		</form>
	</body>
</html>