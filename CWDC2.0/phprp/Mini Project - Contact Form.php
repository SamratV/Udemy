<?php
	$error = '';
	$successMessage = '';
	if($_POST)
	{
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$content = $_POST['content'];
		
		if(!$email)
			$error .= 'Email field missing.<br>';
		if(!$subject)
			$error .= 'Subject field missing.<br>';
		if(!$content)
			$error .= 'Content field missing.<br>';
		if ($email && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
			$error .= 'Invalid email address.<br>';
		
		if($error != '')
			$error = '<div class="alert alert-danger" role="alert"><strong>There were error(s) while submitting:</strong><br>'.$error.'</div>';
		else
		{
			$emailTo = 'vaibhawsky@gmail.com';
			$header = 'From: '.$email;
			if(mail($emailTo,$subject,$content,$header))
				$successMessage = '<div class="alert alert-success" role="alert">Your message was sent successfully!</div>';
			else
				$error = '<div class="alert alert-danger" role="alert">Your email couldn\'t sent. Please try again later.</div>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Contact Form</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
	<div class="container">
		<h1>Mini Project!</h1>
	
		<div id="error">
			<?php echo $error.$successMessage; ?>
		</div>
		
		<form method="post">
			  <div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your email address.">
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			  </div>
			  <div class="form-group">
				<label for="subject">Subject</label>
				<input type="text" class="form-control" id="subject" name="subject">
			  </div>
			  <div class="form-group">
				<label for="content">What would you like to ask us?</label>
				<textarea class="form-control" id="content" name="content" rows="3"></textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	
	</div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	
	<script type="text/javascript">
		$('form').submit(
			function()
			{
				var error = '';
				if($('#email').val() == '')
					error += 'Email field missing.<br>';
				if($('#subject').val() == '')
					error += 'Subject field missing.<br>';
				if($('#content').val() == '')
					error += 'Content field missing.<br>';
				
				if(error == '')
					return true;
				else
				{
					$('#error').html('<div class="alert alert-danger" role="alert"><strong>There were error(s) while submitting:</strong><br>'+error+'</div>');
					return false;
				}
			}
		);
	</script>
  </body>
</html>