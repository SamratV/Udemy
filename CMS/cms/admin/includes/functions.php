<?php

	function verifyAdmin(){
		if(isAdmin())
			echo $_SESSION['username'];
		else
			relocate("../index.php");
	}

	include "aux_functions.php";

	function bulkUpdate($status,$id){
		global $link;
		$status = escape($status);
		$id = escape($id);
		if($status == "delete"){
			$stmt = mysqli_prepare($link,"SELECT post_image FROM posts WHERE post_id=?");
			mysqli_stmt_bind_param($stmt,"i",$id);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_bind_result($stmt,$post_image);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
			@chmod("../images/".$post_image,0777);
	        @unlink("../images/".$post_image);
	        $stmt = mysqli_prepare($link,"DELETE FROM comments WHERE comment_post_id=?");
			mysqli_stmt_bind_param($stmt,"i",$id);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_close($stmt);
			$stmt = mysqli_prepare($link,"DELETE FROM posts WHERE post_id=? LIMIT 1");
			mysqli_stmt_bind_param($stmt,"i",$id);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_close($stmt);
		}else if($status == "clone"){
			$stmt = mysqli_prepare($link,"SELECT post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status FROM posts WHERE post_id=?");
			mysqli_stmt_bind_param($stmt,"i",$id);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_bind_result($stmt,$category,$title,$author,$date,$image,$content,$tags,$state);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
			$stmt = mysqli_prepare($link,"INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) VALUES(?,?,?,?,?,?,?,?)");
			mysqli_stmt_bind_param($stmt,"isssssss",$category,$title,$author,$date,$image,$content,$tags,$state);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_close($stmt);
		}else{
			$stmt = mysqli_prepare($link,"UPDATE posts SET post_status=? WHERE post_id=?");
			mysqli_stmt_bind_param($stmt,"si",$status,$id);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_close($stmt);
		}
	}

	function bulkCommentUpdate($status,$id){
		global $link;
		$status = escape($status);
		$id = escape($id);
		if($status == "delete"){
			$stmt = mysqli_prepare($link,"DELETE FROM comments WHERE comment_id=? LIMIT 1");
			mysqli_stmt_bind_param($stmt,"i",$id);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_close($stmt);
		}else{
			$stmt = mysqli_prepare($link,"UPDATE comments SET comment_status='{$status}' WHERE comment_id=?");
			mysqli_stmt_bind_param($stmt,"i",$id);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_close($stmt);
		}
	}

	function makeAdmin($user_id){
		global $link;
		$user_id = escape($user_id);
		$stmt = mysqli_prepare($link,"UPDATE users SET user_role='admin' WHERE user_id=?");
		mysqli_stmt_bind_param($stmt,"i",$user_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("users.php");
	}

	function makeSub($user_id){
		global $link;
		$user_id = escape($user_id);
		$stmt = mysqli_prepare($link,"UPDATE users SET user_role='subscriber' WHERE user_id=?");
		mysqli_stmt_bind_param($stmt,"i",$user_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("users.php");
	}

	function commentApprove($comment_id){
		global $link;
		$comment_id = escape($comment_id);
		$stmt = mysqli_prepare($link,"UPDATE comments SET comment_status='approved' WHERE comment_id=?");
		mysqli_stmt_bind_param($stmt,"i",$comment_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("comments.php");
	}

	function commentUnapprove($comment_id){
		global $link;
		$comment_id = escape($comment_id);
		$stmt = mysqli_prepare($link,"UPDATE comments SET comment_status='unapproved' WHERE comment_id=?");
		mysqli_stmt_bind_param($stmt,"i",$comment_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("comments.php");
	}

	function commentDelete($comment_id){
		global $link;
		$comment_id = escape($comment_id);
		$stmt = mysqli_prepare($link,"DELETE FROM comments WHERE comment_id=? LIMIT 1");
		mysqli_stmt_bind_param($stmt,"i",$comment_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("comments.php");
	}

	function commentApproveSpecific($comment_id,$post_id){
		global $link;
		$comment_id = escape($comment_id);
		$stmt = mysqli_prepare($link,"UPDATE comments SET comment_status='approved' WHERE comment_id=?");
		mysqli_stmt_bind_param($stmt,"i",$comment_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("comment.php?p_id={$post_id}");
	}

	function commentUnapproveSpecific($comment_id,$post_id){
		global $link;
		$comment_id = escape($comment_id);
		$stmt = mysqli_prepare($link,"UPDATE comments SET comment_status='unapproved' WHERE comment_id=?");
		mysqli_stmt_bind_param($stmt,"i",$comment_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		relocate("comment.php?p_id={$post_id}");
	}

	function commentDeleteSpecific($comment_id,$post_id){
		global $link;
		$comment_id = escape($comment_id);
		$stmt = mysqli_prepare($link,"DELETE FROM comments WHERE comment_id=? LIMIT 1");
		mysqli_stmt_bind_param($stmt,"i",$comment_id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_close($stmt);
		$count -= 1;
		relocate("comment.php?p_id={$post_id}");
	}

	function listAllPostSpecificComments($id){
		global $link;
		$stmt = mysqli_prepare($link,"SELECT comments.comment_id,comments.comment_post_id,comments.comment_author,comments.comment_email,comments.comment_content,comments.comment_status,comments.comment_date,posts.post_id,posts.post_title,posts.post_author FROM comments LEFT JOIN posts ON comments.comment_post_id=posts.post_id WHERE comments.comment_post_id=? ORDER BY comments.comment_id DESC");
		mysqli_stmt_bind_param($stmt,"i",$id);
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_bind_result($stmt,$comment_id,$comment_post_id,$comment_author,$comment_email,$comment_content,$comment_status,$comment_date,$post_id,$post_title,$post_author);
		while(mysqli_stmt_fetch($stmt)){
			echo "<tr><td><input class='checkBoxes' name='checkBoxArray[]' type='checkbox' value='".$comment_id."'></td>";
			echo "<td>{$comment_id}</td>";
			echo "<td>{$comment_author}</td>";
			echo "<td>{$comment_content}</td>";
			echo "<td>{$comment_email}</td>";
			echo "<td>{$comment_status}</td>";
			echo "<td><a href='../post.php?p_id={$id}'>{$post_title}</a><hr>Author: <a href='../author_posts.php?author={$post_author}'>{$post_author}</td>";
			echo "<td>".date_to_word(strval($comment_date))."</td>";
			if($comment_status == 'unapproved')
				echo "<td><a href='comment.php?source=comment_approve&approve={$comment_id}&p_id={$id}'><button type'button' class='btn btn-success'>Approve</button></a></td>";
			else
				echo "<td><button type'button' class='btn btn-success disabled'>Approve</button></td>";
			if($comment_status == 'approved')
				echo "<td><a href='comment.php?source=comment_unapprove&unapprove={$comment_id}&p_id={$id}'><button type='button' class='btn btn-warning'>Unapprove</button></a></td>";
			else
				echo "<td><button type='button' class='btn btn-warning disabled'>Unapprove</button></td>";
			echo "<td><a class='the_link'  data-toggle='modal' data-target='#the_modal' msg_title='Confirm comment deletion' msg='Are you sure about deleting this comment?' url='comment.php?source=comment_delete&delete={$comment_id}&p_id={$id}'><button type'button' class='btn btn-danger'>Delete</button></a></td></tr>";
		}
		mysqli_stmt_close($stmt);
	}

	function listAllUsers(){
		global $link;
		$stmt = mysqli_prepare($link,"SELECT user_id,username,user_firstname,user_lastname,user_email,user_role,account_created FROM users ORDER BY username ASC");
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_bind_result($stmt,$user_id,$username,$user_firstname,$user_lastname,$user_email,$user_role,$account_created);
		while(mysqli_stmt_fetch($stmt)){
			echo "<tr><td>{$user_id}</td>";
			echo "<td>{$username}</td>";
			echo "<td>{$user_firstname}</td>";
			echo "<td>{$user_lastname}</td>";
			echo "<td>{$user_email}</td>";
			echo "<td>{$user_role}</td>";
			echo "<td>".date_to_word(strval($account_created))."</td>";
			if($_SESSION['userid'] != $user_email){
				if($user_role != 'admin')
					echo "<td><a href='users.php?source=make_admin&u_id={$user_id}'><button type'button' class='btn btn-success'>Make admin</button></a></td>";
				else
					echo "<td><button type'button' class='btn btn-success disabled'>Make admin</button></td>";
				if($user_role == 'admin')
					echo "<td><a href='users.php?source=make_sub&u_id={$user_id}'><button type='button' class='btn btn-warning'>Make subscriber</button></a></td>";
				else
					echo "<td><button type='button' class='btn btn-warning disabled'>Make subscriber</button></td>";
				echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'><button type='button' class='btn btn-primary'>Edit</button></a></td>";
				echo "<td><a class='the_link' data-toggle='modal' data-target='#the_modal' msg_title='Confirm user deletion' msg='Are you sure about deleting this user?' url='users.php?user_delete={$user_id}'><button type='button' class='btn btn-danger'>Delete</button></a></td></tr>";
			}else{
				echo "<td><button type'button' class='btn btn-success disabled'>Make admin</button></td>";
				echo "<td><button type='button' class='btn btn-warning disabled'>Make subscriber</button></td>";
				echo "<td><a href='profile.php'><button type='button' class='btn btn-primary'>Edit your profile</button></a></td>";
				echo "<td><button type='button' class='btn btn-danger disabled'>Delete</button></td></tr>";
			}
		}
		mysqli_stmt_close($stmt);
	}

	function listAllCategories(){
		global $link;
		$stmt = mysqli_prepare($link,"SELECT cat_id,cat_title FROM categories ORDER BY cat_title ASC");
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_bind_result($stmt,$cat_id,$cat_title);
		while(mysqli_stmt_fetch($stmt)){
			echo "<tr><td>{$cat_id}</td>";
			echo "<td>{$cat_title}</td>";
			echo "<td><a href='categories.php?edit={$cat_id}&value={$cat_title}'><i class='fa fa-edit'></i></a></td>";
			echo "<td><a class='the_link'  data-toggle='modal' data-target='#the_modal' msg_title='Confirm category deletion' msg='Are you sure about deleting this category?' style='color:#b71c1c' url='categories.php?cat_delete={$cat_id}'><i class='fa fa-close'></i></a></td></tr>";
		}
		mysqli_stmt_close($stmt);
	}

	function listAllComments(){
		global $link;
		$stmt = mysqli_prepare($link,"SELECT comments.comment_id,comments.comment_post_id,comments.comment_author,comments.comment_email,comments.comment_content,comments.comment_status,comments.comment_date,posts.post_id,posts.post_title,posts.post_author FROM comments LEFT JOIN posts ON comments.comment_post_id=posts.post_id ORDER BY comments.comment_id DESC");
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_bind_result($stmt,$comment_id,$comment_post_id,$comment_author,$comment_email,$comment_content,$comment_status,$comment_date,$post_id,$post_title,$post_author);
		while(mysqli_stmt_fetch($stmt)){
			echo "<tr><td>{$comment_id}</td>";
			echo "<td>{$comment_author}</td>";
			echo "<td>{$comment_content}</td>";
			echo "<td>{$comment_email}</td>";
			echo "<td>{$comment_status}</td>";
			echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a><hr>Author: <a href='../author_posts.php?author={$post_author}'>{$post_author}</td>";
			echo "<td>".date_to_word(strval($comment_date))."</td>";
			if($comment_status == 'unapproved')
				echo "<td><a href='comments.php?source=comment_approve&approve={$comment_id}'><button type'button' class='btn btn-success'>Approve</button></a></td>";
			else
				echo "<td><button type'button' class='btn btn-success disabled'>Approve</button></td>";
			if($comment_status == 'approved')
				echo "<td><a href='comments.php?source=comment_unapprove&unapprove={$comment_id}'><button type='button' class='btn btn-warning'>Unapprove</button></a></td>";
			else
				echo "<td><button type='button' class='btn btn-warning disabled'>Unapprove</button></td>";
			echo "<td><a class='the_link'  data-toggle='modal' data-target='#the_modal' msg_title='Confirm comment deletion' msg='Are you sure about deleting this comment?' url='comments.php?source=comment_delete&delete={$comment_id}'><button type'button' class='btn btn-danger'>Delete</button></a></td></tr>";
		}
		mysqli_stmt_close($stmt);
	}

	function listAllPosts(){
		global $link;
		$stmt = mysqli_prepare($link,"SELECT COUNT(CASE WHEN p.post_id=k.comment_post_id THEN 1 END) as comment_count,p.post_id,p.post_category_id,p.post_title,p.post_author,p.post_date,p.post_image,p.post_tags,p.post_status,p.post_view_count,c.cat_title
			FROM posts p
			    LEFT JOIN categories c ON c.cat_id = p.post_category_id
			    LEFT JOIN comments k ON k.comment_post_id=p.post_id
			GROUP BY p.post_id	DESC");
		mysqli_stmt_execute($stmt);
		confirmQuery($stmt);
		mysqli_stmt_bind_result($stmt,$comment_count,$post_id,$post_category_id,$post_title,$post_author,$post_date,$post_image,$post_tags,$post_status,$post_view_count,$cat_title);
		while(mysqli_stmt_fetch($stmt)){
			echo "<tr><td><input class='checkBoxes' name='checkBoxArray[]' type='checkbox' value='".$post_id."'></td>";
			echo "<td>{$post_id}</td>";
			echo "<td><a href='../author_posts.php?author={$post_author}'>{$post_author}</a></td>";
			echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
			echo "<td><a href='../category.php?category={$post_category_id}'>{$cat_title}</a></td>";
			echo "<td>{$post_status}</td>";
			echo "<td><img style='margin: 0 auto;' class='img-responsive' src='../images/{$post_image}' width='50' height='50' alt=''></td>";
			echo "<td>{$post_tags}</td>";
			if($comment_count != 0)
				echo "<td><a href='comment.php?p_id={$post_id}'>{$comment_count}</a></td>";
			else
				echo "<td><span style='color: #92CE92'>0</span></td>";
			echo "<td>".date_to_word(strval($post_date))."</td>";
			if($post_view_count != 0)
				echo "<td><a class='the_link'  data-toggle='modal' data-target='#the_modal' msg_title='View count reset' msg='Are you sure?' url='posts.php?post_view_count_reset={$post_id}'>{$post_view_count}</a></td>";
			else
				echo "<td><span style='color: #92CE92'>0</span></td>";
			echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'><i class='fa fa-edit'></i></a></td>";
			echo "<td><a style='color:#b71c1c' class='the_link'  data-toggle='modal' data-target='#the_modal' msg_title='Confirm post deletion' msg='Are you sure about deleting this post?' url='posts.php?post_delete={$post_id}'><i class='fa fa-close'></i></a></td></tr>";
		}
		mysqli_stmt_close($stmt);
	}

	function addUser(){
		global $link;
		if(isset($_POST['create_user'])){
			$date = escape(date("Y-m-d"));
			$user_firstname = escape($_POST['user_firstname']);
			$user_lastname = escape($_POST['user_lastname']);
			$user_role = escape($_POST['user_role']);
			$username = escape($_POST['username']);
			$user_email = escape($_POST['user_email']);
			$user_password = escape(password_hash($_POST['user_password'],PASSWORD_BCRYPT,array('cost' => 12)));
			$stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE user_email=?");
			mysqli_stmt_bind_param($stmt,"s",$user_email);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_store_result($stmt);
			if(mysqli_stmt_num_rows($stmt) > 0){
				relocate("./users.php?source=add_user&failure=1");
			}
			mysqli_stmt_close($stmt);
			$stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE username=?");
			mysqli_stmt_bind_param($stmt,"s",$username);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_store_result($stmt);
			if(mysqli_stmt_num_rows($stmt) > 0){
				relocate("./users.php?source=add_user&failure=2");
			}
			mysqli_stmt_close($stmt);
			$stmt = mysqli_prepare($link,"INSERT INTO users (user_firstname,user_lastname,user_role,username,user_email,user_password,account_created) VALUES(?,?,?,?,?,?,?)");
			mysqli_stmt_bind_param($stmt,"sssssss",$user_firstname,$user_lastname,$user_role,$username,$user_email,$user_password,$date);
			mysqli_stmt_execute($stmt);
			confirmQuery($stmt);
			mysqli_stmt_close($stmt);
			$id = mysqli_insert_id($link);
			relocate("./users.php?source=add_user&u_id={$id}&add_success=1");
		}
	}

	function addPost(){
		global $link;
		if(isset($_POST['submit'])){
			$title = escape($_POST['post_title']);
			$category = escape($_POST['post_category_id']);
			$author = escape($_POST['post_author']);
			$status = escape($_POST['post_status']);
			$tags = escape($_POST['post_tags']);
			$content = $_POST['post_content'];
			if(strlen(strip_tags(html_entity_decode($content))) != 0){
				$date = escape(date("Y-m-d"));
				$image_temp = $_FILES['post_image']['tmp_name'];
				$type = $_FILES['post_image']['name'];
				$newfilename = md5(date('d-m-y')).round(microtime(true)).$type;// To give image a unique name
				move_uploaded_file($image_temp,"../images/{$newfilename}");
				$image = escape($newfilename);// Actually it is mysqli_real_escape_string()

				$stmt = mysqli_prepare($link,"INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) VALUES(?,?,?,?,?,?,?,?)");
				mysqli_stmt_bind_param($stmt,"ssssssss",$category,$title,$author,$date,$image,$content,$tags,$status);
				mysqli_stmt_execute($stmt);
				confirmQuery($stmt);
				mysqli_stmt_close($stmt);
				$id = mysqli_insert_id($link);
				relocate("posts.php?source=add_post&p_id=".strval($id)."&add_success=1");
			}else
				relocate("posts.php?source=add_post&et=1");
		}
	}
?>
