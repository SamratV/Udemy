<?php
	$weather = '';
	$flag = false;
	$error = "";
	if(array_key_exists('city',$_GET))
	{
		$urlContents = @file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=API_KEY");
		$weatherArray = json_decode($urlContents,true);
		if($weatherArray['cod'] == 200)
		{
			$flag = true;
			$weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";
			$temp = round($weatherArray['main']['temp'] - 273.15);
			$weather .= "The temperature is ".$temp."&deg;C and the wind speed is ".$weatherArray['wind']['speed']." meter/second.";
		}
		else
		{
			$error = "Could not find the city - please try again.";
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
					echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
				else if($error != "")
					echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
			?>
		</div>
	</div>
  </body>
</html>
