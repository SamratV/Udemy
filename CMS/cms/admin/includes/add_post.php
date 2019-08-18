<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post title</label>
    <input type="text" class="form-control" name="post_title" placeholder="Title" required="required">
  </div>
  <div class="form-group">
    <label for="post_category_id">Post category</label>
	<div>
		<select id="post_category_id" name="post_category_id" class="form-control" required="required">
			<?php
				$select_query = "SELECT * FROM categories";
				$select_result = mysqli_query($link,$select_query);
				confirmQuery($select_result);
				echo "<option selected disabled hidden>Choose a category</option>";
				while($select_row = mysqli_fetch_assoc($select_result)){
					echo "<option value='{$select_row['cat_id']}'>{$select_row['cat_title']}</option>";
				}
        $name = $_SESSION['firstname']." ".$_SESSION['lastname'];
			?>
		</select>
	</div>
  </div>
  <div class="form-group">
    <label for="post_author">Post author</label>
    <input type="hidden" name="post_author" placeholder="Author name" value="<?php echo $name;?>">
    <input type="text" class="form-control" value="<?php echo $name;?>" disabled="disabled">
  </div>
  <div class="form-group">
    <label for="post_status">Post status</label>
    <select id="post_category_id" name="post_status" class="form-control" required="required">	
		<option selected disabled hidden>Choose a status</option>
		<option value="draft">Draft</option>
		<option value="published">Publish</option>
	</select>
  </div>
  <div class="form-group">
	<div class="custom-file">
	  <label for="post_image">Post image</label>
	  <input type="file" class="custom-file-input" name="post_image">
	</div>
  </div>
  <div class="form-group">
    <label for="post_tags">Post tags</label>
    <input type="text" class="form-control" name="post_tags" placeholder="Tags" required="required">
  </div>
  <div class="form-group">
    <label for="post_content">Post content</label>
    <textarea class="form-control" name="post_content" id="editor" rows="3"></textarea>
  </div>
  <div class="form-group">
	<button type="submit" name="submit" id="add_post" class="btn btn-primary">Add post</button>
  </div>
</form>
<?php
	addPost();
?>