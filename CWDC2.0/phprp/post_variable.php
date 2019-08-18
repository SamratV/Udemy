<?php
	if($_POST)
	{
		$n = $_POST['name'];
		$c = 0;
		$array = array("Vaibhaw Samrat","SamratV");
		foreach($array as $value)
		{
			if($n == $value)
			{
				$c++;
				break;
			}
		}
		if($c != 0)
			echo "You are in!<br>";
		else
			echo "I don't know you.<br>";
	}
?>
<p>Enter your name.</p>
<form method="post">
	<input type="text" name="name">
	<input type="submit" value="Go!">
</form>