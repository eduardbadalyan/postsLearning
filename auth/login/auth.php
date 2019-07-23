<?php
    session_start();

    $email = filter_var(trim($_POST["email"]),FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST["password"]),FILTER_SANITIZE_STRING);

    $password = md5($password);

    include ('../../config/db.php');
    //$mysqli->query ("SET NAMES 'utf8'");
    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'");
    $user = $result->fetch_assoc();

    $result_set = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
    $useremail = $result_set->fetch_assoc();
    if(count($useremail) == 0) {
        $_SESSION["email"] = $email;
        echo "failEmail";
        exit();
    }
    if(count($user) == 0) {
        $_SESSION["email"] = $email;
        echo "fail";
        exit();
    }

    $_SESSION['name'] = $user['name'];
    $_SESSION['user_id'] = $user['id'];

    $mysqli->close ();
    echo "success";
?>