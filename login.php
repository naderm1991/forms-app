<?php
include 'db_connection.php';
session_start();

if (isset($_SESSION['username'])) {
    header('location:Home.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // collect value of input field
    $username = $_POST['email'];
    $password = $_POST['password'];
    $time = date("H:i:s");
    $date = date("Y/m/d");
    $hashed_pass = sha1($password);
    $count=0;
    $row=null;

    if (empty($username) || empty($password)) {
        echo "Failed Login.";
    }
    if (isset($username) && isset($password)) {
        /** @var TYPE_NAME $conn */
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=? AND password =?");
        $stmt->execute(array($username, $hashed_pass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    }

    if ($count > 0)
    {
        $_SESSION['user_id'] = $row['id'];
        header('location:index.php');
    }
    else {
        echo "Login Invalid , Please Login again";
    }
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
            <form id='Login' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'
                  accept-charset='UTF-8'>
                <h1>Login</h1>
                <input type="text" value="" name='email' placeholder="Email" id="email" required="required"/>
                <input type="password" value=""  name='password' placeholder="Password" id="password" required="required" />
                <button name="submit">Login</button>
                <hr>
                <a href="signup.php">Sign Up</a>
            </form>
        </div>
    </body>
</html>