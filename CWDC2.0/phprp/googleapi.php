<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
	  var map;
	  function initMap() {
		var chicago = {lat: 41.85, lng: -87.65};
		var indianapolis = {lat: 39.79, lng: -86.14};

		var map = new google.maps.Map(document.getElementById('map'), {
		  center: chicago,
		  zoom: 7
		});

		var directionsDisplay = new google.maps.DirectionsRenderer({
		  map: map
		});

		// Set destination, origin and travel mode.
		var request = {
		  destination: indianapolis,
		  origin: chicago,
		  travelMode: 'DRIVING'
		};

		// Pass the directions request to the directions service.
		var directionsService = new google.maps.DirectionsService();
		directionsService.route(request, function(response, status) {
		  if (status == 'OK') {
			// Display the route on the map.
			directionsDisplay.setDirections(response);
		  }
		});
	  }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=API_KEY"
    async defer></script>
  </body>
</html>
