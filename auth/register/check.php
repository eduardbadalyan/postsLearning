<?php
    $name = filter_var(trim($_POST["name"]),FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST["password"]),FILTER_SANITIZE_STRING);
    $checkPassword = filter_var(trim($_POST["password"]),FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]),FILTER_SANITIZE_STRING);
    $age = filter_var(trim($_POST["age"]),FILTER_SANITIZE_NUMBER_INT);

    $age = intval($age);
    $checkPassword = md5($checkPassword);
    $password = md5($password);

    if(strlen($name) == 0 || $email == "" || !preg_match ("/@/", $email) || strlen($password) == 0 || $password != $checkPassword  ||$age == 0 || $age == "") {
        header ("Location: /auth/register/?error=1");
        exit();
    };

    $mysqli = new mysqli("localhost", "root", "root", "myBase");
    $result = $mysqli->query("INSERT INTO `users` VALUES (NULL,'".$name."','".$age."','".$email."','".$password."')");

    $mysqli->close ();
    header ("Location: /");
    exit();
?>