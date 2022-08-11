<?php
include 'db_connection.php';
include 'Config.php';
?>
<html lang="en">
<style>
</style>
    <head>
        <title>Forms App</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav class="nav-color navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Form App</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <?php session_start(); ?>
                </ul>
            </div>
        </nav>

    </body>
</html>