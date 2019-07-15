<?php
    $email = filter_var(trim($_POST["email"]),FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST["password"]),FILTER_SANITIZE_STRING);

    $password = md5($password);

    $mysqli = new mysqli("localhost", "root", "root", "myBase");
    //$mysqli->query ("SET NAMES 'utf8'");
    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'");
    $user = $result->fetch_assoc();
    if(count($user) == 0) {
        echo "This is invalid user!!!";
        exit();
    }

    setcookie('name', $user['name'], time() + 3600 * 24, "/");
    setcookie('user_id', $user['id'], time() + 3600 * 24, "/");

    $mysqli->close ();
    header ("Location: /");
?>