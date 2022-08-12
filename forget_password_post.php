<?php

use PHPMailer\PHPMailer\PHPMailer;

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
require 'db_connection.php';
require 'src/functions.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

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
        $message = 'Click On This Link to Reset Password'.$link;
        $time = time();

        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.zoho.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = getenv('MAIL_USERNAME');                     //SMTP username
            $mail->Password   = getenv('MAIL_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('nader1_7@zohomail.com', $row['password']);
            $mail->addAddress($_POST['email'], $_POST['email']);     //Add a recipient
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            if ( $mail->send()){
                echo 'Message has been sent';
                header("refresh:1;url=login.php");
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
