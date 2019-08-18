<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php
	$page_name = basename($_SERVER['PHP_SELF']);
?>
<div class="collapse navbar-collapse navbar-ex1-collapse">
	<ul class="nav navbar-nav side-nav">
		<li <?php if($page_name == "index.php") echo "class=active";?>>
			<a href="index.php"><i class="fa fa-bar-chart"></i> Dashboard</a>
		</li>
		<li <?php if($page_name == "posts.php") echo "class=active";?>>
			<a href="javascript:;" data-toggle="collapse" data-target="#one"><i class="fa fa-envelope"></i> Posts<i class="fa fa-fw fa-caret-down"></i></a>
			<ul id="one" class="collapse">
				<li>
					<a href="./posts.php">View all posts</a>
				</li>
				<li>
					<a href="./posts.php?source=add_post">Add post</a>
				</li>
			</ul>
		</li>
		<li <?php if($page_name == "categories.php") echo "class=active";?>>
			<a href="./categories.php"><i class="fa fa-list"></i> Categories</a>
		</li>
		<li <?php if($page_name == "comments.php") echo "class=active";?>>
			<a href="./comments.php"><i class="fa fa-comments"></i> Comments</a>
		</li>
		<li <?php if($page_name == "users.php") echo "class=active";?>>
			<a href="javascript:;" data-toggle="collapse" data-target="#two"><i class="fa fa-users"></i> Users<i class="fa fa-fw fa-caret-down"></i></a>
			<ul id="two" class="collapse">
				<li>
					<a href="./users.php">View all users</a>
				</li>
				<li>
					<a href="./users.php?source=add_user">Add a user</a>
				</li>
			</ul>
		</li>
		<li <?php if($page_name == "profile.php") echo "class=active";?>>
			<a href="./profile.php"><i class="fa fa-user"></i> Your profile</a>
		</li>
	</ul>
</div>
<!-- /.navbar-collapse -->
</nav>