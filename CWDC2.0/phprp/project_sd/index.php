<?php
    session_start();
    $error='';
    if(array_key_exists('logout',$_GET))
    {
        unset($_SESSION['id']);
        setcookie('id','',time()-3600);
    }
    else if((array_key_exists('id',$_SESSION) AND $_SESSION['id']) OR (array_key_exists('id',$_COOKIE) AND $_COOKIE['id']))
    {
        header("Location: loggedin.php");
    }
    if(array_key_exists('submit',$_POST))
    {
        if(!$_POST['email'])
            $error .= 'Email field required.';
        if(!$_POST['password'])
            $error .= ' Password field required.';
        if($error != '')
            $error = '<strong>There were some error(s) while processing the request:</strong><br>'.$error;
        else
        {
            include("connection.php");
            switch($_POST['log'])
            {
                case 0:    $query = 'SELECT `id` FROM `users` WHERE email = "'.mysqli_real_escape_string($link,$_POST['email']).'" LIMIT 1';
                        $result = mysqli_query($link,$query);
                        if( mysqli_num_rows($result) > 0 )
                        {
                            $error = 'This email id is already registered with us.<br>';
                        }
                        else
                        {
                            $query = 'INSERT INTO users (email,password) VALUES("'.mysqli_real_escape_string($link,$_POST['email']).'","'.mysqli_real_escape_string($link,$_POST['password']).'")';
                            if(mysqli_query($link,$query))
                            {
                                $query = 'UPDATE users SET password = "'.md5(md5(mysqli_insert_id($link)).$_POST['password']).'" WHERE id = '.mysqli_insert_id($link).' LIMIT 1';
                                $result = mysqli_query($link,$query);
                                $_SESSION['id'] = mysqli_insert_id($link);
                                if(array_key_exists('stayLoggedIn',$_POST))
                                    setcookie('id',mysqli_insert_id($link),time()+60*60*24*365);
                                header('Location: loggedin.php');
                            }
                            else
                            {
                                $error = 'Unable to process the request at this time. Please try again later.<br>';
                            }
                        }
                        break;
                case 1:    $query = 'SELECT * FROM users WHERE email = "'.mysqli_real_escape_string($link,$_POST['email']).'" LIMIT 1';
                        $result = mysqli_query($link,$query);
                        if( mysqli_num_rows($result) > 0 )
                        {
                            $row = mysqli_fetch_array($result);
                            $hashedPassword = md5(md5($row['id']).$_POST['password']);
                            if($row['password'] == $hashedPassword)
                            {
                                $_SESSION['id'] = $row['id'];
                                if(array_key_exists('stayLoggedIn',$_POST))
                                    setcookie('id',$row['id'],time()+60*60*24*365);
                                header("Location: loggedin.php");
                            }
                            else
                            {
                                $error = 'Incorrect password entered.<br>';
                            }
                        }
                        else
                        {
                            $error = 'Unrecognized email/password combination.<br>';
                        }
                        break;
            }
        }
    }
?>
	<?php include("header.php");?>
	<div class="container" id="homePageContainer">
		<h1>Secret Diary</h1>
		<p><strong>Store your thoughts permanently and securely!</strong></p>
		<div id="error"><?php if($error) echo '<div class="alert alert-danger" role="alert"><span id="close"><i class="fa fa-times" aria-hidden="true"></i></span><br>'.$error.'</div>'; ?></div>
		<div id="signUpForm">
			<p>Interested? Sign up now.</p>
			<form method="post">
				<div class="form-group">
					<input type="email" id="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Your email">
				</div>
				<div class="form-group">
					<input type="password" id="password" class="form-control" name="password" placeholder="Password">
				</div>
				<div class="form-check">
					<input type="checkbox" id="stayLoggedIn" name="stayLoggedIn" value=1>
					Stay logged in
				</div>
				<div class="form-group">
					<input type="hidden" name="log" value=0>
					<input type="submit" id="signUp" class="btn btn-success" name="submit" value="Sign Up">
				</div>
			</form>
			<button class="toggleForm" id="switch">Log In</button>
		</div>
		<div id="logInForm">
			<p>Login using your username and password.</p>
			<form method="post">
				<div class="form-group">
					<input type="email" id="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Your email">
				</div>
				<div class="form-group">
					<input type="password" id="password" class="form-control" name="password" placeholder="Password">
				</div>
				<div class="form-check">
					<input type="checkbox" id="stayLoggedIn" name="stayLoggedIn" value=1>
					Stay logged in
				</div>
				<div class="form-group">
					<input type="hidden" name="log" value=1>
					<input type="submit" id="signUp" class="btn btn-success" name="submit" value="Log In">
				</div>
			</form>
			<button class="toggleForm" id="switch">Sign Up</button>
		</div>
	</div>
    <?php include("footer.php"); ?>