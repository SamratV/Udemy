<?php
	include "includes/header.php";
	include "includes/db.php";
	include "includes/navigation.php";
?>

<!-- Blog Entries Column -->
<div class="col-md-8">
	<?php
		if(!isset($_POST['category']))
			relocate("index.php");
		if(isset($_POST['page']))
			$page = $_POST['page'];
		else
			$page = 1;
		$category = escape($_POST['category']);
		$page_1 = ($page*$per_page) - $per_page;
		$page_1 = escape($page_1);

		$query = "SELECT * FROM posts WHERE post_status='published' AND post_category_id={$category}";
		$result = mysqli_query($link,$query);
		$count = ceil(mysqli_num_rows($result)/$per_page);

		$query = "SELECT * FROM posts WHERE post_status='published' AND post_category_id={$category} ORDER BY post_id DESC LIMIT {$page_1},{$per_page}";
		$result = mysqli_query($link,$query);
		if(mysqli_num_rows($result) == 0)
			echo "<p>There is no such post.</p>";
		while($row = mysqli_fetch_assoc($result)){
			$post_id = $row['post_id'];
			$post_title = $row['post_title'];
			$post_author = $row['post_author'];
			$post_date = $row['post_date'];
			$post_image = $row['post_image'];
			$post_content = substr(strip_tags($row['post_content']),0,300).".....";
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
	<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

	<hr>
	<?php }?>
	<form id='pager_form' action='' method='post'>
		<input type='hidden' name='category' value='<?php echo $category;?>'>
		<input type='hidden' id='pageno' name='page' value=''>
	</form>
	<ul class="pager">
		<?php
			for($i=1;$i<=$count;$i++){
				if($i == $page){
					echo "<li><span style='color:#ffd600'>{$i}</span></li>";
				}else{
					echo "<li><a class='pager_links' val='{$i}'>{$i}</a></li>";
				}
			}
		?>
	</ul>
</div>
<script type="text/javascript">
	$(".pager_links").click(function(){
		var page = $(this).attr("val");
		$("#pageno").val(page);
		$("#pager_form").submit();
	});
</script>
<?php include "includes/sidebar.php";?>
<?php include "includes/footer.php";?>