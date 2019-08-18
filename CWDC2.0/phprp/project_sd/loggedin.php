<?php
	session_start();
	if(array_key_exists('id',$_COOKIE))
		$_SESSION['id'] = $_COOKIE['id'];
	if(array_key_exists('id',$_SESSION))
	{
		include("connection.php");
		$query = "SELECT secret_diary FROM users WHERE id = ".mysqli_real_escape_string($link,$_SESSION['id'])." LIMIT 1";
		$row = mysqli_fetch_assoc(mysqli_query($link,$query));
	}
	else
		header("Location: index.php");
	include("header.php");
?>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Secret Diary</a>
  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <a class="form-inline" href="index.php?logout=1">
      <button class="btn btn-outline-success" type="submit">Logout</button>
    </a>
  </div>
</nav>
<div class="container" id="loggedinPageContainer">
	<textarea id="diary" class="form-control"><?php echo $row['secret_diary']; ?></textarea>
</div>
<?php include("footer.php"); ?>