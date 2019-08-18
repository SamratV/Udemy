    <footer class="footer">
		<div class="container">
			<span class="text-muted">&copy; Socio.Inc 2018. <small>Created by Vaibhaw Samrat</small></span>
		</div>
	</footer>
	
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<!-- Modal -->
	<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="loginModalTitle">Login</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="alert alert-danger" id="loginAlert"></div>
			<form method="post" form="loginSignupForm">
			  <input type="hidden" name="loginActive" id="loginActive" value="1">
			  <div class="form-group" id="username-div">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
			  </div>
			  <div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required="required">
			  </div>
			  <div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
			  </div>
			  <div class="form-check">
				<input type="checkbox" class="form-check-input" id="stay-logged-in" name="stay-logged-in" value=1>
				<label class="form-check-label" for="stay-logged-in">Stay logged in.</label>
			  </div>
			  <div class="modal-footer">
				<p id="toggleLogin">Sign up</p>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-button">Close</button>
				<button type="button" class="btn btn-primary" id="loginSignupButton">Login</button>
			  </div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="modal" tabindex="-1" id="onPost" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="onPostModalTitle"></h5>
			<button type="button" class="close" data-dismiss="modal" id="onPostCloseButton" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p id="onPostMessage"></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" id="okayButton" data-dismiss="modal">Okay</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<script type="text/javascript">
		
		$("#toggleLogin").click(function(){
			if($("#loginActive").val() == "1"){
				$("#loginActive").val("0");
				$("#loginModalTitle").html("Sign Up");
				$("#loginSignupButton").html("Sign up");				
				$("#toggleLogin").html("Login");
				$("#username-div").show();
			}else{
				$("#loginActive").val("1");
				$("#loginModalTitle").html("Login");
				$("#loginSignupButton").html("Login");				
				$("#toggleLogin").html("Sign up");
				$("#username-div").hide();
			}
		});
		
		$("#loginSignupButton").click(function(){
			$.ajax({
				type: "POST",
				url: "actions.php?action=loginSignup",
				data: "email="+$("#email").val()+"&stay-logged-in="+$("#stay-logged-in").val()+"&username="+$("#username").val()+"&password="+$("#password").val()+"&loginActive="+$("#loginActive").val(),
				success: function(result){
					if(result == "1"){
						$("#loginAlert").toggleClass("alert-danger");
						$("#loginAlert").toggleClass("alert-success");
						$("#loginAlert").html("Logging you in...").show().delay(3000);
						window.location.assign("http://localhost/phprp/socio/");
					}else{
						$("#loginAlert").html(result).show();
					}
				}
			});
		});
		
		$(".toggleFollow").click(function(){
			var id = $(this).attr('data-userId');
			if(id != ""){
				$.ajax({
					type: "POST",
					url: "actions.php?action=toggleFollow",
					data: "userId="+id,
					success: function(result){
						
						if(result == "1"){
							$("span[data-userId='"+id+"']").html('<i class="fa fa-user" aria-hidden="true"></i> Follow');
						}else{
							$("span[data-userId='"+id+"']").html('<i class="fa fa-user-o" aria-hidden="true"></i> Unfollow');
						}
						
					}
				});
			}else{
				$("span[data-userId='"+id+"']").attr('data-toggle', 'modal');
				$("span[data-userId='"+id+"']").attr('data-target', '#exampleModalLong');
			}
		});
		
		$("#postButton").click(function(){
			$.ajax({
				type: "POST",
				url: "actions.php?action=post",
				data: "postContent="+$("#postContent").val(),
				success: function(result){
					$("#onPostMessage").html((result == "") ? "Post failed." : ((result == "1") ? "Your post was successful." : result));
					$("#onPostModalTitle").html((result == "" || result == "Your post is empty." || result == "Your post is too long.") ? "Oops..." : "Success");
				},
				error: function(xhr, error){
					console.debug(xhr); console.debug(error);
					$("#onPostMessage").html("A problem occurred while processing your post. Please try again later.");
					$("#onPostModalTitle").html("Oops...");
				}
			});
		});
		
		$("#okayButton").click(function(){
			window.location.assign(window.location.href);
		});
		
		$("#onPostCloseButton").click(function(){
			window.location.assign(window.location.href);
		});
		
		$("#searchButton").click(function(){
			if($("#search").val() == ""){
				$('#searchButton').attr('data-toggle', 'modal');
				$('#searchButton').attr('data-target', '#onPost');
				$("#onPostMessage").html("Search box is empty.");
				$("#onPostModalTitle").html("Looks like...");
			}else
				window.location.assign("http://localhost/phprp/socio/?page=search&q="+$("#search").val());
		});

	</script>
	
  </body>
</html>