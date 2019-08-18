<div class="container mainContainer">

	<div class="row">
		<div class="col-md-7">
			<h2>Posts for you</h2>
			<?php displayPosts('isfollowing'); ?>
		</div>
		<div class="col-md-5">
			<?php displaySearch(); ?>
			<hr>
			<?php displayPostBox(); ?>
		</div>
	</div>

</div>