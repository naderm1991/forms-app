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
        $from = "support@cfaffiliate360.com";
        $header = "From:" . $from;
        $message = 'Click On This Link to Reset Password'.$link;
        $time = time();

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.zoho.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = getenv('MAIL_USERNAME');                     //SMTP username
            var_dump(getenv('MAIL_USERNAME'));die;
            $mail->Password   = getenv('MAIL_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('nader1_7@zohomail.com', 'Mailer');
            $mail->addAddress($_POST['email'], 'Nader Mohamed');     //Add a recipient
//            $mail->addAddress('ellen@example.com');               //Name is optional
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            if ( $mail->send()){
                echo 'Message has been sent';
                //header("refresh:1;url=login.php");
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
