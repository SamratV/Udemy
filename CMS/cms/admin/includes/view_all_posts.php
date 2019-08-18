<div>
	<form action="" method="post">
		<div id="bulkOptionsContainer" class="col-xs-4">
			<select name="bulk_options" id="" class="form-control" required="required">
				<option selected disabled hidden>Select an option</option>
				<option value="published">Publish</option>
				<option value="draft">Draft</option>
				<option value="clone">Clone</option>
				<option value="delete">Delete</option>
			</select>
		</div>
		<div class="col-xs-4">
			<input type="submit" name="submit" class="btn btn-success" value="Apply">&nbsp;&nbsp;
			<a href="posts.php?source=add_post" class="btn btn-primary">Add new</a>
		</div>
		<br><br><br>
		<table class="table table-bordered table-hover text-center">
			<thead>
				<tr>
					<th class="text-center"><input type="checkbox" id="selectAllBoxes"></th>
					<th class="text-center"><i class="fa fa-envelope"></i></th>
					<th class="text-center">Author</th>
					<th class="text-center">Title</th>
					<th class="text-center">Category</th>
					<th class="text-center">Status</th>
					<th class="text-center">Image</th>
					<th class="text-center">Tags</th>
					<th class="text-center">Comments</th>
					<th class="text-center">Date</th>
					<th class="text-center">Views</th>
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					listAllPosts();
					if(isset($_POST['checkBoxArray'])){
						foreach ($_POST['checkBoxArray'] as $key => $value) {
							$bulk_options = $_POST['bulk_options'];
							bulkUpdate($bulk_options,$value);
						}
						relocate("./posts.php");
					}
				?>
			</tbody>
		</table>
	</form>
</div>