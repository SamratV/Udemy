<?php
	if(!isAdmin())
		relocate("../index.php");
	
	if(isset($_GET['post_view_count_reset'])){
		$id = escape($_GET['post_view_count_reset']);
		$stmt = mysqli_prepare($link,"UPDATE posts SET post_view_count=0 WHERE post_id=?");
		mysqli_stmt_bind_param($stmt,"i",$id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		relocate("posts.php");
	}

	if(isset($_POST['update_profile'])){
		$user_id = escape($_POST['user_id']);
		$user_firstname = escape($_POST['user_firstname']);
		$user_lastname = escape($_POST['user_lastname']);
		$user_role = escape($_POST['user_role']);
		$username = escape($_POST['username']);
		$user_email = escape($_POST['user_email']);
		$user_password = escape(password_hash($_POST['user_password'],PASSWORD_BCRYPT,array('cost' => 12)));
		$stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE user_email=? AND user_id!=?");
		mysqli_stmt_bind_param($stmt,"si",$user_email,$user_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_store_result($stmt);
		if(mysqli_stmt_num_rows($stmt) > 0){
			relocate("./profile.php?update_failure=1");
		}
		mysqli_stmt_close($stmt);
		$stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE username=? AND user_id!=?");
		mysqli_stmt_bind_param($stmt,"si",$username,$user_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_store_result($stmt);
		if(mysqli_stmt_num_rows($stmt) > 0){
			relocate("./profile.php?update_failure=2");
		}
		mysqli_stmt_close($stmt);
		$_SESSION['userid'] = $user_email;
		$_SESSION['username'] = $username;
		$_SESSION['firstname'] = $user_firstname;
		$_SESSION['lastname'] = $user_lastname;
		$stmt = mysqli_prepare($link,"UPDATE users SET user_firstname=?,user_lastname=?,user_role=?,username=?,user_email=?,user_password=? WHERE user_id=?");
		mysqli_stmt_bind_param($stmt,"ssssssi",$user_firstname,$user_lastname,$user_role,$username,$user_email,$user_password,$user_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("./profile.php?update_success=1");
	}
	
	if(isset($_POST['cat_title'])){
		$x = escape($_POST['cat_title']);
		$stmt = mysqli_prepare($link,"INSERT INTO categories (cat_title) VALUES(?)");
		mysqli_stmt_bind_param($stmt,"s",$x);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("categories.php");
	}
	
	if(isset($_POST['update_cat_title'])){
		$x = escape($_POST['update_cat_title']);
		$stmt = mysqli_prepare($link,"UPDATE categories SET cat_title=? WHERE cat_id=?");
		mysqli_stmt_bind_param($stmt,"si",$x,$_POST['update_cat_id']);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("categories.php");
	}
	
	if(isset($_GET['cat_delete'])){
		$x = escape($_GET['cat_delete']);
		$stmt = mysqli_prepare($link,"DELETE FROM categories WHERE cat_id=? LIMIT 1");
		mysqli_stmt_bind_param($stmt,"i",$x);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("categories.php");
	}
	
	if(isset($_GET['user_delete'])){
		$x = escape($_GET['user_delete']);
		$stmt = mysqli_prepare($link,"DELETE FROM users WHERE user_id=? LIMIT 1");
		mysqli_stmt_bind_param($stmt,"i",$x);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("users.php");
	}
	
	if(isset($_GET['post_delete'])){
		$x = escape($_GET['post_delete']);
		$stmt = mysqli_prepare($link,"SELECT post_image FROM posts WHERE post_id=?");
		mysqli_stmt_bind_param($stmt,"i",$x);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_bind_result($stmt,$post_image);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		@chmod("../images/".$post_image,0777);
        @unlink("../images/".$post_image);
        $stmt = mysqli_prepare($link,"DELETE FROM comments WHERE comment_post_id=?");
		mysqli_stmt_bind_param($stmt,"i",$x);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		$stmt = mysqli_prepare($link,"DELETE FROM posts WHERE post_id=? LIMIT 1");
		mysqli_stmt_bind_param($stmt,"i",$x);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("posts.php");
	}
	
	if(isset($_POST['update_post'])){
		$id = escape($_POST['post_id']);
		$title = escape($_POST['post_title']);
		$category = escape($_POST['post_category_id']);
		$author = escape($_POST['post_author']);
		$status = escape($_POST['post_status']);
		$tags = escape($_POST['post_tags']);
		$content = $_POST['post_content'];
		if(strlen(strip_tags(html_entity_decode($content))) != 0){
			$type = $_FILES['post_image']['name'];
			$image_temp = $_FILES['post_image']['tmp_name'];
			$date = escape(date("Y-m-d"));
			$stmt = mysqli_prepare($link,"UPDATE posts SET post_category_id=?,post_date=?,post_title=?,post_author=?,post_content=?,post_tags=?,post_status=? WHERE post_id=?");
			mysqli_stmt_bind_param($stmt,"issssssi",$category,$date,$title,$author,$content,$tags,$status,$id);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_close($stmt);
			if($type){
				$stmt = mysqli_prepare($link,"SELECT post_image FROM posts WHERE post_id=?");
				mysqli_stmt_bind_param($stmt,"i",$id);
				mysqli_stmt_execute($stmt);
				confirmQuery($stmt);
				mysqli_stmt_bind_result($stmt,$post_image);
				mysqli_stmt_fetch($stmt);
				mysqli_stmt_close($stmt);

				@chmod("../images/".$post_image,0777);
				@unlink("../images/".$post_image);

				$newfilename = md5(date('d-m-y')).round(microtime(true)).$type;
				move_uploaded_file($image_temp,"../images/{$newfilename}");
				$image = escape($newfilename);

				$stmt = mysqli_prepare($link,"UPDATE posts SET post_image=? WHERE post_id=?");
				mysqli_stmt_bind_param($stmt,"si",$image,$id);
				mysqli_stmt_execute($stmt);
				confirmQuery($stmt);
				mysqli_stmt_close($stmt);
			}
			relocate("posts.php?source=edit_post&p_id={$_GET['p_id']}&success=1");
		}else
			relocate("posts.php?source=edit_post&p_id={$_GET['p_id']}&et=1");
	}
	
	if(isset($_POST['edit_user'])){
		$user_id = escape($_POST['user_id']);
		$user_firstname = escape($_POST['user_firstname']);
		$user_lastname = escape($_POST['user_lastname']);
		$user_role = escape($_POST['user_role']);
		$username = escape($_POST['username']);
		$user_email = escape($_POST['user_email']);
		$user_password = escape(password_hash($_POST['user_password'],PASSWORD_BCRYPT,array('cost' => 12)));
		$stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE user_email=? AND user_id!=?");
		mysqli_stmt_bind_param($stmt,"si",$user_email,$user_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_store_result($stmt);
		if(mysqli_stmt_num_rows($stmt) > 0){
			relocate("./users.php?source=edit_user&u_id={$user_id}&failure=1");			
		}
		mysqli_stmt_close($stmt);
		$stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE username=? AND user_id!=?");
		mysqli_stmt_bind_param($stmt,"si",$username,$user_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_store_result($stmt);
		if(mysqli_stmt_num_rows($stmt) > 0){
			relocate("./users.php?source=edit_user&u_id={$user_id}&failure=2");			
		}
		mysqli_stmt_close($stmt);
		$stmt = mysqli_prepare($link,"UPDATE users SET user_firstname=?,user_lastname=?,user_role=?,username=?,user_email=?,user_password=? WHERE user_id=?");
		mysqli_stmt_bind_param($stmt,"ssssssi",$user_firstname,$user_lastname,$user_role,$username,$user_email,$user_password,$user_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("./users.php?source=edit_user&u_id={$user_id}&edit_success=1");
	}
?>