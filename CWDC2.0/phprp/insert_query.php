<?php
	$link = mysqli_connect('localhost','root','ubi16','demo');
	if(mysqli_connect_error())
		die('Database connection failure.');
	$email = mysqli_real_escape_string($link,'vaibhawsky@gmail.com');
	$password = mysqli_real_escape_string($link,'ubi16');
	$quote = mysqli_real_escape_string($link,'As you like it.');
	$query = "INSERT INTO demo(email,password,fav_quote) VALUES('".$email."','".$password."','".$quote."')";
	echo $query."<br>";
	if(mysqli_query($link,$query))
		echo "Done.";
	else
		echo "Not done.";
	mysqli_close($link);
?>