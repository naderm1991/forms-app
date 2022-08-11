<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
include 'db_connection.php';

if(isset($_POST['submit_email']) && $_POST['email'])
{
    $email = $_POST['email'];
    $sql = "select email,password from users where email='$email'";
    /** @var TYPE_NAME $conn */
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount()==1)
    {
        //todo: remove static links and configs
        $row = $stmt->fetch();
        $email=md5($row['email']);
        $pass=md5($row['password']);
        $link="<a href='http://localhost/forms-app/reset_password.php?key=".$email."&reset=".$pass.">Click To Reset password</a>";
        $to=$row['email'];
        $subject  = 'Reset Password';
        $from = "emailtest@YOURDOMAIN";
        $header = "From:" . $from;
        $message = 'Click On This Link to Reset Password'.$link;
        $time = time();
        if(mail($to,$subject,$message,$header))
        {
            echo "Check Your Email and Click on the link sent to your email";
        }
        else
        {
            echo "Mail Error";
        }
    }
}
