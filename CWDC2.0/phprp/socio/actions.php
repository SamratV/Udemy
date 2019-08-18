<?php
	
	include("functions.php");
	
	if($_GET['action'] == "loginSignup"){
		
		$error = "";
		
		if(!$_POST['email']){
			$error .="Email address required. ";
		}else if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$error .= "Enter a valid email address. ";
		}
		
		if(!$_POST['password']){
			$error .= "Password required. ";
		}
		
		if($_POST['loginActive'] == "0" AND !$_POST['username']){
			$error .= "Username required. ";
		}
		
		if($error != ""){
			echo $error;
			exit();
		}
		
		if($_POST['loginActive'] == "0"){
			$query = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
			$result = mysqli_query($link,$query);
			if(mysqli_fetch_row($result) > 0) $error .="That email address is already taken. ";
			else{
				$query = "INSERT INTO `users` (`email`,`username`,`password`) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['username'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
				
				if(mysqli_query($link,$query)){
					$id = mysqli_insert_id($link);
					$query = "UPDATE users SET password='".md5(md5($id).$_POST['password'])."' WHERE id='".mysqli_real_escape_string($link,$id)."' LIMIT 1";
					mysqli_query($link,$query);
					$_SESSION['id'] = $id;
					if(array_key_exists('stay-logged-in',$_POST)){
						setcookie('id',$id,time()+60*60*24*365,"/");
					}
					echo 1;
				}else{
					$error .= "Couldn't create user - please try again later. ";
				}
				
			}
		}else{
			$query = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
			$result = mysqli_query($link,$query);
			$row = mysqli_fetch_assoc($result);
			if(md5(md5($row['id']).$_POST['password']) == $row['password']){
				$_SESSION['id'] = $row['id'];
				if(array_key_exists('stay-logged-in',$_POST)){
					setcookie('id',$row['id'],time()+60*60*24*365,"/");
				}
				echo 1;
			}else{
				$error .= "Couldn't find that email/password combination - please try again later. ";
			}			
		}
		
		if($error != ""){
			echo $error;
			exit();
		}
		
	}else if($_GET['action'] == "toggleFollow"){
		$query = "SELECT * FROM follow WHERE follower='".mysqli_real_escape_string($link,$_SESSION['id'])."' AND isfollowing='".mysqli_real_escape_string($link,$_POST['userId'])."' LIMIT 1";
		$result = mysqli_query($link,$query);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$query = "DELETE FROM follow WHERE id='".mysqli_real_escape_string($link,$row['id'])."' LIMIT 1";
			mysqli_query($link,$query);
			echo "1";
		}else{
			$query = "INSERT INTO follow (follower,isfollowing) VALUES('".mysqli_real_escape_string($link,$_SESSION['id'])."','".mysqli_real_escape_string($link,$_POST['userId'])."')";
			mysqli_query($link,$query);
			echo "2";
		}
	}else if($_GET['action'] == "post"){
		if(!$_POST['postContent']){
			echo "Your post is empty.";
		}else if(strlen($_POST['postContent']) > 250){
			echo "Your post is too long.";
		}else{
			$query = "INSERT INTO posts (post,userid,datetime) VALUES('".mysqli_real_escape_string($link,$_POST['postContent'])."','".mysqli_real_escape_string($link,$_SESSION['id'])."',NOW())";
			mysqli_query($link,$query);
			echo "1";
		}
	}
	
?>