			</div>
			<hr>
			<!-- Footer -->
			<footer>
				<div class="row">
					<div class="col-lg-12">
						<p>Copyright &copy; Blog 2018</p>
					</div>
				</div>
			</footer>
		</div>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/editor.js"></script>
		<script type="text/javascript">
			function online(){
				var user = "<?php
								if(isset($_SESSION['username']))
									echo $_SESSION['username'];
								else
									echo "NULL";
							?>";
				if(user !== "NULL"){
					$.get("includes/users_online.php?presence=1",function(data){});
				}
			}

			setInterval(function(){
				online();
			},1000);

			$("#on_login").delay(3000).fadeOut('slow');
			$("#on_login_error").delay(5000).fadeOut('slow');
			$("#toggleLogin").click(function(){
				if($("#status").val() == "0"){
					$(this).html("Login");
					$("#loginSignup").html("Sign up");
					$("#status").val("1");
				}else{
					$(this).html("Sign up");
					$("#loginSignup").html("Login");
					$("#status").val("0");
				}
				$("#username").toggleClass("hidden");
				$("#firstname").toggleClass("hidden");
				$("#lastname").toggleClass("hidden");
				$("#auth_alert").addClass("hidden");
				$(".input_s").val("");
			});
			$(".nav_links").click(function(){
				var id = $(this).attr("val");
				$("#cat").val(id);
				$("#link_form").submit();
			});
		</script>
	</body>
</html>