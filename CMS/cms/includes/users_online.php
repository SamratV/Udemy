<?php
	
	include "db.php";

	$time = time();
	$time_out_in_seconds = 5;
	$time_out = $time - $time_out_in_seconds;
	
	if(isset($_GET['presence'])){
		$session = escape($_SESSION['username']);
		$sql = "SELECT * FROM users_online WHERE session='{$session}'";
		$sql_result = mysqli_query($link,$sql);
		if(mysqli_num_rows($sql_result) > 0)
			$sql = "UPDATE users_online SET time='{$time}' WHERE session='{$session}'";
		else
			$sql = "INSERT INTO users_online (session,time) VALUES('{$session}','{$time}')";
		mysqli_query($link,$sql);
	}

	if(isset($_GET['count_presence'])){
		$sql = "SELECT * FROM users_online WHERE time>'{$time_out}'";
		$sql_result = mysqli_query($link,$sql);
		$users_online = mysqli_num_rows($sql_result);
		echo $users_online;
	}

	$sql = "DELETE FROM users_online WHERE time<'{$time_out}'";
	mysqli_query($link,$sql);
?>