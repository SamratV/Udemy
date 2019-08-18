<?php
	include "db.php";
	
	if(!isset($_POST['email']))
		relocate("../index.php");
	if(!isset($_POST['password']))
		relocate("../index.php");
	$username = escape($_POST['username']);
	$firstname = escape($_POST['firstname']);
	$lastname = escape($_POST['lastname']);
	$email = escape($_POST['email']);
	$password = $_POST['password'];
	$status = $_POST['status'];
	if($status == "0"){
		$stmt = mysqli_prepare($link,"SELECT user_email,user_password,user_firstname,user_lastname,user_role,username FROM users WHERE user_email=?");
		mysqli_stmt_bind_param($stmt,"s",$email);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_bind_result($stmt,$user_email,$user_password,$user_firstname,$user_lastname,$user_role,$username);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_fetch($stmt);
		if(mysqli_stmt_num_rows($stmt) == 0)
			relocate("../index.php?auth_error=l1");
		else{
			if(password_verify($password,$user_password)){
				$_SESSION['userid'] = $user_email;
				$_SESSION['username'] = $username;
				$_SESSION['firstname'] = $user_firstname;
				$_SESSION['lastname'] = $user_lastname;
				$_SESSION['role'] = $user_role;
				if(isset($_POST['stay-logged-in']))
					setcookie("userid", $email, time() + (86400 * 30), "/");
				relocate("../index.php?auth_success=1");
			}else
				relocate("../index.php?auth_error=l2");
		}
		mysqli_stmt_close($stmt);
	}else{

		if(!isset($username) || trim($username) == ''){
			relocate("../index.php?auth_error=s2");
			exit("Authentication error.");
		}
		if((!isset($firstname) || trim($firstname) == '')){
			relocate("../index.php?auth_error=s3");
			exit("Authentication error.");
		}
		if((!isset($lastname) || trim($lastname) == '')){
			relocate("../index.php?auth_error=s4");
			exit("Authentication error.");
		}
		if(strlen($username) < 6){
			relocate("../index.php?auth_error=s5");
			exit("Authentication error.");
		}
		if(strlen($_POST['password']) < 6){
			relocate("../index.php?auth_error=s6");
			exit("Authentication error.");
		}

		$stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE user_email=?");
		mysqli_stmt_bind_param($stmt,"s",$email);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_store_result($stmt);
		$x = mysqli_stmt_num_rows($stmt);
		mysqli_stmt_close($stmt);
		if($x != 0){
			relocate("../index.php?auth_error=s1a");
			exit("Duplicate entry.");
		}

		$stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE username=?");
		mysqli_stmt_bind_param($stmt,"s",$username);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_store_result($stmt);
		$x = mysqli_stmt_num_rows($stmt);
		mysqli_stmt_close($stmt);
		if($x != 0){
			relocate("../index.php?auth_error=s1b");
			exit("Duplicate entry.");
		}

		$date = escape(date('Y-m-d'));
		$password = escape(password_hash($password,PASSWORD_BCRYPT,array('cost' => 12)));
		$stmt = mysqli_prepare($link,"INSERT INTO users (username,user_email,user_password,user_firstname,user_lastname,account_created) VALUES(?,?,?,?,?,?)");
		mysqli_stmt_bind_param($stmt,"ssssss",$username,$email,$password,$firstname,$lastname,$date);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		$_SESSION['userid'] = $email;
		$_SESSION['username'] = $username;
		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['role'] = 'subscriber';
		if(isset($_POST['stay-logged-in']))
			setcookie("userid", $email, time() + (86400 * 30), "/");
		relocate("../index.php?auth_success=1&new=w1aqZ");			
	}
?>