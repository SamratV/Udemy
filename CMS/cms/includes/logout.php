<?php
	session_start();
	session_destroy();
	setcookie("userid","",time() - (86400 * 30), "/");
	header("Location: ../index.php");
?>