<?php
    include "includes/db.php";
    include "includes/header.php";
    include "includes/navigation.php";

    if(!isset($_GET['email']) && !isset($_GET['token']))
        relocate('index.php');
    $email = escape($_GET['email']);
    $token = escape($_GET['token']);
    $stmt = mysqli_prepare($link, "SELECT COUNT(user_id) AS counter FROM users WHERE token=? AND user_email=?");
    if($stmt){
        mysqli_stmt_bind_param($stmt, "ss", $token,$email);
        mysqli_stmt_execute($stmt);
        confirmQuery($stmt);
        mysqli_stmt_bind_result($stmt,$count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        if($count >= 1){
            if(isset($_POST['password']) && isset($_POST['confirmPassword'])){
                if($_POST['password'] === $_POST['confirmPassword']){
                    $password = $_POST['password'];
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
                    $token = $token.bin2hex(openssl_random_pseudo_bytes(50)).$token;
                    $stmt = mysqli_prepare($link, "UPDATE users SET token='{$token}', user_password='{$hashedPassword}' WHERE user_email = ?");
                    if($stmt){
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        confirmQuery($stmt);
                        if(mysqli_stmt_affected_rows($stmt) >= 1)
                            relocate('index.php');
                        mysqli_stmt_close($stmt);
                    }
                }else
                    echo "<div style='margin: 0px auto; width: 400px;' class='text-center alert alert-danger' role='alert'>
                            Please confirm password correctly.
                        </div>";
            }
        }else
            relocate('index.php');
    }
?>
<div class="container">
    <br><br><br>
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                    <h2 class="text-center">Reset Password</h2>
                    <p>You can reset your password here.</p>
                    <div class="panel-body">
                        <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                    <input id="password" name="password" placeholder="Enter password" class="form-control"  type="password" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                    <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                            </div>

                            <input type="hidden" class="hide" name="token" id="token" value="">
                        </form>

                    </div><!-- Body-->

                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php";?>