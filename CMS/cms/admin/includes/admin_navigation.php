<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="index.php">CMS admin</a>
</div>
<!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">
	<li><a>Users online: <span id="users_online"></span></a></li>
	<li><a href="../index.php">Blog Home</a></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
			<?php
				if(isset($_SESSION['userid'])){
					echo " ".$_SESSION['firstname']." ".$_SESSION['lastname'];
				}
			?>
		<b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li>
				<a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href='../includes/logout.php'><i class="fa fa-fw fa-power-off"></i> Logout</a>
			</li>
		</ul>
	</li>
</ul>