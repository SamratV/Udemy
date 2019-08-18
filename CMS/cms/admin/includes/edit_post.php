<?php
	if(!isset($_GET['p_id']))
		header("Location: posts.php");
	$post_id = escape($_GET['p_id']);
	$stmt = mysqli_prepare($link,"SELECT post_title,post_author,post_status,post_image,post_tags,post_content,post_category_id FROM posts WHERE post_id=?");
	mysqli_stmt_bind_param($stmt,"i",$post_id);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);
	mysqli_stmt_bind_result($stmt,$post_title,$post_author,$post_status,$post_image,$post_tags,$post_content,$post_category_id);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post title</label>
    <input type="text" class="form-control" name="post_title" placeholder="Title" value="<?php echo $post_title;?>" required="required">
  </div>
  <div class="form-group">
    <label for="post_category_id">Post category</label>
	<div>
		<select id="post_category_id" name="post_category_id" class="form-control">
			<?php
				$query = "SELECT * FROM categories";
				$result = mysqli_query($link,$query);
				confirmQuery($result);
				while($row = mysqli_fetch_assoc($result)){
					if($post_category_id == $row['cat_id'])
						$selected = "selected='selected'";
					else
						$selected = "";
					echo "<option value='{$row['cat_id']}' {$selected}>{$row['cat_title']}</option>";
				}
			?>
		</select>
	</div>
  </div>
  <div class="form-group">
    <label for="post_author">Post author</label>
    <input type="hidden" name="post_author" value="<?php echo $post_author;?>">
    <input type="text" class="form-control" value="<?php echo $post_author;?>" disabled="disabled">
  </div>
  <div class="form-group">
    <label for="post_status">Post status</label>
	<select id="post_status" name="post_status" class="form-control" required="required">
		<?php
			if($post_status == 'draft'){
				echo "<option value='draft' selected='selected'>Draft</option>";
				echo "<option value='published'>Publish</option>";
			}else{
				echo "<option value='draft'>Draft</option>";
				echo "<option value='published' selected='selected'>Publish</option>";
			}
		?>
	</select>
  </div>
  <div class="form-group">
	<div class="custom-file">
	  <label for="post_image">Post image</label>
	  <input type="file" class="custom-file-input" name="post_image">
	</div>
	<br>
	<div>
		<img src="<?php echo '../images/'.$post_image;?>" alt="Post image" width="200" height="100">
	</div>
  </div>
  <div class="form-group">
    <label for="post_tags">Post tags</label>
    <input type="text" class="form-control" name="post_tags" placeholder="Tags" value="<?php echo $post_tags;?>" required="required">
  </div>
  <div class="form-group">
    <label for="post_content">Post content</label>
    <textarea class="form-control" name="post_content" id="editor" rows="3" required="required"><?php echo $post_content;?></textarea>
  </div>
  <input type="hidden" name="post_id" value="<?php echo $post_id;?>">
  <div class="form-group">
	<button type="submit" name="update_post" id="update_post" class="btn btn-primary">Update post</button>
  </div>
</form>