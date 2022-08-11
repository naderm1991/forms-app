<?php
include 'db_connection.php';
include 'navigation_bar.php';
include 'error_handler.php';
error();
ini_set('display_errors', 0);
if (isset($_SESSION['user']['id']))
{
    echo "Welcome" . "  " . $_SESSION['user']['name'] ."<br>";
}else{
    header("Location: login.php");
    exit();
}
?>
<br>
<a href="logout.php">Logout</a>
<script type="text/javascript"></script>
