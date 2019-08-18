<form action="" method="post">
  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname" placeholder="Firstname" required="required">
  </div>
  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" placeholder="Lastname" required="required">
  </div>
  <div class="form-group">
    <label for="user_role">Role</label>
	<div>
		<select id="user_role" name="user_role" class="form-control" required="required">
			<option selected disabled hidden>Select a role</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username" required="required">
  </div>
  <div class="form-group">
    <label for="user_email">Email address</label>
    <input type="email" class="form-control" name="user_email" placeholder="Email address" required="required">
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password" placeholder="Password" required="required">
  </div>
  <div class="form-group">
	<button type="submit" name="create_user" class="btn btn-primary">Add user</button>
  </div>
</form>
<?php
	addUser();
?>