<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
require 'db_connection.php';
require 'src/functions.php';

if(isset($_POST['submit_email']) && $_POST['email'])
{
    $email = $_POST['email'];
    /** @var TYPE_NAME $conn */
    $stmt = select_query($conn,$_POST,'users');
    if($stmt->rowCount()==1)
    {
        $row = $stmt->fetch();
        $email=md5($row['email']);
        $pass=md5($row['password']);
        $url = BASE_URL;
        $link="<a href='$url/reset_password.php?key=".$email."&reset=".$pass.">Click To Reset password</a>";
        $to=$row['email'];
        $subject  = 'Reset Password';
        $from = EMAIL;
        $header = "From:" . $from;
        $message = 'Click On This Link to Reset Password'.$link;
        $time = time();
        if(mail($to,$subject,$message,$header))
        {
            $array['password'] = $pass;
            $array['email'] = $row['email'];
            insert_query($conn,$array);
            echo "Check Your Email and Click on the link sent to your email";
        }
        else
        {
            echo "Mail Error";
        }
        header("refresh:1;url=login.php");
    }
}
