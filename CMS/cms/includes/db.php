<?php

	session_start();
	
	$link = mysqli_connect("localhost","root","","cms");
	if(mysqli_connect_error())
		die("Database connection error.");
	
	function escape($string){
		global $link;
		return mysqli_real_escape_string($link,trim($string));
	}

	function confirmQuery($stmt){
		global $link;
		if(!$stmt)
			exit("QUERY FAILED: ".mysqli_error($link));
	}

	if(isset($_COOKIE['userid'])){
		$_SESSION['userid'] = $_COOKIE['userid'];
		$x = escape($_SESSION['userid']);
		$stmt = mysqli_prepare($link,"SELECT username,user_firstname,user_lastname,user_role FROM users WHERE user_email=?");
		mysqli_stmt_bind_param($stmt,"s",$x);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_bind_result($stmt,$username,$user_firstname,$user_lastname,$user_role);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		$_SESSION['username'] = $username;
		$_SESSION['firstname'] = $user_firstname;
		$_SESSION['lastname'] = $user_lastname;
		$_SESSION['role'] = $user_role;
	}

	function isAdmin(){
		return (isset($_SESSION['role']) AND $_SESSION['role'] == 'admin');
	}

	function relocate($location){
		header("Location: ".$location);
		exit("Finish.");
	}

	$per_page = 3;
	
	include "date_to_word.php";
?>