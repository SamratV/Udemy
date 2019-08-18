<?php
	include "includes/header.php";
	include "includes/db.php";
	include "includes/navigation.php";
?>

<div class="col-md-8">
	<?php
		if(isset($_POST['email'])){
			$email = $_POST['email'];
			$subject = $_POST['subject'];
			$content = $_POST['content'];
			$to = "blog@support.com";
			$header = 'From: '.$email."\r\n".'Reply-To: '.$email;
			echo $header;
			mail($to, $subject, $content, $header);
		}
	?>
	<h1 class="page-header text-center">
		Contact us
	</h1>
	<form action="contact.php" method="post">
	  <div class="form-group">
	    <label for="email">Email address</label>
	    <input type="email" class="form-control" id="email" name="email" placeholder="Your email address" required="required">
	  </div>
	  <div class="form-group">
	    <label for="subject">Subject</label>
	    <input type="text" class="form-control" id="subject" name="subject" required="required">
	  </div>
	  <div class="form-group">
	    <label for="content">Content</label>
	    <textarea class="form-control" id="content" rows="10" name="content" required="required"></textarea>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

<?php
	include "includes/sidebar.php";	
	include "includes/footer.php";
?>