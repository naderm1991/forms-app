<?php
session_start();
if (isset($_SESSION['user']['id'])) {
    header('location:index.php');
}
include 'db_connection.php';
include 'error_handler.php';
ini_set('display_errors', 0);
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $valid= true;
    if (in_array('', $_POST)!==false){
        echo '<li>Please enter a value into at least one of the fields regarding the request you are searching for.</li>';
        $valid = false;
    }

    if ($valid) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = sha1($_POST['password']);
        try
        {
            $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES". "('$name', '$email','$password')";
            /** @var TYPE_NAME $conn */
            $get_stmt = $conn->prepare($sql);
            $get_stmt->execute();
            echo "<script type='text/javascript'>alert('User added successfully .')</script>";
        }
        catch (Exception $exception) {echo $exception;die;}
    }
}
?>
<html>
    <body>
    <!DOCTYPE html>
        <head>
            <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="styles/signup.css">
            <meta charset="UTF-8">
            <title>Register</title>
        </head>
        <div>
        <div class="register"></div>
            <div class="Registration-block">
                <form id='Registration' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' accept-charset='UTF-8'>
                    <h1>Register</h1>
                    <input type="text" value="" name='name' placeholder="Name" id="name" />
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" value="" name='email' placeholder="Email" id="email" />
                        </div>
                        <div class="col-md-6">
                            <input type="password" value="" name='password' placeholder="Password" id="password" />
                        </div>
                        <div class="col-md-6">
                            <input type="password" value="" name='password_retype' placeholder="Retype The Password " id="password_retype" />
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-6">
                            <button class="register btn btn-primary">Submit</button>
                        </div>
                        <div class="col-md-6">
                            <button class="register btn btn-secondary" type="button" onclick="window.history.back()" >Back</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<br>
<script type="text/javascript"></script>
