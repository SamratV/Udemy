<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Blog</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<form id='link_form' action="category.php" method="post">
				<input type="hidden" name="category" id="cat" value="">
			</form>
			<ul class="nav navbar-nav">
				<?php
					$query = "SELECT * FROM categories ORDER BY cat_title ASC";
					$result = mysqli_query($link,$query);
					while($row = mysqli_fetch_assoc($result)){
						if(isset($_POST['category']) AND $_POST['category'] == $row['cat_id'])
							echo "<li class='active'><a class='nav_links' val={$row['cat_id']}>{$row['cat_title']}</a></li>";
						else
							echo "<li><a class='nav_links' val={$row['cat_id']}>{$row['cat_title']}</a></li>";
					}
					$page_name = basename($_SERVER['PHP_SELF']);
					if($page_name == "contact.php")
						echo "<li class='active'><a href='contact.php'>Contact us</a></li>";
					else
						echo "<li><a href='contact.php'>Contact us</a></li>";
				
					if(isAdmin()){
						echo "<li><a href='admin'><i class='fas fa-shield-alt'></i> Admin</a></li>";
						if(isset($_GET['p_id']))
							echo "<li><a href='admin/posts.php?source=edit_post&p_id={$_GET['p_id']}'><i class='fa fa-edit'></i> Edit</a></li>";
					}					
				?>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
 </nav>
 <!-- Page Content -->
<div class="container">

	<div class="row">