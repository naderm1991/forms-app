<?php
include 'db_connection.php';

if(isset($_POST['submit_password']) && $_POST['password']){
    /** @var TYPE_NAME $conn */
    $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
    $stmt->execute(array(sha1($_POST['password']),$_POST['email']));
    echo "Success.";
    header("Location: login.php");

}
else if($_GET['key'] && $_GET['reset'])
{
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
        <form method="post" action="reset_password.php">
            <input type="hidden" name="email" value="<?php echo $row['email'];?>">
            <p>Enter New password</p>
            <input type="password" name='password'>
            <input type="submit" name="submit_password">
        </form>
        <?php
    }else{
        echo "something went wrong.";
        header("Location: login.php");
    }
}
?>