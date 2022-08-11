<?php
function select_query($conn,$columns,$table){
    $email = $columns['email'];
    $sql = "select email,password from $table where email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt;
}

function insert_query($conn,$array): int
{
    $email = $array['email'];
    $password= $array['password'];
    $sql = "INSERT INTO `password_resets` (`email`, `token`) VALUES". "( '$email','$password')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return 1;
}

function delete_query($conn,$array): int
{
    $email = $array['email'];
    $sql = "DELETE FROM `password_resets` WHERE email="."'$email'";
    /** @var TYPE_NAME $conn */
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return 1;
}