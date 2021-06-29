<!DOCTYPE html>
<html>
	<head>
		<title>Geocoding an address.</title>
	</head>
	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
			$.ajax({
				url: "https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=API_KEY",
				type: "GET",
				success: function(data){
					$.each(data["results"][0]["address_components"][6],function(key,value){
						alert(value);
					});
				}
			});
		</script>
	</body>
</html>
