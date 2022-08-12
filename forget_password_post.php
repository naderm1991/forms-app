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
        ini_set("MAIL_DRIVER", "smtp");
        ini_set("MAIL_ENCRYPTION", "tls");
        ini_set("MAIL_FROM_ADDRESS", "support@cfaffiliate360.com");
        ini_set("MAIL_HOST", "smtp.mailtrap.io");
        ini_set("MAIL_PASSWORD", "5789374bb1e258");
        ini_set("MAIL_PORT", "2525");
        ini_set("MAIL_USERNAME", "d4aba6e00b3c5b");

        $row = $stmt->fetch();
        $email=md5($row['email']);
        $pass=md5($row['password']);
        $url = BASE_URL;
        $link="<a href='$url/reset_password.php?key=".$email."&reset=".$pass.">Click To Reset password</a>";
        $to=$row['email'];
        $subject  = 'Reset Password';
        $from = "support@cfaffiliate360.com";
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
