<?php
	$weather = '';
	$error = '';
	$flag = array_key_exists('city',$_GET);
	if($flag)
	{
		$city = str_replace(' ','',$_GET['city']);
		$url = 'http://www.weather-forecast.com/locations/'.$city.'/forecasts/latest';
		
		$file_headers = @get_headers($url);
		
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found')//If url doesn't exists.
			$error = 'That city couldn\'t be found.';
		else
		{
			$forecast = file_get_contents($url);
			$array1 = explode('1 &ndash; 3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">',$forecast);
			
			if(sizeof($array1) > 1)
			{
				$array2 = explode('<',$array1[1]);
				if(sizeof($array2) > 1)
					$weather = $array2[0];
				else
					$error = 'That city couldn\'t be found.';//If the website is unable to extract the forecast due to change in the html content.
			}
			else
				$error = 'That city couldn\'t be found.';//If the website is unable to extract the forecast due to change in the html content.
			
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Weather Scraper</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<style type="text/css">
		html{
			background: url(background.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		body{
			background: none;
			margin: 0px;
			padding: 0px;
		}
		.container{
			text-align: center;
			width: 400px;
			margin-top: 200px;
		}
		input{
			margin: 20px 0px;
		}
		#weather{
			margin-top: 20px;
		}
	</style>
  </head>
  <body>
	<div class="container">
		<h1>What's the weather?</h1>
		<form>
		  <div class="form-group">
			<label for="city">Enter the name of a city.</label>
			<input type="text" class="form-control" id="city" name="city" aria-describedby="emailHelp" placeholder="Eg. New Delhi, New York" value="<?php if($flag) echo $_GET['city']; ?>">
		  </div>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<div id="weather">
			<?php
				if($flag)
				{
					if($weather)
						echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
					else
						echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
				}
			?>
		</div>
	</div>
  </body>
</html>