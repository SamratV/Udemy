<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">
	<!-- Blog Search Well -->
	<div class="well">
		<h4>Blog Search</h4>
		<form action="search.php" method="post">
			<div class="input-group">
				<input name="search" type="text" class="form-control" required="required">
				<span class="input-group-btn">
					<button name="submit" class="btn btn-default" value=1 type="submit">
						<i class="fas fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<!-- /.input-group -->
	</div>
	<div class="well">
		<?php
			if(!isset($_SESSION['userid'])){
		?>
		<form action="includes/auth.php" method="post">
		  <?php
				if(isset($_GET['auth_error'])){
					$error_msg = "";
					switch($_GET['auth_error']){
						case 'l1': $error_msg = "Invalid email address.";
							break;
						case 'l2': $error_msg = "Wrong password.";
							break;
						case 's1a': $error_msg = "An existing account has the entered email address.";
							break;
						case 's1b': $error_msg = "An existing account has the entered username.";
							break;
						case 's2': $error_msg = "Invalid username.";
							break;
						case 's3': $error_msg = "Invalid firstname.";
							break;
						case 's4': $error_msg = "Invalid lastname.";
							break;
						case 's5': $error_msg = "Too short username(Min 6 characters).";
							break;
						case 's6': $error_msg = "Too short password(Min 6 characters).";
							break;
					}
					echo "<div class='alert alert-danger text-center' id='on_login_error' role='alert'>{$error_msg}</div>";
				}
		  ?>
		  <div class="form-group">
			<input type="text" class="form-control hidden input_s" id="username" name="username" placeholder="Enter username">
		  </div>
		  <div class="form-group">
			<input type="text" class="form-control hidden input_s" id="firstname" name="firstname" placeholder="Enter firstname">
		  </div>
		  <div class="form-group">
			<input type="text" class="form-control hidden input_s" id="lastname" name="lastname" placeholder="Enter lastname">
		  </div>
		  <div class="form-group">
			<input type="email" class="form-control input_s" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required="required">
		  </div>
		  <div class="input-group">
			<input type="password" class="form-control input_s" id="password" name="password" placeholder="Password" required="required">
			<span class="input-group-btn">
				<button type="submit" name="loginSignup" id="loginSignup" class="btn btn-primary">Login</button>
			</span>
		  </div>
		  <div id="check" class="form-check">
			<input type="checkbox" name="stay-logged-in" class="form-check-input" id="stay-logged-in">
			<label class="form-check-label text-muted" for="stay-logged-in"><small>Stay logged in</small></label>
		  </div>
		  <input type="hidden" id="status" name="status" value="0">
		  <div class="text-center">
		  	<a style="text-decoration: none;" href="forgot.php?forgot=<?php echo uniqid(true);?>">Forgot password?</a>
		  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span id="toggleLogin">Sign up</span>
		  </div>
		</form>
		<?php
			}else{
				if(isset($_GET['auth_success']))
					echo "<div class='alert alert-success text-center' id='on_login' role='alert'>Login successful.</div>";
				echo "<div style='width: 180px; margin:0 auto;' class='text-center panel panel-inverse panel-body'>
						<h2>
							<i class='fa fa-user'></i>
						</h2>
						<h3 class='text-muted'>
							{$_SESSION['username']}
						</h3>
					  </div><br>";
				echo "<a href='includes/logout.php'>
						<button class='btn btn-success' type='button'>
							<i class='fas fa-sign-out-alt'></i> Logout
						</button>
					  </a>";
			}
		?>
	</div>
	<!-- Blog Categories Well -->
	<div class="well">
		<h4>Blog Categories</h4>
		<div class="row">
			<div class="col-lg-12">
				<ul class="list-unstyled">
					<?php
						$query = "SELECT * FROM categories ORDER BY cat_title ASC LIMIT 10";
						$result = mysqli_query($link,$query);
						while($row = mysqli_fetch_assoc($result)){
							echo "<li><a class='nav_links' val={$row['cat_id']}>{$row['cat_title']}</a></li>";
						}
					?>
				</ul>
			</div>
		</div>
	</div>
	<?php include "widget.php";?>
</div>