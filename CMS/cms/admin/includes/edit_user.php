<?php
	if(!isset($_GET['u_id']))
	   header("Location: users.php");
	$user_id = escape($_GET['u_id']);
	$stmt = mysqli_prepare($link,"SELECT user_firstname,user_lastname,user_role,user_email,username FROM users WHERE user_id=?");
  mysqli_stmt_bind_param($stmt,"i",$user_id);
  mysqli_stmt_execute($stmt);
  confirmQuery($stmt);
  mysqli_stmt_bind_result($stmt,$user_firstname,$user_lastname,$user_role,$user_email,$username);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);
?>
<form action="" method="post">
  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname;?>" placeholder="Firstname" required="required">
  </div>
  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname;?>" placeholder="Lastname" required="required">
  </div>
  <div class="form-group">
    <label for="user_role">Role</label>
	<div>
		<select id="user_role" name="user_role" class="form-control" required="required">
			<?php
				if($user_role == 'admin'){
					echo '<option value="admin" selected="selected">Admin</option>';
					echo '<option value="subscriber">Subscriber</option>';
				}else{
					echo '<option value="admin">Admin</option>';
					echo '<option value="subscriber" selected="selected">Subscriber</option>';
				}
			?>
		</select>
	</div>
  </div>
  <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username;?>" placeholder="Username" required="required">
  </div>
  <div class="form-group">
    <label for="user_email">Email address</label>
    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email;?>" placeholder="Email address" required="required">
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password" placeholder="Password" required="required">
  </div>
  <div class="form-group">
	<button type="submit" name="edit_user" class="btn btn-primary">Edit user</button>
  </div>
</form>