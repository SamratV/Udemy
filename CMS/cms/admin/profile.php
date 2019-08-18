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
					Your Profile
					<small>
						<?php
							verifyAdmin();
						?>
					</small>
				</h1>
				<?php
					if(isset($_GET['update_success']))
						echo "<div class='col-xs-3 alert alert-success text-center' role='alert'>Your account edited. <a href='users.php'>View users</a>?</div>";
					else if(isset($_GET['update_failure'])){
						if($_GET['update_failure'] == 1)
							$invalid = "email address.";
						else
							$invalid = "username.";
						echo "<div class='col-xs-4 alert alert-danger text-center' role='alert'>An existing account already has the entered {$invalid}</div>";
					}
				?>
			</div>
		</div>
		<form action="" method="post">
		  <div class="form-group">
			<label for="user_firstname">Firstname</label>
			<input type="text" class="form-control" name="user_firstname" value="<?php echo $_SESSION['firstname'];?>" placeholder="Firstname" required="required">
		  </div>
		  <div class="form-group">
			<label for="user_lastname">Lastname</label>
			<input type="text" class="form-control" name="user_lastname" value="<?php echo $_SESSION['lastname'];?>" placeholder="Lastname" required="required">
		  </div>
		  <div class="form-group">
			<label for="user_role">Role</label>
			<div>
				<select id="user_role" name="user_role" class="form-control" required="required">
					<?php
						if($_SESSION['role'] == 'admin'){
							echo '<option value="admin" selected="selected">Admin</option>';
							echo '<option disabled>Subscriber</option>';
						}
						$x = escape($_SESSION['userid']);
						$stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE user_email=?");
						mysqli_stmt_bind_param($stmt,"s",$x);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt,$user_id);
						mysqli_stmt_fetch($stmt);
						mysqli_stmt_close($stmt);
					?>
				</select>
			</div>
		  </div>
		  <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
		  <div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'];?>" placeholder="Username" required="required">
		  </div>
		  <div class="form-group">
			<label for="user_email">Email address</label>
			<input type="email" class="form-control" name="user_email" value="<?php echo $_SESSION['userid'];?>" placeholder="Email address" required="required">
		  </div>
		  <div class="form-group">
			<label for="user_password">Password</label>
			<input type="password" class="form-control" name="user_password" placeholder="Password" required="required">
		  </div>
		  <div class="form-group">
			<button type="submit" name="update_profile" class="btn btn-primary">Update profile</button>
		  </div>
		</form>
	</div>
</div>
<?php
	include "includes/admin_footer.php";
?>