		</div>
		
		<div id="the_modal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-md">
		    <div id="modal_style" class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="text-center"><span id="modal_header">Confirm action</span></h4>
		      </div>
		      <div class="modal-body">
		        <p id="modal_content"></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" url="" id="confirm_button" class="btn btn-danger">Confirm</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		      </div>
		    </div>
		  </div>
		</div>

		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
		<script src="../js/editor.js"></script>
		<script type="text/javascript">
			$("#on_post").delay(3000).fadeOut('slow');
			//Loader...
			var div_box = "<div id='load-screen'><div id='loading'></div></div>";
			$("body").prepend(div_box);
			$("#load-screen").delay(100).fadeOut(100,function(){
				$(this).remove();
			});
			//Online activity...
			function online(){
				var user = "<?php
								if(isset($_SESSION['username']))
									echo $_SESSION['username'];
								else
									echo "NULL";
							?>";
				if(user !== "NULL"){
					$.get("../includes/users_online.php?presence=1",function(data){});
				}
			}

			setInterval(function(){
				online();
			},1000);

			setInterval(function(){
				$.get("../includes/users_online.php?count_presence=1",function(data){
					$("#users_online").html(data);
				});
			},500);
			//Modal...
			$('.the_link').click(function(){
				var title = $(this).attr("msg_title");
				var message = $(this).attr("msg");
				var url = $(this).attr("url");
				$("#modal_header").html(title);
				$("#modal_content").html(message);
				$("#confirm_button").attr("url",url);
			});
			$("#confirm_button").click(function(){
				var url = $(this).attr("url");
				window.location.replace(url);
			});
		</script>
	</body>
</html>