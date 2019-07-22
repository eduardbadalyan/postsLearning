<?php
session_start();
    $name = filter_var(trim($_POST["name"]),FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]),FILTER_SANITIZE_STRING);
    $age = filter_var(trim($_POST["age"]),FILTER_SANITIZE_NUMBER_INT);

    $age = intval($age);
    

    if(strlen($name) == 0 || $email == "" || !preg_match ("/@/", $email) || $age == 0 || $age == "") {
        echo "fail";
        exit();
    }

    $mysqli = new mysqli("localhost", "root", "root", "myBase");

    $mysqli->query ("UPDATE `users` SET `name` = '".$name."' WHERE `users`.`id` = ".$_SESSION["user_id"].";");
    $mysqli->query ("UPDATE `users` SET `email` = '".$email."' WHERE `users`.`id` = ".$_SESSION["user_id"].";");
    $mysqli->query ("UPDATE `users` SET `age` = '".$age."' WHERE `users`.`id` = ".$_SESSION["user_id"].";");

    $result = $mysqli->query("SELECT * FROM `users` WHERE `id`='".$_SESSION[user_id]."'");
    $user = $result->fetch_assoc();

    $_SESSION["name"] = $user["name"];

    echo "success";
    exit();
?>