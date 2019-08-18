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
					Post specific comments
					<small>
						<?php
							verifyAdmin();
							if(!isset($_GET['p_id']))
								relocate("index.php");
						?>
					</small>
				</h1>
			</div>
		</div>
			<div>
		<form action="" method="post">
			<div id="bulkOptionsContainer" class="col-xs-4">
				<select name="bulk_options" id="" class="form-control" required="required">
					<option selected disabled hidden>Select an option</option>
					<option value="approved">Approve</option>
					<option value="unapproved">Unapprove</option>
					<option value="delete">Delete</option>
				</select>
			</div>
			<div class="col-xs-4">
				 <input type="submit" name="submit" class="btn btn-success" value="Apply">
			</div>
			<br><br><br>
			<table class="table table-bordered table-hover text-center">
				<thead>
					<tr>
						<th class="text-center"><input type="checkbox" id="selectAllBoxes"></th>
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
						$source = '';
						if(isset($_GET['source']))
							$source = $_GET['source'];
						switch($source){
							case 'comment_approve': commentApproveSpecific($_GET['approve'],$_GET['p_id']);
								break;
							case 'comment_unapprove': commentUnapproveSpecific($_GET['unapprove'],$_GET['p_id']);
								break;
							case 'comment_delete': commentDeleteSpecific($_GET['delete'],$_GET['p_id']);
								break;
							default: listAllPostSpecificComments($_GET['p_id']);
								if(isset($_POST['checkBoxArray'])){
									foreach ($_POST['checkBoxArray'] as $key => $value) {
										$bulk_options = $_POST['bulk_options'];
										bulkCommentUpdate($bulk_options,$value);
									}
									relocate("Location: comment.php?p_id={$_GET['p_id']}");
								}
								break;
						}
					?>
				</tbody>
			</table>
		</form>
	</div>
	</div>
</div>
<?php
	include "includes/admin_footer.php";
?>