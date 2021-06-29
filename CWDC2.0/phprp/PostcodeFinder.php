<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <title>Postcode Finder</title>
	<style type="text/css">
		body{
			text-align: center;
		}
	</style>
  </head>
  <body>
  
	<div class="container">
		<h1>Postcode Finder</h1>
		<form>
		  <div class="form-group">
			<label for="address">Enter a partial address.</label>
			<input type="text" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Enter address">
		  </div>
		  <button class="btn btn-primary" id="find-postcode">Submit</button>
		</form>
	<div>
	<br>
	<div id="message"></div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$("#find-postcode").click(function(e){
			e.preventDefault();
			$.ajax({
				url: "https://maps.googleapis.com/maps/api/geocode/json?address="+encodeURIComponent($("#address").val())+"&key=API_KEY",
				type: "GET",
				success: function(data){
					console.log(data);
					if(data["status"] != "OK" || data["results"][0]["address_components"].length < 7){
						$("#message").html('<div class="alert alert-warning" role="alert"><strong>Postcode not found!</strong></div>');
					}
					else{
						$.each(data["results"][0]["address_components"],function(key,value){
							if(value["types"][0] == "postal_code"){
								$("#message").html('<div class="alert alert-success" role="alert"><strong>Postcode found!</strong> The postcode is '+value['long_name']+'.</div>');
							}
						});
					}
				}
			});
		});
	</script>
  </body>
</html>
