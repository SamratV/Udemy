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
					Welcome to admin panel
					<small>
						<?php
							verifyAdmin();
						?>
					</small>
				</h1>
			</div>
			<?php
				$q = "SELECT 1 FROM users";
				$res = mysqli_query($link,$q);
				$no_of_users = mysqli_num_rows($res);
				$q = "SELECT 1 FROM posts";
				$res = mysqli_query($link,$q);
				$no_of_posts = mysqli_num_rows($res);
				$q = "SELECT 1 FROM comments";
				$res = mysqli_query($link,$q);
				$no_of_comments = mysqli_num_rows($res);
				$q = "SELECT 1 FROM categories";
				$res = mysqli_query($link,$q);
				$no_of_categories = mysqli_num_rows($res);
			?>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-envelope fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
						  <div class='huge'><?php echo $no_of_posts;?></div>
								<div>Posts</div>
							</div>
						</div>
					</div>
					<a href="posts.php">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-comments fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
							 <div class='huge'><?php echo $no_of_comments;?></div>
							  <div>Comments</div>
							</div>
						</div>
					</div>
					<a href="comments.php">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-user fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
							<div class='huge'><?php echo $no_of_users;?></div>
								<div> Users</div>
							</div>
						</div>
					</div>
					<a href="users.php">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-list fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class='huge'><?php echo $no_of_categories;?></div>
								 <div>Categories</div>
							</div>
						</div>
					</div>
					<a href="categories.php">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<?php
			$q = "SELECT 1 FROM posts WHERE post_status='draft'";
			$res = mysqli_query($link,$q);
			$no_of_draft_posts = mysqli_num_rows($res);
			$q = "SELECT 1 FROM comments WHERE comment_status='unapproved'";
			$res = mysqli_query($link,$q);
			$no_of_unapproved_comments = mysqli_num_rows($res);
			$q = "SELECT 1 FROM users WHERE user_role='subscriber'";
			$res = mysqli_query($link,$q);
			$no_of_subscribers = mysqli_num_rows($res);
		?>
		<div class="row">
			<script type="text/javascript">
			  google.charts.load('current', {'packages':['bar']});
			  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				var data = google.visualization.arrayToDataTable([
				  ['Data', 'Count'],
				  <?php
					$text = ['Total posts','Published posts','Draft posts','Total comments','Approved comments','Unapproved comments','Users','Subscribers'];
					$value = [$no_of_posts,$no_of_posts-$no_of_draft_posts,$no_of_draft_posts,$no_of_comments,$no_of_comments-$no_of_unapproved_comments,$no_of_unapproved_comments,$no_of_users,$no_of_subscribers];
					for($i = 0;$i<8;$i++){
						echo "['{$text[$i]}',{$value[$i]}],";
					}
				  ?>
				]);

				var options = {
				  chart: {
					title: '',
					subtitle: '',
				  }
				};

				var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

				chart.draw(data, google.charts.Bar.convertOptions(options));
			  }
			</script>
			<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
		</div>
	</div>
</div>
<?php
	include "includes/admin_footer.php";
?>