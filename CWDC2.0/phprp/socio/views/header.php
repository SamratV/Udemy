<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/575cf0ac79.js"></script>
	<link rel="stylesheet" href="http://localhost/phprp/socio/styles.css">
	<link href="images/ts_logo.png" rel="icon" type="image/x-icon"/>
    <title>Socio | The social tab</title>
  </head>
  <body>
	  <nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="http://localhost/phprp/socio/">Socio</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item">
			<a class="nav-link" href="?page=timeline">Your Timeline</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="?page=yourposts">Your Posts</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="?page=publicprofiles">Public profiles</a>
		  </li>
		</ul>
		<div class="form-inline my-2 my-lg-0">
			<?php 
				if((array_key_exists('id',$_SESSION) AND $_SESSION['id']) OR (array_key_exists('id',$_COOKIE) AND $_COOKIE['id'])){	
					if(array_key_exists('id',$_COOKIE) AND $_COOKIE['id'] != ''){
						$_SESSION['id'] = $_COOKIE['id'];
					}
			?>
				<a class="btn btn-outline-success my-2 my-sm-0" href="?function=logout">Logout</a>
			<?php }else{ ?>
				<button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#exampleModalLong">Login | Sign up</button>
			<?php } ?>
		</div>
	  </div>
	</nav>