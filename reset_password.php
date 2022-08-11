<?php
include 'db_connection.php';
include 'src/functions.php';

// todo check the post request security issues
if($_GET['key'] && $_GET['reset'])
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['email']){
        $sql= 'select email from password_resets where email="'. $_POST['email'] .'"';
        /** @var TYPE_NAME $conn */
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()==1 && isset($_POST['submit_password']) && $_POST['password']){
            /** @var TYPE_NAME $conn */
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
            $stmt->execute(array(sha1($_POST['password']),$_POST['email']));
            delete_query($conn,$_POST);
            echo "Success.";
            header("Location: login.php");
        }
        echo "Not allowed,already done before.";
        header("refresh:3;url=login.php");
    }

    $email=$_GET['key'];
    $pass=$_GET['reset'];
    $sql= 'select email,password from users where md5(email)="'. $email .'" and md5(password)="'.$pass.'"';
    /** @var TYPE_NAME $conn */
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount()==1)
    {
        $row = $stmt->fetch();
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?".http_build_query($_GET); ?>">
            <input type="hidden" name="email" value="<?php echo $row['email'];?>">
            <p>Enter New password</p>
            <input type="password" name='password'>
            <input type="submit" name="submit_password">
        </form>
        <?php
    }else{
        echo "something went wrong.";
        header("refresh:3;url=login.php");
    }
}
?>