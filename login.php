<?php
include 'db_connection.php';
session_start();

if (isset($_SESSION['user']['id'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <title>Forms</title>
        <link rel="stylesheet" href="styles/login.css">
    </head>
    <body >
        <div class="logo"></div>
        <div class="login-block">
            <form id='Login' action="login_post.php" method='post'
                  accept-charset='UTF-8'>
                <h1>Login</h1>
                <input type="text" value="" name='email' placeholder="Email" id="email" required="required"/>
                <input type="password" value=""  name='password' placeholder="Password" id="password" required="required" />
                <button>Login</button>
                <hr>
                <a href="signup.php">Sign Up</a>
                <br><br>
                <a href="forget_password.php">Reset Password</a>
            </form>
        </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    // this is the id of the form
    $("#Login").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        let form = $(this);
        let actionUrl = form.attr('action');
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if (data=="1"){
                    window.location="index.php";
                }else {
                    alert(data); // show response from the php script.
                }

            }
        });
    });
</script>