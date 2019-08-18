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
					Categories
					<small>
						<?php
							verifyAdmin();
						?>
					</small>
				</h1>
			</div>
		</div>
		<div class="col-xs-4">
			<form action="" method="post">
				<div class="form-group">
					<label for="cat_title">Add a new category</label>
					<input type="text" class="form-control" name="cat_title" required="required">
				</div>
				<div class="form-group text-center">
					<input type="submit" class="btn btn-primary" name="submit" value="Add">
				</div>
			</form>
			<?php if(isset($_GET['edit'])){?>
			<form action="" method="post">
				<div class="form-group">
					<label for="update_cat_title">Update category</label>
					<input type="text" class="form-control" name="update_cat_title" value="<?php echo $_GET['value'];?>" required="required">
					<input type="hidden" name="update_cat_id" value="<?php echo $_GET['edit'];?>">
				</div>
				<div class="form-group text-center">
					<input type="submit" class="btn btn-primary" name="submit" value="Update">
				</div>
			</form>
			<?php }?>
		</div>
		<div class="col-xs-8">
			<table class="table table-bordered table-hover text-center">
				<thead>
					<tr>
						<th class="col-xs-1 text-center"><i class="fa fa-list"></i></th>
						<th class="col-xs-5 text-center">Category title</th>
						<th class="col-xs-1 text-center">Edit</th>
						<th class="col-xs-1 text-center">Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
						listAllCategories();
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
	include "includes/admin_footer.php";
?>