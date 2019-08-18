<?php
	
	session_start();
	$link = mysqli_connect("localhost","root","ubi16","socio");
	if(mysqli_connect_errno()){
		echo mysqli_connect_error();
		exit();
	}
	
	if(array_key_exists('function',$_GET) AND $_GET['function'] == 'logout'){
		session_unset();
        setcookie('id','',time()-3600,'/');
	}
	
	function time_since($since) {
		$chunks = array(
			array(60 * 60 * 24 * 365 , 'year'),
			array(60 * 60 * 24 * 30 , 'month'),
			array(60 * 60 * 24 * 7, 'week'),
			array(60 * 60 * 24 , 'day'),
			array(60 * 60 , 'hour'),
			array(60 , 'minute'),
			array(1 , 'second')
		);

		for ($i = 0; $i < 7; $i++) {
			$time = $chunks[$i][0];
			$name = $chunks[$i][1];
			if (($count = floor($since / $time)) != 0) {
				break;
			}
		}
		
		$print = ($count == 0) ? "Just now" : (($count == 1) ? "1 ".$name." ago" : "$count ".$name."s ago");
		return '<small class="text-muted">'.$print.'</small>';
	}
	
	function displayPosts($type){
		global $link;
		$whereClause = "";
		
		if((array_key_exists('id',$_SESSION) AND $_SESSION['id']) AND $type == "search"){
			
			echo '<p class="text-muted">Showing results for: "'.mysqli_real_escape_string($link,$_GET['q']).'"</p>';
			$whereClause = "WHERE post LIKE '%".mysqli_real_escape_string($link,$_GET['q'])."%'";
			
			$query = "SELECT * FROM users WHERE username LIKE '%".mysqli_real_escape_string($link,$_GET['q'])."%'";
			$result = mysqli_query($link,$query);
			if(mysqli_num_rows($result) > 0){
				
				echo '<div class="searchPublicProfiles">';
				echo '<h5 class="text-muted">Public profiles</h5>';
				while($row = mysqli_fetch_assoc($result)){
					echo '<p><span class="person"><a href="?page=publicprofiles&userid='.$row['id'].'">'.$row['username'].'</a></span></p>';
				}
				echo '</div>';
				
			}
			
			echo '<div class="postHeading"><h5 class="text-muted">Posts</h5></div>';
			
		}else if((array_key_exists('id',$_SESSION) AND $_SESSION['id']) AND $type == "yourposts"){
			
			$whereClause = "WHERE userid='".mysqli_real_escape_string($link,$_SESSION['id'])."'";
			
		}
		else if((array_key_exists('id',$_SESSION) AND $_SESSION['id']) AND $type == 'isfollowing'){
			
			$query = "SELECT * FROM follow WHERE follower='".mysqli_real_escape_string($link,$_SESSION['id'])."'";
			$result = mysqli_query($link,$query);
			while($row = mysqli_fetch_assoc($result)){
				if($whereClause == "") $whereClause = "WHERE";
				else $whereClause .= "OR";
				$whereClause .= " userid='".$row['isfollowing']."'";
			}
			
		}else if(is_numeric($type)){
			
			$whereClause = "WHERE userid='".mysqli_real_escape_string($link,$type)."'";
			$query = "SELECT * FROM `users` WHERE id='".mysqli_real_escape_string($link,$type)."' LIMIT 1";
			$result = mysqli_query($link,$query);
			$row = mysqli_fetch_assoc($result);
			echo "<h2>".mysqli_real_escape_string($link,$row['username'])."'s posts</h2>";
			
		}
		
		$query = "SELECT * FROM `posts` ".$whereClause." ORDER BY `datetime` DESC LIMIT 20";
		$result = mysqli_query($link,$query);
		
		if(mysqli_num_rows($result) == 0){
			echo "There are no posts to display.";
		}else{
			
			$flag = false;
			
			while($row = mysqli_fetch_assoc($result)){
				
				$userQuery = "SELECT * FROM `users` WHERE id='".mysqli_real_escape_string($link,$row['userid'])."' LIMIT 1";
				$userQueryResult = mysqli_query($link,$userQuery);
				$userRow = mysqli_fetch_assoc($userQueryResult);
				
				echo '<div class="post">';
				echo '<p><span class="person"><a href="?page=publicprofiles&userid='.$userRow['id'].'">'.$userRow['username'].'</a></span> '.time_since(time() - strtotime($row['datetime'])).'</p>';
				echo '<p><span id="postText">'.$row['post'].'</span></p>';
				echo '<span class="toggleFollow" data-userId="'.((array_key_exists('id',$_SESSION) AND $_SESSION['id']) ? $row['userid'] : "").'">';
				if(array_key_exists('id',$_SESSION) AND $_SESSION['id']){
					
					if($_SESSION['id'] != $row['userid']){
						
						$flag = false;
						$isFollowinQuery = "SELECT * FROM follow WHERE follower='".mysqli_real_escape_string($link,$_SESSION['id'])."' AND isfollowing='".mysqli_real_escape_string($link,$row['userid'])."' LIMIT 1";
						$isFollowinQueryResult = mysqli_query($link,$isFollowinQuery);
						
						if($row = mysqli_num_rows($isFollowinQueryResult) > 0)
							echo '<i class="fa fa-user-o" aria-hidden="true"></i> Unfollow';
						else
							echo '<i class="fa fa-user" aria-hidden="true"></i> Follow';
						
					}else{
					    $flag = true;	
					}
					
				}else{
					echo '<i class="fa fa-user" aria-hidden="true"></i> Follow';
				}			
				
				echo '</span>';
				if($flag){
					echo '<span class="currentUser"><i class="fa fa-user" aria-hidden="true"></i> You</span>';
				}
				echo '</div>';
			}
			
		}
	}
	
	function displaySearch(){
		echo '<div class="form-inline">
					<div class="form-group mx-sm-3 mb-2">
						<input type="text" name="q" class="form-control" id="search" placeholder="Search">
					</div>
					<button type="button" id="searchButton" class="btn btn-primary mb-2">Search posts</button>
			</div>';
	}
	
	function displayPostBox(){
		if((array_key_exists('id',$_SESSION) AND $_SESSION['id'] > 0) OR (array_key_exists('id',$_COOKIE) AND $_COOKIE['id'] > 0)){
			echo '<div class="form">
						<div class="form-group">
							<textarea class="form-control" id="postContent" rows="5"></textarea>
						</div>
						<button type="button" id="postButton" data-toggle="modal" data-target="#onPost" class="btn btn-primary">Post</button>
				</div>';
		}
	}
	
	function displayUsers(){
		global $link;
		$query = "SELECT * FROM users LIMIT 20";
		$result = mysqli_query($link,$query);
		while($row = mysqli_fetch_assoc($result)){
			echo '<p><a href="?page=publicprofiles&userid='.$row['id'].'"><span class="person">'.$row['username'].'</span></a></p>';
		}
	}
	
?>