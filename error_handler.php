<?php
function error()
{
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
    if(isset($_SESSION['Group_Name']))
    {
        if ($_SESSION['Group_Name'] != 'admin')
        {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            error_reporting(0);
        }
    }
    else {
        echo '<br>';
        echo 'Session timeout, Please Login again.';
    }
}

