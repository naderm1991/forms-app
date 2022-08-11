<?php
include 'db_connection.php';
session_start();
$disabled=0;
$is_blocked=0;
$try_later=0;
$failed_login=0;
if (isset($_SESSION['tryings_count'] )){
    if ( $_SESSION['tryings_count'] == 3){
        $try_later =1;
    }
    elseif ($_SESSION['tryings_count'] ==4){
        $is_blocked = 1;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // collect value of input field
    $email = $_POST['email'];
    $password = $_POST['password'];
    $time = date("H:i:s");
    $date = date("Y/m/d");
    $hashed_pass = sha1($password);
    $count_2=0;
    $row=null;

    if (empty($email) || empty($password)) {
        $failed_login =1;
    }
    if (isset($email) && isset($password)) {
        /** @var TYPE_NAME $conn */
        $stmt = $conn->prepare("SELECT id,disabled FROM users WHERE email=?");
        $stmt->execute(array($email));
        $row = $stmt->fetch();
        $count_1 = $stmt->rowCount();

        if ($count_1){
            if ($row['disabled']==0){
                // todo find the best solution for this logic
                $stmt = $conn->prepare("SELECT id,name FROM users WHERE password =? and email=? and disabled=0");
                $stmt->execute(array($hashed_pass,$email));
                $row = $stmt->fetch();
                $count_2 = $stmt->rowCount();
                if ($count_2 ==0 && isset($_SESSION['tryings_count']) && $_SESSION['tryings_count'] >= 3 ){
                    $stmt = $conn->prepare("UPDATE users SET  disabled=1 WHERE email=?");
                    $stmt->execute(array($email));
                    $disabled=1;
                    $try_later=0;
                }elseif(!$try_later){
                    $failed_login=1;
                }
            }else{
                $disabled=1;
                $try_later=0;
            }
        }elseif(!$try_later){
            $failed_login=1;
        }
    }

    if ($count_2 > 0)
    {
        $_SESSION['user']['id'] = $row['id'];
        $_SESSION['user']['name'] = $row['name'];
        $_SESSION['tryings_count'] =0;
        echo "1";exit();
    }

    if (!$disabled){
        if (!isset($_SESSION['tryings_count'])){
            $_SESSION['tryings_count'] =1;
        }else{
            $_SESSION['tryings_count'] = $_SESSION['tryings_count']+1;

            if ($_SESSION['tryings_count'] == 3){
                $try_later=1;
            }else{
                $failed_login=1;
            }
        }
    }


    if ($try_later){
        echo "try again after 30 sec. ";
        $failed_login=0;
    }

    if ($is_blocked){
        echo "Sorry, this account is disabled.";
    }

    if ($disabled){
        echo "Sorry, this account is disabled.";
    }

    if ($failed_login){
        echo "Login Invalid.";
    }
}

