<?php
    include "includes/db.php"; 
    include "includes/header.php"; 
    include "includes/navigation.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "./vendor/autoload.php";

    if(!isset($_GET['forgot']))
        relocate("index.php");
    $emailSent = false;

    function email_exists($email){
        global $link;
        $email = escape($email);
        $stmt = mysqli_prepare($link,"SELECT user_id FROM users WHERE user_email=?");
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        confirmQuery($stmt);
        mysqli_stmt_store_result($stmt);
        return mysqli_stmt_num_rows($stmt) > 0;
    }

    if(isset($_POST['recover-submit'])){
        $email = escape($_POST['email']);
        $token = bin2hex(openssl_random_pseudo_bytes(50));
        if(email_exists($email)){
            if($stmt = mysqli_prepare($link, "UPDATE users SET token='{$token}' WHERE user_email= ?")){
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                confirmQuery($stmt);
                mysqli_stmt_close($stmt);

                try{
                    $mail = new PHPMailer();

                    $mail->isSMTP();
                    $mail->Host = config::SMTP_HOST;
                    $mail->Username = config::SMTP_USER;
                    $mail->Password = config::SMTP_PASSWORD;
                    $mail->Port = config::SMTP_PORT;
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth = true;
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom('blog@cms.com', 'Vaibhaw Samrat');
                    $mail->addAddress($email);
                    $mail->Subject = 'Password reset request.';
                    $mail->Body = '<p>Please click to reset your password
                    <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.' ">http://localhost/cms/reset.php?email='.$email.'&token='.$token.'</a>
                    </p>';
                    if($mail->send())
                        $emailSent = true;
                    else
                        echo "<script>console.log('NOT SENT');</script>";
                    
                }catch(Exception $e){
                    echo "<script>console.log('EXCEPTION');</script>";
                }
            }
        }else
            echo "<div style='margin: 0px auto; width: 400px;' class='text-center alert alert-danger' role='alert'>
                    Invalid email address.
                </div>";
    }
?>

<div class="container">
    <br><br><br><br><br>
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                    <h2 class="text-center">Forgot Password?</h2>
                    <p>You can reset your password here.</p>
                    <div class="panel-body">

                        <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input id="email" name="email" placeholder="Email address" class="form-control"  type="email" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                            </div>
                            <input type="hidden" class="hide" name="token" id="token" value="">
                        </form>
                        <?php
                            if($emailSent)
                                echo "<p>Email sent, check it out!</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <?php include "includes/footer.php";?>