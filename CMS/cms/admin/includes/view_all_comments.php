<div>
	<table class="table table-bordered table-hover text-center">
		<thead>
			<tr>
				<th class="text-center"><i class="fa fa-comments"></i></th>
				<th class="text-center">Author</th>
				<th class="text-center">Comment</th>
				<th class="text-center">Email</th>
				<th class="text-center">Status</th>
				<th class="col-xs-2 text-center">In respose to</th>
				<th class="text-center">Date</th>
				<th class="text-center">Approve</th>
				<th class="text-center">Unapprove</th>
				<th class="text-center">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
				listAllComments();
			?>
		</tbody>
	</table>
</div>