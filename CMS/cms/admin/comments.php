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
					Comments
					<small>
						<?php
							verifyAdmin();
						?>
					</small>
				</h1>
			</div>
		</div>
		<?php
			$source = '';
			if(isset($_GET['source']))
				$source = $_GET['source'];
			switch($source){
				case 'comment_approve': commentApprove($_GET['approve']);
					break;
				case 'comment_unapprove': commentUnapprove($_GET['unapprove']);
					break;
				case 'comment_delete': commentDelete($_GET['delete']);
					break;
				default: include "includes/view_all_comments.php";
					break;
			}
		?>
	</div>
</div>
<?php
	include "includes/admin_footer.php";
?>