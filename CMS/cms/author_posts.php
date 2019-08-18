<?php
	include "includes/header.php";
	include "includes/db.php";
	include "includes/navigation.php";
?>
	
<!-- Blog Entries Column -->
<div class="col-md-8">
	<?php
		if(!isset($_GET['author']))
			relocate("index.php");
		
		$post_author = mysqli_real_escape_string($link,$_GET['author']);
		echo "<h1 class='page-header text-center'>{$post_author}'s posts</h1>";

		if(isset($_GET['page']))
			$page = $_GET['page'];
		else
			$page = 1;

		$page_1 = ($page*$per_page) - $per_page;
		$page_1 = mysqli_real_escape_string($link,$page_1);

		$query = "SELECT * FROM posts WHERE post_author='{$post_author}'";
		$result = mysqli_query($link,$query);
		$count = ceil(mysqli_num_rows($result)/$per_page);

		$query = "SELECT * FROM posts WHERE post_author='{$post_author}' ORDER BY post_id DESC LIMIT {$page_1},{$per_page}";
		$result = mysqli_query($link,$query);
		while($row = mysqli_fetch_assoc($result)){
			$post_id = $row['post_id'];
			$post_title = $row['post_title'];
			$post_date = $row['post_date'];
			$post_image = $row['post_image'];
			$post_content = substr(strip_tags($row['post_content']),0,300).".....";			
	?>

	<!-- Blog Post -->
	<h2>
		<a style="color:#449D44" href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
	</h2>
	<small class="text-muted"><i class="far fa-clock"></i> Posted on <?php echo date_to_word(strval($post_date));?></small>
	<hr>
	<a href="post.php?p_id=<?php echo $post_id;?>"><img class="img-responsive" src="images/<?php echo $post_image;?>" width="500" height="300" alt=""></a>
	<hr>
	<p><?php echo $post_content;?></p>
	<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
	<hr>
	<?php }?>
	<ul class="pager">
		<?php
			for($i=1;$i<=$count;$i++){
				if($i == $page){
					echo "<li><span style='color:#ffd600'>{$i}</span></li>";
				}else{
					echo "<li><a href='?author={$post_author}&page={$i}'>{$i}</a></li>";
				}
			}
		?>
	</ul>
</div>
<?php include "includes/sidebar.php";?>	
<?php include "includes/footer.php";?>