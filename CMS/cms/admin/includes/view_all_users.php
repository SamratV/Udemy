<div>
	<table class="table table-bordered table-hover text-center">
		<thead>
			<tr>
				<th class="text-center"><i class="fa fa-users"></i></th>
				<th class="text-center">Username</th>
				<th class="text-center">Firstname</th>
				<th class="text-center">Lastname</th>
				<th class="text-center">Email</th>
				<th class="text-center">Role</th>
				<th class="text-center">Account created</th>
				<th class="text-center">Make admin</th>
				<th class="text-center">Make subscriber</th>
				<th class="text-center">Edit user</th>
				<th class="text-center">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
				listAllUsers();
			?>
		</tbody>
	</table>
</div>