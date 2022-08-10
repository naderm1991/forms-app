<?php
require "config.php";
$dsn="mysql:host=".DB_HOST.";dbname=".DB_NAME;
$user=DB_USERNAME;
$password=DB_PASSWORD;
global $conn;
$options=array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');

try
{
    $conn=new PDO($dsn,$user,$password,$options);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $ex)
{
    echo "not connected".$ex->getMessage();
}