<div class="container mainContainer">

	<div class="row">
		<div class="col-md-7">
			
			<?php if(array_key_exists('userid',$_GET) AND $_GET['userid']){ ?>
				<?php displayPosts($_GET['userid']); ?>
			<?php }else{ ?>
				<h2>Active users</h2>
				<?php displayUsers(); ?>
			<?php } ?>
		</div>
		<div class="col-md-5">
			<?php displaySearch(); ?>
			<hr>
			<?php displayPostBox(); ?>
		</div>
	</div>

</div>