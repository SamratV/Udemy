<?php
	include "includes/header.php";
	include "includes/db.php";
	include "includes/navigation.php";
?>
	
<!-- Blog Entries Column -->
<div class="col-md-8">
	<?php
		if(isset($_GET['c']) AND !isAdmin())
			echo "<div class='alert alert-success text-center' id='on_comment' role='alert'>Your comment has been posted and will be displayed upon approval.</div>";
		else if(isset($_GET['c']) AND isAdmin())
			echo "<div class='alert alert-success text-center' id='on_comment' role='alert'>Your comment has been posted successfully.</div>";
		else if(isset($_GET['lc']) AND isAdmin())
			echo "<div class='alert alert-danger text-center' id='on_comment' role='alert'>Your comment is too long.</div>";
		else if(isset($_GET['nc']) AND isAdmin())
			echo "<div class='alert alert-danger text-center' id='on_comment' role='alert'>Empty comment.</div>";
	
		if(!isset($_GET['p_id']))
			relocate("index.php");
		if(isset($_POST['create_comment'])){
			$comment_author = mysqli_real_escape_string($link,$_POST['author_name']);
			$comment_author_email = mysqli_real_escape_string($link,$_POST['comment_author_email']);
			$comment = mysqli_real_escape_string($link,$_POST['comment_content']);
			if(strlen(strip_tags(html_entity_decode($comment))) == 0)
				relocate("post.php?p_id={$_GET['p_id']}&nc=1");
			else if(strlen(strip_tags($comment)) <= 1000){
				$comment_post_id = mysqli_real_escape_string($link,$_GET['p_id']);
				if(isAdmin())
					$comment_status = 'approved';
				else
					$comment_status = 'unapproved';
				$query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_date,comment_status) VALUES('{$comment_post_id}','{$comment_author}','{$comment_author_email}','{$comment}',now(),'{$comment_status}')";
				$result = mysqli_query($link,$query);
			}else
				relocate("post.php?p_id={$_GET['p_id']}&lc=1");
		}
		$query = "UPDATE posts SET post_view_count=post_view_count+1 WHERE post_id='".mysqli_real_escape_string($link,$_GET['p_id'])."'";
		$result = mysqli_query($link,$query);
		$query = "SELECT * FROM posts WHERE post_id='".mysqli_real_escape_string($link,$_GET['p_id'])."'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_assoc($result);
		$post_id = $row['post_id'];
		$post_title = $row['post_title'];
		$post_author = $row['post_author'];
		$post_date = $row['post_date'];
		$post_image = $row['post_image'];
		$post_content = $row['post_content'];			
	?>

	<!-- Blog Post -->
	<h2>
		<a style="color:#449D44" href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
	</h2>
	<p class="lead">
		by <a href="author_posts.php?author=<?php echo $post_author;?>"><?php echo $post_author;?></a>
	</p>
	<small class="text-muted"><i class="far fa-clock"></i> Posted on <?php echo date_to_word(strval($post_date));?></small>
	<hr>
	<a href="post.php?p_id=<?php echo $post_id;?>"><img class="img-responsive" src="images/<?php echo $post_image;?>" width="500" height="300" alt=""></a>
	<hr>
	<p><?php echo $post_content;?></p>
	<hr>
	<!-- Blog Comments -->
	<?php
		if(isset($_SESSION['userid']))
			$flag = true;
		else
			$flag = false;
	?>
	<!-- Comments Form -->
	<div class="well">
		<h4>Leave a Comment:</h4><small class="text-muted">Do not select a programming language while posting a piece of code.</small>
		<form action="post.php?p_id=<?php echo $post_id;?>&c=1" method="post" role="form">
			<div class="form-group <?php if($flag) echo 'hidden';?>">
				<label for="author_name">Author:</label>
				<input type="text" class="form-control" name="author_name" value="<?php if($flag) echo $_SESSION['firstname'].' '.$_SESSION['lastname'];?>" placeholder="Your name" required="<?php if($flag) echo 'not ';?>required">
			</div>
			<div class="form-group <?php if($flag) echo 'hidden';?>">
				<label for="comment_author_email">Email:</label>
				<input type="email" class="form-control" name="comment_author_email" value="<?php if($flag) echo $_SESSION['userid'];?>" placeholder="Your email address" required="<?php if($flag) echo 'not ';?>required">
			</div>
			<div class="form-group">
				<label for="post_comment_content" class="<?php if($flag) echo 'hidden';?>">Comment:</label>
				<textarea class="form-control" rows="3" name="comment_content" id="editor" placeholder="Your comment"></textarea>
			</div>
			<button type="submit" name="create_comment" id="create_comment" maxlength="250" class="btn btn-primary">Submit</button>
		</form>
	</div>

	<hr>

	<!-- Posted Comments -->
	<?php
		$query = "SELECT * FROM comments WHERE comment_post_id='".mysqli_real_escape_string($link,$_GET['p_id'])."' AND comment_status='approved' ORDER BY comment_id DESC";
		$result = mysqli_query($link,$query);
		while($row = mysqli_fetch_assoc($result)){
	?>
	<!-- Comment -->
			<div class="media">
				<div class="media-body">
					<h4 class="media-heading"><?php echo $row['comment_author'];?>
						<small><?php echo date_to_word(strval($row['comment_date']));?></small>
					</h4>
					<?php echo $row['comment_content'];?>
				</div>
			</div>
	<?php }?>
</div>
<script src="js/jquery.js"></script>
<script type="text/javascript">
	$("#on_comment").delay(3000).fadeOut('slow');
</script>
<?php include "includes/sidebar.php";?>	
<?php include "includes/footer.php";?>