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
					User section
					<small>
						<?php
							verifyAdmin();
						?>
					</small>
				</h1>
				<?php
					if(isset($_GET['edit_success']))
						echo "<div class='col-xs-3 alert alert-success text-center' role='alert'>User account edited. <a href='users.php'>View users</a>?</div>";
					else if(isset($_GET['add_success']))
						echo "<div class='col-xs-3 alert alert-success text-center' role='alert'>User account added. <a href='users.php'>View users</a>?</div>";
					else if(isset($_GET['failure'])){
						if($_GET['failure'] == 1)
							$invalid = "email address.";
						else
							$invalid = "username.";
						echo "<div class='col-xs-4 alert alert-danger text-center' role='alert'>An existing account already has the entered {$invalid}</div>";
					}
				?>
			</div>
		</div>
		<?php
			$source = '';
			if(isset($_GET['source']))
				$source = $_GET['source'];
			switch($source){
				case 'edit_user': include "includes/edit_user.php";
					break;
				case 'make_admin': makeAdmin($_GET['u_id']);
					break;
				case 'make_sub': makeSub($_GET['u_id']);
					break;
				case 'add_user': include "includes/add_user.php";
					break;
				default: include "includes/view_all_users.php";
					break;
			}
		?>
	</div>
</div>
<?php
	include "includes/admin_footer.php";
?>