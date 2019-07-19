<?php
    $name = filter_var(trim($_POST["name"]),FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST["password"]),FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]),FILTER_SANITIZE_STRING);
    $age = filter_var(trim($_POST["age"]),FILTER_SANITIZE_NUMBER_INT);

    $age = intval($age);
    

    if(strlen($name) == 0 || $email == "" || !preg_match ("/@/", $email) || $password == NULL || $age == 0 || $age == "") {
        session_start();
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["age"] = $age;

        echo "fail";
        exit();
    }
    //$password = md5($password);

    $mysqli = new mysqli("localhost", "root", "root", "myBase");
    $mysqli->query("INSERT INTO `users` VALUES (NULL,'".$name."','".$age."','".$email."','".$password."')");
    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'");
    $user = $result->fetch_assoc();
    session_start();

    $_SESSION["name"] = $user["name"];
    $_SESSION["user_id"] = $user["id"];

    echo "success";
    exit();
?>