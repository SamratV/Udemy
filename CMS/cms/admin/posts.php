<?php
	include "includes/admin_header.php";
	include "includes/admin_navigation.php";
	include "includes/admin_sidebar.php";
	include "includes/functions.php";
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					Post section
					<small>
						<?php
							verifyAdmin();
						?>
					</small>
				</h1>
				<?php
					if(isset($_GET['et']))
						echo "<div class='col-xs-2 alert alert-danger text-center' id='on_post' role='alert'>There is no post content.</div>";
					else if(isset($_GET['success']))
						echo "<div class='col-xs-3 alert alert-success text-center' role='alert'>Post updated. <a href='../post.php?p_id={$_GET['p_id']}'>View post</a> or <a href='posts.php'>Edit posts</a></div>";
					else if(isset($_GET['add_success']))
						echo "<div class='col-xs-3 alert alert-success text-center' role='alert'>Post added. <a href='../post.php?p_id={$_GET['p_id']}'>View post</a> or <a href='posts.php'>Edit posts</a></div>";
				?>
			</div>
		</div>
		<?php
			$source = '';
			if(isset($_GET['source']))
				$source = $_GET['source'];
			switch($source){
				case 'add_post': include "includes/add_post.php";
					break;
				case 'edit_post': include "includes/edit_post.php";
					break;
				default: include "includes/view_all_posts.php";
					break;
			}
		?>
	</div>
</div>
<?php
	include "includes/admin_footer.php";
?>